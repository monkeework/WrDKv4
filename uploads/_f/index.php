<?php
#@TODO - deal with how special characters are handled in search like a single quote such as " m'crackname is somethign with a single quote in it."
function maxDoc_library_index(){
	/**
	 * based on add.php, pbChek.php is a single page web application
	 * pvChek displays all actively quantified, available/unused/unclaimed playby site options.
	 *
	 * LAYOUT: http://www.w3schools.com/bootstrap/bootstrap_templates.asp
	 *
	 * This page is based onedit.php
	 *
	 * Any number of additional steps or processes can be added by adding keywords to the switch
	 * statement and identifying a hidden form field in the previous step's form:
	 *
	 *<code>
	 * <input type="hidden" name="act" value="next" />
	 *</code>
	 *
	 * The above code shows the parameter "act" being loaded with the value "next" which would be the
	 * unique identifier for the next step of a multi-step process
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


$pageDeets = '<li> UPGRADE --> noCaptcha</li>
	<li> Review/update function checkForm(thisForm)</li>
	<li> used pb chek</li>';

# '../' works for a sub-folder.  use './' for the root
require './../../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
	$config->titleTag = smartTitle(); #Fills <title> tag.
	$config->metaDescription = smartTitle() . ' - ' . $config->metaDescription;


	#$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
	#$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
	#$config->metaRobots = 'no index, no follow';
	# The config property named 'loadHead' places JS, CSS, etc. inside the <head> tag - only use double quotes, or escape them!
	$config->loadhead = '<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>
		<!-- Edit Required Form Elements via JavaScript Here -->
	<script type="text/javascript">
		//here we make sure the user has entered valid data
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.Name,"Please Enter Your Name")){return false;}
			if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
			return true;//if all is passed, submit!
		}
	</script>

	<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
	<style type="text/css">
		.required {font-style:italic;color:#FF0000;font-weight:bold;}
	</style>


	<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
	<style>
		.jumbotron {
			position: relative;
			background: #000 url("../_img/_bgs/bgPlayBy00.jpg") center center;
			width: 100%;
			height: 100%;
			background-size: cover;
			overflow: hidden;
			color: white;
		}

		div.container div.jumbotron h1 b, div.jumbotron p {
			color: white;
			text-shadow: 2px 2px 16px #000000;
			text-shadow: 0 0 16px #000000;
		}

		/* Set height of the grid so .sidenav can be 100% (adjust if needed) */
		.row.content {height: 1500px}

		/* On small screens, set height to \'auto\' for sidenav and grid */
		@media screen and (max-width: 767px) {
			.sidenav {
				height: auto;
				padding: 15px;
			}
			.row.content {height: auto;}
		}

		p:first-letter{ text-transform: capitalize; }
	</style>


	<!-- JS for captcha.  Move to your _JS? (or not) -->
	<script type="text/javascript">
		 var RecaptchaOptions = {
				theme : "clean"
		 };
	 </script>

	 <!-- CSS class for captcha.  Move to your CSS? (or not) -->
		<style>
			.g-recaptcha div { margin-left: auto; margin-right: auto;}

			#recaptcha_area { margin: auto;}
		</style>
	';



	#END   CONFIG for contact form (Not General Contact Modal)

//END CONFIG AREA ----------------------------------------------------------



# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

#for search
#dumpDie($_GET);
#if(isset($_REQUEST['search'])){$myAction = (trim($_REQUEST['search']));}else{$myAction = "";}

$dirPath=$gender=$pbExt=$pbName=$pbAltName=$pbPath=$prefix=$b=$e=$h=$s=''; #initialize

if(isset($_GET['act'])){
	$gender = $_GET['act'];
}else{ $gender = '';}

#get hidden values to personize page with.
if($gender == 'm'){
	#get gender setting
	$gender = 'male';
	$prefix = 'm';
}else if($gender == 'f'){
	#initialize the vars if they empty
	$gender = 'female';
	$prefix = 'f';
}else{
	#initialize the vars if they empty
}

global $config;


get_header();

echo MaxNotes($pageDeets); #notes to me!

echo "
	<div class='jumbotron'>
		<h1 style='margin: 0 0 -35px -35px;'><br /><br /><br /><br />
		<b>Playbys</b></h1>
	</div>


	<div class='container-fluid'>

		<div class='row content'>
			<div class='col-sm-3 sidenav'>

			<br />

				<a href='?act=f' class='btn btn-primary btn-xs'>Female Playbys</a>
				 &nbsp;
				<a href='?act=m' class='btn btn-primary  btn-xs'>Male Playbys</a><br /><br />";

/*
				<!--
				<label>Search by Gender...</label>
				<select class='selectpicker' data-style='btn-primary'
					multiple data-max-options='1'
					>
					<option value='gF'>Gender - Female</option>
					<option value='gM'>Gender - Male</option>
				</select>



				<br /><br />

				<select class='selectpicker'
					data-style='btn-primary'
					multiple data-max-options='1'
					>
					<option selected>Search by Hair Color...</option>
					<option value='hBk'>Hair - Black</option>
					<option value='hBn'>Hair - Brown</option>
					<option value='hBe'>Hair - Blonde</option>
					<option value='hAn'>Hair - Auburn</option>
					<option value='hCt'>Hair - Chestnut</option>
					<option value='hWt'>Hair - Red</option>
					<option value='hGy'>Hair - Grey</option>
					<option value='hWe'>Hair - White</option>
				</select>

				<br /><br />

				<select class='selectpicker'
					data-style='btn-primary'
					multiple data-max-options='1'
					>
					<option selected>Search by Eye Color...</option>
					<option value='hBl'>Eyes - Black</option>
					<option value='eBe'>Eyes - Blue</option>
					<option value='eBn'>Eyes - Brown</option>
					<option value='hGn'>Eyes - Green</option>
					<option value='hGy'>Eyes - Grey</option>
					<option value='eAr'>Eyes - Amber</option>
					<option value='eHl'>Eyes - Hazel</option>
					<option value='hRd'>Eyes - Red</option>
					<option value='eVt'>Eyes - Violet</option>
				</select>

				<br /><br />

				<select class='selectpicker'
					data-style='btn-primary'
					multiple data-max-options='1'
					>
					<option selected>Search by Body Type...</option>
					<option value='pSm'>Physique - Heroic</option>
					<option value='pAc'>Physique - Athletic</option>
					<option value='pFt'>Physique - Lanky</option>
					<option value='pAc'>Physique - Trim</option>
					<option value='pOt'>Physique - Overweight</option>
					<option value='pOe'>Physique - Obese</option>
				</select>

				<br /><br />

				<select class='selectpicker'
					data-style='btn-primary'
					multiple data-max-options='1'
					>
					<option selected>Search By Race...</option>
					<option value='rAp'>Race - Asian/Pacific</option>
					<option value='rAa'>Race - Afro American</option>
					<option value='rLs'>Race - Latino/Spanish</option>
					<option value='rNa'>Race - Native American</option>
					<option value='rWe'>Race - White</option>
				</select>

				<br /><br />


				-->

*/



echo "<!-- <a href='?act=f&name=some_one'-->

				<form class='navbar-form' role='search'>
					<div class='input-group add-on'><input class='form-control'
							placeholder='Check Playbys for...'
							name='act' id='srch-term'
							type='text'><div class='input-group-btn'>
							<button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i>			</button>
					</div></div>
				</form>

			</div>
			<div class='col-sm-9'>";


switch ($myAction)
{//check 'act' for type of process
	case "m":
		#show available male casting options.
		echo "<h3>Current Unclaimed <b>{$gender}</b> Playbys:</h3>
			<div class='clearfix'><div>";

	#asaf_goren---bld=fit+eyes=brown+hair=brunette+rc=white
	#build = b (slim, fit, athletic, muscular, husky, fat)
	#eyes = e (blue, hazel, green, grey, brown, black)
	#hair = h (blonde, red, grey, brown, black, other)
	#race = r (white, black, asain, hispanic, mixed)
		echo showAvailable($gender, $prefix, $b='', $e='', $h='', $s='');

		break;
	########################################################
	case "f":
		#show available male casting options.
		echo "<h3>Current Unclaimed <b>{$gender}</b> Playbys:</h3>
			<div class='clearfix'><div>";
		echo showAvailable($gender, $prefix, $b='', $e='', $h='', $s='');

		break;

	########################################################
	default:

		if( (isset($_REQUEST['act'])) && ($_REQUEST['act']) ){

		#if( isset($_REQUEST['act']) ){
			#prep data
			$pbName   = htmlspecialchars(strtolower($_GET['act']));
			$pbName   = stripcslashes($pbName);
			#echo 'pbName 1 ' . $pbName  . '<br />';

			$pbSearch = str_replace(" ", "_", $pbName); 	//whitespace
			#echo 'search 2 ' . $pbSearch  . '<br />';
			$pbSearch = str_replace("+", "_", $pbSearch);	//plus sign
			#echo 'search 2 ' . $pbSearch  . '<br />';
			$pbSearch = str_replace("'", "_", $pbName);  	//single quote
			#echo 'search 2 ' . $pbSearch  . '<br />';
			$pbSearch = str_replace("-", "_", $pbSearch); //dash
			#echo 'search 3 ' . $pbSearch  . '<br /><br /><br />';



			#echo 'pbName 1 ' . $pbName  . '<br />';
			$pbName   = ucwords(str_replace("_", " ", $pbName));
			#echo 'pbName 2 ' . $pbName  . '<br />';
			$pbName   = ucwords(str_replace("+", " ", $pbName));
			#echo 'pbName 3 ' . $pbName  . '<br />';

			//seach for character entered
			echo searchResult($pbSearch, $pbName);
		}

		if((!isset($_REQUEST['act'])) || (empty($_REQUEST['act']))){
			#include INCLUDE_PATH . "aarContent-inc.php";
			#echo $aarContent['UploadDefault']; #Default content
		}

		#END display
}


#CLOSE PAGE UP
echo '</div>
<div class="clearfix">
<hr >


	<form role="form" action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<h4><i>Is there a Playby whom you are interested in that you didn\'t see?</i></h4>';

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

			#echo recaptcha_get_html($publickey, $error);
			#echo recaptcha_get_html(SITE_KEY, $error);

			echo '</div>
				<div class="clearfix"></div>
				<br />

				<button type="submit" class="btn btn-success pull-right">Submit</button>

				</p>';
		}

		echo '</form>
				<br>
				<br>
			</div>
		</div>
	</div>
