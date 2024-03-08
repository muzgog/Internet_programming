<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.navbar {
  overflow: hidden;
  background-color: #333;
  font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  cursor: pointer;
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.show {
  display: block;
}
</style>
</head>
<body>
<?php
    function pageHeaderSession($title,$img)
    {
       echo<<<EOT
<div class="navbar">
  <a><img src="$img"></a>
   <a class="nav-item nav-link active" href="./index.php">Home <span class="sr-only">(current)</span></a>
EOT;
  if(!isset($_SESSION['name']))
   {
      echo ' <a class="nav-item nav-link" href="loginForm.php">Login</a>';
      echo ' <a class="nav-item nav-link" href="./signup.php">Signup</a>';
  }
  else
  {
    if (!isset($_SESSION['admin']))
    {
echo<<<EOT
  <a class="nav-item nav-link" href="infoSummary.php">Contact Information</a>
  <a class="nav-item nav-link" href="infoEntry.php">Enter New Contact</a>
  <a class="nav-item nav-link" href="questionSummary.php">Questions</a>
EOT;
}
else
{
  echo<<<EOT
<a class="nav-item nav-link" href="./infoSummaryAdmin.php">Contact Information</a>
<a class="nav-item nav-link" href="./infoUsers.php">Users Information</a>
<a class="nav-item nav-link" href="questionSummaryAdmin.php">Questions</a>
EOT;
}
echo<<<EOT
  <a class="nav-item nav-link" href="questionEntry.php">Enter New Question</a>
  <div class="dropdown">
  <button class="dropbtn" onclick="myFunction()">Profile
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content" id="myDropdown">
    
    <a href="profile.php">Settings</a>
    <a href="logout.php">Log Out</a>
  </div>
  </div> 
  EOT;
  }
  
echo "</div>";

}

  function pageFooter()
     {
      echo '<a class="nav-item nav-link" href="adminLogin.php">Admin Login</a>';
         
      }

    ?>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
</script>
</body>
</html>