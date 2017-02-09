
<form action="" method="POST">
		<input type="text" name="name" value="" placeholder="name" />
		<br />
		<input type="text" name="email" value="" placeholder="email" />
		<br />
		<textarea type="text" name="message" placeholder="message" ></textarea>
		<br />
		<br />
		<div class="g-recaptcha" data-sitekey="6Lc7YgwUAAAAADT3e-yW_S4l4IkHggCgBflZP0w8"></div>
		<input type="submit" name="submit" value="SUBMIT">
</form>

<?php

# gKeys for captcha
	define('SITE_KEY','6Lc7YgwUAAAAADT3e-yW_S4l4IkHggCgBflZP0w8');
	define('SECRET_KEY','6Lc7YgwUAAAAAFKlI_cYf1V6_KfK7JOrWZ04lGWH');





/*
array(7) {
	["name"]=> string(5) "werwe"

	["email"]=>  string(8) "re@8.com"

	["message"]=> string(7) "aserear"

	["requestMembership"]=>  string(1) "y"

	["g-recaptcha-response"]=> string(996) "03AHJ_Vut4NZe23DlMvnnUyZ5FHlKXTeTgOuCxxKrw083M3EI-UsCAs0Vh9sKrILN-VBoB2_-dGbOSymaiU1uQCiR5oRc26sJGOsrbct6RCTNZFI5Aax4yo71JIsiIAqRZ4hPZCbUMrG9dZEqjPH0A0BwUNR-z_igu7oSaIRBc5BczkTB_hn-xrcF8X7duPo5G83XKSqL-XyXilvNatMylShhwVFyWksTTNUjpHJ71n2PeBtLyv77ApeFSgvuGKN2MJrY4mXAvfYqNtAI01ZEvBtjjo4dcGM_1TMAOxXNTOvPo2mUojXribZBrfWJmP7nVy2Vla4dDEh_O1mRXDaDv-HMJ5VGsdcWp6Kf2QffnqwwvsBCfM1JLBo0rrywA1XHY11ITGnLRq8tjy1BQI54In8UlJzlBDFwKGHh6Q6NfDjzVZR4C4jyv3IJmzIfaqbOz4AvOhvY6cZD-uhO3cE7evMTDtP1KObLucDyz3A_YD_8Jok99GBUFJhVYO3egqliS4obcF4twqhEb0mh71a3mlaupzEvCqqECd8a8iN6hcCaPWhdXWVS8ZxijAMgpXx1RDhP-x7cbso_KVB7x0KiwN9VisdA2c05WhXw0uwPJ0fxiZbhEetgfPdc9JEyQWuU_jajqI0Uk1SXAhjKxalCZl0bHbH2qnbt229orp6M7cSS_kVeIGXC9A7-3oHl_A0NAJ8lB3Etf3C6MtjXC35pfsvgT34Bxc_7C_8AtGJje0HWVXpQZCyIzd5Xz6RcfqDpsQlbuUmRzoOi1hBW73-WUgXus8-vXZiTnbXUtTAJ7QeK74wUuKQh_JlASU_RJ7c4XWaV-z1R0rjU7KHxib7RrN_FQsSrFKeOVqpiYWVD6bJnE86czEZ3hjI44Cml5AGH2ke_LwKQgGPp9k9wGyAZflWiOkcjpebtAO0VIEZhMBFV0UCNfW4GqtP2cptVQXVLuvnGNasgrQVUjTrYM2l7IWASFI9Fn0djutg"

 ["badBot"]=> string(7) "wqerewr"

	["urlPointer"]=> string(45) "http://marvel-champions.com/library/about.php"
}

*/


if(isset($_POST['email']) && !empty($_POST['email'])):
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
				//your site secret key
				$secret = '6Lc7YgwUAAAAAFKlI_cYf1V6_KfK7JOrWZ04lGWH';
				//get verify response data
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
				$responseData = json_decode($verifyResponse);
				if($responseData->success):
						//contact form submission code
						$name = !empty($_POST['name'])?$_POST['name']:'';
						$email = !empty($_POST['email'])?$_POST['email']:'';
						$message = !empty($_POST['message'])?$_POST['message']:'';

						$to = 'monkeework@gmail.com';
						$subject = 'New contact form have been submitted';
						$htmlContent = "
								<h1>Contact request details</h1>
								<p><b>Name: </b>".$name."</p>
								<p><b>Email: </b>".$email."</p>
								<p><b>Message: </b>".$message."</p>
						";
						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						// More headers
						$headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
						//send email
						@mail($to,$subject,$htmlContent,$headers);

						$succMsg = 'Your contact request have submitted successfully.';
				else:
						$errMsg = 'Robot verification failed, please try again.';
				endif;
		else:
				$errMsg = 'Please click on the reCAPTCHA box.';
		endif;
else:
		$errMsg = '';
		$succMsg = '';
endif;
?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
