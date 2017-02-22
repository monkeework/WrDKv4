<?php
function maxDoc_users_modCreateChars(){
/**
 * based on dashboard.php is based on admin.php
 * A session protected 'dashboard' page of links to handler/administrator tools
 *
 * Use this file as a landing page after successfully logging in as an administrator.
 * Be sure this page is not publicly accessible by referencing admin_only_inc.php
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see $config->userLogin.php
 * @see $config->adminValidate.php
 * @see $config->adminLogout.php
 * @see admin_only_inc.php
 * @todo Get Image Border to show around submitted characters in my characters portion of dashboard.
 */
}

//used to determine A-Z + 0-9
$userPage = pathinfo(__FILE__)['filename'];

require '../_inc/config_inc.php'; //provides configuration, et al.
//include INCLUDE_PATH . 'arrays-inc.php';

$uID 	 = $_SESSION['UserID'];
$uName = $_SESSION['UserName'];
$uPriv = $_SESSION['Privilege'];

//set access priv needed for this page by member
chekPrivies(4); //known guest (1+)

//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel

global $config;

//END CONFIG AREA ----------------------------------------------------------
#$access = "admin"; //admin or higher level can view this page
#include_once INCLUDE_PATH . 'admin_only_inc.php'; //session protected page - level is defined in $access var

$feedback = ""; //initialize feedback
if(isset($_GET['msg'])){
	switch($_GET['msg'])
	{
			case 1:
				 $feedback = "Your permissions don't allow access to that page.";
				 break;
		default:
				 $feedback = "";
	}
}

if($feedback != ""){$feedback = '<div align="center"><h4><font color="red">' . $feedback . '</font></h4></div>';} //Fill out feedback HTML

get_header('testBoard'); //defaults to theme header or header_inc.php

//BEGIN CONTENT AREA

echo '<div class="container-fluid">';

echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
echo getSidebar($uName, $uID, $uPriv);// see custom-inc.php to edit

echo '<div class="col-sm-9 col-md-10 main">
	<!--toggle sidebar button-->
	<p class="visible-xs">
		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
	</p>

<!-- content to go here -->
<div class="row placeholders">';

//BEGIN Character Create
if($uPriv >= 4){
# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

#if myAction is a letter, this handles errors should there be no letter/lets us feed it in
#$letter = (isset($_GET['act']) ? $letter = isset($_GET['act']) : false); // returns true

switch ($myAction){//check 'act' for type of process
/**
 * Show all characters based on the first letter of their codename
 * @param  act=letter/number
 * @return string
 **/
	case 'A':
	case 'B':
	case 'C':
	case 'D':
	case 'E':
	case 'F':
	case 'G':
	case 'H':
	case 'I':
	case 'J':
	case 'K':
	case 'L':
	case 'M':
	case 'O':
	case 'P':
	case 'Q':
	case 'R':
	case 'S':
	case 'T':
	case 'U':
	case 'V':
	case 'W':
	case 'X':
	case 'Y':
	case 'Z':
	case '0-9':
		 showCharByFirstLetter($uPriv, $myAction );
		 break;

	case "add": //2) Form for adding new customer data
		 addChar();
		 break;

	case "insert": //3) Insert new customer data
		insertChar();
		 showChar($uPriv);
		break;

	case "update": //3) Insert new customer data
		showChar($uPriv, 'update');
		break;

	case "status": //3) Insert new customer data
		showChar($uPriv, 'status');
		break;

	case "handler": //3) Insert new customer data
		showChar($uPriv, 'handler');
		break;

	case "codename": //3) Insert new customer data
		showChar($uPriv, 'codename');
		break;

	case "search": //3) Insert new customer data;
		showChar($uPriv, 'search');
		break;

/*
	case "type": //3) Insert new customer data
		showChar('type');
		break;

	case "mutant": //3) Insert new customer data
		showChar('mutant');
		break;

	case "inhuman": //3) Insert new customer data
		showChar('inhuman');
		break;

	case "tech": //3) Insert new customer data
		showChar('tech');
		break;

	case "alien": //3) Insert new customer data
		showChar('alien');
		break;
*/

	default: //1)Show existing customers
		 showChar($uPriv);
	}
}


echo '</div><!--END Approval Cue -->
	<div class="clearfix"></div>
	<div class="push"></div>
</div><!--/.container-->';

//END CONTENT AREA


