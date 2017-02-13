<?php //aboutus.php
/Tutorials - -SQL, GitHub, OOP

To get to WrDKv.05

1. Fix/update thread and post tools so all work

2. Resolve session issue - hit db instead when charIndex needed
		- make function
		- see below

3. Notifications

4. Galleries - fix image slide

/*
 * get list of current existing characters - possible equal to given tIDs?
function gt_currentCharacter(){
$sql="SELECT * CharID, Codename From ma_Test;";

#set CharIDs as Key, $codename as value

$aCharIndex[]=[];

#START PDO
$db = pdo(); # pdo() creates and returns a PDO object

#$result stores data object in memory
try {$result = $db->query($sql);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

#chk for result
if($result->rowCount() > 0)
{#there are records - present data
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{# pull data from associative array


$tID	 = (int)$row['ThreadID'];

			$cID  	 = (int)$row['CharID'];
			$cName  	 = (int)$row['Codename'];


			$aCharIndex[] = [
				'cID'  => $cID,
				'$cName'    => $$cName,
			];


	}
return $aCharIndex;

}else{#no records
	return $aCharIndex;
}
unset($result,$db);//clear resources

}







make small classes - a class should work on on thing/method
it would have several things

class Gender(){

public $gender = 'm';


public function checkCharacterGender(){

chek if set

}

if(gender is set){

}


}
