

//****************************************************************************
// Registration Form Validation
// ***************************************************************************

// Get registration input field elements
let emailField = document.getElementById("email");
let usernameField = document.getElementById("username");
let passwordField = document.getElementById("password");
let retypePasswordField = document.getElementById("retype");
let firstNameField = document.getElementById("firstName");
let lastNameField = document.getElementById("lastName");

// Get registration input labels
let firstNameLabel = document.getElementById("firstNameLabel");
let lastNameLabel = document.getElementById("lastNameLabel");
let emailLabel = document.getElementById("emailLabel");
let usernameLabel = document.getElementById("usernameLabel");
let passwordLabel = document.getElementById("passwordLabel");
let retypePasswordLabel = document.getElementById("retypeLabel");



// Error messages for each registration input field
let defaultMsg = "";
let firstNameErrorMsg = "Must enter a first name";
let lastNameErrorMsg = "Must enter a last name";
let emailErrorMsg = "Email address should be non-empty with the format xyx@xyz.xyz";
let usernameErrorMsg = "Username should be non-empty, and within 30 characters long";
let passwordErrorMsg = "Password should be at least 8 characters, and must include a uppercase letter, lowercase letter, number and symbol";
let retypePasswordErrorMsg = "Passwords do not match";




// Method to create and return new error element with class="warning"
// Arguments:
//      errorMsg: error message to display
//      elementId: id of the element
function createErrorElement(errorMsg, elementId) {
    let errorElement = document.createElement('span');
    errorElement.setAttribute("class", "warning");
    errorElement.id = elementId;
    errorElement.innerHTML = errorMsg;
    return errorElement;
}

function createErrorMarker(markerId) {
    let errorMarker = document.createElement('img');
    errorMarker.src = "../images/errorMarker.png";
    errorMarker.setAttribute("class", "errorMarker");
    errorMarker.id = markerId;
    return errorMarker;
}

// Method to remove error message when input is valid
// Arguments:
//      inputField: input field to add event listener to
//      errorId: id of error message to be removed
//      validationFunction: the validation function for each input
function removeErrorWhenValidInput(inputField, errorId, errorMarkerId, validationFunction) {
    inputField.addEventListener("input", function() {
        let errorElement = document.getElementById(errorId);
        let errorMarkerElement = document.getElementById(errorMarkerId);
        if (validationFunction() === defaultMsg && errorElement !== null) {
            errorElement.remove();
            errorMarkerElement.remove();
            inputField.style.borderColor = "#9e9e9e";
        }
    });
}

// Calling the method to actively remove error messages when the input data becomes valid
removeErrorWhenValidInput(firstNameField, "firstNameError", "firstNameErrorMarker", validateFirstName);
removeErrorWhenValidInput(lastNameField, "lastNameError", "lastNameErrorMarker", validateLastName);
removeErrorWhenValidInput(emailField, "emailError", "emailErrorMarker", validateEmail);
removeErrorWhenValidInput(usernameField, "usernameError", "usernameErrorMarker", validateUsername);
removeErrorWhenValidInput(passwordField, "passwordError", "passwordErrorMarker", validatePassword);
removeErrorWhenValidInput(retypePasswordField, "retypePasswordError", "retypePasswordErrorMarker", validateRetypePassword);


// Method to clear all error indicators
function clearAllErrors() {
    let errors = document.getElementsByClassName("warning");
    let errorMarkers = document.getElementsByClassName("errorMarker");
    let textInputs = document.getElementsByTagName("input");
    for (let i = errors.length - 1; i >= 0; i--) {
        if (elementExists(errors[i].id)) {
            errors[i].remove();
        }
        
    }
    for (let i = errorMarkers.length - 1; i >= 0; i--) {
        if (elementExists(errorMarkers[i].id)) {
            errorMarkers[i].remove();
        }
        
    }
    for (let i = 0; i < textInputs.length; i++) {
        textInputs[i].style.borderColor = "#9e9e9e";
    }
}

// Remove all error messages when reset button is clicked
// document.querySelector('button[type="reset"]').addEventListener("click", clearAllErrors);

usernameTakenError = document.getElementById("usernameTakenError");
document.querySelector("button[type='reset']").addEventListener("click", function(event) {
    console.log("clearing run");
    event.preventDefault();
    if (usernameTakenError) {
        usernameTakenError.textContent = "";
    }

    
    console.log(firstNameField.value);
    clearAllErrors();
    firstNameField.value = "";
    lastNameField.value = "";
    usernameField.value = "";
    emailField.value = "";
    console.log(firstNameField.value);
})




