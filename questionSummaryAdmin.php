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

    <title>Submitted Questions</title>
    <style>
      #content { margin: 50px; } 
a { text-decoration: none; }  
 
.expandable {
  background: #fff;
  overflow: hidden;

  transition: all .5s ease-in-out;
  line-height: 0;
  padding: 0 1em;
  color: transparent;
}
 
.expandable:target {
  line-height: 1.5;
  padding-top: 1em;
  padding-bottom: 1em;
  color: black;
}
</style>
  </head>
  <body style = "background-color: #53b0e9;">
    <div class = "container-fluid">

    <?php
    //create header
    require_once 'pageFormatSession.php';


    $pageTitle = "QUESTIONS";
    $img = "./images/logo.jpg";
    pageHeaderSession($pageTitle,$img);

    echo("<form action=\"./questionSummaryAdminHandler.php\" method=\"POST\"><input type=\"text\" id=\"searchable\" name=\"searchable\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Search\"></form>");
    echo("<a class=\"btn btn-primary\" href=\"questionSummaryAdmin.php\">Refresh</a>");

    require_once 'connection.php';
    $conn = connect_db();

    //get questions from database and display
    $query = "SELECT * FROM questions";
    $result = $conn->query($query);
    if(!$result) die("Fatal error on query");
 
    $rows = $result->num_rows;

    echo <<<_END

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Question</th>
          <th scope="col">Time</th>
          <th scope="col">Status</th>
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
        $q = $row["question"];
        $t = $row["time"];
        $s = $row["status"];
        $all = "$cid*$q";
        $out=getContactInfo($cid);
        

        echo"<tr><td>$q</td><td>$t</td><td>$s</td>";
        echo"<td><form action=\"./questionAdminForm.php\" method = \"POST\"><button type=\"submit\" class=\"btn btn-primary\" id=\"mBtn\" name=\"mBtn\" value=\"$all\">Modify Question</button></form></td> <td><a href=\"#$i\"><button class=\"btn btn-primary\" >Contact Information</button></a></td>";
        echo"</tr><tr><td colspan=\"100\"><div class=\"expandable\" id=\"$i\">$out</div></td></tr>";
      }
    }
    else
    {
      //echo("<div id=\"$rowName\">");

      for($i=0; $i<$rows; $i++)
      {
        $countRows++;

        $row = $result->fetch_array(MYSQLI_ASSOC);
        $cid = $row["contactID"];
        $q = $row["question"];
        $t = $row["time"];
        $s = $row["status"];
        $all = "$cid*$q";
        $out=getContactInfo($cid);

        echo"<tr><td>$q</td><td>$t</td><td>$s</td>";
        echo"<td><form action=\"./questionAdminForm.php\" method = \"POST\"><button type=\"submit\" class=\"btn btn-primary\" id=\"mBtn\" name=\"mBtn\" value=\"$all\">Modify Question</button></form></td> <td><a href=\"#$i\"><button class=\"btn btn-primary\" >Contact Information</button></a></td>";
        echo"</tr><tr><td colspan=\"100\"><div class=\"expandable\" id=\"$i\">$out</div></td></tr>";

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
      //echo("</tbody>");
    }

    $conn->close();

    echo "</tbody</table>";
    echo "<p style=\"display:none\" id=\"pLoop\">$showingLoops</p>";

    if($rows > 10)
    {
      echo "<button type=\"button\" class=\"btn btn-primary\" id=\"qButton\" onclick=\"summaryButton($loopsCount)\">Show More</button>";
    }
    
    //echo "$rowName$loopsCount";

function getContactInfo($cid)
    {
      $conn = connect_db();
      $query="SELECT * FROM info WHERE contactID=\"$cid\"";

        $result=$conn->query($query);
        $rows=$result->num_rows;


     if($rows>0)
      {
        $row=$result->fetch_array(MYSQLI_ASSOC);
      $ea = $row["emailAddress"];
      $a1 = $row["addressLine1"];
      $a2 = $row["addressLine2"];
      $a3 = $row["addressLine3"];
      $ci = $row["city"];
      $st = $row["state"];
      $zi = $row["zip"];
      $co = $row["country"];
      }
      else
      {
      $ea = "";
      $a1 = "";
      $a2 = "";
      $a3 = "";
      $ci = "";
      $st = "";
      $zi = "";
      $co = "";
      }

      //$out="<table class=\"table table-hover\">
//<tr><td>$ea</td><td>$a1</td><td>$a2</td><td>$a3</td><td>$ci</td><td>$st</td><td>$zi</td><td>$co</td></tr></table> ";
      //$out="<div class=\"row\"><div class=\"col-3\">$ea</div><div class=\"col-3\">$a1</div><div class=\"col-3\">$a1</div><div class=\"col-2\">$a1</div><div class=\"col-3\">$ci</div></div>";
      $out="<div class=\"row\" style=\"background-color: #53b0e9;\"><table>
  <tr>
<td>$ea</td><td>$a1</td><td>$a2</td><td>$a3</td><td>$ci</td><td>$st</td><td>$zi</td><td>$co</td>
  </tr>
</table></div>";
      $conn->close();
      return $out;
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