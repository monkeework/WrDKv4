<?php
function maxDoc_threads_start(){
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
include_once '../_inc/aarContent-inc.php'; #for stats


$userName=$privies='';

$config->metaDescription = 'Marvel Cinematic Universe Timeline (alternative)'; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Avengers, X-Men, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil, Young Avengers, Fantastic Four';


#For Threads-short
$sql = "SELECT ThreadID, CatID, PostID, ThreadFeaturing, ThreadType, ThreadTitle, ThreadNotes, ThreadSummary, ThreadTag, DatePostThread, DatePullThread, DateCreated, LastUpdated FROM ma_Threads;";


if (!isset($_SESSION['UserName'])){
	$_SESSION['UserName'] = "";
	$userName =  ' ';
}else{
	$userName =  ' ' . $_SESSION['UserName'];
}



//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;
get_header('headerJumbo-inc.php', 'bgRules00.jpg', 'Da\' Rulez');


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
			<h3 id="register">REGISTRATION</h3>

			<p>
				 Unlike other sites<? echo ' ' . $userName;?>, you only need to register once with Marvel Champions to play as many characters as you can comfortable handle. When registering, we will ask you for your name and your email address, your email WILL always be your login, it's that simple. And once your account is created, our automations will help guide you through your initial set up and help you to finding your way to your first character, and you&quot;ll only ever need one account to play all the characters you can handle, but more on  that later.
			</p>
			<p>
				Marvel Champions expects that you will create a user profile once you are ready to adopt a character for posting and site participation, if you want to be allowed to handle more then one character you'll need to complete your user profile. Your profile is only availalbe to our members and only when they are logged in. All of this is accessible from your <?php


				if ($userName !=''){
					echo '<a href="' . VIRTUAL_PATH . 'users/dashboard.php">your personalize dashboard ' . $_SESSION['UserName'] . '</a> ';
				}else{
					echo 'your personalize dashboard ';
				}

				?> which you can always get to just by clicking on your name in the upper right corner of any page on the site. Pretty snazzy huh?
			</p>
			<p>
				<a href="#" data-toggle="modal" data-target="#modalContact">Click here to join us!</a>
			</p>
		</article>

		<hr>
		<!-- characters -->
		<article>
			<h3 id="characters">CHARACTERS</h3>
			<p>
				While an advance roleplay if ever there was one, Marvel Champions is also welcoming to the new and unitiated because everyone has to start somewhere, so why not some place that will hopefully inspire you to your full potential? We believe that anyone can join an advanced RP if the membership (players and moderators alike) are willing to help one another, and everyone is willing to accept the help of everyone else. Our storylines waiver from site-wide moderator driven to character-driven with a minimum word count of 200 words per post plus one hunder words per additional character you are handling.  Original Characters (OCs) and Featured Characters (FCs) are welcome - and our applications which might look daunting are pretty easy because we've automated the process out of them. Example, you want to use Taylor Swift for you playby, just type her name and if we have images of here in our site assets, your character images will auto load for you. If you don't like our images, you can replace them with our image uploader which is built right into our application form. Oh, and our form requires no coding experience because this site is about posting, not coding.
			</p>
			<div class="btn-group btn-group-sm btn-group-justified">
				<a href="./../characters/index.php" class="btn btn-primary">Database</a>
				<a href="./../characters/index.php?act=ShowTaken" class="btn btn-primary">Characters</a>
				<a href="./../characters/index.php?act=ShowPlayby" class="btn btn-primary">Playbys</a>
				<a href="./../characters/index.php?act=ShowTeams" class="btn btn-primary">Teams</a>
				<a href="#" class="btn btn-primary">Groups</a>
				<a href="./faqs.php" class="btn btn-primary">FAQ</a>
			</div>
		</article>

		<hr>

		<!-- stats -->
		<article>
			<h3 id="stats">STATs (Character Statistics)</h3>
			<p>
				First and foremost, STATS are only used during a contested action, more on that later. We only mention this now so as to help you to keep this 'top of mind' as you read the following.
			<p>
			</p>
				What are STATs? A STAT is an value used in either to determine if a character is capable of doing something within gameplay, OR to resolve a contested conflict between two characters. In simple terms the character with the hightest Applicable STAT <B>WINS</B>. IN the event of a tie, the action is then judged by the next most appropriate STAT, so on and so forth until you have gone to the fourth STAT in your Stat Chain (Series of STATs used to settle a contested action between two characters). And be fore you ask why we use this, it is to help handlers to immediately settle character disuputes without the need to directly involve a moderator. The Stat Chain makes every very neat, cut, and dry. It even allows a character to "size up" another character, much like our heroes do in the comics, cartoons, and movies  we all so dearly love.
			</p>
			<p>
				In terms of rules and storyplay, characters are defined on <? echo SITE_NAME; ?> by their powers, abilities, merits, flaws, AND <i>Character Statistics</i>. This traits determin and summariza a characers chances of performing any contested action; See <a href="#" tooltip="Any opposed declared action opposed by character">Contested Actions</a> in terms of site play. There are three typs of traits: primary, secondary, and special abilities. Anything which is defined as an ability usually has an accompanying STAT which defines the magnitude of the secondary ability.
			</p>
			<p>
				The <i>primary abilities</i> of a character are divided into seven catagories: <a href="#fighting" tooltip="Any opposed declared action opposed by character">Fighting</a>, <a href="#fighting" tooltip="Any opposed declared action opposed by character">Agility</a>, <a href="#agility" tooltip="Any opposed declared action opposed by character">Fighting</a>, <a href="#strength" tooltip="Any opposed declared action opposed by character">Strength</a>, <a href="#endurance" tooltip="Any opposed declared action opposed by character">Endurance</a>, <a href="#reason" tooltip="Any opposed declared action opposed by character">Reason</a>, <a href="#intuition" tooltip="Any opposed declared action opposed by character">Intuition</a>, and <a href="#psyche" tooltip="Any opposed declared action opposed by character">Psyche</a>. These abilities are inherent to almost if not every character with in Marvel's Cinematic Universe &emdash; they are a measuring stick of how well a character can perform certain acts. Primary abilities are also called fisxed abilties because twhile they may be improved over time, they do not normally change from story to story. All Primary abilites have a rank and assigned numeric range.
			</p>
			<p>
				Secondary Abilties are Health, Karma, Resources, and Popularity, traits which we currently do not use within the boundries of our storyplay at this time, but might choose to incorporate at a later time. <!--  These are sometimes called variable abilities, as they may change withi the course of a single adventrue. All normal individials an most characters the handlers encounter have secondary abiltiies. Secondary abilies may be defined by ranks or separate numers. -->
			</p>
			<p>
				And finally, Special abilities are skills and ablities, Merits, and Flaws which are not common to all charactes, and indeed may beunique to a particular character. These special ablities usually have an associated STAT to them (Amazing, Incredible, so on and so forth) which may modify (positively, or negativley) a character&quot;'s chances at success.
			</p>
			<p>
				RANKS &amp; RANK NUMBERS: Abilties are often defined by a word (Amazing, Incredible, so on and so forth) know as the ability's rank. Each rank has an assumed numeric value (see each stats particular chart for details), which is used to dermine the effects such as Character Health, starting Karma, and potential damage with which a character can withstand or deliver. Each ability has a rank and rank number, but that number known as the associated value. The associated value falls within an assumed assocaited rank of a particular rank, again please see the table below for details and specifics. When a rank is not stated or know, it is assumed to be 'good'.
			</p>

			<h4>STAT RANKS DEFINED</h4>

<?php

	#array to initial and fill with stuff to pull from...
	#$stat=$chk=$str='';
#'RankStrength', '1'
function mk_StatMatch($trait='', $num='', $str =''){
		$sql = "SELECT CharID, UserID, CodeName, Classification, PowerSource, RankPower, RankFighting, RankAgility, RankStrength, RankEndurance, RankReason, RankIntuition, RankPsyche
		FROM ma_Characters
		WHERE UserID > 0";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results
			#External formatting here...

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$chk=$cName=$cID='';

				$chk = (int)$row[$trait];
				#if 1 == 1 make link
				if($num == $chk){
					#$chek = dbOut($row[$stat]);
					$cID   .= (int)$row['CharID'];
					$cName .= dbOut($row['CodeName']);

					$str .= ', <a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $cName . '&id=' . $cID . '&act=show">' . $cName . '</a>';
				}
			}
			#closing formating here...
		}
		#free result
		@mysqli_free_result($result); //free resources

		return $str;
	}

