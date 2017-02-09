<?php

/**
 *arrays-inc.php - all general arrays kept here for ease of location/use
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seelist.php
 *
 *
 * @todo none
 */

// ===============================================
// COMMON ARRAYS
// ===============================================
$aarStatus = [
	"0"  => "Set Status", #non standards default setting
	"1"  => 'Wanted', #non standards default setting
	"2"  => 'Open',
	"3"  => 'Hold',
	"4"  => 'Taken',
	"5"  => 'Developing',
	"6"  => 'Submitted',
	"7"  => 'Review',
	"8"  => 'Expand',
	"9"  => 'Approved',
	"10" => 'Locked',
	"11" => 'Injured',
	"12" => 'Retiree',
	"13" => 'M.I.A.',
	"14" => 'Dead',
	"15" => 'Cloned',
	"16" => 'Unlisted', #is the default setting when needed
	"17" => 'Restricted', #is the default setting when needed
	"18" => 'Banned'
];

#used in profilesADD.php - note description variation
$aarStatusTest = [
		"0"  => "Character Status Not Set", #non standards default setting
		"1"  => 'Wanted', #non standards default setting
		"2"  => 'Open',
		"3"  => 'Hold',
		"4"  => 'Taken',
		"5"  => 'Develop',
		"6"  => 'Submit',
		"7"  => 'Review',
		"8"  => 'Expand (Revisions Needed)',
		"9"  => 'Approved',
		"10" => 'Locked',
		"11" => 'Injured',
		"12" => 'Retired',
		"13" => 'M.I.A.',
		"14" => 'Dead',
		"15" => 'Clone',
		"16" => 'Unlisted (Invisible to membership)', #is the default setting when needed
		"17" => 'Restricted (Mod Approval needed)', #is the default setting when needed
		"18" => 'Banned'
	];

$aarPrivilege = [
	"0"  => "visitor", 		#unknown
	"1"  => 'guest',   		#no character, just joined
	"2"  => 'member',  		#aproved, no character
	"3"  => 'handler',    #aproved, has character
	"4"  => 'mod',     		#characters
	"5"  => 'admin',   		#handles
	"6"  => 'owner',      #superadmin
	"7"  => 'developer'   #all privs-db

	// PRIV_DEVELOPER
	// PRIV_DEVELOPER 	// PRIV_DEVELOPER
	// PRIV_DEVELOPER
	// PRIV_DEVELOPER
	// PRIV_DEVELOPER

	//"7"  => PRIV_DEVELOPER   #all privs-db
];

$aarWaiver = [
"0"  => "G - General. Suitable for members of all ages; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"1"  => "PG - Some content may not be suitable for children; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"2"  => "PG-13 - Some material may be inappropriate for persons under the age of 13; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"3"  => "R - Content not suitable for persons under the age of 17. Adult or legal guardian's permission required to participate; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"4"  => "NC-17 - Content not suitable for persons under the age of 17; No maiming, mutitilating, or other possible traumatic situations. Prior explicit player consent required before event inclusion.",
"5"  => "X - So long as it is within the rules of the site; Maiming, mutitilating, and other possible sexual/traumatic situations approved by mods and storyteller. Such actions initiated by other players require prior player consent.",
"6"  => "XX - So long as it is within the rules of the site; Maiming, mutitilating, and other possible sexual/traumatic situations approved by mods and storyteller. Such actions initiated by other players require prior player consent.",
"7"  => "XXX - So long as it is within the rules of the site; Maiming, mutitilating, and other possible sexual/traumatic situations approved. No prior player consent required for event inclusion.",
"8"  => "NPC - General use authorized; No maiming, mutitilating, or other possible traumatic situations without prior moderator consent.",
"9"  => "NPC - Mod approval required; No maiming, mutitilating, or other possible traumatic situations without prior moderator consent.",
"10" => "NPC - Storyteller approval required; No maiming, mutitilating, or other possible traumatic situations without prior storyteller consent."
];

//remember to map changes to '/ajax/charinfo.php'!
$digits = ["0",1,2,3,4,5,6,7,8,9];

#&frasl; = forward slash
$aarBtnRank = [
	'S &frasl; 0',
	'fe', 'pr', 'ty', 'gd', 'ex', 'rem',' inc', 'am', 'mon', 'un',
	'S &frasl; X', 'S &frasl; Y', 's &frasl; z',
	'c1', 'c3', 'c5', 'b'];

$aarClassification = [
"Please select a Character Classification", #don't show if no selection/default
"animal",
"android",
"a.i.",
"alien - extraterestrial",
"alien - extradimensional",
"alien - temporal",
"angel",
"celestial",
"cyborg",
"demi-god/godling",
"demon/devil",
"diety",
"extra-dimensional",
"foriegn",
"human (Homosapien Sapien Sapien)",
"hybrid",
"inhuman",
"mechanical",
"mutation - dormant: Class Unknown",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"alpha-prime - Ap1",
"alpha-kappa - Ak1",
"alpha-epsilon - Ae1",
"alpha-gamma - Ag1",
"alpha-tau - At1",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"gamma-prime - Gp2",
"gamma-kappa - Gk2",
"gamma-epsilon - Ge2",
"gamma-omega - Go2",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"epsilon-prime - Ep3",
"epsilon-kappa - Ek3",
"epsilon-tau - Et3",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"kappa-prime - Ek4",
"kappa-tau - Et4",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"omega-prime - Op5",
"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------------------",
"symbiot",
"robot",
"unknown",
" " #don't show if no selection/default
];

$aarEducation = [
"None",
"Special Ed. - Variable",
"Preschool",
"Kindergarden",
"GRD 1",
"GRD 2",
"GRD 3",
"GRD 4",
"GRD 5",
"GRD 6",
"GRD 7",
"GRD 8",
"GRD 9 - Freshmen",
"GRD 10 - Sophmore",
"GRD 11 - Junior",
"GRD 12 - Senior",
"GRD 12 - Grad",
"GRD 12 - G.E.D.",
"College YR 1 - Attending",
"College YR 1 - Certificate",
"College YR 2 - Attending",
"College YR 2 - A.A.",
"College YR 2 - A.A.A.",
"College YR 2 - A.A.A.",
"College YR 2 - A.E.",
"College YR 2 - A.P.S.",
"College YR 2 - Certificate",
"College YR 3 - Attending",
"College YR 4 - Attending",
"College YR 4 - B.A.",
"College YR 2 - A.Arch.",
"College YR 4 - B.B.A.",
"College YR 4 - B.F.A.",
"College YR 4 - B.S.",
"College YR 5 - Attending",
"College YR 6 - Attending.",
"College YR 6 - LL.M.",
"College YR 6 - M.A.",
"College YR 6 - M.B.A.",
"College YR 6 - M.Res",
"College YR 6 - M.Phil",
"College YR 6 - M.S.",
"College YR 7 - Attending.",
"College YR 8 - Attending.",
"College YR 8 - Ed.D.",
"College YR 8 - PH.d.",
"College YR 8 - J.d.",
"College YR 8 - Dr.",
"Homeschooled.",
"Unknown"
];


$aarHair = [
	'Set Hair Color',
	'black, jet',
	'black, natural',

	'brown, dark',
	'brown, chocolate', #5
	'brown, medium',
	'brown, golden',
	'brown, light',
	'brown, ashen',
	'brown, honey',
	'brown, caramel',

	'blonde, hollywood',
	'blonde, plantinum',
	'blonde, ash',
	'blonde, medium',
	'blonde, platinum',
	'blonde, honey',
	'blonde, golden',
	'blonde, sandy',
	'blonde, meade',
	'blonde, butterscotch',
	'blonde, strawberry',

	'pink, pearl',

	'red, rosa',
	'red, ruby',
	'red, copper',
	'red, garnet',
	'red, burgundy',
	'red, dark',

	'purple, passion',
	'purple, plum',
	'purple, ultraviolet',

	'green, grape',
	'green, turquoise',

	'blue, steel',

	'white',

	'bald',
	'shaved',

	'<sup>*</sup>see distinquishing features for details'
];


