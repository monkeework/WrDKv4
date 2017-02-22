<?php

/**
 * working out tags and stuff
 */

include './../_inc/config_inc.php';





	'CatID' => string '4' (length=1)
	'ThreadID' => string '11' (length=2)
	'UserID' => string '1' (length=1)
	'PostFeaturing' => string '' (length=0)

	'PostContent' => string 'Post info' (length=9)
	'PostSummary' => string 'summary info' (length=12)
	'PostType' => string '0' (length=1)
	'PostOrder' => string '2' (length=1)

	'PostRating' => string '0' (length=1)
	'CharID' => string '3' (length=1)
	'Proxy' => string '' (length=0)
	'PostPhaseOfDay' => string '0' (length=1)

	'PostWeather' => string '0' (length=1)
	'PostLocation' => string '' (length=0)
	'PostTimeOfDay' => string '' (length=0)
	'PostNotes' => string 'Notes info' (length=10)

	'PostTags' => string '' (length=0)

	'act' => string 'postInsert' (length=10)










	#STEP 1



	#$PostApproval 	= $_POST['PostApproval'];
	#$PostVisible 	= $_POST['PostVisible'];
	#$PostFrom 			= $_POST['PostFrom'];

	#PDO Setup needed vars...
	#$PostID 				= $_POST['PostID'];
	$CatID 					= $_POST['CatID'];
	$tID 						= $_POST['ThreadID'];
	$uID 						= $_POST['UserID'];

	$pFeaturing 		= $_POST['PostFeaturing'];
	$pContent 		  = $_POST['PostContent'];
	$pSummary 			= $_POST['PostSummary'];

	$pType 					= $_POST['PostType'];
	$pOrder 				= $_POST['PostOrder'];
	$pRating 				= $_POST['PostRating'];

	# !!! we wipe $cID out IF we have a proxy !!!
	$cID 						= $_POST['CharID'];
	# !!! we wipe $cID out IF we have a proxy !!!
	$cProxy 				= $_POST['Proxy'];
	$pPhase					= $_POST['PostPhaseOfDay'];

	$pWeather 			= $_POST['PostWeather'];
	$pLocation 			= $_POST['PostLocation'];
	$postTimeOfDay 	= $_POST['PostTimeOfDay'];

	$pNotes 				= $_POST['PostNotes'];
	$pTags 					= $_POST['PostTags'];




#step 3
	//build string for SQL insert with replacement vars, ?
	$sql = "INSERT INTO ma_Posts (
			ThreadID, CatID, UserID, CharID, PostType, PostOrder, PostRating, PostFeaturing, PostPhaseOfDay,
			PostTimeOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags
		)
		VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

#PDO Setup needed vars...
	#$PostID 				= $_POST['PostID'];
	$tID 						= $_POST['ThreadID'];
	$CatID 					= $_POST['CatID'];
	$uID 						= $_POST['UserID'];

	$cID 						= $_POST['CharID'];
	$pType 					= $_POST['PostType'];

	$pOrder 				= $_POST['PostOrder'];

	$pRating 				= $_POST['PostRating'];
	$pFeaturing 		= $_POST['PostFeaturing'];
	$pPhase					= $_POST['PostPhaseOfDay'];
,,
	$postTimeOfDay 	= $_POST['PostTimeOfDay'];
	$pWeather 			= $_POST['PostWeather'];

	$pLocation 			= $_POST['PostLocation'];
	$pContent 		  = $_POST['PostContent'];
	$pNotes 				= $_POST['PostNotes'];

	$pSummary 			= $_POST['PostSummary'];
	$pTags 					= $_POST['PostTags'];

	$cProxy 				= $_POST['Proxy'];




























