<?php
session_start();

require_once('controllers/base_controller.php');

if (isset($_GET['controller']) || isset($_GET['action'])) {
  $controller = $_GET['controller'];
  $action = $_GET['action'];
} else {
  $controller = 'home';
  $action = 'index';
}

$page = new BaseController($controller);

$page->route($controller, $action);
