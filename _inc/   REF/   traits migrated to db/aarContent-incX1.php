<?php #Possessive

#$cName = $cGender = $cGenderPossessive = $CodeName = '';

#echo '<h1>wackka wakkawackka wakkawackka wakkawackka wakkawackka wakkawackka wakka</h1>'; #prove we are including file

#Move into DB once we have the ability to create editable text areas
$aarContent = [
	#CHARACTERS - INDEX
		"AccessVisitor" => '<div class="">
		<h3 class="">Unauthorized user recognized, file access limited.</h3>
		<p><strong>Access Level 0 </strong></p>
		<p>(If Unregistered/unlogged in user)Welcome to Cerebra, a digital assistant used in the creation of, storing and archiving of locations, profiles and vital information which those allied with the X-Men might need at any given moment regarding many of the world\'s known mutants, super-powered inhabitant\'s and even alien species. Records are editable only by those with administrator access, but are accessible by those with a security clearance of 3 or higher for the purpose of research and training. Records may only be entered by someone with administrative level access. You have base administrative privileges to all Cerebra Database entries.</p>
		<p>To search Cerebra for a character or a location, choose from the appropriate categories and/or enter a keyword using the form at the top of the page. </p>
	</div>',

	"AccessMember" => '<div class="">
			<h3 align="center">Authorized user recognized, file access granted.</h3>
			<p><strong>Access Level 2 </strong></p>
			<p>I am Friday, you\'re personal digital assistant for as long as you are active on this site. I exist to help facilitiate the purposes of character research, development, and curation of vitial character statistics here at Marvel Adventures. the creation, storing and archiving of vital information which is currated by the Xaiver Institute for the Gifted. The information is often detailed and contains a wealth of data and is easily searchable. Here, you have access to various levels of detailed character profiles of many of the most noteable beings and super-powered inhabitant\'s across the globe. In addition, the database also contains detailed information on various locals and maps of noteable locations across the universe. Records are editable only by those with administrator access, but are accessible by those with a security clearance of 3 or higher for the purpose of research and training. Records may only be entered by someone with administrative level access </p>
		</div> ',



	#CHARACTERS - PROFILE - getting started
	"charCreation-images" => "
		<p>As the handler of <b>$cName</b>, you will be building $cGender from the ground up from $cGenderPossessive name to the color of $cGenderPossessive hair to their background images. Think about your hero in all dimensions from how they got their powers to who they first shared their secrets to how they hide their dual life from the public. It's quite easy with our drop down menu and insert functions.</p>

		<ol>
			<li><b>CHOOSING A MAIN BACKGROUND/BANNER IMAGE (940x460px):</b> Ideally this will capture the hero in action or show a particular aspect of them in costume. You can use photos of a real-life actor or model, or other well know celebrity to represent $cName, or a reasonably realistic artist rendering to convey the the look and feel of $cName. The banner image can be in or out of uniform, the goal is to select something which truly represents $cGender. Such images should be relatively clothed, even the Hulk has pants. The image should not look like an attempt at a Tinder hook-up.<br /><i>Image size is 940x460 pixels.</i></li>

			<li><b>CHOOSING A CHARACTER PROFILE IMAGE (170x170px):</b> Profile image is what is used throughout the site to represent your character, both on the character\'s profile page and when posting or otherwised referenced - it is essentially your character avatar. As such the image selected should be an iconic representation of your character. And as with the main banner image, the profile image should not look like an attempt at a Tinder hook-up. Even Namor eventually abandoned his speedo for something with a little dignifired too it.<br /><i>Image size is 170x170 pixels.</i></li>

			<li><b>CHOOSING A CHARACTER GALLERY IMAGE(S) (500x500px):</b>  Yup, while it might not be apparent at first glance, every character automatically has a character gallery of images which is available by clicking on the main character profile image on their particular profile page.) You can upload as many images as you would like, of which four will be randomly selected at any given time along with your main prolfile image.  When someone selects a gallery image thumbail, your full character gallery will be exposed for view. The images are meant to represent your character both in their every day life as well as when they're being adventuresome. As with site policy regarding image selection, the profile images should not look like an attempt at a Tinder hook-up. You can have a shirtless image or two, but they should not constitute the magority of your image selections for a character. Even Emma Frost ultimately gave up the corset afterall.<br /><i>Image size is 500x500 pixels.</i>
		</ol>",



