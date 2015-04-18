function validateUserSignInFields() {
    var email = document.forms["signInForm"]["emailAddress"].value;
    if (email == null || email == "") {
        alert("Email must be filled out");
        return false;
    }
    var pw = document.forms["signInForm"]["password"].value;
    if (pw == null || pw == "") {
        alert("Password must be filled out");
        return false;
    }
    else {
    	return true;
    }
}
