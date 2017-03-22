<?php

class HomeController extends BaseController {

  public function index() {
    // check if logged in
    if (isset($_SESSION['userid']) || isset($_COOKIE['userid'])) {
      // get familyid's
      $familyid = Family::get_familyid($_SESSION['userid']);

      $photos = Photo::all_photos($familyid);
      $this->build_page('home', $photos);
    } else {
      $this->redirect('user', 'signin');
    }
  }

  public function error() {
    $this->build_page('error');
  }

}
