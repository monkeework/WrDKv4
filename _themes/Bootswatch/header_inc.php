<?php
//theme specific functions
include 'bootswatch_functions.php';//WAS bootswatch_functions.php

// handle errors caused by missing session elements
// currently adds privilege == -1
//$priv = sessionChek();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<?php include INCLUDE_PATH . 'meta_inc.php'; ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Bootstrap themes use style settings to change look and feel -->
		<link rel="stylesheet" href="<?=THEME_PATH;?>css/<?=$config->style;?>" media="screen">

        <!-- Calling jquery for carousel -- added 1702-13 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?=THEME_PATH;?>css/bootswatch.min.css">
		<link rel="stylesheet" href="<?=THEME_PATH;?>css/bootswatch-overrides.css">

        <!-- Carousel added 1702-13-->
        <script language="JavaScript" type="text/javascript">
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval: 3000
                })
            });
        </script>

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

