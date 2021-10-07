function checkName(event){
    var myName = event.currentTarget;
    var pos = myName.value.search(/^[A-Za-z ]+$/);
    if (pos != 0) {
        alert("The name you entered (" + myName.value +
          ") is not in the correct form. \n" +
          "The name field contains alphabet characters and character spaces.");
    myName.focus();
    myName.select();
	return false;
    }
}

function validateEmail(event){
    var email = event.currentTarget;
    var pos = email.value.search(/^\w+([\.-]?\w+)*@[\w]+(\.[\w]+){0,2}\.[\w]{2,3}$/);
    if (pos != 0){
        alert("The email " + email.value +
        " is not in the correct form"
        );
    email.focus();
    email.select();
    return false;
    }
}

function checkDate(event){
    var selectedDate = new Date(event.currentTarget.value);
    var today = new Date()
    if (selectedDate.getDate() <= today.getDate()){
        alert("The start date can not be today or in the past");
        event.currentTarget.focus();
        event.currentTarget.select();
        return false;
    }

}

var nameNode = document.getElementById("name");
nameNode.addEventListener("change", checkName, false);

var emailNode = document.getElementById("email");
emailNode.addEventListener("change", validateEmail, false);

var dateNode = document.getElementById("startDate");
dateNode.addEventListener("change", checkDate, false);
