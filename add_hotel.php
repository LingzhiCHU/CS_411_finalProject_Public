<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	//echo "hello world";
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);


	$host = $_POST['host_email'];
	# echo $host;
	$new_hotel = $_POST["input_name"];
	$address = $_POST["input_addr"];
	$price = $_POST["input_price"];
	$remain_num = $_POST["input_room"];

	$from = $_POST["input_from"];
	$to = $_POST["input_to"];

	if (strlen($new_hotel) > 55) {
		print("Hotel name is too long.<\br>");
	}
	else if (strlen($address) > 50) {
		print("Hotel address is too long.<\br>");
	}
	else if (strlen($remain_num) > 4) {
		print("Room remaining string is too long.<\br>");
	}
	else if ($from > $to) {
		print ("Please enter valid starting and ending time.");
	}
	else {
		$sql0 = "SELECT MAX(ID) FROM `TABLE 4`";
		$res0 = mysql_query($sql0);
		$data = mysql_fetch_assoc($res0);
		$newid = $data['MAX(ID)'] + 1;
		$sql = "INSERT INTO `TABLE 4`(`hotel_name`, `address`, `price_per_room`, `room_remaining`, check_in, check_out, ID) 
		VALUES ('$new_hotel', '$address', '$price', '$remain_num', '$from', '$to', '$newid')";
		$res=mysql_query($sql);
		$sql1 = "INSERT INTO `host_hotel`(`host_email`, `hotel_id`) VALUES ('$host', $newid)";
		mysql_query($sql1);
		if ($res < 1)
			print ("Add hotel " . $new_hotel . " " . $address . " failed.\r\n");
		else 
			print("Add hotel " . $new_hotel . " " . $address . " succeeded.\r\n");
?>
		<h4><a href = "index.html">Back to homepage</a> <br>
		<a href = "host.html">Manage my hotels</a></h4>

<?php
	}

	mysql_close($link);
?>