<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Home</title>
  <style>
    body {background-color: #53b0e9;}

    a {color: navy;}
    
    .msg{
      opacity: 0; 
  
    animation: opacityOn 2s normal forwards;
    
}

@keyframes opacityOn {
    0% {
        opacity: 0;
    }
    25% {
        opacity: 0.25;
    }
    50% {
        opacity: 0.5;
    }
    75% {
        opacity: 0.75;
    }
    100% {
        opacity: 1;
    }
}



  </style>
</head>
<body>
  <div class="container-fluid">

  <?php


  require_once 'pageFormatSession.php';
  require_once 'connection.php';
    $pageTitle = "Settings";
    $img = "./images/logo.jpg";
    pageHeaderSession($pageTitle,$img);

    if (!isset($_SESSION['name']))
    {
      header('refresh:0;url=loginForm.php');
      exit();
    }

    $conn=connect_db();
    $uid = $_SESSION['name'];
    $query="SELECT * FROM users WHERE userID=\"$uid\";";

    $result=$conn->query($query);
     
     if(!$result)
     {
      die("Query error!");
     }
     $rows=$result->num_rows;

     if($rows==1)
      {
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $username=$row["userName"];
        $pwd=$row["password"];
        $email=$row["email"];
        $name=$row["name"];
      }
      else
      {
        die("Query error!");
      }

    $query="SELECT * FROM info WHERE userID=\"$uid\";";

    $result=$conn->query($query);
    $rows=$result->num_rows;


     if($rows>0)
      {
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $contactID=$row["contactID"];
        $contactName=$row["contactName"];
        $emailAddress=$row["emailAddress"];
        $addressLine1=$row["addressLine1"];
        $addressLine2=$row["addressLine2"];
        $addressLine3=$row["addressLine3"];
        $city=$row["city"];
        $state=$row["state"];
        $zip=$row["zip"];
        $country=$row["country"];
      }
      else
      {
         $contactID="";
        $contactName="";
        $emailAddress="";
        $addressLine1="";
        $addressLine2="";
        $addressLine3="";
        $city="";
        $state="";
        $zip="";
        $country="";
      }

      $conn->close();


    echo<<<EOT
    <div class="container light-style flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      Account settings
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#contact-info">Contact Information</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">

 
              <hr class="border-light m-0">

              <div class="card-body">
                <div class="form-group">
                  <label class="form-label">Username</label>
EOT;
               echo "<input type=\"text\" class=\"form-control mb-1\" id=\"username\" value=\"$username\" onblur=\"validateUsername(this)\"> <p id=\"usernamemsg\"></p>";

echo<<<EOT

            
      </div>
                <div class="form-group">
                  <label class="form-label">Name</label>
EOT;
              echo    "<input type=\"text\" class=\"form-control\" id=\"name\" value=\"$name\" onblur=\"validateName(this)\"> <p id=\"namemsg\"></p>";
echo<<<EOT
                </div>
                <div class="form-group">
                  <label class="form-label">E-mail</label>
EOT;
               echo   "<input type=\"text\" class=\"form-control mb-1\" id=\"email\" value=\"$email\" onblur=\"validateEmail(this)\">
               <p id=\"emailmsg\"></p>
               </div> <input type=\"hidden\" id=\"uid\" name=\"uid\" value=\"$uid\">";
echo<<<EOT
                
        <p id="generalmsg"></p>
                <div class="text-right mt-3">
              <button type="button" class="btn btn-primary" onclick="submitGeneral()">Save changes</button>&nbsp;
              
          </div>
              </div>

            </div>
            <div class="tab-pane fade" id="account-change-password">
              <div class="card-body pb-2">

                <div class="form-group">
                  <label class="form-label">Current password</label>
                  <input type="password" class="form-control" id="currentpwd" onblur="validateCurrentPwd(this)">
                  <p id="currentpwdmsg"></p>
                </div>

                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control" id="newpwd" onblur="validateNewPwd(this)">
                  <p id="newpwdmsg"></p>
                </div>

                <div class="form-group">
                  <label class="form-label">Repeat new password</label>
                  <input type="password" class="form-control" id="repeatpwd" onblur="validateRepeatPwd(this)">
                  <p id="repeatpwdmsg"></p>
                </div>
                <p id="pwdmsg"></p>
                <div class="text-right mt-3">
              <button type="button" class="btn btn-primary" onclick="submitPwd()"">Save changes</button>&nbsp;
              
          </div>

              </div>
            </div>
            <div class="tab-pane fade" id="contact-info">
              <div class="card-body pb-2">

                <div class="form-group">
                 
                  <label class="form-label">Contact Name</label>
EOT;
               echo"<input type=\"text\" class=\"form-control mb-1\" id=\"contactname\" value=\"$contactName\" onblur=\"validateContactName(this)\">

               <p id=\"contactnamemsg\"></p>
               
                </div>
                <div class=\"form-group\">
                 
                  <label class=\"form-label\">Contact E-mail</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"emailaddress\" value=\"$emailAddress\" onblur=\"validateEmailAddress(this)\">

               <p id=\"emailaddressmsg\"></p>
               
                </div>
                <div class=\"form-group\">

              <label class=\"form-label\">Street Address</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"addressline1\" value=\"$addressLine1\" onblur=\"validateStreetAddress(this)\">

               <p id=\"streetaddressmsg\"></p>
               
                </div>
                

                <div class=\"form-group\">
                <div class=\"row\">
                <div class=\"col-8\">
               <label class=\"form-label\">Unit Type</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"addressline2\" value=\"$addressLine2\">
               </div>
                

               <div class=\"col-4\">
               <label class=\"form-label\">Unit Number</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"addressline3\" value=\"$addressLine3\" >
               
                    </div>
                  </div>
                </div>
                <div class=\"form-group\">

               <label class=\"form-label\">City</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"city\" value=\"$city\" onblur=\"validateCity(this)\">

               <p id=\"citymsg\"></p>
               
                </div>

                <div class=\"form-group\">
                <div class=\"row\">

                <div class=\"col-5\">

               <label class=\"form-label\">State</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"state\" value=\"$state\" onblur=\"validateState(this)\">

               <p id=\"statemsg\"></p>
               
                </div>

                 <div class=\"col-5\">

               <label class=\"form-label\">Country</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"country\" value=\"$country\" onblur=\"validateCountry(this)\">

               <p id=\"countrymsg\"></p>
               </div>

                <div class=\"col-2\">

               <label class=\"form-label\">ZIP</label>

               <input type=\"text\" class=\"form-control mb-1\" id=\"zip\" value=\"$zip\" onblur=\"validateZip(this)\">

               <p id=\"zipmsg\"></p>
               
                </div>

              
                </div>
                <input type=\"hidden\" id=\"contactid\" value=\"$contactID\">";


echo<<<EOT
              </div>
              <p id="infomsg"></p>
              <div class="text-right mt-3">
            <button type="button" class="btn btn-primary" onclick="submitInfo()">Save changes</button>&nbsp;
            
        </div>
              <hr class="border-light m-0">


            </div>
          </div>
        </div>
      </div>
    </div>



  </div>

EOT;    
  ?>

  
<script type="text/javascript">
  /*
Upon click of a menu item in menu.php, this adds the item to the local storage and displays a message that the
item is in the users cart.
*/
"use strict";
function submitGeneral() {
  let email=document.getElementById("email");
  let name=document.getElementById("name");
  let username=document.getElementById("username");

  if (validateEmail(email)&&validateName(name)&&validateUsername(username))
  {
  document.getElementById("generalmsg").innerHTML ="";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("generalmsg").innerHTML = '<div class="msg" style=="font-weight: bold;"'+this.responseText+'</div>';
  }
  xhttp.open("POST", "submitProfile.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  let uid=document.getElementById("uid").value;
  let name=document.getElementById("name").value;
  let username=document.getElementById("username").value;
  let email=document.getElementById("email").value;
 
  xhttp.send(`uid=${uid}&name=${name}&username=${username}&email=${email}`);
}
}

function submitPwd() {
  let currentPwd=document.getElementById("currentpwd");
  let newPwd=document.getElementById("newpwd");
  let repeatPwd=document.getElementById("repeatpwd");

  if (validateCurrentPwd(currentPwd)&&validateNewPwd(newPwd)&&validateRepeatPwd(repeatPwd))
  {
  document.getElementById("pwdmsg").innerHTML ="";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("pwdmsg").innerHTML = '<div class="msg" style=="font-weight: bold;"'+this.responseText+'</div>';
  }
  xhttp.open("POST", "submitPassword.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let uid=document.getElementById("uid").value;
  let currentPwdVal=currentPwd.value;
  let newPwdVal=newPwd.value;

  xhttp.send(`uid=${uid}&currentPwd=${currentPwdVal}&newPwd=${newPwdVal}`);
}
}

function validateEmail(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("emailmsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">E-mail cannot be empty</div>';
    msg.className="text-danger";
  }
  else if (!(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field)))
  {
    msg.innerHTML='<div class="msg font-weight: bold;">Invalid E-mail</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}
function validateName(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("namemsg");
  if (field.length<2)
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Name should be at least 2 characters long</div>';
    msg.className="text-danger";
  }
  else if (!(/^[A-Za-z\s]+$/.test(field)))
  {
    msg.innerHTML='<div class="msg font-weight: bold;">Invalid characters used</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}
function validateUsername(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("usernamemsg");
  if (field.length<2)
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Username should be at least 2 characters long</div>';
    msg.className="text-danger";
  }
  else if (!(/^[a-z0-9_\.]+$/.test(field)))
  {
    msg.innerHTML='<div class="msg font-weight: bold;"> Usernames can only have: <br>- Lowercase Letters (a-z)  <br>- Numbers (0-9) <br>- Dots (.) <br>- Underscores (_)</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateCurrentPwd(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("currentpwdmsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Enter Your Current Password</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateNewPwd(id) {


  var field=id.value;
  var flag=false;
  var msg=document.getElementById("newpwdmsg");
  var output="";

if (field.length<8||field.length>15)
output+="<br>- Be 8-15 Character Long";
if (!/(?=.*[A-Z])/.test(field))
  output+="<br>- One Uppercase Letter (A-Z)";
if (!/(?=.*[a-z])/.test(field))
  output+="<br>- One Lowercase Letter (a-z)";
if (!/(?=.*\d)/.test(field))
  output+="<br>- One Digit (0-9)";

 /*if (!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,15}$/.test(field)))
  {
    msg.innerHTML='<div class="msg font-weight: bold;"> Passwords must contain: <br>- One Uppercase Letter (A-Z) <br>- One Lowercase Letter (a-z)  <br>- One Digit (0-9) <br>- Be 8-15 Character Long</div>';
    msg.className="text-danger";
  }
  */
 

  if (output!="")
  {
    msg.innerHTML='<div class="msg font-weight: bold;">Passwords must contain:'+output+'</div>';
    msg.className="text-danger";
  }

  else 
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateRepeatPwd(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("repeatpwdmsg");
  if (field!=document.getElementById("newpwd").value)
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Does Not Match Your New Password</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateContactName(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("contactnamemsg");
  if (field.length<2)
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Name should be at least 2 characters long</div>';
    msg.className="text-danger";
  }
  else if (!(/^[A-Za-z\s]+$/.test(field)))
  {
    msg.innerHTML='<div class="msg font-weight: bold;">Invalid characters used</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateEmailAddress(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("emailaddressmsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">E-mail cannot be empty</div>';
    msg.className="text-danger";
  }
  else if (!(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field)))
  {
    msg.innerHTML='<div class="msg font-weight: bold;">Invalid E-mail</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateStreetAddress(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("streetaddressmsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Street address cannot be empty</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateCity(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("citymsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">City cannot be empty</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateState(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("statemsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">State cannot be empty</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateCountry(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("countrymsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">Country cannot be empty</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function validateZip(id) {
  var field=id.value;
  var flag=false;
  var msg=document.getElementById("zipmsg");
  if (field=="")
  {
    msg.innerHTML='<div class="msg" style=="font-weight: bold;">ZIP cannot be empty</div>';
    msg.className="text-danger";
  }
  else
  {
    flag=true;
    msg.innerHTML="";
  }


  return flag;
}

function submitInfo() {
  let contactName=document.getElementById("contactname");
  let emailAddress=document.getElementById("emailaddress");
  let addressLine1=document.getElementById("addressline1");
  let city=document.getElementById("city");
  let state=document.getElementById("state");
  let country=document.getElementById("country");
  let zip=document.getElementById("zip");
  


  if (validateContactName(contactName)&&validateEmailAddress(emailAddress)&&validateStreetAddress(addressLine1)&&validateCity(city)&&validateState(state)&&validateCountry(country)&&validateZip(zip))
  {
  document.getElementById("infomsg").innerHTML ="";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("infomsg").innerHTML = '<div class="msg" style=="font-weight: bold;"'+this.responseText+'</div>';
  }
  xhttp.open("POST", "submitInfo.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let uid=document.getElementById("uid").value;
  let contactID=document.getElementById("contactid").value;
  let addressLine1=document.getElementById("addressline1").value;
  let addressLine2=document.getElementById("addressline2").value;
  let addressLine3=document.getElementById("addressline3").value;
  let contactName=document.getElementById("contactname").value;
  let emailAddress=document.getElementById("emailaddress").value;
  let city=document.getElementById("city").value;
  let state=document.getElementById("state").value;
  let country=document.getElementById("country").value;
  let zip=document.getElementById("zip").value;
  xhttp.send(`uid=${uid}&contactID=${contactID}&al1=${addressLine1}&al2=${addressLine2}&al3=${addressLine3}&name=${contactName}&email=${emailAddress}&city=${city}&state=${state}&country=${country}&zip=${zip}`);
}
}
</script>
<script>

</script>
</body>
</html>