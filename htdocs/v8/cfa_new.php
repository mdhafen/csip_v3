<?php
// To rebuild this:
//   Copy htdocs/v8/cfa.php
//   Remove text input value's and contents of textarea's
//     Leave the hidden inputs alone!
//   Collapse if/else block around 'protected-content' to just the if block
//   Remove the if statements around the Delete button

?>
<br>
    <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
    <ul id="cfa<?= $part ?>" class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="sequence" value="0">
    <input type="hidden" name="op" value="SaveAnswer">
    <li id="cfal<?= $part ?>" class="uk-parent" aria-expanded="true">
        <div class="uk-panel uk-panel-box uk-panel-box-primary">
            <p><strong>Our Team&apos;s GVC</strong></p>
            <hr>
            <p>With your team, identify/list the critical standards/skills that all students need to know.</p>
            <p>Once your team has identified the skills, share with the team above and below your specific grade level.</p>
            <p>Share the guaranteed skills with your students that you have identified below.</p>
        </div>
        <br>

        <div class="uk-form-row uk-panel uk-panel-box">
            <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <label class="uk-form-label" for="cfa-l-<?= $part ?>-46">List the common formative assessment. FOR ELEMENTARY: Identify which questions on your existing instructional program assessments align with your GVC.</label>
            <div class="uk-form-controls">
                <input type="hidden" name="questions[]" value="46">
                <input type="hidden" name="answerids[]" value="">
                <input type="hidden" name="sequences[]" value="0">
                <textarea id="cfa-l-<?= $part ?>-46" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
            </div>
        </div>
        <br>
    </li>
    <li id="cfac<?= $part ?>" class="uk-parent" aria-expanded="true">
        <h2><span class="uk-text-primary">Learning Targets and Common Formative Assessment</span></h2>
        <div class="uk-panel uk-panel-box uk-panel-box-primary">
            <p><strong>How will WE know if they LEARNED it?</strong></p>
            <hr>
            <p>A learning target is any achievement expectation for students <i>on the path</i> toward mastery of a standard.  It clearly states what we want the students to learn and should be understood by teachers and students.  Learning targets should be formatively assessed to monitor progress toward a standard.</p>
            <p>EFFECTIVE TEAMS utilize COMMON FORMATIVE ASSESSMENTS (CFA) to diagnostically assess a student&apos;s learning and determine which students were proficient in the guaranteed skill and those who weren&apos;t.</p>
            <p>TEAM ACTION STEPS: Identify a common formative assessment that your team will use to assess the GVC skill.</p>
        </div>
        <br>

        <div class="uk-panel uk-panel-box">
            <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <div class="uk-form-row uk-flex uk-flex-wrap uk-margin-top">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 45%">
                    <label class="uk-form-label" for="cfa-c-<?= $part ?>-49">List the Learning Targets that will be part of this standard</label>
                    <span class="">
                        <input type="hidden" name="questions[]" value="49">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-49" cols="41" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </span>
                </div>

                <div class="uk-flex-item-auto uk-margin-right" style="width: 20%">
                    <label class="uk-form-label" for="cfa-c-<?= $part ?>-50">How many students were assessed by our team?</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="50">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-50" cols="15" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>

                <div class="uk-flex-item-auto" style="width: 20%">
                    <label class="uk-form-label" for="cfa-c-<?= $part ?>-51">How many students were NOT proficient the first time?</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="51">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-51" cols="15" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-52">Enter any website links to online documents which support this assessment</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="52">
                    <input type="hidden" name="answerids[]" value="">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-52" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-53">According to the results of this CFA and our team&apos;s collaboration, the following teaching practices/strategies were most effective in teaching this guaranteed skill(s):</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="53">
                    <input type="hidden" name="answerids[]" value="">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-53" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
                </div>
            </div>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
            <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
        </div>
        <br>
    </li>
    <li id="int<?= $part ?>" class="uk-parent">
        <h2><span class="uk-text-primary">Intervention</span></h2>
        <div class="uk-parent">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE RESPOND to those who didn&apos;t get it?</strong></p>

                <p>EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn&apos;t get a concept, it&apos;s not an intervention problem; the initial instruction needs to be examined.)</p>
            </div>
            <br>
            <div class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <div class="uk-form-row uk-flex">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-56">List the SPECIFIC INTERVENTIONS your team responded with for students who WERE NOT proficient.</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="56">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-56" cols="40" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-57">Following your team&apos;s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="57">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-57" cols="40" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-58">List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team&apos;s intervention.<br><br>(To indicate growth, include how much the student grew from the first to second assessment).</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="58">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-58" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-59">How did your TEAM respond to those who were still not proficient even after your team&apos;s interventions?</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="59">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-59" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </div>
        </div>
        <br>
    </li>
    <li id="le<?= $part ?>" class="uk-parent">
        <h2><span class="uk-text-primary">Learning Extension</span></h2>
        <div class="uk-nav-sub">
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</strong></p>
            </div>
            <br>

            <div class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-62">ACTION STEPS: As you review your GVC from (step #1), identify extension activities your team will use for those who already know it.</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="62">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-62" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-63">End of Year Reflection Date:</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="63">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <input type="text" id="cfa-l-<?= $part ?>-63" name="answers[]" value="" placeholder="text input">
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-64"><strong>End of Year Reflection</strong><br><br>Do our extension activities provide deeper learning for those students who already know it? What adjustments can we make to provide for better extended learning opportunities?
                    </label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="64">
                        <input type="hidden" name="answerids[]" value="">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-64" cols="50" rows="8" name="answers[]" placeholder="text input"></textarea>
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
</ul>
</form>

<hr>
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
