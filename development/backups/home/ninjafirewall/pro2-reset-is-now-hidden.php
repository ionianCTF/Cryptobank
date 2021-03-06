<?php
/*
 +=====================================================================+
 | pro2-reset.php  (c) NinTechNet - http://nintechnet.com/             |
 |                                                                     |
 | Revision: 2018-03-05                                                |
 +=====================================================================+
*/
$version = '3.1';
/*
 +=====================================================================+
 | Script to reset your NinjaFirewall (Pro/Pro+ Edition) admin         |
 | password.                                                           |
 |           >>     This is for NinjaFirewall v2.x & v3.x  <<          |
  =====================================================================+
 | 1. Rename this file to "pro2-reset.php".                            |
 | 2. Upload it into your NinjaFirewall's folder.                      |
 | 3. Go to http://YOUR WEBSITE/FOLDER/pro2-reset.php                  |
 | 4. Delete it afterwards.                                            |
 +=====================================================================+
*/

if (! file_exists('./conf/options.php')) {
	die('Error #001 : I cannot find ['.dirname( dirname(__FILE__) ).'/conf/options.php] file.<br>aborting.');
}

$msg = '';
$mid = @$_POST['mid'];
if ($mid == 1) {
	$admin = @$_POST['admin'];
	if (! preg_match('/^\w{6,20}$/D', $admin) ) {
		summary('Error #002 : ['. htmlspecialchars($admin) .'] is not a correct username.', 1);
		exit;
	}
	reset_pass($admin);
} else {
	summary($msg, 0);
}
exit;

/* ================================================================ */
function summary($msg, $type) {

	global $version;

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<title></title>
<head><link href="static/styles.css" rel="stylesheet" type="text/css"></head>
<body bgcolor=white class=smallblack>
<font class=tinygrey>NinjaFirewall Password Reset v.'. $version .'</font>
<center>
<br /><br />';
	if ($msg) {
		if ($type == 1) {
			echo '<div class="error" style="width:250px"><p>';
		} else {
			echo '<div class="success" style="width:250px"><p>';
		}
		echo $msg .'</p></div>';
	}

	echo '<p>This script allows you to reset your NinjaFirewall admin password.</p>

<br /><br />
Please enter your admin log-in name :
<br />
<form method=post>
<input type=text class=input name=admin value="" size=25>
<br><br>
<input type=hidden name=mid value=1>
<input type=submit value="Reset Password" class=button>
</form>
</center>
</body>
</html>';

}
/* ================================================================ */
function reset_pass($admin) {

	require(__DIR__ . '/conf/options.php');

	$nfw_options = unserialize($nfw_options);

	if ( empty($nfw_options['admin_name']) ) {
		summary('Error #003: cannot find the admin name in the "/conf/options.php" file', 1);
		exit;
	}

	if ($admin !== $nfw_options['admin_name']){
		summary('Error #004 : cannot find user ['. htmlspecialchars($admin) .'].', 1);
		exit;
	}

	$alphachars =  "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$charlength = strlen($alphachars);
	$password = '';
	for ($i = 1; $i <= 10; $i++) {
		$char = mt_rand(1, $charlength);
		$char = substr($alphachars, $char, 1);
		$password .= $char;
	}

	// PHP <5.5: create SHA-1 hash
	if (! function_exists( 'password_hash' ) || version_compare( PHP_VERSION, '5.5', '<' ) ) {
		$encoded_password = sha1( $password );
	// PHP >=5.5: use password_hash
	} else {
		$encoded_password = password_hash( $password, PASSWORD_DEFAULT, [ 'cost' => 10 ] );
	}

	if ( empty( $encoded_password ) ) {
		summary('Error #005 : error while generating the password hash', 1);
		exit;
	}

	$nfw_options['admin_pass'] = $encoded_password;

	if (! is_writable(__DIR__ . '/conf/options.php') ) {
		summary('Error #006 : "/conf/options.php" is not writable', 1);
		exit;
	}
	if (! $fh = fopen(__DIR__ . '/conf/options.php', 'w') ) {
		summary('Error #007 : cannot write to "/conf/options.php"', 1);
		exit;
	}

	fwrite($fh, '<?php' . "\n\$nfw_options = <<<'EOT'\n" . serialize( $nfw_options ) . "\nEOT;\n" );
	fclose($fh);

	$message = 'Hi ' . $nfw_options['admin_name'] . ',

You have requested to reset your NinjaFirewall admin password.
The request came from IP '. $_SERVER['REMOTE_ADDR'] .' on '. date('Y-m-d'). ' at ' .date('H:i:s O'). '.

You new password : ' . $password . '

Best Regards,

NinjaFirewall Team - http://ninjafirewall.com/
';

	$subject = '[NinjaFirewall] Password reset';
	mail($nfw_options['admin_email'], $subject, $message, null, '-f'. $nfw_options['admin_email']);

	summary('Your new password has been sent to you.', 0);
	echo "Your new password is:";
	echo $password;
	exit;

}
/* ================================================================ */
// EOF
