

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>
 
  <!-- Stylesheets -->
  <link rel="stylesheet" href="css_login/style.css">
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
          <span>We are badly sorry for whatever reason you choose to delete your profile and account permanently</span>
          
        </header>
      </div>
      <div class="col-md-6 right-side">
      
          <body>
    <h1>Sorry we miss you</h1>
    <form method = "post" action = "delete_user.php">
       <input name = "email" type = "text" style = "background-color:white; border: solid 1px #ffffff; color: #fff" value = <?php echo $_POST['input_email']?>>
       <fieldset>
         <legend>Selecting elements</legend>
 
          <p>
           <label>Do you want to keep your reservations?</label> <br>
            <input type = "radio" name="reserve" value="Yes"> Yes
            <input type = "radio" name="reserve" value="No"> No
         </p>
       </fieldset>
    
  </body>
        
        <div class="cta">
          
		  <!--Yuki revision-->
		  <input type = "submit" value = "Delete me">
            <!--Sign-Up Now-->
      </form>   
          
        </div>
        <ul class="social list-inline">
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Linkedin</a></li>
        </ul>
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
</html>
