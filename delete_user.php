<?php
  // link the website
  $link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  //echo "hello world";
  // choose database 
  mysql_select_db('searchengine_CSV_DB', $link);

  $email = $_POST['email'];
  $reserve = $_POST['reserve'];

  // find user id 
  $sql1 = "SELECT ID FROM user WHERE emailAddr = '$email'";
  $res1 = mysql_query($sql1);
  $data = mysql_fetch_assoc($res1);
  $id = $data['ID'];

  $sql = "DELETE FROM `user` WHERE emailAddr = '$email'";
  mysql_query($sql);


  if ($reserve == "Yes") {
  	$sql = "DELETE FROM reserved WHERE userID = '$id'";
  	mysql_query($sql);
  }


  // echo $email;
  // echo $reserve;
  // echo "hello";

?>

<h3>Your account have been removed! Goodbye. <br>
<a href = "index.html">Back to homepage</a></h4>