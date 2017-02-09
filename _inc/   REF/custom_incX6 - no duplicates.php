 <?php
function maxDoc_inc_custom_inc(){
	/**
	 * custom_inc.php stores custom functions specific to your application
	 *
	 * Keeping common_inc.php clear of your functions allows you to upgrade without conflict
	 *
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @todo add safeEmail to common_inc.php
	 */

	/**
	 * Place your custom functions below so you can upgrade common_inc.php without trashing
	 * your custom functions.
	 *
	 * An example function is commented out below as a documentation example
	 *
	 * View common_inc.php for many more examples of documentation and starting
	 * points for building your own functions!
	 */
}


# ???   DROP   ????
function get_catName($catID, $str=''){
	/**
	* get catagory name based on catagory id
	*
	* ***** Code sample *****
	* NEED CAT NAME - GET CAT ID
	* $catNameget_catName($catID, $str='')
	*
	*/

	$sqlCat = "select CatTitle, CatID from ma_Categories where CatID = {$catID}";

	$db = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$catResult = $db->query($sqlCat);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($catResult->rowCount() > 0)
	{#there are records - present data
		while($row = $catResult->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			 $str = $row['CatTitle'] ;
		}
	}else{#no records
		$str = '';
	}
	unset($catResult, $db);//clear resources
	return $str;
}


## FUNCTIONS TO REWRITE BELOW - THE WORK - CAN WORK BETTER
## CONSOLIDATE SQL/QUERIES WHEN/WHERE POSSIBLE
#ULTIMATE TOP SITES -- STACKED --
#ADD TO TOP and inbetween every 5th post maybe?

function MTS_stacked($str=''){
	$str = '<!-- Vote Picture Code -->
		&nbsp; &nbsp;
		<!-- BEGIN Marvel RPG Topsites CODE -->
		<div class="row text-center">
			<span style="display: inline">
				<a href="http://www.ultimatetopsites.com/games/MarvelVerse/">
				<img src="http://www.ultimatetopsites.com/bin/votepicture/?MarvelVerse&cat=games&ID=347"></a>
			</span>

			&nbsp; &nbsp;

			<span style="display: inline">
				<a href="https://discord.gg/S3kk9YU" title="Please join us on Discord">
					<img src="./../_img/_icons/img_discord-chat-banner-xs.png" alt="DiscordApp for Gamers" style width: 150px;>
				</a>
			</span>


	</div>
	<br /<br />


	<!-- END Marvel RPG Topsites CODE -->';

		return $str;
}


function chitChat($str=''){
	$str .= '<div class="row ">
			<div class="side-menu">
				<script src="http://www.shoutbox.com/chat/chat.js.php"></script> <script> var chat = new Chat(6065);</script>
			</div>
		</div><!-- End chitChat -->';
	return $str;
};


 /**
	* If User Privilege not equal to minimum require privilege level for access, redirect to main site index page.
	*
	* @param string $str data as entered by user
	* @return boolean returns true if matches pattern.
	*/
function chekPrivies($privReq = '0', $privChek = '0'){

	// Get User Privilege from session

	$privChek = (int)$_SESSION['Privilege']; //Cast as int

	//if Priv less then access required redirect to main index.
	if ($privChek < $privReq){
		$myURL = VIRTUAL_PATH;
		myRedirect($myURL);
	}
}

function alphaOnly($str){
/**
 * Checks data for alphanumeric characters using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 * @todo none
 */
	if(preg_match("/[^a-zA-Z]/",$str))
	{return false;}else{return true;} //opposite logic from email?
}#end onlyAlpha()

function maxNotes($deets='', $req='', $str=''){
/**
 * Displays developer notes.
 *
 * If user ID = privledge rating, displays developer notes on page.
 *
 * @param string $str data as entered by user
 * @return $str if => then Privlede level given by fucntion callOh dear .
 * @todo none
 */
	#get user id to vet access
	if(startSession() && isset($_SESSION['UserID'])){

		#get userID and prevledgies
		$uPriv = $_SESSION['Privilege'];

		#if user is equal to access, show
		if($uPriv >= 7){

			# deets comes form calling file
			$str = '<div class="row""><div class="col-sm-5 maxIt" ><h4><b>MaxDO:</b></h4>
					<small>'. $deets . '</small>
				</div></div>';
		}
		#free stuff once we start using db....
	}

	return $str;

}

function getSidebar($uName='', $uID='', $uPriv='', $str=''){
	 /*
		 make hot links


	 */

	$str .= '<div class="row row-offcanvas row-offcanvas-left">
	 <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

			<ul class="nav nav-sidebar">
				<li class="' . isActive('dashboard') . '"><a href="dashboard.php">My Homepage</a></li>
				<li class="' . isActive('userStart') . '">
					<a href="' . VIRTUAL_PATH . 'users/userStart.php">My Startpage</a>
				</li>
				<li class="' . isActive('userChars') . '">
					<a href="' . VIRTUAL_PATH . 'users/userChars.php" >My Characters</a>
				</li>
				<li class="' . isActive('userPosts') . '"  target="_ext">&nbsp; &nbsp; &nbsp; My Posts*</li>
				<li class="' . isActive('userTags') . '">&nbsp; &nbsp; &nbsp; My Tags*</li>
				<li class="' . isActive('userUpdatePassword') . '"><a href="' . VIRTUAL_PATH . 'users/userUpdatePassword.php?act=edit&uID=' . $uID . '">My Password*</a></li>
				<li class="' . isActive('userPrefs') . '"><a href="' . VIRTUAL_PATH . 'users/userPrefs.php?act=edit&uID=' . $uID . '">My Preferences*</a></li>
				<li class="' . isActive('userProfile') . '"><a href="' . VIRTUAL_PATH . 'users/userProfile.php">My Profile</a></li>
				<li class="' . isActive('userContact') . '"><a href="' . VIRTUAL_PATH . 'users/userContact.php">Contact Staff</a></li>
			</ul>';


	if($uPriv >= 4){
		$str .= '<h4>Moderator Tools<br />
		<small class="text-muted">for managing threads/characters</small></h4>
		<ul class="nav nav-sidebar">

			<li class="' . isActive('modCreateChars') . '"><a href="' . VIRTUAL_PATH . 'users/modCreateChars.php">Create Characters</a></li>

			<li class="' . isActive('modReviewChars') . '"><a href="' . VIRTUAL_PATH . 'users/modReviewChars.php">Review Characters</a></li>

			<li class="' . isActive('modReviewPosts') . '">&nbsp; &nbsp; &nbsp; Review Posts*</li>

		</ul>';
	}

	if($uPriv >= 5){
		$str .= '<h4>Admin Tools<br />
		<small class="text-muted">for managing user\'s needs</small></h4>
		<ul class="nav nav-sidebar">
		<li class="text-muted"><a href="' . VIRTUAL_PATH . 'users/adminReviewUsers.php">Review Members</a></li>
		<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/adminAddUser.php">Add User</a></li>
		<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/adminEditUser.php">Edit User</a></li>
		<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/adminResetPassword.php">Reset User Password</a></li>
		<li class="text-muted">&nbsp; &nbsp; &nbsp; Ban User*</li>
	</ul>';
	}

	if($uPriv == 7){
		$str .=  "<h4>Monkee's Tools</h4>";
		$str .=  '<ul class="nav nav-sidebar">
			<li><a href="' . VIRTUAL_PATH . 'users/maxAdminer.php">Adminer</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxSessions.php">Session Nuke</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxInfo.php">PHP_INFO</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxLogs.php">View Logs</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxLogs.php">Create Poll</a></li>
		</ul>';
	}

	$str .= '	<!-- BEGIN row --></div><!--/span-->';

	return $str;

}

function getCurrentURL($strip = true) {// filter function - get current page url
	//used in themes/bootstrape/footer_inc.php

	static $filter;
	if ($filter == null) {
		$filter = function($input) use($strip) {
			$input = str_ireplace(array(
					"\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', urldecode($input));
			if ($strip) {
					$input = strip_tags($input);
			}

			// or any encoding you use instead of utf-8
			$input = htmlspecialchars($input, ENT_QUOTES, 'utf-8');

			return trim($input);
		};
	}

	return 'http'. (($_SERVER['SERVER_PORT'] == '443') ? 's' : '')
		.'://'. $_SERVER['SERVER_NAME'] . $filter($_SERVER['REQUEST_URI']);
}

function getMyUrl() {
$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
$url .= $_SERVER["REQUEST_URI"];
return $url;
}


function isActive($page='', $userPage='', $str=''){
	#make tab 'active'
	#$path = pathinfo(__FILE__)['filename'];

	$path = $_SERVER['PHP_SELF'];
	$_SERVER["SCRIPT_NAME"];
	$break = Explode('/', $path);
	$path = $break[count($break) - 1];

	$path= str_replace('.php', '', $path);


	$file = basename($path);         // $file is set to "index.php"
	$file = basename($path, ".php"); // $file is set to "index"

	#if current page == current url, make hot by adding active class
	if($page == $file){
		$str = 'active';
	}else{
		$str = 'text-muted';
	}

	return $str;
}


//////////////////      DATA REVEIWING      /////////////////
#echo reviewNotes($aarContent['charCreation-start'], $CodeName, $Gender, $Reviewer, $Rrd1, $Rrd2, $Rrd3);

#WORKING HERE
function reviewNotes($data, $CodeName, $Gender, $Reviewer, $Rrd1, $Rrd2, $Rrd3, $str='') { #we have NumRevies, DateCreated, DateAssigned, LastUpdated, DevelopmentTime,
	# Reviewer
	# ReviewStart
	# Rrd1
	# Rrd2
	# Rrd3

	#SEE: http://prideparrot.com/blog/archive/2014/4/blog_template_using_twitter_bootstrap3_part1

	$str .= '<div class="row">
		<h2>Instructions and Review Notes for ' . $CodeName . '</h2>
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#start">Start (Images)</a></li>';

			#tabs...

			if(($_SESSION['Privilege'] > 3) || ($Rrd1 != NULL)){
				$str .= '<li class=" "><a data-toggle="tab" href="#rd1">Comments (Rd. 1)</a></li>';
			}

			if($Rrd2 != NULL){$str .= '<li class=" "><a data-toggle="tab" href="#rd1">Comments (Rd. 2)</a></li>';}
			if($Rrd3 != NULL){$str .= '<li class=" "><a data-toggle="tab" href="#rd1">Comments (Rd. 3)</a></li>';}

		$str .= '</ul>
		<div class="tab-content">';


		#starting instruction
		$str  .= customizeData($data, $Gender, $CodeName);
		#$str  .= $data;

	var_dump($Rrd1);

		#reviews and stuff

		if(($_SESSION['Privilege'] > 3) || ($Rrd1 != NULL)){$str .= getReview($Rrd1, 'rd1', '1');}
		if($Rrd2 != NULL){$str .= getReview($Rrd1, 'rd2', '2');}
		if($Rrd3 != NULL){$str .= getReview($Rrd1, 'rd3', '3');}

		$str .= '</div>



		<br />
		<br />
		<br />
		<br />




	</div>';

	return $str;
}

function customizeData($data, $cGen, $cName, $stripTags='y'){
	/**
		* Personalize data in an array
		*
		* Takes array, returns string
		*
		*
		**/
	//for content array
	#setup vars
	#setup gender nouns

#dumpDie($cName);
#var_dump($cGen);

#set up old data to new chek system
#how to update db to unified gender vars....
	if($cGen == 'male'){

		#dumpDie($cGen);
		$cgSubjective  = 'he';
		$cgObjective   = 'him';
		$cgPossessive  = 'his';
		$cgReflexive   = 'himself';

	}else if ($cGen == 'female'){
		$cgSubjective  = 'she';
		$cgObjective   = 'her';
		$cgPossessive  = 'hers';
		$cgReflexive   = 'herself';

	}else if ($cGen == 'trans'){ #based on data for gender pronouns - transsturden.org/graphics
		$cgSubjective  = 'ze';
		$cgObjective   = 'zir';
		$cgPossessive  = 'zirs';
		$cgReflexive   = 'zirself';

	}else{

		$cName = ' the character ';
		#$cGen       = 'it';
		$cgSubjective  = 'it';
		$cgObjective   = 'it';
		$cgPossessive  = 'its';
		$cgReflexive   = 'itself';
	}


	#Customize data based on gender assignments (we are sensitive to trans types)
	if($stripTags == 'y'){ $data = strip_tags($data);}

	$data = str_replace("XXXcNameXXX", 				$cName, $data);

	$data = str_replace('XXXcGenderXXX',			$cGen,  $data);

	$data = str_replace('XXXcgSubjectiveXXX',	$cgSubjective,  $data);
	$data = str_replace('XXXcgObjectiveXXX',	$cgObjective,	  $data);
	$data = str_replace('XXXcgPossessiveXXX',	$cgPossessive,  $data);
	$data = str_replace('XXXcgReflexiveXXX',	$cgReflexive,  	$data);

	$data = trim($data);

	return ucfirst(trim($data));
}

function getReview($Review='', $id='', $phase, $str=''){
	if(isset($Review)){$str .= '<div id="' . $id. '" class="tab-pane fade ">
			<!-- list of posts -->
			<article>
				<h2>Rd ' . $phase . ' comments</h2>
				<div class="row">
					<div class="group1 col-sm-6 col-md-6">
						<a href="#">The Grandmaster</a>, <a href="#">The Gardener</a>
					</div>
					<div class="group2 col-sm-6 col-md-6">
						<span class="glyphicon glyphicon-pencil"></span> <a href="singlepost.html#comments">20 Comments</a>
						<span class="glyphicon glyphicon-time"></span> August 24, 2013 9:00 PM
					</div>
				</div>
				<hr>
				<br />
				<!-- start slipsum code -->
				' . $Review . '
				<!-- end slipsum code -->
				<p class="text-right">
					<a href="#">
						Contact Reviewer
					</a>
				</p>
				<hr>
			</article>
		</div>';
	}
	return $str;
}

//////////////////         NAVIGATION         /////////////////


//create btns to specific categories, send character data via get.
//URL EX: #'. VIRTUAL_PATH . 'library/powers.php?act=combat-powers&charID=60&codeName=Ulli&statusID=5
//fed: baseURL, action, codename, id, stage(status), gender,  str
function genCatBtns($bURL='', $aKey='', $codeName='', $charID='', $stageID='', $gender='', $arrCatAct, $arrCatTT, $arrCatName, $str=''){
	//raw render


	#dumpDie($_SESSION);

	#http://localhost/WrDKv3/library/powers.php?act=combat-powers&charID=60&codeName=Ulli&statusID=5

	$str .= '<div class="row hoverHighlight">

		<div class="col-sm-3 text-right text-muted">
			<p class="text-right">
			</p>
		</div>

		<div class="col-sm-9">
			<fieldset id="RankPower">
				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group btn-group-xs" >';

						$x = count($arrCatName);
						$i = 0;
						while($i < $x) {
							$str .= '<a class="btn btn-default btn-xs" href="' . $bURL .
								'?act=' . $arrCatAct[$i] .
								'&codeName=' . $codeName .
								'&charID=' . $charID .
								'&statusID=' . $stageID .
								'&gender=' . $gender .
								'" rel="tooltip" title="' . $arrCatTT[$i] .
								'">' . $arrCatName[$i] . '</a>';

							$i++;
						}

					$str .= '</div> <!-- END stat buttons -->
				</div><!-- END toolbar -->
			</fieldset>
		</div><!-- END Container -->
	</div>

	'; //END $str
	return $str;


}







//////////////////      DATA FORMATTING      /////////////////

#make empty tr tray
function charLabel($str){
	return '<div>
			<div class="col-sm-3">
				<h3 class="label label-default pull-right "><strong>' . strtoupper($str) . '</strong></h3>
			</div>
			<div class="col-sm-9 ">
				<h3 class="text-right"> &nbsp;</h3>
			</div>

		</div>
		<div class="clearfix"></div>'; #clear fix added to control wacky row highlight
}
#Characters - act=show
#echo showNames('full name', $FullName, $Gender);
#echo showStage('full name', $FullName, $PlayerName, $StatusID, $aarStatus); #shows player/abailability, et all.

function charStage($FullName, $PlayerName, $StatusID, $aarStatus, $str=''){
	#if no names, don't show
	#if only one name, eliminate the comma

	$FullName = ltrim($FullName, ', ');
	$FullName = rtrim($FullName, ', ');

	$stage    = $aarStatus[$StatusID];

	if(getPrivies() > 0){
		$stage = ($stage <= 2 ? $stage : $stage='');

		#$str = 'Summers, Alex (stage)';
	}else{
		#simplify stage for non-members
		$stage = ( ($stage == 0) ? $stage='available for adoption' : $stage); #Zero shows as open
		$stage = ((($stage <= 1) && ($stage >= 4)) ? $stage='available for adoption' : $stage);
		$stage = ( ($stage <= 5) ? $stage='not available for adoption' : $stage);

		#$str = 'Summers, Alex (taken)';
	}

	#dumpDie($FullName);
	if ($FullName != ''){
		$title='full name';

	}else{
		$title='handler';
	}

	$str .= '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($title) . ':</strong> </p>
		</div>
		<div class="col-sm-9">
			<p> ' . $FullName . '&nbsp; <small class="text-muted">(' . $stage . ')</small></p>
		</div>
	</div>';

	return $str;

}

#echo showStrValue('power rank', $RankPower, $aarRank);
function showStrValue($title='', $aStr='', $arr='', $uc=0, $str=''){
	#if not empty, show me stuff
	if(!empty($aStr)){

		#if array make array
		if(is_array($arr) && (!empty($arr))){
			$myArr = $arr;
		}else if (!empty($arr)){
			#is a text notation of some sort
			$str = '<i><span class="text-muted"> &nbsp; (' . ucwords($arr) . ')</span></i>';
		}

		if(!empty($aStr) && ($aStr!='')){#if array exists, use array value
			if(!empty($myArr)){$aStr = $myArr[$aStr];}

			#uppercased first letter of each word?
			if($uc == 0){$aStr = ucfirst($aStr);}
			if($uc == 1){$aStr = ucwords($aStr);}

		}

		#return with array info of gender notation
		$str .='<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($title) . ':</strong></p></div>
			<div class="col-sm-9">
				<p>' . nl2br($aStr) .  nl2br($str) . '</p>
			</div>
		</div>';
	} //END if

	return $str;
}

#echo showStrValue('power rank', $RankPower, $aarRank);
function show_StrVal($title='', $val='', $arr='', $str=''){
	#if not empty, show me stuff
	if(!empty($val)){
		#return with array info of gender notation
		$str .= '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($title) . ':</strong></p></div>
			<div class="col-sm-9"><p>' . mk_Characterlink($val, $arr) . '</p></div>
		</div>';
	} //END if

	return $str;
}

#echo showStrValue('power rank', $RankPower, $aarRank);
function showStrDesc($title='', $key='', $data='', $cGen, $cName, $str=''){

	#do we have data?
	if((isset($data)) && (isset($key))){
		$data = $data[$key];
	}

	#if we have data, is it worth showing?
	if(($key != 'No') &&  ($key != '')){
		$data = customizeData($data, $cGen, $cName, $stripTags='y');
		$data = ucfirst($data);

		$data = '<p>' . ucwords($key) . ' - <em>' . $data . '</em></p>';

		#assemble return render
		$str .= '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right">	<strong>' . ucwords($title) . ':</strong></p>
			</div>
			<div class="col-sm-9">' . $data . '</div>
		</div>';

		#show the data
		return $str;
	}
	#only return if we have array data...
} //END if

#get names and character id's list
function mk_cNameLnks(){ #get all characters names and ids
	#build the possible list of characters to chk against...
	$sql = "SELECT CharID, CodeName, FirstName, MiddleName, LastName
	FROM ma_Characters";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	#actually build the associative array needed...
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		#External formatting here...
		#foreach($result as $key => $value) {
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			#make the key => value array...
			$arrMatches[(int)$row['CharID']]=dbOut($row['CodeName']);
		}
		#closing formating here...
	}

	@mysqli_free_result($result); //free resources

	#char names and ids
	return $arrMatches;
}

#make character name link to it's profile from another page
function mk_Characterlink($val, $arr_cNames, $txt='', $key='', $newStr='' ){
#make text field an array
	$arr_words = explode("\n", $val);
	#dumpDie($arr_words);

	#chek each word in string for match
	foreach($arr_words as $word) {
		#save for later replace
		$original = $word;

		$txt = preg_replace('/^.*(\(.*\)).*$/', '$1', $word);
		#chek for parens and text between them....
		$txt = preg_replace('/\(|\)/', '', $txt);

		#pred for search
		if (strpos($word, ' - ') !== false) {
			$word = substr($word, 0, strpos($word, ' - '));
		}
		$word = preg_replace('#\s*\(.+\)\s*#U', ' ', $word);

		#check for white space before and after...
		$word = ltrim($word);
		$word = rtrim($word);

		#check for white space before and after...
		$txt = ltrim($txt);
		$txt = rtrim($txt);

		#var_dump($word);
		#var_dump($txt);

		#if match make link...
		if(in_array($word, $arr_cNames) ){
		#dumpDie($word);
			#cID of character
			$key = array_search($word, $arr_cNames);

			#make link
			$link = '<a href="'
				. VIRTUAL_PATH . 'characters/profile.php?CodeName='
				. $word . '&id='
				. $key . '&act=show"
				target="_blank" data-toggle="tooltip"
				title="'
				. $word . '!"">'
				. $word . '</a>';

			$newStr .= str_replace($word, $link, $original) . '<br />';

		}else if(in_array($txt, $arr_cNames) ){
		#dumpDie($word);
			#cID of character
			$key = array_search($word, $arr_cNames);

			#make link
			$link = '<a href="'
				. VIRTUAL_PATH . 'characters/profile.php?CodeName='
				. $txt . '&id='
				. $key . '&act=show"
				target="_blank" data-toggle="tooltip"
				title="'
				. $txt . '!"">'
				. $txt . '</a>';

			$newStr .= str_replace($txt, $link, $original) . '<br />';

		}else{
			#no match - add to pile and continue on...
			$newStr .= $original . '<br />';
		}


	}
	return $newStr;
} #END function

//echo showStrValue('availability', $StatusID, $aarStatus);
function showIntValue($title='', $myInt='', $myArr='', $str=''){
	$myInt = (int)$myInt;

	$str = '<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($title) . ':</strong></p></div>
		<div class="col-sm-9"><p>' . ucwords($myArr[$myInt]) . '</p></div>
	</div>';

	return $str;
}

