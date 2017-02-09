<?php
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
include INCLUDE_PATH . 'aarContent-inc.php';

function maxDoc_characters_index(){
/**
 * index.php (list.php) character portal entry point
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seeview.php
 * @todo tooltips
 *
 * @todo Customize profiles show based on user
	 - show their characters
	 - show their character allies
	 - show most recently approved
 * @todo Add - sorry no results found for case statements
 * @todo ADD PAGER too playbys option
 *
 */

	# '../' works for a sub-folder.  use './' for the root
}

$pageDeets = '<ol>
	<li> Resolve chat box overlap issue</li>
	<li> Review/update function checkForm(thisForm)</li>

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



# SQL statement
$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters ORDER BY RAND() LIMIT 12;";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php
$config->titleTag = SITE_NAME . 'Character&nbsp;Profiles | ' . SITE_NAME;

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = SITE_NAME . ' Character Database ' . $config->metaDescription;
$config->metaKeywords = 'Super-Heroes, Superheroes, Marvel, Comics, Characters, Roleplay, RP, RPG'. $config->metaKeywords;
$config->loadhead = '<link rel="stylesheet" type="text/css" href="./../_css/maxStrap.css">'; #load page specific JS


# END CONFIG AREA ----------------------------------------------------------

get_header(); #defaults to theme header or header_inc.php

#echo MaxNotes($pageDeets); #notes to me!

#generate a new token for the $_SESSION superglobal and put them in a hidden field
$newToken = genFormToken('form01-Search');

if(isset($_GET['act'])){ $act = ($_GET['act']); }else{ $act = ''; } #initialize $act for switch





