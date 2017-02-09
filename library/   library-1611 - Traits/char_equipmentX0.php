<?php

#test URL: http://localhost/WrDKv3/library/powers.php?act=travel-items&codeName=Ulli&charID=60&stageID=4&gender=male
function maxDoc_library_char_equipment(){
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

# '../' works for a sub-folder.  use './' for the root
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
require '../_inc/aarContent-inc.php';

	$config->titleTag = smartTitle(); #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
	$config->metaDescription = smartTitle() . ' - ' . $config->metaDescription;



//END CONFIG AREA ----------------------------------------------------------

#dumpDie($_SESSION);

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

#if(isset($_GET['CodeName'])){$myCodeName = $_GET['CodeName']; }
$CharID=$CodeName=$Gender=''; #initialize

#get hidden values to personize page with.
if(isset($_GET['codeName'])){#get CodeName
	$codeName = $_GET['codeName'];
	$_SESSION['codeName'] = $codeName;
}else{
	#set CodeName
	$codeName='';
	$_SESSION['codeName']='';
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
	$gender='';
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
get_header('headerJumbo-inc.php', 'bgItems00.jpg', 'Equipment');

#echo MaxNotes($pageDeets); #notes to me!


#$baseSQL .= $cat == Descriptions!
$baseSQL = "SELECT ItemID, ItemName, ItemSum, ItemDesc, Available, LastUpdated FROM `ma_CharItems` WHERE CatID ";

#function genCategory($sql, $charID, $codeName, $gender, $stageID,  $str='' )
switch ($myAction){//check 'act' for type of process

	case 'general':
			#final setup of sql
			$cat  = 'general';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

		#dumpDie($sql);

			echo genOverview($myAction, $aarLibrary_equipment['general'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

	 #($sql, $cat, $charID, $codeName, $gender, $stageID)
	 ##$sql, $charID, $codeName, $gender, $stageID, $sql='', $str=''

		break;

	########################################################
	case "restraint":
			#final setup of sql
			$cat  = 'restraint';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_equipment['restraint'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;
	
	########################################################
	case "restricted":
			#final setup of sql
			$cat  = 'restricted';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_equipment['restricted'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "tool":
			#final setup of sql
			$cat  = 'tool';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_equipment['tool'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case 'ultility':
			#final setup of sql
			$cat  = 'ultility';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_equipment['ultility'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;
	
	########################################################
	case "weapon":
			#final setup of sql
			$cat  = 'weapon';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_equipment['weapon'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "other":
			#final setup of sql
			$cat  = 'other';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_equipment['other'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	##################    ADMIN STUFF     ##################
	########################################################

/*
	case "addTrait":
			chekPrivies(4); #admin+
			echo addTrait(); //We get stuff from link here.. be careful

		break;


	########################################################
	##################    ADMIN STUFF     ##################
	########################################################


	case "add":
		chekPrivies(4); #admin+
		echo powerAdd(); #show my silly assed power

		break;
	########################################################
	case "edit":

		chekPrivies(4); #admin+
		echo powerEdit(); #process event/add to power

		break;
	########################################################
	case "insert":
		chekPrivies(4); #admin+
		echo powerInsert(); #process event/add to power

		#myRedirect(THIS_PAGE);

		break;
	########################################################
	case "revise":

		#dumpDie($_POST);

		chekPrivies(4); #admin+
		echo powerRevise(); #process event/add to power

		#myRedirect(THIS_PAGE);

		break;
	########################################################
	case "trash":
		chekPrivies(4); #admin+
		echo powerTrash(); #process event/add to power

		break;
	########################################################

*/

	default:
		#customize category
		echo genOverview($myAction, $aarLibrary_equipment['overview'], $codeName, $gender, $charID);;#END default

} #END switch


get_footer('footerRecaptcha-inc.php');


function genOverview($myAction='', $mainContent='', $codeName, $charID, $gender, $str=''){ #format descriptions from array and

	#remove the dashes used for urls
	$mySubjectTitle = str_replace('-', ' ', $myAction);

	$str  .= '<div class="container-fluid">
			<div class="row content">

				<div class="col-sm-3 sidenav">
				<br />';

	//Let folks tweak descriptions to their characters
	$str .= formPersonalizer($codeName, $gender);

	$str .= strPersonalizer();
	$str .= genLegend();

	$str .= '<br />
					<div class="input-group class="col-sm-3" >
						<input type="text" class="form-control" placeholder="Search To Come..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</div><!-- end sidebar-->

			<div class="col-sm-9">
				<h2>' . ucwords($mySubjectTitle) . '</h2>
				<h5><span class="glyphicon glyphicon-time"></span> Post by Monkee, October 9, 2016.</h5>
				<h5><span class="label label-danger">Powers</span> <span class="label label-primary">Character Creation</span></h5><br>';

	$str .= customizeData($mainContent, $gender, $codeName, $stripTags='n');

	$str .= '<p>
				<em class="text-muted"><b>Note</b> - If you are logged in to ' . SITE_NAME . ', each entry shown below may already be personalized to reflect your character&quot;s codename and gender. If not, then they are shown in a generic format, but you can still set them to reflect your characters gender and codename by using the customizer located just above the catagory legend. Doing so will will instantly then format all the descriptions to your specifications to help you on your way to building an awesome addition to the  ' . SITE_NAME . ' universe.</em>
			</p>
			<hr />';

	return $str;
}

function genLegend($codeName='', $charID = 0,  $gender='', $str='' ){ #generate category legend and links from array
	#$CodeName, $CharID are fed to us via Sh
	if(isset($_GET['codeName'])){$codeName = ($_GET['codeName']); }
	if(isset($_GET['charID'])){$charID = ($_GET['charID']); }
	if(isset($_GET['gender'])){$gender = ($_GET['gender']); }

	$charID = (int)$charID; #cast as int to be safe.

	#used to creat links in the legend -- some &ndash; and asci code used to format some letters specifically
	$myTitles =      ['general', 'restraint', 'restricted', 'tool', 'ultility', 'weapon', 'other'];
	$myLoadedQuery = ['general', 'restraint', 'restricted', 'tool', 'ultility', 'weapon', 'other'];

	$str .= '<h4><a href="' . THIS_PAGE . '">Equipment & Utilities</a></h4>

		<ul class="nav nav-pills nav-stacked">';

	$count=0;

	foreach($myTitles as $title){
		$myLabel = str_replace("-", " ", $title);

		#if our switch matchs, highlight legend li
		$url  = $myLoadedQuery[$count];
		$chek = $_SERVER['REQUEST_URI']; #get url to test match too
		#clean url for first test
		$act = str_replace("/WrDK/traits/char_equipment.php?act=","", $chek );

		#var_dump($codeName);
		#var_dump($charID);

		if($act == $url){
				$str .= '<li class="active">
					<a style="color: white;" href="'
						. VIRTUAL_PATH . 'library/char_equipment.php?act='
						. $myLoadedQuery[$count++]
						. '&codeName=' . $_SESSION['codeName']
						. '&charID=' . $charID
						. '&gender=' . $gender
						. '">'
						. ucwords($myLabel)
						. ' </a>
					</li>';

			#if title matches these, don't show unless admin or soemthing
			}else if($title == 'magic&ndash;&#76;ike' || $title == 'restricted'){

				$str .= '<li>
					<a class="" href="' . VIRTUAL_PATH . 'library/char_equipment.php?'
						. '&codeName=' . $codeName
						. '&charID=' . $charID
						. '&gender=' . $gender
						. '">'
						. ucwords($myLabel)
						. '<sup>*<sup> </a>
					</li>';

					[$count++];

			#show me unhighlighted all others
			}else{
				$str .= '<li>
					<a  href="' . VIRTUAL_PATH . 'library/char_equipment.php?act='
						. $myLoadedQuery[$count++]
						. '&codeName=' . $codeName
						. '&charID=' . $charID
						. '&gender=' . $gender
						. '">'
						. ucwords($myLabel)
						. ' </a>
					</li>';
			}
	}

	$str .= '</ul>';

	return $str;
}


	 #($sql, $cat, $charID, $codeName, $gender, $stageID)
	 ##$sql, $charID, $codeName, $gender, $stageID, $sql='', $str=''

function genCategory($sql, $cat, $charID, $codeName, $gender, $stageID, $str='' ){ #generate cat descs...
	#dumpDie($charID);

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#BEGIN external formatting
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$itemID   = (int)dbOut($row['ItemID']);
			$itemName = dbOut($row['ItemName']);
			$itemDesc = dbOut($row['ItemDesc']);

			$itemLink = str_replace('', ' ', $itemName);

			#uppercase everything up to first paren, then "small"
			#creat anchors - see: http://www.echoecho.com/htmllinks08.htm
			$str .= '<p><strong class="text-primary"><a name="' . $itemLink . '">' . ucwords($itemName) . '</a>: (#' . ucwords($itemID) . ')</strong> <br />'
				. dbOut($row['ItemDesc']) . '</p>';

			if(isset($stageID) && ($stageID >= 3)){$str .= '<a
				class="btn btn-info pull-left btn-xs"
				href="' . VIRTUAL_PATH . 'library/char_equipment.php?act=addTrait&catID='
												. $cat	        #combat-items - combat-items
				. '&itemID='   . $itemID  		#1             - beserker	id num
				. '&itemName=' . $itemName    #name of trait - beserker
				. '&charID=' 		. $charID       #character id  - 60
				. '&codeName='  . $codeName     #codename      - Ully
				. '&stageID='   . $stageID			#3-6 = can add a power, else nope
				. '"
				title="Click to add ' . $itemName . '  to ' . $codeName . '"><span class="glyphicon glyphicon-plus"></span> Add ' . strtoupper($itemName) . ' power to ' . $codeName . '</a>';
			}

			#Edit trait
			#$_SESSION['Privilege'] >= 4
			if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] >= 4)){$str .= '<a class="btn btn-info pull-right btn-xs" href="' . VIRTUAL_PATH .'library/char_equipment.php?act=edit&powName=' . $itemName . '&CatID=' . $cat . '" title="Click to edit"><span class="glyphicon glyphicon-edit"></span></a>';
			}
			$str .= '<br /><hr />';
		}
	}else{//no records
			echo '<p>Currently No Mathcing Descriptions Available.</p><hr />';
	}

	@mysqli_free_result($result); //free resources

	#personalize data
	$str = strPersonalizer($str, $codeName, $gender);


	if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] >= 4)){

		#$_SESSION['Privilege'] >= 6

		#add additional cheks
		#if is admin, suepr, owner, developer or is player show edit option.

		$str .= '<div align="center">
					<a class="btn btn-primary btn-sm" href="' . THIS_PAGE . '?act=add&cat=' . $cat .'"><i class="glyphicon glyphicon-pencil"></i> add Power</a>
				</div>';
	}

	$str .= '<hr />';

	return ucfirst($str);
}

function genCategoryBtns($sql, $codeName='', $str='' ){ #generate cat descs...
	#act/myAction already set on line #115

	#if we have a codename
	if(empty($codeName)){$codeName='your character';}

	$sql = "SELECT ItemName, Available FROM `ma_CharItems` WHERE CatID = '$sql'; ";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#BEGIN external formatting
		$str .= '<p>';
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$itemName  = dbOut($row['ItemName']);
			$itemAvail = dbOut($row['Available']);

			$itemLink  = str_replace ('-', ' ', $itemName);

			#uppercase everything up to first paren, then "small"
			#creat anchors - see: http://www.echoecho.com/htmllinks08.htm
			$str .= '<small><a class="btn btn-primary btn-xs" href="#' . $itemLink . '">' . ucwords($itemName) . '</a></small>';
		}
		#END external formatting
		$str .= '</p><hr />';
	}

	@mysqli_free_result($result); //free resources

	return $str;
}
//Need to handle gender




