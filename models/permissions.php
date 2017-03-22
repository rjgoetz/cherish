<?php

  class Permissions {

    public static function admin($userid, $familyid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO permissions (userid, familyid, admin) VALUES ('$userid', '$familyid', 1)";

      // add admin to db
      mysqli_query($dbc, $query);

      // close db
      mysqli_close($dbc);
    }

    public static function check_dup($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT permid FROM permissions WHERE userid='$userid' AND admin=1";

      // get data
      $data = mysqli_query($dbc, $query);

      if (mysqli_num_rows($data) > 0) {
        return true;
      } else {
        return false;
      }
    }

    public static function get_adminid($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT familyid FROM permissions WHERE userid='$userid' and admin=1";

      // get data
      $data = mysqli_query($dbc, $query);
      $adminid = mysqli_fetch_array($data);

      return $adminid['familyid'];
    }

  }
