"use strict";

function validateUsername(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("usernamemsg");
	if(field == "")
	{
		msg.innerHTML = "Username cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validatePassword(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("passwordmsg");
	if(field == "")
	{
		msg.innerHTML = "Password cannot be empty!";
		msg.className = "text-danger";
	}
	else
	{
		if(!(/^.{6,}$/.test(field)) && !(/\d+/.test(field)) && !(/[a-zA-Z]+/.test(field)))
		{
			msg.innerHTML = "Password is not correct!";
			msg.className = "text-danger";
		}
		else
			good = true;
	}
	return good;
}

function validate(id)
{
	let userid = document.getElementById("username");
	let password = document.getElementById("password");
	if(validateUsername(userid) && validatePassword(password))
		return true;
	else
		return false;
}