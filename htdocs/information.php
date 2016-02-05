<!-- Tabs Begin -->
<div class="uk-panel uk-panel-box-secondary">
<?php
   if ( !empty($data['courseid']) && !empty( $data['csip']['courses'][ $data['courseid'] ]['questions']) ) {
?>
	<ul class="uk-tab" data-uk-tab="{connect:'#cfas'}" id="rightpaneltabs">
<?php
      $count = 1;
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'] as $part => $questions ) {
        if ( $part < 4 ) { continue; }
        $num_questions = 0;
        $num_answers = 0;
        foreach ( $questions as $questionid => $answer ) {
          if ( $data['csip']['questions'][$questionid]['type'] != 9 ) {
            $num_questions++;
            if ( isset($answer[0]['answer']) && $answer[0]['answer'] != "" ) {
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
        <li class="<?= $part == $count ? 'uk-active' : '' ?>" id="cfa<?= $count ?>_tab"><a href=""><div class="uk-badge <?= $completeness ?>">GVC <?= $count ?></div></a></li>
<?php
         $count++;
      }
      if ( !empty($data['can_edit']) ) {
 ?>
        <li class="" id="addcfa_tab"><a href="" onclick="addCFATab('<?= $data['csip']['csipid'] ?>','<?= $data['categoryid'] ?>','<?= $data['courseid'] ?>','<?= $part ?>');"><i class="uk-icon-plus"></i></a></li>
<?php } ?>
        <li class="" id="accreditation_tab"><a href=""><div class="uk-badge uk-badge-primary">Accreditation</div></a></li>
        <li class="" id="results_tab"><a href=""><div class="uk-badge uk-badge-primary">Stakeholder Input</div></a></li>

	</ul>
	<!-- Tabs End -->
	<script>maxTab=<?=$count ?>;</script>



    <!-- Load pages based on tab selected -->
        <div id="cfas" class="uk-switcher">
<?php
      $count = 1;
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'] as $part => $questions ) {
        if ( $part < 4 ) { continue; }
        $num_answers = 0;
        foreach ( $questions as $questionid => $answer ) {
          if ( $data['csip']['questions'][$questionid]['type'] != 9 ) {
            if ( isset($answer[0]['answer']) && $answer[0]['answer'] != "" ) {
              $num_answers++;
            }
          }
        }
 ?>
    <div id="cfa<?= $count ?>_content">
	   <?php include 'cfa.php'; ?>
    </div>
<?php
         $count++;
      }
      if ( !empty($data['can_edit']) ) {
 ?>
	<div id="addcfa_content">
	</div>
<?php
      }
?>
	<div id="accreditation_content">
	   <?php include 'accreditation.php';?>
	</div>
	<div id="results_content">
	   <?php include 'results.php';?>
	</div>
    </div>

    <div>
        A spreadsheet for showing <a target="_blank" href="https://docs.google.com/spreadsheets/d/1QvMmCNJeK1xmqlI01lqajb6nR0lPe8WmQJattI-GDyk/edit?usp=sharing">Teacher Effect Size</a>
    </div>
<?php } ?>
</div>
