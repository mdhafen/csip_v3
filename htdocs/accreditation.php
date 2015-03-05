                <form class="uk-form uk-form-horizontal" action="save_answer.php">
<?php
if ( !empty($data['courseid']) && !empty($data['csip']['courses'][ $data['courseid'] ]['questions'][2]) ) {
  echo "<input type='hidden' name='csipid' value='<?= $data['csip']['csipid'] ?>'>\n";
  echo "<input type='hidden' name='courseid' value='<?= $data['course'] ?>'>\n";
  echo "<input type='hidden' name='part' value='2'>\n";
  echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
  $count = 0;
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][2] as $questionid => $answer ) {
    $count++;
    if ( $count > 1 ) {
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
                        <label class="uk-form-label" for="form-h-t"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="Type reponse here"><?= empty($answer['answer']) ? "" : $answer['answer'] ?></textarea>
                        </div>
                    </div>     
<?php
    }
  }
}
?>
            <br>
<button class="uk-button uk-button-success uk-align-right" type="button">Save</button>        
                </form>
