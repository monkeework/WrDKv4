<?php // maps currently too profile-rdSTAT.php
require '../_inc/config_inc.php';



$config->loadhead=''; #load page specific JS


function maxDoc_characters_profile(){
/**
 * profile.php based view.php, display character attributes
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seelist.php
 *
 * @todo edit peekaboo edit character link
 *	  cheks char assigned/is mod+
 *		show edit option
 *
 * @todo add back button
 */

 # '../' works for a sub-folder.  use './' for the root
}

$pageDeets = '<ol>
	<li> Add word counters for limited text areas</li>
	<li> unique skills not in list</i>
	<li> -thumbnail will display most current character mood /post association?</li>
	<li> REWORK weight - in pounds, convert to tons</li>

	<li> add classes</li>

	<!--
		<ul>
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



	#id - series - suffix
	#THUMB   2-000t.jpg    teddy thumbnail
	#GALLY 	 2-002.jpg       teddy gallery
	#PROFL   2-001.jpg     teddy profile/featured image/emoji
	#HEADR   2-000.jpg     teddy header/background


#config for image uploads
$title = "Image Upload";

#declare file size max (100000 = 100K)
$sizeBytes = 100000; # bytes max file size

#If true, will create thumbnail in same upload directory
#Pass as a string, so can be placed in hidden form field
$createThumb = "TRUE";

#Declared width of thumbnail
#Height calculated from there
$thumbWidth = 50; #thumb

$gallyWidth='';  #gallery
$proflwidth = 170; #profile
$headrwidth = 940; #header

#Declared suffix of thumbnail.
#if use '_thumb', and image prefix is 'm', file name would be: m1_thumb.jpg
$thumbSuffix = "t";

#Folder for upload.
$uploadFolder = "uploads/"; # Physical path added to uploadFolder info in upload_execute.php

#unique prefix to add to your image name.
#$imagePrefix = "m";

$thumbPrefix = 't'; #thumb    2-002t.jpg
$gallyPrefix=''; #gallery   2-2.jpg to 2-003+ to infinity and beyond
$proflPrefix=''; #gallery   2-001.jpg
$headrPrefix=''; #gallery   2-000.jpg  triple naught

#image extension - currently only supporting .jpg - see upload_execute.php
$extension = ".jpg";
#end config for image uploads




# check variable - if invalid redirect to index
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#data must be on querystring
	 $cID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
	myRedirect(VIRTUAL_PATH . "characters/index.php");
}

######################  SQL QUERY 1  ########################
#Aliased FirstName from user table to avoid data conflation/collisions
#u.UserID AS HandlerID,
$sql = "SELECT u.UserName AS PlayerName,

c.CharID, c.UserID, c.CodeName, c.LastName, c.FirstName, c.MiddleName, c.NickName, c.Alias, c.StatusID, c.IdentityID, c.OCFC, c.Playby, c.Gender, c.CharHtFt, c.CharHtIn, c.CharWt0000, c.CharWt000, c.CharWt00, c.CharWt0, c.HairColor, c.EyeColor, c.DOByear, c.DOBmonth, c.DOBday, c.AgeActual, c.AgeApparent, c.Distinquishment, c.Appearance, c.Quote, c.ThemeSong, c.ThemeSongLink, c.Citizenship, c.LegalStatus, c.PlaceOfBirth, c.Affliation, c.Relationship, c.Education,  c.Waiver, c.Concept, c.Orientation, c.Demeanor,  c.Nature, c.Personality, c.Goal, c.Team, c.TeamPosition, c.Classification, c.PowerSource, c.RankPower, c.RankFighting, c.RankAgility, c.RankStrength, c.RankEndurance, c.RankReason, c.RankIntuition, c.RankPsyche, c.RankAsset, c.RankExpertise, c.Power, c.PowerDesc, c.SkillLevel, c.Aptitude, c.Merit, c.Flaw, c.Uniform, c.UniformSpecs, c.Resource, c.Equipment, c.Transportation, c.Contact, c.Relative, c.Allies, c.Rivals, c.History, c.NumReviews, c.Reviewer, c.Rrd1, c.Rrd2,  c.Rrd3, c.DevelopmentTime, c.DateCreated, c.DateAssigned, c.LastUpdated

#ALIASING FOR coming joins
#FROM ma_Characters AS c INNER JOIN
FROM ma_Characters AS c LEFT JOIN
ma_Users           AS u ON

#FILTER DATA NEED
c.UserID = u.UserID
WHERE c.CharID = " . $cID;

$foundRecord = FALSE; # Will change to true, if record found!

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0){#records exist - process
	$foundRecord = TRUE;

	while ($row 	= mysqli_fetch_assoc($result)) {
		$CharID 		= dbOut($row['CharID']);
		$pName = dbOut($row['PlayerName']);

		#$HandlerID = dbOut($row['HandlerID']);

		#added user id here...
		$HandlerUserID  			= dbOut($row['UserID']);
		$cName  						= dbOut($row['CodeName']);
		$StatusID  						= dbOut($row['StatusID']);

		$LastName  						= dbOut($row['LastName']);
		$FirstName 						= dbOut($row['FirstName']);
		$MiddleName 					= dbOut($row['MiddleName']);
		$NickName 						= dbOut($row['NickName']);
		$Alias 								= dbOut($row['Alias']);
		$FullName 						= $LastName . ', ' . $FirstName . ', ' . $MiddleName;

		#$StatusID 						= dbOut($row['StatusID']);
		$IdentityID 					= dbOut($row['IdentityID']);
		$OCFC 								= dbOut($row['OCFC']);
		$Playby 							= dbOut($row['Playby']);
		$Gender 							= dbOut($row['Gender']);

		$CharHtFt 						= dbOut($row['CharHtFt']);
		$CharHtIn 						= dbOut($row['CharHtIn']);

		$CharWt0000 					= dbOut($row['CharWt0000']);
		$CharWt000 						= dbOut($row['CharWt000']);
		$CharWt00 						= dbOut($row['CharWt00']);
		$CharWt0 							= dbOut($row['CharWt0']);

		$HairColor 						= dbOut($row['HairColor']);
		$EyeColor 						= dbOut($row['EyeColor']);



		$DOBday								= dbOut($row['DOBday']);
		$DOBmonth							= dbOut($row['DOBmonth']);
		$DOByear							= dbOut($row['DOByear']);



		$AgeActual						= dbOut($row['AgeActual']);
		$AgeApparent					= dbOut($row['AgeApparent']);
		$Distinquishment 			= dbOut($row['Distinquishment']);
		$Appearance 					= dbOut($row['Appearance']);

		$Quote 								= dbOut($row['Quote']);
		$ThemeSong 						= dbOut($row['ThemeSong']);
		$ThemeSongLink 				= dbOut($row['ThemeSongLink']);
		$Waiver 							= dbOut($row['Waiver']);

		$Citizenship 					= dbOut($row['Citizenship']);
		$LegalStatus 					= dbOut($row['LegalStatus']);
		$PlaceOfBirth 				= dbOut($row['PlaceOfBirth']);
		$Affliation 					= dbOut($row['Affliation']);
		$Relationship 				= dbOut($row['Relationship']);
		$Education 						= dbOut($row['Education']);
		$Concept 							= dbOut($row['Concept']);
		$Orientation 					= dbOut($row['Orientation']);
		$Demeanor 						= dbOut($row['Demeanor']);
		$Nature 							= dbOut($row['Nature']);
		$Personality 					= dbOut($row['Personality']);
		$Goal 								= dbOut($row['Goal']);

		$Team 								= dbOut($row['Team']);
		$TeamPosition 				= dbOut($row['TeamPosition']);
		$Classification 			= dbOut($row['Classification']);
		$PowerSource 					= dbOut($row['PowerSource']);

		$RankFighting 				= dbOut($row['RankFighting']);
		$RankAgility 					= dbOut($row['RankAgility']);
		$RankStrength 				= dbOut($row['RankStrength']);
		$RankEndurance 				= dbOut($row['RankEndurance']);

		$RankReason 					= dbOut($row['RankReason']);
		$RankIntuition 				= dbOut($row['RankIntuition']);
		$RankPsyche 					= dbOut($row['RankPsyche']);

		$RankAsset 						= dbOut($row['RankAsset']);
		$RankExpertise 				= dbOut($row['RankExpertise']);

		$RankPower 						= dbOut($row['RankPower']);

		$Power 								= dbOut($row['Power']);
		$PowerDesc 						= dbOut($row['PowerDesc']);
		$SkillLevel 					= dbOut($row['SkillLevel']);
		$Aptitude 						= dbOut($row['Aptitude']);
		$Merit 								= dbOut($row['Merit']);
		$Flaw 								= dbOut($row['Flaw']);
		$Uniform 							= dbOut($row['Uniform']);
		$UniformSpecs 				= dbOut($row['UniformSpecs']);
		$Resource 						= dbOut($row['Resource']);
		$Equipment 						= dbOut($row['Equipment']);
		$Transportation 			= dbOut($row['Transportation']);
		$Contact 							= dbOut($row['Contact']);
		$Relative 						= dbOut($row['Relative']);
		$Allies 							= dbOut($row['Allies']);
		$Rivals 							= dbOut($row['Rivals']);

		$History 							= dbOut($row['History']);

		$NumReviews 					= dbOut($row['NumReviews']);
		#	c.Reviewer, c.Rrd1, c.Rrd2, c.Rrd3
		$Reviewer 						= dbOut($row['Reviewer']);
		#$ReviewInstruct 			= dbOut($row['ReviewInstruct']);
		$Rrd1 								= dbOut($row['Rrd1']);
		$Rrd2 								= dbOut($row['Rrd2']);
		$Rrd3 								= dbOut($row['Rrd3']);


		$DevelopmentTime 			= dbOut($row['DevelopmentTime']);
		$DateCreated 					= dbOut($row['DateCreated']);
		$DateAssigned 				= dbOut($row['DateAssigned']);

		#$MetaDescription = dbOut($row['MetaDescription']);
		#$MetaKeywords = dbOut($row['MetaKeywords']);
	}
}

