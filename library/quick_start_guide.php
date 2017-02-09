<?php
function maxDoc_library_quick_start_guide(){
	/**
	 * About is a basic static information page, nothing special
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @Make field RTF editalbe like timeline page
	 */
}

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials

$config->metaDescription = 'Marvel Cinematic Universe alternative Roleplay (RPG)'; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Young Avengers, X-Men, SHIELD, S.H.I.E.L.D., Secret Warriors, Fantastic Four, Avengers, Defenders, Champions, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil ';


#For Threads-short
$sql = "SELECT ThreadID, CatID, PostID, ThreadFeaturing, ThreadType, ThreadTitle, ThreadNotes, ThreadSummary, ThreadTag, DatePostThread, DatePullThread, DateCreated, LastUpdated FROM ma_Threads;";



//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;
get_header('headerJumbo-inc.php', 'bgQuickstart00.jpg', '<br /><br />');


echo '<div class="container-fluid main-container">
	<div class="col-md-3 sidebar" >';

	#chatbox
	#echo chitChat(); #chatBox function...
	echo '<br />';


	#top sites banner / discord banner to vote for us
	echo MTS_stacked();

	#recent threads (IC)
	echo threadSidebar('IC', $sql); #ic threads...

	#threadSidebar(OC)
	echo threadSidebar('OOC', $sql); #OOC posts...
	echo '</div>';

	#END sidebar

	#BEGIN main content
	#echo threadRecent($sql, $sqlTags);
