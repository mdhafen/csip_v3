<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<?php include 'menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
<br>
            <span class="uk-align-right">
						<?php
							foreach( $data['_config']['header_logos'] as $logo ) {
								echo '<img src="' . $logo . '" class="uk-margin-left" style="max-height: 30px">';
							}
						?>
						<br>
						<a href="https://www.washk12.org/professional-learning/help-me/csip" style="float: right;" class="uk-button uk-button-primary" target="_BLANK">Go here for help</a>
            </span>
						<h2>

            <form method="post" class="uk-form uk-display-inline-block" action="index.php">
                   Plan for
            <select type="text" class="uk-form-large" name="csipid" onchange="this.form.submit()">
            <option>Select One...</option>
<?php
if ( !empty($data['csips']) ) {
   $csipid = empty($data['csip']) ? 0 : $data['csip']['csipid'];
   foreach ( $data['csips'] as $csip ) {
       echo '<option value="'. $csip['csipid'] .'"'. ( $csip['csipid'] == $csipid ? ' selected="selected"' : "" ) .'>'. $csip['year_name'] .' '. $csip['name'] .'</option>'."\n";
   }
}
?>
            </select>
            Course
<?php
if ( !empty($data['csip']['courses']) ) {
   $selected_category = 0;
   if ( count($data['csip']['course_categories']) > 1 ) {
      echo '<select type="text" class="uk-form-large" name="categoryid" onchange="this.form.submit()">',"\n";
      echo '<option>Select One...</option>',"\n";
      $selected_category = empty($data['categoryid']) ? 0 : $data['categoryid'];
      foreach ( $data['csip']['course_categories'] as $categoryid => $category_name ) {
         echo "<option value='$categoryid'". ($categoryid == $selected_category ? " selected='selected'" : "" ) .">". $category_name ."</option>\n";
      }
      echo '</select>',"\n";
   }
   if ( $selected_category or count($data['csip']['course_categories']) <= 1 ) {
      echo '<select type="text" class="uk-form-large" name="courseid" onchange="this.form.submit()">',"\n";
      echo '<option>Select One...</option>',"\n";
      $selected_course = empty($data['courseid']) ? 0 : $data['courseid'];
      foreach ( $data['csip']['courses'] as $courseid => $course ) {
         if ( $selected_category && $course['course_category'] != $selected_category ) { continue; }
         echo "<option value='$courseid'". ($courseid == $selected_course ? " selected='selected'" : "" ) .">". $course['course_name'] ."</option>\n";
      }
      echo '</select>',"\n";
   }
}
?>
        </form>
        </h2>
<?php
if ( !empty($data['csip']) && !empty($data['courseid']) ) {
 if ( !empty($data['_session']['CAN_approve_csip']) ) {
 ?>
    <form method="post" class="uk-form uk-display-inline-block" action="approve.php">
        <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
        <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
        <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
        <input type="hidden" name="op" value="Comment">
        <textarea id="a-c" cols="115" rows="3" name="comment" placeholder="Principal&apos;s feedback"><?= isset($data['csip']['courses'][ $data['courseid'] ]['principal_comment']) ? $data['csip']['courses'][ $data['courseid'] ]['principal_comment'] : "" ?></textarea><br>
        <button class='uk-button uk-button-success' onclick="save_answers(this)">Save Feedback</button><?php if ( isset($data['csip']['courses'][ $data['courseid'] ]['comment_date']) ) { $date = new DateTime($data['csip']['courses'][ $data['courseid'] ]['comment_date']); print " (". $date->format('m/d/Y') .") "; } ?>
    </form>
<?php } else if ( !empty($data['csip']['courses'][ $data['courseid'] ]['principal_comment']) ) { ?>
   <span class="uk-panel uk-alert uk-alert-warning"><span class="uk-text-large uk-text-bold">Principal&apos;s Feedback:</span><?php if ( isset($data['csip']['courses'][ $data['courseid'] ]['comment_date']) ) { $date = new DateTime($data['csip']['courses'][ $data['courseid'] ]['comment_date']); print " (". $date->format('m/d/Y') .") "; } ?>
<?= isset($data['csip']['courses'][ $data['courseid'] ]['principal_comment']) ? $data['csip']['courses'][ $data['courseid'] ]['principal_comment'] : "" ?>
    </span>
<?php
      }
   }
