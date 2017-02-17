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
        $query = "SELECT answer,part,location.name AS location_name,questionid FROM answer CROSS JOIN csip USING (csipid) CROSS JOIN location USING (locationid) WHERE courseid = ? AND questionid IN ($questions)";
        if ( !empty($quoted_locations) ) {
            $query .= " AND csip.locationid IN (". implode(',',$quoted_locations) .")";
        }
        $query .= " order by csipid,part,questionid";
        $sth = $dbh->prepare($query);
        $sth->execute([$courseid]);
        while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
            if ( $version == 7 ) {
                $gvcs[ $row['location_name'] ][ $row['part'] - 3 ]['GVC'] = $row['answer'];
            }
            else if ( $version == 8 ) {
                switch ( $row['questionid'] ) {
                   case 46: $label = 'GVC'; break;
                   case 49: $label = 'Learning Targets'; break;
                   case 50: $label = 'CFA'; break;
                }
                $gvcs[ $row['location_name'] ][ $row['part'] - 3 ][$label] = $row['answer'];
            //FIXME have to use hard coded values here again
            }
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
        'gvcs' => $gvcs,
        'run' => !empty($run)?$run:0,
);
output( $output, 'reports/GVCs' );
?>
