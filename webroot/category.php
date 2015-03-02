<?php
include_once( '../lib/input.phpm' );
include_once( '../lib/security.phpm' );
include_once( '../lib/output.phpm' );

include_once( '../inc/category.phpm' );
include_once( '../inc/csips.phpm' );

if ( ! authorized( 'load_csip' ) || ! authorized( 'load_other_csip' ) ) {
  authorize( 'load_csip' );
}

$csip = $_SESSION['csip'];
if ( ! $csip ) {
  $location = ( preg_match( '/^http/', $config['base_url'] ) ) ? $config['base_url'] : "http://". $_SERVER['HTTP_HOST'] . $config['base_url'];
  header( "Location: $location" );
  exit;
}

$categoryid = input( 'category', INPUT_PINT );
$part = input( 'part', INPUT_PINT );
$op = input( 'op', INPUT_STR );
if ( $op == 'Save Answers' ) {
  cat_save_answers( $categoryid, $part, $csip );

  //$csip = load_csip( $csip['csipid'] );
  $csip = cat_reload_answers( $csip, $categoryid );
  $_SESSION['csip'] = $csip;
}

$question_group_id = $csip['category'][$categoryid]['question_group'];
$question_group = $csip['question_group'][ $question_group_id ];
foreach ( (array) $question_group as $id => $question ) {
  $answer = array();
  if ( $question['part'] != $part ) {
    unset( $question_group[ $id ] );
  } else {
    if ( $csip['category'][$categoryid]['answer'] ) {
      foreach ( (array) $csip['category'][$categoryid]['answer'] as $ans ) {
	if ( $ans['questionid'] == $question['questionid'] ) {
	  $answer = $ans;
	  break;
	}
      }
    }
    $question_group[ $id ]['input_html'] = cat_get_html_input( $question, $answer, $categoryid, $csip );
  }
}

$output = array(
	'csip' => $csip,
	'categoryid' => $categoryid,
	'part' => $part,
	'questions' => $question_group,
);
output( $output, 'category.tmpl' );
?>
