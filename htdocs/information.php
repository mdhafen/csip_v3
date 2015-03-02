<!-- Tabs Begin -->
<div class="uk-panel uk-panel-box-secondary">

    <form class="uk-form">
    <h4><strong>Selected Course:</strong>
        <select type="text" class="uk-form-large">
            <option>Select One...</option>
<?php
if ( !empty($data['csip']['courses']) ) {
   foreach ( $data['csip']['courses'] as $courseid => $course ) {
      echo "<option value='$courseid'>". $course['course_name'] ."</option>\n";
   }
}
?>
        </select>
    </form>
    </h4>
<br>
	<ul class="uk-tab" data-uk-tab>
<?php
   if ( !empty($data['courseid']) && !empty( $data['csip']['courses'][ $data['courseid'] ]['questions']) ) {
      $count = 1;
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'] as $part => $questions ) { ?>
        <li class="uk-active" id="cfa<?= $count ?>_tab"><a href="" onclick="activetab('cfa<?= $count ?>');"><div class="uk-badge uk-badge-success">GVC <?= $count ?></div></a></li>';
<?php
         $count++;
      }
 ?>
        <li class="" id="cfa<?= $count ?>_tab"><a href="" onclick="activetab('cfa<?= $count ?>');"><i class="uk-icon-plus"></i>
        <li class="" id="accreditation_tab"><a href="" onclick="activetab('accreditation');"><div class="uk-badge uk-badge-primary">Accreditation</div></a></li>            
</a></li>

	</ul>
	<!-- Tabs End -->




    <!-- Load pages based on tab selected -->

<?php
      $count = 1;
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'] as $part => $questions ) { ?>
    <div id="cfa<?= $count ?>_content" style="display: block;">
	   <?php include 'cfa.php'; ?>
    </div>
<?php
         $count++;
      }
 ?>

	<div id="accreditation_content" style="display: none;">
	   <?php include 'accreditation.php';?>
    </div>
<?php } ?>
</div>
