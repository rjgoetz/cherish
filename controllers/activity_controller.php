<?php

  class ActivityController extends BaseController {

    public function index() {
      // check if logged in
      if (isset($_SESSION['userid']) || isset($_COOKIE['userid'])) {
        // get familyid's
        $familyid = Family::get_familyid($_SESSION['userid']);

        $comments = Comment::all_comments($familyid);
        $this->build_page('activity', $comments);
      } else {
        // not logged in
        $this->alert('You are not logged in. Please log in.', 'error');
        $this->redirect('user', 'signin');
      }
    }

  }