</div>';#END display

get_footer();


#showAvailable($gender, $prefix, $b='', $e='', $h='', $s='');
function showAvailable($gender, $prefix, $str = ''){
/**
	* Show unclaimed PBs
	*
	*
	* TODO compare against active handler/PB claims
	**/

	$pbExt = '-001.jpg';
	$dirPath = "./_uploads/_{$gender}/";


	foreach(glob("./_{$gender}/*", GLOB_ONLYDIR) as $dir) {
			$dirname = basename($dir);
			$mappen[] = $dirname;
	}


	natsort($mappen);
	foreach($mappen as $map){


		#remove sorting nonsense to make printable name (everything after the dash)
		$pbName = substr($map, 0, strpos($map, '---'));

		$pbAltName = $map;
		#remove underscore to make printable name
		$pbName = ucwords(str_replace("_", " ", $pbName));

		$search_dir = "./_{$gender}/".$map;
		$images = glob("$search_dir/*");
		sort($images);

		if (count($images) > 0) {
				 $imgPath = $images[0];

			//can be removed once we have the whole search thing working
			//make backup character title basically incase title not generated.
			if($pbName==''){
				$pbName=$pbAltName;
				$pbName = str_replace('_', ' ',  $pbName);
				$pbName = '<span class="text-muted"> ' . $pbName . ' </span>';
			}


			$str .=  '<!--playby-->
				<div class="" style="float: right; margin: 10px; text-align: center">
					<a href="viewPlayby.php?act=show&gender=' . $gender . '&img='. $map .'" >
						<figure>
						<!--playby preview-->

							<img src="./'. $imgPath .'" alt="0" style="
										border-radius: 25px; border: 2px solid #bbb;
										width: 150px; height: 150px;">

							<!--description and price of product-->
							<figcaption>
								<h6 class=""> ' . ucwords($pbName) . ' </h6>
							</figcaption>
						</figure>
					</a>
				</div>';

		}


	}

	$str .= "<div class='clearfix'></div>";


	return $str;

}

