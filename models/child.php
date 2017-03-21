<?php

  class Child {

    public $childid;
    public $name;
    public $image;

    public function __construct($childid, $name, $image) {
      $this->childid = $childid;
      $this->name = $name;
      $this->image = $image;
    }

    public static function get_kids($familyid) {
      // connect database
      require('models/db.php');

      // build query
      $query = "SELECT childid, kt.name AS name, image FROM kids AS kt INNER JOIN family USING (familyid) WHERE familyid='$familyid'";

      // get data
      $data = mysqli_query($dbc, $query);

      $kids = [];

      while ($row = mysqli_fetch_array($data)) {
        $kids[] = new Child($row['childid'], $row['name'], $row['image']);
      }

      // close connection
      mysqli_close($dbc);

      return $kids;
    }

    public static function add_child($name, $image, $familyid) {
      // connect database
      require('models/db.php');

      // build query
      $query = "INSERT INTO kids (name, image, familyid) VALUES ('$name', '$image', '$familyid')";

      // add child to db
      mysqli_query($dbc, $query);

      // close connection
      mysqli_close($dbc);
    }
  }
