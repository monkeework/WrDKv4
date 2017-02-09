<?php

	//Redirect to protect against spammers
	include './../_inc/config_inc.php';
	header( 'Location: http://www.' . SITE_NAME . '.com' );
