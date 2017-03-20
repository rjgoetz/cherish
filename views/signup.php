<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

      <section class="l-pad-top">
        <h2 class="border-bottom">Sign up</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?controller=user&action=signup'; ?>" method="post" role="form">
          <div class="form-group">
            <label for="name" class="l-block">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $_POST['name']; ?>" class="form-control">
          </div>

          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $_POST['email']; ?>">
          </div>

          <div class="form-group">
            <label for="password" class="l-block">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>

          <div class="form-group">
            <label for="password2" class="l-block">Confirm password</label>
            <input type="password" id="password2" name="password2" class="form-control">
          </div>

          <button type="submit" class="btn" name="submitted">Sign up</button>
        </form>

        <p class="l-pad-bottom"><a href="<?php echo $_SERVER['PHP_SELF'] . '?&controller=user&action=signin'; ?>">Already have an account?<span class="l-block text-bold">Sign in here.</span></a></p>
      </section>

    </div>
  </div>
</div>
