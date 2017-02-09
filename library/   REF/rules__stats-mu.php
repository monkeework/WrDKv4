<?php
	include("functions.php");
	include("templates/header.php");
?>

<script type="text/javascript">
	$(document).ready(function () {
		$('#buttons').akordeon();
		$('#button-less').akordeon({ buttons: false, toggle: true, itemsOrder: [2, 0, 1] });
	});
</script>

<script src="/_js/fireakordeon.js" type="text/javascript"></script>


<h1 class='spaceafter'>Character Stats (Definitions)</h1>


<p>
	<a href="rules__stats-mu.php#mu_fighting">FI</a> | 
	<a href="rules__stats-mu.php#mu_agility">AG</a> | 
	<a href="rules__stats-mu.php#mu_strength">STR</a> | 
	<a href="rules__stats-mu.php#mu_endurance">END</a> | 
	<a href="rules__stats-mu.php#mu_reason">REA</a> | 
	<a href="rules__stats-mu.php#mu_intuition">INT</a> | 
	<a href="rules__stats-mu.php#mu_psyche">PSY</a>

</p>


<hr >

<!-- CkEditor begin -->
<?php
// this is the static contents id in the database - max
// get static id from 'http://xaviers-children.net/addNewCk.php'
$pageID = 27;

// ckEditor save routine
if ($moderator) {
	 if (isset($_REQUEST['save']) && $_REQUEST['save'] == 'yes' && $_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['id'] != "" ){
		  $content =addslashes( $_REQUEST['RTE1'] );
		  $id = addslashes ( $_REQUEST['id']);
		  $Update = "UPDATE `static_content` SET `content` = '".$content."' WHERE `id` = '".$id."' ";
		  $exe = mysql_query( $Update )or die(mysql_erorr());
		  echo "<span  style='color:red;'>content saved</span>";
	}
}

// get static content from db to display
$getStaticContent = mysql_query( "select * from `static_content` WHERE `id`={$pageID} LIMIT 1");
if(mysql_num_rows( $getStaticContent ) > 0 ){
$FetchStaticContent = mysql_fetch_array( $getStaticContent );
?>
<?php echo $FetchStaticContent['content']?>

<script type="text/javascript" src="js/AjaxSaveContent.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script language="javascript">
	function showHide( Divname ){
	   divObj = document.getElementById( "div_"+Divname );
	   if( divObj.style.display == 'none'){
		  divObj.style.display = 'block';
	   }else{
		 divObj.style.display = 'none';
	   }
	}
</script>	
<?php if ($moderator) {?> 
<!-- ckEdit Button -->
<p><a href="javascript:void(0);" onclick="javascript:showHide('<?php echo $FetchStaticContent['id']; ?>')">[Edit]</a></p><?php } ?>
	<form name="frmmessageedit" id="frmmessageedit" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
		 <div id='div_<?php echo $FetchStaticContent['id'];?>' style='display:none;' >
			 <textarea name='RTE1'  id='RTE1' rows='10' cols='100'><?php echo stripslashes($FetchStaticContent['content']);?></textarea>
		 <br /><input type="submit" name="btn_<?php echo $FetchStaticContent['id'];?>"  id="btn_<?php echo $FetchStaticContent['id'];?>" value="Save" />
		 <input type="hidden" name="save" id="save" value="yes" />  
		 <input type="hidden" name="id" id="id" value="<?php echo $FetchStaticContent['id'];?>" />  
			 <script type="text/javascript">
							CKEDITOR.replace('RTE1');
			 </script>
		</div> 
	</form>
<?php } ?>
<!-- CkEditor done -->

<hr>

<?php 
	include("templates/modlinks.php"); 
	include("templates/footer.php"); 
?>