<!-- Tabs Begin -->
<div class="uk-panel uk-panel-box-secondary">
<?php
   if ( !empty($data['courseid']) && !empty( $data['csip']['form'][ $data['courseid'] ][4]) ) {
?>
	<ul class="uk-tab" data-uk-tab="{connect:'#cfas'}" id="rightpaneltabs">
<?php
      $count = 1;
      $max_tab = 0;
      foreach ( $data['csip']['form'][ $data['courseid'] ] as $part => $questions ) {
        if ( $part < 4 ) { continue; }
        $num_questions = 0;
        $num_answers = 0;
        if ( $part > $max_tab ) { $max_tab = $part; }
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
        <li class="" id="cfa<?= $part ?>_tab"><a href=""><div class="uk-badge <?= $completeness ?>">GVC <?= $count ?></div></a></li>
<?php
         $count++;
      }
      if ( !empty($data['can_edit']) ) {
 ?>
        <li class="" id="addcfa_tab"><a href="" onclick="addCFATab('<?= $data['csip']['csipid'] ?>','<?= $data['categoryid'] ?>','<?= $data['courseid'] ?>','<?= $max_tab ?>','<?= $count ?>','<?= $max_tab ?>');"><i class="uk-icon-plus"></i></a></li>
<?php } ?>
<?php
  $answers = 0;
  foreach ( $data['csip']['form'][ $data['courseid'] ][1] as $answer ) {
    if ( isset($answer['answer']) && $answer['answer'] != "" ) {
      $answers++;
    }
  }
  if ( $answers == 1 ) {
    $completeness = "uk-badge-success";
  }
  else {
    $completeness = "uk-badge-warning";
  }
?>
        <li class="" id="growth_tab"><a href=""><div class="uk-badge <?= $completeness ?>">Team PGP</div></a></li>
        <li class="" id="results_tab"><a href=""><div class="uk-badge uk-badge-primary">Stakeholder Input</div></a></li>
	</ul>
	<!-- Tabs End -->


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
    <div id="cfa<?= $part ?>_content">
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
	<div id="growth_content">
	   <?php include 'leftpanel.php';?>
	</div>
	<div id="results_content">
	   <?php include 'results.php';?>
	</div>
    </div>

<?php } ?>
<?php
if ( !empty($data['part']) ) {
  switch ($data['part']) {
  case 1 : $tab = 'growth_tab'; break;
  case 2 : $tab = 'accreditation_tab'; break;
  case 3 : $tab = 'results_tab'; break;
  default: $tab = 'cfa'. ( $data['part'] ) .'_tab'; break;
  }
}
?>
