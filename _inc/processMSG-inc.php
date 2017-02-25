<?php

#Test direct - _inc/processMSG-inc.php

function maxDoc_contact_processMSG(){
	/**
	 * smart mailhandler - takes into account if user is known/logged
	 * responds accordingly (auto populating certian field et al.)
	 *
	 *
	 * BOTH CONTACT & JOIN SITE MODALS are here!
	 *
	 *
	 * BEGIN CONFIG for contact form (Not General Contact Modal)
	 * KEYs for Marvel-Champions
	 * get key from http://www.google.com/recaptcha/whyrecaptcha:
	 * For each customer/domain, get a key from http://recaptcha.net/api/getkey
	 *
	 * EDIT THE FOLLOWING:
	 *  $toAddress = "speedlanerunner@gmail.com, monkeework@gmail.com , chezshire@gmail.com";
	 * - place your/your client's email address here ADDRESSES!
	 * $toName = "Grandmaster, Gardener , Architect"; //place your client's name here
	 * $website = "Marvel Champions";  //place NAME of your client's website/form here,
	 *  - ie: ITC280 Contact, ITC280 Registration, etc.
	 * $sendEmail = TRUE; //if true,sends email, else shows user data.
	 *
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 *
	 * @todo add more complicated checkbox & radio button examples
	 *
	 * @screen out generic messages with urls - spam
	 * @sanitize data better
	 */
}
include './../_inc/config_inc.php';

/*
 * Check Correct Post Data coming in off $_POST
 * dumpDie($_POST); // Better var_dump
 * array (size=7)
		'name' => string 'test@u.com' (length=10)
		'email' => string 'test@u.com' (length=10)
		'message' => string 'test test test - test test - test test test' (length=43)
		'g-recaptcha-response' => string '03'... (length=1294)
		'dateBot' => string 'Friday, February 3rd, 2017 ' (length=27)
		'other_email' => string '' (length=0)
		'urlPointer' => string 'http://localhost/WrDKv4/library/about.php' (length=41)
 **/



# initialize vars to minimize explosions
$captcha = $uName = $uMail = $uMessage = $memRequest = $cOCFC = $urlPointer = $urlReferring = $url = $reg_exUrl = $txt = '';

# instantiate beginning data
#user name
$uName 		= $_POST['name'];
#user name
$uMessage = $_POST['message'];
# where user came from
$urlReferring = $_POST['urlPointer'];
# hidden field chek #1
$dateBot = $_POST['dateBot'];
# hidden field chek #2
$oMail = $_POST['other_email'];

# GET & SET url return path
# If sending page is known - Contact form appears in a modal on all pages)
if (isset($urlReferring)){ $urlPointer = $urlReferring; }
# set reference point unknown
if (!isset($urlReferring)){ $urlPointer = VIRTUAL_PATH; }



# check user name for illegal characters
# if illegal - punt them back to where they came from

if ( (strpos($uName, '@')    !== false) ||
     (strpos($uName, 'www.') !== false) ||
     (strpos($uName, '.com') !== false) ||
     (strpos($uName, '.net') !== false) ){

    #kick them out/kill form handler
    feedback("Message unsent &mdash; Please try again. (CODE-0106)", "info");

    myRedirect($urlPointer);

    #dumpDie($urlPointer);
    header( "Location: " . $urlPointer  ); //Send to origin

    die;
}



if ( (strpos($uMessage, '@')    !== false) ||
     (strpos($uMessage, 'www.') !== false) ||
     (strpos($uMessage, '.com') !== false) ||
     (strpos($uMessage, '.net') !== false) ){

    #kick them out/kill form handler
    feedback("Message unsent &mdash; Please try again. (CODE-0106)", "info");
    header( "Location: " . $urlPointer  ); //Send to origin

    die;
}

#security chek one using hidden field to catch bots
$botChek1 = date('l\, F jS\, Y ');
if($dateBot != $botChek1){
	feedback("We're sorry, you message could not be sent. (CODE-0078)", "info");
	header( "Location: " . $urlPointer  ); //Send to origin
}

#security chek one using hidden field to catch bots
if(isset($oMail)){
	feedback("We're sorry, you message could not be sent. (CODE-0078)", "info");
	header( "Location: " . $urlPointer  ); //Send to origin
}