$aarEye = [
	'Set Eye Color',
	'red, dark', #2
	'red, light',
	'orange, dark',
	'orange, light',
	'Amber',
	'yellow, bright',
	'yellow, light',
	'green, light',
	'green, dark',
	'green, med',
	'green, light',
	'blue, pond',
	'blue, dark',
	'blue, medium',
	'blue, light',
	'periwinkle',
	'lavender',
	'pink',
	'plum',
	'brown, dark',
	'brown, med',
	'brown, light',
	'hazel',
	'grey',
	'metallic periwinkle',
	'teal, metallic ',
	'albino',

	'<sup>*</sup>see distinquishing features for details'];


$aarLegal = [
	"Minor, No criminal record", "Minor, Criminal record", "Minor, Record sealed", "Adult, No criminal record", "Adult, Criminal record", "Adult, Record sealed"
];

$aarMarital = [
	"committed",
	"Dating", "Divorced",
	"Married", "Open Relation",
	"Partnered",
	"Seperated", "Single"
];

$aarPowSource = [
"None",
"Accident",
"Alien",
"Altered - Induced",
"Altered - Random",
"Artificial - Mechanical: Induced",
"Artificial - Mechanical: Random",
"Enhanced - Induced",
"Enhanced - Random",
"External (Extra-dimensional)",
"External (Faith)",
"External (Mechanical)",
"External (Magical)",
"External (Mythical)",
"Faith",
"Hybrid",
"Mutation - Dormant",
"Mutation - Genetic: Induced",
"Mutation - Genetic: Hereditary",
"Mutation - Genetic: Random",
"High-Tech Wonder",
"Magic",
"Mythic",
"Study",
"Training",
"Unknown"
];

$aarOrientation = [
"0" => "please select a character sexual orientation", #is the default setting when needed
"1" => "asexual",
"2" => "bisexual",
"3" => "hetrosexual",
"4" => "homosexual",
"5" => "pansexual",
"6" => "polysexual",
"7" => "transexual",
"8" => ""	 #default for non-displayed value
];

$aarRank = [
"",
"S0/00",
"PR/01",
"FE/02",
"PR/04",
"TY/06",
"GD/10",
"EX/20",
"REM/30",
"INC/40",
"AM/50",
"MON/75",
"UN/100",
"SX/150",
"SY/200",
"SZ/500",
"C1/1,000",
"C3/3,000",
"C5/5,000",
"BYND/?"
	];

//Marvel stats
$aarRankStaggered = [
	"None",
" ",
"PR",
"PR / FE*",
"PR / TY*",
"PR / GD*",
"PR / EX*",
"PR / REM*",
" ",
"FE / PR*",
"FE",
"FE / TY*",
"FE / GD*",
"FE / EX*",
"FE / REM*",
" ",
"TY / PR*",
"TY / FE*",
"TY",
"TY / GD*",
"TY / EX*",
"TY / REM*",
"TY / INC*",
"TY / AM*",
"TY / MON*",
" ",
"GD / PR*",
"GD / FE*",
"GD / TY*",
"GD",
"GD / EX*",
"GD / REM*",
"GD / INC*",
"GD / AM*",
" ",
"EX / PR*",
"EX / FE*",
"EX / TY*",
"EX / GD*",
"EX",
"EX / REM*",
"EX / INC*",
"EX / AM*",
"EX / MON*",
" ",
"REM / FE*",
"REM / TY*",
"REM / GD*",
"REM / EX*",
"REM",
"REM / INC*",
"REM / AM*",
"REM / MON*",
"REM / UN*",
" ",
"INC / TY*",
"INC / GD*",
"INC / EX*",
"INC / REM*",
"INC",
"INC / AM*",
"INC / MON*",
"INC / UN*",
"INC / SX*",
" ",
"AM / GD*",
"AM / EX*",
"AM / REM*",
"AM / INC*",
"AM",
"AM / AM",
"AM / MON*",
"AM / UN*",
"AM / SX*",
" ",
"MON / EX*",
"MON / REM*",
"MON / INC*",
"MON / AM",
"MON",
"MON / UN*",
"MON / SX*",
"MON / SY*",
"MON / SZ*",
" ",
"UN / REM*",
"UN / INC*",
"UN / AM",
"UN / MON*",
"UN",
"UN / SX*",
"UN / SY*",
"UN / SZ*",
"UN / C1000*",
" ",
"SX / INC*",
"SX / AM",
"SX / MON*",
"SX / UN*",
"SX",
"SX / SY*",
"SX / SZ*",
"SX / C-1000*",
"SX / C-3000*",
" ",
"SY / AM",
"SY / MON*",
"SY / UN*",
"SY / SX*",
"SY",
"SY / SZ*",
"SY / C-1000*",
"SY / C-3000*",
"SY / C-5000*",
" ",
"C-1000 / UN*",
"C-1000 / SX*",
"C-1000 / SY*",
"C-1000 / SZ*",
"C-1000",
"C-1000 / C-3000*",
"C-1000 / C-5000*",
"C-1000 / BYND*",
" ",
"C-3000 / SX*",
"C-3000 / SY*",
"C-3000 / SZ*",
"C-3000 / C-1000*",
"C-3000",
"C-000 / C-5000*",
"C-3000 / BYND*",
" ",
"C-5000 / SX*",
"C-5000 / SY*",
"C-5000 / SZ*",
"C-5000 / C-1000*",
"C-5000*",
"C-3000 / BYND*",
" ",
"BYND / SY*",
"BYND / SZ*",
"BYND / C-1000*",
"BYND / C-5000*",
"BYND",
" ",
"Unknown"
	];

$aarRating = [
1 => array("rating"=>"G", "description"=>"General Audiences"),
2 => array("rating"=>"PG", "description"=>"Strong language used"),
3 => array("rating"=>"PG-13", "description"=>"Strong violence or language used"),
4 => array("rating"=>"R", "description"=>"Restricted - Strong sexual or violent situations described"),
5 => array("rating"=>"NC-17", "description"=>"Explicit Sexual/Graphic situations described"),
6 => array("rating"=>"X", "description"=>"Hee, hee, hee!")
];

$aarAsset = [
	"Unemployed, Social Security or allowance",
	"Freelance, lower middle class, students",
	"Salaried employment, middle class",
	"Professional employment, middle class",
	"Small ineritance or business, upper middle class",
	"Large business or chain, trust fund, upper class",
	"Standard corporation, millionaire",
	"Large corporation, small country",
	"Multinational corp., govt. branch of major country",
	"Major country, mega-corporation",
	"Unknown"
];


$aarExpertise = [
	"Lacks any knowledge or understanding of Language and machines",
	"Knows native language and simple machines",
	"Some tech exposure, understands complex machines",
	"Operate current technology: computers, electronics",
	"Repair, install and troubleshoot current technology",
	"Modify existing current technology",
	"Knows most advanced terran tech concepts",
	"Knows non-terran technologies",
	"Create leading-edge tech: stardrives, temporal devices",
	"Improve and modify advanced alien technologies",
	"In effect, IS an alien technology",
	"Unknown"
];

//Changes applied to compoto => display.php, edit.php
//MA, MU, XC & XPG will use '$stats_marvel' (duh)
//DC Stats
$stats_dc = [
"0",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"10",
"11",
"12",
"13",
"14",
"15",
"16",
"17",
"18",
"19",
"20",
"21",
"22",
"23",
"24",
"25",
"26",
"27",
"28",
"29",
"30",
"31",
"32",
"33",
"34",
"35",
"36",
"37",
"38",
"39",
"40",
"41",
"42",
"43",
"44",
"45",
"46",
"47",
"48",
"49",
"50",
"51",
"52"
	];

$stateAbbr = [
	"AL", "AK", "AZ", "AR", "CA", "CZ", "CO", "CT", "DE", "FL", "GA", "GU", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "VI", "WA", "DC", "WV", "WI", "WY"
	];

