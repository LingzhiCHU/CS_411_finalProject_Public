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
	while($data=mysql_fetch_assoc($res)) {
		
		$name = $data['hotel_name'];
		$count = $data['room_remaining'];
		$hotelid = $data['ID'];
		// echo $hotelid."\n";
		while ($count > 0) {
			$date = $data['check_in'];
			for ($i = 0; $i < 32; $i = $i + 1) {
				$newid = ($count - 1) * 32 + $i;
				# echo "name = ".$name."newid = ".$newid 
				$sql1 = "INSERT INTO `hotel_reserve`(`name`, `id`, `date`, `hotel_id`) VALUES ('$name', '$newid', '$date', '$hotelid')";
				$res1 = mysql_query($sql1);
				$date = strtotime("+1 day", strtotime($date));
				$date = date("Y-m-d", $date);
			}
			$count = $count - 1;
	}
	}

?>