@mysqli_free_result($result); # We're done with the data!

//---end config area ---------------------

include INCLUDE_PATH . 'aarContent-inc.php';

if($foundRecord){#only load data if record found
	$config->titleTag = $cName . " | " . ucfirst($Team); #overwrite PageTitle with character info!
	#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
	#$config->metaDescription = $MetaDescription . ' Seattle Central\'s ITC280 Class Muffins are made with pure PHP! ' . $config->metaDescription;
	#$config->metaKeywords = $MetaKeywords . ',Muffins,PHP,Fun,Bran,Regular,Regular Expressions,'. $config->metaKeywords;
}

$config->metaDescription = 'Marvel Champions Character Profile for ' . $cName; #Fills <meta> tags.
$config->metaKeywords = $cName . ', ' . $FirstName . ' ' . $LastName . ', ' . $config->metaKeywords;

# END CONFIG AREA ---------------------------------------

get_header(); #defaults to theme header or header_inc.php
#echo MaxNotes($pageDeets); #set in theme

// Incase act is somehow unset, send user back to view (shoW)
if(!isset($_REQUEST['act'])){$_REQUEST = ['act'=> 'show'];}
// Read 'act' value, if it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}


//Get header element after myAction processed to determine if we show button or not.
getJumbotron($cID, $cName, $Playby, $Gender);