$stateName = [
	"Alabama", "Alaska", "Arizona", "Arkansas",
	"California", "Canal Zone", "Colorado", "Connecticut",
	"Delaware",
	"Florida",
	"Georgia", "Guam",
	"Hawaii",
	"Idaho", "Illinois", "Indiana", "Iowa",
	"Kansas", "Kentucky",
	"Louisiana",
	"Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana",
	"Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota",
	"Ohio", "Oklahoma", "Oregon",
	"Pennsylvania", "Puerto Rico",
	"Rhode Island", "South Carolina",
	"South Dakota",
	"Tennessee", "Texas",
	"Utah", "Vermont",
	"Virginia", "Virgin Islands",
	"Washington", "Washington, D.C.", "West Virginia", "Wisconsin", "Wyoming"];

/*
$aarSource = [
"None",
"Artificial - Mechanical: Induced",
"Artificial - Mechanical: Random",
"Extra-dimensional",
"Mutation - Genetic: Induced",
"Mutation - Genetic: Hereditary",
"Mutation - Genetic: Random",
"Alien",
"High-Tech Wonder",
"Magic",
"Unknown"
];
*/


$aarTposition = [
"None",
"Squad Leader",
"Deputy Squad Leader",
"Team Leader",
"Deputy Team Leader",
"Reservist",
"Hiatus"
];

/*
$aarTrait = [
	"Activist", "Adventurer", "Analyst", "Architect", "Autocrat", "Autist", "Avant-Garde", "Benefactor", "Bon Vivant", "Bragard", "Bravo", "Caregiver", "Cavalier", "Celebrant", "Child", "Competitor", "Confidant", "Conformist", "Conniver", "Coward", "Crackerjack", "Critic", "Curmudgeon", "Coward", "Dabbler", "Dark Hero", "Decoder", "Defender", "Defiant", "Director", "Deviant", "Explorer", "Fanatic", "Follower", "Gallant", "Grown-up", "Guardian", "Hero", "Honest-Abe", "Jester", "Jobsworth", "Judge", "Idealist",  "Intellectual", "Lackey", "Loner", "Manipulator", "Martyr", "Masochist", "Mediator", "Mentor", "Minion", "Misguided Villian", "Monster", "Narcissist", "Newbie", "Nut", "Old Hand", "Optimist", "Pedagogue", "Penitent", "Perfectionist", "Pervert", "Plotter", "Poltroon", "Power Broker", "Praise-Seeker", "Predator", "Psuedo Intellectual", "Psychotic", "Rebel", "Recovering", "Reluctant Hero", "Rogue", "Sadist", "Sage", "Scientist", "Scoundrel", "Seductresss", "Seductor", "Sensualist", "Shattered", "Show-off", "Soldier", "Startlet", "Supplicant", "Survivor", "Sycophant", "Terrorist", "Theorist",  "Thrill-Seeker", "Traditionalist", "Trickster", "Vigilante", "Villain", "Vindictive" ];



$aarTraitDesc = [
	"Activist", "Adventurer", "Analyst", "Architect", "Autocrat", "Autist", "Avant-Garde", "Benefactor", "Bon Vivant", "Bragard", "Bravo", "Caregiver", "Cavalier", "Celebrant", "Child", "Competitor", "Confidant", "Conformist", "Conniver", "Coward", "Crackerjack", "Critic", "Curmudgeon", "Coward", "Dabbler", "Dark Hero", "Decoder", "Defender", "Defiant", "Director", "Deviant", "Explorer", "Fanatic", "Follower", "Gallant", "Grown-up", "Guardian", "Hero", "Honest-Abe", "Jester", "Jobsworth", "Judge", "Idealist",  "Intellectual", "Lackey", "Loner", "Manipulator", "Martyr", "Masochist", "Mediator", "Mentor", "Minion", "Misguided Villian", "Monster", "Narcissist", "Newbie", "Nut", "Old Hand", "Optimist", "Pedagogue", "Penitent", "Perfectionist", "Pervert", "Plotter", "Poltroon", "Power Broker", "Praise-Seeker", "Predator", "Psuedo Intellectual", "Psychotic", "Rebel", "Recovering", "Reluctant Hero", "Rogue", "Sadist", "Sage", "Scientist", "Scoundrel", "Seductresss", "Seductor", "Sensualist", "Shattered", "Show-off", "Soldier", "Startlet", "Supplicant", "Survivor", "Sycophant", "Terrorist", "Theorist",  "Thrill-Seeker", "Traditionalist", "Trickster", "Vigilante", "Villain", "Vindictive" => "XXXdescXXX"
]
*/


$aarTraitName = [
	'No',
	"Addict", "Adherent", "Adjudicator", "Advisor", "Analyst", "Architect", "Artist", "Autocrat", "Autist", "Avant-Garde", "Barbarian", "Believer", "Bon Vivant", "Bravo", "Caregiver", "Cavalier", "Child", "Celebrant", "Competitor", "Confidant", "Conformist", "Conniver", "Critic", "Crusader", "Curmudgeon", "Defender", "Demagogue", "Deviant", "Director", "Dreamer", "Eccentric", "Engine", "Explorer", "Evangelist", "Fanatic", "Gallant", "Healer", "Honest-Abe", "Jester", "Jobsworth", "Judge", "Loner", "Manipulator", "Martyr", "Masochist", "Meddler, Mediator", "Monger", "Monster", "Non-Partisan", "Optimist", "Paragon", "Pedagogue", "Penitent", "Perfectionist", "Plotter", "Poltroon", "Praise-Seeker", "Provider", "Rebel", "Rogue", "Soldier", "Stoic", "Survivor", "Sycophant", "Traditionalist", "Thrill-Seeker", "Trickster", "Vigilante", "Visionary"
];

