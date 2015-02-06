<?php if ( $data['csip'] ) { ?>
<div id="due_date_key">
<?php if ( $data['csip']['version'] == 6 ) { ?>
October 7, 2014: Teams identify GVC for their courses (Question 1)<br>
October 7, 2014: Teams identify EXTENSION offerings (Question 4)<br>
October 30, 2014: Teams develop and administer 2 CFA's (Questions 2 & 3)<br>
November 2014: School Board reviews and approves CSIPs in Board Meeting<br>
March 2, 2015: Teams develop and administer 2 additional CFA's<br>
May 1, 2015: Teams complete REFLECTION process<br>
<?php } ?>
<?php if ( $data['csip']['version'] == 7 ) { ?>
October 2, 2015: Teams identify GVC for their courses (Question 1)<br>
October 2, 2015: Teams identify EXTENSION offerings (Question 4)<br>
October 30, 2015: Teams develop and administer 2 CFA's (Questions 2 & 3)<br>
November 2015: School Board reviews and approves CSIPs in Board Meeting<br>
February 5, 2016: Teams develop and administer 2 additional CFA's<br>
April 29, 2016: Teams complete REFLECTION process<br>
<?php } ?>
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
