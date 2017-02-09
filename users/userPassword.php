<?php
function maxDoc_users_userPassword(){
/**
 * based on userPrefs.php is based on dashboard.php & _test/edit.php
 * A session protected 'dashboard' page of links to handler/administrator tools
 *
 * Use this file to set user site prefs.
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

require '../_inc/config_inc.php'; //provides configuration, et al.

#declaried in users/validateUser.php
$uID 	  	= $_SESSION['UserID'];
$uName 		= $_SESSION['UserName'];
$uPriv  	= $_SESSION['Privilege'];
$uStart 	= $_SESSION['uStart']; #startpage
$twID  		= 1; #userStart textarea ID

$rSQL 		= "SELECT RTEID, AdminID, LastUpdated, RTEText FROM ma_RTE WHERE RTEID = $twID";

chekPrivies(2); //known guest or better (no unlogged visitors basically here)


//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel
$config->titleTag = 'Password Reset'; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->loadhead='
	<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.UserID,"Please Select a User.")){return false;}
				return true;//if all is passed, submit!
			}
	</script>';

//END CONFIG AREA ----------------------------------------------------------
#$access = "admin"; //admin or higher level can view this page
#include_once INCLUDE_PATH . 'admin_only_inc.php'; //session protected page - level is defined in $access var


$feedback = ""; //initialize feedback
if(isset($_GET['msg']))
{
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
	
	<h3 align="center">Reset <a href="' . VIRTUAL_PATH . 'users/dashboard.php"> Your </a> Password</h3>';


# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}





switch ($myAction)
{//check for type of process
	case "edit": //2) show password change form
		 editDisplay();
		 break;
	case "update": //3) change password, feedback to user
		updateExecute();
		break;
	default: //1)Select Administrator
		 selectAdmin();
}





























?>

				<div class="clearfix"></div>
				</div>
			</div>
		</div><!--/row-->
	<div class="push"></div>
</div><!--/.container-->


<?php

//END CONTENT AREA

get_footer(); //defaults to theme footer or footer_inc.php



//BEGIN page functions



function selectAdmin()
{//Select administrator
	global $config;

	if(isset($_SESSION["Privilege"]) && $_SESSION["Privilege"] == "admin")
	{#redirect if logged in only as admin
		myRedirect(THIS_PAGE . "?act=edit");
	}

	
	#get_header();
	
	if($_SESSION["Privilege"] != "admin")
	{# must be greater than admin level to have  choice of selection
		echo '<p align="center">Select a user, to reset their password:</p>';
	}
	
	echo '<form action="' . $config->userReset . '" method="post" onsubmit="return checkForm(this);">';
	$iConn = IDB::conn();
	$sql = "select UserID,UserName,LastName,Email,Privilege,LastLogin,NumLogins from " . PREFIX . "Users";
	
	if($_SESSION["Privilege"] == "admin")
	{# limit access to the individual, if admin level
		$sql .= " where UserID=" . $_SESSION["UserID"];
	}
	$result = @mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '
		<form action="' . $config->userReset . '" method="post" onsubmit="return checkForm(this);">
		<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">
			<tr>
				<th>UserID</th>
				<th>User</th>
				<th>Email</th>
				<th>Privilege</th>
			</tr>
		';
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 echo '
					 <tr>
					<td>
						<input type="radio" name="UserID" value="' . dbOut($row['UserID']) . '"> &nbsp; '
							. dbOut($row['UserID']) . '
					</td>
					<td>' . dbOut($row['UserName']) . ' ' . dbOut($row['LastName']) . '</td>
					<td>' . dbOut($row['Email']) . '</td>
						 <td>' . dbOut($row['Privilege']) . '</td>
					 </tr>
				 ';
		}
		echo '
			<input type="hidden" name="act" value="edit" />
			<tr>
				<td align="center" colspan="4">
					<input type="submit" value="Choose Admin!" />
				</td>
			</tr>
		</table>
		</form>
		';
	}else{//no records
			//put links on page to reset form, exit
			echo '<div align="center"><h3>Currently No Administrators in Database.</h3></div>';
	}

	@mysqli_free_result($result); //free resources
	get_footer();
}

function editDisplay()
{
	global $config;
	if($_SESSION["Privilege"] == "admin")
	{#use session data if logged in as admin only
		$myID = (int)$_SESSION['UserID'];
	}else{
		if(isset($_POST['UserID']) && (int)$_POST['UserID'] > 0)
		{
			 $myID = (int)$_POST['UserID']; #Convert to integer, will equate to zero if fails
		}else{
			feedback("UserID not numeric","error");
			myRedirect($config->adminReset);
		}
	}
	$config->loadhead = '
	<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(!isAlphanumeric(thisForm.PWord1,"Only alphanumeric characters are allowed for passwords.")){thisForm.PWord2.value="";return false;}
				if(!correctLength(thisForm.PWord1,6,20,"Password does not meet the following requirements:")){thisForm.PWord2.value="";return false;}
				if(thisForm.PWord1.value != thisForm.PWord2.value)
				{//match password fields
					 alert("Password fields do not match.");
					 thisForm.PWord1.value = "";
					 thisForm.PWord2.value = "";
					 thisForm.PWord1.focus();
					 return false;
				 }
				return true;//if all is passed, submit!
			}
	</script>
	';
	#get_header();
	$iConn = IDB::conn();
	$sql = sprintf("select UserID,UserName,LastName,Email,Privilege from " . PREFIX . "Users WHERE UserID=%d",$myID);
	$result = @mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 $Name = dbOut($row['UserName']) . ' ' . dbOut($row['LastName']);
				 $Email = dbOut($row['Email']);
				 $Privilege = dbOut($row['Privilege']);
		}
	}else{//no records
			//put links on page to reset form, exit
			echo '
				<div align="center"><h3>No such administrator.</h3></div>
				<div align="center"><a href="' . $config->userDashboard . '">Exit To Admin</a></div>
				';
	}
	echo '
	<h3 align="center">Reset Administrator Password</h3>
	<p align="center">
		Admin: <font color="red"><b>' . $Name . '</b></font>
		Email: <font color="red"><b>' . $Email . '</b></font>
		Privilege: <font color="red"><b>' . $Privilege . '</b></font>
	</p>
	<p align="center">Be sure to write down password!!</p>
	<form action="' . $config->userReset . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr>
				 <td align="right">Password</td>
				 <td>
					 <input type="password" name="PWord1" />
					 <font color="red"><b>*</b></font> <em>(6-20 alphanumeric chars)</em>
				 </td>
		 </tr>
		 <tr>
				 <td align="right">Re-enter Password</td>
				 <td>
					 <input type="password" name="PWord2" />
					 <font color="red"><b>*</b></font>
				 </td>
		 </tr>
		 <tr>
				 <td align="center" colspan="2">
					 <input type="hidden" name="UserID" value="' .$myID . '" />
					 <input type="hidden" name="act" value="update" />
					 <input type="submit" value="Reset Password!" />
					 <em>(<font color="red"><b>*</b> required field</font>)</em>
				 </td>
			 </tr>
	</table>
	</form>
	<div align="center"><a href="' . $config->userDashboard . '">Exit To Admin</a></div>
	';
	@mysqli_free_result($result); #free resources
	#get_footer();
}

function updateExecute()
{
	global $config;
	if(isset($_POST['UserID']) && (int)$_POST['UserID'] > 0)
	{
		 $myID = (int)$_POST['UserID']; #Convert to integer, will equate to zero if fails
	}else{
		feedback("UserID not numeric","warning");
		myRedirect($config->userReset);
	}

	if(!onlyAlphaNum($_POST['PWord1']))
	{//data must be alphanumeric or punctuation only
		feedback("Data entered for password must be alphanumeric only");
		myRedirect(THIS_PAGE);
	}
	$iConn = IDB::conn();
	$redirect = $config->userReset; # global var used for following iformReq redirection on failure
	$UserID = iformReq('UserID',$iConn);  # calls dbIn internally, to check form data
	$UserPW = iformReq('PWord1',$iConn);

	 # SHA() is the MySQL function that encrypts the password
	$sql = sprintf("UPDATE " . PREFIX . "Users set UserPW=SHA('%s') WHERE UserID=%d",$UserPW,$UserID);

	@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));

	 //feedback success or failure of insert
	 if (mysqli_affected_rows($iConn) > 0)
	 {
		 feedback("Password Successfully Reset!","notice");
		}else{
		 feedback("Password NOT Reset! (or not changed from original value)");
	 }
	get_header();
	echo '
	<div align="center"><h3>Reset User Password</h3></div>
	<div align="center"><a href="' . $config->userReset . '">Reset More</a></div>
	<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>
	';
	#get_footer();
}


