<?php

  class Photo {

    public $photoid;
    public $image;
    public $date;
    public $child;

    public function __construct($photoid, $image, $date, $child) {
      $this->photoid = $photoid;
      $this->image = $image;
      $this->date = $date;
      $this->child = $child;
    }

    public static function add_photo($image, $userid, $kids, $comment) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO photos (image, userid) VALUES ('$image', '$userid')";

      // insert into photos db
      mysqli_query($dbc, $query);

      // retrieve last id generated "photoid"
      $photoid = mysqli_insert_id($dbc);

      // tag photos by child and insert into childphotos db
      foreach ($kids as $kid) {
        $query = "INSERT INTO childphotos (photoid, childid) VALUES ('$photoid', '$kid')";
        mysqli_query($dbc, $query);
      }

      // add comment if present
      if (!empty($comment)) {
        Comment::add_comment($comment, $photoid, $userid);
      }

      // close connection
      mysqli_close($dbc);
    }

    public static function all_photos($userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT pt.photoid, pt.image, EXTRACT(month from date) AS month, EXTRACT(day from date) AS day, EXTRACT(year from date) as year, GROUP_CONCAT(kt.name) AS child FROM photos AS pt INNER JOIN childphotos USING (photoid) INNER JOIN kids AS kt USING (childid) WHERE pt.userid='$userid' GROUP BY pt.photoid";

      // create data
      $data = mysqli_query($dbc, $query);

      $photos = [];

      // loop through data
      while ($row = mysqli_fetch_array($data)) {
        $photos[] = new Photo($row['photoid'], $row['image'], $row['month'] . '/' . $row['day'] . '/' . $row['year'], $row['child']);
      }

      // close db
      mysqli_close($dbc);

      return $photos;
    }
  }
