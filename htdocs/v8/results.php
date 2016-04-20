<?php
if ( !empty($data['courseid']) && !empty($data['csip']['form'][ $data['courseid'] ][3]) ) {
  $questions = $data['csip']['form'][ $data['courseid'] ][3];
  $index = 0;
  $prev_repeatableid = 0;
  $repeated_questions = array();
  $repeatable_questions = array();
  foreach( $questions as $question ) {
    $quest = $data['csip']['questions'][ $question['questionid'] ];
    $repeatable_questions[ $quest['group_repeatableid'] ][] = $quest['questionid'];
  }
  foreach( $questions as $question ) {
    $quest = $data['csip']['questions'][ $question['questionid'] ];
    if ( !empty($quest['group_repeatableid']) ) {
      if ( !empty($prev_repeatableid) && $prev_repeatableid == $quest['group_repeatableid'] ) {
	continue;
      }
      $count = 0;
      $i = $index;
      $new_questions = array();
      $sequences = array();
      $blank_answers = array();
      while ( !empty($questions[$i]) && $data['csip']['questions'][ $questions[$i]['questionid'] ]['group_repeatableid'] == $quest['group_repeatableid'] ) {
	if ( !empty($questions[$i]['answers']) ) {
	  foreach ( $questions[$i]['answers'] as $answer ) {
	    $sequence = $answer['group_sequence'];
	    if ( empty($sequences[$sequence]) ) {
	      foreach ( $repeatable_questions as $rep_quests ) {
		if ( in_array($questions[$i]['questionid'],$rep_quests) ) {
		  foreach ( $rep_quests as $qid ) {
		    $sequences[ $sequence ][$qid] = array( 'questionid' => $qid, 'answer' => array( 'group_sequence' => $sequence) );
		  }
		}
	      }
	    }
	    $qid = $questions[$i]['questionid'];
	    $sequences[ $sequence ][ $qid ]['answer'] = $answer;
	  }
	}
	if ( !empty($data['can_edit']) ) {
	  $blank_answers[] = array( 'questionid' => $questions[$i]['questionid'], 'answer' => array() );
	}
	$i++;
	$count++;
      }
      foreach ( $sequences as $new_quests ) {
	$ids = array();
	foreach ( $new_quests as $repeat_question ) {
	  $ids[] = array(
	    'questionid' => $repeat_question['questionid'],
	    'answerid' => !empty($repeat_question['answer']['answerid'])?$repeat_question['answer']['answerid']:"",
	    'group_sequence' => !empty($repeat_question['answer']['group_sequence'])?$repeat_question['answer']['group_sequence']:"",
	  );
	}
	$new_questions = array_merge($new_questions, $new_quests);
	$key = count($new_questions)-1;
	$new_questions[$key]['end_group'] = $ids;
      }
      if ( !empty($data['can_edit']) ) {
	$key = count($blank_answers)-1;
	$blank_answers[$key]['end_group'] = array();
	$new_questions = array_merge( $new_questions, $blank_answers );
      }
      $repeated_questions[] = array( 'index' => $index, 'length' => $count, 'replacement' => $new_questions );
    }
    $index++;
    $prev_repeatableid = $quest['group_repeatableid'];
  }
  if ( !empty($repeated_questions) ) {
    $repeated_questions = array_reverse($repeated_questions);
    foreach ( $repeated_questions as $replace ) {
      array_splice( $questions, $replace['index'], $replace['length'], $replace['replacement'] );
    }
  }

  $c=0;
  $first = 1;
  foreach ( $questions as $question ) {
    $c++;
    $questionid = $question['questionid'];
    $answer = !empty($question['answer'])?$question['answer']:array();

    $num_answers = 0;
    if ( $first ) {
      echo "<form method='post' class='uk-form uk-form-horizontal uk-clearfix' action='save_answer.php'>";
      echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
      echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>";
      echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
      echo "<input type='hidden' name='part' value='3'>\n";
      echo "<input type='hidden' name='op' value='SaveAnswer'>\n";
      $first = 0;
    }
    echo "<div>\n";

    if ( $data['csip']['questions'][ $questionid ]['type'] == 9 ) {
?>
                <br>
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                   <?= $data['csip']['questions'][ $questionid ]['question_clean'] ?>
                </div>
<?php
    }
    else {
       if ( !empty($answer['answer']) ) {
          $num_answers++;
       }
?>
                <br>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="res-3-<?= $questionid ?>-<?= $c ?>"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="<?= $questionid ?>">
                            <input type="hidden" name="answerids[]" value="<?= !empty($answer['answerid']) ? $answer['answerid'] : "" ?>">
                            <input type="hidden" name="sequences[]" value="<?= !empty($answer['group_sequence']) ? $answer['group_sequence'] : "" ?>">

<?php
    switch ( $data['csip']['questions'][ $questionid ]['type'] ) {
    case 1:
?>
                            <textarea id="res-3-<?= $questionid ?>-<?= $c ?>" cols="113" rows="8" name="answers[]" placeholder="text input"><?= isset($answer['answer']) ? $answer['answer'] : "" ?></textarea>
<?php
    break;
    case 3:
?>
                            <input type="text" id="res-3-<?= $questionid ?>-<?= $c ?>" size="113" name="answers[]" placeholder="text input" value="<?= isset($answer['answer']) ? $answer['answer'] : "" ?>">
<?php
    break;
    }
?>
                        </div>
                    </div>
    </div>
<?php
    }
    if ( isset($question['end_group']) ) {
      $first = 1;
      if ( !empty($data['can_edit']) ) { ?>
<button class="uk-button uk-button-success uk-align-right uk-margin-top" type="button" onclick="save_answers(this)">Save</button>
<?php }
    echo "          </form>\n";

    if ( count(array_column($question['end_group'],'answerid')) ) {
	echo "<form method='post' class='uk-form uk-form-horizontal uk-clearfix' action='save_answer.php'>";
	echo "<input type='hidden' name='csipid' value='". $data['csip']['csipid'] ."'>\n";
	echo "<input type='hidden' name='categoryid' value='". $data['categoryid'] ."'>";
	echo "<input type='hidden' name='courseid' value='". $data['courseid'] ."'>\n";
	echo "<input type='hidden' name='part' value='3'>\n";
	echo "<input type='hidden' name='op' value='DeleteAnswer'>\n";
	foreach ( $question['end_group'] as $group_members ) {
	  $questid = $group_members['questionid'];
	  $answerid = $group_members['answerid'];
	  $sequence = $group_members['group_sequence'];
	  if ( $data['csip']['questions'][ $questionid ]['type'] != 9 ) {
?>
            <input type="hidden" name="questions[]" value="<?= $questid ?>">
            <input type="hidden" name="answerids[]" value="<?= !empty($answerid) ? $answerid : "" ?>">
            <input type="hidden" name="sequences[]" value="<?= !empty($sequence) ? $sequence : "" ?>">
<?php
	  }
        }
        echo "<button class=\"uk-button uk-button-danger uk-align-right uk-margin-top\" type=\"button\" onclick=\"this.form.submit()\">Delete</button>\n";
        echo "</form>\n";
      }
      echo "<hr>\n";
    }
  }
}
?>
