<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash']; } ?>

      <section class="l-pad-top">
        <h2 class="border-bottom l-margin-bottom">Family Account Setup</h2>

        <div class="panel">
          <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=family&action=create'; ?>">
            <div class="panel-header-active clearfix">
              <p class="l-float-left">Create a New Family Account</p>
              <i class="text-green material-icons l-float-right">chevron_right</i>
            </div>
          </a>
        </div>

        <p class="text-bold text-center l-pad">or</p>

        <div class="panel l-margin-bottom">
          <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=family&action=index'; ?>">
            <div class="panel-header-active clearfix">
              <p class="l-float-left">Join an Existing Family Account</p>
              <i class="text-green material-icons l-float-right">chevron_right</i>
            </div>
          </a>
        </div>
      </section>

    </div>
  </div>
</div>