function showSearch($str = ''){

	if(isset($_POST['CodeName'])){
		$mySearchTerm = $_POST['CodeName'];
	}else{
		$mySearchTerm = '';
	}

	$str = '<form method="post" action="' . $mySearchTerm . '?act=search"  id="searchform">
		<div class="input-group">
				<input
					type="text"
					class="form-control"

					name="CodeName"
					value="'. $mySearchTerm .'"

					placeholder="Enter a codename here">

				<span class="input-group-btn">
					<button
						class="btn btn-default"
						type="text">Search!</button>
				</span>
		</div><!-- /input-group -->
		</form>';

	return $str;

}

function showChar($uPriv, $firstSort='', $secondSort='', $cStage=''){//Select Character

	#select type of search result....
	echo show_typeDD();

	echo ' <div class="col-sm-9 pull-right col-xs-12 ">
			' . showSearch() . '
		</div><!-- /.col-sm-6 -->

	</div><!-- /.row -->

	<div class="clearfix"></div>

	<br />

	<div>
		<p class="text-justify">';

		$result ='';
		foreach (range('A', 'Z') as $letter) {
			$result .= ' <a href="' . VIRTUAL_PATH . '/users/modCreateChars.php?act=' . $letter . '" title="See all characters  beginning with ' . $letter . '"/>' . $letter . '</a> <span class="text-mute">|</span>';
		}

		#remove last leading pipe from array
		echo $result . '  <a href="' . VIRTUAL_PATH . '/users/modCreateChars.php?act=num" title="See all characters beginning with a number"/> 0-9 </a></p>
	</div><!-- /.col-sm-6 -->


	<br /><br />';




// Set sort paremeters
// Set sort paremeters
// Set sort paremeters

switch ($firstSort) {
	case 'update':
			$firstSort  = ' ';
			$secondSort = ' ORDER by LastUpdated DESC';
			break;

		case 'status':
			$firstSort  = ' ';
			$secondSort = ' ORDER by StatusID DESC';
			break;

	case 'search':
			$firstSort  = ' ';
			$secondSort = ' WHERE CodeName = "' . $_POST['CodeName'] . '"';
			$search = $_POST['CodeName'];
			break;

	case 'handler':
			$firstSort  = ' ORDER by UserID DESC';
			$secondSort = ' ORDER by UserID DESC';
			break;

	case 'codename':
			$firstSort  = ' ';
			$secondSort = ' ORDER by CodeName';
			break;


	default:
			$firstSort  = ' ';
			$secondSort = ' ';
}

// Set sort paremeters
// Set sort paremeters
// Set sort paremeters




$sql = "SELECT UserID, UserName, Email FROM ma_Users $firstSort";
$arrHandlers = []; #creat array to hold handler names and IDs

$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysqli_fetch_assoc($result))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		$arrHandlers[$row['UserID']] = dbOut($row['UserName']);
		#$arrHandlers[$row['UserID']] = dbOut($row['UserName']);
	}
}

@mysqli_free_result($result); //free resources

	#lets get all the characters....
	$sql = "SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName, StatusID, LastUpdated FROM ma_Characters $secondSort";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<form method="post" action="' . THIS_PAGE . '">
			<table class="table table-striped" >';

			echo '<tr>
				<th>Codename</th>
				<th>Real Name</th>
				<th>Handler</th>
				<th>Status</th>
			</tr>';

			#lets make our checkie boxes...

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

				#show characters to select for deletion...
				$cName ='';
				#get character name...
				if(trim(dbOut($row['CodeName'])) != ''){ #codename if set
					$cName = dbOut($row['CodeName']);
					$cID   = (int)$row['CharID'];

					#Real name shows in parens if exists
					$rName        = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
					#name displayed to user
					$displayName  = $cName . " <small>({$cID})</small>";

					if($rName != ' '){
						$displayName .= ' <small class="text-muted">(' . $rName . ')</small>';
						#var_dump($cName);
					}
				}else{	#use first/last name
					$cName = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
				}

				$uID    = (int)dbOut($row['UserID']);
				$myTest = $uID;
				$myTest = (int)$myTest;
				#$myTest = $myTest - 1;

				if($myTest == -1){ $myTest = NULL;}
				if($myTest){ #codename if set

				include './../_inc/arrays-inc.php';
				$cStage = $aarStatusTest[dbOut($row['StatusID'])];

				if($cStage === 'Character Status Not Set'){$cStage='';}

				#Muted, Primary, Success, Info, Warning, Danger.
				$myHandler = $arrHandlers[$myTest];

				$myHandler = str_replace_first('The ', '', $myHandler);

				if ($uPriv >= 3){ $myHandler = '<b>' . $myHandler . '</b>';}





			}else{	#use first/last name
				$myHandler = '';
			}

			$myCharID = (int)$row['CharID']; #get character id

			echo '<tr>
					<td><a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cName . '&id=' . $myCharID . '&act=show" target="_blank">' . $displayName . '</a></td>

					<td><a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cName . '&id=' . $myCharID . '&act=show" target="_blank">' . $rName . '</a></td>
					<td>' . $myHandler . '</td>
					<td>' . $cStage . '</td>
				</tr>';
			}
		echo '</table>
		</form>';

	}else{//no records
		echo '<div align="center"><h3>Currently No Characters in Database.</h3></div>';
	}
	#echo '<div class="pull-left"><a href="' . THIS_PAGE . '?act=delete">DELETE CHARACTERS</a></div>';
	@mysqli_free_result($result); //free resources
}






