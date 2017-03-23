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

      if (isset($_SESSION['userid']) || isset($_COOKIE['userid'])) {
        // logged in
        require_once('views/navigation.php');
        require_once('views/' . $page . '.php');
        require_once('views/footer.php');
      } else {
        // not logged in
        if ($page === 'signup') {
          require_once('views/signup.php');
          require_once('views/footer.php');
        } else {
          require_once('views/signin.php');
          require_once('views/footer.php');
        }
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
