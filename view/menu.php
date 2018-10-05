<nav class="uk-navbar">
	<div class="uk-container uk-container-center">
		<a href="<?= $data['_config']['base_url'] ?>index.php" class="uk-navbar-brand">Digital CSIP <font size="1pt">v. 8.0.bse</font></a>
		<div class="uk-hidden-small uk-navbar-attached">
			<?php
			if(! empty($data['_session']['username']) ){
			echo '
			<ul class="uk-navbar-nav uk-navbar-flip">
				<li><div class="uk-navbar-content">Hello, ' . $data['_session']['username'] . '</div></li>
				<li><a href="'. $data['_config']['base_url'] .'index.php?_logout=1">Logout</a></li>
			</ul>';
			}
			?>

			<ul class="uk-navbar-nav">
			<?php
			if( !empty($data['_session']['CAN_view_reports']) ){
				echo '<li><a href="'. $data['_config']['base_url'] .'reports/index.php">Reports</a></li>';
			}
			if( !empty($data['_session']['CAN_manage_users']) ){
				echo '<li><a href="'. $data['_config']['base_url'] .'manage/index.php">Administration</a></li>';
			}
			?>
			</ul>
		</div>
		<div class="uk-visible-small uk-navbar-flip uk-navbar-attached">
			<ul class="uk-navbar-nav">
				<li data-uk-dropdown="{mode:'click'}">
					<a href="" class="uk-navbar-toggle"></a>
					<div class="uk-dropdown uk-dropdown-navbar">
						<ul class="uk-nav uk-nav-navbar">
						<?php
						if( !empty($data['_session']['CAN_view_reports']) ){
							echo '<li><a href="'. $data['_config']['base_url'] .'reports/index.php">Reports</a></li>';
						}
						if( !empty($data['_session']['CAN_manage_users']) ){
							echo '<li><a href="'. $data['_config']['base_url'] .'manage/index.php">Administration</a></li>';
						}
						if(! empty($data['_session']['username']) ) {
							echo '<li><a href="'. $data['_config']['base_url'] .'index.php?_logout=1">Logout</a></li>';
						}
						?>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