switch ($act) {
	case 'ShowAvailable':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID BETWEEN 0 AND 2
				ORDER BY CodeName ASC;";

			showTest($sql, 'Available', $minNum=-0, $maxNum=2); #characters locked prevent meddling
		break;

	################ SHOW BANNED ################
	case 'ShowBanned':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID = 16
				ORDER BY CodeName ASC;";

				showTest($sql, 'banned', $minNum=16, $maxNum=16);
			break;

	############## SHOW PLAYBYS ###############
	case 'ShowPlayby':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Playby, Gender
				FROM ma_Characters ORDER BY Playby ASC;";

			echo '<div class="row">
					<h1 class="text-center"> Current Castings (Playbys)</h1>
				</div>
				<div class="row">
				<div class="col-sm-6">
					<h3>Female</h3>';
					#process results - show female playbys
					showCurrentPlaybys($sql, 'female');

				echo '</div>
				<div class="col-sm-6">
					<h3>Male</h3>';
					#process results - show male playbys
					showCurrentPlaybys($sql, 'male');

				echo '</div>
			</div>'; #END playbys

			break; #END showPlayby

	################ SHOW GROUP PLOTTERS ################
	case 'ShowPlotter':
			echo '<h1>show group plotters - see profiles for individiual character plotters</h1>';
			break;

	############## SHOW TEAMS ###############
	case 'ShowTeams':
		$sql = "SELECT  c.CodeName, c.FirstName, c.LastName, c.MiddleName, c.CharID, c.StatusID, #selected from ma_Characters
			g.TeamName  #selected from ma_Groups

			FROM ma_Characters AS c

			LEFT JOIN ma_Characters_Groups AS cg
			ON c.CharID = cg.CharID

			LEFT JOIN ma_Groups AS g
			ON cg.GroupID = g.TeamID

			WHERE g.TeamName IS NOT NULL

			ORDER BY g.TeamName ASC ;
			";

			showTeams($sql, 'null', 'teamed together');

			break;

	############### SHOW TAKEN #################
	case 'ShowTaken':
		$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID
			FROM ma_Characters
			WHERE StatusID BETWEEN 2 AND 13
			ORDER BY CodeName ASC;";

			showTest($sql, 'taken', $minNum=2, $maxNum=13); #characters locked prevent meddling

		break;

	############## SHOW MEMBERS ###############

	case 'ShowMembers':

		//set access priv needed for this page by member
		chekPrivies(1); #members+

		echo '<h3>Current Active Members</h3>';

		$sql = "SELECT UserID, UserName, Email, Privilege, LastLogin FROM ma_Users ORDER BY UserName ASC;";
		# connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

			if(mysqli_num_rows($result) > 0)
			{#records exist - process

				echo '<div align="center" style="margin: 5px;" >'; #start images container
				while($row = mysqli_fetch_assoc($result))
				{# process each row

					$uName = dbOut($row['UserName']);

					#creat image link to character
					echo '<a href="' . VIRTUAL_PATH . 'users/member.php?CodeName=' .
						#strip white spaces out of code name for url
						str_replace(' ', '-', $uName) . '&id=' . (int)$row['UserID'] . '&act=members">

						<div class="divThumbs">';

						#create image path to check...
						$filename = '../uploads/c' . dbOut($row['UserID']) . '_thumb.jpg';

						$imgPath = '<img src="' . $filename . '" />';

						#if image exists, show
						if (file_exists($filename)) {
							echo '<img class="imgThumbs"  src="' . $filename . '" />';

						} else {
							$x =  rand(160, 200);
							#no image show me random static image (6 possible returns)
							echo '<img class="imgThumbs" src="http://placekitten.com/' . $x. '/' . $x. '" alt="' . $uName . '"  />';
						}

						echo '<br />

						' . dbOut($row['UserName']) . '

						<i><font color="red">' . 	dbOut(sprintf("%03d",$row['UserID'])) . '</font></i>
						<br />
						<i><font color="red">' . 	dbOut($row['Email']) . '</font></i>

					 </div>
					</a>';; #close image

				}

				echo '</div>
				<br style="clear:both" />'; #close images container


			}else{#no records
					echo "<p>No matches were found.</p>";
			} #END PROFILES SEARCH

			@mysqli_free_result($result);

		break;

	############## SHOW MEMBERS ###############

	case 'female':

		//set access priv needed for this page by member
		$gender = 'female';
		$parentDir = 'uploads';

		echo '
			<div class="row">
				<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

			echo searchForm($newToken);

			echo '<br /><br />
				</div>
				<div class="col-xs-7 col-sm-9 col-md-9" style="">
					<h3 class="text-center">' . ucfirst($gender) . ' playbys currently in MC\'s Asset Library</h3>';

			echo playbyTiles($parentDir, $gender);

			echo '</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="border-top: solid 1px silver;">';

				echo getContent($aarContent); #execute search

				echo '</div>
			</div><!--END row -->
		<div class="clearfix"></div>';

		break;

	############## SHOW MEMBERS ###############
	#http://localhost/WrDKv3/characters/index.php?act=male#

		#http://localhost/WrDKv3/uploads/_male/Kellan_Lutz/Kellan_Lutz-001.jpg
	case 'male':

		//set access priv needed for this page by member
		$gender = 'male';
		$parentDir = 'uploads';

		echo '
			<div class="row">
				<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

			echo searchForm($newToken);

			echo '<br /><br />
				</div>
				<div class="col-xs-7 col-sm-9 col-md-9" style="">
					<h3 class="text-center">' . ucfirst($gender) . ' playbys currently in MC\'s Asset Library</h3>';

			echo playbyTiles($parentDir, $gender);

			echo '</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="border-top: solid 1px silver;">';

				echo getContent($aarContent); #execute search

				echo '</div>
			</div><!--END row -->
		<div class="clearfix"></div>';

		break;

	############## SHOW DEFAULT CASE ###############
	#Generic random assort of characters
	case 'ShowRandom':
	default:

			echo '
			<div class="row">
				<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

			echo searchForm($newToken);

			echo '<br /><br />
				</div>
				<div class="col-xs-7 col-sm-9 col-md-9" style="">';
/*
					if (verifyFormToken('form01-Search')) {

					// ... more security testing
					// if pass, execute code

						echo searchResult($sql);

					} else {

						 echo "Invalid Input detected.";
						 writeLog('Formtoken');

					}
*/

			echo searchResult($sql); #make sql if needed

			echo '</div>
		</div>
		<div class="row">
			<div class="col-xs-12" style="border-top: solid 1px silver;">';

				echo get_welcome($aarFriday); #execute search

				echo '</div>
			</div><!--END row -->
		<div class="clearfix"></div>';


}#END Switch



if(!isset($_SESSION['Privilege'])){
	echo '
	<div align= "center">
		<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#modalContact">Join Us!</a>
	</div>';

}else{
	echo '
	<div align= "center">

		<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#modalContact">Request Character!</a>

	</div>';
}


get_footer(); #defaults to theme footer or footer_inc.php


