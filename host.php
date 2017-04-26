
<?php
  // link the website
  $link = mysql_connect('searchengine.web.engr.illinois.edu', 'searchengine_sliu105', 'ShuijingLiu123');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db('searchengine_CSV_DB', $link);

  $email = $_POST["email"];
  $password_in = $_POST["password"];
    // sanity check
  if ($email == "") {
    print("Username is empty! \r\n");
    exit(1);
  }

  if ($password_in == "") {
    print("Password is empty! \r\n");
    exit(1);
  }

  $sql = "SELECT * FROM host WHERE email = '$email' AND password = '$password_in'";
  $result = mysql_query($sql);
  $count = mysql_num_rows($result);

    # print($count);  
  
  if($count == 1) {
    # print("hello");
    # session_register("email");
    $data=mysql_fetch_assoc($result);
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>
 
  <!-- Stylesheets -->
  <link rel="stylesheet" href="css_login/style3.css">
  <link rel="stylesheet" href="css_login/set1.css">

  <!--Google Fonts-->
  <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

</head>

<body>
<div id="main-wrapper">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 left-side">
        <header>
          
          <h3>Become a Host</h3>
        </header>
      </div>
      <div class="col-md-6 right-side">

 


        <div class="cta">
        <form action="add_hotel.php" method="post" target="_blank">
        <span class="input input--hoshi">
          <input name = "host_email" type = "text"  style = "background-color:white; border: solid 1px #ffffff; color: #fff" 
          value = <?php echo $_POST['email']; ?> >
          <input name = "input_name" class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name">
            <span class="input__label-content input__label-content--hoshi">Hotel name</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input name = "input_price" class="input__field input__field--hoshi" type="text" id="email" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
            <span class="input__label-content input__label-content--hoshi">Price</span>
          </label>
        </span>
        <span class="input input--hoshi">
          <input name = "input_addr" class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password">
            <span class="input__label-content input__label-content--hoshi">Hotel Address</span>
          </label>
        </span>
       
        <span class="input input--hoshi">
          <input name = "input_room" class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Room remaining</span>
          </label>
        </span>
       
        <span class="input input--hoshi">
          <input name = "input_from" class="input__field input__field--hoshi" type="date" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Rooms Available Starting from</span>
          </label>
        </span>
          <span class="input input--hoshi">
          <input name = "input_to" class="input__field input__field--hoshi" type="date" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Rooms Available until</span>
          </label>
        </span>
          
          <input name="Add" type="submit" value="Add My Hotel" />
		  <!--Yuki revision-->
		  <!--<a href="blog.html">Add My Hotel</a> -->
            <!--Sign-Up Now-->
          
          </form>
          </div>


          <div class="cta">
          <form action="delete_hotel.php" method="post" target="_blank">
            <input name = "host_email" type = "text" style = "background-color:white; border: solid 1px #ffffff; color: #fff" value = <?php echo $_POST['email']; ?> >
           <span class="input input--hoshi">
          <input name = "input_name" class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Hotel name</span>
          </label>
        </span>
       
        <span class="input input--hoshi">
          <input name = "input_addr" class="input__field input__field--hoshi" type="text" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Hotel Address</span>
          </label>
        </span>
        

          
          <input name="Delete" type="submit" value="Delete My Hotel" />
      <!--Yuki revision-->
<!--       <a href="blog.html">Delete My Hotel</a> -->
            <!--Sign-Up Now-->
          
          </form>
          </div>




          <div class="cta">
          <form action="update_hotel.php" method="post" target="_blank">
                  <input name = "host_email" type = "text" style = "background-color:white; border: solid 1px #ffffff; color: #fff" value = <?php echo $_POST['email']; ?> >
         <span class="input input--hoshi">
          <input name = "input_name" class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Original Hotel name</span>
          </label>
        </span>
       
        <span class="input input--hoshi">
          <input name = "new_input_name" class="input__field input__field--hoshi" type="text" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">New Hotel Name</span>
          </label>
        </span>
         <span class="input input--hoshi">
          <input name = "input_addr" class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Original Hotel Address</span>
          </label>
        </span>
       
        <span class="input input--hoshi">
          <input name = "new_input_addr" class="input__field input__field--hoshi" type="text" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">New Hotel Address</span>
          </label>
        </span>

<!--
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="name" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">Original Hotel Price</span>
          </label>
        </span>
-->
       
        <span class="input input--hoshi">
          <input name = "new_input_price" class="input__field input__field--hoshi" type="text" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">New Hotel Price</span>
          </label>
        </span>

        <span class="input input--hoshi">
          <input name = "new_input_room" class="input__field input__field--hoshi" type="text" id="name"/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="password1">
            <span class="input__label-content input__label-content--hoshi">New Remaining Room number</span>
          </label>
        </span>
         
        
          
          <input name="Update" type="submit" value="Edit My Hotel" />
      <!--Yuki revision-->
     <!-- <a href="blog.html">Edit My Hotel</a> -->
            <!--Sign-Up Now-->
         

        </form>
       
      </div>
    </div>
      
  </div>

</div> <!-- end #main-wrapper -->

<!-- Scripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js_login/scripts.js"></script>
<script src="js_login/classie.js"></script>
<script>
  (function() {
    // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
    if (!String.prototype.trim) {
      (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
          return this.replace(rtrim, '');
        };
      })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
      // in case the input is already filled..
      if( inputEl.value.trim() !== '' ) {
        classie.add( inputEl.parentNode, 'input--filled' );
      }

      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
      classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        classie.remove( ev.target.parentNode, 'input--filled' );
      }
    }
  })();
</script>

</body>
<?php   
  }

  else {
    print ("Your email or password is incorrect. Please try again.");
    exit(1);
  }
?>