#Fighting table
function mk_StatFi(){ $str = '<h4>
		<a href="#fighting">FIGHTING: &mdash; <i>What is it?</i></a>
	</h4>
	<p>
		FIGHTING, or <i>&quot;What is it good for?!&quot;</i> Fighting ability reflects skill in armed and unarmed combat. It&quot;s a hero&quot;s ability to hit his opponent during a slugfest.
	</p>
	<ul>
		<li>A measure of raw combat ability and prowse</li>
		<li>Used to determine if your character lands a blow in a <em>contested action</em> or when <em>baring down</em> or <em>overbaring</em></li>
		<li>Used to determine if your character evades a blunt attack</li>
		<li>Used to dertmine success in a multiple combat attack or contested action involving hand-to-hand combat</li>
		<li>Used to determine the secondary ability known as health</li>
	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b> <br />(feeble)</td>
				<td>Untrained in combat, or unable to fight due to physical limiitations</td>
				<td>Examples:Madam Web'  .  mk_StatMatch('RankFighting', '1') . '</td>
			</tr>

			<tr>
				<td><b>Pr</b> <br /> (poor)</td>
				<td>Little Ability in combat, below normal aptitude</td>
				<td>Examples: Examples: Man-Thing, Polaris, Frog-Man, J.J. Jameson '  .  mk_StatMatch('RankFighting', '2') . '</td>
			</tr>
			<tr>
				<td><b>Ty</b> <br /> (typical)</td>
				<td>Standard human fighting ability without special talent or training</td>
				<td>Examples: Dazzler'  .  mk_StatMatch('RankFighting', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>Some formal training in combat, about police force level</td>
				<td>Examples:  Capt. Marvel, Dr. Strange, Scarlet Witch, Ariel, Rogue, Invisible Girl, Human Torch, Mr. Fantastic  '  .  mk_StatMatch('RankFighting', '4') . '</td>
			</tr>
			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>Training and experience in combat, includes active members of the armed forces</td>
				<td>Examples: Iron Man, Colossus, Storm, Nightcrawler, Nick Fury, Cyclops '  .  mk_StatMatch('RankFighting', '5') . '</td>
			</tr>
			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>Superior natural talent, in service as a combat specialist in the armed forces</td>
				<td>Examples: Spider-Man, Hulk, She-Hulk, Power Man ' . mk_StatMatch('RankFighting', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>Combines intelligence, experience, and ability, into a powerful package</b> Tons</td>
				<td>Examples: Thing, Wolverine, Daredevil, Iron Fist '  .  mk_StatMatch('RankFighting', '7') . '</td>
			</tr>
			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>The ultimate human fighting machine</td>
				<td>Examples: Capt, America, Black Panther, Punisher '  .  mk_StatMatch('RankFighting', '8') . '</td>
			</tr>
			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>Wielding superior powers unavailable to normal men</td>
				<td>Examples: Ord (25 tons), Artemis (30 tons), Attuma (40 tons), Apollo (50 tons) '  .  mk_StatMatch('RankFighting', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>Superior powers backed by long experience in combat</td>
				<td>Examples: Thor, Hercules '  .  mk_StatMatch('RankFighting', '10') . '</td>
			</tr>
			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>Ridiculously good; Can beat your dad up.</td>
				<td>Examples: '  .  mk_StatMatch('RankFighting', '11') . '</td>
			</tr>
			<tr>
				<td><b>S/X</b> <br /> (shift-y)</td>
				<td>Can beat your dad up with one arm tied behind his back</td>
				<td>Examples: '  .  mk_StatMatch('RankFighting', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>CCan beat your dad up blindfolded AND with both hands tied behind his back.</td>
				<td>Examples: '  .  mk_StatMatch('RankFighting', '13') . '</td>
			</tr>
			<tr>
				<td><b>BEYOND</b></td>
				<td>Can beat my dad up</td>
				<td>Examples: The Beyonder'  .  mk_StatMatch('RankFighting', '14') . '</td>
			</tr>
			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';
	return $str;
}

