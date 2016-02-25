<!DOCTYPE html>
<html>
	<head>
	<?php include 'head.php';?>
	</head>
	<body>
		<?php include 'menu.php'; ?>

        <div class="uk-container uk-container-center uk-animation-fade">
<br>

            <span class="uk-align-right"><img src="https://schools.washk12.org/enterprise/wp-content/uploads/sites/23/2014/01/grey_wcsd_logo-e1395268854370.png"></span>
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
<?php
if ( !empty($data['courseid']) ) {
  if ( !empty($data['_session']['CAN_approve_csip']) ) {
    if ( empty($data['csip']['courses'][ $data['courseid'] ]['principal_approved']) ) {
      $app = "Not Approved";
      $class = "uk-button-danger";
    }
    else {
      $app = "Approved";
      $class = "uk-button-success";
    }

?>
        <form method="post" class="uk-form uk-display-inline-block" action="approve.php">
        <input type="hidden" name="csipid" value="<?= $data['csip']['csipid'] ?>">
        <input type="hidden" name="categoryid" value="<?= $data['categoryid'] ?>">
        <input type="hidden" name="courseid" value="<?= $data['courseid'] ?>">
        <input type="hidden" name="op" value="<?= $app == 'Not Approved' ? 'ApproveCourse' : 'UnApproveCourse' ?>">
        <button class='uk-button <?= $class ?>' onclick="this.form.submit()"><?= $app ?></button>
        </form>
<?php
  }
}
?>
            <hr>
        </h2>
            <div class="uk-grid" uk-grid-divider data-uk-grid-match>
                <div class="uk-width-medium-3-10">
                    <?php include 'leftpanel.php'; ?>
                    <?php include 'dates.php'; ?>
				</div>
				<div class="uk-width-medium-7-10">

                    <?php include 'information.php'; ?>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>

<?php
$tab = '';
if ( !empty($data['part']) && $data['part'] > 1 ) {
  switch ($data['part']) {
  case 2 : $tab = 'accreditation_tab'; break;
  case 3 : $tab = 'results_tab'; break;
  default: $tab = 'cfa'. ( $data['part'] - 3 ) .'_tab'; break;
  }
}
?>
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
  $( element.form ).find( "input[type='button'], button" ).each(function(){
    $(this).removeClass("uk-button-success").addClass("uk-button-danger");
    $(this).val('Save');
  });

    //save_answers_ajax();
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

  $( form ).find( "input[type='button'], button" ).each(function(){
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
      var nodes = elm.parentNode.getElementsByTagName( 'input' );
      var this_part = elm.form.elements["part"].value;
      if ( parts.hasOwnProperty( this_part ) ) {
	parts[ this_part ].questions.push( nodes[0].value );
	parts[ this_part ].answerids.push( nodes[1].value );
	parts[ this_part ].answers.push( elm.value );
      }
      else {
	parts[ this_part ] = {
	  "csipid" : elm.form.elements["csipid"].value,
	  "courseid" : elm.form.elements["courseid"].value,
	  "part" : this_part,
	  "questions" : [ nodes[0].value ],
	  "answerids" : [ nodes[1].value ],
	  "answers" : [ elm.value ]
	};
      }
    }
  }
  for ( var data_key in parts ) {
    if ( parts.hasOwnProperty( data_key ) ) {
      var data = parts[ data_key ];
      $.post('<?= $data['_config']['base_url'] ?>api/save_answer_ajax.php', data, function(xml_result) { answer_saved_ajax(data_key,xml_result) }, "xml" );
    }
  }
}

function answer_saved_ajax( part, xml_result ) {
  if ( $(xml_result).find("state").text() == 'Success' ) {

    var form = $("input[type='hidden'][name='part'][value='"+ part +"']")[0].form;

    $(xml_result).find("answerids").each( function(){
      $(form).find( "input[type='hidden'][name='questions'][value='"+ $(this).find('questionid').text() +"'] ~ input[type='hidden'][name='answerids'][value='']" ).get(0).value = $(this).find('answerid').text();
    });

    $( form ).find( "input[type='text'], textarea" ).each(function(){
      if ( answers_changed[ this.id ] ) {
	delete answers_changed[ this.id ];
      }
      if ( answers_original[ this.id ] ) {
	delete answers_original[ this.id ];
      }
    });

    $( form ).find( "input[type='button'], button" ).each(function(){
      $(this).removeClass("uk-button-danger").addClass("uk-button-success");
      $(this).val('Changes Saved');
    });
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