function showCharByFirstLetter($uPriv, $act='', $firstSort='', $secondSort='', $cStage=''){//Select Character
	#show sorting menu
	echo show_typeDD();


	#search bar for whatever
	# @TODO - Set up search bar
	echo '<div class="col-sm-9 pull-right col-xs-12 ">
			' . showSearch() . '
		</div><!-- /.col-sm-6 -->
	</div><!-- /.row -->
		<div class="clearfix"></div>
	<br />';

	#make aplha numeric cast of a-z 1-10 numeric search band
	echo mk_alphaNumericSearchBar();


	#get user names, id's et al necessary to connect to handlers if needed
	$sql = "SELECT UserID, UserName, Email FROM ma_Users";
	$arrHandlers = []; #creat array to hold handler names and IDs

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$arrHandlers[$row['UserID']] = dbOut($row['UserName']);
			#$arrHandlers[$row['UserID']] = dbOut($row['UserName']);
		}
	}
	@mysqli_free_result($result); //free resources
	 #END Handler query

	#BEGIN character query based on first alphanumeric character of codename
	#sql for search of a character by first letter of codename or a number
	$sql  = "SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName, StatusID, LastUpdated FROM ma_Characters WHERE LEFT (CodeName, 1) = '{$act}' ;";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<form method="post" action="' . THIS_PAGE . '">
			<table class="table table-striped" >';

			echo '<tr>
				<th>Codename</th>
				<th>Real Name</th>
				<th>Handler</th>
				<th>Status</th>
			</tr>';

			#lets make our checkie boxes...

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

				#show characters to select for deletion...
				$cName ='';
				#get character name...
				if(trim(dbOut($row['CodeName'])) != ''){ #codename if set
					$cName = dbOut($row['CodeName']);
					$cID   = (int)$row['CharID'];

					#Real name shows in parens if exists
					$rName        = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
					#name displayed to user
					$displayName  = $cName . " <small>({$cID})</small>";

					if($rName != ' '){
						$displayName .= ' <small class="text-muted">(' . $rName . ')</small>';
						#var_dump($cName);
					}
				}else{	#use first/last name
					$cName = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
				}

				$uID    = (int)dbOut($row['UserID']);
				$myTest = $uID;
				$myTest = (int)$myTest;
				#$myTest = $myTest - 1;

				if($myTest == -1){ $myTest = NULL;}
				if($myTest){ #codename if set

				include './../_inc/arrays-inc.php';
				$cStage = $aarStatusTest[dbOut($row['StatusID'])];

				if($cStage === 'Character Status Not Set'){$cStage='';}

				#Muted, Primary, Success, Info, Warning, Danger.
				$myHandler = $arrHandlers[$myTest];

				$myHandler = str_replace_first('The ', '', $myHandler);

				if ($uPriv >= 3){ $myHandler = '<b>' . $myHandler . '</b>';}

			}else{	#use first/last name
				$myHandler = '';
			}

			$myCharID = (int)$row['CharID']; #get character id

			echo '<tr>
					<td><a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cName . '&id=' . $myCharID . '&act=show" target="_blank">' . $displayName . '</a></td>

					<td><a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cName . '&id=' . $myCharID . '&act=show" target="_blank">' . $rName . '</a></td>
					<td>' . $myHandler . '</td>
					<td>' . $cStage . '</td>
				</tr>';
			}
		echo '</table>
		</form>';

	}else{//no records
		echo '<p>Currently we have no characters filed under <i>' . $act . '</i></p>';
	}
	#echo '<div class="pull-left"><a href="' . THIS_PAGE . '?act=delete">DELETE CHARACTERS</a></div>';
	@mysqli_free_result($result); //free resources
}

