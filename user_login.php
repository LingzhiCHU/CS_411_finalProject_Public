
<?php

	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	# session_start();
	# print("hello");
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

	$sql = "SELECT * FROM user WHERE emailAddr = '$email' AND password = '$password_in'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

    # print($count);	
	
	if($count == 1) {
		# print("hello");
		# session_register("email");
		$data=mysql_fetch_assoc($result);
		
		# print($data['username']);
		// session_start();
		// print(session_id());
		// $_SESSION['login_user'] = $email;
		// $user_check = $_SESSION['login_user'];
		// print("Hello, ". $data['username']."!");
		
		# reservation($data['username']);
		// echo '<input name = "$input_name" type="submit" value="Reserve now" />';
		# echo '<a href="print_friends.php" class="button">Find travelmates</a>';
		 
		// echo '</form>';
		// find_friend($data['username']);
?> 
 <!-- <head>
      <title>Welcome, "$result" </title>
   </head> -->
	<body>
      <h1>Welcome <?php  echo $data['username']."!"; ?></h1> 
      <link rel="stylesheet" href="css/style.css">

      <h4> <a href="trip.html"> Book Hotels </h4>

      <form method="post" action="find_reservation.php">
      <input type="text" name="input_id" id="name" value= <?php echo $data['ID']?>  
      			style = "background-color:white; border: solid 1px #ffffff; color: #fff"/>
       <input type="submit" value="View My trips" />
       </form>

     <form method="post" action="print_friends.php">
     <input type="text" name="input_email" id="name" value= <?php echo $data['emailAddr']?>  
            size = "7" style = "background-color:white; border: solid 1px #ffffff; color: #fff"/>
      <input type="text" name="input_username" id="name" value= <?php echo $data['username']?> 
      		size = "7" style = "background-color:white; border: solid 1px #ffffff; color: #fff" />
       <input type="submit" value="Find Travelmates" />
       </form>
       <form method="post" action="after_delete.php">
     	<input type="text" name="input_email" id="name" style = "background-color:white; border: solid 1px #ffffff; color: #fff" 
     	value= <?php echo $data['emailAddr']?>  size = "10" />
      
       <input type="submit" value="Delete my account" />
       </form>
      	
      	<form method="post" action="recommendation.php">
     	<input type="text" name="input_email" id="name" style = "background-color:white; border: solid 1px #ffffff; color: #fff" 
     	value= <?php echo $data['emailAddr']?>  size = "10" />
      
       <input type="submit" value="View my recommendations" />
       </form>
      <h4><a href = "index.html">Sign Out</a></h4>
   </body>
<?php		
	}

	else {
		print ("Your email or password is incorrect. Please try again.");
		exit(1);
	}
?>
 
