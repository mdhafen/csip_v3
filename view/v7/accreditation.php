                <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
<?php
if ( !empty($data['courseid']) && !empty($data['csip']['form'][ $data['courseid'] ][2]) ) {
  echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
  echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>\n";
  echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
  echo "<input type='hidden' name='part' value='2'>\n";
  echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
  $hor_rule = 0;
  foreach ( $data['csip']['form'][ $data['courseid'] ][2] as $question ) {
    $questionid = $question['questionid'];
    $answer = !empty($question['answer'])?$question['answer']:array();
    $hor_rule++;
    if ( $hor_rule > 1 ) {
      echo "<hr>\n";
    }
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
                        <label class="uk-form-label" for="acc-2-<?= $questionid ?>"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls" data-csip-answer-ids>
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
                            <input type="hidden" name="answerids[]" value="<?= isset($answer['answerid']) ? $answer['answerid'] : "" ?>">
                            <input type="hidden" name="sequences[]" value='0'>
                            <textarea id="acc-2-<?= $questionid ?>" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($answer['answer']) ? $answer['answer'] : "" ?></textarea>
                        </div>
                    </div>
<?php
    }
  }
}
?>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
<button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
                </form>
