<?php

  class ChildController extends BaseController {

    public function index() {
      $kids = Child::get_kids($_SESSION['familyid']);

      if (!empty($kids)) {
        $this->build_page('kids', $kids);
      } else {
        // redirect to add child
        $this->alert('Please add child to complete registration.', 'error');
        $this->redirect('child', 'add');
        exit();
      }
    }

    public function kid_photos() {
      $photos = Photo::kid_photos($_GET['kid']);
      $this->build_page('kid_photos', $photos);
    }

    public function add() {
      // check form was submitted
      if (!isset($_POST['submitted'])) {
        $kids = Child::get_kids($_SESSION['familyid']);
        // form not submitted
        $this->build_page('add-child', $kids);
      } else {

        // check name field is not empty
        if (empty($_POST['name'])) {
          $this->alert('Please complete all the fields.', 'error');
          $this->redirect('child', 'add');
          exit();
        } else {
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
          $this->redirect('child', 'add');
          exit();
        }

        // validate image
        if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' || $image_type == 'image/png' || $image_type == 'image/gif' && $image_size > 0 && $image_size <= $max_size) {

          if ($_FILES['image']['error'] == 0) {

            // move image to img folder
            move_uploaded_file($_FILES['photo']['tmp_name'], $image_target);
            
            Child::add_child($name, $image_name, $_SESSION['familyid']);

            $this->alert($name . ' added successfully.', 'success');
            $this->redirect('child', 'add');
          } else {
            $this->alert('Error uploading image.', 'error');
            $this->redirect('child', 'add');
          }
        } else {
          $this->alert('Image type or size error.', 'error');
          $this->redirect('child', 'add');
        }
      }
    }

  }
