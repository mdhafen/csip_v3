<br>
    <ul id="cfa<?= $count ?>" class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="op" value="SaveAnswer">
    <li id="cfam<?= $count ?>" class="uk-parent" aria-expanded="true">
        <a href="#"><strong>Common Formative Assessment</strong></a>
        <ul class="uk-nav-sub">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE know if they LEARNED it?</strong></p>
                <hr>
                <p>EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student&quot;s learning and determine which students were proficient in the guaranteed skill and those who weren&quot;t.</p>
                <p>TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.</p>
            </div>
            <br>

            <li class="uk-panel uk-panel-box">
                    <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-m-<?= $part ?>-15">List the common formative assessment AND the guaranteed skill it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="15">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[15][0]['answerid']) ? $questions[15][0]['answerid'] : "" ?>">
                            <textarea id="cfa-m-<?= $part ?>-15" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[15][0]['answer']) ? $questions[15][0]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-m-<?= $part ?>-16">How many students were assessed by our team?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="16">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[16][0]['answerid']) ? $questions[16][0]['answerid'] : "" ?>">
                            <input type="text" id="cfa-m-<?= $part ?>-16" name="answers[]" value="<?= isset($questions[16][0]['answer']) ? $questions[16][0]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-m-<?= $part ?>-17">How many were not proficient the first time?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="17">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[17][0]['answerid']) ? $questions[17][0]['answerid'] : "" ?>">
                            <input type="text" id="cfa-m-<?= $part ?>-17" name="answers[]" value="<?= isset($questions[17][0]['answer']) ? $questions[17][0]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-m-<?= $part ?>-18">According to the results of this CFA and our team&quot;s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="18">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[18][0]['answerid']) ? $questions[18][0]['answerid'] : "" ?>">
                            <textarea id="cfa-m-<?= $part ?>-18" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[18][0]['answer']) ? $questions[18][0]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
					<button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </li>
        </ul>
    </li>
        <br>
<li id="int<?= $count ?>" class="uk-parent">
        <a href="#"><strong>Intervention</strong></a>
        <ul class="uk-nav-sub">
            <li class="uk-parent">
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE RESPOND to those who didn&quot;t get it?</strong></p>

                <p>EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn&quot;t get a concept, it&quot;s not an intervention problem; the initial instruction needs to be examined.)</p>
                    </div>
                <br>
            </li>

            <li class="uk-panel uk-panel-box">
                    <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-i-<?= $part ?>-21">List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="21">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[21][0]['answerid']) ? $questions[21][0]['answerid'] : "" ?>">
                            <textarea id="cfa-i-<?= $part ?>-21" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[21][0]['answer']) ? $questions[21][0]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-i-<?= $part ?>-22">Following your team&quot;s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="22">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[22][0]['answerid']) ? $questions[22][0]['answerid'] : "" ?>">
                            <input type="text" id="cfa-i-<?= $part ?>-22" name="answers[]" value="<?= isset($questions[22][0]['answer']) ? $questions[22][0]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-i-<?= $part ?>-23">List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team&quot;s intervention.<br><br>(To indicate growth, include how much the student grew from the first to second assessment).</label>
<?php if ( !empty($data['_session']['CAN_view_protected_answers']) ) { ?>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="23">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[23][0]['answerid']) ? $questions[23][0]['answerid'] : "" ?>">
                            <textarea id="cfa-i-<?= $part ?>-23" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[23][0]['answer']) ? $questions[23][0]['answer'] : "" ?></textarea>
<?php } else { ?>
                        <div class="uk-form-controls uk-form-controls-text uk-panel uk-panel-box">
                            Protected Content
<?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
			<label class="uk-form-label" for="cfa-i-<?= $part ?>-24">How did your TEAM respond to those who were still not proficient even after your team&apos;s interventions?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="24">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[24][0]['answerid']) ? $questions[24][0]['answerid'] : "" ?>">
                            <textarea id="cfa-i-<?= $part ?>-24" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[24][0]['answer']) ? $questions[24][0]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
					<button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </li>
        </ul>
    </li>
<br>
<li id="le<?= $count ?>" class="uk-parent">
        <a href="#"><strong>Learning Extension</strong></a>
        <ul class="uk-nav-sub">
            <li class="uk-parent">
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                       <p><strong>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</strong></p>
                    </div>
                <br>
                </li>

            <li class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-l-<?= $part ?>-27">ACTION STEPS: As you review your GVC from (step #1), identify extension activities your team will use for those who already know it.</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="27">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[27][0]['answerid']) ? $questions[27][0]['answerid'] : "" ?>">
                            <textarea id="cfa-l-<?= $part ?>-27" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[27][0]['answer']) ? $questions[27][0]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-l-<?= $part ?>-28">End of Year Reflection Date:</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="28">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[28][0]['answerid']) ? $questions[28][0]['answerid'] : "" ?>">
                            <input type="text" id="cfa-l-<?= $part ?>-28" name="answers[]" value="<?= isset($questions[28][0]['answer']) ? $questions[28][0]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cfa-l-<?= $part ?>-29"><strong>End of Year Reflection</strong><br><br>Do our extension activities provide deeper learning for those students who already know it? What adjustments can we make to provide for better extended learning opportunities?
						</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="29">
                            <input type="hidden" name="answerids[]" value="<?= isset($questions[29][0]['answerid']) ? $questions[29][0]['answerid'] : "" ?>">
                            <textarea id="cfa-l-<?= $part ?>-29" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[29][0]['answer']) ? $questions[29][0]['answer'] : "" ?></textarea>
                        </div>
                    </div>
					<br>
  <?php if ( !empty($data['can_edit']) ) { ?>
					<button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </li>
        </ul>
    </li>
    <br>
</form>
</ul>

<hr>
<?php
if ( $part > 3 && $num_answers == 0 ) {
?>
<form method="post" class="uk-form uk-form-horizontal" action="delete_cfa.php" onSubmit="return confirmDelete();">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="op" value="DeleteCFA">
  <?php if ( !empty($data['can_edit']) ) { ?>
    <div class="uk-align-right"><button class="uk-button uk-button-danger uk-button-mini">Delete this GVC</button></div>
  <?php } ?>
</form>
<?php
}
?>
