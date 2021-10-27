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
$course_name = '';
$labels = array(
    //FIXME have to use hard coded values here
    15 => 'GVC',
    46 => 'GVC',

    16 => '# assessed',
    51 => '# assessed',

    17 => '# NOT proficient',
    52 => '# NOT proficient',

    21 => 'Interventions',
    57 => 'Interventions',

    22 => 'Still NOT proficient',
    58 => 'Still NOT proficient',

    27 => 'Extensions',
    63 => 'Extensions',
);

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
        //FIXME hard coded values suck, but are necessary here
        case 7: $questions = '15,16,17,21,22,27'; break;
        case 8: $questions = '46,51,52,57,58,63'; break;
        default :
            $questions = '15,16,17,21,22,27,46,51,52,57,58,63';
    }
    
    $quoted_locations = array();
    foreach ( $locationids as $loc ) {
        $quoted_locations[] = $dbh->quote( $loc );
    }

    if ( empty($courseid) ) {
        $wheres = array();
        $query = "SELECT courseid,course_name FROM course LEFT JOIN location_course_links USING (courseid) WHERE active = 1";
        if ( !empty($grade) ) {
            $wheres[] = "( course.min_grade <= ". $dbh->quote($grade) ." AND course.max_grade >= ". $dbh->quote($grade) ." )";
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
    }
    else {
        $query = "SELECT courseid,course_name FROM course WHERE active = 1 AND courseid = ". $dbh->quote($courseid);
        $sth = $dbh->prepare($query);
        $sth->execute([$courseid]);
        $course_name = $sth->fetch( PDO::FETCH_ASSOC );
        $course_name = $course_name['course_name'];

        $query = "SELECT answer,part,year_name,location.name AS location_name,questionid FROM answer CROSS JOIN csip USING (csipid) CROSS JOIN year USING (yearid) CROSS JOIN location USING (locationid) WHERE courseid = ? AND questionid IN ($questions)";
        if ( !empty($quoted_locations) ) {
            $query .= " AND csip.locationid IN (". implode(',',$quoted_locations) .")";
        }
        $query .= " order by csipid,part,questionid";
        $sth = $dbh->prepare($query);
        $sth->execute([$courseid]);
        while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
            $label = $labels[ $row['questionid'] ];
            $gvcs[ $row['location_name'] ][ $row['year_name'] ][ $row['part'] - 3 ][$label] = $row['answer'];
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
        'course_name' => $course_name,
        'gvcs' => $gvcs,
        'labels' => array_unique($labels),
        'run' => !empty($run)?$run:0,
);
output( $output, 'reports/Interventions' );
?>
