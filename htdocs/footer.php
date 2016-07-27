<hr>
<div class="clearfix">
  <div class="uk-width-1-2 uk-container-center" style="text-align: center;">
  <?php
    if ( empty($data['_config']['footer_logos']) ) {
      echo '<img width="95" class="uk-align-center" src="https://logos.washk12.org/wcsd_web_95.png">';
    } else {
      foreach ( $data['_config']['footer_logos'] as $logo ) {
        echo '<img width="95" src="' . $logo . '">';
      }
    }
  ?>
  </div>
  <div class="uk-align-right" style="font-size: 9pt;">
    <p>Developed for <strong>Washington County School District</strong> | A joint venture, powered by <img src="<?= $data['_config']['base_url'] ?>images/blackplum_logo_small.png" width="70" alt="BlackPlum Logo"> <i class="uk-icon-plus"></i> <strong>HAFEN</strong>&copy; 2015,2016 Jim Black, Cody Plumhof and Michael Hafen.</p>
  </div>
</div>
<br>
<br>
