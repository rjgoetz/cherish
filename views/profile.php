<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <?php if ($_SESSION['flash']) { echo $_SESSION['flash'];} ?>

      <section class="l-pad-top">

        <h2 class="border-bottom">My Profile</h2>

        <form action="<?php $_SERVER['PHP_SELF'] . '?controller=user&action=profile'; ?>" role="form" method="post">

          <div class="form-group">
            <label for="name" class="l-block">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $data[0]['user_name']; ?>">
          </div>

          <div class="form-group">
            <label for="email" class="l-block">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $data[0]['email']; ?>">
          </div>

          <button type="submit" class="btn" name="submitted">Update</button>

        </form>
      </section>

      <section class="l-pad">
        <div class="row l-pad-bottom">
          <div class="col-xs-12">
            <h2 class="border-bottom">My Kids</h2>

            <?php
              foreach($data as $kid) {
            ?>
            <div class="row l-pad-top">
              <div class="col-xs-4">
                <img class="img-responsive" src="public/img/<?php echo $kid['image']; ?>" alt="<?php echo $kid['child_name']; ?>">
              </div>
              <div class="col-xs-8">
                <p class="text-bold"><?php echo $kid['child_name']; ?></p>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>

        <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=child&action=add'; ?>" class="btn l-block">Add Kid</a>
      </section>

      <div class="l-pad">
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=user&action=logout'; ?>" class="btn btn-wide clearfix l-block"><i class="material-icons l-float-right">exit_to_app</i>Log Out</a>
      </div>

    </div>
  </div>
</div>