switch ($myAction)
{//check 'act' for type of process
	case "show": #Show Character Profile!
		if($foundRecord) {#records exist - show character!
		#If user is logged - show edit button

		#character identifiers
		#charStage($title, $FullName, $PlayerName, $StatusID, $aarStatus)
		echo charStage($FullName, $pName, $StatusID, $aarStatus); #shows player/abailability, et all.

		echo showStrValue('alias', $Alias);
		echo showStrValue('nicknames', $NickName);
		echo showStrValue('identity is', $IdentityID);
		echo showStrValue('char type', $OCFC);

		#appearance
		if(!empty($Playby) || $HairColor != 0 || $EyeColor != 0 ||
			($CharHtFt != 0) || ($CharHtIn != 0) ||
			($CharWt000 != 0) || ($CharWt00 != 0)  || ($CharWt0 != 0) ||
			!empty($Distinquishment) || !empty($Appearance) || !empty($Uniform)
		){
			echo charLabel('appearance');

			echo showStrValue('playby', $Playby);

			if(($CharHtFt != 0) || ($CharHtIn != 0) || ($CharWt000 != 0) || ($CharWt00 != 0)  || ($CharWt0 != 0)){
				# IF hieght or weight exists, show me

				echo '<div class="row hoverHighlight">
				<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>Measurements:</strong></p></div>
					<div class="col-sm-7"><p>
						<strong>H:</strong> ' . $CharHtFt . '&ldquo;  ' . $CharHtIn . '&lsquo;   <span class="text-muted"> | </span>
						<strong>W:</strong> ' . $CharWt000 .  $CharWt00 . $CharWt0 . ' lbs.
						</p>
					</div>
				</div>';
			}


			if($HairColor > 0){echo showArrValue('hair color', $aarHair[$HairColor]);}
			if($EyeColor  > 0){echo showArrValue('eye color', $aarEye[$EyeColor]);}
			if(isset($Distinquishment)){echo showStrValue('features', $Distinquishment);}
			if(isset($Distinquishment)){echo showStrValue('appearance', $Appearance);}
			if(isset($Distinquishment)){echo showStrValue('uniform', $Uniform);}
		}

		#personality
		if(!empty($Quote) || !empty($Waiver) || !empty($Orientation) ||
			!empty($Demeanor) || !empty($Nature) || !empty($Personality)
		){
			echo charLabel('personality');

			echo showStrValue('quote', $Quote);

			if ($ThemeSong){
				#IF Themesong exists, show data
				echo showStrValue('theme song', '<a href="' . $ThemeSongLink . ' target="_blank" >'. $ThemeSong . ' </a>');
			}

			echo showIntValue('waiver', $Waiver, $aarWaiver);
			echo showStrValue('concept', $Concept);
			echo showStrValue('orientation', $Orientation, $aarOrientation);
			echo showStrDesc('demeanor', $Demeanor, $aarTraitDesc, $Gender, $cName);
			echo showStrDesc('nature', $Nature, $aarTraitDesc, $Gender, $cName);

			echo showStrValue('personality', $Personality);
		}

		#legal/clerical
		# #yes - three vars shoved into one - yippee!
			#datat entered as day - month - year
			#wa change it to year - month - day - easier to computer with datatime
			$dob = $DOByear . '-' . $DOBmonth . '-' . $DOBday;

		if(!empty($Citizenship) || !empty($LegalStatus) ||
			!empty($dob) || !empty($AgeApparent) ||
			!empty($PlaceOfBirth) ||!empty($Education)
		){
			echo charLabel('legal');

			echo showStrValue('citizenship', $Citizenship, $aarCountryName);
			echo showStrValue('legal status', $LegalStatus, $aarLegal);

#var_dump($dob);
			#DOB = 1978-23-9

			echo showAge('date of birth', $dob, $AgeApparent, $DOByear, $DOBmonth, $DOBday);
			echo showStrValue('place of birth', $PlaceOfBirth);
			echo showStrValue('education', $Education, $aarEducation);
		}

		#team/group
		if(!empty($Team)){
			echo charLabel('group');

			echo showStrValue('team', $Team);
			echo showStrValue('team position', $TeamPosition);
		}

		#Abilities
		if( !empty($Classification) || !empty($PowerSource) ||!empty($RankPower) ||
			!empty($RankFighting) || !empty($RankAgility) ||!empty($RankStrength) ||
			!empty($RankEndurance) || !empty($RankReason) ||!empty($RankIntuition) ||
			!empty($RankPsyche) || !empty($RankExpertise) ||!empty($RankAsset) ||
			!empty($SkillLevel) || !empty($PowerDesc) || !empty($Aptitude) ||
			!empty($Merit) || !empty($Flaw))
		{
			echo charLabel('abilities');

			echo showStrValue('classification', $Classification, $aarClassification);
			echo showStrValue('power source', $PowerSource, $aarPowSource);

			#function in a fuction
			echo showStrValue('power rank', mk_stat($RankPower, $aarRank) );

			echo showStrValue('Stats', '<a href="#" title="" >Fi:</a> ' . mk_stat($RankFighting, $aarRank) .
												'<span class="text-muted"> |</span> <a href="#" title="" >Ag:</a> ' .  mk_stat($RankAgility, $aarRank) .
												'<span class="text-muted"> |</span> <a href="#" title="" >St:</a> ' .  mk_stat($RankStrength, $aarRank) .
												'<span class="text-muted"> |</span> <a href="#" title="" >En:</a> ' .  mk_stat($RankEndurance, $aarRank) .
												'<span class="text-muted"> |</span> <a href="#" title="" >Re:</a> ' .  mk_stat($RankReason, $aarRank) .
												'<span class="text-muted"> |</span> <a href="#" title="" >In:</a> ' .  mk_stat($RankIntuition, $aarRank) .
												'<span class="text-muted"> |</span> <a href="#" title="" >Ps:</a> ' .  mk_stat($RankPsyche, $aarRank)
											 );

			echo showStrValue('expertise',     $RankExpertise,  $aarExpertise);
			echo showStrValue('assets',        $RankAsset,      $aarAsset);
			echo showStrValue('savey',         $SkillLevel,     $aarExpertise);

			echo showStrValue('powers overview', $Power);

			echo showStrValue('power description', $PowerDesc);

			echo showStrValue('aptitude', $Aptitude);
			echo showStrValue('merit', $Merit);
			echo showStrValue('flaw', $Flaw);
		}


		#collateral
		if(
			!empty($Equipment) || !empty($Resource) ||!empty($Transportation) || !empty($Uniform) || !empty($UniformSpecs)
		){
			echo charLabel('collateral');

			echo showStrValue('equipment', $Equipment);
			echo showStrValue('resource', $Resource);
			echo showStrValue('transportation', $Transportation);
			echo showStrValue('uniform', $Uniform);
			echo showStrValue('uniformSpecs', $UniformSpecs);
		}


		#contacts
		if(
			!empty($Affliation) || !empty($Allies) ||!empty($Contact) ||
			!empty($Relative) || !empty($Rivals)
		){
			echo charLabel('Affiliates');

			#get names and ids of all chars to use in following...
			$arr_cNames = mk_cNameLnks();

			echo showStrValue('affliation', $Affliation);
			echo show_StrVal('allies', $Allies, $arr_cNames);

			echo show_StrVal('contacts', $Contact, $arr_cNames);
			echo show_StrVal('relationship', $Relationship, $arr_cNames);
			echo show_StrVal('relatives', $Relative, $arr_cNames);
			echo show_StrVal('rivals', $Rivals, $arr_cNames);
		} #END CONTACTS


		#history
		if(!empty($History)){
			echo charLabel('history');

			echo showStrValue('character history', $History);
		}

	}

break; #END SHOW
	############################################################################
	#########################    END   SHOW    #################################
	############################################################################
	case "edit": //2) show first name change for
		chekPrivies(2); #member+

		if($foundRecord) {#records exist - lets edit the data!

			#some path variables to make code less unweildly
			$pathLibraryIndex = '<a href="' . VIRTUAL_PATH
				. '/library/index.php?CodeName='
				. $cName . '&CharID='
				. $CharID . '&' ;

#dumpDie($_SESSION);

$path_cDetails='?charID=' . $CharID .
	'&codeName='	. $cName .
	'&gender='		.	$Gender .
	'&statusID='	. $_SESSION['Privilege'];

			#http://localhost/WrDKv3/library/char_powers.php?act=defensive-powers&CodeName=Chimaera&id=2&gender=m
			$path_charPowerOverview = '<a href="'
				. VIRTUAL_PATH . 'library/char_powers.php'
				. $path_cDetails . '" target="_blank" >Power Overview</a>' ;

			$path_charPowers = '<a href="' . VIRTUAL_PATH
				. 'library/char_powers.php'
				. $path_cDetails . '" target="_blank" >Powers</a>' ;

			$path_charAptitudes = '<a href="' . VIRTUAL_PATH
				. 'library/char_aptitudes.php'
				. $path_cDetails . '" target="_blank" >Aptitudes</a>' ;

			$path_charMerits = '<a href="' . VIRTUAL_PATH
				. 'library/char_advantages.php'
				. $path_cDetails . '" target="_blank" >Merits</a>' ;

			$path_charFlaws = '<a href="' . VIRTUAL_PATH
				. 'library/char_disadvantages.php'
				. $path_cDetails . '" target="_blank" >Flaws</a>' ;

			$path_charEquipment = '<a href="' . VIRTUAL_PATH
				. 'library/char_equipment.php'
				. $path_cDetails . '" target="_blank" >Equipment</a>' ;

			$path_charResources = '<a href="' . VIRTUAL_PATH
				. 'library/char_resources.php'
				. $path_cDetails . '" target="_blank" >Resources</a>' ;

			$pathLibPowers = 'library/powers.php';
			include './../_inc/aarContent-inc.php';

			echo '<style> form div.row {margin-bottom: 5px;} </style>';

			echo '<form
				action="profileUpdate.php?act=update&id=' . $cID . '" id="myForm" method="post">';


echo '<br /><br />';


echo '<div class="panel-group" id="accordion">

	 <!-- BEGIN A -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseA" style="color: #008cba"><b>OVERVIEW</b> &mdash; <i>What to do...</i></a>
					<p class="pull-right"><small>';
						#When did we start...
						if(isset($DateAssigned)){
						echo 'Date Assigned: ' . date("F jS, Y", strtotime($DateAssigned));
						}else{
							echo 'Date created: '  . date("F jS, Y", strtotime($DateCreated));
						}
					echo '</small>
					</p>
				</h5>
			</div>
			<div id="collapseA" class="panel-collapse collapse in">
				<div class="panel-body">
					' . customizeData($aarProfile['charCreation-overview'], $Gender, $cName) . '
				</div>
			</div>
		</div>';


if($Rrd1 != NULL){
	echo '<!-- BEGIN Rrd1-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseB" style="color: #008cba"><b >Comments</b> &mdash; <i>First Review</i></a>
					<p class="pull-right"><small>

					Approvals: ? / 3 (14 Days Left)</small></p>

				</h5>
			</div>
			<div id="collapseB" class="panel-collapse collapse">
				<div class="panel-body">
					'. $Rrd1 . '<input type="hidden" name="CharID" value="' . $Rrd1 . '" />';

					echo '<p style="width: 95%; margin: auto 1em">' . $Rrd1 . '<br /><br /></p>';

					 #we wamt to append this sucker!
						if($_SESSION['Privilege'] > 3){
							echo '<div  class="form-group">
								<textarea
									style="width: 95%; margin: auto 1em"
									name="Rrd1"
									value="Rrd1"
									rows="3"
									data-min-rows="3"
									placeholder="Reviewer Comments or Handler replies here..."
									/></textarea>
								</div>';
							}
		echo '<!-- end slipsum code -->
					<p class="pull-right> <a href="#" style="margin: 10px;"> <i>Contact Reviewer </i></a></p>
				</div>
			</div>
		</div>';
	}


if($Rrd2 != NULL){
	echo '<!-- BEGIN Rrd2-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseC" style="color: #008cba"><b>Comments</b> &mdash; <i>Second Review</i></a>' . listApprovals() . '
				</h5>
			</div>
			<div id="collapseC" class="panel-collapse collapse">
				<div class="panel-body">
					'. $Rrd2 . '<input type="hidden" name="CharID" value="' . $Rrd1 . '" />';

					echo '<p style="width: 95%; margin: auto 1em">' . $Rrd1 . '<br /><br /></p>';

					 #we wamt to append this sucker!
						if($_SESSION['Privilege'] > 3){
							echo '<div  class="form-group">
								<textarea
									style="width: 95%; margin: auto 1em"
									name="Rrd2"
									value="Rrd2"
									rows="3"
									data-min-rows="3"
									placeholder="Reviewer Comments or Handler replies here..."
									/></textarea>
								</div>';
							}
		echo '<!-- end slipsum code -->
					<p class="pull-right> <a href="#" style="margin: 10px;"> <i>Contact Reviewer </i></a></p>
				</div>
			</div>
		</div>';
	}


if($Rrd3 != NULL){
	echo '<!-- BEGIN DDDD-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseD"  style="color: #008cba"><b>Comments</b> &mdash; <i>Final Review</i></a>' . listApprovals() . '
				</h5>
			</div>
			<div id="collapseD" class="panel-collapse collapse">
				<div class="panel-body">
					'. $Rrd3 . '<input type="hidden" name="CharID" value="' . $Rrd3 . '" />';

					echo '<p style="width: 95%; margin: auto 1em">' . $Rrd3 . '<br /><br /></p>';

					 #we wamt to append this sucker!
						if($_SESSION['Privilege'] > 3){
							echo '<div  class="form-group">
								<textarea
									style="width: 95%; margin: auto 1em"
									name="Rrd3"
									value="Rrd3"
									rows="3"
									data-min-rows="3"
									placeholder="Reviewer Comments or Handler replies here..."
									/></textarea>
								</div>';
							}
		echo '<!-- end slipsum code -->
					<p class="pull-right>
						<a href="#" style="margin: 10px;"> <i>Contact Reviewer </i></a>
					</p>
				</div>
			</div>
		</div>';
	}




	echo '</div>
	<br /><br />';
	#close up comments

#instructions to help handlers build characters correctly.
echo showInstructions('Start', 'Getting Started &mdash; Images', $aarProfile['charCreation-images']);
echo '<br />';

#section 1 - General Descriptors
#echo charLabel('Images');


			$returnPage = "profile.php?id={$cID}&act=edit";

			echo '<div><div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>Header: </strong></p></div>

					<div class="col-sm-7"><a href="./profileUpload.php?'
						. $_SERVER['QUERY_STRING']
						. '&type=h&img=' . $CharID . '-0&returnPage='
						. $returnPage
						. '" class="btn btn-info" role="button"> '
						. btnProfileImg($CharID, 0)
						. '</a></div>
					<div class="clearfix"></div>
					<br />
				</div>';

			echo '
				<div >
					<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>Image Gallery: </strong></p></div>
					<div class="col-sm-7">' . galleryMaker($CharID, $returnPage) . '</div><div class="clearfix"></div>
					<br />
				</div>

				<div >
		<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>Profile: </strong></p></div>

		<div class="col-sm-7">
			<a href="./profileUpload.php?'
				. $_SERVER['QUERY_STRING']
				. '&type=p&img=' . $CharID . '-1&returnPage='
				. $returnPage
				. '&createThumb=TRUE"
				class="btn btn-info" role="button">'
				. btnProfileImg($CharID, 1) . '</a>';



			if(isset($_GET['msg'])){# msg on querystring implies we're back from uploading new image
				$msgSeconds = (int)$_GET['msg'];
				$currSeconds = time();
				if(($msgSeconds + 2)> $currSeconds)
				{//link only visible once, due to time comparison of qstring data to current timestamp
					echo '<br /><div class=""><script type="text/javascript">';
					echo 'document.write("<form><input type=button value=\'IMAGE UPLOADED! CLICK TO VIEW!\' onClick=history.go()></form>")</scr';
					echo 'ipt></div>';
				}
			}

		echo '</div>
		<div class="clearfix"></div>
		<br />
	</div>';


echo showInstructions('Gen', 'General Descriptions', $aarProfile['charCreation-general']);
echo '<br />';
#section 1 - General Descriptors
#echo charLabel('general descriptors');


			echo mk_input('code name', $cName, 'CodeName');

			//using second result set
			#called in function for now


			if($_SESSION['Privilege'] > 3){
				echo handlerDropDown($pName, $HandlerUserID);
			}

			#echo makeDropDown('status', 'StatusID', $aarStatus, $StatusID);

			#limits options/choices based on priveleges.
			echo mk_DDconditional('status', 'StatusID', $aarStatus, $StatusID);

			echo mkRadio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');

			echo mk_input('alias', $Alias, 'Alias');
			echo mk_input('last name', $LastName, 'LastName');
			echo mk_input('first name', $FirstName, 'FirstName');
			echo mk_input('middle name', $MiddleName, 'MiddleName');
			echo mk_input('nicknames', $NickName, 'NickName');
			echo mkRadio('identity is', 'IdentityID', $IdentityID,    'secret', 'public', 'secret', 'public');


#instructions to help handlers build characters correctly.
echo showInstructions('App', 'Appearance', $aarProfile['charCreation-appearance']);
#section 2 - Appearance
#echo charLabel('Appearance');

			#height
			echo '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Height: </strong></p>
			</div>

			<div class="col-sm-3">';

			echo makeNumericSelect('CharHtFt', $CharHtFt, 0, 40, ' ft.') . '</div>

			<div class="col-sm-3">';

			echo makeNumericSelect('CharHtIn', $CharHtIn, 0, 11, ' in.') . '</div>
			</div><!-- END Container -->';

			#Weight
			echo '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Weight: </strong></p>
			</div>


			<div class="col-sm-2">';
			echo makeNumericSelect('CharWt000', $CharWt000, 0, 24, '') . '</div>

			<div class="col-sm-2">';
			echo makeNumericSelect('CharWt00', $CharWt00, 0, 9, '') . '</div>

			<div class="col-sm-2">';

			echo makeNumericSelect('CharWt0', $CharWt0, 0, 9, '') . '</div>
			</div><!-- END Container -->';


			echo mkDDinput($title = 'Hair', 'HairColor', $aarHair, $HairColor, 0, '', 'iHair');
			echo mkDDinput($title = 'Eye',  'EyeColor',  $aarEye,  $EyeColor,  0, '', 'iColor');
			#Distinquishment

			#echo mk_input('actual age', $AgeActual, 'AgeActual');
			echo '<input type="hidden" name="AgeActual" value="">';


		/*
			<div class="row hoverHighlight">
			<div class="col-sm-3 col-xm-12 text-muted"><p class="text-right"><strong><a href="./../uploads/index.php?gender=m" target="_blank">playby</a>:</strong></p> </div>
			<div class="col-sm-9 col-xm-12">

				<input class="col-sm-9 col-xm-12" type="text" name="Playby" value="Mason Dye" placeholder="?">
			</div>
		</div>
		*/


			#was Year / Month / Day
			echo '<div class="row hoverHighlight"><div class="col-sm-3 col-xm-12 text-muted"><p class="text-right"><strong>DOB:</strong></p>
				</div>

				<div class="col-sm-9 col-xm-12">

					<input
						type="number "
						name="DOBday"
						value="' .  $DOBday . '"
						placeholder="Day as number"
					/> &nbsp;
					<input
						type="number "
						name="DOBmonth"
						value="' .  $DOBmonth . '"
						placeholder="Month as number"
					/>
					<input
						type="number "
						name="DOByear"
						value="' .  $DOByear . '"
						placeholder="Year as number"
					/> &nbsp;
					<br />
					<small>Fill out the birthday for your character and Jarvis will compute the actual age for you.</small>

				</div>
			</div>';

			echo mk_input('apparent age', $AgeApparent, 'AgeApparent');
			echo mkRadio('gender', 'Gender', $Gender, 'male', 'female', 'male', 'female');


			if($Gender == ''){
				$setGender='';
			}else if($Gender == 'male'){
				$setGender = 'm';
			}else{
				$setGender = 'f';
			}
			echo mk_input('<a href="./../uploads/index.php?gender=' . $setGender . '" target="_blank">playby</a>', $Playby, 'Playby');



#growing textarea

?>
<style>
	.myTextarea{
		display:block;
		box-sizing: padding-box;
		overflow:hidden;

		padding:10px;
		width:98%;
		font-size:14px;
		margin:50px auto;
		border-radius:8px;
		border:6px solid SkyBlue;
	}
</style>


<?php
			#echo mk_textArea('Dis', 'distinquishing features', $Distinquishment, 'Distinquishment');
			echo mk_textArea('distinquishing features', $Distinquishment, 'Distinquishment');
			echo mk_textArea('appearance', $Appearance, 'Appearance');


#instructions to help handlers build characters correctly.
echo showInstructions('Pers', 'Personality', $aarProfile['charCreation-personality']);
#section 3 - Personality
#echo charLabel('Personality');
			echo mk_textArea('quote', $Quote, 'Quote');
			echo mk_input('character theme song', $ThemeSong, 'ThemeSong');
			echo mk_input('theme song link', $ThemeSongLink, 'ThemeSongLink');
			echo makeDropDown('waiver', 'Waiver', $aarWaiver, $Waiver);
			echo mk_input('concept', $Concept, 'Concept');
			echo makeDropDown('orientation', 'Orientation', $aarOrientation, $Orientation);





			#dumpDie($aarTraitOverview);
			#dumpDie($aarTrait);
			#dumpDie($Demeanor);



			#echo makeDropDown('demeanor', 'Demeanor', $aarTraitOverview, $Demeanor);
			echo mkDDwDesc('demeanor', 'Demeanor', $aarTraitOverview, $Demeanor, $Gender, $cName);
			echo mkDDwDesc('nature', 'Nature', $aarTraitOverview, $Nature, $Gender, $cName);
			#echo makeDropDown('nature', 'Nature', $aarTrait, $Nature);




			echo mk_textArea('personality', $Personality, 'Personality');


#instructions to help handlers build characters correctly.
echo showInstructions('Legal', 'Legal', $aarProfile['charCreation-legal']);
#section 4 - Legal
#echo charLabel('legal'); #legal/clerical
			echo makeDropDown('citizenship', 'Citizenship', $aarCountryName, $Citizenship);
			echo makeDropDown('Legal Status', 'LegalStatus', $aarLegal, $LegalStatus);

			#moved age to be with apparent age

			echo mk_input('place of birth', $PlaceOfBirth, 'PlaceOfBirth');
			echo makeDropDown('education', 'Education', $aarEducation, $Education);
			echo makeDropDown('Character Class', 'Classification', $aarClassification, $Classification);



#instructions to help handlers build characters correctly.
echo showInstructions('Rank', 'Power Ranks', $aarProfile['charCreation-ranks']);
#section 5 - ranks
#echo charLabel('Power Rranks'); #Abilities
#http://www.menucool.com/tooltip/javascript-tooltip
			echo makeDropDown('power source', 		'PowerSource', 		$aarPowSource, 		$PowerSource );
			echo rdSTAT($aarMyTips['ra'],  				'RankPower',     	$RankPower,				$aarBtnRank);
			echo rdSTAT($aarMyTips['fi'],   			'RankFighting',  	$RankFighting,		$aarBtnRank);
			echo rdSTAT($aarMyTips['ag'],   			'RankAgility',   	$RankAgility,			$aarBtnRank);
			echo rdSTAT($aarMyTips['st'],   			'RankStrength',  	$RankStrength,		$aarBtnRank);
			echo rdSTAT($aarMyTips['end'],  			'RankEndurance', 	$RankEndurance,		$aarBtnRank);
			echo rdSTAT($aarMyTips['re'],					'RankReason',   	$RankReason,			$aarBtnRank);
			echo rdSTAT($aarMyTips['int'],  			'RankIntuition',	$RankIntuition,		$aarBtnRank);
			echo rdSTAT($aarMyTips['psy'], 				'RankPsyche',			$RankPsyche,   		$aarBtnRank);
			echo makeDropDown('technical savey',	'SkillLevel', 		$aarExpertise, 		$SkillLevel);
			echo makeDropDown('expertise', 	 			'RankExpertise', 	$aarExpertise, 		$RankExpertise);
			echo makeDropDown('assets', 		 			'RankAsset', 			$aarAsset, 				$RankAsset);





#instructions to help handlers build characters correctly.
echo showInstructions('Traits', 'Traits, Quirks, & Powers', $aarProfile['charCreation-traits']);
#section 6



//fed: baseURL, action, codename, id, stage(status), gender,  str
echo genCatBtns(VIRTUAL_PATH . 'library/powers.php',[
	'combat','defensive','detection','energy control','energy emission','faith','illusions','life form control','magical','matter control','matter conversion','matter creation','mental enhancement','physical enhancement','restricted','self-alteration','travel'
	],
	$cName, $CharID, $StatusID, $Gender, $arrCatAct, $arrCatTT, $arrCatName
 );


#http://localhost/WrDKv3//library/char_powers.php?CodeName=Chimaera&CharID=2&act=trait-powers

echo mk_textArea($path_charPowerOverview, $Power, 'Power');
echo mk_textArea($path_charPowers, $PowerDesc, 'PowerDesc');
echo mk_textArea($path_charAptitudes, $Aptitude, 'Aptitude');
echo mk_textArea($path_charMerits, $Merit, 'Merit');
echo mk_textArea($path_charFlaws, $Flaw, 'Flaw');



#instructions to help handlers build characters correctly.
echo showInstructions('Assets', 'Assets', $aarProfile['charCreation-personality']);
#section 7 - resources and stuff
#echo charLabel('assets'); #stuff

			echo mk_textArea($path_charEquipment, $Equipment, 'Equipment');
			echo mk_textArea($path_charResources, $Resource, 'Resource');
			echo mk_textArea('transportation', $Transportation, 'Transportation');
			echo mk_textArea('uniform', $Uniform, 'Uniform');

			echo mk_textArea('uniform specs', $UniformSpecs, 'UniformSpecs');

#instructions to help handlers build characters correctly.
echo showInstructions('Assoc', 'Associations', $aarProfile['charCreation-associations']);
#section 8 - contacts
#echo charLabel('Associations'); #stuff

			echo mk_input('team', $Team, 'Team');
			echo mk_input('team position', $TeamPosition, 'TeamPosition');
			echo mk_textArea('affliation', $Affliation, 'Affliation');
			echo mk_textArea('allies', $Allies, 'Allies');
			echo mk_textArea('contacts', $Contact, 'Contact');
			echo mk_textArea('relationship', $Relationship, 'Relationship');
			echo mk_textArea('relatives', $Relative, 'Relative');
			echo mk_textArea('rivals', $Rivals, 'Rivals');


#instructions to help handlers build characters correctly.
echo showInstructions('History', 'History', $aarProfile['charCreation-history']);
#section 9 - abilities
echo charLabel('history'); #history

			echo mk_textArea('character history', $History, 'History');

			echo '<input type="hidden" name="CharID" value="' . $cID . '" />

				<!-- for review purposes -->
				<!-- if we have a review in process -->
				<input type="hidden" name="NumReviews" value="' . $NumReviews . '" />
				<!-- get name of current user -->
				<input type="hidden" name="Reviewer" value="' . $_SESSION['UserID'] . '" />

				<!-- get the reviews -->
				<input type="hidden" name="Rrd1" value="' . $Rrd1 . '" />
				<input type="hidden" name="Rrd2" value="' . $Rrd2 . '" />
				<input type="hidden" name="Rrd3" value="' . $Rrd3 . '" />

				<!-- Times How long has it been / char created on / started on-->
				<input type="hidden" name="DevelopmentTime" value="' . $DevelopmentTime . '" />
				<input type="hidden" name="DateCreated" value="' . $DateCreated . '" />

				<input type="hidden" name="DateAssigned" value="' . $DateAssigned . '" />


				<input type="hidden" name="act" value="update" />





				<input type="submit" value="Update"> &nbsp;
					<button> <a href="profile.php?id=' . $cID . '&act=show">Exit Without Update</a> </button>
						 &nbsp;
					<button> <a href="./index.php">Return to Characters</a> </button>
			</form>';

		}	#END Edit area

	 break;
	############################################################################
	default: # 1)Ask user to enter their name
		echo '<div align="center">What! No such Character? There must be a mistake!!</div>';
		echo '<div align="center"><a href="' . VIRTUAL_PATH . 'characters">Another Character?</a></div>';

		break;
} #END switch

