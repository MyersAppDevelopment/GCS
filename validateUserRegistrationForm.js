function validateUserEntryFields() {
    var fname = document.forms["registrationForm"]["firstName"].value;
    if (fname == null || fname == "") {
        alert("First Name must be filled out");
        return false;
    }
    var lname = document.forms["registrationForm"]["lastName"].value;
    if (lname == null || lname == "") {
        alert("Last Name must be filled out");
        return false;
    }
    var email = document.forms["registrationForm"]["emailAddress"].value;
    if (email == null || email == "") {
        alert("Email must be filled out");
        return false;
    }
    var pw = document.forms["registrationForm"]["password"].value;
    var cpw = document.forms["registrationForm"]["confirmPassword"].value;
    if (pw == null || pw == "") {
        alert("Password must be filled out");
        return false;
    }
    else if (cpw == null || cpw == "") {
    		alert("Confirm Password must be filled out");
    		return false;
    }
    else if (pw != cpw) {
    		alert("Passwords Do Not Match");
    		return false;
    }
    else {
    	return true;
    }
}
