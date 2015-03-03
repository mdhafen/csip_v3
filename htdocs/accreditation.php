                <br>
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                       <p><strong>Essential Elements of Accreditation</strong></p>
                        <p>We will put something more when we know what we want this part to say.</p>
                    </div>
                <form class="uk-form uk-form-horizontal">
<?php
if ( !empty($data['courseid']) && !empty($data['csip']['courses'][ $data['courseid'] ]['questions'][2]) ) {
  $count = 0;
  foreach ( $data['csip']['courses'][ $data['courseid'] ]['questions'][2] as $questionid => $answer ) {
    $count++;
    if ( $count > 1 ) {
      echo "<hr>\n";
    }
?>
                <br>
                    
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="form-h-t"><?= $data['csip']['questions'][ $questionid ]['question_clean'] ?></label>
                        <div class="uk-form-controls">
                            <textarea id="form-h-t" cols="50" rows="8" placeholder="Type reponse here"><?= $answer['answer'] ?></textarea>
                        </div>
                    </div>     
<?php
  }
}
?>
            <br>
<button class="uk-button uk-button-success uk-align-right" type="button">Save</button>        
                </form>
