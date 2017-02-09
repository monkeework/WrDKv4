<?php

//Do we need these?
function getThisPage($strip = true) {// filter function - get current page url
	//used in themes/bootstrape/footer_inc.php

	static $filter;
	if ($filter == null) {
		$filter = function($input) use($strip) {
			$input = str_ireplace(array(
					"\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', urldecode($input));
			if ($strip) {
					$input = strip_tags($input);
			}

			// or any encoding you use instead of utf-8
			$input = htmlspecialchars($input, ENT_QUOTES, 'utf-8');

			return trim($input);
		};
	}

	return 'http'. (($_SERVER['SERVER_PORT'] == '443') ? 's' : '')
		.'://'. $_SERVER['SERVER_NAME'] . $filter($_SERVER['REQUEST_URI']);
}

function getEvalImg($str = ''){
	$evalNum = mt_rand(1, 12);

	$str .= '<label for="evalChek" class="col-sm-2 control-label"><img
			style="width:75px; margin-top:-35px;"
			src="' . VIRTUAL_PATH . '_img/_eval/eval-img-'. $evalNum .'.jpg"
			alt="img" />
		</label>
		<input type="hidden" name="evalChek" value="' . $evalNum . '">
	';

	return $str;

}

function maxDoc_themes_footer_inc(){
	/**
	 * based on add.php is a single page web application that allows us to add a new customer to
	 * an existing table
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
	 * @todo add more complicated checkbox & radio button examples
	 */
}



/*
array (size=12)
	'feedback' => string '' (length=0)
	'feedback-level' => string '' (length=0)
	'admin-red' => string 'logout.php' (length=10)
	'codeName' => string '' (length=0)
	'charID' => string '0' (length=1)
	'gender' => string '' (length=0)
	'stageID' => int 0


	'UserID' => int 1
	'UserName' => string 'The Gardener' (length=12)

	'Email' => string 'developer@example.com' (length=21)

	'Privilege' => int 7

	'uStart' => string 'dashboard.php' (length=13)

*/







#submit url
$submitURL = VIRTUAL_PATH . 'contact/processMSG.php';
#intial Strings
$uName = $uMail = $result = $errContactName = $errContactEmail = $errContactMsg = '';
#intial Ints
$uID = $uPriv = $charSum = 0;

//if logged in....
if ($errContactName != '') {
	$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
}


#get preliminary STRING values needed to determine if user is familiar, logged in, naughty
if(isset($_SESSION['UserID']))   { $uID 		= $_SESSION['UserID'];    }
if(isset($_SESSION['Privilege'])){ $uPriv 	= $_SESSION['Privilege']; }
#get preliminary INT values needed to determine if user is familiar, logged in, naughty
if(isset($_SESSION['UserName'])) { $uName = $_SESSION['UserName'];    }
if(isset($_SESSION['Email']))    { $uMail 	= $_SESSION['Email'];     }


#processMSG.php
?>


<!-- BEGIN modal contact -->
<div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">

		 <!-- BEGIN modal head -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<!-- add drop down select of user names for folks logged into to message each other -->
				<h4 class="modal-title">Contact <?=SITE_NAME;?></h4>
			</div>
			<!-- END modal head -->

		 <!-- BEGIN modal body -->
			<div class="modal-body">
				<form
					action="<?PHP echo htmlspecialchars($submitURL); ?>"
					method="post"
					id="formMail">


<!-- if not logged in, show -->
<?php
	if($uPriv <= 1){
		#Name
		echo '<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control"

				id="mailName"

				name="name"
				value="' . htmlspecialchars($uName) . '"
				placeholder="Your name here*"
				required="true">

		</div>
	</div>';


	#Email
	echo '<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control"

				id="mailEmail"

				name="email"
				value="' . htmlspecialchars($uMail) . '"
				placeholder="Your email here*"
				required="true">

		</div>
	</div>';
	}
?>


<!-- Message -->
<div class="form-group">
	<label for="message" class="col-sm-2 control-label">Message</label>
	<div class="col-sm-10">
		<textarea class="form-control" rows="4"

			id="mailMSG"

			name="message"
			placeholder="Enter message here
 - no urls
 - no email addresses*"
			style="margin: 0px;"
			required="true"
			></textarea>

		</div>
	</div>


<?php
//recapcha - add if user not logged in
if($uPriv <= 1){ echo '<div class="clearfix"><br /></div>
	<div class="g-recaptcha" data-sitekey="' . SITE_KEY . '" onsubmit="return validateRecaptcha();"></div>
<div class="clearfix"></div>'; }
?>








</div>













			</div>
		 <!-- END modal head -->

		 <!-- BEGIN modal footer -->
			<div class="clearfix"></div>
			<div class="modal-footer">
				<!-- if no varification - don't show/render submit, dat simple -->


				<!-- get page url - pass on for redirect -->
				<input type="hidden" name="urlPointer" value="<?=getThisPage(); ?>">


				<input type="submit" value="Submit" />

				</form><!-- END actual form here -->
			</div>
		 <!-- END modal footer -->

		</div>
	</div>
</div>
<!-- END modal contact-->




<!-- FOOTER begin -- THEMES / BOOTSTRAP / FOOTER_INC -->
<footer>
	<div class="row">
		<div class="col-lg-12">
			<ul class="list-unstyled">
				<li style="margin-left:15px"><?=$config->copyright; ?>.</li>
				<li class="pull-right"><a href="#top">Back to top</a></li>
			</ul>

		</div>
	</div>
</footer>
</div>
<!-- END content / THEMES / Footer_inc -->

<!-- reCAPTCHA / NO CAPTCHA -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>

<!-- BOOTSTRAP-->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?=THEME_PATH;?>js/bootstrap.min.js"></script>
<script src="<?=THEME_PATH;?>js/bootswatch.js"></script>

<!--
	form validations
	script ebables 'require' to work in safari/chrome
	prevents submit unless all are 'TRUE'
	if false, notifies user of specific errors


	SEE: http://stackoverflow.com/questions/23261301/required-attribute-not-work-in-safari-browser

	SEE: http://www.html5rocks.com/en/tutorials/forms/constraintvalidation/#toc-safari
-->
<script>
	//formMail
	var form = document.getElementById('formMail'); // form has to have ID: <form id="formID">
	form.noValidate = true;
	form.addEventListener('submit', function(event) { // listen for form submitting

		if (!event.target.checkValidity()) {
			event.preventDefault(); // dismiss the default functionality
			alert('Please complete the contact form.'); // error message

			document.getElementById('errorMessageDiv').style.display = 'block';
		}
	}, false);

	//mailName - user name/contact
	var input = document.getElementById('mailName'); // form has to have ID: <form id="formID">
	input.noValidate = true;
	input.addEventListener('submit', function(event) { // listen for form submitting

		if (!event.target.checkValidity()) {
			event.preventDefault(); // dismiss the default functionality
			alert('Please enter a name.'); // error message

			document.getElementById('errorMessageDiv').style.display = 'block';
		}
	}, false);

	//mailEmail - user contact email
	var input = document.getElementById('mailEmail'); // form has to have ID: <form id="formID">
	input.noValidate = true;
	input.addEventListener('submit', function(event) { // listen for form submitting

		if (!event.target.checkValidity()) {
			event.preventDefault(); // dismiss the default functionality
			alert('Please enter a valid email address.'); // error message

			document.getElementById('errorMessageDiv').style.display = 'block';
		}
	}, false);

	//mailMSG - user message
	var input = document.getElementById('mailName'); // form has to have ID: <form id="formID">
	input.noValidate = true;
	input.addEventListener('submit', function(event) { // listen for form submitting

		if (!event.target.checkValidity()) {
			event.preventDefault(); // dismiss the default functionality
			alert('Please enter a message.'); // error message

			document.getElementById('errorMessageDiv').style.display = 'block';
		}
	}, false);

</script>


<script>
	function validateRecaptcha() {
			var response = grecaptcha.getResponse();
			if (response.length === 0) {
					alert("not validated");
					return false;
			} else {
					alert("validated");
					return true;
			}
	}
</script>


<script>

$("form").submit(function(event){

	 var recaptcha = $("#g-recaptcha-response").val();
	 if (recaptcha === "") {
			event.preventDefault();
			alert("Please check the recaptcha");
	 }
});

</script>

















<?php
var_dump($_SESSION);
?>
<!-- FOOTER end -- THEMES / BOOTSTRAP / FOOTER_INC -->
</body>
</html>