###################################
function showCurrentPlaybys($sql, $gender='', $playby='')
{
	# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


	if(mysqli_num_rows($result) > 0) {#records exist - process

		echo '<div class="" >'; #start images container

		while($row = mysqli_fetch_assoc($result)) {# process each row

			if(!empty($row['Playby']) && ($row['Gender'] == $gender)){
				#0. create needed vars
				$myCharID      = dbOut($row['CharID']);
				$playby      = dbOut($row['Playby']);
				#my google image search of a playby
				#https://www.google.com/search?q=aaron+taylor+johnson
				#https://www.google.com/search?q=aaron+' . $myGoogle .'
				#replace whitespace, commas, and dashes with plus sign
				$myGoogle      = preg_replace('/[ ,]+/', '+', trim($playby));
				$myPlayByGoogle = "<a href='https://www.google.com/search?q={$myGoogle}' target='_blank'>{$playby}</a>";

				$myCodeName    = dbOut($row['CodeName']);
				$myURLCodeName = str_replace(' ', '-', dbOut($row['CodeName']));
				$stageID       = dbOut($row['StatusID']);

				#1. create thumbnail
				#$myImgPath = "../uploads/c{$myCharID}_thumb.jpg";

				$myImgPath = chekImgExists($myCharID, $gender, $playby);

				$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='{$playby}is
					the playby for {$myCodeName} - {$myCharID}' />";
				$myPageLink = VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
					$myURLCodeName . '&id= ' .
					$myCharID . '&act=show';


				#2. create image assignments state
				switch ($stageID) {
					case "available":
						$stageID = '<i>temporarily</i> cast as';
						break;

					case "assigned":
					case "review":
					case "reserved":
						$stageID = '<i>reserved</i> for';
						break;
					case "assigned":
					case "approved":
					case "locked":
						$stageID = '<i>designated</i> casting for';
						break;
					default:
						$stageID = 'is currently a <i>placeholder</i> casting for';
					}

				echo "<p >{$myImg} <div><span class='text-info'>{$myPlayByGoogle}</span> {$stageID}
					<a href='{$myPageLink}'>{$myCodeName}</a></div></p>
					<hr />
					";
			}
		}

		echo '</div>
		<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matches were found.<br /><a href='" . THIS_PAGE . "'> Return To Characters?</a></div>";
	}
} #END Function showCurrentPlaybys
				# SQL statement

#makeButton - like make nav?
function myDropdown(){
	echo '<div class="dropdown">
	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Show Characters By...
	<span class="caret"></span></button>
	<ul class="dropdown-menu">

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowWanted"  > Wanted Characters </a></li>

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowTaken"  > Taken Characters </a></li>';

		#let's protect our users privacy
	if(startSession() && isset($_SESSION['UserID'])){
		echo '<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowPlotters"  > Plotters </a></li>';
	}

		echo '<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowPlayby" > Playbys / Castings </a> </li>

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowBanned"  > Characters Banned</a></li>

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowAvailable"  > Characters Available</a></li>';



		#let's protect our users privacy
		if(startSession() && isset($_SESSION['UserID'])){
			echo '	<li><a href="' . VIRTUAL_PATH . '/characters/index.php?act=ShowMembers"  > Members </a></li>';
		}

			echo '<li><a href="' . VIRTUAL_PATH . '/characters/index.php?act=ShowTeams"  > Teams </a></li>

			<li><a href="' . VIRTUAL_PATH . '/characters/index.php?act=ShowRandom"  > Random </a></li>
		</ul>
	</div>
	';
}
#makes the dropdown button list thing

function showResult($mySQL = '', $stageID, $myAdjective = '')
{
	echo "<h1 class=''>Characters currently {$myAdjective} on " . SITE_NAME ."</h1>";

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(), $mySQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


	if(mysqli_num_rows($result) > 0) {#records exist - process

		echo '<div class="" >'; #start images container

		while($row = mysqli_fetch_assoc($result)) {# process each row

			if(!empty($row['StatusID']) && ($row['StatusID'] == $stageID)){

				#0. create needed vars
				$cID      		 = dbOut($row['CharID']);
				$myCodeName    = dbOut($row['CodeName']);
				$stageID       = dbOut($row['StatusID']);


				#my freindly google news search of codename
				#https://www.google.com/search?q=aaron+taylor+johnson
				#https://www.google.com/search?q=' . $myGoogle .'
				#replace whitespace, commas, and dashes with plus sign

				$myGoogle      = preg_replace('/[ ,]+/', '+', trim($myCodeName));
				$myGoogleSearch = "<a href='https://www.google.com/search?q=marvel+super-hero+cinematic+universe+{$myGoogle}+x-men+avengers' target='_blank'>You can learn more about {$myCodeName} here.</a>";


				#$myURLCodeName = str_replace(' ', '-', dbOut($row['CodeName']));

				#0. Check image exists
				#$myImgPath = $myCharID; #creat path
				$myImgPath = chekImgExists($cID);           #chek image exists


				#http://localhost/git250-16q2/marvel-adventures//uploads/static---001.gif

				#var_dump($myImgPath); #string(35)
				#die;

				#1. create thumbnail
				#$myImgPath = "../uploads/c{$myCharID}_thumb.jpg";
				$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='{$myCodeName} is
					currently {$stageID} - {$cID}' />";

				#2. create link
				$myPageLink = '<a href="profile.php?CodeName=' . $myCodeName .
					'&id=' . $cID .
					'&act=show">' . $myCodeName .
					'</a>';

				#3. show match results

				echo "<p >{$myImg} <div>{$myPageLink} -  {$myGoogleSearch}</div></p><hr />";

			}
		}

		echo '</div> <br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matching results <i>{$myAdjective}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
	}
} #END Function showCurrentPlaybys

