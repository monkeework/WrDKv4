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


# SQL statement
$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters ORDER BY RAND() LIMIT 12;";

# END CONFIG AREA ----------------------------------------------------------
global $config;
#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php
$config->titleTag = SITE_NAME . '&nbsp; | &nbsp; Character Profiles | &nbsp; ' . SITE_NAME;

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = SITE_NAME . ' Character Database ' . $config->metaDescription;
$config->metaKeywords = 'Super-Heroes, Superheroes, Marvel, Comics, Characters, Roleplay, RP, RPG'. $config->metaKeywords;
$config->loadhead = '<link rel="stylesheet" type="text/css" href="./../_css/maxStrap.css">'; #load page specific JS


$tempTitle ='';

get_header();

#generate a new token for the $_SESSION superglobal and put them in a hidden field
$newToken = genFormToken('form01-Search');

if(isset($_GET['act'])){ $act = ($_GET['act']); }else{ $act = ''; } #initialize $act for switch

switch ($act) {
	case 'ShowAvailable':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID BETWEEN 0 AND 2
				ORDER BY CodeName ASC;";

			showTaken($sql, 'Available', $minNum=-0, $maxNum=2); #characters locked prevent meddling
		break;

	################ SHOW BANNED ################
	case 'ShowBanned':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID = 16
				ORDER BY CodeName ASC;";

				showTaken($sql, 'banned', $minNum=16, $maxNum=16);
			break;

	############## PLAYBYS ###############
		#...?act=playby&gen=male&playby=aaron_taylor_johnson

	/*
	 * Playby Search result
	 * returns html render
	 */
	case 'playby':

			$pbName=$gender='';
			$pbName = $_GET['playby'];
			$gender = $_GET['gen'];

			echo '<div class="row">
					<h1 class="text-center"> ' . $pbName . ' (Playbys)</h1>
				</div>
				<div class="row">
				<div class="col-sm-6">';

			echo '</div>
			</div>'; #END playbys

			break; #END showPlayby

	############## SHOW PLAYBYS ###############
	case 'ShowPlayby':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Playby, Gender
				FROM ma_Characters ORDER BY Playby ASC;";

			echo '
			<div class="row">
				<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

			echo searchForm($newToken);

			echo '<br /><br />
			</div>
			<div class="col-xs-7 col-sm-9 col-md-9" style="">
				<h3 class="text-center"> <b>Currently Assigned Playbys</b></h3>

				<hr />

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
			</div>
			<div class="clearfix"></div>';

		break;
	################ SHOW GROUP PLOTTERS ################
	case 'ShowPlotter':
			echo '<h1>show group plotters - see profiles for individiual character plotters</h1>';
			break;

	############## SHOW TEAMS ###############
	case 'ShowTeams':

			echo '<div class="row">
				<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

			echo searchForm($newToken);

			echo '<br /><br />
			</div>
			<div class="col-xs-7 col-sm-9 col-md-9" style="">
				<h3 class="text-center"> <b>Current Team Rosters</b></h3>

				<hr />

				<div class="col-sm-12">';
					#show only characters who are on teams, show them by the teams they're on
					showTeams('null', 'teamed together');
			echo '</div>
			</div>
			<div class="clearfix"></div>';

			break;

	############### SHOW TAKEN #################
	case 'ShowTaken':
		/*
		$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, Playby, Gender, StatusID
			FROM ma_Characters
			WHERE StatusID >= 2 AND Gender = 'female' ORDER BY CodeName ASC";
		*/

			echo '
				<div class="row">
					<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

				echo searchForm($newToken);
				echo '<br /><br />
					</div>
					<div class="col-xs-7 col-sm-9 col-md-9" style="">
						<h3 class="text-center"> <b>Taken or Reserved Characters</b></h3>
						<p class="text-muted">
							Many of the playbys which have been associated with the characters appearing on this site are only to be considered suggestions. If you adopt one of our many available characters you are under no owness to use the character unless it is otherwise communicated to you while in the app process. So, what does that mean in english? If you app Spider-Man, you\'re free use Tom Holland, Andrew Garfield, Toby Maguire, or someone completely else, just so long as it\'s appropriate to the character, your selection will likely be approved. And if that selection is currently in use with another character, one of two options will used.
						</p>
						<ul>
						<li class="text-muted" style="list-style-type: none;">
							A: The unclaimed character will have it\'s playby changed.
						</li>
						<li class="text-muted"  style="list-style-type: none;">
							B: Both character\'s will share the same playby so long as they use different images.
							<br />
							<small><i> Why you might ask? Because, sometimes,  people just look alike, sometimes with astonishing similiaries - like Captain America and the Human Torch.</i>
						</li>

					</ul>
					</div>


						<hr />

						<div class="col-sm-4 pull-left">
							<h3>Female</h3>';
							#process results - show female playbys
						echo showTaken('taken', $minNum=2, $maxNum=13, 'female', 'Female'); #characters locked prevent meddling

						echo '</div>';

						echo '<div class="col-sm-4 pull-right">
							<h3>Male</h3>';
							#process results - show female playbys
							echo showTaken('taken', $minNum=2, $maxNum=13, 'male', 'Male'); #characters locked prevent meddling


				echo '</div>
				</div>
				<div class="clearfix"></div>';

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
						$filename = '../uploads/' . dbOut($row['UserID']) . '_thumb.jpg';

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


############## SHOW PLAYBYS ###############
	case 'm':
	case 'f':

		//set access priv needed for this page by member
		$pbGen = $_GET['act'];

		if($pbGen == 'm'){ $genderExplicit = 'male'; }
		if($pbGen == 'f'){ $genderExplicit = 'female'; }

		$parentDir = 'uploads';

		echo '
			<div class="row">
				<div class="col-xs-5 col-sm-3 col-md-3" style="border-right: solid 1px silver;">';

			echo searchForm($newToken);

			echo '<br /><br />
				</div>
				<div class="col-xs-7 col-sm-9 col-md-9" style="">
					<h3 class="text-center">' . ucfirst($genderExplicit) . ' playbys currently in MC&rsquo;s Asset Library</h3>';

			echo playbyTiles($parentDir, $pbGen);

			echo '</div>
			</div>
			<div class="clearfix"></div>';

		break;

	############## SHOW DEFAULT CASE ###############
	############## SHOW DEFAULT CASE ###############
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
	<br />
		<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#modalContact">Join Us!</a>
	</div>';

}elseif($act='m'){
	echo '
	<div align= "center">
	<br />
		<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#modalContact">Place a Reserve!</a>
	</div>';

}elseif($act='f'){
	echo '
	<div align= "center">
	<br />
		<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#modalContact">Place a Reserve!</a>
	</div>';

}else{
	echo '
	<div align= "center">
	<br />
		<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#modalContact">Request Character!</a>
	</div>';
}

