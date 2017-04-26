<html>
<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	# session_start();

	$email = $_POST["input_email"];
	$password_in = $_POST["input_password"];

	// sanity check
	if ($email == "") {
		print("Username is empty! \r\n");
		exit(1);
	}

	if ($password_in == "") {
		print("Password is empty! \r\n");
		exit(1);
	}

	$sql = "SELECT ID FROM user WHERE emailAddr = '$email' AND password = '$password_in'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	# print($count);	
	
	if($count == 1) {
		# print("hello");
		# session_register("email");
		print("hello25");
		session_start();
		$_SESSION['login_user'] = $email;
		$user_check = $_SESSION['login_user'];
	}
	else {
		exit(1);
	}
?>
  <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <h2><a href = "user_logout.php">Sign Out</a></h2>
   </body>
</html>