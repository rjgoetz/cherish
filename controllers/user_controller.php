<?php

  class UserController extends BaseController {

    public function signup() {

      // check form was submitted
      if (!isset($_POST['submitted'])) {

        // not submitted
        $this->build_page('signup');
      } else {

        // check fields are not empty
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2'])) {
          $this->alert('Please complete all the fields.', 'error');
          $this->build_page('signup');
          exit();
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
          exit();
        }

        // validate email field
        if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
          $this->alert('Email is invalid format.', 'error');
          $this->build_page('signup');
          exit();
        }

        // check passwords match
        if ($password !== $password2) {
          $this->alert('Passwords do not match.', 'error');
          $this->build_page('signup');
          exit();
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error');
          $this->build_page('signup');
          exit();
        } else {
          // check for duplicate user
          $duplicate = User::duplicate_user($email);

          if ($duplicate) {
            $this->alert('The email address you provided is already in the database.', 'error');
            $this->build_page('signup');
            exit();
          } else {
            // encrypt password
            $options = ['cost' => 12];
            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            // add user to DB and retrieve userid
            $userid = User::add_user($name, $email, $password);

            $_SESSION['userid'] = $userid;
            setcookie('userid', $userid, time() + 365*24*60*60);

            // redirect
            $this->redirect('family', 'index');
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
        if (empty($_POST['email']) || empty($_POST['password'])) {
          $this->alert('Please complete all the fields.', 'error');
          $this->build_page('signin');
          exit();
        } else {
          // save form data
          $email = $_POST['email'];
          $password = $_POST['password'];
        }

        // validate email field
        if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
          $this->alert('Email is invalid.', 'error');
          $this->build_page('signin');
          exit();
        }

        // validate password
        if (!preg_match('/^([a-zA-Z0-9@$!%*#?&]){6,}$/', $password)) {
          $this->alert('Password must be at least 6 characters long and contain letters, numbers, or symbols @$!%*#?&', 'error');
          $this->build_page('signin');
          exit();
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
              // retrieve familyid
              $familyid = Permissions::get_familyid($user->permid);

              // set session and cookie data
              $_SESSION['userid'] = $user->userid;
              $_SESSION['familyid'] = $familyid;
              setcookie('userid', $user->userid, time() + 365*24*60*60);
              setcookie('familyid', $familyid, time() + 365*24*60*60);

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
            // redirect to add child
            $this->alert('Please add child to complete registration.', 'error');
            $this->redirect('child', 'add');
            exit();
          }

        } else {
          // form was submitted
          // are fields empty?
          if (empty($_POST['name']) || empty($_POST['email'])) {
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
              exit();
            }

            // validate email field
            if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
              $this->alert('Email is invalid format.', 'error');
              $this->build_page('profile', $user);
              exit();
            }

            // check for duplicate email
            if ($email !== $user->email) {
              $duplicate = User::duplicate_user($email);

              if ($duplicate) {
                $this->alert('The email address you provided is already in the database.', 'error');
                $this->build_page('profile', $user);
                exit();
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
          setcookie('userid', '', 1);
        }

        if (isset($_COOKIE['permid'])) {
          setcookie('permid', '', 1);
        }

        // redirect to sign in
        $this->alert('You are logged out.', 'success');
        $this->redirect('user', 'signin');
      }
    }

  }
