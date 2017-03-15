<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cherish your family moments.</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
  <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
  <header class="page-header">
    <div class="row">
      <div class="col-xs-12">
        <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php'; ?>"><h1 class="logo">Cherish</h1></a>
      </div>
    </div>
  </header>
  <main>

  <?php require_once('routes/index.php'); ?>

  </main>

  <footer class="page-footer clearfix">
    <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php'; ?>"><i class="material-icons l-float-left <?php if ($controller == 'home') { echo 'active'; } ?>">home</i></a>

    <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php?controller=activity&action=index'; ?>"><i class="material-icons l-float-left <?php if ($controller == 'activity') { echo 'active'; } ?>">comment</i></a>

    <a href="<?php echo $SERVER['PHP_SELF'] . 'index.php?controller=photos&action=index'; ?>"><i class="material-icons l-float-left <?php if ($controller == 'photos') { echo 'active'; } ?>">add_a_photo</i></a>

    <a href=""><i class="material-icons l-float-left">person</i></a>
  </footer>
</body>
</html>
