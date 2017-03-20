<div class="container">
  <div class="row">
    <div class="col-xs-12 l-pad-bottom">
      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>
    </div>
  </div>
</div>

<?php
  foreach ($data as $photo) {
?>
<div class="panel">
  <div class="panel-header clearfix">
    <!-- <div class="profile-thb l-float-left"></div> -->
    <p class="text-bold text-sm l-float-left"><?php echo $photo->child; ?></p>
    <p class="text-xs text-grey l-float-right"><?php echo $photo->date; ?></p>
  </div>
  <div class="panel-body l-pad-bottom">
    <img class="img-responsive" src="public/img/<?php echo $photo->image; ?>" alt="<?php echo $photo->child; ?>">
    <div class="panel-action l-pad-top">
      <i class="material-icons active">favorite</i>
      <i class="material-icons">chat_bubble_outline</i>
    </div>
    <div class="panel-comments">
      <p><span class="text-bold">Kristen&nbsp;&nbsp;</span>Harold hanging out on the shores of Lake Superior!</p>
      <p class="text-sm text-grey">2 more comments</p>
    </div>
  </div>
</div>
<?php
  }
  if (!$data) {
?>
<div class="panel">
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=photos&action=index'; ?>">
    <div class="panel-header-active clearfix">
      <p class="text-bold text-sm l-float-left">Add your first photo!</p>
      <i class="text-green material-icons l-float-right">chevron_right</i>
    </div>
  </a>
</div>
<?php
  }
?>
