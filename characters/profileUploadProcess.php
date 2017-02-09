<?php
function maxDoc_characters_profileUpload(){
/**
 * based on upload_execute.php
 * profileUploadProcess.php takes ID number & image file sent via upload_form.php, and
 * replaces image associated with the current ID number.
 *
 * This page requires a loaded querystring, with an id number of an item passed to it. Form
 * will submit image to be uploaded, and ID to uploadImage.php, which processes the upload.
 * The checkFileType() function in the common_inc.php is used to validate file extensions.
 *
 * All default settings below can be over-written by a submitting form.
 *
 * Global Variable $_FILES is used in PHP 4.x
 * $_FILES['upload']['size'] ==> Returns the Size of the File in Bytes.
 * $_FILES['upload']['tmp_name'] ==> Returns the Temporary Name of the File.
 * $_FILES['upload']['name'] ==> Returns the Actual Name of the File.
 * $_FILES['upload']['type'] ==> Returns the Type of the File.
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see upload_form.php
 * @todo expand to add .gif support
 * @todo allow inc file to add DB updates, file names, sizes, etc.
 * @todo check if determining correctly if writeable or not.  Might be checking for writeable via PHP, not public
 */

/**
 * Default setting: comma separated string of acceptable file types.
 * Works with checkFileType() function in common_inc.php
 * Examples of (image) file types below:
 *
 *<code>
 * $file_types = "image/pjpeg,image/jpeg,image/gif,image/x-png";
 *</code>
 *
 * To add to acceptable file types, attempt to upload invalid file types,
 * then make a note of the extension, and add it to the list.
 *
 * NOTE: These are only default values, and represent the WIDEST variety of files that
 * may be uploaded.  The form may make it's own limitations via the $_POST['extension']
 * variable.
 *
 * @see checkFileType()
 * @see common_inc.php
 */

 # '../' works for a sub-folder.  use './' for the root
}

$file_types = "image/pjpeg,image/jpeg"; # currently we only accepts jpegs!

//END CONFIG AREA ----------------------------------------------------------

require '../_inc/config_inc.php';
/**
 * Session protects including page
 * Only administrators are allowed to view this page
 * Level is defined in constant, ACCESS, above
 * @see admin_only_inc.php
 */


require_once INCLUDE_PATH . 'admin_only_inc.php';

# check variable of item passed in - if invalid data, forcibly redirect back to view or index page
if(isset($_POST['myID']) && (int)$_POST['myID'] > 0){#proper data must be on querystring
	 $myID = (int)$_POST['myID']; #Convert to integer, will equate to zero if fails
}else{
	if(!isset($redirect)){$redirect = VIRTUAL_PATH . "index.php";}
	header('Location:' . $redirect);
		die;
}

# retrieve over-rides from upload_form.php page, if applicable - otherwise safe defaults are provided
if(isset($_POST['sizeBytes'])){$sizeBytes 			= (int)$_POST['sizeBytes'];}else{$sizeBytes = "100000";}
if(isset($_POST['imagePrefix'])){$imagePrefix 	= $_POST['imagePrefix'];}else{$imagePrefix = "";}
if(isset($_POST['uploadFolder'])){$uploadFolder = $_POST['uploadFolder'];}else{$uploadFolder = "uploads/";}
if(isset($_POST['createThumb'])){$createThumb 	= $_POST['createThumb'];}else{$createThumb = "FALSE";}
if(isset($_POST['thumbWidth'])){$thumbWidth 		= $_POST['thumbWidth'];}else{$thumbWidth = "50";}
if(isset($_POST['thumbSuffix'])){$thumbSuffix 	= $_POST['thumbSuffix'];}else{$thumbSuffix = "t";}
if(isset($_POST['img'])){$img 									= $_POST['img'];}else{$img = "";}

if(isset($_POST['returnPage'])){$returnPage 		= $_POST['returnPage'];}else{$returnPage = "";}


#my added crap
#h=headr, p=profl, g=gally, t=thumb
if(isset($_POST['type'])){$type 			= $_POST['type'];}else{$type = "";}

#dumpDie($_POST);

/**
 * Indicate exact path to file upload here.
 * Folder must have write capability, either 0775, or 0777
 * You may not want this to be your actual images directory. Note the path must include a last "/".
 *
 * PHYSICAL PATH is path to root space of server, and set in config_inc.php
 */
$uploadFolder = PHYSICAL_PATH . $uploadFolder;


#dumpDie($uploadFolder);

