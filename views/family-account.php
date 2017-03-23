<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-offset-sm-2 col-md-6 col-offset-md-3 col-lg-4 col-offset-lg-4">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

      <div class="row">
        <div class="col-xs-12 col-xs2-8 col-offset-xs2-2">
          <section class="l-pad-top">
            <h2 class="border-bottom">Family Account Setup</h2>

            <form action="<?php echo $_SERVER['PHP_SELF'] . '?controller=register&action=family&account=create'; ?>" role="form" method="post">
              <div class="panel-no-margin">
                <button class="panel-button clearfix" type="submit" name="submitted">
                  <p class="text-sm l-float-left">Create a New Family Account</p>
                  <i class="text-green material-icons l-float-right">chevron_right</i>
                </button>
              </div>
            </form>

            <!-- <p class="text-bold text-center">or</p>

            <form action="<?php // echo $_SERVER['PHP_SELF'] . '?controller=register&action=family&account=join'; ?>" role="form" method="post">
              <div class="panel">
                <button class="panel-button clearfix" type="submit" name="submitted">
                  <p class="l-float-left">Join an Existing Family Account</p>
                  <i class="text-green material-icons l-float-right">chevron_right</i>
                </button>
              </div>
            </form> -->

          </section>
        </div>
      </div>

    </div>
  </div>
</div>
