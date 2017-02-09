<?php

/*
	http://localhost/WrDKv3/_inc/processCHAR-inc.php?

	cName=Wiccan
	&cID=3
	$feedBack=

*/
#DESIRED URL

/*
	'form01-Search_token' => string '5d2f2c8592c508c643824de8c8ba2247' (length=32)
	'username' => string 'maxster' (length=7)
	'user' => string '1' (length=1)
	'feedback' => string 'Thank You! We will be in touch soon-ish ;) CODE-0257' (length=52)
	'feedback-level' => string 'success' (length=7)
	'UserID' => int 1
	'UserName' => string 'The Gardener' (length=12)
	'Email' => string 'developer@example.com' (length=21)
	'Privilege' => int 7
	'uStart' => string 'dashboard.php' (length=13)
*/



function maxDoc_inc_processCHAR_inc(){
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
include './../_inc/arrays-inc.php';

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
//initialize vars to minimize explosions
#common STRINGs
$cName = $uName = $uMail = $uMessage = '';

$cAdopt = $cRequest = '';
# Common INTs
$cID = $uID = $cStage = $uPriv = 0;


#$_SESSION ONLY VALUES - only presnt for logged in users
if(isset($_SESSION['UserID']))	  	{ $uID = $_SESSION['UserID'];     }
if(isset($_SESSION['Privilege']))	  { $uPriv=$_SESSION['Privilege'];  }
if(isset($_SESSION['UserName']))	  { $uName=$_SESSION['UserName'];   }
if(isset($_SESSION['Email']))	  		{ $uMail=$_SESSION['Email'];   		}


#$_GET ONLY VALUES - only presnt for logged in users
if(isset($_GET['cName']))			      { $cName      	= $_GET['cName']; }
if(isset($_GET['cID']))			        { $cID      		= $_GET['cID'];   }
if(isset($_GET['cStage']))			    { $cStage      	= $_GET['cStage'];}



#NOTIFCATION setup
$to = MOD_MAIL . ", $uMail";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
//$from = 'Marvel Champions (' . 	$urlPointer . ')'; SUPPORT_EMAIL
$from = 'Marvel Champions (' . 	SUPPORT_EMAIL . ')';
$subject = 'Marvel Champions Notification:: ' . $cName . ' updated';

//build body of email
$uMessage .= $cName . ' has been updated by ' . $uName . ' (Stage: ' . $aarStatusTest[$cStage] . ') ';
//later all character stuff will go here....

$body ="From: $uName\n E-Mail: $uMail\n Message: $uMessage\n";


//if logged in....
if (mail ($to, $subject, $body, $from)) {
	#$result='<div class="alert alert-success">Thank You! I will be in touch 1</div>';
	feedback("Thank You! We will be in touch soon-ish ;) CODE-0257", "success");

	// If there are no errors, send the email
} else {
	feedback("Sorry there was an error sending your message. Please try again later. CODE-0264", "danger");
	#header( "Location: $myURL "); //Send me back to where i belong
}


feedback( $CodeName . " Updated Successfully!", "success");

//http://marvel-champions.com/characters/profile.php?codename=Wiccan&id=3&act=show
myRedirect(VIRTUAL_PATH . 'characters/profile.php?' . $cName . '&id=' . $cID. '&act=show'); //Send to default page


function testInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