function showArrValue($title='', $val='', $str=''){

	$str = '<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($title) . ':</strong></p></div>
		<div class="col-sm-9"><p>' .  ucwords($val) . '</p></div>
	</div>';

	return $str;
}

#make drop down select from array
#load preselected options
#Limit load options based on privs
function mk_DDconditional($title, $name, $arr, $val, $str='' ){
	#user privilege ID
	$pID = $_SESSION['Privilege'];


	$str .= '
	<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . ucwords($title) . ': </strong></p>
		</div>
		<div class="col-sm-7">
			<div class="form-group">
				<select class="form-control" name="' . $name . '">';
				#create dropdown list - with option of select= 'selected' if matches db value!
				$count = 0;
				foreach($arr as $item)
				{ #sometimes you feel like a select
					if($count===0){
						$str .= '<option value="'. $count .'">'. $item .'</option>';

					}else if ($count==$val){
						 $str .= '<option value="'. $count .'" selected="selected">'. $item .'</option>';

					}else if ( ($pID < 4) && (($count >=4) && ($count <=5)) ){
						 $str .= '<option value="'. $count .'">'. $item .'</option>';

					}else if ($pID >= 4){
						 //show all options to mods and admins
						 $str .= '<option value="'. $count .'">'. $item .'</option>';


					}else if ($pID >= 200){
						 //handers can drop, work on and submit only
						 if($count < 5 || $count > 8){
						 //handers can drop, work on and submit only
						 $str .= '<option value="'. $count .'">'. $item .'</option>';


						}
					}
					$count++;
				}
		return $str . '</select> </div></div></div><!-- END Container -->';
	}





//////////////////      LIBRARY FUNCTION     /////////////////
/*
	functions specifically for creating the descriptions, et al for library pages of the site.
*/
function mk_overview($myAction, $titles, $content, $cName, $cID, $cGen, $page, $str=''){ #format descriptions from array and

	#remove the dashes used for urls
	$title = str_replace('-', ' ', $myAction);

	$str = '<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav">
			<br />'

		#top sites banner / discord banner to vote for us
		. MTS_stacked($str='')
		. mk_customizerForm($cName, $cGen)
		. mk_legend($cName='', $titles, $cID=0, $cGen='', $page, $str='' );

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
		<h2>' . ucwords($title) . '</h2>
		<h5><span class="glyphicon glyphicon-time"></span> Post by Monkee, October 9, 2016.</h5>
		<h5><span class="label label-danger">Advantages</span> <span class="label label-primary">Character Creation</span></h5><br>';

	$str .= customizeData($content, $cGen, $cName, 'n');

	$str .= '<p><small>
			<em class="text-muted"> <b>Note</b> - If you are logged in to ' . SITE_NAME . ', each entry shown below may already be personalized to reflect your character&quot;s codename and gender. If not, then they are shown in a generic format, but you can still set them to reflect your characters gender and codename by using the customizer located just above the catagory legend. Doing so will will instantly then format all the descriptions to your specifications to help you on your way to building an awesome addition to the  ' . SITE_NAME . ' universe.</em>
		</small></p>
		<hr />';

	return $str;
}

function mk_customizerForm($cName, $cGen, $str = ''){#creates form to personalize the descriptions
	$str='<h4><a href="#">Customize Descriptions</a></h4>
		<p>Enter characters name to personalize each &amp; every descriptions on this page to your character.</p>';
			$str .='<form action="' . htmlspecialchars(THIS_PAGE) . '" method="get">
				<input type="text" name="codeName"
					value="' . $cName . '" placeholder="Alias / Codename?"><br>
					<input type="radio" name="gender"';

					if ((isset($cGen)) && ($cGen=="female")){ $str .= "checked"; }

					$str .='value="female"> Female <input type="radio" name="gender"';

					if ((isset($cGen)) && ($cGen=="male")){ $str .= "checked"; }

					$str .='value="male"> Male
					<br /><br/>';

				$str .='<input type="hidden" name="CharID" value="0">
				<input type="submit" value="Submit">
			</form>
		<hr />';

	return $str;
}

function mk_legend($cName='', $titles, $cID, $cGen, $page, $str='' ){ #generate category legend and links from array
	#$CodeName, $CharID are fed to us via Sh
	if(isset($_GET['codeName'])){$cName = ($_GET['codeName']); }
	if(isset($_GET['charID'])){$cID 		= ($_GET['charID']); }
	if(isset($_GET['gender'])){$cGen 		= ($_GET['gender']); }

	$cID = (int)$cID; #cast as int to be safe.

	$str .= '<h4><a href="' . THIS_PAGE . '">Sections</a></h4>
		<ul class="nav nav-pills nav-stacked">';

	$count=0;

	foreach($titles as $title){
		$label = str_replace("-", " ", $title);

		#if our switch matchs, highlight legend li
		$url  = $titles[$count];
		$chek = $_SERVER['REQUEST_URI']; #get url to test match too
		#clean url for first test
		$act = str_replace("/WrDK/traits/' . $page . '.php?act=","", $chek );

		#var_dump($codeName);
		#var_dump($charID);

		if($act == $url){
				$str .= '<li class="active">
					<a style="color: white;" href="'
						. VIRTUAL_PATH . 'library/' . $page . '.php?act='
						. $titles[$count++]
						. '&codeName=' . $_SESSION['codeName']
						. '&charID=' . $cID
						. '&gender=' . $cGen
						. '">'
						. ucwords($label)
						. ' </a>
					</li>';

			#if title matches these, don't show unless admin or soemthing
			}else if($title == 'magic&ndash;&#76;ike' || $title == 'restricted'){

				$str .= '<li>
					<a class="" href="' . VIRTUAL_PATH . 'library/' . $page . '.php?'
						. '&codeName=' . $cName
						. '&charID=' . $cID
						. '&gender=' . $cGen
						. '">'
						. ucwords($label)
						. '<sup>*<sup> </a>
					</li>';

					[$count++];

			#show me unhighlighted all others
			}else{
				$str .= '<li>
					<a  href="' . VIRTUAL_PATH . 'library/' . $page . '.php?act='
						. $titles[$count++]
						. '&codeName=' . $cName
						. '&charID=' . $cID
						. '&gender=' . $cGen
						. '">'
						. ucwords($label)
						. ' </a>
					</li>';
			}
	}

	$str .= '</ul>';

	return $str;
}

function mk_categoryBtns($sql, $codeName='', $page, $dbFx, $str='' ){ #generate cat descs...
	#act/myAction already set on line #115

	#if we have a codename
	if(empty($codeName)){$codeName='your character';}

	$sql = "SELECT {$dbFx}Name, Available FROM `ma_Char{$dbFx}s` WHERE CatID = '$sql'; ";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#BEGIN external formatting
		$str .= '<div class="btn-toolbar btn-group-justified">';
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$traitName  = dbOut($row[ $dbFx . 'Name']);
			$traitAvail = dbOut($row['Available']);

			$traitLink  = str_replace ('-', ' ', $traitName);

			$traitName = strtolower($traitName);

			#uppercase everything up to first paren, then "small"
			#creat anchors - see: http://www.echoecho.com/htmllinks08.htm
			$str .= '<small><a class="btn btn-primary btn-xs " href="#' . $traitLink . '">' . strtolower($traitName) . '</a></small>';
		}
		#END external formatting
		$str .= '</div><hr />';
	}

	@mysqli_free_result($result); //free resources

	return $str;
}

function mk_category($sql, $cat, $charID, $cName, $cGen, $stageID, $page, $qFix, $dbFx, $str='' ){ #generate cat descs...
#dumpDie($sql);

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#BEGIN external formatting
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$catID   = (int)dbOut($row[$dbFx . 'ID']); #$dbFx . 'ID' = 'AdvantageID', et al.
			$catName = dbOut($row[$dbFx . 'Name']);
			$catDesc = dbOut($row[$dbFx . 'Desc']);
			$catDesc = customizeData($catDesc, $cGen, $cName, $stripTags='x');
			$catLink = str_replace('', ' ', $catName);

			#uppercase everything up to first paren, then "small"
			#creat anchors - see: http://www.echoecho.com/htmllinks08.htm
			$str .= '<p><strong class="text-primary"><a name="' . $catLink . '">' . ucwords($catName) . '</a>: (#' . ucwords($catID) . ')</strong> <br />' . $catDesc . '</p>';


			if(isset($stageID) && ($stageID >= 3)){$str .= '<a
				class="btn btn-info pull-left btn-xs"
				href="' . VIRTUAL_PATH  . 'library/char_advantages.php?act=addTrait&catID='
																. $cat	        #combat-skills - combat-skills
				. '&' . $qFix . 'ID='   . $catID  		  #1             - beserker	id num
				. '&' . $qFix . 'Name=' . $catName  		#name of trait - beserker
				. '&' . $qFix . 'ID=' 	. $catID       #character id  - 60
				. '&codeName='  		. $cName     #codename      - Ully
				. '&stageID='   		. $stageID			#3-6 = can add a power, else nope
				. '"
				title="Click to add ' . $advantageName . '  to ' . $cName . '"><span class="glyphicon glyphicon-plus"></span> Add ' . strtoupper($powName) . ' power to ' . $cName . '</a>';
			}


			#Edit trait
			#$_SESSION['Privilege'] >= 4
			if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] >= 4)){$str .= '<a class="btn btn-info pull-right btn-xs" href="' . VIRTUAL_PATH .'library/char_advantages.php?act=edit&powName=' . $catName . '&CatID=' . $cat . '" title="Click to edit"><span class="glyphicon glyphicon-edit"></span></a>';
			}
			$str .= '<br /><hr />';
		}
	}else{//no records
			echo '<p>Currently No Matching Descriptions Available.</p><hr />';
	}

	@mysqli_free_result($result); //free resources

	#personalize data
	# $str = customizeData($str, $cGen, $cName, $stripTags='x');



	if(isset($_SESSION['Privilege']) && ($_SESSION['Privilege'] >= 4)){

		#$_SESSION['Privilege'] >= 6

		#add additional cheks
		#if is admin, suepr, owner, developer or is player show edit option.

		$str .= '<div align="center">
					<a class="btn btn-primary btn-sm" href="' . THIS_PAGE . '?act=add&cat=' . $cat .'"><i class="glyphicon glyphicon-pencil"></i> add an advantage</a>
				</div>';
	}



	return ucfirst($str);
}

function getURL() {
	$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
								=== FALSE ? 'http' : 'https';
	$host     = $_SERVER['HTTP_HOST'];
	$script   = $_SERVER['SCRIPT_NAME'];
	$params   = $_SERVER['QUERY_STRING'];

	$currentUrl = $protocol . '://' . $host . $script . '?' . $params;

	return $currentUrl;
}




////////////////////    THREADs FORMS ????????????

##################   HELPER FUNCTION$   ##################
function formatUrl($str, $sep='-'){ #convert white space to dashes for urls
	$res = strtolower($str);
	$res = preg_replace('/[^[:alnum:]]/', ' ', $res);
	$res = preg_replace('/[[:space:]]+/', $sep, $res);
	return trim($res, $sep);
}

function selectCat($myDropdown=''){
	/**
	 * Create dropdown select for category/team to filter forum
	 *
	 */

	$myDropdown .='<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button"
				data-toggle="dropdown">Select Category<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="' . THIS_PAGE . '">Most Recent Threads</a></li>';


			$sql = "SELECT CatID, CatSort, CatTitle, CatVisible FROM ma_Categories;";
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results

				#Organize catagories
					$myGroup = $myPeeps = $myOrg = '';

				while ($row = mysqli_fetch_assoc($result))
				{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

					if(($row['CatSort']) == 'team'){

						#we want them alphanumeric AND to show!

						$catName = $row['CatTitle'];
						$myGroup .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&tID=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';

					} else if(($row['CatSort']) == 'person'){

						$catName = $row['CatTitle'];
						$myPeeps .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&tID=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';;

					}else{

						$catName = $row['CatTitle'];
						$myOrg .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&tID=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';

					}
				}

				#now order them neatly
				if(!empty($myGroup)){
					$myDropdown .= '<li class="divider"></li>
					<li class="dropdown-header">Teams</li>'
					. $myGroup;
				}

				if(!empty($myOrg)){
					$myDropdown .= '<li class="divider"></li>
					<li class="dropdown-header">Organizations</li>'
					. $myOrg;
				}


				if(!empty($myPeeps)){
					$myDropdown .= '<li class="divider"></li>
					<li class="dropdown-header">Individuals</li>'
					. $myPeeps;
				}
			}

			@mysqli_free_result($result); //free resources

			if(startSession() && isset($_SESSION['UserID'])){
				$myDropdown .= '<li class="divider"></li>
				<li class="dropdown-header">Dropdown header 2</li>

				<li><a href="' . THIS_PAGE . '?act=threadAdd" >New Thread</a></li>


				<li class="divider"></li>
				<li class="dropdown-header">Admin Only</li>

				<li><a href="' . THIS_PAGE . '?act=categoryAdd" " >New Category</a></li>';
			}

			$myDropdown .= '</ul>
		</div>';

	return $myDropdown;

}

function threadSidebar($type='', $sql, $tID='', $tURL='', $str=''){
	$str = '<row>
		<div class="side-menu">
			<nav class="navbar navbar-default" style="background-color: #fff;">
				<ul class="list-unstyled">';
				if($type == 'IC'){
					$str .= '<li style="background-color: orange;">Recently Active IC Threads</li>';
				}else{
					$str .= '<li style="background-color: Skyblue;">Recently Active OC Threads</li>';
				}


				$result = mysqli_query(IDB::conn(), $sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
				if (mysqli_num_rows($result) > 0)//at least one record!
				{//show results
					while ($row = mysqli_fetch_assoc($result))
					{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
						if($type == ($row['ThreadType'])){

							$tID  = (int)$row['ThreadID'];
							$tURL = $row['ThreadTitle'];

							$str .= '<li>
							<a href="' . THIS_PAGE . '?act=threadShow&tID=' . $tID . '&ttl=' . $tURL . '" />' . $tURL . '</a>
						</li>';
						}
					}
				}else{//no records
						$str .= "<li>There are currently no active $type threads. Wierd. We will have to do something about that.</li>";
				}
				@mysqli_free_result($result); //free resources

			$str .= '</ul>
			</nav>
		</div>
	</row>';

	return $str;
}



function get_pDetails($pFormattedID, $pOrder, $pLocation, $pWeather, $gTime, $pNotes,
$pTags, $rtID, $act, $btnGroup, $tTitle,
$tType, $catID, $titleEncoded, $tType, $tRateEncoded,
$twEncoded, $phaseEncoded, $timeEncoded, $locationEncoded, $whenEncoded,
$titleEncoded, $priv, $hID, $uID , $str=''	){
	#make OOP SEE: http://php.net/manual/en/datetime.settime.php
	$format = 'Y-m-d h:i';

	$str = '<div class="col-sm-4">
		<small>
			<p><strong>Post &raquo; </strong> [' . $pFormattedID  . '] </p>';

			# if not set, don't show
			if(isset($pOrder) 	 && !empty($pOrder))	 { $str .=  '<p><strong>Post Order &raquo; </strong> ' . $pOrder . ' </p>';}
			if(isset($pLocation) && !empty($pLocation)){ $str .=  '<p><strong>Where &raquo; </strong> ' . $pLocation . ' </p>';}
			if(isset($pWeather)  && !empty($pWeather)) { $str .=  '<p><strong>Weather &raquo; </strong> ' . $pWeather . ' </p>';}
			if(isset($gTime)  	 && !empty($gTime))	   { $str .=  '<p><strong>When &raquo; </strong> ' . $gTime = date($format, $gTime) . ' </p>';}
			if(isset($pNotes)  	 && !empty($pNotes))	 { $str .=  '<p><strong>Notes &raquo; </strong> ' . nl2br($pNotes) . ' </p>';}
			if(isset($pTags)  	 && !empty($pTags))		 { $str .=  '<p><strong>Tags &raquo; </strong>' . get_pTags($pTags) . '</p>';}
			if(isset($pTags) 		 && !empty($pTags))		 { $str .=  '<p><strong>Mentions &raquo; </strong>' . get_pTags($pTags) . '</p>';}

			if(startSession() && isset($_SESSION['UserID'])){
				$priv = $_SESSION['Privilege'];

				$hID = (isset($_SESSION['UserID'])) 	? $_SESSION['UserID']  : 0;

				#QUERY STRINGS for buttons - this way its easier to edit/revise them all in one place
				$pQueryEdit  = '?act=postEdit';
				$pQueryEdit  .= '&uID=' . $hID
										 .	'&cat=' . $catID
										 .  '&tID=' . $rtID
										 .  '&pID=' . $pFormattedID
										 .  '&ttl=' . $titleEncoded
										 .  '&typ=' . $tType
										 .  '&pOdr='. $pOrder
										 .  '&rtg=' . $tRateEncoded
										 .  '&wet=' . $twEncoded
										 .  '&phs=' . $phaseEncoded
										 .  '&tme=' . $timeEncoded
										 .  '&loc=' . $locationEncoded
										 .  '&whn=' . $whenEncoded; #addd min 67 seconds to it...

				#URL Sanitized
				$pQueryEdit = htmlspecialchars($pQueryEdit, ENT_QUOTES);

				#dumpDie($pQueryAdd);
/*
	$pQueryEdit   = '?act=threadEdit&tID='   . $rtID . '&title=' . $titleEncoded;
	#URL Sanitized
	$pQueryEdit = htmlspecialchars($pQueryEdit, ENT_QUOTES);
	$pQueryEdit = htmlentities($pQueryEdit);

	$pQueryRemove = '?act=threadRemove&tID=' . $rtID . '&title=' . $titleEncoded;
	#URL Sanitized
	$pQueryRemove = htmlspecialchars($pQueryRemove, ENT_QUOTES);
	$pQueryRemove = htmlentities($pQueryRemove);

	$pQueryLock   = '?act=threadLock&tID='   . $rtID . '&title=' . $titleEncoded;
	#URL Sanitized
	$pQueryLock = htmlspecialchars($pQueryLock, ENT_QUOTES);
	$pQueryLock = htmlentities($pQueryLock);
*/


				#btngroup for post here
				#REVIEW  edit
				$btnGroup .= '<a href="' . VIRTUAL_PATH . 'threads/index.php' . $pQueryEdit . '" data-toggle="tooltip" title="Edit Post!"><span class="glyphicon glyphicon-edit" aria-hidden="true"></a></span>  &nbsp ';


#http://localhost/WrDKv4/threads/index.php?act=threadAdd&catID=2&catName=young-avengers


				#GET CAT NAME for spinout
				$catName = '';
				$catName= get_catName($catID);
				#SPIN OUT  new thread
				$btnGroup .= '<a href="./index.php?act=threadAdd&catID=' . $catID . '&catName=' . $catName . '" data-toggle="tooltip" title="Spin Out New Thread"><span class="glyphicon glyphicon-share" aria-hidden="true"></a></span>  &nbsp ';

/*
	#REVIEW  Post
	$btnGroup .= '<a href="" data-toggle="tooltip" title="Review post"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></a></span>  &nbsp ';

	#MOVE  Post
	$btnGroup .= '<a href="" data-toggle="tooltip" title="Move Post"><span class="glyphicon glyphicon-share" aria-hidden="true"></span></a></span>  &nbsp ';


	#FLAG  Lock
	$btnGroup .= '  &nbsp   &nbsp <a href="" data-toggle="tooltip" title="Bookmark"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a></span>  &nbsp ';



	#FLAG  bookmark
	$btnGroup .= '  &nbsp   &nbsp <a href="" data-toggle="tooltip" title="Bookmark"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></a></span>  &nbsp ';

	#FLAG  Post
	$btnGroup .= '<a href="" data-toggle="tooltip" title="Flag"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></a></span>  &nbsp ';
*/

				$str .= $btnGroup;
			}


		$str .=  '</small>
	 </div><!-- end right sidebar details -->';

	return $str;
}

function mk_cThumb($cID, $str=''){
	#get character info for tooltip from  ma_Characters
	$sqlTT = "SELECT Codename, Overview, Waiver, Team FROM ma_Characters WHERE CharID = $cID;"; #ToolTip
	$cName = $cOverview = $cWaiver = $cTeam = '';#initialize
	$resultTT = mysqli_query(IDB::conn(),$sqlTT) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	$dbTT = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$resultTT = $dbTT->query($sqlTT);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($resultTT->rowCount() > 0)
	{#there are records - present data
		#set values needed for tool tip
		while($rowTT = $resultTT->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			$cOverview = $rowTT['Overview'];
			$cWaiver   = $rowTT['Waiver'];
			$cTeam     = $rowTT['Team'];
			$cName     = $rowTT['Codename'];
		}
	}
	unset($resultTT, $dbTT); #free resources

	#verify Image or use FPO
	#create Image Path
	$filename = './../uploads/_assigned/' . $cID . '-1t.jpg';
	#Verify image exists, show
	if (file_exists($filename)) {
		$filename = VIRTUAL_PATH . 'uploads/_assigned/' . $cID . '-1t.jpg';
	}else{
		#no image, use fpo static
		$filename =  VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 8). '.gif';
	}

/*


http://localhost/WrDKv4/_img/_static/static---005.gif



*/





	#construct the polyThumb
	$str .= '<div class="text=center">
			<a href="' . VIRTUAL_PATH . 'characters/profile.php?id=' . $cID . '&act=show"
				target="_blank" data-toggle="tooltip" data-placement="right" title="" data-container="body" class="tooltiplink" data-html="true"
				data-original-title="' . $cName . ' >> ' . $cOverview . '"
				>
				<img src="' . $filename . '" alt="' . $cName . '" style="width:50px">
			</a>
		</div>';

	return $str;

}
#doesn't work with safari for some reason :(
function mk_PolyThumb($cID, $str=''){
	#get character info for tooltip from  ma_Characters
	$sqlTT = "SELECT Codename, Overview, Waiver, Team FROM ma_Characters WHERE CharID = $cID;"; #ToolTip

	$codeName = $overview = $waiver = $team = '';#initialize


	$resultTT = mysqli_query(IDB::conn(),$sqlTT) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	$dbTT = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$resultTT = $dbTT->query($sqlTT);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($resultTT->rowCount() > 0)
	{#there are records - present data
		#set values needed for tool tip
		while($rowTT = $resultTT->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			$overview = $rowTT['Overview'];
			$waiver = $rowTT['Waiver'];
			$team = $rowTT['Team'];
			$codeName = $rowTT['Codename'];
		}
	}
	unset($resultTT, $dbTT); #free resources

	#verify Image or use FPO
	#create Image Path
	$filename = '../uploads/'. $cID . '-1t.jpg';
	#Verify image exists, show
	if (file_exists($filename)) {
		$filename = $filename;
	}else{
		#no image, use fpo static
		$filename =  '../_img/_static/static---00' . rand(0, 8). '.gif';
	}


	#construct the polyThumb
	$str .= '
		<div><a href="' . VIRTUAL_PATH . 'characters/profile.php?id=' . $cID . '&act=show"
			target="_blank" data-toggle="tooltip" data-placement="right" title="" data-container="body" class="tooltiplink" data-html="true"
			data-original-title="' . $codeName . ' >> ' . $overview .'"
			>

				<!--- for polygons -->
				<svg class="clip-svg">
					<defs>
						<clipPath id="polygon-clip-hexagon" clipPathUnits="objectBoundingBox">
							<polygon points="0.5 0, 1 0.25, 1 0.75, 0.5 1, 0 0.75, 0 0.25"></polygon>
						</clipPath>
					</defs>
				</svg>

				<div class="polygon-each-img-wrap">
					<img src="' . $filename . '" alt="demo-clip-heptagon" class="polygon-clip-hexagon">
				</div>
		</a></div>

		<div>
			<p class="text-center"><small><strong>' . $codeName . '</strong></small></p>
		</div>';

	return $str;

}

