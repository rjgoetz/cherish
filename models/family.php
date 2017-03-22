<?php

  class Family {

    public $familyid;

    public function __construct($familyid) {
      $this->familyid = $familyid;
    }

    public static function create_family($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO family (familyid) VALUES (0)";

      // add family to db
      mysqli_query($dbc, $query);

      // retrieve familyid
      $familyid = mysqli_insert_id($dbc);

      // close db
      mysqli_close($dbc);

      // create admin
      Permissions::admin($userid, $familyid);
    }

    public static function get_familyid($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT familyid FROM permissions WHERE userid='$userid'";

      // get data
      $data = mysqli_query($dbc, $query);

      $familyid = [];

      while ($row = mysqli_fetch_array($data)) {
        $familyid[] = new Family($row['familyid']);
      }

      return $familyid;
    }

  }
