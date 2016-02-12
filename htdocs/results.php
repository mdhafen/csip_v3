<?php
if ( !empty($data['courseid']) && !empty($data['csip']['courses'][ $data['courseid'] ]['questions'][3]) ) {
  echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
  echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>\n";
  echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
  echo "<input type='hidden' name='part' value='3'>\n";
  echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
  $count = 0;
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][3] as $questionid => $answers ) {
    if ( count($answers) > $count ) {
      $count = count($answers);
    }
  }

  if ( !empty($data['csip']['loc_demo']) ) {
    // hide the empty question set if the location is a Demo
    $count--;
  }

  for ( $c = 0; $c <= $count; $c++ ) {
    $num_answers = 0;
    echo "<div class='uk-clearfix'>\n";
    echo "<form method='post' class='uk-form uk-form-horizontal' action='save_answer.php'>";
    echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
    echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>";
    echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
    echo "<input type='hidden' name='part' value='3'>\n";
    echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
    foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][3] as $questionid => $answers ) {
      if ( $data['csip']['questions'][ $questionid ]['type'] == 9 ) {
?>
                <br>
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                   <?= $data['csip']['questions'][ $questionid ]['question_clean'] ?>
                </div>
<?php
      }
      else {
         if ( !empty($answers[$c]['answerid']) ) {
            $num_answers++;
         }
?>
                <br>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="res-3-<?= $questionid ?>"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
                            <input type="hidden" name="answerids[]" value="<?= !empty($answers[$c]['answerid']) ? $answers[$c]['answerid'] : "" ?>">

<?php
    switch ( $data['csip']['questions'][ $questionid ]['type'] ) {
    case 1:
?>
                            <textarea id="res-3-<?= $questionid ?>-<?= $c ?>" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($answers[$c]['answer']) ? $answers[$c]['answer'] : "" ?></textarea>
<?php
    break;
    case 3:
?>
                            <input type="text" id="res-3-<?= $questionid ?>-<?= $c ?>" name="answers[]" placeholder="text input" value="<?= isset($answers[$c]['answer']) ? $answers[$c]['answer'] : "" ?>">
<?php
    break;
    }
?>
                        </div>
                    </div>
<?php
      }
    }
    if ( !empty($data['can_edit']) ) { ?>
<button class="uk-button uk-button-success uk-align-right uk-margin-top" type="button" onclick="this.form.submit()">Save</button>
<?php }
    echo "          </form>\n";
    if ( $num_answers ) {
      echo "<form method='post' class='uk-form uk-form-horizontal' action='save_answer.php'>";
      echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
      echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>";
      echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
      echo "<input type='hidden' name='part' value='3'>\n";
      echo "<input type='hidden' name='op' value='DeleteAnswer'>\n";
      foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][3] as $questionid => $answers ) {
        if ( $data['csip']['questions'][ $questionid ]['type'] != 9 ) {
?>
            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
            <input type="hidden" name="answerids[]" value="<?= !empty($answers[$c]['answerid']) ? $answers[$c]['answerid'] : "" ?>">
<?php
        }
      }
      echo "<button class=\"uk-button uk-button-danger uk-align-right uk-margin-top\" type=\"button\" onclick=\"this.form.submit()\">Delete</button>\n";
      echo "</form>\n";
      echo "</div>\n";
    }
    if ( $c != $count ) { echo "<hr>\n"; }
  }
}
?>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
<button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
                </form>
