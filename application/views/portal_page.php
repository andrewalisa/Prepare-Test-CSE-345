<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set("display_errors", "on");  
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

    <title>Portal</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/jumbotron.css" rel="stylesheet">

  </head>

  <body>
<!--Including header -->
<?php include_once ('include/header/nav.php'); ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Portal</h1>
        <p>Hello! Thanks for visiting Prepare Test CSE 345. This is an application that allows the end user to prepare for an exam. </p> 
        <p>We currently offer two subjects to prepare for. These subjects are: English and Reading.  </p>
        <p>The instructions to use this are as follows: 
          <ul>
            <li>Look at what subject you would like to take (English or Reading)</li>
            <li>Choose difficulty (Easy, Medium, Hard)</li>
            <li>Take the exam</li>
          </ul>
        </p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-6">
          <h2>English</h2>
          <h4><i>Some Tips:</i></h4>
          <ul>
            <li><p> Be aware of the writing style used in each passage. </p></li>
            <li><p>Consider the elements of writing that are included in each underlined portion of the passage. Some questions will ask you to base your decision on some specific element of writing, such as the tone or emphasis the text should convey.</p></li>
            <li><p>Examine each answer choice and determine how it differs from the others. Many of the questions in the test will involve more than one aspect of writing.</p></li>
            <li><p><b>READ</b> and <b>REREAD</b> the entire passage before you answer the questions.</p></li>
          </ul>
            <p><a class="btn btn-default" href='<?php echo base_url()."Main/select_difficulty_english"; ?>' role="button">Select the Difficulty for the English Test &raquo;</a></p>
        </div>
        <div class="col-md-6">
          <h2>Reading</h2>
          <h4><i>Some Tips:</i></h4>
          <ul>
          <li><p>Read the passage(s) carefully.</p></li>
          <li><p>Read and consider all of the answer choices before you choose the one that best responds to the question.</p></li>
          <li><p>Refer to the passage(s) when answering the questions.</p></li>
          </ul>
          <p><a class="btn btn-default" href='<?php echo base_url()."Main/select_difficulty_reading"; ?>' role="button">Select the Difficulty for the Reading Test &raquo;</a></p>
        </div>
      </div>

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

  </body>
</html>
