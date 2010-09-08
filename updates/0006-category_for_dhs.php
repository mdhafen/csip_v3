<?php

include_once( '../lib/data.phpm' );
include_once( '../lib/config.phpm' );

$db_settings = $config['database'];
$table = $db_settings['schema'];

$dbh = db_connect();
$query = "SELECT COUNT(*) AS count FROM category WHERE version = 3 AND ( loc_cat_subcat = 704 OR category_name = 'Information Literacy' )";
$sth = $dbh->query( $query );
$row = $sth->fetch();
if ( $row['count'] == 0 ) {
  $query = "
INSERT INTO category (
 category_name, category_class, category_type, type_target,
 category_group, course_group, course_group_order, category_note, version,
 question_group, gradelevel, loc_cat_subcat,
 needs_principal_approve, needs_community_approve, needs_district_approve,
 custom_goal_focus, parent_category )
VALUES
 ( 'Information Literacy', 'OTHR', 0, '', 0, 0, 0, '', 3, 17, 0, '704', 1, 0, 0, 0, 0 )
";
  $result = $dbh->exec( $query );
  if ( $result !== FALSE ) {
    return "Adding Category for Information Literacy in DHS";
  } else {
    $error = $dbh->errorInfo();
    return "Error adding category for DHS: ". $error[2];
  }
}

?>
