<?php

// function returns requested controller and method
function get_page($controller, $action) {
  require_once('controllers/' . $controller . '_controller.php');

  // connect models
  require_once('models/user.php');
  require_once('models/child.php');
  require_once('models/photo.php');
  require_once('models/comments.php');
  require_once('models/family.php');
  require_once('models/permissions.php');

  // cases for different controllers
  switch($controller) {
     case 'home':
       $a = new HomeController($controller);
       break;
     case 'register':
       $a = new RegisterController($controller);
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
     case 'child':
       $a = new ChildController($controller);
       break;
     case 'family':
       $a = new FamilyController($controller);
       break;
  }

  // run action method
  $a->$action();
}

// list of controllers and actions
$controllers = array('home' => ['index', 'error'],
                     'register' => ['signup', 'family', 'kids'],
                     'activity' => ['index'],
                     'photos' => ['index'],
                     'user' => ['signin', 'signup', 'profile', 'logout'],
                     'child' => ['index', 'add', 'kid_photos'],
                     'family' => ['index', 'join']);

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
