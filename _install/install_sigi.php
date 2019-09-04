<?php defined('SYSPATH') or die('No direct script access.');

if (version_compare(PHP_VERSION, '5.3', '<'))
{
	// Clear out the cache to prevent errors. This typically happens on Windows/FastCGI.
	clearstatcache();
}
else
{
	// Clearing the realpath() cache is only possible PHP 5.3+
	clearstatcache(TRUE);
}

?>


<?php
function getRelativePath( $path, $compareTo ) {
        // clean arguments by removing trailing and prefixing slashes
        if ( substr( $path, -1 ) == '/' ) {
            $path = substr( $path, 0, -1 );
        }
        if ( substr( $path, 0, 1 ) == '/' ) {
            $path = substr( $path, 1 );
        }

        if ( substr( $compareTo, -1 ) == '/' ) {
            $compareTo = substr( $compareTo, 0, -1 );
        }
        if ( substr( $compareTo, 0, 1 ) == '/' ) {
            $compareTo = substr( $compareTo, 1 );
        }

        // simple case: $compareTo is in $path
        if ( strpos( $path, $compareTo ) === 0 ) {
            $offset = strlen( $compareTo ) + 1;
            return substr( $path, $offset );
        }

        $relative  = array(  );
        $pathParts = explode( '/', $path );
        $compareToParts = explode( '/', $compareTo );

        foreach( $compareToParts as $index => $part ) {
            if ( isset( $pathParts[$index] ) && $pathParts[$index] == $part ) {
                continue;
            }

            $relative[] = '..';
        }

        foreach( $pathParts as $index => $part ) {
            if ( isset( $compareToParts[$index] ) && $compareToParts[$index] == $part ) {
                continue;
            }

            $relative[] = $part;
        }

        return implode( '/', $relative );
    }
    