?>

            <hr>

<?php
$tab = '';

if ( !empty($data['csip']['version']) ) {
  switch ( $data['csip']['version'] ) {
    case 7:  include 'v7/information.php'; break;
    case 8:  include 'v8/information.php'; break;
    default: print '<h1>Alpha Code!  Form version '. $data['csip']['version'] .' has not been created yet!</h1>' ."\n"; break;
  }
}

include 'footer.php';
?>
        </div>

<script type="text/javascript">
$(window).load( function(){
  var tab = "<?= $tab ?>";
  if ( tab ) {
    $("#" + tab).trigger('click');
  }
});

answers_changed = {};
answers_original = {};

function answer_save_original(element) {
  if ( ! answers_original.hasOwnProperty( element.id ) ) {
    answers_original[ element.id ] = element.value;
  }
}

function answer_changed(element) {
  if ( answers_original.hasOwnProperty( element.id ) ) {
    if ( element.value == answers_original[ element.id ] ) {
      delete answers_changed[ element.id ];
      return;
    }
  }

  answers_changed[ element.id ] = 1;
  $( element.form ).find( "button[data-group='cfa_save']" ).each(function(){
    $(this).removeClass("uk-button-success").addClass("uk-button-danger");
    $(this).val('Save');
  });

  save_answers_ajax();
}

function check_unsaved_answers() {
  for ( var ans_id in answers_changed ) {
    if ( answers_changed.hasOwnProperty(ans_id) ) {  // just in case
      return true;
    }
  }
  return false;
}

function save_answers(button_elm) {
  var form = button_elm.form;

  $( form ).find( "input[type='text'], textarea" ).each(function(){
    if ( answers_changed[ this.id ] ) {
      delete answers_changed[ this.id ];
    }
  });

  $( form ).find( "button[data-group='cfa_save']" ).each(function(){
    $(this).removeClass("uk-button-danger").addClass("uk-button-success");
    $(this).val('Changes Saved');
  });

  form.submit();
}

function save_answers_ajax() {
  var parts = {};
  for ( var ans_id in answers_changed ) {
    if ( answers_changed.hasOwnProperty(ans_id) ) {
      var elm = document.getElementById(ans_id);
      var questionid=0; var answerid=0; var sequence=0;
      var nodes = elm.parentNode.getElementsByTagName( 'input' );
      for ( var i = 0, l = nodes.length; i < l; i++ ) {
        var node = nodes[i];
        switch ( node.name ) {
          case "questions[]": questionid = node.value; break;
          case "answerids[]": answerid = node.value; break;
          case "sequences[]": sequence = node.value; break;
          case "questionid": questionid = node.value; break;
          case "answerid": answerid = node.value; break;
          case "sequence": sequence = node.value; break;
        }
      }
      var this_part = elm.form.elements["part"].value;
      if ( parts.hasOwnProperty( this_part ) ) {
        parts[ this_part ].questions.push( questionid );
        parts[ this_part ].answerids.push( answerid );
        parts[ this_part ].sequences.push( sequence );
        parts[ this_part ].answers.push( elm.value );
      }
      else {
        parts[ this_part ] = {
          "csipid" : elm.form.elements["csipid"].value,
          "courseid" : elm.form.elements["courseid"].value,
          "part" : this_part,
          "questions" : [ questionid ],
          "answerids" : [ answerid ],
          "sequences" : [ sequence ],
          "answers" : [ elm.value ]
        };
      }
    }
  }
  for ( var data_key in parts ) {
    if ( parts.hasOwnProperty( data_key ) ) {
      var data = parts[ data_key ];
	  var modal = UIkit.modal.blockUI("Saving Answer...");
      $.post('<?= $data['_config']['base_url'] ?>api/save_answer_ajax.php', data, function(xml_result) { answer_saved_ajax(data_key,xml_result,modal) }, "xml" );
    }
  }
}