#Strength table
function mk_StatAg(){ $str = '<br /><br />
	<h3>
		<a href="#agility">AGILITY: &mdash; <i>What is it?</i></a>
	</h3>
	<p>
		AGILITY, or <i>&quot;U can&quot; Touch This!&quot;</i> Agility affects maneuverability, accuracy with thrown or fired weapons, the ability to dodge, and most other actions depending on coordination.
	</p>
	<ul>
		<li>A measure of dexterity and nimbleness</li>
		<li>Used to ddetermine if your character hits their target with a thrown or aimed weapon</li>
		<li>Used to determine if the your character catches an object, holds onto a ledge, or successfully performs actions that require quick action or coordination</li>
		<li>Used to determine how well your character handles a vehicle</li>
		<li>Used to determine the secondary abilty known as health</li>
	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b> <br /> (feeble)</td>
				<td>Physically limited, with little ability to maneuver or change direction</td>
				<td>Examples: Madam Web, Modok, Supremor'  .  mk_StatMatch('RankAgility', '1') . ' Children, the infirmed</td>
			</tr>

			<tr>
				<td><b>Pr</b> <br /> (poor)</td>
				<td>Maneuvers with difficulty; slow reaction time, easily hit, clumsy</td>
				<td>Examples: Aunt May, Hulk, Juggernaut, Professor Xavier'  .  mk_StatMatch('RankAgility', '2') . '</td>
			</tr>
			<tr>
				<td><b>Ty</b> <br /> (typical)</td>
				<td>Normal human reaction and accuracy</td>
				<td>Examples: J.J. Jameson, Scarlet Witch, Mr. Fantastic, Dazzler'  .  mk_StatMatch('RankAgility', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>Some training or natural ability</td>
				<td>Examples:  =Capt. Marvel, Power Man, Dr. Strange, Thing, Ariel  '  .  mk_StatMatch('RankAgility', '4') . '</td>
			</tr>
			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>Agility of an Olympic athlete, from experience or natural ability</td>
				<td>Examples: =Iron Man, She-Hulk, Thor, Cyclops, Rogue, Human Torch '  .  mk_StatMatch('RankAgility', '5') . '</td>
			</tr>
			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>High natural agility with training; can perform complex gymnastics</td>
				<td>Examples: =Spider-Man, Hulk, She-Hulk, Power Man ' . mk_StatMatch('RankAgility', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>Able to walk tightropes and dodge single bullets</td>
				<td>Examples: Capt. America, Daredevil '  .  mk_StatMatch('RankAgility', '7') . '</td>
			</tr>
			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>Superb sense of balance, able to dodge multiple bullets</td>
				<td>Examples: Spider-Man, Nightcrawler, Beast '  .  mk_StatMatch('RankAgility', '8') . '</td>
			</tr>
			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>Able to dodge automatic weapon fire with ease</td>
				<td>Examples: Cobra '  .  mk_StatMatch('RankAgility', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>Able to avoid lasers and other energy weapons with minimal effort</td>
				<td>Examples: Silver Surfer, Quicksilver '  .  mk_StatMatch('RankAgility', '10') . '</td>
			</tr>
			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>TBD</td>
				<td>Examples: Man-Killer (75 tons), Quicksand (80 tons), Ironclad (90 tons) '  .  mk_StatMatch('RankAgility', '11') . '</td>
			</tr>
			<tr>
				<td><b>S/X</b> <br /> (shift-y)</td>
				<td>TBD</td>
				<td>Examples: TBD '  .  mk_StatMatch('RankAgility', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>TBD</td>
				<td>Examples: TBD '  .  mk_StatMatch('RankAgility', '13') . '</td>
			</tr>
			<tr>
				<td><b>BEYOND</b></td>
				<td>Untouchable.</td>
				<td>Examples: Beyonder '  .  mk_StatMatch('RankAgility', '14') . '</td>
			</tr>
			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';
	return $str;
}

