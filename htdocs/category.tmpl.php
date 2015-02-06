<?php include( 'doc-open.php' ); ?>
<title>Welcome to Digital Comprehensive School Improvement Plan</title>
<?php
include( 'doc-head-close.php' );
include( 'doc-header-open.php' );
include( 'doc-due-key.php' );
include( 'doc-header-close.php' );
include( 'doc-menu.php' );
?>

<?php
$class = $data['csip']['category'][ $data['categoryid'] ]['category_class'];
$can_save = 0;
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
  if ( ! $data['csip']['loc_demo'] ) {
    $can_save = 1;
  }
}

if ( $data['csip'] ) {
?>
<h1><?= $data['csip']['year_name'] ?> Plan for <?= $data['csip']['name'] ?></h1>
<?php
}
?>

<h2><?= $data['csip']['category'][ $data['categoryid'] ]['category_name'] ?></h2>

<h3>Question <?= $data['part'] ?>: <?php
  if ( $data['csip']['version'] == 6 ) {
    if ( $class == 'OPT' && $data['part'] == 1 ) { ?>
Other Information<?php
    } else if ( $data['part'] == 1 ) { ?>
Guaranteed and Viable Curriculum<?php
    } else if ( $data['part'] == 2 ) { ?>
Formative Assessments<?php
    } else if ( $data['part'] == 3 ) { ?>
Interventions<?php
    } else { ?>
Learning Extensions<?php
    }
  }
  else if ( $data['csip']['version'] == 7 ) {
    switch ( $data['part'] ) {
      case 1: print "Guaranteed Curriculum"; break;
      case 2: print "GVC 1"; break;
      case 3: print "GVC 2"; break;
      case 4: print "GVC 3"; break;
      case 5: print "GVC 4"; break;
      case 6: print "GVC 5"; break;
      case 7: print "GVC 6"; break;
      case 8: print "Accreditation"; break;
    }
  }
?></h3>

<form method="post" action="<?= $data['_config']['base_url'] ?>category.php?category=<?= $data['categoryid'] ?>&part=<?= $data['part'] ?>">
<ol>
<?php foreach ( $data['questions'] as $question ) { ?>
<li>
<?= $question['input_html'] ?>
<?php if ( $can_save && $question['type'] != 9 ) { ?>
<br><input type="submit" name="op" value="Save Answers">
<?php } ?>
</li>
<?php } ?>
</ol>
</form>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
