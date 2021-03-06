<div class="container">
  <div class="row">
    <div class="col-xs-12 col-xs2-8 col-offset-xs2-2 col-md-6 col-offset-md-3 col-lg-4 col-offset-lg-4">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash'];} ?>

      <section class="l-pad-top">

        <h2 class="border-bottom">My Profile</h2>

        <form action="<?php $_SERVER['PHP_SELF'] . '?controller=user&action=profile'; ?>" role="form" method="post">

          <div class="form-group">
            <label for="name" class="l-block">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $data->name; ?>">
          </div>

          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $data->email; ?>">
          </div>

          <button type="submit" class="btn" name="submitted">Update</button>

        </form>
      </section>

      <?php require_once('views/my-kids.php'); ?>

      <div class="l-pad">
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=user&action=logout'; ?>" class="btn btn-wide clearfix l-block"><i class="material-icons l-float-right">exit_to_app</i>Log Out</a>
      </div>

    </div>
  </div>
</div>
