<?php
require_once "/var/www/html/smb/conf.php";
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Editer les partages de Samba<?php if ( $_GET['action'] == 'edit' ) echo ' - ' . $_GET['file'] ?></title>
		<meta charset="utf-8"</meta>
	</head>
	<body>

<?php

if ( $_GET['action'] == 'see' ) {
	
	$first_file = fopen(CONF_DIR . 'smb.conf', 'r');
	$contenu_fichier = fread($first_file, filesize (CONF_DIR . 'smb.conf'));
	$nblignes =  substr_count($contenu_fichier, "\n");
	fclose($first_file);
	
	$first_file = fopen(CONF_DIR . 'smb.conf', 'r');
	
	$i = 1;
	while ($i <= $nblignes) {
		$ligne = substr( (fgets($first_file)), '10', '70' );
		$ligne = substr($ligne , '0' , '-1');
		// echo $ligne . '<br /><br />';
		
		$file = $ligne; 
		$contenu = file_get_contents($file);
				echo '
			<pre>' . $contenu . '</pre>
		';
		$fname = substr($ligne , '16' , '70');
		echo '<p class="edit_share"><a href=?action=edit&file=' . $fname . ' target="_blank" >Modifier ce contenu</a></p>';
		
		$i++;
	}
	
} else if ( $_GET['action'] == 'edit' ) {
	// echo 'good !';
	
		$file = CONF_DIR . $_GET['file']; 
		$contenu = file_get_contents($file);
		echo '
			<pre>' . $contenu . '</pre>
		<br /><br />';
		echo '
			<form method="post" action="?action=cedit&file=' . $_GET['file'] . '">
				<textarea wrap="hard" name="file_content" border="2" rows="10" cols="50">' 
					. $contenu . 
				'</textarea>
				<br /><br />
				<input type="submit" value="Valider les modifications" name="complete"/>
			</form>
		';
} else if ( $_GET['action'] == 'cedit' ) {
	
	unlink(CONF_DIR . $_GET['file']);
	
	// $file_conf_path = "\n" . 'include = ' . CONF_DIR . $_GET['file'];	
	$conf_file = fopen(CONF_DIR . $_GET['file'], 'a+'); 
	// fputs($conf_file, $file_conf_path);	 
	
	$ligne = preg_split("/[\n]+/", $_POST['file_content']);
	foreach( $ligne as $row => $value ) {
		echo $value."<br />\n";	 
		fputs($conf_file, $value);
	}
	fclose($conf_file);

	
}

?>