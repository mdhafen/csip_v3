<!-- Tabs Begin -->
<div class="uk-panel uk-panel-box-secondary">
<?php
   if ( !empty($data['courseid']) && !empty( $data['csip']['form'][ $data['courseid'] ][4]) ) {
?>
	<ul class="uk-tab" data-uk-tab="{connect:'#cfas'}" id="rightpaneltabs">
<?php
      $count = 1;
      foreach ( $data['csip']['form'][ $data['courseid'] ] as $part => $questions ) {
        if ( $part < 4 ) { continue; }
        $num_questions = 0;
        $num_answers = 0;
        foreach ( $questions as &$question ) {
	  $questionid = $question['questionid'];
          if ( $data['csip']['questions'][$questionid]['type'] != 9 ) {
            $num_questions++;
            if ( !empty($question['answer']['answer']) ) {
              $num_answers++;
            }
            if ( !empty($question['answers']) ) {
              $num_answers++;
            }
          }
        }
	$data['csip']['form'][ $data['courseid'] ][ $part ][0]['num_answers'] = $num_answers;
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
      foreach ( $data['csip']['form'][ $data['courseid'] ] as $part => $these_questions ) {
	$questions = array();
        if ( $part < 4 ) { continue; }
	foreach ( $these_questions as $quest ) {
	  $questions[ $quest['questionid'] ] = !empty($quest['answer'])?$quest['answer']:array();
	}
	$num_answers = $these_questions[0]['num_answers'];
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
