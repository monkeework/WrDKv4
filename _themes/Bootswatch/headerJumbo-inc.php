<?php
//theme specific functions
include 'bootswatch_functions.php';//WAS bootswatch_functions.php



// handle errors caused by missing session elements
// currently adds privilege == -1
//$priv = sessionChek();

// handle peopel without privleges coming to site
//if(!$_SESSION['Privilege']){$_SESSION['Privilege'] = -1;}



?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<?php include INCLUDE_PATH . 'meta_inc.php'; ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Bootstrap themes use style settings to change look and feel -->
		<link rel="stylesheet" href="<?=THEME_PATH;?>css/<?=$config->style;?>" media="screen">
		<link rel="stylesheet" href="<?=THEME_PATH;?>css/bootswatch.min.css">
		<link rel="stylesheet" href="<?=THEME_PATH;?>css/bootswatch-overrides.css">
		<link rel="shortcut icon" href="<?=VIRTUAL_PATH;?>_img/_mCons/favicon.ico" type="image/x-icon" />
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>











	<body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="<?=VIRTUAL_PATH?>" class="navbar-brand"><?=$config->banner;?></a>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
			<?php
				#echo bootswatchLinks($config->nav1,'<li>','</li>','<li class="active">'); #link arrays are created in config_inc.php file - see bootswatch_functions.php
			?>
					</ul>



					<ul class="nav navbar-nav">
			<?php
				echo bsDropdownLinks($config->nav1,'<li>','</li>','<li class="active">'); #link arrays are created in config_inc.php file - see bootswatch_functions.php
			?>
					</ul>

			<?php
				echo bootswatchAdmin(); //right aligned Admin link - see bootswatch_functions.php
			?>
				</div>
			</div>
		</div>
		<div class="container">
		<?php
			echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php


		?>


		<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>
		<!-- Edit Required Form Elements via JavaScript Here -->
	<script type="text/javascript">
		//here we make sure the user has entered valid data
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.Name,"Please Enter Your Name")){return false;}
			if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
			return true;//if all is passed, submit!
		}
	</script>

	<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
	<style type="text/css">
		.required {font-style:italic;color:#FF0000;font-weight:bold;}
	</style>


	<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
	<style>
		.jumbotron {
			position: relative;
			background: #000 url("./../_img/_bgs/<? echo PAGE_JUMBO; ?>") center center;
			width: 100%;
			height: 100%;
			background-size: cover;
			overflow: hidden;
			color: blue;
		}

		div.container div.jumbotron h1 b, div.jumbotron p {
			color: white;
			text-shadow: 2px 2px 16px #000000;
			text-shadow: 0 0 16px #000000;
		}

		/* Set height of the grid so .sidenav can be 100% (adjust if needed) */
		.row.content {height: 1500px}

		/* On small screens, set height to \'auto\' for sidenav and grid */
		@media screen and (max-width: 767px) {
			.sidenav {
				height: auto;
				padding: 15px;
			}
			.row.content {height: auto;}
		}

		p:first-letter{ text-transform: capitalize; }
	</style>


	<!-- JS for captcha.  Move to your _JS? (or not) -->
	<script type="text/javascript">
		 var RecaptchaOptions = {
				theme : "clean"
		 };
	</script>

	<!-- CSS class for captcha.  Move to your CSS? (or not) -->
	<style>
		.g-recaptcha div { margin-left: auto; margin-right: auto;}

		#recaptcha_area { margin: auto;}
	</style>



<div class="jumbotron">
	<h1 style="margin: 0 0 -35px -35px;"><br /><br /><br /><br />
	<b><?php
				echo $title;
			?></b></h1>

</div>
