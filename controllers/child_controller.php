<?php

  class ChildController extends BaseController {

    public function index() {
      // get familyid
      $familyid = Family::get_familyid($_SESSION['userid']);

      $kids = Child::get_kids($familyid);

      if (!empty($kids)) {
        $this->build_page('kids', $kids);
      } else {
        // redirect to add child
        $this->alert('Please add kid to complete registration.', 'error');
        $this->redirect('register', 'kids');
        exit();
      }
    }

    public function kid_photos() {
      $photos = Photo::kid_photos($_GET['kid']);
      $this->build_page('kid_photos', $photos);
    }

  }
