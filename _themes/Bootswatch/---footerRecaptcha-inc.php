<?php

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


if(isset($_SESSION['UserID'])){
	$userEmail = $_SESSION['UserID'];
}else{ $userEmail = 0; }

if(isset($_SESSION['Privilege'])){
	$privilege = $_SESSION['Privilege'];
}else{ $privilege = 0; }

if(isset($_SESSION['UserID'])){
	$myID = $_SESSION['UserID'];
}else{ $myID = 0; }

//if user is logged in, get their email
$sql = "select UserID, Email from ma_Users WHERE UserID = $userEmail";

$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	#External formatting here...
	while ($row = mysqli_fetch_assoc($result))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		$userEmail = dbOut($row['Email']);
	}
	#closing formating here...
}else{//no records
	$userEmail = '';
}

@mysqli_free_result($result); //free resources


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

?>

<!-- BEGIN modal contact -->

<div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Contact <?=SITE_NAME;?></h4>
			</div>

			<div class="modal-body">


<!-- BEGIN Actual form here -->
<form class="form-horizontal" role="form" method="post" action="<?=VIRTUAL_PATH; ?>contact/">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="name" placeholder="Your name here*"
value="<?php
	if (isset($_SESSION['UserName'])) {
		echo $_SESSION['UserName'];
	}
?>" >
	</div>
</div>

<div class="form-group">
	<label for="email" class="col-sm-2 control-label">Email</label>
	<div class="col-sm-10">
		<input type="email" class="form-control" id="email" name="email" value="<?php echo $userEmail; ?>"placeholder="Your email here*" >
	</div>
</div>

<div class="form-group">
	<label for="message" class="col-sm-2 control-label">Message</label>
	<div class="col-sm-10">
		<textarea class="form-control" rows="4" name="message" placeholder="Your message here*" style="margin: 0px;"></textarea>
	</div>
</div>



<?php
//if user is a vistor, guest, unregistered user, not logged in... et al
if(!isset($_SESSION['Privilege']) || (($_SESSION['Privilege']) <= 1)){
//treat user as possibly malicious
?>

<div class="form-group">
	<label for="evalAnswer" class="col-sm-2 control-label"><?=getEvalImg(); ?></label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="evalAnswer" name="evalAnswer" placeholder="Who is that?*" >
	</div>
</div>

<div class="form-group">
	<label for="requestMembership" class="col-sm-2 control-label"></label>
	<div class="col-sm-10 ">
		<input type="checkbox" name="requestMembership" value="User requests membership to Marvel Champions"> &nbsp; <i>Request membership to Marvel Champions</i>
	</div>
</div>

<?php
}
?>

<?php
//if user is under ration of chars (2) allow them to request a character
// request a character?


//if user a member...
if(($privilege == 0) || ($privilege >= 1)){

$sql = "SELECT CharID, UserID FROM ma_Characters WHERE UserID = $myID";

$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

$charSum = 0;

if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	$count = 0;
	while ($row = mysqli_fetch_assoc($result))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		$charSum = $count;
		$count++; //automatically now equal to one as loop ran once
	}
}

@mysqli_free_result($result); //free resources


$charTot = 2 - $charSum;// max char allowance is currently 2

echo '<div style="background-color: #edf8f1; padding:10px; margin-bottom: 10px;">
<div class="form-group">
	<label for="evalAnswer" class="col-sm-2 control-label"><?=getEvalImg(); ?></label>
	<div class="col-sm-10">';

	if($charSum <= 2){
		echo '<div><p> You may be eligible for a character*</p></div>
				</div>
			</div>';

			$sql = "SELECT CharID, UserID, CodeName, StatusID FROM ma_Characters WHERE StatusID <= 2";

			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results
				#External formatting here...
				echo '<div class="form-group">
					<label for="charAdopt"  class="col-sm-2 control-label">Adoptable:</label>
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

		echo '<div class="form-group">
			<label for="charNew" class="col-sm-2 control-label text-right">New/original</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="charNew" name="charRequest" placeholder="Enter the name of the character you would like to apply for">
			</div>
		</div>

		<div class="form-group">
			<label for="charFCOC" class="col-sm-2 control-label"></label>
			<div class="col-sm-10 ">

				<input type="radio" name="charFCOC" value="fc"> &nbsp; <i>FC - A Featured Character of the Marvel Universe?</i>
				<br />
				<input type="radio" name="charFCOC" value="oc"> &nbsp; <i>OC - An original character of your imagination?</i>
			</div>
		</div>';

	}else{
		echo '<div>You currently have ' . $count .   ' characters and are not eligible for any additonal characters at this time.</div>
			</div>
		</div>';
	}

	echo '</div>';
} //END if statement
?>

