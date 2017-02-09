<?php
//theme specific functions
function maxDoc_themes_header_testBoard_themes(){
	/**
	 * based on dashboard-offCanvasSidebar-master
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @todo add more complicated checkbox & radio button examples
	 */
}

include 'functions-themes.php';
include_once './../_inc/arrays-inc.php'; #called in config-inc.php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<?php
		#$uPriv = $_SESSION['Privilege'];
		echo "<title>" . $_SESSION['UserName'] . "'s Dashboard | Marvel Champions</title>";
	?>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="<?=THEME_PATH;?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=THEME_PATH;?>css/testBoard.css" rel="stylesheet">

	<link rel="shortcut icon" href="<?=VIRTUAL_PATH;?>_img/_mCons/favicon.ico" type="image/x-icon" />
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<!-- BEGIN body -->
	<!-- BEGIN nav -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">

			<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container">
					<div class="pull-left" style="margin-top: 5px; margin-left: -35px;"  >
						<a class="brand" style="position: absolute; left: 0; Top 5px; "  href="#" style="font: white; text-decoration: none;">
							<h4 class=" pull-left" style="font: white;">
								<span style="color: white; text-decoration: none;"><a href="<? echo VIRTUAL_PATH; ?>"><? echo SITE_NAME; ?></a></span>
							</h4>
						</a>
					</div>

					<div class="navbar-header">

						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav pull-right">
							<li><?=bootstrapAdmin(); ?></li>
						</ul>
					</div>
				</nav>
			</div>
<!--
	<form class="navbar-form navbar-right">
		<input type="text" class="form-control" placeholder="Search TBD">
	</form>
-->
		</div>
	</div>
</nav>

	<!-- END nav -->
	<!-- SEE getSideBar() - custom-inc.php for sidebar -->