"charCreation-general" => "
	<p>As the handler of <b>$cName</b>, you will be building $cGender from the ground up from $cGenderPossessive name to the color of $cGenderPossessive hair to their background images. Think about your hero in all dimensions from how they got their powers to who they first shared their secrets to how they hide their dual life from the public. It's quite easy with our drop down menu and insert functions.</p>

	<ol>
		<li><b>CHARACTER CODENAME:</b> What is the codename of your character? A codename is important for any character on the site, not only because it is able to quickly identify the character to others, but also because it is used by our sites notification system to alert handlers to posts that are of potential interest to them and the characters they may handle. Even an ordinary person as they are used by our automatic tagging systemt to alert you to posts which might be of interest to you. As such all characters must have a codename, even if it is nothing more then your characters last night. As an example <i>Moira MacTaggert</i> would have the codename of <b>MacTaggert.</b></li>

		<li><b>DEVELOPMENT STAGE:</b> When you are ready for your character to be reviewed, please set the character stage to 'Review'. Mods will then know to review your character and leave notes for you if changes are required for approval.</li>

		<li><b>CHARACTER TYPE:</b> (Canon/Original)</li>

		<li><b>ALIAS (Nickname):</b></li>

		<li><b>NAME (First, Middle, Last):</b> While not all characters have a name, or their name is not known, when it is, you are encouraged to list it here.</li>

		<li><b>IDENTITY STATUS:</b> Please think about your character and the consequences of having both a secret and a public identity. They both have severe implications in role-playing.</li>
	</ol>",



"charCreation-appearance" => "
	<p>Overview needed</p>
		<ol>
			<li><b>AGE (Actual & Apparent):</b> Unless $CodeName\'s Actual and Apparent age are vastly different, more then a year or two, you only need to list $cGenderPossessive Actual age. Characters such as Wolverine or Seline or Captain America are expected to list both.</li>

			<li><b>PLAYBY (Character Avatar/Face Claim/Selected Model):</b> This is the model, actor, or any other possible celebrity with images considered to be in the public domain which you might sample to represent your character. An example of a possible playby might be Patric Stewart who is often considered to be a spot on casting for Professor Charles Xavier or Scarlet Johanssen who is cinematic choice for the Avenger's team mate, the Black Widow.</li>

			<li><b>DISTINQUISHING FEATURE(S):</b> Please describe your character physical appearance. i.e. tattoos, scars, skin completion, etc.</li>
		</ol>",



"charCreation-legal" => "
	<p>Overview needed</p>
		<ol>
			<li><b>CITIZENSHIP:</b>  Description needed</li>

			<li><b>LEGAL STATUS:</b>  Description needed</li>

			<li><b>D.O.B. (Date of Birth):</b> Description needed</li>

			<li><b>P.O.B. (Place of Birth):</b> Description needed</li>

			<li><b>EDUCATION:</b> Description needed.</li>

			<li><b>CHARACTER CLASS:</b> Description needed</li>
		</ol>",



"charCreation-ranks" => "
	<p>Overview needed</p>
		<ol>
			<li><b>POWER SOURCE:</b> Is self-explanatory
			<br />
			<small>You can launch the Powers page directly from within $CodeName\'s profile. If you do so, you will see buttons which will allow you to automatically auto-load the personalized descriptions from our Powers Asset Library.</small></li>

			<li><b>APTITUEDS (Skills and Abilities):</b> – self-explanatory
			<br />
			<small>You can launch the Aptitudes page directly from within $CodeName\'s profile. If you do so, you will see buttons which will allow you to automatically auto-load the personalized descriptions from our Aptitudes Asset Library.</small></li>

			<li><b>MERITS (Advantages):</b> Where did you get those wonderful toys?
			<br />
			<small>You can launch the Merits/advantages page directly from within $CodeName\'s profile. If you do so, you will see buttons which will allow you to automatically auto-load the personalized descriptions from our Merits Asset Library.</small></li>

			<li><b>FLAWS (Disadvantages):</b> Description still needed.
			<br />
			<small>You can launch the Flaws/Disadvantages page directly from within $CodeName\'s profile. If you do so, you will see buttons which will allow you to automatically auto-load the personalized descriptions from our Flaws Asset Library.</small></li>
		</ol>",



