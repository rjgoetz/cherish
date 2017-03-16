<?php

  class UserController extends BaseController {

    public function signin() {
      $this->build_page('signin');
    }

    public function signup() {
      // check form was submitted
      if (!isset($_POST['submitted'])) {
        $this->build_page('signup');
      }

      // check fields are not empty
      if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2'])) {
        $this->build_page('signup', $this->alert('Please complete all the fields.', 'error'));
      }

      // save form data
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $password2 = $_POST['password2'];

      // validate name field
      if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $this->build_page('signup', $this->alert('Name cannot contain symbols.', 'error'));
      }

      // validate email field
      if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
        $this->build_page('signup', $this->alert('Email is invalid.', 'error'));
      }

      $this->redirect('user', 'signin');

    }

    public function profile() {
      $this->build_page('profile');
    }

  }
