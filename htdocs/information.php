<!-- Tabs Begin -->
<div class="uk-panel uk-panel-box-secondary">

	<ul class="uk-tab" data-uk-tab id="rightpaneltabs">
<?php
   if ( !empty($data['courseid']) && !empty( $data['csip']['courses'][ $data['courseid'] ]['questions']) ) {
      $count = 1;
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'] as $part => $questions ) {
        if ( $part < 3 ) { continue; }
        $num_questions = 0;
        $num_answers = 0;
        foreach ( $questions as $questionid => $answer ) {
          if ( $data['csip']['questions'][$questionid]['type'] != 9 ) {
            $num_questions++;
            if ( isset($answer['answer']) && $answer['answer'] != "" ) {
              $num_answers++;
            }
          }
        }
        if ( $num_questions == $num_answers ) {
          $completeness = 'uk-badge-success';
        }
        else {
          $completeness = 'uk-badge-warning';
        }
 ?>
        <li class="<?= $part == 3 ? 'uk-active' : '' ?>" id="cfa<?= $count ?>_tab"><a href="" onclick="activetab('cfa<?= $count ?>');"><div class="uk-badge <?= $completeness ?>">GVC <?= $count ?></div></a></li>
<?php
         $count++;
      }
 ?>
        <li class="" id="cfa<?= $count ?>_tab"><a href="" onclick="activetab('cfa<?= $count ?>');"><i class="uk-icon-plus"></i></a></li>
        <li class="" id="accreditation_tab"><a href="" onclick="activetab('accreditation');"><div class="uk-badge uk-badge-primary">Accreditation</div></a></li>            

	</ul>
	<!-- Tabs End -->




    <!-- Load pages based on tab selected -->
        <div id="cfas">
<?php
      $count = 1;
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'] as $part => $questions ) {
        if ( $part < 3 ) { continue; }
 ?>
    <div id="cfa<?= $count ?>_content" style="display: <?= $part == 3 ? 'block' : 'none' ?>;">
	   <?php include 'cfa.php'; ?>
    </div>
<?php
         $count++;
      }
 ?>
        </div>
	<div id="accreditation_content" style="display: none;">
	   <?php include 'accreditation.php';?>
    </div>
<?php } ?>
</div>
