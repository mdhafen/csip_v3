<br>
    <ul id="cfa<?= $count ?>" class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    <li id="cfam<?= $count ?>" class="uk-parent" aria-expanded="true">
        <a href="#"><strong>Common Formative Assessment</strong></a>
        <ul class="uk-nav-sub">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE know if they LEARNED it?</strong></p>
                <hr>
                <p>EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student's learning and determine which students were proficient in the guaranteed skill and those who weren't.</p>
                <p>TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.</p>
            </div>
            <br>

            <li class="uk-panel uk-panel-box">
                <form class="uk-form uk-form-horizontal" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="<?= $part ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t">List the common formative assessment AND the guaranteed skill it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="15">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[15]['answer']) ? $questions[15]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-it">How many students were assessed by our team?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="16">
                            <input type="text" id="form-h-it" name="answers[]" value="<?= isset($questions[16]['answer']) ? $questions[16]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-it">How many were not proficient the first time?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="17">
                            <input type="text" id="form-h-it" name="answers[]" value="<?= isset($questions[17]['answer']) ? $questions[17]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t">According to the results of this CFA and our team's collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="18">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[18]['answer']) ? $questions[18]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <br>
					<button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>
                </form>
            </li>
        </ul>
    </li>
        <br>
<li id="int<?= $count ?>" class="uk-parent">
        <a href="#"><strong>Intervention</strong></a>
        <ul class="uk-nav-sub">
            <li class="uk-parent">
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE RESPOND to those who didn't get it?</strong></p>

                <p>EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn't get a concept, it's not an intervention problem; the initial instruction needs to be examined.)</p>
                    </div>
                <br>
            </li>

            <li class="uk-panel uk-panel-box">
                <form class="uk-form uk-form-horizontal" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="<?= $part ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                    <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t">List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="21">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[21]['answer']) ? $questions[21]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-it">Following your team's INTERVENTIONS and REASSESSMENT, how many students are still not proficient?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="22">
                            <input type="text" id="form-h-it" name="answers[]" value="<?= isset($questions[22]['answer']) ? $questions[22]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t">List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team's intervention.<br><br>(To indicate growth, include how much the student grew from the first to second assessment).</label>
<?php if ( !empty($data['_session']['CAN_view_protected_answers']) ) { ?>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="23">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[23]['answer']) ? $questions[23]['answer'] : "" ?></textarea>
<?php } else { ?>
                        <div class="uk-form-controls uk-form-controls-text uk-panel uk-panel-box">
                            Protected Content
<?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t">How did your TEAM respond to those who were still not proficient even after your team's interventions?</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="24">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[24]['answer']) ? $questions[24]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <br>
					<button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>
                </form>
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
            <form class="uk-form uk-form-horizontal" action="save_answer.php">
                    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
                    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
                    <input type="hidden" name="part" value="<?= $part ?>">
                    <input type="hidden" name="op" value="SaveAnswer">
                        <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t">ACTION STEPS: As you review your GVC from (step #1), identify extension activities your team will use for those who already know it.</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="27">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[27]['answer']) ? $questions[27]['answer'] : "" ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-it">EXTENSION:</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="28">
                            <input type="text" id="form-h-it" name="answers[]" value="<?= isset($questions[28]['answer']) ? $questions[28]['answer'] : "" ?>" placeholder="text input">
                        </div>
                    </div>
                    <hr>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t"><strong>End of Year Reflection</strong><br><br>Do our extension activities provide deeper learning for those students who already know it? What adjustments can we make to provide for better extended learning opportunities?
						</label>
                        <div class="uk-form-controls">
                            <input type="hidden" name="questions[]" value="29">
                            <textarea id="form-h-t" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[29]['answer']) ? $questions[29]['answer'] : "" ?></textarea>
                        </div>
                    </div>
					<br>
					<button class="uk-button uk-button-success uk-align-right" type="button" onclick="this.form.submit()">Save</button>
                </form>
            </li>
        </ul>
    </li>
    <br>
</ul>

<hr>
<?php
if ( $part > 3 && $num_answers == 0 ) {
?>
<form class="uk-form uk-form-horizontal" action="delete_cfa.php" onSubmit="return confirmDelete();">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="op" value="DeleteCFA">
    <div class="uk-align-right"><button class="uk-button uk-button-danger uk-button-mini">Delete this GVC</button></div>
</form>
<?php
}
?>