$aarTraitOverview = [
	"No" => " Value Selected",

	"Addict" => "Whatever XXXcgPossessiveXXX fix is, XXXcgSubjectiveXXX HAS TO have it.",

	"Adherent" => "Stay true to XXXcgPossessiveXXX goals/beliefs no matter what.",

	"Adjudicator" => "Pronounce the solutions to others' problems.",

	"Advisor" => "Your wise counsel is sought out.",

	"Analyst" => "Collection and study of information brings understanding.",

	"Architect" => "Creation is XXXcgPossessiveXXX passion.",

	"Artist" => "Inspire, challenge or provoke others with XXXcgPossessiveXXX works.",

	"Autocrat" => "Control-freak.",

	"Autist" => "One who buries their secrets.",

	"Avant-Garde" => "A fascination with the trendy and new.",

	"Barbarian" => "Civilization is the crutch of the weak",

	"Believer" => "You must convince others of the Truth only you know.",

	"Bon Vivant" => "Eat, drink, and be merry, for tomorrow we die.",

	"Bravo" => "Cruelty and bullying are XXXcgPossessiveXXX good points.",

	"Caregiver" => "Actively caring or helping others.",

	"Cavalier" => "The fearless hero.",

	"Child" => "Working through immaturity and innocence.",

	"Celebrant" => "Pursue excitement in all things.",

	"Competitor" => "You must win everything to be happy.",

	"Confidant" => "A good listener and keeper of secrets.",

	"Conformist" => "You would rather follow a powerful figure than lead.",

	"Conniver" => "You want something for nothing.",

	"Critic" => "You find imperfections in everything.",

	"Crusader" => "All action must serve XXXcgPossessiveXXX goal and inspire others likewise.",

	"Curmudgeon" => "Cynicism is the main means of operation.",

	"Defender" => "You stand guard over that for which you care.",

	"Demagogue" => "Incite others to XXXcgPossessiveXXX side using their fears and prejudices.",

	"Deviant" => "The status quo is for suckers.",

	"Director" => "Order is the name of the game.",

	"Dreamer" => "Focus on the loftiness of XXXcgPossessiveXXX goals, not their practicality.",

	"Eccentric" => "Strange times call for strange behavior/attitudes.",

	"Engine" => "Utterly implacable, nothing sways you from XXXcgPossessiveXXX goal.",

	"Explorer" => "Seek new experiences and ideas.",

	"Evangelist" => "Whatever it is you have faith in, you must spread the word.",

	"Fanatic" => "One cause, full support for it.",

	"Gallant" => "A rogue to themselves, a jerk to most.",

	"Healer" => "Ease the pain and suffering of the afflicted.",

	"Honest-Abe" => "The simple things in life are best.",

	"Jester" => "In the school of life, you are the class clown.",

	"Jobsworth" => "The routine is the only comfortable way to exist.",

	"Judge" => "Brutal honesty results in improvements.",

	"Loner" => "Company makes for uncomfortable situations.",

	"Manipulator" => "It's fun to tweak the actions of others.",

	"Martyr" => "The sacrifice of one is beneficial to others.",

	"Masochist" => "It ain't good until it hurts.",

	"Meddler" => "You know what's best for everyone.",

	"Mediator" => "Balance is the best way.",

	"Monger" => "You value only one thing, be it money, fame, power, etc.",

	"Monster" => "knows she is a creature of darkness and acts like it.",

	"Non-Partisan" => "Avoid external preconceptions, judge things/people for XXXcgPossessiveXXXself.",

	"Optimist" => "Life is good. Live it.",

	"Paragon" => "Stick to XXXcgPossessiveXXX code to provide an example to the rest.",

	"Pedagogue" => "Learning is what life is all about.",

	"Penitent" => "There is no right to exist. It must be earned.",

	"Perfectionist" => "Mistakes cannot be made.",

	"Plotter" => "Nothing can be done right without a plan.",

	"Poltroon" => "Someone cannot shoot at a target they do not have.",

	"Praise-Seeker" => "The opinions of others drive existence.",

	"Provider" => "Your focus is XXXcgPossessiveXXX family's well-being.",

	"Rebel" => "The establishment is a joke.",

	"Rogue" => "Only one thing matters to the Rogue: herself. To each his own.",

	"Soldier" => "Your firm resolve under pressure keeps the team together.",

	"Stoic" => "All hardships must be endured with calm.",

	"Survivor" => "Perserverence is the only way to get ahead in life.",

	"Sycophant" => "Let others do the hard work and live on praise for it.",

	"Traditionalist" => "The old ways are the best ways.",

	"Thrill-Seeker" => "Take a chance on everything.",

	"Trickster" => "Find the absurd in everything.",

	"Vigilante" => "Decide and dispense justice XXXcgPossessiveXXXself.",

	"Visionary" => "There is something more to life and this existence."

];

