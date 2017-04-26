<!-- <html>

	<body>
 -->
<?php
	# include "user_login.php";
	# print (session_id()."\r\n");
	//	link the website
	$link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// choose database 
	mysql_select_db('searchengine_CSV_DB', $link);

	$username = $_POST["input_username"];
	$email = $_POST["input_email"];

	$sql0 = "SELECT DISTINCT * FROM `reserved` WHERE username = '$username'";
	$res0 = mysql_query($sql0);
    if (mysql_num_rows($res0) < 1) {
    	print ("Sorry, there is no travelmate available now :( ");
    	exit(0);
    }
	while($data0=mysql_fetch_assoc($res0)) {
		
		$hotel = $data0['reservedHotel'];
		// echo $hotel;
	// // find friends
		$sql = "SELECT DISTINCT * FROM `user` NATURAL JOIN `reserved`
			WHERE shareEmail = 1 AND reserved.username <> '$username' AND
			reservedHotel = '$hotel'";

		$res=mysql_query($sql);

		print("<tr>
		<td align=\"center\"> ");
			if (mysql_num_rows($res)>0)
		{
			// print("<p>We found " . mysql_num_rows($res) . " potential travelmate(s)</p>");
			while($data=mysql_fetch_assoc($res)) {
			
			// print("<p><b> Gene: {$data['Gene_No']} </b>");
				print("<br><br>");

				print("<b><u>Name:</u></b> {$data['username']}<br/>");
				print("<b><u>Email:</u></b> {$data['emailAddr']}<br/>");
				print("<b><u>You are both staying at:</u></b> {$data['reservedHotel']}<br/>");
				print("\n");
				//print("<b><u>Gene Function:</u></b> {$data['Gene_Function']}<br/>");
?>
    <form method="post" action="email.php">
    <input type="text" name="input_from" id="name" value= <?php echo $email; ?>
           size = "1" style = "background-color:white; border: solid 1px #ffffff; color: #fff" />
    <input type="text" name="input_to" id="name" value= <?php echo $data['emailAddr']?>  
    		size = "1" style = "background-color:white; border: solid 1px #ffffff; color: #fff"/>
    <input type="submit" value="Connect!" />
    </form>
<?php 				
				# echo '<form method="post" action="reserve.php">';
				# echo '<input name = "$input_name" type="submit" value="Reserve now" />';
				# echo '</form>';
				# echo '</html>';
			}
			}
		
	}
?>
<h4><a href = "index.html">Back To Homepage</a></h4>
<a href = "host.html">Manage my hotels</a></h4>
<!-- 	</body>

</html> -->