?>


	<div class="col-sm-9 pull-right">
		<h1><b></b>Quick Start Guide</b><small class="text-muted">v0.5.4 (Updated 02/05/2017)</small></h1>




		<article>
			<h2>The Character Bank, <small class="text-muted"> or your girl Friday</small></h2>
			<div class="paragraphs">
				<div class="span4">
					<a href="./../characters/index.php" title="XXX"><img class=" img-thumbnail" style="float:left; margin-right: 20px;" width="200" src="./../_img/_quikstart/quickstart-00.jpg" alt="img" /></a>
					<p>
						Marvel Champions is a world of heroes and villains set in the Marvel Cinematic Universe. Where Cinematic worlds collide with Mutants and Avengers roam the same streets. You join a world with Agents of SHIELD and Fantastic Four explorers mix it up with Asgardian Gods and Daredevil inspired heroes awaits you; once you join our shared world.
					</p>
					<p>
						The world Is set a few months after the events of Captain American Civil War. Steve Rogers and his Avengers are working in secret while SHIELD and the Slokovia accords try to regulate an ever-increasing cadre of Vigilantes and Heroes in a dangerous world with Inhumans and Ghostriders that defy logic and explore magical realms.
					</p>
					<p>
						Do you have what it takes to write yourself into the silver screen of heroes and monsters?   Imagine yourself a super spy like Hawkeye or Black Widow. Or ere you more of the Captain Marvel or The Thing whose hands and power can crumble buildings. Pick someone and write their stories in our shared Universe. Welcome to Marvel Champions.
					</p>
				</div>
			</div>
		</article>




		<article>
			<h2>The Character Bank, <small class="text-muted"> or your girl Friday</small></h2>
			<div class="paragraphs">
				<div class="span4">
					<a href="./../characters/index.php" title="XXX"><img class=" img-thumbnail" style="float:left; margin-right: 20px;" width="200" src="./../_img/_quikstart/quickstart-00.jpg" alt="img" /></a>
						<p>
						 Here we have collected, condensed, and summarized everything we believe you would need to join and get started on Marvel-Champions. But before we go further, we want to stress very firmly that Marvel-Champions is a very different kind of site. We’ve built our site from the ground up. This isn’t just another re-skinned jcink or Proboards, nor is it Google or Yahoo group that someone has attempted to beautify. No. We have re-imagined how a text based role-play can work, look, and respond to our members needs.
					</p>
					<p>
						To that end, we’ve built our site from the ground up. We’ve built our own forum software (iRPcms v0.5.3) and created many unique features so that we are beholden to no one but ourselves. As such, we have a site where anything goes and a culture that is hopefully welcoming to all.
					</p>
					<p>
						Currently we are play testing the first iteration of our system and will continue to consider, reconsider, iterate, and develop our systems, policies, and procedures so that we can be as adaptive and responsive to our membership as is possible. At the moment, our site already boasts a few unique features, many of which can be seen when visiting <a href="./../characters/index.php" title="Our onestop claims guide">Jarvis, Friday, &amp;  Cerebor</a> or whatever you'd like to call it.
					</p>
					<h4>The Character Bank in a nutshell</h4>
						<a href="./../characters/index.php" title="XXX"><img class=" img-thumbnail" style="float:left; margin-right: 20px;" width="200" src="./../_img/_quikstart/quickstart-01b.jpg" alt="img" /></a>

					<a href="./../characters/index.php" title="XXX"><img class=" img-thumbnail" style="float:left; margin-right: 20px;" width="200" src="./../_img/_quikstart/quickstart-01.jpg" alt="img" /></a>
					<p>
						The <a href="./../characters/index.php" title="Our onestop claims guide">Character bank</a>, a responsive tool which has been designed to help you find various things quickly and to save you the time and hassle of having to upload character profiles, faceclaims, participate in activity checks, and more. If you want to know if Cyclops is available or take, who plays him, what he can do or his powers and history, just enter his codename into the search box for characters. If you want to see all the playbys or the playby resources we have, enter the name of the playby you interested in  OR just click to see our available assets - which will preload into your app if you choose one so you don't have to code anything. And the best think about the Character Bank is that it handles your faceclaim, activity checks, and also automatically uploads your character into the Character Bank. No need to make a thread for the character. It just happens.
					</p>
					<p>
						<small>
							Call it what you like, Jarvis, Friday, Cerebro, Burt, whatever, our claims tool handles everything automatically for you, and it does so behind the scenes. Say goodbye to the days of hassling with code and scripts to post faceclaims, plotters, activity checks, and more. Our claims tool does it all and more.
						</small>
					</p>
				</div>
			</div>
		</article>



		<article>
			<h2><a href="http://marvel-champions.com/library/quick_start_guide.php#" title="Join Marvel Adventures!" >Registration</a></h2>
			<div class="paragraphs">
				<div class="span4">
					<img class=" img-thumbnail" style="float:left; margin-right: 20px; border:1px solid #111;" width="200" src="./../_img/_quikstart/quickstart-00.jpg" alt="img" />
					<p>
						To register, you can either select the 'Join MC' select from the black ribbon at the top of our site, or you can <a href="http://marvel-champions.com/library/quick_start_guide.php#" title="Join Marvel Adventures!" >click here to request membership now!</a> Either will open a small modal window where you will be asked you for:
					</p>

					<br /><br /><br />
					<ol>
						<li>
							Your desired name/username
						</li>
						<li>
							You will only ever need one login to access all of your characters, postings, 			records, et al on Marvel-Champions. Unlike other sites, we’re not asking you to create a thousand logins and accounts. One account will handle it all. So please, unless your real name is Scot Summers, don’t choose the name scot_summers. My username for instance is Max.
						</li>
						<li>
							Your email address which will be used as your login - you will only ever need one login to marvel-adventures.
						</li>
						<li>
							Write us a very brief message (140 words or less please) regarding who you are interested adopting
						</li>
							<ul>
								<li>
									Original Character (One of your own making an design which does not duplicate that of a featured character)
								</li>
								<li>
									Featured Character such as the Black Widow, Iron Fist, or the Wasp.
								</li>
							</ul>
						<li>
							Check the Join Marvel Champions link so that your message is appropriately flagged
						</li>
						<li>
							Check the box that says your not a robot - if you don't we likely won't ever see your message.
						</li>
					</ol>
				</div>
			</div>
		</article>

		<div class="clearFix" ></div>

		<article>
			<h2><a href="">USER SET UP</a></h2>
			<div class="paragraphs">
				<div class="span4">
					<img class=" img-thumbnail" style="float:left; margin-right: 20px;  border:1px solid #111;" width="200" src="./../_img/_quikstart/quickstart-00.jpg" alt="img" />
					<p>
						Once you are approved for membership and have logged in to Marvel-Champions, you will automatically log in to your personal dashboard which helps to organize all of your characters, communications, ect.
					</p>
					<p>
						The start page is a tool we are currently working on to help you with all your necessary actions, needs, and desires. It's sort of an automated To Do list which you can ignore at your prerogative. When you login, you will always login to your start page unless you update your desired start point by clicking the ’set your start page here’ link at the bottom of your dashboard start page.
					</p>
					<p>
						There you can set where you’d like to start from. You can choose from several options depending on how many characters you are handling, and how you like to interact with Marvel-Champions.
					</p>
				</div>
			</div>
		</article>



		<article>
			<h2><a href="http://rpgrating.com">Site Rating</a></h2>
			<div class="paragraphs">
				<div class="span4">
					<img class=" img-thumbnail" style="float:left; margin-right: 20px;" width="100" src="http://rpgrating.com/ratings/l3_s3_v3.gif" alt="Marvel Champions is rated L-3 | S-3 | V-3" />
					<p>
						Our site rating is 3/3/3 as detailed at <a href="http://rpgrating.com">RPGrating</a> for some sort of a standard. In short, that covers language, sex, and violence. Those are the highest ratings on the site, indicating few if any limitations in all three of those categories. As explained on that site, this rating doesn&rsquo;t necessarily mean that the rpg will be a free-for-all, but that mature themes can be expected in general. If that&rsquo;s something which is going to be an issue for you, please consider that before applying.
					</p>
				</div>
			</div>
		</article>



		<article>
			<h2><a href="">MEMBERSHIP PAGE</a></h2>
			<div class="paragraphs">
				<div class="span4">
					<img class=" img-thumbnail" style="float:left; margin-right: 20px; border:1px solid #111;" width="200" src="./../_img/_quikstart/quickstart-00.jpg" alt="img" />
					<p>
						Once you are approved for membership and have logged in to Marvel-Champions, you will automatically login to your personal dashboard which helps to organize all of your characters, communications, et.
					</p>
					<p>
						The start page is a tool we are currently working on to help you with all your necessary actions, needs, and desires. Sort of an automated To Do list which you can ignore at your prerogative. When you login, you will always login to your start page unless you update your desired start point by clicking the ’set your start page here’ link at the bottom of your dashboard start page.
					</p>
					<p>
						There you can set where you’d like to start from. You can choose from several options depending on how many characters you are handling, and how you like to interact with Marvel-Champions.
					</p>
				</div>
			</div>
		</article>



		<article>
		<h2><a href="" />HELPFUL LINKS</a></h2>
			<p>
				Below you will find a collection of links which we hope will answer many of your other questions.
			</p>

			</p>
			<div class="">
				<a href="./rules.php#register" class="">Register</a> :: How to Join Marvel Adventures<br />
				<a href="./rules.php#characters" class="">Characters</a> :: Quick Start Guide on how to Create a character<br />
				<a href="./rules.php#stats" class="">STATs</a> :: The definitions of a characters limits<br />
				<a href="http://www.rpgrating.com" class="">Rating</a> :: MA is rated L3/S3/V3<br />
				<a href="./rules.php#posting" class="">Post</a> :: Our guidelines and rules for posting<br />
				<a href="./rules.php#rules" class="">Rules</a> :: Our current and ever evolving rule set<br />
				<a href="./rules.php#activity" class="">Activity</a> :: Coming soon - a tool so you can see who is and isn't active which will notify you when your in danger of loosing a character<br />
				<a href="./faqs.php" class="">FAQ</a> :: Frequently asked questions- updated weekly staring in March 1st, 2017.<br />
			</div>
		</article>

	</div>
</div>


<?php


#has revised contact modal in it...
#echo get_footer('footerContact_inc.php');
echo get_footer();

##################   HELPER FUNCTION$   ##################


#Th-Th-Th-Th-Th-... That's all, folks.
