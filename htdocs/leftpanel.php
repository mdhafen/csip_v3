<div class="uk-panel uk-panel-box" uk-nav-side>

<?php
if ( ! empty($data['courseid']) && ! empty($data['csip']['courses'][ $data['courseid'] ]['questions'][1]) ) {
  $answers = 0;
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][1] as $answer ) {
    if ( isset($answer['answer']) && $answer['answer'] != "" ) {
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
            <li>HIGHLY EFFECTIVE TEAMS teach ALL of the standards within their discipline but engage in the work of IDENTIFYING which of the standards/skills are so critical that EVERY student MUST know. TEAMS then work to ENSURE that every student will demonstrate proficiency in them. The guaranteed and viable curriculum (GVC) are those skills deemed by the team to be the absolute critical skills that ALL students must demonstrate proficiency in order to be successful in the grade level or course.</li>
        </ul>
    </li>
    <li class="uk-parent">
        <a href="#">Our Team's GVC</a>
        <ul class="uk-nav-sub">
            With your team, identify/list the critical standards/skills that all students need to know.<br><br>
            Once your team has identified the skills, share with the team above and below your specific grade level.<br><br>
            Share the guaranteed skills with your students that you have identified below.<br><br>
            <li>
                <form class="uk-form" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="questionid" value="2">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="form-h-t" cols="30" rows="8" name="answer" placeholder="Define Team's GVC Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][2]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][2]['answer'] : "" ?></textarea>
                    <br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
                    <br><br>
                </form>
                <hr>
            </li>
        </ul>
    </li>
        <li class="uk-parent">
        <a href="#">Reflection Date</a>
        <ul class="uk-nav-sub">
            <li>Enter the date when your team will complete the Reflection process</li>
            <li>
                <form class="uk-form" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="questionid" value="3">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <input type="text" name="answer" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="<?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][3]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][3]['answer'] : "" ?>">
                     <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
                    <br><br>
                </form>
                                <hr>

            </li>
        </ul>
    </li>
     <li class="uk-parent">
        <a href="#">Reflection Summary</a>
        <ul class="uk-nav-sub">
            <li>Has your team's GVC changed?  If so, which elements did your team adjust in preparation for next year?</li>
            <li>
            <form class="uk-form" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="questionid" value="4">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="form-h-t" cols="30" rows="8" name="answer" placeholder="Define Team's Reflection Summary Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][4]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][4]['answer'] : "" ?></textarea>
                <br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
                    <br><br>
                </form>
            </li>
        </ul>
    </li>
     <li class="uk-parent">
        <a href="#">Teaching Practices</a>
        <ul class="uk-nav-sub">
            <li>As you consider your GVC, which teaching practices will help you get the results you want?</li>
            <li>
            <form class="uk-form" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="1">
                    <input type="hidden" name="questionid" value="5">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <textarea id="form-h-t" cols="30" rows="8" name="answer" placeholder="Define Team's Reflection Summary Here..."><?= isset($data['csip']['courses'][ $data['courseid'] ]['questions'][1][5]['answer']) ? $data['csip']['courses'][ $data['courseid'] ]['questions'][1][5]['answer'] : "" ?></textarea>
                <br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>     
                    <br><br>
                </form>
            </li>
        </ul>
    </li>
</ul>
<?php } ?>
    </div>
