<?php
	//function reservation($username) {
		// link the website
		$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		// choose database 
		mysql_select_db('searchengine_CSV_DB', $link);

		$user_id = $_POST["input_id"];
		$sql = "SELECT * FROM reserved WHERE userID = '$user_id'";
		$res = mysql_query($sql);

		# echo "userid = ".$user_id;

		print("<tr>
		<td align=\"center\"> ");
	

		if (mysql_num_rows($res)>0)
		{
			print("<p>You have " . mysql_num_rows($res) . " reservations:</p>");
			while($data=mysql_fetch_assoc($res)) {
			// print("<p><b> Gene: {$data['Gene_No']} </b>");
				print("<br><br>");

				print("<b><u>Hotel name:</u></b> {$data['reservedHotel']}<br/>");
				print("<b><u>Check in date:</u></b> {$data['check_in']}<br/>");
				print("<b><u>Check out date:</u></b> {$data['check_out']}<br/>");
				//print("<b><u>Gene Function:</u></b> {$data['Gene_Function']}<br/>");
				print("<br><br>");
?>

<form method = "post" action = "rate.php">
<input type = "text" name = "ID" value = <?php echo $user_id ?>
		size = "4" style = "background-color:white; border: solid 1px #ffffff; color: #fff">
<input type = "text" name = "hotel_id" value = <?php echo $data['hotel_id'] ?>
		size = "4" style = "background-color:white; border: solid 1px #ffffff; color: #fff">
<input type = "submit" value = "Rate this hotel">
</form>

<?php
			}

		}
		else {
			print("You have no reservations yet.");
		}

	//}

?>