echo '</div>'; #END container
// END POSTBACK

get_footer(); #defaults to footer_inc.php


///// #myFunctions
function randLetter(){
		//$int = rand(0,51);
		$int = rand(0,8);
		$a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rand_letter = $a_z[$int];
		return $rand_letter;
}

function editDisplay($myID='') {# shows details from a single customer, and preloads their first name in a form.


	$myID = (int)$myID;  //forcibly convert to integer

	$sql = sprintf("select CustomerID,FirstName,LastName,Email from test_Customers WHERE CustomerID=%d",$myID);
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 $Name = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
				 $First = dbOut($row['FirstName']);
				 $Last = dbOut($row['LastName']);
				 $Email = dbOut($row['Email']);
		}
	}else{//no records
			//feedback issue to user/developer
			feedback("No such customer. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}

	$config->loadhead .= '
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


	echo '<h3 align="center">' . smartTitle() . '</h3>
	<h4 align="center">Update Customer\'s Name</h4>
	<p align="center">Customer: <font color="red"><b>' . $Name . '</b>
	 Email: <font color="red"><b>' . $Email . '</b></font>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr><td align="right">First Name</td>
				 <td>
					 <input type="text" name="FirstName" value="' .  $First . '">
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Last Name</td>
				 <td>
					 <input type="text" name="LastName" value="' .  $Last . '">
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Email</td>
				 <td>
					 <input type="text" name="Email" value="' .  $Email . '">
					 <font color="red"><b>*</b></font> <em>(valid email only)</em>
				 </td>
		 </tr>
		 <input type="hidden" name="CustomerID" value="' . $myID . '" />
		 <input type="hidden" name="act" value="update" />
		 <tr>
				 <td align="center" colspan="2">
					 <input type="submit" value="Update Info!"><em>(<font color="red"><b>*</b> required field</font>)</em>
				 </td>
		 </tr>
	</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Update</a></div>
	';
}

function mk_input($myTitle, $str='', $name=''){
	#create input
		return '<div class="row hoverHighlight">
			<div class="col-sm-3 col-xm-12 text-muted"><p class="text-right"><strong>' . ucwords($myTitle) . ':</strong></p> </div>
			<div class="col-sm-9 col-xm-12">
				<input
					class="col-sm-9 col-xm-12"
					type="text"
					name="'  . $name . '"
					value="' .  $str . '"
					placeholder="?"
				/>
			</div>
		</div>';
	}


#for user-facing view (Show) = add to count
function mk_stat($val, $aRank){
	# if val is set to zero, show 'o' which is equal to aarRank[$val] === ''
	# if val >= 1, add one so we echo the correct stat.
	if ($val != "") { $val = $val + 2;}

	#value is revised 1CS if greater then zero
	return $aRank[$val];
}

#personalizeString($myDesc, $codename, $gender);
function personalizeString($str='', $codename='', $gender=''){
/*

// Provides: <body text='black'>
$bodytag = str_replace("%body%", "black", "<body text='%body%'>");

// Provides: Hll Wrld f PHP
$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");

// Provides: You should eat pizza, beer, and ice cream every day
$phrase  = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy   = array("pizza", "beer", "ice cream");

$newphrase = str_replace($healthy, $yummy, $phrase);

*/

	$str = str_replace('XcharnameX', $codename, $str);


	if ($gender == 'male'){ $str = str_replace('Xhim-her-themX', 'him', $str);}
	if ($gender == 'female'){ $str = str_replace('Xhim-her-themX', 'her', $str);}
	if ($str    != ''){ $str = str_replace('Xhim-her-themX', 'them', $str);}

	#clean up formatting used in arrays for display on other pages
	//$str = strip_tags($str, '<p>');
	//$str = strip_tags($str, '<strong>');

	return $str;
}

function mk_textArea($myTitle, $val, $name){
	#create input
		return '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($myTitle) . ':</strong></p> </div>

			<div class="col-sm-9 ">
				<textarea
					class="autoExpand col-sm-9"
					name="'  . $name . '"
					value="' .  htmlspecialchars($val, ENT_QUOTES, 'utf-8') . '"
					rows="3"
					data-min-rows="3"
					placeholder="?"
				/>' .  htmlspecialchars($val, ENT_QUOTES, 'utf-8') . '</textarea>

			</div>
		</div>

		<div class=clearfix> &nbsp;</div>

		';
	}
#autoExpand col-sm-9 myTextarea

function mkDDinput($myTitle='', $myName='', $myArr='', $myVal='', $count = 0, $myReturn=''){
	//* $myTitle is one word - sets both the flush right title of the display button AND is used to call the specific jQuery script

	#assemble return / set title*, jQery* and formatting
	$myReturn .= '<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . $myTitle . ' Color: </strong></p>
		</div>

		<div class="col-sm-9">
			<select
				id="' . $myTitle . '-htmlselect-basic"
				name="' . $myName . '"

			>';

		#build the drop down
		foreach($myArr as $item) { #sometimes you feel like a select
			if($count == $myVal){
				#we have set this to select
				$myReturn .= '<option value="' . $count . '" selected="selected""> ' . ucwords($item) . '
				(' . $count . ')</option>';

			}else{
			 #if not set, make general li setting
				$myReturn .= '<option value="' . $count . '"> ' . ucwords($item) . '
				(' . $count . ')</option>';
			}

			$count++;
		}

	$myReturn .= '</select>
		</div>
	</div>';

	return $myReturn;
}

#make drop down select from array - load preselected options
function makeDropDown($myTitle, $myName, $myArray, $myValue ){

	$myDropdown =''; #initialize

	$myDropdown .= '
	<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . ucwords($myTitle) . ': </strong></p>
		</div>
		<div class="col-sm-7">
			<div class="form-group">
				<select class="form-control" name="' . $myName . '">';
				#create dropdown list - with option of select= 'selected' if matches db value!
				$count = 0;
				foreach($myArray as $item)
				{ #sometimes you feel like a select
					if($count==$myValue){
						 $myDropdown .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
					}else{
						 #sometimes you don't
						 $myDropdown .= '<option value="'. $count++ .'">'. $item .'</option>';
					}
				}
		return $myDropdown . '</select> </div></div></div><!-- END Container -->';
	}

#make drop down select from zdro to whatever $myMax set to.
function makeNumericDropDown($myTitle, $myName, $myValue, $myMax=0 ){

	$myDropdown =''; #initialize

	$myDropdown .= '
	<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . ucwords($myTitle) . ': </strong></p>
		</div>

		<div class="col-sm-7">
			<div class="form-group">
				<select class="form-control" name="' . $myName . '" id="' . $myTitle . '">';
				#create dropdown list - with option of select= 'selected' if matches db value!
				$count = 0;

				while($count <= $myMax)
				{ #sometimes you feel like a select
					if($count == $myValue){
						 $myDropdown .= '<option value="'. $count .'" selected="selected">'. $count .'</option>';
					}else{
						 #sometimes you don't
						 $myDropdown .= '<option value="'. $count .'">'. $count .'</option>';
					}

					$count++;
				}
		return $myDropdown . '</select></div></div></div><!-- END Container -->';
	}

#Make individual select for when we want to have a few in a row
function makeNumericSelect($myName, $myValue, $count, $myMax, $myTitle){

	#set up dropdown select
	$myDropdown = '<div class="form-group">
		<select class=" form-control col-sm-1"
			name="' . $myName . '"
			id="' . $myName . '">
			';

			#build select
			while($count <= $myMax)
			{ #sometimes you feel like a select
				if($count == $myValue){
					 #$myDropdown .= '<option value="'. $count .'" selected="selected">'. $count .'</option>';
					 $myDropdown .= '<option value="'. $count .'" selected="selected">' . $count . ' ' . $myTitle . '</option>';
				}else{
					 #sometimes you don't
					 #$myDropdown .= '<option value="'. $count .'">'. $count .'</option>';
					$myDropdown .= '<option value="' . $count . '">' . $count . ' ' . $myTitle . '</option>';
				}
				#iterate count
				$count++;
			}
		#close out select
		$myDropdown .= '
		</select>
	</div><!--end form group-->';

	return $myDropdown;
}

#get value from the basic radio settings for OCFC and StatusID
function mkRadio( $myTitle, $myName, $myValue, $myChek1, $myChek2, $myDesc1, $myDesc2 ){
	#initialize needed variables
	$str   = $chekd1 = $chekd2='';

	if ($myValue == $myChek1) { $chekd1 = "checked='checked'"; }else{$chekd2 = "checked='checked'";}

	$str .= '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right">
					<strong>' . ucwords($myTitle) . ': </strong>
				</p>
			</div>
			<div class="col-sm-9">
				<p>';
				$str .= "<label>
					<input type='radio' value='{$myChek1}' name='{$myName}' {$chekd1}> &nbsp; {$myDesc1} &nbsp; &nbsp; </label>
					<input type='radio' value='{$myChek2}' name='{$myName}' {$chekd2}> &nbsp; {$myDesc2} </label>
				</p>
			</div>
		</div>";

	return $str;
}

function showInstructions($anchor, $title, $aValue, $str=''){ #show instructions generated from arrContent-inc.php
	$str='<div class="row">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="Getting Started">
						<a data-toggle="collapse" href="#collapse' . $anchor . '"><b>' . $title . '</b></a> <small><i><span class="pull-right">Click to see helpful hints on how to fill this section out!</span><i></small>
					</h5>
				</div>
				<div id="collapse' . $anchor . '" class="panel-collapse collapse">
					<div class="panel-body">' . $aValue . '</div>
					<div class="panel-footer"><a class="pull-right" data-toggle="collapse" href="#collapse' . $anchor . '">Close ' . $title . '</a></div>
				</div>
			</div>
		</div>
	</div>';

	return $str;
}

function rdSTAT($myTitle, $myName='', $myValue='', $myArray, $str=''){
	#begin construction of return (label)
	$str .=  '<div class="row hoverHighlight">'
	. '<div class="col-sm-3 text-right text-muted">'
	.   '<p class="text-right"><strong>' . ucwords( $myTitle ) . ': (' . $myValue . ')</strong></p>'
	. '</div>'
	#end label construct

	#start button container
	. '<div class="col-sm-9">'
	.   '<fieldset id="' . $myName . '">'
	.     '<div class="btn-toolbar" role="toolbar">'
	.       '<div class="btn-group btn-group-xs" data-toggle="buttons" >';
	$max = count( $myArray );
	for ($x = 0; $x < $max; $x++) {
		$item = $myArray[ $x ];

		/* problem not registering the value so nothing checks */
		#$selectActive = ($myValue == $item ) ? ' active ' : ' btn-default ';
		$selectActive = ($myValue == $x ) ? ' active ' : ' ';
		#$selectChek   = ($myValue == $item ) ? ' checked ' : ' xxxx ';
		$selectChek   = ($myValue == $x ) ? ' checked="checked" ' : ' ';


		$str .= '<label class="btn btn-primary btn-xs ' . $selectActive . '">'
		. '<input style="font-size: 6px;" '

		. ' type="radio" '
		. ' name="' . $myName . '" '
		#DB wants int value -- only ever 18 values in this specific instance
		. ' value="' . $x . '"' . $selectChek . '>' . ucwords( $item )

		. '</label>';
	}

	$str .=  '</div> <!-- END stat buttons -->'
	.       '</div><!-- END toolbar -->'
	.     '</div><!-- END Container -->'
	.   '</fieldset>'
	. '</div>';
	return $str;
}

function handlerDropDown($PlayerName, $HandlerUserID, $myDropdown=''){//Select User
	#			echo handlerDropDown($PlayerName, $HandlerUserID);

	$sql = "SELECT UserName AS HandlerName, UserID AS HandlerID, LastUpdated AS HandlerUpdate
		FROM ma_Users";

	$foundRecord = FALSE; # Will change to true, if record found!

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0){#records exist - process
		$foundRecord = TRUE;

		$myDropdown .= '<div class="row hoverHighlight"><div class="col-sm-3 text-right text-muted"><p class="text-right"><strong> Handler: </strong></p></div>
			<div class="col-sm-7"><div class="form-group">
				<select class="form-control" name="UserID">


					<option value="0">Select Handler</option>';
				#create dropdown list - with option of select= 'selected' if matches db value!

				while ($row = mysqli_fetch_assoc($result)) {
					//$HandlerID      - character table
					//$HandlerUserID  - user table


				 $HandlerID = dbOut($row['HandlerID']);
					//dbOut() function is a 'wrapper' used strip slashes, etc. of data leaving db
					#sometimes you feel like a select
					if($HandlerUserID == $HandlerID){
						$myDropdown .= '<option value="'. $HandlerID .'" selected="selected">'. dbOut($row['HandlerName']) .'</option>';
					}else{
						#sometimes you don't
						$myDropdown .= '<option value="'. $HandlerID .'">'. dbOut($row['HandlerName']) .'</option>';
					}

				}
		return $myDropdown . '</select></div></div></div><!-- END Container -->';
	}
	@mysqli_free_result($result); # We're done with the data!
}




