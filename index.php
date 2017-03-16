<?php

require_once('controllers/base_controller.php');

if (isset($_GET['controller']) || isset($_GET['action'])) {
  $controller = $_GET['controller'];
  $action = $_GET['action'];
} else {
  $controller = 'home';
  $action = 'index';
}

$page = new BaseController($controller);

if (http_response_code() === 301) {
  $page->redirect($controller, $action);
} else {
  $page->route($controller, $action);
}
