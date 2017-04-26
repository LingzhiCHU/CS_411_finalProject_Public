<?php
	# include 'user_login.html';
	// // link the website
	// $link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	// if (!$link) {
	// 	die('Could not connect: ' . mysql_error());
	// }
	// // choose database 
	// mysql_select_db('searchengine_CSV_DB', $link);

	function find_friend($input) {
		// link the website
		$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		// choose database 
		mysql_select_db('searchengine_CSV_DB', $link);
		# print($input);
		$sql = "SELECT DISTINCT *
				FROM `user` NATURAL JOIN `reserved`
				/* choose the same hotel which was reserved by other users and exclude those who are reserved by themselves, then choose the people who reserved them and who wish to disclose their emails*/
				WHERE shareEmail = 1 AND reserved.username <> '$input' AND
				reservedHotel = (SELECT DISTINCT reservedHotel
								FROM `reserved`
								WHERE username = '$input')";
	    $result1 = mysql_query($sql);

	    if (mysql_num_rows($result1) < 1) {
	    	print("Sorry, we did not find any travelmates. \r\n");
	    	exit();
	    }
	    else {
	    	print("<p>We found " . mysql_num_rows($result1) . " potential travelmates for you: </p>");
			while($data=mysql_fetch_assoc($result1)) {		
				print("<br><br>");

				print("<b><u>Name:</u></b> {$data['username']}<br/>");
				print("<b><u>Email address:</u></b> {$data['emailAddr']}<br/>");
					
			}
	    }
	}

?>