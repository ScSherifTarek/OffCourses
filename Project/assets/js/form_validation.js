function validateSignUpInstructorForm() {
      var fName = document.forms["instructorSignUpForm"]["fname"].value;
      var lName = document.forms["instructorSignUpForm"]["lname"].value;
      var email = document.forms["instructorSignUpForm"]["email"].value;
      var password = document.forms["instructorSignUpForm"]["pass"].value;
      var confirm_password = document.forms["instructorSignUpForm"]["cfPass"].value;
      if(isValidName(fName) && isValidName(lName) && isValidEmail(email) && checkPassword(password, confirm_password))
      {
        //Now check the email in db!
        alert("Congratulation U are now part of our site :\"D");
        return true;
      }
      else
      {
        if(!isValidName(fName))//First Name label is empty!
        {
          alert("fName");
          // document.getElementById("demo").style.color="red";
        }
        if (!isValidName(lName)) { //last Name label is empty!
          alert("lName");
          // document.getElementById("demo").style.color="red";
        }
        if (!isValidEmail(email)) { //email label is empty!
          alert("email");
          // document.getElementById("demo").style.color="red";
        }
        if (!checkPassword(password, confirm_password))
        {
          alert("pass");
            // document.getElementById("demo").style.color="red";
        }
        return false;
      }
}
function validateSignInInsructorForm()
{
  var email = document.forms["instructorSignInForm"]["inMail"].value;
  var password = document.forms["instructorSignInForm"]["inPass"].value;
  alert("LOL");
  if(isValidEmail(email) && isValidPassword(password))
  {
    alert("Now we can check our database :D");
    return true;
  }
  else
  {
     alert("Try again!");
     return false;
  }
}
function validateSignUpAcademyForm() {
  var Name = document.forms["academySignUpForm"]["name"].value;
  var email = document.forms["academySignUpForm"]["email"].value;
  var Address = document.forms["academySignUpForm"]["address"].value;
  var password = document.forms["academySignUpForm"]["pass"].value;
  var confirm_password = document.forms["academySignUpForm"]["cfPass"].value;
  if(isValidName(Name) && isValidEmail(email) && checkPassword(password, confirm_password))
  {
    //Now check the email in db!
    alert("Congratulation U are now part of our site :\"D");
    return true;
  }
  else
  {
    if(!isValidName(Name))//First Name label is empty!
    {
      alert("Not valid name!");
    }

    if (!isValidEmail(email)) { //email label is empty!
      alert("Not valid email!");
      // return false;
    }
    if (!checkPassword(password, confirm_password))
    {

    }
    return false;
  }
}
function validateSignInAcademyForm()
{
  var email = document.forms["academySignInForm"]["acMail"].value;
  var password = document.forms["academySignInForm"]["acPass"].value;
  if(isValidEmail(email) && isValidPassword(password))
  {
    alert("Now we can check our database :D");
    return true;
  }
  else
  {
     alert("Try again!");
     return false;
  }
}
function isValidName(n)
{
    if(n == "" || n.length > 45)
    {
        return false;
    }

    var letters = /^[A-Za-z ]+$/;
    // var letters = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ"
    if(!(n.match(letters)))
    {
      return false;
    }
    return true;
}

function isValidEmail(email) {
    if(email == "" || email.length > 45)
    {
        return false;
    }
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function isValidPassword(pass)
{
  re1 = /[0-9]/;
  re2 = /[a-z]/;
  re3 = /[A-Z]/;
  if((pass.length < 6 || pass.length > 45) || ((!(re1.test(pass))) || (!(re2.test(pass))) || (!(re3.test(pass))))) {
    alert("Error: Wrong Password!");
    // form.pwd1.focus();
    return false;
  }
  else
  {
    alert("LOL");
    return true;
  }
}

function checkPassword(pass, cfPass)
  {
    // re = /^\w+$/;
    if(pass != "" && pass == cfPass) {
      if(pass.length < 6) {
        alert("Error: Password must contain at least six characters!");
        // form.pwd1.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(pass)) {
        alert("Error: password must contain at least one number (0-9)!");
        // form.pwd1.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(pass)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        // form.pwd1.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(pass)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        // form.pwd1.focus();
        return false;
      }
    } 
    else {
      alert("Error: Please check that you've entered and confirmed your password!");
      // form.pwd1.focus();
      return false;
    }
    alert("You entered a valid password: " + pass);
    return true;
  }
