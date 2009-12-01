<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-header-close.php' );
?>

<div class="for_login">
<form class="for_login" method="post" action="https://csip.washk12.org<?= $_SERVER['REQUEST_URI'] ?>">
  <div id="login">
  <h1>Please Login</h1>
  <span><label for="_username">Username: </label><input id="_username" name="_username" value="<?= $_SESSION[ 'username' ] ?>" /></span><br>
  <span><label for="_password">Password: </label><input id="_password" name="_password" value="" type="password" /></span><br>
<input type="submit" name="button" value="login"/>
</div>
<?php
  if ( $_SESSION['NOSESSION'] || $_SESSION['BADLOGIN'] || $_SESSION['NOTPERMITTED'] ) {
    echo "<div class='important'>\n";
    if ( $_SESSION[ 'NOSESSION' ] ) {
      echo "<!-- Not Logged In -->\n";
    }
    if ( $_SESSION[ 'BADLOGIN' ] ) {
      echo "<span>Incorrect Login</span><br>\n";
    }
    if ( $_SESSION[ 'NOTPERMITTED' ] ) {
      echo "<span>Not authorized</span><br>\n";
    }
    echo "</div>\n";
}
?>
</form>
</div>

<?php include( 'doc-close.php' ); ?>
