<?php
session_start();
if(!isset($_SESSION["admin"]))
  die("You must login as admin to access the page");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>User Information</title>
  </head>
  <body style = "background-color: #53b0e9;">
    <div class = "container-fluid">

    <?php
    //create header
    require_once 'pageFormatSession.php';

    $pageTitle = "USERS";
    $img = "./images/logo.jpg";
    pageHeaderSession($pageTitle,$img);

    echo("<form action=\"./infoSummaryAdminHandler.php\" method=\"POST\"><input type=\"text\" id=\"searchable\" name=\"searchable\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Search\"></form>");
    echo("<a class=\"btn btn-primary\" href=\"infoSummaryAdmin.php\">Refresh</a>");

    require_once 'connection.php';
    $conn = connect_db();

    //get questions from database and display
    $query = "SELECT * FROM users";
    $result = $conn->query($query);
    if(!$result) die("Fatal error on query");
 
    $rows = $result->num_rows;

    echo <<<_END

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Notes</th>
        </tr>
      </thead>

    _END;

    $countRows = 0;
    $rowName = "questionRow";
    $loopsCount = 0;
    $showingLoops = 1;

    echo"<tbody id=\"questionRow\">";

    if($rows <= 10)
    {
      for($i=0; $i<$rows; $i++)
      {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $uID = $row["userID"];
        $na = $row["name"];
        $em = $row["email"];
        $no = $row["notes"];
        $all = "$uID*$no";
        echo"<tr><td>$na</td><td>$em</td><td>$no</td>";
        echo"<td><form action=\"./infoAdminForm.php\" method = \"POST\"><button type=\"submit\" class=\"btn btn-primary\" id=\"mBtn\" name=\"mBtn\" value=\"$all\">Modify Notes</button></form><form action=\"./infoAdminDelete.php\" method = \"POST\"><button type=\"submit\" class=\"btn btn-primary\" id=\"clearB\" name=\"clearB\" value=\"$uID\">Clear Notes</button></form></td>";
        echo"</tr>";
      }
    }
    else
    {

      for($i=0; $i<$rows; $i++)
      {
        $countRows++;

        $row = $result->fetch_array(MYSQLI_ASSOC);
        $uID = $row["userID"];
        $na = $row["name"];
        $em = $row["email"];
        $no = $row["notes"];
        $all = "$uID*$no";
        echo"<tr><td>$na</td><td>$em</td><td>$no</td>";
        echo"<td><form action=\"./infoAdminForm.php\" method = \"POST\"><button type=\"submit\" class=\"btn btn-primary\" id=\"mBtn\" name=\"mBtn\" value=\"$all\">Modify Notes</button></form><form action=\"./infoAdminDelete.php\" method = \"POST\"><button type=\"submit\" class=\"btn btn-primary\" id=\"clearB\" name=\"clearB\" value=\"$uID\">Clear Notes</button></form></td>";
        echo"</tr>";

        if($countRows == 10)
        {
          $loopsCount++;
          echo("</tbody><tbody style=\"display:none\" id=\"questionRow$loopsCount\">");
          $countRows = 0;
        }
        else if($i == $rows-1)
        {
          $loopsCount++;
        }
      }
    }

    $conn->close();

    echo "</tbody</table>";
    echo "<p style=\"display:none\" id=\"pLoop\">$showingLoops</p>";

    if($rows > 10)
    {
      echo "<button type=\"button\" class=\"btn btn-primary\" id=\"qButton\" onclick=\"summaryButton($loopsCount)\">Show More</button>";
    }

    ?>

    <script type="text/javascript" src="js/summary.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </div> 
  </body>
</html>