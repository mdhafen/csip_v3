<?php if ( $data['csip'] && ( $data['csip']['sap_due_date'] || $data['csip']['board_due_date'] || $data['csip']['csip_due_date'] || $data['csip']['district_due_date'] ) ) { ?>
<div id="due_date_key">
<?php if ( $data['csip']['sap_due_date'] ) { ?>
CSIP Due: <?= $data['csip']['sap_due_date'] ?><br>
<?php } ?>
<?php if ( $data['csip']['board_due_date'] ) { ?>
Community Council Review: <?= $data['csip']['board_due_date'] ?><br>
<?php } ?>
<?php if ( $data['csip']['csip_due_date'] ) { ?>
Assistant Superintendent Review: <?= $data['csip']['csip_due_date'] ?><br>
<?php } ?>
<?php if ( $data['csip']['district_due_date'] ) { ?>
Board Review: <?= $data['csip']['district_due_date'] ?><br>
<?php } ?>
</div>
<?php } ?>