"charCreation-personality" => "
	<p>Overview needed</p>
		<ol>
			<li><b>PERSONALITY:</b> You will be able to personalize them to your own tastes by offering quotes they might like, or theme songs that might capture their essence.</li>
			<li><b>WAIVER:</b> This is for the Mod to use to determine what stories and levels of threat are acceptable for you as a player to agreed to in role playing.</li>

			<li><b>CONCEPT:</b> Should be a simple description of your character. I.e. Jean Grey is a Mutant for pick from the available choices in the drop down menu.</li>

			<li><b>ORIENTATION (Sexual):</b> lots of choices and this is not set in stone.</li>

			<li><b>DEMEANOR:</b> is a guiding principle of your characters behavior in dealing with people and situations.<br />
			<small>Simply select the appropriate designation from our dropdown list within the character building profile tool</small></li>

			<li><b>NATURE:</b> is a guiding principle of your characters behavior in dealing with people and situations.<br />
			<small>Make selection from dropdown list.</small></li>

			<li><b>Personality:</b> Give a detailed spectrum of attitudes and behavior to better capture your characters reaction to people, places and things. </li>
		</ol>",



"charCreation-abilities" => "
	<p>Overview needed</p>
		<ol>
			<li><b>POWERS:</b> ?
			<br />
			<small>Selct one option from the dropdown select menu detailing the various recognized Power Sources.</small></li>

			<li><b>APTITUEDS (Skills and Abilities):</b> – self-explanatory
			<br />
			<small>You can launch the Aptitudes page directly from within $CodeName\'s profile. If you do so, you will see buttons which will allow you to automatically auto-load the personalized descriptions from our Aptitudes Asset Library.</small></li>

			<li><b>SAVEY:</b> How good are you with technology?
				<br />
				<small>Selct one option from the dropdown select menu detailing the various recognized Power Sources.</small></li>

			<li><b>Expertise:</b> How good are you in general?
				<br />
				<small>Selct one option from the dropdown select menu detailing the various recognized Power Sources.</small></li>

			<li><b>Assets (Disadvantages):</b> ?.
				<br />
				<small>Selct one option from the dropdown select menu detailing the various recognized Power Sources.</small></li>
		</ol>",



"charCreation-assets" => "<p>Overview needed</p>
		<ol>
			<li><b>EQUIPMENT (If any):</b> What does $CodeName carry on their actual person on a day to day basis rather then what they might have access to such as a public library or a school\'s computer network or your Netflixs account.

			<li><b>RESOURCES (If any):</b> A resource is something $CodeName owns or has access too, but does not actually carry on their person. Example, Professor Xaiver of the X-Men has the Cerebro, he and all the X-Men might list this as a resource. But interms of equipment, they would list the mini-cerebro smart watchs if they have been issued one.</li>

			<li><b>TRANSPORTAION:</b>  ?</li>

			<li><b>UNIFORM:</b>  This is a detailed description of how $CodeName looks when in their alter-ego.</li>

			<li><b>UNIFORM SPECS:</b> If your uniform provides $CodeName with some form of special protections or enhancements, please note said enhancements here. If the enhancements are of a super-nature, they ought to be listed under the powers section of $cGenderPossessive profile.</small></li>
		</ol>",



