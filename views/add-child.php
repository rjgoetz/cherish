<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

      <section class="l-pad-top">

        <?php
          if (!empty($data)) {
        ?>
        <div class="row l-pad-bottom">
          <div class="col-xs-12">
            <h2 class="border-bottom">My Kids</h2>

            <?php
              foreach($data as $kid) {
            ?>
            <div class="row l-pad-top">
              <div class="col-xs-4">
                <img class="img-responsive" src="public/img/<?php echo $kid->image; ?>" alt="<?php echo $kid->name; ?>">
              </div>
              <div class="col-xs-8">
                <p class="text-bold"><?php echo $kid->name; ?></p>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
        <?php
          }
        ?>

        <h2 class="border-bottom">Add Kid</h2>

        <form action="<?php $_SERVER['PHP_SELF'] . '?controller=child&action=add'; ?>" method="post" role="form" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name" class="l-block">Name</label>
            <input type="text" id="name" name="name" class="form-control">
          </div>

          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">
          </div>

          <button type="submit" name="submitted" class="btn">Add Child</button>

        </form>

        <div class="l-pad">
        <?php
          if (!empty($data)) {
        ?>
          <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=home&action=index'; ?>" class="btn btn-wide clearfix l-block">Finish<i class="material-icons l-float-right">chevron_right</i></a>
        <?php
        }
        ?>
        </div>
      </section>

    </div>
  </div>
</div>
