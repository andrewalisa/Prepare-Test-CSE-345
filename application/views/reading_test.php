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

    <title>Reading Test</title>

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
        <h1>Practice Reading Test</h1> <br/>
        <p><b><i>Directions:</i></b></p>
        <p><i>Directions: The passage below is accompanied by several questions. After reading the passage, choose the best answer to each of the ACT Reading practice questions. You may refer to the passage as often as necessary.</i></p>
    <br/><br/>


        <?php foreach ($Eng_Paragraph as $row) { ?> 
          <p><?=$row->CONTENT?></p>
        <?php } ?>

     

        <br/>

        <form action="http://preparetestcse345.co/Main/reading_result_display" method="POST" accept-charset="utf-8">

        <?php foreach ($Question as $row) { ?> 
           <p><?=$row->ENG_PROB_ID?>. <?=$row->PROB_QUESTION?></p>

        <?php $ans_array = array($row->PROB_CHOICE_1, $row->PROB_CHOICE_2, $row->PROB_CHOICE_3, $row->PROB_ANSWER); 
        shuffle($ans_array); ?>



           <input type ="radio" name="quizid<?=$row->PROB_ID?>" value="<?=$ans_array[0]?>"> A. <?=$ans_array[0]?><br/>
           <input type ="radio" name="quizid<?=$row->PROB_ID?>" value="<?=$ans_array[1]?>"> B. <?=$ans_array[1]?><br/>
           <input type ="radio" name="quizid<?=$row->PROB_ID?>" value="<?=$ans_array[2]?>"> C. <?=$ans_array[2]?><br/>
           <input type ="radio" name="quizid<?=$row->PROB_ID?>" value="<?=$ans_array[3]?>"> D. <?=$ans_array[3]?><br/>
       <br/>
        <?php } ?>

          <p><a class="btn btn-primary btn-lg" href='<?php echo base_url()."Main/reading_result_display/"; ?><?=$diff; ?>' role="button">Submit &raquo;</a></p>
      </form>



      </div>
    </div>

    <div class="container">

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
