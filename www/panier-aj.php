<?php
session_start();
require_once 'includes/fonctionsqli.php';
require_once 'includes/panier.php';

$lien = connexionBDD();

// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");
	$tva =  mysqli_fetch_object($res_lect_tva);
	$tauxtva = $tva->taux_tva;

if(isset($_POST['ajoutpanier']))
{
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	
	$id_support   = securiseFormulaire($_POST['supports']);   // id support
	$id_nuancier  = securiseFormulaire($_POST['nuanciers']);  // id nuancier
	
	$id_couleur   = securiseFormulaire($_POST['idacouleur']); // id couleur
	$la_couleur   = securiseFormulaire($_POST['lacouleur']);  // ref de la  couleur
	$rf_couleur   = securiseFormulaire($_POST['larefcoul']);  // ref de la  couleur
	
	$id_apoudre	  = securiseFormulaire($_POST['idapoudre']); // id poudre type pp00000000
	$la_poudre	  = securiseFormulaire($_POST['larefpoudre']);  // ref de la  poudre
	
	$id_contenant = securiseFormulaire($_POST['contenant']);  // id contenant
	if(isset($_POST['brillance']))
	{
		$brillance	  = securiseFormulaire($_POST['brillance']);  // brillance
	}else{
		$brillance	  = "";
	}
	
	$nb_pot		  = securiseFormulaire($_POST['nbpot']);      // nb pots
	$mttc 		  = securiseFormulaire($_POST['mttc']);       // prix TTC
	
	
	
	
	$id_brillance = 0;
	
	switch ($brillance) {
		case "Mat":
			$id_brillance = '1';
			break;
		case "Satin√©":
			$id_brillance = '2';
			break;
		case "Brillant":
			$id_brillance = '3';
			break;
		default :
			$id_brillance = '0';
	}	
	
	// Poudre ou autre
	if($la_poudre <> "" and $id_apoudre <> "")
	{
		// Poudre
		
		
		$requet_      = "SELECT idp_contenant as id, prixttc as prx FROM `illi21_tarifspdr` WHERE `idp_contenant` = ". $id_contenant;
		$resultat_    = mysqli_query($lien, $requet_);
		$lect_res_    = mysqli_fetch_object($resultat_);  
		$prixunitaire = $lect_res_->prx;
		
		
		// Recherche frais de port du contenant poudre
		$lect_port = "SELECT montantht FROM illi21_port WHERE idcontenant = '$id_contenant' and tp = 'p' limit 1;";
		// echo $lect_port;
		$res_lect_port = mysqli_query($lien, $lect_port) or die ("Erreur lecture port");
		$leport = mysqli_fetch_object($res_lect_port);
		
		$ports		= $leport->montantht;	
		// echo $ports;
		$total = $prixunitaire * $nb_pot;
		$total = number_format($total, 2, '.', '');
		$identifiant  = $id_nuancier."_".$id_support."_".$id_apoudre."_".$id_contenant."_".$id_brillance;
		
		ajouterArticle($identifiant, $id_support, $id_nuancier, $id_couleur, $id_apoudre, $la_poudre, $id_contenant, $brillance, $nb_pot, $prixunitaire, $ports, $total);
	}else{
		// Ral ou SIKKENS
		
		
		
		// requÍte qui rÈcupËre le taux du contenant 
		$requetecontenant = "SELECT id_c, tar_class, tar_mesu  FROM `illi21_contenant` WHERE `id_c` = ". $id_contenant ." ";
		$res_contenant = mysqli_query($lien,$requetecontenant);
		$lecontenant = mysqli_fetch_object($res_contenant); 
		$cont_tar_class = $lecontenant->tar_class;
		$cont_tar_mesu = $lecontenant->tar_mesu;
		// errlogtxt($requetecontenant);
		
		
		// requÍte qui rÈcupËre le type de tarif couleur (sur mesure ou en stock) 
		$requetecoul = "SELECT id_cl, tartype FROM `illi21_couleur` WHERE `id_cl` = ". $id_couleur ." ";
		$res_couleur = mysqli_query($lien,$requetecoul);
		$lacouleur = mysqli_fetch_object($res_couleur); 
		$letaux = $lacouleur->tartype;
		// errlogtxt($requetecoul);
		
		if($letaux == '100')
		{
			// en stock
			$prx = $cont_tar_class;
			
		}else{
			// Sur mesure
			$prx = $cont_tar_mesu;
		}
		
		$prixunitaire = $prx;
		
		$total = $prixunitaire * $nb_pot;
		$total = number_format($total, 2, '.', '');
		//echo $prixunitaire;
		
		
		// Recherche frais de port du contenant poudre
		$lect_port = "SELECT montantht FROM illi21_port WHERE idcontenant = '$id_contenant' and tp = 'n' limit 1;";
		// echo $lect_port;
		$res_lect_port = mysqli_query($lien, $lect_port) or die ("Erreur lecture port");
		$leport = mysqli_fetch_object($res_lect_port);
		
		$ports		= $leport->montantht;	
		// echo $ports;

		$identifiant  = $id_nuancier."_".$id_support."_".$id_couleur."_".$id_contenant."_".$id_brillance;
		
		ajouterArticle($identifiant, $id_support, $id_nuancier, $id_couleur, $la_couleur, $rf_couleur, $id_contenant, $brillance, $nb_pot, $prixunitaire, $ports, $total);
	}
	
	
	
	
	
	
	
	// echo "identifiant       : ".$identifiant."<br>";
	
	header("Location:feraud-mon-panier-liste-produits-boutique-peinture");
}else{
	header("Location:feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee");
}

deconnexionBDD($lien);
?>