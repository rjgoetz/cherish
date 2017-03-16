<?php

class HomeController extends BaseController {

  public function index() {
    $this->build_page('home');
  }

  public function error() {
    $this->build_page('error');
  }

}
