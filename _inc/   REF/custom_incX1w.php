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

function chekPrivies($privReq = '0', $privChek = '0'){
/**
	* If User Privilege not equal to minimum require privilege level for access, redirect to main site index page.
	*
	* @param string $str data as entered by user
	* @return boolean returns true if matches pattern.
	*/

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
				data-toggle="dropdown">Select Catagory<span class="caret"></span></button>
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
						$myGroup .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&id=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';

					} else if(($row['CatSort']) == 'person'){

						$catName = $row['CatTitle'];
						$myPeeps .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&id=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';;

					}else{

						$catName = $row['CatTitle'];
						$myOrg .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&id=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';

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

function chitChat($str=''){
	$str .= '<div class="row ">
			<div class="side-menu">
				<script src="http://www.shoutbox.com/chat/chat.js.php"></script> <script> var chat = new Chat(6065);</script>
			</div>
		</div><!-- End chitChat -->';
	return $str;
};

function threadSidebar($type='', $sql, $str=''){


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
							$str .= '<li>
							<a href="' . THIS_PAGE
								. '?act=threadShow&id='
								. (int)$row['ThreadID'] . '" />'
								. $row['ThreadTitle'] . '</a>
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
#extend class - add pager 'get_pPaged' so we have the option for full thread read and paged read for mobile

function postDetails($pFormattedID, $pLocation, $pWeather, $gTime, $pNotes, $pSummary, $pTags, $tID, $act ){
	#make OOP SEE: http://php.net/manual/en/datetime.settime.php
	$format = 'Y-m-d h:i';

	$str = '<div class="col-sm-4">
		<small>
			<p><strong>Post &raquo; </strong> [' . $pFormattedID  . '] </p>';

			if($pLocation != ''){ $str .=  '<p><strong>Where &raquo; </strong> ' . $pLocation . ' </p>'; }

			$str .=  '<p><strong>Weather &raquo; </strong> ' . $pWeather . ' </p>
			<p><strong>When &raquo; </strong> ' . $gTime = date($format, $gTime) . ' </p>
			<p><strong>Notes &raquo; </strong> ' . nl2br($pNotes) . ' </p>
			<p><strong>Summary &raquo; </strong> ' . nl2br($pSummary) . ' </p>';

			#set them to not show if no tags...
			$str .=  '<p><strong>Tags &raquo; </strong>' . get_pTags($pTags) . '</p>
			<p><strong>Mentions &raquo; </strong>' . get_pTags($pTags) . '</p>';

	/*
			if(){

				$str .= '<a href="' . VIRTUAL_PATH . 'threads/index.php?act=threadShow&tID=' . $tID . '" class=""><span class="glyphicon glyphicon-send"></span> &nbsp; Go To Thread</a>';
			}
*/

		$str .=  '</small>
	 </div><!-- end right sidebar details -->';

	return $str;
}

function mk_cThumb($cID, $str=''){
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
			$cName = $rowTT['Codename'];
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
	$str .= '<div class="text=center">
			<a href="' . VIRTUAL_PATH . 'characters/profile.php?id=' . $cID . '&act=show"
				target="_blank" data-toggle="tooltip" data-placement="right" title="" data-container="body" class="tooltiplink" data-html="true"
				data-original-title="' . $cName . ' >> ' . $overview .'"
				>
				<img src="' . $filename . '" alt="' . $cName. '" style="width:50px">
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
			$str .= "<p>Tags  &raquo; ";

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
			$str .= "</p>";
		}

	return $str;

	@mysqli_free_result($resultCharTags);
}

#get all related posts, paged
function get_pPaged($rID, $tally, $act, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	#pare this down to what is needed once we know what we need
	$sql = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType, PostApproval, PostRating, PostVisible, PostFrom, PostFeaturing, PostPhaseOfDay, PostWeather, PostLocation, PostContent,  	PostNotes, PostSummary, PostTags, DatePostLock, DatePostPost, DatePullPost, LastEditor, DateCreated, DateAssigned, LastUpdated FROM ma_Posts
	 WHERE ThreadID = $rID;";

	$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";

	#reference images for pager
	$prev = '<span class="glyphicon glyphicon-step-backward"></span>';
	$next = '<span class="glyphicon glyphicon-step-forward"></span>';

	# Create instance of new 'pager' class
	$pager = new Pager($tally,'',$prev,$next,'');
	$sql = $pager->loadSQL($sql);  #load SQL, add offset

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if (mysqli_num_rows($result) > 0)//at least one record!
	{#records exist - process

		#only make the charactere array if we need it - be kind to db
		#make array of links to character bios $cArr[$cID] ;
		$cLinxkArr = get_cLinks();

		if($pager->showTotal()==1){ $itemz = "post"; }else{ $itemz = "posts"; }  //deal with plural

		$str .=  '<hr /><h4><strong>We have ' . $pager->showTotal() . ' ' . $itemz . '!</strong></h4>';

		#build $str post by post
		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$hID							= (int)$row['UserID'];
			$tID 							= (int)$row['ThreadID'];
			$cID							= (int)$row['CharID'];

			$cName						= $cLinxkArr[$cID]['link'];
			#format post id to 4 places

			$pID   						= (int)$row['PostID'];
			$pFormattedID  		= str_pad($pID, 4, '0', STR_PAD_LEFT);

			#format time post updated
			$update       		= date_create($row['LastUpdated']);
			$gDate 						= date_format($update, 'Y-m-d H:i:s a');
			$pLocation    		= $row['PostLocation'];
			$pWeather     		= $row['PostWeather'];
			$pContent     		= dbOut($row['PostContent']);
			$pNotes       		= dbOut($row['PostNotes']);

			#get char ids for tags
			$pTags 						= $row['PostTags'];
			$gTime = strtotime('2016-09-03 14:55:24');
			$pSummary      		= dbOut($row['PostSummary']);

			#BEGIN main content
			$str .=  '<!-- MAIN CONTENT begin -->

				<div class="col-xs-1"  style="margin-left: -40px; margin-right: 20px;">' . mk_cThumb($cID) . '</div>
					<hr />
					<p class="col-sm-7 col-xs-11">
						<strong>' . $cName . ' &raquo; </strong> ' .  nl2br($pContent) . '
					</p>';

			$str .= postDetails($pFormattedID, $pLocation, $pWeather, $gTime, $pNotes, $pSummary, $pTags, $tID, $act );

		}

#VIRTUAL_PATH . 'threads/index.php?act=postAdd&threadId=' . $tID . '
		$str .=  '<a href="' . VIRTUAL_PATH . 'threads/index.php?act=postAdd&threadId=' . $tID . '" class="btn btn-primary btn-xs"> ADD REPLY </a><hr />';


		$str .=  '</div></div>';






		$str .=  $pager->showNAV(); # show paging nav, only if enough records
	}else{#no records
		$str .=  "<p>Currently no posts. You should do </p>";
	}

	$str .= '<!-- END post/content --></div><!-- START footer-->';

	return $str;

}

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
	 * @seeindex.php?act=threadShow&id=1
	 * @see Pager.php
	 * @todo none
	 */

	$sqlHID = "SELECT UserID, UserName, Privilege FROM ma_Users WHERE UserID = $hID";

	$resultHID = mysqli_query(IDB::conn(), $sqlHID) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	$dbHID = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
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
				<a href="' . VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID=' . $pID . '">Edit</a> | <a href="' . VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID=' . $pID . '">Remove</a>
			</p>';
	}
	unset($resultHID, $dbHID); #free resources

	return $str;

}