/*
# check user message for illegal characters, if illegal - punt
foreach ( $uMessage as $testcase ) {
	if (ctype_alpha($testcase)) {
		feedback("We're sorry, you message could not be sent. (CODE-0078)", "info");
		header( "Location: " . $urlPointer  ); //Send to origin
	}
}



# check user name for illegal characters, if illegal - punt
foreach ( $uName as $testcase ) {
	if (ctype_alpha($testcase)) {
		feedback("We're sorry, you message could not be sent. (CODE-0078)", "info");
		header( "Location: " . $urlPointer  ); //Send to origin
	}
}


if(isset($_POST['name'])){
	if (ctype_alpha($testcase)) {
		feedback("We're sorry, you message could not be sent. (CODE-0078)", "info");
		header( "Location: " . $urlPointer  ); //Send to origin
	}
}

if($_POST['name']){
	if (ctype_alpha($testcase)) {
		feedback("We're sorry, you message could not be sent. (CODE-0078)", "info");
		header( "Location: " . $urlPointer  ); //Send to origin
	}
}
*/


$cAdopt = $cRequest = '';
# Common INTs
$uID = $cRequest = $charSum = $uPriv = 0;


#$_SESSION ONLY VALUES - only presnt for logged in users
// DO this first as we use it in conjunction with reCAPTCHA...
if(isset($_SESSION['UserID']))	  	{ $uID=$_SESSION['UserID'];      }
if(isset($_SESSION['Privilege']))	  { $uPriv=$_SESSION['Privilege']; }


#USER UNKNOWN - captcha
if($uID <= 0){
	#DETERMINE KICK OUT EVENTS HERE - stuff needed not given goodbye!
	//captcha handling
	if(isset($_POST['g-recaptcha-response'])){ $captcha=$_POST['g-recaptcha-response'];
	}

	#echo 'recp: ' . $captcha=$_POST['g-recaptcha-response'];
	if(!$captcha){ //no captcha...
		feedback("Sorry - you did not complete the captcha correctly; Message not sent. CODE-0087", "info");
		header( "Location: " . $urlPointer  ); //Send to origin
	}

	#defined in credentials-inc.php
	$secretKey = SECRET_KEY;

	$ip = $_SERVER['REMOTE_ADDR'];
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);

	#HANDLE SPAMMERs
	if(intval($responseKeys["success"]) !== 1) {
		//seems like spam/unknown user/robot
		feedback("Sorry - We received an invalid or incorrect CAPTCHA RESPONSE; Message not sent: CODE-0101", "danger");
		header( "Location: " . $urlPointer  ); //Send to origin
	}
}


#DATA SANITIZATION begin - necessary data - VALUES FROM $_POST
// testInput sanitize data
// first layer of sanitization
if(isset($_POST['email']))			      { $uMail      	= $_POST['email']; 	          $uMail 			  = testInput($uMail);  		 }
if(isset($_POST['message']))		      { $uMessage   	= $_POST['message'];          $uMessage 		= testInput($uMessage);  	 }
if(isset($_POST['urlPointer']))	      { $urlPointer 	= $_POST['urlPointer'];      	$urlPointer 	= testInput($urlPointer);  }
if(isset($_POST['name']))			      	{ $uName      	= $_POST['name']; 	          $uName 			  = testInput($uMail);  		 }

#VALUE NOT ALWAYS PRESENT DEPENDING ON scenario - so check only if exist...
if(isset($_POST['charAdopt']))         { $cAdopt 	 	  = $_POST['charAdopt'];         $cAdopt 	    = testInput($cAdopt);      }
if(isset($_POST['charRequest']))       { $cRequest  	= $_POST['charRequest'];  	   $cRequest    = testInput($cRequest);    }
if(isset($_POST['charFCOC']))			     { $cOCFC 	   	= $_POST['charFCOC'];          $cOCFC 		  = testInput($cOCFC);       }
if(isset($_POST['requestMembership'])) { $memRequest	= $_POST['requestMembership']; $memRequest 	= testInput($memRequest);  }


#second layer of sanitization - FILTER_SANITIZE_... cleans data
// second layer of sanitization
//string cleaning
$uMail 			  = filter_var($uMail 	   , FILTER_SANITIZE_EMAIL);
$uMessage 		= filter_var($uMessage   , FILTER_SANITIZE_STRING);
$urlPointer 	= filter_var($urlPointer , FILTER_SANITIZE_STRING);
$uName 			  = filter_var($uName 	   , FILTER_SANITIZE_STRING);
$memRequest 	= filter_var($memRequest , FILTER_SANITIZE_STRING);
$cOCFC 		  	= filter_var($cOCFC 		 , FILTER_SANITIZE_STRING);

