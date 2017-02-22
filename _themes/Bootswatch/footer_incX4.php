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
#submit url
$submitURL = VIRTUAL_PATH . '_inc/processMSG-inc.php';
#intial Strings
$uName = $uMail = $result = $errContactName = $errContactEmail = $errContactMsg = '';
#intial Ints
$uID = $charSum = 0;
# date for datBot comparison to catch spammers
$today = date('l\, F jS\, Y ');

//if logged in....
if ($errContactName != '') {
	$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
}

#get preliminary STRING values needed to determine if user is familiar, logged in, naughty
if(isset($_SESSION['UserID']))   { $uID 		= $_SESSION['UserID'];    }
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
<!-- BEGIN modal head -->
<!-- BEGIN modal head -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<!-- add drop down select of user names for folks logged into to message each other -->
				<h4 class="modal-title">Contact <?=SITE_NAME;?></h4>
			</div>
			<!-- END modal head -->


<!-- BEGIN modal body -->
<!-- BEGIN modal body -->
<!-- BEGIN modal body -->
<div class="modal-body">
<!-- START actual form here -->
<form action="<?PHP echo htmlspecialchars($submitURL); ?>" method="post" id="formMail"><!-- START actual form here -->


<!-- NAME/EMAIL begin -->
<!-- not logged in/unknown -->
<? if($uID <= 0){; ?>
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="mailName" name="name"
			value=""
			placeholder="Your name here*"
			required="true">
	</div>
</div>

<!-- Email -->
<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Email</label>
	<div class="col-sm-10">
		<input type="email" class="form-control" id="mailEmail" name="email"
			value=""
			placeholder="Your email here*"
			required="true">
	</div>
</div>
<? } ?>
<!-- NAME/EMAIL end -->



<!-- MESSAGE begin -->
<? if($uID <= 0){; ?>
<!-- Message -->
<div class="form-group">
	<label for="message" class="col-sm-2 control-label">Message</label>
	<div class="col-sm-10">
		<textarea class="form-control" rows="4" id="mailMSG" name="message"
			placeholder="Enter message here
 - no urls
 - no email addresses*"
			style="margin: 0px;" required="true"
			></textarea>
	</div>
</div>
<? } ?>



<? if($uID > 0){; ?>
<div class="form-group"><label for="message" class="col-sm-2 control-label">Message</label>
	<div class="col-sm-10">
		<textarea class="form-control" rows="4" id="mailMSG" name="message"
			placeholder="Enter message here"
			style="margin: 0px;" required="true"
			></textarea>
	</div>
</div>
<? } ?>
<!--  MESSAGE end -->



<!--  MEMBERSHIP DRIVE begin -->
<!-- variable option displays -->
<? if($uID <= 0){; ?>
<div class="form-group"><label for="requestMembership" class="col-sm-2 control-label"></label>
	<div class="col-sm-10 ">
		<input type="checkbox" name="requestMembership" value="y"> &nbsp; <i>Join Marvel Champions</i>
	</div>
</div>
<? } ?>
<!--  MEMBERSHIP DRIVE end   -->



<!--  CHARACTER REQUEST begin -->
<?php
//if user a member...
if($uID > 0){

$sql = "SELECT CharID, UserID FROM ma_Characters WHERE UserID = $uID";
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	$count = 1;
	while ($row = mysqli_fetch_assoc($result))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		$charSum = $count;
		$count++; //automatically now equal to one as loop ran once
	}
}

@mysqli_free_result($result); //free resources

$charTot = 2 - $charSum;// max char allowance is currently 2