#make associative array with character link AND tooltip annotation
function get_cLinks(){
	$sqlTags = "SELECT Codename, CharID, Overview FROM ma_Characters;";
	$result = mysqli_query(IDB::conn(), $sqlTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		$count = 0;
		$aar = [];

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$cName 			= $row['Codename'];
			$cID   		  = $row['CharID'];
			$cOverView  = $row['Overview'];
			#nl2br($cOverivew)

			#add in comma/seperator
			$aar[$cID]['link'] = '<a
				data-toggle="tooltip" title="' . $cOverView . '"
				href="'.VIRTUAL_PATH.'characters/profile.php?CodeName='.$cName.'&id='.$cID.'&act=show">'.$cName.'</a>';

			#$aar[$cID]['overview'] = [$cOverView];
		}
		#return an array of links with tooltips
		return $aar;
	}
	@mysqli_free_result($result);
}

function get_pTags($postTags, $str = ''){
	#process $postTags into SQL friend list
	$postTags = "'" . str_replace(array("'", ","), array("\\'", "','"), $postTags) . "'";
	#assemble the sql
	$sqlTags = "SELECT Codename, CharID, Overview FROM ma_Characters
	WHERE CharID IN ($postTags);";

	$resultTags = mysqli_query(IDB::conn(), $sqlTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($resultTags) > 0)//at least one record!
		{//show results

			$count = 0;

			while ($row = mysqli_fetch_assoc($resultTags))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$myCodeName 			= $row['Codename'];
				$myCharID   			= $row['CharID'];
				$myCharOverivew   = $row['Overview'];

				#add in comma/seperator
				If($count++ >= 1){ $str .= ', ';}

				$str .= '<a href="'
					. VIRTUAL_PATH . 'characters/profile.php?CodeName='
					. $myCodeName . '&id='
					. $myCharID . '&act=show"

					target="_blank" data-toggle="tooltip"
					data-placement="left"

					title=""
					data-container="body"

					class="tooltiplink"
					data-html="true"

					data-original-title="' . nl2br($myCharOverivew)  . '"
					>' . $myCodeName . '</a>';
			}
		}

	return $str;

	@mysqli_free_result($resultCharTags);
}

#get all related posts, paged
function get_pPaged($rtID, $tally, $act, $btns, $tTitle, $tType, $catID, $titleEncoded, $tType, $tRateEncoded, $twEncoded, $phaseEncoded, $timeEncoded, $locationEncoded, $whenEncoded, $titleEncoded, $priv, $hID, $uID ,$str='', $btnGroup=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	$titleEncode = str_replace(' ', '_', $tTitle); 	#URL safe

	if(isset($_GET['tOrder']) && !empty($_GET['tOrder'])){$tOrder = ($_GET['tOrder']);} else {$tOrder ='';}

	#pare this down to what is needed once we know what we need
	$sql = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType, PostOrder, PostApproval, PostRating, PostVisible, PostFrom, PostFeaturing, PostPhaseOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags, DatePostLock, DatePostPost, DatePullPost, LastEditor, DateCreated, DateAssigned, LastUpdated FROM ma_Posts
		WHERE ThreadID = $rtID
		ORDER BY PostID
		$tOrder;"; #is either DESC or ASC

	$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";

	#reference images for pager
	$prev = '<span class="glyphicon glyphicon-step-backward"></span>';
	$next = '<span class="glyphicon glyphicon-step-forward"></span>';
	#user privs to eval if they can post

	# Create instance of new 'pager' class
	$pager = new Pager($tally,'',$prev,$next,'');
	$sql = $pager->loadSQL($sql);  #load SQL, add offset

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if (mysqli_num_rows($result) > 0)//at least one record!
	{#records exist - process

		#only make the charactere array if we need it - be kind to db
		#make array of links to character bios $cArr[$cID] ;
		$cLinxArr = get_cLinks();

		if($pager->showTotal()==1){ $itemz = "post"; }else{ $itemz = "posts"; }  //deal with plural

		#build $str post by post
		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$hID							= (int)$row['UserID']; #the creator
			$tID 							= (int)$row['ThreadID'];
			$cID							= (int)$row['CharID'];

			if(isset($_SESSION['UserID'])){
				$uID					= $_SESSION['UserID']; #this is the viewer
			}else{
				$uID					= ''; #this is the viewer
			}

			#because the index starts at 'one', we add 'one' to the id count to map
			if($cID != ''){$cName = $cLinxArr[$cID]['link'];}else{$cName = '';}


			/**
			 * ADD SQL JOIN STATEMENT TO GET TITLE - remove all the gets
			 * MAKE POST cause we inject here and this is not a bookmark page
			 *
			 &@TODO convert usage to $_POST
			 */



			#$tTitle    		= $row['ThreadTitle'];


			$titleEncoded = str_replace(' ', '_', $tTitle); 	#URL safe

			#format post id to 4 places
			$pID   						= (int)$row['PostID'];
			$pFormattedID  		= str_pad($pID, 4, '0', STR_PAD_LEFT);

			#format time post updated
			$update       		= date_create($row['LastUpdated']);
			$gDate 						= date_format($update, 'Y-m-d H:i:s a');
			$pOrder    				= $row['PostOrder'];
			$pLocation    		= $row['PostLocation'];
			$pLocEncode  			= str_replace(' ', '_', $pLocation); 	#URL safe

			$pWeather     		= $row['PostWeather'];
			$pWeatherEncode   = str_replace(' ', '_', $pWeather); 	#URL safe

			$pContent     		= dbOut($row['PostContent']);
			$pContentEncode   = htmlentities($pContent, ENT_QUOTES | ENT_IGNORE, "UTF-8");

			$pNotes       		= dbOut($row['PostNotes']);

			#get char ids for tags
			$pTags 						= $row['PostTags'];
			$gTime = strtotime('2016-09-03 14:55:24');
			$pSummary      		= dbOut($row['PostSummary']);

			$rID = $pID;


			#process text so html entitles are safely enabled

			$pContentEncode = html_entity_decode($pContentEncode);

			#BEGIN main content
			$str .=  '<!-- MAIN CONTENT begin -->
				<div class="pull-left">
					<hr />
					<div class="col-xs-1"  style="margin-left: -20px; margin-right: 10px;">'
						. mk_cThumb($cID) . '
					<br /></div>
					<p class="col-sm-7 col-xs-11">
						<strong>' . $cName . ' &raquo; </strong> ' .  nl2br($pContentEncode) . '
					</p>';

			$str .= get_pDetails($pFormattedID, $pOrder, $pLocation, $pWeather, $gTime, $pNotes,
				$pTags, $rtID, $act, $btnGroup, $tTitle,
				$tType, $catID, $titleEncoded, $tType, $tRateEncoded,
				$twEncoded, $phaseEncoded, $timeEncoded, $locationEncoded, $whenEncoded,
				$titleEncoded, $priv, $hID, $uID);

			$str .=  '<div>
			';
		}
		#show buttons at end too
		if($pager->showTotal() >= 1){ $str .= '<div calss="clearfix"><br /></div>' . $btns . '</div><div calss="clearfix"><br /></div>'; } else { $str .= '</div>';}

		#give to pager -- $btnGroup;

		$str .=  $pager->showNAV(); # show paging nav, only if enough records

	}else{#no records

		if(isset($_SESSION['UserName'])){
			$str .=  "<p><br />Currently no posts - This looks like a job for <i>" . $_SESSION['UserName'] . "!</i></p>";
		}else{
			$str .=  "<p><br />Currently There are no posts available.</i></p>";
		}
		#$str .=  "<p><br />Currently no posts. This looks like a job for <i>" . $_SESSION['UserName'] . "!</i></p>";
	}

	$str .= '<!-- END post/content --></div>';

	return $str;

}

#takes codename conversts to CharID
function get_proxyChar($cProxy, $cID){
	if(empty($cID)){
		#pull char id which matches character name
		$sql  = "SELECT CharID, Codename FROM ma_Characters Where Codename = '$cProxy';";

		$db = pdo(); # pdo() creates and returns a PDO object

		#$result stores data object in memory
		try {$result = $db->query($sql);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

		if($result->rowCount() > 0) {
			#there are records - present data
			while($row = $result->fetch(PDO::FETCH_ASSOC))
			{# pull data from associative array
				 $cID = (int)$row['CharID'];
			}
		}
	}
	return $cID;
	unset($result,$db);//clear resources
}

#HANDLER FUNCTIONS
function get_tNames($sql, $arrTags=''){
/**
	 * create a key/index array of CharIDs/Names
	*/

	if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

	#$sql = 'SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters';

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//make array

		$arrTags[] = 'No Character'; #occupy zero index

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
										#key
			$arrTags[] = $row['Codename'];

		}
	}
	@mysqli_free_result($result); //free resources

	return $arrTags;
} #END getTags

function get_hName($uID, $hName=''){
	$sql = "SELECT UserID, UserName FROM ma_Users WHERE UserID = {$uID};";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		#External formatting here...
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$hName .= dbOut($row['UserName']);
		}
		#closing formating here...
	}else{//no records
			$hName .= 'unknown';
	}

	@mysqli_free_result($result); //free resources
	return $hName;
}


#make drop down select from array - load preselected options - also in profiles
function mk_DD($myTitle, $myName, $myArray, $myValue ){

	$myDropdown  = ''; #initialize

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
#get value from the basic radio settings for OCFC and StatusID - also in profiles
function mk_radio( $myTitle, $myName, $myValue, $myChek1, $myChek2, $myDesc1, $myDesc2 ){
	#initialize needed variables
	$str   = $chekd1 = $chekd2 = '';

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

#handler details
function get_hDetails($hID='', $pID='', $str=''){
	/**
	 * Helper Function
	 * get_hDetails returns a link (Handler Name, Handler ID)
	 *
	 * This ultimately will point to handlers user-page.
	 * Handler's user-page will only be accessible by those logged in/approved (not guests).
	 *
	 * The associated view page,view_pager.php is virtually identical toview.php.
	 * The only difference is the pager version links to the list pager version to create a
	 * separate application from the original list/view.
	 *
	 *
	 * @package ma-v1608-04
	 * @author monkeework <monkeework@gmail.com>
	 * @version 0.1.1 1608-04
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @seeindex.php?act=threadShow&tID=1
	 * @see Pager.php
	 * @todo none
	 */

	$sqlHID = "SELECT UserID, UserName, Privilege FROM ma_Users WHERE UserID = $hID";

	$resultHID = mysqli_query(IDB::conn(), $sqlHID) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	$dbHID = pdo(); # pdo() creates and returns a PDO object

	try {$resultHID = $dbHID->query($sqlHID);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($resultHID->rowCount() > 0)
	{#there are records - present data
		#set values needed for tool tip
		while($rowHID = $resultHID->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			#Creat user link to user profile page
			$str .= '<p id="handlerID">
				<strong>By &raquo; </strong> <a href="#' . $rowHID['UserID'] . '">' . $rowHID['UserName'] . '</a><br />
					<a href="' . VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID=' . $pID . '">Edit</a> | <a href="' . VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID=' . $pID . '">Remove</a>
			</p>';
		}
	}else{ #NO Hanlder, return link to edit the post
		$str .= '<p id="handlerID">
				<a href="' . VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID=' . $pID . '&">Edit</a> | <a href="' . VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID=' . $pID . '">Remove</a>
			</p>';
	}
	unset($resultHID, $dbHID); #free resources

	return $str;

}



###################   POST/THREAD FUNCTION$   ###################
###################   POST/THREAD FUNCTION$   ###################
###################   POST/THREAD FUNCTION$   ###################

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function categoryShow($sql, $sqlTags, $str='', $rCatName='', $catDesc=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	#requested data
	$rCatID      = (int)$_GET['tID'];
	$rCatName    = test_input($_GET['categoryName']);


	$sqlCat = "SELECT CatID, CatTitle, CatType, CatSort, CatDescription, CatVisible FROM ma_Categories WHERE CatID = {$rCatID};";

	$result = mysqli_query(IDB::conn(),$sqlCat) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		#External formatting here...
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$catDesc = dbOut($row['CatDescription']);
		}
		#closing formating here...
	}else{//no records
			$catDesc =  '<p>Category description not given</p>';
	}

	@mysqli_free_result($result); //free resources


	$str .= '<!-- start general content -->
	<div class="col-md-9 pull-right">
		<h4><strong>' . $rCatName . '</strong> Most Recent Postings </h4>

		<p>' . nl2br($catDesc) . '</p>

		<div class="bs-example">
			<div class="panel-group" id="accordion">';

			#reference images for pager
			$prev = '<span class="glyphicon glyphicon-backward"></span>';
			$next = '<span class="glyphicon glyphicon-forward"></span>';

			# Create instance of new 'pager' class
			$myPager = new Pager(10,'',$prev,$next,'');
			$sql = $myPager->loadSQL($sql);  #load SQL, add offset

			# connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results

				if($myPager->showTotal()==1){$itemz = "thread";}else{$itemz = "threads";}  //deal with plural

				$str .=  '<div align="center">' . $myPager->showTotal() . ' ' . $itemz . ' currently available.</div>';

				while($row = mysqli_fetch_assoc($result))
				{# process each row

					$tID 				= (int)$row['ThreadID'];
					$catID    	= (int)$row['CatID'];

					#if category matches selected category show
					if($catID == $rCatID){

						$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">

								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $tID . '"> ' . $row['ThreadTitle'] . ' </a>

								<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&tID=' . $tID . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
							</h4>
						</div>

						<div id="collapse-' . $tID . '" class="panel-collapse collapse">
							<div class="panel-body">
								<p>'. $row['ThreadSummary'] . '</p>
								<p>';

								#set ground work for tags
								$threadTag 	= $row['ThreadTag'];
								$arrTags 		= explode(',', $threadTag);
								$arrNames 	= get_tNames($sqlTags);

								#dumpDie($arrTags);

								#if we have tags show them
								if ((isset($threadTag)) && (!empty($threadTag))){
									//$str .= '';

									$x = 0;
									$tot = count($arrTags);

									#make links, comma seperated
									foreach($arrTags as $key => $value)
									{
										$str .=  '<a href="../characters/profile.php?CodeName=CodeName&tID=' . $value . '">' . $arrNames[$value] . '</a>, ';
									}
								}else{
									$str .=  '<span class="text-muted"><span class="glyphicon glyphicon-tag"></span>  No Tags Currently Set</span>';
								}

								$str .=  '</p>
								<p><a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&tID=' . $tID . '"> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';

					}
				}

			@mysqli_free_result($result); //free resources

			$str .= $myPager->showNAV(); # show paging nav, only if enough records

			$str .= '</div>';

		}else{#no records
			$str .= "<div align=center>There are currently no active threads for $rCatName. Drats!!<br />
			We should really do something about that soon.</div>";
		}

	$str .='</div><!-- end accordian -->';



	#http://localhost/WrDKv4/threads/index.php?act=threadAdd


#BUTTONS begin -- Add Thread -- Edit Thread -- Delete Category




if(startSession() && isset($_SESSION['UserID'])){
	$priv = $_SESSION['Privilege'];

	#ADD new thread
	$str .= '<div >';


	$str .= '<a href="' . THIS_PAGE . '?act=threadAdd&catID=' . $rCatID . '&catName=' . formatUrl($rCatName) . '" class="btn btn-info btn-xs" role="button"><span class="glyphicon glyphicon-plus" title="Add New Thread To  ' . $rCatName . '"></span> Add New Thread To  ' . $rCatName . '</a>';


	#mod or better...
	if( $priv >= 3){

		$str .= '<a href="' . THIS_PAGE . '?act=categoryEdit&id=' . $rCatID . '&categoryName=' . formatUrl($rCatName) . '" class="btn btn-info btn-xs pull-right" role="button"><span class="glyphicon glyphicon-edit" title="Edit ' . formatUrl($rCatName) . '"></span> ' . $rCatName . ' Catagory</a>';
	}
	$str .= '</div><!-- END Buttons -->';
}

	return $str;
	#BUTTONS end
}

function categoryAdd($str=''){
	/**
	 * create a new category
	 */

	#Get referring page to send users back to
	$previous = $_SERVER['HTTP_REFERER'];

	$str .= '<!-- start general content -->
		<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>

		<script type="text/javascript">

			function checkForm(thisForm)

			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}

		</script>


		<div class="row" style=""><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="CatID" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="">

					<!-- left container -->
					<div class="col-sm-8 pull-left" style="">
						<h4 class="text-center">Add New Catagory</b></h4>';




							$str .= '<div class="row ">
								<div class="pull-middle">

									<select class="selectpicker" name="CatSort" required>
										<option value="person" select="select">Group By: Indivual</option>
										<option value="team">Group By: Group/Team</option>
										<option value="organization">Group By: Organization</option>
									</select>


									<select class="selectpicker" name="CatSort" required>
										<option value="individual" select="select">Catagory Type: IC</option>
										<option value="team">Catagory Type: OOC</option>
									</select>

								</div>
							</div><!-- END Container -->

							<div class="row">
								<input
									class="col-sm-12"
									type="text"

									name="CatTitle"
									placeholder="Team/Group/Character Name here"/>
							</div><!-- END Container -->

							<div class="row">
								<textarea
									name="CatDescription"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Catagory Description"
									></textarea>
							</div><!-- end container-->


					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="">

					<input  type="hidden" name="act" value="categoryInsert" />
					<input class="btn btn-primary btn-xs " type="submit" value="Add Catagory">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . $previous . '">Exit Post</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}

function categoryInsert($str=''){

	#dumpDie($_POST);
	#PDO Setup needed vars...
	$catID 						= $_POST['CatID'];
	$catSort 					= $_POST['CatSort'];
	$catTitle 				= $_POST['CatTitle'];
	$catType 					= $_POST['CatType'];
	$catDescription 	= $_POST['CatDescription'];

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
		$sql = "INSERT INTO ma_Categories (
				CatID, CatTitle, CatType, CatDescription
			)
			VALUES (
				:CatID,
				:CatTitle,
				:CatType,
				:CatDescription
			)";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $catID,						PDO::PARAM_STR);
	$stmt->bindValue(2, $catTitle,				PDO::PARAM_STR);
	$stmt->bindValue(3, $catType,					PDO::PARAM_STR);
	$stmt->bindValue(4, $catDescription,	PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Category Added Successfully To Site!","success");
	}else{//Problem!  Provide feedback!
		feedback("Category NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}

function categoryEdit($str=''){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{

		$myCatID = ($_GET["id"]);
		# ADD - DateCreated, DateAssigned, LastUpdated to table
		$sql = "select CatID, CatTitle, CatType, CatSort, CatDescription, CatVisible
			FROM ma_Categories WHERE CatID = $myCatID ;";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results

		# shows details from a single customer, and preloads their first name in a form.
		$str .= '
		<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

		<script type="text/javascript">

			function checkForm(thisForm)

			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}

		</script>';


		$str .= '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db
				$catID 						= dbOut($row['CatID']);
				$catTitle    			= dbOut($row['CatTitle']);
				$catType 					= dbOut($row['CatType']);
				$catSort  				= dbOut($row['CatSort']);
				$catDescription		= dbOut($row['CatDescription']);
				$catVisible  			= dbOut($row['CatVisible']);

				$str .= '<form action="' . THIS_PAGE . '" method="post"
					onsubmit="return checkForm(this);">

							<input  type="hidden" name="CatID" value="' . $catID . '" />

							<h4 align="center">Edit Catagory (' . $catTitle . ')</h4>

							<!-- inner container -->
							<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

								<!-- left container -->
								<div class="col-sm-8 pull-left" style="background-color: #ddd ;">

									<div class="row ">
										<div class="pull-middle">

											<select class="selectpicker" name="CatType" required>
												<option value="IC" select="select">Category Type: IC</option>
												<option value="OOC"               >Category Type: OOC</option>
											</select>

											<select class="selectpicker" name="CatSort" required>
												<option value="organization" select="select">Group By: Indivual</option>
												<option value="team"                        >Group By: Group/Team</option>
												<option value="person"                      >Group By: Organization</option>
											</select>

											<select class="selectpicker" name="CatSort" required>
												<option value="0" select="select">Visible: Yes</option>
												<option value="1"                >Visible: No</option>
											</select>

										</div>
									</div><!-- END Container -->

									<div class="row">
										<input
											class="col-sm-12"
											type="text"

											name="CatTitle"
											value="' . $catTitle . '"
											placeholder="Team/Group/Character Name here"/>
									</div><!-- END Container -->

									<div class="row">
										<textarea
											name="CatDescription"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Catagroy Description"
											>' . $catDescription . '</textarea>
									</div><!-- end container-->

								</div><!-- end inner container -->

							<div class="clearfix">
								<br /><br />
							</div>

							<div
								align="center"
								style="background-color: #a0a;">







								<input  type="hidden" name="act" value="categoryRevise" />







								<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Catagory">

								&nbsp; &nbsp;

								<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '">Exit Event</a>';

								if(startSession() && isset($_SESSION['UserID'])){
									$str .= '&nbsp; &nbsp;

									<!-- set to invisible actually -->
									<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '?act=categoryRemove&id=' . $catID . '&categoryName=' . formatUrl($catTitle) . '">Remove Catagory</a>';
								}

							$str .= '</div>

						</form>';

					}

				}else{//no records
					$str .= '<div align="center">
						<h3>Currently No Events Listed in the Timeline.</h3>
					</div>';
				}

			return $str;

			@mysqli_free_result($result); //free resources

		} else { #redirect back to timeline

			#myRedirect('index.php');
		}
}

