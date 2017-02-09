<?php
function maxDoc_users_adminReviewUsers(){
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

require '../_inc/config_inc.php'; //provides configuration, et al.
//include INCLUDE_PATH . 'arrays-inc.php';

$uID 	 = $_SESSION['UserID'];
$uName = $_SESSION['UserName'];
$uPriv = $_SESSION['Privilege'];


$pageDeets = '<ol>
	<li> Updgrade dashboard sidebar with collapsible navs </li>
	<li> mod tabs - if something in tab needs action hightlight</li>
	<li> if post or character ready for review list in the side tab</li>

	<li> add classes</li>

	<!--
		<ul>
			<li> m2 - extended layout?</li>
			<li> m2 - notifications-mail</li>
			<li> m2 - character posting styles</li>
			<li> m2 - Classes/PDO</li>
			<li> M2 - unapprove/resubmit posts</li>
			<li> m2 - C2E (Click 2 Edit)</li>
			<li> m2 - chat box</li>
			<li> m2 - C2P (Chat to Joint-Post)</li>
			<li> m2 - C2M (Click to Move Thread/Post)</li>
			<li> ???</li>
		</ul>

		<ul>
			<li> m3 - MvC (CodeIngiter)</li>
			<li> M4 - MvC (Laravel)</li>
			<li> ???</li>
		</ul>
	-->';

//set access priv needed for this page by member
chekPrivies(1); //known guest (1+)

//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel


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

#notes to self
echo MaxNotes($pageDeets); #notes to me!

//BEGIN CONTENT AREA
?>

<div class="container-fluid">

<?php
	echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
	echo getSidebar($uName, $uID, $uPriv);// see custom-inc.php to edit
?>


	<div class="col-sm-9 col-md-10 main">
		<!--toggle sidebar button-->
		<p class="visible-xs">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
		</p>

		<!-- content to go here -->

		<div class="row placeholders">
			<h3 class="page-header">Member Review Cue</h3>
			

		<?php  //BEGIN Character Review Cue
			if($uPriv >= 4){

				//Lets get all the characters associated with the primary user (if any characters exist)
				$sql = " SELECT UserID, UserName, Privilege, LastUpdated FROM ma_Users WHERE Privilege = 1 ORDER BY LastUpdated;";

				// connection comes first in mysqli (improved) function
				$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

				if(mysqli_num_rows($result) > 0)
				{//records exist - process
					//outer formatting here

					echo '<h3 class="page-header">Member Review</h3>';

					while($row = mysqli_fetch_assoc($result))
					{// process each row
						$uID = $uName = $uStatus = $uLink = $uImg = '';

						$uID   			= dbOut($row['UserID']);
						$uName 			= dbOut($row['UserName']);
						$uPrivilege	= dbOut($row['Privilege']);

						$uLink    	= 'users/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=show';
						$uImg     	= 'http://www.mycustomer.com/sites/all/themes/pp/img/default-user.png';

						//create link
						echo '<div class="col-xs-6 col-sm-3 placeholder text-center">
							<a href="' . $uLink . '" title="' . $uName . '" >';

						//chek, did handler provide an image? exists, show
						if (file_exists($uImg)) { //if handler did, show us image
							echo '<img src="' . $uImg . '" class="center-block img-responsive img-circle" alt="' . $uName . '" style="height: 150px; width: 150px;"/></a>';
						} else {//no img matches, show random static pattern
							echo '<img src="' . $uImg . '" class="center-block img-responsive img-circle" style="width:150px; hieght: 150px;" alt="' . $uName . '" />';
						}

						//close up link
						echo '</a>
							<h5><a href="' . $uLink . '" title="' . $uName . '" >' . $uName . '</a></h5>
							<span class="text-muted">';

						if($uPriv >= 4){echo '<a href="">' . $aarPrivilege[$uPrivilege] . '</a> |';}

						echo ' <a href="">Approve?</a></span><br /><br /></div>'; //close character
					}
				}
				
				echo "<h3><em>Currently there are no members awaiting assistance.</em></h3>";
				//outer formatting here
//END  member que

				@mysqli_free_result($result);
			}
	?>

		</div><!--END Approval Cue -->
	<div class="clearfix"></div>
	<div class="push"></div>
</div><!--/.container-->


<?php
//END CONTENT AREA

get_footer(); //defaults to theme footer or footer_inc.php