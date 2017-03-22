<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

      <section class="l-pad-top">
        <h2 class="border-bottom">Sign in</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?controller=user&action=signin'; ?>" method="post" role="form">
          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $_POST['email']; ?>">
          </div>

          <div class="form-group">
            <label for="password" class="l-block">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>

          <button type="submit" class="btn" name="submitted">Sign In</button>
        </form>

        <p><a href="<?php echo $_SERVER['PHP_SELF'] . '?&controller=register&action=signup'; ?>">Don't have an account?<span class="l-block text-bold">Sign up here.</span></a></p>
      </section>

    </div>
  </div>
</div>
