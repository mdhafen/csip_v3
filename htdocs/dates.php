
    <div class="uk-panel uk-panel-box">
        <h4><i class="uk-icon-calendar"></i> <strong>Expected Completion Dates</strong></h4>
<hr>
    <ul>
        <font size="1pt">
<?php
if ( !empty($data['csip']['due_dates']) ) {
   $dates = explode( "\n", $data['csip']['due_dates'] );
   foreach ( $dates as $date ) {
      echo "<li>$date</li>";
   }
}
?>
    </font></ul>
</div>