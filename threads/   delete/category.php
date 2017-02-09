<?php
function maxDoc_threads_thread(){
	/**
	 * postback application based on add_pdo-update is a single page web application that allows us customer to
	 * to add a new an existing table
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

	# '../' works for a sub-folder.  use './' for the root require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
}

$pageDeets = '<ol>
						<li> Resolve chat box overlap issue</li>
						<li> Spin Out Posts to new threads</li>
						<li> Auto-tagging</li>
						<li> Review/update function checkForm(thisForm)</li>

						<!--
							<ul>
								<li> m2 - extended layout?</li>
								<li> m2 - notifications-mail</li>
								<li> m2 - character posting styles</li>
								<li> m2 - dashboard</li>
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

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials




$sqlThreads = "SELECT ThreadID, CatID, PostID, UserID, CharID, ThreadType,
ThreadRating, ThreadApproval, ThreadVisible,
ThreadFrom, ThreadFeaturing, ThreadPhaseOfDay, ThreadTimeOfDay, ThreadWeather, ThreadLocation,
ThreadContent, ThreadTitle, ThreadNotes, ThreadSummary,
ThreadTag, DateLockThread, DatePostThread, DatePullThread, LastEditor,
DateCreated, DateAssigned, LastUpdated FROM ma_Threads;";


$sqlPosts = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType,
PostApproval, PostRating, PostVisible,
PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation,
PostContent, PostNotes, PostSummary, PostTags,
DatePostLock, DatePostPost, DatePullPost,
LastEditor, DateCreated, DateAssigned, LastUpdated
FROM ma_Posts;";


$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";


#For Threads-short
$sql = "SELECT ThreadID, CatID, PostID,
ThreadFeaturing, ThreadType,
ThreadTitle, ThreadNotes, ThreadSummary,
ThreadTag, DatePostThread, DatePullThread,
DateCreated, LastUpdated FROM ma_Threads;";

$sqlCodeNames = "SELECT Codename, CharID FROM ma_characters
WHERE CharID IN (1,2,3,4,7,12);";

$sqlUserNames = "SELECT UserID, UserName, Privilege FROM ma_Users
WHERE UserID = 1;";


//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;
get_header();

#dumpDie($_SESSION);

include 'threads-css.php';


echo '<div class="jumbotron bottom-align">
		<h2 style="color: White;"><br /><br /><br /><br /><br />
		Recent <b>Threads</b></h2><br />
	</div>';

#echo MaxNotes($pageDeets); #notes to me!


echo selectCat();

echo '<br /><br />
	<div class="container-fluid main-container">
		<div class="col-md-3 sidebar" >';

#chatbox
#echo chitChat(); #chatBox function...
echo '<br />';

#recent threads (IC)
echo threadSidebar('IC', $sql); #ic threads...

#threadSidebar(OC)
echo threadSidebar('OOC', $sql); #OOC posts...
echo '</div></div>';
#END sidebar


#BEGIN main content
switch ($myAction)
{//check 'act' for type of process
	case "categoryShow":
		echo categoryShow($sql, $sqlTags); #show all threads in specific category

		break;
	########################################################
	case "threadShow":
		echo threadShow($tally=8); #show all posts of single thread

		break;
	########################################################
	case "threadAdd":
		echo threadAdd($sql, $sqlTags); #show form to add a thread to catagory/general populace

		break;
	########################################################
	case "threadEdit":
		echo threadEdit($sqlThreads, $sqlTags); #show form to add a thread to catagory/general populace

		break;
	########################################################
	case "threadRevise":
		echo threadRevise($sqlThreads, $sqlTags); #show form to add a thread to catagory/general populace

		break;
	########################################################
	########################################################
	########################################################
	default:
		echo threadRecent($sql, $sqlTags);

	}

echo get_footer();






###################   MAIN FUNCTION$   ###################

function threadShow($tally, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	$sql = "SELECT ThreadID, CatID, PostID,
		ThreadFeaturing, ThreadType,
		ThreadTitle, ThreadNotes, ThreadSummary,
		ThreadTag, DatePostThread, DatePullThread,
		DateCreated, LastUpdated FROM ma_Threads;";


	$str .= '<!-- start general content -->

	<div class="col-md-9 pull-right">';

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$myID    = $_GET['id'];
			$threadID = (int)$row['ThreadID'];


			#if category matches selected category show
			if($myID == $threadID){
				$str .=  '<h3 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $threadID . '"> ' . $row['ThreadTitle'] . ' </a>
					</h3>

					<p>'. $row['ThreadSummary'] . '</p>';

					$threadTag 	= $row['ThreadTag'];

					#######################################################
					#get Codenames of characters tagged

					#get all unique id sets
					$sqlAllTags = "SELECT DISTINCT PostTags FROM ma_Posts WHERE ThreadID = $myID";

					$myStr = '';

					$resultAllTags = mysqli_query(IDB::conn(), $sqlAllTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
					if (mysqli_num_rows($resultAllTags) > 0)//at least one record!
					{//show results

						$count = 0;
						$myStr = '';

						#process id sets into string, add duplicates removed
						while ($row = mysqli_fetch_assoc($resultAllTags))
						{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
							$myStr .=  $row['PostTags'] . 'x';
						}

						#remove double commas
						$myStr = str_replace('xx',',', $myStr);
						$myStr = str_replace('x',',', $myStr);

						#remove duplicates
						$myStr = implode(',',array_unique(explode(',', $myStr)));

						#format numbers to row comma quoted delinated row with
						$myStr = "'" . str_replace(array("'", ","), array("\\'", "','"), $myStr) . "'";

						#removing trailing comma and or empty/white space or combos there of.
						$myStr = str_replace(",''",'', $myStr);
					}

					@mysqli_free_result($resultAllTags); //free resources





#dumpDie($myStr);
#string '' (length=0)

					$postTagsNew = $sqlCharTags = '';
					//we might not have any tags
					if($myStr !==''){
						$sqlCharTags = "SELECT Codename, CharID, Overview FROM ma_Characters WHERE CharID IN ($myStr) ORDER BY Codename;";

						$resultCharTags = mysqli_query(IDB::conn(), $sqlCharTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
							if (mysqli_num_rows($resultCharTags) > 0)//at least one record!
							{//show results

								$count = 0;
								$postTagsNew .= '<p>Featuring: ';

								while ($row = mysqli_fetch_assoc($resultCharTags))
								{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
									$myCodeName 			= $row['Codename'];
									$myCharID   			= $row['CharID'];
									$myCharOverivew   = $row['Overview'];

									#add in comma/seperator
									If($count++ >= 1){ $postTagsNew .= ', ';}

									$postTagsNew .= '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $myCodeName . '&id=' . $myCharID . '&act=show"

									data-toggle="tooltip" data-placement="right" title="' . $myCharOverivew  . '"

									>' . $myCodeName . '</a>';
								}
							$postTagsNew .= '</p>';
						}

					}


#dumpDie($sqlCharTags);
/*
Error in file: '/Applications/AMPPS/www/WrDKv3/threads/index.php' on line: 1382 Error message: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') ORDER BY Codename' at line 1
*/



				$str .= $postTagsNew;
				#######################################################


				if(startSession() && isset($_SESSION['UserID'])){
					$str .= '<p><!-- set to invisible actually -->
						<a class="" href="' . THIS_PAGE . '?act=threadRemove&id=' . $myID . '">Remove Thread</a>

						&nbsp; | &nbsp;

						<a class="" href="' . THIS_PAGE . '?act=threadLock&id=' . $myID . '">Lock Thread</a>

						&nbsp; | &nbsp;

						<!-- set to invisible actually -->
						<a class="" href="' . THIS_PAGE . '?act=threadEdit&id=' . $myID . '">Edit Thread</a></p>';
				}

				#FROM HERE
				#now get all the related posts
				$str .= getPostsPaged($threadID, $tally); #get all psots

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

function threadRecent($sql, $sqlTags, $str=''){
	/**
	 * Show the most recent posts, set pager to 3 for test
	 */

	$str .= '<!-- start general content -->

	<div class="col-md-9 pull-right">

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

					$threadID = (int)$row['ThreadID'];

					$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $threadID . '">' . $row['ThreadTitle'] . ' </a>

								<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
							</h4>
						</div>
						<div id="collapse-' . $threadID . '" class="panel-collapse collapse">
							<div class="panel-body">
								<p>'. $row['ThreadSummary'] . '</p>
								<p>';

								#set ground work for tags
								$threadTag 	= $row['ThreadTag'];
								$arrTags 		= explode(',', $threadTag);
								$arrNames 	= getTagNames($sqlTags);

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

								$str .=  '<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';
				}

				@mysqli_free_result($result); //free resources

				$str .= $myPager->showNAV(); # show paging nav, only if enough records

				}else{#no records
					$str .= "<div align=center>There are currently no posts. Wierd.</div>";
				}

			$str .='</div><!-- end accordian -->
			</div>';


			if(startSession() && isset($_SESSION['UserID'])){
				$str .='<p> <a href="' . THIS_PAGE . '?act=threadAdd" class="btn btn-primary btn-xs pull-right">Add New Thread</a></p>';
			}

			$str .='</div> <!-- END content -->';

	return $str;
}

