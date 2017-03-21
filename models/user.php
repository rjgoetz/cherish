<?php

  class User {

    public $userid;
    public $name;
    public $email;
    public $permid;

    public function __construct($userid, $name, $email, $permid) {
      $this->userid = $userid;
      $this->name = $name;
      $this->email = $email;
      $this->permid = $permid;
    }

    public static function add_user($name, $email, $password) {
      // connect database
      require('models/db.php');

      // build query
      $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

      // add user to database
      mysqli_query($dbc, $query);

      // retrieve userid
      $userid = mysqli_insert_id($dbc);

      // close db connection
      mysqli_close($dbc);

      return $userid;
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
      } else {
        return false;
      }
    }

    public static function auth_user($email, $password) {
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

        $row = mysqli_fetch_array($data);

        // verify password
        if (password_verify($password, $row['password'])) {
          $user = new User($row['userid'], $row['name'], $row['email'], $row['permid']);
          return $user;
        } else {
          return 'unauthorized';
        }
      } else {
        return 'not found';
      }
    }

    public static function retrieve_user($userid) {
      // connect database
      require('models/db.php');

      // build query
      $query = "SELECT * FROM users WHERE userid='$userid'";

      // create data
      $data = mysqli_query($dbc, $query);
      $row = mysqli_fetch_array($data);

      // create user
      $user = new User($row['userid'], $row['name'], $row['email'], $row['permid']);

      // close db connection
      mysqli_close($dbc);

      return $user;
    }

    public static function update_user($userid, $name, $email) {
      // connect database
      require('models/db.php');

      // build query
      $query = "UPDATE users SET name='$name', email='$email' WHERE userid='$userid'";

      // create data
      $data = mysqli_query($dbc, $query);

      // close db connection
      mysqli_close($dbc);

      return $data;
    }

  } // end class
