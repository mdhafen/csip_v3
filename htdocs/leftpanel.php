<div class="uk-panel uk-panel-box" uk-nav-side>

<?php if ( ! empty($data['courseid']) && ! empty($data['csip']['courses'][ $data['courseid'] ]['questions'][1]) ) { ?>
    <h4><i class="uk-icon-bars"></i> <strong>Guaranteed Curriculum</strong></h4>
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
                <form class="uk-form">                            
                    <textarea id="form-h-t" cols="30" rows="8" placeholder="Define Team's GVC Here..."></textarea>
                    <br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button">Save</button>     
                    <br><br>
                </form>
                <hr>
            </li>
        </ul>
    </li>
        <li class="uk-parent">
        <a href="#">Reflection Date</a>
        <ul class="uk-nav-sub">
            <li>With your team, identify and list which STANDARDS AND SKILLS are absolutely CRITICAL for the student to be successful in the grade level or course AND that your team will work to guarantee that EVERY student will know.<br><br></li>
            <li>
                <form class="uk-form">
                    <input type="text" data-uk-datepicker="{format:'DD.MM.YYYY'}">                     <button class="uk-button uk-button-success uk-align-right" type="button">Save</button>     
                    <br><br>
                </form>
                                <hr>

            </li>
        </ul>
    </li>
     <li class="uk-parent">
        <a href="#">Reflection Summary</a>
        <ul class="uk-nav-sub">
            <li>With your team, identify and list which STANDARDS AND SKILLS are absolutely CRITICAL for the student to be successful in the grade level or course AND that your team will work to guarantee that EVERY student will know.</li>
            <li>
            <form class="uk-form">                            
                    <textarea id="form-h-t" cols="30" rows="8" placeholder="Define Team's Reflection Summary Here..."></textarea>
                <br><br>
                    <button class="uk-button uk-button-success uk-align-right" type="button">Save</button>     
                    <br><br>
                </form>
            </li>
        </ul>
    </li>
</ul>
<?php } ?>
    </div>