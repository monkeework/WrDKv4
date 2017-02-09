<?php // maps currently too profile-rdSTAT.php
// Incase act is somehow unset, send user back to view (shoW)


function maxDoc_uploads_playby(){
/**
 * profile.php based view.php, display character attributes
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seelist.php
 *
 * @todo edit peekaboo edit character link
 *	  cheks char assigned/is mod+
 *		show edit option
 *
 * @todo add back button
 */

 # '../' works for a sub-folder.  use './' for the root
}

if(!isset($_REQUEST['act'])){

	#fail message add here
	header( 'Location: http://' . $VIRTUAL_PATH . 'upload/' ) ;
}

require '../_inc/config_inc.php';

require INCLUDE_PATH . 'arrays-inc.php';

$priv=$str='';
if(startSession() && isset($_SESSION['UserID'])){
	$priv = $_SESSION['Privilege'];
}else{ $priv ='';}
# END CONFIG AREA ---------------------------------------

get_header(); #defaults to theme header or header_inc.php

if(isset($_SERVER['HTTP_REFERER'])){
	$priorPage  = $_SERVER['HTTP_REFERER'];
}else{ $priorPage = 'index.php';}


#IF NO ACTIN, SEND AWAY
if(isset($_GET['act'])){
	$act = $_GET['act'];
}else{
	#provide feedback
	feedback('We&quot;re Sorry but we could not find any images for that Playby!'); #will show up next running of showFeedback()
	#send them back where started
	header( 'Location: ' . $priorPage );

}

#array to hold playby names in i
$cName=$cGen=$cImg=$imgPath='';

#gName = get_name
$cImgPath  = (isset($_GET['img']) ? htmlspecialchars($_GET['img']) : '');
#cName is cleaned up name
$cName	= str_replace('_', ' ',  htmlspecialchars($cImgPath)); #clean up name

$cGen   = (isset($_GET['gender']) ? $_GET['gender'] : '');




//Get header element after myAction processed to determine if we show button or not.
echo get_playbyTron($cName, $cImgPath, $cGen, $aarStatus, $priv, $cImgPath );

echo '<div>'; #END container

echo get_sideSearch();

echo get_pbGallery($cGen, $cImgPath, $priv, $str='');

echo '<div class="clearfix"></div>
	</div>'; #END container
// END POSTBACK

get_footer(); #defaults to footer_inc.php


######################  IMG HANDLING  ########################

#create single playby image gallery

#http://localhost/WrDKv4/uploads/viewPlayby.php?act=f
#http://localhost/WrDKv4/uploads/index.php?act=f

function get_sideSearch($str=''){
	$str = "<div class='container-fluid'>
<div class='row content'>
	<div class='col-sm-3 sidenav'>

	<br />

		<a href='./index.php?act=f' class='btn btn-primary btn-xs'>Female Playbys</a>
		 &nbsp;
		<a href='./index.php?act=m' class='btn btn-primary  btn-xs'>Male Playbys</a><br /><br />

		<form class='navbar-form' role='search'>
			<div class='input-group add-on'><input class='form-control'
					placeholder='Search Again...'
					name='act' id='srch-term'
					type='text'><div class='input-group-btn'>
					<button class='btn btn-default' type='submit'><i class='glyphicon glyphicon-search'></i></button>
			</div></div>
		</form>

	</div>
	<div class='col-sm-9'>";
	return $str;

}

