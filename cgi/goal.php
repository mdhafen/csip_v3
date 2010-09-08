<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/goal.phpm' );
include_once( '../inc/csips.phpm' );

if ( ! authorized( 'load_csip' ) || ! authorized( 'load_other_csip' ) ) {
  authorize( 'load_csip' );
}

$csip = $_SESSION['csip'];
if ( ! $csip ) {
  $location = ( preg_match( '/^http/', $config['base_url'] ) ) ? $config['base_url'] : "http://". $_SERVER['HTTP_HOST'] . $config['base_url'];
  header( "Location: $location" );
  exit;
}

$categoryid = input( 'categoryid', INPUT_PINT );
$goalid = input( 'goalid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$goal = $csip['category'][ $categoryid ]['goal'][ $goalid ];
$focus_list = question_get_options( -1 );

if ( $op == 'Save' ) {
  $update = array();

  $goal_desc = input( 'goal_description', INPUT_HTML_NONE );
  $goal_progress = input( 'goal_progress', INPUT_HTML_NONE );
  $goal_report = input( 'goal_report', INPUT_HTML_NONE );

  if ( $goal ) {
    if ( $goal_desc != $goal['goal'] ) {
      $update['goal'] = $goal_desc;
    }
    if ( $goal_progress != $goal['progress'] ) {
      $update['progress'] = $goal_progress;
    }
    if ( $goal_report != $goal['report'] ) {
      $update['report'] = $goal_report;
    }
  } else {
    $update = array(
	'goal' => $goal_desc,
	'progress' => $goal_progress || '',
	'report' => $goal_report || '',
	'csipid' => $csip['csipid'],
	'categoryid' => $categoryid,
		    );
  }

  if ( $update ) {
    $goalid = update_goal_fields( $goalid, $update );
    $updated = 1;
  }
} elseif ( $op == 'Save Subgoal' ) {
  if ( ! $goalid ) {
    $update = array();

    $goal_desc = '';  # or 'See Action Plan'
    $goal_progress = '';
    $goal_report = '';

    $update = array(
	'goal' => $goal_desc,
	'progress' => $goal_progress,
	'report' => $goal_report,
	'csipid' => $csip['csipid'],
	'categoryid' => $categoryid,
		    );

    $goalid = update_goal_fields( $goalid, $update );
    $csip = cat_reload_goal( $csip, $goalid );
    $_SESSION['csip'] = $csip;
    $goal = array(
    	'goalid' => $goalid,
        'goal' => $goal_desc,
	'csipid' => $csip['csipid'],
	'categoryid' => $categoryid,
                  );
  }

  $update = array();

  $activityid = input( 'activityid', INPUT_PINT );
  $activity = $goal['activity'][ $activityid ];

  $focus = input( "{$activityid}_focus", INPUT_STR );
  $activity_desc = input( "{$activityid}_activity_description", INPUT_HTML_NONE );
  $complete_date = input( "{$activityid}_complete_date", INPUT_STR );
  $completed = input( "{$activityid}_complete", INPUT_STR );
  $progress = input( "{$activityid}_progress", INPUT_HTML_NONE );
  $report = input( "{$activityid}_report", INPUT_HTML_NONE );
  $people_fullname = input( "{$activityid}_fullname", INPUT_HTML_NONE );
  if ( $people_fullname ) {
    $people_id = input( "{$activityid}_people_id", INPUT_PINT );
    $people_email = input( "{$activityid}_people_email", INPUT_EMAIL );
    if ( ! $people_id ) { $people_id = array(); }  // else this might be NULL
    foreach ( $people_fullname as $person_fullname ) {
      $person_delete = 0;
      $personid = array_shift( $people_id );
      $person_email = array_shift( $people_email );
      $person_delete = input( "{$activityid}_people_delete_{$personid}", INPUT_STR );
      $person_delete = ( $person_delete == "on" ) ? 1 : 0;
      if ( $personid && $person_fullname == '' && $person_email == '' ) {
	$person_delete = 1;
      }
      if ( $person_fullname || $person_email || $person_delete ) {
        $people[ $personid ] = array(
			'activity_people_id' => $personid,
			'fullname' => $person_fullname,
			'people_email' => $person_email,
			'delete' => $person_delete,
				    );
      }
    }
  }

  if ( ! $focus ) { $focus = ''; }
  if ( $completed ) { $completed = ( $completed == 'yes' ) ? 1 : 0; }
  if ( $complete_date ) {
    $date_arr = preg_split( '/[-\/\.]/', $complete_date );
    if ( $date_arr[2] < 100 ) {  // two digit year?
      if ( $date_arr[2] > 70 ) {
	$date_arr[2] += 1900;
      } else {
	$date_arr[2] += 2000;
      }
    }
    $complete_date = sprintf( '%04.d-%02.d-%02.d', $date_arr[2], $date_arr[0], $date_arr[1] );
  }

  if ( $activityid ) {
    if ( $focus != $activity['focus'] ) {
      $update['focus'] = $focus;
    }
    if ( $activity_desc != $activity['activity'] ) {
      $update['activity'] = $activity_desc;
    }
    if ( $complete_date != $activity['complete_date'] ) {
      $update['complete_date'] = $complete_date;
    }
    if ( $completed != $activity['completed'] ) {
      $update['completed'] = $completed;
    }
    if ( $progress != $activity['progress'] ) {
      $update['progress'] = $progress;
    }
    if ( $report != $activity['report'] ) {
      $update['report'] = $report;
    }
    if ( $focus != $activity['focus'] ) {
      $update['focus'] = $focus;
    }
    foreach ( (array) $people as $person ) {
      $person_old = $activity['activity_people'][ $person['activity_people_id'] ];
      if ( $person_old['fullname'] != $person['fullname'] ||
	   $person_old['email'] != $person['email'] ||
	   $person['delete'] ) {
	$update['people'][] = $person;
      }
    }
  } else {
    $update = array(
		    'focus' => $focus,
		    'activity' => $activity_desc,
		    'complete_date' => $complete_date,
		    'completed' => $completed,
		    'progress' => $progress,
		    'report' => $report,
		    'people' => $people,
		    'goalid' => $goalid,
		    );
  }

  if ( $update ) {
    $activityid = update_activity_fields( $activityid, $update );
    $updated = 1;
  }
} elseif ( $op == 'Delete Subgoal' ) {
  $activityid = input( 'activityid', INPUT_PINT );
  delete_activity( $activityid );
  $updated = 1;
} elseif ( $op == 'Add a Goal' ) {
  $next_goal = count( (array) $csip['category'][ $categoryid ]['goal'] ) + 1;
  $goal = array(
		'goal' => "Goal $next_goal",
		'csipid' => $csip['csipid'],
		'categoryid' => $categoryid,
		);
} elseif ( $op == 'Add a Subgoal' ) {
  if ( ! $goalid ) {
    $goalid = 0;
    $goal = array(
    	'goalid' => $goalid,
        'goal' => '',
	'csipid' => $csip['csipid'],
	'categoryid' => $categoryid,
                  );
  }

  $act = array(
	       'goalid' => $goalid,
	       );
  $goal['activity'][0] = $act;
}

if ( $updated ) {
  //$csip = load_csip( $csip['csipid'] );
  $csip = cat_reload_goal( $csip, $goalid );
  $_SESSION['csip'] = $csip;
  $goal = $csip['category'][ $categoryid ]['goal'][ $goalid ];
}

if ( ! $goal ) {
  $error[] = "BADGOAL";
}

$output = array(
	'csip' => $csip,
	'categoryid' => $categoryid,
	'goal' => $goal,
	'focus_list' => $focus_list,
	'updated' => $updated,
		);

output( $output, 'goal.tmpl' );
?>
