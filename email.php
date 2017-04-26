
<?php
//if "email" variable is filled out, send email
  if (isset($_REQUEST['email']))  {
  
  //Email information
  $admin_email = $_POST["from"];
  $email = $_REQUEST['email'];
  $subject = $_REQUEST['subject'];
  $comment = $_REQUEST['comment'];
  // echo "From:".$admin_email;
  // echo "To:".$email;
  //send email
  // mail($admin_email, $subject, $comment, "From:" . $email);
  mail($email, $subject, $comment, "From:" . $admin_email);
  //Email response
  echo "Congraduations, you have successfuly connected to a travelmate!";
  echo '<h4><a href = "index.html">Back to Homepage</a></h4>';
  }
  
  //if "email" variable is not filled out, display the form
  else  {
?>

 <form method="post">
  <input type="text" name="from" id="name" value= <?php echo $_POST['input_from']; ?>
           size = "1" style = "background-color:white; border: solid 1px #ffffff; color: #fff" />
  To: <input name= "email" value = <?php echo $_POST["input_to"] ?> type="text" /><br />
  Subject: <input name= "subject" value = "Greetings from Travelmate!" type="text" /><br />
  Message:<br />
  <textarea name= "comment" rows="15" cols="40"></textarea><br />
  <input type="submit" value="Send" />
  </form>
  
<?php
  }
?>
