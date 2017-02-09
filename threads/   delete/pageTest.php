<?php
# '../' works for a sub-folder.  use './' for the root
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials






# SQL statement
$sql = "SELECT * FROM ma_Posts ORDER BY DateCreated DESC";

# END CONFIG AREA ----------------------------------------------------------

get_header(); #defaults to theme header or header_inc.php

#reference images for pager
	$prev = '<span class="glyphicon glyphicon-backward"></span>';
	$next = '<span class="glyphicon glyphicon-forward"></span>';

# Create instance of new 'pager' class
$pager = new Pager(7,'',$prev,$next,'');
$sql = $pager->loadSQL($sql);  #load SQL, add offset

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if (mysqli_num_rows($result) > 0)//at least one record!
{#records exist - process

	if($pager->showTotal()==1){
		$itemz = "post";
	}else{
		$itemz = "posts";
	}  //deal with plural


	#BEGIN main content
	echo '<!-- MAIN CONTENT begin -->
	<div class="col-sm-9 col-xs-12 pull-right">
		<div align="center">We have ' . $pager->showTotal() . ' ' . $itemz . '!</div>';

		$count = 0;
		echo '<div align="center">';
		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$cName						= (int)$row['CharID'];
			$pID   						= (int)$row['PostID'];
			$pContent     		= dbOut($row['PostContent']);


			 echo '<div class="col-sm-12" style="border: 1px solid red; color: #888">
				 <p>
					<strong>Count post ' . $count . ' | Post ID ' . $pID . ' | ' . $cName . ' &raquo; </strong> ' .  nl2br($pContent) . '
				</p>
			</div>
			<hr />';

			$count++;
		}
		echo $pager->showNAV(); # show paging nav, only if enough records
	}else{#no records
			echo "<div align=center>What! No muffins?  There must be a mistake!!</div>";
	}

echo '</div></div>';

@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php
?>
