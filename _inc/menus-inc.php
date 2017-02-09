<?php
/**
 * footer_inc.php provides the right panel and footer for our site pages
 *
 * Includes dynamic copyright data
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see template.php
 * @see header_inc.php
 * @todo none
 */
?>
		




<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
			<div class="container-fluid">
				<a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a href="#" class="brand">Project name</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Link</a></li>
						<li><a href="#">Link</a></li>
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
										<a href="#">2-level Dropdown <i class="icon-arrow-right"></i></a>
										<ul class="dropdown-menu sub-menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
												<li class="divider"></li>
												<li class="nav-header">Nav header</li>
												<li><a href="#">Separated link</a></li>
												<li><a href="#">One more separated link</a></li>
										</ul>
								</li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li class="nav-header">Nav header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
					<form action="" class="navbar-search pull-left">
						<input type="text" placeholder="Search" class="search-query span2">
					</form>
					<ul class="nav pull-right">
						<li><a href="#">Link</a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a class="#" href="#">Menu</a>
						</li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
	</div>
</div>

<hr>

<ul class="nav nav-pills">
<li class="active"><a href="#">Regular link</a></li>
<li class="dropdown">
	<a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown <b class="caret"></b></a>
	<ul class="dropdown-menu" id="menu1">
		<li>
				<a href="#">2-level Menu <i class="icon-arrow-right"></i></a>
				<ul class="dropdown-menu sub-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="nav-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
				</ul>
		</li>
		<li><a href="#">Another action</a></li>
		<li><a href="#">Something else here</a></li>
		<li class="divider"></li>
		<li><a href="#">Separated link</a></li>
	</ul>
</li>
<li class="dropdown">
	<a href="#">Menu</a>
</li>
<li class="dropdown">
	<a href="#">Menu</a>
</li>
</ul>
