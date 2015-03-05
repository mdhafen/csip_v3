<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<?php include 'menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
<br>

            <span class="uk-align-right"><img src="https://schools.washk12.org/enterprise/wp-content/uploads/sites/23/2014/01/grey_wcsd_logo-e1395268854370.png"></span>
            <form class="uk-form" action="index.php">
               <h2>
                   Plan for
        <select type="text" class="uk-form-large" name="csipid" onchange="this.form.submit()">
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
        <select type="text" class="uk-form-large" name="courseid" onchange="this.form.submit()">
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
<?php
if ( !empty($data['courseid']) ) {
  $can_approve = '';
  if ( empty($data['_session']['CAN_approve_csip']) ) {
    $can_approve = ' disabled';
  }
  if ( empty($data['csip']['courses'][ $data['courseid'] ]['principal_approved']) ) {
    $app = "Not Approved";
    $class = "uk-button-danger";
  }
  else {
    $app = "Approved";
    $class = "uk-button-success";
  }
  echo "<button class='uk-button $class'$can_approve>$app</button>";
}
?>
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

<?php
if ( !empty($data['part']) && $data['part'] > 1 ) {
  $tab = $data['part'] == 2 ? 'accreditation' : 'cfa'. $part - 2;
?>
<script type="text/javascript">
activetab('<?= $tab ?>');
</script>
<?php
}
?>
	</body>
</html>