function categoryRevise(){
	$catVisible = '';

	$CatID 						= strip_tags($_POST['CatID']);
	$CatTitle    			= strip_tags($_POST['CatTitle']);
	$CatType 					= strip_tags($_POST['CatType']);
	$CatSort  				= strip_tags($_POST['CatSort']);
	$CatDescription		= strip_tags($_POST['CatDescription']);
	$CatVisible		    = strip_tags($_POST['CatVisible']);

	#if(isset($_POST['CatVisible'])) {$CatVisible  			= strip_tags($_POST['CatVisible'])};

	$db = pdo(); # pdo() creates and returns a PDO object

	$sql = "UPDATE `ma_Categories`
		SET
			`CatID` 					= :CatID,
			`CatTitle` 				= :CatTitle,
			`CatType` 				= :CatType,
			`CatSort` 				= :CatSort,
			`CatDescription`  = :CatDescription,
			`CatVisible` 			= :CatVisible,

		WHERE `CatID`       = :CatID";

	$stmt = $db->prepare($sql);

	//The Primary Key of the row that we want to update.
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':CatID', 					$CatID, 						PDO::PARAM_INT);
	$stmt->bindValue(':CatTitle',     	$CatTitle, 					PDO::PARAM_INT);

	$stmt->bindValue(':CatType',  			$CatType, 					PDO::PARAM_STR);
	$stmt->bindValue(':CatSort',   			$CatSort, 					PDO::PARAM_STR);
	$stmt->bindValue(':CatDescription', $CatDescription, 		PDO::PARAM_STR);
	$stmt->bindValue(':CatVisible',     $CatVisible, 				PDO::PARAM_STR);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Category Revised Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Category NOT REVISED!","warning");
	}
	#myRedirect(THIS_PAGE);

}

function categoryRemove(){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		$CatID			 	= strip_tags($_GET['id']);	#int - primaryKey

		$db = pdo(); # pdo() creates and returns a PDO object

		$sql = "DELETE FROM ma_Categories WHERE CatID = :CatID";

		$stmt = $db->prepare($sql);
		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->bindValue(':CatID', $CatID, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback("Category Removed Successfully","success");
		}else{//Problem!  Provide feedback!
			feedback("Category Not Trashed!","warning");
		}
		myRedirect(THIS_PAGE);
	}
	#script for expanding textarea
}




#...?act=threadAdd&cID=10&catName=brooklyn-heights
function threadAdd($sql, $sqlTags, $str=''){
	/**
	 * create a new thread:D
	 */

	$arr_cIdcName = mk_cIDcName($_SESSION['UserID']);

	#ternairy operator - shorthand if/else statement...
	isset($_GET['catID']) ? ($catID = $_GET['catID']) : ($catID = 0);

	#ternairy operator - shorthand if/else statement...
	isset($_GET['catName']) ? ($catName = ' </b>to ' . $_GET['catName']) . '</b>' : ($catName = ' to <b>general</b>');
	#$catName   		= $_GET['catName'];

	$tID 					= '';
	$tTitle    		= '';
	#$pPhaseOfDay = $_POST['PostPhaseOfDay'];
	$tPhaseOfDay 	= '';
	$tTimeOfDay   = ''; #addd min 67 seconds to it...

	$tLocation = '';
	$pWeather = ''; #addd min 67 seconds to it...
	$tWhen = ''; #addd min 67 seconds to it...

	#$pID = (int)$row['PostID'];
	#temp arrays
	#$arrPostType = ['Post Type', 'IC', 'OOC', 'Guidance', 'Journal', 'Timeline'];
	$arrMyChars = ['a', 'b', 'c'];
	$arrCemoji = [1,2,3,4,5];

	$str .= '<!-- start general content -->
		<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

		<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}
		</script>';


#MIDDLE CONTAINER   begin
function gen_tMidContainer($tID, $catID, $catName, $str=''){ #

		$str .= '<div class="row" style=" "><!-- begin content -->
			<form action="' . THIS_PAGE . '?act=threadInsert" method="post" onsubmit="return checkForm(this);" >

				<input  type="hidden" name="ThreadID" value="' . $tID . '" />
				<input  type="hidden" name="CatID"    value="' . $catID . '" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style=" ">

					<!-- left container -->
					<div class="col-sm-6 pull-left" style=" ">
						<h4 class="text-center">Add thread ' . $catName . '</h4>

						<div class="row">
								<input class="col-sm-12" type="text" name="ThreadTitle" placeholder="Thread Title..."/>
						</div><!-- END Container -->

						<div class="row">
								<textarea name="ThreadContent" id="text"

									class="autoExpand col-sm-12" rows="7" data-min-rows="3"

									placeholder="Scene set text here"
									></textarea>

								<div id="result">
									Words: <span id="wordCount">0</span> | Total Characters(including trails): <span id="totalChars">0</span>
								</div>

							</div><!-- END Container -->

							<div class="row">
								<textarea
									name="ThreadSummary"
									id="text"

									class="autoExpand col-sm-12"
									rows="$arr_cIdcName3"
									data-min-rows="3"

									placeholder="Please Summarize the thread Scene Set here in 140 words or less..."
									></textarea>

								<div id="result">
									Words: <span id="wordCount">0</span> | Total Characters(including trails): <span id="totalChars">0</span>
								</div>

							</div><!-- END Container -->
						</div>
						<!-- LEFT CONTAINER end -->';

		return $str;

	}
	$str .= gen_tMidContainer($tID, $catID, $catName);




#RIGHT CONTAINER   begin
$str .= '<!-- RIGHT CONTAINER start -->
						<div class="col-sm-2 pull-right" style=" ">
							<h4 class="text-center">Post Details</h4>';


		#THREAD TYPE   begin
		function tType($str=''){
			#returns an array -- $db, $table, $column
				#We use constant DB_NAME here because db name is not the same locally as it is globally/live on web.
				#Local it's maTest - live it's dbchampions.
				$enum = get_enum(DB_NAME, 'ma_Threads', 'ThreadType');

			#name dropdown
			$arrThreadType[] = 'Thread Type'; #add descriptor to dropdown

			#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
			foreach($enum as $item){
				#remove data after a certain character
				#$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
				#$item = substr($item, 0, $cut_position);

				// Assign each value to the array as you cycle through
				$arrThreadType[] = $item;
			}

			#make dropdown
			$str .= mk_pDD('ThreadType', $arrThreadType, 'ThreadType') . '<br /><br />';
			return $str;
		}
			$str .= 	tType();


		#THREAD RATING   begin
		function tRating($arr_cIdcName, $str=''){
			#returns an array -- $db, $table, $column
				#We use constant DB_NAME here because db name is not the same locally as it is globally/live on web.
				#Local it's maTest - live it's dbchampions.
				$enum = get_enum(DB_NAME, 'ma_Threads', 'ThreadRating');
				#shorten descriptions

				#name dropdown
				$arrPostRating[] = 'Thread Rating';

				#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
				foreach($enum as $item){
					#remove data after a certain character
					$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
					$item = substr($item, 0, $cut_position);

					// Assign each value to the array as you cycle through
					$arrPostRating[] = $item;
				}

				#make dropdown
				$str .= mk_pDD('ThreadRating', $arrPostRating, 'ThreadRating') . '<br /><br />';

			return $str;
		}
			$str .= tRating($arr_cIdcName);


		#THREAD AS   begin
		function postAs($arr_cIdcName, $str=''){
			$str .= '<select class="selectpicker" name="cID">
					<option selected="selected">Post As</option>';
						$key ='';
						foreach($arr_cIdcName as $key => $item) {
							#$key = key($arr_cIdcName);
							$str .= '<option value="' . $key . '">' . $item['cName'] . '</option>';
						}
				$str .= '</select><br /><br />';

				/*
				<select class="selectpicker">
					<optgroup label="myCharacters">
						<option name="CharID" value="1">Char A</option>
						<option name="CharID" value="2">Char B</option>
					</optgroup>
					<optgroup label="npcs-assigned">
						<option>npc A</option>
						<option>npc B</option>
						<option>npc C</option>
						<option>npc D</option>
						<option>npc E</option>
					</optgroup>
					<optgroup label="npcs-general">
						<option>general A</option>
						<option>general B</option>
					</optgroup>
					<optgroup label="npcs-restricted">
						<option>restrict A</option>
						<option>restrict B</option>
						<option>restrict C</option>
					</optgroup>
				</select>
			*/

			return $str;
		}
			$str .= postAs($arr_cIdcName);


#PHASE-OF-DAY   begin
		#returns an array -- $db, $table, $column
		#We use constant DB_NAME here because db name is not the same locally as it is globally/live on web.
		#Local it's maTest - live it's dbchampions.
		$enum = get_enum(DB_NAME, 'ma_Threads', 'ThreadPhaseOfDay');
		#shorten descriptions

		#name dropdown
		$arrDayPhase[] = 'Phase of Day';

		#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
		foreach($enum as $item){
			#remove data after a certain character
			#$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
			#$item = substr($item, 0, $cut_position);

			// Assign each value to the array as you cycle through
			$arrDayPhase[] = $item;
		}

		#make dropdown
		$str .= mk_pDD('ThreadPhaseOfDay', $arrDayPhase, 'ThreadPhaseOfDay') . '<br /><br />';
		#PHASE-OF-DAY   end





#cEMOJI   begin
#cEMOJI   begin
#cEMOJI   begin

#$str .= mk_pDD('cEmoji', $arrCemoji, 'cID');

#cEMOJI   end
#cEMOJI   end
#cEMOJI   end






#CURRENT TIME   end
$str .= '<input
	class=""
	type="text"

	name="ThreadTimeOfDay"
	value="' . $tTimeOfDay . '"
	placeholder="0000-00-00 00:00:00"/>
<!-- end container-->';







#CURRENT WEATHER   begin
#CURRENT WEATHER   begin
#CURRENT WEATHER   begin

	#CURRENT WEATHER   begin
		#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
	#We use constant DB_NAME here because db name is not the same locally as it is globally/live on web.
	#Local it's maTest - live it's dbchampions.
	$enum = get_enum(DB_NAME, 'ma_Posts', 'PostWeather');
	#shorten descriptions

	#name dropdown
	$arrPostWeather[] = 'Current Weather';

	#clean up array -- $enum returns $arrPostType[]
	foreach($enum as $item){
		#remove data after a certain character
		#$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
		#$item = substr($item, 0, $cut_position);

		// Assign each value to the array as you cycle through
		$arrPostWeather[] = $item;
	}

	#make dropdown
	$str .= mk_pDD('ThreadWeather', $arrPostWeather, 'ThreadWeather') . '<br /><br />';
	#CURRENT WEATHER   end

#CURRENT WEATHER   begin
#CURRENT WEATHER   begin
#CURRENT WEATHER   begin





#LOCATION
#LOCATION
#LOCATION

							#LOCATION
							$str .= '<div class="row">
								<input
									class=""
									type="text"

									name="ThreadLocation"
									value="' . $tLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


<!--
		<div class="row">
			<input
				class=""
				type="text"

				name="ThreadTimeOfDay"
				value="' . $tWhen . '"
				placeholder="When?"/>
		</div>
-->




							<div class="row">
								<textarea class="autoExpand col-sm-12" rows="3" data-min-rows="3"
									name="ThreadNotes"
									placeholder="OOC Notes? "
									></textarea>
							</div><!-- end container-->

							<!-- auto fill needed -->
							<div class="row">
								<input class="" type="text"
									name="ThreadTag"
									placeholder="Tags? Get from reply"/>
							</div><!-- end container-->

						</div><!-- end right container -->
					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div align="center">

					<input  type="hidden" name="act" value="threadInsert" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Thread">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . VIRTUAL_PATH . '">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}

function threadInsert($sqlThreads, $sqlTags, $str=''){

	echo '<h1>Thread Insert function</h1>';

	echo '<pre>';
	echo var_dump($_SESSION);
	echo '<pre>';

	#dumpDie($_POST);


	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		#Here we get all the submitted form data

		$tID   							= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		$cID   							= strip_tags($_POST['cID']);


		$threadType    			= strip_tags($_POST['ThreadType']);				#chk
		$threadRating   		= strip_tags($_POST['ThreadRating']);			#chk
		$threadPhaseOfDay   = strip_tags($_POST['ThreadPhaseOfDay']);	#chk
		$threadTimeOfDay   	= strip_tags($_POST['ThreadTimeOfDay']);	#chk
		$threadWeather    	= strip_tags($_POST['ThreadWeather']);		#chk
		$threadLocation   	= strip_tags($_POST['ThreadLocation']);		#chk
		$threadContent    	= strip_tags($_POST['ThreadContent']);		#chk
		$title    					= strip_tags($_POST['ThreadTitle']);			#chk
		$threadNotes    		= strip_tags($_POST['ThreadNotes']);			#chk
		$threadSummary    	= strip_tags($_POST['ThreadSummary']);		#chk
		$threadTag    			= strip_tags($_POST['ThreadTag']);				#chk



		$db = pdo(); # pdo() creates and returns a PDO object
				#`ThreadID` = :ThreadID, #MOVED OUT OF SET
		$sql = "INSERT INTO ma_Threads(
			ThreadID, CatID, CharID,
			ThreadType, ThreadRating,
			ThreadPhaseOfDay, ThreadTimeOfDay, ThreadWeather,
			ThreadLocation, ThreadContent,
			ThreadTitle, ThreadNotes, ThreadSummary, ThreadTag

			) VALUES (

			:ThreadID,
			:CatID,
			:CharID,
			:ThreadType,
			:ThreadRating,
			:ThreadPhaseOfDay,
			:ThreadTimeOfDay,
			:ThreadWeather,
			:ThreadLocation,
			:ThreadContent,
			:ThreadTitle,
			:ThreadNotes,
			:ThreadSummary,
			:ThreadTag
		)";


		$stmt = $db->prepare($sql);


		//The Primary Key of the row that we want to update.
		$stmt = $db->prepare($sql);
			$stmt->bindParam(':ThreadID',					$tID, 							PDO::PARAM_INT);
			$stmt->bindParam(':CatID',						$catID, 						PDO::PARAM_INT);
			$stmt->bindParam(':CharID',						$cID, 							PDO::PARAM_INT);

			$stmt->bindParam(':ThreadType',				$threadType, 				PDO::PARAM_INT);
			$stmt->bindParam(':ThreadRating',			$threadRating, 			PDO::PARAM_INT);
			$stmt->bindParam(':ThreadPhaseOfDay',	$threadPhaseOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadTimeOfDay',	$threadTimeOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadWeather',		$threadWeather, 		PDO::PARAM_INT);

			$stmt->bindParam(':ThreadLocation',		$threadLocation, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadContent',		$threadContent, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTitle',			$title, 						PDO::PARAM_STR);
			$stmt->bindParam(':ThreadNotes',			$threadNotes, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadSummary',		$threadSummary, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTag',				$threadTag, 				PDO::PARAM_STR);



		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update


		#dumpDie($db->errorInfo());
		#die;

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback("$title Was Successfully Revised!","success");
		}else{//Problem!  Provide feedback!
			feedback("$threadTitle NOT REVISED!","warning");
		}
		myRedirect(THIS_PAGE);
	}
}

#function threadClone($sql, $sqlTags, $str=''){  TODO  }

function threadEdit($sqlThreads, $sqlTags, $str=''){
	#Get referring page to send users back to
	$previous = $_SERVER['HTTP_REFERER'];

	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{

		$rID = ($_GET["tID"]);

		$sqlThreads = "SELECT ThreadID, CatID, PostID, UserID, CharID,
			ThreadType, ThreadRating, ThreadApproval,
			ThreadVisible, ThreadFrom, ThreadFeaturing,
			ThreadPhaseOfDay, ThreadTimeOfDay,
			ThreadWeather, ThreadLocation,
			ThreadContent, ThreadTitle, ThreadNotes, ThreadSummary,
			ThreadTag,
			DateLockThread, DatePostThread, DatePullThread, LastEditor,
			DateCreated, DateAssigned, LastUpdated FROM ma_Threads
			WHERE ThreadID = $rID;";


		$result = mysqli_query(IDB::conn(),$sqlThreads) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		#dumpDie($result);          #hmmmmmm

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results

			# shows details from a single customer, and preloads their first name in a form.
			$str .= '<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

			<script type="text/javascript">

				function checkForm(thisForm)

				{//check form data for valid info
					if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
					if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
					if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
					return true;//if all is passed, submit!
				}

			</script>';


			$str .= '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';


				while ($row = mysqli_fetch_assoc($result))
				{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db
					$threadId 				= dbOut($row['ThreadID']);

					$threadType    		= dbOut($row['ThreadType']);
					$threadRating    	= dbOut($row['ThreadRating']);
					$threadWeather    = dbOut($row['ThreadWeather']);

					$title    	= dbOut($row['ThreadTitle']);
					$threadContent 		= dbOut($row['ThreadContent']); #addd min 67 seconds to it...
					$threadSummary    = dbOut($row['ThreadSummary']);

					$threadPhaseOfDay = dbOut($row['ThreadPhaseOfDay']);
					$threadTimeOfDay 	= dbOut($row['ThreadTimeOfDay']); #addd min 67 seconds to it...

					$threadLocation 	= dbOut($row['ThreadLocation']);
					$threadWeather 		= dbOut($row['ThreadWeather']); #addd min 67 seconds to it...
					$threadNotes 			= dbOut($row['ThreadNotes']); #addd min 67 seconds to it...

					$threadTag 			= dbOut($row['ThreadTag']); #addd min 67 seconds to it...

					$threadWhen = 'tbs'; #to - be - set



					$str .= '<form action="' . THIS_PAGE . '" method="post"
						onsubmit="return checkForm(this);">

					<input  type="hidden" name="ThreadID" value="' . $threadId . '" />


					<!-- inner container -->
					<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

						<!-- left container -->
						<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
							<h4 class="text-center">Edit <b>' . $title .  '</b></h4>

							<div class="row">
									<input
										class="col-sm-12"
										type="text"

										name="ThreadTitle"
										value="' . $title . '"
										placeholder="Thread Title..."/>
								</div><!-- END Container -->

								<div class="row">
									<textarea
										name="ThreadContent"
										id="text"

										class="autoExpand col-sm-12"
										rows="3"
										data-min-rows="3"

										placeholder="The first post or post details or something?"
										>' . $threadContent . '</textarea>

										<div id="result">
											Total Characters(including trails): <span id="totalChars">0</span><br/>
										</div>

								</div><!-- END Container -->

								<div class="row">
									<textarea
										name="ThreadSummary"
										id="text"

										class="autoExpand col-sm-12"
										rows="3"
										data-min-rows="3"

										placeholder="Please Summarize your Post here in 140 characters or less..."
										>' . $threadSummary . '</textarea>

										<div id="result">
											Total Characters(including trails): <span id="totalChars">0</span><br/>
										</div>

								</div><!-- END Container -->

								<!-- <div class="row">
								<p>show if notes exist, show if mod or player AND notes exist</p>
									<textarea
										name="PostNotes"

										class="autoExpand col-sm-12"
										rows="3"
										data-min-rows="3"

										placeholder="Moderator Notes funciton to come..." ></textarea>
									-->
								</div>
							<!-- END Container -->
						</div>
<!-- END left container -->
<!-- Right container -->

						<div class="col-sm-2 pull-right" style="background-color: #0aa;">
							<h4 class="text-center">Thread Details</h4>

							<div class="row">
									<select class="selectpicker" name="ThreadPhaseOfDay" value="' . $threadPhaseOfDay . '">';
										$myArray = ['Pre-Dawn','Early Morning','Morning','Midday','Early Afternoon','Afternoon','Early Evening','Evening','Midnight','Late Night'];
										#create dropdown list - with option of select= 'selected' if matches db value!
										$count = 0;

										foreach($myArray as $item)
										{ #sometimes you feel like a select
											if($item == $threadPhaseOfDay){
												 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
											}else{
												 #sometimes you don't
												 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
											}
										}
									$str .= '</select>
							</div><!-- end container-->

							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadTimeOfDay"
									value="' . $threadTimeOfDay . '"
									placeholder="0000-00-00 00:00:00"/>
							</div><!-- end container-->

							<div class="row">
								<select class="selectpicker" name="CatID" value="">
									<option>Team - f2c </option>
									<option>Person - f2c </option>
									<option>Organization - f2c </option>
								</select>
							</div><!-- end container-->

							<div class="row">
									<select class="selectpicker" name="ThreadType" value="' . $threadType . '">';
										$myArray = ['IC',
																'OOC',
																'Announcement',
																'Guidance',
																'Journal',
																'Timeline'];
										#create dropdown list - with option of select= 'selected' if matches db value!
										$count = 0;

										foreach($myArray as $item)
										{ #sometimes you feel like a select
											if($item==$threadType){
												 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
											}else{
												 #sometimes you don't
												 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
											}
										}
									$str .= '</select>
							</div><!-- end container-->


							<div class="row">
									<select class="selectpicker" name="ThreadRating" value="' . $threadRating . '">';

										$myArray = ['G - General Audiences PG',
																'PG - Strong language used PG-13',
																'PG-13 - Strong violence or language used',
																'R - Restricted: Strong sexual or violent situations described',
																'NC-17 - Explicit Sexual/Graphic situations described',
																'X - Hee, hee, hee!'];
										#create dropdown list - with option of select= 'selected' if matches db value!
										$count = 0;

										foreach($myArray as $item)
										{ #sometimes you feel like a select
											if($item==$threadRating){
												 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
											}else{
												 #sometimes you don't
												 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
											}
										}

									$str .= '</select>
							</div><!-- end container-->


							<div class="row">
									<select class="selectpicker" name="ThreadWeather" value="' . $threadWeather . '">';

									$myArray = ['GOOD - Clear',
															'FAIR - Partly',
															'Overcast/Cloudy',
															'FAIR - Overcast/Cloudy',
															'MILD - Cloudy, Occasional Drizzle',
															'OVERCAST - Overcast OVERCAST - Partly Foggy',
															'OVERCAST - Foggy',
															'STORMY - Drizzle',
															'STORMY - Rain',
															'STORMY - Thunder & Lightning',
															'STORMY - Snow',
															'STORMY - Icestorm',
															'HAZARDOUS - Blizzard',
															'HAZARDOUS - Hurricane',
															'HAZARDOUS - Partial Eclipse',
															'HAZARDOUS - Full Eclipse'];
									#create dropdown list - with option of select= 'selected' if matches db value!
									$count = 0;

									foreach($myArray as $item)
									{ #sometimes you feel like a select
										if($item==$threadWeather){
											 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
										}else{
											 #sometimes you don't
											 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
										}
									}

								$str .= '</select>
							</div>


							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadLocation"
									value="' . $threadLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadTimeOfDay"
									value="' . $threadTimeOfDay . '"
									placeholder="When?"/>
							</div><!-- end container-->



							<div class="row">
								<textarea
									name="ThreadNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="OOC Notes? "
									>' . $threadNotes . '</textarea>
							</div><!-- end container-->


								<!-- auto fill needed -->
							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadTag"
									value="' . $threadTag . '"
									placeholder="Tags? Get from reply"/>
							</div><!-- end container-->


						</div><!-- end right container -->
					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="background-color: #a0a;">

					<input  type="hidden" name="act" value="threadRevise" />
					<input  type="hidden" name="ThreadID" value="' . $rID . '" />

					<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Thread">

					&nbsp; &nbsp; ';

					if(startSession() && isset($_SESSION['UserID'])){
						$str .= '<!-- set to invisible actually -->
						<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '?act=threadRemove&id=' . $threadId . '&threadName=' . formatUrl($title) . '">Remove Thread</a> &nbsp; &nbsp; ';
					}

					$str .= '<a class="btn btn-primary btn-xs outline" href="' . $previous . '">Exit Post</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

					}

				}else{//no records
					$str .= '<div align="center">
						<h3>Currently No Events Listed in the Timeline.</h3>
					</div>';
				}

			return $str;

			@mysqli_free_result($result); //free resources

		} else { #redirect back to timeline

			myRedirect('index.php');
		}
}





