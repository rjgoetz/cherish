<?php

  class BaseController {

    public $controller;

    public function __construct($controller) {
      $this->controller = $controller;
    }

    public function alert($msg, $type) {
      switch ($type) {
        case 'error':
          $alert = '<div id="flash" class="alert-error">';
          break;
        case 'success':
          $alert = '<div id="flash" class="alert-success">';
          break;
      }

      $alert .= $msg;
      $alert .= '</div>';

      $_SESSION['flash'] = $alert;
    }

    public function build_page($page, $data = false) {
      require_once('views/header.php');

      // check logged in
      if (isset($_SESSION['userid']) || isset($_COOKIE['userid'])) {
        // check registration status
        $status = User::register_status($_SESSION['user']);

        if (isset($status)) {
          require_once('views/' . $page . '.php');
          require_once('views/footer.php');
        } else {
          $this->alert('Please finish registering', 'error');
          require_once('views/family-account.php');
        }

      } else {
        require_once('views/signin.php');
      }

      // unset flash from session
      unset($_SESSION['flash']);
    }

    public function route($controller, $action) {
      require_once('routes/index.php');
    }

    public function redirect($controller, $action) {
      $location = $_SERVER['PHP_SELF'] . '?controller=' . $controller . '&action=' . $action;

      header('Location: ' . $location);
      exit();
    }

  }
