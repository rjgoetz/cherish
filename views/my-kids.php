<section class="l-pad">
  <div class="row l-pad-bottom">
    <div class="col-xs-12">
      <h2 class="border-bottom">My Kids</h2>

      <?php
        // get kids data
        $adminid = Permissions::get_adminid($_SESSION['userid']);
        $kids = Child::get_kids($adminid);

        if (!$kids) {
      ?>
      <p>Please add kids to finish registration.</p>
      <?php
      } else {
        foreach($kids as $kid) {
      ?>
      <div class="row l-pad-top">
        <div class="col-xs-4">
          <img class="img-responsive" src="public/img/<?php echo $kid->image; ?>" alt="<?php echo $kid->name; ?>">
        </div>
        <div class="col-xs-8">
          <p class="text-bold"><?php echo $kid->name; ?></p>
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>
  </div>

  <a href="<?php echo $_SERVER['PHP_SELF'] . '?controller=register&action=kids'; ?>" class="btn">Add Kid</a>
</section>