#returns an array of character indexs involved in threads to match against
#used in threads and posts
function mk_charIndex($str ='')
{

	#get full index of possible character names and id's from current session
	$aCharNameIndex = [];

	#$aCharChk = $_SESSION["charIndex"]; #array character check

	#select statement
	#$sql = "SELECT  `PostID`, `ThreadID`, `UserID`,`CharID`, `PostOrder` FROM `ma_posts` ORDER BY `ThreadID`";

	$sql = "SELECT  DISTINCT `ThreadID`, `PostID`, `CharID`, `PostOrder` FROM `ma_Posts` ORDER BY `ThreadID`;";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#hold temporty data
		$aSortArray = [];

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$tID	   = (int)$row['ThreadID'];
			$pID  	 = (int)$row['PostID'];
			$cID  	 = (int)$row['CharID'];
			#$uID  	 = (int)$row['UserID'];
			$pOrder  = (int)$row['PostOrder'];


			$aCharNameIndex[] = [
				'ThreadID'  => $tID,
				'PostID'    => $pID,
				'CharID'    => $cID,
				#'UserID'    => $uID,
				'PostOrder' => $pOrder,
			];

			if ($cID > 0){
				# test values being indexed - print to browser
				$str .= $tID . ' || ' . $cID . ' || ' . $pOrder . '<br />';
				#$aCharNameIndex[$threadID] = $pID ;
			}

		}

			#sort sub array in main array
			#array of arrays
			#$aCharNameIndex = $aTempArray;

		#closing formating here...

		return $aCharNameIndex;
	}
	@mysqli_free_result($result); //free resources

}





/**
	* mk_cFeaturedLinks -> create a string of character links who are involved in a thread
	*
	* Todo lots
	* @return string of formated html char links
	*/
function note_mkcFeatureLins_WORK_GOOD($str ='!!! MAKE IT WORK GOOD !!!'){
/*


Alternatively, you can do it with one loop, using an array as a hash map to determine whether or not you've already printed a character.  Rough example:



$seen = [];
foreach($aCharNameIndex[0] as $data) {
	if($data['ThreadID'] == $threadID && !isset($seen[$characterID]) {
		echo "<a href=\"#\">$characterId</a>";
		$seen[$characterId] = true;
	}
}







Looks like hash map is the term Java uses for their implementation and hash table is the generic term.

This gets very CS very fast
https://en.wikipedia.org/wiki/Hash_table

Your $aCharNameIndex array is the perfect example for this.  Let's say you want to know the character ID of a given post ID.  Your array is arranged in a seemingly random order.  So to implement this function, here's what you have to do:

function getCharacterIdForPostId($aCharNameIndex, $postId) {
	foreach($aCharNameIndex as $data) {
		if($data['PostId'] == $postId) {
			return $data['CharId'];
		}
	}
	return null;
}

If we query for post 32, we only have to do one loop iteration before we find it.  If we query for post 51, we have to get all the way to the end of the list before we find it.  If we query for 99999, we'll get through the entire list and never find what we want.  Assuming that each iteration of the loop takes the same amount of time, we can say that the runtime of this function in its worst case is n, where n is the number of elements in the array.

But what if I told you I can get the worst case scenario down to 1 loop iteration?  Does it sound too good to be true?  It's not!  Instead, we declare the data differently:

$postData = [
	32 => 0,
	51 => 0,
];

Here, we set the array key to the post ID and the value of each element to the character ID.  But we can actually set the array values to anything we want, so let's replicate the same data:

$postData = [
	32 => ['ThreadID' => 0, 'CharID' => 0, 'PostOrder' => 0],
	51 => ['ThreadID' => 20, 'CharID' => 0, 'PostOrder' => 0],
];

Now if we want to find the Character ID for post 51, we just say:
if(isset($postData[51])) {
	echo $postData[51]['CharId'];
}
Or the thread ID for post 32:
if(isset($postData[32])) {
	echo $postData[32]['ThreadId'];
}


A quick note on hash tables: You'll probably be seeing stuff about "buckets".  Here's an example of how that might be used.

Let's say you're a hospital and you have a database of all your patients and who their primary care provider is.  You keep track of your patients by their social security number.  If it's a big hospital, you'll have thousands and thousands of patients and you can't store all that data in memory.  So you store it off on disk somewhere but the hash table helps you quickly get to the right spot for a certain patient.  Let's just say that this hospital is huge and has 10,000,000 patients.  If we just use the SSN as the key, in the worst case scenario we would have to iterate over ten million records to get to the patient we're looking for.  So instead we create a bucket for each of the parts of the SSN.  So when we go to look up the data for patient 456-78-9012, we take the first set of digits, 456, and look through our first list which contains the first three digits of all the SSNs of all our patients.  We end up at the 456 bucket and then have to look through 100 more buckets to find the 78 bucket.  Once we have that, there's only a thousand records to look through so we can iterate over those much quicker than if there were ten million to look through.

That may actually be pretty confusing without a diagram.  Don't worry if it doesn't make sense; it's not super important at this point.
*/

}

function note_mkcFeatureLins_WORK($str ='!!! MAKE IT WORK !!!'){
/*

	MAKE IT WORK
	You have too much code in your initial loop.

	You are using the "foreach($aCharNameIndex[0] as $data)
	{" to preprocess your data but you start dealing with it before you have finished processing your data.}

Your call to array_unique is pointless as there's nothing that is ever done with the resulting array.

MATCH all data in $aCharNameIndex to corresponding CharID's
RETURN link of each character name, linking to their character profile

TO DO THIS - two loops.
LOOP ONE   - filter the data,
LOOP TWO   - iterate over that filtered data, creat links.

RETURN LINKS


*/

}

function mk_cFeaturedLinks($threadID, $aPosts, $aChars=[], $aParticipants=[], $postParticipantID=0, $str='') {

 /**
	* config function
	*
	*
	*
	* @param
	* @TODO ? Nothing
	**/

	#get charIndex from $_SESSION
	if(isset($_SESSION['charIndex'])){ $aChars=$_SESSION['charIndex']; }


	#1st foreach - get participating charIDs from participating posts matching $threadID
	#if threadID exists AND matches, get character id
	if(isset($threadID)){
		#get the id of the character associated with individual post

		#temp array -> is destroy/reinitialized
		$arrTemp = [];
		foreach($aPosts[0] as $arrData) {
		/*
			dumpDie($arrData);

			array (size=4)
			'ThreadID' => int 0
			'PostID' => int 32
			'CharID' => int 0
			'PostOrder' => int 0
		*/

			# if ThreadID = Given ThreadID
			if($arrData['ThreadID'] == $threadID){
				#(int)$tempThreadID = $arrData['ThreadID'];
				#(int)$tempPostID 	= $arrData['PostID'];
				(int)$tempCharID 	= $arrData['CharID'];
				#(int)$tempOrderID  = $arrData['PostOrder'];

				#save character id from post data to array to clean of multiples/duplicates
				#get character id associated with individual post - get it - comes from posts array
				#$postParticipantID = $arrData['CharID'];

				if(($tempCharID != 0) && (!empty($tempCharID))){
					#if it has data and is not empty, get data
					$arrTemp[] = $tempCharID;
				} #END inner if
			} #END outer if

		}#END foreach

		$aParticipants = array_unique($arrTemp);
		#echo ' <br /><br /> ';
	} #END if


	# array_filter remove all values equal to null, 0, '' or false.
	$aParticipants = array_filter($aParticipants);

	if(!empty($aParticipants)){

		var_dump($aParticipants);

	}















	//get participant id
	if($postParticipantID != 0){
		#make participant character link
		foreach($aChars[0] as $charID) {

#var_dump($charID);
			#match postParticipantID to charID
			if($charID == $postParticipantID){

				$str .= $_SESSION['charIndex'][$charID] . ', ';

			}
		} #END inner foreach
	}#END inner if


	//if no data - tell me no data
	if(!isset($threadID)){ return 'No Thread ID Found'; }

	return $str;
} #END mk_cFeaturedLinks














function threadRecent($sql, $sqlTags, $tId='', $str='', $postOrder =''){
	/**
	 * Show the most recent posts, set pager to 3 for test
	 */

	$str .= '<!-- start general content -->

	<div class="col-sm-9 col-xs-12 pull-right">
		<div class="bs-example">
			<div class="panel-group" id="accordion">';

			#reference images for pager
			$prev = '<span class="glyphicon glyphicon-backward"></span>';
			$next = '<span class="glyphicon glyphicon-forward"></span>';

			# Create instance of new 'pager' class
			$myPager = new Pager(10,'',$prev,$next,'');
			$sql = $myPager->loadSQL($sql);  #load SQL, add offset

			# connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results


				if($myPager->showTotal()==1){$itemz = "thread";}else{$itemz = "threads";}  //deal with plural

				$str .=  '<div align="center">' . $myPager->showTotal() . ' ' . $itemz . ' currently available.</div>';

				while($row = mysqli_fetch_assoc($result))
				{# process each row

					$tID 		= (int)$row['ThreadID'];
					$tTitle = $row['ThreadTitle'];
					$tURL 	= THIS_PAGE . '?act=threadShow&tID=' . $tID . '&ttl=' . $tTitle;

					$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $tID . '">' . $row['ThreadTitle'] . ' </a>

								<small>(#t' . str_pad($tID, 4, '0', STR_PAD_LEFT) . ')</small>

								<a class="pull-right" href="' . $tURL . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
							</h4>
						</div>
						<div id="collapse-' . $tID . '" class="panel-collapse collapse">
							<div class="panel-body">';



					$str .=  '<p class="col-md-9">'. $row['ThreadSummary'] . '</p>

								<p class="col-md-3 pull-left text-right"><small><b>POST ORDER:</b>
								<br/>';



				#set up post order/partipants
				$aCharNameIndex[] = mk_charIndex();

				#show our list of particpating characters in post order/alphanumeric depending on context order
				$str .= mk_cFeaturedLinks($tID, $aCharNameIndex);



				$str .= '<br />
								<a href="./../characters/profile.php?CodeName=Chimaera&id=2&act=show" title="" >Chimeara</a>

									<br/>

								<a href="./../characters/profile.php?CodeName=Psyche&id=5&act=show" title="" >Psyche</a>

									<br/>

								<a href="./../characters/profile.php?http://localhost/WrDKv4/characters/profile.php?CodeName=Cyclops&id=1&act=show" title="" >Cyclops</a>

									<br/>

								<a href="./../characters/profile.php??CodeName=Beast&id=25&act=show" title="" >Beast</a>

									<br/>';


					#$test = mk_cFeaturedLinks($tID, $aCharNameIndex );
					#dumpDie($test);


								$str .= mk_cFeaturedLinks($tID, $aCharNameIndex );

								$str .='</small><br /><br /></p>';

					#$str .= '<p>' . get_postingOrder() . '</p>';

								#set ground work for tags
								$threadTag 	= $row['ThreadTag'];
								$arrTags 		= explode(',', $threadTag);
								$arrNames 	= get_tNames($sqlTags);

								#if we have tags show them
								$str .= '<span class="glyphicon glyphicon-tag"></span> ';

								$x = 0;
								$tot = count($arrTags);

								#make links, comma seperated
								foreach($arrTags as $key => $value){

									if(!isset($value) || $value == FALSE ){
										$str .=  ' <i class="text-muted"> No Characters Currently Tagged.';
									}else{
										$str .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';

									} #END if/else statement
								}#END foreach loop

								$str .=  '<a class="pull-right" href="' . $tURL . '"> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';
				}

				@mysqli_free_result($result); //free resources

				$str .= $myPager->showNAV(); # show paging nav, only if enough records

				}else{#no records
				$str .= "<div align=center>No posts currently Available.</div>";
			}

			$str .='</div><!-- end accordian --></div>';

			if(startSession() && isset($_SESSION['UserID'])){
				$str .='<p> <a href="' . THIS_PAGE . '?act=threadAdd" class="btn btn-primary btn-xs pull-right">Add New Thread</a></p>';
			}

			$str .='</div> <!-- END content -->';

	return $str;
}

function threadRemove(){
	/**
	 * create a new thread:D
	 */

	$threadId			 	= strip_tags($_GET['ThreadId']);				  #int - primaryKey

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_Threads WHERE `ThreadID` = :ThreadID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':ThreadID', $threadId, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Thread Removed Successfully From Timeline!","success");
	}else{//Problem!  Provide feedback!
		feedback("Thread Not Removed!","warning");
	}
	myRedirect(THIS_PAGE);
}

function threadRevise($sqlThreads, $sqlTags, $str=''){

	#echo 'thread revise';
	#dumpDie($_POST);

	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		#get thread id to delete - we want this ultimatelyt to be a post

		$tID   				= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		$threadType    			= strip_tags($_POST['ThreadType']);				#chk
		$threadRating   		= strip_tags($_POST['ThreadRating']);			#chk
		$threadPhaseOfDay   = strip_tags($_POST['ThreadPhaseOfDay']);	#chk
		$threadTimeOfDay   	= strip_tags($_POST['ThreadTimeOfDay']);	#chk
		$threadWeather    	= strip_tags($_POST['ThreadWeather']);		#chk
		$threadLocation   	= strip_tags($_POST['ThreadLocation']);		#chk
		$threadContent    	= strip_tags($_POST['ThreadContent']);		#chk
		$title    		= strip_tags($_POST['ThreadTitle']);			#chk
		$threadNotes    		= strip_tags($_POST['ThreadNotes']);			#chk
		$threadSummary    	= strip_tags($_POST['ThreadSummary']);		#chk
		$threadTag    			= strip_tags($_POST['ThreadTag']);				#chk



/*
	Full Set
		$tID   				= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		#$pID    				= strip_tags($_POST['PostID']);
		#$userID    				= strip_tags($_POST['UserID']);
		#$charID   					= strip_tags($_POST['CharID']);
		$threadType    			= strip_tags($_POST['ThreadType']);				#chk
		$threadRating   		= strip_tags($_POST['ThreadRating']);			#chk
		$threadApproval 		= strip_tags($_POST['ThreadApproval']);
		$threadVisible  		= strip_tags($_POST['ThreadVisible']);
		$threadFrom    			= strip_tags($_POST['ThreadFrom']);
		$threadFeaturing   	= strip_tags($_POST['ThreadFeaturing']);
		$threadPhaseOfDay   = strip_tags($_POST['ThreadPhaseOfDay']);	#chk
		$threadTimeOfDay   	= strip_tags($_POST['ThreadTimeOfDay']);	#chk
		$threadWeather    	= strip_tags($_POST['ThreadWeather']);		#chk
		$threadLocation   	= strip_tags($_POST['ThreadLocation']);		#chk
		$threadContent    	= strip_tags($_POST['ThreadContent']);		#chk
		$title    		= strip_tags($_POST['ThreadTitle']);			#chk
		$threadNotes    		= strip_tags($_POST['ThreadNotes']);			#chk
		$threadSummary    	= strip_tags($_POST['ThreadSummary']);		#chk
		$threadTag    			= strip_tags($_POST['ThreadTag']);				#chk
		$dateLockThread    	= strip_tags($_POST['DateLockThread']);
		$datePostThread    	= strip_tags($_POST['DatePostThread']);
		$datePullThread    	= strip_tags($_POST['DatePullThread']);
		$lastEditor    			= strip_tags($_POST['LastEditor']);
		$dateCreated   			= strip_tags($_POST['DateCreated']);
		$dateAssigned  			= strip_tags($_POST['DateAssigned']);
		$lastUpdated   			= strip_tags($_POST['LastUpdated']);
*/


		$db = pdo(); # pdo() creates and returns a PDO object
				#`ThreadID` = :ThreadID, #MOVED OUT OF SET
		$sql = "UPDATE `ma_Threads`
			SET

				`CatID`							= :CatID,
				`ThreadType`				= :ThreadType,
				`ThreadRating`			= :ThreadRating,
				`ThreadPhaseOfDay`	= :ThreadPhaseOfDay,
				`ThreadTimeOfDay`		= :ThreadTimeOfDay,
				`ThreadWeather`			= :ThreadWeather,
				`ThreadLocation`		= :ThreadLocation,
				`ThreadContent`			= :ThreadContent,
				`ThreadTitle`				= :ThreadTitle,
				`ThreadNotes`				= :ThreadNotes,
				`ThreadSummary`			= :ThreadSummary,
				`ThreadTag`					= :ThreadTag

				WHERE `ThreadID` 		= :ThreadID";

/*
	Full Set
	/* Don't need Thread id - it's handled at the bottom
		`CatID`									= :CatID,

		`PostID`								= :PostID,
		`UserID`								= :CharID,
		`CharID`								= :CharID,

		`ThreadType`						= :ThreadType,
		`ThreadRating`					= :ThreadRating,

		`ThreadApproval`				= :ThreadApproval,
		`ThreadVisible` 				= :ThreadVisible,
		`ThreadFrom`						= :ThreadFrom,
		`ThreadFeaturing`				= :ThreadFeaturing,

		`ThreadPhaseOfDay`			= :ThreadPhaseOfDay,
		`ThreadTimeOfDay`				= :ThreadTimeOfDay,
		`ThreadWeather`					= :ThreadWeather,
		`ThreadLocation`				= :ThreadLocation,
		`ThreadContent`					= :ThreadContent,
		`ThreadTitle`						= :ThreadTitle,
		`ThreadNotes`						= :ThreadNotes,
		`ThreadSummary`					= :ThreadSummary,
		`ThreadTag`							= :ThreadTag";

		`DateLockThread` 				= :DateLockThread,
		`DatePostThread`				= :DatePostThread,
		`DatePullThread`				= :DatePullThread,
		`LastEditor`						= :LastEditor,
		`DateCreated`						= :DateCreated,
		`DateAssigned`					= :DateAssigned,
		`LastUpdated`						= :LastUpdated
*/

		$stmt = $db->prepare($sql);


		//The Primary Key of the row that we want to update.
		$stmt = $db->prepare($sql);
			$stmt->bindParam(':ThreadID',					$tID, 					PDO::PARAM_INT);
			$stmt->bindParam(':CatID',						$catID, 						PDO::PARAM_INT);
			$stmt->bindParam(':ThreadType',				$threadType, 				PDO::PARAM_INT);
			$stmt->bindParam(':ThreadRating',			$threadRating, 			PDO::PARAM_INT);
			$stmt->bindParam(':ThreadPhaseOfDay',	$threadPhaseOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadTimeOfDay',	$threadTimeOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadWeather',		$threadWeather, 		PDO::PARAM_INT);

			$stmt->bindParam(':ThreadLocation',		$threadLocation, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadContent',		$threadContent, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTitle',			$title, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadNotes',			$threadNotes, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadSummary',		$threadSummary, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTag',				$threadTag, 				PDO::PARAM_STR);


/*
	Full Set
	$stmt->bindParam(':ThreadID',						$tID, 						PDO::PARAM_INT);
	$stmt->bindParam(':CatID',							$catID, 							PDO::PARAM_INT);
	#$stmt->bindParam(':PostID',						$PostID, 							PDO::PARAM_INT);
	#$stmt->bindParam(':UserID',						$CharID, 							PDO::PARAM_INT);
	#$stmt->bindParam(':CharID',						$CharID, 							PDO::PARAM_INT);
	$stmt->bindParam(':ThreadType',					$threadType, 					PDO::PARAM_INT);
	$stmt->bindParam(':ThreadRating',				$threadRating, 				PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadApproval',		$ThreadApproval, 			PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadVisible', 		$ThreadVisible, 			PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadFrom',				$ThreadFrom, 					PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadFeaturing',		$ThreadFeaturing, 		PDO::PARAM_STR);
	$stmt->bindParam(':ThreadPhaseOfDay',		$threadPhaseOfDay, 		PDO::PARAM_INT);
	$stmt->bindParam(':ThreadTimeOfDay',		$threadTimeOfDay, 		PDO::PARAM_INT);
	$stmt->bindParam(':ThreadWeather',			$threadWeather, 			PDO::PARAM_INT);
	$stmt->bindParam(':ThreadLocation',			$threadLocation, 			PDO::PARAM_STR);
	$stmt->bindParam(':ThreadContent',			$threadContent, 			PDO::PARAM_STR);
	$stmt->bindParam(':ThreadTitle',				$title, 				PDO::PARAM_STR);
	$stmt->bindParam(':ThreadNotes',				$threadNotes, 				PDO::PARAM_STR);
	$stmt->bindParam(':ThreadSummary',			$threadSummary, 			PDO::PARAM_STR);
	$stmt->bindParam(':ThreadTag',					$threadTag, 					PDO::PARAM_STR);
	#$stmt->bindParam(':DateLockThread', 		$DateLockThread, 			PDO::PARAM_INT);
	#$stmt->bindParam(':DatePostThread',		$DatePostThread, 			PDO::PARAM_INT);
	#$stmt->bindParam(':DatePullThread',		$DatePullThread, 			PDO::PARAM_INT);
	#$stmt->bindParam(':LastEditor',				$LastEditor, 					PDO::PARAM_INT);
	#$stmt->bindParam(':DateCreated',				$DateCreated, 				PDO::PARAM_INT);
	#$stmt->bindParam(':DateAssigned',			$DateAssigned, 				PDO::PARAM_INT);
	#$stmt->bindParam(':LastUpdated',				$LastUpdated,         PDO::PARAM_INT);
*/




		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update


		#dumpDie($db->errorInfo());
		#die;

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback("$title Was Successfully Revised!","success");
		}else{//Problem!  Provide feedback!
			feedback("$threadTitle NOT REVISED!","warning");
		}
		myRedirect(THIS_PAGE);
	}
}

