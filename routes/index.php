<?php

// function returns requested controller and method
function get_page($controller, $action) {
  require_once('controllers/' . $controller . '_controller.php');

  // cases for different controllers
  switch($controller) {
     case 'home':
       require_once('models/photo.php');
       $a = new HomeController($controller);
       break;
     case 'activity':
       $a = new ActivityController($controller);
       break;
     case 'photos':
       require_once('models/user.php');
       require_once('models/child.php');
       require_once('models/photo.php');
       $a = new PhotosController($controller);
       break;
     case 'user':
       require_once('models/user.php');
       require_once('models/child.php');
       $a = new UserController($controller);
       break;
     case 'child':
       require_once('models/child.php');
       $a = new ChildController($controller);
       break;
  }

  // run action method
  $a->$action();
}

// list of controllers and actions
$controllers = array('home' => ['index', 'error'],
                     'activity' => ['index'],
                     'photos' => ['index'],
                     'user' => ['signin', 'signup', 'profile', 'logout'],
                     'child' => ['add']);

// find controller and action, retrieve page
if (array_key_exists($controller, $controllers)) {
  if (in_array($action, $controllers[$controller])) {
    get_page($controller, $action);
  } else {
    get_page('home', 'error');
  }
} else {
  get_page('home', 'error');
}