######################  IMG HANDLING  ########################

#getJumbotron($myID, $CodeName, $Playby, $Gender);
function getJumbotron($cID, $cName='', $playby='', $cGen='', $genderExplicit =''){

	if($cGen == 'male'){ $genderExplicit = 'm'; }
	if($cGen == 'female'){ $genderExplicit = 'f'; }


	echo '<style>
				.jumbotron {
					position: relative;
					background: #fff url("' . getJumboBg($cID, $cName, $playby, $genderExplicit) . '") center center;
					width: 100%;
					height: 100%;
					background-size: cover;
					overflow: hidden;
					}

				.vertical-align {
					position: absolute;
					bottom: -18px;
					left: 1%;
					}

				.btnJumbotron {
					position: absolute;
					top:10px;
					right: 0px;

					color: #000;

					background: white;
					#opacity: 0.9;
					font-size: 10px;
					padding: -3px -4px;

					border-radius: 10px 0 0 10px  ;
					font-weight: bold;
					}

					.btnJumbotron a {color: grey; text-decoration: none;}
					.btnJumbotron a:hover { color: tomato; text-decoration: none;}

				.jumbotron h1 {
					color: white;
					text-shadow: 4px 4px 8px #444;
					}

				.btn.outline {
					background: none;
					padding: 12px 22px;
					color: white;
					border: solid 2px white;
					border-radius: 10px;
					font-weight: bold;
					text-shadow: 0px 0px 8px #000000;
					box-shadow: 0px 0px 8px #000000;
					}


				.pull-bottom{
					position: absolute;
					bottom: 0px;}


				.myThumb {
					height: 35px;
					width: 35px;
					margin: 0 3px 0 6px;
					}

				.txt-KO{color: white;}

				.hoverHighlight:hover{ background: WhiteSmoke;}

				.charSection { background: WhiteSmoke;}

				.myParagraph {
					margin-bottom: -54px;
					padding: 0 0 0 25px;
					}

			</style>

			<!-- begin character -->
			<div class="container">
				<div class="jumbotron">
					<br />
					<br />
					<br />';

			if(startSession() && isset($_SESSION['UserID']) && ($_REQUEST['act']) == 'show'){

				#add additional cheks
				#if is admin, suepr, owner, developer or is player show edit option.

				echo '<div class=text-right>
					<button type="button"  class="btn btn-sm btnJumbotron"><a class="txt-KO" href="./profile.php?act=edit&id=' . $cID . '" data-toggle="click to edit ' . $cName . '"> ' . $cName . ' &nbsp; <i class="glyphicon glyphicon-edit"></i></a></button>
				</div>';
			}

	#getJumbotron($myID, $CodeName, $Playby, $Gender);
	echo getImgGallery($cID, $cName, $playby, $genderExplicit); #CharID needed, returns array to build image gallery with

	echo '</div>
	<!--END JUMBO-->'; #END jumbo
}

