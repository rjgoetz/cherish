<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

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

      <section class="l-pad">
        <h2 class="border-bottom">My Kids</h2>

        <div class="choose-kids-bar">
          <div class="profile-thb"></div>
          <div class="profile-thb"></div>
        </div>

        <a href="<?php echo $_SERVER['PHP_SELF'] . 'index.php?controller=profile&action=kid'; ?>" class="clearfix btn l-block text-center">Add Kid</a>
      </section>

    </div>
  </div>
</div>
