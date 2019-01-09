function validateSignUpInstructorForm() {
      var fName = document.forms["instructorSignUpForm"]["fname"].value;
      var lName = document.forms["instructorSignUpForm"]["lname"].value;
      var email = document.forms["instructorSignUpForm"]["email"].value;
      var password = document.forms["instructorSignUpForm"]["pass"].value;
      var confirm_password = document.forms["instructorSignUpForm"]["cfPass"].value;
      if(isValidName(fName, 20) && isValidName(lName, 20) && isValidEmail(email, 20) && checkPassword(password, confirm_password, 20))
      {
        //Now check the email in db!
        alert("Congratulation U are now part of our site :\"D");
        return true;
      }
      else
      {
        // $( ".hello" ).remove();
        // var err ="Check your ";
        // if(!isValidName(fName))//First Name label is empty!
        // {
        //   var fNameErr = "first name! ";
        //   err += fNameErr;
        //   // alert("fName");
        //   // document.getElementById("demo").style.color="red";
        // }
        // if (!isValidName(lName, 20)) { //last Name label is empty!
        //   var lNameErr = "last name! ";
        //   err += lNameErr;
        //   // alert("lName");
        //   // document.getElementById("demo").style.color="red";
        // }
        // if (!isValidEmail(email, 20)) { //email label is empty!
        //   var emailErr = "email! ";
        //   err += emailErr;
        //   // alert("email");
        //   // document.getElementById("demo").style.color="red";
        // }
        // if (!checkPassword(password, confirm_password, 20))
        // {
        //   var passErr = "password!"
        //   err += passErr;
        //   // alert("pass");
        //     // document.getElementById("demo").style.color="red";
        // }
        // $("#err").prepend('<div class="hello" style="padding:0 20px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
        return false;
      }
}
function validateSignInInsructorForm()
{
  var email = document.forms["instructorSignInForm"]["inMail"].value;
  var password = document.forms["instructorSignInForm"]["inPass"].value;
  // alert("LOL");
  if(isValidEmail(email, 20) && isValidPassword(password, 20))
  {
    alert("Now we can check our database :D");
    return true;
  }
  else
  {
    // $( ".hello" ).remove();
    // var err = "Check your ";
    // if (!isValidEmail(email, 20)) {
    //   err += "email! ";
    // }
    // if (!isValidPassword(password, 20)) {
    //   err += "password!";
    // }
    // $("#err").prepend('<div class="hello" style="padding:0 20px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');

     // alert("Try again!");
     return false;
  }
}
function validateSignUpAcademyForm() {
  var Name = document.forms["academySignUpForm"]["name"].value;
  var email = document.forms["academySignUpForm"]["email"].value;
  var Address = document.forms["academySignUpForm"]["address"].value;
  var password = document.forms["academySignUpForm"]["pass"].value;
  var confirm_password = document.forms["academySignUpForm"]["cfPass"].value;
  if(isValidName(Name, 20) && isValidEmail(email, 20) && checkPassword(password, confirm_password, 20) && Address != "")
  {
    //Now check the email in db!
    alert("Congratulation U are now part of our site :\"D");
    return true;
  }
  else
  {
    // $( ".hello" ).remove();
    // var err = "Check your ";
    // if(!isValidName(Name, 20))//First Name label is empty!
    // {
    //   err += "name! ";
    //   // alert("Not valid name!");
    // }
    // if (!isValidEmail(email, 20)) { //email label is empty!
    //   err += "email! ";
    //   // alert("Not valid email!");
    //   // return false;
    // }
    // if (!checkPassword(password, confirm_password, 20))
    // {
    //   err += "password! ";
    // }
    // if (Address == "") {
    //   err += "address!";
    // }
    // $("#err").prepend('<div class="hello" style="padding:0 20px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
    return false;
  }
}
function validateSignInAcademyForm()
{
  var email = document.forms["academySignInForm"]["acMail"].value;
  var password = document.forms["academySignInForm"]["acPass"].value;
  if(isValidEmail(email, 20) && isValidPassword(password, 20))
  {
    alert("Now we can check our database :D");
    return true;
  }
  else
  {
    // $( ".hello" ).remove();
    // var err = "Check your ";
    // if (!isValidEmail(email, 20)) {
    //   err += "email! ";
    // }
    // if(!isValidPassword(password, 20))
    // {
    //   err += "password!";
    // }
    //  // alert("Try again!");
    //  $("#err").prepend('<div class="hello" style="padding:0 20px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
     return false;
  }
}

