<?php
/*
 +=====================================================================+
 | pro-check.php  (c) NinTechNet - http://nintechnet.com/              |
 |                                                                     |
 | Revision: 2015-01-28 12:11:32                                       |
 +=====================================================================+
*/
$version = '1.01';
/*
 +=====================================================================+
 | NinjaFirewall's (Pro/Pro+ Edition) troubleshooter script            |
 +=====================================================================+
 | 1. Rename this file to "pro-check.php".                             |
 | 2. Upload it into your website root folder.                         |
 | 3. Go to http://YOUR WEBSITE/pro-check.php                          |
 | 4. Delete it afterwards.                                            |
 +=====================================================================+
*/
if (version_compare(PHP_VERSION, '5.4', '<') ) {
	if (! session_id() ) {
		session_start();
	}
} else {
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?><html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<style>.tdb{background: none repeat scroll 0% 0% #F1F1F1}</style>
</head>
<body style="font-family: 'Open Sans',sans-serif;">
<h3>NinjaFirewall (Pro edition) troubleshooter</h3>
<table width="100%" border="0" cellpadding="4" cellspacing="0">
	<tr class="tdb">
		<th width="30%">HTTP server</th>
		<td>:</td>
		<td>
		<?php
		if (! empty( $_SERVER['SERVER_SOFTWARE'] ) ) {
			echo $_SERVER['SERVER_SOFTWARE'];
		} else {
			echo '<font color="orange">unknown</font>';
		}
		?>
		</td>
	</tr>
	<tr>
		<th width="30%">PHP version</th>
		<td>:</td>
		<td>
		<?php
		if ( defined('PHP_VERSION') ) {
			if ( version_compare( PHP_VERSION, '5.5', '<' ) ) {
				echo PHP_VERSION . ': <font color="red">Error, NinjaFirewall requires PHP 5.5 or greater</font>';
			} else {
				echo PHP_VERSION;
			}
		} else {
			echo '<font color="orange">unknown</font>';
		}
		?>
		</td>
	</tr>
	<tr class="tdb">
		<th width="30%">PHP SAPI</th>
		<td>:</td>
		<td>
		<?php
		if ( defined('PHP_SAPI') ) {
			echo strtoupper( PHP_SAPI );
			if ( defined('HHVM_VERSION') ) {
				echo ' (HHVM detected)';
			}
		} else {
			echo '<font color="orange">unknown</font>';
		}
		?>
		</td>
	</tr>
	<tr><th width="30%">&nbsp;</th><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr class="tdb">
		<th width="30%">auto_prepend_file</th>
		<td>:</td>
		<td>
		<?php
		$res = ini_get('auto_prepend_file');
		if ( $res ) {
			echo $res;
		} else {
			echo 'none';
		}
		?>
		</td>
	</tr>
	<tr>
		<th width="30%">NinjaFirewall detection</th>
		<td>:</td>
		<td>
		<?php
		if ( defined('NFW_STATUS') ) {
			if (NFW_STATUS == 20) {
				$res = 'NinjaFirewall WP Edition is loaded';
			} elseif (NFW_STATUS == 21) {
				$res = 'NinjaFirewall WP+ Edition is loaded';
			} elseif (NFW_STATUS == 22) {
				$res = 'NinjaFirewall Pro Edition is loaded';
			} elseif (NFW_STATUS == 23) {
				$res = 'NinjaFirewall Pro+ Edition is loaded';
			} else {
				$res = '<font color="red">NinjaFirewall is loaded but returned error code #'. NFW_STATUS .'</font>';
			}
		} else {
			$res = '<font color="red">NinjaFirewall is not loaded</font>';
		}
		echo $res;
		?>
		</td>
	</tr>
	<tr class="tdb"><th width="30%">&nbsp;</th><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<th width="30%">Loaded INI file</th>
		<td>:</td>
		<td>
		<?php
		$res = php_ini_loaded_file();
		if ( $res ) {
			echo $res;
		} else {
			echo 'none';
		}
		?>
		</td>
	</tr>
	<tr class="tdb">
		<th width="30%">user_ini.filename</th>
		<td>:</td>
		<td>
		<?php
		$res = ini_get('user_ini.filename');
		if ( $res ) {
			echo $res;
		} else {
			echo 'none';
		}
		?>
		</td>
	</tr>
	<tr>
		<th width="30%">user_ini.cache_ttl</th>
		<td>:</td>
		<td>
		<?php
		$res = ini_get('user_ini.cache_ttl');
		if ( $res ) {
			echo $res . ' seconds';
		} else {
			echo 'none';
		}
		?>
		</td>
	</tr>
	<tr>
		<th width="30%">User PHP INI</th>
		<td>:</td>
		<td>
		<?php
		$res = $count = '';
		if ( file_exists('php.ini' ) ) {
			$res = 'php.ini found - ';
			$count++;
		}
		if ( file_exists('php5.ini' ) ) {
			$res .= 'php5.ini found - ';
			$count++;
		}
		if ( file_exists('.user.ini' ) ) {
			$res .= '.user.ini found - ';
			$count++;
		}
		if ( $res ) {
			echo $res;
			if ($count > 1) {
				echo '<font color="red">Warning: you have more than one INI file</font>';
			}
		} else {
			echo "none found";
		}
		?>
		</td>
	</tr>
	<tr class="tdb"><th width="30%">&nbsp;</th><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<th width="30%">DOCUMENT_ROOT</th>
		<td>:</td>
		<td>
		<?php
		$res = getenv('DOCUMENT_ROOT');
		if ( $res ) {
			echo $res;
		} else {
			echo '<font color="red">Error: cannot find your DOCUMENT_ROOT</font>';
		}
		?>
		</td>
	</tr>
	<?php
	if ( @file_exists( $file = dirname(getenv('DOCUMENT_ROOT') ) . '/.htninja') ) {
		?>
		<tr>
		<th width="30%">.htninja</th>
		<td>:</td>
		<td>
		<?php
		echo 'found in '. dirname(getenv('DOCUMENT_ROOT') ) . '/.htninja';
		?>
		</td>
	</tr>
	<?php
	}
	?>
</table>
<p><code>NinjaFirewall (Pro edition) troubleshooter v<?php echo $version ?></code></p>
</body>
</html>
