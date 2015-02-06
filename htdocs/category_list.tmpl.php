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
if ( $data['csip'] ) {
?>
<h1><?= $data['csip']['year_name'] ?> Plan for <?= $data['csip']['name'] ?></h1>
<?php
}
?>

<table class="category_list">
<thead>
<tr>
<th>&nbsp</th>
<th>Section</th>
<?php
if ( $data['category_list']['PREVIOUS'] ) {
?>
<!--  <th>Previous Year Report</th> -->
<?php
}
for ( $i = 1; $i <= $data['csip']['parts']; $i++ ) {
  if ( $data['csip']['version'] < 6 ) {
    switch ( $i ) {
      case 1: $part = 'Data Analysis'; break;
      case 2: $part = 'Analysis Summary'; break;
      case 3: $part = 'Analysis Summary'; break;
      case 4: $part = 'Analysis Summary'; break;
    }
  }

  else if ( $data['csip']['version'] == 6 ) {
    switch ( $i ) {
      case 1: $part = 'Question #1<br>Guaranteed Curriculum'; break;
      case 2: $part = 'Question #2<br>Formative Assessments'; break;
      case 3: $part = 'Question #3<br>Interventions'; break;
      case 4: $part = 'Question #4<br>Learning Extensions'; break;
      default : $part = "Part $i"; break;
    }
  }
  else if ( $data['csip']['version'] == 7 ) {
    switch ( $i ) {
      case 1: $part = 'Guaranteed Curriculum'; break;
      case 2: $part = 'GVC 1'; break;
      case 3: $part = 'GVC 2'; break;
      case 4: $part = 'GVC 3'; break;
      case 5: $part = 'GVC 4'; break;
      case 6: $part = 'GVC 5'; break;
      case 7: $part = 'GVC 6'; break;
      case 8: $part = 'Accreditation'; break;
      default : $part = "Part $i"; break;
    }
  }

  }
?>
  <th><?= $part ?></th>
<?php
}
?>
<?php
if ( $data['csip']['version'] < 6 ) {
?>
<th>Smart Goals</th>
<?php } ?>
<th><img src="<?= $data['_config']['base_url'] ?>images/Principal_Approved.png" alt="Principal Approved"></th>
<!--
<th><img src="<?= $data['_config']['base_url'] ?>images/Community_Approved.png" alt="Community Approved"></th>
<th><img src="<?= $data['_config']['base_url'] ?>images/District_Approved.png" alt="District Approved"></th>
<th><img src='<?= $data['_config']['base_url'] ?>images/progress.png' alt='Progress'></th>
<th><img src='<?= $data['_config']['base_url'] ?>images/End_of_Year.png' alt='End Of Year'></th>
 -->
</tr>
</thead>

