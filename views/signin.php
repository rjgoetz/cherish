<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($alert) { echo $alert; } ?>

      <section class="l-pad-top">
        <h2 class="border-bottom">Sign in</h2>

        <form action="" method="post" role="form">
          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="email" class="form-control">
          </div>

          <div class="form-group">
            <label for="password" class="l-block">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>
          <button type="submit" class="btn">Sign In</button>
        </form>

        <p><a href="<?php echo $_SERVER['PHP_SELF'] . '?&controller=user&action=signup'; ?>">Don't have an account?<span class="l-block text-bold">Sign up here.</span></a></p>
      </section>

    </div>
  </div>
</div>
