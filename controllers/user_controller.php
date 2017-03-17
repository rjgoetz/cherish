<?php

  class UserController extends BaseController {

    public function signin() {
      $this->build_page('signin');
    }

    public function signup() {

      // check form was submitted
      if (!isset($_POST['submitted'])) {

        // not submitted
        $this->build_page('signup');

      } else {

        // check fields are not empty
        if (!isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['password2']) || empty($_POST['password2'])) {
          $this->alert('Please complete all the fields.', 'error');
          $this->build_page('signup');
        } else {
          // save form data
          $name = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $password2 = $_POST['password2'];
        }

        // validate name field
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
          $this->build_page('signup', $this->alert('Name cannot contain symbols.', 'error'));
        }

        // validate email field
        if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
          $this->build_page('signup', $this->alert('Email is invalid.', 'error'));
        }

        // check passwords match
        if ($password !== $password2) {
          $this->build_page('signup', $this->alert('Passwords do not match.', 'error'));
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->build_page('signup', $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error'));
        } else {

          // connect database
          require_once('models/db.php');

          // build query
          $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

          // add user to database
          mysqli_query($dbc, $query);

          // close db connection
          mysqli_close($dbc);

          $this->alert('Welcome to Cherish! Please sign in.', 'success');
          $this->redirect('user', 'signin');

        }

      }

    }

    public function profile() {
      $this->build_page('profile');
    }

  }
