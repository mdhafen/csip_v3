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
        <ul id="grow" class="uk-nav uk-nav-side uk-nav-parent-icon">
            <li id="grow1">
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                    <p><strong>Team Professional Growth Plan:</strong></p>
                    <hr>
                    <p>After identifying your GVC and individually self assessing with the <a href="http://www.schools.utah.gov/CURR/educatoreffectiveness/Observation-Tools/Teaching/Chart.aspx" class="uk-display-inline" target="_blank">Utah Teaching Observation Tool (UTOT)</a>, collectively determine the Teaching Standard(s) you need to strengthen as a team, based on the learning needs of the students in your classroom this year (<a href="https://docs.google.com/document/d/1avnRg24z6hlyZccCJTKoFnTKzNXmPR4dqGACC-AOlyI/edit" class="uk-display-inline" target="_blank">click here for optional template</a>).
                </div>
                <br>
                <div class="uk-panel uk-panel-box">
                    <input type="hidden" name="questionid" value="33">
                    <input type="hidden" name="answerid" value="<?= isset($questions[33]['answerid']) ? $questions[33]['answerid'] : "" ?>">
                        <label class="uk-form-label" for="grow-1-33"><br>
</label>
                    <div class="uk-form-controls">
                        <textarea id="grow-1-33" cols="113" rows="8" name="answer" placeholder="Outline Team&apos;s Professional Growth Plan Here..."><?= isset($questions[33]['answer']) ? $questions[33]['answer'] : "" ?></textarea><br><br>
                    </div>
                    <br>
                    <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>

                </div>
            </li>
        </ul>
    </form>
<?php } ?>