###################   POST/THREAD FUNCTION$   ###################
###################   POST/THREAD FUNCTION$   ###################
###################   POST/THREAD FUNCTION$   ###################

function categoryShow($sql, $sqlTags, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	$str .= '<!-- start general content -->

	<div class="col-md-9 pull-right">
		<h4><strong>Most Recent Postings...</h4>

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
					$catID    		= (int)$row['CatID'];
					#$catTitle 		= $row['CatTitle'];
					$myCatID    	= $_GET['id'];
					$myCatName    = $_GET['categoryName'];

					#if category matches selected category show
					if($catID == $myCatID){

						$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">

								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $tID . '"> ' . $row['ThreadTitle'] . ' </a>

								<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $tID . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
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
								if (isset($threadTag)){
									$str .= '<span class="glyphicon glyphicon-tag"></span> ';

									$x = 0;
									$tot = count($arrTags);

									#make links, comma seperated
									foreach($arrTags as $key => $value)
									{
										$str .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';
									}
								}

								$str .=  '</p>
								<p><a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"      s> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';

					}
				}

			@mysqli_free_result($result); //free resources

			$str .= $myPager->showNAV(); # show paging nav, only if enough records



			if(startSession() && isset($_SESSION['UserID'])){
				$str .= '<div class="pull-right">
					<a href="' . THIS_PAGE . '?act=categoryEdit&id=' . $myCatID . '&categoryName=' . formatUrl($myCatName) . '" class="btn btn-info btn-xs pull-right" role="button">Edit Catagory</a>
				</div>';
			}

		}else{#no records
			$str .= "<div align=center>There are currently no active threads for $myCatName. Wierd. We should really do something about that soon.</div>";
		}

	$str .='</div><!-- end accordian -->
	</div>';




	$str .= '</div><!-- END content -->';

	return $str;
}

