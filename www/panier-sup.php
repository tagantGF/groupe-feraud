<?php
session_start();
require_once 'includes/panier.php';

$identifiant = $_GET['_idp'];
supprimerArticle($identifiant);
	
header("Location:feraud-mon-panier-liste-produits-boutique-peinture");
?>