function getThumbs($cID, $name){ #create 4 random thumbnails
	#define variables needed
	$x = 1;
	$str='';
#edit
	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images

		while($x <= 4) {
			$imgPath = '../uploads/_assigned/' . $cID . '-' . rand(2,6) . 't.jpg';

			#var_dump($imgPath);

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="' . $imgPath . '" alt=" "' . $name .
					'" class="img-thumbnail myThumb" >';
			}else{ #show static
				$str .= '<img src="' . VIRTUAL_PATH .
					'_img/_static/static---00' . rand(0,9) . '.gif" alt=" "' . $name .
					'" class="img-thumbnail myThumb" >';
			}
			$x++;
		}
	}

	#edit mod
	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images
		while($x <= 4) {
			$imgPath = '../uploads/_assigned/' . $cID . '-' . rand(2,6) . 't.jpg';

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="' . $imgPath . '" alt=" "' . $name .
					'" class="img-thumbnail myThumb" >';
			}else{ #show static
				$str .= '<img src="../_img/_dims/dims35x35.jpg" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}
			$x++;
		}
	}

return $str; #return gallery images
}

function getJumboBg($cID, $cName, $playby, $cGen, $img='-0.jpg'){ #create background image
	#creat testing links for image paths
	$permImg = permImg($cID) . $img;
	$tempImg = tempImg($playby, $cGen) . $img;


	if(($_REQUEST['act']) == 'show'){
		if(file_exists($permImg)){
			$img = $permImg;
		} else if(file_exists($tempImg)) {
		#no image show me random static image (6 possible returns)
		return $tempImg; #temp image
		} else{ #show static
			$img = VIRTUAL_PATH . '_img/_static/static---blueCascade.gif';
		}
	}

	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images

		if(file_exists($permImg)){
				$img = $permImg;
			}else{ #show static
				$img = VIRTUAL_PATH . '_img/_dims/dims940x462ph.jpg';
			}

		}
	return $img; #return gallery images
}














