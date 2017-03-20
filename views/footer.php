  </main>

  <?php
    if (isset($_SERVER['userid']) || isset($_COOKIE['userid'])) {
  ?>
  <footer class="page-footer clearfix">
    <div class="row">
      <div class="col-xs-3">
        <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php'; ?>"><i class="material-icons l-float-left <?php if ($this->controller == 'home') { echo 'active'; } ?>">home</i></a>
      </div>

      <div class="col-xs-3">
        <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php?controller=activity&action=index'; ?>"><i class="material-icons l-float-left <?php if ($this->controller == 'activity') { echo 'active'; } ?>">comment</i></a>
      </div>

      <div class="col-xs-3">
        <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php?controller=photos&action=index'; ?>"><i class="material-icons l-float-left <?php if ($this->controller == 'photos') { echo 'active'; } ?>">add_a_photo</i></a>
      </div>

      <div class="col-xs-3">
        <a href="<?php
          if (isset($_SESSION['userid'])) {
            echo $SERVER['PHP_SELF'] . 'index.php?controller=user&action=profile';
          } else {
            echo $SERVER['PHP_SELF'] . 'index.php?controller=user&action=signin';
          }
        ?>"><i class="material-icons l-float-left <?php if ($this->controller == 'user') { echo 'active'; } ?>">person</i></a>
      </div>
    </div>
  </footer>
  <?php
    }
  ?>

  <script src="public/js/main.js"></script>
</body>
</html>