# determine acceptable extensions for file upload - convert to formats used by PHP upload
if(!empty($_POST['extension']))
{# if not passed by form, use defaults
	$aExtensions = explode(",",$_POST['extension']);
	if(is_array($aExtensions))
	{#comma separated set of extensions
		$fileString = "";
		for($x = 0; $x < count($aExtensions); $x++)
		{
				$file_types = extension2fileType($aExtensions[$x]);
				if($fileString == ""){$fileString .= extension2fileType($aExtensions[$x]);}else{$file_types .= "," . extension2fileType($aExtensions[$x]);}
				$extension = $aExtensions[$x];
		}
	}else{#only one extension sent
		$file_types = extension2fileType($aExtensions);
		$extension = $_POST['extension']; //single extension (non-array) attach to doc
	}
}

#http://localhost/WrDKv3/characters/profileUpload.php?act=edit&id=1&type=g&img=1-2&returnPage=profile.php?id=1&act=edit
#dumpDie($_POST);
/*

array (size=9)
	'myID' => string '1' (length=1)
	'uploadFolder' => string 'uploads/' (length=8)
	'extension' => string '.jpg' (length=4)
	'thumbWidth' => string '50' (length=2)
	'createThumb' => string 'TRUE' (length=4)
	'sizeBytes' => string '100000' (length=6)
	'returnPage' => string 'profile.php?id=1' (length=16)
	'type' => string 'g' (length=1)
	'img' => string '1-2' (length=3)

	*/




if($type == 'p'){
	#if profile image
	$fileName   = $myID . '-1' . $extension;  //create name of file to be uploaded
	$thumbName  = $myID . '-1t' . $extension;  //create name of file to be uploaded
} else if($type == 'g'){
	#if gallery image
	$fileName   = $img . $extension;  //create name of file to be uploaded
	$thumbName  = $img . 't' . $extension;  //create name of file to be uploaded

	#echo $fileName;
	#dumpDie($thumbName);

}else{
	#if banner header image
	$fileName   = $myID . '-0' . $extension;  //create name of file to be uploaded
	$thumbName  = $myID . '-0t' . $extension;  //create name of file to be uploaded
	$sizeBytes  = "800000";
}


#dumpDie($_POST);




$aErrors = array(); //init.  If error message is loaded (array length > 0) errors occurred!

//identify the page where the admin will return once upload is complete
if(isset($_POST['returnPage'])){$returnPage = $_POST['returnPage'];}else{$returnPage = ADMIN_DASHBOARD;}

//check if the directory exist or not.
if (!is_dir("$uploadFolder")){$aErrors[] = "The directory <b>" . $uploadFolder . "</b> doesn't exist.";}

//check if the directory is writable.
if (count($aErrors)==0 && !is_writeable("$uploadFolder"))
{
	 $aErrors[] = "Unable to write to directory: <b>" . $uploadFolder . "</b>. Change directory permissions: First try 0755, and if that fails 0777";
}
//not determining correctly if writeable or not.  Might be checking for writeable via PHP, not public

//Check first if a file has been sent via HTTP POST. Returns false otherwise.
if (count($aErrors)==0 && is_uploaded_file($_FILES['FileToUpload']['tmp_name']))
{
	$size = $_FILES['FileToUpload']['size'];  //Get the Size of the File
	if (count($aErrors)==0 && $size > $sizeBytes) //Make sure that $size is acceptable
	{
		$aErrors[] = "The File you tried to upload is <b>" . $size . "</b>K. Maximum file size: <b>" . $sizeBytes . "</b>K. Please upload a smaller file.";
	}

	if (count($aErrors)==0 && !checkFileType($file_types,$_FILES['FileToUpload']['type']))
	{//Make sure file is of allowable file types
		$aErrors[] = "File you tried to upload is <b>" . $_FILES['FileToUpload']['type'] . "</b>. This file type is not currently allowed.";
	}


echo $uploadFolder.$fileName . '<br /><br/>';
echo $fileName . '<br /><br/>';
//dumpDie($_POST);
// string '/Applications/AMPPS/www/WrDKv3/uploads/' (length=39)

	//move_filetoupload_file('filename','destination') Moves file to directory
	if (count($aErrors)==0 && move_uploaded_file($_FILES['FileToUpload']['tmp_name'], $uploadFolder.$fileName)){
		if($createThumb == "TRUE")
		{//create thumbnail in same folder, add thumbSuffix
			$tempImage = ImageCreateFromJPEG($uploadFolder.$fileName);  //copy to temporary image
			$width = ImageSx($tempImage); // Original picture width
			$height = ImageSy($tempImage); // Original picture height
			$thumbHeight = floor( $height * ( $thumbWidth / $width ) ); // calculate proper thumbnail height

			$newimage = imagecreatetruecolor($thumbWidth, $thumbHeight); //create new blank image

			imageCopyResampled($newimage, $tempImage,0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);  //copy to thumb

			#ImageJpeg($newimage,$uploadFolder . $myID .  '-'. $series .'t' . $extension);  //create thumbnail in same directory
			ImageJpeg($newimage,$uploadFolder . $thumbName);  //create thumbnail in same directory
		}


		//append timestamp to qstring to print temporary reload() message
		$mySeconds = time();

		//redirect to item page so new file can be seen
		feedback("Image Uploaded Successfully!<br /> (If you see old image, click button below pic)","notice");

				#Edit Applied -> added &act=edit
				#Edit Applied -> $returnPage
				header('Location:' . $returnPage . "&act=edit&msg=" . $mySeconds);
				die;

	}else{
		//Print error
		$aErrors[] = "Unable to upload file.";
	}
}else{
	$aErrors[] = "File not sent via POST.";
}

