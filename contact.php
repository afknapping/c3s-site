<?php
/*
Credits: Bit Repository
URL: http://www.bitrepository.com/
*/

// change this email address to your own email ad.
define("WEBMASTER_EMAIL", 'joefrey.mahusay@gmail.com');

function ValidateEmail($email)
{
/*
(Name) Letters, Numbers, Dots, Hyphens and Underscores
(@ sign)
(Domain) (with possible subdomain(s) ).
Contains only letters, numbers, dots and hyphens (up to 255 characters)
(. sign)
(Extension) Letters only (up to 10 (can be increased in the future) characters)
*/

$regex = '/([a-z0-9_.-]+)'. # name

'@'. # at

'([a-z0-9.-]+){2,255}'. # domain & possibly subdomains

'.'. # period

'([a-z]+){2,10}/i'; # domain extension 

if($email == '') { 
	return false;
}
else {
$eregi = preg_replace($regex, '', $email);
}

return empty($eregi) ? true : false;
} // end function ValidateEmail



error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
//include 'functions.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$subject = stripslashes($_POST['subject']);
$message = stripslashes($_POST['message']);


$error = '';

// Check name
if(!$name || $name=="Your Name")
{
$error .= '<li>Please enter your name.</li>';
}

// Check email

if(!$email)
{
$error .= '<li>Please enter an e-mail address.</li>';
}

if($email && !ValidateEmail($email))
{
$error .= '<li>Please enter a valid e-mail address.</li>';
}

// Check message (length)

if(!$message || $message=="Your Message")
{
$error .= "<li>Please enter your message.</li>";
}


if(!$error)
{
$mail = mail(WEBMASTER_EMAIL, $subject, $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());


if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>