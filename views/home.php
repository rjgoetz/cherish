<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-offset-sm-1 col-md-8 col-offset-md-2 col-lg-6 col-offset-lg-3 l-pad-bottom">
      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>
    </div>
  </div>
<?php
  foreach ($data as $photo) {
    $kid_tags = explode(",", $photo->child);
?>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-offset-sm-1 col-md-8 col-offset-md-2 col-lg-4 col-offset-lg-4">
      <div class="panel l-margin-bottom">
        <div class="panel-header clearfix">
          <p class="text-bold text-sm l-float-left">
          <?php
            for ($i = 0; $i < count($kid_tags); $i++) {
              if ($i === count($kid_tags) - 1) {
                echo $kid_tags[$i];
              } else {
                echo $kid_tags[$i] . ', '; }
              }
          ?></p>
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
    </div>
  </div>
<?php
  }
  if (!$data) {
?>
  <div class="row">
    <div class="col-xs-12 col-xs2-10 col-offset-xs2-1 col-md-8 col-offset-md-2 col-lg-4 col-offset-lg-4">
      <div class="panel-no-margin">
        <div class="panel-header">
          <p>No photos...</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>
