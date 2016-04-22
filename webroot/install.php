<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/data.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );
include_once( '../lib/user.phpm' );

global $config;

$output = array();
end( $config['role'] );
$admin_role = key( $config['role'] );

$output = do_checks( $admin_role );

if ( !empty($output) ) {
  $output[ 'ERROR' ] = 1;
}
else {
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
    );
    $result = update_location( 0, $location );
    if ( empty($result) ) {
      $output[ 'INSTALL_ADD_LOCATION_FAILED' ] = 1;
      $output['ERROR'] = 1;
    }
  }

  if ( empty($output) && !empty($username) && !empty($password) && !empty($con_pass) ) {
    if ( strcmp($password,$con_pass) != 0 ) {
      $output['INSTALL_PASS_NOMATCH'] = 1;
      $output['ERROR'] = 1;
    }
    else {
      $user = user_by_username( $username );
error_log("U: ". print_r($user,true) );
      if ( !empty($user) ) {
        $output['INSTALL_USERNAME_USED'] = 1;
        $output['ERROR'] = 1;
      }
      else {
        list( $password, $salt ) = new_password( $con_pass );
        $user = array(
          'username' => $username,
          'fullname' => !empty($fullname) ? $fullname : "",
          'email' => !empty($email) ? $email : "",
          'role' => $admin_role,
          'password' => $password,
          'salt' => $salt,
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

}

output( $output, 'install' );

function do_checks( $admin_role ) {
  global $config;
  $dbh = db_connect();
  $output = array();
  $schema = $config['database']['core']['write']['schema'];

  if ( !empty($config['user_external_module']) ) {
    $output[ 'INSTALL_USER_EXTERNAL' ] = 1;
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