#getJumbotron($myID, $CodeName, $Playby, $Gender);
function get_playbyTron($cName, $cImgPath, $cGen, $aarStatus, $priv, $cImgPath ){
	echo '<style>
				.jumbotron {
					position: relative;

					background: #fff url("' . get_playbyBG($cName, $cImgPath, $cGen) . '") center center;
					width: 100%;
					height: 100%;
					background-size: cover;
					overflow: hidden;
					}

				.vertical-align {
					position: absolute;
					bottom: -18px;
					left: 1%;
					}

				.btnJumbotron {
					position: absolute;
					top:10px;
					right: 0px;

					color: #000;

					background: white;
					#opacity: 0.9;
					font-size: 10px;
					padding: -3px -4px;

					border-radius: 10px 0 0 10px  ;
					font-weight: bold;
					}

					.btnJumbotron a {color: grey; text-decoration: none;}
					.btnJumbotron a:hover { color: tomato; text-decoration: none;}

				.jumbotron h1 {
					color: white;
					text-shadow: 4px 4px 8px #444;
					}

				.btn.outline {
					background: none;
					padding: 12px 22px;
					color: white;
					border: solid 2px white;
					border-radius: 10px;
					font-weight: bold;
					text-shadow: 0px 0px 8px #000000;
					box-shadow: 0px 0px 8px #000000;
					}


				.pull-bottom{
					position: absolute;
					bottom: 0px;}


				.myThumb {
					height: 35px;
					width: 35px;
					margin: 0 3px 0 6px;
					}

				.txt-KO{color: white;}

				.hoverHighlight:hover{ background: WhiteSmoke;}

				.charSection { background: WhiteSmoke;}

				.myParagraph {
					margin-bottom: -54px;
					padding: 0 0 0 25px;
					}

			</style>

			<!-- begin character -->
			<div class="container">
				<div class="jumbotron">
					<br />
					<br />';


				# available tell us, if valid user, allow to reserve

				echo get_statusReserve($priv, $cName, $cImgPath, $aarStatus);

				echo '<div style="position: absolute; bottom: 0px;"><h1><strong>'
					. strtoupper($cName) . '</strong></h1></div>';


				#echo btn_statusReserve($priv);

				#echo get_pbGallery($cName, $cName, $gender); #CharID needed, returns array to build image gallery with

	echo '</div>
	<!--END JUMBO-->'; #END jumbo
}

function get_pbGallery($cGen, $playby, $str = ''){
	$directory = "./_$cGen/$playby/";
	$images = glob($directory . "*.jpg");

	$pbName = str_replace('_', ' ', $playby);

	$count = 1;
	foreach($images as $imgPath)
		{ #skip if header
			if(strpos($imgPath, '-0') !== false){
				continue;
				# skip if thumbnail
			}else if(strpos($imgPath, 't.jpg') !== false){
				continue;
				#show image
			}else{

				echo'<!--playby-->
				<div class="" style="float: right; margin: 10px; text-align: center">
					<a href="#" >
						<figure>
						<!--playby preview-->

							<img src="./'. $imgPath .'" alt="0" style="
										border-radius: 25px; border: 2px solid #bbb;
										width: 150px; height: 150px;">

							<!--description and price of product-->
							<figcaption>
								<h6 class=""> ' . ucwords($pbName) . ' </h6>
							</figcaption>
						</figure>
					</a>
				</div>';

				$count++;
			}

		} #END foreach loop

	}


function get_statusReserve($priv, $cName, $cImgPath, $aarStatus, $chek='', $str=''){

$sql = "SELECT CharID, UserID,	StatusID, Playby FROM ma_Characters
	WHERE StatusID > 2 AND UserID != '';";

	$db = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$result = $db->query($sql);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($result->rowCount() > 0)
	{#there are records - present data
		while($row = $result->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			$chek   = $row['Playby'];

			$status = (int)$row['StatusID'];
			$status = $aarStatus[$status];


			#http://localhost/WrDKv4/characters/index.php?act=playby&gen=male&playby=Matt_battaglia#


			if($chek == $cName)
			{
				#only one if will be valid so if match we get button
				$str = '<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" style="position: absolute; bottom: 20px;  right: 20px;" data-target="#modalContact">Reserved</a>';
			}

			if($chek != $cName)
			{
				#regardless how many checks we do, we're just overwriting and will only show one notice/button
				$str = '<a href="#" class="btn btn-default btn-xs" role="button" data-toggle="modal" style="position: absolute; bottom: 20px;  right: 20px;" data-target="#modalContact">Request</a>';
			}

			return $str;
		}

	}

	unset($result,$db);//clear resources

}



#mk array detailing each character's status if attached to handler
function get_pgStatus($aPBstatus=[], $str=''){

	#select all characters assigned to active user
	$sql = "SELECT CharID, UserID,	StatusID, Playby FROM ma_Characters
	WHERE StatusID >= 4 AND UserID >= 1 ORDER BY Playby";

	$db = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$result = $db->query($sql);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	echo '<div align="center"><h4>SQL STATEMENT: <font color="red">' . $sql . '</font></h4></div>';
	if($result->rowCount() > 0)
	{#there are records - present data
		while($row = $result->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			 echo $row['Playby'];
			echo '<br />';
		}
	}else{#no records
		echo '<div align="center">Sorry, there are no records that match this query</div>';
	}
	unset($result,$db);//clear resources
}

