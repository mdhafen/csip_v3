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
    <li id="cfal<?= $part ?>">
        <div class="uk-panel uk-panel-box uk-panel-box-primary">
            <p><strong>What do students NEED to know and be able to do?</strong></p>
            <hr>
            <p>
            With your team:<ol>
            <li>Look at your standards, give priority, and come to consensus around key skills, concepts, behaviors, and dispositions.</li>
            <li>Identify/list the Essential Learnings that all students need to know.  These are your GVC&apos;s.</li>
            <li>Once your team has identified each GVC, share them with the team above and below your specific grade level.</li>
            <li>Share the GVC with your students.</li>
            </ol></p>
        </div>
        <br>

        <div class="uk-form-row uk-panel uk-panel-box">
            <label class="uk-form-label" for="cfa-l-<?= $part ?>-46">Enter GVC #<?= $count ?> here:</label>
            <div class="uk-form-controls" data-csip-answer-ids>
                <input type="hidden" name="questions[]" value="46">
                <input type="hidden" name="answerids[]" value="<?= isset($questions[46]['answerid']) ? $questions[46]['answerid'] : "" ?>">
                <input type="hidden" name="sequences[]" value="0">
                <textarea id="cfa-l-<?= $part ?>-46" cols="113" rows="3" name="answers[]" placeholder="text input"></textarea>
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
            <p>A learning target is any achievement expectation for students <i>on the path</i> toward mastery of a standard.  It clearly states what we want our students to learn and should be understood by teachers and students.  Learning targets should be formatively assessed to monitor progress toward a GVC.</p>
            <p>With your team:<ol><li>Break GVC #<?= $count ?> into specific, measurable learning targets.</li><li>Identify the Common Formative Assessment(s) that your team will use to measure these learning targets.</li><li>Schedule, administer, and analyze the results of your CFA(s).</li></ol></p>
        </div>
        <br>

        <div class="uk-panel uk-panel-box">
            <div class="uk-form-row uk-flex uk-flex-wrap uk-margin-top">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 40%">
                    <div style="min-height:40px;"><label class="" for="cfa-c-<?= $part ?>-49">List the Learning Targets that lead to proficiency in GVC #<?= $count ?></label></div>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="49">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[49]['answerid']) ? $questions[49]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-49" cols="65" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>

                <div class="uk-flex-item-auto uk-margin-right" style="width: 20%">
                    <div style="min-height:40px;"><label class="" for="cfa-c-<?= $part ?>-50">CFA(s)</label></div>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="50">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[50]['answerid']) ? $questions[50]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-50" cols="35" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>

                <div class="uk-flex-item-auto uk-margin-right" style="width: 5%">
                    <div style="min-height:40px;"><label class="" for="cfa-c-<?= $part ?>-51"># assessed</label></div>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="51">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[51]['answerid']) ? $questions[51]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-51" cols="20" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>

                <div class="uk-flex-item-auto" style="width: 5%">
                    <div style="min-height:40px;"><label class="" for="cfa-c-<?= $part ?>-52"># NOT proficient</label></div>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="52">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[52]['answerid']) ? $questions[52]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-c-<?= $part ?>-52" cols="20" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-53">OPTIONAL: Enter links to online documents which support this assessment.</label>
                <div class="uk-form-controls" data-csip-answer-ids>
                    <input type="hidden" name="questions[]" value="53">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[53]['answerid']) ? $questions[53]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-53" cols="113" rows="8" name="answers[]" placeholder="text input"></textarea>
                </div>
            </div>
            <hr>
            <div class="uk-form-row">
                <label class="uk-form-label" for="cfa-c-<?= $part ?>-54">According to the results of our CFA(s) and team collaboration, the following teaching practices/strategies were most effective for GVC #<?= $count ?>.</label>
                <div class="uk-form-controls" data-csip-answer-ids>
                    <input type="hidden" name="questions[]" value="54">
                    <input type="hidden" name="answerids[]" value="<?= isset($questions[54]['answerid']) ? $questions[54]['answerid'] : "" ?>">
                    <input type="hidden" name="sequences[]" value="0">
                    <textarea id="cfa-c-<?= $part ?>-54" cols="113" rows="8" name="answers[]" placeholder="text input"></textarea>
                </div>
            </div>
            <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
            <button class="uk-button uk-button-success uk-align-right" type="button" data-group="cfa_save" onclick="save_answers(this)">Save</button>
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
            <div class="uk-form-row uk-flex">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="" for="cfa-i-<?= $part ?>-57">List the SPECIFIC INTERVENTIONS your team responded with for students who WERE NOT proficient in GVC #<?= $count ?>.</label>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="57">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[57]['answerid']) ? $questions[57]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-57" cols="70" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <div class="uk-flex-item-auto uk-margin-right" style="width: 50%">
                    <label class="" for="cfa-i-<?= $part ?>-58">Following your team&apos;s INTERVENTIONS and REASSESSMENT, how many students are still not proficient?</label>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="58">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[58]['answerid']) ? $questions[58]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-58" cols="70" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-59">List the FIRST NAMES of those students who were not proficient even after your team&apos;s intervention.<br><br>(Or enter a link to an online document with the students names.)</label>
                    <div class="uk-form-controls" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="59">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[59]['answerid']) ? $questions[59]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-59" cols="113" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <hr>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-i-<?= $part ?>-60">How did your TEAM respond to those who were still not proficient even after your team&apos;s interventions?</label>
                    <div class="uk-form-controls" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="60">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[60]['answerid']) ? $questions[60]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-i-<?= $part ?>-60" cols="113" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" data-group="cfa_save" onclick="save_answers(this)">Save</button>
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
                <p><strong>What will we do if they already know it?</strong></p>
            </div>
            <br>

            <div class="uk-panel uk-panel-box">
                <div class="uk-form-row">
                    <label class="uk-form-label" for="cfa-l-<?= $part ?>-63">As you plan instruction for GVC #<?= $count ?> and the learning targets, identify extension activities your team will use for those who already know it.</label>
                    <div class="uk-form-controls" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="63">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[63]['answerid']) ? $questions[63]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-63" cols="113" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" data-group="cfa_save" onclick="save_answers(this)">Save</button>
  <?php } ?>
            </div>
        </li></ul>
        <hr>
    </li>

    <li id="re<?= $part ?>">
        <div class="uk-panel uk-panel-box uk-alert-warning">
            <p><strong>Once you have completed the process, reflect on...</strong></p>
        </div>
        <br>
        <div class="uk-panel uk-panel-box">
            <div class="uk-form-row uk-flex">
                <div class="uk-flex-item-auto uk-margin-right" style="width: 45%">
                    <label class="" for="cfa-r-<?= $part ?>-65">What we will keep for GVC #<?= $count ?>:</label>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="65">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[65]['answerid']) ? $questions[65]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-r-<?= $part ?>-65" cols="60" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
                <div class="uk-flex-item-auto uk-margin-right" style="">
                    <label class="" for="cfa-l-<?= $part ?>-66">What we will change for GVC #<?= $count ?>:</label>
                    <div class="" data-csip-answer-ids>
                        <input type="hidden" name="questions[]" value="66">
                        <input type="hidden" name="answerids[]" value="<?= isset($questions[66]['answerid']) ? $questions[66]['answerid'] : "" ?>">
                        <input type="hidden" name="sequences[]" value="0">
                        <textarea id="cfa-l-<?= $part ?>-66" cols="60" rows="8" name="answers[]" placeholder="text input"></textarea>
                    </div>
                </div>
            </div>
                <br>
  <?php if ( !empty($data['can_edit']) ) { ?>
                <button class="uk-button uk-button-success uk-align-right" type="button" data-group="cfa_save" onclick="save_answers(this)">Save</button>
  <?php } ?>
        </div>
    </li>
    <br>
</ul>
</form>

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
