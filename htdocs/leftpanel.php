<div class="uk-panel uk-panel-box" uk-nav-side>

<?php
if ( ! empty($data['courseid']) && ! empty($data['csip']['courses'][ $data['courseid'] ]['questions'][1]) ) {
  $answers = 0;
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][1] as $answer ) {
    if ( isset($answer[0]['answer']) && $answer[0]['answer'] != "" ) {
      $answers++;
    }
  }
  if ( $answers == 4 ) {
    $completeness = "uk-badge-success uk-icon-check";
  }
  else {
    $completeness = "uk-badge-warning uk-icon-exclamation-triangle";
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
    <li class="uk-parent uk-active">
        <a href="#">Our Team&apos;s GVC</a>
        <ul class="uk-nav-sub">
            <li><p>With your team, identify/list the critical standards/skills that all students need to know.</p>
            <p>Once your team has identified the skills, share with the team above and below your specific grade level.</p>
            <p>Share the guaranteed skills with your students that you have identified below.</p></li>
            <li>
                <form method="post" class="uk-form" action="save_answer.php">
                    <p class="uk-clearfix">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="questionid" value="2">
                    <input type="hidden" name="answerid" value="<?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][2][0]['answerid']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][2][0]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="gc-1-2" cols="30" rows="8" name="answer" placeholder="Define Team's GVC Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][2][0]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][2][0]['answer'] : "" ?></textarea>
  <?php if ( !empty($data['can_edit']) ) { ?>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
  <?php } ?>
                    </p>
                </form>
                <hr>
            </li>
        </ul>
    </li>
     <li class="uk-parent">
        <a href="#">Team Professional Growth Plan</a>
        <ul class="uk-nav-sub">
            <li><p>After identifying your GVC and individually self assessing with the <a href="http://www.uen.org/k12educator/uets/" target="_blank">Utah Effective Teaching Standards</a>, collectively determine the teaching practices you need to strengthen as a team, based on the learning needs of the students in your classroom this year.</p></li>
            <li>
                <form method="post" class="uk-form" action="save_answer.php">
                    <p class="uk-clearfix">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="questionid" value="5">
                    <input type="hidden" name="answerid" value="<?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][5][0]['answerid']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][5][0]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="gc-1-5" cols="30" rows="8" name="answer" placeholder="Outline Team's Professional Growth Plan Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][5][0]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][5][0]['answer'] : "" ?></textarea>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>
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
                    <input type="hidden" name="questionid" value="3">
                    <input type="hidden" name="answerid" value="<?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][3][0]['answerid']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][3][0]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <input type="text" name="answer" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="<?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][3][0]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][3][0]['answer'] : "" ?>">
                     <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
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
                    <input type="hidden" name="questionid" value="4">
                    <input type="hidden" name="answerid" value="<?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][4][0]['answerid']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][4][0]['answerid'] : "" ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="gc-1-4" cols="30" rows="8" name="answer" placeholder="Define Team's Reflection Summary Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][4][0]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][4][0]['answer'] : "" ?></textarea>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
                    </p>
                </form>
                <hr>
            </li>
        </ul>
    </li>
</ul>
<?php } ?>
    </div>
