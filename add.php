<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ajout - Add shared folder to Samba</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			require_once "/var/www/html/smb/conf.php";
		?>
		
		<p>If you want to configure a share without authentification, <b>don't put anything</b> into 'Utilisateur autorisé à accéder au partage" label.</p>
		
		<form method="POST" action='?action=add'>
			
			<label for="pname">Name of share to create :<br />
				<input type="text" name="pname" id="pname" placeholder="Entrez ici le nom"/>
			</label><br /><br />
			
			<label for="ppath">Path of the folder you want share :<br />
				<input type="text" name="ppath" id="ppath" placeholder="Enter path"/>
			</label><br /><br />
			
			<label for="browseable">Do you want it to be browseable ?<br />
				<select name="browseable" id="browseable">
					<option value='yes'>No</option>
					<option value='no'>No</option>
				</select>
			</label><br /><br />
			
			<label for="guest">Do you want to require a login for users ?<br />
				<select name="guest" id="guest" >
					<option value='yes'>No</option>
					<option value='no' selected="selected">Yes</option>
				</select>
			</label><br /><br />
			
			<label for="validuser">Username of allowed user :<br />
				<input type="text" name="validuser" id="validuser" placeholder="User name"/>
			</label><br /><br />
			
			<label for="public">Will the sharing be public ?<br />
				<select name="public" id="public" >
					<option value='yes'>Yes</option>
					<option value='no' selected="selected">No</option>
				</select>
			</label><br /><br />
			
			<label for="adminuser">Sharing administrator :<br />
				<input type="text" name="adminuser" id="adminuser" placeholder="User name"/>
			</label><br /><br />
			
			<label for="writable">Will the sharing be writable ?<br />
				<select name="writable" id="writable">
					<option value='yes'>Yes</option>
					<option value='no'>No</option>
				</select>
			</label><br /><br />
			
			<input type="submit" value="Add" name="complete"/><br /><br />
			
		</form>
	<body>
</html>





<?php

$pname = '';
$ppath = '';
$browseable = '';
$guest = '';
$validuser = '';
$public = '';
$adminuser = '';
$writable = '';

if( isset($_GET['action']) ) {
	if ( $_GET['action'] == 'add' ) {
		$pname = $_POST['pname'];
		$ppath = $_POST['ppath'];
		$browseable = $_POST['browseable'];
		$guest = $_POST['guest'];
		$validuser = $_POST['validuser'];
		$public = $_POST['public'];
		$adminuser = $_POST['adminuser'];
		$writable = $_POST['writable'];

		$l1 = '[' . $pname . ']' . "\n";
		$l2 = 'comment = ' . $ppath . "\n";
		$l3 = 'path = ' . $ppath . "\n";
		$l4 = 'browseable = ' . $browseable . "\n";
		$l5 = 'guest ok = ' . $guest . "\n";
		$l6 = 'valid users = ' . $validuser . "\n";
		$l7 = 'public = ' . $public . "\n";
		$l8 = 'admin users = ' . $adminuser . "\n";
		$l9 = 'writable = ' . $writable . "\n";
		
		$conf_file = fopen(CONF_DIR . $pname . '.conf', 'a+');
		fputs($conf_file, $l1);
		fputs($conf_file, $l2);
		fputs($conf_file, $l3);
		fputs($conf_file, $l4);
		fputs($conf_file, $l5);
		fputs($conf_file, $l6);
		fputs($conf_file, $l7);
		fputs($conf_file, $l8);
		fputs($conf_file, $l9);
		fclose($conf_file);
		
		$file_conf_path = "\n" . 'include = ' . CONF_DIR . $pname . '.conf';	
		$conf_file = fopen(CONF_DIR . 'smb.conf', 'a+'); 
		fputs($conf_file, $file_conf_path);	 
		fclose($conf_file);
		
	}
}
?>
