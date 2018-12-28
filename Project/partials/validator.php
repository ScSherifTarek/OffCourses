<?php

class validator
{
	public static function isValidEmail($email) {
		# $re = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

	    if(empty($email) || strlen($email) > 45 && !filter_var($email, FILTER_VALIDATE_EMAIL))
	    {
	    	echo "Invalid email format";
	        return false;
	    }
	    echo "<br>Valid email";
	    return true;
	}

  	public static function isValidPassword($pass, $cfPass = null)
  	{
  		if ($cfPass == null) {
  			$cfPass = $pass;
  		}
  		if(!empty($pass) && ($pass == $cfPass)) {
	        $password = validator::test_input($pass);
	        $cpassword = validator::test_input($pass);
	        if (strlen($pass) < '6') {
	            $passwordErr = "Your Password Must Contain At Least 6 Characters!";
	            return false;
	        }
	        elseif(!preg_match("#[0-9]+#",$password)) {
	            $passwordErr = "Your Password Must Contain At Least 1 Number!";
	            return false;
	        }
	        elseif(!preg_match("#[A-Z]+#", $password)) {
	            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
	            return false;
	        }
	        elseif(!preg_match("#[a-z]+#",$password)) {
	            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
	            return false;
	        }
    	}
    	return true;
	}
	// Complete name, first or last name.
	public static function isValidName($name)
	{		
		if (empty($name)) {
    		$nameErr = "You Forgot to Enter Your Name!";
    		echo $nameErr;
    		return false;
    	} 
    	else 
    	{
	        $Nname = validator::test_input($name);
	        //Checks if name only contains letters and whitespace
	        if (!preg_match("/^[a-zA-Z ]*$/",$Nname)) 
	        {
	            $nameErr = "Only letters and white space allowed"; 
	            echo $nameErr;
	            return false;
	        }
    	}
    	echo "<br>valid name";
    	return true;
	}

	public static function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  // echo $data;
	  return $data;
	}
}
?>