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