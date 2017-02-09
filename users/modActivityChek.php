<?php
function maxDoc_users_modActivityChek(){
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
chekPrivies(3); //known mod (4+)

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
#echo MaxNotes($pageDeets); #notes to me!

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

		<?php  //BEGIN Character Review Cue
			if($uPriv >= 4){


//BEGIN character review que
			$sql = " SELECT UserID, CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Playby, Gender, Playby, LastUpdated FROM ma_Characters
			WHERE UserID > 0
			GROUP BY StatusID
			ORDER BY UserID
			DESC;";


			// connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

			if(mysqli_num_rows($result) > 0){//records exist - process
				//outer formatting

				echo '<div class="clearfix"></div>
				<h3 class="page-header">Activity Check (Characters)</h3>';

				while($row = mysqli_fetch_assoc($result))
				{// process each row
					#strings
					$cName = $cPlayby = $cGender =
					#ints
					$uID = $cID = $cStatus = $cDefault = $cLink = $cImg = $pbImg = $statusBorder = '';


					$uID   		= dbOut($row['UserID']);

					$cID   		= dbOut($row['CharID']);
					$cName 		= dbOut($row['CodeName']);
					$cStatus	= dbOut($row['StatusID']);
					$cPlayby  = dbOut($row['Playby']);
					$cGender  = dbOut($row['Gender']);

					if($cGender == ''){$cGender = 'male';}

					$cLink    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=show';
					$cEdit    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=edit';
					$cImg     = '../uploads/' . $cID . '-1.jpg';

					$cbDir     = strtolower(str_replace(' ', '_', $cPlayby));
					$cbLnk    = '../uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-001.jpg';
					$sImg     = './../_img/_static/static---000.gif';


					if($cStatus == 1){$statusBorder = 'border: solid 5px #c2ce3f;';}
					if($cStatus == 2){$statusBorder = 'border: solid 5px #13a2e6;';}
					if($cStatus == 3){$statusBorder = 'border: solid 5px #2e91de;';}
					if($cStatus == 4){$statusBorder = 'border: solid 5px #2e91de;';}
					if($cStatus == 5){$statusBorder = 'border: solid 5px #4657b0;';}
					if($cStatus == 6){$statusBorder = 'border: solid 5px #9633ab;';}
					if($cStatus == 7){$statusBorder = 'border: solid 5px #da2a63;';}
					if($cStatus == 8){$statusBorder = 'border: solid 5px #e24b43;';}
					if($cStatus == 9){$statusBorder = 'border: solid 5px #e5902f;';}
					if($cStatus == 10) {$statusBorder = 'border: solid 5px #88b142;';}



					//create link
					echo '<div class="col-xs-6 col-sm-3 placeholder text-center"><a href="' . $cLink . '"  target="_blank" title="' . $cName . '" >';

					//if we ahve an image use it, else show proxy or default)
					if (file_exists($cImg)) {  //if handler did, show us image
						//set image path
						$imgPath = $cImg;

					//Proxy image
					} elseif(file_exists($cbLnk)) { //if we can match playby, map to playby as proxy
						//set image path
						$imgPath = $cbLnk;

					//default image
					} else { //show default
						//set to static
						$imgPath = $sImg;
					}

					//close up link
					echo '<img src="'
						. $imgPath . '" class="center-block img-responsive img-circle" alt="'
						. $cName . '" style="height:150px; width:150px; '
						. $statusBorder . '"/></a><h5><a href="'
						. $cLink . '" title="'
						. $cName . '" target="_blank">'
						. $cName . '</a></h5><span class="text-muted">

						<a href="'
						. $uID . '" target="_blank" title="'
						. $uID . '">'
						. $uID . '</a>

						<br /> '
						. $aarStatus[$cStatus] . ' | <a href="'
						. $cEdit . '" target="_blank" title="'
						. $cName . '">Edit</a> '
						. $cStatus . ' </span>
						<br /><br /></div>'; //close character
				}

			}else{//no records
					echo "<p>Currently there are no characters in the cue.</p>";
			} //END PROFILES SEARCH
			//outer formatting here
//END  user character que
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
