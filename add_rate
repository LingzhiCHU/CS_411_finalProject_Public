<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$hotel_id = $_POST['input_id'];
	$recommend = $_POST['recommend'];
	$rank = $_POST['rate'];
	$summary = $_POST['summary'];
	$comment = $_POST['comment'];

	echo $hotel_id."\n";
	echo $recommend."\n";
	echo  $rank."\n";
	echo $summary."\n";
	echo $comment."\n";
?>

<h3>Thank you, your review has been submitted! <br>
</h3>
<h4>
<a href="index.html">Back to homepage</a>
<a href="trip.html">Book hotels</a>
</h4>