// -------------------------------------------------------------------------------
// Input validators
// -------------------------------------------------------------------------------


// Check that email is in correct format
function validateEmail() {
    let emailRegEx = /\S+@\S+\.\S+/;
    let error = defaultMsg;
    if (!emailRegEx.test(emailField.value.trim())) {
        error = emailErrorMsg;
    }
    return error;
}


// Check that username is non-empty and less than 30 charaters
function validateUsername() {
    let error = defaultMsg;
    if (usernameField.value.trim() === "" || usernameField.value.trim().length >= 30) {
        error = usernameErrorMsg;
    }
    return error;
}

// Check that password is 8 or more characters
function validatePassword() {
    let error = defaultMsg;
    //** CHANGE THIS BACK FOR CORRECT VALIDATION */
    // Minimum of eight characters, at least: one uppercase letter, one lowercase letter, one number and one special character
    // let passwordRegEx = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
    // if (!passwordRegEx.test(passwordField.value)) {
    if (passwordField.value.length < 8) {
        error = passwordErrorMsg;
    }
    return error;
}

// Check that re-typed password matches original password and is non-empty
function validateRetypePassword() {
    let error = defaultMsg;
    if (retypePasswordField.value !== passwordField.value || retypePasswordField.value === "") {
        error = retypePasswordErrorMsg;
    }
    return error;
}

// Check that first name input if non-empty
function validateFirstName() {
    let error = defaultMsg;
    if (firstNameField.value.trim() === "") {
        error = firstNameErrorMsg;
    }
    return error;
}

// Check if last name is non-empty
function validateLastName() {
    let error = defaultMsg;
    if (lastNameField.value.trim() === "") {
        error = lastNameErrorMsg;
    }
    return error;
}


// Method to check if element already exists in the HTML; returns true if it does exist, false otherwise
function elementExists(elementId) {
    return document.getElementById(elementId) !== null
}

function removeError(fieldError) {
    if (elementExists(fieldError.id)) {
        fieldError.remove();
    }
}
function displayError(fieldError, fieldErrorMarkerId, inputField) {
    let fieldErrorMarker = document.getElementById(fieldErrorMarkerId);
        if (!elementExists(fieldError.id) && fieldErrorMarker != null) {  //** */
            inputField.insertAdjacentElement("afterend", fieldError);
        }
}

// Create event listeners on inputs so when the input is 'focused' the error message shows and when 'unfocused' the error message is removed
// Arguments:
//      inputField: the specific input field DOM element
//      fieldErrorMsg: the (String) error message to display
//      fieldErrorId: the (String) field error's ID to be set
//      fieldErrorMarkerId: the (String) field error marker's id to access the field errror marker and display message beside
// 
function createFocusBlurEventListeners(inputField, fieldErrorMsg, fieldErrorId, fieldErrorMarkerId) {
    
    // Create input field's error element
    let fieldError = createErrorElement(fieldErrorMsg, fieldErrorId);

    // Store function reference, by reusing existing function reference if it exists or creating new function reference if it
    // doesn't exist (avoiding function duplications)
    inputField.displayErrorFunction = inputField.displayErrorFunction || (() => displayError(fieldError, fieldErrorMarkerId, inputField));
    inputField.removeErrorFunction = inputField.removeErrorFunction || (() => removeError(fieldError));

    // Remove the event listeners if they exist
    inputField.removeEventListener("focus", inputField.displayErrorFunction);
    inputField.removeEventListener("blur", inputField.removeErrorFunction);

    // Add event listener to display input error message when the input is 'focused' 
    inputField.addEventListener("focus", inputField.displayErrorFunction);
    // Add event listener to remove the error message when the input is 'unfocused'
    inputField.addEventListener("blur", inputField.removeErrorFunction);
}

