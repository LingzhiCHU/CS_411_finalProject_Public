
<?php
	// session_start();
	// $_SESSION['userName'] = 'Root';
	// echo session_id();
	
	// link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	///////////
	$destination = $_POST["input_destination"];
	$checkin = $_POST["input_checkin"];
	$checkout = $_POST["input_checkout"];
	$guest_num = $_POST["input_guest_num"];
	//////////


	//sanity check
	// print ("destination: ".$destination);
	// print("check in:".$checkin);
	// print("check_out： ".$checkout);
	// print("guest_num: ".$guest_num);
	if ($destination == "" || $checkin == "" || $checkout == "" || $guest_num == "")
		print("One of the input bar is blank. Please enter a valid value. \r\n");
	else if ($guest_num <= 0) 
		print("Please enter a valid guest number. \r\n");
	else if ($checkin >= $checkout) 
		print ("Please enter valid dates.\r\n");


	else {
		$sql = "SELECT * FROM `TABLE 4` WHERE address LIKE '%$destination%' 
		 AND check_in <= '$checkin' AND check_out >= '$checkout' AND room_remaining >= '$guest_num'";
		 // AND check_in >= '$checkin' AND check_out <= '$checkout'
		$res=mysql_query($sql);

		print("<tr>
		<td align=\"center\"> ");
	

		if (mysql_num_rows($res)>0)
		{
			print("<p>There are " . mysql_num_rows($res) . " hotel(s) available</p>");
			while($data=mysql_fetch_assoc($res)) {
			
			// print("<p><b> Gene: {$data['Gene_No']} </b>");
				print("<br><br>");

				print("<b><u>Hotel name:</u></b> {$data['hotel_name']}<br/>");
				print("<b><u>City and state:</u></b> {$data['address']}<br/>");
				print("<b><u>Rate per night:</u></b> {$data['price_per_room']}<br/>");
				//print("<b><u>Gene Function:</u></b> {$data['Gene_Function']}<br/>");
				print("<b><u>There are </u></b> {$data['room_remaining']} rooms left<br/>");
				//print("<br><br>");
				// $input_name = $data['hotel_name'];
?>

				
				
				<form method="post" action="reserve.php">
				<input name = "input_id" type="text" value=<?php echo $data['ID']?> style =  "background-color:white; 
              border: solid 1px #ffffff; color: #fff" />
				<p> Check in date:</p>
				<input name = "input_checkin" type="date" value=<?php echo $checkin ?> />
				<p> Check out date: </p>
				<input name = "input_checkout" type="date" value=<?php echo $checkout ?> />
				<p> Room number: </p>
				<input name = "input_guestnum" type="text" value=<?php echo $guest_num ?> />
				<input name = "input_name" type="submit" value="Reserve now" />
				</form>


				<!-- <form method="post" action="rate.php">
				<input name = "input_id" type="text" value= "<?php //echo $data['ID']?>"  size = "1" style =  "background-color:white; 
              	border: solid 1px #ffffff; color: #fff" />
				<input name = "input_name" type="submit" value="Rate this hotel" />
				</form> -->

				<form method="post" action="comment.php">
				<input name = "input_id" type="text" value=<?php echo $data['ID']?>  size = "1" style =  "background-color:white; 
              	border: solid 1px #ffffff; color: #fff" />
				<input name = "input_name" type="submit" value="View comments" />
				</form>
				
<?php
			}
		}
		else {
			print("Sorry, no hotel is found. Please try again :(");
		}
	

		print("</td>
				</tr>
				</table> ");

	
	}
	
	mysql_close($link);
 	// search algorithm
 	// all attributes are not null
	// if ($name != "" && $address != "" && $price != "")	{
	// 	//echo "all attributes are not null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE hotel_name LIKE '%$name%' OR address LIKE '%$address%'
	// 			OR price_per_room <= '$price' ORDER BY price_per_room";
	// }
	// // one attribute is null: 3 cases
	// else if ($name == "" && $address != "" && $price != "") {
	// 	//echo "name is null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE address LIKE '%$address%'
	// 			OR price_per_room <= '$price' ORDER BY price_per_room";
	// }
	// else if ($name != "" && $address == "" && $price != "") {
	// 	//echo "address is null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE hotel_name LIKE '%$name%' OR price_per_room <= '$price' ORDER BY price_per_room";
	// }
	// else if ($name != "" && $address != "" && $price == "")	{
	// 	//echo "price is null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE hotel_name LIKE '%$name%' OR address LIKE '%$address%'
	// 			ORDER BY price_per_room";
	// }

	// // two attributes are null: 3 cases
	// else if ($name == "" && $address == "" && $price != "")	{
	// 	//echo "price is NOT null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE price_per_room <= '$price' ORDER BY price_per_room";
	// }
	// else if ($name == "" && $address != "" && $price == "")	{
	// 	//echo "address is NOT null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE address LIKE '%$address%' ORDER BY price_per_room";
	// }
	// else if ($name != "" && $address == "" && $price == "") {
	// 	//echo "name is NOT null";
	// 	$sql = "SELECT * FROM `TABLE 4`  WHERE hotel_name LIKE '%$name%' ORDER BY price_per_room";
	// }
	// // all attributes are null
	// else 
	// 	$sql = "SELECT * FROM `TABLE 4`";

	
		
	// print("<table width=\"100%\" border=\"1\" cellpadding=\"10\"> 
	// 	<tr>
	// 		<td  align=\"center\">
	// 		<h1>Gene Information Database</h1>
	// 		<h2> CS411 </h2>
	// 		<h3>For Demo Purpose Only!</h3>
	// 		<h4>Gene Search Result(s)</h4>
	// 		</td>
	// 	</tr> ");
		
	// print("<td>&nbsp;<a href=\"index.html\">Home</a> &nbsp;
	//      </td> ");
	

?>