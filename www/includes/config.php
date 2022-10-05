<?php

$host = "bqsyhdddeclic.mysql.db"; /* Host name */
$user = "bqsyhdddeclic"; /* User */
$password = "Declic4Feraud"; /* Password */
$dbname = "bqsyhdddeclic"; /* Database name */

/* $host = "localhost"; /* Host name */
/* $user = "root"; /* User */
/* $password = "root"; /* Password */
/* $dbname = "illicoloat349856"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
mysqli_set_charset($con, "utf8");
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

function securiseFormulaire($variable){
	$donnee = $variable;
		
	if(get_magic_quotes_gpc())
		$resultat = $donnee;
	else
		$resultat = addslashes($donnee);	
	
	return $resultat;
}