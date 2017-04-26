<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	

	// initialize w and b: 104 * 4 to ALL 0
	// gender, age, hotel location, hotel price
	$w = array(1, 1, 1, 1);
	$b = array(1, 1, 1, 1);

	$weight = array();
	$bias = array();
	for ($i = 0; $i < 104; $i++) {
		$weight[$i] = $w;
		$bias[$i] = $b; 
	}
	// $weight = array();
	// $bias = array();
		// for ($i = 0; $i < 4; $i++) {
		// for ($j = 0; $j < 104; $j++) {

	// train w and b
	$epoch = 10;
	while ($epoch > 0) {
	$sql = "SELECT * FROM user NATURAL JOIN reserved";
	$res = mysql_query($sql);
	while($data=mysql_fetch_assoc($res)) {
		// parse data
		// gender
		if ($data['gender'] == "M")
			$gender = 0;
		else 
			$gender = 1;

		// age
		if ($data['age'] == "0 to 20")
			$age = 0;
		else if ($data['age'] == "20 to 40")
			$age = 1;
		else
			$age = 2;

		// location
		// Query table 4!!!!!!!!!!!!!!
		$id = $data['hotel_id'];
		$sql1 = "SELECT region FROM `TABLE 4` WHERE ID = '$id'";
		$res1 = mysql_query($sql1);
		$data = mysql_fetch_assoc($res1);
		$region = $data['region'];

		// price 
		$sql1 = "SELECT price_per_room FROM `TABLE 4` WHERE ID = '$id'";
		$res1 = mysql_query($sql1);
		$data = mysql_fetch_assoc($res1);
		$price = $data['price'];
		if ($price < 60)
			$price = 0;
		else if ($price > 60 && $price < 120)
			$price = 1;
		else
			$price = 2;

		// calculate sample: x and y
		$x = array($gender, $age, $region, $price);
		$y = array();
		for ($i = 0; $i < 104; $i ++)
			$y[$i] = -1;
		$y[$id] = 1;


		$h = array();
		// find h
		for ($i = 0; $i < 104; $i++) {
			$h[$i] = $x[0] * $weight[0][$i] + $x[1] * $weight[1][$i]+ $x[2] * $weight[2][$i] + $x[3] * $weight[3][$i];
			if ($h[$i] > 0)
				$h[$i] = 1;
			else
				$h[$i] = -1;
		}

		// find alpha * (y - h)
		for ($i = 0; $i < 104; $i++) {
			for ($j = 0; $j < 4; $j ++) {
				// alpha = 0.1
				$diff = ($y[$i] - $h[$i]) * 0.1;
				echo $diff;
				$diff = $diff * $x[$j];
				$weight[$j][$i] = $weight[$j][$i] + $diff;
				$bias[$j][$i] = $bias[$j][$i] + $diff;
			}
		}
	}
	$epoch = $epoch - 1;
}
	// upload w and b to database
	for ($i = 0; $i < 4; $i++) {
		for ($j = 0; $j < 104; $j++) {
			$new_w = $weight[$i][$j];
			$new_b = $bias[$i][$j];
			$sql = "UPDATE `weight` SET `w`='$new_w' WHERE row = '$i' and col = '$j'";
			echo "row = ".$i.", col = ".$j. ", w = ".$weight[$i][$j]."\n";
			echo "row = ".$i.", col = ".$j. ", b = ".$bias[$i][$j]."\n";
			mysql_query($sql);
			mysql_query($sql);
			$sql = "UPDATE `bias` SET `b`='$new_b' WHERE row = '$i' and col = '$j'";
			mysql_query($sql);
		}
	}
?>