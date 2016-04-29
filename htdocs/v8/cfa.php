<br>
    <form method="post" class="uk-form uk-form-horizontal" action="save_answer.php">
    <ul id="cfa<?= $part ?>" class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav="{multiple:true}">
    <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
    <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
    <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
    <input type="hidden" name="part" value="<?= $part ?>">
    <input type="hidden" name="sequence" value="0">
    <input type="hidden" name="op" value="SaveAnswer">
    <li id="cfal<?= $part ?>">
        <div class="uk-panel uk-panel-box uk-panel-box-primary">
            <p><strong>Our Team&apos;s GVC</strong></p>
            <hr>
            <p>
            With your team:<ol>
            <li>Identify/list the Essential Learnings that all students need to know.  These are your GVC&apos;s.</li>
            <li>Once your team has identified the Essential Learnings, share them with the team above and below your specific grade level.</li>
            <li>Share the Essential Learnings with your students.</li>
            </ol></p>
        </div>
        <br>

        <div class="uk-form-row uk-panel uk-panel-box">
            <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <label class="uk-form-label" for="cfa-l-<?= $part ?>-46">Enter your GVC <?= $count ?> here:</label>
            <div class="uk-form-controls">
                <input type="hidden" name="questions[]" value="46">
                <input type="hidden" name="answerids[]" value="<?= isset($questions[46]['answerid']) ? $questions[46]['answerid'] : "" ?>">
                <input type="hidden" name="sequences[]" value="0">
                <textarea id="cfa-l-<?= $part ?>-46" cols="113" rows="3" name="answers[]" placeholder="text input"><?= isset($questions[46]['answer']) ? $questions[46]['answer'] : "" ?></textarea>
            </div>
        </div>
        <br>
    </li>
    <li id="cfac<?= $part ?>" class="uk-parent" aria-expanded="true">
        <a href="#" class="uk-text-large"><strong><i class="uk-icon-bars"></i> Learning Targets and Common Formative Assessment</strong></a>
        <ul class="uk-nav-sub"><li>
        <div class="uk-panel uk-panel-box uk-panel-box-primary">
            <p><strong>How will WE know if they LEARNED it?</strong></p>
            <hr>
            <p>A learning target is any achievement expectation for students <i>on the path</i> toward mastery of a standard.  It clearly states what we want the students to learn and should be understood by teachers and students.  Learning targets should be formatively assessed to monitor progress toward a standard.</p>
            <p>With your team:<ol><li>Break the GVC into specific, measurable learning targets</li><li>Identify a common formative assessment(s) (CFA) that your team will use to measure these learning targets.</li><li>Schedule, administer, and analyze the results of your CFA(s).</li></ol></p>
        </div>
        <br>

        <div class="uk-panel uk-panel-box">
            <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <div class="uk-form-row uk-flex uk-flex-wrap uk-margin-top">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 40%">
                    <label class="" for="cfa-c-<?= $part ?>-48">List the Learning Targets that will lead to proficiency in this GVC</label>
                    <span class="">
                        <input type="hidden" name="questions[]" value="48">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[49]['answerid']) ? $questions[49]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-48" cols="65" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[49]['answer']) ? $questions[49]['answer'] : "" ?></textarea>
                    </span>
                </div>

                <div class="uk-flex-item-auto uk-margin-right" style="width: 20%">
                    <label class="" for="cfa-c-<?= $part ?>-50">CFA(s)</label>
                    <span class="">
                        <input type="hidden" name="questions[]" value="50">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[50]['answerid']) ? $questions[50]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-50" cols="35" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[50]['answer']) ? $questions[50]['answer'] : "" ?></textarea>
                    </span>
                </div>

                <div class="uk-flex-item-auto uk-margin-right" style="width: 5%">
                    <label class="" for="cfa-c-<?= $part ?>-51"># assessed</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="51">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[51]['answerid']) ? $questions[51]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-51" cols="20" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[51]['answer']) ? $questions[51]['answer'] : "" ?></textarea>
                    </div>
                </div>

                <div class="uk-flex-item-auto" style="width: 5%">
                    <label class="" for="cfa-c-<?= $part ?>-52"># NOT proficient</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="52">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[52]['answerid']) ? $questions[52]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-52" cols="20" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[52]['answer']) ? $questions[52]['answer'] : "" ?></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-53">Enter any website links to online documents which support this assessment</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="53">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[53]['answerid']) ? $questions[53]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-53" cols="113" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[53]['answer']) ? $questions[53]['answer'] : "" ?></textarea>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-54">According to the results of our CFA(s) and team&apos;s collaboration, the following teaching practices/strategies were most effective</label>
                <div class="uk-form-controls">
                    <input type="hidden" name="questions[]" value="54">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[54]['answerid']) ? $questions[54]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-54" cols="113" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[54]['answer']) ? $questions[54]['answer'] : "" ?></textarea>
                </div>
            </div>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
            <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
        </div>
        <br>
        </li></ul>
        <hr>
    </li>
    <li id="int<?= $part ?>" class="uk-parent">
        <a href="#" class="uk-text-large"><strong><i class="uk-icon-bars"></i> Intervention</strong></a>
        <ul class="uk-nav-sub"><li>
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>How will WE RESPOND to those who didn&apos;t get it?</strong></p>

                <p>EFFECTIVE TEAMS analyze the results of their common formative assessment (CFA) and immediately intervene with those who are in need of extra time and support. (Keep in mind that if less than 75% of students didn&apos;t get a concept, it&apos;s not an intervention problem; the initial instruction needs to be examined.)</p>
            </div>
            <br>
            <div class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
            <div class="uk-form-row uk-flex">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="" for="cfa-i-<?= $part ?>-57">List the SPECIFIC INTERVENTIONS your team responded with for students who WERE NOT proficient.</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="57">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[57]['answerid']) ? $questions[57]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-57" cols="70" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[57]['answer']) ? $questions[57]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="" for="cfa-i-<?= $part ?>-58">Following your team&apos;s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="58">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[58]['answerid']) ? $questions[58]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-58" cols="70" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[58]['answer']) ? $questions[58]['answer'] : "" ?></textarea>
                    </div>
                </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-59">List the SPECIFIC FIRST NAMES of those students who were not proficient even after your team&apos;s intervention.<br><br>(To indicate growth, include how much the student grew from the first to second assessment).</label>
