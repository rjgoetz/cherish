<?php

class HomeController {

  public function index() {
    require_once('views/home.php');
  }

  public function error() {
    require_once('views/error.php');
  }

}