#http://localhost/WrDKv3/library/items.php?act=physical-enhancement-items&codeName=Havok&charID=26&statusID=4&gender=male
function addTrait(){

	if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] > 2)){

		#dumpDie($_GET);

		#http://localhost/WrDKv3/library/items.php?act=AddTrait&catID=combat&powName=beserker&charID=60&codeName=Ulli&statusID=6
		$exgPD = $addPN = $addPD = $finalPD='';

		#SEE: http://stackoverflow.com/questions/11839523/secure-against-sql-injection-pdo-mysqli
		#we are grabbing from url string instead of $_POST here....

		$cat      	= strip_tags($_GET['catID']);				#combat-items - combat-items
		$itemID    = strip_tags($_GET['powID']);				#1             - power id for beserker power
		$itemName	= strip_tags($_GET['itemName']);			#name of trait - beserker
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
		$sql = "SELECT `ItemID`, `ItemName`, `ItemDesc` FROM ma_CharPower WHERE PowID = '$itemID';";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results
			#BEGIN outer HTML here
			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$addPN .= dbOut($row['ItemName']); #name for New Power
				$addPD .= dbOut($row['ItemDesc']); #name for New Power Description
				#echo '<p>' . $addPD . '</p>';
			}
			#END OUTER HTML here
		}

		@mysqli_free_result($result); //free resources

		#dumpDie($exgPD);
		#put it all together


		if($exgPD != ''){
			$finalPD = $exgPD . ' <br /><br/> ' . strtoupper($addPN) . ':: ' . strPersonalizer($addPD, $codeName);
		}else{
			$finalPD = strtoupper($addPN) . ':: ' . strPersonalizer($addPD, $codeName); #need gender
		}

		$ItemDesc = $finalPD;
		#dumpDie($PowDesc);

		$db = pdo(); # pdo() creates and returns a PDO object

		//build string for SQL insert with replacement vars, ?
		$sql = "UPDATE `ma_Characters` SET CharID='$charID', ItemDesc='$itemDesc' WHERE `CharID`='$charID'";


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
			feedback($itemName . " Item Added Successfully To " . $codeName . "!","success");
		}else{//Problem!  Provide feedback!
			feedback($itemName . " Item WAS NOT ADDED to" . $codeName . "!","warning");
		}


		myRedirect(THIS_PAGE);
	}

}  #END addTrait()





