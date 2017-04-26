<?php
# echo $_POST['input_email'];
  $email = $_POST['input_email'];

  // download w and b
    // link the website
  $link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  // choose database 
  mysql_select_db('searchengine_CSV_DB', $link);

 $weight = array();
 $bias = array();

 $sqlw = "SELECT * FROM weight";
 $sqlb = "SELECT * FROM bias";

 $resw = mysql_query($sqlw);
 $resb = mysql_query($sqlb);

 while($data=mysql_fetch_assoc($resw)) {
  $weight[$data['row']][$data['col']] = $data['w'];
  // echo $weight[$data['row']][$data['col']];
 }
 while($data=mysql_fetch_assoc($resb)) {
  $bias[$data['row']][$data['col']] = $data['b'];
  // echo $bias[$data['row']][$data['col']];
 }

 // fetch user information
 $sql = "SELECT gender, age FROM user WHERE emailAddr = '$email'";
 $res = mysql_query($sql);
  $data=mysql_fetch_assoc($res);

  // parse argument
  if ($data['gender'] == "M")
      $gender = 0;
    else 
      $gender = 1;

    // age
    if ($data['age'] == "0 to 20")
      $age = 0;
    else if ($data['age'] == "20 to 40")
      $age = 1;
    else
      $age = 2;

    $price = 1;

    // for each region
   $recommend = array();
   $address = array();

    for($region = 0; $region < 5; $region ++){
    $x = array($gender, $age, $region, $price);
    for ($i = 0; $i < 104; $i++) {
      $h[$i] = $x[0] * $weight[0][$i] + $x[1] * $weight[1][$i]+ $x[2] * $weight[2][$i] + $x[3] * $weight[3][$i];
      if ($h[$i] > 0)
        $h[$i] = 1;
      else
        $h[$i] = -1;

    }

    // find best fit hotel
    $h_max = -1;
    $id = 0;
    for ($i = 0; $i < 104; $i++) {
      if ($h[$i] > $h_max) {
        $h_max = $h[$i];
        $id = $i;
      }
    }
    // echo "max id : ".$id ."\r\n";
    // find hotel info & post to page
    $sql = "SELECT * FROM `TABLE 4` WHERE ID = '$id'";
    $res = mysql_query($sql);
    $data=mysql_fetch_assoc($res);
    $recommend[$region] = $data['hotel_name'];
    $address[$region] = $data['address'];
    $rate[$region] = $data['price_per_room'];
    $id[$region] = $data['ID'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--

Template 2082 Pure Mix

http://www.tooplate.com/view/2082-pure-mix

-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<!-- Site title
   ================================================== -->
	<title>Recommendations For You</title>

	<!-- Bootstrap CSS
   ================================================== -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Animate CSS
   ================================================== -->
	<link rel="stylesheet" href="css/animate.min.css">

	<!-- Font Icons CSS
   ================================================== -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">

	<!-- Main CSS
   ================================================== -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Google web font 
   ================================================== -->	
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300' rel='stylesheet' type='text/css'>
	
</head>
<body>


<!-- Preloader section
================================================== -->
<div class="preloader">

	<div class="sk-spinner sk-spinner-pulse"></div>

</div>


<!-- Navigation section
================================================== -->
<div class="nav-container">
   <nav class="nav-inner transparent">

      <div class="navbar">
         <div class="container">
            <div class="row">

              <div class="brand">
                <a href="index.html">Travelmate</a>
              </div>

              <div class="navicon">
                <div class="menu-container">

                  <div class="circle dark inline">
                    <i class="icon ion-navicon"></i>
                  </div>

                  <div class="list-menu">
                    <i class="icon ion-close-round close-iframe"></i>
                    <div class="intro-inner">
                     	<ul id="nav-menu">
                         <li><a href="index.html">Home</a></li>
                        <li><a href="trip.html">My Trip</a></li>
               
                        <li><a href="login_index.html">Log in/Sign up</a></li>
                                          </ul>
                    </div>
                  </div>

                </div>
              </div>

            </div>
         </div>
      </div>

   </nav>
</div>


<!-- Header section
================================================== -->
<section id="header" class="header-five">
	<div class="container">
		<div class="row">

			<div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
          <div class="header-thumb">
              <h1 class="wow fadeIn" data-wow-delay="0.6s">Recommendation For You</h1>
              <h3 class="wow fadeInUp" data-wow-delay="0.9s">Our Hottest Destinations</h3>
          </div>
			</div>

		</div>
	</div>		
</section>


<!-- Blog section
================================================== -->
<section id="blog">
   <div class="container">
      <div class="row">

         <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="1s">
         	  <div class="blog-thumb">
         		   <a href="single-post.html"><img src="images/blog-img1.jpg" class="img-responsive" alt="Blog"></a>
         		   <a href="single-post.html"><h1><?php echo $recommend[0] ?></h1></a>
         		     <div class="post-format">
						        <span><?php echo $address[0] ?></a></span>
						        <span>$<?php echo $rate[0] ?> per night</span>
					       </div>
         		     <form method = "post" action = "reserve_recommend.php">
                <input name= "input_id" type="text" value = <?php echo $id[0]?>
         size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
                 <input type = "submit" value = "Reserve">
                 </form>
         	    </div>
		    </div>

		    <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="1.6s">
         	  <div class="blog-thumb">
         		   <a href="single-post.html"><img src="images/blog-img2.jpg" class="img-responsive" alt="Blog"></a>
         		   <a href="single-post.html"><h1><?php echo $recommend[1] ?></h1></a>
         			    <div class="post-format">
						        <span><?php echo $address[1] ?></a></span>
						        <span>$<?php echo $rate[1] ?>per night</span>
					       </div>
         		    <form method = "post" action = "reserve_recommend.php">
                <input name= "input_id" type="text" value = <?php echo $id[1]?>
         size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
         		     <input type = "submit" value = "Reserve">
                 </form>
         	  </div>
		    </div>

        

		    <div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="1.9s">
         	  <div class="blog-thumb">
         		   <a href="single-post.html"><img src="images/blog-img3.jpg" class="img-responsive" alt="Blog"></a>
         		   <a href="single-post.html"><h1><?php echo $recommend[2] ?></h1></a>
         			    <div class="post-format">
						        <span><?php echo $address[2] ?></a></span>
						        <span>$<?php echo $rate[2] ?>per night</span>
					       </div>
         		    
         		     <form method = "post" action = "reserve_recommend.php">
                <input name= "input_id" type="text" value = <?php echo $id[2]?>
         size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
                 <input type = "submit" value = "Reserve">
                 </form>
         	  </div>
		    </div>

        <div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="2.2s">
            <div class="blog-thumb">
               <a href="single-post.html"><img src="images/blog-img4.jpg" class="img-responsive" alt="Blog"></a>
               <a href="single-post.html"><h1><?php echo $recommend[3] ?></h1></a>
                  <div class="post-format">
                    <span><?php echo $address[3] ?></a></span>
                    <span>$<?php echo $rate[3] ?>per night</span>
                
                 <form method = "post" action = "reserve_recommend.php">
                <input name= "input_id" type="text" value = <?php echo $id[3]?>
         size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
                 <input type = "submit" value = "Reserve">
                 </form>
            </div>
        </div>

        <div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="2s">
            <div class="blog-thumb">
               <a href="single-post.html"><img src="images/blog-img5.jpg" class="img-responsive" alt="Blog"></a>
               <a href="single-post.html"><h1><?php echo $recommend[4] ?></h1></a>
                  <div class="post-format">
                    <span> <?php echo $address[4] ?></a></span>
                    <span>$<?php echo $rate[4] ?>per night</span>
                    
                 </div>
                 
                 <form method = "post" action = "reserve_recommend.php">
                <input name= "input_id" type="text" value = <?php echo $id[4]?>
         size = "1" style =  "background-color:white; border: solid 1px #ffffff; color: #fff"/>
                 <input type = "submit" value = "Reserve">
                 </form>
            </div>
        </div>
      </div>
   </div>
</section>

<!-- Footer section
================================================== -->
<footer>
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<p class="wow fadeInUp"  data-wow-delay="0.3s">Copyright © 2016 Your Company Name - Designed by Tooplate</p>
				<ul class="social-icon wow fadeInUp"  data-wow-delay="0.6s">
					<li><a href="#" class="fa fa-facebook"></a></li>
					<li><a href="#" class="fa fa-twitter"></a></li>
					<li><a href="#" class="fa fa-dribbble"></a></li>
					<li><a href="#" class="fa fa-behance"></a></li>
					<li><a href="#" class="fa fa-google-plus"></a></li>
				</ul>
			</div>
			
		</div>
	</div>
</footer>

<!-- Javascript 
================================================== -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>