function searchResult($pbSearch='', $pbName='', $gender='', $str=''){
	//chek if playby exists...
	$pbExt 			= '-001.jpg';
	$dirPath 		= "./_playbys/";

	$chekMale 	= './../uploads/_male/' . $pbSearch;
	$chekFemale = VIRTUAL_PATH . 'uploads/_female/' . $pbSearch;

	//END Function config

	#1 confirm exists
	if(file_exists($chekFemale)) {
		//set gender
		$gender = 'female';
		#2a -  show result for each
		echo '<!--playby-->
		<h3>All Search Results for <b>" . $pbSearch . " - " . $pbName . "</b>:</h3>

		<div class="clearfix"><div>

		<div class="" style="float: right; margin: 10px; text-align: center">
			<a href="./viewPlayby.php?act=show&gender=' . $gender . '&img=' . $pbSearch . '" >
				<figure>
					<!--playby preview-->
					<img src="' . $chekFemale .'/' . $pbSearch . '/' . $pbSearch .'-001.jpg" alt="0" style="
						border-radius: 25px; border: 2px solid #bbb;
						width: 150px; height: 150px;">
					<!--description of playby -->
					<figcaption>
						<h6 class=""> ' . $pbName . ' </h6>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="clearfix"></div> ';

	} else if (file_exists($chekMale)) {
		//set gender
		$gender = 'male';
		#2b - show result for each

		echo '<!--playby-->
		<h3>All Search Results for <b>' . $pbName . '</b>:</h3>

		<div class="clearfix"><div>

		<div class="" style="float: right; margin: 10px; text-align: center">
			<a href="./viewPlayby.php?act=show&gender=' . $gender . '&img=' . $pbSearch . '" >
				<figure>
					<!--playby preview-->
					<img src="' . $chekMale .'/' . $pbSearch .'-001.jpg" alt="0" style="
						border-radius: 25px; border: 2px solid #bbb;
						width: 150px; height: 150px;">
					<!--description of playby-->
					<figcaption>
						<h6 class=""> ' . $pbName . ' </h6>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="clearfix"></div>';

	} else {
		#provide feedback if no results found :(
		echo "<h3> <i>{$pbName}</i> was not found in our image library</h3>
		<div class='clearfix'></div>";
	}


} //END searchResult()









