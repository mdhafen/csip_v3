<nav class="uk-navbar">
	<div class="uk-container uk-container-center">
		<?php
		if(! empty($data['_session']['username']) ){
		echo '
		<div style="float:right; vertical-align:middle;" class="">
			<ul class="uk-navbar-nav uk-hidden-small uk-navbar-attached">
				<li class="">Hello, ' . $data['_session']['username'] . '</li>
				<li class=""><a href="'. $data['_config']['base_url'] .'index.php?_logout=1">Logout</a></li>
			</ul>
		</div>';
		}
		?>
		<a href="<?= $data['_config']['base_url'] ?>index.php" class="uk-navbar-brand">Digital CSIP <font size="1pt">v. 5.0.bse</font></a>
		<?php
		if( !empty($data['_session']['CAN_manage_users']) ){
                                echo '<ul class="uk-navbar-nav uk-hidden-small uk-navbar-attached">';
				echo '<li><a href="'. $data['_config']['base_url'] .'manage/index.php">Administration</a></li>
				</ul>';
		}
		?>
		<div class="uk-navbar-flip">
			<a href="#mainmenu-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="{target:'#mainmenu-id'}"></a>
		</div>
	</div>
</nav>
