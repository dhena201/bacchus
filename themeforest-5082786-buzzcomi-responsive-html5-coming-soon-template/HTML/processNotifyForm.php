<?php

// Clean up the input values
foreach($_POST as $key => $value) {
	if(ini_get('magic_quotes_gpc'))
		$_POST[$key] = stripslashes($_POST[$key]);
	
	$_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

// Assign the input values to variables for easy reference
$email = isset($_POST["email"]) ? $_POST["email"] : "";

// Test input values for errors
$errors = array();
if(!$email) {
	$errors[] = "You must enter an email.";
} else if(!validEmail($email)) {
	$errors[] = "You must enter a valid email.";
}

if($errors) {
	// Output errors and die with a failure message
	$errortext = "";
	foreach($errors as $error) {
		$errortext .= "<li>".$error."</li>";
	}
	die("<div class='thanks failure'>The following errors occured:<ul>". $errortext ."</ul></div>");
}
// Send the email
$result = writeToFile($email);
if($result == 1)
  die("<div class='thanks'>Thanks for submitting your email! We will notice you when our site is available.</div>");
else {
  die("<sdivpan class='thanks'>You entered your email before!</div>");
}


function writeToFile($email) {
  $file = fopen('emails.txt', 'a+');
  fwrite($file, $email . "\n");
  fclose($file);
  return 1;
}
function insertEmailToDatabase($email) {
  $link = mysql_connect("localhost", "root", "");
  mysql_select_db("buzzcorp", $link);
  $result = mysql_query("SELECT * FROM emails WHERE email='$email'", $link);
  $num_rows = mysql_num_rows($result);
  if($num_rows === 0) {
    $time = date("Y-m-d H:i:s");
    mysql_query("INSERT INTO emails (email, time) VALUES ('$email', '$time')");
    return 1;
  }
  return 0;
}

// A function that checks to see if
// an email is valid
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

?>