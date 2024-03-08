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
    require_once 'pageFormatSession.php';

    $pageTitle = "QUESTION";
    $img = "./images/logo.jpg";
    pageHeaderSession($pageTitle,$img);

    require_once 'connection.php';
    $conn = connect_db();

    #clean input
    require_once 'security.php';
    $contact = sanitizeString($_POST["contact"]);
    $question = sanitizeString($_POST["question"]);
    $systemID = $_SESSION["name"];
    $status = "new";

    //use input to login
    $query = "INSERT INTO questions(userID, contactID, question, status) VALUES (\"$systemID\",\"$contact\",\"$question\",\"$status\")";
    $conn->query($query);
    $query = "SELECT * FROM questions WHERE userID = \"$systemID\" AND contactID = \"$contact\" AND question = \"$question\"";
    $result = $conn->query($query);
    if(!$result) 
      die("Fatal error on query");
    $rows = $result->num_rows;
    if($rows > 0)
    {
      header('Location: ./questionSummary.php');
    }
    else
      echo "<h2 class=\"text-danger\">New question failed! Try again!</h2>";
    $conn->close();

    ?> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </div> 
  </body>
</html>