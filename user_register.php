<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('searchengine_CSV_DB', $link);

	$name = $_POST["input_name"];
	$email = $_POST["input_email"];
	$password = $_POST["input_password"];
	$comfirm_password = $_POST["input_confirm_password"];

	if ($comfirm_password != $password) {
		print("Password does not match, please re-enter.\r\n");
	}

	// check email?
	else if (strlen($name) > 50){
		print("User name is too long, please re-enter. \r\n");
	}
	else if (strlen($password) > 50){
		print("Password is too long, please re-enter.\r\n");
	}

	else {
		// check duplicate email address
		$sql = "SELECT * FROM `user` WHERE `emailAddr` = '$email'";
		$res = mysql_query($sql);

		if (mysql_num_rows($res)>0)
			print("Registration failed. Your email is already registered. \r\n");

		else{
			// calculate new user id
			$tot_id = "SELECT * FROM `user`";
			$res = mysql_query($tot_id);
			$new_id = mysql_num_rows($res) + 1;

			print ($new_id);
			$sql1 = "INSERT INTO `user`(`ID`, `username`, `password`, `emailAddr`) VALUES ('$new_id', '$name', '$password', '$email')";
			$res = mysql_query($sql1);
			if ($res < 1) {
				print ("Adding user failed.\r\n");
				print ($res);
			}
			else
				print ("Adding user succeeded. \r\n");
	}
	}


	mysql_close($link);

?>