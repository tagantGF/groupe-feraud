<?php
session_start();
require_once 'includes/fonctionsqli.php';
require_once 'includes/panier.php';

$lien = connexionBDD();
    $lien -> set_charset("utf8");

	//print_r($_POST);

	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva ORDER BY id_tva ASC;";
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");
	while($tva =  mysqli_fetch_object($res_lect_tva))
	{
		$tauxtva["$tva->id_tva"] = $tva->taux_tva;	
		
	}

if(isset($_POST['idproduit']) and isset($_POST['quantite']))
	{
	$type_prod = 's';
	// Produit simple
	$id_produit = securiseFormulaire($_POST['idproduit']);
	$quantite_produit = securiseFormulaire($_POST['quantite']);
	
	$lect_reference = "SELECT * FROM illi21_produits WHERE id_p = '$id_produit' limit 1;";
	$res_lect_reference = mysqli_query($lien, $lect_reference) or die ("Erreur lecture produits");
	$reference = mysqli_fetch_object($res_lect_reference);
	
	$identifiant = $id_produit."_".$type_prod;	
	$quantite_produit = securiseFormulaire($_POST['quantite']);
	$nomproduit = $reference->p_nom;	
	$typeport =  $reference->p_port;
	
	
	// Recherche les frais de port
	$lect_port = "SELECT montantht FROM illi21_port WHERE idcontenant = '$typeport' limit 1;";
	$res_lect_port = mysqli_query($lien, $lect_port) or die ("Erreur lecture port");
	$leport = mysqli_fetch_object($res_lect_port);
	
	$ports		= $leport->montantht;
	
	
	
	// LE prix HT
	$leprixht =  $reference->p_prix_ht;
	
	
	$leprixht = number_format($leprixht, 2, '.', '');
	$total = $leprixht * $quantite_produit;
	$total = number_format($total, 2, '.', '');
	
	if(mysqli_num_rows($res_lect_reference))
		ajouterProduit($identifiant, $nomproduit, $quantite_produit, $leprixht, $ports, $total ,$type_prod ,$id_produit);

	header("Location:feraud-mon-panier-liste-produits-boutique-peinture");
}else{
	if(isset($_POST['iddeclinaison']) and isset($_POST['quantite']))
		{
		// Produit décliné
		$type_prod = 'm';
		$id_declinaison = securiseFormulaire($_POST['iddeclinaison']);
		$quantite_produit = securiseFormulaire($_POST['quantite']);
		
		$lect_reference = "SELECT * FROM illi21_produits_var WHERE id_decli = '$id_declinaison' limit 1;";
		$res_lect_reference = mysqli_query($lien, $lect_reference) or die ("Erreur lecture produits decliné");
		$reference = mysqli_fetch_object($res_lect_reference);
		
		$lect_produit = "SELECT * FROM illi21_produits WHERE id_p = '$reference->id_prod' limit 1;";
		$res_lect_produit = mysqli_query($lien, $lect_produit) or die ("Erreur lecture produits principal");
		$leproduit = mysqli_fetch_object($res_lect_produit);
		
		$identifiant = $id_declinaison."_".$type_prod;	
		$quantite_produit = securiseFormulaire($_POST['quantite']);
		
		$nomproduit = $leproduit->p_nom." ".$reference->p_nom;	
		$typeport =  $leproduit->p_port;
		
		// Recherche frais de port du produit parent
		$lect_port = "SELECT montantht FROM illi21_port WHERE idcontenant = '$typeport' limit 1;";
		$res_lect_port = mysqli_query($lien, $lect_port) or die ("Erreur lecture port");
		$leport = mysqli_fetch_object($res_lect_port);
		
		$ports		= $leport->montantht;	
		
		
		// calcul du prix
		$leprixht =  $reference->p_prix_ht;
		
		
		$leprixht = number_format($leprixht, 2, '.', '');
		$total = $leprixht * $quantite_produit;
		$total = number_format($total, 2, '.', '');
		
		if(mysqli_num_rows($res_lect_reference))
			ajouterProduit($identifiant, $nomproduit, $quantite_produit, $leprixht, $ports, $total ,$type_prod ,$id_declinaison);
	
		header("Location:feraud-mon-panier-liste-produits-boutique-peinture");
	}else{
		header("Location:feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee");
	}
}

deconnexionBDD($lien);
?>