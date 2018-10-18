<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/data.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );
include_once( '../lib/user.phpm' );

global $config;

if ( ! authen_against_db() ) {
    error(array('INSTALL_ACCESS_DENIED'=>'Access to the installer is denied.'));
}

$output = array();
$checks_passed = input( 'checks_passed', INPUT_INT );
end( $config['role'] );
$admin_role = key( $config['role'] );
$output = do_checks( $admin_role, $checks_passed );

if ( !empty($output) ) {
    if ( !empty($output['INSTALL_USER_EXTERNAL']) ) {
        $module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
        if ( !is_readable( $module ) ) {
            error(array('INSTALL_EXTERNAL_NOMODULE'=>$module));
        }
        include_once( $module );
        $ex = new Authen_External();
        $sync_out = $output;
        if ( count($output) == 1 ) {
            $sync_out['checks_passed'] = 1;
        }
        else {
            $sync_out['ERROR'] = 1;
        }
        ( $step = input( 'step', INPUT_PINT ) ) || ($step = 1 );
        switch ($step) {
            case "1": $sync_out += (array) prepare_locations( $ex );
                      break;  // locations

            case "2": handle_locations();
                      $sync_out += (array) prepare_users( $ex );
                      break;  // users

            case "3": handle_users();
                      $sync_out += (array) prepare_courses( $ex );
                      break;  // courses

            case "4": handle_courses();
                      $step++;
                      break;
        }

        if ( $step < "4" ) {
            $sync_out['step'] = $step;
            output( $sync_out, 'install_external' );
            exit;
        }
        else {
            $output['step'] = $step;
            $output['checks_passed'] = 1;
        }
    }
    else {
        $output[ 'ERROR' ] = 1;
    }
}
else {
  $output['checks_passed'] = 1;
}

$locationid = input( 'locationid', INPUT_PINT );
$locationname = input( 'locationname', INPUT_HTML_NONE );
$username = input( 'username', INPUT_HTML_NONE );
$password = input( 'password', INPUT_STR );
$con_pass = input( 'password_confirm', INPUT_STR );
$fullname = input( 'fullname', INPUT_HTML_NONE );
$email = input( 'email', INPUT_EMAIL );

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM location WHERE locationid = :lid";
$sth = $dbh->prepare( $query );
$sth->bindValue( ':lid', $locationid );
$sth->execute();
$result = $sth->fetchColumn();
if ( $result >= 1 ) {
    # ALREADY_ADDED_LOCATION
}
else if ( ! ( $locationid && $locationname ) ) {
  $output['ERROR'] = 1;
  $output['INSTALL_NO_LOCATION'] = 1;
}
else {
  $location = array(
      'locationid' => $locationid,
      'locationname' => $locationname,
      'mingrade' => 0,
      'maxgrade' => 0,
      'loc_demo' => 0,
      'externalid' => '',
  );
  $result = update_location( 0, $location );
  if ( empty($result) ) {
    $output[ 'INSTALL_ADD_LOCATION_FAILED' ] = 1;
    $output['ERROR'] = 1;
  }
}

if ( empty($output['ERROR']) && !empty($username) && !empty($password) && !empty($con_pass) ) {
  if ( strcmp($password,$con_pass) != 0 ) {
    $output['INSTALL_PASS_NOMATCH'] = 1;
    $output['ERROR'] = 1;
  }
  else {
    $user = user_by_username( $username );
    if ( !empty($user) ) {
      $output['INSTALL_USERNAME_USED'] = 1;
      $output['ERROR'] = 1;
    }
    else {
      list( $password, $salt, $pass_mode ) = new_password( $con_pass );
      $user = array(
          'username' => $username,
          'fullname' => !empty($fullname) ? $fullname : "",
          'email' => !empty($email) ? $email : "",
          'role' => $admin_role,
          'password' => $password,
          'salt' => $salt,
          'password_mode' => $pass_mode,
          'externalid' => '',
      );
      $result = update_user( 0, $user );
      if ( empty($result) ) {
        $output['INSTALL_ADD_USER_FAILED'] = 1;
        $output['ERROR'] = 1;
      }
      else {
        update_user_locations( $result, array( $locationid ) );
        $output[ 'INSTALL_DONE' ] = 1;
      }
    }
  }
}

$output['locationid'] = $locationid;
$output['locationname'] = $locationname;
$output['username'] = $username;
$output['fullname'] = $fullname;
$output['email'] = $email;

output( $output, 'install' );

function do_checks( $admin_role, $checks_passed ) {
  global $config;
  $dbh = db_connect();
  $output = array();
  $schema = $config['database']['core']['write']['schema'];

  if ( !empty($config['user_external_module']) ) {
    $output[ 'INSTALL_USER_EXTERNAL' ] = 1;
  }

  if ( !empty($checks_passed) ) {
      return $output;
  }
  
  $query = "SELECT COUNT(*) AS count FROM information_schema.TABLES WHERE TABLE_SCHEMA = ?";
  $sth = $dbh->prepare( $query );
  $sth->execute( array($schema) );
  $result = $sth->fetchColumn();
  if ( empty($result) ) {
    if ( is_readable('../doc/DCSIP_v5_create.sql') && is_readable('../doc/DCSIP_v5_install.sql') ) {
// $dbh->setAttribute(PDO::MYSQL_ATTR_MAX_BUFFER_SIZE,$size);
// mysqli_options($dbh,MYSQLI_OPT_NET_CMD_BUFFER_SIZE,$size);
      $sql = file_get_contents( "../doc/DCSIP_v5_create.sql" );
      foreach ( array_map('trim',explode(';',$sql)) as $statement ) {
        if ( !empty($statement) ) {
          $dbh->exec( $statement );
          if ( $dbh->errorCode() !== '00000' ) {
            $db_error = $dbh->errorInfo();
            $output[ 'INSTALL_CREATETABLES_FAILED' ] = htmlspecialchars($db_error[2]);
            return $output;
          }
        }
      }

      $sql = file_get_contents( "../doc/DCSIP_v5_install.sql" );
      $statements = preg_split('/;$/m',$sql);
      foreach ( $statements as $statement ) {
	$statement = trim($statement);
        if ( !empty($statement) ) {
          $dbh->exec( $statement );
          if ( $dbh->errorCode() !== '00000' ) {
            $db_error = $dbh->errorInfo();
            $output[ 'INSTALL_CREATETABLES_FAILED' ] = htmlspecialchars($db_error[2]);
            return $output;
          }
        }
      }
    }
    else {
      $output[ 'INSTALL_CREATETABLES_CANT_READ' ] = 1;
      return $output;
    }
  }

  $query = "SELECT COUNT(*) AS count FROM user WHERE role = ?";
  $sth = $dbh->prepare( $query );
  $sth->execute( array($admin_role) );
  $result = $sth->fetchColumn();
  if ( $result >= 1 ) {
    $output[ 'INSTALL_ALREADY_ADDED_ADMIN' ] = 1;
  }
  return $output;
}