function validateAcademyUpdateForm()
{
  var name = document.forms["AcademyUpdateForm"]["name"].value;
  var phone_no = document.forms["AcademyUpdateForm"]["phone_no"].value;
  var address = document.forms["AcademyUpdateForm"]["address"].value;
  var password = document.forms["AcademyUpdateForm"]["password"].value;
  var profile_image_url = document.forms["AcademyUpdateForm"]["profile_image_url"].value;
 
  if(isValidName(name, 0) && isValidPassword(password, 0) && isValidPhoneNo(phone_no, 0) && isImage(profile_image_url, 0))
  {
    //Now add to db!
    alert("Done editing :\"D");
    return true;
  }
  else
  {
    /*if(!isValidName(name))//First Name label is empty!
    {
      // alert("Not valid name!");
    }
 
    if (!isValidPassword(password, 0)) { //email label is empty!
      // alert("Not valid password!");
      // return false;
    }
    if (!isValidPhoneNo(phone_no)) {
      // alert("Not valid phone number!");
    }
    if(!isImage(image))
    {
      // alert("Not image!");
    }*/
    return false;
  }
}
 
function validateCourseUpdateForm()
{
  var name = document.forms["CoursesUpdateForm"]["name"].value;
  var start_date = document.forms["CoursesUpdateForm"]["start_date"].value;
  var finish_date = document.forms["CoursesUpdateForm"]["finish_date"].value;
  var price = document.forms["CoursesUpdateForm"]["price"].value;
  var description = document.forms["CoursesUpdateForm"]["description"].value;
  var image = document.forms["CoursesUpdateForm"]["image"].value;
 
  if (isValidName(name, 0) && isValidDate(start_date, finish_date, 0) && isValidPrice(price, 0) && description != "" && isImage(image, 0)) {
    return true;
  }
  else
  {
    // if(!isValidName(name))
    // {
 
    // }
    // else if(!isValidDate(start_date, finish_date))
    // {
 
    // }
    // else if(!isValidPrice(price))
    // {
 
    // }
    // else if(!isImage(image))
    // {
 
    // }
    return false;
  }
}
 
function validateCreateCourseForm()
{
  var name = document.forms["createCourseForm"]["name"].value;
  // var academy = document.forms["createCourseForm"]["academy"].value;
  var instructor_email = document.forms["createCourseForm"]["instructor_email"].value;
  var start_date = document.forms["createCourseForm"]["start_date"].value;
  var finish_date = document.forms["createCourseForm"]["finish_date"].value;
  var price = document.forms["createCourseForm"]["price"].value;
  var description = document.forms["createCourseForm"]["description"].value;
  var image = document.forms["createCourseForm"]["image"].value;
 
  if (isValidName(name, 0) && isValidEmail(instructor_email, 0) && isValidDate(start_date, finish_date, 0) && isValidPrice(price, 0) && description != "" && isImage(image, 0)) {
    return true;
  }
  else
  {
    // if(!isValidName(name))
    // {
 
    // }
    // if(!isValidEmail(instructor_email))
    // {
 
    // }
    // if(!isValidDate(start_date, finish_date))
    // {
 
    // }
    // if(!isValidPrice(price))
    // {
 
    // }
    // if(!isImage(image))
    // {
 
    // }
    return false;
  }
}
 
