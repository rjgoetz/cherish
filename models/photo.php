<?php

  class Photo {

    public $image;
    public $date;
    public $child;

    public function __construct($image, $date, $child) {
      $this->image = $image;
      $this->date = $date;
      $this->child = $child;
    }

    public static function add_photo($image, $userid, $childid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO photos (image, userid) VALUES ('$image', '$userid')";

      // add photo to db
      mysqli_query($dbc, $query);

      // close connection
      mysqli_close($dbc);
    }

    public static function all_photos($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT DISTINCT pt.image, EXTRACT(MONTH FROM DATE) AS month, EXTRACT(DAY FROM date) AS day, EXTRACT(YEAR FROM date) AS year, kt.name AS child FROM photos AS pt INNER JOIN kids AS kt USING (childid) INNER JOIN users USING (userid) WHERE userid='$userid'";

      // create data
      $data = mysqli_query($dbc, $query);

      $photos = [];

      // loop through data
      while ($row = mysqli_fetch_array($data)) {
        $photos[] = new Photo($row['image'], $row['month'] . '/' . $row['day'] . '/' . $row['year'], $row['child']);
      }

      // close db
      mysqli_close($dbc);

      return $photos;
    }
  }