#Strength table
function mk_StatSt(){ $str = '<br /><br />
	<h3>
		<a href="#strength">STRENGTH: &mdash; <i>What is it?</i></a>
	</h3>
	<p>
		STRENGTH, or <i>&quot;OMG Where&quot;d you get Dem Musckles?&quot;</i> You go ahead, me, i&quot;ll catch an Uber. Endurance reflects the ability to survive in hostile environments, and to regain lost health. It is also the hero’s ability to work without resting.Endurance reflects the ability to survive in hostile environments, and to regain lost health. It is also the hero’s ability to work without resting.
	</p>
	<ul>
		<li>A measure of phusical muscular power</li>
		<li>Used to dermine damage inflicted in slugfest combats</li>
		<li>Used to derermine success and damage in wrestling combat and success in Grabbing, Escaping, and Blocking maneuvers.</li>
		<li>Used to determine success in destroying materials</li>
		<li>Used to dermine if a chracter can lift a particular object or perform other actos of strength that requiare a physical power</li>
		<li>Used to dertmine the secondary ability know as Health</li>
	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b> <br /> (feeble)</td>
				<td>0-10 lbs</td>
				<td>Examples:Madam Web'  .  mk_StatMatch('RankStrength', '1') . ' Children, the infirmed</td>
			</tr>

			<tr>
				<td><b>Pr</b> <br /> (poor)</td>
				<td>11-50 lbs</td>
				<td>Examples: Aunt May, Professor Xavier'  .  mk_StatMatch('RankStrength', '2') . ' Below normal. The guy in the Charles Atlas ads who gets sand kicked on them at the beach</td>
			</tr>

			<tr>
				<td><b>Ty</b> <br /> (typical)</td>
				<td>51-125 lbs</td>
				<td>Examples: J. J. Jameson, Dr. Strange, Dazzler, Invisible Girl, Nightcrawler, Storm, Mr. Fantastic'  .  mk_StatMatch('RankStrength', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>125 lbs - 299 lbs</td>
				<td>Examples:  Cyclops, Gambit,  '  .  mk_StatMatch('RankStrength', '4') . '</td>
			</tr>

			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>300 - 500 lbs</td>
				<td>Examples: Nightcrawler (300 lbs), Daredevil (450 lbs), Batroc (500 lbs) '  .  mk_StatMatch('RankStrength', '5') . '</td>
			</tr>

			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>800 lbs - 1.5 Tons</td>
				<td>Examples: Punisher (550 lbs), Kingpin (650 lbs), Iron Fist (750 lbs), Black Cat (800 lbs) ' . mk_StatMatch('RankStrength', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>1.5 - 5</b> Tons</td>
				<td>Examples: Destroyer (1000 lbs), Nighthawk (1-2 tons), Deathcry (2 tons), Grim Hunter (3 tons), Dracula (4 tons), Jackpot (5 tons) '  .  mk_StatMatch('RankStrength', '7') . '</td>
			</tr>

			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>10 - 25 Tons</td>
				<td>Examples: Omega Red (10 tons), Cardiac (15 tons), Ch’od (20 tons), Man-Beast (25 tons) '  .  mk_StatMatch('RankStrength', '8') . '</td>
			</tr>

			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>25 - 50 Tons</td>
				<td>Examples: Ord (25 tons), Artemis (30 tons), Attuma (40 tons), Apollo (50 tons) '  .  mk_StatMatch('RankStrength', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>50 - 75 Tons</td>
				<td>Examples: Balder (50 tons), Thundra (60 tons), Doc Samson (70 tons), Magdalene (75 tons) '  .  mk_StatMatch('RankStrength', '10') . '</td>
			</tr>

			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>75 - 90 tons</td>
				<td>Examples: Man-Killer (75 tons), Quicksand (80 tons), Ironclad (90 tons) '  .  mk_StatMatch('RankStrength', '11') . '</td>
			</tr>

			<tr>
				<td><b>S/X</b> <br /> (shift-y)</td>
				<td>90+ Tons</td>
				<td>Examples: Lionheart (90 tons), Collossas (100 tons), Anti-Venom (110+ tons) '  .  mk_StatMatch('RankStrength', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>300+ Tons</td>
				<td>Examples: Abomination (200+ Tons) Hulk (235+ Tons) '  .  mk_StatMatch('RankStrength', '13') . '</td>
			</tr>

			<tr>
				<td><b>BEYOND</b></td>
				<td>500+ Tons</td>
				<td>Examples: Galactus (503+ Tons) '  .  mk_StatMatch('RankStrength', '14') . '</td>
			</tr>

			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';

return $str;
}

#Strength table
function mk_StatEnd(){ $str = '<br /><br /><h3>
		<a href="#endurance">ENDURANCE: &mdash; <i>What is it?</i></a>
	</h3>
	<p>
		ENDURANCE, or, <i>&quot;Uhm Ok, Sure. You go ahead, me, i&quot;ll catch an Uber.&quot;</i> Endurance reflects the ability to survive in hostile environments, and to regain lost health. It is also the hero’s ability to work without resting.Endurance reflects the ability to survive in hostile environments, and to regain lost health. It is also the hero’s ability to work without resting.
	</p>

	<ul>
		<li>A measure of persoanl toughness and physical resistance</li>
		<li>Used to determine hormal moving speed</li>
		<li>Used to determine success in contested charging attacks</li>
		<li>Used to determine success in avoiding the effects of disease, poison, and gas</li>
		<li>Used to determine success in contested actions that rewuire your character to perform actions over a long period oftime, such as holding one\'s breath</li>
		<li>Used to determine the secondary abilty known as health</li>
		<li>Used to resist the efect of slams, stuns, and other lethal actions directed against your character</li>
		<li>Used to determine the amount of heal regained by your character</li>

	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b>
				<br /> (feeble)</td>
				<td>Stay out of drafts. Rest after a minute of light work</td>
				<td>Examples: Aunt May, Madam Web'  .  mk_StatMatch('RankEndurance', '1') . ' Children, the infirmed</td>
			</tr>

			<tr>
				<td><b>Pr</b>
				<br /> (poor)</td>
				<td>Easily winded. Rest after several minutes of light work</td>
				<td>Examples: Franklin Richards, Alicia Masters, The Leader'  .  mk_StatMatch('RankEndurance', '2') . ' Below normal. The guy in the Charles Atlas ads who gets sand kicked on them at the beach</td>
			</tr>

			<tr>
				<td><b>Ty</b>
				<br /> (typical)</td>
				<td>Able to tolerate moderate hot and cold temperatures. Rest after several minutes of moderate work</td>
				<td>Examples: J.J. Jameson, Frog-Man'  .  mk_StatMatch('RankEndurance', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>Can function well in environments with moderate climates. Rest required after several minutes of intense work</td>
				<td>Examples: Rogue, Dazzler, Ariel, Professor X'  .  mk_StatMatch('RankEndurance', '4') . '</td>
			</tr>
			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>Can function exceedingly well in environments with slightly harsher climates. Rest required after an hour of intense work</td>
				<td>Examples: Beast, Daredevil, Invisible Girl, Human Torch, Mr. Fantastic'  .  mk_StatMatch('RankEndurance', '5') . '</td>
			</tr>

			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>Can function with very little impairment in environment with very harsh climates. No need for rest except normal sleep</td>
				<td>Examples: Capt. America, Capt. Marvel, Dr. Strange, Nightcrawler, wolverine, Colossus, Cyclops' . mk_StatMatch('RankEndurance', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>Can function with no impairment in environments with very harsh climates. No need for ret except normal sleep</b> Tons</td>
				<td>EExamples: Spider-Man'  .  mk_StatMatch('RankEndurance', '7') . '</td>
			</tr>

			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>Can function with no impairment in the harshest of climates as long as oxygen, water or food is present.  </td>
				<td>Examples: She-Hulk, Power Man, Storm'  .  mk_StatMatch('RankEndurance', '8') . '</td>
			</tr>

			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>Can survive for short times in a vacuum. Normal sleep is still required</td>
				<td>Examples: thing, Wonder Man, Iron Man, Hulk'  .  mk_StatMatch('RankEndurance', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>Can survive unprotected in space for long periods of time. No sleep needed</td>
				<td>Examples: Silver Surfer, Thor, Vision'  .  mk_StatMatch('RankEndurance', '10') . '</td>
			</tr>

			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>Can survive unprotected in space forever. No sleep needed</td>
				<td>Examples: TBD '  .  mk_StatMatch('RankEndurance', '11') . '</td>
			</tr>

			<tr>
				<td><b>S/X</b>
				<br /> (shift-y)</td>
				<td>Can survive unprotected in a star for long periods of time. No sleep needed</td>
				<td>Examples: TBD '  .  mk_StatMatch('RankEndurance', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>Can survive unprotected indefinately within the heart of a star. No sleep needed</td>
				<td>Examples: TBD '  .  mk_StatMatch('RankEndurance', '13') . '</td>
			</tr>
			<tr>
				<td><b>BEYOND</b></td>
				<td>Can survive unprotected in indefinately within a black hole; Can function in any environment regardless of food, water, or oxygen. Can function in space for an indefinite amount of time.
No sleep needed.
				</td>

				<td>Examples: TBD '  .  mk_StatMatch('RankEndurance', '14') . '</td>
			</tr>
			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';

return $str;
}