#HELPER GENERAL IMAGE DISPLAY FUNCTIONS
#

function getImgGallery($cID='', $cName='', $playby='', $gender='', $str='', $imgHero='', $pbPath='', $modal = FALSE){
#Take CharID, check upload __DIR__, return all images found meeting criteria of search given

	$str .= '<h1 class="col-sm-8 vertical-align"><b>' . strtoupper($cName) . '</b></h1>
		<!-- image gallery here -->
		<div class"col-sm-2 vertical-align pull-right .vertical-align">
			<div class="  pull-right" >
				<p class="myParagraph">';
				$str .= getThumbs($cID, $cName);
				$str .='</p>';

			$str .= '<br />
				<div col-sm-2 pull-right">
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
					<!-- Large modal -->
					<a href="#" class="btn " data-toggle="modal" data-target=".bs-example-modal-lg">
						<img src="';

						#make path if playby
						if(!empty($playby)){
							$playby = str_replace(' ', '_', strtolower($playby));
							$playby = str_replace('-', '_', strtolower($playby));
							$playby = str_replace("'", '_', strtolower($playby));

							$pbPath = "../uploads/_{$gender}/{$playby}/{$playby}-1.jpg";
						}

						#make path if assigned image
						if(!empty($cID)){$imgPath = '../uploads/_assigned/' . $cID . '-1.jpg';}
						if(($_REQUEST['act']) == 'show'){
							#make gallery of 4 random images

							if(file_exists($imgPath)) {
								$imgHero = $imgPath; #temp image
								$modal = TRUE;

							} else if(file_exists($pbPath)){
								$imgHero = $pbPath; #temp image
								$modal = TRUE;

							} else{ #show static
								$imgHero = '../_img/_static/static---00' . rand(1,9). '.gif';
								#no image, no modal
							}
						}
						if(($_REQUEST['act']) == 'edit'){
							#make gallery of 4 random images
							if((!empty($imgPath) == 1) && ( file_exists($imgPath))){
								$imgHero = $imgPath;
								$modal = TRUE;
							}else{ #show static
								$imgHero = VIRTUAL_PATH . '_img/_dims/dims170x170phf.jpg';
								#no image, no modal
							}
						}

					$str .= $imgHero . '" alt="' . $cName . '"
					class="img-thumbnail pull-right" width="170" height="170">
				</a>
			</div>';

			// call MODAL GALLERY
			$str .= gt_modalGallery($modal);

			$str .= '</div>
			<div class="clearfix"></div>
		</div></div><!--END IMAGES-->';

	return $str;
}


