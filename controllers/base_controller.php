<?php

  class BaseController {

    public $controller;

    public function __construct($controller) {
      $this->controller = $controller;
    }

    function alert($msg, $type) {

      switch ($type) {
        case 'error':
          $alert = '<div class="alert-error">';
          break;
        case 'success':
          $alert = '<div class="alert-success">';
          break;
      }

      $alert .= $msg;
      $alert .= '</div>';

      return $alert;
    }

    public function build_page($page, $alert = false) {
      require_once('views/header.php');
      require_once('views/' . $page . '.php');
      require_once('views/footer.php');
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
