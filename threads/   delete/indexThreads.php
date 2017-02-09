<?php
function maxDoc_threads_index(){
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


$config->metaDescription = 'Marvel Cinematic Universe Timeline (alternative)'; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Avengers, X-Men, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil, Young Avengers, Fantastic Four';
/*
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

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

get_header('headerJumbo-inc.php', 'bgWelcome00.jpg', '&nbsp; &nbsp;Threads <br /><br />');


include 'threads-css.php';


echo '<div class="container-fluid main-container">
	<div class="col-md-3 sidebar" >';

	#chatbox
	#echo chitChat(); #chatBox function...
	echo '<br />';

	echo selectCat();

	echo '<br /><br />';

	#recent threads (IC)
	echo threadSidebar('IC', $sql); #ic threads...

	#threadSidebar(OC)
	echo threadSidebar('OOC', $sql); #OOC posts...
	echo '</div>';


#BEGIN main content
switch ($myAction)
{//check 'act' for type of process
	default:
		echo threadRecent($sql, $sqlTags);
	}

echo get_footer();

##################   HELPER FUNCTION$   ##################

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
#extend class - add pager 'getPostsPaged' so we have the option for full thread read and paged read for mobile




function getTagNames($sql, $arrTags=''){
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

					$threadID 		= (int)$row['ThreadID'];
					$catID    		= (int)$row['CatID'];
					#$catTitle 		= $row['CatTitle'];
					$myCatID    	= $_GET['id'];
					$myCatName    = $_GET['categoryName'];

					#if category matches selected category show
					if($catID == $myCatID){

						$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">

								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $threadID . '"> ' . $row['ThreadTitle'] . ' </a>

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

#function threadClone($sql, $sqlTags, $str=''){  TODO  }








#Th-Th-Th-Th-Th-... That's all, folks.
?>





