<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('searchengine_CSV_DB', $link);

	$name = $_POST["input_name"];
	$location = $_POST["input_location"];
	$restaurant_type = $_POST["input_restaurant_type"];
	$food_recommend = $_POST["input_food"];

	if (strlen($name) == 0) {
		print("please type the name.\r\n");
	}
    else if (strlen($restaurant_type) == 0 ){
        print("please type the restaurant type.\r\n");
    }

    else if (strlen($food_recommend) == 0){
        print("please type the food recommened .\r\n");
    }

	

	else {
		
			// calculate new user id
			$tot_id = "SELECT * FROM `restaurant`";
			$res = mysql_query($tot_id);
			$new_id = mysql_num_rows($res) + 1;

			print ($new_id);
			$sql1 = "INSERT INTO `restaurant`(`name`, `location`, `restaurant_type`, `food_recommend`) VALUES ('$name', '$location', '$restaurant_type', '$food_recommend')";
			$res = mysql_query($sql1);
			if ($res < 1) {
				print ("Adding recommend failed.\r\n");
				print ($res);
			}
			else
				print ("Adding recommend succeeded. \r\n");
	
	}


	mysql_close($link);

?>