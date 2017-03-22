<?php

class RegisterController extends BaseController
{

  public function signup() {
    if (!isset($_POST['submitted'])) {
      // form not submitted
      $this->build_page('signup');
    } else {
      // form submitted
      if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2'])) {
        // fields are empty
        $this->alert('Please complete all the fields.', 'error');
        $this->build_page('signup');
        exit();
      } else {
        // fields are not empty
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
          $this->redirect('register', 'family');
        }
      }
    }
  }

  public function family() {
    if (!isset($_POST['submitted'])) {
      // form not submitted
      $this->build_page('family-account');
    } else {
      // form submitted
      $account = $_GET['account'];

      if ($account === 'create') {
        // only one admin per user; check duplicates
        $admin = Permissions::check_dup($_SESSION['userid']);

        if ($admin) {
          $this->alert('Family account already created.', 'error');
          $this->redirect('register', 'kids');
        } else {
          Family::create_family($_SESSION['userid']);

          $this->alert('New family account created.', 'success');
          $this->redirect('register', 'kids');
        }

      } else {
        echo 'nothing yet';
      }
    }
  }

  public function kids() {
    // retrieve admin status and familyid
    $adminid = Permissions::get_adminid($_SESSION['userid']);

    // if administrator
    if ($adminid) {

      if (!isset($_POST['submitted'])) {
        // form not submitted
        $kids = Child::get_kids($adminid);
        $this->build_page('add-child', $kids);
      } else {
        // form submitted
        if (empty($_POST['name'])) {
          // fields are empty
          $this->alert('Please complete all the fields.', 'error');
          $this->redirect('child', 'add');
          exit();
        } else {
          // field are not empty
          // save form data
          $name = $_POST['name'];

          // image variables
          $upload_path = 'public/img/';
          $max_size = 250000;
          $image_name = $_FILES['photo']['name'];
          $image_target = $upload_path . $image_name;
          $image_type = $_FILES['photo']['type'];
          $image_size = $_FILES['photo']['size'];
        }

        // validate name field
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
          $this->alert('Name cannot contain numbers or symbols.', 'error');
          $this->redirect('register', 'kids');
          exit();
        }

        // validate image
        if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' || $image_type == 'image/png' || $image_type == 'image/gif' && $image_size > 0 && $image_size <= $max_size) {

          if ($_FILES['image']['error'] == 0) {

            // move image to img folder
            move_uploaded_file($_FILES['photo']['tmp_name'], $image_target);

            Child::add_child($name, $image_name, $adminid);

            $this->alert($name . ' added successfully.', 'success');
            $this->redirect('register', 'kids');
          } else {
            $this->alert('Error uploading image.', 'error');
            $this->redirect('register', 'kids');
          }
        } else {
          $this->alert('Image type or size error.', 'error');
          $this->redirect('register', 'kids');
        }
      }
    } else {
      $this->alert('Administrator access required.', 'error');
      $this->redirect('user', 'signin');
    }
  }

}
