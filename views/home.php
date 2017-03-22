<div class="container">
  <div class="row">
    <div class="col-xs-12 l-pad-bottom">
      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>
    </div>
  </div>
</div>

<?php
  foreach ($data as $photo) {
    $kid_tags = explode(",", $photo->child);
?>
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
<?php
  }
  if (!$data) {
?>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="panel l-margin-bottom">
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=photos&action=index'; ?>">
          <div class="panel-header-active clearfix">
            <p class="l-float-left">Add a photo!</p>
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
