<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="border-bottom l-pad-top">Kids</h2>
    </div>
  </div>

  <div class="row l-pad-top">

  <?php
    foreach ($data as $kid) {
  ?>
    <div class="col-xs-12">
      <a href="<?php echo $_SERVER['PHP_SELF'] . "?controller=child&action=kid_photos&kid=" . $kid->childid; ?>">
        <div class="panel">
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
  <?php
    }
  ?>
</div>