function prepare_locations( $ex ) {
    $out = array();
    $out['left'] = all_locations();
    $out['right'] = $ex->get_locations();
    uasort( $out['left'], function($a,$b){ return strcasecmp($a['name'],$b['name']); } );
    uasort( $out['right'], function($a,$b){ return strcasecmp($a['name'],$b['name']); } );
    $out['data_set'] = 'Locations';
    $out['value_field'] = 'locationid';
    $out['label_field'] = 'name';
    return $out;
}

function prepare_users( $ex ) {
    $out = array();
    $out['left'] = all_users();
    $out['right'] = $ex->get_users();
    uasort( $out['left'], function($a,$b){ return strcasecmp($a['fullname'],$b['fullname']); } );
    uasort( $out['right'], function($a,$b){ return strcasecmp($a['fullname'],$b['fullname']); } );
    $out['data_set'] = 'Users';
    $out['value_field'] = 'userid';
    $out['label_field'] = 'fullname';

    return $out;
}

function prepare_courses( $ex ) {
    $out = array();
    $out['left'] = get_courses( true );
    $out['right'] = $ex->get_courses();
    uasort( $out['left'], function($a,$b){ return strcasecmp($a['course_name'],$b['course_name']); } );
    uasort( $out['right'], function($a,$b){ return strcasecmp($a['course_name'],$b['course_name']); } );

    foreach ( $out['left'] as &$course ) {
        $course['label'] = $course['category_name'] .":". $course['course_name'] . ( ($course['min_grade'] > 0 && $course['max_grade'] > 0 ) ? " (". $course['min_grade'] ."-". $course['max_grade'] .")" : "" );
        $course['externalids'] = array_column( get_course_external_links($course['courseid']), 'externalid');
    }

    $out['data_set'] = 'Courses';
    $out['value_field'] = 'courseid';
    $out['label_field'] = 'course_name';
    return $out;
}

function handle_locations() {
    $locations = all_locations();
    $loc_map = array_combine( array_column($locations,'locationid'), array_column($locations,'externalid') );
    $loc_ids = input( 'elements', INPUT_PINT );
    $ex_ids = input( 'externals', INPUT_HTML_NONE );
    $count = count($loc_ids);
    for ( $i = 0; $i < $count; $i++ ) {
        $locid = $loc_ids[$i];
        $extid = $ex_ids[$i];
        if ( empty($loc_map[$locid]) || $loc_map[$locid] != $extid ) {
            update_location( $locid, array( 'externalid' => $extid ) );
        }
    }
}

function handle_users() {
    $users = all_users();
    $user_map = array_combine( array_column($users,'userid'), array_column($users,'externalid') );
    $user_ids = input( 'elements', INPUT_PINT );
    $ex_ids = input( 'externals', INPUT_HTML_NONE );
    $count = count($user_ids);
    for ( $i = 0; $i < $count; $i++ ) {
        $usrid = $user_ids[$i];
        $extid = $ex_ids[$i];
        if ( empty($user_map[$usrid]) || $user_map[$usrid] != $extid ) {
            update_user( $usrid, array( 'externalid' => $extid ) );

            $locations = $ex->get_users_locations( $externalid );
            update_user_locations( $userid, array_column($locations,'locationid') );
            if ( !empty($locations) ) {
                delete_course_user_links( $userid );
                foreach ( $locations as $loc ) {
                    if ( !empty($loc['externalid']) ) {
                        $courses = $ex->get_users_location_courses( $externalid, $loc['externalid'] );
                        foreach ( $courses as $crs ) {
                            add_course_user_link( $crs['courseid'], $userid, $loc['locationid'] );
                        }
                    }
                }
            }
        }
    }
}

function handle_courses() {
    $courses = get_courses( true );
    $crs_map = array();
	foreach ( $courses as $crs ) {
		$crs_map[ $crs['courseid'] ] = array_column( get_course_external_links($crs['courseid']), 'externalid');
	}
    $crs_ids = input( 'elements', INPUT_PINT );
    $count = count($crs_ids);
    for ( $i = 0; $i < $count; $i++ ) {
        $crsid = $crs_ids[$i];
		delete_course_external_link( $crsid );
		$ex_ids = input( $crsid .'_externals', INPUT_HTML_NONE );
		if ( !empty( $ex_ids ) ) {
			foreach ( $ex_ids as $extid ) {
				if ( empty($crs_map[$crsid]) || !in_array($extid,$crs_map[$crsid]) ) {
					update_course( $crsid, array( 'externalid' => $extid ) );
				}
			}
		}
    }
}
