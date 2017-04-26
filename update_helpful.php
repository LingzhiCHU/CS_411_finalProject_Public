<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$id = $_POST["comment_id"];
	$helpful = $_POST["input_helpful"];
	// if (isset($_POST["submit"]))
	// 	echo "set";
	// echo "hello";
	// echo $id;
	// echo $helpful;
	if ($helpful == "Yes") {
		// echo "hello";
		// read current helpfulness from database
		$sql0 = "SELECT helpfulness FROM Comment WHERE ID = '$id'";
		$res0 = mysql_query($sql0);
		$data0 = mysql_fetch_assoc($res0);
		$cur = $data0['helpfulness'];

		// update helpfulness
		$cur = $cur + 1;
		$sql = "UPDATE Comment SET helpfulness = '$cur' WHERE ID = '$id'";
		mysql_query($sql);
	}
	else {
		echo "get nothing";
	}
?>

<h3>Thank you for your feedback!</h3> 
<h4><a href = "comment.php" >Back to comments</a>



