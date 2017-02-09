<?php
function maxDoc_users_userPrefs(){
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

	<h3> Welcome <a href="' . VIRTUAL_PATH . 'users/dashboard.php">' . $uName . '</a> to your start page</h3>
	';

//SHOW editable content area

if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}


















































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




