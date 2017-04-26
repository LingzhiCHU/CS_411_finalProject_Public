<?php

	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$sql = "SELECT * FROM `TABLE 4`";

	$res = mysql_query($sql);

	# $data=mysql_fetch_assoc($res);
	// for every hotel
	// $i = 0;
	while($data=mysql_fetch_assoc($res)) {
		$name = $data['hotel_name'];
		// $sql1 = "UPDATE `TABLE 4` SET ID = '$i' WHERE hotel_name = '$name'";
		// $res1 = mysql_query($sql1);
		// $i = $i + 1;
		

		$id = $data['ID'];
		// print('$name'."  ");
		// print('$id');
		// set ids in hotel_reserve
		$sql1 = "UPDATE `hotel_reserve` SET `hotel_id`='$id' WHERE name = '$name'";
		$res1 = mysql_query($sql1);
	}

?>