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

    <title>Results for English Test</title>

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
        <h1>Practice English Test</h1> <br/>
        <p><b><i>Directions:</i></b></p>
        <p><i>In the following ACT English practice test, there is a passage with certain words and phrases that are underlined and numbered. The questions will provide alternatives for the underlined portion. You should choose the alternative that best expresses the idea in standard written English and is worded most consistently with the tone of the passage. If you believe that the original version is best, then choose “NO CHANGE.” There will also be questions about sections of the passage or about the passage as a whole. Read the entire passage before answering any of the questions. For some questions you may need to read beyond the underlined section in order to determine the correct answer.</i></p>
    <br/><br/>

   <?php $score = 0; ?>

    <?php $array1= array(); ?>
    <?php $array2= array(); ?>
    <?php $array3= array(); ?>
    <?php $array4= array(); ?>
    <?php $array5= array(); ?>
    <?php $array6= array(); ?>
    <?php $array7= array(); ?>
    <?php $array8= array(); ?>
    <?php $array9= array(); ?>
    <?php $array10= array(); ?>

    <?php foreach($checks as $checkans) { ?>
      <?php array_push($array1, $checkans); } ?>

    <?php foreach($results as $res) { ?>
      <?php array_push($array2, $res->PROB_ANSWER);
            array_push($array3, $res->ENG_PROB_ID);
            array_push($array4, $res->PROB_QUESTION);
            array_push($array5, $res->PROB_CHOICE_1);
            array_push($array6, $res->PROB_CHOICE_2);
            array_push($array7, $res->PROB_CHOICE_3);
            array_push($array8, $res->PROB_ANSWER);
       } ?>



       <?php 
          for ($x=0; $x < 15; $x++) { ?>




    <form action="http://preparetestcse345.co/Main/english_result_display" method="post" accept-charset="utf-8">

        

        <p><?=$array3[$x]?>. <?=$array4[$x]?></p>

          <?php if($array2[$x] != $array1[$x]) { ?>

            <p><span style ="background-color: #FF9C9E"><?=$array1[$x]?></span></p>

            <p><span style="background-color: #ADFFB4"><?=$array2[$x]?></span></p>
          <?php } else { ?>

             <p><span style="background-color: #ADFFB4"><?=$array1[$x]?></span></p>
                  <?php $score = $score + 1; ?>
          

        <?php } } ?>

     

        <br/>


       <br/>


       <?php if($score < 8) { ?>
           <p> BE CAREFUL, You scored a score of <?=$score?>/10!</p>
           <p>We would really recommend studying A LOT!</p>
           <p> Here are some great resources:</p>
            <p><a href ="http://www.actstudent.org/" target="_blank">http://www.actstudent.org/</a> <br/>
               <a href="https://www.studyguidezone.com/acttest.htm" target="_blank">https://www.studyguidezone.com/acttest.htm</a> <br/>
               <a href="http://blog.prepscholar.com/how-to-study-for-the-act" target="_blank">http://blog.prepscholar.com/how-to-study-for-the-act</a> <br/>
            </p>
  

            <p>Remember: no pain, no gain.</p>
            
         <?php } else { ?>
           
           <p>Wow! You scored a score of <?=$score?>/10! You did a fantastic job! :)</p>
           <p>Maybe still consider these resources to earn an even better score on your test: </p>
            <p><a href ="http://www.actstudent.org/" target="_blank">http://www.actstudent.org/</a> <br/>
               <a href="https://www.studyguidezone.com/acttest.htm" target="_blank">https://www.studyguidezone.com/acttest.htm</a> <br/>
               <a href="http://blog.prepscholar.com/how-to-study-for-the-act" target="_blank">http://blog.prepscholar.com/how-to-study-for-the-act</a> <br/>
            </p>
           <p>This is a great guideline to get off the sidelines. </p>
         <?php } ?>
     
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
