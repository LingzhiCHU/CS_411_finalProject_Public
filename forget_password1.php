<?php
  
  // link the website
  $link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  // choose database 
  mysql_select_db('searchengine_CSV_DB', $link);

  $admin_email = $_POST["input_email"];
  // $email = "sliu105@illinois.edu";
  $email = "travelmatecs411@gmail.com";
  $sql = "SELECT * FROM user WHERE emailAddr = '$admin_email'";
  $res = mysql_query($sql);
  

  if (mysql_num_rows($res) == 1) {
  //send email
  $data = mysql_fetch_assoc($res);
  # print("{$data['password']}");
  $content = "Hello ". $data['username'].",\nYour password is ".$data['password'];
  mail($admin_email, "Your Travelmate account password", $content, "From:" . $email);
  // //Email response
  echo "We sent your password to ".$admin_email.". Thank you for contacting us!";

?>

 <h3><a href="index.html">Back to Homepage</a> </h3>

<?php
  }
  
  else {
    echo "Sorry, your email address is incorrect.";
  }
  //if "email" variable is not filled out, display the form
  
?>
