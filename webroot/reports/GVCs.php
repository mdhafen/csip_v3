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
$locations = all_locations();
$courses = array();

$run = input( 'run', INPUT_STR );
$locationids = input( 'locations', INPUT_PINT );
$yearid = input( 'yearid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$grade = input( 'grade', INPUT_PINT );

if ( !empty($run) ) {
    $dbh = db_connect();

    $version = 0;
    $questionid = 0;
    foreach ( $years as $year ) {
        if ( $year['yearid'] == $yearid ) {
            $version = $year['version'];
            break;
        }
    }
    switch ( $version ) {
        case 7: $questions = '15'; break;
        case 8: $questions = '46,49,50'; break;
        //FIXME hard coded values suck, but are necessary here
        default :
            error( array('REPORT_NOYEAR' => 'You must select a year.') );
    }
    
    $quoted_locations = "";
    foreach ( $locationids as $loc ) {
        $quoted_locations[] = $dbh->quote( $loc );
    }

    if ( empty($courseid) ) {
        $query = "SELECT courseid,course_name FROM course CROSS JOIN location_course_links USING (courseid) WHERE ( course.min_grade > ". $dbh->quote($grade) ." AND course.max_grade < ". $dbh->quote($grade) ." ) OR locationid IN (". implode(',',$quoted_locations) .")";
        $sth = $dbh->query($query);
        $courses = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        $gvcs = array();

        $query = "SELECT answer,part,location.name AS location_name,questionid FROM answers CROSS JOIN csip USING (csipid) CROSS JOIN location USING (locationid) WHERE courseid = ? AND questionid IN (?) order by csipid,part,questionid";
        $sth = $dbh->prepare($query);
        $sth->execute($courseid,$questions);
        while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
            switch ( $version ) {
            case 7:
                $gvcs[ $row['location_name'] ][ $row['part'] - 3 ]['GVC'] = stripslashes_array( $row );
                break;
            case 8:
                switch ( $row['questionid'] ) {
                   case 46: $label = 'GVC'; break;
                   case 49: $label = 'Learning Targets'; break;
                   case 50: $label = 'CFA'; break;
                }
                $gvcs[ $row['location_name'] ][ $row['part'] - 3 ][$label] = stripslashes_array( $row );
                break;
            //FIXME have to use hard coded values here again
            }
        }
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
        'run' => !empty($run),
);
output( $output, 'reports/GVCs' );
?>
