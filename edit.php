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
		/*echo '
			Contenu du fichier $file : 
			<br><pre>' . $contenu . '</pre>
		';*/
				echo '
			<pre>' . $contenu . '</pre>
		';
		$fname = substr($ligne , '16' , '70');
		echo '<p class="edit_share"><a href=?action=edit&file=' . $fname . ' target="_blank" >Modifier ce contenu</a></p>';
		
		$i++;
	}
	
} else if ( $_GET['action'] == 'edit' ) {
	echo 'good !';
}
	
/*
	$pname = $_POST['pname'];
	$ppath = $_POST['ppath'];
	$browseable = $_POST['browseable'];
	$guest = $_POST['guest'];
	$validuser = $_POST['validuser'];
	$public = $_POST['public'];
	$adminuser = $_POST['adminuser'];
	$writable = $_POST['writable'];

	$d1 = '';
	$d2 = '';

	if ( ( $guest == 'yes' ) OR ( $public = 'yes' ) ) {
		$d1 = '#';
		if ( $public == 'yes' ) 
			$d2 = '#';
	}

	$l1 = '[' . $pname . ']' . "\n";
	$l2 = 'comment = ' . $ppath . "\n";
	$l3 = 'path = ' . $ppath . "\n";
	$l4 = 'browseable = ' . $browseable . "\n";
	$l5 = 'guest ok = ' . $guest . "\n";
	$l6 = $d1 . 'valid users = ' . $validuser . "\n";
	$l7 = 'public = ' . $public . "\n";
	$l8 = $d2 . 'admin users = ' . $adminuser . "\n";
	$l9 = 'writable = ' . $writable . "\n";
	
	echo $l1 . '<br />';
	echo $l2 . '<br />';
	echo $l3 . '<br />';
	echo $l4 . '<br />';
	echo $l5 . '<br />';
	echo $l6 . '<br />';
	echo $l7 . '<br />';
	echo $l8 . '<br />';
	echo $l9 . '<br />';
	
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
	*/

?>