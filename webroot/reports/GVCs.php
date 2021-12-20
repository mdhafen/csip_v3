<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/data.phpm' );
include_once( '../../inc/csips.phpm' );
include_once( '../../inc/course.phpm' );

authorize( 'view_reports' );

$district = authorized( 'load_other_csip' );

$years = get_years();
$locations = array();
$courses = array();
$gvcs = array();
$course_names = array();

uasort( $years, function($a,$b){ return strcasecmp($b['year_name'],$a['year_name']); } );
if ( $district ) {
    $locations = all_locations();
}
else if ( !empty($_SESSION['loggedin_user']['locations']) ) {
    $locations = $_SESSION['loggedin_user']['locations'];
}

$run = input( 'run', INPUT_STR );
($locationids = input( 'locations', INPUT_PINT )) || ($locationids = array());
$yearid = input( 'yearid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$grade = input( 'grade', INPUT_PINT );
$cfas = input( 'CFAs', INPUT_STR );
$all_courses = input( 'all_courses', INPUT_STR );

if ( !empty($run) ) {
    $dbh = db_connect();

    $version = 0;
    foreach ( $years as $year ) {
        if ( $year['yearid'] == $yearid ) {
            $version = $year['version'];
            break;
        }
    }
    switch ( $version ) {
        case 7: $questions = '15'; break;
        case 8: $questions = !empty($cfas)?'46,49,50':'46'; break;
        //FIXME hard coded values suck, but are necessary here
        default :
            error( array('REPORT_NOYEAR' => 'You must select a year.') );
    }

    $quoted_locations = array();
    foreach ( $locationids as $loc ) {
        $quoted_locations[] = $dbh->quote( $loc );
    }

    if ( empty($courseid) && empty($all_courses) ) {
        $wheres = array();
        $query = "SELECT courseid,course_name FROM course LEFT JOIN location_course_links USING (courseid) WHERE active = 1";
        if ( !empty($grade) ) {
            $wheres[] = "( course.min_grade >= ". $dbh->quote($grade) ." AND course.max_grade <= ". $dbh->quote($grade) ." )";
        }
        else if ( !empty($quoted_locations) ) {
            $grade_query = "SELECT MIN(mingrade) AS min, MAX(maxgrade) AS max FROM location WHERE locationid IN (". implode(',',$quoted_locations) .")";
            $sth = $dbh->query($grade_query);
            $grades = $sth->fetch(PDO::FETCH_ASSOC);
            $wheres[] = "( course.min_grade <= ". $dbh->quote($grades['max']) ." AND course.max_grade >= ". $dbh->quote($grades['min']) ." )";
        }

        if ( !empty($quoted_locations) ) {
            $wheres[] = "locationid IN (". implode(',',$quoted_locations) .")";
        }
        if ( !empty($wheres) ) {
            $query .= " AND ( ". implode( ' OR ', $wheres ) ." )";
        }
        $query .= " GROUP BY courseid ORDER BY course_name";
        $sth = $dbh->query($query);
        $courses = $sth->fetchAll(PDO::FETCH_ASSOC);
        usort( $courses, function($a,$b) { return strcmp($a['course_name'],$b['course_name']); } );
    }
    else {
        $params = array();
        $query = "SELECT courseid,course_name FROM course WHERE active = 1";
        if ( !empty($courseid) ) {
            $query .= " AND courseid = ". $dbh->quote($courseid);
            $params[] = $courseid;
        }
        $sth = $dbh->prepare($query);
        $sth->execute($params);
        while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
            $course_names[$row['courseid']] = $row['course_name'];
        }

        $params = array($yearid);
        $query = "SELECT ". (!empty($all_courses) ? "COUNT(answer) AS answer" : "answer") .",part,course_name,location.name AS location_name". ($all_courses ? "" : ",questionid" ) ." FROM course LEFT JOIN location_course_links USING (courseid) CROSS JOIN location ON (location_course_links.locationid = location.locationid OR (course.min_grade <= location.maxgrade AND course.max_grade >= location.mingrade)) CROSS JOIN csip ON (csip.locationid = location.locationid) LEFT JOIN answer ON (course.courseid = answer.courseid AND csip.csipid = answer.csipid AND answer.part >= 3) WHERE ". (!empty($all_courses) ? "yearid = ?" : "yearid = ? AND questionid IN ($questions)");
        if ( !empty($courseid) ) {
            $query .= " AND course.courseid = ?";
            $params[] = $courseid;
        }
        if ( !empty($grade) ) {
            $query .= " AND course.min_grade >= ? AND course.max_grade <= ?";
            $params[] = $grade;
            $params[] = $grade;
        }
        if ( !empty($quoted_locations) ) {
            $query .= " AND location.locationid IN (". implode(',',$quoted_locations) .") AND (location.locationid = location_course_links.locationid OR location_course_links.locationid IS NULL)";
        }
        if ( !empty($all_courses) ) {
            $query .= " group by location_name,course.courseid,part";
        }
        $query .= " order by location_name,course_name". ( !empty($all_courses) ? "" : ",part,questionid" );
        $sth = $dbh->prepare($query);
        $sth->execute($params);
        while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
            if ( !empty($row['part']) && $row['part'] <= 3 ) { continue; }
            $part = $row['part'] - 3;
            $question = !empty($row['questionid']) ? $row['questionid'] : null;
            if ( $version == 7 ) {
                $gvcs[ $row['location_name'] ][ $row['course_name'] ][ $part ]['GVC'] = $row['answer'];
            }
            else if ( $version == 8 ) {
                switch ( $question ) {
                   case 46: $label = 'GVC'; break;
                   case 49: $label = 'Learning Targets'; break;
                   case 50: $label = 'CFA'; break;
                   case null: $label = 'GVCs'; break;
                }
                $gvcs[ $row['location_name'] ][ $row['course_name'] ][ $part ][$label] = $row['answer'];
            //FIXME have to use hard coded values here again
            }
        }
        foreach ( $gvcs as $loc => &$cos ) {
            ksort($cos);
        }
        $run = 'Finished';
    }
}

$output = array(
        'years' => $years,
        'locations' => $locations,
        'yearid' => $yearid,
        'locationids' => $locationids,
        'grade' => $grade,
        'courses' => $courses,
        'courseid' => $courseid,
        'course_names' => $course_names,
        'gvcs' => $gvcs,
        'all_courses' => $all_courses,
        'run' => !empty($run)?$run:0,
);
output( $output, 'reports/GVCs' );
?>
