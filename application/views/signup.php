<!DOCTYPE html>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign up</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/jumbotron.css" rel="stylesheet">

  </head>

  <body>
<!--Including header -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/Main">Prepare for Test!</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
 <ul class="nav navbar-nav">
            <li><a href="/Main">Home</a></li>

            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
          </ul>
      
          <form action="http://preparetestcse345.co/Main/login_validation" method="post" accept-charset="utf-8" class="navbar-form navbar-right">
          <div class="form-group">
              <input type="text" placeholder="Email" name="STU_EMAIL" class="form-control">
          </div>
          <div class="form-group">
              <input type="password" placeholder="Password" name="STU_PASSWORD" class="form-control">
          </div>
            <button type="submit" name="login" class="btn btn-success">Sign in</button>
            <a class="btn btn-danger" role="button" href='<?php echo base_url()."Main/signup"; ?>'> Sign up!</a>
          </form>
      
      
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Sign Up for our website!</h1>
          <form class="form-inline" action="http://preparetestcse345.co/main/signup_validation" method="post" accept-charset="utf-8">
          <?php
              //Gives error messages, if user forgot to input email or password
              echo '<div class="error">';
              echo validation_errors();
              echo '</div>';
          ?>
            <p>
              <input type="text" placeholder="First Name" name="STU_FNAME" class="form-control" value= '<?php echo isset($_POST['STU_FNAME']) ? $_POST['STU_FNAME'] : '' ?>'>
            </p>
            <p>
              <input type="text" placeholder="Last Name" name="STU_LNAME" class="form-control" value= '<?php echo isset($_POST['STU_LNAME']) ? $_POST['STU_LNAME'] : '' ?>'>
            </p>
            <p>
              <input type="text" placeholder="Address" name="STU_ADDRESS" class="form-control" value= '<?php echo isset($_POST['STU_ADDRESS']) ? $_POST['STU_ADDRESS'] : '' ?>'>
            </p>
            <p>
              <input type="text" placeholder="City" name="STU_CITY" class="form-control" value= '<?php echo isset($_POST['STU_CITY']) ? $_POST['STU_CITY'] : '' ?>'>
            </p>
            <p>
              <input type="text" maxlength="2" placeholder="State" name="STU_STATE" class="form-control" value= '<?php echo isset($_POST['STU_STATE']) ? $_POST['STU_STATE'] : '' ?>'>
            </p>
            <p>
              <input type="text" maxlength="5" pattern="[0-9]{5}" placeholder="Zip Code" name="STU_ZIP" class="form-control" value= '<?php echo isset($_POST['STU_ZIP']) ? $_POST['STU_ZIP'] : '' ?>'>
            </p>
            <p>
              <input type="text" placeholder="Email" name="STU_EMAIL" class="form-control" value= '<?php echo isset($_POST['STU_EMAIL']) ? $_POST['STU_EMAIL'] : '' ?>'>
            </p>

            <p>
              <input type="password" placeholder="Password" name="STU_PASSWORD" class="form-control">
            </p>

            <p>
              <input type="password" placeholder="Confirm Password" name="STU_CPASSWORD" class="form-control">
            </p>

        <button type="submit" name="signup_submit" class="btn btn-primary btn-lg">Register &raquo;</button>
          </form>

      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->

      <hr>

      <footer>
        <p>&copy; 2017 Andrew Alisa, Larisa Garmo, Valerie Jarbo.  </p>
		<p>Prepared for CSE 345 Databases, with Professor Lin. A course at <a href = "http://www.oakland.edu" target="_blank"> Oakland University </a> </p>
		<p>Not intended for actual use</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="/js/bootstrap.min.js"></script>

         <script type="text/javascript">
         $(document).ready(function () {
             $(".numberinput").forceNumeric();
         });


         // forceNumeric() plug-in implementation
         jQuery.fn.forceNumeric = function () {

             return this.each(function () {
                 $(this).keydown(function (e) {
                     var key = e.which || e.keyCode;

                     if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                     // numbers   
                         key >= 48 && key <= 57 ||
                     // Numeric keypad
                         key >= 96 && key <= 105 ||
                     // comma, period and minus, . on keypad
                        key == 190 || key == 188 || key == 109 || key == 110 ||
                     // Backspace and Tab and Enter
                        key == 8 || key == 9 || key == 13 ||
                     // Home and End
                        key == 35 || key == 36 ||
                     // left and right arrows
                        key == 37 || key == 39 ||
                     // Del and Ins
                        key == 46 || key == 45)
                         return true;

                     return false;
                 });
             });
         }
     </script>

  </body>
</html>
