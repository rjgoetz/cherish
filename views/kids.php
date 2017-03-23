<div class="container l-pad-top">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-offset-sm-2 col-md-6 col-offset-md-3 col-lg-4 col-offset-lg-4">
      <h2 class="border-bottom">Kids</h2>
    </div>
  </div>

  <div class="l-pad-bottom"></div>

  <?php
    foreach ($data as $kid) {
  ?>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-offset-sm-2 col-md-6 col-offset-md-3 col-lg-4 col-offset-lg-4">
      <a href="<?php echo $_SERVER['PHP_SELF'] . "?controller=child&action=kid_photos&kid=" . $kid->childid; ?>">
        <div class="panel l-margin-bottom">
          <div class="panel-header">
            <p class="text-bold"><?php echo $kid->name; ?></p>
            <i class="material-icons l-float-right">chevron_right</i>
          </div>
          <div class="panel-body">
            <img src="public/img/<?php echo $kid->image; ?>" alt="<?php echo $kid->name; ?>" class="img-responsive">
          </div>
        </div>
      </a>
    </div>
  </div>
  <?php
    }
  ?>
</div>