#function threadMove
#function threadHidden - show all 'nuked' threads




function threadShow($tally, $act, $dir='DESC', $str=''){
	/*
	 * Show the general scene start for a thread and then all related posts related to that thread/topic.
	 * $tally       sets number of posts per page
	 * $direction   sets order to either ASC of DESC (Newest or Oldest post first)
	 */


	#uID is the current user/viewer looking at page,
	#hID is the handler/creator of  actual thread
	$uID=$hID=$hName=$priv='';
	#for query string
	$rqID=$rtID=$tTitle=$twID=$wID=$testStr=$btns='';

	#get requested thread id
	$rqID = $_GET['tID']; #$rID = requested thread id



	#dumpDie($_SESSION['Privilege']);

	#get user creds
	if(isset($_SESSION['UserID']))	 {  $hID = $_SESSION['UserID'];     } #uID   = ''
	if(isset($_SESSION['Privilege'])){  $priv = $_SESSION['Privilege']; } ##priv = ''

	#get Post modifiers to pass on to 'populate' existing post with
	if(isset($_GET['pWeather'])){  $wID = $_GET['pWeather'];  }

	$sql = "SELECT ThreadID, CatID, PostID, UserID, ThreadFeaturing, ThreadType, ThreadTitle, ThreadRating, ThreadPhaseOfDay, ThreadTimeOfDay, ThreadWeather, ThreadLocation, ThreadContent, ThreadNotes, ThreadSummary, ThreadTag, DatePostThread, DatePullThread, DateCreated, LastUpdated FROM ma_Threads where ThreadID = {$rqID}
	ORDER BY PostID $dir;";


	$str .= '<!-- start general content -->
	<div class="col-sm-9 col-xs-12 pull-right">';

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$catID 	 			= (int)$row['CatID'];
			#$uID 	 			= (int)$row['UserID']; #owner/creator of thread
			$uID 					= (isset($row['UserID'])) 	? $row['UserID']  : 0;

			$rtID 	 			= (int)$row['ThreadID'];

			$tTitle 			= $row['ThreadTitle'];
			$titleEncoded = str_replace(' ', '_', $tTitle); #URL safe

			$tType 				= $row['ThreadType'];
			$tRate 				= $row['ThreadRating'];
			$tRateEncoded = str_replace(' ', '_', $tRate); #URL safe

			$phase 				= $row['ThreadPhaseOfDay'];
			$phaseEncoded = str_replace(' ', '_', $phase); #URL safe

			$time 				= $row['ThreadTimeOfDay'];
			#add 67 seconds to time stamp
			$time 				= date("m/d/Y h:i:s a", time() + 67);
			$timeEncoded  = str_replace(' ', '_', $time); #URL safe

			$tWeather  		= $row['ThreadWeather']; #thread weather
			$twEncoded 		= str_replace(' ', '_', $twID); #URL safe

			$location 		= $row['ThreadLocation'];
			$locationEncoded = str_replace(' ', '_', $location); #URL safe
			$when 				= 'when';
			#add 67 seconds to time stamp
			#$time 				= date("m/d/Y h:i:s a", time() + 67);
			$whenEncoded  = str_replace(' ', '_', $when); #URL safe


			#handler - current user viewing is X
			#$hID = $_SESSION['UserID'];
			$hID = (isset($_SESSION['UserID'])) 	? $_SESSION['UserID']  : 0;


			#QUERY STRINGS for buttons - this way its easier to edit/revise them all in one place
			$pQueryAdd   = '?act=postAdd';
			$pQueryAdd  .= '&uID=' . $hID
									.	 '&cat=' . $catID
									.  '&tID=' . $rtID
									.  '&ttl=' . $titleEncoded
									.  '&typ=' . $tType
									.  '&rtg=' . $tRateEncoded
									.  '&wet=' . $twEncoded
									.  '&phs=' . $phaseEncoded
									.  '&tme=' . $timeEncoded
									.  '&loc=' . $locationEncoded
									.  '&whn=' . $whenEncoded; #addd min 67 seconds to it...
			#URL Sanitized
			$pQueryAdd = htmlspecialchars($pQueryAdd, ENT_QUOTES);
			#$pQueryAdd = htmlentities($pQueryAdd);
			#$pQueryAdd = rawurlencode ($pQueryAdd);

			#dumpDie($pQueryAdd);

			$pQueryEdit   = '?act=threadEdit&tID='   . $rtID . '&title=' . $titleEncoded;
			#URL Sanitized
			$pQueryEdit = htmlspecialchars($pQueryEdit, ENT_QUOTES);
			$pQueryEdit = htmlentities($pQueryEdit);

			$pQueryRemove = '?act=threadRemove&tID=' . $rtID . '&title=' . $titleEncoded;
			#URL Sanitized
			$pQueryRemove = htmlspecialchars($pQueryRemove, ENT_QUOTES);
			$pQueryRemove = htmlentities($pQueryRemove);

			$pQueryLock   = '?act=threadLock&tID='   . $rtID . '&title=' . $titleEncoded;
			#URL Sanitized
			$pQueryLock = htmlspecialchars($pQueryLock, ENT_QUOTES);
			$pQueryLock = htmlentities($pQueryLock);

			#if category matches selected category show
			if($rtID){

				#add leading zeros...
				$rIDformatted ='';
				$rIDformatted = str_pad( $rtID, 4, "0", STR_PAD_LEFT );

				#show threadHandler - make link to profile if logged in
				if(!empty($priv)){
					$hName = '<a href="' . VIRTUAL_PATH . 'users/userProfile.php?act=show&user=' . $uID . '" title="">' . get_hName($uID) . '</a>';
				}else{
					#if it's not our memeber, make link meaningless
					$hName = get_hName($uID);
				}

				#display content
				$str .=  '<h2 class="panel-title"><b>' . $tTitle . ' <span class="text-muted"></b><small>(#TiD-' . $rtID . ')</small></span></a>  <span class="pull-right"><span class="glyphicon glyphicon-pencil text-muted"></span> ' . $hName .'</span></h2>

				<p><br />'. nl2br($row['ThreadContent']) . '</p>';
				#intial description/staging for thread


				$threadTag = $row['ThreadTag'];

				#get Codenames of characters tagged
				#get all unique id sets
				$sqlAllTags = "SELECT DISTINCT PostTags FROM ma_Posts WHERE ThreadID = $rtID";

				$txt = '';

				#make tags for thread
				$resultAllTags = mysqli_query(IDB::conn(), $sqlAllTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

				//at least one record!
				if (mysqli_num_rows($resultAllTags) > 0){//show results
					$count = 0;

					#process id sets into string, add duplicates removed
					while ($row = mysqli_fetch_assoc($resultAllTags))
					{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
						$txt .=  $row['PostTags'] . 'x';
					}

					#remove double commas
					$txt = str_replace('xx',',', $txt);
					$txt = str_replace('x',',', $txt);

					#remove duplicates
					$txt = implode(',', array_unique(explode(',', $txt)));

					#format numbers to row comma quoted delinated row with
					$txt = "'" . str_replace(array("'", ","), array("\\'", "','"), $txt) . "'";

					#removing trailing comma and or empty/white space or combos there of.
					$myStr = str_replace(",''",'', $txt);
				}

				@mysqli_free_result($resultAllTags); //free resources

				$postTagsNew = $sqlCharTags = '';
				//we might not have any tags
				if($txt !==''){
					$sqlCharTags = "SELECT Codename, CharID, Overview FROM ma_Characters WHERE CharID IN ($txt) ORDER BY Codename;";

					$resultCharTags = mysqli_query(IDB::conn(), $sqlCharTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

					//at least one record!
					if (mysqli_num_rows($resultCharTags) > 0)
					{//show results

						$count = 0;
						$postTagsNew .= '<p>Featuring: ';

						while ($row = mysqli_fetch_assoc($resultCharTags))
						{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
							$cName 			 = $row['Codename'];
							$cNameEncode = str_replace(' ', '_', $cName); 	#URL safe
							#$twEncoded = str_replace(' ', '_', $twID); 		#URL safe
							#$titleEncoded = str_replace(' ', '_', $title);	#URL safe

							$cID   			 = $row['CharID'];
							$cOverivew   = $row['Overview'];

							#add in comma/seperator
							If($count++ >= 1){ $postTagsNew .= ', ';}

							$postTagsNew .= '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cNameEncode . '&id=' . $cID . '&act=show" data-toggle="tooltip" data-placement="right" title="' . $cOverivew  . '"
							>' . $cName . '</a>';
						}
						$postTagsNew .= '</p>';
					}
				}

				$str .= $postTagsNew;

				#THREAD queries addendums (NOT POSTS!)
				#we are using $rID = requested thread id instead of $rtID

				#GET posts - page them



			#Make the btns
			/*
				#we need a handler id for edit, lock and delete options -- handler is the registered created of that post or thread...
			*/


			if(!empty($priv)){ $btns .= mk_btns4posts($priv, $hID, $uID, $pQueryAdd, $pQueryAdd, $pQueryEdit, $pQueryRemove, $pQueryLock); }

			#sbow btns before posts.....
			$str .= $btns; #add the btns



			#pass the btns on to get_pPaged()
			$testStr .= get_pPaged($rtID, $tally, $act, $btns, $tTitle, $tType,
				$catID, $titleEncoded, $tType, $tRateEncoded, $twEncoded, $phaseEncoded,
				$timeEncoded, $locationEncoded, $whenEncoded, $titleEncoded,
				$priv, $hID, $uID); #get all psots

			if($testStr != ''){
				$str .= $testStr;
				$str .= '<hr>';
			#no records
			}else{
				$str .= "<div align=center>Houston we have problemo</div>";
			}
		}
		#close it all up

		$str .='</div><!-- END content -->';
		@mysqli_free_result($result); //free resources
		return $str;
		}
	}
}



#makes buttons to reply/edit posts
function mk_btns4posts($priv='', $hID='', $uID='', $pQueryAdd='', $pQueryEdit='', $pQueryRemove='', $pQueryLock='', $tURL ='', $tOrder='', $str=''){
	if($priv !=''){

	#for buttons
	#$pQueryAdd=$pQueryEdit=$pQueryRemove=$pQueryLock=$str='';
	$str = '<!-- START buttons -->


		<div class="btn-group btn-group-sm" role="group" aria-label="..."><small>';


		if($priv > 0){
			# disable class btn?
			$str .=  '<a class=""  href="' . THIS_PAGE . $pQueryAdd . '"> Add Reply</a>';
		}

		#if user is a mod/creator of thread, let them edit it.
		if(($priv > 3) || ($hID === $uID)){
			#set to invisible actually
			$str .=  ' &nbsp; &nbsp; | &nbsp; &nbsp; <a class="" href="' . THIS_PAGE . $pQueryEdit . '">Edit Thread</a>';
		}

		if($priv > 4){
			#set to invisible actually
			$str .=  ' &nbsp; &nbsp; | &nbsp; &nbsp; <a class="" href="' . THIS_PAGE . $pQueryRemove . '">Remove Thread</a>';
			#set to invisible actually
			$str .=  ' &nbsp; &nbsp; | &nbsp; &nbsp; <a class="" href="' . THIS_PAGE . $pQueryLock . '">Lock Thread</a>';
		}


		$str .='</small>';

		#glyphicon glyphicon-sort-by-attributes-
		$str .= '&nbsp; &nbsp; ';


		$str .= '</div><!-- END buttons -->
		<div class="pull-right">';


#ASC = crhonolgical;
#DESC = most recent




		#get full query string - then revise it to revise thread posting order
		$tUrl   = $_SERVER["QUERY_STRING"];

		#http://localhost/WrDKv4/act=threadShow&tID=20&ttl=IC%20TTa%20-%20Mall%20of%20Champions&tOrder=ASC

		#if tOrder exists/isset...
		if(isset($_GET['tOrder']) && !empty($_GET['tOrder'])){$tOrder = ($_GET['tOrder']);} else {$tOrder ='';}

		#default - if tOrder = '' or doesn't exist, show most recent post first
		if(empty($tOrder)){
			#http://localhost/WrDKv4/threads/index.php?act=threadShow&tID=20&ttl=IC%20TTa%20-%20Mall%20of%20Champions&tOrder=ASC&tOrder=ASC
			$str .= '<a href="' . VIRTUAL_PATH . 'threads/index.php?' . $tUrl . '&tOrder=DESC"><span class="glyphicon glyphicon glyphicon glyphicon-sort-by-attributes-alt pull-right" aria-hidden="true" data-toggle="tooltip" title="Read Thread By Chronological Order"></span>
			</div></a>';

		#change to chronological...
		}else{
			#http://localhost/WrDKv4/threads/index.php?act=threadShow&tID=20&ttl=IC%20TTa%20-%20Mall%20of%20Champions&tOrder=ASC&tOrder=DESC

			$str .= '<a href="' . VIRTUAL_PATH . 'threads/index.php?' . $tUrl . '&tOrder=ASC"><span class="glyphicon glyphicon glyphicon-sort-by-attributes pull-right" aria-hidden="true" data-toggle="tooltip" title="Read Thread By Most Recent Post First"></span>
			</div></a>';
		}


	}
	return $str;
}

function mk_cIDcName($hID){ #char name and ids
	$sqlTags = "SELECT Codename, CharID FROM ma_Characters where UserID = {$hID};";
	$result = mysqli_query(IDB::conn(), $sqlTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		$count = 0;
		$aar = [];

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$cID   		  = $row['CharID'];
			$cName 			= $row['Codename'];
			#nl2br($cOverivew)

			#make needed array of cID and cName
			$aar[$cID]['cName'] = $cName;

			#$aar[$cID]['overview'] = [$cOverView];
		}
		#return an array of links with tooltips
		return $aar;
	}
	@mysqli_free_result($result);
}

#$str .= mk_pDD('PostType', $arrPostType, 'PostType', 'required', $pType='')
#$str .= mk_pDD('PostType', $arrPostType, 'PostType', 'required', $pType)
#make drop down select from array - load preselected options - for creating posts
function mk_pDD($name, $arr, $val, $dd='', $pType=''){
	$dd = '<select class="selectpicker" name="' . $name . '" required="required">';
	#create dropdown list - with option of select= 'selected' if matches db value!

	$count = 0;

	#for setting posts types if available
	if(isset($_GET['tType']))		{ $pType  	= $_GET['tType'];
																$pMatch 	= $pType;}

	#for setting posts rating if available
	if(isset($_GET['pRating']))	{ $pRating 	= $_GET['pRating'];
																$pMatch  	= $pRating;}

	#for setting posts rating if available
	if(isset($_GET['pRating'])) { $pRating 	= $_GET['pRating'];
																$pMatch  	= $pRating;}

	#for setting phases of day rating if available
	if(isset($_GET['pDayPhase'])){$pDayPhase = $_GET['pDayPhase'];
																$pMatch 	 = $pDayPhase;}

	#for setting post weather rating if available
	if(isset($_GET['pWeather'])){ $pWeather  = $_GET['pWeather'];
																$pMatch    = $pWeather;}


	foreach($arr as $item)
	{#if we have value match
		if(($count==$val) || ($pType==$item) ){
			$dd .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
		}else{#don't have a match
			$dd .= '<option value="'. $count++ .'">'. $item .'</option>';
		}
	}

	return $dd . '</select>';
}

#get enum values from database for dropdowns
function get_enum($db, $table, $column) {
	// get ENUM values as string to populate a dropdown select (not the what column has what enum assigned but the possible enums themself)

	//	$sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
	//WHERE TABLE_SCHEMA = 'maTest' AND TABLE_NAME = 'ma_Posts' AND COLUMN_NAME = 'PostRating'";
	$sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
	WHERE TABLE_SCHEMA = '{$db}' AND TABLE_NAME = '{$table}' AND COLUMN_NAME = '{$column}'";

	$db = pdo(); # pdo() creates and returns a PDO object
	#run the query

	#$result stores data object in memory
	try {$result = $db->query($sql);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	#run query
	$results = $db->query($sql);

	#process query
	$results = $results->fetchAll(PDO::FETCH_ASSOC);

	#convert array to string
	$results = $results[0]['COLUMN_TYPE'];

	#prep string data
	$results = substr($results, 5, -1);

	#make $result inot an array of data again
	$enum = str_getcsv($results, ',', "'");

	return $enum;
}

#add a new post to forum
function postAdd($str=''){




	#Get referring page to send users back to
	$previous = $_SERVER['HTTP_REFERER'];

	#make associative array of char ids and codenames
	$arr_cIdcName = mk_cIDcName($_SESSION['UserID']);

	#uID - cat - tID - ttl  - typ  - rtg    - phs  - wet     - time - loc - whn
	$uID=$catID=$tID=$tTitle=$pType=$pOrder=$pRating=$phase=$dWeather=$pTime=$pLoc=$when = '';
#	$tID = $title = $type = $pRating = $phaseOfDay = $timeOfDay = $location = $when = '';


	#	if(isset($type)){ $location = str_replace('_', ' ', $_GET['typ']); }else{ $type = ''; }

	#set UserID if exists
	$uID =    	(isset($_GET['uID'])) 	? $_GET['uID']  : '';
	#set category if exists
	$catID =    (isset($_GET['cat'])) 	? $_GET['cat']  : '';
	#set threadID if exists
	(int)$tID = (isset($_GET['tID']))   ? $_GET['tID'] : '';
	#set title if exists - make url friendly
	$tTitle =   (isset($_GET['ttl'])) 	? str_replace('_', ' ', $_GET['ttl'])  : '';
	#set rating if exists
	$pType =    (isset($_GET['typ']))   ? $_GET['typ']  : '';
	#set post type if exists  - make url friendly
	$pRating =  (isset($_GET['rtg']))   ? str_replace('_', ' ', $_GET['rtg'])  : '';

	#set post type if exists  - make url friendly
	#$pOrder = '';

	#set location if exists - make url friendly
	$pLoc =     (isset($_GET['loc'])) 	? str_replace('_', ' ', $_GET['loc'])  : '';
	#set phase of day if exists - make url friendly
	$dPhase = 	(isset($_GET['phs']))  	? str_replace('_', ' ', $_GET['phs'])  : '';
	#set phase of day if exists - make url friendly
	$pTime =  	(isset($_GET['tme'])) 	? str_replace('_', ' ', $_GET['tme'])  : '';
	#set weather if exists - make url friendly
	$dWeather = (isset($_GET['wet']))   ? str_replace('_', ' ', $_GET['wet'])  : '';
	#set when if exists - make url friendly
	$pWhen =  	(isset($_GET['whn']))   ? str_replace('_', ' ', $_GET['whn'])  : ''; #addd min 67 seconds to it...

	#$cName 			= $row['Codename'];
	#$cNameEncode = str_replace(' ', '_', $cName); 	#URL safe
	#$twEncoded = str_replace(' ', '_', $twID); 		#URL safe
	#$titleEncoded = str_replace(' ', '_', $title);	#URL safe

	#$pID = (int)$row['PostID'];
	#temp arrays
	#$arrPostType = ['Post Type', 'IC', 'OOC', 'Guidance', 'Journal', 'Timeline'];
	#$arrMyChars = ['a', 'b', 'c'];
	#$arrCemoji = [1,2,3,4,5];


	# sends to postInsert

	$str .= '<!-- start general content -->
		<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

		<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.PostType,"Please Select Character")){return false;}
				if(empty(thisForm.PostMessage,"Please Enter Message to Post")){return false;}
				if(empty(thisForm.PostSummary,"Please Enter Post Summary")){return false;}


				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}

				return true;//if all is passed, submit!
			}
		</script>


		<div class="row" style=""><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >';


			#needed hidden values = Catagory, Thread, user id
			$str .= '
				<input  type="hidden" name="CatID"    			 value="' . $catID . '" />
				<input  type="hidden" name="ThreadID" 			 value="' . $tID   . '" />
				<input  type="hidden" name="UserID"   			 value="' . $uID   . '" />
				<input  type="hidden" name="PostFeaturing"   value="' . $uID   . '" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="">

					<!-- left container -->
					<div class="col-sm-6 pull-left" style="">
						<h4 class="text-center">Add Post to <b>' . $tTitle .  '</b></h4>

						<div class="row">
							<textarea name="PostContent" id="text" class="autoExpand col-sm-12" rows="3" data-min-rows="3" placeholder="Your Reply..."></textarea>
								<div id="result">
									Words: <span id="wordCount">0</span><br/>
								</div>
							</div><!-- END Container -->

							<div class="row">
								<textarea name="PostSummary" id="text" class="autoExpand col-sm-12" rows="3" data-min-rows="3" placeholder="Please Summarize your Post here in 140 characters or less..." ></textarea>
									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br/>
									</div>
							</div><!-- END Container -->
						</div>
<!-- LEFT CONTAINER end -->';