#Strength Reason
function mk_StatRe(){ $str = '<br /><br /><h3>
		<a href="#reason">REASON &mdash; <i>What is it?</i></a>
	</h3>
	<p>
		REASON, or, <i>&quot;I got me some of them thar college book learnin\' smarts I do.&quot;</i>. Reason is a general term for intelligence, education, and all logical processes. Heroes can use reason to identify the functions of alien artifacts and to invent new devices of their own.
	</p>
	<ul>
		<li>A measure of intelligence and the capacit for logical thought</li>
		<li>Used to determine the character\'s success in building things</li>
		<li>Used to determine the character\'s success in understanding unknown technology and languages</li>
		<li>Used to determine the secondary ability know as karma</li>
	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b>
				<br /> (feeble)</td>
				<td>Barely there; has trouble with doors</td>
				<td>Examples: Children, the infirmed, Living Mummy, Man-Thing'  .  mk_StatMatch('RankReason', '1') . ' </td>
			</tr>

			<tr>
				<td><b>Pr</b>
				<br /> (poor)</td>
				<td>Barely there; has trouble with doors</td>
				<td>Examples: Dazzler'  .  mk_StatMatch('RankReason', '2') . '</td>
			</tr>

			<tr>
				<td><b>Ty</b>
				<br /> (typical)</td>
				<td>Normal human level</td>
				<td>Examples: J.J. Jameson, Wolverine, Capt. Marvel, Storm, Thor, Colossus, Daredevil, She-Hulk'  .  mk_StatMatch('RankReason', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>Understands modern technology; can attempt repairs on moderately complex items (such as cars)</td>
				<td>Examples: Capt. America, Dr. Strange, Iron Fist, Human Torch, Power Man, Thing'  .  mk_StatMatch('RankReason', '4') . '</td>
			</tr>
			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>Can perform small experiments, invent or jury-rig equipment, run complex machinery</td>
				<td>Examples: Spider-Man, Nick Fury, Cyclops'  .  mk_StatMatch('RankReason', '5') . '</td>
			</tr>

			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>Can operate advanced or alien equipment; can invent and build lasting equipment</td>
				<td>Examples: Bruce Banner, Sasquatch, Ariel/Shadowcat' . mk_StatMatch('RankReason', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>Can repair advanced or alien technology; capable of making significant improvements on normal science</td>
				<td>Examples: Professor X, Magneto, Tony Stark'  .  mk_StatMatch('RankReason', '7') . '</td>
			</tr>

			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>Develops ideas beyond the realm or normal science; can modify and improve alien technology</td>
				<td>Examples: Mr. Fantastic, Dr. Doom, Starhawk, Leader, Ultron'  .  mk_StatMatch('RankReason', '8') . '</td>
			</tr>

			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>Full recall; though far beyond the realm of humans; can create artificial life</td>
				<td>Examples: Stranger, High Evolutionary'  .  mk_StatMatch('RankReason', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>Near omnipotence</td>
				<td>Examples: The Watcher, Immortus'  .  mk_StatMatch('RankReason', '10') . '</td>
			</tr>

			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>Desc</td>
				<td>TBD'  .  mk_StatMatch('RankReason', '11') . '</td>
			</tr>

			<tr>
				<td><b>S/X</b>
				<br /> (shift-y)</td>
				<td>TBD</td>
				<td>Ex  '  .  mk_StatMatch('RankReason', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>TBD</td>
				<td>TBD'  .  mk_StatMatch('RankReason', '13') . '</td>
			</tr>
			<tr>
				<td><b>BEYOND</b></td>
				<td>Not only sees all knows all, but already has ang they got tee shirt to prove it.</td>
				<td>Examples: The Beyonder'  .  mk_StatMatch('RankReason', '14') . '</td>
			</tr>
			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';

return $str;
}

