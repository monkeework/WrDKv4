<?php
function maxDoc_threads_index(){
	/**
	 * switching page to simplify stuff - will roll into classes
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
//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;


#BEGIN main content
switch ($myAction)
{//check 'act' for type of process
	case "categoryShow":
		#echo categoryShow($sql, $sqlTags); #show all threads in specific category
		#echo 'go to  categoryShow';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/catShow.php' ) ;

		break;
	########################################################
		case "categoryAdd":
		#echo categoryAdd(); #show all threads in specific category
		#echo 'go to  categoryAdd';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/catAdd.php' ) ;

		break;
	########################################################
	case "categoryInsert":
		#echo categoryInsert(); #show all threads in specific category
		#echo 'go to  categoryInsert';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/catInsert.php' ) ;

		break;
	########################################################
	case "categoryEdit":
		#echo categoryEdit(); #show all threads in specific category
		#echo 'go to  categoryEdit';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/catEdit.php' ) ;

		break;
	########################################################
	case "categoryRevise":
		#echo categoryRevise(); #cetegoryEdit Formhandler
		#echo 'go to  categoryRevise';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/catRevise.php' ) ;

		break;
	########################################################
	case "categoryRemove":
		#echo categoryRemove(); #set thread to hidden basically - vM2
		#echo 'go to  categoryRemove';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/catRemove.php' ) ;

		break;
	########################################################
	########################################################
	########################################################

	case "threadRecent":
		#echo threadShow($tally=8); #show all posts of single thread
		#echo 'go to  threadShow';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/threadRecent.php?tally=X' ) ;

		break;
	########################################################
	case "threadShow":
		#echo threadShow($tally=8); #show all posts of single thread
		#echo 'go to  threadShow';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/threadShow.php' ) ;

		break;
	########################################################
	case "threadAdd":
		#echo threadAdd($sql, $sqlTags); #show form to add a thread to catagory/general populace
		#echo 'go to  threadAdd';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/threadAdd.php' ) ;

		break;
	########################################################
	case "threadEdit":
		#echo threadEdit($sqlThreads, $sqlTags); #show form to add a thread to catagory/general populace
		#echo 'go to  threadEdit';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/threadEdit.php' ) ;

		break;
	########################################################
	case "threadRevise":
		#echo threadRevise($sqlThreads, $sqlTags); #show form to add a thread to catagory/general populace
		#echo 'go to  threadRevise';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/threadRevise.php' ) ;

		break;
	########################################################
	########################################################
	########################################################

	case "postRecent":
		#echo postRecent($tally=8); #show all recent threads.
		#echo 'go to  postRecent';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postRecent.php?tally=X' ) ;

		break;
	########################################################
	case "postShow":
		#echo postShow(); #show single post
		#threadShow($tally=1);
		#echo 'go to  postShow';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postShow.php?tally=X' ) ;

		break;
	########################################################
	case "postAdd":
		#echo postAdd(); #show form to add a post to thread
		#echo 'go to  postAdd';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postAdd.php' ) ;

		break;
	########################################################
	case "postInsert":
		#echo postInsert();
		#echo 'go to  postInsert';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postInsert.php' ) ;

		break;
	########################################################
	case "postEdit":
		#echo postEdit($sqlTags);
		#echo 'go to  postEdit';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postEdit.php' ) ;

		break;
	########################################################
	case "postTrash":
		#echo postTrash();
		#echo 'go to  postTrash';
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postTrash.php' ) ;

		break;
	########################################################
	default:
		#echo threadRecent($sql, $sqlTags);

		#if preference set - defer on start point
		header( 'Location: ' . VIRTUAL_PATH . 'threads/postRecent.php?tally=X' ) ;
		#header( 'Location: ' . VIRTUAL_PATH . 'threads/threadRecent.php?tally=X' ) ;
	}