function categoryAdd($str=''){
	/**
	 * create a new category
	 */

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


		<div class="row" style="background-color: #0a0;"><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="CatID" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

					<!-- left container -->
					<div class="col-sm-8 pull-left" style="background-color: #ddd ;">
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

									placeholder="Catagroy Description"
									></textarea>
							</div><!-- end container-->


					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="background-color: #a0a;">

					<input  type="hidden" name="act" value="categoryInsert" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Catagory">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '">Exit Event</a>
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


	$CatID 						= strip_tags($_POST['CatID']);
	$CatTitle    			= strip_tags($_POST['CatTitle']);
	$CatType 					= strip_tags($_POST['CatType']);
	$CatSort  				= strip_tags($_POST['CatSort']);
	$CatDescription		= strip_tags($_POST['CatDescription']);
	$CatVisible  			= strip_tags($_POST['CatVisible']);

	$db = pdo(); # pdo() creates and returns a PDO object

	$sql = "UPDATE `ma_Categories`
		SET
			`CatID` 					= :CatID,
			`CatTitle` 				= :CatTitle,
			`CatType` 				= :CatType,
			`CatDescription`  = :CatDescription,
			`CatVisible` 			= :CatVisible

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





function threadAdd($sql, $sqlTags, $str=''){
	/**
	 * create a new thread:D
	 */
	$threadId 				= '';
	$title    	= 'N2G Thread Title';
	#$postPhaseOfDay 	= $_POST['PostPhaseOfDay']
	$postPhaseOfDay 	= 'N2G Post/ThreadPhaseOfDay';
	$postTimeOfDay 		= 'N2G Post/ThreadTimeOfDay'; #addd min 67 seconds to it...

	$postLocation 		= 'N2G PostLocation';
	$postWeather 			= 'N2G postWeather'; #addd min 67 seconds to it...
	$postWhen 				= 'N2G postWhen'; #addd min 67 seconds to it...



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


		<div class="row" style="background-color: #0a0;"><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="ThreadID" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

					<!-- left container -->
					<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
						<h4 class="text-center">Add Post to <b>' . $title .  '</b></h4>';

							#Pulldown-Post-Type
							#function also used in profiles
							#echo mk_DD('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-Post-As
							#function also used in profiles
							#echo mk_DD('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-select character emoji:
							#function also used in profiles
							#echo mk_radio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


							$str .= '<div class="row">
								<div class="pull-middle">

									<select class="selectpicker">
										<option>Thread Type</option>
										<option>IC</option>
										<option>OOC</option>
										<option>Guidance</option>
										<option>Journal</option>
										<option>Timeline</option>
									</select>

									&nbsp; &nbsp;

									<select class="selectpicker">
										<option>Rating</option>
										<option>IC</option>
										<option>OOC</option>
										<option>Guidance</option>
										<option>Journal</option>
										<option>Timeline</option>
									</select>

									&nbsp; &nbsp;

									<select class="selectpicker">
										<option>Weather</option>
										<option>Image A</option>
										<option>Image B</option>
										<option>Image C</option>
										<option>Image D</option>
										<option>Image E</option>
									</select>

									<br /><br />

								</div>
							</div><!-- END Container -->


							<div class="row">
								<input
									class="col-sm-12"
									type="text"

									name="ThreadTitle"
									placeholder="Thread Title..."/>
							</div><!-- END Container -->


							<div class="row">
								<textarea
									name="ThreadContent"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Please Summarize your Post here in 140 characters or less..."
									></textarea>

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

									placeholder="Please Summarize the thread Scene Set here in 140 characters or less..."
									></textarea>

									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br/>
									</div>

							</div><!-- END Container -->









						<!--

							<div class="row">
							<p>show if notes exist, show if mod or player AND notes exist</p>
								<textarea
									name="PostNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Moderator Notes here..." ></textarea>
							</div>



						-->
							<!-- END Container -->

						</div>
<!-- END left container -->
<!-- Right container -->


						<div class="col-sm-2 pull-right" style="background-color: #0aa;">

							<h4 class="text-center">Post Details</h4>

							<div class="row">
								<input
									class=""
									type="text"

									name="PostPhaseOfDay"
									value="' . $postPhaseOfDay . '"
									placeholder="?"/>


								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postTimeOfDay . '"
									placeholder="0000-00-00 00:00:00"/>
							</div><!-- end container-->


							<div class="row">
								<select class="selectpicker">
									<option>Post Rating</option>
									<option>IC</option>
									<option>OOC</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>

							<div class="row">
								<select class="selectpicker">
									<option>Weather</option>
									<option>IC</option>
									<option>OOC</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>


							<div class="row">
								<input
									class=""
									type="text"

									name="PostLocation"
									value="' . $postLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


							<div class="row">
								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postWhen . '"
									placeholder="When?"/>
							</div><!-- end container-->



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

					<input  type="hidden" name="act" value="insertThread" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Post">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . VIRTUAL_PATH . '">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}

#function threadClone($sql, $sqlTags, $str=''){  TODO  }

function threadEdit($sqlThreads, $sqlTags, $str=''){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{

		$rID = ($_GET["id"]);

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

					$str .= '<a class="btn btn-primary btn-xs outline" href="' . VIRTUAL_PATH . '">Exit Event</a>
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

function threadRecent($sql, $sqlTags, $str=''){
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

					$tID = (int)$row['ThreadID'];

					$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $tID . '">' . $row['ThreadTitle'] . ' </a>

								<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $tID . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
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
								if (isset($threadTag)){
									$str .= '<span class="glyphicon glyphicon-tag"></span> ';

									$x = 0;
									$tot = count($arrTags);

									#make links, comma seperated
									foreach($arrTags as $key => $value)
									{
										$str .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';
									}
								}

								$str .=  '<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&tID=' . $tID . '"> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';
				}

				@mysqli_free_result($result); //free resources

				$str .= $myPager->showNAV(); # show paging nav, only if enough records

				}else{#no records
				$str .= "<div align=center>There are currently no posts. Weird.</div>";
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

function threadShow($tally, $act, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	$sql = "SELECT ThreadID, CatID, PostID, ThreadFeaturing, ThreadType, ThreadTitle, ThreadNotes, ThreadSummary, ThreadTag, DatePostThread, DatePullThread, DateCreated, LastUpdated FROM ma_Threads;";

	$str .= '<!-- start general content -->
	<div class="col-md-9 pull-right">';

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$rID    = $_GET['tID']; #$rID -> requested id
			$tID = (int)$row['ThreadID'];

			#if category matches selected category show
			if($rID == $tID){
				$str .=  '<h3 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $tID . '"> ' . $row['ThreadTitle'] . ' </a>
					</h3>

					<p>'. $row['ThreadSummary'] . '</p>';

					$threadTag 	= $row['ThreadTag'];

					#######################################################
					#get Codenames of characters tagged

					#get all unique id sets
					$sqlAllTags = "SELECT DISTINCT PostTags FROM ma_Posts WHERE ThreadID = $rID";

					$txt = '';

					$resultAllTags = mysqli_query(IDB::conn(), $sqlAllTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
					if (mysqli_num_rows($resultAllTags) > 0)//at least one record!
					{//show results
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
						$txt = implode(',',array_unique(explode(',', $txt)));

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
							if (mysqli_num_rows($resultCharTags) > 0)//at least one record!
							{//show results

								$count = 0;
								$postTagsNew .= '<p>Featuring: ';

								while ($row = mysqli_fetch_assoc($resultCharTags))
								{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
									$cName 			= $row['Codename'];
									$cID   			= $row['CharID'];
									$cOverivew  = $row['Overview'];

									#add in comma/seperator
									If($count++ >= 1){ $postTagsNew .= ', ';}

									$postTagsNew .= '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cName . '&id=' . $cID . '&act=show" data-toggle="tooltip" data-placement="right" title="' . $cOverivew  . '"

									>' . $cName . '</a>';
								}
							$postTagsNew .= '</p>';
						}

					}

				$str .= $postTagsNew;
				#######################################################

				if(startSession() && isset($_SESSION['UserID'])){
					$str .= '<p><!-- set to invisible actually -->
						<a class="" href="' . THIS_PAGE . '?act=threadRemove&id=' . $rID . '">Remove Thread</a>
						&nbsp; | &nbsp;
						<a class="" href="' . THIS_PAGE . '?act=threadLock&id=' . $rID . '">Lock Thread</a>
						&nbsp; | &nbsp;
						<!-- set to invisible actually -->
						<a class="" href="' . THIS_PAGE . '?act=threadEdit&id=' . $rID . '">Edit Thread</a></p>';
				}

				#FROM HERE
				#now get all the related posts
				$str .= get_pPaged($tID, $tally, $act); #get all psots
			}
		}

		@mysqli_free_result($result); //free resources

		}else{#no records
			$str .= "<div align=center>Houston we have problemo</div>";
		}

		#close it all up
		$str .='</div><!-- END content -->';


	#show me the money
	return $str;
}

#function threadMove
#function threadHidden - show all 'nuked' threads





function postAdd($str=''){
	/**
	 * create a post :D
	 */

	$title    = 'N2G Thread Title';
	#$postPhaseOfDay = $_POST['PostPhaseOfDay']
	$postPhaseOfDay = 'N2G Post/ThreadPhaseOfDay';
	$postTimeOfDay = 'N2G Post/ThreadTimeOfDay'; #addd min 67 seconds to it...

	$postLocation = 'N2G PostLocation';
	$postWeather = 'N2G postWeather'; #addd min 67 seconds to it...
	$postWhen = 'N2G postWhen'; #addd min 67 seconds to it...

	#$pID = (int)$row['PostID'];


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
		</script>


		<div class="row" style="background-color: #0a0;"><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="ThreadID" value="' . $_GET['threadId']. '" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

					<!-- left container -->
					<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
						<h4 class="text-center">Add Post to <b>' . $title .  '</b></h4>';

							#Pulldown-Post-Type
							#function also used in profiles
							#echo mk_DD('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-Post-As
							#function also used in profiles
							#echo mk_DD('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-select character emoji:
							#function also used in profiles
							#echo mk_radio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


							$str .= '<div class="row">
								<div class="pull-middle">

									<select class="selectpicker">
										<option>Post Type</option>
										<option>IC</option>
										<option>OOC</option>
										<option>--Event--</option>
										<option>Guidance</option>
										<option>Journal</option>
										<option>Timeline</option>
									</select>

									&nbsp; &nbsp;

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


									&nbsp; &nbsp;

									<select class="selectEmoji">
										<option>Character Emoji</option>
										<option>Image A</option>
										<option>Image B</option>
										<option>Image C</option>
										<option>Image D</option>
										<option>Image E</option>
									</select>

									<br /><br />

								</div>
							</div><!-- END Container -->


							<div class="row">
								<textarea
									name="PostContent"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Your Reply?"></textarea>



									<div id="result">
										Words: <span id="wordCount">0</span><br/>
									</div>
							</div><!-- END Container -->


							<div class="row">
								<textarea
									name="PostContent"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Please Summarize your Post here in 140 characters or less..."
									></textarea>

									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br/>
									</div>

							</div><!-- END Container -->

						<!--

							<div class="row">
							<p>show if notes exist, show if mod or player AND notes exist</p>
								<textarea
									name="PostNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Moderator Notes here..." ></textarea>
							</div>



						-->
							<!-- END Container -->

						</div>
<!-- END left container -->
<!-- Right container -->


						<div class="col-sm-2 pull-right" style="background-color: #0aa;">

							<h4 class="text-center">Post Details</h4>

							<div class="row">
								<input
									class=""
									type="text"

									name="PostPhaseOfDay"
									value="' . $postPhaseOfDay . '"
									placeholder="?"/>


								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postTimeOfDay . '"
									placeholder="0000-00-00 00:00:00"/>
							</div><!-- end container-->


							<div class="row">
								<select class="selectpicker">
									<option>Post Rating</option>
									<option>IC</option>
									<option>OOC</option>
									<option>--Event--</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>

							<div class="row">
								<select class="selectpicker">
									<option>Weather</option>
									<option>IC</option>
									<option>OOC</option>
									<option>--Event--</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>


							<div class="row">
								<input
									class=""
									type="text"

									name="PostLocation"
									value="' . $postLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


							<div class="row">
								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postWhen . '"
									placeholder="When?"/>
							</div><!-- end container-->



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

					<input  type="hidden" name="act" value="postInsert" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Post">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="timeline.php">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}


# @TODO need to allow unapprove/resubmit - m2
function postEdit($sqlTags){

	$str='';
	#If user is logged - allow edit else send back to timeline

	$rID = ($_GET["postID"]); #resquested ID of the psot matching to to edit

	if(startSession() && isset($_SESSION['UserID']))
	{

		# SQL statement - PREFIX is optional way to distinguish your app
		$sql = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType, PostApproval, PostRating, PostVisible,
		PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags, DatePostLock, DatePostPost, DatePullPost, LastEditor, DateCreated, DateAssigned, LastUpdated
		FROM ma_Posts
		WHERE PostID = $rID;";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{ #show result

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db

				#set up needed variables...
				$pID						= dbOut($row['PostID']);
				$tID    				= dbOut($row['ThreadID']);
				#$catTitle 			= dbOut($row['CatID']);
				$uID  				= dbOut($row['UserID']);
				$cID  				= dbOut($row['CharID']);

				#$tID    	= dbOut($row['PostType']);
				#$catTitle 			= dbOut($row['PostApproval']);
				$pRating  		= dbOut($row['PostRating']);
				$postApproval  	= dbOut($row['PostVisible']);

				$postFrom    		= dbOut($row['PostFrom']);
				$postFeaturing  = dbOut($row['PostFeaturing']);
				$postTimeOfDay 	= dbOut($row['PostTimeOfDay']);
				$postPhaseOfDay = dbOut($row['PostPhaseOfDay']);
				$pWeather    = dbOut($row['PostWeather']);
				$pLocation 	= dbOut($row['PostLocation']);

				$pContent		= dbOut($row['PostContent']);
				$pNotes			= dbOut($row['PostNotes']);
				$pSummary		= dbOut($row['PostSummary']);
				$pTags    		= dbOut($row['PostTags']);

				#$datePostLock  = dbOut($row['DatePostLock']);
				#$datePostPost  = dbOut($row['DatePostPost']);
				#$datePullPost  = dbOut($row['DatePullPost']);
				#$lastEditor    = dbOut($row['LastEditor']);
				#$dateCreated   = dbOut($row['DateCreated']);
				#$dateAssigned  = dbOut($row['DateAssigned']);
				#$lastUpdated   = dbOut($row['LastUpdated']);


				# show post details for edit...
				$str .= '
				<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

				<script type="text/javascript">
					function checkForm(thisForm)
					{//check form data for valid info
						if(empty(thisForm.,"Please Enter Customer\'s First Name")){return false;}
						if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
						if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
						return true;//if all is passed, submit!
					}
				</script>


				<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">


					<input  type="hidden" name="ThreadID" value="' . $rID . '" />

					<!-- inner container -->
					<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

						<!-- left container -->
						<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
							<h4 align="center">Edit Post # ' . $rID . ' </h4>';

								#Pulldown-Post-Type
								#function also used in profiles
								#echo mk_DD('postType', 'PostType', 'xxx', $PostType);

								#Pulldown-Post-As
								#function also used in profiles
								#echo mk_DD('postType', 'PostType', 'xxx', $PostType);

								#Pulldown-select character emoji:
								#function also used in profiles
								#echo mk_radio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


									$str .= '<div class="row">
										<div class="pull-middle">

											<select class="selectpicker">
												<option>Post Type</option>
												<option>IC</option>
												<option>OOC</option>
												<option>Guidance</option>
												<option>Journal</option>
												<option>Timeline</option>
											</select>

											&nbsp; &nbsp;

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


											&nbsp; &nbsp;

											<select class="selectEmoji">
												<option>Character Emoji</option>
												<option>Image A</option>
												<option>Image B</option>
												<option>Image C</option>
												<option>Image D</option>
												<option>Image E</option>
											</select>

											<br /><br />

										</div>
									</div><!-- END Container -->


									<div class="row">
										<textarea
											name="PostContent"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Your Reply?">' . $pContent . '</textarea>
									</div><!-- END Container -->


									<div class="row">
										<textarea
											name="PostSummary"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Please Summarize your Post here in 140 characters or less..."
											>' . $pSummary . '</textarea>
									</div><!-- END Container -->


									<div class="row">
										<textarea
											name="$postNotes"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Moderator Notes here..." >' . $pNotes . '</textarea>
									</div>

									<!-- END Container -->

								</div>


<!-- END left container -->
<!-- Right container -->


								<div class="col-sm-2 pull-right" style="background-color: #0aa;">

									<h4 class="text-center">Post Details</h4>

									<div class="row">
										<input
											class=""
											type="text"

											name="PostPhaseOfDay"
											value="' . $postPhaseOfDay . '"
											placeholder="?"/>


										<input
											class=""
											type="text"

											name="PostTimeOfDay"
											value="' . $postTimeOfDay . '"
											placeholder="0000-00-00 00:00:00"/>
									</div><!-- end container-->

									<div class="row">
										<select class="selectpicker">
											<option>Post Rating</option>
											<option>IC</option>
											<option>OOC</option>
											<option>Guidance</option>
											<option>Journal</option>
											<option>Timeline</option>
										</select>
									</div>

									<div class="row">
										<select class="selectpicker">
											<option>Weather</option>
											<option>IC</option>
											<option>OOC</option>
											<option>Guidance</option>
											<option>Journal</option>
											<option>Timeline</option>
										</select>
									</div>


									<div class="row">
										<input
											class=""
											type="text"

											name="PostLocation"
											value="' . $pLocation . '"
											placeholder="Where?"/>
									</div><!-- end container-->


									<div class="row">
										<input
											class=""
											type="text"

											name="PostLocation"
											value="' . $postTimeOfDay . '"
											placeholder="When?"/>
									</div><!-- end container-->



									<div class="row">
										<textarea
											name="PostNotes"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="OOC Notes? "
											>' . $pNotes . '"</textarea>
									</div><!-- end container-->

									<!-- auto fill needed -->
									<div class="row">
										<input
											class=""
											type="text"

											name="PostTags" ';



		#get codenames for tags
		#set ground work for tags
		#$threadTag 	= $row['ThreadTag'];
		$arrTags 		= explode(',', $pTags);
		$arrNames 	= get_tNames($sqlTags);


		#if we have tags show them
		if (isset($threadTag)){
			$pTags .= '<span class="glyphicon glyphicon-tag"></span> ';

			$x = 0;
			$tot = count($arrTags);

			#make links, comma seperated
			foreach($arrTags as $key => $value)
			{
				$pTags .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';
			}
		}

										$str .= 'value="' . $pTags . '"

											placeholder="Tags?" />
									</div><!-- end container-->


								</div><!-- end right container -->
							</div><!-- end inner container -->

						<div class="clearfix">
							<br /><br />
						</div>

						<div
							align="center"
							style="background-color: #a0a;">

							<input  type="hidden" name="act" value="updatePost" />
							<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Post">

							&nbsp; &nbsp;

							<a class="btn btn-primary btn-xs outline" href="index.php">Exit Post #' . $rID . '</a>
						</div>

					</form>
				</div>

			<!-- END content -->';
			}

		}else{//no records
			echo '<div align="center">
				<h3>Houston we have a problem...</h3>
			</div>';
		}

		@mysqli_free_result($result); //free resources

	} else { #redirect back to timeline
		echo '<div align="center">
				<h3>Houston we have a problem...</h3>
			</div>';

		myRedirect('index.php');
	}

	return $str;

}

function postInsert($str=''){
/*

	SELECT PostID, ThreadID, CatID, UserID, CharID, PostType,
PostApproval, PostRating, PostVisible,
PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation,
PostContent, PostNotes, PostSummary, PostTags,
DatePostLock, DatePostPost, DatePullPost,
LastEditor, DateCreated, DateAssigned, LastUpdated
FROM ma_Posts;

*/

	#PDO Setup needed vars...
	#$PostID 				= $_POST['PostID'];
	$ThreadID 			= $_POST['ThreadID'];
	#$CatID 				= $_POST['CatID'];

	#$UserID 				= $_POST['UserID'];
	$CharID 				= $_POST['CharID'];
	#$PostType 			= $_POST['PostType'];
	#$PostApproval 	= $_POST['PostApproval'];
	#$PostRating 		= $_POST['PostRating'];
	#$PostVisible 	= $_POST['PostVisible'];
	#$PostFrom 			= $_POST['PostFrom'];
	#$PostFeaturing 		= $_POST['PostFeaturing'];
	#$postPhaseOfDay 		= $_POST['PostPhaseOfDay'];
	#$postTimeOfDay 		= $_POST['PostTimeOfDay'];
	#$postWeather 			= $_POST['PostWeather'];
	#$PostLocation 	= $_POST['PostLocation'];
	$PostContent 		= $_POST['PostContent'];
	#$PostNotes 		= $_POST['PostNotes'];
	#$PostSummary 	= $_POST['PostSummary'];
	#$PostTags 			= $_POST['PostTags'];
	#$DatePostLock 	= $_POST['DatePostLock'];
	#$DatePostPost 	= $_POST['DatePostPost'];
	#$DatePullPost 	= $_POST['DatePullPost'];
	#$LastEditor 		= $_POST['LastEditor'];
	#$DateCreated 	= $_POST['DateCreated'];
	#$DateAssigned 	= $_POST['DateAssigned'];
	#$LastUpdated	 	= $_POST['LastUpdated'];

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
		$sql = "INSERT INTO ma_Posts (
				ThreadID, CharID, PostContent
			)
			VALUES ( ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $ThreadID,				PDO::PARAM_STR);
	$stmt->bindValue(2, $CharID,					PDO::PARAM_STR);
	$stmt->bindValue(3, $PostContent,			PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Post Added Successfully To Thread Name!","success");
	}else{//Problem!  Provide feedback!
		feedback("Post NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}

#shows most recent posts - paged format ($tally sets amount shown)
#shows most recent posts - paged format ($tally sets amount shown)
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
		$cLinxkArr = get_cLinks();


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

			$cName						= $cLinxkArr[$cID]['link'];
			#format post id to 4 places

			$pID   						= (int)$row['PostID'];
			$pFormattedID  		= str_pad($pID, 4, '0', STR_PAD_LEFT);

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

			$str .= postDetails($pFormattedID, $pLocation, $pWeather, $gTime, $pNotes, $pSummary, $pTags, $tID );

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
					$str .= '<div class="col-sm-7" style="background-color: white;">
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


	//*change second letter to astrological month, sign? */




	$realAge = setAge($dob);

	#all is good...
	if(($realAge != '') || ($realAge != 0) && ($appAge != '') || ($appAge != 0)){
		$dob = $dob . ' &nbsp; <small class="text-muted">('
								. $realAge
								.  ' / '
								. $appAge . ' - <em>' . $zSign . '</em>)</small>'; #Add 0 back for troublshooting...
	}

	$str .= '<div class="row hoverHighlight col-xs-12">
		<div class=" col-sm-3 text-right-responsive   col-xs-12">
			<p class="text-muted"><strong>' . ucwords($title) . ':</strong> </p>
		</div>

		<div class="col-sm-9  col-xs-12">
			<p class="">' . $dob . '</p>
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