#Strength Intuition
function mk_StatInt(){ $str = '<br /><br /><h3>
		<a href="#psyche">INTUITION &mdash; <i>What is it?</i></a>
	</h3>
	<p>
		INTUITION, or, <i>&quot;There is a voice that doesn&quot;t use words, use it!&quot;</i>. Intuition relies upon a hero’s observation and senses to complement reason. It also affects a hero’s chance of being surprised.
	</p>
	<ul>
		<li>A measure of wisdom, wits, common sense, and battle reflexes</li>
		<li>Used to discover clues</li>
		<li>Used to determine first action in a contested combat</li>
		<li>Used to detect hidden or potentailly dangerous items, as well as in situations where your character plays a hunch</li>
		<li>Used to resist emotion-based attacks</li>
		<li>Used to determine the secondary ability know as karma</li>
	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b>
				<br /> (feeble)</td>
				<td>Not aware of its environment unless harmed</td>
				<td>Examples: Children, Living Mummy, Man-Thing, the infirmed or comatose'  .  mk_StatMatch('RankIntuition', '1') . ' </td>
			</tr>

			<tr>
				<td><b>Pr</b>
				<br /> (poor)</td>
				<td>Thick as a brick</td>
				<td>Examples: Most henchmen and sometimes your teammates'  .  mk_StatMatch('RankIntuition', '2') . '</td>
			</tr>

			<tr>
				<td><b>Ty</b>
				<br /> (typical)</td>
				<td>Normal human level of intuition and observation</td>
				<td>Examples: J.J. Jameson, Dazzler, Colossus, Hulk'  .  mk_StatMatch('RankIntuition', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>Sharper than average</td>
				<td>Examples: Thing, Capt. Marvel, Ariel, Invisible Girl, Thor, Rogue, Human Torch'  .  mk_StatMatch('RankIntuition', '4') . '</td>
			</tr>
			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>In the business of noticing things; has an eye for detail and odd circumstance</td>
				<td>Examples: Power Man, Nick Fury, Iron Man, Storm, Nightcrawler'  .  mk_StatMatch('RankIntuition', '5') . '</td>
			</tr>

			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>Detective; notices what others may miss</td>
				<td>Examples: Moon Knight, Cyclops' . mk_StatMatch('RankIntuition', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>Fine eye for detail and schedules; notices when something “feels wrong”</td>
				<td>Examples: Capt. America, Black Widow, Iron Fist'  .  mk_StatMatch('RankIntuition', '7') . '</td>
			</tr>

			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>In tune with him/herself and the general area; hard to surprise</td>
				<td>Examples: Spider-Man, Shaman, Professor X'  .  mk_StatMatch('RankIntuition', '8') . '</td>
			</tr>

			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>Notices things no normal person can; senses emotions</td>
				<td>Examples: Daredevil, Dr. Strange, Silver Surfer, Wolverine'  .  mk_StatMatch('RankIntuition', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>Plugged directly into the cosmos; one with the universe</td>
				<td>Examples: Watcher, Starhawk'  .  mk_StatMatch('RankIntuition', '10') . '</td>
			</tr>

			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>Desc</td>
				<td>Example: TBD'  .  mk_StatMatch('RankIntuition', '11') . '</td>
			</tr>

			<tr>
				<td><b>S/X</b>
				<br /> (shift-y)</td>
				<td>Kenneth, they know the frequency</td>
				<td>Example: TBD'  .  mk_StatMatch('RankIntuition', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>Can fathom the unfathomable; Understands everythign Moonunit Zappa said in the eighties.</td>
				<td>Example: TBD'  .  mk_StatMatch('RankIntuition', '13') . '</td>
			</tr>
			<tr>
				<td><b>BEYOND</b></td>
				<td>Not only sees all knows all, but already has ang they got tee shirt to prove it.</td>
				<td>Examples: The Beyonder'  .  mk_StatMatch('RankIntuition', '14') . '</td>
			</tr>
			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';

return $str;
}

#Strength Psyche
function mk_StatPs(){ $str = '<br /><br />
	<h3>
		<a href="#psyche">PSYCHE &mdash; <i>What is it?</i></a>
	</h3>
	<p>
		PSYCHE, or, <i>&quot;They don&quot;t know that we know they know we know&quot;</i>. Psyche reflects willpower and inner strength. It is the “soul” of the hero, and the source of magical ability. High psyche does not grant magical power automatically, but it does make a hero more resistant to magic.
	</p>
	<ul>
		<li>A measure of mental strength, willpower, and where withall</li>
		<li>Used to show resistance to mental and will-dominating attacks</li>
		<li>Used to determine resistance to magical-based contested actions</li>
		<li>Used to determine intial magical abilites for thos character who wield magic</li>
		<li>Used to determine the secondary ability know as karma</li>
	</ul>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>RANK NAME</th>
				<th>RANK</th>
				<th>RANK EXAMPLES</th>
			</tr>
		</thead>
		<tbody>

			<tr>
				<td><b>Fe</b>
				<br /> (feeble)</td>
				<td>Easily controlled by magical, mental, or infomercial means</td>
				<td>EXAMPLE: AIM/HYDRA henchmen, Children, Man-Thing, the infirmed'  .  mk_StatMatch('RankPsyche', '1') . ' </td>
			</tr>

			<tr>
				<td><b>Pr</b>
				<br /> (poor)</td>
				<td>Young or untrained normal humans</td>
				<td>Examples: Rogue, New Mutants'  .  mk_StatMatch('RankPsyche', '2') . '</td>
			</tr>

			<tr>
				<td><b>Ty</b>
				<br /> (typical)</td>
				<td>Normal human; can be controlled by superior entity</td>
				<td>Examples: J.J. Jameson, Ariel, Iron Man, Capt. Marvel, Human Torch, Dazzler, Power Man'  .  mk_StatMatch('RankPsyche', '3') . '</td>
			</tr>

			<tr>
				<td><b>Gd</b> <br /> (good)</td>
				<td>Some training in mind control, or experience with mind control</td>
				<td>Examples: Capt. America, Invisible Girl, Daredevil'  .  mk_StatMatch('RankPsyche', '4') . '</td>
			</tr>
			<tr>
				<td><b>Ex</b> <br /> (excellent)</td>
				<td>Trained to defend against mind control or familiar with magical wards</td>
				<td>Ex'  .  mk_StatMatch('RankPsyche', '5') . '</td>
			</tr>

			<tr>
				<td><b>Rm</b> <br /> (remarkable)</td>
				<td>Hard to control except by magical or high-tech means</td>
				<td>Examples: Nightcrawler, Storm, Colossus' . mk_StatMatch('RankPsyche', '6') . '</td>
			</tr>

			<tr>
				<td><b>In</b> <br /> (incredible)</td>
				<td>Great strength of will; experience with magical foes</td>
				<td>Examples: Spider- Man, Shaman, Wolverine'  .  mk_StatMatch('RankPsyche', '7') . '</td>
			</tr>

			<tr>
				<td><b>Am</b> <br /> (amazing)</td>
				<td>Indomitable will; experience with magical and/or mental control</td>
				<td>Examples: Moondragon, Dr. Doom, Thor, Iron Fist'  .  mk_StatMatch('RankPsyche', '8') . '</td>
			</tr>

			<tr>
				<td><b>Mn</b> <br /> (monsterous)</td>
				<td>Pinnacle of mental control; resistant to all but the most powerful magics</td>
				<td>Examples: Professor X, Loki, Snowbird'  .  mk_StatMatch('RankPsyche', '9') . '</td>
			</tr>

			<tr>
				<td><b>Un</b> <br /> (unearthly)</td>
				<td>Highest level of magical control possible to mortals; invulnerable to mental attack</td>
				<td>Examples: Dr. Strange, Immortus'  .  mk_StatMatch('RankPsyche', '10') . '</td>
			</tr>

			<tr>
				<td><b>S/x</b> <br /> (shift-x)</td>
				<td>TBD</td>
				<td>Examples: TBD'  .  mk_StatMatch('RankPsyche', '11') . '</td>
			</tr>

			<tr>
				<td><b>S/X</b>
				<br /> (shift-y)</td>
				<td>TBD</td>
				<td>Examples: TBD'  .  mk_StatMatch('RankPsyche', '12') . '</td>
			</tr>

			<tr>
				<td><b>S/z</b> <br /> (Shift-z)</td>
				<td>TBD</td>
				<td>Examples: TBD'  .  mk_StatMatch('RankPsyche', '13') . '</td>
			</tr>
			<tr>
				<td><b>BEYOND</b></td>
				<td>Not only sees all knows all, but already has ang they got you the tee shirt and mailed it to you last Thursday.</td>
				<td>Examples: The Beyonder'  .  mk_StatMatch('RankPsyche', '14') . '</td>
			</tr>
			<tr>
				<td><b>Ms</b> <br /> (Mary-Sue go home)</td>
				<td>Ridiculous squared</td>
				<td>Seriously, whats beyond Beyond? C&quot;mon folks, we&quot;re not DC.</td>
			</tr>
		</tbody>
	</table>';

return $str;
}




