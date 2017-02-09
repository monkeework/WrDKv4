<?php
/*

NOTES:

I ran your code with the debugger active.  It made this much easier to spot.

You have too much code in your initial loop.  You are using the "foreach($aCharacterBank[0] as $data) {" to preprocess your data but you start dealing with it before you have finished processing your data.

Your call to array_unique is pointless as there's nothing that is ever done with the resulting array.

I assume the point of this function is to take all the data in $aCharacterBank, grab the names of all the characters that match the thread ID and then print them out.  To do this, you need two loops.  One to filter the data, and one to iterate over that filtered data to print it out.

Alternatively, you can do it with one loop, using an array as a hash map to determine whether or not you've already printed a character.  Rough example:

$seen = [];
foreach($aCharacterBank[0] as $data) {
	if($data['ThreadID'] == $threadID && !isset($seen[$characterID]) {
		echo "<a href=\"#\">$characterId</a>";
		$seen[$characterId] = true;
	}
}


I have three other emails from you today; did you get those solved or should I go back and look at them?


PS, my offer still stands for a get-together.

		 ------------
		 ------------
		 ------------


		 Sure, any time, just pick a day that isn't tomorrow.

Looks like hash map is the term Java uses for their implementation and hash table is the generic term.

This gets very CS very fast

https://en.wikipedia.org/wiki/Hash_table
https://en.wikipedia.org/wiki/Hash_table
https://en.wikipedia.org/wiki/Hash_table
https://en.wikipedia.org/wiki/Hash_table


Your aCharacterBank array is the perfect example for this.  Let's say you want to know the character ID of a given post ID.  Your array is arranged in a seemingly random order.  So to implement this function, here's what you have to do:

function getCharacterIdForPostId($aCharacterBank, $postId) {
	foreach($aCharacterBank as $data) {
		if($data['PostId'] == $postId) {
			return $data['CharId'];
		}
	}
	return null;
}

If we query for post 32, we only have to do one loop iteration before we find it.  If we query for post 51, we have to get all the way to the end of the list before we find it.  If we query for 99999, we'll get through the entire list and never find what we want. Assuming that each iteration of the loop takes the same amount of time, we can say that the runtime of this function in its worst case is n, where n is the number of elements in the array.

But what if I told you I can get the worst case scenario down to 1 loop iteration? Does it sound too good to be true?  It's not!  Instead, we declare the data differently:

$postData = [
	32 => 0,
	51 => 0,
];

Here, we set the array key to the post ID and the value of each element to the character ID.  But we can actually set the array values to anything we want, so let's replicate the same data:

$postData = [
	32 => ['ThreadID' => 0, 'CharID' => 0, 'PostOrder' => 0],
	51 => ['ThreadID' => 20, 'CharID' => 0, 'PostOrder' => 0],
];

Now if we want to find the Character ID for post 51, we just say:
if(isset($postData[51])) {
	echo $postData[51]['CharId'];
}
Or the thread ID for post 32:
if(isset($postData[32])) {
	echo $postData[32]['ThreadId'];
}


A quick note on hash tables: You'll probably be seeing stuff about "buckets".  Here's an example of how that might be used.

Let's say you're a hospital and you have a database of all your patients and who their primary care provider is.  You keep track of your patients by their social security number.  If it's a big hospital, you'll have thousands and thousands of patients and you can't store all that data in memory.  So you store it off on disk somewhere but the hash table helps you quickly get to the right spot for a certain patient.  Let's just say that this hospital is huge and has 10,000,000 patients.  If we just use the SSN as the key, in the worst case scenario we would have to iterate over ten million records to get to the patient we're looking for.  So instead we create a bucket for each of the parts of the SSN.  So when we go to look up the data for patient 456-78-9012, we take the first set of digits, 456, and look through our first list which contains the first three digits of all the SSNs of all our patients.  We end up at the 456 bucket and then have to look through 100 more buckets to find the 78 bucket.  Once we have that, there's only a thousand records to look through so we can iterate over those much quicker than if there were ten million to look through.

That may actually be pretty confusing without a diagram.  Don't worry if it doesn't make sense; it's not super important at this point.




*/

































/**
 * working out tags and stuff
 */

