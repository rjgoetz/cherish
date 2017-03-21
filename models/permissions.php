<?php

  class Permissions {
    public static function admin($userid, $familyid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO permissions (userid, familyid) VALUES ('$userid', '$familyid')";

      // add admin to db
      mysqli_query($dbc, $query);

      // retrieve permid
      $permid = mysqli_insert_id($dbc);

      // build query
      $query = "UPDATE users SET permid='$permid' WHERE userid='$userid'";

      // update user with admin id
      mysqli_query($dbc, $query);

      // close db
      mysqli_close($dbc);
    }

    public static function get_familyid($permid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT familyid FROM permissions WHERE permid='$permid'";

      // get data
      $data = mysqli_query($dbc, $query);
      $row = mysqli_fetch_array($data);

      // close db
      mysqli_close($dbc);

      return $row['familyid'];
    }
  }