/* will need to paginate this sucker */
function showTest( $mySQL, $myAdjective='', $minNum='0', $maxNum='0', $equalNum='0')
{
		echo "<h1 class=''>Characters currently {$myAdjective} on " . SITE_NAME ."</h1>";

		# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(), $mySQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


		if(mysqli_num_rows($result) > 0) {#records exist - process
			echo '<div class="" >'; #start images container

			while($row = mysqli_fetch_assoc($result)) {# process each row

				if(!empty($row['StatusID'])
					 &&
					 ($row['StatusID'] >= $minNum) &&
					 ($row['StatusID'] <= $maxNum) ||
					 ($row['StatusID'] == $equalNum)
					){

					#0. create needed vars
					$myCharID      = dbOut($row['CharID']);
					$myCodeName    = dbOut($row['CodeName']);
					$myStatusID    = dbOut($row['StatusID']);

					$myGoogle      = preg_replace('/[ ,]+/', '+', trim($myCodeName));
					$myGoogleSearch = "<a href='https://www.google.com/search?q=marvel+super-hero+cinematic+universe+{$myGoogle}+x-men+avengers' target='_blank'>You can learn more about {$myCodeName} here.</a>";


					#$myURLCodeName = str_replace(' ', '-', dbOut($row['CodeName']));

					#0. Check image exists
					#$myImgPath = $myCharID; #creat path
					$myImgPath = chekImgExists($myCharID);           #chek image exists


					#http://localhost/git250-16q2/marvel-adventures//uploads/static---001.gif

					#var_dump($myImgPath); #string(35)
					#die;

					#1. create thumbnail
					#$myImgPath = "../uploads/c{$myCharID}_thumb.jpg";
					$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='{$myCodeName} is
						currently {$myStatusID} - {$myCharID}' />";

					#2. create link
					$myPageLink = '<a href="profile.php?CodeName=' . $myCodeName .
						'&id=' . $myCharID .
						'&act=show">' . $myCodeName .
						'</a>';

					#3. show match results

					echo "<p >{$myImg} <div>{$myPageLink} -  {$myGoogleSearch}</div></p><hr />";

				}
			}

			echo '</div> <br style="clear:both" />'; #close images container

		}else{#no records
				echo "<div align=center>No matching results <i>{$myAdjective}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
		}
	} #END Function showNewResult

function showTeams($mySQL = 'x', $myStatus = '', $myAdjective = '')
{

	echo "<h1 class=''>Characters currently {$myAdjective} on " . SITE_NAME ."</h1>";

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(), $mySQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0) {#records exist - process

		#myVars
		$myStr   = '';
		$myChek  = '';

		while($row = mysqli_fetch_assoc($result)) {# process each row
			if(!empty($row['TeamName'])
				 #example of how to control who shows up in search
				 #This seems odd - should be !='banned'
				 && (($row['StatusID'] != NULL)) || ($row['StatusID'] == 'banned'))
			{
				#0. create needed vars
				$myTeamName    = dbOut($row['TeamName']);
				$myCharID      = dbOut($row['CharID']);
				$myCodeName    = dbOut($row['CodeName']);
				#$myPosition    = dbOut($row['TeamPosition']); #must have default

				#1. create thumbnail
				$myImgPath = chekImgExists($myCharID);


				$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='Image of {$myCodeName}' /><br />{$myCodeName}";

				#2. create link

				#http://localhost/git250-16q2/marvel-adventures//characters/profile.php?CodeName=ChimaeraX&act=showChimaeraX&id=2

				$myPageLink = "<div class='pull-left' style='display:block; text-align: left'> &nbsp;
					<a href='profile.php?CodeName={$myCodeName}&act=show&id={$myCharID}'>{$myImg}</a></div> ";

				#3. sort the results teamname

				#chek if TeamName new
				#it's empty first time, so title/teamname prints
				if ($myChek !== $myTeamName){
					#if TeamName new - set new
					$myStr .= "<br style='clear:both' />
					<h3 style='align:left'> {$myTeamName} </h3>";
					#Save new teamname
					$myChek = $myTeamName;
				}

				$myStr .= $myPageLink;


			} #END While

			if(isset($myStr)){
				echo $myStr;
				$myStr = ''; #clear out string
			}else{
				echo 'Currently No Teams Set';
			};

		}
		echo '<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matching results <i>{$myAdjective}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
	}
} #END Function showCurrentPlaybys

#helper Functions
function chekImgExists($img='', $gender='', $playby=''){

	$filepath = "../uploads/{$img}-1.jpg";

	#../uploads/_female/Alexa PenaVega/Alexa PenaVega-001.jpg


	$playby = str_replace(' ', '_', strtolower($playby));
	$playby = str_replace('-', '_', strtolower($playby));
	$playby = str_replace("'", '_', strtolower($playby));

	$pbPath   = "../uploads/_{$gender}/{$playby}/{$playby}-1.jpg";
	#if image exists, show
	if (file_exists($filepath)) {
		return $filepath; #return nothing - path stays same

	} else if(file_exists($pbPath)) {
		#no image show me random static image (6 possible returns)
		return $pbPath; #temp image
	} else {
		#dumpDie($pbPath);

		#no image show me random static image (6 possible returns)
		return '../_img/_static/static---00' . rand(0, 9). '.gif'; #new image path
	}
}

