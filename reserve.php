<?php
	
	if (isset($_REQUEST["submit"])) {
		// link the website
		
		$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		// choose database 
		mysql_select_db('searchengine_CSV_DB', $link);

		$email = $_POST['input_email'];
		$password = $_POST['input_password'];
		$hotel_id = $_POST['input_id'];
		$checkin = $_POST['input_checkin'];
		$checkout = $_POST['input_checkout'];
		$room_num = $_POST['input_room'];
		$share_email = $_POST['friend'];

		$hotel_id = rtrim($hotel_id, "/ ");
		$checkin = rtrim($checkin, "/ ");
		$checkout = rtrim($checkout, "/ ");
		$room_num = rtrim($room_num, "/ ");

		$checkin_back = $checkin;
		# echo "You entered:".$share_email;
		// echo $room_num;
	// echo $email;
	// echo $password;

	// echo "hotel:".$hotel_id;
	// echo "checkin".$checkin;
	// echo "checkout".$checkout;

		// check user email and password
		$sql0 = "SELECT * FROM user WHERE emailAddr = '$email' AND password = '$password'";
		$res0 = mysql_query($sql0);

		if (mysql_num_rows($res0) < 1) {
			echo "Wrong email address or password. Please try again.";
			exit(1);
		} 


		// make reservation
		// update hotel_reserve
		// reserve day by day
		while ($checkin != $checkout) {
			# echo "a day\n";
			$sql1 = "SELECT MAX(id) FROM `hotel_reserve` WHERE hotel_id = '$hotel_id' AND `date` = '$checkin'";
			$res1 = mysql_query($sql1);
			# echo "Result ".$res1;
			$data = mysql_fetch_assoc($res1);
			$max_id = $data['MAX(id)'];
			# echo "data: ".$data['MAX(id)'];
			$sql2 = "DELETE FROM `hotel_reserve` WHERE id = '$max_id' AND `date` = '$checkin' AND hotel_id = '$hotel_id'";
			$res2 = mysql_query($sql2);
			$checkin = strtotime("+1 day", strtotime($checkin));
			$checkin = date("Y-m-d", $checkin);
		}

		// add reservation to reserved database
		// find user id
		$sql2 = "SELECT ID, username FROM user WHERE emailAddr = '$email'";
		$res2 = mysql_query($sql2);
		$data2 = mysql_fetch_assoc($res2);
		$username = $data2['username'];
		$user_id = $data2['ID'];

		// find hotel name
		$sql3 = "SELECT hotel_name FROM `TABLE 4` WHERE ID = '$hotel_id'";
		$res3 = mysql_query($sql3);
		$data3 = mysql_fetch_assoc($res3);
		$hotel_name = $data3['hotel_name'];

		// determine shareEmail value
		if ($share_email == "Yes") 
			$share_email = 1;
		else
			$share_email = 0;

		// add to reserved
		$sql4 = "INSERT INTO `reserved`(`userID`, `username`, `reservedHotel`, `shareEmail`, `check_in`, `check_out`) 
				VALUES ('$user_id','$username','$hotel_name','$share_email','$checkin_back','$checkout')";
		mysql_query($sql4);
		
		// send email to user
		$from = "travelmatecs411@gmail.com";
		# $from = "minnie725@outlook.com";
		$to = $email;
		$subject = "Thank you for your order at Travelmate!";
		$content = "Hello ".$username.", \nHere's your order summary: \nHotel name: ".$hotel_name.
					";\nCheck in date: ".$checkin_back."; \nCheck out date: ".$checkout.
					". \nYou can view your reservation after logging in at Travelmate";
		mail($to, $subject, $content, "From:" . $from);

		echo "Thank you, your reservation has been processed!";

	}

?>

	<form method="post">
 	<h3> Your reservation is NOT completed yet! </h3>
 	<h4>Please enter your email: <input name= "input_email" type="text" /><br />
 	Please enter your Password: <input name= "input_password" type="password" /><br />
 	Do you want to connect to other travelmates who are traveling to your destination (if you choose yes, your email will be shared with them): <br />
 	<input type="radio" name="friend" value="Yes"> Yes, I would like to<br>
  	<input type="radio" name="friend" value="No"> Not this time<br> </h4>
 
 	<input name= "input_id" type="text" value = <?php echo $_POST['input_id'] ?>
 	       size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
 	<input name= "input_checkin" type="text" value = <?php echo $_POST['input_checkin'] ?>
 		   size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
 	<input name= "input_checkout" type="text" value = <?php echo $_POST['input_checkout'] ?>
 			size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
 	<input name= "input_room" type="text" value = <?php echo $_POST['input_guestnum'] ?>
 			size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
 	
  <input name = "submit" type="submit" value="Reserve!" /> 
  </form>
	
	<h4>Not a member yet? <a href="login_index.html">Sign up now</a> <br/>
	<a href="index.html">Back to homepage </a></h4>

<!--     <h3><a href="index.html" class="button">Back to home page</a> </h3>
    <h3><a href="login_index.html" class="button">Log in or Register</a> </h3> -->
<!--    </body>
   
</html> -->