                <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
<?php
if ( !empty($data['courseid']) && !empty($data['csip']['courses'][ $data['courseid'] ]['questions'][3]) ) {
  echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
  echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>";
  echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
  echo "<input type='hidden' name='part' value='3'>\n";
  echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
  $count = 0;
  $q_ids = array();
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][3] as $questionid => $answers ) {
    if ( count($answers) > $count ) {
      $count = count($answers);
    }
    array_push( $q_ids, $questionid );
  }
  foreach ( $q_ids as $questionid ) {
    $answers = $data['csip']['courses'][ $data['courseid'] ]['questions'][3][ $questionid ];
?>
                <br>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
<?php
    switch ( $data['csip']['questions'][ $questionid ]['type'] ) {
    case 1:
?>
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($answers[0]['answer']) ? $answers[0]['answer'] : "" ?></textarea>
<?php
    break;
    case 3:
?>
                            <input id="form-h-t" name="answers[]" placeholder="text input" value="<?= isset($answers[0]['answer']) ? $answers[0]['answer'] : "" ?>">
<?php
    break;
    }
?>
                        </div>
                    </div>     
<?php
  }
  for ( $c = 1; $c < $count; $c++ ) {
    echo "<hr>\n";
    foreach ( $q_ids as $questionid ) {
      $answers = $data['csip']['courses'][ $data['courseid'] ]['questions'][3][ $questionid ];
      if ( $data['csip']['questions'][ $questionid ]['type'] == 9 ) {
?>
                <br>
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                   <?= $data['csip']['questions'][ $questionid ]['question_clean'] ?>
                </div>
<?php
      }
      else {
?>
                <br>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
<?php
    switch ( $data['csip']['questions'][ $questionid ]['type'] ) {
    case 1:
?>
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($answers[0]['answer']) ? $answers[0]['answer'] : "" ?></textarea>
<?php
    break;
    case 3:
?>
                            <input id="form-h-t" name="answers[]" placeholder="text input" value="<?= isset($answers[0]['answer']) ? $answers[0]['answer'] : "" ?>">
<?php
    break;
    }
?>
                        </div>
                    </div>     
<?php
      }
    }
  }
}
?>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
<button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>        
  <?php } ?>
                </form>