// Validate the form by validating each form element and inserting error message when input is invalid
function validate() {
    let valid = true;

    clearAllErrors();

    // Check first name input against first name validation and insert error element if invalid and doesn't already exist
    if (validateFirstName() !== defaultMsg) {

        // Make border of input field red
        firstNameField.style.borderColor = "red";
        
        // Create error marker element
        var firstNameErrorMarker = createErrorMarker("firstNameErrorMarker");

        // Insert error marker element adjacent to input field
        firstNameLabel.insertAdjacentElement("beforeend", firstNameErrorMarker);

        // Create event listeners to insert error message when input is 'focused' on and removed when 'unfocused'
        createFocusBlurEventListeners(firstNameField, firstNameErrorMsg, "firstNameError", firstNameErrorMarker.id);

        valid = false;
    }
    
    // Check last name input against last name validatioin and insert error element if invalid and doesn't already exist
    if (validateLastName() !== defaultMsg) {

        // Make border of input field red
        lastNameField.style.borderColor = "red";

        // Create error marker element
        var lastNameErrorMarker = createErrorMarker("lastNameErrorMarker");

        // Insert error marker element adjacent to input field
        lastNameLabel.insertAdjacentElement("beforeend", lastNameErrorMarker);

        // Create event listeners to insert error message when input is 'focused' on and removed when 'unfocused'
        createFocusBlurEventListeners(lastNameField, lastNameErrorMsg, "lastNameError", lastNameErrorMarker.id);

        valid = false;
    }

    // Check email input against email validation and insert error element if invalid and doesn't already exist
    if (validateEmail() !== defaultMsg) {

        // Make border of input field red
        emailField.style.borderColor = "red";

        // Create error marker element
        var emailErrorMarker = createErrorMarker("emailErrorMarker");

        // Insert error marker element adjacent to input field
        emailLabel.insertAdjacentElement("beforeend", emailErrorMarker);
        
        // Create event listeners to insert error message when input is 'focused' on and removed when 'unfocused'
        createFocusBlurEventListeners(emailField, emailErrorMsg, "emailError", emailErrorMarker.id);

        valid = false;
    }

    // Check username input against username validation and insert error element if input is invalid and doesn't already exist
    if (validateUsername() !== defaultMsg) {

        // Make border of input field red
        usernameField.style.borderColor = "red";

        // Create error marker element
        var usernameErrorMarker = createErrorMarker("usernameErrorMarker");

        // Insert error marker element adjacent to input field
        usernameLabel.insertAdjacentElement("beforeend", usernameErrorMarker);
        
        // Create event listeners to insert error message when input is 'focused' on and removed when 'unfocused'
        createFocusBlurEventListeners(usernameField, usernameErrorMsg, "usernameError", usernameErrorMarker.id);

        valid = false;
    }

    // Check password input against password validation and insert error element if invalid and doesn't already exist
    if (validatePassword() !== defaultMsg) {

        // Make border of input field red
        passwordField.style.borderColor = "red";

        // Create error marker element
        var passwordErrorMarker = createErrorMarker("passwordErrorMarker");

        // Insert error marker element adjacent to input field
        passwordLabel.insertAdjacentElement("beforeend", passwordErrorMarker);
        
        // Create event listeners to insert error message when input is 'focused' on and removed when 'unfocused'
        createFocusBlurEventListeners(passwordField, passwordErrorMsg, "passwordError", passwordErrorMarker.id);

        valid = false;
    }

    // Check re-typed input against re-type password validation and insert error element if invalid and doesn't already exist
    if (validateRetypePassword() !== defaultMsg) {

        // Make border of input field red
        retypePasswordField.style.borderColor = "red";

        // Create error marker element
        let retypePasswordErrorMarker = createErrorMarker("retypePasswordErrorMarker");

        // Insert error marker element adjacent to input field
        retypePasswordLabel.insertAdjacentElement("beforeend", retypePasswordErrorMarker);
        
        // Create event listeners to insert error message when input is 'focused' on and removed when 'unfocused'
        createFocusBlurEventListeners(retypePasswordField, retypePasswordErrorMsg, "retypePasswordError", retypePasswordErrorMarker.id);

        valid = false;
    }

    // Convert username to lowercase upon valid form submission attempt
    if (valid) {
        usernameField.value = usernameField.value.toLowerCase();
    }
    return valid;
}




//********************************************************************************
// Login Form Validation
//********************************************************************************

function validateLogin() {
    let loginUsername = document.getElementById("loginUsername");
    let loginPassword = document.getElementById("password");
    let loginValid = true;
    let loginErrorMsg = "Please fill in username and password";
    let loginError = document.createElement("span");
    loginError.innerHTML = loginErrorMsg;

    if (loginUsername.value === "" || loginPassword.value === "") {
        loginPassword.insertAdjacentElement("afterend", loginErrorMsg);
        loginValid = false;
    }
    return loginValid;
}