//********************************************************************************
// Login Form Validation
//********************************************************************************

function validateLogin() {
    
    // Remove previous errors if they exist
    let existingError = document.querySelector(".warning");
    if (existingError) {
        existingError.remove();
    }

    // Grab login input fields
    let loginUsername = document.getElementById("loginUsername");
    let loginPassword = document.getElementById("loginPassword");
    let loginValid = true;

    // Error messages for empty fields
    let bothLoginErrorMsg = "Please fill in username and password";
    let usernameLoginErrorMsg = "Please enter username";
    let passwordLoginErrorMsg = "Please enter password";

    // Create error element
    let loginError = document.createElement("span");
    loginError.setAttribute("class", "warning");

    // If both username and password empty
    if (loginUsername.value === "" && loginPassword.value === "") {
        // Insert error message for both fields empty
        loginError.innerHTML = bothLoginErrorMsg;
        loginPassword.insertAdjacentElement("afterend", loginError);
        loginValid = false;
    }
    // If just username field is empty
    else if (loginUsername.value == "") {
        // Insert error message for empty username field
        loginError.innerHTML = usernameLoginErrorMsg;
        loginPassword.insertAdjacentElement("afterend", loginError);
        loginValid = false;
    }
    // If just password field is empty
    else if (loginPassword.value == "") {
        // Insert error message for empty password field
        loginError.innerHTML = passwordLoginErrorMsg;
        loginPassword.insertAdjacentElement("afterend", loginError);
        loginValid = false;
    }
    // Return if form field are filled or not
    return loginValid;
}