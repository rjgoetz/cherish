<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <section class="l-pad-top">
        <h2 class="border-bottom">My Profile</h2>

        <form action="" role="form" method="post">

          <div class="form-group">
            <label for="name" class="l-block">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="RJ Goetz">
          </div>

          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="name" class="form-control" placeholder="test@mydomain.com">
          </div>

          <button type="submit" class="btn">Update</button>

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
