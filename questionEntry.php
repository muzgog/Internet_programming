<?php
session_start();
if(!isset($_SESSION["name"]))
  die("You must login to access the page");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>New Question</title>
  </head>
  <body style = "background-color: #53b0e9;">
    <div class = "container-fluid">

    <?php
    //create header
    require_once 'pageFormatSession.php';

    $id = $_SESSION["name"];
    $pageTitle = "QUESTION";
    $img = "./images/logo.jpg";
    pageHeaderSession($pageTitle,$img);

    ?>

    <!--display form to sign up-->
    <form action="./questionHandler.php" method = "POST" onsubmit="return validate(this)">
    
    <input type="hidden" id="contact" name="contact" onblur="validateContact(this)" placeholder="Enter contact ID" value="$id"><br>
    <p id="contactmsg"></p>
    <label for="question">Question:</label><br>
    <input type="text" id="question" name="question" onblur="validateQuestion(this)" placeholder="Enter Question"><br>
    <p id="questionmsg"></p>
    <input type="submit" class="btn btn-primary" value="Submit">
    </form> 

    <script type="text/javascript" src="./js/validationQuestion.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </div> 
  </body>
</html>