<tbody>
<?php
foreach ( (array) $data['category_list'] as $class => $cats ) {
  if ( $class == 'PREVIOUS' ) { continue; }

  $class_image = "";
  $class_image_alt = "";
  switch ( $class ) {
  case 'MAND' : { 
    $class_image = 'MAND.png';
    $class_image_alt = 'Mandatory';
    break;
  }

/*
  case 'OPT' : {
    $class_image = 'OPT.png';
    $class_image_alt = 'Optional';
    break;
  }
 */

  case 'CSIP' : {
    $class_image = 'CSIP.png';
    $class_image_alt = 'CSIP';
    break;
  }

  case 'SAP' : {
    $class_image = 'SAP.png';
    $class_image_alt = 'SAP';
    break;
  }
  }

  $hilight = ! $hilight;
  $r_l = ( $hilight ) ? "highlighted" : "lowlighted";
  $count = count( $cats );
  if ( isset( $cats['group'] ) ) {
    $count--;
    foreach ( (array) $cats['group'] as $group ) {
      $count += count( $group );
    }
  }
?>
<tr class="<?= $r_l ?>">
<?php if ( $class_image ) { ?>
<td rowspan=<?= $count ?> class="category_class">
<img src='<?= $data['_config']['base_url'] ?>images/<?= $class_image ?>' alt='<?= $class_image_alt ?>'>
</td>
<?php } ?>
<?php
  $first = 1;
  foreach ( (array) $cats['group'] as $group ) {
    foreach ( (array) $group as $category ) {
      if ( ! $first ) {
	$hilight = ! $hilight;
	$r_l = ( $hilight ) ? "highlighted" : "lowlighted";
?>
<tr class="<?= $r_l ?>">
<?php
      } else {
	$first = 0;
      }
?>
<?php if ( ! $class_image ) { ?>
<td>&nbsp;</td>
<?php } ?>
<td class="section_title"><?php if ( $category['category_type'] == 1 ) { ?><a target="_BLANK" href="<?= $category['type_target'] ?>"><?php } ?><?= $category['category_name'] ?><?php if ( $category['category_type'] == 1 ) { ?></a><?php } ?> <?= $category['category_note'] ?></td>
<?php if ( $data['category_list']['PREVIOUS'] ) { ?>
<!-- <td>
<?php if ( in_array( 'P', (array) $category['parts'] ) ) { ?>
<a href="previous.php?category=<?= $category['categoryid'] ?>">
<?php
$class = $data['csip']['category'][ $category['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
?>
Edit
<?php } else { ?>
view
<?php } ?>
</a>
<?php } ?>
</td> -->
<?php } ?>
<?php
        for ( $i = 1; $i <= $data['csip']['parts']; $i++ ) {
?><td><?php
	    if ( $category['parts'][$i] ) {
?><a href="category.php?category=<?= $category['categoryid'] ?>&part=<?= $i ?>">
<?php
$class = $data['csip']['category'][ $category['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
?>
Edit
<?php } else { ?>
view
<?php } ?>
</a><?php
	    }
?></td>
<?php
        }
?>
<?php
if ( $data['csip']['version'] < 6 ) {
?>
<td>
<?php if ( $category['category_type'] != 1 ) { ?>
<a href="goal_list.php?category=<?= $category['categoryid'] ?>">
<?php
$class = $data['csip']['category'][ $category['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
?>
Edit
<?php } else { ?>
view
<?php } ?>
</a>
<?php } ?>
</td>
<?php } ?>
<?php
      if ( $category['needs_principal_approve'] ) {
	if ( $data['csip']['category'][ $category['categoryid'] ]['principal_approved'] ) {
?><td class="complete">
<input type="button" disabled="disabled" value="Y">
</td><?php
	} else {
?>
<td class="incomplete">
<form method="post" action="approve.php" class="inline">
<input type="hidden" name="category" value="<?= $category['categoryid'] ?>">
<input type="hidden" name="level" value="principal">
<input type="submit" name="op" value="N"<?php if ( ! $data['principal'] ) { ?> disabled="disabled"<?php } ?>>
</form>
</td>
<?php
	}
      } else {
?>
<td></td>
<?php
      }
?>
<!--
<?php
      if ( $category['needs_community_approve'] ) {
	if ( $data['csip']['category'][ $category['categoryid'] ]['community_approved'] ) {
?><td class="complete">
<input type="button" disabled="disabled" value="Y">
</td><?php
	} else {
?>
<td class="incomplete">
<form method="post" action="approve.php" class="inline">
<input type="hidden" name="category" value="<?= $category['categoryid'] ?>">
<input type="hidden" name="level" value="community">
<input type="submit" name="op" value="N"<?php if ( ! $data['principal'] ) { ?> disabled="disabled"<?php } ?>>
</form>
</td>
<?php
	}
      } else {
?>
<td></td>
<?php
      }
?>
<?php
      if ( $category['needs_district_approve'] ) {
	if ( $data['csip']['category'][ $category['categoryid'] ]['district_approved'] ) {
?><td class="complete">
<input type="button" disabled="disabled" value="Y">
</td><?php
	} else {
?>
<td class="incomplete">
<form method="post" action="approve.php" class="inline">
<input type="hidden" name="category" value="<?= $category['categoryid'] ?>">
<input type="hidden" name="level" value="district">
<input type="submit" name="op" value="N"<?php if ( ! $data['district'] ) { ?> disabled="disabled"<?php } ?>>
</form>
</td>
<?php
	}
      } else {
?>
<td></td>
<?php
      }
?>
<td class="<?php echo ( $category['progress_percent'] == 0 && $category['category_type'] != 1 ) ? 'incomplete' : ( ( $category['progress_percent'] == 100 || $category['category_type'] == 1 ) ? 'complete' : 'working' ); ?>"><?= $category['progress_percent'] ?>%</td>
<td class="<?php echo ( $category['report_percent'] == 0 && $category['category_type'] != 1 ) ? 'incomplete' : ( ( $category['report_percent'] == 100 || $category['category_type'] == 1 ) ? 'complete' : 'working' ); ?>"><?= $category['report_percent'] ?>%</td>
 -->
</tr>
<?php
    }
  }
  unset( $cats['group'] );

  foreach ( (array) $cats as $category ) {
    if ( ! $first ) {
      $hilight = ! $hilight;
      $r_l = ( $hilight ) ? "highlighted" : "lowlighted";
?>
<tr class="<?= $r_l ?>">
<?php
    } else {
      $first = 0;
    }
?>
<?php if ( ! $class_image ) { ?>
<td>&nbsp;</td>
<?php } ?>
<td class="section_title"><?php if ( $category['category_type'] == 1 ) { ?><a target="_BLANK" href="<?= $category['type_target'] ?>"><?php } ?><?= $category['category_name'] ?><?php if ( $category['category_type'] == 1 ) { ?></a><?php } ?> <?= $category['category_note'] ?></td>
<?php if ( $data['category_list']['PREVIOUS'] ) { ?><!-- <td>
<?php if ( in_array( 'P', (array) $category['parts'] ) ) { ?>
<a href="previous.php?category=<?= $category['categoryid'] ?>">
<?php
$class = $data['csip']['category'][ $category['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
?>
Edit
<?php } else { ?>
view
<?php } ?>
</a>
<?php } ?></td> --><?php } ?>
<?php
    for ( $i = 1; $i <= $data['csip']['parts']; $i++ ) {
?><td><?php
      if ( $category['parts'][$i] ) {
?><a href="category.php?category=<?= $category['categoryid'] ?>&part=<?= $i ?>">
<?php
$class = $data['csip']['category'][ $category['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
?>
Edit
<?php } else { ?>
view
<?php } ?>
</a><?php
      }
?></td>
<?php
    }
?>
<?php
if ( $data['csip']['version'] < 6 ) {
?>
<td><?php if ( $category['category_type'] != 1 ) { ?><a href="goal_list.php?category=<?= $category['categoryid'] ?>">
<?php
$class = $data['csip']['category'][ $category['categoryid'] ]['category_class'];
if ( ( $data['_session']['CAN_update_csip'] && ( $class == 'CSIP' || $class == 'OPT' ) ) || 
     ( $data['_session']['CAN_update_sap'] && ( $class == 'SAP' || $class == 'MAND' ) ) ||
     ( $class == 'OTHR' && ( $data['_session']['CAN_update_sap'] || $data['_session']['CAN_update_csip'] ) ) ) {
?>
Edit
<?php } else { ?>
view
<?php } ?>
</a><?php } ?></td><?php } ?>
<?php
      if ( $category['needs_principal_approve'] ) {
	if ( $data['csip']['category'][ $category['categoryid'] ]['principal_approved'] ) {
?><td class="complete">
<input type="button" disabled="disabled" value="Y">
</td><?php
	} else {
?>
<td class="incomplete">
<form method="post" action="approve.php" class="inline">
<input type="hidden" name="category" value="<?= $category['categoryid'] ?>">
<input type="hidden" name="level" value="principal">
<input type="submit" name="op" value="N"<?php if ( ! $data['principal'] ) { ?> disabled="disabled"<?php } ?>>
</form>
</td>
<?php
	}
      } else {
?>
<td></td>
<?php
      }
?>
<!--
<?php
      if ( $category['needs_community_approve'] ) {
	if ( $data['csip']['category'][ $category['categoryid'] ]['community_approved'] ) {
?><td class="complete">
<input type="button" disabled="disabled" value="Y">
</td><?php
	} else {
?>
<td class="incomplete">
<form method="post" action="approve.php" class="inline">
<input type="hidden" name="category" value="<?= $category['categoryid'] ?>">
<input type="hidden" name="level" value="community">
<input type="submit" name="op" value="N"<?php if ( ! $data['principal'] ) { ?> disabled="disabled"<?php } ?>>
</form>
</td>
<?php
	}
      } else {
?>
<td></td>
<?php
      }
?>
<?php
      if ( $category['needs_district_approve'] ) {
	if ( $data['csip']['category'][ $category['categoryid'] ]['district_approved'] ) {
?><td class="complete">
<input type="button" disabled="disabled" value="Y">
</td><?php
	} else {
?>
<td class="incomplete">
<form method="post" action="approve.php" class="inline">
<input type="hidden" name="category" value="<?= $category['categoryid'] ?>">
<input type="hidden" name="level" value="district">
<input type="submit" name="op" value="N"<?php if ( ! $data['district'] ) { ?> disabled="disabled"<?php } ?>>
</form>
</td>
<?php
	}
      } else {
?>
<td></td>
<?php
      }
?>
<td class="<?php echo ( $category['progress_percent'] == 0 && $category['category_type'] != 1 ) ? 'incomplete' : ( ( $category['progress_percent'] == 100 || $category['category_type'] == 1 ) ? 'complete' : 'working' ); ?>"><?= $category['progress_percent'] ?>%</td>
<td class="<?php echo ( $category['report_percent'] == 0 && $category['category_type'] != 1 ) ? 'incomplete' : ( ( $category['report_percent'] == 100 || $category['category_type'] == 1 ) ? 'complete' : 'working' ); ?>"><?= $category['report_percent'] ?>%</td>
 -->
</tr>

<?php
  }
}
?>
</tbody>
</table>

<?php include( 'csip-close.php' ); ?>
<?php include( 'doc-close.php' ); ?>
