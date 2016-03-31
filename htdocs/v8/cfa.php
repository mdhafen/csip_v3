<br>
    <ul id="cfa<?= $part ?>" class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="sequence" value="0">
    <input type="hidden" name="op" value="SaveAnswer">
    <li id="cfal<?= $part ?>" class="uk-parent" aria-expanded="true">
        <div class="uk-panel uk-panel-box uk-panel-box-primary">
            <p><strong>How will WE know if they LEARNED it?</strong></p>
            <hr>
            <p>EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student&apos;s learning and determine which students were proficient in the guaranteed skill and those who weren&apos;t.</p>
            <p>TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.</p>
        </div>
        <br>

        <div class="uk-form-row uk-panel uk-panel-box">
            <label class="uk-form-label" for="cfa-l-<?= $part ?>-45">List the common formative assessment AND the guaranteed skill/learning target it aligns with (Example: Unit 1 - Fractions). FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.</label>
            <div class="uk-form-controls">
                <input type="hidden" name="questions[]" value="45">
                <input type="hidden" name="answerids[]" value="<?= isset($questions[45]['answerid']) ? $questions[45]['answerid'] : "" ?>">
                <input type="hidden" name="sequences[]" value="0">
                <textarea id="cfa-l-<?= $part ?>-45" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[45]['answer']) ? $questions[45]['answer'] : "" ?></textarea>
            </div>
        </div>
    </li>
    <li id="cfac<?= $part ?>" class="uk-parent" aria-expanded="true">
        <a href="#"><strong>Learning Targets and Common Formative Assessment</strong></a>
        <div class="uk-panel uk-panel-box">
            <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-48">List the Learning Targets that will be part of this standard</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="48">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[48]['answerid']) ? $questions[48]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-48" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[48]['answer']) ? $questions[48]['answer'] : "" ?></textarea>
                </div>
            </div>
            <hr>
            <div class="uk-form-row uk-grid">
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="cfa-c-<?= $part ?>-49">How many students were assessed by our team?</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="49">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[49]['answerid']) ? $questions[49]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <input type="text" id="cfa-c-<?= $part ?>-16" name="answers[]" value="<?= isset($questions[49]['answer']) ? $questions[49]['answer'] : "" ?>" placeholder="text input">
                    </div>
                </div>

                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="cfa-c-<?= $part ?>-50">How many students were NOT proficient the first time?</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="50">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[50]['answerid']) ? $questions[50]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <input type="text" id="cfa-c-<?= $part ?>-50" name="answers[]" value="<?= isset($questions[50]['answer']) ? $questions[50]['answer'] : "" ?>" placeholder="text input">
                    </div>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-51">Enter any website links to online documents which support this assessment</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="51">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[51]['answerid']) ? $questions[51]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <input type="text" id="cfa-c-<?= $part ?>-51" name="answers[]" value="<?= isset($questions[51]['answer']) ? $questions[51]['answer'] : "" ?>" placeholder="text input">
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-52">According to the results of this CFA and our team&apos;s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="52">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[52]['answerid']) ? $questions[52]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-52" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[52]['answer']) ? $questions[52]['answer'] : "" ?></textarea>
                </div>
            </div>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
            <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
        </div>
    </li>
    <br>
    <li id="int<?= $part ?>" class="uk-parent">
        <a href="#"><strong>Intervention</strong></a>
        <div class="uk-parent">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE RESPOND to those who didn&apos;t get it?</strong></p>

                <p>EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn&apos;t get a concept, it&apos;s not an intervention problem; the initial instruction needs to be examined.)</p>
            </div>
            <br>
            <div class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-55">List the SPECIFIC INTERVENTIONS that your team responded with for those students who WERE NOT proficient.</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="55">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[55]['answerid']) ? $questions[55]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-55" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[55]['answer']) ? $questions[55]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-56">Following your team&apos;s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="56">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[56]['answerid']) ? $questions[56]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <input type="text" id="cfa-i-<?= $part ?>-56" name="answers[]" value="<?= isset($questions[56]['answer']) ? $questions[56]['answer'] : "" ?>" placeholder="text input">
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-57">List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team&apos;s intervention.<br><br>(To indicate growth, include how much the student grew from the first to second assessment).</label>
<?php if ( !empty($data['_session']['CAN_view_protected_answers']) ) { ?>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="57">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[57]['answerid']) ? $questions[57]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-57" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[57]['answer']) ? $questions[57]['answer'] : "" ?></textarea>
<?php } else { ?>
                    <div class="uk-form-controls uk-form-controls-text uk-panel uk-panel-box">
                        Protected Content
<?php } ?>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-58">How did your TEAM respond to those who were still not proficient even after your team&apos;s interventions?</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="58">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[58]['answerid']) ? $questions[58]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-58" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[58]['answer']) ? $questions[58]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </div>
        </div>
    </li>
    <br>
    <li id="le<?= $part ?>" class="uk-parent">
        <a href="#"><strong>Learning Extension</strong></a>
        <div class="uk-nav-sub">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</strong></p>
            </div>
            <br>

            <div class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-61">ACTION STEPS: As you review your GVC from (step #1), identify extension activities your team will use for those who already know it.</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="61">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[61]['answerid']) ? $questions[61]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-61" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[61]['answer']) ? $questions[61]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-62">End of Year Reflection Date:</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="62">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[62]['answerid']) ? $questions[62]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <input type="text" id="cfa-l-<?= $part ?>-62" name="answers[]" value="<?= isset($questions[62]['answer']) ? $questions[62]['answer'] : "" ?>" placeholder="text input">
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-63"><strong>End of Year Reflection</strong><br><br>Do our extension activities provide deeper learning for those students who already know it? What adjustments can we make to provide for better extended learning opportunities?
                    </label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="63">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[63]['answerid']) ? $questions[63]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-29" cols="50" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[63]['answer']) ? $questions[63]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </div>
        </div>
    </li>
    <br>
</form>
</ul>

<hr>
<?php
if ( $part > 4 && $num_answers == 0 ) {
?>
<form method="post" class="uk-form uk-form-horizontal" action="delete_cfa.php" onSubmit="return confirmDelete();">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="sequence" value="0">
    <input type="hidden" name="op" value="DeleteCFA">
  <?php if ( !empty($data['can_edit']) ) { ?>
    <div class="uk-align-right"><button class="uk-button uk-button-danger uk-button-mini">Delete this GVC</button></div>
  <?php } ?>
</form>
<?php
}
?>
