<?php
  if (!empty($data)) {
?>
<div class="container">
  <div class="row l-pad">
    <div class="col-xs-12">
      <h2 class="border-bottom"><?php echo $data[0]->child; ?></h2>
    </div>
  </div>
</div>
<?php
    foreach ($data as $photo) {
?>
<div class="panel">
  <div class="panel-header clearfix">
    <p class="text-bold text-sm l-float-left">
    <?php echo $photo->child; ?></p>
    <p class="text-xs text-grey l-float-right"><?php echo $photo->date; ?></p>
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
  } else {
?>
<div class="container">
  <div class="row l-pad-top">
    <div class="col-xs-12">
      <div class="panel">
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=photos&action=index'; ?>">
          <div class="panel-header-active clearfix">
            <p class="text-bold text-sm l-float-left">No photos... add a photo!</p>
            <i class="text-green material-icons l-float-right">chevron_right</i>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>
