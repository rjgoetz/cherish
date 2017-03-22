<?php
  if (!empty($data)) {
?>
<div class="container">
  <div class="row l-pad-top">
    <div class="col-xs-12">
      <h2 class="border-bottom"><?php echo $data[0]->child; ?></h2>
    </div>
  </div>
</div>
<?php
    foreach ($data as $photo) {
?>
<div class="panel">
  <div class="panel-header-dark clearfix">
    <p class="text-xs l-float-right"><?php echo $photo->date; ?></p>
  </div>
  <div class="panel-body l-pad-bottom">
    <img class="img-responsive" src="public/img/<?php echo $photo->image; ?>" alt="<?php echo $photo->child; ?>">
    <div class="panel-action l-pad-top">
      <i class="material-icons active">favorite</i>
      <i class="material-icons">chat_bubble_outline</i>
    </div>
    <?php require('views/comments.php'); ?>
  </div>
</div>
<?php
    }
?>
<div class="panel l-margin">
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=child&action=index'; ?>">
    <div class="panel-header-active clearfix">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <p>All Kids</p>
            <i class="text-green material-icons l-float-left">chevron_left</i>
          </div>
        </div>
      </div>
    </div>
  </a>
</div>
<?php
  } else {
?>
<div class="container">
  <div class="row l-pad-top">
    <div class="col-xs-12">
      <div class="panel">
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=child&action=index'; ?>">
          <div class="panel-header-active clearfix">
            <p>No photos...</p>
            <i class="text-green material-icons l-float-left">chevron_left</i>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>
