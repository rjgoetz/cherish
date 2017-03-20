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

    public static function get_kids($userid) {
      // connect database
      require('models/db.php');

      // build query
      $query = "SELECT * FROM kids WHERE userid='$userid'";

      // get data
      $data = mysqli_query($dbc, $query) or die('query failed');

      $kids = [];

      while ($row = mysqli_fetch_array($data)) {
        $kids[] = new Child($row['childid'], $row['name'], $row['image']);
      }

      // close connection
      mysqli_close($dbc);

      return $kids;
    }

    public static function add_child($name, $image, $userid) {
      // connect database
      require('models/db.php');

      // build query
      $query = "INSERT INTO kids (name, image, userid) VALUES ('$name', '$image', '$userid')";

      // add child to db
      mysqli_query($dbc, $query);

      // close connection
      mysqli_close($dbc);
    }
  }
