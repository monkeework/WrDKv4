<?php

function maxDoc_library_char_advantages(){
	/**
	 * based on add.php is a single page web application that allows us to add a new customer to
	 * an existing table
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

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
require '../_inc/aarContent-inc.php';

$config->titleTag = smartTitle(); #Fills <title> tag. If left empty will fallback to $config->titleTag in
$config->metaDescription = smartTitle() . ' - ' . $config->metaDescription;

//END CONFIG AREA ----------------------------------------------------------

#dumpDie($_SESSION);

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

#if(isset($_GET['CodeName'])){$myCodeName = $_GET['CodeName']; }
$CharID = $CodeName = $Gender = ''; #initialize

#get hidden values to personize page with.
if(isset($_GET['codeName'])){#get CodeName
	$codeName = $_GET['codeName'];
	$_SESSION['codeName'] = $codeName;
}else{
	#set CodeName
	$codeName = '';
	$_SESSION['codeName'] = '';
}

#get hidden values to personize page with.
if(isset($_GET['charID'])){
	#get CharID
	$charID = $_GET['charID'];
	$_SESSION['charID'] = $charID;
}else{#get CharID
	$charID = 0 ;
	$_SESSION['charID'] = $charID;
}

#get url/hidden values to personize page with.
if(isset($_GET['gender'])){#get gender
	$gender = $_GET['gender'];
	$_SESSION['gender'] = $gender;
}else{
	#set gender
	$gender = '';
	$_SESSION['gender'] = $gender;
}


#get url/hidden values to personize page with.
if(isset($_GET['statusID'])){#get gender
	$stageID = $_GET['statusID'];
	$_SESSION['stageID'] = $stageID;
}else{
	#set gender
	$stageID = 0;
	$_SESSION['stageID'] = $stageID;
}

global $config;
//get_header will set a new global == the grfx given OR set to generic if none.
get_header('headerJumbo-inc.php', 'bgAdvantage00.jpg', 'Advantages & Merits');

#echo MaxNotes($pageDeets); #notes to me!

#used to creat links in the legend -- some &ndash; and asci code used to format some letters specifically
$titles = [ 'combat', 'defensive', 'detection', 'faith', 'magic*', 'mental', 'physical', 'restricted*', 'social', 'other' ];

#$baseSQL .= $cat == Descriptions!
$baseSQL = "SELECT AdvantageID, AdvantageName, AdvantageSum, AdvantageDesc, Available, LastUpdated FROM `ma_CharAdvantages` WHERE CatID = ";

$page='char_advantages';
$qFix='advantage'; # prefix/adverb for query string attributes
$dbFx='Advantage'; # prefix/adverb for some db assets + Name/Sum/Desc

switch ($myAction){//check 'act' for type of process
	case 'combat':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'defensive':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'detection':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'faith':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'magic':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'mental':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'physical':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'restricted':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'social':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################
	case 'other':
			#final setup of sql
			$cat = $myAction;
			$sql = $baseSQL . "'$cat';"; //for btns

			echo mk_overview($myAction, $titles, $aarLibrary_advantages[$myAction], $codeName, $gender, $charID, $page);
			echo mk_CategoryBtns($cat, $codeName, $page, $dbFx);
			echo mk_Category($sql, $cat, $charID, $codeName, $gender, $stageID, $page, $qFix, $dbFx);

		break;
	########################################################

	default:
		#customize category
		echo mk_overview($myAction, $titles, $aarLibrary_advantages['overview'], $codeName, $gender, $charID, $page);#END default

} #END switch


#CLOSE PAGE UP
get_footer('footerRecaptcha-inc.php');


#http://localhost/WrDKv3/library/skills.php?act=physical-enhancement-skills&codeName=Havok&charID=26&statusID=4&gender=male
function addTrait(){

	if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] > 2)){

		#dumpDie($_GET);

		#http://localhost/WrDKv3/library/skills.php?act=AddTrait&catID=combat&powName=beserker&charID=60&codeName=Ulli&statusID=6
		$exgPD = $addPN = $addPD = $finalPD = '';

		#SEE: http://stackoverflow.com/questions/11839523/secure-against-sql-injection-pdo-mysqli
		#we are grabbing from url string instead of $_POST here....

		$cat      	= strip_tags($_GET['catID']);				#combat-skills - combat-skills
		$skillID    = strip_tags($_GET['powID']);				#1             - power id for beserker power
		$skillName	= strip_tags($_GET['skillName']);			#name of trait - beserker
		$charID	 		= strip_tags($_GET['charID']);			#character id  - 60
		$codeName		= strip_tags($_GET['codeName']);		#codename      - Ully
		$stageID		= strip_tags($_GET['stageID']);	  #3-6 = can add a power, else no

#dumpDie($_GET);
		#TEST redirect
		if(($stageID <= 2) || ($stageID >= 7)){
			#if character stage not between 3-6, kick out
			$redirect = $_SERVER['HTTP_REFERER'];
			header( 'Location: ' . $redirect ) ;
		}


		#dumpDie($exgPD);

		#get prior power description
		$sql = "SELECT `CharID`, `CodeName`, `Aptitude` FROM ma_Characters WHERE CharID = '$charID';";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results
			#BEGIN outer HTML here
			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$exgPD = dbOut($row['Aptitude']); #Existing Power Description
				#echo '<p>' . $exgPD . '</p>';
			}
			#END OUTER HTML here
		}

		@mysqli_free_result($result); //free resources

		#dumpDie($exgPD);
		#get the power to concatinate together
		#get prior power description
		$sql = "SELECT `SkillID`, `SkillName`, `SkillDesc` FROM ma_CharPower WHERE PowID = '$powID';";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results
			#BEGIN outer HTML here
			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$addPN .= dbOut($row['SkillName']); #name for New Power
				$addPD .= dbOut($row['SkillDesc']); #name for New Power Description
				#echo '<p>' . $addPD . '</p>';
			}
			#END OUTER HTML here
		}

		@mysqli_free_result($result); //free resources

		#dumpDie($exgPD);
		#put it all together


		if($exgPD != ''){
			$finalPD = $exgPD . ' <br /><br/> ' . strtoupper($addPN) . ':: ' . personalizeStr($addPD, $codeName);
		}else{
			$finalPD = strtoupper($addPN) . ':: ' . personalizeStr($addPD, $codeName); #need gender
		}

		$SkillDesc = $finalPD;
		#dumpDie($PowDesc);

		$db = pdo(); # pdo() creates and returns a PDO object

		//build string for SQL insert with replacement vars, ?
		$sql = "UPDATE `ma_Characters` SET CharID='$charID', SkillDesc='$skillDesc' WHERE `CharID`='$charID'";


		#dumpDie($sql);
		$stmt = $db->prepare($sql);
		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
		//The Primary Key of the row that we want to update.
		$stmt = $db->prepare($sql);

		$stmt->bindValue(1, $charID, 		PDO::PARAM_STR);
		$stmt->bindValue(2, $PowDesc, 	PDO::PARAM_STR);

		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback($skillName . " Skill Added Successfully To " . $codeName . "!","success");
		}else{//Problem!  Provide feedback!
			feedback($skillName . " Skill WAS NOT ADDED to" . $codeName . "!","warning");
		}


		myRedirect(THIS_PAGE);
	}

} #END addTrait()





#ADMIN functions
function traitAdd(){

	$catName = $_GET['cat'];
	$authorID = $_SESSION['UserID'];
#dumpDie($authorID);

	# shows details from a single customer, and preloads their first name in a form.
	echo '
	<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
			if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
			if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
			return true;//if all is passed, submit!
		}
	</script>';


	echo '<h3 class="text-center">Add Power to ' . ucwords($catName) . ' power category</h3>

	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

		<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Power Name: </strong></p>
			</div>
			<div class="col-sm-9">
				<input class="col-sm-9" type="text"  name="PowName" placeholder="The name of the power">
			</div><!-- END Container -->
		</div>


		<div class="row hoverHighlight">
			<br /><br />
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Power Summary: </strong></p>
			</div>
			<div class="col-sm-9">
				<textarea
					class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="A one sentence description of the power"
					name="PowSum" ></textarea>
			</div><!-- END Container -->
		</div>


		<div class="row hoverHighlight">
			<br /><br />
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Power Description: </strong></p>
			</div>
			<div class="col-sm-9">
				<textarea
					class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="The full description of the proposed power with as much detail as possible."
					name="PowDesc" ></textarea>
			</div><!-- END Container -->

		</div>


		<input  type="hidden" name="CatID" value="' . $catName . '" />
		<input  type="hidden" name="AuthorID" value="' . $authorID . '" />
		<input  type="hidden" name="act" value="insert" />

		<br /><br />


		<div align="center">
			<input
				class="btn btn-primary btn-xs outline" type="submit" value="Add Power">
			&nbsp; &nbsp;
				<a class="btn btn-primary btn-xs outline" href="power.php">Exit Event</a>
		</div>

		<br />
	</form>
	';

}

#http://localhost/WrDKv3/power.php?act=edit&powName=Mary-Sue-ism&CatID=restricted
function traitEdit(){
	#If user is logged - allow edit else send back to power
	if(startSession() && isset($_SESSION['UserID']))
	{

		$powName 		= ($_GET["powName"]);
		#dumpDie($powName);
#string 'Mary-Sue-ism' (length=12)

		# SQL statement - PREFIX is optional way to distinguish your app
		$sql = "SELECT

			PowID, CatID, AuthorID, ReviewerID,
			PowName, SKillSum, PowDesc, Available,
			NumReviews, LastUpdated, LastUpdated

			FROM ma_CharPower

			WHERE PowName = '$powName' ;";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results


		# shows details from a single customer, and preloads their first name in a form.
		echo '
		<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>

		<script type="text/javascript">

			function checkForm(thisForm)

			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}

		</script>

		<script src="' . VIRTUAL_PATH . '_ckEditor/ckeditor.js"></script>
		';

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db

				$skillID			= dbOut($row['SkillID']);
				$catID			= dbOut($row['CatID']);
				$authorID		= dbOut($row['AuthorID']);
				$skillName		= dbOut($row['SkillName']);
				$skillSum			= dbOut($row['SkillSum']);
				$skillDesc		= dbOut($row['SkillDesc']);

				$authorID		= $_SESSION['UserID'];


				echo '<h3 class="text-center">Edit ' . ucwords($powName) . ' power entry</h3>

				<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Power Name: </strong></p>
						</div>
						<div class="col-sm-9">
							<input class="col-sm-9" type="text" name="PowName" value="' . $skillName . '">
						</div><!-- END Container -->
					</div>


					<div class="row hoverHighlight">
						<br /><br />
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Power Summary: </strong></p>
						</div>
						<div class="col-sm-9">
							<textarea
								class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="A one sentence description of the power"
								name="PowSum">' . $skillSum . '</textarea>
						</div><!-- END Container -->
					</div>


					<div class="row hoverHighlight">
						<br /><br />
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Power Description: </strong></p>
						</div>
						<div class="col-sm-9">
							<textarea
								class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="The full description of the proposed power with as much detail as possible."
								name="PowDesc" >' . $skillDesc . '</textarea>
						</div><!-- END Container -->

					</div>


					<input  type="hidden" name="PowID" value="' . $skillID . '" />
					<input  type="hidden" name="CatID" value="' . $skillID . '" />
					<input  type="hidden" name="AuthorID" value="' . $authorID . '" />


					<input type="hidden" name="act" value="revise" />

					<br />


					<div align="center">
						<input class="btn btn-primary btn-xs outline"
							type="submit"
							value="Edit Power!">

							&nbsp; &nbsp;

						<a class="btn btn-primary btn-xs outline"
							href="powers.php"
							title="Exit"
							">Exit Event</a>

							&nbsp; &nbsp;

						<a class="pull-right"
							href="#" title="Delete Power">
								<i class="glyphicon glyphicon-trash"></i>
						</a>

							&nbsp; &nbsp;

					</div>

					<br />';

			}

			echo '</form>';

		}else{//no records
				echo '<div align="center">
					<h3>Currently No event found matching this power ID.</h3>
				</div>';
		}

		@mysqli_free_result($result); //free resources

	} else { #redirect back to power

		myRedirect('index.php');
	}


}

function traitInsert(){

	$CatID			= strip_tags($_POST['CatID']);
	$AuthorID		= strip_tags($_POST['AuthorID']);
	$SkillName		= strip_tags($_POST['SkillName']);
	$SkillSum			= strip_tags($_POST['SkillSum']);
	$SkillDesc		= strip_tags($_POST['SkillDesc']);

	$db = pdo(); # pdo() creates and returns a PDO object

	//dumpDie($FirstName);

	//PDO Quote has some great stuff re: injection:
	//http://www.php.net/manual/en/pdo.quote.php

	//next check for specific issues with data
	/*
	if(!ctype_graph($_POST['FirstName'])|| !ctype_graph($_POST['LastName']))
	{//data must be alphanumeric or punctuation only
		feedback("First and Last Name must contain letters, numbers or punctuation");
		myRedirect(THIS_PAGE);
	}


	if(!onlyEmail($_POST['Email']))
	{//data must be alphanumeric or punctuation only
		feedback("Data entered for email is not valid");
		myRedirect(THIS_PAGE);
	}
	*/

		//build string for SQL insert with replacement vars, ?
		$sql = "INSERT INTO ma_CharSkills (
				CatID, AuthorID, SkillName, SkillSum, SkillDesc
			)
			VALUES ( ?, ?, ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $CatID,				PDO::PARAM_STR);
	$stmt->bindValue(2, $AuthorID,		PDO::PARAM_STR);
	$stmt->bindValue(3, $SkillName,		PDO::PARAM_STR);
	$stmt->bindValue(4, $SkillSum,		PDO::PARAM_STR);
	$stmt->bindValue(5, $SkillDesc,		PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Power Added Successfully To {$catName}!","success");
	}else{//Problem!  Provide feedback!
		feedback("Power NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}

function traitRevise(){

	#dumpDie($_POST);
	/*

	array (size=7)

	'PowName' => string 'beserker' (length=8)
	'PowSum' => string 'summary to come' (length=15)
	'PowDesc' => string 'your character can enter into a battle-like rage that alters your character in some significant ways. Reason and Psyche plummet to Feeble rank while the ranks for Strength and Fighting increase by the same number of ranks. (That is, the total number of points lost are split evenly between the Fighting and Strength ranks.) your character also develops Iron Will for the duration of the Berserker rage; the rank for this is the same as the Berserker Power' rank. The Berserker lasts for the length of combat and '... (length=787)
	'PowID' => string '1' (length=1)
	'CatID' => string 'combat' (length=6)
	'AuthorID' => string '1' (length=1)
	'act' => string 'revise' (length=6)

	*/


	$PowName			 		= strip_tags($_POST['PowName']);				#int - primaryKey
	$PowSum			 		  = strip_tags($_POST['PowSum']); 					#int
	$PowDesc			 		= htmlspecialchars($_POST['PowDesc']); 			#str
	$PowID			 			= strip_tags($_POST['PowID']);
	$CatID			 			= strip_tags($_POST['CatID']);  			#str - entered by user
	$AuthorID			 		= strip_tags($_POST['AuthorID']);          #str of comma sep numbers



	#dumpDie($PowDesc);
	#string 'string 'XcharnameX can can enter into a battle-like rage that alters XcharnameX in some significant ways. Reason and Psyche plummet to Feeble rank while the ranks for Strength and Fighting increase by the same number of ranks. (That is, the total number of points lost are split evenly between the Fighting and Strength ranks.) XcharnameX also develops Iron Will for the duration of the Berserker rage; the rank for this is the same as the Berserker Power' rank. The Berserker lasts for the length of combat and 10 turns'... (length=782)'

	$db = pdo(); # pdo() creates and returns a PDO object

	//build string for SQL insert with replacement vars, ?
	$sql = "UPDATE `ma_CharPower`
		SET
			PowName='$PowName',
			PowSum='$PowSum',
			PowDesc='$PowDesc',
			PowID='$PowID',
			CatID='$CatID',
			AuthorID='$AuthorID'

		WHERE `PowID`='$PowID'";

	#dumpDie($PowDesc);
	#string 'string 'XcharnameX can can enter into a battle like rage that alters XcharnameX in some significant ways. Reason and Psyche plummet to Feeble rank while the ranks for Strength and Fighting increase by the same number of ranks. That is, the total number of points lost are split evenly between the Fighting and Strength ranks. XcharnameX also develops Iron Will for the duration of the Berserker rage the rank for this is the same as the Berserker Power' rank. The Berserker lasts for the length of combat and 10 turns'... (length=782)'

#dumpDie($sql);
/*

'UPDATE `ma_CharPower`
		SET
			PowName='beserker',
			PowSum='summary to come',
			PowDesc='XcharnameX can can enter',
			PowID='1',
			CatID='combat',
			AuthorID='1'

		WHERE `PowID`='1'' (length=188)

*/



	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	//The Primary Key of the row that we want to update.
	$stmt = $db->prepare($sql);

	$stmt->bindValue(1, $PowName, 		PDO::PARAM_STR);
	$stmt->bindValue(2, $PowSum, 			PDO::PARAM_STR);
	$stmt->bindValue(3, $PowDesc, 		PDO::PARAM_STR);
	$stmt->bindValue(4, $PowID, 			PDO::PARAM_STR);
	$stmt->bindValue(5, $CatID, 			PDO::PARAM_STR);
	$stmt->bindValue(6, $AuthorID, 		PDO::PARAM_STR);

	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Event Revised Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Event NOT REVISED!","warning");
	}
	myRedirect(THIS_PAGE);
}

function traitTrash(){
	#dumpDie($_POST);
	$TimelineID			 	= strip_tags($_GET['TimelineID']);				  #int - primaryKey
	#$EntryID			 		  = strip_tags($_POST['EntryID']); 					#int
	#$EntryTitle			 	= strip_tags($_POST['EntryTitle']); 			#str
	#$EntryDate			 		= strip_tags($_POST['EntryDate']);  			#str - entered by user
	#$EntryDescription	= strip_tags($_POST['EntryDescription']); #str
	#$CharTag			 			= strip_tags($_POST['CharTag']);          #str of comma sep numbers

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_Timeline WHERE `TimelineID` = :TimelineID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':TimelineID', $TimelineID, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Event Removed Successfully From Timeline!","success");
	}else{//Problem!  Provide feedback!
		feedback("Event Not Trashed!","warning");
	}
	myRedirect(THIS_PAGE);
}
#script for expanding textarea
