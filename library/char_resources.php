<?php

#test URL: http://localhost/WrDKv3/library/powers.php?act=travel-resources&codeName=Ulli&charID=60&stageID=4&gender=male
function maxDoc_library_char_resources(){
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
get_header('headerJumbo-inc.php', 'bgResources00.jpg', 'Resources');

#echo MaxNotes($pageDeets); #notes to me!
/*
	'general','criminal','facility','government','location','municipal','online',
	'private','public','restricted','tool','utility','vehicle','weapon','other'
*/

#$baseSQL .= $cat == Descriptions!
$baseSQL = "SELECT ResourceID, ResourceName, ResourceSum, ResourceDesc, Available, LastUpdated FROM `ma_CharResources` WHERE CatID ";


#function genCategory($sql, $charID, $codeName, $gender, $stageID,  $str='' )
switch ($myAction){//check 'act' for type of process

	case 'criminal':
			#final setup of sql
			$cat  = 'criminal';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['criminal'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
		case 'general':
			#final setup of sql
			$cat  = 'general';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

		#dumpDie($sql);

			echo genOverview($myAction, $aarLibrary_resource['general'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

	 #($sql, $cat, $charID, $codeName, $gender, $stageID)
	 ##$sql, $charID, $codeName, $gender, $stageID, $sql='', $str=''

		break;

	########################################################
	case "facility":
			#final setup of sql
			$cat  = 'facility';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['facility'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "government":
			#final setup of sql
			$cat  = 'government';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['government'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "location":
			#final setup of sql
			$cat  = 'location';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['location'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;########################################################
	case "municipal":
			#final setup of sql
			$cat  = 'municipal';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['municipal'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "online":
			#final setup of sql
			$cat  = 'online';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['online'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "private":
			#final setup of sql
			$cat  = 'private';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['private'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "public":
			#final setup of sql
			$cat  = 'public';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['public'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "restricted":
			#final setup of sql
			$cat  = 'restricted';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['restricted'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "tool":
			#final setup of sql
			$cat  = 'tool';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['tool'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "utility":
			#final setup of sql
			$cat  = 'utility';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['utility'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;


	########################################################
	case "vehicle":
			#final setup of sql
			$cat  = 'vehicle';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['vehicle'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;

	########################################################
	case "weapon":
			#final setup of sql
			$cat  = 'weapon';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['weapon'], $codeName, $charID, $gender);
			echo genCategoryBtns($cat, $codeName);
			echo genCategory($sql, $cat, $charID, $codeName, $gender, $stageID);

		break;
	########################################################
	case "other":
			#final setup of sql
			$cat  = 'other';
			$sql  = $baseSQL . "= '$cat'; "; //for btns

			echo genOverview($myAction, $aarLibrary_resource['other'], $codeName, $charID, $gender);
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
		echo genOverview($myAction, $aarLibrary_aptitudes['overview'], $codeName, $gender, $charID);;#END default

} #END switch


get_footer('footerRecaptcha-inc.php');


function genOverview($myAction='', $mainContent='', $codeName, $charID, $gender, $str=''){ #format descriptions from array and

	#remove the dashes used for urls
	$mySubjectTitle = str_replace('-', ' ', $myAction);

	$str  .= '<div class="container-fluid">
			<div class="row content">

				<div class="col-sm-3 sidenav">
				<br />';



	#top sites banner / discord banner to vote for us
	$str .= MTS_stacked();


	//Let folks tweak descriptions to their characters
	$str .= formPersonalizer($codeName, $gender);


	#$str .= strPersonalizer();
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
				<h5><span class="label label-danger">Resources</span> <span class="label label-primary">Character Creation</span></h5><br>';

	$str .= customizeData($mainContent, $gender, $codeName, $stripTags='n');

	$str .= '<p>
				<em class="text-muted"><b>Note</b> - If you are logged in to ' . SITE_NAME . ', each entry shown below may already be personalized to reflect your character&quot;s codename and gender. If not, then they are shown in a generic format, but you can still set them to reflect your characters gender and codename by using the customizer located just above the catagory legend. Doing so will will instantly then format all the descriptions to your specifications to help you on your way to building an awesome addition to the  ' . SITE_NAME . ' universe.</em>
			</p>
			<hr />';

	return $str;
}

function genLegend($codeName='', $charID = 0, $str='' ){ #generate category legend and links from array
	#$CodeName, $CharID are fed to us via Sh
	if(isset($_GET['codeName'])){$codeName = ($_GET['codeName']); }
	if(isset($_GET['charID'])){$charID = ($_GET['charID']); }

	$charID = (int)$charID; #cast as int to be safe.

	#used to creat links in the legend -- some &ndash; and asci code used to format some letters specifically
	$myTitles = ['criminal', 'facility', 'general', 'government', 'location', 'municipal', 'online', 'private', 'public', 'restricted', 'tool', 'utility', 'vehicle', 'weapon', 'other'];

	$myLoadedQuery =['criminal', 'facility', 'general', 'government', 'location', 'municipal', 'online', 'private', 'public', 'restricted', 'tool', 'utility', 'vehicle', 'weapon', 'other'];

	$str .= '<h4><a href="' . THIS_PAGE . '">Aptitudes & Resources</a></h4>

		<ul class="nav nav-pills nav-stacked">';

	$count=0;

	foreach($myTitles as $title){
		$myLabel = str_replace("-", " ", $title);

		#if our switch matchs, highlight legend li
		$url  = $myLoadedQuery[$count];
		$chek = $_SERVER['REQUEST_URI']; #get url to test match too
		#clean url for first test
		$act = str_replace("/WrDK/traits/char_resources.php?act=","", $chek );

		#var_dump($codeName);
		#var_dump($charID);

		if($act == $url){
				$str .= '<li class="active">
					<a style="color: white;" href="'
						. VIRTUAL_PATH . 'library/char_resources.php?act='
						. $myLoadedQuery[$count++]
						. '&codeName=' . $_SESSION['codeName']
						. '&charID=' . $charID
						. '">'
						. ucwords($myLabel)
						. ' </a>
					</li>';

			#if title matches these, don't show unless admin or soemthing
			}else if($title == 'magic&ndash;&#76;ike' || $title == 'restricted'){

				$str .= '<li>
					<a class="" href="' . VIRTUAL_PATH . 'library/char_resources.php?'
						. '&codeName=' . $codeName
						. '&charID=' . $charID
						. '">'
						. ucwords($myLabel)
						. '<sup>*<sup> </a>
					</li>';

					[$count++];

			#show me unhighlighted all others
			}else{
				$str .= '<li>
					<a  href="' . VIRTUAL_PATH . 'library/char_resources.php?act='
						. $myLoadedQuery[$count++]
						. '&codeName=' . $codeName
						. '&charID=' . $charID
						. '">'
						. ucwords($myLabel)
						. ' </a>
					</li>';
			}
	}

	$str .= '</ul>';

	return $str;
}


#INCOMING -> #http://localhost/WrDKv3/library/resources.php?act=combat-resources&charID=60&codeName=Ulli&statusID=5
#genCategory('defensive', $CodeName, $CharID, $Gender='')

#http://localhost/WrDKv3/library/resources.php?act=combat-resources&codeName=Havok&charID=55&statusID=4


#http://localhost/WrDKv3/library/char_resources.php? act=alternate-sciences    &codeName=Ulli   &charID=0
#http://localhost/WrDKv3/library/char_resources.php? act=crime                 &codeName=Ulli   &charID=0
function genCategory($sql, $cat, $charID, $cName, $cGen, $stageID, $str='' ){ #generate cat descs...
	#act/myAction already set on line #115
	#$cat = $sql; //for btns



	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#BEGIN external formatting
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$resourceID   = (int)dbOut($row['ResourceID']);
			$resourceName = dbOut($row['ResourceName']);
			$resourceDesc = dbOut($row['ResourceDesc']);
			$resourceDesc = customizeData($resourceDesc, $cGen, $cName, $stripTags='x');
			$resourceLink = str_replace('', ' ', $resourceName);

			#uppercase everything up to first paren, then "small"
			#creat anchors - see: http://www.echoecho.com/htmllinks08.htm
			$str .= '<p><strong class="text-primary"><a name="' . $resourceLink . '">' . ucwords($resourceName) . '</a>: (#' . ucwords($resourceID) . ')</strong> <br />'
				. dbOut($row['ResourceDesc']) . '</p>';


			if(isset($stageID) && ($stageID >= 3)){$str .= '<a
				class="btn btn-info pull-left btn-xs"
				href="' . VIRTUAL_PATH . 'library/char_resources.php?act=addTrait&catID='
												. $cat	        #combat-resources - combat-resources
				. '&resourceID='   . $resourceID  		#1             - beserker	id num
				. '&resourceName=' . $resourceName    #name of trait - beserker
				. '&charID=' 		. $charID       #character id  - 60
				. '&codeName='  . $codeName     #codename      - Ully
				. '&stageID='   . $stageID			#3-6 = can add a power, else nope
				. '"
				title="Click to add ' . $resourceName . '  to ' . $codeName . '"><span class="glyphicon glyphicon-plus"></span> Add ' . strtoupper($resourceName) . ' power to ' . $codeName . '</a>';
			}


			#Edit trait
			#$_SESSION['Privilege'] >= 4
			if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] >= 4)){$str .= '<a class="btn btn-info pull-right btn-xs" href="' . VIRTUAL_PATH .'library/char_resources.php?act=edit&resourceName=' . $resourceName . '&CatID=' . $cat . '" title="Click to edit"><span class="glyphicon glyphicon-edit"></span></a>';
			}
			$str .= '<br /><hr />';
		}
	}else{//no records
			echo '<p>Currently No Mathcing Descriptions Available.</p><hr />';
	}

	@mysqli_free_result($result); //free resources



	if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] >= 4)){

		#$_SESSION['Privilege'] >= 6

		#add additional cheks
		#if is admin, suepr, owner, developer or is player show edit option.

		$str .= '<div align="center">
					<a class="btn btn-primary btn-sm" href="' . THIS_PAGE . '?act=add&cat=' . $cat .'"><i class="glyphicon glyphicon-pencil"></i> add Resource</a>
				</div>';
	}

	$str .= '<hr />';

	return ucfirst($str);
}

function genCategoryBtns($sql, $codeName='', $str='' ){ #generate cat descs...
	#act/myAction already set on line #115

	#if we have a codename
	if(empty($codeName)){$codeName='your character';}

	$sql = "SELECT ResourceName, Available FROM `ma_CharResources` WHERE CatID = '$sql'; ";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#BEGIN external formatting
		$str .= '<p>';
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$resourceName  = dbOut($row['ResourceName']);
			$resourceAvail = dbOut($row['Available']);

			$resourceLink  = str_replace ('-', ' ', $resourceName);

			#uppercase everything up to first paren, then "small"
			#creat anchors - see: http://www.echoecho.com/htmllinks08.htm
			$str .= '<small><a class="btn btn-primary btn-xs" href="#' . $resourceLink . '">' . ucwords($resourceName) . '</a></small>';
		}
		#END external formatting
		$str .= '</p><hr />';
	}

	@mysqli_free_result($result); //free resources

	return $str;
}
//Need to handle gender






function addTrait(){

	if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] > 2)){

		#dumpDie($_GET);

		#http://localhost/WrDKv3/library/resources.php?act=AddTrait&catID=combat&resourceName=beserker&charID=60&codeName=Ulli&statusID=6
		$exgPD = $addPN = $addPD = $finalPD='';

		#SEE: http://stackoverflow.com/questions/11839523/secure-against-sql-injection-pdo-mysqli
		#we are grabbing from url string instead of $_POST here....

		$cat      	= strip_tags($_GET['catID']);				#combat-resources - combat-resources
		$resourceID    = strip_tags($_GET['powID']);				#1             - power id for beserker power
		$resourceName	= strip_tags($_GET['resourceName']);			#name of trait - beserker
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
				$exgPD = dbOut($row['Aptitude']); #Existing Resource Description
				#echo '<p>' . $exgPD . '</p>';
			}
			#END OUTER HTML here
		}

		@mysqli_free_result($result); //free resources

		#dumpDie($exgPD);
		#get the power to concatinate together
		#get prior power description
		$sql = "SELECT `ResourceID`, `ResourceName`, `ResourceDesc` FROM ma_CharResources WHERE ResourceID = '$resourceID';";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results
			#BEGIN outer HTML here
			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$addPN .= dbOut($row['ResourceName']); #name for New Resource
				$addPD .= dbOut($row['ResourceDesc']); #name for New Resource Description
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

		$ResourceDesc = $finalPD;
		#dumpDie($ResourceDesc);

		$db = pdo(); # pdo() creates and returns a PDO object

		//build string for SQL insert with replacement vars, ?
		$sql = "UPDATE `ma_Characters` SET CharID='$charID', ResourceDesc='$resourceDesc' WHERE `CharID`='$charID'";


		#dumpDie($sql);
		$stmt = $db->prepare($sql);
		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
		//The Primary Key of the row that we want to update.
		$stmt = $db->prepare($sql);

		$stmt->bindValue(1, $charID, 		PDO::PARAM_STR);
		$stmt->bindValue(2, $ResourceDesc, 	PDO::PARAM_STR);

		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback($resourceName . " Resource Added Successfully To " . $codeName . "!","success");
		}else{//Problem!  Provide feedback!
			feedback($resourceName . " Resource WAS NOT ADDED to" . $codeName . "!","warning");
		}


		myRedirect(THIS_PAGE);
	}

} #END addTrait()

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


	echo '<h3 class="text-center">Add Resource to ' . ucwords($catName) . ' resource category</h3>

	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

		<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Resource Name: </strong></p>
			</div>
			<div class="col-sm-9">
				<input class="col-sm-9" type="text"  name="ResourceName" placeholder="The name of the resource">
			</div><!-- END Container -->
		</div>


		<div class="row hoverHighlight">
			<br /><br />
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Resource Summary: </strong></p>
			</div>
			<div class="col-sm-9">
				<textarea
					class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="A one sentence description of the resource"
					name="ResourceSum" ></textarea>
			</div><!-- END Container -->
		</div>


		<div class="row hoverHighlight">
			<br /><br />
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Resource Description: </strong></p>
			</div>
			<div class="col-sm-9">
				<textarea
					class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="The full description of the proposed resource with as much detail as possible."
					name="ResourceDesc" ></textarea>
			</div><!-- END Container -->

		</div>


		<input  type="hidden" name="CatID" value="' . $catName . '" />
		<input  type="hidden" name="AuthorID" value="' . $authorID . '" />
		<input  type="hidden" name="act" value="insert" />

		<br /><br />


		<div align="center">
			<input
				class="btn btn-primary btn-xs outline" type="submit" value="Add Resource">
			&nbsp; &nbsp;
				<a class="btn btn-primary btn-xs outline" href="resource.php">Exit Event</a>
		</div>

		<br />
	</form>
	';

}

