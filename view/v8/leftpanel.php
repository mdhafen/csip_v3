<br>
<?php
if ( ! empty($data['courseid']) && ! empty($data['csip']['form'][ $data['courseid'] ][1]) ) {
  $questions = array();
  foreach ( $data['csip']['form'][ $data['courseid'] ][1] as $quest ) {
    $questions[ $quest['questionid'] ] = !empty($quest['answer'])?$quest['answer']:array();
  }
?>
    <form method="post" class="uk-form" action="save_answer.php">
        <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
        <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
        <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
        <input type="hidden" name="part" value="1">
        <input type="hidden" name="sequence" value="0">
        <input type="hidden" name="op" value="SaveAnswer">
        <div id="grow">
<?php
  $count = 0;
  foreach ( $data['csip']['form'][ $data['courseid'] ][1] as $question ) {
      $questionid = $question['questionid'];
      $answer = !empty($question['answer'])? $question['answer'] : array();
      $count++;
      if ( $count > 1 ) {
          echo "<hr>\n";
      }
?>
            <div id="grow<?=$count?>">
<?php if ( $data['csip']['questions'][ $questionid ]['type'] == 9 ) { ?>
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                    <?= $data['csip']['questions'][ $questionid ]['question_clean'] ?>
                </div>
<?php } else { ?>
                <div class="uk-panel uk-panel-box" data-csip-answer-ids>
                    <label class="uk-form-label" for="grow-1-<?= $questionid ?>"><br>
</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questionid" value="<?= $questionid ?>">
                        <input type="hidden" name="answerid" value="<?= isset($answer['answerid']) ? $answer['answerid'] : "" ?>">
                        <textarea id="grow-1-<?= $questionid ?>" cols="113" rows="8" name="answer" placeholder="<?= $data['csip']['questions'][ $questionid ]['question_clean'] ?>"><?= isset($answer['answer']) ? $answer['answer'] : "" ?></textarea><br><br>
                    </div>
  <?php if ( !empty($data['can_edit']) ) { ?>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
                </div>
<?php } ?>
            </div>
<?php } ?>
        </div>
    </form>
<?php } ?>
