/*getting the form*/
var form = document.querySelector('form');
/*getting username variables*/
var username = document.querySelector('#usernameDiv');
var usernameError = username.querySelector('.error');
var usernameField = username.querySelector('input');
/*getting email variables*/
var email = document.querySelector('#emailDiv');
var emailError = email.querySelector('.error');
var emailField = email.querySelector('input');
/*getting password variables*/
var password = document.querySelector('#passwordDiv');
var passwordError = password.querySelector('.error');
var passwordField = password.querySelector('input');
/*getting repeatPassword variables*/
var repeatPassword = document.querySelector('#repeatPasswordDiv');
var repeatPasswordError = repeatPassword.querySelector('.error');
var repeatPasswordField = repeatPassword.querySelector('input');

form.addEventListener("submit", function(event) {

  checkusername(usernameField, usernameError);
  checkEmail(emailField, emailError);
  checkPassword(passwordField, passwordError);
  checkRepeatPassword(repeatPasswordField, repeatPasswordError, passwordField);

}, false);

function checkusername(username, error) {
  var reg = /^[a-zA-Z0-9_]+$/;

  /*
  **if there is nothing entered or the username is of not sufficient length
  */
  if (username.value == "" || (username.value.length < 4 || username.value.length > 8)) {
    var msg = "enter a username (4-8 characters)";
    
    addError(error, username, msg, event);
    return;
  }
  /*
  **if the username contains not only letters, digits, and underscore
  */
  if (!reg.test(username.value)) {
    var msg = "special characters are not allowed";
    
    addError(error, username, msg, event);
    return;
  }
  /*
  **removing the error classes in case everything is alright
  */
  popError(error, username);
}

function checkEmail(email, error) {
  /*regex to validate an email
  *
  *1)any number of blocks separated with dot before @ is possible
  *2)only letters, numbers, and underscore are allowed before @
  *3)only letters and hyphens are allowed for domain
  *4)complicated extensions are allowed (com.ua or org.su)
  */
  var reg = /^[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*@[a-zA-Z-]+\.([a-zA-Z]+){2,}(\.([a-zA-Z]+){2,})*$/;

  /*
  **if there is nothing entered or the email is of not correct format
  */
  if (email.value == "" || !reg.test(email.value)) {
    var msg = "enter a valid email address";

    addError(error, email, msg, event);
    return;
  }
  /*
  **removing the error classes in case everything is alright
  */
  popError(error, email);
}

function checkPassword(password, error) {
  /*regex to validate an password
  *
  *1)the password should consist only of letters, digits, and underscore
  *2)the password should be from 8 to 32 characters long
  *3)the password should contain at least 1 lowercase letter
  *4)the password should contain at least 1 uppercase letter
  *5)the password should contain at least 1 digit
  */
  var reg = /^(?=[a-zA-Z0-9_]{8,32}$)(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)/;

  /*
  **if there is nothing entered
  */
  if (password.value == "") {
    var msg = "enter a password";

    addError(error, password, msg, event);
    return;
  }
  /*
  **if the password does not contain at least one: lowercase letter, uppercase letter, and 1 digit
  **or is of insufficient length
  */
  if (!reg.test(password.value)) {
    var msg = "no special characters" + '\n'
    + "at least one uppercase letter" + '\n' +  "at least one lowercase letter" + '\n'
    + "at least one digit" + '\n' + "from 8 to 32 characters";

    addError(error, password, msg, event);
    return;
  }
  /*
  **removing the error classes in case everything is alright
  */
  popError(error, password);
}

function checkRepeatPassword(repeatPassword, error, password) {
  /*if both the password and repeated password are not entered*/
  if (repeatPassword.value == "" && password.value == "") {
    var msg = "re-enter your password";

    addError(error, repeatPassword, msg, event);
    return;
  }
  /*
  **if the password is not entered, and the repeated password is entered
  */
  if (repeatPassword.value != "" && password.value == "") {
    var msg = "you have to enter a password first";

    addError(error, repeatPassword, msg, event);
    return;
  }
  /*
  **if the password does not match the repeated one
  */
  if (repeatPassword.value != password.value) {
    var msg = "passwords do not match";

    addError(error, repeatPassword, msg, event);
    return;
  }
  /*
  **removing the error classes in case everything is alright
  */
  popError(error, repeatPassword);
}

function addError(error, field, text, event) {
  error.textContent = text;
  error.classList.add("active-error");
  field.classList.add("invalid-field");

  event.preventDefault();
}

function popError(error, field) {
  error.textContent = "";
  error.classList.remove("active-error");
  field.classList.remove("invalid-field");
}
