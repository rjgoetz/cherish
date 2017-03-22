<?php

  class Comment {

    public $comment;
    public $user;
    public $date;
    public $image;

    public function __construct($comment, $user, $date, $image) {
      $this->comment = $comment;
      $this->user = $user;
      $this->date = $date;
      $this->image = $image;
    }

    public static function add_comment($comment, $photoid, $userid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "INSERT INTO comments (comment, photoid, userid) VALUES ('$comment', '$photoid', '$userid')";

      // add comment to db
      mysqli_query($dbc, $query);

      // close connection
      mysqli_close($dbc);
    }

    public static function get_comment($photoid) {
      // connect db
      require('models/db.php');

      // build query
      $query = "SELECT comment, name, EXTRACT(month from date) AS month, EXTRACT(day from date) AS day, EXTRACT(year from date) as year FROM comments INNER JOIN users USING(userid) WHERE photoid='$photoid'";

      // get data
      $data = mysqli_query($dbc, $query);
      $comments = [];

      while ($row = mysqli_fetch_array($data)) {
        $comments[] = new Comment($row['comment'], $row['name'], $row['month'] . '/' . $row['day'] . '/' . $row['year'], $row['image']);
      }

      // close connection
      mysqli_close($dbc);

      return $comments;
    }

    public static function all_comments($familyid) {
      // db connect
      require('models/db.php');

      // build query
      $query = "SELECT ct.comment AS comment, EXTRACT(month from ct.date) AS month, EXTRACT(day from ct.date) AS day, EXTRACT(year from ct.date) as year, pt.image AS image, ut.name AS name FROM photos AS pt INNER JOIN comments AS ct USING (photoid) INNER JOIN users AS ut USING (userid) WHERE";

      for ($i = 0; $i < count($familyid); $i++) {
        if ($i === count($familyid) - 1) {
          $query .= ' familyid=' . $familyid[$i]->familyid . '';
        } else {
          $query .= ' familyid=' . $familyid[$i]->familyid . ' OR';
        }
      }

      // get data
      $data = mysqli_query($dbc, $query);
      $comments = [];

      while ($row = mysqli_fetch_array($data)) {
        $comments[] = new Comment($row['comment'], $row['name'], $row['month'] . '/' . $row['day'] . '/' . $row['year'], $row['image']);
      }

      // close connection
      mysqli_close($dbc);

      return $comments;
    }

  }
