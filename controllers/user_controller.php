<?php

  class UserController extends BaseController {

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
          $this->build_page('signup', $this->alert('Email is invalid format.', 'error'));
        }

        // check passwords match
        if ($password !== $password2) {
          $this->build_page('signup', $this->alert('Passwords do not match.', 'error'));
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->build_page('signup', $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error'));
        } else {
          // check for duplicate user
          $duplicate = User::duplicate_user($email);

          if ($duplicate) {
            $this->build_page('signup', $this->alert('The email address you provided is already in the database.', 'error'));
          } else {
            // encrypt password
            $options = ['cost' => 12];
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            // add user to DB
            // $user->add_user($name, $email, $password);
            User::add_user($name, $email, $password);

            // redirect
            $this->alert('Welcome to Cherish! Please sign in.', 'success');
            $this->redirect('user', 'signin');
          }
        }
      }
    }

    public function signin() {

      // check form was submitted
      if (!isset($_POST['submitted'])) {

        // not submitted
        $this->build_page('signin');
      } else {

        // check fields are not empty
        if (!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])) {
          $this->alert('Please complete all the fields.', 'error');
          $this->build_page('signin');
        } else {
          // save form data
          $email = $_POST['email'];
          $password = $_POST['password'];
        }

        // validate email field
        if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
          $this->build_page('signin', $this->alert('Email is invalid.', 'error'));
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->build_page('signin', $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error'));
        } else {

          // authorize user
          $user = User::auth($email, $password);

          switch($user) {
            case 'unauthorized':
              $this->build_page('signin', $this->alert('Password is incorrect. Try again.', 'error'));
              break;
            case 'not found':
              $this->build_page('signin', $this->alert('Email address not found.', 'error'));
              break;
            default:
              // set session and cookie data
              $_SESSION['userid'] = $user->userid;
              setcookie('userid', $user->userid, time() + 365*24*60*60);

              // redirect user home
              $this->alert('You successfully signed in.', 'success');
              $this->redirect('home', 'index');
              break;
          }
        }
      }
    }

    public function profile() {
      $this->build_page('profile');
    }

  }