function threadAdd($sql, $sqlTags, $str=''){
	/**
	 * create a new thread:D
	 */
	$threadId 				= '';
	$threadTitle    	= 'N2G Thread Title';
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
						<h4 class="text-center">Add Post to <b>' . $threadTitle .  '</b></h4>';

							#Pulldown-Post-Type
							#function also used in profiles
							#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-Post-As
							#function also used in profiles
							#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-select character emoji:
							#function also used in profiles
							#echo mkRadio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


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

		$myThreadID = ($_GET["id"]);

		$sqlThreads = "SELECT ThreadID, CatID, PostID, UserID, CharID,
			ThreadType, ThreadRating, ThreadApproval,
			ThreadVisible, ThreadFrom, ThreadFeaturing,
			ThreadPhaseOfDay, ThreadTimeOfDay,
			ThreadWeather, ThreadLocation,
			ThreadContent, ThreadTitle, ThreadNotes, ThreadSummary,
			ThreadTag,
			DateLockThread, DatePostThread, DatePullThread, LastEditor,
			DateCreated, DateAssigned, LastUpdated FROM ma_Threads
			WHERE ThreadID = $myThreadID;";


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

					$threadTitle    	= dbOut($row['ThreadTitle']);
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
							<h4 class="text-center">Edit <b>' . $threadTitle .  '</b></h4>

							<div class="row">
									<input
										class="col-sm-12"
										type="text"

										name="ThreadTitle"
										value="' . $threadTitle . '"
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
					<input  type="hidden" name="ThreadID" value="' . $myThreadID . '" />

					<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Thread">

					&nbsp; &nbsp; ';

					if(startSession() && isset($_SESSION['UserID'])){
						$str .= '<!-- set to invisible actually -->
						<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '?act=threadRemove&id=' . $threadId . '&threadName=' . formatUrl($threadTitle) . '">Remove Thread</a> &nbsp; &nbsp; ';
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

function threadRevise($sqlThreads, $sqlTags, $str=''){

	#echo 'thread revise';
	#dumpDie($_POST);

	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		#get thread id to delete - we want this ultimatelyt to be a post

		$threadID   				= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		$threadType    			= strip_tags($_POST['ThreadType']);				#chk
		$threadRating   		= strip_tags($_POST['ThreadRating']);			#chk
		$threadPhaseOfDay   = strip_tags($_POST['ThreadPhaseOfDay']);	#chk
		$threadTimeOfDay   	= strip_tags($_POST['ThreadTimeOfDay']);	#chk
		$threadWeather    	= strip_tags($_POST['ThreadWeather']);		#chk
		$threadLocation   	= strip_tags($_POST['ThreadLocation']);		#chk
		$threadContent    	= strip_tags($_POST['ThreadContent']);		#chk
		$threadTitle    		= strip_tags($_POST['ThreadTitle']);			#chk
		$threadNotes    		= strip_tags($_POST['ThreadNotes']);			#chk
		$threadSummary    	= strip_tags($_POST['ThreadSummary']);		#chk
		$threadTag    			= strip_tags($_POST['ThreadTag']);				#chk



/*
	Full Set
		$threadID   				= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		#$postID    				= strip_tags($_POST['PostID']);
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
		$threadTitle    		= strip_tags($_POST['ThreadTitle']);			#chk
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
			$stmt->bindParam(':ThreadID',					$threadID, 					PDO::PARAM_INT);
			$stmt->bindParam(':CatID',						$catID, 						PDO::PARAM_INT);
			$stmt->bindParam(':ThreadType',				$threadType, 				PDO::PARAM_INT);
			$stmt->bindParam(':ThreadRating',			$threadRating, 			PDO::PARAM_INT);
			$stmt->bindParam(':ThreadPhaseOfDay',	$threadPhaseOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadTimeOfDay',	$threadTimeOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadWeather',		$threadWeather, 		PDO::PARAM_INT);

			$stmt->bindParam(':ThreadLocation',		$threadLocation, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadContent',		$threadContent, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTitle',			$threadTitle, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadNotes',			$threadNotes, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadSummary',		$threadSummary, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTag',				$threadTag, 				PDO::PARAM_STR);


/*
	Full Set
	$stmt->bindParam(':ThreadID',						$threadID, 						PDO::PARAM_INT);
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
	$stmt->bindParam(':ThreadTitle',				$threadTitle, 				PDO::PARAM_STR);
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
			feedback("$threadTitle Was Successfully Revised!","success");
		}else{//Problem!  Provide feedback!
			feedback("$threadTitle NOT REVISED!","warning");
		}
		myRedirect(THIS_PAGE);
	}
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

#function threadMove
#function threadHidden - show all 'nuked' threads



?>



<script>
	$(document)
		.one('focus.textarea', '.autoExpand', function(){
			var savedValue = this.value;
			this.value = '';
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

<script src="//cdn.jsdelivr.net/prefixfree/1.0.7/prefixfree.min.js"></script>

<!-- Prefixfree.js allows you to write prefix-free CSS
		 This means no -webkit-transform, -moz-transform, ... -->


<!--
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->

<!-- for word count -->
<script>
	counter = function() {
		var value = $('#text').val();

		if (value.length == 0) {
				$('#wordCount').html(0);
				$('#totalChars').html(0);
				$('#charCount').html(0);
				$('#charCountNoSpace').html(0);
				return;
		}

		var regex = /\s+/gi;
		var wordCount = value.trim().replace(regex, ' ').split(' ').length;
		var totalChars = value.length;
		var charCount = value.trim().length;
		var charCountNoSpace = value.replace(regex, '').length;

		$('#wordCount').html(wordCount);
		$('#totalChars').html(totalChars);
		$('#charCount').html(charCount);
		$('#charCountNoSpace').html(charCountNoSpace);
	};

	$(document).ready(function() {
		$('#count').click(counter);
		$('#text').change(counter);
		$('#text').keydown(counter);
		$('#text').keypress(counter);
		$('#text').keyup(counter);
		$('#text').blur(counter);
		$('#text').focus(counter);
	});
</script>

<!-- for toolTip -->
<script>
$(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();
});

	$('input[rel="txtTooltip"]').tooltip({
	container: 'body'
});
</script>
