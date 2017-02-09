<?php


function maxDoc_characters_profileUpdate(){
	/**
	 * character_edit.php, based on edit.php is a single page web application that allows us to select a character
	 * and edit their data
	 *
	 * This page is based onpostback.php as well as first_crud.php, which is part of the
	 * nmPreload package
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

	 # '../' works for a sub-folder.  use './' for the root
}

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials


//set access priv needed for this page by member
		#chekPrivies(3); #mods+

//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){
	$myAction = (trim($_REQUEST['act']));
}else{
	$myAction = "";
}

switch ($myAction)
{//check 'act' for type of process

	case "update": //3) Change character's first name
		update();
		break;

	default: //1)Select character from list
		myRedirect('profile.php?CodeName=' . $CodeName . '&id=' . $CharID. '&act=show');
}



function update() {
	if(!is_numeric($_POST['CharID']))
	{//data must be alphanumeric only
		feedback("id passed was not a number. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}

	#dumpDie($_POST);

#echo 'here i am';

	#dumpDie($_POST);

	#dumpDie($_POST['Reviewer']);


	$iConn = IDB::conn();//must have DB as variable to pass to mysqli_real_escape() via iformReq()
	$redirect = THIS_PAGE; //global var used for following formReq redirection on failure


	//call mysqli_real_escape() internally, to check form data
	$CharID = iformReq('CharID',$iConn);

	#section 1 - General
	$CodeName       	= strip_tags(iformReq('CodeName',					$iConn));
	$UserID       	  = strip_tags(iformReq('UserID',			      $iConn));
	$StatusID					= strip_tags(iformReq('StatusID',					$iConn));
	$OCFC							= strip_tags(iformReq('OCFC',							$iConn));
	$Alias						= strip_tags(iformReq('Alias', 						$iConn));

	$LastName       	= strip_tags(iformReq('LastName', 				$iConn));
	$FirstName      	= strip_tags(iformReq('FirstName',  			$iConn));
	$MiddleName     	= strip_tags(iformReq('MiddleName', 			$iConn));
	$NickName  		  	= strip_tags(iformReq('NickName', 				$iConn));
	$IdentityID				= strip_tags(iformReq('IdentityID', 			$iConn));


	#section 2 - Appearance
	$CharHtFt       	= strip_tags(iformReq('CharHtFt',					$iConn));
	$CharHtIn       	= strip_tags(iformReq('CharHtIn',					$iConn));
	$CharWt000      	= strip_tags(iformReq('CharWt000',				$iConn));
	$CharWt00       	= strip_tags(iformReq('CharWt00',					$iConn));
	$CharWt0        	= strip_tags(iformReq('CharWt0',					$iConn));

	$HairColor      	= strip_tags(iformReq('HairColor',				$iConn));
	$EyeColor       	= strip_tags(iformReq('EyeColor',					$iConn));


	$AgeActual      	= strip_tags(iformReq('AgeActual',				$iConn));
	$AgeApparent    	= strip_tags(iformReq('AgeApparent',			$iConn));

	$Gender    		  	= strip_tags(iformReq('Gender',						$iConn));
	$Playby						= strip_tags(iformReq('Playby',						$iConn));

	$Distinquishment	= strip_tags(iformReq('Distinquishment',	$iConn), '<a><b><br /><em><i><strong><u>');
	$Appearance     	= strip_tags(iformReq('Appearance',				$iConn), '<a><b><br /><em><i><strong><u>');


	#section 3 - personality section
	$Quote    		  	= strip_tags(iformReq('Quote', 						$iConn), '<a><b><br /><em><i><strong><u>');
	$ThemeSong				= strip_tags(iformReq('ThemeSong',				$iConn));
	$ThemeSongLink		= strip_tags(iformReq('ThemeSongLink',		$iConn));
	$Waiver						= strip_tags(iformReq('Waiver',						$iConn));
	$Concept    			= strip_tags(iformReq('Concept', 					$iConn));
	$Orientation    	= strip_tags(iformReq('Orientation', 			$iConn));
	$Demeanor    			= strip_tags(iformReq('Demeanor', 				$iConn));
	$Nature    				= strip_tags(iformReq('Nature', 					$iConn));
	$Personality    	= strip_tags(iformReq('Personality',  		$iConn), '<a><b><br /><em><i><strong><u>');


	#section 4 - Legal section
	$Citizenship    	= strip_tags(iformReq('Citizenship',			$iConn));
	$LegalStatus			= strip_tags(iformReq('LegalStatus',			$iConn));
	$DOByear        	= strip_tags(iformReq('DOByear',					$iConn));
	$DOBmonth       	= strip_tags(iformReq('DOBmonth', 				$iConn));
	$DOBday         	= strip_tags(iformReq('DOBday', 					$iConn));
	$PlaceOfBirth   	= strip_tags(iformReq('PlaceOfBirth', 		$iConn));
	$Education      	= strip_tags(iformReq('Education', 				$iConn));


	#section 5 - stats
	$Classification 	= strip_tags(iformReq('Classification', 	$iConn));
	$PowerSource    	= strip_tags(iformReq('PowerSource', 			$iConn));


	$RankPower      	= strip_tags(iformReq('RankPower', 				$iConn));

	$RankFighting   	= strip_tags(iformReq('RankFighting', 		$iConn));
	$RankAgility    	= strip_tags(iformReq('RankAgility', 			$iConn));
	$RankStrength   	= strip_tags(iformReq('RankStrength', 		$iConn));
	$RankEndurance  	= strip_tags(iformReq('RankEndurance', 		$iConn));

	$RankReason     	= strip_tags(iformReq('RankReason', 			$iConn));
	$RankIntuition  	= strip_tags(iformReq('RankIntuition', 		$iConn));
	$RankPsyche     	= strip_tags(iformReq('RankPsyche', 			$iConn));



	$SkillLevel     	= strip_tags(iformReq('SkillLevel', 			$iConn));
	$RankExpertise    = strip_tags(iformReq('RankExpertise', 		$iConn));
	$RankAsset     		= strip_tags(iformReq('RankAsset', 				$iConn));


	#section 6 - abilities
	$PowerDesc     		= strip_tags(iformReq('PowerDesc', 				$iConn), '<a><b><br /><em><i><strong><u>');
	$Aptitude     		= strip_tags(iformReq('Aptitude', 				$iConn), '<a><b><br /><em><i><strong><u>');
	$Merit      			= strip_tags(iformReq('Merit', 						$iConn), '<a><b><br /><em><i><strong><u>');
	$Flaw    					= strip_tags(iformReq('Flaw', 						$iConn), '<a><b><br /><em><i><strong><u>');

	#section 7 - stuff
	$Equipment				= strip_tags(iformReq('Equipment', 				$iConn), '<a><b><br /><em><i><strong><u>');
	$Resource					= strip_tags(iformReq('Resource', 				$iConn), '<a><b><br /><em><i><strong><u>');
	$Transportation		= strip_tags(iformReq('Transportation', 	$iConn), '<a><b><br /><em><i><strong><u>');
	$Uniform					= strip_tags(iformReq('Uniform', 					$iConn), '<a><b><br /><em><i><strong><u>');
	$UniformSpecs			= strip_tags(iformReq('UniformSpecs', 		$iConn), '<a><b><br /><em><i><strong><u>');

	#section 8 - contacts
	$Team     				= strip_tags(iformReq('Team', 						$iConn));
	$TeamPosition   	= strip_tags(iformReq('TeamPosition', 		$iConn));


	$Affliation     	= strip_tags(iformReq('Affliation', 			$iConn), '<a><b><br /><em><i><strong><u>');
	$Allies      			= strip_tags(iformReq('Allies', 					$iConn), '<a><b><br /><em><i><strong><u>');
	$Contact					= strip_tags(iformReq('Contact', 					$iConn), '<a><b><br /><em><i><strong><u>');
	$Relationship   	= strip_tags(iformReq('Relationship', 		$iConn), '<a><b><br /><em><i><strong><u>');
	$Relative     		= strip_tags(iformReq('Relative', 				$iConn), '<a><b><br /><em><i><strong><u>');
	$Rivals    				= strip_tags(iformReq('Rivals', 					$iConn), '<a><b><br /><em><i><strong><u>');

	#section 9 - history
	/*
		You almost certainly still need to filter out html tags from the
		input...even if you use a client-side editor that restricts what the
		user can enter, an attacker could still try to submit directly to your
		form handler to bypass that.

		Handling all cases of malicious or invalid html is non-trivial, so
		when possible it's nice to avoid altogether...using a simpler markup
		syntax like markdown or bbcode can give you some visual formatting
		options without the complexity of html.

		When you must allow html formatting in rich text, you will typically
		choose a list of acceptable html tags which are safe and you will
		allow, and then strip anything that isn't on the list. (What actually
		belongs in that list is a bigger discussion, and depends on what your
		editor widget outputs, what formatting you need to support, and what
		kind of security concerns you have...but generally the shorter the
		list, the better.) strip_tags() has an optional second parameter that
		will take such a list of tags that it will allow through, so using
		that would be a quick first step. Though be aware that there are still
		security concerns using strip_tags, as it doesn't limit/process
		attributes on allowed tags at all, and can let through things like
		inline css styles or on<event> attributes which have security
		implications. A library like HTML Purifier[1] is generally the best
		approach, but is a bit more work to get started with.

		SEE: http://htmlpurifier.org/
	*/


	/*
		There's also a simpler option than a library like HTML Purifier, just to get you started.  You can pass a list of acceptable tags to leave alone to strip_tags():

		$History = strip_tags(iformFreq('History',$iConn), '<p><strong><a>');

		That way you could at least have basic sanitizing to start and then worry about something more robust later.
	*/

	$History = strip_tags(iformReq('History',$iConn), '<a><b><br /><em><i><strong><u><ul><ol><li>');


	#lets let admins and handlers talk to each other directly and record the correspondance
	$NumReviews 					= strip_tags(iformReq('NumReviews', 			$iConn));
	$Reviewer 						= strip_tags(iformReq('Reviewer', 				$iConn));

	$Rrd1 								= strip_tags(iformReq('Rrd1', 						$iConn));
	$Rrd2 								= strip_tags(iformReq('Rrd2', 						$iConn));
	$Rrd3 								= strip_tags(iformReq('Rrd3', 						$iConn));


	//TWEAK results



	#comments/convo
	#here we are appending the values to keep old comments and fold in new notes so no old comments are ever destroyed
	$Rrd1Update = strip_tags($_POST['Rrd1Update']);
	$Rrd1Update 					.= '<hr />' . strip_tags($Rrd1Update);
	$Rrd1 = $Rrd1 . $Rrd1Update;


	$Rrd2Update = strip_tags($_POST['Rrd2Update']);
	$Rrd2Update 					.= '<hr />' . strip_tags($Rrd2Update);
	$Rrd2 = $Rrd2 . $Rrd2Update;


	$Rrd3Update = strip_tags($_POST['Rrd3Update']);
	$Rrd3Update 					.= '<hr />' . strip_tags($Rrd2Update);
	$Rrd3 = $Rrd3 . $Rrd3Update;











	#automatic records
	$DevelopmentTime 			= strip_tags(iformReq('DevelopmentTime', 	$iConn));
	$DateCreated 					= strip_tags(iformReq('DateCreated', 			$iConn));
	$DateAssigned 				= strip_tags(iformReq('DateAssigned', 		$iConn));

	//next check for specific issues with data
	if(!ctype_print($_POST['CodeName']))
	{//data must be alphanumeric or punctuation only
		feedback("First and Last Name must contain letters, numbers or punctuation","warning");
		myRedirect(THIS_PAGE);
	}





	#dumpDie($_POST);

	//build string for SQL insert with replacement vars, %s for string, %d for digits

	#PLAYER CODE NAME/FIRSTNAME -- HOW HOW HOW?
	#PLAYER CODE NAME/FIRSTNAME -- HOW HOW HOW?
	#PLAYER CODE NAME/FIRSTNAME -- HOW HOW HOW?

	#PlayerName AS u.FirstName='%s',
	#HandlerID='%s',

		$sql = "UPDATE ma_Characters set

			CodeName='%s',

			UserID='%s',

			StatusID='%s',
			OCFC='%s',
			LastName='%s',
			FirstName='%s',
			MiddleName='%s',
			NickName='%s',
			Alias='%s',
			IdentityID='%s',

			CharHtFt='%s',
			CharHtIn='%s',

			CharWt000='%s',
			CharWt00='%s',
			CharWt0='%s',

			HairColor='%s',
			EyeColor='%s',

			AgeActual='%s',
			AgeApparent='%s',

			Gender='%s',
			Playby='%s',
			Distinquishment='%s',
			Appearance='%s',

			Quote='%s',
			ThemeSong='%s',
			ThemeSongLink='%s',
			Waiver='%s',
			Concept='%s',
			Orientation='%s',
			Demeanor='%s',
			Nature='%s',
			Personality='%s',

			Citizenship='%s',
			LegalStatus='%s',
			DOByear='%s',
			DOBmonth='%s',
			DOBday='%s',
			PlaceOfBirth='%s',
			Education='%s',

			Classification='%s',
			PowerSource='%s',
			RankPower='%s',

			RankFighting='%s',
			RankAgility='%s',
			RankStrength='%s',
			RankEndurance='%s',

			RankReason='%s',
			RankIntuition='%s',
			RankPsyche='%s',

			SkillLevel='%s',
			RankExpertise='%s',
			RankAsset='%s',

			PowerDesc='%s',
			Aptitude='%s',
			Merit='%s',
			Flaw='%s',

			Equipment='%s',
			Resource='%s',
			Transportation='%s',
			Uniform='%s',
			UniformSpecs='%s',

			Team='%s',
			TeamPosition='%s',

			Affliation='%s',
			Allies='%s',
			Contact='%s',
			Relationship='%s',
			Relative='%s',
			Rivals='%s',
			History='%s',





NumReviews='%s',
Reviewer='%s',

Rrd1='%s',
Rrd2='%s',
Rrd3='%s',

DevelopmentTime='%s',
DateCreated='%s',
DateAssigned='%s'


			WHERE CharID=%d"
		; #no comma before where statement...








	#			$HandlerID,
	# sprintf() allows us to filter (parameterize) form data
			$sql = sprintf($sql,

			$CodeName,
			$UserID,

			$StatusID,
			$OCFC,
			$LastName,
			$FirstName,
			$MiddleName,
			$NickName,
			$Alias,
			$IdentityID,

			/* Appearance */
			$CharHtFt,
			$CharHtIn,
			$CharWt000,
			$CharWt00,
			$CharWt0,

			$HairColor,
			$EyeColor,

			$AgeActual,
			$AgeApparent,

			$Gender,
			$Playby,

			$Distinquishment,
			$Appearance,

			$Quote,
			$ThemeSong,
			$ThemeSongLink,
			$Waiver,
			$Concept,
			$Orientation,
			$Demeanor,
			$Nature,
			$Personality,

			$Citizenship,
			$LegalStatus,
			$DOByear,
			$DOBmonth,
			$DOBday,
			$PlaceOfBirth,
			$Education,


			$Classification,
			$PowerSource,
			$RankPower,

			$RankFighting,
			$RankAgility,
			$RankStrength,
			$RankEndurance,
			$RankReason,
			$RankIntuition,
			$RankPsyche,

			$SkillLevel,
			$RankExpertise,
			$RankAsset,

			$PowerDesc,
			$Aptitude,
			$Merit,
			$Flaw,

			$Equipment,
			$Resource,
			$Transportation,
			$Uniform,
			$UniformSpecs,


			$Team,
			$TeamPosition,

			$Affliation,
			$Allies,
			$Contact,
			$Relationship,
			$Relative,
			$Rivals,

			$History,


$NumReviews,
$Reviewer,

$Rrd1,
$Rrd2,
$Rrd3,

$DevelopmentTime,
$DateCreated,
$DateAssigned,


			(int)$CharID);


	@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	#feedback success or failure of update

	if (mysqli_affected_rows($iConn) > 0)
	{//success!  provide feedback, chance to change another!
		feedback( $CodeName . " Updated Successfully!", "success");
		#send notification
		myRedirect('./../_inc/processCharNotification-inc.php?cName=' . $CodeName . '&cID=' . $CharID . '&cStage=' . $StatusID);

	}else{//Problem!  Provide feedback!
		feedback("No Changes Made To {$CodeName}", "warning");
		#send back to start
		myRedirect('profile.php?cName=' . $CodeName . '&cID=' . $CharID);
	}

}

