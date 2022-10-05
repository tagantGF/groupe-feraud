<?php
	session_start();
	require_once 'admin/includes/fonctionsqli.php';
	$lien = connexionBDD();
    $lien -> set_charset("utf8");
	function char($text)
{
	$text = htmlentities($text, ENT_NOQUOTES, "UTF-8");
	$text = htmlspecialchars_decode($text);
	return $text;
}
?>
<!doctype html>
<html lang="fr">
<head>

<title>Backoffice de gestion du site Feraud Color</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="admin/css/style.css">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="admin/css/back.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
<?php 
$nomfic = "majdescriptif.csv";
$fichier = @fopen($nomfic, 'r');
$linesCount = 0;
if ($fichier) 
{
   while (!feof($fichier)) 
   {
		if(fgetc($fichier) == "\n")	
		{
			$linesCount++;
		}
   }
	$linesCount++; // pour le EOF
	fclose($fichier);
}
// echo $linesCount."<br>";

$ii = 0;

$fichier = @fopen($nomfic, 'r');
while(!feof($fichier))
{
	$ii++;
	$ligne	= fgets($fichier,4096);
	$ligne	= mb_convert_encoding(utf8_decode($ligne), "UTF-8");
	$element	= explode(";", strip_tags($ligne));
	$_p_id_prod		= $element[0];
	$_p_des_prod	= ($element[1]);
	$req = "update illi21_produits set p_des_com = '$_p_des_prod'  where id_p = '$_p_id_prod' limit 1";
	if($ii > 1) 
	{
				$res_enr_produit = mysqli_query($lien,$req) or die ("Erreur enregistrement produit");
	}
}

// echo $ii."<br>";

?>
    			
</body>
</html>
