<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );
global $config;

authorize( 'manage_users' );

$userid = input( 'userid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$externals = array();
$edit = 0;
$saved = 0;
$user = array( 'locations'=>array() );
$locations = all_locations();
$roles = roles();

if ( $userid ) {
  $user = user_by_userid( $userid );
  if ( $user ) {
    $edit = 1;
    foreach ( $locations as &$loc ) {
      if ( in_array($loc['locationid'], array_keys($user['locations'])) ) {
	$loc['selected'] = 1;
      }
    }
    foreach ( $roles as $roleid => &$arole ) {
      if ( $roleid == $user['role'] ) {
	$arole['selected'] = 1;
	break;
      }
    }
  } else {
    $edit = 0;
    $user = array();
  }
}

if ( !empty($config['user_external_module']) ) {
	$module = $config['base_dir'] .'/lib/'. $config['user_external_module'] .".phpm";
	if ( !is_readable( $module ) ) {
		$error[] = 'EXTERNAL_NOMODULE';
	}
	include_once( $module );
	$ex = new Authen_External();

	$users = all_users();
	global $assigned_externals;
	$assigned_externals = array_filter(array_column($users,'externalid'));
	$externals = $ex->get_users();
	$externals = array_filter( $externals, function($var){global $assigned_externals; return !in_array($var['externalid'],$assigned_externals); } );
	uasort( $externals, function($a,$b){ return strcasecmp($a['fullname'],$b['fullname']); } );
}

if ( $op == "Save" ) {  // Update/Add the user
  $username = input( 'username', INPUT_HTML_NONE );
  $fullname = input( 'fullname', INPUT_HTML_NONE );
  $email = input( 'email', INPUT_EMAIL );
  $role = input( 'role', INPUT_PINT );
  $externalid = input( 'externalid', INPUT_HTML_NONE );
  $user_locations = input( 'locations', INPUT_PINT );
  $loc_changed = false;
  $password = input( 'password', INPUT_STR );
  $password2 = input( 'password_2', INPUT_STR );
  $user_password = '';
  $salt = '';
  $pass_mode = '';
  if ( $password && $password != '*****' && $password == $password2 ) {
    list( $user_password, $salt, $pass_mode ) = new_password( $password );
  }

  foreach ( $user_locations as $locid ) {
    if ( !in_array($locid, array_column($locations,'locationid')) ) {
      error( array('BADLOC' => 'Undefined Location') );
    }
    if ( !in_array($locid, array_keys($user['locations'])) ) {
      $loc_changed = true;
    }
  }
  foreach ( $user['locations'] as $locid => $loc ) {
    if ( !in_array($locid, $user_locations) ) {
      $loc_changed = true;
    }
  }

  $found = 0;
  foreach ( $roles as $roleid => &$arole ) {
    if ( $roleid == $role ) {
      $found = 1;
      break;
    }
  }
  if ( ! $found ) {
    error( array('BADROLE' => 'Undefined Role') );
  }

  $updated = array();
  if ( !empty($user) ) {
    if ( $username != $user['username'] ) {
      $updated['username'] = $username;
    }
    if ( $fullname != $user['fullname'] ) {
      $updated['fullname'] = $fullname;
    }
    if ( $email != $user['email'] ) {
      $updated['email'] = $email;
    }
    if ( $role != $user['role'] ) {
      $updated['role'] = $role;
    }
    if ( $externalid != $user['externalid'] ) {
      $updated['externalid'] = $externalid;
    }
    if ( !empty($salt) ) {
      $updated['salt'] = $salt;
      $updated['password'] = $user_password;
      $updated['password_mode'] = $pass_mode;
    }
  } else {
    $updated = array(
	'username' => $username,
	'fullname' => $fullname,
	'email' => $email,
	'role' => $role,
	'password' => $user_password,
	'salt' => $salt,
	'password_mode' => $pass_mode,
        'externalid' => $externalid,
		     );
    $loc_changed = true;
  }

  if ( !empty($updated) || $loc_changed ) {
    if ( !empty($updated) ) {
      $userid = update_user( $userid, $updated );

	  if ( !empty($config['user_external_module']) && !empty($updated['externalid'])) {
        delete_course_user_links( $userid );
        foreach ( $user_locations as $loc ) {
          if ( !empty($loc['externalid']) ) {
            $courses = $ex->get_users_location_courses( $externalid, $loc['externalid'] );
            foreach ( $courses as $crs ) {
              add_course_user_link( $crs['courseid'], $userid, $loc['locationid'] );
            }
          }
        }
	  }
    }
    if ( $loc_changed ) {
      update_user_locations( $userid, $user_locations );
    }
    $user = user_by_userid( $userid );
    if ( $user ) {
      $saved = 1;
      $edit = 1;
      $locations = all_locations();
      $roles = roles();
      foreach ( $locations as &$loc ) {
        if ( in_array($loc['locationid'], array_keys($user['locations'])) ) {
	  $loc['selected'] = 1;
	}
      }
      foreach ( $roles as $roleid => &$arole ) {
	if ( $roleid == $user['role'] ) {
	  $arole['selected'] = 1;
	  break;
	}
      }
    }
  }
}

$output = array(
	'edit' => $edit,
	'saved' => $saved,
	'user' => $user,
	'externals' => $externals,
	'locations' => $locations,
	'roles' => $roles,
);
output( $output, 'manage/edit_user.tmpl' );
?>
