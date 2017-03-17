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
          $this->alert('Name cannot contain numbers or symbols.', 'error');
          $this->build_page('signup');
        }

        // validate email field
        if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
          $this->alert('Email is invalid format.', 'error');
          $this->build_page('signup');
        }

        // check passwords match
        if ($password !== $password2) {
          $this->alert('Passwords do not match.', 'error');
          $this->build_page('signup');
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error');
          $this->build_page('signup');
        } else {
          // check for duplicate user
          $duplicate = User::duplicate_user($email);

          if ($duplicate) {
            $this->alert('The email address you provided is already in the database.', 'error');
            $this->build_page('signup');
          } else {
            // encrypt password
            $options = ['cost' => 12];
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            // add user to DB
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

        // are fields empty?
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
          $this->alert('Email is invalid.', 'error');
          $this->build_page('signin');
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error');
          $this->build_page('signin');
        } else {

          // authorize user
          $user = User::auth_user($email, $password);

          switch($user) {
            case 'unauthorized':
              $this->alert('Password is incorrect. Try again.', 'error');
              $this->build_page('signin');
              break;
            case 'not found':
              $this->alert('Email address not found.', 'error');
              $this->build_page('signin');
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

      // check if logged in
      if (isset($_SESSION['userid']) || isset($_COOKIE['userid'])) {
        $user = User::retrieve_user($_SESSION['userid']);

        // form was not submitted
        if (!isset($_POST['submitted'])) {

          if ($user) {
            $this->build_page('profile', $user);
          } else {
            // redirect sign in
            $this->alert('Profile access denied. Please log in.', 'error');
            $this->redirect('user', 'signin');
          }

        } else {
          // form was submitted
          // are fields empty?
          if (!isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['email']) || empty($_POST['email'])) {
            $this->alert('Fields cannot be empty.', 'error');
            $this->build_page('profile', $user);
          } elseif ($_POST['name'] === $user->name && $_POST['email'] === $user->email) {
            // check if fields changed
            $this->build_page('profile', $user);
          } else {
            // save form data
            $name = $_POST['name'];
            $email = $_POST['email'];

            // validate name field
            if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
              $this->alert('Name cannot contain numbers or symbols.', 'error');
              $this->build_page('profile', $user);
              return;
            }

            // validate email field
            if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
              $this->alert('Email is invalid format.', 'error');
              $this->build_page('profile', $user);
              return;
            }

            // check for duplicate email
            if ($email !== $user->email) {
              $duplicate = User::duplicate_user($email);

              if ($duplicate) {
                $this->alert('The email address you provided is already in the database.', 'error');
                $this->build_page('profile', $user);
                return;
              }
            }

            // update user profile
            $data = User::update_user($_SESSION['userid'], $name, $email);

            if ($data) {
              $user->name = $name;
              $user->email = $email;

              $this->alert('Profile updated.', 'success');
              $this->build_page('profile', $user);
            } else {
              $this->alert('Error updating profile.', 'error');
              $this->build_page('profile', $user);
            }
          }
        }
      } else {
        // not logged in
        $this->alert('You are not logged in. Please log in.', 'error');
        $this->redirect('user', 'signin');
      }
    }

    public function logout() {
      if (isset($_SESSION['userid'])) {
        // reset session variable
        $_SESSION = array();

        if (isset($_COOKIE['userid'])) {
          // setcookie to expire
          setcookie('userid', '', 1);
        }

        // redirect to sign in
        $this->alert('You are logged out.', 'success');
        $this->redirect('user', 'signin');
      }
    }

  }
