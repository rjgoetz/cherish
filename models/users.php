<?php

  class User {

    public $userid;

    public function __construct($userid) {
      $this->userid = $userid;
    }

    public static function duplicate_user($email) {
      // connect database
      require('models/db.php');

      // build query
      $query = "SELECT email FROM users WHERE email='$email'";

      // create data
      $data = mysqli_query($dbc, $query);

      // close db connection
      mysqli_close($dbc);

      // check for duplicate email
      if (mysqli_num_rows($data) > 0) {
        return true;
      }
    }

    public static function add_user($name, $email, $password) {
      // connect database
      require('models/db.php');

      // build query
      $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

      // add user to database
      mysqli_query($dbc, $query);

      // close db connection
      mysqli_close($dbc);
    }

    public static function auth($email, $password) {
      // connect database
      require('db.php');

      // build query
      $query = "SELECT * FROM users WHERE email='$email'";

      // create data
      $data = mysqli_query($dbc, $query);

      // close db connection
      mysqli_close($dbc);

      // check user exists
      if (mysqli_num_rows($data) > 0) {

        // verify password
        $row = mysqli_fetch_array($data);

        if (password_verify($password, $row['password'])) {
          $user = new User($row['userid']);
          return $user;
        } else {
          return 'unauthorized';
        }
      } else {
        return 'not found';
      }
    }

  } // end class
