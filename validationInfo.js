"use strict";

function validateName(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("contactNamemsg");
	if(field == "")
	{
		msg.innerHTML = "Name cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validateEmail(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("emailmsg");
	if(field == "")
	{
		msg.innerHTML = "Email cannot be empty!";
		msg.className = "text-danger";
	}
	else
	{
		if(!(/^(.+)@(.+)$/.test(field)))
		{
			msg.innerHTML = "Email is not correct!";
			msg.className = "text-danger";
		}
		else
			good = true;
	}
	return good;
}

function validateAddress(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("addressmsg");
	if(field == "")
	{
		msg.innerHTML = "Address line 1 cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validateCity(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("citymsg");
	if(field == "")
	{
		msg.innerHTML = "City cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validateState(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("statemsg");
	if(field == "")
	{
		msg.innerHTML = "State cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validateZip(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("zipmsg");
	if(field == "")
	{
		msg.innerHTML = "Zipcode cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validateCountry(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("countrymsg");
	if(field == "")
	{
		msg.innerHTML = "Country cannot be empty!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validate(id)
{
	let nameid = document.getElementById("contactName");
	let emailid = document.getElementById("email");
	let addressid = document.getElementById("address");
	let cityid = document.getElementById("city");
	let zipid = document.getElementById("zip");
	let countryid = document.getElementById("country");
	if(validateName(nameid) && validateEmail(emailid) && validateAddress(addressid) && validateCity(cityid) && validateZip(zipid) &&validateCountry(countryid))
		return true;
	else
		return false;
}