function get_welcome($aar, $str=''){

	//display general info
		if(startSession() && isset($_SESSION['UserID'])){
			$str .= $aar['AccessMember'];
		}else{
			$str .= $aar['AccessVisitor'];
		} #END User Address/Instruction content area.

	return $str;
}


###################     HEP FUNCTIONS -> SEARCH     ################
function showRandom($sql, $str=''){
	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0)
	{#records exist - process

		echo '<div align="center" style="margin: 5px;" >'; #start images container
		while($row = mysqli_fetch_assoc($result))
		{# process each row

/*
if(isset(dbOut($row['CharID'])))	{$cID 		= dbOut($row['CharID']);	}else{ $cID = '';}
if(isset(dbOut($row['CodeName']))){$cName 	= dbOut($row['CodeName']);}else{ $cName = '';}
if(isset(dbOut($row['StatusID']))){$cStage 	= dbOut($row['StatusID']);}else{ $cStage = '';}
if(isset(dbOut($row['Playby'])))	{$cPlayby = dbOut($row['Playby']);	}else{ $cPlayby = '';}
if(isset(dbOut($row['Gender'])))	{$cGender = dbOut($row['Gender']);	}else{ $cGender = '';}
*/


			$cID = $cName = $cStatus = $cPlayby = $cGender = $cDefault = $cLink = $cImg = $pbImg = '';

			$cID   		= dbOut($row['CharID']);
			$cName 		= dbOut($row['CodeName']);
			$cStatus	= dbOut($row['StatusID']);
			$cPlayby  = dbOut($row['Playby']);
			$cGender  = dbOut($row['Gender']);


			#if no gender, declare as most characters are likely male
			if($cGender == ''){$cGender = 'male';}



			#creat image link to character
			echo '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
				#strip white spaces out of code name for url
				str_replace(' ', '-', $cName) . '&id=' . $cID  . '&act=show">

				<div class="divThumbs">';


				#EX: 1-1t.jpg
				$tImg   = 'uploads/_assigned/' . $cID  . '-1.jpg';
				#EX: alex_kotze
				$cbDir  = strtolower(str_replace(' ', '_', $cPlayby));
				#EX: uploads/_male/david_berry/david_berry-1.jpg
				$pImg   = 'uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-1.jpg';
				#EX: $sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';
				$sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';


				#if image exists, show
				if (file_exists('./../' . $tImg)) {
					echo '<img class="imgThumbs"  src="./../' . $tImg . '" alt="' . $cName . '" />';

				} elseif(file_exists('./../' . $pImg)) {
						#} elseif(file_exists($cbLnk) {
						#if playby match exists, show

					#uploads/_male//-000.jpg
						echo '<img src="./../' . $pImg . '" class="imgThumbs" alt="' . $cName . '" />';

				} else {
					#no image show me random static image (6 possible returns)
					echo '<img class="imgThumbs" src="' . $sImg . '" alt="' . $cName . '"  />';
					# testJarvis00.gif

					#echo '<img class="imgThumbs" src="./../_img/_jarvis/testJarvis00.gif" alt="' . $cName . '"  />';
				}

				echo '<br /><small>
				<i>#'
					. 	dbOut(sprintf("%05d", $cID))
					. ' ' . $cName . '</i></small>
					</div></a>'; #close image

			}

		echo '</div>
		<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<h3 class='text-center' style='border-bottom:solid 1px silver;'>No matches were found.</h3>";
	} #END PROFILES SEARCH

	@mysqli_free_result($result);

}#END showRandom

/*
		#incoming :: http://localhost/WrDKv3/characters/indexDev.php?
		cCe=CodeName&
		rNe=regularName&
		cTe=charType&
		cTm=charTeam&
		cPB=charPlayby#
*/

