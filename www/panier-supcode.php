<?php
session_start();
require_once 'includes/panier.php';

supprimerCode();
	
header("Location:feraud-mon-panier-liste-produits-boutique-peinture");
?>