$str .= '<!-- RIGHT CONTAINER start -->
						<div class="col-sm-2 pull-right" style="">
							<h4 class="text-center">Post Details</h4>';

	#POST TYPE   begin
			#returns an array -- $db, $table, $column
			#We use constant DB_NAME here because db name is not the same locally as it is globally/live on web. 	#Local it's maTest - live it's dbchampions.
			$enum = get_enum(DB_NAME, 'ma_Posts', 'PostType');

			#name dropdown
			$arrPostType[] = 'Post Type';

			#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
			foreach($enum as $item){
				#remove data after a certain character
				#$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
				#$item = substr($item, 0, $cut_position);

				// Assign each value to the array as you cycle through
				$arrPostType[] = $item;
			}
			#make dropdown
			$str .= mk_pDD('PostType', $arrPostType, 'PostType', 'required', $pType) . '<br /><br />';


	#POST ORDER begin
			$str .= '<div class="row"><input class="" type="text" name="PostOrder" value="" placeholder="Post Order..."></div>';

	#POST RATING   begin
			$enum = get_enum(DB_NAME,  'ma_Posts', 'PostRating');
			#name dropdown
			$arrPostRating[] = 'Post Rating';
			#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
			foreach($enum as $item){
				#remove data after a certain character
				$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
				$item = substr($item, 0, $cut_position);
				// Assign each value to the array as you cycle through
				$arrPostRating[] = $item;
			}
			#make dropdown
			$str .= mk_pDD('PostRating', $arrPostRating, 'PostRating', 'required', $pRating) . '<br /><br />';

	#POST AS   begin
			$cSelections=$x=0;

			$str .= '<select class="selectpicker" name="CharID">';

			$key ='';
			foreach($arr_cIdcName as $key => $item) {
				#$key = key($arr_cIdcName);
				$cSelections .= '<option value="' . $key . '">' . $item['cName'] . '</option>';
				$x++;
			}

			#if only one character set to default - no reasont to select as only one char.
			if($x > 1){$str .= '<option selected="selected" value="">Post As...</option>';}
			#add in selections
			$str .= $cSelections;
			#close up select...
			$str .= '</select><br /><br />';

	#POST PROXY   begin

			if(($_SESSION['Privilege']) >= 4){

				$cProxy='';

				$str .= '<div class="row">
				<input
					class=""
					type="text"

					name="Proxy"
					value="' . $cProxy  . '"
					placeholder="Proxy as..."/>
				</div>';

			}



	#PHASE-OF-DAY   begin
			$enum = get_enum(DB_NAME,  'ma_Posts', 'PostPhaseOfDay');
			#name dropdown
			$arrDayPhase[] = 'Phase of Day';
			#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
			foreach($enum as $item){
				// Assign each value to the array as you cycle through
				$arrDayPhase[] = $item;
			}
			#make dropdown
			$str .= mk_pDD('PostPhaseOfDay', $arrDayPhase, 'PostPhaseOfDay', 'required', $dPhase) . '<br /><br />';


#cEMOJI   begin
	#$str .= mk_pDD('cEmoji', $arrCemoji, 'cID');
#cEMOJI   end


/*
#CURRENT TIME   end
				$str .= '<input
					class=""
					type="text"

					name="PostTimeOfDay"
					value="' . $pTimeOfDay . '"
					placeholder="0000-00-00 00:00:00"/>
				</div><!-- end container-->';
#CURRENT TIME   begin
*/


#CURRENT WEATHER   begin
			$enum = get_enum(DB_NAME,  'ma_Posts', 'PostWeather');
			#name dropdown
			$arrPostWeather[] = 'Current Weather';
			foreach($enum as $item){
				// Assign each value to the array as you cycle through
				$arrPostWeather[] = $item;
			}
			#make dropdown
			$str .= mk_pDD('PostWeather', $arrPostWeather, 'PostWeather', 'required', $dWeather) . '<br /><br />';


#LOCATION
						$str .= '<div class="row">
							<input
								class=""
								type="text"

								name="PostLocation"
								value="' . $pLoc . '"
								placeholder="Where?"/>
						</div><!-- end container-->


						<div class="row">
							<input
								class=""
								type="text"

								name="PostTimeOfDay"
								value="' . $pWhen . '"
								placeholder="When?"/>
						</div>



						<div class="row">
							<textarea
								name="PostNotes"

								class="autoExpand col-sm-12"
								rows="3"
								data-min-rows="3"

								placeholder="OOC Notes? "
								></textarea>
						</div><!-- end container-->


							<!-- auto fill needed -->
						<div class="row">
							<input
								class=""
								type="text"

								name="PostTags"
								placeholder="Add any tags?"/>
						</div><!-- end container-->


					</div><!-- end right container -->
				</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div align="center" style="">';

				#read post add names of characters features here PostFeaturing

				/*
					will need to do a scan on submit, fill, allow to go to post i think?
					Will need a full array of user char names, and want to make that linked in post notices too i think.
				*/


				$str .= '<input  type="hidden" name="PostFeaturing"   value="" />
					<input  type="hidden" name="act" value="postInsert" />

					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Post">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . $previous . '">Exit Post</a>
				</div>

			</form>
		</div>

	<!-- END content -->';
	# sends to postInsert

	#background-color: #a0a;
	return $str;
}

#drop down for post details stuff...
function mk_ddPostSelected($table='', $col='', $type='', $count=0, $str='', $dropDown = ''){
	#POST TYPE   begin
	#returns an array -- $db, $table, $column
	#We use constant DB_NAME here because db name is not the same locally as it is globally/live on web. 	#Local it's maTest - live it's dbchampions.
	$enum = get_enum(DB_NAME, $table, $col);

	#name dropdown
	$arrPostType[] = $col;

	#clean up array/shorten descriptions if needed -- $enum returns $arrPostType[]
	foreach($enum as $item){
		#remove data after a certain character
		#$cut_position = strpos($item, ' '); // remove the +1 if you don't want the ' '  included
		#$item = substr($item, 0, $cut_position);

		// Assign each value to the array as you cycle through
		$arrPostType[] = $item;
	}

	#to iterate the dropdown
	#$count 		= 0;
	$val   		= $col;
	#$dropDown = '';
	#populate select
	foreach($arrPostType as $item)
	{#if we have value match
		if(($count==$val) || ($type==$item) ){
			$dropDown .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
		}else{#don't have a match
			$dropDown .= '<option value="'. $count++ .'">'. $item .'</option>';
		}
	}
	$str .= $dropDown;

	$str .= '</select>';

	return $str;

}


/*

?act=postEdit
&
uID=1
&
cat=3
&
tID=9
&
pID=0060
&
ttl=test_title_here
_-_cat_1_-_Lorem_ipsum_dolor_sit_amet,_consectetur_adipisicing_elit,_sed_do_eiusmod_tempor_incididunt_ut_labore_et_dolore_magna_aliqua._Ut_enim_ad_minim_veniam,_quis_nostrud_exercitation_ullamco_laboris_nisi_ut_aliquip_ex_ea_
&
typ=OOC
&
pOdr=0
&
rtg=G_-_General_Audiences&wet=
&
phs=Midday
&
tme=01/22/2017_09:28:54_am
&
loc=Avengers_Mansion
&
whn=when

*/


# @TODO need to allow unapprove/resubmit - m2
function postEdit($sqlTags, $str=''){
	#Get referring page to send users back to

	$previous = (isset($_SERVER['HTTP_REFERER'])) 	? $_SERVER['HTTP_REFERER']  : VIRTUAL_PATH;

	#change get to post http://stackoverflow.com/questions/9643805/send-post-data-along-when-link-is-clicked-without-using-forms

	#make associative array of char ids and codenames
	$arr_cIdcName = mk_cIDcName($_SESSION['UserID']);

	# We need to $_GET post id and title... anything else?
	#	   if(isset($type)){ $location = str_replace('_', ' ', $_GET['typ']); }else{ $type = ''; }


	/*

		?act=postEdit
		&uID=1
		&cat=12
		&tID=20
		&pID=0058
		&ttl=post_order
		&typ=IC
		&pOdr=1
		&rtg=PG-13_-_Strong_violence_or_language_used&wet=
		&phs=Midday
		&tme=01/21/2017_11:25:31_am
		&loc=
		&whn=when

	*/
	#set Privs if exists
	$privs =    (isset($_SESSION['Privilege'])) 	? $_SESSION['Privilege']  : '';

	#set PostID if exists
	$rpID =    	(isset($_GET['pID'])) 	? $_GET['pID']  : '';
	#set UserID if exists
	$uID =    	(isset($_GET['uID'])) 	? $_GET['uID']  : '';
	#set category if exists
	$catID =    (isset($_GET['cat'])) 	? $_GET['cat']  : '';
	#set threadID if exists
	(int)$tID = (isset($_GET['tID']))   ? $_GET['tID'] : '';
	#set title if exists - make url friendly
	$tTitle =   (isset($_GET['ttl'])) 	? str_replace('_', ' ', $_GET['ttl'])  : '';

	# We need to $_GET post id and title... anything else?


	#set post content
	$pCon =   	(isset($_GET['txt'])) 	? str_replace('_', ' ', $_GET['txt'])  : '';
	#set post content
	$pSum =   	(isset($_GET['sum'])) 	? str_replace('_', ' ', $_GET['sum'])  : '';
	#set rating if exists
	$pType =    (isset($_GET['typ']))   ? $_GET['typ']  : '';
	#set post order if exists
	$pOrder =   (isset($_GET['pOdr']))  ? $_GET['pOdr']  : '';


	#set post type if exists  - make url friendly
	$pRating =  (isset($_GET['rtg']))   ? str_replace('_', ' ', $_GET['rtg'])  : '';
	//simplify rating for moment... remove description after rating for now
	$pRating =  substr($pRating, 0, strpos($pRating, " - "));


	#set location if exists - make url friendly
	$pLoc =     (isset($_GET['loc'])) 	? str_replace('_', ' ', $_GET['loc'])  : '';

	#set phase of day if exists - make url friendly
	$dPhase = 	(isset($_GET['phs']))  	? str_replace('_', ' ', $_GET['phs'])  : '';
	#set phase of day if exists - make url friendly
	$pTime =  	(isset($_GET['tme'])) 	? str_replace('_', ' ', $_GET['tme'])  : '';
	#set weather if exists - make url friendly
	$dWeather = (isset($_GET['wet']))   ? str_replace('_', ' ', $_GET['wet'])  : '';
	#set when if exists - make url friendly
	$pWhen =  	(isset($_GET['whn']))   ? str_replace('_', ' ', $_GET['whn'])  : ''; #addd min 67 seconds to it...

	$pFeature = '';



	$sql = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType, PostOrder, PostApproval, PostRating, PostVisible, PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags, DatePostLock, DatePostPost, DatePullPost, LastEditor, DateCreated, DateAssigned, LastUpdated
	FROM ma_Posts
	WHERE PostID = $rpID;";

#dumpDie($sql);

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#out html here
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			#$cID        = (int)$row['CustomerID'];
			#$cFirstName = dbOut($row['FirstName']);
			#$cLastName  = dbOut($row['LastName']);
			#$cEmail			= dbOut($row['Email']);



			#	if(isset($type)){ $location = str_replace('_', ' ', $_GET['typ']); }else{ $type = ''; }
			#set PostID if exists
			#$rpID 				= dbOut($row['PostID']);

			$pID 					= dbOut($row['PostID']);
			$tID 					= dbOut($row['ThreadID']);
			$CatID 				= dbOut($row['CatID']);
			$uID			  	= dbOut($row['UserID']);
			$cID 					= dbOut($row['CharID']);
			$pType 				= dbOut($row['PostType']);

			$pOrder 			= dbOut($row['PostOrder']);

			#$pApproval  	= dbOut($row['PostApproval']);

			$pRating	  	= dbOut($row['PostRating']);
			$pVisible	  	= dbOut($row['PostVisible']);
			$pFrom      	= dbOut($row['PostFrom']);
			$pFeature   	= dbOut($row['PostFeaturing']);
			$pPhase				= dbOut($row['PostPhaseOfDay']);
			$pDaytime			= dbOut($row['PostTimeOfDay']);
			$pWeather	  	= dbOut($row['PostWeather']);

			$pLoc					= dbOut($row['PostLocation']);
			$pCon  				= dbOut($row['PostContent']);
			$pNote 				= dbOut($row['PostNotes']);
			$pSum  				= dbOut($row['PostSummary']);

			//handle possible slashes
			$pLoc					= addslashes($pLoc);
			$pCon  				= addslashes($pCon);
			$pNote 				= addslashes($pNote);
			$pSum 				= addslashes($pSum);

			$pTag  				= dbOut($row['PostTags']);

			#$DatePostLock = dbOut($row['DatePostLock']);
			#$DatePostPost = dbOut($row['DatePostPost']);
			#$DatePullPost = dbOut($row['DatePullPost']);
			#$LastEditor 	= dbOut($row['LastEditor']);
			#$DateCreated  = dbOut($row['DateCreated']);
			#$DateAssigned = dbOut($row['DateAssigned']);
			#$LastUpdated  = dbOut($row['LastUpdated']);


			#make associative array of char ids and codenames
			$arr_cIdcName = mk_cIDcName($uID);

			$str = '<div class="row" style=""><!-- begin content -->
				<form action="' . THIS_PAGE . '" act=postRevise" method="post"onsubmit="return checkForm(this);">
					<input type="hidden" name="CatID" 				value="' . $CatID . '">
					<input type="hidden" name="ThreadID" 			value="' . $tID . '">
					<input type="hidden" name="PostID" 				value="' . $pID . '">
					<input type="hidden" name="UserID" 				value="' . $uID . '">
					<input type="hidden" name="PostFeaturing" value="' . $previous . '">
					<input type="hidden" name="PostPrevious"  value="' . $previous . '">


					<!-- inner container -->
					<div class="class=" col-sm-9="" pull-right"="" style="">

						<!-- left container -->
						<div class="col-sm-6 pull-left" style="">
							<h4 class="text-center">Edit ' . stripslashes($tTitle) . ' <b>#' . $rpID . '</b></h4>

							<div class="row">
								<textarea name="PostContent" value="" id="text" class="autoExpand col-sm-12" rows="12" data-min-rows="3">' . stripslashes($pCon) . '</textarea>
								<div id="result">
									Words: <span id="wordCount">0</span><br>
								</div>
							</div><!-- END Container -->

							<div class="row">
								<textarea name="PostSummary" value="" id="text" class="autoExpand col-sm-12" rows="3" data-min-rows="3" placeholder="Please Summarize your Post here in 140 characters or less...">' . stripslashes($pSum) . '</textarea>
									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br>
									</div>
							</div><!-- END Container -->
						</div>
						<!-- LEFT CONTAINER end -->';


#post type...
 # user is mod or better - they can pick any player character...
 $str .= '<!-- RIGHT CONTAINER start -->
				<div class="col-sm-2 pull-right" style="">
					<h4 class="text-center">Post Details</h4>

						<select class="selectpicker" name="PostType" required="required">';
							$str .= mk_ddPostSelected('ma_Posts', 'PostType', $pType );
						$str .= '</select>
						<br><br>';

#postOrder
		$str .= '<input class="" type="text" name="PostOrder" value="' . $pOrder . '" placeholder="Post Order">
						<br><br>';


#rating...
		$str .= '<select class="selectpicker" name="PostRating" required="required">';
							$str .= mk_ddPostSelected('ma_Posts', 'PostRating', $pRating );
						$str .= '</select>
						<br><br>';


#post as...

			$cSelections=$x=0;

			$str .= '<select class="selectpicker" name="CharID" required="required">';

			$key ='';
			foreach($arr_cIdcName as $key => $item) {
				#$key = key($arr_cIdcName);
				$cSelections .= '<option value="' . $key . '">' . $item['cName'] . '</option>';
				$x++;
			}

			#if only one character set to default - no reasont to select as only one char.
			if($x > 1){$str .= '<option selected="selected">Post As</option>';}
			#add in selections
			$str .= $cSelections;
			#close up select...
			$str .= '</select><br /><br />';

/*

	make OPT GROUP to add NPCs and remove NPCs from which are tied to handlers

	Anything else handled by 'postby'

	<select class="selectpicker">
		<optgroup label="myCharacters">
			<option name="CharID" value="1">Char A</option>
			<option name="CharID" value="2">Char B</option>
		</optgroup>
		<optgroup label="NPCs">
			<option>npc A</option>
			<option>npc B</option>
			<option>npc C</option>
			<option>npc D</option>
			<option>npc E</option>
		</optgroup>
	</select>

$str .= 		'<select class="selectpicker" name="CharID" required="required">';
							$str .= mk_ddPostSelected('ma_Posts', 'CharID', $cID );
						$str .= '</select>
						<br><br>';
*/

#phase...
		$str .= 		'<select class="selectpicker" name="PostPhaseOfDay" required="required">';
									$str .= mk_ddPostSelected('ma_Posts', 'PostPhaseOfDay', $pPhase );
								$str .= '</select>
								<br><br>';

#weather...
		$str .= 		'<select class="selectpicker" name="PostWeather" required="required">';
									$str .= mk_ddPostSelected('ma_Posts', 'PostWeather', $pWeather );
								$str .= '</select>
								<br><br>';


		$str .= '<div class="row">
								<input class="" type="text" name="PostLocation" value="' . $pLoc . '" placeholder="Where?">
							</div><!-- end container-->

							<div class="row">
								<input class="" type="text" name="PostTimeOfDay" value="' . $pWhen . '" placeholder="When?">
							</div>

							<div class="row">
								<textarea name="PostNotes" class="autoExpand col-sm-12" rows="3" data-min-rows="3" placeholder="OOC Notes? ">' . $pNote . '</textarea>
							</div><!-- end container-->

							<!-- auto fill needed -->
							<div class="row">
								<input class="" type="text" name="PostTags" placeholder="Add any tags?">
							</div><!-- end container-->
						</div><!-- end right container -->
					</div><!-- end inner container -->

					<div class="clearfix">
						<br><br>
					</div>

					<div align="center" style="">

						<input type="hidden" name="PostFeaturing" value="">
						<input type="hidden" name="act" value="postRevise">


						<input class="btn btn-primary btn-xs outline" type="submit" value="Submit Edit">

						&nbsp; &nbsp;

						<a class="btn btn-primary btn-xs outline" href="' . $previous . '">Exit Post</a>
					</div>
				</form>
			</div>';
			}
			# javascript sends folks back to previous page
			# SEE: http://stackoverflow.com/questions/2548566/go-back-to-previous-page

		}else{//no records
			echo '<div align="center"><h3>Currently No Matching Customer in Database.</h3></div>';
		}
	# sends to postInsert
	#change get to post http://stackoverflow.com/questions/9643805/send-post-data-along-when-link-is-clicked-without-using-forms
	@mysqli_free_result($result); //free resources
	return $str;
}

function postInsert($str=''){

	#dumpDie($_POST);

	#PDO Setup needed vars...
	#$PostID 				= $_POST['PostID'];

	#rearranged to map to how post data comes in
	$CatID 					= $_POST['CatID'];
	$tID 						= $_POST['ThreadID'];
	$uID 						= $_POST['UserID'];
	$pFeaturing 		= $_POST['PostFeaturing'];

	$pContent 		  = $_POST['PostContent'];
	$pSummary 			= $_POST['PostSummary'];
	$pType 					= $_POST['PostType'];
	$pOrder 				= $_POST['PostOrder'];

	$pRating 				= $_POST['PostRating'];
	# !!! we wipe $cID out IF we have a proxy !!!
	$cID 						= $_POST['CharID'];
	# !!! we wipe $cID out IF we have a proxy !!!
	$cProxy 				= $_POST['Proxy'];
	$pPhase					= $_POST['PostPhaseOfDay'];

	$pWeather 			= $_POST['PostWeather'];
	$pLocation 			= $_POST['PostLocation'];
	$postTimeOfDay 	= $_POST['PostTimeOfDay'];
	$pNotes 				= $_POST['PostNotes'];

	$pTags 					= $_POST['PostTags'];

	#$PostApproval 	= $_POST['PostApproval'];
	#$PostVisible 	= $_POST['PostVisible'];
	#$PostFrom 			= $_POST['PostFrom'];
	#$DatePostLock 	= $_POST['DatePostLock'];
	#$DatePostPost 	= $_POST['DatePostPost'];
	#$DatePullPost 	= $_POST['DatePullPost'];
	#$LastEditor 		= $_POST['LastEditor'];
	#$DateCreated 	= $_POST['DateCreated'];
	#$DateAssigned 	= $_POST['DateAssigned'];
	#$LastUpdated	 	= $_POST['LastUpdated'];


	#dumpDie($pSummary);

	#chek for proxy...
	$cProxy = $_POST['Proxy'];
	$cID = get_proxyChar($cProxy, $cID);


	$db = pdo(); # pdo() creates and returns a PDO object

	#dumpDie($db);

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
	$sql = "INSERT INTO ma_Posts (
			ThreadID, CatID, UserID, CharID, PostType, PostOrder, PostRating, PostFeaturing, PostPhaseOfDay,
			PostTimeOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags
		)
		VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1,		$tID 						,	PDO::PARAM_STR);
	$stmt->bindValue(2,		$CatID 					,	PDO::PARAM_STR);
	$stmt->bindValue(3,		$uID 						,	PDO::PARAM_STR);
	$stmt->bindValue(4,		$cID 						,	PDO::PARAM_STR);
	$stmt->bindValue(5,		$pType 					,	PDO::PARAM_STR);

	$stmt->bindValue(6,		$pOrder 				,	PDO::PARAM_STR);

	$stmt->bindValue(7,		$pRating 				,	PDO::PARAM_STR);
	$stmt->bindValue(8,		$pFeaturing 		,	PDO::PARAM_STR);
	$stmt->bindValue(9,		$pPhase					,	PDO::PARAM_STR);
	$stmt->bindValue(10,	$postTimeOfDay 	,	PDO::PARAM_STR);
	$stmt->bindValue(11,	$pWeather 			,	PDO::PARAM_STR);
	$stmt->bindValue(12,	$pLocation 			,	PDO::PARAM_STR);
	$stmt->bindValue(13,	$pContent 		  ,	PDO::PARAM_STR);
	$stmt->bindValue(14,	$pNotes 				,	PDO::PARAM_STR);
	$stmt->bindValue(15,	$pSummary 			,	PDO::PARAM_STR);
	$stmt->bindValue(16,	$pTags 					,	PDO::PARAM_STR);


	$chek = $stmt;

	#dumpdie($chek);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Post Added Successfully To Thread Name! $chek","success");

	}else{//Problem!  Provide feedback!
		feedback("Post NOT added!","warning");
	}

	#dumpDie($_SESSION);

	myRedirect(VIRTUAL_PATH . 'threads/index.php?act=threadShow&tID=' . $tID ); #send back to thread where htey posted from
}