echo mk_StatFi();

echo mk_StatAg();

echo mk_StatSt();

echo mk_StatEnd();

echo mk_StatRe();

echo mk_StatInt();

echo mk_StatPs();
?>





		</article>

		<hr>

		<article>
			<h3 id="stats">STATs (Character Statistics)</h3>
			<div class="btn-group btn-group-sm btn-group-justified">
				<a href="./../characters/index.php" class="btn btn-primary">Database</a>
				<a href="./../characters/index.php?act=ShowTaken" class="btn btn-primary">Characters</a>
				<a href="./../characters/index.php?act=ShowPlayby" class="btn btn-primary">Playbys</a>
				<a href="./../characters/index.php?act=ShowTeams" class="btn btn-primary">Teams</a>
				<a href="#" class="btn btn-primary">Groups</a>
				<a href="./faqs.php" class="btn btn-primary">FAQ</a>
			</div>
		</article>

		<hr>

		<!-- Character Creation -->
		<article>
			<h4 id="characters">CHARACTER CREATION &AMP; ADOPTION</h4>
			<p>
				We don't believe in wasting effort. Nope. We just don't beleive in it. And to that end we have already developed a large collection of resources to help you create OR adopt a character. If you see a character is marked as available for adoption on our site, that means that we have already done some prelimimary work for you, ranging from very little, sometimes to a very extensive write up which we are happy to hand over to you to polish up and finish up as you like so long as it mets spec. (We actually have over 600 character profiles). Additonally we've built a lot of tools to help you make characters quickly, below you will find links to just a few of the tools we make available to our members because making a character should be more painful then pulling teeth (unless your into that kind of thing and if you are why are you here instead of some S&AMP;M Dentist site?)
			</p>
			<p>
				<em>Please note that we are still working on these asset libraries, Some are quite extensive like the powers library, others are very meager at this writing like the resources asset library. But we are continueally expanding and updating them on a weekly basis, that we promise.</em>
			</p>
			<div class="btn-group btn-group-sm btn-group-justified">
				<a href="./char_aptitudes.php" class="btn btn-primary">Aptitudes</a>
				<a href="./char_equipment.php" class="btn btn-primary">Equipment</a>
				<a href="./char_disadvantages.php" class="btn btn-primary">Flaws</a>
				<a href="./char_advantages.php" class="btn btn-primary">Merits</a>
				<a href="./char_powers.php" class="btn btn-primary">Powers</a>
				<a href="./char_resources.php" class="btn btn-primary">Resources</a>
				<a href="./faqs.php" class="btn btn-primary">FAQ</a>
			</div>

			<p>
				<br /><small>* A note to the purists among you. We take no &quot; specific stance&quote regarding what is or is not Plagerism. The reason for this is simple, if you\'re running a site which features a character that does not belong to you, lets say Iron Man, then you're committing plagerism and unlawful use of intellectual copyrighted materials. It's pretty cut and dry; We make no claims to ownership of anything which appears on this site other then the technologies we have developed, and those are safeguarded under the <a href="http://opensource.org/licenses/osl-3.0.php">Open Software License ("OSL") v. 3.0</a>.

				<br /><br />

				While we hope all member provided content is original, or is as original as is possible given the framework of general probability, we do not concern ourselves with where our members pull their content from, we only concern ourselves that the content pulled and provided is correct to the character. Should anyone object to any content found on our site, please notify us if it is contestible; Only complaints provied by the legal copyright holder will be responded to. Or, to put it another way, if you are not Disney, a whole owned subsidiary of Disney (i.e. Marvel Entertainment or Marvel Studios), we aren't going to participate in where content came from given the parameters of the internet and it's original intention that all information is free and meant to be shared.

				<br /><br />

				So, if you see something and feel it belongs to you, ask yourself, did you put it on the internet? If you did, you shared it regarless of how much you said you copyrighted it - you can't copyright a work of fiction uses in part or parcel, the work of anothers -- i.e. if your fanfict has Captain Marvel Man it and you don't own Captain Marvel Man, then whoever owns Captain Marvel Man owns your fanfict. That's how the legal system works around issues of plagerism, trademark, and copyright law.

