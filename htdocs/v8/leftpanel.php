<div class="uk-panel uk-panel-box" uk-nav-side>

<?php
if ( ! empty($data['courseid']) && ! empty($data['csip']['form'][ $data['courseid'] ][1]) ) {
  $answers = 0;
  foreach ( $data['csip']['form'][ $data['courseid'] ][1] as $answer ) {
    if ( isset($answer['answer']) && $answer['answer'] != "" ) {
      $answers++;
    }
  }
  if ( $answers == 3 ) {
    $completeness = "uk-badge-success uk-icon-check";
  }
  else {
    $completeness = "uk-badge-warning uk-icon-exclamation-triangle";
  }

  $questions = array();
  foreach ( $data['csip']['form'][ $data['courseid'] ][1] as $quest ) {
    $questions[ $quest['questionid'] ] = !empty($quest['answer'])?$quest['answer']:array();
  }
?>
    <h4 class="uk-clearfix"><i class="uk-icon-bars"></i> <strong>Guaranteed Curriculum</strong> <span class="uk-align-right uk-badge <?= $completeness ?>"></span></h4>
<hr>
    <ul id="leftpanel" class="uk-nav uk-nav-parent-icon" data-uk-nav>
    <li class="uk-parent">
        <a href="#">What is the GVC?</a>
        <ul class="uk-nav-sub">
            <li>HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards/skills are so critical that EVERY student MUST know. TEAMS then work to ENSURE that every student will demonstrate proficiency in them. The <a class="uk-display-inline" target="_blank" href="http://prodev.washk12.org/site_file/prodev/files/Learning_Graphics/gvc.pdf">GVC</a> are the agreed upon essentials within the course or grade level that teams will commit to collectively address, commonly assess and persistently provide targeted interventions for students in need.</li>
        </ul>
    </li>
    <li class="uk-parent">
        <a href="#">Team Professional Growth Plan</a>
        <ul class="uk-nav-sub">
            <li><p>After identifying your GVC and individually self assessing with the <a href="http://www.uen.org/k12educator/uets/" class="uk-display-inline" target="_blank">Utah Effective Teaching Standards</a>, collectively determine the teaching practices you need to strengthen as a team, based on the learning needs of the students in your classroom this year.</p></li>
            <li>
                <form method="post" class="uk-form" action="save_answer.php">
                    <p class="uk-clearfix">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="sequence" value="0">
                    <input type="hidden" name="questionid" value="33">
                    <input type="hidden" name="answerid" value="<?= isset($questions[33]['answerid']) ? $questions[33]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="gc-1-5" cols="30" rows="8" name="answer" placeholder="Outline Team's Professional Growth Plan Here..."><?= isset($questions[5]['answer']) ? $questions[5]['answer'] : "" ?></textarea><br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
                    </p>
                </form>
            </li>
        </ul>
    </li>
    <li class="uk-parent">
        <a href="#">Reflection Date</a>
        <ul class="uk-nav-sub">
            <li><p>Enter the date when your team will complete the Reflection process</p></li>
            <li>
                <form method="post" class="uk-form" action="save_answer.php">
                    <p class="uk-clearfix">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="sequence" value="0">
                    <input type="hidden" name="questionid" value="34">
                    <input type="hidden" name="answerid" value="<?= isset($questions[34]['answerid']) ? $questions[34]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <input type="text" name="answer" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="<?= isset($questions[34]['answer']) ? $questions[34]['answer'] : "" ?>">
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
                    </p>
                </form>
                <hr>
            </li>
        </ul>
    </li>
    <li class="uk-parent">
        <a href="#">Reflection Summary</a>
        <ul class="uk-nav-sub">
            <li><p>Has your team&apos;s GVC changed?  If so, which elements did your team adjust in preparation for next year?</p></li>
            <li>
                <form method="post" class="uk-form" action="save_answer.php">
                    <p class="uk-clearfix">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="sequence" value="0">
                    <input type="hidden" name="questionid" value="35">
                    <input type="hidden" name="answerid" value="<?= isset($questions[35]['answerid']) ? $questions[35]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="gc-1-4" cols="30" rows="8" name="answer" placeholder="Define Team's Reflection Summary Here..."><?= isset($questions[35]['answer']) ? $questions[35]['answer'] : "" ?></textarea><br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
                    </p>
                </form>
                <hr>
            </li>
        </ul>
    </li>
    </ul>
<?php } ?>
</div>

<?php
if ( !empty($data['courseid']) {
?>
<div class="uk-panel uk-panel-box">
    <h4 class="uk-clearfix"><i class="uk-icon-comment"></i> <strong>Principal&apos;s Comment</strong></h4>
<hr>
<?php if ( !empty($data['_session']['CAN_approve_csip']) ) {
    <form method="post" class="uk-form uk-display-inline-block" action="approve.php">
        <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
        <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
        <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
        <input type="hidden" name="op" value="Comment">
        <textarea id="a-c" cols="30" rows="8" name="comment" placeholder="Place comments Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['principal_comment']) ? $data['csip']['courses'][ $data['courseid'] ]['principal_comment'] : "" ?></textarea><br><br>
        <button class='uk-button uk-button-success' onclick="this.form.submit()">Save Comment</button>
    </form>
<?php } else { ?>
    <div class="uk-panel uk-panel-box-secondary">
<?= isset($data['csip']['courses'][ $data['courseid'] ]['principal_comment']) ? $data['csip']['courses'][ $data['courseid'] ]['principal_comment'] : "" ?>
    </div>
<?php
      }
?>
</div>
<?php
}
?>
