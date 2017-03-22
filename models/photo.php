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

    public static function add_photo($image, $userid, $kids, $comment, $familyid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO photos (image, familyid) VALUES ('$image', '$familyid')";

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

    public static function all_photos($familyid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT pt.photoid, pt.image, EXTRACT(month from date) AS month, EXTRACT(day from date) AS day, EXTRACT(year from date) as year, GROUP_CONCAT(kt.name) AS child FROM photos AS pt INNER JOIN childphotos USING (photoid) INNER JOIN kids AS kt USING (childid) WHERE";

      for ($i = 0; $i < count($familyid); $i++) {
        if ($i === count($familyid) - 1) {
          $query .= ' pt.familyid=' . $familyid[$i]->familyid . '';
        } else {
          $query .= ' pt.familyid=' . $familyid[$i]->familyid . ' OR';
        }
      }

      $query .= ' GROUP BY pt.photoid ORDER BY pt.photoid DESC';

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

    public static function kid_photos($childid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT kt.name AS child, pt.image, pt.photoid, EXTRACT(month from date) AS month, EXTRACT(day from date) AS day, EXTRACT(year from date) as year FROM childphotos INNER JOIN photos AS pt USING (photoid) INNER JOIN kids AS kt USING (childid) WHERE childid='$childid' ORDER BY pt.photoid DESC";

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