function searchForm($newToken){
	$str='';
	/*
		<p >{$myImg} <div><span class='text-info'>{$myPlayByGoogle}</span> {$stageID}
			<a href='{$myPageLink}'>{$myCodeName}</a></div></p>
			<hr />
	*/

	#http://localhost/WrDKv3/characters/indexDev.php?cCe=burt&rNe=my+real+name&cTe=i%27m+a+mutant&cTm=defender&cPB=lodi+lin#


#htmlspecialchars_decode(trim($value))

#character codename
if(isset($_GET['cCe']))	{
	$cName  = $_GET['cCe'];
	$cName 	= htmlspecialchars_decode(trim($cName));
}else{
	$cName 	= '';
}


#character regular name
if(isset($_GET['rNe']))	{
	$regName  = $_GET['rNe'];
	$regName 	= htmlspecialchars_decode(trim($regName));
}else{
	$regName = '';
}


#character type
if(isset($_GET['cTe']))	{
	$cType  = $_GET['cTe'];
	$cType 	= htmlspecialchars_decode(trim($cType));
}else{
	$cType 	= '';
}


#character team
if(isset($_GET['cTm']))	{
	$cTeam  = $_GET['cTm'];
	$cTeam 	= htmlspecialchars_decode(trim($cTeam));
}else{
	$cTeam 	= '';
}


#character playby
if(isset($_GET['cPB']))	{
	$cPlayby  = $_GET['cPB'];
	$cPlayby 	= htmlspecialchars_decode(trim($cPlayby));
}else{
	$cPlayby = '';
}



$str .='<form class="text-right" action="' . VIRTUAL_PATH . 'characters/index.php" method="get"><!-- SET form-->
	<img
		src="./../_img/_jarvis/_jarvis-053.png"
		class="pull-center"
		style="height:150px;"
		alt="jarvis search!" />
	<br />
	<br />

	<div class="form-group"><br />
		<label for=" ">Codename:</label>
		<input type="text" name="cCe" value="' . $cName .'"
			placeholder="Enter codename" />
	</div>


<!--
	<div class="form-group">
		<label for=" ">Name:</label><br />
		<input type="text"  name="rNe" value="' . $regName .'"
			placeholder="Enter name of character" />
	</div>

	<div class="form-group">
		<label for=" ">cType:</label><br />
		<input type="text"  name="cTe" value="' . $cType .'"
			placeholder="Enter character type" />
	</div>
-->

	<div class="form-group">
		<label for=" ">Team:</label><br />
		<input type="text"  name="cTm" value="' . $cTeam .'"
			placeholder="Enter name of team" />
	</div>

	<div class="form-group">
		<label for=" ">Playby:</label><br />
		<input type="text"  name="cPB" value="' . $cPlayby .'"
			placeholder="Enter name of playby" />
	</div>

	<br/>
	<input type="hidden" name="token" value="' . $newToken .'" />



	<input class="pull-right" type="submit" value="submit" />




</form><!--END form-->';


	return $str;
 }

function searchResult($sql, $str=''){
	#build search result based on query returns
	$cName = $regName = $cType = $cTeam = $cPlayby = '';

	#character codename
	if( (isset($_GET['cCe'])) && (($_GET['cCe']) != '') )
	{
		$cName 	= htmlspecialchars(trim($_GET['cCe']), ENT_QUOTES, "UTF-8");

		#update SQL
		$sql = "SELECT CharID, CodeName, FirstName, LastName, MiddleName, StatusID, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cName%'";
		#use updated SQL
		genTiles($sql);

		echo '<hr />
			<a href="' . VIRTUAL_PATH . 'characters/index.php" class="btn btn-default btn-xs" role="button">reset link</a>
			<a href="' . VIRTUAL_PATH . 'characters/index.php" class="btn btn-default btn-xs pull-right" role="button">see more</a>';
		#echo $sql;
	}

	#character regular name
	if(isset($_GET['rNe']))	{
		$regName = htmlspecialchars(trim($_GET['rNe']), ENT_QUOTES, "UTF-8");

	}

	#character type
	if(isset($_GET['cTe']))	{
		$cType 	= htmlspecialchars(trim($_GET['cTe']), ENT_QUOTES, "UTF-8");
	}

	#character team
	#if(isset($_GET['cTm']))
	if((isset($_GET['cTm'])) && (($_GET['cTm']) != '')){
		$cTeam 	= htmlspecialchars(trim($_GET['cTm']), ENT_QUOTES, "UTF-8");

		#update SQL
		$sql = "SELECT CharID, CodeName, FirstName, LastName, MiddleName, StatusID, Playby, Gender, Team #selected from ma_Characters
			FROM ma_Characters WHERE Team='$cTeam' ORDER BY CodeName ASC ;";
		#use updated SQL

		#echo $sql;
		genTiles($sql);

		echo '
		<div class="clearfix"></div>
		<div>
			<a href="' . VIRTUAL_PATH . 'characters/index.php" class="btn btn-default btn-xs" role="button">reset link</a>
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowTeams" class="btn btn-default btn-xs pull-right" role="button">see more</a>
		</div>
		';
	}


	#character playby
	#if(isset($_GET['cPB']))
	#http://localhost/WrDKv3/characters/indexDev.php?cCe=&cTm=&cPB=taylor+swift&token=6f1dee0ff07610370409a67cd665892c#
	if((isset($_GET['cPB'])) && (($_GET['cPB']) != '')){
		$cPlayby = htmlspecialchars(trim($_GET['cPB']), ENT_QUOTES, "UTF-8");

		#update SQL
		$sql = "SELECT CharID, CodeName, FirstName, LastName, MiddleName, StatusID, Playby, Gender, Team #selected from ma_Characters
			FROM ma_Characters WHERE Playby='$cPlayby' ORDER BY CodeName ASC ;";
		#use updated SQL

		#echo $sql;
		genTiles($sql);

		echo '<div>
		<br />
		<div class="col-sm-9 text-center" >
			<a href="' . VIRTUAL_PATH . 'characters/index.php" class="btn btn-default btn-xs" role="button">Clear Form</a>

			&nbsp; &nbsp;

			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowPlayby" class="btn btn-default btn-xs" role="button">See Taken</a>

			&nbsp; &nbsp;

			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=male" class="btn btn-default btn-xs" role="button" >Unclaimed Males</a>

			&nbsp; &nbsp;

			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=female" class="btn btn-default btn-xs" role="button">Unclaimed Females</a>
		</div>';


	}


	///// IF ALL EMPTY - SHOW GENERIC RESULT ////

	if(($cName == '') && ($cTeam == '') && ($cPlayby == '')) {
		showRandom($sql);
	}

}