#http://localhost/WrDKv3/resource.php?act=edit&powName=Mary-Sue-ism&CatID=restricted
function resourceEdit(){
	#If user is logged - allow edit else send back to resource
	if(startSession() && isset($_SESSION['UserID']))
	{

		$resourceName 		= ($_GET["powName"]);
		#dumpDie($resourceName);
#string 'Mary-Sue-ism' (length=12)

		# SQL statement - PREFIX is optional way to distinguish your app
		$sql = "SELECT

			ResourceID, CatID, AuthorID, ReviewerID,
			ResourceName, SKillSum, ResourceDesc, Available,
			NumReviews, LastUpdated, LastUpdated

			FROM ma_CharResources

			WHERE ResourceName = '$resourceName' ;";

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

				$resourceID		= dbOut($row['ResourceID']);
				$catID			= dbOut($row['CatID']);
				$authorID		= dbOut($row['AuthorID']);
				$resourceName	= dbOut($row['ResourceName']);
				$resourceSum		= dbOut($row['ResourceSum']);
				$resourceDesc	= dbOut($row['ResourceDesc']);

				$authorID		= $_SESSION['UserID'];


				echo '<h3 class="text-center">Edit ' . ucwords($resourceName) . ' resource entry</h3>

				<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Resource Name: </strong></p>
						</div>
						<div class="col-sm-9">
							<input class="col-sm-9" type="text" name="ResourceName" value="' . $resourceName . '">
						</div><!-- END Container -->
					</div>


					<div class="row hoverHighlight">
						<br /><br />
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Resource Summary: </strong></p>
						</div>
						<div class="col-sm-9">
							<textarea
								class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="A one sentence description of the resource"
								name="ResourceSum">' . $resourceSum . '</textarea>
						</div><!-- END Container -->
					</div>


					<div class="row hoverHighlight">
						<br /><br />
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Resource Description: </strong></p>
						</div>
						<div class="col-sm-9">
							<textarea
								class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="The full description of the proposed power with as much detail as possible."
								name="ResourceDesc" >' . $resourceDesc . '</textarea>
						</div><!-- END Container -->

					</div>


					<input  type="hidden" name="ResourceID" value="' . $resourceID . '" />
					<input  type="hidden" name="CatID" value="' . $resourceID . '" />
					<input  type="hidden" name="AuthorID" value="' . $authorID . '" />


					<input type="hidden" name="act" value="revise" />

					<br />


					<div align="center">
						<input class="btn btn-primary btn-xs outline"
							type="submit"
							value="Edit Resource!">

							&nbsp; &nbsp;

						<a class="btn btn-primary btn-xs outline"
							href="powers.php"
							title="Exit"
							">Exit Event</a>

							&nbsp; &nbsp;

						<a class="pull-right"
							href="#" title="Delete Resource">
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
	$ResourceName		= strip_tags($_POST['ResourceName']);
	$ResourceSum			= strip_tags($_POST['ResourceSum']);
	$ResourceDesc		= strip_tags($_POST['ResourceDesc']);

	$db = pdo(); # pdo() creates and returns a PDO object

	//build string for SQL insert with replacement vars, ?
	$sql = "INSERT INTO ma_CharResources (
			CatID, AuthorID, ResourceName, ResourceSum, ResourceDesc
		)
		VALUES ( ?, ?, ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $CatID,				PDO::PARAM_STR);
	$stmt->bindValue(2, $AuthorID,		PDO::PARAM_STR);
	$stmt->bindValue(3, $ResourceName,		PDO::PARAM_STR);
	$stmt->bindValue(4, $ResourceSum,		PDO::PARAM_STR);
	$stmt->bindValue(5, $ResourceDesc,		PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Resource Added Successfully To {$catName}!","success");
	}else{//Problem!  Provide feedback!
		feedback("Resource NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}

function powerRevise(){
	$ResourceName			 		= strip_tags($_POST['ResourceName']);				#int - primaryKey
	$ResourceSum			 		  = strip_tags($_POST['ResourceSum']); 					#int
	$ResourceDesc			 		= htmlspecialchars($_POST['ResourceDesc']); 			#str
	$ResourceID			 			= strip_tags($_POST['ResourceID']);
	$CatID			 			= strip_tags($_POST['CatID']);  			#str - entered by user
	$AuthorID			 		= strip_tags($_POST['AuthorID']);          #str of comma sep numbers

	$db = pdo(); # pdo() creates and returns a PDO object

	//build string for SQL insert with replacement vars, ?
	$sql = "UPDATE `ma_CharResources`
		SET
			ResourceName='$ResourceName',
			ResourceSum='$ResourceSum',
			ResourceDesc='$ResourceDesc',
			ResourceID='$ResourceID',
			CatID='$CatID',
			AuthorID='$AuthorID'

		WHERE `ResourceID`='$ResourceID'";


	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	//The Primary Key of the row that we want to update.
	$stmt = $db->prepare($sql);

	$stmt->bindValue(1, $ResourceName, 		PDO::PARAM_STR);
	$stmt->bindValue(2, $ResourceSum, 			PDO::PARAM_STR);
	$stmt->bindValue(3, $ResourceDesc, 		PDO::PARAM_STR);
	$stmt->bindValue(4, $ResourceID, 			PDO::PARAM_STR);
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
	$ResourceID			 	      = strip_tags($_GET['ResourceID']);				  #int - primaryKey
	#$ResourceID			 		  = strip_tags($_POST['ResourceID']); 					#int
	#$ResourceTitle			 	  = strip_tags($_POST['ResourceTitle']); 			#str
	#$ResourceDate			 		= strip_tags($_POST['ResourceDate']);  			#str - entered by user
	#$ResourceDescription	  = strip_tags($_POST['ResourceDescription']); #str
	#$CharTag			 			    = strip_tags($_POST['CharTag']);          #str of comma sep numbers

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_CharResource WHERE `ResourceID` = :ResourceID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':ResourceID', $TimelineID, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Resource Removed Successfully From Resources!","success");
	}else{//Problem!  Provide feedback!
		feedback("Resource Not Removed!","warning");
	}
	myRedirect(THIS_PAGE);
}
#script for expanding textarea

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