function validateInstructorUpdateForm()
{
  var first_name = document.forms["instructorUpdateForm"]["first_name"].value;
  var last_name = document.forms["instructorUpdateForm"]["last_name"].value;
  var phone_no = document.forms["instructorUpdateForm"]["phone_no"].value;
  var password = document.forms["instructorUpdateForm"]["password"].value;
  var previous_experience = document.forms["instructorUpdateForm"]["previous_experience"].value;
  var profile_image_url = document.forms["instructorUpdateForm"]["profile_image_url"].value;
 
  if (isValidName(first_name, 0) && isValidName(last_name) && isValidPhoneNo(phone_no, 0) && isValidPassword(password, 0) && (previous_experience != "") && isImage(profile_image_url, 0)) 
  {
    // alert("ok");
    return true;
  }
  else
  {
    $( ".hello" ).remove();
    var err = "";
    if(!isValidName(first_name, 0))
    {
      err = "Check first name";
      // alert("fName");
    }
    else if(!isValidName(last_name, 0))
    {
      err = "Check last name";
      // alert("lName");
    }
    else if(!isValidPhoneNo(phone_no, 0))
    {
      err = "Check phone number";
      // alert("phone_no");
    }
    else if(!isValidPassword(password, 0))
    {
      err = "Check password";
      // alert("password");
    }
    else if(!isImage(profile_image_url, 0))
    {
      err = "Enter image";
      // alert("image");
    }
    // $("#err").prepend('<div class="hello" style="padding:0 '+ 0 +'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');

    return false;
  }
}

function instructorAddFormValidation()
{
  // var len = $('input[name^="emails"]').length;
  // // $( ".hello" ).remove();
  // var tmp = 0;
  // for (var i = 0; i < len - 1; i++) {
  //   tmp = i;
  //   alert($('input[name="emails[i]"]'));
  //   if(!isValidEmail($('input[name^="emails[i]"]')))
  //   {
  //     i = tmp - 1;
  //   }
  // }

  $('input[name^="emails"]').each(function() {
    var err = "Wrong email: ";
    
    while(!isValidEmail($(this).val()))
    {
      $( ".hello" ).remove();
      err += $(this).val();

      $("#er").prepend('<div class="hello" style="padding:0 '+ 0 +'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
      
      return false;
    }
    $( ".hello" ).remove();
    // alert($(this).val());
  });
  return true;
  // return true;
  // var len = $('#Emails input[name="emails"]').length;
  // alert(len);
  // var emails = document.forms["instructorAddForm"]["emails"].value;
  // if(Array.isArray(emails))
  // {
  //   for(var i = 0; i < 2; i++)
  //   {  //Error on this line

  //     if(!isValidEmail(emails[i]))
  //     {
  //       alert(emails[i] + "is not valid");
  //     }
  //     // if (emails[i].value == '')
  //     // {
  //     //   break;
  //     // }
  //     // else
  //     // {
  //     //   if (emails[i].value == '')
  //     //   {
  //     //     break;
  //     //   }
  //     // }
  //   }


  // }
  // else
  // {
  //   alert("Sorry!");
  // }
  return false;
}

function isValidName(n, pad)
{
  var letters = /^[A-Za-z ]+$/;
  var err = "";
  $( ".hello" ).remove();
  if(n == "" || n.length > 45)
  {
    $( ".hello" ).remove();
    if (n == "") {
      err = "Make sure to enter a name!";
    }
    else
    {
      err = "Too long name!";
    }
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
    return false;
  }
  else if(!(n.match(letters)))
  {
    err = "Name must only contains letters(A-Z or a-z)";
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
    return false;
  }
  return true;
}

function isValidPhoneNo(phone, pad)
{
  re=/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
  var err = "";
  if((phone.length > 0 && (re.test(phone))) == true)
  {
    return true;
  }
  else
  {
    $( ".hello" ).remove();
    if(phone.length == 0)
    {
      err = "please enter phone number";
    }
    else if((re.test(phone)) == false)
    {
      err = "please enter a valid phone number";
    }
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
    return false;
  }
}

function isValidEmail(email, pad) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (email != "" && email.length <= 45 && re.test(String(email).toLowerCase())) {
    return true;
  }
  else
  {
    var err;
    $( ".hello" ).remove();
    if(email == "" || email.length > 45)
    {

      if (email == "") {
        err = "Please enter email!";
      }
      else if(email.length > 45)
      {
          err = "To long email!";
      }
    }
    else if (!re.test(email)) 
    {
      err = "Not valid email!";
    }
    else
    {
      err = "Check mail";
    }
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');      
      return false;
    }
  }

