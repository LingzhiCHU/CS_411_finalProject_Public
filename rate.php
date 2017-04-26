<!DOCTYPE html>
<html>
<form method = "post">
<input type = "text" name = "id" size = "4" style = "background-color:white; border: solid 1px #ffffff; color: #fff" 
		value = <?php echo $_POST['ID']; ?>>
<input type = "text" name = "hotel_id" size = "4" 
style = "background-color:white; border: solid 1px #ffffff; color: #fff" 
value = <?php echo $_POST['hotel_id'] ?>>
<h3>Would you recommend this hotel to your friends? 
	<input type="radio" name="recommend" value="Yes"> Yes
	<input type="radio" name="recommend" value="No"> No <br>

	Please give this hotel an overall rating (1~5, 1 for terrible, 5 for perfect):
	<input type = "number" name = "rate" > <br>

	Tell us about your stay:  </h3>

<h4>Summary <br>
	<textarea name= "summary" rows="2" cols="100"></textarea><br />

	Additional comments <br>
	<textarea name= "comment" rows="10" cols="100"></textarea><br />
	<input type = "submit" value = "Submit your review">
</h4>
</form>

<?php
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$user_id = $_POST['id'];
	$hotel_id = $_POST['hotel_id'];
	$recommend = $_POST['recommend'];
	$rank = $_POST['rate'];
	$summary = $_POST['summary'];
	$comment = $_POST['comment'];

	if ($recommend == "") {
		echo "Please select Yes or No in recommend field.";
		exit(1);
	}
	else if ($rank == "" || $rank < 0 || $rank > 5) {
		echo "Please give a valid rating";
		exit(1);
	}
	else if ($summary == "") {
		echo "Plese enter a summary";
		exit(1);
	}
	// echo $hotel_id."\n";
	// echo $recommend."\n";
	// echo  $rank."\n";
	// echo $summary."\n";
	// echo $comment."\n";
	// echo "hello";
	
	date_default_timezone_set('America/Chicago');
	$date = date('Y-m-d H:i:s');
	# echo "Now is ".$date;
	// echo $date;
	// echo $user_id;
	// choose the id for new comment
	$sql = "SELECT MAX(ID) FROM Comment";
	$res = mysql_query($sql);
	$data = mysql_fetch_assoc($res);
	$newid = $data['MAX(ID)'] + 1;

	// echo "newid: ".$newid."\n";

	# echo "userid: ".$user_id."\n";
	// find username based on user id
	$sql1 = "SELECT * FROM user WHERE ID = '$user_id'";
	$res1 = mysql_query($sql1);
	$data1 = mysql_fetch_assoc($res1);
	$name = $data1['username'];

	// echo "username: ".$name;
	$sql = "INSERT INTO `Comment`(`rank`, `time_posted`, `ID`, `content`, 
		`username`, `recommend`, `helpfulness`, `summary`, `hotel_id`) 
		VALUES ('$rank', '$date','$newid','$comment','$name','$recommend','0','$summary','$hotel_id')";

	mysql_query($sql);
    echo "<h3>Thank you, your review has been submitted! <br> </h3>";

?>



<h4>
<a href="index.html">Back to homepage</a> <br>
<a href="trip.html">Book hotels</a>
</h4>
</html>