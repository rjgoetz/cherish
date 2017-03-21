<?php

  class Family {

    public $familyid;
    public $userid;

    public function __construct($familyid, $userid) {
      $this->familyid = $familyid;
      $this->userid = $userid;
    }

    public static function create_family($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO family (userid) VALUES ('$userid')";

      // add family to db
      mysqli_query($dbc, $query);

      // retrieve familyid
      $familyid = mysqli_insert_id($dbc);

      // close db
      mysqli_close($dbc);

      // create admin
      Permissions::admin($userid, $familyid);

      return $familyid;
    }

  }
