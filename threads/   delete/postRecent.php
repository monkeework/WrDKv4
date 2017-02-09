<?php
function maxDoc_threads_postRecent(){
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

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials


$config->metaDescription = 'Marvel Cinematic Universe alternative Roleplay' . $config->metaDescription; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Avengers, X-Men, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil, Young Avengers, Fantastic Four';


$sqlThreads = "SELECT ThreadID, CatID, PostID, UserID, CharID, ThreadType,
ThreadRating, ThreadApproval, ThreadVisible,
ThreadFrom, ThreadFeaturing, ThreadPhaseOfDay, ThreadTimeOfDay, ThreadWeather, ThreadLocation,
ThreadContent, ThreadTitle, ThreadNotes, ThreadSummary,
ThreadTag, DateLockThread, DatePostThread, DatePullThread, LastEditor,
DateCreated, DateAssigned, LastUpdated FROM ma_Threads;";

/*
$sqlPosts = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType,
PostApproval, PostRating, PostVisible,
PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation,
PostContent, PostNotes, PostSummary, PostTags,
DatePostLock, DatePostPost, DatePullPost,
LastEditor, DateCreated, DateAssigned, LastUpdated
FROM ma_Posts;";
*/

#sql for post data
$sqlPost = "SELECT * FROM ma_Posts ORDER BY DateCreated DESC";
#sql call for tags
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

get_header('headerJumbo-inc.php', 'bgWelcome00.jpg', '&nbsp; &nbsp;Recent Posts <br /><br />');

#include 'threads-css.php';

/* create a thread of posts, paginated, order by date created (most recent to last) */
echo '<div class="container-fluid main-container">';

	echo '<div class="col-sm-3 col-xs-12 sidebar" >';

	#chatbox
	#echo chitChat(); #chatBox function...
	echo '<br />' . selectCat() . '<br /><br />';

	#recent threads (IC)
	echo threadSidebar('IC', $sql); #ic threads...

	#threadSidebar(OC)
	echo threadSidebar('OOC', $sql) . '</div><!-- END sidebar -->';


	#CONFIG DATA

	$str=$cName=$cArr='';
	$pFormattedID=$pID=$postLocation=$postWeather=$postContent=$postNotes=$postSummary=$postTags='';
	$cID=$tID='';
	$gameTime=$formatLastUpdate=$format='';

	#get tally tolal - cast to int
	$tally=(int)$_GET['tally'];
	#set default show value
	#add user pref - 10, 20, 25, 50, 100
	#add user pref - 10, 20, 25, 50, 100
	if(($tally == '') || ($tally == 'X')){ $tally=10;}

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

		echo '<h3><strong>We have ' . $pager->showTotal() . ' ' . $itemz . '!</strong></h2>';

		#BEGIN main content
		echo '<!-- MAIN CONTENT begin -->
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

			 echo '<div class="col-sm-12" style="background-color: ">
			 <hr >
				 <div class="col-xs-1"  style="margin-left: -40px; margin-right: 20px;">' . mk_cThumb($cID) . '</div>
				 <p class="col-sm-7 col-xs-11">
					<strong>' . $cName . ' &raquo; </strong> ' .  nl2br($pContent) . '
				</p>
				<div class="col-sm-4">
					<small>
						<p><strong>Post &raquo; </strong> [' . $pFormattedID  . '] </p>';

						if($pLocation != ''){ echo '<p><strong>Where &raquo; </strong> ' . $pLocation . ' </p>'; }

						echo '<p><strong>Weather &raquo; </strong> ' . $pWeather . ' </p>
						<p><strong>When &raquo; </strong> ' . $gTime = date($format, $gTime) . ' </p>
						<p><strong>Notes &raquo; </strong> ' . nl2br($pNotes) . ' </p>
						<p><strong>Summary &raquo; </strong> ' . nl2br($pSummary) . ' </p>';

						#set them to not show if no tags...
						echo '<p><strong>Tags &raquo; </strong>' . get_pTags($pTags) . '</p>
						<p><strong>Mentions &raquo; </strong>' . get_pTags($pTags) . '</p>

						<a href="' . VIRTUAL_PATH . 'threads/thread.php?tID=' . $tID . '" class="btn btn-info btn-xs"> Go To Thread</a>
					</small>
				 </div><!-- end right sidebar details -->
			</div>
			<hr />';
		}
		echo $pager->showNAV(); # show paging nav, only if enough records
	}else{#no records
		echo "<div align=center>Currently no posts. You should do </div>";
	}

echo '<!-- END post/content -->
</div>
<!-- START footer-->';

echo get_footer();



#function postMove(){}


#Th-Th-Th-Th-Th-... That's all, folks.
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
