<?php
	session_start();
	require_once 'includes/fonctionsqli.php';
	require_once 'includes/panier.php';
	$lien = connexionBDD();
    $lien -> set_charset("utf8");
	videArticle();
	header("Location:feraud-mon-panier-liste-produits-boutique-peinture");
	deconnexionBDD($lien);
?>