function postRecent($sqlPost){
	#CONFIG DATA

	$str=$cName=$cArr='';
	$pFormattedID=$pID=$postLocation=$postWeather=$postContent=$postNotes=$postSummary=$postTags='';
	$cID=$tID='';
	$gameTime=$formatLastUpdate=$format='';

	#get tally tolal - cast to int
	if( isset( $_GET['tally']) ){ $tally=(int)$_GET['tally']; } else { $tally=20; }

	#set default show value
	#add user pref - 10, 20, 25, 50, 100
	#add user pref - 10, 20, 25, 50, 100
	if(($tally == '') || ($tally == 'X') || ($tally == 0)){ $tally=20;}

	#set up pager
	#reference images for pager
	$prev = '<span class="glyphicon glyphicon-backward"></span>';
	$next = '<span class="glyphicon glyphicon-forward"></span>';

	# Create instance of new 'pager' class
	$pager = new Pager($tally,'',$prev,$next,'');

	$sqlPost = $pager->loadSQL($sqlPost);  #load SQL, add offset
	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sqlPost) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if (mysqli_num_rows($result) > 0)//at least one record!
	{#records exist - process
		#only make the charactere array if we need it - be kind to db
		#make array of links to character bios $cArr[$cID] ;
		$cLinxArr = get_cLinks();


#http://localhost/WrDKv3/characters/profile.php?CodeName=Cyclops&id=1&act=show%3ECyclops%3C/a%3E%3C/h1%3E%20%3Cbr%20/%3E%3Cbr%20/%3E%20%3Cdiv%20align=


		if($pager->showTotal()==1){ $itemz = "post"; }else{ $itemz = "posts"; }  //deal with plural

		$str .=  '<h3><strong>We have ' . $pager->showTotal() . ' ' . $itemz . '!</strong></h2>';

		#BEGIN main content
		$str .=  '<!-- MAIN CONTENT begin -->
		<div class="col-sm-9 col-xs-12 pull-right">';


		#build $str post by post
		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$hID							= (int)$row['UserID'];
			$tID 							= (int)$row['ThreadID'];
			$cID							= (int)$row['CharID'];

			$cName						= $cLinxArr[$cID]['link'];
			#format post id to 4 places

			$pID   						= (int)$row['PostID'];
			$pFormattedID  		= str_pad($pID, 4, '0', STR_PAD_LEFT);
			$pOrder   				= (int)$row['PostOrder'];

			#format time post updated
			$update       		= date_create($row['LastUpdated']);
			$gDate 						= date_format($update, 'Y-m-d H:i:s a');
			$pLocation    		= $row['PostLocation'];
			$pWeather     		= $row['PostWeather'];
			$pContent     		= dbOut($row['PostContent']);
			$pNotes       		= dbOut($row['PostNotes']);

			#get char ids for tags
			$pTags 						= $row['PostTags'];
			#make OOP SEE: http://php.net/manual/en/datetime.settime.php
			$format = 'Y-m-d h:i';
			$gTime = strtotime('2016-09-03 14:55:24');
			$pSummary      		= dbOut($row['PostSummary']);

			 $str .=  '<div class="col-sm-12" style="background-color: ">
			 <hr >
			<div class="col-xs-1"  style="margin-left: -40px; margin-right: 20px;">' . mk_cThumb($cID) . '</div>
				 <p class="col-sm-7 col-xs-11">
					<strong>' . $cName . ' &raquo; </strong> ' .  nl2br($pContent) . '
				 </p>';

			$str .= get_pDetails($pFormattedID, $pOrder, $pLocation, $pWeather, $gTime, $pNotes, $pSummary, $pTags, $tID );

			$str .= '</div><hr />';
		}
		$str .=  $pager->showNAV(); # show paging nav, only if enough records
	}else{#no records
		$str .=  "<div align=center>Currently no posts. You should do </div>";
	}

$str .= '<!-- END post/content -->
</div>
<!-- START footer-->';


return $str;

}

function postRevise($str=''){
	#dumpDie($_POST);
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		#PDO Setup needed vars...
		$pID 						= $_POST['PostID'];
		$tID 						= $_POST['ThreadID'];
		$CatID 					= $_POST['CatID'];
		$uID 						= $_POST['UserID'];
		$cID 						= $_POST['CharID'];
		$pType 					= $_POST['PostType'];

		$pOrder 				= $_POST['PostOrder'];

		#$PostApproval 	= $_POST['PostApproval'];
		$pRating 				= $_POST['PostRating'];
		#$PostVisible 	= $_POST['PostVisible'];
		#$PostFrom 			= $_POST['PostFrom'];
		$pFeaturing 		= $_POST['PostFeaturing'];
		$pPhase					= $_POST['PostPhaseOfDay'];
		$pDaytime 			= $_POST['PostTimeOfDay'];
		$pWeather 			= $_POST['PostWeather'];
		$pLoc 					= addslashes($_POST['PostLocation']);
		$pCon 		  		= addslashes($_POST['PostContent']);
		$pNotes 				= addslashes($_POST['PostNotes']);
		$pSum 					= addslashes($_POST['PostSummary']);
		$pTags 					= $_POST['PostTags'];
		#$DatePostLock 	= $_POST['DatePostLock'];
		#$DatePostPost 	= $_POST['DatePostPost'];
		#$DatePullPost 	= $_POST['DatePullPost'];
		#$LastEditor 		= $_POST['LastEditor'];
		#$DateCreated 	= $_POST['DateCreated'];
		#$DateAssigned 	= $_POST['DateAssigned'];
		#$LastUpdated	 	= $_POST['LastUpdated'];

		$db = pdo(); # pdo() creates and returns a PDO object


		$sql = "UPDATE ma_Posts
			SET
				ThreadID        ='$tID',
				CatID           ='$CatID',
				UserID          ='$uID',
				CharID          ='$cID',
				PostType        ='$pType',
				PostOrder      	='$pOrder',
				PostRating      ='$pRating',
				PostFeaturing   ='$pFeaturing',
				PostPhaseOfDay  ='$pPhase',
				PostTimeOfDay   ='$pDaytime',
				PostWeather     ='$pWeather',
				PostLocation    ='$pLoc',
				PostContent     ='$pCon',
				PostNotes       ='$pNotes',
				PostSummary     ='$pSum',
				PostTags        ='$pTags'

			WHERE PostID = '$pID'";

		$stmt = $db->prepare($sql);
		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
		#$stmt->bindValue(1,		$pID 						,	PDO::PARAM_STR);
		$stmt->bindValue(1,		$tID 						,	PDO::PARAM_STR);
		$stmt->bindValue(2,		$CatID 					,	PDO::PARAM_STR);
		$stmt->bindValue(3,		$uID 						,	PDO::PARAM_STR);
		$stmt->bindValue(4,		$cID 						,	PDO::PARAM_STR);
		$stmt->bindValue(5,		$pType 					,	PDO::PARAM_STR);

		$stmt->bindValue(6,		$pOrder 				,	PDO::PARAM_STR);

		$stmt->bindValue(7,		$pRating 				,	PDO::PARAM_STR);
		$stmt->bindValue(8,		$pFeaturing 		,	PDO::PARAM_STR);
		$stmt->bindValue(9,		$pPhase					,	PDO::PARAM_STR);
		$stmt->bindValue(10,	$pDaytime 			,	PDO::PARAM_STR);
		$stmt->bindValue(11,	$pWeather 			,	PDO::PARAM_STR);
		$stmt->bindValue(12,	$pLoc 					,	PDO::PARAM_STR);
		$stmt->bindValue(13,	$pCon 		  		,	PDO::PARAM_STR);
		$stmt->bindValue(14,	$pNotes 				,	PDO::PARAM_STR);
		$stmt->bindValue(15,	$pSum 					,	PDO::PARAM_STR);
		$stmt->bindValue(16,	$pTags 					,	PDO::PARAM_STR);


		$chek = $stmt;

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback("Post #$pID Successfully Revised! $chek","success");

		}else{//Problem!  Provide feedback!
			feedback("Post #$pID NOT Revised!","warning");
		}

	}

	#dumpDie($_SESSION);

	myRedirect(VIRTUAL_PATH . 'threads/index.php?act=threadShow&tID=' . $tID ); #send back to thread where htey posted from
}

#show Single Post - will need to work in pager... so we can advance up and down
function postShow($str='', $tID = 0, $codeName = ''){
	#$myID = (int)$_GET['id']; #get post ID
	#$tID = (int)$_GET['tID']; #get thread ID
	$tID = 2; #temp value of thread for dev purpose, must ultimately come from query string
	$pID = (int)$_GET['id']; #get post ID

	#sql call for tags
	$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";
	#sql for post data
	$sqlPost = "SELECT PostID, ThreadID, UserID, CharID, PostType, PostApproval, PostRating, PostVisible, PostFrom,
	 PostFeaturing, PostPhaseOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags,
	 DatePostLock, DatePostPost, DatePullPost, LastEditor, DateCreated, DateAssigned, LastUpdated
	 FROM ma_Posts

	 WHERE PostID = $pID;";

	#BEGIN post construction
	$str='
	<!-- END sidebar -->
	<!-- BEGIN content -->
	<div class="col-md-9 pull-right">';


		#reference images for pager
		$prev = '<span class="glyphicon glyphicon-backward"></span>';
		$next = '<span class="glyphicon glyphicon-forward"></span>';

		# Create instance of new 'pager' class
		$myPager = new Pager(2,'',$prev,$next,'');
		$sql = $myPager->loadSQL($sqlPost);  #load SQL, add offset

		# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(),$sqlPost) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{#records exist - process

			/*
			if($myPager->showTotal()==1){$itemz = "post";}else{$itemz = "posts";}  //deal with plural
			$str .= ' <div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
			*/

				#build $str post by post
				while($row = mysqli_fetch_assoc($result))
				{# process each row
					#config post variables
					$hID				= (int)$row['UserID'];
					$tID 				= (int)$row['ThreadID'];

					$charID						= (int)$row['CharID'];

					#format post id to 4 places
					$pID   				= (int)$row['PostID'];
					$pFormattedID  		= str_pad($pID, 4, '0', STR_PAD_LEFT);

					#format time post updated
					$lastUpdate    = date_create($row['LastUpdated']);
					$LastUpdate    = date_format($lastUpdate, 'Y-m-d H:i:s a');

					$pLocation     = $row['PostLocation'];
					$pWeather      = $row['PostWeather'];
					$pContent      = dbOut($row['PostContent']);
					$pNotes      	 = dbOut($row['PostNotes']);

					#get char ids for tags
					$postTags 				= $row['PostTags'];

					#make OOP SEE: http://php.net/manual/en/datetime.settime.php
					$format = 'Y-m-d H:i:s';
					$gTime = strtotime('2016-09-03 14:55:24');

					$pSummary      = dbOut($row['PostSummary']);


					$str .= '<div class="row">
						<div class="col-sm-2">';

						$str .= mk_PolyThumb($charID) . '</div>'; #gets thumbnail of featured character with detailed tooltip

					#get the post content - the actual meat of the post
					$str .= '<div class="col-sm-7" style="">
							<p><strong>' . $codeName . ' &raquo; </strong> ' .  nl2br($postContent) . '</p>
						</div>

						<!-- END innercontent -->
						<!-- BEGIN post details -->
						<div class="col-sm-3 small">
							<div class="well">
								<p><strong>Message '
									. $pFormattedID . '&raquo; </strong> <br /> [ <a href="'
									. VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID='
									. $pID . '">Edit</a> | <a href="'
									. VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID='
									. $pID . '">Remove</a> ]</p>

								<p><strong>Updated &raquo; </strong> ' . $LastUpdate . '</p>
								<p>' . get_hDetails($hID, $pID) . '<p>'; #returns a handler detail link

								###########################################################
																 // ** IF SET SHOW **//
								###########################################################
								echo '<p><strong>From &raquo; </strong>[ #XXXX ]</p>
								<p><strong>Where &raquo; </strong> ' . $pLocation . ' </p>
								<p><strong>Weather &raquo; </strong> ' . $pWeather . ' </p>
								<p><strong>When &raquo; </strong> ' . $gTime = date($format, $gTime) . ' </p>
								<p><strong>Notes &raquo; </strong> ' . nl2br($pNotes) . ' </p>
								<p><strong>Summary &raquo; </strong> ' . nl2br($pSummary) . ' </p>';


								echo '<p>tages: '. get_pTags($pTags) . '</p>';

							echo '</div><!-- END post details -->
						</div>
					</div>';

				} #END main while loop

				$str .= $myPager->showNAV(); # show paging nav, only if enough records

				@mysqli_free_result($result);

			}else{#no records
				$str .= "<div align=center>Currently no posts. You should do </div>";
			}


			$str .= '<p>(b1-not if first / b2-if last post only/b3-not if last)</p>
			<br />
			<p>
				<a href="#" class="btn btn-primary btn-xs">Prior Post (ID-1)</a>
				<a href="index.php?act=postAdd&threadId=' . $tID . '" class="btn btn-primary btn-xs">Add/INSERT Post</a>
				<a href="#" class="btn btn-primary btn-xs">Next Post (ID+1)</a>
			</p>
		</div><!-- END post/content -->
	<!-- START footer-->
	';

	return $str;
}

function postTrash(){
	#dumpDie($_POST);
	$pID			 	= strip_tags($_GET['postID']);				  #int - primaryKey

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_Posts WHERE `PostID` = :PostID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':PostID', $pID, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Post Removed Successfully From Thread!","success");
	}else{//Problem!  Provide feedback!
		feedback("Post Not Removed!","warning");
	}
	myRedirect(THIS_PAGE);
}




////////////////////    CHARACTER FORMS    ////////////////////
////////////////////    CHARACTER FORMS    ////////////////////
////////////////////    CHARACTER FORMS    ////////////////////



function set_zodiacSign($birthdate=0, $year=0, $month=0, $day=0, $zodiac='') {
	if(
		 isset($year)  && ($year != '') && ($year != 0) &&
		 isset($month) && ($month != '') && ($month != 0) &&
		 isset($day)   && ($day != '') && ($day != 0)
		){
		list ($year, $month, $day) = explode ("-", $birthdate);

		 if     ( ( $month == 3  && $day > 20 ) || ( $month == 4 	&& $day < 20 ) ) { $zodiac = "Aries"; }
		 elseif ( ( $month == 4  && $day > 19 ) || ( $month == 5 	&& $day < 21 ) ) { $zodiac = "Taurus"; }
		 elseif ( ( $month == 5  && $day > 20 ) || ( $month == 6 	&& $day < 21 ) ) { $zodiac = "Gemini"; }
		 elseif ( ( $month == 6  && $day > 20 ) || ( $month == 7 	&& $day < 23 ) ) { $zodiac = "Cancer"; }
		 elseif ( ( $month == 7  && $day > 22 ) || ( $month == 8 	&& $day < 23 ) ) { $zodiac = "Leo"; }
		 elseif ( ( $month == 8  && $day > 22 ) || ( $month == 9 	&& $day < 23 ) ) { $zodiac = "Virgo"; }
		 elseif ( ( $month == 9  && $day > 22 ) || ( $month == 10 && $day < 23 ) ) { $zodiac = "Libra"; }
		 elseif ( ( $month == 10 && $day > 22 ) || ( $month == 11 && $day < 22 ) ) { $zodiac = "Scorpio"; }
		 elseif ( ( $month == 11 && $day > 21 ) || ( $month == 12 && $day < 22 ) ) { $zodiac = "Sagittarius"; }
		 elseif ( ( $month == 12 && $day > 21 ) || ( $month == 1 	&& $day < 20 ) ) { $zodiac = "Capricorn"; }
		 elseif ( ( $month == 1  && $day > 19 ) || ( $month == 2 	&& $day < 19 ) ) { $zodiac = "Aquarius"; }
		 elseif ( ( $month == 2  && $day > 18 ) || ( $month == 3 	&& $day < 21 ) ) { $zodiac = "Pisces"; }

		return $zodiac;
	}
}

#Uses DATE_CURRENT defined in config-inc
function setAge($dob){ #calculate current age
/**
 * Simple PHP age Calculator
 *
 * Calculate and returns age based on the date provided by the user.
 * @param   date of birth('Format:yyyy-mm-dd').
 * @return  age based on date of birth
 */

	#dumpDie($dob);
	if((!empty($dob)) || ($dob != '--') ){
		$birthdate = new DateTime($dob);
		#$today   = new DateTime('today');
		$today   = new DateTime(DATE_CURRENT);
		$age = $birthdate->diff($today)->y;
		return $age;
	}else{
		return 0;
	}
}

#Uses DATE_CURRENT defined in config-inc
// FED AS       ('date of birth', $dob, $AgeApparent, $DOByear, $DOBmonth, $DOBday);

function showAge($title, $dob, $appAge, $year, $month, $day, $realAge='', $str=''){#Show age
/**
 * Display actual and apparent age
 *
 * If ages are the same, show apparent age if available, else show actual.
 * @param   date of birth('Format:yyyy-mm-dd').
 * @return  age based on date of birth
 */

	if(($dob == '--') ||($dob == '0-0-0')){$dob ='';}
	$zSign = set_zodiacSign($dob, $year, $month, $day);

	$realAge = setAge($dob);


	#all is good...
	if(($realAge != '') || ($realAge != 0) && ($appAge != '') || ($appAge != 0)){


		$dob = $day . ' / ' . $month . ' / ' . $year . ' &nbsp; <small class="text-muted">('
								. $realAge
								.  ' / '
								. $appAge . ' - <em>' . $zSign . '</em>)</small>'; #Add 0 back for troublshooting...
	}




	$str .= '
	<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>' . ucwords($title) . ':</strong></p>
			</div>
			<div class="col-sm-9">
				<p>' . $dob . '</p>
			</div>
		</div>';


#	if(($realAge == '') && (($appAge == 0) || ($appAge == ''))){ $str=''; }
	return $str;

}

//////////////////      DATA MANAGEMENT      /////////////////
function getPrivies($int=''){ #Get set session var
	if(isset($_SESSION['Privilege'])){
		$int = $_SESSION['Privilege'];
	}else{
		$int = 0;}
	return $int;
}

#mk dropdown w/descriptions
#echo mkDDwDesc('demeanor', 'Demeanor', $aarTraitOverview, $Demeanor, $Gender, $CodeName);
function mkDDwDesc($title, $nName, $arr, $val, $cGen, $cName, $str=''){
	#dumpDie($arr);
	$str .= '<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . ucwords($title) . ': </strong></p>
		</div>
		<div class="col-sm-7">
			<div class="form-group">
				<select class="form-control" name="' . $nName . '">';
				#create dropdown list - with option of select= 'selected' if matches db value!
				$count = 1;
				foreach($arr as $key => $data)
				{ #sometimes you feel like a select
					$data = customizeData($data, $cGen, $cName, $stripTags='y');

					if($val==$key){
						 $str .= '<option value="'. $key .'" selected="selected">' . $key .' - ' . $data . '</option>';
					}else{
						 #sometimes you don't
						 $str .= '<option value="' . $key .'">' . $key .' - ' . $data . '</option>';
					}

					$count++;
				}
		return $str . '</select> </div></div></div><!-- END Container -->';
	}

/////////////////////      SECURITY      /////////////////////
function genFormToken($form) {
	// generate a token from an unique value
	$token = md5(uniqid(microtime(), true));

	// save token to session
	// use to compare to/against hidden field form input
	$_SESSION[$form.'_token'] = $token;

	return $token;

}

/*
	 check token values against each other when form is submitted.
*/
function verifyFormToken($form) {

		// check if a session is started and a token is transmitted, if not return an error
	if(!isset($_SESSION[$form.'_token'])) {
		return false;
		}

	// check if the form is sent with token in it
	if(!isset($_POST['token'])) {
		return false;
		}

	// compare the tokens against each other if they are still the same
	if ($_SESSION[$form.'_token'] !== $_POST['token']) {
		return false;
		}

	return true;
}

/*
	This function attempts to write to a text file on the server (that file is going to need proper file permissions, user writeable) or if that fails, it will email it to you.
*/
function writeLog($where) {

	$ip = $_SERVER["REMOTE_ADDR"]; // Get the IP from superglobal
	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
	$date = date("d M Y");

	// create a logging message with php heredoc syntax
	$logging = <<<LOG
		\n
		<< Start of Message >>
		There was a hacking attempt on my form - form name here. \n
		Date of Attack: {$date}
		IP-Adress: {$ip} \n
		Host of Attacker: {$host}
		Point of Attack: {$where}
		<< End of Message >>
LOG;

				// open log file
		if($handle = fopen('hacklog.log', 'a')) {

			fputs($handle, $logging);  // write the Data to file
			fclose($handle);           // close the file

		} else {  // if first method is not working, for example because of wrong file permissions, email the data

					$to = 'monkeework@gmail.com';
					$subject = 'HACK ATTEMPT';
					$header = 'From: monkeework@gmail.com';
					if (mail($to, $subject, $logging, $header)) {
						echo "Sent notice to the monkee.";
					}

	}
}

/*
	Originally i used strip_tags() for normal fields and htmlentities() for content. This is fine, except that it's best practice to declare ENT_NOQUOTES and "UTF-8" as well, since otherwise characters like the accent on the e (" é ") could become crap like Å@. And since most servers add slashes to input brought via $_POST[] it's not a bad thing to run stripslashes just in case, else you'd have a slash in front of every single or doublequote that was typed entered in the form once it's in the mailbox or whatever.
*/

#$message .= "Name: " . stripclean2html($_POST['req-name']) . "\n";
function stripclean2html($s){
		// Restores the added slashes (ie.: " I\'m John " for security in output, and escapes them in htmlentities(ie.:  &quot; etc.)
		// Also strips any <html> tags it may encouter
		// Use: Anything that shouldn't contain html (pretty much everything that is not a textarea)
		return htmlentities(trim(strip_tags(stripslashes($s))), ENT_NOQUOTES, "UTF-8");
}

#$message .= "NEW Content: " . clean2html($_POST['newText']) . "\n";
function clean2html($s){
		// Restores the added slashes (ie.: " I\'m John " for security in output, and escapes them in htmlentities(ie.:  &quot; etc.)
		// It preserves any <html> tags in that they are encoded aswell (like &lt;html&gt;)
		// As an extra security, if people would try to inject tags that would become tags after stripping away bad characters,
		// we do still strip tags but only after htmlentities, so any genuine code examples will stay
		// Use: For input fields that may contain html, like a textarea
		return strip_tags(htmlentities(trim(stripslashes($s))), ENT_NOQUOTES, "UTF-8");
}

function getRealIp() {
	 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
		 $ip=$_SERVER['HTTP_CLIENT_IP'];
	 } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
		 $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	 } else {
		 $ip=$_SERVER['REMOTE_ADDR'];
	 }
	 return $ip;
}


