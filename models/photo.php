<?php

  class Photo {

    public $image;
    public $date;
    public $childid;

    public function __construct($image, $date, $childid) {
      $this->image = $image;
      $this->date = $date;
      $this->childid = $childid;
    }

    public static function add_photo($image, $childid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO photos (image, childid) VALUES ('$image', '$childid')";

      // add photo to db
      mysqli_query($dbc, $query);

      // close connection
      mysqli_close($dbc);
    }

    // public static function all_photos() {
    //   // connect db
    //   require('models/db.php');
    //
    //   // build query
    //   $query = "";
    //
    //   // create data
    //   $data = mysqli_query($dbc, $query);
    //
    //   $photos = [];
    //
    //   // loop through data
    //   while ($row = mysqli_fetch_array($data)) {
    //     // $photo[] = new Photo;
    //   }
    // }
  }
