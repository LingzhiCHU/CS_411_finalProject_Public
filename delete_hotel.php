<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$delete_name = $_POST["input_name"];
	$delete_addr = $_POST["input_addr"];
	$host = $_POST['host_email'];

	// delete function 
	if (strlen($delete_name) > 55) {
		print("Hotel name is too long.\r\n");
	}
	if (strlen($delete_addr) > 50) {
		print("Hotel address is too long.\r\n");
	}
	
	else {
		//print ("Hotel name = ".$delete_name.", hotel address = " . $delete_addr . "is deleted");
		$sql0 = "SELECT ID FROM `TABLE 4` WHERE  hotel_name LIKE '%$delete_name%' AND address LIKE '%$delete_addr%'";
		$res0 = mysql_query($sql0);
		$data = mysql_fetch_assoc($res0);
		$hotel_id = $data['ID'];

		$sql = "DELETE FROM `TABLE 4` 
			    WHERE hotel_name LIKE '%$delete_name%' AND address LIKE '%$delete_addr%'";
		$res = mysql_query($sql);


		$sql1 = "DELETE FROM `host_hotel` WHERE host_email = '$host' AND hotel_id = '$hotel_id'";
		mysql_query($sql1);

		if ($res < 1) {
			print("Deletion failed\r\n");
			print($res."result is returned.\r\n");
		}
		else
			print("Delete hotel name:" . $delete_name . ", address: " . $delete_addr . " succeeded.\r\n");
		//print the result: 
	}
	mysql_close($link);
?>

		<h4><a href = "index.html">Back to homepage</a> <br>
		<a href = "host.html">Manage my hotels</a></h4>

