<?php

	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$hotel_id = $_POST['input_id'];
	echo $hotel_name;
	// most helpful comment first, then newest comment 
	$sql = "SELECT * FROM `Comment` WHERE hotel_id = '$hotel_id' ORDER BY helpfulness DESC, time_posted DESC";
	$res = mysql_query($sql);

	// present result
	if (mysql_num_rows($res)>0){
		print("<p>There are " . mysql_num_rows($res) . " comment(s) available.</p>");
		while($data=mysql_fetch_assoc($res)) {

			print("<br><br>");
			print("<b><u>Rank:</u> {$data['rank']}</b><br/>");
			print("<b><u>Posted by:</u> {$data['username']}</b><br/>");
			print("<b><u>Time posted:</u> {$data['time_posted']}</b><br/>");
			print("<b><u>Recommend to everyone? </u> {$data['recommend']}</b><br/>");
			print("<b><u>Summary:</u></b> {$data['summary']}<br/>");
			print("{$data['content']}<br/>");
?>
<p>Is this comment helpful? 
	<form method = "post" action = "update_helpful.php">
  	<input type="radio" name="input_helpful" value="Yes"> Yes
	<input type="radio" name="input_helpful" value="No"> No <br>
	<input type = "text" name = "comment_id" value = <?php echo $data['ID'] ?> 
			size = "10" style =  "background-color:white; border: solid 1px #ffffff; color: #fff">
	<input type = "submit" name = "submit" value = "submit">
	</form>
</p>
<?php

		}
	}

	else {
		print ("Sorry, this hotel has no comment yet.\n");
	}


?>