$aarTraitDesc = [

	"No" => " Value Selected",


	"Addict" => "Whatever XXXcgPossessiveXXX fix is, XXXcgSubjectiveXXX HAS TO have it.",

	"Adherent" => "Stay true to XXXcgPossessiveXXX goals/beliefs no matter what.",

	"Adjudicator" => "Pronounce the solutions to others' problems.",

	"Advisor" => "Your wise counsel is sought out.",

	"Analyst" => "Collection and study of information brings understanding.",


"Architect" => "Your sense of purpose goes beyond XXXcgPossessiveXXX own needs; you try to create something of lasting value for those who will come after you. People need many things, and you gain satisfaction by providing whatever you can. You are the type of person who makes an effort to build something of value; to found a town, create a company or in some way leave a lasting legacy. Many American pioneers were Architects by Nature.",


"Artist" => "Inspire, challenge or provoke others with XXXcgPossessiveXXX works.",


"Autocrat" => "You must have complete control of the situation, complete control over those around you and as much control over fate as you possibly can. Control is the only thing you understand; it is what you worship. Authority is what you desire, and it is what you gain when you have control. The more authority you have, the more control you gain. One hand feeds the other. Others may consider you domineering, but they just aren't up for the job. You are the only one who can do it.",


"Autist" => "You hide XXXcgPossessiveXXX secrets from others. Even more importantly, you hide XXXcgPossessiveXXX true self. Anyone who understands you can hurt you, so no one must ever see the real you, or even come close. Give away as little of XXXcgPossessiveXXXself as possible, adopt a false personality if you like, but just make sure no one discovers the truth about you. Knowledge is power, and those who know you can do anything they like to you.",


"Avant-Garde" => "You must always be in the forefront, always the first with a piece of news, a dance or fashion trend, or a discovery in the arts. Nothing pains you more than hearing news secondhand, or someone else telling you about a hot new band. New discoveries are XXXcgPossessiveXXX life, and you devote a great deal of time and effort to keeping up with things. After all, if XXXcgSubjectiveXXX\'s not in the forefront, XXXcgSubjectiveXXX\'s nowhere.",


	"Barbarian" => "Civilization is the crutch of the weak",


	"Believer" => "You must convince others of the Truth only you know.",


"Bon Vivant" => "Life is pointless, shallow and meaningless---so have as good a time as possible. Rome may burn, but you shall drink wine and sing songs. A hedonist, sensualist, sybarite and party animal, the words austere, self-denial and self-discipline have no place in XXXcgPossessiveXXX life. You much prefer the concept of instant gratification. Still, you don\'t mind a little hard work as long as a good time awaits you upon completion. most Bon Vivants have low Self-Control, for they so dearly love excess.",


"Bravo" => "You are known as a bully, a ruffian and a tough, and delight in tormenting the weak. Things must always go XXXcgPossessiveXXX way, and you do not tolerate those who cross you. Power and might are all you respect; indeed, you heed only those who can prove their power to you. You see nothing wrong with forcing XXXcgPossessiveXXX will upon others. There is nothing you like better than to persecute, antagonize, heckle and intimidate those for whom you have contempt---and of them there are many. The emotions of kindness and pity are not completely foreign to you, but you hide from XXXcgPossessiveXXX own sense of weakness through cruelty to others. While most Bravos despise the weak, a few become their protectors.",


"Caregiver" => "You always try to help those around you, struggling to make a difference in the needs and sorrows of the unfortunate. People around you depend on XXXcgPossessiveXXX stability and strength to keep them steady and centered. You are the one people turn to when they have a problem.",


"Cavalier" => "You are as bold, intrepid, valiant and fearless as you need to be to complete XXXcgPossessiveXXX duty. You are the hero who tries to live up to glorious ideals and codes of justice. By protecting that which is good, you seek to preserve the society that made you what you are. If XXXcgPossessiveXXX Nature is Cavalier, and XXXcgPossessiveXXX Humanity ever falls below four, you have to choose a new Nature. You probably hate Deviants, though you may not always recognize them.",


"Child" => "You are still immature in personality and temperament: a kid who never grew up. Though you can (hopefully) care for XXXcgPossessiveXXXself, you prefer the security of being watched over by others. Often you seek out someone to look out for you---a caretaker of sorts. Some see you as a spoiled brat, while others see you as an innocent cherub unaffected by the evils of the world. This is a very common archetype for Kindred who were created when they were young and subsequently matured mentally, but not emotionally.",




	"Celebrant" => "Pursue excitement in all things.",




"Competitor" => "You are driven by the need to win at all costs. The thrill of victory is the only thrill you recognize; it is the thing that drives you. You see life as a contest and society as a dichotomy of winners and losers. You believe all the macho business proverbs: \"if XXXcgSubjectiveXXX\'s not the lead dog, the view never changes,\" \"there are no prizes for second place", "eat or be eaten.\" You try to turn every situation into a contest of some kind, and it is the only way you can relate to anything. You are capable of cooperating with others, but only by turning the group interactions into another contest: you must be the leader, or the most productive, or the most indispensable, or the best liked. ANYTHING, as long as it means you win in some way or another.",


"Confidant" => "You understand people, and, more importantly, you like them. You are a facilitator who listens and advises. People confess to you and in return you give them advice, most of which is good (though sometimes XXXcgPossessiveXXX advice is more for XXXcgPossessiveXXX own benefit than for that of the recipient). You are very interested in other people, and who and what they are.",


"Conformist" => "You are a follower. Taking charge is just not XXXcgPossessiveXXX style. It is easier for you to adapt, attune, adjust, comply and reconcile XXXcgPossessiveXXXself to whatever new situation you find XXXcgPossessiveXXXself in. You flit to the brightest star, the person whom you feel to be the best, throwing XXXcgPossessiveXXX lot in with him. It is both difficult and distasteful for you to go against the flow or rebel. You hate inconsistence and instability, and know that by supporting a strong leader, you help prevent chaos from occurring. All stable groups need some kind of Conformist.",


"Conniver" => "What\'s the sense of working hard when you can get something for nothing? Why drudge when, just by talking, you can get what you want? You always try to find the easy way out, the fast track to success and wealth. Some people might call what you do swindling or even outright theft, but you know that you only do what everyone else does; you just do it better. Additionally, it\'s a game, and you get great pleasure out of outwitting someone. Connivers play many roles, so you may be a thief, a swindler, a street waif, an entrepreneur, a con man, or just a finagler.",


"Critic" => "Nothing in the world should be accepted without thorough scrutiny and examination. Nothing is ever perfect, and the blemishes must be pointed out in order for the good to be truly known. Your standards are high for everything, and you insist on their being met. You encourage the same ideals in others, because laxity and low standards reduce the quality of life for everyone. Others will thank you later, once they discover the purity of XXXcgPossessiveXXX perspective. You seek out and expose the imperfections in every person or thing you encounter. You are never satisfied with anything that is less than perfect, unless it is within XXXcgPossessiveXXXself (after all, XXXcgSubjectiveXXX\'s not a perfectionist).",


"Curmudgeon" => "You are an irascible, churlish person at heart, taking everything seriously and finding little humor in life (though you may have a wickedly barbed wit). Cynicism is XXXcgPossessiveXXX middle name; it is the tool with which you judge everything in life. You have a very well-defined understanding of how things really work, especially when they involve the circus of human endeavor. Long ago the foolish actions of others ceased to surprise you.",





	"Defender" => "You stand guard over that for which you care.",

	"Demagogue" => "Incite others to XXXcgPossessiveXXX side using their fears and prejudices.",







"Deviant" => "There are always people who don\'t fit in, and you are such a miscreant. Your beliefs, motivations and sense of propriety are the complete antithesis of the status quo. You are not so much an aimless rebel as an independent thinker who does not belong in the society in which you were raised. You don\'t give a damn about other people\'s morality, but you do adhere to XXXcgPossessiveXXX own strange code of conduct. Deviants are typically irreverent, and some have truly bizarre tastes and desires.",


"Director" => "You despise chaos and disorder, and tend to take control and organize things in order to suppress anarchy. You like to be in charge, live to organize and habitually strive to make things work smoothly. You trust XXXcgPossessiveXXX own judgment implicitly and tend to think of things in black-and-white terms: \"This won\'t work,\" \"You're either for me or against me,\" \"There are two ways to do this---my way and the wrong way.\"",




	"Dreamer" => "Focus on the loftiness of XXXcgPossessiveXXX goals, not their practicality.",

	"Eccentric" => "Strange times call for strange behavior/attitudes.",

	"Engine" => "Utterly implacable, nothing sways you from XXXcgPossessiveXXX goal.",

	"Explorer" => "Seek new experiences and ideas.",

	"Evangelist" => "Whatever it is you have faith in, you must spread the word.",




"Fanatic" => "You are consumed by a cause; it is the primary force in XXXcgPossessiveXXX life, for good or ill. Every ounce of blood and passion you possess is directed towards it; in fact, you feel very guilty about spending time on anything else. You will let nothing stand in XXXcgPossessiveXXX way---nothing that you cannot overcome, in any case. You and those around you may suffer, but XXXcgPossessiveXXX cause is everything---the end justifies the means. Before the game begins, make sure you describe XXXcgPossessiveXXX cause, and define how it may affect XXXcgPossessiveXXX behavior.",


"Gallant" => "You are as flamboyant as you are amoral; some see you as a rogue, a Don Juan, a rake, a paramour, or just a lounge lizard---but you see XXXcgPossessiveXXXself as all of the above. A consummate actor who loves to make as big show of things as possible, nothing attracts XXXcgPossessiveXXX interest more than an appreciative audience. You love people and you love to impress them even more. Though you may indeed be a superior lover, you enjoy the chase almost as much as you enjoy the act. Gallants vary widely in temperament and ambition, holding in common little more than their love of attention.",



	"Healer" => "Ease the pain and suffering of the afflicted.",



"Honest-Abe" => "You have a moderate temperament, and refrain at all cost from telling lies and stealing from others. You were brought up to live honestly and openly, and to be good to others; you have lived XXXcgPossessiveXXX life (and unlife) by these simple truths ever since. You are not a dogmatist and do not insist that others live as you do, nor have you constructed a complicated set of rules for XXXcgPossessiveXXXself. You are flexible in XXXcgPossessiveXXX behavior, but always carefully evaluate XXXcgPossessiveXXX actions against XXXcgPossessiveXXX beliefs.",


"Jester" => "You are the fool, idiot, quipster, clown or comic, forever making fun of both XXXcgPossessiveXXXself and others. You constantly seek the humor in any situation, and strive always to battle the tides of depression inside XXXcgPossessiveXXXself. You hate sorrow and pain, and constantly try to take others' minds off the dark side of life. Sometimes you'll do nearly anything to forget pain exists. Your particular brand of humor might not always impress XXXcgPossessiveXXX friends, but it makes you feel better. Some Jesters manage to escape pain and are truly happy, but most never find release.",


"Jobsworth" => "You are dedicated to the unbroken routine of XXXcgPossessiveXXX existence, and refuse to do anything that compromises XXXcgPossessiveXXX routine and established practices. No matter how urgent or deserving an individual case may be, the preservation of established practices and routines is more important. Individual decisions and considerations are fallible, whereas routines and established procedures are the distilled wisdom of years or decades of decision-making. Routines are what separates order from chaos. Make an exception once, and it sets a dangerous precedent; make an exception twice, and the door to anarchy is opened.",


"Judge" => "As a facilitator, moderator, arbitrator, conciliator, and peacemaker, you always seek to make things better. You pride XXXcgPossessiveXXXself on XXXcgPossessiveXXX rationality, XXXcgPossessiveXXX judgment and XXXcgPossessiveXXX ability to deduce a reasonable explanation when given the facts. You struggle to promote truth, but you understand how difficult it is to ascertain. You respect justice, for that is the way in which truth can reign. In XXXcgPossessiveXXX view, people are resources, albeit ones that are most difficult to manage and employ. You hate dissension and arguments, and shy away from dogmatism. Sometimes Judges make good leaders, though a lack of vision can sometimes cause them to maintain the status quo instead of searching for a better way.",


"Loner" => "You are the type of person who is always alone, even in the midst of a crowd. You are the wanderer, hunter and lone wolf. Though others might think of you as lonely, forsaken, isolated or remote, in truth you prefer XXXcgPossessiveXXX own company to that of others. There are many different reasons why this might be so: you don\'t understand people, you understand people too well, people dislike you, people like you too much, or you are simply lost in XXXcgPossessiveXXX own thoughts. Your reasons are XXXcgPossessiveXXX own.",


"Manipulator" => "You have always been fascinated by others. Why do people behave as they do? What thoughts and emotions affect their actions? The cognitive process that influences the choices people make intrigue you. Sometimes just asking people questions about their actions can yield important information, but often people do not truly understand their own motivations and concerns. In these cases, it is far easier to set up situations, experiments, if you will, to see how people behave. You attempt to manipulate these situations for XXXcgPossessiveXXX personal advantage, in order to discover more information about XXXcgPossessiveXXX chosen subjects. Some might call these experiments cruel, but to you it is mere scientific necessity.",


"Martyr" => "All possess the martyr instinct, but few act upon it. Even fewer live the life of a Martyr, but you are such a one. Your desire for self-sacrifice stems either from a low self-esteem, a feeling of a lack of control, or a profoundly developed sense of love. You are able to endure long-lasting and severe suffering because of XXXcgPossessiveXXX beliefs and ideals. At worst, a Martyr expects sympathy and attention because of his or her suffering, and may even feign or exaggerate pain or deprivation. At best, a Martyr will choose to suffer injury or even the Final Death rather than renounce his religion, beliefs, principles, cause or friends.",


"Masochist" => "You like to push the boundaries and try to see how much you can take... how much pain you can tolerate before you collapse. You gain a certain satisfaction from suffering humiliation, depravation and even mutilation, especially when you are the cause of XXXcgPossessiveXXX pain and have some control over it. You know that XXXcgPossessiveXXX need is somewhat perverse, but you know you aren\'t crazy. This is just the way you are.",



		"Meddler" => "You know what\'s best for everyone.",




"Mediator" => "The world is full of people who want things; sometimes people want the exact same things. Some people have what other people want and would be willing to talk about working out a deal, but just don\'t know how to start. These people often have immense trouble finding and communicating with each other. That is where you come in. You are dedicated to mediating between people, fulfilling needs; smoothing over disputes, and generally helping people talk to one another. You are the diplomat, the middle child, the perpetual person in the middle.",



	"Monger" => "You value only one thing, be it money, fame, power, etc.",

	"Monster" => "knows she is a creature of darkness and acts like it.",

	"Non-Partisan" => "Avoid external preconceptions, judge things/people for XXXcgPossessiveXXXself.",



"Optimist" => "\"Everything always turns out for the best.\" That is the motto of XXXcgPossessiveXXX life, and you know if you can just stay cheerful and stop worrying, XXXcgPossessiveXXX problems will never be with you forever. Some call you a fool, but even they have to admit XXXcgSubjectiveXXX\'s happier than they are. Certainly you'll encounter difficulties from time to time, but there\'s no sense in worrying XXXcgPossessiveXXXself to death in advance. Don\'t worry, be happy, and have a nice day.",



	"Paragon" => "Stick to XXXcgPossessiveXXX code to provide an example to the rest.",



"Pedagogue" => "XXXcNameXXX has  been a few places, seen a few things, and picked up a thing or two along the way, and you like to tell everyone about what XXXcgSubjectiveXXX has learned. Teaching is XXXcgPossessiveXXX avocation, if not necessarily XXXcgPossessiveXXX profession. In XXXcgPossessiveXXX time XXXcgSubjectiveXXX has seen inexperience and ignorance lead to all kinds of misery and misfortune, and it pains you too much to stand by and watch this occur. You are dedicated to passing on what you have learned for the benefit of others, not only skills and knowledge, but also the less tangible assets of wisdom and experience. If given the chance you can lecture others for hours.",


"Penitent" => "You are unworthy. You are sinful. You are base, vile and lacking in virtue. You have no right to exist and are utterly beyond redemption. Either because of a low self-image or because of a spectacular trauma in XXXcgPossessiveXXX past, you feel compelled to spend XXXcgPossessiveXXX life making up for what you are, what you lack or what you have done. You owe it to Creation at large to offer repentance for the crime of XXXcgPossessiveXXX existence. You struggle nightly to make amends for XXXcgPossessiveXXX weakness, and XXXcgPossessiveXXX nightly dream is to be able, at last, to overcome it. But you know you are weak and beyond hope.",


"Perfectionist" => "You can\'t stand imperfection, not in others and certainly not in XXXcgPossessiveXXXself. Neither can you tolerate those who do not do everything they can to do their best, to make everything neat and proper and right in their lives. Though you may be strict with others, it is with XXXcgPossessiveXXXself that you are most critical. Everything must always be in its place, and you must always do the best and be the best.",


"Plotter" => "Everything you do is planned. Very little springs from you spontaneously. Your plans are often long and involved, sometimes extending beyond the lives of the mortals involved in them. Details must be exact, for you believe any deviation could bring ruin. You try to plan everything in XXXcgPossessiveXXX life; each thing you do must accomplish something in the greater scheme Deviation from routine, however, is bothersome, not traumatic. You are organized, not deranged. You tend to be neat and precise in everything you do.",


"Poltroon" => "Meeting trouble (or anything else) head-on is the tactic of fools and optimists. The sensible way to deal with trouble is to deny it a target. While some people might accuse you of sticking XXXcgPossessiveXXX head in the sand, they do have to admit that it has remained on XXXcgPossessiveXXX shoulders for quite some time, and looks like it will continue to do so indefinitely. You never confront what you can evade, and never face anything unless there is no other option. Courage is not high on XXXcgPossessiveXXX list of virtues, but then the line between courage and folly is virtually nonexistent to XXXcgPossessiveXXX eyes.",


"Praise-Seeker" => "Your self-worth is based entirely on the opinions of others. You crave approval and praise, and will go to extreme lengths to get such, even risking XXXcgPossessiveXXXself and things you love. Unlike the Sycophant, you do not think of protection, and have no thought of using others' good opinions to XXXcgPossessiveXXX own advantage, you simply crave praise and approval for their own sake, so you can feel good about XXXcgPossessiveXXXself.",


"Rebel" => "You are a malcontent, iconoclast and free-thinking recalcitrant. You are so independent-minded and free-willed that you are unwilling to join any particular cause or movement. You are just XXXcgPossessiveXXXself and only desire the freedom to be XXXcgPossessiveXXXself. You do not make a good follower and aren\'t usually a very good leader either (unless XXXcgPossessiveXXX followers are willing to go wherever you lead). You tend to be insubordinate to authority to the point of stupidity.",



	"Soldier" => "Your firm resolve under pressure keeps the team together.",

	"Stoic" => "All hardships must be endured with calm.",



"Survivor" => "No matter what, you always manage to survive. You can endure, pull through, recover from, outlast and outlive nearly any circumstance. When the going gets tough, you get going. You never say die, and never give up. Ever. Nothing angers you as much as a person who doesn\'t struggle to make things better, or who surrenders to the nameless forces of the universe.",


"Sycophant" => "In the grand scheme of things, you are small and weak and unfit for survival. Your best hope is to find someone who is more powerful than you are and persuade him to take care of you. In return you will serve, admire and follow him. You will do anything he says, unless it puts you in great risk. In any type of uncertain situation, you will attach XXXcgPossessiveXXXself to the strongest-seeming person, siding with him, performing various barely necessary services and generally trying to ingratiate XXXcgPossessiveXXXself. Thereby you hope to earn some kind of protection. There is no limit to the depths to which you will lower XXXcgPossessiveXXXself in order to be accepted, and you have no pride.",


"Traditionalist" => "You are an orthodox, conservative and extremely traditional individual. What was good enough for you when you were young is good enough for you now. You almost never change. In general you are opposed to change for the sake of change---what point is there in that? You may be seen by some as a miser, a reactionary or simply an old fogy. You strive to always preserve the status quo.",


"Thrill-Seeker" => "You live for that moment of danger when the adrenalin kicks in and you feel truly alive. Skydiving, bungee jumping and leaping across roofs on a dare are all just par for the course. As a junkie is addicted to his particular brand of poison, you are addicted to danger. Unlike most, you go out of XXXcgPossessiveXXX way to place XXXcgPossessiveXXXself in dangerous situations that test the limits of XXXcgPossessiveXXX abilities. You train and work for these situations, and then you seek them out. This is what sets you apart from the teeming masses of paranoid dullards who shuffle around, hiding from their own shadows.","Survivor" => "No matter what, you always manage to survive. You can endure, pull through, recover from, outlast and outlive nearly any circumstance. When the going gets tough, you get going. You never say die, and never give up. Ever. Nothing angers you as much as a person who doesn\'t struggle to make things better, or who surrenders to the nameless forces of the universe.",


"Sycophant" => "In the grand scheme of things, you are small and weak and unfit for survival. Your best hope is to find someone who is more powerful than you are and persuade him to take care of you. In return you will serve, admire and follow him. You will do anything he says, unless it puts you in great risk. In any type of uncertain situation, you will attach XXXcgPossessiveXXXself to the strongest-seeming person, siding with him, performing various barely necessary services and generally trying to ingratiate XXXcgPossessiveXXXself. Thereby you hope to earn some kind of protection. There is no limit to the depths to which you will lower XXXcgPossessiveXXXself in order to be accepted, and you have no pride.",


"Traditionalist" => "You are an orthodox, conservative and extremely traditional individual. What was good enough for you when you were young is good enough for you now. You almost never change. In general you are opposed to change for the sake of change---what point is there in that? You may be seen by some as a miser, a reactionary or simply an old fogy. You strive to always preserve the status quo.",


"Thrill-Seeker" => "You live for that moment of danger when the adrenalin kicks in and you feel truly alive. Skydiving, bungee jumping and leaping across roofs on a dare are all just par for the course. As a junkie is addicted to his particular brand of poison, you are addicted to danger. Unlike most, you go out of XXXcgPossessiveXXX way to place XXXcgPossessiveXXXself in dangerous situations that test the limits of XXXcgPossessiveXXX abilities. You train and work for these situations, and then you seek them out. This is what sets you apart from the teeming masses of paranoid dullards who shuffle around, hiding from their own shadows.",



	"Trickster" => "Find the absurd in everything.",

	"Vigilante" => "Decide and dispense justice XXXcgPossessiveXXXself.",



"Visionary" => "There are very few who are brave or strong or imaginative enough to look beyond the suffocating embrace of society and mundane thought and see something more. Society treats such people with both respect and contempt---for it is the Visionary who perverts as well as guides society into the future. You may be a spiritualist, shaman, New Ager, mystic, philosopher or inventor, but whatever you are, you are always conventional imagination and create new possibilities. Though you might have XXXcgPossessiveXXX head in the clouds and are often of an impractical bent, you are filled with new ideas and perceptions."

];









