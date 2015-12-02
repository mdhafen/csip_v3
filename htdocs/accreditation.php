                <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
<?php
if ( !empty($data['courseid']) && !empty($data['csip']['courses'][ $data['courseid'] ]['questions'][2]) ) {
  echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
  echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>";
  echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
  echo "<input type='hidden' name='part' value='2'>\n";
  echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
  $hor_rule = 0;
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][2] as $questionid => $answer ) {
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
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
                            <input type="hidden" name="answerids[]" value="<?= isset($answer[0]['answerid']) ? $answer[0]['answerid'] : "" ?>">
                            <textarea id="acc-2-<?= $questionid ?>" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($answer[0]['answer']) ? $answer[0]['answer'] : "" ?></textarea>
                        </div>
                    </div>     
<?php
    }
  }
}
?>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
<button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>        
  <?php } ?>
                </form>
