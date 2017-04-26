<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$sql = "SELECT * FROM reserved";
	$res = mysql_query($sql);
	# $data = mysql_fetch_assoc($res);

	while ($data = mysql_fetch_assoc($res)){
		$hotel_name = $data['reservedHotel'];
		$sql1 = "SELECT ID FROM `TABLE 4` WHERE hotel_name = '$hotel_name'";
		$res1 = mysql_query($sql1);
		$data = mysql_fetch_assoc($res1);
		$newid = $data['ID'];

		$sql2 = "UPDATE reserved SET hotel_id = '$newid' WHERE reservedHotel = '$hotel_name'";
		mysql_query($sql2);
	}
?>