if(count($aErrors)>0)
{
	get_header(); #defaults to theme header or header_inc.php

	#include '../_inc/header_inc.php';
	echo '<h2 class="text-center">Upload Error</h2>';
	echo '<p class="text-center">Please view the following upload error(s)</p>';

	$count = 1;
	for($x = 0; $x < count($aErrors); $x++)
	{
			echo "<p class='text-center'>" . $count++ . ' -  ' . $aErrors[$x] . "</p>";
	}
	echo '<p class="text-center"><a href="' . $returnPage . '">BACK</a></p>';

	get_footer(); #defaults to footer_inc.php

}


function checkFileType($file_types, $currentFileType) {
/**
 * Checks a comma separated string of acceptable file types set by
 * an administrator in upload pages (upload_execute.php, upload_form.php)
 * to be certain an accepted file type is currently being uploaded.
 *
 * PHP upload file types can be derived by using extension2fileType() function.
 *
 *<code>
 * $file_types = "image/pjpeg,image/jpeg,image/gif,image/x-png";
 * $validFileType = checkFileType($file_types,$_FILES['FileToUpload']['type']);
 *</code>
 *
 * To add to acceptable file types, attempt to upload invalid file types,
 * then make a note of the extension, and add it to the list.
 *
 * Added with nmUpload Package
 *
 * @see upload_execute.php
 * @see upload_form.php
 * @uses extension2fileType
 *
 * @param str $file_types comma separated string of acceptable files to upload
 * @param str $currentFileType file type of the current file being uploaded
 * @return boolean true if passes filetype test
 */
	$aFiles = explode(",", $file_types); //create aFiles file type array:
	for($x=0; $x < count($aFiles); $x++)
	{
		if($aFiles[$x]==$currentFileType){return true;}
	}
	return false; // no match found, return false!
}#end checkFileType()


function extension2fileType($extension){
/**
 * Converts natural file extension into file type required for
 * PHP upload.
 *
 * Works with checkFileType() function to identify valid file types, as
 * declared by administrators
 *
 *<code>
 * $fileType = extension2fileType(".jpg");
 *</code>
 *
 * To add to acceptable file type, attempt to upload INVALID file types,
 * then make a note of the file_type/extension, and add it to the switch below.
 *
 * Added with nmUpload Package
 *
 * @see upload_execute.php
 * @see upload_form.php
 *
 * @param string $extension natural extension of a file
 * @return string PHP upload file type of the current file
 */
	$file_types = ""; #init
	switch(strtolower($extension))
	{
		case ".jpg":
		case ".jpeg":
			$file_types = "image/pjpeg,image/jpeg";
			break;
		case ".gif":
			$file_types = "image/gif";
			break;
		case ".png":
			$file_types = "image/x-png";
			break;
		case ".doc":
			$file_types = "application/msword";
			break;
		case ".zip":
			$file_types = "application/x-zip-compressed";
			break;
		case ".pdf":
			$file_types = "application/pdf";
			break;
		case ".xls":
			$file_types = "application/vnd.ms-excel";
			break;
		case ".mp3":
			$file_types = "audio/mpeg";
			break;
		case ".txt":
			$file_types = "text/plain";
			break;
		case ".htm":
		case ".html":
			$file_types = "text/html";
			break;
		case ".wma":
			$file_types = "audio/x-ms-wma";
			break;
		default:
			$file_types = "image/pjpeg,image/jpeg"; //default to .jpg
	}
	return $file_types; # return matching file type!
}#end extension2fileType()

