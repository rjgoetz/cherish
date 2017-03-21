<?php

  class Comment {

    public $comment;
    public $user;

    public function __construct($comment, $user) {
      $this->comment = $comment;
      $this->user = $user;
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
      $query = "SELECT comment, name FROM comments INNER JOIN users USING(userid) WHERE photoid='$photoid'";

      // get data
      $data = mysqli_query($dbc, $query);
      $comments = [];

      while ($row = mysqli_fetch_array($data)) {
        $comments[] = new Comment($row['comment'], $row['name']);
      }

      // close connection
      mysqli_close($dbc);

      return $comments;
    }
  }