//int cleaning
#$cAdopt 	    = filter_var($cAdopt 	   , FILTER_VALIDATE_INT);
#$cRequest     = filter_var($cRequest   , FILTER_VALIDATE_INT);
//URL quirks
$urlPointer = str_replace(' ',   '-', $urlPointer);
$urlPointer = str_replace('%20', '-', $urlPointer);


#VALUES FROM $_SESSION - #_POST values not always set, some can be gotten from $_SESSION!
// testInput sanitize data
if($uMail == ''){  if(isset($_SESSION['Email']))     { $uMail=$_SESSION['Email'];}    }
if($uName == ''){  if(isset($_SESSION['UserName']))	 { $uName=$_SESSION['UserName'];} }


#VAR PROCESSING
$urlReferring = str_replace('http://marvel-champions.com/', '', $urlPointer );



if(($uID > 0) && ($uPriv > 2)){ echo ' -- wackka wakka everyone --><br /><br />';}


echo '$uMessage - ' . $uMessage .  '<br /> <br />';


#SPAMMERS kick them out before bothering to process anything...
if(($uID = 0) || ($uPriv < 2)) {
	#dealing with an unknow or untrusted entity.

	// The Regular Expression filter
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	// Check if there is a url in the text
	if(preg_match($reg_exUrl, $uMessage, $url)) {
		#url found = goodbye
		feedback("Sorry - Your message is considered spam because it contained a url in the text message box; Message not sent: CODE-0076", "danger");
		header( "Location: " . VIRTUAL_PATH ); //Send to default page
	}

	#SPAMMING email
	#email found = goodbye
	if (strpos($uMessage, '@') !== false) {
		#email found, goodbye
		feedback("Sorry - Your message is considered spam because it contained an email address in the text message box.; Message not sent: CODE-0084", "danger");
		header( "Location: " . VIRTUAL_PATH ); //Send to default page
	}
}


#MESSAGE HANDLING (From newbs)
if($memRequest =='y'){ $memRequest = ':: Membership Requested by ' . $uName . ' (' . $uMail . ')';}
if($cAdopt !='Choose from our list of pre-built character shells') { $cAdopt 		     = ':: ' . $uName . ' wants to adopt ' . $cAdopt . ' '; }else{ $cAdopt ='';}
if($cRequest !='') { $cRequest     = ':: ' . $uName . ' wants to create ' . $cRequest . ' / ' . $uName . ')';}


#MESSAGE CHEK
#Check if email has been entered and is valid
if (!$uMail || !filter_var($uMail, FILTER_VALIDATE_EMAIL)) {
	#no email/invalid email, goodbye
	feedback("Sorry - We received an invalid email address and will not be able to respond. Please check that your are providing a valid email address before attempting to send your message again. Thank you.; Message not sent: CODE-0219", "danger");
	header( "Location: " . $urlPointer  ); //Send to origin
}

#Check if message entered
if (!$uMessage) {
	#no message/invalid email, goodbye
	feedback("No message given CODE-0240.", "alert");
	feedback("Sorry - No message was included. Please check message before attempting to send a message again. Thank you.; Message not sent: CODE-0219", "danger");
	header( "Location: " . $urlPointer  ); //Send to origin
}
#DATA PREP end

#NOTIFCATION setup
$to = 'speedlanerunner@yahoo.com, monkeework@gmail.com, chezshire@gmail.com ';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
$from = 'Marvel Champions (' . 	$urlPointer . ')';
$subject = 'Marvel Champions Notification ' . $memRequest  . $cAdopt . $cRequest . $urlReferring;

//build body of email
$uMessage .= '


'. $cAdopt . '
'. $cRequest;

$body ="From: $uName\n E-Mail: $uMail\n Message:\n $uMessage";


//if logged in....
if (mail ($to, $subject, $body, $from)) {
	#$result='<div class="alert alert-success">Thank You! I will be in touch 1</div>';

	feedback("Thank You! We will be in touch soon-ish ;) CODE-0257", "success");

	#header( "Location: $myURL "); //Send me back to where i belong
	header( "Location: " . $urlPointer ); //Send me back to where i belong

// If there are no errors, send the email
} else {
	feedback("Sorry there was an error sending your message. Please try again later. CODE-0264", "danger");
	#header( "Location: $myURL "); //Send me back to where i belong
	if($urlPointer != ''){
		header( "Location: " . $urlPointer ); //Send me back to where i belong
	}else{
		header( "Location: " . VIRTUAL_PATH ); //Send to default page
	}

}

//}





function testInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
