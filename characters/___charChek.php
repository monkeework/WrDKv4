<?php

require '../_inc/config4cerebra-inc.php'; #configuration, pathing, error handling, db credentials

//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check 'act' for type of process
	case "display": # 2)Display user's name!
		 showCharacter();
		 break;
	default: # 1)Ask user to enter their name
		 start();
}

function start()
{# shows form so user can enter their name.  Initial scenario
	get_header(); #defaults to header_inc.php
?>

	<p align="center">Character?</p>
	<form action="<?=THIS_PAGE;?>" method="post" onsubmit="return checkForm(this);">
			<p align="center"><input type="text" name="Codename" placeholder="Codename?"/></p>
			<p align="center"><input  type="submit" value="Chek Exists" /></p>
		<input type="hidden" name="act" value="display" />
	</form>
<?php
	get_footer(); #defaults to footer_inc.php

}

function showCharacter()
{#form submits here we show entered name
	get_header(); #defaults to footer_inc.php
	if(!isset($_POST['Codename']) || $_POST['Codename'] == '')
	{//data must be sent
		feedback("No form data submitted"); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}


	$chek = $_POST['Codename'];
	$sql = "select codename, id from cerebra where codename='$chek';";


















	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#External formatting here...

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$str .= '<p>' . dbOut($row['codename']) . ' (#' . (int)$row['id'] . ')</p>';
		}

		#closing formating here...
	}else{//no records
			echo '<p><h3>Currently marching character found.</h3></p>';

			$sql = "select codename, id from cerebra;";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#External formatting here...

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$str .= '<p>' . dbOut($row['codename']) . ' (#' . (int)$row['id'] . ')</p>';
		}
	}












	}
	echo '<div align="center"><a href="' . THIS_PAGE . '?act=add">ADD CUSTOMER</a></div>';
	@mysqli_free_result($result); //free resources





	$myName = strip_tags($_POST['Codename']);# here's where we can strip out unwanted data

	echo '<h3 align="center">' . smartTitle() . '</h3>';
	echo '<p align="center">Your name is <b>' . $myName . '</b>!</p>';
	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';
	get_footer(); #defaults to footer_inc.php
}

