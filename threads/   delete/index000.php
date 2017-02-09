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

get_header('headerJumbo-inc.php', 'bgWelcome00.jpg', '&nbsp; &nbsp;Recent Posts <br /><br />');

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
	case "categoryShow":
		echo categoryShow($sql, $sqlTags); #show all threads in specific category

		break;
	########################################################
		case "categoryAdd":
		echo categoryAdd(); #show all threads in specific category

		break;
	########################################################
	case "categoryInsert":
		echo categoryInsert(); #show all threads in specific category

		break;
	########################################################
	case "categoryEdit":
		echo categoryEdit(); #show all threads in specific category

		break;
	########################################################
	case "categoryRevise":
		echo categoryRevise(); #cetegoryEdit Formhandler

		break;
	########################################################
	case "categoryRemove":
		echo categoryRemove(); #set thread to hidden basically - vM2

		break;
	########################################################
	########################################################
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

	case "postRecent":
		echo postRecent($tally=8); #show all recent threads.

		break;
	########################################################
	case "postShow":
		echo postShow(); #show single post
		#threadShow($tally=1);

		break;
	########################################################
	case "postAdd":
		echo postAdd(); #show form to add a post to thread

		break;
	########################################################
	case "postInsert":
		echo postInsert();

		break;
	########################################################
	case "postEdit":
		echo postEdit($sqlTags);

		break;
	########################################################
	case "postTrash":
		echo postTrash();

		break;
	########################################################
	default:
		echo threadRecent($sql, $sqlTags);

	}

echo get_footer();



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