<?php
  $comments = Comment::get_comment($photo->photoid);
  foreach ($comments as $comment) {
?>

<div class="panel-comments">
  <p><span class="text-bold"><?php echo $comment->user; ?>&nbsp;&nbsp;</span><?php echo $comment->comment; ?></p>
  <p class="text-sm text-grey">2 more comments</p>
</div>
<?php
  }
?>