function genCharTiles($sql, $str=''){


	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0)
	{#records exist - process

		$str .= '<div align="center" style="margin: 5px;" >'; #start images container
		while($row = mysqli_fetch_assoc($result))
		{# process each row

			#$cID = $cName = $cStatus = $cPlayby = $cGender = $cDefault = $cLink = $cImg = $pbImg = '';
			$cID   		= dbOut($row['CharID']);
			$cName 		= dbOut($row['CodeName']);
			$cStatus	= dbOut($row['StatusID']);
			$cPlayby  = dbOut($row['Playby']);
			$cGender  = dbOut($row['Gender']);

			#if no gender, declare as most characters are likely male
			if($cGender == ''){$cGender = 'male';}

			#creat image link to character
			$str .= '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
				#strip white spaces out of code name for url
				str_replace(' ', '-', $cName) . '&id=' . $cID  . '&act=show">

				<div class="divThumbs">';

				$tImg   = 'uploads/' . $cID  . '-0.jpg';
				$cbDir  = strtolower(str_replace(' ', '_', $cPlayby));
				$pImg   = 'uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-000.jpg';
				$sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';

				#if image exists, show
				if (file_exists('./../' . $tImg)) {
					$str .= '<img class="imgThumbs"  src="./../' . $tImg . '" alt="' . $cName . '" />';

				} elseif(file_exists('./../' . $pImg)) {
					#if playby match exists, show

					#uploads/_male//-000.jpg
					$str .= '<img src="./../' . $pImg . '" class="imgThumbs" alt="' . $cName . '" />';

				} else {
					#no image show me random static image (6 possible returns)
					$str .= '<img class="imgThumbs" src="' . $sImg . '" alt="' . $cName . '"  />';
				}

				$str .= '<br />
				' . $cName . '<i><font color="red">'
					. 	dbOut(sprintf("%05d", $cID))
					. '</font></i>
				<br /></div></a>'; #close image

		}

		$str .= '</div>
		<br style="clear:both" />'; #close images container

	}else{#no records
			$str .= "";
	} #END PROFILES SEARCH

	@mysqli_free_result($result);

	return $str;
}

function genTiles($sql, $cName='', $regName='', $cTeam='', $cType='', $cPlayby='', $str='' ){
		#produce a title match for values given for jarvis/cerebra/cerebro/shield database et al.


	if($cName){ //show random results

		$str .= "<h3>All known existing matches for {$cName}</h3>";
		$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cName%';";

		$str .= genCharTiles($sql);


		return $str;

	//////////////////////////////////////////
	} else if($regName){ //show random results

		$str .= "<h3>All known existing matches for {$regName}</h3>";
		$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$regName%';";


		return $str;

	//////////////////////////////////////////
	} else if($cType){ //show random results
		$str .= "<p>{$cType}</p>";
		$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cType%';";


		return $str;

	//////////////////////////////////////////
	} else if($cTeam){ //show random results

		$str .= "<h3>All known existing matches for {$cTeam}</h3>";
		$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cTeam%';";


		return $str;

	//////////////////////////////////////////
	} else if($cPlayby){ //show random results
		$str .= "<p>{$cPlayby}</p>";

		$str .= "<h3>All known existing matches for {$cPlayby}</h3>";
		$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cPlayby%';";


		return $str;

	//////////////////////////////////////////
	} else {
		//no requests, show random sort
		$str .= showRandom($sql);
	}


}