get_footer(); #defaults to theme footer or footer_inc.php


###################################
function showCurrentPlaybys($sql, $cGenExplicit='', $playby='', $cGen='')
{
	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	#changing 'male' to 'm' for shorter query strings elsewhere/consistency
	if($cGenExplicit == '')				{ $cGen = 'm'; }
	if($cGenExplicit == 'male')		{ $cGen = 'm'; }
	if($cGenExplicit == 'female')	{ $cGen = 'f'; }


	if(mysqli_num_rows($result) > 0) {#records exist - process

		echo '<div class="" >'; #start images container

		while($row = mysqli_fetch_assoc($result)) {# process each row

			if(!empty($row['Playby']) && ($row['Gender'] == $cGenExplicit)){
				#0. create needed vars
				$cID      = dbOut($row['CharID']);
				$playby   = dbOut($row['Playby']);
				#my google image search of a playby
				#https://www.google.com/search?q=aaron+taylor+johnson
				#https://www.google.com/search?q=aaron+' . $pbGoogle .'
				#replace whitespace, commas, and dashes with plus sign
				$pbGoogle      = preg_replace('/[ ,]+/', '+', trim($playby));
				$pbGoogleURL = "<a href='https://www.google.com/search?q={$pbGoogle}' target='_blank'>{$playby}</a>";

				$cName    = dbOut($row['CodeName']);
				$cNameURL = str_replace(' ', '-', dbOut($row['CodeName']));
				$stageID  = dbOut($row['StatusID']);

				#1. create thumbnail
				#$myImgPath = "../uploads/c{$cID}_thumb.jpg";

				$imgPath = chekImgExists($cID, $cGen, $playby);

				$myImg = "<img class='thumbSM' src='{$imgPath}' alt='{$playby}is
					the playby for {$cName} - {$cID}' />";
				$myPageLink =
					VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
					$cNameURL    . '&id= ' .
					$cID         . '&act=show';


				#2. create image assignments state
				switch ($stageID) {
					case "available":
						$stageID = '<i>temporarily</i> casting <br />casting as';
						break;

					case "assigned":
					case "review":
					case "reserved":
						$stageID = '<i>reserved</i> <br />casting for';
						break;
					case "assigned":
					case "approved":
					case "locked":
						$stageID = '<i>designated</i> casting <br />casting for';
						break;
					default:
						$stageID = 'is currently a <i>placeholder</i> <br />casting for';
					}

				echo "<p >{$myImg} <div><span class='text-info'>{$pbGoogleURL}</span> {$stageID}
					<a href='{$myPageLink}'>{$cName}</a></div></p>
					<div class='clearfix'></div>
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


#showTaken($sql, 'taken', $minNum=2, $maxNum=13, 'female');
function showTaken($searchFor='', $minNum='0', $maxNum='0', $cGenExplicit='', $genderChk='', $equalNum='0', $colLeft='', $colRight='', $str='')
{

	#make sure first letter is uppercased to match SQL Naming convention
	$Gender = ucfirst($cGenExplicit);

	#dumpDie($Gender);

	$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, Playby, Gender, StatusID
			FROM ma_Characters
			WHERE StatusID >= 2 AND Gender = '$Gender' ORDER BY CodeName ASC;";

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0) {#records exist - process

		#changing 'male' to 'm' for shorter query strings elsewhere/consistency
		#changing 'male' to 'm' for shorter query strings elsewhere/consistency
		if($cGenExplicit == '')				{ $cGen = 'm'; }
		if($cGenExplicit == 'male')		{ $cGen = 'm'; }
		if($cGenExplicit == 'female')	{ $cGen = 'f'; }

#	687 Error message: Use of undefined constant cStageID - assumed 'cStageID'

		while($row = mysqli_fetch_assoc($result)) {# process each row
			#chk against gender assigned
			$genderChk =  $row['Gender'];

			$cStageID = $row['StatusID'];

			if(!empty($cStageID)
				 &&
				 ($cGenExplicit = $genderChk)
				 &&
				 ($cStageID >= $minNum) &&
				 ($cStageID <= $maxNum) ||
				 ($cStageID == $equalNum)
				){

				#0. create needed vars
				$cID      		= dbOut($row['CharID']);
				$cName    		= dbOut($row['CodeName']);
				#$gender='';
				#$cGenExplicit	= dbOut($row['Gender']);
				#$cStageID 		= dbOut($row['StatusID']);
				$cPlayby			= dbOut($row['Playby']);

				$google       = preg_replace('/[ ,]+/', '+', trim($cName));
				$gSearch = "<a href='https://www.google.com/search?q=marvel+super-hero+cinematic+universe+{$google}+x-men+avengers' target='_blank'>Google Link for {$cName} here.</a>";

				#0. Check image exists

				#$myImgPath = $cID; #creat path
				$iPath = chekImgExists($cID, $cGen, $cPlayby);           #chek image exists

				#1. create thumbnail
				#$myImgPath = "../uploads/c{$cID}_thumb.jpg";
				$img = "<img class='thumbSM' src='{$iPath}' alt='{$cName} is
					currently {$cStageID} - {$cID}' />";

				#2. create link
				$pLink = '<a href="profile.php?CodeName=' . $cName .
					'&id=' . $cID .
					'&act=show">' . $cName .
					'</a>';

				#3. set the string up for return
				$str .= "<div class='' >
					<p >{$img}
						<div>
							{$pLink}
							<br />
							{$gSearch}
						</div>
					</p>
					<hr />
					</div>";





				/*
				#do we need a switch?

				#2. create image assignments state
				switch ($stageID) {
					case "available":
						$stageID = '<i>temporarily</i> casting <br />casting as';
						break;

					case "assigned":
					case "review":
					case "reserved":
						$stageID = '<i>reserved</i> <br />casting for';
						break;
					case "assigned":
					case "approved":
					case "locked":
						$stageID = '<i>designated</i> casting <br />casting for';
						break;
					default:
						$stageID = 'is currently a <i>placeholder</i> <br />casting for';
					}


				*/






			}#END inner if statement
		} #END while loop
	}#END outer if statement

	return $str;
} #END showTaken function

/**
 * Show Teams -> returns character who are listed on a team, grouped by the teams they are currently on
 * @param str (echoed)
 *
 * @todo -> highlight characters by stage (available, taken, reserved, restricted, et al)
 */
function showTeams($cStage = '', $searchFor = '')
{
	/**
	 * SQL returns characters in groups based on the teams they are on
	 *
	 *
	 */

	$sql = "SELECT  c.CodeName, c.FirstName, c.LastName, c.MiddleName, c.CharID, c.StatusID, c.Gender, c.Playby, #selected from ma_Characters
			g.TeamName  #selected from ma_Groups

			FROM ma_Characters AS c

			LEFT JOIN ma_Characters_Groups AS cg
			ON c.CharID = cg.CharID

			LEFT JOIN ma_Groups AS g
			ON cg.GroupID = g.TeamID

			WHERE g.TeamName IS NOT NULL

			ORDER BY g.TeamName ASC ;
			";


	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(), $sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0) {#records exist - process

		#myVars
		$str   = '';
		$chek  = '';

		while($row = mysqli_fetch_assoc($result)) {# process each row
			if(!empty($row['TeamName'])
				 #example of how to control who shows up in search
				 #This seems odd - should be !='banned'
				 && (($row['StatusID'] != NULL)) || ($row['StatusID'] == 'banned'))
			{
				#0. create needed vars
				$tName    = dbOut($row['TeamName']);
				$cID      = dbOut($row['CharID']);
				$gender   = dbOut($row['Gender']);
				$cName    = dbOut($row['CodeName']);
				$playby   = dbOut($row['Playby']);

				#$myPosition    = dbOut($row['TeamPosition']); #must have default

				#1. create thumbnail
				$iPath = chekImgExists($cID, $gender, $playby);

				#img link
				$iLink = "<img class='thumbSM' src='{$iPath}' alt='Image of {$cName}' /><br />{$cName}";

				#2. create link

				#http://localhost/git250-16q2/marvel-adventures//characters/profile.php?CodeName=ChimaeraX&act=showChimaeraX&id=2

				$pLink = "<div class='pull-left' style='display:block; text-align: left'> &nbsp;
					<a href='profile.php?CodeName={$cName}&act=show&id={$cID}'>{$iLink}</a></div> ";

				#3. sort the results teamname

				#chek if TeamName new
				#it's empty first time, so title/teamname prints
				if ($chek !== $tName){
					#if TeamName new - set new
					$str .= "<br style='clear:both' />
					<h3 style='align:left'> {$tName} </h3>";
					#Save new teamname
					$chek = $tName;
				}

				$str .= $pLink;


			} #END While

			if(isset($str)){
				echo $str;
				$str = ''; #clear out string
			}else{
				echo 'Currently No Teams Set';
			};

		}
		echo '<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matching results <i>{$searchFor}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
	}
} #END Function showTeams

#helper Functions
function chekImgExists($img='', $cGen='', $playby=''){
	$filepath = "../uploads/_assigned/{$img}-1t.jpg";

	#../uploads/_assigned/9-1t.jpg

	#../uploads/_female/Alexa PenaVega/Alexa PenaVega-1.jpg

	$playby = str_replace(' ', '_', strtolower($playby));
	$playby = str_replace('-', '_', strtolower($playby));
	$playby = str_replace("'", '_', strtolower($playby));

	$pbPath   = "../uploads/_{$cGen}/{$playby}/{$playby}-1.jpg";

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
if(isset(dbOut($row['Gender'])))	{$cGen = dbOut($row['Gender']);	}else{ $cGen = '';}
*/


			$cID = $cName = $cStatus = $cPlayby = $cGenExplicit = $cGen = $cDefault = $cLink = $cImg = $pbImg = '';

			$cID   					= dbOut($row['CharID']);
			$cName 					= dbOut($row['CodeName']);
			$cStatus				= dbOut($row['StatusID']);
			$cPlayby  			= dbOut($row['Playby']);
			$cGenExplicit = dbOut($row['Gender']);


			#changing 'male' to 'm' for shorter query strings elsewhere/consistency
			if($cGenExplicit == '')				{ $cGen = 'm'; }
			if($cGenExplicit == 'male')		{ $cGen = 'm'; }
			if($cGenExplicit == 'female')	{ $cGen = 'f'; }


			#if no gender, declare as most characters are likely male
			#if($cGen == ''){$cGen = 'm';}


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
				$pImg   = 'uploads/_' . $cGen . '/' . $cbDir . '/' . $cbDir . '-1.jpg';
				#EX: $sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';
				$sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';


				#if image exists, show
				if (file_exists('./../' . $tImg)) {
					echo '<img class="imgThumbs"  src="./../' . $tImg . '" alt="' . $cName . '" />';

				} elseif(file_exists('./../' . $pImg)) {
						#} elseif(file_exists($cbLnk) {
						#if playby match exists, show

					#uploads/_male//-0.jpg
						echo '<img src="./../' . $pImg . '" class="imgThumbs" alt="' . $cName . '" />';

				} else {
					#no image show me random static image (6 possible returns)
					echo '<img class="imgThumbs" src="' . $sImg . '" alt="' . $cName . '"  />';


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
			echo "<h3 class='text-center' style='border-bottom:solid 1px silver;'>No matches found.</h3>";
	} #END PROFILES SEARCH

	@mysqli_free_result($result);

}#END showRandom

function searchForm($newToken){
	$str='';
	/*
		<p >{$myImg} <div><span class='text-info'>{$pbGoogleURL}</span> {$stageID}
			<a href='{$myPageLink}'>{$cName}</a></div></p>
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


	#http://localhost/WrDKv4/characters/index.php?act=ShowPlayby


$str .='<form class="text-center" action="' . VIRTUAL_PATH . 'characters/index.php" method="get" ><!-- SET form-->
		<img
			src="./../_img/_jarvis/_jarvis-053.png"
			class="pull-center"
			style="height:150px;"
			alt="jarvis search!" />
		<br />
		<br />


		<div class="form-group">
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowPlayby" class="btn btn-primary btn-block-levl btn-sm "
				style="background: #fff; border: 	1px solid #ccc; color: #aaa; min-width: 170px;"
				role="button">Taken/Reserved Playbys</a>
		</div>

		<div class="form-group">
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=m" class="btn btn-primary  btn-block-levl btn-sm "
				style="background: #fff; border: 	1px solid #ccc; color: #aaa; min-width: 170px;"
				role="button">Open Male Playbys</a>
		</div>

		<div class="form-group">
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=f" class="btn btn-primary  btn-block-levl btn-sm "
				style="background: #fff; border: 	1px solid #ccc; color: #aaa; min-width: 170px;"
				role="button">Open female Playbys</a>
		</div>

		<hr />

		<div class="form-group">
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowTaken" class="btn btn-primary  btn-block-levl btn-sm "
				style="background: #fff; border: 	1px solid #ccc; color: #aaa; min-width: 170px;"
				role="button">Taken/Reserved Characters</a>
		</div>

		<hr />

		<div class="form-group">
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowTeams" class="btn btn-primary  btn-block-levl btn-sm "
				style="background: #fff; border: 	1px solid #ccc; color: #aaa; min-width: 170px;"
				role="button">Current Team Rosters</a>
		</div>

		<hr />

		<div class="form-group">
			<input type="text"  name="cCe" value="' . $cName .'"
				placeholder="Search by codename" />
		</div>


	<!--
		<div class="form-group">
			<input type="text"  name="rNe" value="' . $regName .'"
				placeholder="Search by character" />
		</div>

		<div class="form-group">
			<input type="text"  name="cTe" value="' . $cType .'"
				placeholder="Search by type" />
		</div>
	-->

		<div class="form-group">
			<input type="text"  name="cTm" value="' . $cTeam .'"
				placeholder="Search by team" />
		</div>

		<div class="form-group">
			<input type="text"  name="cPB" value="' . $cPlayby .'"
				placeholder="Search by playby" />
		</div>

		<br/>
		<input type="hidden" name="token" value="' . $newToken .'" />

		<input class="pull-right" type="submit" value="submit" />

	</form><!--END form-->';

	return $str;
}

function searchResult($sql, $count=0, $str=''){
	#build search result based on query returns
	$cName = $cID = $regName = $cType = $cTeam = $cPlayby = '';

	#character codename
	if( (isset($_GET['cCe'])) && (($_GET['cCe']) != '') )
	{
		$cName 	= htmlspecialchars(trim($_GET['cCe']), ENT_QUOTES, "UTF-8");

		#update SQL
		$sql = "SELECT CharID, CodeName, FirstName, LastName, MiddleName, StatusID, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cName%'";

		#use updated SQL
		genTiles($sql, $count);

        $str.= '<hr />
			<a href="' . VIRTUAL_PATH . 'characters/index.php" class="btn btn-default btn-xs" role="button">reset link</a>
			<a href="' . VIRTUAL_PATH . 'characters/index.php" class="btn btn-default btn-xs pull-right" role="button">see more</a>';

		// if we have duplicates count them
		$count++;
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
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowPlayby" class="btn btn-default btn-xs" role="button">See Taken</a>
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=male" class="btn btn-default btn-xs" role="button" >Unclaimed Males</a>
			<a href="' . VIRTUAL_PATH . 'characters/index.php?act=female" class="btn btn-default btn-xs" role="button">Unclaimed Females</a>
		</div>';
	}

	// IF EMPTY - SHOW GENERIC RESULT
	if(($cName == '') && ($cTeam == '') && ($cPlayby == '')) {
		showRandom($sql);
	}

}

function genCharTiles($sql, $count=0, $str=''){
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0)
	{#records exist - process

		$str .= '<div align="center" style="margin: 5px;" >'; #start images container
		while($row = mysqli_fetch_assoc($result))
		{# process each row

			#$cID = $cName = $cStatus = $cPlayby = $cGen = $cDefault = $cLink = $cImg = $pbImg = '';
			$cID   		= dbOut($row['CharID']);
			$cName 		= dbOut($row['CodeName']);
			$cStatus	= dbOut($row['StatusID']);
			$cPlayby  = dbOut($row['Playby']);
			$cGen  = dbOut($row['Gender']);

			#if no gender, declare as most characters are likely male
			if($cGen == ''){$cGen = 'male';}

			#creat image link to character
			$str .= '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
				#strip white spaces out of code name for url
				str_replace(' ', '-', $cName) . '&id=' . $cID  . '&act=show">

				<div class="divThumbs">';

				$tImg   = 'uploads/' . $cID  . '-0.jpg';
				$cbDir  = strtolower(str_replace(' ', '_', $cPlayby));
				$pImg   = 'uploads/_' . $cGen . '/' . $cbDir . '/' . $cbDir . '-1.jpg';
				$sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';

				#if image exists, show
				if (file_exists('./../' . $tImg)) {
					$str .= '<img class="imgThumbs"  src="./../' . $tImg . '" alt="' . $cName . '" />';

				} elseif(file_exists('./../' . $pImg)) {
					#if playby match exists, show

					#uploads/_male//-1.jpg
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


/**
 * if we have only one match, forward us to matching character profile
 *
 * @param $sql
 * @param string $str
 */
function charRedirect($sql, $str=''){
    $result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

    if(mysqli_num_rows($result) > 0)
    {#records exist - process
        // NO html start
        while($row = mysqli_fetch_assoc($result))
        {# process each row

            $cID   		= dbOut($row['CharID']);
            $cName 		= dbOut($row['CodeName']);

           # http://localhost/WrDKv4/characters/profile.php?CodeName=Cyclops&id=1&act=show

            $str = VIRTUAL_PATH . 'haracters/profile.php?CodeName=' . $cName . '&id=' . $cID . '&act=show';

        }
        // NO html end
    }
    myRedirect($str);

}


/**
 * generate result based on search params given
 *
 * @param $sql
 * @param string $count
 * @param string $cName
 * @param string $regName
 * @param string $cTeam
 * @param string $cType
 * @param string $cPlayby
 * @param string $str
 * @return string
 */
function genTiles($sql, $count='', $cName='', $regName='', $cTeam='', $cType='', $cPlayby='', $str='' ){
		#produce a title match for values given for jarvis/cerebra/cerebro/shield database et al.

    // if only one result, send us to character profile
    if($count > 1){ //send us to character profile as we have only one match
        $sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cName%';";
        #http://localhost/WrDKv4/characters/profile.php?CodeName=Cyclops&id=1&act=show
        $str .= charRedirect($sql);

        //return $str;
    }


    //if multiple results, chek params and respond ac
	if($cName){ //show random results

		$str .= "<h3>All known existing matches for {$cName}</h3>";
		$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters WHERE CodeName LIKE '%$cName%';";

		$str .= genCharTiles($sql);

		return $str;

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
} #END Function showTeam



###################     HEP FUNCTIONS -> Playbys Random     ################
#scan directory - generate subdirectory list for random playby list
function playbyTiles($parentDir, $gender='', $subDirPath='', $str=''){
	//css
	//http://alt-web.com/TUTORIALS/?id=bootstrap_modal_carousel_gallery

	$parentDir = "./../{$parentDir}/_{$gender}/";
	//get all files in specified directory
	$dir = glob($parentDir . "*");
	//print each file name
	foreach($dir as $subDir)
	{
		//check to see if the file is a folder/directory
		if(is_dir($subDir))
		{







			$pbName = str_replace('./../uploads/_' . $gender . '/', '', $subDir);
			$pbTitle = str_replace('./../uploads/_' . $gender . '/', '', $subDir);
			$pbTitle = str_replace('_', ' ', $pbTitle);
			$pbTitle = ucwords($pbTitle);

			/* merged modal and carousel without use of javascript */

			#http://localhost/WrDKv3/uploads/viewPlayby.php?act=show&gender=male&img=Kellan_Lutz---eBl+hBl

			#https://codepen.io/krnlde/pen/pGijB

			#make modal pop up carousels! for each image - neat huh?

			#creat image link to character
			/*
			 * THIS IS THE ORIGINA CODE
			 * BELOW IS TEMPORARY PATCH

			$str .= '<a href="' . VIRTUAL_PATH  . 'characters/index.php?act=playby&gen=' . $gender . '&playby=' . $pbName . '">
				<div class="divThumbs text-center">
					<img class="imgThumbs"  src="' . $subDir  . '/' . $pbName . '-1.jpg" alt="' . $pbTitle . '" />
					<br />
				' . $pbTitle . '<br /></div>
			</a>'; #close image
			*/


			# above creates -> characters/index.php?act=playby&gen=m&playby=aaron_diaz
			# below creates -> uploads/viewPlayby.php?act=show&gender=m&img=aaron_diaz


			#temp fix revision

			$str .= '<a href="' . VIRTUAL_PATH  . 'uploads/viewPlayby.php?act=show&gender=' . $gender . '&img=' . $pbName . '">
				<div class="divThumbs text-center">
					<img class="imgThumbs"  src="' . $subDir  . '/' . $pbName . '-1.jpg" alt="' . $pbTitle . '" />
					<br />
				' . $pbTitle . '<br /></div>
			</a>'; #close image



		}
	}
	return $str;
}




function modalGallery(){


	$str___my___gallery = '';
	$str___my___gallery .= '


<button class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
		 <img class="img-responsive" src="http://placehold.it/1200x600/555/000&text=One" alt="...">
			<div class="carousel-caption">
				One Image
			</div>
		</div>
		<div class="item">
			<img class="img-responsive" src="http://placehold.it/1200x600/fffccc/000&text=Two" alt="...">
			<div class="carousel-caption">
				Another Image
			</div>
		</div>
		 <div class="item">
			<img class="img-responsive" src="http://placehold.it/1200x600/fcf00c/000&text=Three" alt="...">
			<div class="carousel-caption">
				Another Image
			</div>
		</div>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>
		</div>
	</div>
</div>
';
	}