<!--
					 isn\'t just the copying of someone else&quot;s words, it&quot;s the unlawful appropriation of a copyrighted work. So what does that mean? That means that if you write the most amazing profile for Spider-Man and somene else lifts it word for word, the only person who has been plagerised is Marvel Entertainment, LTD. So unless your the actual copyright holder of the original source point (the character in question), please don't bother us.  We don&quot;t care where our handlers get their material from, we care that it is factual and to spec. To quot Bono Vox, &quot;every artist is a thief, every poet a cannibal&quot;. So to the ameteurs out there who never got published and want to complain because anything on this site resembles something they did or think they did or think someone else did, please, draw yourself a bath, light some aromatheraphy candles, dim the lights, get in that warm tub of water and go fuck yourselves ever so gently with a chainsaw and I will get back to you with a bandaid for your pathetic ego when I have the time. If you aren&quot; are&quot;t a member of this site, i don&quot; don&quot; really care what you think or have to say. My sole consern and consideration is to the membership. Period.
-->
				- <i>The Architect</i>.</small>
			</p>
		</article>

		<hr>

		<!-- Story setting -->
		<article>
			<h3 id="story">STORY SETTING</h3>
			<p>
				Marvel-Champions, the world is in a bad spot right now and it needs champions, Marvel Champions. Join us, help save the world and have some fun with your unstructured free time! The world is based on the Marvel Cinematic Universe, and while their are currenlty no mutants, there does seem to be something odd in the winds lately.
			</p>
		</article>

		<hr>

		<!-- posts -->
		<article>
			<h3 id="posts">POSTING</h3>
			<p>
				While we aspire to be an advanced level writing site in both quality of posts and activity, everyone, including us had to start somewhere.  What this means is that, you are expected to post a minimum of two (2) in-character (IC) post each and every week of a minimum length of 200 words + one hundred words for each additional character you are handling. The only exception to this rule is if you or your character is on an approved haitus. Our site will automatically track your posts, and note when you fall out of expected minimums and alert you to this. Our site also tracks your posting history over 120 day period so we can tell if you're averaging accordly or not. Our site will also alert you automatically when you are in danger of falling below expectations with an email alert.
			</p>
			<p>
				While you are free to write a post which is ten words, oen hundred words, even ten thousand million words (please, please don't do that. Thats just impossible to reply to), for a post to be counted toward your counted minum post quota, you need to write at least two posts, plus one post per additional character you have. And the word count for each of these posts goes up by 100 words. So if you have five characters, your expected that each character will have 5 posts, each post being 500 words in length to satisfy posting expectations. Additionally, counted posts should be broken into a few paragraphs at the bare minimum - no one wants to read one big ugly block of bulk text (Yuck!). Further, you are expected to reflect that which has been previously posted in any thread you post in and your post should help progress the thread. Remember when posting, give folks something they can reply too. When your about to submit your post, proof it not just for content and grammar, but also for responsiveness - could you reply to it?
			</p>
			<p>
				We do, however, follow the rule of reciprocation. This means that you should give back what you receive. So, if someone spent some time constructing a nice post, writing a 1,000 words, try not to reply with only one paragraph with no dialogue; Yes we know there are times when the perfect reply is 'Huh'. But if so, describe that 'huh' in all it's annoying pissy glorious detail! If your gonna be a jerk, write about it!
			</p>
			<p>
				Now this can be a problem for opening new threads. The best solution is to aim for at least 400-600 words. This will meet that criteria of giving your partner enough to work with and progressing the story. Then, as you and your partner get comfortable in writing with each other, you can adjust the length of what you provide them.
			</p>
		</article>

		<hr>

		<!-- rating -->
		<article>
			<h3 id="rating">SITE RATING &nbsp; &nbsp; <a href="http://rpgrating.com"><img src="http://rpgrating.com/ratings/l3_s3_v3.gif" /></a></h3>
			<p>
				Marvel Champions is <strong>Rated M for Mature</strong>. This site is designed for individuals 18 and older. We anticipate that there will be violent content, cussing, and even sexual situations. However, everyone has their right to decide to what level they wish to take things in the story (and folks are always welcome to make use of the fade-to-black option if things get to uncomfortable for them). You can set your comfort level on your membership page as well as your any character your handling if it differs (otherwise, it's automatically set for you.) Your waiver lets others know  how comfortable you are and members are expected to take this into account when posting. However, if no player who enjoys G only storylines should join a pg-13 rated post and expect that everyone is going to adjust accordingly.
			</p>
			<p>
				Note, threads will always automatically reflect the highest rating based on all of the post contained with in. This gives any lurking readers an idea of what they can expect in order to avoiding reading anything that they are not comfortable with.
			</p>

		</article>

		<hr>

		<!-- rules -->
		<article>
			<h3 id="rules">RULE OVERVIEW</a></h3>
			<p>
				One of the things which makes Marvel Champions unique is our use of character STATS based on the FASERIP system <em>which</em> we have modified to work in a posting context. We beleive that the person with the highest STAT always wins when involved witin a contested posting situation. Why? Because then no one needs a moderator to come in to resolve things. You can simply look at the STAT chain and see who wins and play things out accordingly.
			</p>
			<p>
				We encourage you to read our rules, we've tried to make them as brief and understandable as possible and are constantly revising and updating them to keep our listed rules in step with the membership of Marvel Champions.
			</p>

			<p><em>We are still writing these up, please bare with us... thank you.</em></p>

			<div class="btn-group btn-group-sm btn-group-justified">
				<a href="#" class="btn btn-primary">Combat</a>
				<a href="#" class="btn btn-primary">Stat Chains</a>
				<a href="#" class="btn btn-primary">Overbaring</a>
				<a href="#" class="btn btn-primary">Autoing</a>
				<a href="./faqs.php" class="btn btn-primary">FAQ</a>
			</div>
		</article>

		<hr>

		<!-- Timeline -->
		<article>
			<h3 id="timeline">Timeline Overview</a></h3>
			<p>
				This is a base/overview of how marvel champions envisions the cinematic universe with links to more extensive explanations, and whatever else we need.
			</p>
			<p>
				<a href="./timeline.php">Check Out The Site Time Line!</a>
			</p>
		</article>

	</div>
</div>


<?php

#END sidebar

#BEGIN main content
#echo threadRecent($sql, $sqlTags);

echo get_footer();

##################   HELPER FUNCTION$   ##################





#Th-Th-Th-Th-Th-... That's all, folks.
