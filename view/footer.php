<hr>
<div class="clearfix">
  <div class="uk-width-1-2 uk-container-center uk-text-center">
  <?php
      foreach ( $data['_config']['footer_logos'] as $logo ) {
        echo '<img class="uk-align-center uk-display-inline uk-margin-left" src="' . $logo . '">';
      }
  ?>
  </div>
  <div class="uk-align-right" style="font-size: 9pt;">
    <p>Developed for <strong>Washington County School District</strong> | A joint venture, powered by <img src="<?= $data['_config']['base_url'] ?>images/blackplum_logo_small.png" width="70" alt="BlackPlum Logo"> <i class="uk-icon-plus"></i> <strong>HAFEN</strong>&copy; 2017 Washington County School District.</p>
  </div>
</div>
<br>
<br>