$aarWeather = [
1 => array("weatherDB"=>"GOOD", "description"=>"Clear"),

2 => array("weatherDB"=>"FAIR", "description"=>"Partly Overcast"),
3 => array("weatherDB"=>"FAIR", "description"=>"Overcast"),

4 => array("weatherDB"=>"MILD", "description"=>"Cloudy"),
5 => array("weatherDB"=>"MILD", "description"=>"Cloudy, Occasional Drizzle"),

6 => array("weatherDB"=>"OVERCAST", "description"=>"Overcast"),
7 => array("weatherDB"=>"OVERCAST", "description"=>"Partly Foggy"),
8 => array("weatherDB"=>"OVERCAST", "description"=>"Foggy"),

9 => array("weatherDB"=>"STORMY", "description"=>"Drizzle"),
10 => array("weatherDB"=>"STORMY", "description"=>"Rain"),
11 => array("weatherDB"=>"STORMY", "description"=>"Thunder & Lightning"),
12 => array("weatherDB"=>"STORMY", "description"=>"Snow"),
13 => array("weatherDB"=>"STORMY", "description"=>"Icestorm"),

14 => array("weatherDB"=>"HAZARDOUS", "description"=>"Blizzard"),
15 => array("weatherDB"=>"HAZARDOUS", "description"=>"Hurricane"),
16 => array("weatherDB"=>"HAZARDOUS", "description"=>"Partial Eclipse"),
17 => array("weatherDB"=>"HAZARDOUS", "description"=>"Full Eclipse")
];

