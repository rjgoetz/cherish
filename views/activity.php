<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php
        foreach ($data as $comment) {
      ?>

      <div class="activity clearfix border-bottom">
        <p class="l-float-left text-sm"><span class="text-bold"><?php echo $comment->user; ?>&nbsp;&nbsp;</span><?php echo $comment->comment; ?>&nbsp;&nbsp;<span class="text-sm text-grey"><?php echo $comment->date; ?></span></p>
        <img src="public/img/<?php echo $comment->image; ?>" alt="<?php echo $comment->image; ?>" class="l-float-right img-responsive">
      </div>

      <!-- <div class="activity clearfix border-bottom">
        <i class="material-icons text-red l-float-left">favorite</i>
        <p class="l-float-left text-sm"><span class="text-bold">Kristen, </span><span class="text-bold">RJ, and 3 others</span> like this post.&nbsp;&nbsp;<span class="text-sm text-grey">February 2, 2017</span></p>
        <img src="public/img/harold-lake-superior.jpg" alt="Harold Lake Superior" class="l-float-right img-responsive">
      </div> -->

      <?php
        }
        if (!$data) {
      ?>
      <div class="row l-pad-top">
        <div class="col-xs-12">
          <div class="panel">
            <div class="panel-header">
              <p>No comments...</p>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      ?>

    </div>
  </div>
</div>
