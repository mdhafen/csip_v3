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
$plans = array();

uasort( $years, function($a,$b){ return strcasecmp($b['year_name'],$a['year_name']); } );
if ( $district ) {
    $locations = all_locations();
}
else if ( !empty($_SESSION['loggedin_user']['locations']) ) {
    $locations = $_SESSION['loggedin_user']['locations'];
}

foreach ( $locations as &$loc ) {
    if ( $loc['mingrade'] >= 0 && $loc['maxgrade'] > 0 ) {
        $loc['selected'] = true;
    }
}

$run = input( 'run', INPUT_STR );
($locationids = input( 'locations', INPUT_PINT )) || ($locationids = array());
($courseids = input( 'courseids', INPUT_PINT )) || ($courseids = array());
$yearid = input( 'yearid', INPUT_PINT );

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
        case 8: $question = '33,68'; break;
        //FIXME hard coded values suck, but are necessary here
        default :
            error( array('REPORT_NOYEAR' => 'You must select a year that includes a technology plan.') );
    }

    $quoted_locations = array();
    foreach ( $locationids as $loc ) {
        $quoted_locations[] = $dbh->quote( $loc );
    }
    $quoted_courses = array();
    foreach ( $courseids as $cor ) {
        $quoted_courses[] = $dbh->quote( $cor );
    }

    if ( empty($courseids) ) {
        $wheres = array();
        $query = "SELECT courseid,course_name FROM course LEFT JOIN location_course_links USING (courseid) WHERE active = 1";
        if ( !empty($quoted_locations) ) {
            $grade_query = "SELECT MIN(mingrade) AS min, MAX(maxgrade) AS max FROM location WHERE locationid IN (". implode(',',$quoted_locations) .")";
            $sth = $dbh->query($grade_query);
            $grades = $sth->fetch(PDO::FETCH_ASSOC);
            $wheres[] = "( course.min_grade <= ". $dbh->quote($grades['max']) ." AND course.max_grade >= ". $dbh->quote($grades['min']) ." )";

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
        $query = "SELECT answer,part,location.name AS location_name,course_name,questionid FROM answer CROSS JOIN csip USING (csipid) CROSS JOIN location USING (locationid) CROSS JOIN course USING (courseid) WHERE yearid = ? AND courseid IN (". implode(',',$quoted_courses) .") AND questionid IN ($question)";
        if ( !empty($quoted_locations) ) {
            $query .= " AND csip.locationid IN (". implode(',',$quoted_locations) .")";
        }
        $query .= " order by csipid,part,questionid";
        $sth = $dbh->prepare($query);
        $sth->execute([$yearid]);
        while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
            if ( $version == 8 ) {
                $plans[ $row['location_name'] ][ $row['course_name'] ] = $row['answer'];
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
        'courses' => $courses,
        'courseids' => $courseids,
        'plans' => $plans,
        'run' => !empty($run)?$run:0,
);
output( $output, 'reports/PGPs' );
?>
