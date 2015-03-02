<?php
include_once( '../../lib/input.phpm' );
include_once( '../../lib/security.phpm' );
include_once( '../../lib/output.phpm' );

include_once( '../../inc/manage_site.phpm' );

authorize( 'manage_users' );

$userid = input( 'userid', INPUT_PINT );
$op = input( 'op', INPUT_STR );

$locations = get_locations();
$roles = roles();

if ( $userid ) {
  $user = get_user_by_userid( $userid );
  if ( $user ) {
    $edit = 1;
    foreach ( $locations as &$loc ) {
      if ( $loc['locationid'] == $user['locationid'] ) {
	$loc['selected'] = 1;
	break;
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
  $location = input( 'location', INPUT_PINT );
  $password = input( 'password', INPUT_STR );
  $password2 = input( 'password_2', INPUT_STR );
  if ( $password && $password != '*****' && $password == $password2 ) {
    list( $user_password, $salt ) = new_password( $password );
  }

  $found = 0;
  foreach ( $locations as &$loc ) {
    if ( $loc['locationid'] == $location ) {
      $found = 1;
      break;
    }
  }
  if ( ! $found ) {
    output( "<html><body>You Can't Do That!</body></html>", NULL );
    exit;
  }

  $found = 0;
  foreach ( $roles as $roleid => &$arole ) {
    if ( $roleid == $role ) {
      $found = 1;
      break;
    }
  }
  if ( ! $found ) {
    output( "<html><body>You Can't Do That!</body></html>", NULL );
    exit;
  }

  if ( $user ) {
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
    if ( $location != $user['locationid'] ) {
      $updated['locationid'] = $location;
    }
    if ( $salt ) {
      $updated['salt'] = $salt;
      $updated['password'] = $user_password;
    }
  } else {
    $updated = array(
	'username' => $username,
	'fullname' => $fullname,
	'email' => $email,
	'role' => $role,
	'locationid' => $location,
	'password' => $user_password,
	'salt' => $salt,
		     );
  }

  if ( $updated ) {
    $userid = update_user_fields( $userid, $updated );
    $user = get_user_by_userid( $userid );
    if ( $user ) {
      $saved = 1;
      $edit = 1;
      $locations = get_locations();
      $roles = roles();
      foreach ( $locations as &$loc ) {
	if ( $loc['locationid'] == $user['locationid'] ) {
	  $loc['selected'] = 1;
	  break;
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
