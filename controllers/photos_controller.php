<?php

  class PhotosController extends BaseController {

    public function index() {
      // check if logged in
      if (isset($_SESSION['userid']) || isset($_COOKIE['userid'])) {
        $user = User::retrieve_user($_SESSION['userid']);

        // form was not submitted
        if (!isset($_POST['submitted'])) {

          if ($user) {
            $this->build_page('photos', $user);
          } else {
            // redirect to add child
            $this->alert('Please add child to complete registration.', 'error');
            $this->redirect('child', 'add');
            exit();
          }

        } else {
          // form was submitted
          // are checkboxes empty?
          if (empty($_POST['kids'])) {
            $this->alert('Please choose a kid to tag in your photo.', 'error');
            $this->redirect('photos', 'index');
          } else {
            // save form data
            $kids = $_POST['kids'];
            $comment = $_POST['comment'];

            // image variables
            $upload_path = 'public/img/';
            $max_size = 250000;
            $image_name = $_FILES['photo']['name'];
            $image_target = $upload_path . $image_name;
            $image_type = $_FILES['photo']['type'];
            $image_size = $_FILES['photo']['size'];

            if ($image_type == 'image/jpeg' || $image_type == 'image/pjpeg' || $image_type == 'image/png' || $image_type == 'image/gif' && $image_size > 0 && $image_size <= $max_size) {

              if ($_FILES['image']['error'] == 0) {

                // move image to img folder
                move_uploaded_file($_FILES['photo']['tmp_name'], $image_target);

                // add photo to db
                Photo::add_photo($image_name, $_SESSION['userid'], $kids, $comment);                

                $this->alert('Photo added successfully.', 'success');
                $this->redirect('photos', 'index');
              } else {
                $this->alert('Error uploading image.', 'error');
                $this->redirect('photos', 'index');
              }
            } else {
              $this->alert('Image type or size error.', 'error');
              $this->redirect('photos', 'index');
            }
          }
        }
      } else {
        // not logged in
        $this->alert('You are not logged in. Please log in.', 'error');
        $this->redirect('user', 'signin');
      }
    }

  }
