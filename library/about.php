<?php
function maxDoc_threads_about(){
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

$config->metaDescription = 'Marvel Cinematic Universe Timeline (alternative)'; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Avengers, X-Men, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil, Young Avengers, Fantastic Four';


#For Threads-short
$sql = "SELECT ThreadID, CatID, PostID, ThreadFeaturing, ThreadType, ThreadTitle, ThreadNotes, ThreadSummary, ThreadTag, DatePostThread, DatePullThread, DateCreated, LastUpdated FROM ma_Threads;";



//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;
get_header('headerJumbo-inc.php', 'bgWelcome00.jpg', '&nbsp; &nbsp;Welcome <br /><br />');


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
?>


	<div class="col-sm-9 pull-right">
		<article>
			<h2>Post &amp; Play, thats our motto.</h2>

			<p>
				 Post and Play, that&rsquo;s our motto and we mean it! We&rsquo;re a new, interactive, online roleplay based on the Marvel Cinematic Universe, and unlike other roleplays, we use our own "home-brewed" mobile CMS specifically developed for text based roleplaying! What is a CMS you might ask? A <a href="https://en.wikipedia.org/wiki/Content_management_system">content management system</a> is a software application or set of related programs that are used to create and manage digital content. CMSes are typically used for enterprise content management (ECM) and web content management (WCM). Our CMS will automatically handle trivial tasks such as activity checks, formatting, eliminating the need for "multiple accounts" and or account "switching", face claims, elininate the need for thread trackers, and all that other tedium that so often comes with trying to run an roleplaying site. Now, we leave all of that annoyance and "busy work" to the past. Why? Because we automated the fuck out it! We still have all that stuff, but it just happens easy pleasey.
			</p>
			<p>
				It&rsquo;s stupid waste of YOUR time, in our opinion, to have to post the same information all over the place. Further, it&rsquo;s time consuming and makes finding things confusing. So we&rsquo;ve actually built a CMS unlike any other in the world, which is designed to do things like handle automating tagging, check word counts for you, alert you to posts you might find interesting based on your preferences, and more. Our Application developer, The Architect (Thats right folks, we have our own personal programming team) is constantly working behind the scenes to make life easier for all of us so that our content handlers (Players/Participants) and storytellers can concentrate on running storylines that everyone so actively wants to spend their time doing instead of doing silly, time consumming tedium like activity checks and face claims, et al (All of that nonsense has been automated. Just finish your character appliction and you'll find that your faceclaim, character claime, et al has also happened behind the scenes with a single click of the approval button so you can go play as soon as you are approved. Pretty awesome huh? We think so.
			</p>
		</article>

		<article>
			<h2>Initial Overview</h2>
			<p>
				Marvel Champions is an advanced roleplay which welcomes both new and intermediate users with the belief that anyone can join an advanced RP if the membership is willing to help, and our membership is. Our storylines range from site-wide to solitary, moderator-driven to character-driven with a minimum word count of 200 words per post. Original Characters (OCs) and Featured Characters (FCs) are welcome – and our application, which might look daunting, is pretty easy because we&rsquo;ve automated the tedium out of it. Example, you want to use Taylor Swift for your playby. Just type her name and, if we have images of here in our site assets, your character images will auto load for you. If you don&rsquo;t like our images, you can replace them with our image uploader, which is built right into our application form. Oh, and our form requires no coding experience because this site is about posting, not coding.
			</p>
		</article>



		<article>
			<h2><a href="https://discord.gg/S3kk9YU" title="Please join us on Discord">DiscordApp rather then cBox</a></h2>

			<div class="paragraphs">
				<div class="row">
					<div class="span4">
						<a href="https://discord.gg/S3kk9YU" title="Please join us on Discord"><img style="float:left; margin-right: 20px;" src="./../_img/_icons/img_discordMascot.gif" alt="DiscordApp for Gamers" /></a>
						<p>
							Nope. Not at this time anyway, rather we use DISCORD, an all-in-one voice, video, and text chat application for gamers that's free, secure, and works on both your desktop/computer and phone/mobile device. It's simple and hassle free and fits our belief that gaming should be fun, not technical.
							<br /><br />
							If you'd like to join our behind the scenes chat on Discord, <a href="https://discord.gg/S3kk9YU" title="Please join us on Discord">click here and we'll say welcome and how yah doing</a>click here and we'll say welcome and how yah doing.
							<br /><br />
							<a href="https://support.discordapp.com/hc/en-us/articles/204229718-What-is-Discord-" title="learn about DiscordApp">Learn more about Discord and how to use it here.</a>
						</p>
					</div>
				</div>
			</div>
		</article>



		<article>
			<h2><a href="">Plot Overview</a></h2>
			<p>
				Marvel Champions is a re-imagining of the Marvel Cinematic Universe. Our goal is to draw inspiration and possibly events from the MCU without becoming slaves to the movies. We love the X-Men, and their movies, but those storylines are chock full of inconsistencies. Lord help the player trying to decide which Spiderman to go with. And, I suppose, Odin help the intrepid adventurer wanting to play Thor (male or female?) or Loki (teen or adult). And the Netflix and broadcast shows are great, though they again don&rsquo;t always conform to any sort of canon.
			</p>
			<p>
				The point is, there is room for all of these interpretations here. We can&rsquo;t have Agent Coulson seeking revenge for Loki&rsquo;s murder of Agent Coulson, clearly, but as long as we can maintain some sort of internal consistency, talk to us about your idea. We&rsquo;re reasonable people who only bite with cause.
			</p>
		</article>



		<article>
			<h2><a href="http://rpgrating.com"><img src="http://rpgrating.com/ratings/l3_s3_v3.gif" alt="Marvel Champions is rated L-3 | S-3 | V-3" /> &nbsp; Site Rating</a></h2>
			<p>
				Our site rating is 3/3/3 as detailed at <a href="http://rpgrating.com">RPGrating</a> for some sort of a standard. In short, that covers language, sex, and violence. Those are the highest ratings on the site, indicating few if any limitations in all three of those categories. As explained on that site, this rating doesn&rsquo;t necessarily mean that the rpg will be a free-for-all, but that mature themes can be expected in general. If that&rsquo;s something which is going to be an issue for you, please consider that before applying.
			</p>

		</article>


		<article>
			<h2><a href="">Posting Overview</a></h2>
			<p>
				Unlike many other sites, we ask YOU to register yourself to our site and only yourself. Then, when you wish to post, you can post as one of your characters directly from your general account without any need to switch characters. Once you you&rsquo;ve officially joined, you will make your first character, then after you&rsquo;ve completed 20 postings, you may make another. As you accrue characters, your minimum word counts for validated post counts will go up by 100 words per post. You can always post as you like, and there is no minimum or maximum, but only posts satisfying your mandatory word count will be counted (and they are counted automatically by our system – so you don&rsquo;t have to do any activity checks, we do that for you in the background). If you’re out of quota, you&rsquo;ll be notified and allowed a week to satisfy the minimum quota count. If you miss post checks routinely, you&rsquo;ll lose a character or two or three until you&rsquo;re eased into a position equal to the amount of time and participation you are comfortable with.
			</p>



		</article>
			<h2><a href="" />Rule Overview</a></h2>
			<p>
				While most things are handled consentually through story based posts, sometimes conflicts arise between handlers as to who&rsquo;s character is stronger, or smarter, or whatever-er. And sometimes the conflicts resolve themself with no need for anyone other then the handlers to talk, sometimes the monkee fieces hit the fan and thats not good. So we&rsquo;ve adopted a motified variation of TSR&rsquo;s Advanced Marvel Super-Heroes Gaming system. Basing our character conflict resolution loosely on Marvel Super-heroes FASERIP STATs system, the person with the highest stat chain (stats applicable to a contested feat or even) always wins, thus there isn&rsquo;t a need for a lot of outside moderation (hopefully). And as for activity, we expect a minimum two posts per character per week. Other than that, we hope you have fun, and that you&rsquo;ll be amazed by all the little hidden features we&rsquo;ve built into this site and our CMS, and will continue to add, so you can play and create and feel empowered while doing so instead of feeling overwhelmed or having to needless handcode the same mind numbing html or dohtml over and over and over and over and over again.
			</p>
			<p>
				We encourage you to read our extend rules section to better understand overbaring, stat-chains, FASERIP, and more. We&rsquo;ve tried to make them as brief and understandable as possible, and we are constantly revising and updating them to keep our listed rules in step with the membership of Marvel Champions.
			</p>

			<div class="btn-group  btn-group-sm btn-group-justified">
				<a href="rules.php#register" class="btn btn-primary">Register</a>
				<a href="rules.php#characters" class="btn btn-primary">Characters</a>
				<a href="rules.php#stats" class="btn btn-primary">STATs</a>
				<a href="rules.php#rating" class="btn btn-primary">rating</a>
				<a href="rules.php#posting" class="btn btn-primary">Post</a>
				<a href="rules.php#rules" class="btn btn-primary">Rules</a>
				<a href="rules.php#activity" class="btn btn-primary">Activity</a>
				<a href="faqs.php" class="btn btn-primary">FAQ</a>
			</div>
		</article>

		<article>
			<h2><a href="">Timeline Overview</a></h2>
			<p>
				This is a base/overview of how marvel champions envisions the cinematic universe with links to more extensive explanations, and whatever else we need.
			</p>
		</article>

		<article>
			<h2><a href="./../characters/profile.php">Characters Overview</a></h2>
			<p>
				Let&rsquo;s be honest the first thing most folks want to know about a site is if their favorite character(s) are available or if a certain playby (actor/celebrity/model/personality/sports figure) is available for casting, so we&rsquo;ve automated this too. You can go to our live character database and just type in the name, the playby, or the group you&rsquo;re interested in. You&rsquo;ll see if they&rsquo;re available/extant/taken/whatever. Further, you&rsquo;ll find links to <a href="./../characters/profile.php">all the characters, groups and playbys</a> for further explorations. When you first arrive at the page, you&rsquo;ll get a random assortment of characters, many available for adoption. If you reload the page, you&rsquo;ll get a new assortment from our database which has almost 400 characters in it and is still growing! You can also search for a chracter, a team or a playby just by entering the name of said entity. If it exists, you&rsquo;ll get it easy pleasey. If it doesn&rsquo;t exist you&rsquo;ll get all the possible search options we have available to help find what you need.
			</p>
			<p>
				And we plan to keep growing the features and functions our site offers so that you can just post and play and have fun!
			</p>
		</article>

	</div>
</div>


<?php

#END sidebar

#BEGIN main content
#echo threadRecent($sql, $sqlTags);

#has revised contact modal in it...
#echo get_footer('footerContact_inc.php');
echo get_footer();

##################   HELPER FUNCTION$   ##################


#Th-Th-Th-Th-Th-... That's all, folks.
