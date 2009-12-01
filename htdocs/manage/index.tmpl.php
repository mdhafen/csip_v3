<?php include( $data['_config']['base_dir'] .'/htdocs/doc-open.php' ); ?>
<title>Site Management</title>
<?php
include( $data['_config']['base_dir'] .'/htdocs/doc-head-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-open.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-header-close.php' );
include( $data['_config']['base_dir'] .'/htdocs/doc-menu.php' );
?>
<h1>Site Management</h1>
<table>
<tr valign="top">
<td>

<a href="/csip_v3/cgi/manage/new_user.php">Add User</a>
<table>
<caption>Users</caption>
<thead>
<tr>
<td>Full Name</td><td>Location</td><td>username</td><td>Password</td><td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php foreach ( $data['users'] as $user ) { ?>
<tr>
<td><?= $user['fullname'] ?></td>
<td><?= $user['locationid'] ?></td>
<td><?= $user['username'] ?></td>
<td><a href="/csip_v3/cgi/manage/set_password.php?userid=<?= $user['userid'] ?>"><?= $user['password']?"Yes":"No" ?></a></td>
<td>
<a href="/csip_v3/cgi/manage/edit_user.php?userid=<?= $user['userid'] ?>">Edit</a> 
<a href="/csip_v3/cgi/manage/delete_user.php?userid=<?= $user['userid'] ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</td>
<td>

<a href="/csip_v3/cgi/manage/new_location.php">Add Location</a>
<table>
<caption>Locations</caption>
<thead>
<tr>
<td>Location ID</td><td>Name</td><td>Minimum Grade</td><td>Maximum Grade</td><td>Location Category</td><td>Location Sub-Category</td><td>Location Is For Demo</td><td>&nbsp;</td>
</tr>
</thead>
<tbody>
<?php foreach ( $data['locations'] as $loc ) { ?>
<tr>
<td><?= $loc['locationid'] ?></td>
<td><?= $loc['name'] ?></td>
<td><?= $loc['mingrade'] ?></td>
<td><?= $loc['maxgrade'] ?></td>
<td><?= $loc['loc_category'] ?></td>
<td><?= $loc['loc_subcategory'] ?></td>
<td><?= $loc['loc_demo'] ?></td>
<td>
<a href="/csip_v3/cgi/manage/edit_location.php?locationid=<?= $loc['locationid'] ?>">Edit</a> 
<a href="/csip_v3/cgi/manage/delete_location.php?locationid=<?= $loc['locationid'] ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</td>
</tr>
</table>
<?php include( $data['_config']['base_dir'] .'/htdocs/doc-close.php' ); ?>