function showTeam($sql, $cTeam, $chk='', $str=''){
	 $sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Team #selected from ma_Characters
			FROM ma_Characters WHERE Team LIKE '%$cTeam%' ORDER BY CodeName ASC ;";

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(), $sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0) {#records exist - process
		#outer html here
		echo "<h1 class=''>Currently known members of the " . $cTeam . "</h1>";

		while($row = mysqli_fetch_assoc($result)) {# process each row
			#0. create needed vars
			$teamName    = dbOut($row['Team']);
			$cID      = dbOut($row['CharID']);
			$cName    = dbOut($row['CodeName']);
			#$myPosition    = dbOut($row['TeamPosition']); #must have default

			#1. create thumbnail
			$iPath = chekImgExists($cID);

			$img = "<img class='thumbSM' src='{$iPath}' alt='Image of {$cName}' /><br />{$cName}";

			#2. create link

			$myPageLink = "<div class='pull-left' style='display:block; text-align: left'> &nbsp;
				<a href='profile.php?CodeName={$cName}&act=show&id={$cID}'>{$img}</a></div> ";

			$str .= $myPageLink;

		} #END While

		if(isset($str)){
			echo $str;
			$str = ''; #clear out string
		}else{
			echo 'Currently No Teams Set';
		};

		echo '<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matching results <i>{$cTeam}</i> found.<br /></div>";
	}
} #END Function showCurrentPlaybys



###################     HEP FUNCTIONS -> Playbys Random     ################
#scan directory - generate subdirectory list for random playby list
function playbyTiles($parentDir, $gender='', $subDirPath='', $str=''){

	//css
	//http://alt-web.com/TUTORIALS/?id=bootstrap_modal_carousel_gallery

	$str .= '


	<ul class="list-inline">
	<li data-toggle="modal" data-target="#modal2"><a href="#myGallery" data-slide-to="0"><img class="img-thumbnail" src="http://lorempixel.com/200/133/nature/1"><br>
Caption</a></li>
<!--end of thumbnails-->
</ul>




<!--begin modal window-->
<div class="modal fade" id="modal2">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="pull-left">My Gallery Title</div>
<button type="button" class="close" data-dismiss="modal" title="Close"> <span class="glyphicon glyphicon-remove"></span></button>
</div>
<div class="modal-body">

<!--begin carousel-->
<div id="myGallery" class="carousel slide" data-interval="false">
<div class="carousel-inner">
<div class="item active"> <img src="http://lorempixel.com/600/400/nature/1" alt="item0">
<div class="carousel-caption">
<h3>Heading 3</h3>
<p>Slide 0  description.</p>
</div>
</div>
<div class="item"> <img src="http://lorempixel.com/600/400/nature/2" alt="item1">
<div class="carousel-caption">
<h3>Heading 3</h3>
<p>Slide 1 description.</p>
</div>
</div>
<div class="item"> <img src="http://lorempixel.com/600/400/nature/3" alt="item2">
<div class="carousel-caption">
<h3>Heading 3</h3>
<p>Slide 2  description.</p>
</div>
</div>
<div class="item"> <img src="http://lorempixel.com/600/400/nature/4" alt="item3">
<div class="carousel-caption">
<h3>Heading 3</h3>
<p>Slide 3 description.</p>
</div>
</div>
<div class="item"> <img src="http://lorempixel.com/600/400/nature/5" alt="item4">
<div class="carousel-caption">
<h3>Heading 3</h3>
<p>Slide 4 description.</p>
</div>
</div>
<div class="item"> <img src="http://lorempixel.com/600/400/nature/6" alt="item5">
<div class="carousel-caption">
<h3>Heading 3</h3>
<p>Slide 5 description.</p>
</div>
</div>
<!--end carousel-inner--></div>
<!--Begin Previous and Next buttons-->
<a class="left carousel-control" href="#myGallery" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myGallery" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
<!--end carousel--></div>

<!--end modal-body--></div>
<div class="modal-footer">
<div class="pull-left">
<small>Photographs by <a href="http://lorempixel.com" target="new">Lorempixel.com</a></small>
</div>
<button class="btn-sm close" type="button" data-dismiss="modal">Close</button>
<!--end modal-footer--></div>
<!--end modal-content--></div>
<!--end modal-dialoge--></div>
<!--end myModal-->></div>



<br /><br />
';

	$parentDir = "./../{$parentDir}/_{$gender}/";
	//get all files in specified directory
	$dir = glob($parentDir . "*");
	//print each file name
	foreach($dir as $subDir)
	{
		//check to see if the file is a folder/directory
		if(is_dir($subDir))
		{
			$pbName = str_replace('./../uploads/_male/', '', $subDir);
			$pbTitle = str_replace('./../uploads/_male/', '', $subDir);
			$pbTitle = str_replace('_', ' ', $pbTitle);
			$pbTitle = ucwords($pbTitle);

			/* merged modal and carousel without use of javascript */

			#http://localhost/WrDKv3/uploads/viewPlayby.php?act=show&gender=male&img=Kellan_Lutz---eBl+hBl

			#https://codepen.io/krnlde/pen/pGijB

			#make modal pop up carousels! for each image - neat huh?





			#creat image link to character
			$str .= '<a href="' . $subDir  . '">
				<div class="divThumbs text-center">
					<img class="imgThumbs"  src="' . $subDir  . '/' . $pbName . '-001.jpg" alt="' . $pbTitle . '" />
					<br />
				' . $pbTitle . '<br /></div>
			</a>'; #close image
		}
	}
	return $str;
}

