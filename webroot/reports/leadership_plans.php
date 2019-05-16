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
$course = '419'; // FIXME - Hard coded for our School Leadership course 
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
        case 8: $question = '68'; break;
        //FIXME hard coded values suck, but are necessary here
        default :
            error( array('REPORT_NOYEAR' => 'You must select a year that includes a leadership growth plan.') );
    }
    
    $quoted_locations = array();
    foreach ( $locationids as $loc ) {
        $quoted_locations[] = $dbh->quote( $loc );
    }

    $query = "SELECT answer,part,location.name AS location_name,questionid FROM answer CROSS JOIN csip USING (csipid) CROSS JOIN location USING (locationid) WHERE yearid = ? AND courseid = ? AND questionid = ?";
    if ( !empty($quoted_locations) ) {
        $query .= " AND csip.locationid IN (". implode(',',$quoted_locations) .")";
    }
    $query .= " order by csipid,part,questionid";
    $sth = $dbh->prepare($query);
    $sth->execute([$yearid,$course,$question]);
    while ( $row = $sth->fetch( PDO::FETCH_ASSOC ) ) {
        if ( $version == 8 ) {
            $plans[ $row['location_name'] ] = $row['answer'];
        }
    }
    $run = 'Finished';
}

$output = array(
        'years' => $years,
        'locations' => $locations,
        'yearid' => $yearid,
        'locationids' => $locationids,
        'plans' => $plans,
        'run' => !empty($run)?$run:0,
);
output( $output, 'reports/leadership_plans' );
?>
