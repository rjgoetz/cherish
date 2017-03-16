<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($alert) { echo $alert; } ?>

      <section class="l-pad-top">
        <h2 class="border-bottom">Sign up</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] . '?controller=user&action=signup'; ?>" method="post" role="form">
          <div class="form-group">
            <label for="name" class="l-block">Name</label>
            <input type="name" id="name" name="name" class="form-control">
          </div>

          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="youremail@domain.com">
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

      </section>

    </div>
  </div>
</div>
