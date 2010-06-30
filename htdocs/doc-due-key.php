<?php if ( $data['csip'] ) { ?>
<div id="due_date_key">
<?php if ( $data['csip']['sap_due_date'] ) { ?>
SAP Goals Due: <?= date('m/d/Y', strtotime( $data['csip']['sap_due_date'] ) ) ?><br>
<?php } ?>
<?php if ( $data['csip']['csip_due_date'] ) { ?>
CSIP Goals Due: <?= date('m/d/Y', strtotime( $data['csip']['csip_due_date'] ) ) ?><br>
<?php } ?>
<?php if ( $data['csip']['board_due_date'] ) { ?>
Community Council Review: <?= date('m/d/Y', strtotime( $data['csip']['board_due_date'] ) ) ?><br>
<?php } ?>
<?php if ( $data['csip']['district_due_date'] ) { ?>
Board Review: <?= date('m/d/Y', strtotime( $data['csip']['district_due_date'] ) ) ?><br>
<?php } ?>
</div>
<?php } ?>