$heightFeet = [
	"", "1&#39;", "2&#39;", "3&#39;", "4&#39;", "5&#39;", "6&#39;", "7&#39;", "8&#39;", "9&#39;", "0&#39;"
];

$heightInch = [
	"", " 1&quot;", " 2&quot;", " 3&quot;", " 4&quot;", " 5&quot;", " 6&quot;", " 7&quot;", " 8&quot;", " 9&quot;", "10&quot;", "11&quot;"
	];



$characterWeight1 = [
"",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"0"];

$characterWeight2 = [
"",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"0"];

$characterWeight3 = [
"",
"1",
"2",
"3",
"4",
"5",
"6",
"7",
"8",
"9",
"0"];


$aarCountryName = [
	"United States",
	"Afghanistan",
	"Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua And Barbuda", "Argent in.", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia Hercegov in.", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Byelorussian SSR", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "Ch in.", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, The Democratic Republic Of", "Cook Islands", "Costa Rica", "Cote DIvoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Czechoslovakia", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Great Britain", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemela", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and McDonald Islands", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic Of)", "Iraq", "Ireland", "Isle Of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic Peoples Republic Of", "Korea, Republic Of", "Kuwait", "Kyrgyzstan", "Lao Peoples Democratic Republic", "Latvia", "Lebanon", "Latveria", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States Of", "Moldova, Republic Of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Neutral Zone", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Helena", "Saint Kitts And Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and The Grenadines", "Samoa", "San Mar in.", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and The Sandwich Islands", "Sokovia", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province Of Ch in.", "Tajikista", "Tanzania, United Republic Of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukra in.", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "USSR", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen, Republic of", "Yugoslavia", "Zaire", "Zambia", "Zimbabwe", "Other"];

$countryAbbr = [
	"US", "AF", "AL",
	"DZ", "AS", "AD", "AO", "AI", "AQ", "AG", "AR", "AM", "AW", "AU", "AT", "AZ", "BS", "BH", "BD", "BB", "BY", "BE", "BZ", "BJ", "BM", "BT", "BO", "BA", "BW", "BV", "BR", "IO", "BN", "BG", "BF", "BI", "BY", "KH", "CM", "CA", "CV", "KY", "CF", "TD", "CL", "CN", "CX", "CC", "CO", "KM", "CG", "CD", "CK", "CR", "CI", "HR", "CU", "CY", "CZ", "CS", "DK", "DJ", "DM", "DO", "TP", "EC", "EG", "SV", "GB", "GQ", "ER", "EE", "ET", "FK", "FO", "FJ", "FI", "FR", "GF", "PF", "TF", "GA", "GM", "GE", "DE", "GH", "GI", "GB", "GR", "GL", "GD", "GP", "GU", "GT", "GG", "GN", "GW", "GY", "HT", "HM", "HN", "HK", "HU", "IS", "IN", "ID", "IR", "IQ", "IE", "IM", "IL", "IT", "JM", "JP", "JE", "JO", "KZ", "KE", "KI", "KP", "KR", "KW", "KG", "LA", "LV", "LB", "LS", "LR", "LY", "LI", "LT", "LU", "MO", "MK", "MG", "MW", "MY", "MV", "ML", "MT", "MH", "MQ", "MR", "MU", "YT", "MX", "FM", "MD", "MC", "MN", "MS", "MA", "MZ", "MM", "NA", "NR", "NP", "NL", "AN", "NT", "NC", "NZ", "NI", "NE", "NG", "NU", "NF", "MP", "NO", "OM", "PK", "PW", "PA", "PG", "PY", "PE", "PH", "PN", "PL", "PT", "PR", "QA", "RE", "RO", "RU", "RW", "SH", "KN", "LC", "PM", "VC", "WS", "SM", "ST", "SA", "SN", "SC", "SL", "SG", "SK", "SI", "SB", "SO", "ZA", "GS", "ES", "LK", "SD", "SR", "SJ", "SZ", "SE", "CH", "SY", "TW", "TJ", "TZ", "TH", "TG", "TK", "TO", "TT", "TN", "TR", "TM", "TC", "TV", "UG", "UA", "AE", "UK", "US", "UM", "UY", "SU", "UZ", "VU", "VA", "VE", "VN", "VG", "VI", "WF", "EH", "YE", "YU", "ZR", "ZM", "ZW"];