function tempImg($pbID='', $gID='', $imgTemp=''){
	#Creates temporary base image path for a character profile
	#EX:: http://localhost/WrDKv3/uploads/_male/alex_kotze/alex_kotze-001t.jpg
	#if image has been set, set path

	#sanitize/prep playby name for processing
	$pbID = str_replace(' ', '_', strtolower($pbID));
	$pbID = str_replace('-', '_', strtolower($pbID));
	$pbID = str_replace("'", '_', strtolower($pbID));

	if((isset($pbID)) && ($pbID !== '')){ $imgTemp = "../uploads/_{$gID}/$pbID/$pbID";
	}
	return $imgTemp ;
}

function permImg($cID, $imgPerm=''){
	$imgPerm = '../uploads/_assigned/' . $cID;
	return $imgPerm;
}

#HELPER IMAGE UPLOAD FUNCTIONS
function btnProfileImg($cID='', $num=2, $galleryImgNum=3, $count=1, $str=''){ #gets thumbnail image for button display
	#img path
	$iPath = '../uploads/_assigned/' . $cID . '-' . $num . '.jpg';
	#thumbnail path
	$tPath = '../uploads/_assigned/' . $cID . '-' . $num . 't.jpg';
	//file exists?
	switch ($num) {
		//it's the hero/banner
		case 0:
				if(file_exists($iPath)){
					$str='<img src="' . $tPath . '" alt="img" title="Upload an image 940 x 460 pixels" style="height: 50px;"/><br />';
				}else{
					$str = '<img src="' . VIRTUAL_PATH .'/_img/_dims/dimHeaderBtn.jpg" alt="img" title="Upload an image 940 x 460 pixels"/><br />940x460';
				}

			break;

		//it's the hero
		case 1:
				if(file_exists($iPath)){
					$str='<img src="' . $tPath . '" alt="img" title="Upload an image 170 x 170 pixels" style="height: 50px;"/><br />';
				}else{
					$str = '<img src="' . VIRTUAL_PATH .'/_img/_dims/dimHeroBtn.jpg"  alt="img" title="Upload an image 170 x 170 pixels"/><br />170x170';
				}

			 break;

		//it's a gallery image, of many
		default:
				if(file_exists($iPath)){
					$str='<img src="../uploads/_assigned/' . $cID . '-' . $num . 't.jpg" alt="img" title="Upload an image 170 x 170 pixels" style="height: 50px;"/><br />';
				}else{
					$str = '<img src="' . VIRTUAL_PATH .'/_img/_dims/dimGalleryBtn.jpg" alt="img" title="Upload an image 170 x 170 pixels"/><br />500x500';
				}
			break;
	}
return $str;
}

#galleryMaker($CharID, $returnPage)
function galleryMaker($cID='', $returnPage, $x = 1, $imgIncrement = 2, $str=''){
		$x--; #$x == ZERO

/*
	var_dump($cID);             #1
		var_dump($returnPage);    #profile.php?id=1&act=edit
		var_dump($x);             #0
		var_dump($imgIncrement);  #2
	dumpDie($str);              #''
*/

	#../uploads/2-1.jpg -- if no file found, loop ends
	do {

		#if we have another gallery image, show us
		$str .='<a href="./profileUpload.php?'

		. $_SERVER['QUERY_STRING']
			. '&type=g&img='
			. $cID
			. '-'
			. $imgIncrement
			. '&returnPage='
			. $returnPage
		. '" class="btn btn-info" role="button">'
		. btnProfileImg($cID, $imgIncrement)
		. '<br />500 x 500</a>';

		$imgIncrement++; // two becomes three, becomes four...
		#we will now look for ../uploads/2-2.jpg if exists on next iteration

		$x++; #$x == ONE - lop runs again

		//if no file exists, we decriement down to zero and stop looking for images
		//this way we can have as many gallery images as we want.

		#$X == zero unless the if statement was true, then incremented to ONE and will run again.

	} while (file_exists('../uploads/_assigned/' . $cID . '-' . $imgIncrement . '.jpg'));
	#dumpDie('../uploads/' . $cID . '-' . $imgIncrement . '.jpg');

	//we need to show/allow for one image upload. With each upload, allow for another...
	$str .='<a href="./profileUpload.php?'
	. $_SERVER['QUERY_STRING']
	. '&type=g&img=' . $cID . '-' . $imgIncrement . '&returnPage='
	. $returnPage
	. '" class="btn btn-info" role="button">
		<img src="' . VIRTUAL_PATH . '_img/_dims/dimMark.jpg" alt="" /><br /><br /> 500 x 500
	</a>';

	return $str;

}

function listApprovals(){
	$str = '<p class="pull-right"><small> Approvals: ? / 3 &nbsp; &nbsp; (14 Days remaining)</small></p>';
	/*   date("F jS, Y", strtotime($DateCreated))   */
	return $str;
}









/**
*
*
*/

function gt_modalGallery($modal, $str=""){ //BEGIN gt_modalGallery
	// if modal has value
	if(isset($modal))
	{
		$str = '<!-- start -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg w500" >
						<div class="modal-content">

							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<!-- Wrapper for slides -->
								';

								// makes image carousel
								$str .= mk_carouselImgs();

								$str .= '<!-- Controls -->
								<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
						</div><!-- END carousel-example-generic -->

					</div><!-- Modal-content --></div>
				</div>
			</div><!-- modal fade bs-example-modal-lg--></div>

			</div>
		</div>
		<!-- END MODAL GALLERY -->';
	}
	return $str;
} //END gt_modalGallery



/**
*
*
*/
function mk_carouselImgs($str = '')
{
	$str .= '
		<div class="carousel-inner"><div class="item active">
			<img class="img-responsive" src="./28/28-13.jpg" alt="...">
				<div class="carousel-caption"><strong>
					Scarlet Witch</strong> (1/20)
				</div>
		</div>

		<!-- BEGIN images -->
		<div class="item ">
			<img class="img-responsive" src="./28/28-1.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (2/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-2.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (3/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-3.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (4/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-4.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (5/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-5.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (6/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-6.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (7/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-7.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (8/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-8.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (9/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-9.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (10/20)</div>
		</div>

		<div class="item ">
			<img class="img-responsive" src="./28/28-10.jpg" alt="...">
			<div class="carousel-caption"><strong>Scarlet Witch</strong> (11/20)</div>
		</div>
	</div>
	<!-- END images -->';

	return $str;



}
























//scripts must site outside php so the browser can properly read the script tags
?>






<!--

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="http://bootsnipp.com/dist/scripts.min.js"></script>

-->







<script type="text/javascript" src="./../_js/jquery.ddslick.js"></script>
<script type="text/javascript" src="./../_js/DDslick-eye.js"></script>
<script type="text/javascript" src="./../_js/DDslick-hair.js"></script>


<script>
	$(document)
		.on('focus.textarea', '.autoExpand', function(){
			var savedValue = this.value;
			this.value='';
			this.baseScrollHeight = this.scrollHeight;
			this.value = savedValue;
		})
		.on('input.textarea', '.autoExpand', function(){
			var minRows = this.getAttribute('data-min-rows')|0,
				 rows;
			this.rows = minRows;
				console.log(this.scrollHeight , this.baseScrollHeight);
			rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 17);
			this.rows = minRows + rows;
		});

</script>

<script>
	$('.closeall').click(function(){
	$('.panel-collapse.in')
		.collapse('hide');
});
$('.openall').click(function(){
	$('.panel-collapse:not(".in")')
		.collapse('show');
});
</script>
