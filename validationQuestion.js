"use strict";

function validateContact(id)
{
    /*
	let field = id.value;
	let good = false;
	let msg = document.getElementById("contactmsg");
	if(field == "")
	{
		//msg.innerHTML = "Contact ID cannot be empty!";
		//msg.className = "text-danger";
	}
	else
		good = true;*/

	return true;
}

function validateQuestion(id)
{
	let field = id.value;
	let good = false;
	let msg = document.getElementById("questionmsg");
	if(field == "")
	{
		msg.innerHTML = "Question cannot be empty!";
		msg.className = "text-danger";
	}
	else if((/[*]/.test(field)))
	{
		msg.innerHTML = "Question cannot contain '*'!";
		msg.className = "text-danger";
	}
	else
		good = true;

	return good;
}

function validate(id)
{
	let contactid = document.getElementById("contact");
	let questionid = document.getElementById("question");
	if(validateContact(contactid) && validateQuestion(questionid))
		return true;
	else
		return false;
}