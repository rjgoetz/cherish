<?php

  class User {

    public $userid;
    public $name;
    public $email;

    public function __construct($userid, $name, $email) {
      $this->userid = $userid;
      $this->name = $name;
      $this->email = $email;
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

    public static function add_user($name, $email, $password) {
      // connect database
      require('models/db.php');

      // build query
      $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

      // add user to database
      mysqli_query($dbc, $query);

      // retrieve userid
      $query = "SELECT userid FROM users WHERE email='$email'";

      // save userid
      $data = mysqli_query($dbc, $query);

      // close db connection
      mysqli_close($dbc);

      return mysqli_fetch_array($data);
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
          $user = new User($row['userid'], $row['name'], $row['email']);
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
      $query = "SELECT ut.name AS user_name, ut.email, ct.name AS child_name, ct.image, ct.childid FROM users AS ut INNER JOIN kids AS ct USING (userid) WHERE userid='$userid'";

      // create data
      $data = mysqli_query($dbc, $query);

      // close db connection
      mysqli_close($dbc);

      // check user exists
      if (mysqli_num_rows($data) > 0) {
        $list = [];

        while ($row = mysqli_fetch_array($data)) {
          $list[] = array('user_name' => $row['user_name'], 'email' => $row['email'], 'child_name' => $row['child_name'], 'childid' => $row['childid'], 'image' => $row['image']);
        }

        return $list;
      } else {
        return false;
      }
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