function generatePassword($length=8) {
	include_once('pwgen.class.php');
    $pwgen = new PWGen($length);
    $password = $pwgen->generate();
    return $password;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sigi3.4 Installation</title>

	<style type="text/css">
	body { width: 42em; margin: 0 auto; font-family: sans-serif; background: #fff; font-size: 1em; }
	h1 { letter-spacing: -0.04em; }
	h2 { letter-spacing: -0.04em; padding-top: .4em; }
	h1 + p { margin: 0 0 2em; color: #333; font-size: 90%; font-style: italic; }
	h2 + p { margin: 0 0 2em; color: #333; font-size: 90%; font-style: italic; }
	code { font-family: monaco, monospace; }
	table { border-collapse: collapse; width: 100%; }
		table th,
		table td { padding: 0.4em; text-align: left; vertical-align: top; }
		table th { width: 12em; font-weight: normal; }
		table tr:nth-child(odd) { background: #eee; }
		table td.pass { color: #191; }
		table td.fail { color: #911; }
	#results { padding: 0.8em; color: #fff; font-size: 1.5em; }
	#results.pass { background: #191; }
	#results.attention { background: #E6E600; color: #333;}
	#results.fail { background: #911; }
	</style>

</head>
<body>

	
	<form action="" method="post"> 

<?php if (isset($_POST['next_installation_step'])): ?>


	
	
	
	<?php // STEP 1 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php if ($_POST["next_installation_step"]=='1'): ?>
		
		<h1>Sigi3.4 Installation  (1 of 6)</h1>
		<h2>Environment Tests</h2>
		<p>
			The following tests have been run to determine if Sigi and Kohana will work in your environment.
			If any of the tests have failed, consult the <a href="http://kohanaframework.org/guide/about.install">Kohana documentation</a>
			for more information on how to correct the problem.
		</p>
	
		<?php $failed = FALSE ?>
	
		<table cellspacing="0">
			<tr>
				<th>PHP Version</th>
				<?php if (version_compare(PHP_VERSION, '5.2.3', '>=')): ?>
					<td class="pass"><?php echo PHP_VERSION ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">Sigi3 requires PHP 5.2.3 or newer, this version is <?php echo PHP_VERSION ?>.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>PCRE UTF-8</th>
				<?php if ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>
					<td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with UTF-8 support.</td>
				<?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
					<td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with Unicode property support.</td>
				<?php else: ?>
					<td class="pass">Pass</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>SPL Enabled</th>
				<?php if (function_exists('spl_autoload_register')): ?>
					<td class="pass">Pass</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">PHP <a href="http://www.php.net/spl">SPL</a> is either not loaded or not compiled in.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>Reflection Enabled</th>
				<?php if (class_exists('ReflectionClass')): ?>
					<td class="pass">Pass</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">PHP <a href="http://www.php.net/reflection">reflection</a> is either not loaded or not compiled in.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>Filters Enabled</th>
				<?php if (function_exists('filter_list')): ?>
					<td class="pass">Pass</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <a href="http://www.php.net/filter">filter</a> extension is either not loaded or not compiled in.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>Iconv Extension Loaded</th>
				<?php if (extension_loaded('iconv')): ?>
					<td class="pass">Pass</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <a href="http://php.net/iconv">iconv</a> extension is not loaded.</td>
				<?php endif ?>
			</tr>
			<?php if (extension_loaded('mbstring')): ?>
			<tr>
				<th>Mbstring Not Overloaded</th>
				<?php if (ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING): $failed = TRUE ?>
					<td class="fail">The <a href="http://php.net/mbstring">mbstring</a> extension is overloading PHP's native string functions.</td>
				<?php else: ?>
					<td class="pass">Pass</td>
				<?php endif ?>
			</tr>
			<?php endif ?>
			<tr>
				<th>Character Type (CTYPE) Extension</th>
				<?php if ( ! function_exists('ctype_digit')): $failed = TRUE ?>
					<td class="fail">The <a href="http://php.net/ctype">ctype</a> extension is not enabled.</td>
				<?php else: ?>
					<td class="pass">Pass</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>URI Determination</th>
				<?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>
					<td class="pass">Pass</td>
				<?php else: $failed = TRUE ?>
					<td class="fail">Neither <code>$_SERVER['REQUEST_URI']</code>, <code>$_SERVER['PHP_SELF']</code>, or <code>$_SERVER['PATH_INFO']</code> is available.</td>
				<?php endif ?>
			</tr>
		</table>
	
		<h2>Optional Tests</h2>
	
		<p>
			The following extensions are not required to run the Kohana core, but if enabled can provide access to additional classes.
		</p>
	
		<table cellspacing="0">
			<tr>
				<th>PECL HTTP Enabled</th>
				<?php if (extension_loaded('http')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Kohana can use the <a href="http://php.net/http">http</a> extension for the Request_Client_External class.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>cURL Enabled</th>
				<?php if (extension_loaded('curl')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Kohana can use the <a href="http://php.net/curl">cURL</a> extension for the Request_Client_External class.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>mcrypt Enabled</th>
				<?php if (extension_loaded('mcrypt')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Kohana requires <a href="http://php.net/mcrypt">mcrypt</a> for the Encrypt class.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>GD Enabled</th>
				<?php if (function_exists('gd_info')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Kohana requires <a href="http://php.net/gd">GD</a> v2 for the Image class.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>MySQL Enabled</th>
				<?php if (function_exists('mysql_connect')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Kohana can use the <a href="http://php.net/mysql">MySQL</a> extension to support MySQL databases.</td>
				<?php endif ?>
			</tr>
			<tr>
				<th>PDO Enabled</th>
				<?php if (class_exists('PDO')): ?>
					<td class="pass">Pass</td>
				<?php else: ?>
					<td class="fail">Kohana can use <a href="http://php.net/pdo">PDO</a> to support additional databases.</td>
				<?php endif ?>
			</tr>
		</table>
		
			<?php if ($failed === TRUE): ?>
			<p id="results" class="fail">✘ Sigi3 may not work correctly with your environment.<br />
				You have to fix these problems before Sigi3 installation can continue.</p>
				<input type="hidden" name="next_installation_step" id="next_installation_step" value="1" />
			<p><input type="submit" value="Retry" /></p>
		<?php else: ?>
			<p id="results" class="pass">✔ Your environment passed all requirements to install Sigi3</p>
			
			<input type="hidden" name="next_installation_step" id="next_installation_step" value="2" />
			<p><input type="submit" value="Continue" /></p>
		<?php endif ?>
	
	
	
	
	<?php // STEP 2 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ($_POST["next_installation_step"]=='2'): ?>
	
	<?php $failed = FALSE ?>
	
	<h1>Sigi3 Installation  (2 of 6)</h1>
		<h2>File Access Rights &amp; Structure</h2>
		<p>
			The following Paths need to be writable by the webserver and need to exist to make the installer and Sigi3 work correctly.<br />
			The paths are relative to the Doc-Root: <b><?php echo $_SERVER['DOCUMENT_ROOT']?></b><br />
		</p>
		<?php
		$path_info = pathinfo(__FILE__);
		$path = realpath($path_info["dirname"] . "/../"); ?>
		
		
		
		<table cellspacing="0">	
			<tr>
			<th>Cache Directory</th>
				<?php 
				if ( is_dir($path.'/application/cache')){
					if (is_writable($path.'/application/cache')){
					?>
						<td class="pass"><?php echo '/application/cache' ?></td>
					<?
					}else{
						if(chmod($path.'application/cache', 0777)){
							?>
							<td class="pass"><?php echo '/application/cache' ?></td>
							<?
						}else{
							$failed = TRUE;
							?>
							<td class="fail">The <code><?php echo '/application/cache' ?></code> directory is not writable.</td>
							<?
						}
					}					
				}else{
					if(mkdir($path.'/application/cache')){
						?>
						<td class="pass"><?php echo '/application/cache' ?></td>
						<?
					}else{
						$failed = TRUE;
						?>
						<td class="fail">The <code><?php echo '/application/cache' ?></code> directory does not exist and refuses to be created.</td>
						<?
					}
				}
				?>
			</tr>
			
			
			<tr>
			<th>Logs Directory</th>
				<?php 
				if ( is_dir($path.'/application/logs')){
					if (is_writable($path.'/application/logs')){
					?>
						<td class="pass"><?php echo '/application/logs' ?></td>
					<?
					}else{
						if(chmod($path.'application/cache', 0777)){
							?>
							<td class="pass"><?php echo '/application/logs' ?></td>
							<?
						}else{
							$failed = TRUE;
							?>
							<td class="fail">The <code><?php echo '/application/logs' ?></code> directory is not writable.</td>
							<?
						}
					}					
				}else{
					if(mkdir($path.'/application/logs')){
						?>
						<td class="pass"><?php echo '/application/logs' ?></td>
						<?
					}else{
						$failed = TRUE;
						?>
						<td class="fail">The <code><?php echo '/application/logs' ?></code> directory does not exist and refuses to be created.</td>
						<?
					}
				}
				?>
			</tr>
			
			
			<tr>
			<th>Backups Directory</th>
				<?php 
				if ( is_dir($path.'/application/backups')){
					if (is_writable($path.'/application/backups')){
					?>
						<td class="pass"><?php echo '/application/backups' ?></td>
					<?
					}else{
						if(chmod($path.'application/backups', 0777)){
							?>
							<td class="pass"><?php echo '/application/backups' ?></td>
							<?
						}else{
							$failed = TRUE;
							?>
							<td class="fail">The <code><?php echo '/application/backups' ?></code> directory is not writable.</td>
							<?
						}
					}					
				}else{
					if(mkdir($path.'/application/backups')){
						?>
						<td class="pass"><?php echo '/application/backups' ?></td>
						<?
					}else{
						$failed = TRUE;
						?>
						<td class="fail">The <code><?php echo '/application/backups' ?></code> directory does not exist and refuses to be created.</td>
						<?
					}
				}
				?>
			</tr>
			
		
			<tr>
			<th>Upload Directory</th>
				<?php 
				if ( is_dir($path.'/media/upload')){
					if (is_writable($path.'/media/upload')){
					?>
						<td class="pass"><?php echo '/media/upload' ?></td>
					<?
					}else{
						if(chmod($path.'media/upload', 0777)){
							?>
							<td class="pass"><?php echo '/media/upload' ?></td>
							<?
						}else{
							$failed = TRUE;
							?>
							<td class="fail">The <code><?php echo '/media/upload' ?></code> directory is not writable.</td>
							<?
						}
					}					
				}else{
					if(mkdir($path.'/media/upload')){
						?>
						<td class="pass"><?php echo '/media/upload' ?></td>
						<?
					}else{
						$failed = TRUE;
						?>
						<td class="fail">The <code><?php echo '/media/upload' ?></code> directory does not exist and refuses to be created.</td>
						<?
					}
				}
				?>
			</tr>
			
			<tr>
			<th>Media Cache Directory</th>
				<?php 
				if ( is_dir($path.'/media/cache')){
					if (is_writable($path.'/media/cache')){
					?>
						<td class="pass"><?php echo '/media/cache' ?></td>
					<?
					}else{
						if(chmod($path.'media/cache', 0777)){
							?>
							<td class="pass"><?php echo '/media/cache' ?></td>
							<?
						}else{
							$failed = TRUE;
							?>
							<td class="fail">The <code><?php echo '/media/cache' ?></code> directory is not writable.</td>
							<?
						}
					}					
				}else{
					if(mkdir($path.'/media/cache')){
						?>
						<td class="pass"><?php echo '/media/cache' ?></td>
						<?
					}else{
						$failed = TRUE;
						?>
						<td class="fail">The <code><?php echo '/media/cache' ?></code> directory does not exist and refuses to be created.</td>
						<?
					}
				}
				?>
			</tr>
					
			
			<th>.htaccess File</th>
				<?php if (is_writable($path.'/.htaccess')): ?>
					<td class="pass"><?php echo '/.htaccess' ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code><?php echo '/.htaccess' ?></code> File is not writable.</td>
				<?php endif ?>
			</tr>
			<tr>
			<th>Index File</th>
				<?php if (is_writable($path.'/index.php')): ?>
					<td class="pass"><?php echo '/index.php' ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code><?php echo '/application/index.php' ?></code> File is not writable.</td>
				<?php endif ?>
			</tr>
			<tr>
			<th>Bootstrap File</th>
				<?php if (is_writable($path.'/application/bootstrap.php')): ?>
					<td class="pass"><?php echo '/application/bootstrap.php' ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code><?php echo '/application/bootstrap.php' ?></code> File is not writable.</td>
				<?php endif ?>
			</tr>
			<tr>
			<th>Database Config File</th>
				<?php if (is_writable($path.'/application/config/database.php')): ?>
					<td class="pass"><?php echo '/application/config/database.php' ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code><?php echo '/application/config/database.php' ?></code> File is not writable.</td>
				<?php endif ?>
			</tr>
			<tr>
			<th>Auth Config File</th>
				<?php if (is_writable($path.'/application/config/auth.php')): ?>
					<td class="pass"><?php echo '/application/config/auth.php' ?></td>
				<?php else: $failed = TRUE ?>
					<td class="fail">The <code><?php echo '/application/config/auth.php' ?></code> File is not writable.</td>
				<?php endif ?>
			</tr>

			
		</table>
		
		<?php if ($failed === TRUE): ?>
			<p id="results" class="fail">✘ Not all necessary files and folders exist and/or are writeable.<br />
				You have to fix these problems before Sigi3 installation can continue.</p>
				<input type="hidden" name="next_installation_step" id="next_installation_step" value="2" />
			<p><input type="submit" value="Retry" /></p>
		<?php else: ?>
			<p id="results" class="pass">✔ All files and folders for Sigi3 seem to be set up correctly.</p>
			
			<input type="hidden" name="next_installation_step" id="next_installation_step" value="3" />
			<p><input type="submit" value="Continue" /></p>
		<?php endif ?>	
	
	
	
		
	
	<?php // STEP 3 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ($_POST["next_installation_step"]=='3'): ?>

	<?php $failed = FALSE ?>
	<h1>Sigi3 Installation  (3 of 6)</h1>
		<h2>Application &amp; Sigi Path</h2>
		<p>
			The following paths have been automagically determined for you... But you can change them if you want.<br />
			The paths are relative to the Doc-Root: <b><?php echo $_SERVER['DOCUMENT_ROOT']?></b><br />
			Omit trailing slashes!
		</p>
		
		<table cellspacing="0">
			<tr>
				<th>Base-URL</th>
				<td class="pass"><input type="text" name="baseUrl" size="36" value="<?php echo dirname($_SERVER['PHP_SELF']) ?>" /></td>
			</tr>
			<tr>
				<th>Sigi3 Path</th>
				<td class="pass"><?php
					$sigiPath = "";
					if (isset($_POST['sigiPath'])) {
						// we're retrying so we might have a variable already
						$sigiPath = $_POST['sigiPath'];
					} else {
						$sigiPath = "/";
					}
						
					if (!is_dir($_SERVER['DOCUMENT_ROOT'].$sigiPath)) {
					
						// sigi's not there... is it in the app-directory?
						$path_info = pathinfo(__FILE__);
						$path = $path_info["dirname"] . "/";
						
						if (is_dir($path)) {
							$sigiPath = dirname($_SERVER['PHP_SELF']). "/";
						} else {
							$failed = TRUE;
						}
					}
					
					?>
				<input type="text" name="sigiPath" size="36" value="<?php echo $sigiPath ?>" />
				</td>
			</tr>
		</table>
		
		<?php if ($failed === TRUE): ?>
			<p id="results" class="fail">✘ Sigi3 was not found at the specified location.</p>
				<input type="hidden" name="next_installation_step" id="next_installation_step" value="3" />
			<p><input type="submit" value="Retry" /></p>
		<?php else: ?>
			<p id="results" class="pass">✔ Sigi3 was found.</p>
			
			<input type="hidden" name="next_installation_step" id="next_installation_step" value="4" />
			<p><input type="submit" value="Continue" /></p>
		<?php endif ?>	
	
	
	
	<?php // STEP 4 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ($_POST["next_installation_step"]=='4'): ?>

	<?php $failed = FALSE ?>
	<input type="hidden" name="sigiPath" size="36" value="<?php echo $_POST['sigiPath'] ?>" />
	<input type="hidden" name="baseUrl" size="36" value="<?php echo $_POST['baseUrl'] ?>" />
	
	<?php
		$creatingDatabase = FALSE;
		if (isset($_POST['submit'])) {
			if ($_POST['submit']=="Create Database") {
				$creatingDatabase=TRUE;
			}
		}
	?>
	
	<h1>Sigi3 Installation (4 of 6)</h1>
		<h2>Database</h2>
		<p>
			The following database information has been automagically determined for you. You can change it if you want. 
		</p>
		
		<?php
		$dbHostname="localhost";
		if (isset($_POST['dbHostname'])) { $dbHostname = $_POST['dbHostname']; }
		
		$dbDatabase=substr( $_POST['baseUrl'], 1 );
		if ($dbDatabase=="") {
			$dbDatabase="sigi";
		}
		if (isset($_POST['dbDatabase'])) { $dbDatabase = $_POST['dbDatabase']; }
		
		$dbUsername="root";
		if (isset($_POST['dbUsername'])) { $dbUsername = $_POST['dbUsername']; }
		
		$dbPassword="root";
		if (isset($_POST['dbPassword'])) { $dbPassword = $_POST['dbPassword']; }
		
		$dbError="";
		
		if ($creatingDatabase) {
			@$mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword);
			if ($mysqli->connect_errno) {
				$failed = TRUE;
 				$dbError= $mysqli->connect_errno . " " . $mysqli->connect_error;
			} else {
				@$mysqli->query();
				$result = $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $dbDatabase);
				if (!$result) {
					$failed = TRUE;
					$dbError= $mysqli->connect_errno . " " . $mysqli->error;
				}
			}
		} else {
			@$mysqli = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbDatabase);
			if ($mysqli->connect_errno) {
				$failed = TRUE;
 				$dbError= $mysqli->connect_errno . " " . $mysqli->connect_error;
			} 
		}
		
		
		
		?>
		<table cellspacing="0">
			<tr>
				<th>Hostname</th>
				<td class="pass"><input type="text" name="dbHostname" size="36" value="<?php echo $dbHostname ?>" /></td>
			</tr>
			<tr>
				<th>Database</th>
				<td class="pass"><input type="text" name="dbDatabase" size="36" value="<?php echo $dbDatabase ?>" /></td>
			</tr>
			<tr>
				<th>Username</th>
				<td class="pass"><input type="text" name="dbUsername" size="36" value="<?php echo $dbUsername ?>" /></td>
			</tr>
			<tr>
				<th>Password</th>
				<td class="pass"><input type="text" name="dbPassword" size="36" value="<?php echo $dbPassword ?>" /></td>
			</tr>
		</table>
		
		<?php if ($failed === TRUE): ?>
			<?php if ($creatingDatabase): ?>
				<p id="results" class="fail">✘ Database could not be created: <br /><?php echo $dbError ?></p>
					<input type="hidden" name="next_installation_step" id="next_installation_step" value="4" />
				<p><input type="submit" name="submit" value="Retry Connection" /><input type="submit" name="submit" value="Create Database" /></p>
			<?php else: ?>
				<p id="results" class="fail">✘ Database Problem: <br /><?php echo $dbError ?></p>
					<input type="hidden" name="next_installation_step" id="next_installation_step" value="4" />
				<p><input type="submit" name="submit" value="Retry Connection" /><input type="submit" name="submit" value="Create Database" /></p>
			<?php endif ?>
		<?php else: ?>
			<p id="results" class="pass">✔ Database is ready to be populated.</p>
			
			<input type="hidden" name="next_installation_step" id="next_installation_step" value="5" />
			<p><input type="submit" value="Continue" /></p>
		<?php endif ?>		
	
	
	
	
	<?php // STEP 5 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	
	<?php elseif ($_POST["next_installation_step"]=='5'): ?>

	<?php $failed = FALSE ?>
	<input type="hidden" name="sigiPath" size="36" value="<?php echo $_POST['sigiPath'] ?>" />
	<input type="hidden" name="baseUrl" size="36" value="<?php echo $_POST['baseUrl'] ?>" />
	<input type="hidden" name="dbHostname" size="36" value="<?php echo $_POST['dbHostname'] ?>" />
	<input type="hidden" name="dbDatabase" size="36" value="<?php echo $_POST['dbDatabase'] ?>" />
	<input type="hidden" name="dbUsername" size="36" value="<?php echo $_POST['dbUsername'] ?>" />
	<input type="hidden" name="dbPassword" size="36" value="<?php echo $_POST['dbPassword'] ?>" />
	
	<h1>Sigi3 Installation (5 of 6)</h1>
		<h2>Ready To Rock!</h2>
		<p>
			Are we ready to complete the setup? 
		</p>
		
		<table cellspacing="0">
			<tr>
				<th>SQL to import</th>
				<?php 
					$path_info = pathinfo(__FILE__);
					$path = realpath($path_info["dirname"] . "/../application/backups/factory_settings.sql");
				?>
				<?php if (is_file($path)):?>
					<td class="pass">/application/backups/factory_settings.sql</td>
				<?php else:?>
					<?php $failed = TRUE ?>
					<td class="fail">/application/backups/factory_settings.sql</td>
				<?php endif ?>
			</tr>
		</table>
		
		<?php if ($failed === TRUE): ?>
			<p id="results" class="fail">✘ SQL-File not found!</p>
				<input type="hidden" name="next_installation_step" id="next_installation_step" value="5" />
			<p><input type="submit" value="Retry" /></p>
		<?php else: ?>
			<p id="results" class="pass">✔ Ready to create application</p>
			<p id="results" class="attention">✘ Attention! Existing data in the database will be overwritten!</p>
			<input type="hidden" name="next_installation_step" id="next_installation_step" value="6" />
			<p><input type="submit" value="Populate database and create config files" /></p>
		<?php endif ?>		
	
	
	
	<?php // STEP 6 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>

	<?php elseif ($_POST["next_installation_step"]=='6'): ?>
	<?php $failed = FALSE;
		$indexFileOk = "0";
		$bootstrapFileOk = "0";
		$databaseFileOk = "0";
		$authFileOk = "0";
		$ckeditorFileOk = "0";
		$htaccessFileOk = "0";
		$databaseImportOk = "0";
		$administratorPasswordOk = "0";
		
		
		if (isset($_POST['indexFileOk'])) { $indexFileOk = $_POST['indexFileOk']; }
		if (isset($_POST['bootstrapFileOk'])) { $bootstrapFileOk = $_POST['bootstrapFileOk']; }
		if (isset($_POST['databaseFileOk'])) { $databaseFileOk = $_POST['databaseFileOk']; }
		if (isset($_POST['authFileOk'])) { $databaseFileOk = $_POST['authFileOk']; }
		if (isset($_POST['ckeditorFileOk'])) { $ckeditorFileOk = $_POST['ckeditorFileOk']; }
		if (isset($_POST['htaccessFileOk'])) { $htaccessFileOk = $_POST['htaccessFileOk']; }
		if (isset($_POST['databaseImportOk'])) { $databaseImportOk = $_POST['databaseImportOk']; }
		if (isset($_POST['administratorPasswordOk'])) { $administratorPasswordOk = $_POST['administratorPasswordOk']; }
	
	 ?>
	<input type="hidden" name="sigiPath" size="36" value="<?php echo $_POST['sigiPath'] ?>" />
	<input type="hidden" name="baseUrl" size="36" value="<?php echo $_POST['baseUrl'] ?>" />
	<input type="hidden" name="dbHostname" size="36" value="<?php echo $_POST['dbHostname'] ?>" />
	<input type="hidden" name="dbDatabase" size="36" value="<?php echo $_POST['dbDatabase'] ?>" />
	<input type="hidden" name="dbUsername" size="36" value="<?php echo $_POST['dbUsername'] ?>" />
	<input type="hidden" name="dbPassword" size="36" value="<?php echo $_POST['dbPassword'] ?>" />
	
	<h1>Sigi3 Installation (6 of 6)</h1>
		<h2>Populating Database &amp; Create Config Files</h2>
		<p>
			Crunching....
		</p>
		
		<table cellspacing="0">
			<tr>
			<th>Database Import</th>
			
				<?php
				if (! $databaseImportOk ) {
					$dbError = "";
					@$mysqli = new mysqli($_POST['dbHostname'], $_POST['dbUsername'], $_POST['dbPassword'], $_POST['dbDatabase']);
					if ($mysqli->connect_errno) {
						$failed = TRUE;
 						$dbError= $mysqli->connect_errno . " " . $mysqli->connect_error;
					} else {
						// we have a connection, so try to import
						
						//... but first, clean the table:

						@$mysqli->query('SET foreign_key_checks = 0');

						if ($result = $mysqli->query("SHOW TABLES"))

						{

							while($row = $result->fetch_array(MYSQLI_NUM))

							{

								$mysqli->query('DROP TABLE IF EXISTS '.$row[0]);

							}

						}

						// Done cleaning

									
						
						$path_info = pathinfo(__FILE__);
						$path = realpath($path_info["dirname"] . "/../application/backups/factory_settings.sql");
						@$sql = file_get_contents($path);
						if ($sql) {
						
						
							$queries = explode(";\n",trim($sql));
							$databaseImportOk = "1";
							foreach ($queries as $query)
							{
								$result = $mysqli->query($query);
								if (!$result) {
									$failed = TRUE;
									$databaseImportOk = "0";
									$dbError= $mysqli->connect_errno . " " . $mysqli->error;
									break;
								}
							}
						} else {
							$failed = TRUE;
							$dbError= "can't load SQL file";
						}
						
					}
				}
				
				
				?>
			
				<?php if ($databaseImportOk): ?>
					<td class="pass">Done</td>
				<?php else: $failed = TRUE ?>
					<td class="fail"><?php echo $dbError ?></td>
				<?php endif ?>
			</tr>
			<tr>
			
			<?php
			$path_info = pathinfo(__FILE__);
			$path = realpath($path_info["dirname"] . "/../");
			?>
			
			<th>.htaccess File</th>
				<?php if (is_writable($path.'/.htaccess')) {
				$str=file_get_contents($path.'/install/htaccess.sigi');
				$fp=fopen($path.'/.htaccess','w');
				$str=str_replace('%%%rewritebase%%%',substr($_POST['baseUrl'],1),$str);
				fwrite($fp,$str,strlen($str));
				$htaccessFileOk = "1";
				 ?>
					<td class="pass">Done</td>
				<?php } else { 
					$failed = TRUE
				?>
					<td class="fail">The <code><?php echo '/.htaccess' ?></code> File is not writable.</td>
				<?php } ?>
			</tr>
			
			<?
			/*
			
			Not needed Anymore, index.php remains just as is
			
			<tr>
			
			<th>Index File</th>
				<?php if (is_writable($path.'/index.php')) {
				
				if ($_POST['baseUrl']=="/") {
					$relsigipath = $_POST['sigiPath'];
				} else {
					$relsigipath = getRelativePath($_POST['sigiPath'], $_POST['baseUrl']);
				}
							
				$str=file_get_contents($path.'/install/index.php.sigi');
				$fp=fopen($path.'/index.php','w');
				$str=str_replace('%%%sigipath%%%',$relsigipath,$str);
				fwrite($fp,$str,strlen($str));
				$indexFileOk = "1";
				 
				 ?>
					<td class="pass">Done</td>
				<?php } else { 
					$failed = TRUE
				?>
					<td class="fail">The <code><?php echo '/index.php' ?></code> File is not writable.</td>
				<?php } ?>
			</tr>
			*/
			?>
			
			<tr>
			
			<th>Bootstrap File</th>
				<?php if (is_writable($path.'/application/bootstrap.php')) {
				$str=file_get_contents($path.'/install/bootstrap.php.sigi');
				$fp=fopen($path.'/application/bootstrap.php','w');
				$str=str_replace('%%%baseurl%%%',$_POST['baseUrl'],$str);
				$str=str_replace('%%%cookiesalt%%%',generatePassword(32),$str);
				fwrite($fp,$str,strlen($str));
				$bootstrapFileOk = "1";
				 ?>
					<td class="pass">Done</td>
				<?php } else { 
					$failed = TRUE
				?>
					<td class="fail">The <code><?php echo '/application/bootstrap.php' ?></code> File is not writable.</td>
				<?php } ?>
			</tr>
			<tr>
			<th>Database Config File</th>
				<?php if (is_writable($path.'/application/config/database.php')) {
				$str=file_get_contents($path.'/install/database.php.sigi');
				$fp=fopen($path.'/application/config/database.php','w');
				$str=str_replace('%%%hostname%%%',$_POST['dbHostname'],$str);
				$str=str_replace('%%%database%%%',$_POST['dbDatabase'],$str);
				$str=str_replace('%%%username%%%',$_POST['dbUsername'],$str);
				$str=str_replace('%%%password%%%',$_POST['dbPassword'],$str);
				fwrite($fp,$str,strlen($str));
				$databaseFileOk = "1";
				 ?>
					<td class="pass">Done</td>
				<?php } else { 
					$failed = TRUE
				?>
					<td class="fail">The <code><?php echo '/application/config/database.php' ?></code> File is not writable.</td>
				<?php } ?>
			</tr>
			<tr>
			<th>Auth Config File</th>
				<?php if (is_writable($path.'/application/config/auth.php')) {
				$str=file_get_contents($path.'/install/auth.php.sigi');
				$fp=fopen($path.'/application/config/auth.php','w');
				$hash_key = generatePassword(32);
				$str=str_replace('%%%hashkey%%%',$hash_key,$str);
				fwrite($fp,$str,strlen($str));
				$authFileOk = "1";
				 ?>
					<td class="pass">Done</td>
				<?php } else { 
					$failed = TRUE
				?>
					<td class="fail">The <code><?php echo '/application/config/auth.php' ?></code> File is not writable.</td>
				<?php } ?>
			</tr>
			<tr>
			<th>Administrator Password</th>
			<?
				$dbPWError = "";
					@$mysqli = new mysqli($_POST['dbHostname'], $_POST['dbUsername'], $_POST['dbPassword'], $_POST['dbDatabase']);
					if ($mysqli->connect_errno) {
						$failed = TRUE;
 						$dbPWError= $mysqli->connect_errno . " " . $mysqli->connect_error;
					} else {
						// we have a connection, so try to set password.
						$plainPassword = generatePassword();
						$password = hash_hmac('sha256', $plainPassword, $hash_key);
						$query = "UPDATE users SET password='". $password ."' WHERE username='admin'";
						
						$result = $mysqli->query($query);
						$administratorPasswordOk = "1";
						if (!$result) {
							$failed = TRUE;
							$administratorPasswordOk = "0";
							$dbPWError= $mysqli->connect_errno . " " . $mysqli->error;
						}
						
					}
				 ?>
				 <?php if ($administratorPasswordOk) { ?>
					<td class="pass">Generated</td>
				<?php } else { 
					 $failed = TRUE
			?>
					<td class="fail">Could not save password: <? echo $dbPWError; ?></td>
				<?php } ?>
			</tr>
			
		</table>
		
		<input type="hidden" name="indexFileOk" size="36" value="<?php echo $indexFileOk ?>" />
		<input type="hidden" name="bootstrapFileOk" size="36" value="<?php echo $bootstrapFileOk ?>" />
		<input type="hidden" name="databaseFileOk" size="36" value="<?php echo $databaseFileOk ?>" />
		<input type="hidden" name="authFileOk" size="36" value="<?php echo $authFileOk ?>" />
		<input type="hidden" name="ckeditorFileOk" size="36" value="<?php echo $ckeditorFileOk ?>" />
		<input type="hidden" name="htaccessFileOk" size="36" value="<?php echo $htaccessFileOk ?>" />
		<input type="hidden" name="databaseImportOk" size="36" value="<?php echo $databaseImportOk ?>" />
		<input type="hidden" name="administratorPasswordOk" size="36" value="<?php echo $administratorPasswordOk ?>" />
		
		<?php if ($failed === TRUE): ?>
			<p id="results" class="fail">✘ We had some problems!</p>
			<p id="results" class="attention">Attention! Your administrator password is <br /><br />&nbsp;&nbsp;&nbsp;&nbsp;<code><? echo $plainPassword; ?></code> <br /><br/>keep it for your records!!</p>	
				<input type="hidden" name="next_installation_step" id="next_installation_step" value="6" />
				
			<p><input type="submit" value="Retry" /></p>
		<?php else: ?>
		
			<p id="results" class="attention">Attention! Your administrator password is <br /><br />&nbsp;&nbsp;&nbsp;&nbsp;<code><? echo $plainPassword; ?></code> <br /><br/>keep it for your records!!</p>
			<?php 
			// we try to rename the install directory now. 
			$installFolderOld = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'install';
			$installFolderNew = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'_install';
			$renameSuccess = @rename ($installFolderOld, $installFolderNew); 
			if ($renameSuccess===TRUE) {
			?>
			<p id="results" class="pass">✔ We are done! Have fun using Sigi3! </p>
			<p><input type="submit" value="Start using Sigi now!" /></p>
			<? } else { ?>
			<p id="results" class="pass">✔ We are done! Delete the folder <code>install</code> from your server and have fun using Sigi3! </p>
			<? } ?>
			
		<?php endif ?>	
	
	
	
	<?php endif ?>	
		
	<?php // STEP 0 ////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	
<?php else: ?>
	<input type="hidden" name="next_installation_step" id="next_installation_step" value="1" />
	<h1>Sigi3 Installation</h1>
		<p>
			This will install Sigi3 on your server. 
		</p>
		<p><input type="submit" value="Begin" /></p>

<?php endif ?>
</form>
</body>
</html>