if($charSum < 2){
	echo '<div class="form-group"><label class="col-sm-2 control-label"></label>
		<div class="col-sm-10"
			style="background-color: #edf8f1; padding:10px; margin-bottom: 10px;">
			You may be eligible for a character*
		</div>
	</div>';

		$sql = "SELECT CharID, UserID, CodeName, StatusID FROM ma_Characters WHERE StatusID < 2";
		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results
			#External formatting here...
			echo '<div class="form-group"><label for="charAdopt"  class="col-sm-2 control-label">Adoptable:</label>
				<div class="col-sm-10">
					<select class="form-control" id="charAdopt" name="charAdopt">
						<option> Choose from our list of pre-built character shells</option>';

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$codeName = $row['CodeName'];
				echo '<option value="' . $codeName . '">' . $codeName . '</option>';
			}
			echo '</select>
				</div>
			</div>';
		}

	@mysqli_free_result($result); //free resources



	echo '<div class="form-group"><label for="charNew" class="col-sm-2 control-label text-right">New/original</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="charNew" name="charRequest" placeholder="Enter the name of the character you would like to apply for">
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="form-group"><label for="charFCOC" class="col-sm-2 control-label"></label>
		<div class="col-sm-10 ">
			<input type="radio" name="charFCOC" value="fc"> &nbsp; <i>FC - A Featured Character of the Marvel Universe?</i>
			<br />
			<input type="radio" name="charFCOC" value="oc"> &nbsp; <i>OC - An original character of your imagination?</i>
		</div>
	</div>';

	}else{
		echo '<div class="form-group"><label class="col-sm-2 control-label"></label>
			<div class="col-sm-10" style="background-color: #edf8f1; padding:10px; margin-bottom: 10px;">
				<small>Currently, you are not eligible for additonal character at this time.</small>
			</div>
		</div>';
	}

} //END if statement
?>
<!--  CHARACTER REQUEST end -->



	<div class="clearfix"></div>
	<!--  reCAPTCHA begin -->

	<?php //recapcha - add if user not logged in
	if($uID <= 0){ echo '<div class="clearfix"><br /></div>
		<div class="g-recaptcha" data-sitekey="' . SITE_KEY . '" onsubmit="return validateRecaptcha();"></div>
	<div class="clearfix"></div>'; }
	?>

	<!--  reCAPTCHA end -->
	<div class="clearfix"></div>


	<!-- form is closed from within modal footer -->
<!-- END actual form here -->
</div>
<!-- END modal body -->
<!-- END modal body -->
<!-- END modal body -->

<!-- BEGIN modal footer -->
<!-- BEGIN modal footer -->
<!-- BEGIN modal footer -->
			<div class="clearfix"></div>

			<div class="modal-footer">
				<!-- if no varification - don't show/render submit, dat simple -->
				<!-- get page url - pass on for redirect -->


					<!-- blox one -->

					<input type="hidden" name="dateBot" value="<? echo date('l\, F jS\, Y '); ?>" />


<style type='text/css'>
	#other_email_label, #other_email { display: none; }
</style>
					<label id='other_email_label' for='other_email'>Please leave blank:</label>
					<input type='text' name='other_email' id='other_email'>


					<!-- if no varification - don't show/render submit, dat simple -->
					<!-- get page url - pass on for redirect -->
					<input type="hidden" name="urlPointer" value="<?=getThisPage(); ?>">
					<input class="btn btn-primary pull-right" id="contact" type="submit" value="Submit" />
				</form>
				<!-- FORM end -->

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

					<li style="margin-left:15px">
							<a href="http://www.ultimatetopsites.com/games/MarvelVerse/">
							<img src="http://www.ultimatetopsites.com/bin/votepicture/?MarvelVerse&cat=games&ID=347"></a>

						<br /><br />
							<?=$config->copyright; ?>
					</li>

					<li class="pull-right">
						<div class="btn-group-vertical pull-right">
							<a class="pull-right" href="#top">Back to top</a>

								<br /><br />

							<a class="pull-right" href="http://www.ultimatetopsites.com/games/MarvelVerse/">
								<img class="pull-right" src="http://www.ultimatetopsites.com/bin/votepicture/?MarvelVerse&cat=games&ID=347&textlink=1">
									Marvel RPG Topsites
							</a>
						</div>
					</li>
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



<!-- FOOTER end -- THEMES / BOOTSTRAP / FOOTER_INC -->
</body>
</html>