</div>
<!-- END modal body -->
<!-- BEGIN modal footer -->
<div class="modal-footer">
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input type="hidden" name="urlPointer" value="<?=getThisPage(); ?>">

			<a href="#" data-dismiss="modal" data-target="#" class="btn btn-default btn-sm pull-left" role="button"><i>Exit without Sending</i></a>
			<input class="btn btn-success btn-sm pull-right" id="submit" name="submit" type="submit" value="Send Message" class="btn btn-primary">
		</div>
	</div>
</form>
<!-- END actual form here -->
</div></div></div></div>
<!-- END modal contact-->


<?php
#CLOSE PAGE UP

/**
 * For each customer/domain, get a key from http://www.google.com/recaptcha/whyrecaptcha:
 * $publivkey, $privatekey moved to credentials to protect them
 *
 * Following moved to config_inc.php
 * $resp, $error, $skipFields, $fromDomain, $fromAddress,
 * $toAddress, $toName, $website, $sendEmail = TRUE
 *
 * Following moved to config_inc
 * include INCLUDE_PATH . 'recaptchalib_inc.php'; #required reCAPTCHA class code
 * include INCLUDE_PATH . 'contact_inc.php'; #complex unsightly code moved here
 */
echo '<h4><i>Do you have a suggestion for a word which might need defining?</i></h4>

			<form role="form" action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';

			if (isset($_POST["recaptcha_response_field"])){# Check for reCAPTCHA response
				$resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

			if ($resp->is_valid){#reCAPTCHA agrees data is valid
				handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);#process form elements, format and send email.

			#Here we can enter the data sent into a database in a later version of this file
			echo "<!-- format HTML here to be your 'thank you' message -->
				<div class='text-center'><h2>Your Comments Have Been Received!</h2></div>
				<div class='text-center'>Thanks for the input!</div>
				<div class='text-center'>We'll respond via email within 48 hours, if you requested information.</div>";

				}else{#reCATPCHA response says data not valid - prepare for feedback
					$error = $resp->error;
					send_POSTtoJS($skipFields); #function for sending POST data to JS array to reload form elements
				}
			}

			#show form, either for first time, or if data not valid per reCAPTCHA
			if(!isset($_POST["recaptcha_response_field"])|| $error != "")
			{#separate code block to deal with returning failed data, or no data sent yet

echo '<!-- below change the HTML to accommodate your form elements - only "Name" & "Email" are significant -->

	<input
		type="text"
		name="Name"

		class="col-xs-5"
		required="true"

		title="Your Name is Required"
		placeholder="Your Name" />


	<input
		type="email"
		name="Email"

		class="col-xs-6 pull-right"
		required="true"

		title="A Valid Email is Required"
		placeholder="Your Email" />

		<br /><br /><br />

	<textarea
		class="form-control"
		rows="3"
		name="Comments"
		placeholder="Please use this space to outline your idea or suggestion..."></textarea>

		<br />


		<div class="capatcha pull-right">';

		echo recaptcha_get_html(SITE_KEY, $error='');

		echo '</div>
		<div class="clearfix"></div>
		<br />

		<button type="submit" class="btn btn-success pull-right">Submit</button>

			</p>
		</form>';
			}

			echo '<br><br>

		</div>
	</div>
</div>';#END display
?>

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

<!-- FOR reCAPTCHA -->
<!-- NOT USING SO COMMENT OUT FOR NOW...
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
END reCAPTCHA -->


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?=THEME_PATH;?>js/bootstrap.min.js"></script>
<script src="<?=THEME_PATH;?>js/bootswatch.js"></script>
<!-- FOOTER end -- THEMES / BOOTSTRAP / FOOTER_INC -->
</body>
</html>
