<?php

  class FamilyController extends BaseController {

    public function index() {
      $this->build_page('family');
    }

    public function create() {
      // create family and return familyid
      $familyid = Family::create_family($_SESSION['userid']);

      // save familyid into session
      $_SESSION['familyid'] = $familyid;
      setcookie('familyid', $familyid, time() + 365*24*60*60);

      $this->alert('New family account created.', 'success');
      $this->redirect('child', 'add');
    }

    public function join() {

    }

  }
