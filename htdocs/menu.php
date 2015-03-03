<nav class="uk-navbar">
	<div class="uk-container uk-container-center">
		<?php
		if(! empty($data['_session']['username']) ){
		echo '
		<div style="float:right; vertical-align:middle;" class="">
			<ul class="uk-navbar-nav uk-hidden-small uk-navbar-attached">
				<li class=""><a href="'. $data['_config']['base_url'] .'account.php">Hello, ' . $data['_session']['username'] . '</a></li>
				<li class=""><a href="'. $data['_config']['base_url'] .'index.php?_logout=1">Logout</a></li>
			</ul>
		</div>';
		}
		?>
		<a href="<?= $data['_config']['base_url'] ?>index.php" class="uk-navbar-brand">Digital CSIP <font size="1pt">v. 5.0.bse</font></a>
		<ul class="uk-navbar-nav uk-hidden-small uk-navbar-attached">
		<?php
		if( !empty($data['_session']['CAN_manage_users']) ){
				echo '<li><a href="'. $data['_config']['base_url'] .'admin_points.php">Administration</a></li>';
			echo '	<li><a href="#">Placeholder</a></li>
					<li><a href="'. $data['_config']['base_url'] .'users.php">User Management</a></li>
				</ul>';
		}
		?>
		<div class="uk-navbar-flip">
			<a href="#mainmenu-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="{target:'#mainmenu-id'}"></a>
		</div>
	</div>
</nav>
<div id="mainmenu-id" class="uk-offcanvas">
	<div class="uk-offcanvas-bar">
		<ul class="uk-nav uk-nav-offcanvas" data-uk-nav>
<?php
		if( !empty($data['_session']['CAN_manage_users']) ){
			echo '<li class=""><a href="'. $data['_config']['base_url'] .'admin_points.php">Administration</a></li>';
			echo '<li class=""><a href="#">Place Holder</a></li>
			<li class=""><a href="'. $data['_config']['base_url'] .'users.php">User Management</a></li>
			<li class=""><a href="'. $data['_config']['base_url'] .'account.php">Account</a></li>';
		}
?>
		<li class=""><a href="<?= $data['_config']['base_url'] ?>index.php?_logout=1">Logout</a></li>
		</ul>
	</div>
</div>
