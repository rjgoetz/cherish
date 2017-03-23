<div class="container">
  <div class="row">
    <div class="col-xs-12 col-xs2-8 col-offset-xs2-2 col-md-6 col-offset-md-3 col-lg-4 col-offset-lg-4">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

      <section class="l-pad-top">

        <h2 class="border-bottom">Tag Kids in Photo</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?controller=photos&action=index'; ?>" role="form" method="post" enctype="multipart/form-data">

          <?php
            foreach($data as $kid) {
          ?>
          <div class="row l-pad-bottom">
            <div class="col-xs-4">
              <img class="img-responsive" src="public/img/<?php echo $kid->image; ?>" alt="<?php echo $kid->name; ?>">
            </div>
            <div class="col-xs-8">
              <div class="form-group">
                <input type="checkbox" id="kids" name="kids[]" value="<?php echo $kid->childid; ?>">
                <label for="kid"><?php echo $kid->name; ?></label>
              </div>
            </div>
          </div>
          <?php
            }
          ?>

          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">
          </div>

          <div class="form-group">
            <label for="comment" class="l-block">Comment</label>
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
          </div>

          <button type="submit" name="submitted" class="btn">Add Photo</button>

        </form>
      </section>

    </div>
  </div>
</div>
