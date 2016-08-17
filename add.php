<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Ajouter un partage à Samba</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			require_once "/var/www/html/smb/conf.php";
		?>
		
		<p>Si vous configurez un partage sans authentification, <b>ne rien mettre</b> dans le champ 'Utilisateur autorisé à accéder au partage".</p>
		
		<form method="POST" action='?action=add'>
			
			<label for="pname">Nom du partage à créer :<br />
				<input type="text" name="pname" id="pname" placeholder="Entrez ici le nom"/>
			</label><br /><br />
			
			<label for="ppath">Emplacement du partage :<br />
				<input type="text" name="ppath" id="ppath" placeholder="Entrez ici le chemin"/>
			</label><br /><br />
			
			<label for="browseable">Le partage doit-il être navigable ?<br />
				<select name="browseable" id="browseable">
					<option value='yes'>Oui</option>
					<option value='no'>Non</option>
				</select>
			</label><br /><br />
			
			<label for="guest">Le partage sera-t-il accessible sans authentification ?<br />
				<select name="guest" id="guest" >
					<option value='yes'>Oui</option>
					<option value='no' selected="selected">Non</option>
				</select>
			</label><br /><br />
			
			<label for="validuser">Utilisateur autorisé à accéder au partage :<br />
				<input type="text" name="validuser" id="validuser" placeholder="Nom d'utilisateur"/>
			</label><br /><br />
			
			<label for="public">Le partage sera-t-il public ?<br />
				<select name="public" id="public" >
					<option value='yes'>Oui</option>
					<option value='no' selected="selected">Non</option>
				</select>
			</label><br /><br />
			
			<label for="adminuser">Administrateur du partage : (utilisateur recommandé : carlo)<br />
				<input type="text" name="adminuser" id="adminuser" placeholder="Nom d'utilisateur"/>
			</label><br /><br />
			
			<label for="writable">Le partage sera-t-il autorisé en écriture ?<br />
				<select name="writable" id="writable">
					<option value='yes'>Oui</option>
					<option value='no'>Non</option>
				</select>
			</label><br /><br />
			
			<input type="submit" value="Ajouter" name="complete"/><br /><br />
			
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