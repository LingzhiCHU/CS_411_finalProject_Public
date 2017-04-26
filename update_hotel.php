<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$name = $_POST["input_name"];
	$addr = $_POST["input_addr"];
	$new_name = $_POST["new_input_name"];
	$new_addr = $_POST["new_input_addr"];
	$new_price = $_POST["new_input_price"];
	$new_room = $_POST["new_input_room"];

	$host = $_POST['host_email'];


	if ($new_name == "" || $new_addr == "")
		print("Please enter valid name and address.\r\n");


	else{
	// echo "name = " . $name. "\r\n";
	// echo "address = " . $addr;
	// error check: if the hotel does not exist, do nothing
	$sql0 = "SELECT * FROM `TABLE 4` WHERE hotel_name LIKE '%$name%' AND address LIKE '%$addr%'";
	$res0 = mysql_query($sql0);


	if ($res0 < 1) {
		print("No hotel found. Please try again.");	
	}
	$data = mysql_fetch_assoc($res0);
	$hotel_id = $data['ID'];
	// echo $hotel_id;
	// echo $host;
	$sql1 = "SELECT * FROM host_hotel WHERE host_email = '$host' AND hotel_id = '$hotel_id'";
	$res1 = mysql_query($sql1);
	$data =  mysql_fetch_assoc($res1);
	// echo $data['hotel_id'];
	// echo $data['host_email'];
	// echo mysql_num_rows($res);
	if ($data['hotel_id'] == "" || $data['host_email'] == "") {
		print ("We did not find your hotel. Please try again.");
	}
	else {
		// print ("found ");
		$sql = "UPDATE `TABLE 4` SET `hotel_name` = '$new_name', `address` = '$new_addr', 
		`price_per_room` = '$new_price', `room_remaining` = '$new_room'
		WHERE `hotel_name` LIKE '%$name%' AND `address` LIKE '%$addr%'";

		$res = mysql_query($sql);
		if ($res < 1) 
			print("Update failed. Please try again.");
		else 
			print("Update succeeded.");
	}
}
	mysql_close($link);
?>
<h4><a href = "index.html">Back To Homepage</a></h4>
<a href = "host.html">Manage my hotels</a></h4>