include './../_inc/config_inc.php';



	#get full index of possible character names and id's from current session
	$aCharacterBank = [];

	#$aCharChk = $_SESSION["charIndex"]; #array character check

	#select statement
	#$sql = "SELECT  `PostID`, `ThreadID`, `UserID`,`CharID`, `PostOrder` FROM `ma_posts` ORDER BY `ThreadID`";

	$sql = "SELECT  DISTINCT `ThreadID`, `PostID`, `CharID`, `PostOrder` FROM `ma_posts` ORDER BY `ThreadID`;";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#hold temporty data
		$aTempArray = [];

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$tID	   = (int)$row['ThreadID'];
			$pID  	 = (int)$row['PostID'];
			$cID  	 = (int)$row['CharID'];
			#$uID  	 = (int)$row['UserID'];
			$pOrder  = (int)$row['PostOrder'];


			#temp array
			$aTempArray = [];


/*

	Not sure what $aCharacterBank is since you don't show its declaration. But assuming it's defined as "$aCharacterBank = [];" somewhere above your select statement, this is what you really want (replace everything between "// get data..." and echo):

	$aCharacterBank[] = [
		'ThreadID'  => (int)$row['ThreadID'],
		'PostID'    => (int)$row['PostID'],
		'CharID'    => (int)$row['CharID'],
		'UserID'    => (int)$row['UserID'],
		'PostOrder' => (int)$row['PostOrder'],
	];

	Note the array appending syntax [].

	In PHP, array keys are strings and the array value can be anything.  In this case, you're making the value of one array element to be an array.

	The key here is that you were just overriding the keys of the master array with new values on every loop.  Which would be fine if you're computing min/max, but in this case you're trying to build a data grid so you have to remember to append instead of write.

*/


$aCharacterBank[] = [
	'ThreadID'  => (int)$row['ThreadID'],
	'PostID'    => (int)$row['PostID'],
	'CharID'    => (int)$row['CharID'],
	#'UserID'    => (int)$row['UserID'],
	'PostOrder' => (int)$row['PostOrder'],
];


			#$aCharacterBank = $aTempArray;

			# test values being indexed - print to browser
			echo $tID . ' || ' . $cID . ' || ' . $pOrder . '<br />';
			#$aCharacterBank[$threadID] = $pID ;
		}

			#sort sub array in main array
			#array of arrays
			#$aCharacterBank = $aTempArray;

		#closing formating here...
	}
	@mysqli_free_result($result); //free resources

var_dump($aCharacterBank);




/*
SQL - Select values where one value is distinct, return data sorted by another value

My goal is to write an SQL Statement which will collect all matching data where the CharID is unique within a Thread ID grouping. Or to put it another way I am trying to get all the participating character IDs of each thread, returned in groups so that if there are five (!, 2, 1, 4, 2 (Again)) CharIDs belonging to ThreadIDD #7, then 1, 2, 4 are returned as tehy are unique to that thread.


HAVE data coming back, sorted by ThreadID

+----+---------+-------------------+----------------+
| PostID | ThreadID   | UserID | CharID | PostOrder |
+----+---------+-------------------+----------------+
|    3   |     1      |   1    |    10  |     1			|
|    4   |     1      |   2    |    12  |     2     |
|    5   |     1      |   3    |    22  |           |
|    6   |     2      |   1    |    10  |     1     |
|    7   |     2      |   1    |    10  |           |
|    8   |     2      |   1    |    10  |           |
+----+---------+-------------------+----------------+


WANT data coming back, first by ThreadID where CharID is unique

+----+---------+-------------------+----------------+
| PostID | ThreadID   | UserID | CharID | PostOrder |
+----+---------+-------------------+----------------+
|    3   |     1      |   1    |    10  |     1			|
|    4   |     1      |   2    |    12  |     2     |
|    5   |     1      |   3    |    22  |           |
|    6   |     2      |   1    |    10  |     1     |
+----+---------+-------------------+----------------+

*/



/*

	what we want to do -- return grouped sets based on thread id, getting each number if unique






*/

































/**
 * Get codenames and CharIDs of thread particpants
 *
 * @param?
 * @return string
 */

#$aCharacterBank = [];

#funciton get_participants($aCharacterBank, $str=''){ }