"charCreation-associations" => "<p>Overview needed</p>
		<ol>
			<li><b>TEAM:</b>  ?</li>

			<li><b>TEAM POSITION:</b>  ?</li>

			<li><b>AFFLIATION:</b>  ?
				<br />
				<small>*If you list a character and the exist on our site, you will see that that character 'auto-links' to the their onsite profile. To enable this, you must list them by their recognized codename, or Last Name First.</small></li>
			</li>

			<li><b>ALLIES:</b>  ?
				<br />
				<small>*If you list a character and the exist on our site, you will see that that character 'auto-links' to the their onsite profile. To enable this, you must list them by their recognized codename, or Last Name First.</small></li>
			</li>

			<li><b>CONTACTS:</b>  ?
				<br />
				<small>*If you list a character and the exist on our site, you will see that that character 'auto-links' to the their onsite profile. To enable this, you must list them by their recognized codename, or Last Name First.</small></li>
			</li>

			<li><b>RELATIONSHIPS:</b>  ?
				<br />
				<small>*If you list a character and the exist on our site, you will see that that character 'auto-links' to the their onsite profile. To enable this, you must list them by their recognized codename, or Last Name First.</small></li>
			</li>

			<li><b>RELATIVES:</b>  ?
				<br />
				<small>*If you list a character and the exist on our site, you will see that that character 'auto-links' to the their onsite profile. To enable this, you must list them by their recognized codename, or Last Name First.</small></li>

			<li><b>RIVALS:</b>  ?
				<br />
				<small>*If you list a character and the exist on our site, you will see that that character 'auto-links' to the their onsite profile. To enable this, you must list them by their recognized codename, or Last Name First.</small>
			</li>
		</ol>",



