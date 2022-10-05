<?php
	session_start();
	require_once 'includes/fonctionsqli.php';

	if(estAuthentifieClient()){
		detruireSessionClient();
		$_SESSION['panierfer']['c_reduc_ttc'] = '0';
		$_SESSION['panierfer']['fraisdePort'] = '0';
		$_SESSION['panierfer']['lapromo'] = '0';
	}
header("Location:feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee");
?>
