<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );
include_once( '../../lib/user.phpm' );

authorize( 'manage_users' );

$userid = input( 'userid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$edit = 0;
$saved = 0;
$user = array();
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

if ( $op == "Save" ) {  // Update/Add the user
  $username = input( 'username', INPUT_HTML_NONE );
  $fullname = input( 'fullname', INPUT_HTML_NONE );
  $email = input( 'email', INPUT_EMAIL );
  $role = input( 'role', INPUT_PINT );
  $user_locations = input( 'locations', INPUT_PINT );
  $password = input( 'password', INPUT_STR );
  $password2 = input( 'password_2', INPUT_STR );
  if ( $password && $password != '*****' && $password == $password2 ) {
    list( $user_password, $salt ) = new_password( $password );
  }

  foreach ( $user_locations as $locid ) {
    if ( !in_array($locid, array_column($locations,'locationid')) ) {
      error( array('BADLOC' => 'Undefined Location') );
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
    if ( !empty($salt) ) {
      $updated['salt'] = $salt;
      $updated['password'] = $user_password;
    }
  } else {
    $updated = array(
	'username' => $username,
	'fullname' => $fullname,
	'email' => $email,
	'role' => $role,
	'password' => $user_password,
	'salt' => $salt,
		     );
  }

  if ( !empty($updated) ) {
    $userid = update_user( $userid, $updated );
    if ( !empty($user_locations) ) {
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
	'locations' => $locations,
	'roles' => $roles,
);
output( $output, 'manage/edit_user.tmpl' );
?>