"charCreation-history" => "
		<p>As a general rule, when developing your background, try to be dramatic but not over the top. In the long run, it is more interesting to have weaknesses, barriers to overcome, and difficult goals to fulfill than to have abundance, power, or effortless strength (this last note is just as, if not more important for game masters). Ideally, you want to address four domains in your background:
		<br /><br />
		A) Conflict - Who or what does your charcter fight for or against?
		<br /><br />
		B) CHALLENGES - What limits your character, physically, emotionally, and psychologically? Enquiring minds want to know!
		<br /><br />
		C) MYSTERY - What odd circumstnaces and unanswered questions linger in the past of $CodeName?
		<br /><br />
		D) PASSION - What motivates and drives $CodeName?
		<br /><br />
		Minimum Required Word Count: 800+ words</p>
		<ol>
			<li><b>HISTORY:</b> As noted we expect a reasonable character history which HAS BEEN spellchecked and is written in the third person. $CodeName\'s history should reflect a brief review of the characters life before and after their heroic circumstances or transition from average citizen to focal character. It should showcase the origin of the character and up to the moment the game begins.</li>
		</ol>",


































	#MODAL - Resigter/Join
	"EvalPost" => '<h4>
		RP Sample Post to Write Your Evaluation Response To</h4><p><em>The limp, possibly lifeless body of May Parker, Aunt of young Peter Parker lay at the feet of Dr Otto Octavius. Spider-Man\'s keen senses and Spider-Sense told him that his aunt was still alive, but only just barely and needed urgent medical care. Octavious stood before Spider-Man, better know as Dr. Ock, the deranged genius was possibly Spider-Man\'s single greatest foe with his keen albiet slightly deranged intellect, his ruthless cunning, and four robotic arms to assist him. "Well Spider-Man? Where are you clever quips and witty barbs now I ask you? We stand at the foothold of my greatest accomplishment and you stand helpless before me - there is nothing you can do. Once I throw the final switch, New York will be under my complete, autonomous control."<br /><br />Dr. Oct was about to laugh, but the lights above them suddenly flickered, then went out. The blackout was likely due to the amount of power which his cold fusion reactor was drawing from the city. The old subterrain wiring likely couldn\'t handle the stress of the load it had been tasked with carring and now the lights were out if only for the moment. In the darkness, Dr. Oct was likely startled - if that was the case, then perhaps his tentacle had eased it\'s grip on Aunt May\'s neck...
	</p>',


	"EvalPlaceholder" => "Please write an RP sample using the text area below. The sample is to be 300 words in length or longer. We ask that you use the character of Spider-Man (we know that it is not likley that you are applying for Spider-Man, this sample is strictly for purposes of evaluation.) In the post, please write your sample in our site style which is third-person, past tense narrative voice. Above, we have given you a sample post to write your evaluation post - Thank you for your cooperation.",

	"Terms" => "<h4 class=''><strong>TERMS &amp; CONDITIONS:</strong></h4>
	<div class='pull-left'><img src='./../_img/RP-17.png' alt='RP-17' /></div>
	<div class='pull-left'>
		<small>" . SITE_NAME . " is rated NC-17, most parents would consider patently too adult for their children 17 and under. No persons, aged 16 or less will be accepted as members of " . SITE_ABBR . " NC-17 does not mean 'obscene' or 'pornographic' in the common or legal understanding of those words, and should not be construed as a negative judgment in any sense. Our rating simply signals that the content is meant for an mature audiences/members. An NC-17 rating can be based on violence, sex, aberrational behavior, drug abuse or any other element that most parents would consider too strong and therefore off-limits for viewing by those under the age of 17. " . SITE_ABBR . " has taken every reasonable process to screen out those below the age of 17 from participating in it's activites and as such is not responsible for those who might mislead admins to gain access to   " . SITE_ABBR . " content.
		<br /><br />
		Neither " . SITE_ABBR . ", nor Monkeework is responsible for any messages posted by it's membership, either 'ICly' or 'OOCly'. We do not vouch for nor warrant the accuracy, completeness or usefulness of any message, and accept no responsiblities for the contents of any such messages. All messages are consdiered to express the views of their perspective authors and not necessarily the views of " . SITE_ABBR . ". Any member who feels that a posted message is objectionable is encouraged to contact a site moderator immediately by email. Please note that while we do have the ability to remove objectionable messages/materials, any such posts which are flagged as objectionable will be reviewed before any efforts are taken to moderator or remove the offending post(s) found to be objectionable within a reasonable time frame, if we determine that removal is necessary and violates our sites rating/posting policies. By joining, you agree, through your use and participation of this service, that you will not use " . SITE_ABBR . " to post any OOC material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person's privacy, or otherwise in violative of any law. You agree not to post any copyrighted material unless the copyright is considered shared/of fair use by you and " . SITE_ABBR . ", and thus will remain on " . SITE_ABBR . " under the governace of such 'fair useage' acts.
	</small></div>",



	#Library / Powers - Combat
	"powersCombat" => "<p>The following listing of Combat enhancement power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for fighting-enhancement-powers power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		Combat powers help to give the edge to in-fighters (close combatant characters)  such as Wolverine, Sabertooth, or Squirrel Girl (She has a really really big tail folks and she knows how to use it or she wouldn't be an Avenger). The powers might be natural or derived from an accident, experiment, or even artificial in nature. Regardless of their origin, they'll help your character turn the tide in a fight either limiting the amount of damage you can sustain or by adding to the amount of damage you can dole out.
	</p>",


	#Library / Powers - Defensive
	"powersDefensive" => "<p>
		The following listings of Defensive power summaries are generalized in their description and available to you for use with creating your character. The descriptions are meant to be personlaized to your character, in most if not all cases, they are written from an informational starting point and you are expected to then elaborate and expand on what is given to help finish your your character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for the Defensive power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		Defensive powers are basically resistances which help to protect the character from physical, mental, or spiritual harm. Most of the defensive protections detailed in this section are generally proof against a specific from of attack such as Resistance to Fire and Heat, which while good against fiery balls of death <em>Equinox</em> might hurl at your character would do little against that of Endotherm's heat stealing abilities. You can find protections and defensive power suggests below for everything from radiation-based dangers to that of psychic trauma or possible spiritual crisis.
	</p>",


	#Library / Powers - Detection
	"powersDetection" => "<p>
		The following listing of Detection power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Detection powers descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		Detection powers are basically sensory powers which are not of a psychic, magical, or faith based nature. They allow your character some exoctic or extraordinary method of detechion. The means by which can range from hyper senses to accute awareness of radiation hot zones. Most of the detctions detailed in this section are generally good towards a specific form of detection such as Hyper-Olfactory sense which would held Daredevil to identify if he is being approached by Electra Nachios or Karen Page by distinquishing the differences in their tell-tale scent markers.
	</p>",


	#Library / Powers - Energy Control
	"powersEnergyCon" => "<p>
		The following listing of Energy Control power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for energy-generation-powers power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		Energy controls reflect those powers which manipulate th evarious typse of energy that exist ‐ effectvely those non-material states outside the characters own body. These include most know types of energy and their possible states of being.",


	#Library / Powers - Energy Emission
	"powersEnergyEm" => "<p>
		The following listing of Energy Generation power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Energy Generation power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		Energy-emission powers are exactly what you are likely imaginging when you hear the term. They are bolts of lightning, bursts of extreme cold, or even the abscence such as that of shadow caster Darkstar of the Winter Guard. Energy emission powers can be emitted by any part of the hero's body. For most Powers, it is not important to specify the emergence point. For the Powers of the Energy Emission class, though, emission points become important. This affects how the hero utilizes his Power. It determines ways goes can negate that Power. If the hero loses the part of their body containing the emission point, they may lose their Power as well. When creating the hero, the player should determine an, emission point for any Energy Emission Powers. They may select the first one rolled as the point for all of their character's Energy Emissions, or be adventurous and determine one for each Power.
	</p>",


	#Library / Powers - Faith
	"powersFaith" => "<p>
		The following listing of Faith-based power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Illusion power descriptions below can be found on the Range Tables (STC).
	</p>",


	#Library / Powers - Illusion
	"powersillusions" => "<p>
		The following listing of Illusion power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Illusion power descriptions below can be found on the Range Tables (STC).
	</p>",


	#Library / Powers - Lifeform Control
	"powersLifeformCon" => "<p>
		The following listing of Lifeform Control power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for  Lifeform Control  power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		These powers are severe in the scope of what they do as they affect other characters and as such must be weighted against their character waivers; These powers change the form, structure, composition or even the very nature of a character. The Corrupter for instance can turn anyone not only evil with a touch, but also brings them under his fiendish sway as well. For those character who are of a high tech nature, then these descriptions list the possible effects of their devices.
	</p>",


	#Library / Powers - Magical
	"powersMagical" => "<p>
		The following listing of Magic-like power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Magic-like power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		The list of heroes with magical powers seems to grow by the day lately, the descriptions here will help you to craft such a character if that is your interest. Mental powers are very valuable in that they have little visible effect, and the character using employing them is often hard to detect outright when doing so.
	</p>",


	#Library / Powers - Matter Control
	"powersMatterCon" => "<p>
		The following listing of Matter Control power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for  Matter Control power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		These powers affect specific forms of animate and inanimate matter (substances as oppossed to energy) outside your character's physical body or beyond their physical means to reach and or otherwise affect. They include the various elemental powers you might expect, as well as the abiltiy to animate objects and transfrom items and in some cases even other characters (see oppossing characters character waiver for possible considerations).
	</p>",


	#Library / Powers - Matter Conversion
	"powersMatterConversion" => "<p>
		The following listing of Matter Conversion power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for  Matter Conversion power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		These powers affect specific forms of animate and inanimate matter (substances as oppossed to energy) outside your character's physical body or beyond their physical means to reach and or otherwise affect. They include the various elemental powers you might expect, as well as the abiltiy to animate objects and transfrom items and in some cases even other characters (see oppossing characters character waiver for possible considerations).
	</p>",


	#Library / Powers - Matter Conversion
	"powersMatterCreation" => "<p>
		The following listing of Matter Creation power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for  Matter Creation power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		These powers affect specific forms of animate and inanimate matter (substances as oppossed to energy) outside your character's physical body or beyond their physical means to reach and or otherwise affect. They include the various elemental powers you might expect, as well as the abiltiy to animate objects and transfrom items and in some cases even other characters (see oppossing characters character waiver for possible considerations).
	</p>",


	#Library / Powers - Mental Enhancement
	"powersMental" => "<p>
		The following listing of Mental Enhancement power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for  Mental Enhancement  power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		The list of heroes with mental powers is near endless these days, the descriptions here will help you to craft such a character if that is your interest. Mental powers are very valuable in that they have little visible effect, and the character using employing them is often hard to detect outright when doing so.
	</p>",


	#Library / Powers - Physical Enhancement
	"powersPhysical" => "<p>
		The following listing of Physical Enhancement power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Physical Enhancement power descriptions below can be found on the Range Tables (STC).
	</p>",


	#Library / Powers - Restricted
	"powersRestricted" => "<p>
		The following listing of Restricted powers is just that, restricted. While you may find some characters with these powers here and there on this site, the when and why they have been allowed has happened under very careful consideration and been given to those who have over time proven themselves through service not only to this site, to the larger RPing community at large.
	</p>",


	#Library / Powers - Self-Alteration
	"powersSelfAlt" => "<p>
		The following listing of Self-Alteration power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Self-Alteration power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		This category of powers incudes those which allow the hero to significantly modify their own form, becoming larger, smaller, lighter, or different in appearance. WHile thse modifications may have combat applications, they are not primarily offensive or defensive in nature.
	</p>",


	#Library / Powers - Travel
	"powersTravel" => "<p>
		The following listing of Travel power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for Travel power descriptions below can be found on the Range Tables (STC).
	</p>
	<p>
		As you might expect, all powers within this section affect the way inwhich a character can move within the story, whether by expaning the characters existing abilities or by introducing completely new capabilities such as displacement. It is up to the author to then take the descriptions and apply it to their character. Flight for instance can be accomplished in a variety of ways, from wingless unassisted flight to possessing weird and wild inhuman-like membranes which run along from under your arms down the complete length of your legs - anything is possible! Also consider what happens if something should go amiss, such as if they have rocket jets in their boots like Iron Man, and the Trapster should fire some flame retardent paste and snag the bottom of your characters boots, what do you do. What. Do. You. Do?
	</p>
	<p>
		Personally, I'd call Triple A and wait until they get there to explain the whole situation. Just saying...
	</p>",























	#UPLOADS
	"UploadDefault" => "<h2>Recent FAQ's</h2>
	<h5><span class='glyphicon glyphicon-time'></span> Post by Monkee, July 5, 2016.</h5>
	<h5><span class='label label-danger'>Powers</span> <span class='label label-primary'>Character Creation</span></h5><br>

	<p>
		So you've just joined Marvel Champion's online Roleplaying site, and you want people to pay attention to you and the character you'll be handling. What do you do? The best way to keep other roleplayers from ignoring you is to choose a play-by for your character..
	</p>

	<h2>What is a Playby?</h2>
	<p>
		Play-bys are models, celebrities, hipsters, and scene kids that roleplayers use to Visually represent the characters in play. selects a play-by for her character, she will mine the internets for photographs of that particular person and molest them with grunge brushes, song lyrics, and whatever pretentious character name the roleplayer dug out of babynames.com. Said roleplayer will post the play-by on her character's profile, and all of the other site's members will ooh and aah over how sexy and cool the character looks. Many internet scholars theorize that the attractiveness of a roleplayer is inversely proportional to the attractiveness of her average character, which means that sites that require or encourage play-bys are overloaded with some of the ugliest women on the planet.
	</p>

	<h2>How to claim a Playby</h2>
	<p>
		Once a handler(Player) has settled on a playby for their character, they enter it into the character creation form. If the playby is available, the form will accept the handler's request and automatically update our claims page for you. If you request a playby which is already in use, you will get a polite notice stating that that playby has already been claimed.</p>
	<p>
		<em>NOTE: While most characters on Marvel Champions have assigned faceclaims, many of them are muteable. If a character does not have an active handler, they may not have an active claim on a specific faceclaim and as always, the handler who get's their character approved first has first claim on a playby.</em></p>

	<h2>So What's Considered Fairgame?</h2>
	<p>
		If a person is considered to be active in the public space, meaning they have some kind of public persona such as that of a famous athelete or actor or even a podcaster, their considered fairgame.
	</p>

	<p>
		Any questions or suggestions?.
	</p>

	<br>"










];










