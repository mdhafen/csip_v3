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
$locations = empty($_SESSION['loggedin_user']['locations']) ? array() : array_keys( $_SESSION['loggedin_user']['locations'] );

$run = input( 'run', INPUT_STR );
$locationids = input( 'locations', INPUT_PINT );
$yearid = input( 'yearid', INPUT_PINT );
$courseid = input( 'courseid', INPUT_PINT );
$grade = input( 'grade', INPUT_PINT );

if ( !empty($run) ) {
    $dbh = db_connect();

    $quoted_locations = "";
    foreach ( $locationids as $loc ) {
        $quoted_locations[] = $dbh->quote( $loc );
    }

    $query = "SELECT courseid,course_name FROM course CROSS JOIN location_course_links USING (courseid) WHERE ( course.min_grade > ". $dbh->quote($grade) ." AND course.max_grade < ". $dbh->quote($grade) ." ) OR locationid IN (". implode(',',$quoted_locations) .")";
    $sth = $dbh->query($query);
    $courses = $sth->fetchAll(PDO::FETCH_ASSOC);

    $csips = array();
    if ( ! empty($locationids) ) {
        $csipids = get_csips( $locationids, 0, array($yearid) );
        foreach ( array_column($csipids,'csipid') as $csipid ) {
            if ( !in_array( get_csip_locationid( $csipid ), $locations ) && ! $district ) {
                error( array('NOTYOURS' => 'Access to CSIP at that location is denied.') );
            }
            else {
                $csips[$csipid] = load_csip( $csipid, $_SESSION['loggedin_user']['userid'], $district );
            }
        }
    }

    $report = array();
    if ( !empty($csips) ) {
        // fill $report here
    }
}

$output = array(
        'years' => $years,
        'locations' => $locations,
        'report' => $report,
);
output( $output, 'reports/index' );
?>