function get_playbyBG($cName, $cImgPath, $gender, $img='-0.jpg'){ #create background image
	#creat testing links for image paths
	$permImg = $cImgPath . $img;

	#dumpDie($permImg);

	$tempImg = tempImg($cImgPath, $gender) . $img;

	if(file_exists($permImg)){
			$img = $permImg;
		} else if(file_exists($tempImg)) {
		#no image show me random static image (6 possible returns)
		return $tempImg; #temp image
		} else{ #show static
			$img = VIRTUAL_PATH . '_img/_static/static---blueCascade.gif';
		}
	return $img; #return gallery images
}

function getThumbs($cGen, $cName, $cImgPath ){ #create 4 random thumbnails
	#define variables needed
	$x = 1;
	$str='';

	while($x <= 4) {
			$imgPath = '../uploads/_' . $cGen . '/' . $cImgPath . '-' . rand(2,6) . 't.jpg';

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="' . $imgPath . '" alt=" "' . $cName .
					'" class="img-thumbnail myThumb" >';
			}else{ #show static
				$str .= '<img src="' . VIRTUAL_PATH .
					'_img/_static/static---00' . rand(0,9) . '.gif" alt=" "' . $cName .
					'" class="img-thumbnail myThumb" >';
			}
			$x++;
		}


	return $str; #return gallery images
}

function permImg($cID, $imgPerm=''){
	$imgPerm = '../uploads/_' . $cGen . '/' . $cID;
	return $imgPerm;
}

function tempImg($pbID='', $gID='', $imgTemp=''){
	#Creates temporary base image path for a character profile
	#EX:: http://localhost/WrDKv3/uploads/_male/alex_kotze/alex_kotze-001t.jpg
	#if image has been set, set path

	#sanitize/prep playby name for processing
	$pbID = str_replace(' ', '_', strtolower($pbID));
	$pbID = str_replace('-', '_', strtolower($pbID));
	$pbID = str_replace("'", '_', strtolower($pbID));

	if((isset($pbID)) && ($pbID !== '')){ $imgTemp = "../uploads/_{$gID}/$pbID/$pbID";
	}
	return $imgTemp ;
}

function searchResult($pbSearch='', $pbName='', $gender='', $link='', $img='', $str=''){
	//chek if playby exists...
	$pbExt 			= '-001.jpg';
	$dirPath 		= "./_playbys/";

	$chekMale 	= './../uploads/_male/' . $pbSearch;
	$chekFemale = './../uploads/_female/' . $pbSearch;

	//END Function config

	#1 confirm exists
	if(file_exists($chekFemale)) {
		//set gender
		$gender = 'female';
		//creat vars
		$link 	= './viewPlayby.php?act=show&gender=' . $gender . '&img=' . $pbSearch;
		$img 		= $chekFemale .'/' . $pbSearch . '/' . $pbSearch .'-001.jpg';

	} else if (file_exists($chekMale)) {
		//set gender
		$gender = 'male';
		//create vars
		$link 	= './viewPlayby.php?act=show&gender=' . $gender . '&img=' . $pbSearch;
		$img 		= $chekMale .'/' . $pbSearch . '/' . $pbSearch .'-001.jpg';

	} else {
		#provide feedback if no results found :(
		$str = "<h3> <i>{$pbName}</i> was not found in our image library</h3>
		<div class='clearfix'></div>";
	}

	if((!empty($link)) && (!empty($img))){
		//build my return

		$str = '<!--playby-->
		<h3>All Search Results for <b>" . $pbSearch . " - " . $pbName . "</b>:</h3>

		<div class="clearfix"><div>

		<div class="" style="float: right; margin: 10px; text-align: center">
			<a href="' . $link . '" >
				<figure>
					<!--playby preview-->
					<img src="' . $img .'" alt="0" style="
						border-radius: 25px; border: 2px solid #bbb;
						width: 150px; height: 150px;">
					<!--description of playby -->
					<figcaption>
						<h6 class=""> ' . $pbName . ' </h6>
					</figcaption>
				</figure>
			</a>
		</div>
		<div class="clearfix"></div>';
	}

	return $str;
} //END searchResult()