function answer_saved_ajax( part, xml_result, modal ) {
  if ( $(xml_result).find("state").text() == 'Success' ) {

    var form = $("input[type='hidden'][name='part'][value='"+ part +"']")[0].form;

    $(xml_result).find("answer_details").each( function(){
		var this_result_part = $(this).find('part').text();
		var this_result_questionid = $(this).find('questionid').text();
		var this_result_answerid = $(this).find('answerid').text();
		var this_result_sequence = $(this).find('group_sequence').text();
		$(form).find( "div[data-csip-answer-ids]" ).each( function(){
			if ( $(this).find( "input[name='questionid']" ).length &&
			     $(this).find( "input[name='questionid']" ).val() != this_result_questionid ) {
				return true;
			}
			if ( $(this).find( "input[name='questions[]']" ).length &&
			     $(this).find( "input[name='questions[]']" ).val() != this_result_questionid ) {
				return true;
			}

			if ( $(this).find( "input[name='answerids[]']" ).length ) {
				if ( ! $(this).find( "input[name='answerids[]']" ).val() ) {
					$(this).find( "input[name='answerids[]']" ).val( this_result_answerid );
					if ( this_result_sequence ) {
                        if ( ! $(form).find( "input[data-sequence-group='"+ this_result_part +"-"+ this_result_sequence +"']" ).length ) {
                            $(form).find( "input[data-sequence-group='"+ this_result_part +"-0']" ).val( this_result_sequence ).attr("data-sequence-group",this_result_part +"-"+ this_result_sequence);
                        }
					}
				}
			}
			else {
				if ( $(this).find( "input[name='answerid']" ).length && ! $(this).find( "input[name='answerid']" ).val() ) {
					$(this).find( "input[name='answerid']" ).val( this_result_answerid );
					if ( this_result_sequence ) {
                        if ( ! $(form).find( "input[data-sequence-group='"+ this_result_part +"-"+ this_result_sequence +"']" ).length ) {
                            $(form).find( "input[data-sequence-group='"+ this_result_part +"-0']" ).val( this_result_sequence ).attr("data-sequence-group",this_result_part +"-"+ this_result_sequence);
                        }
					}
				}
			}

			$(this).find( "input[type='text'], textarea" ).each(function(){ 
				if ( answers_changed[ this.id ] ) {
					delete answers_changed[ this.id ];
				}
				if ( answers_original.hasOwnProperty( this.id ) ) {
					delete answers_original[ this.id ];
				}
			});
		});
    });

    $( form ).find( "button[data-group='cfa_save']" ).each(function(){
      $(this).removeClass("uk-button-danger").addClass("uk-button-success");
      $(this).val('Changes Saved');
    });

    modal.hide();
  }
  else {
    modal.hide();
    modal = UIkit.modal.alert("Save Failed.  Please make sure you use the 'Save' button.  It is also recommended that you copy and paste them to another program, like notepad or Word.");
  }
}

$( document ).ready( function() {
  var goto_tab = "<?= $tab ?>";
  if ( goto_tab ) {
    $("#" + goto_tab).trigger('click');
  }

  $("input[type='text'], textarea").blur(function(e){ answer_changed(this) });
  $("input[type='text'], textarea").focus(function(e){ answer_save_original(this) });

  $( window ).on('beforeunload', function(){
    if ( check_unsaved_answers() ) {
      for ( var ans_id in answers_changed ) {
	if ( answers_changed.hasOwnProperty(ans_id) ) {  // just in case
	  $("#"+ ans_id).css( "background-color", "red" );
	}
      }
      return "There are unsaved answers! Are you sure you want to leave this page?";
    }
  });
});

</script>
	</body>
</html>