$aarMyTips = [
	'ra' => '<a href="#" rel="tooltip"  title="A measure of a character\'s raw innate combat ability: Used to determine if the character lands a blow in hand-to-hand (called Slugfest) combat
	&bull; Used to determine if a character evades a blunt attack
	&bull; Used to determine if a multiple combat attack or other FEAT involving hand-to-hand combat is successful
	&bull; Used to determine the secondary ability known as Health " >Rank</a>',

	'fi' => '<a href="#" rel="tooltip"  title="A measure of a character\'s raw innate combat ability: Used to determine if the character lands a blow in hand-to-hand (called Slugfest) combat
	&bull; Used to determine if a character evades a blunt attack
	&bull; Used to determine if a multiple combat attack or other FEAT involving hand-to-hand combat is successful
	&bull; Used to determine the secondary ability known as Health " >Fighting</a>',

	'ag' => '<a href="#" rel="tooltip"  title="A measure of dexterity and nimbleness
	&bull; Used to determine if the character hits with a thrown or aimed weapon at a distance
	&bull; Used to determine if the character dodges a missile attack
	&bull; Used to determine if the character catches an object, holds onto a ledge, or successfully performs actions that require quick action or co-ordination
	&bull; Used to determine how well a character handles a vehicle
	&bull; Used to determine the secondary ability known as Health" >Agility</a>',

	'st' => '<a href="#" rel="tooltip"  title="A measure of physical muscle power
	&bull; Used to determine damage inflicted in slugfest combat
	&bull; Used to determine success and damage in wrestling combat and success in Grabbing, Escaping, and Blocking maneuvers
	&bull; Used to determine success in destroying materials
	&bull; Used to determine if a character can lift a heavy object or perform other acts that require physical power
	&bull; Used to determine the secondary ability known as Health" >Strength</a>',

	'end' => '<a href="#" rel="tooltip"  title="•	A measure of personal toughness and physical resistance  <br />
	&bull; Used to determine normal moving speed
	&bull; Used to determine success in charging attacks
	&bull; Used to determine success in avoiding the effects of disease, poison, and gas
	&bull; Used to determine success in matters that require the character to perform actions over a long period of time, such as holding one\'s breath
	&bull; Used to determine the secondary ability known as Health
	&bull; Used to resist the effects of Slams, Stuns, and Kill results directed against the hero
	&bull; Used td determine the amount of Health regained by a wounded individual" >Endurance:</a>',

	're' => '<a href="#" rel="tooltip"  title="•	A measure of intelligence and the capacity for logical thought
	&bull; Used to determine the character\'s success in building things
	&bull; Used to determine the character\'s success in understanding unknown technology and languages
	&bull; Used to determine the secondary ability known as Karma" >Reason</a>',

	'int' => '<a href="#" rel="tooltip"  title="•	A measure of wisdom, wits, common sense, and battle reflexes
	&bull; Used to discover clues
	&bull; Used to determine who may act first in combat (see Initiative)
	&bull; Used to detect hidden or potentially dangerous items, as well as in situations where the the character plays a hunch
	&bull; Used to resist effects of emotion control powers, spells, and abilities
	&bull; Used to determine the secondary ability known as Karma" >Intuition</a>',

	'psy' => '<a href="#" rel="tooltip"  title="•	A measure of mental strength and willpower
	&bull; Used to show resistance to mental and will-dominating attacks
	&bull; Used to determine resistance to magical attacks
	&bull; Used to determine initial Magical abilities for those characters who wield magic  <br />
	&bull; Used to determine the secondary ability known as Karma" >Psyche</a>',

	'pow' => '<a href="#" rel="tooltip"  title=" description to come. sorry" >Power Rank</a>',

	'sk' => '<a href="#" rel="tooltip"  title="•	A measure of mental strength and willpower
	&bull; Used to show resistance to mental and will-dominating attacks
	&bull; Used to determine resistance to magical attacks
	&bull; Used to determine initial Magical abilities for those characters who wield magic
	&bull; Used to determine the secondary ability known as Karma" >Skill Level</a>'


];



/*
Health:
•	Used to determine the amount of physical damage the character can absorb before losing consciousness and potentially dying
•	Does not have a rank or rank number, but rather is the sum of the rank numbers of the character's Fighting, Agility, Strength, and Endurance
•	Lost through combat, accidents, attacks, and other potentially dangerous and life-threatening situations
•	Recovered after damage is taken, 10 turns after damage is inflicted
•	Regained through normal healing by the Endurance rank number of points per day (in crisis situations, Health may be figured as regained by the hour or turn. See the table under Healing)
•	If reduced to 0, the character is unconscious and may begin to lose Endurance ranks (see Life, Death, and Health).



Karma:
•	Used by the hero as a measure of experience, allowing the hero to perform actions that may otherwise be impossible
•	Does not have a rank or rank number. Starting Karma is determined when the character is created by the sum of the Initial rank numbers of the character's Reason, Intuition, and Psyche
•	Gained through performing heroic and basically "honorable" acts •	Lost through performing selfish, harmful, or "dishonorable" acts
•	May be spent by the player-character to perform actions otherwise impossible or unlikely. These include modifying die rolls, staying alive, building things, using magical abilities, and raising the hero's ability rank numbers and ranks through advancement

Resources:
•	A measure of how wealthy a character is, and how the character may use that wealth
•	Generated when the character is created
•	Presented as a rank with a rank number (replacing the Resource Points of the MARVEL SUPER HEROES Original Set)
•	Used to determine if a character can afford a particular item or service
•	See under Resource FEATs in the next chapter for full effects of Resources



Popularity:
•	A measure of the character's reputation in that character's normal environment
•	Generated when the character is created
•	Represented as a rank and rank number. Heroes generally have positive Popularity. Villains generally have negative Popularity
•	Used to determine reactions of large groups of people and neutral NPCs
Used to gain favors, information, and equipment from Contacts
*/





$arrCatAct = ['combat-powers',
	'defensive-powers',
	'detection-powers',
	'energy-control-powers',
	'energy-emission-powers',
	'faith',
	'illusions-powers',
	'lifeform-control-powers',
	'magic-powers',
	'matter-control-powers',
	'matter-conversion-powers',
	'matter-creation-powers',
	'mental-enhancement-powers',
	'physical-enhancement-powers',
	'restricted-powers',
	'self-alteration-powers',
	'travel-powers',
];

$arrCatTT = [
	"COMBAT:: Powers which enhance a characters fighting capabilities.",
	"DEFENSE:: Powers which afford a character some special means of protection from harm.",
	"DECTION:: Powers which allow a character to extend their awareness in some manner.",
	"ENERGY CONTROL::  Powers which allow a character influence the behavior of energy patterns.",
	"ENERGY EMISSION:: Powers which allow a character to produce some form of energy.",
	"FAITH:: Powers which can only be explained through acts of belief in a higher power then the character enacting them.",
	"ILLUSIONS:: Powers which allow a character to decieve the senses of other characters.",
	"LIFEFORM CONTROL::  Powers which allow a character to influence the behavior of lifeforms in some manner.",
	"MAGIC-LIKE:: Powers which appear to mimic that which typically may only be explained through magical means.",
	"MATTER CONTROL:: Powers which allow a character to directly control physical matter.",
	"MATTER CONVERSION:: Powers which allow a character to influence the material state of physical matter.",
	"MATTER CREATION:: Powers which allow a character ceate physical matter.",
	"MENTAL ENHANCEMENT:: Powers which enhance a characters mental or psychic capabilities in some manner.",
	"PHYSICAL ENHANCEMENT:: Powers which enhance a characters physical capabilities in some manner.",
	"RESTRICTED:: Powers, which have been restricted for one reason or another by staff.",
	"SELF-ALTERATION:: Powers which allow a character to significantly modify their form.",
	"TRAVEL:: Powers which affect the way inwhich a character can move within a storyline."
];

$arrCatName = [ 'Cbt', 'Dfn', 'Dct', 'ECn', 'EEn', 'Fth', 'Ill', 'Lfc', 'Mgc', 'MCl', 'MCl', 'MCn', 'Mtl', 'Phy', 'Rst*', 'SAt', 'Trl' ];
