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


<h1 class='spaceafter'>Character Creation</h1>


<div id="wrapper-akordeon">


	<div class="stats_dc">
		<section id="hdr-stats">
		<p>
			
			PREFACE SPACE
			
		</p>
		</section>
	</div>



	<div class="akordeon" id="buttons">
		<div class="akordeon-item expanded">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Getting Started</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
				<!-- BEGIN GETTING_STARTED -->
					<section id="first">
					
					FIRST
					
					</section> <!-- END GETTING_STARTED --></div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Character Advantages - Please Limit Your Character To Five (5) Or Less</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_ADVANTAGES-->
					<section id="char_advantages">

					FILLER


					</section>
					<!-- END CHAR_ADVANTAGES -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Character Disadvantages - Please Limit Your Character To Five (5) Or Less</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_DISADVANTAGES-->
					<section id="char_disadvantages">

					FILLER


					</section>
					<!-- END CHAR_DISADVANTAGES -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Character Equipment - Please Limit Items To What Your Character Can Reasonably Carry With Them</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_EQUIPMENT-->
					<section id="char_advantages">

					FILLER


					</section>
					<!-- END CHAR_EQUIPMENT -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Character Resources</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_RESOURCES-->
					<section id="char_advantages">

					FILLER


					</section>
					<!-- END CHAR_RESOURCES -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Character Natures & Demeanors</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_NATURES-DEMEANORS-->
					<section id="filler">

					FILLER


					</section>
					<!-- END CHAR_NATURES-DEMEANORS -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Resources - Things Which Your Character Has Access To OR Can Call On For Help</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_RESOURCES-->
					<section id="char_resources">

					FILLER


					</section>
					<!-- END CHAR_RESOURCES -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						Character Skills - Please Limit Your Character To Five (5) Or Less</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN CHAR_SKILLS-->
					<section id="char_skills">

					FILLER


					</section>
					<!-- END CHAR_SKILLS -->					
				</div>
			</div>
		</div>



		<div class="akordeon-item">
			<div class="akordeon-item-head">
				<div class="akordeon-item-head-container">
					<div class="akordeon-heading">
						F.A.Q.</div>
				</div>
			</div>
			<div class="akordeon-item-body">
				<div class="akordeon-item-content">
					<!-- BEGIN LAST-->
					<section id="char_faq">

					LAST


					</section>
					<!-- END CHAR_FAQ (LAST) -->
				</div>
			</div>
		</div>
	</div>
</div>


<br >

<hr>

<?php 
	include("templates/modlinks.php"); 
	include("templates/footer.php"); 
?>