#ADMIN functions
function powerAdd(){

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
function powerEdit(){
	#If user is logged - allow edit else send back to power
	if(startSession() && isset($_SESSION['UserID']))
	{

		$itemName 		= ($_GET["powName"]);
		#dumpDie($itemName);
#string 'Mary-Sue-ism' (length=12)

		# SQL statement - PREFIX is optional way to distinguish your app
		$sql = "SELECT

			PowID, CatID, AuthorID, ReviewerID,
			PowName, SKillSum, PowDesc, Available,
			NumReviews, LastUpdated, LastUpdated

			FROM ma_CharPower

			WHERE PowName = '$itemName' ;";

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

				$itemID		= dbOut($row['ItemID']);
				$catID			= dbOut($row['CatID']);
				$authorID		= dbOut($row['AuthorID']);
				$itemName	= dbOut($row['ItemName']);
				$itemSum		= dbOut($row['ItemSum']);
				$itemDesc	= dbOut($row['ItemDesc']);

				$authorID		= $_SESSION['UserID'];


				echo '<h3 class="text-center">Edit ' . ucwords($itemName) . ' power entry</h3>

				<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Power Name: </strong></p>
						</div>
						<div class="col-sm-9">
							<input class="col-sm-9" type="text" name="PowName" value="' . $itemName . '">
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
								name="PowSum">' . $itemSum . '</textarea>
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
								name="PowDesc" >' . $itemDesc . '</textarea>
						</div><!-- END Container -->

					</div>


					<input  type="hidden" name="PowID" value="' . $itemID . '" />
					<input  type="hidden" name="CatID" value="' . $itemID . '" />
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

function powerInsert(){

	$CatID			= strip_tags($_POST['CatID']);
	$AuthorID		= strip_tags($_POST['AuthorID']);
	$ItemName		= strip_tags($_POST['ItemName']);
	$ItemSum			= strip_tags($_POST['ItemSum']);
	$ItemDesc		= strip_tags($_POST['ItemDesc']);

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
		$sql = "INSERT INTO ma_CharItems (
				CatID, AuthorID, ItemName, ItemSum, ItemDesc
			)
			VALUES ( ?, ?, ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $CatID,				PDO::PARAM_STR);
	$stmt->bindValue(2, $AuthorID,		PDO::PARAM_STR);
	$stmt->bindValue(3, $ItemName,		PDO::PARAM_STR);
	$stmt->bindValue(4, $ItemSum,		PDO::PARAM_STR);
	$stmt->bindValue(5, $ItemDesc,		PDO::PARAM_STR);

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

function powerRevise(){

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

function powerTrash(){
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





#HELPER FUNCTIONS
#personalizeString($myDesc, $codename, $gender);
function strPersonalizer($str='', $codeName='', $gender=''){

	if ($codeName != ''){ $str = str_replace('XXXcNameXXX', $codeName, $str);
	}else{
		$str = str_replace('XcharnameX', 'your character', $str);
	}

	if ($gender == 'male'){ $str = str_replace('Xhim-her-themX', 'him', $str);}
	if ($gender == 'female'){ $str = str_replace('Xhim-her-themX', 'her', $str);}
	if ($str    != ''){ $str = str_replace('Xhim-her-themX', 'them', $str);}

	#clean up formatting used in arrays for display on other pages
	//$str = strip_tags($str, '<p>');
	//$str = strip_tags($str, '<strong>');

	return $str;
}

function formPersonalizer($codeName, $gender, $str=''){#creates form to personalize the descriptions

	$str='<h4><a href="#">Customize Descriptions</a></h4>
		<p>Enter characters name to personalize each &amp; every descriptions on this page to your character.</p>';

		#$str .= '<p>' . $codeName  . ' -- ' . $gender . '</p>';

			$str .='<form action="' . htmlspecialchars(THIS_PAGE) . '" method="get">
				<input type="text" name="codeName"
					value="' . $codeName . '" placeholder="Alias / Codename?"><br>

					<input type="radio" name="gender"';

					if ((isset($gender)) && ($gender=="female")){ $str .= "checked"; }

					$str .='value="female"> Female <input type="radio" name="gender"';

					if ((isset($gender)) && ($gender=="male")){ $str .= "checked"; }

					$str .='value="male"> Male

				<br /><br/>';


				$str .='<input type="hidden" name="CharID" value="0">
				<input type="submit" value="Submit">
			</form>
		<hr />';

	return $str;
}

function getURL() {
	$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
	$host     = $_SERVER['HTTP_HOST'];
	$script   = $_SERVER['SCRIPT_NAME'];
	$params   = $_SERVER['QUERY_STRING'];

	$currentUrl = $protocol . '://' . $host . $script . '?' . $params;

	return $currentUrl;
}
