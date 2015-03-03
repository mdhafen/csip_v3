<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<?php include 'menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
<br>

            <span class="uk-align-right"><img src="http://schools.washk12.org/enterprise/wp-content/uploads/sites/23/2014/01/grey_wcsd_logo-e1395268854370.png"></span>
            <form class="uk-form">
               <h2>
                   Plan for
        <select type="text" class="uk-form-large" name="csipid">
            <option>Select One...</option>
<?php
if ( !empty($data['csips']) ) {
   $csipid = empty($data['csip']) ? 0 : $data['csip']['csipid'];
   foreach ( $data['csips'] as $csip ) {
       echo '<option value="'. $csip['csipid'] .'"'. ( $csip['csipid'] == $csipid ? ' selected="selected"' : "" ) .'>'. $csip['year_name'] .' '. $csip['name'] .'</option>'."\n";
   }
}
?>
        </select>
        Course
        <select type="text" class="uk-form-large" name="courseid">
            <option>Select One...</option>
<?php
if ( !empty($data['csip']['courses']) ) {
   $selected_course = empty($data['courseid']) ? 0 : $data['courseid'];
   foreach ( $data['csip']['courses'] as $courseid => $course ) {
      echo "<option value='$courseid'". ($courseid == $selected_course ? " selected='selected'" : "" ) .">". $course['course_name'] ."</option>\n";
   }
}
?>
        </select>
                 <hr>
    </h2>
    </form>
            <div class="uk-grid" uk-grid-divider data-uk-grid-match>
                <div class="uk-width-medium-3-10">
                    <?php include 'leftpanel.php'; ?>
                    <?php include 'dates.php'; ?>
				</div>
				<div class="uk-width-medium-7-10">

                    <?php include 'information.php'; ?>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>

	</body>
</html>

