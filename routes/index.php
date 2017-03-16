<?php

// function returns requested controller and method
function get_page($controller, $action) {
  require_once('controllers/' . $controller . '_controller.php');

  // cases for different controllers
  switch($controller) {
     case 'home':
       $a = new HomeController($controller);
       break;
     case 'activity':
       $a = new ActivityController($controller);
       break;
     case 'photos':
       $a = new PhotosController($controller);
       break;
     case 'user':
       $a = new UserController($controller);
       break;
  }

  // run action method
  $a->$action();
}

// list of controllers and actions
$controllers = array('home' => ['index', 'error'],
                     'activity' => ['index'],
                     'photos' => ['index'],
                     'user' => ['signin', 'signup', 'profile']);

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
