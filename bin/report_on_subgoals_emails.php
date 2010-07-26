<?php
require_once 'Mail.php';

$params = array(
//	'host' => 'scan.washk12.org',
//	'auth' => false,  // or 'auth' => 'PLAIN',
);
$mail_factory =& Mail::factory( 'smtp', $params );

$from = 'postmaster@washk12.org.invalid';
$subject = "DCSIP Action Plan due-date passed.  Please report.";
$messages = array();  # output buffer
$today = date( 'Y-m-d' );
$url = "http://csip.washk12.org/respond.php?";

require_once( '../lib/config.phpm' );
require_once( $config['base_dir'] ."/lib/data.phpm" );
require_once( $config['base_dir'] ."/inc/csips.phpm" );

$dbh = db_connect();

# just so I don't have to go through all the csips
#  only get ones where a goal has an email, and a timeline isn't finished.
#  MOD: don't look at goal emai, we don't use it anymore
$query = '
 SELECT goal.csipid
   FROM activity
  CROSS JOIN goal USING ( goalid )
  WHERE activity.completed IS NULL
    AND activity.complete_date < CURRENT_DATE()
  GROUP BY goal.csipid
';

$result = $dbh->query( $query );

foreach ( $result as $row ) {
  $csipid = $row['csipid'];
  $csip = load_csip( $csipid );

  foreach ( (array) $csip['category'] as $categoryid => $category ) {

    $first_goal = 1;
    foreach ( (array) $category['goal'] as $goalid => $goal ) {
      $update_message = 0;
      $first_activity = 1;

      foreach ( (array) $goal['activity'] as $activityid => $activity ) {
	if ( $activity['completed'] === 1 || $activity['completed'] === '1' ||
	     $activity['completed'] === 0 || $activity['completed'] === '0' ) {
	  continue;
	}
	if ( $activity['complete_date'] < $today ) {

	  // first we need an email address
	  foreach ( (array) $activity['people'] as $peopleid => $person ) {
	    if ( ! $activity_email && $person['people_email'] ) {
	      $activity_email = $person['people_email'];
	    }
	  }
	  if ( ! $activity_email && $goal['goal_email'] ) {
	    $activity_email = $goal['goal_email'];
	  }

	  if ( $activity_email ) {
	    if ( ! $messages[ $activity_email ] ) {
	      $message = "
This E-Mail is a request to report on Action Plans entered in the DCSIP system
Your email address was entered as a person responsible for this Action Plan.
Please use the links below to report on the activities listed below.
------------------------------------------------------------------\n\n
";
	    } else {
	      $message = $messages[ $activity_email ];
	    }

	    if ( $first_goal ) {
	      $message .= "
Category : $category[category_name]
";
	    } else {
	      $first_goal = 0;
	    }

	    if ( $first_activity ) {
	      if ( $goal['goal']
	        $desc = $goal['goal'];
	      } elseif ( count( (array) $goal['activity'] ) ) {
	        $activities = (array) $goal['activity'];
	  	$act = reset( $activities );
  		$desc = $act['activity'];
	      } else {
	        $desc = 'See Action Plan';
	      }
	      $message .= "
Action Plan : $desc
";
	    } else {
	      $first_activity = 0;
	    }
	    $update_message++;
	    $message .= "
Action Plan $update_message : $activity[activity]

Action Plan Expected Completion Date(MM/DD/YYYY): ".
date('m/d/Y', strtotime( $activity['complete_date'] ) ) ."

If this Action Plan has been meet please visit : 
{$url}activity={$activityid}&goal={$goalid}&category={$categoryid}&csip={$csipid}&response=yes

If this Action Plan has NOT been meet pleast visit : 
{$url}activity={$activityid}&goal={$goalid}&category={$categoryid}&csip={$csipid}&response=no
\n\n";

	  }
	}
      }
      if ( $update_message ) {
	$messages[ $activity_email ] = $message;
      }
      $activity_email = "";
    }
  }
}

foreach ( $messages as $email => $mess ) {
  $header = array(
    'To' => $email,
    'Subject' => $subject,
    'From' => $from,
  );
  $result = $mail_factory->send( $email, $headers, $mess );
  if ( PEAR::isError( $result ) ) { print ( $result->getMessage() ); }
  //print "\nMessage sent to $email about $subject : \n$mess\n";
}
?>