function isValidPassword(pass, pad)
{
  re1 = /[0-9]/;
  re2 = /[a-z]/;
  re3 = /[A-Z]/;
  if((pass.length < 6 || pass.length > 45) || ((!(re1.test(pass))) || (!(re2.test(pass))) || (!(re3.test(pass))))) {
    // alert("Error: Wrong Password!");
    var err;
    $( ".hello" ).remove();
    if(pass.length < 6)
    {
      err = "password length should be at least 6 characters";
    }
    else if(pass.length > 45)
    {
      err = "Too long password!";
    }
    else if (!(re1.test(pass))) {
      err = "password should have at least 1 number(0-9)";
    }
    else if (!(re2.test(pass))) {
      err = "password should have at least 1 lowercase letter(a-z)";
    }
    else if (!(re3.test(pass))) {
      err = "password should have at least 1 uppercase letter(A-Z)";
    }
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');

    // form.pwd1.focus();
    return false;
  }
  else
  {
    // alert("LOL");
    return true;
  }
}

function checkPassword(pass, cfPass, pad)
  {
    // re = /^\w+$/;
    var err;
    if(pass == "" || cfPass=="")
    {
      $( ".hello" ).remove();
      if(pass == "")
      {
        err = "please enter password ";
      }
      else
      {
        err = "please confirm your password ";
      }
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');

      return false;
    }
    else if(pass != "" && pass == cfPass) 
    {
      re1 = /[0-9]/;
      re2 = /[a-z]/;
      re3 = /[A-Z]/;

      $( ".hello" ).remove();
        if(pass.length < 6) {
          err = "password length should be at least 6 characters";
          $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
          // alert("Error: Password must contain at least six characters!");
          // form.pwd1.focus();
          return false;
        }
        else if(!re1.test(pass)) {
          err = "password should have at least 1 number(0-9)";
          $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
          // alert("Error: password must contain at least one number (0-9)!");
          // form.pwd1.focus();
          return false;
        }
        else if(!re2.test(pass)) {
          err = "password should have at least 1 lowercase letter(a-z)";
          $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');

          // alert("Error: password must contain at least one lowercase letter (a-z)!");
          // form.pwd1.focus();
          return false;
        }
        else if(!re3.test(pass)) {
          err = "password should have at least 1 lowercase letter(A-Z)";
          $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
          // alert("Error: password must contain at least one uppercase letter (A-Z)!");
          // form.pwd1.focus();
          return false;
        }
    }
    else if(pass != cfPass)
    {
      $( ".hello" ).remove();
      err = "Make sure that the confirm password is same as password!";
      $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
      return false;
    }
     
    // else {
    //   alert("Error: Please check that you've entered and confirmed your password!");
    //   // form.pwd1.focus();
    //   return false;
    // }
    // alert("You entered a valid password: " + pass);
    return true;
}

function isImage(img, pad)
{
  if (img == "") {
    $( ".hello" ).remove();
    var err = "please enter image!";
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');

    // alert("Enter image!");
    return false;
  }
 
  // alert("Nice");
  return true;
  // var URL = window.URL || window.webkitURL;
 
  // if (img) {
  //   alert("file");
  //   var image = new Image();
 
  //   image.onload = function() {
  //       if (this.width) {
  //            console.log('Image has width, I think it is real image');
  //            //TODO: upload to backend
  //       }
  //       else
  //       {
  //         alert("Please, enter a valid image!");
  //       }
  //   };
  //   image.src = URL.createObjectURL(img);
  // }
}
 
function isValidDate(start_date, finish_date, pad)
{
  var today = new Date();
  var todayDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();  
  // alert(start_date);
  // alert(finish_date);
  // alert("today is: " + todayDate);
  var err = "check start and finish dates";
  if(start_date <= todayDate || finish_date <= todayDate || start_date >= finish_date)
  {
    $( ".hello" ).remove();
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
    // alert("check start and finish dates");
    return false;
  }
  // else if(start_date >= finish_date)
  // {
  //   // alert("check start and finish dates");
  //   return false;
  // }
  return true;
}
 
function isValidPrice(price, pad)
{
  if(price.length == 0 || isNaN(price))
  {
    $( ".hello" ).remove();
    var err = "Not valid price";
    $("#err").prepend('<div class="hello" style="padding:0 '+ pad+'px"> <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error</strong> ' + err + '</div> </div>');
    // alert("Not valid price!");
    return false;
  }
  return true;
}