function addChar(){# shows details from a single customer, and preloads their first name in a form.
    /*
     * to make $config->loadhead .= work, we need boostrap functions maybe?
     */
	#$config->loadhead .= '
    echo '
	<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.CodeName,"Please Enter Character\'s Code Name")){return false;}
			if(empty(thisForm.FirstName,"Please Enter Character\'s First Name")){return false;}
			if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>';

	#get_header();
	echo '<h3 align="center">Add Character</h3>

	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr><td align="right">Code Name</td>
			 <td>
				 <input type="text" name="CodeName" />
				 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
			 </td>
		</tr>
		<tr><td align="right">First Name</td>
			 <td>
				 <input type="text" name="FirstName" />
				 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
			 </td>
		 </tr>
		 <tr><td align="right">Last Name</td>
			 <td>
				 <input type="text" name="LastName" />
				 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
			 </td>
		 </tr>
		 <input type="hidden" name="act" value="insert" />
		 <tr>
			 <td align="center" colspan="2">
				 <input type="submit" value="Add Character!"><em>(<font color="red"><b>*</b> required field</font>)</em>
			 </td>
		 </tr>
	</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Add</a></div>
	';

}

function insertChar(){

	#	$sql = "SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName FROM ma_Characters;";

	$CodeName = $_POST['CodeName'];
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];

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
		$sql = "INSERT INTO ma_Characters (CodeName, FirstName, LastName) VALUES (?,?,?)";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $CodeName, PDO::PARAM_STR);
	$stmt->bindValue(2, $FirstName, PDO::PARAM_STR);
	$stmt->bindValue(3, $LastName, PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Character Added Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Character NOT added!","warning");
	}

}


#############################################################
#####      HELPER FUNCTIONS FOR modCreateChars Page      ####
#############################################################

#trim off upto first occurance of a substring within a string
function str_replace_first($search, $replace, $subject) {
		$pos = strpos($subject, $search);
		if ($pos !== false) {
				return substr_replace($subject, $replace, $pos, strlen($search));
		}
		return $subject;
}


# search options for the modCreateChar page
function show_typeDD(){
	$str ='	<div class="row">

	<div class="col-sm-3 col-xs-12">
		<div class="dropdown">
			<button class="btn btn-default btn-sm dropdown-toggle " type="button"
				data-toggle="dropdown">Sort/Add Characters<span class="caret"></span></button>
				<ul class="dropdown-menu">

					<li><a href="' . THIS_PAGE . '?act=add" class="btn btn-sm" style="color: orange"><b>Add Character</b></a></li>

					<li><a href="' . THIS_PAGE . '?act=status"		class="btn btn-sm">By Status*</a></li>
					<li><a href="' . THIS_PAGE . '?act=handler" 	class="btn btn-sm">By Handler</a></li>
					<li><a href="' . THIS_PAGE . '?act=codename" 	class="btn btn-sm">By Codename</a></li>

					<li><a href="' . THIS_PAGE . '?act=updated" 	class="btn btn-sm">By Last Updated</a></li>

<!--
<li><a href="' . THIS_PAGE . '?act=type"			class="btn btn-sm">By Type</a></li>
<li><a href="' . THIS_PAGE . '?act=mutant"		class="btn btn-sm">By Mutants</a></li>
<li><a href="' . THIS_PAGE . '?act=inhuman"		class="btn btn-sm">By Inhumans</a></li>
<li><a href="' . THIS_PAGE . '?act=tech"			class="btn btn-sm">By Hi-Tech Wonders</a></li>
<li><a href="' . THIS_PAGE . '?act=alien"			class="btn btn-sm">By Aliens</a></li>

<li><a href="' . THIS_PAGE . '?act=marySue"		class="btn btn-sm">Types 2 Come</a></li>

<li><a href="' . THIS_PAGE . '?act=marySue" class="btn btn-sm">Type 2 Come</a></li>
<li><a href="' . THIS_PAGE . '?act=marySue" class="btn btn-sm">Type 2 Come</a></li>
<li><a href="' . THIS_PAGE . '?act=marySue" class="btn btn-sm">Type 2 Come</a></li>
-->
			</ul>
		</div>
	</div><!-- /.col-sxs-3   col-xs-12-->';

	return $str;
}


#make alphaNumeric search band
function mk_alphaNumericSearchBar($result =''){
$str = '	<div>
	<p class="text-justify">';

	$result ='';
	foreach (range('A', 'Z') as $letter) {
		$result .= ' <a href="' . VIRTUAL_PATH . '/users/modCreateChars.php?act=' . $letter . '" title="See all characters  beginning with ' . $letter . '"/>' . $letter . '</a> <span class="text-mute">|</span>';
	}

	#remove last leading pipe from array
	echo $result . '  <a href="' . VIRTUAL_PATH . '/users/modCreateChars.php?act=num" title="See all characters beginning with a number"/> 0-9 </a></p>
</div><!-- /.col-sm-6 -->

<br /><br />';

return $str;
}


get_footer(); //defaults to theme footer or footer_inc.php