<?php if ( !empty($data['_session']['CAN_view_protected_answers']) ) { ?>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="59">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[59]['answerid']) ? $questions[59]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-59" cols="113" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[59]['answer']) ? $questions[59]['answer'] : "" ?></textarea>
<?php } else { ?>
                    <div class="uk-form-controls uk-form-controls-text uk-panel uk-panel-box">
                        Protected Content
<?php } ?>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-60">How did your TEAM respond to those who were still not proficient even after your team&apos;s interventions?</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="60">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[60]['answerid']) ? $questions[60]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-60" cols="113" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[60]['answer']) ? $questions[60]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </div>
        <br>
        </li></ul>
        <hr>
    </li>
    <li id="le<?= $part ?>" class="uk-parent">
        <a href="#" class="uk-text-large"><strong><i class="uk-icon-bars"></i> Learning Extension</strong></a>
        <ul class="uk-nav-sub"><li>
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <p><strong>EFFECTIVE TEAMS provide extension activities for those students who already know a standard or skill.</strong></p>
            </div>
            <br>

            <div class="uk-panel uk-panel-box">
                <div class="uk-badge uk-badge-notification uk-align-right"><?= $count ?></div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-63">ACTION STEPS: As you review your GVC from (step #1), identify extension activities your team will use for those who already know it.</label>
                    <div class="uk-form-controls">
                        <input type="hidden" name="questions[]" value="63">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[63]['answerid']) ? $questions[63]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-63" cols="113" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[63]['answer']) ? $questions[63]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </div>
        </li></ul>
        <br>
    </li>

    <li id="re<?= $part ?>">
        <div class="uk-panel uk-panel-box">
            <div class="uk-form-row uk-flex">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="" for="cfa-r-<?= $part ?>-64">Reflect on what worked</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="64">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[64]['answerid']) ? $questions[64]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-r-<?= $part ?>-64" cols="70" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[64]['answer']) ? $questions[64]['answer'] : "" ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
		    <label class="uk-form-label" for="cfa-l-<?= $part ?>-65">Reflect on what didn&apos;t work</label>
                    <div class="">
                        <input type="hidden" name="questions[]" value="65">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[65]['answerid']) ? $questions[65]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-65" cols="70" rows="8" name="answers[]" placeholder="text input"><?= isset($questions[65]['answer']) ? $questions[65]['answer'] : "" ?></textarea>
                    </div>
                </div>
            </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" onclick="save_answers(this)">Save</button>
  <?php } ?>
        </div>
    </li>
    <br>
</ul>
</form>

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
