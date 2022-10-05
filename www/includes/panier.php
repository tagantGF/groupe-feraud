<?php
function creationPanier(){
	$existe = false;
	
	if(isset($_SESSION['panierfer']))
	 $existe = true;
	else
	{
		$_SESSION['panierfer'] = array();
		$_SESSION['panierfer']['identifiant'] = array();
		$_SESSION['panierfer']['id_support'] = array();
		$_SESSION['panierfer']['id_nuancier'] = array();
		$_SESSION['panierfer']['id_couleur'] = array();
		$_SESSION['panierfer']['la_couleur'] = array();
		$_SESSION['panierfer']['rf_couleur'] = array();
		$_SESSION['panierfer']['id_contenant'] = array();
		$_SESSION['panierfer']['brillance'] = array();
		$_SESSION['panierfer']['nomproduit'] = array();
		$_SESSION['panierfer']['nb_pot'] = array();
		$_SESSION['panierfer']['prixunitaire'] = array();
		$_SESSION['panierfer']['ports'] = array();
		$_SESSION['panierfer']['mttc'] = array();
		$_SESSION['panierfer']['typeprod'] = array();
		$_SESSION['panierfer']['idproduit'] = array();
		$existe = true;
	}
	return $existe;
}



function ajouterProduit($identifiant, $nomproduit, $quantite, $prix_unit, $ports, $prix_total, $type_prod, $idproduit){
	if(creationPanier())
	{
		$position = array_search($identifiant,  $_SESSION['panierfer']['identifiant']);
			
		if ($position !== false)
		{
			$qtepanier = $_SESSION['panierfer']['nb_pot'][$position] + $quantite;
			
			$_SESSION['panierfer']['nb_pot'][$position] += $quantite;
			$_SESSION['panierfer']['mttc'][$position] += $prix_total;
		}
		else
		{
			array_push( $_SESSION['panierfer']['identifiant'], $identifiant);
			array_push( $_SESSION['panierfer']['id_support'], "");
			array_push( $_SESSION['panierfer']['id_nuancier'], "");
			array_push( $_SESSION['panierfer']['id_couleur'], "");
			array_push( $_SESSION['panierfer']['la_couleur'], "");
			array_push( $_SESSION['panierfer']['rf_couleur'], "");
			array_push( $_SESSION['panierfer']['id_contenant'], "");
			array_push( $_SESSION['panierfer']['brillance'], "");
			array_push( $_SESSION['panierfer']['nomproduit'], $nomproduit);
		  	array_push( $_SESSION['panierfer']['nb_pot'], $quantite);
		   	array_push( $_SESSION['panierfer']['prixunitaire'], $prix_unit);
			array_push( $_SESSION['panierfer']['ports'], $ports);
		   	array_push( $_SESSION['panierfer']['mttc'], $prix_total);
			array_push( $_SESSION['panierfer']['typeprod'], $type_prod);
			array_push( $_SESSION['panierfer']['idproduit'], $idproduit);
		}
	}
	
	else
	  echo "Un probl&egrave;me est survenu veuillez contacter l'administrateur du site.";
}


function ajouterArticle($identifiant,$id_support,$id_nuancier,$id_couleur,$la_couleur,$rf_couleur,$id_contenant, $brillance, $nb_pot, $prixunitaire, $ports, $prix_total){
	if(creationPanier())
	{
		$position = array_search($identifiant,  $_SESSION['panierfer']['identifiant']);
			
		if ($position !== false)
		{
			$qtepanier = $_SESSION['panierfer']['nb_pot'][$position] + $nb_pot;
			$_SESSION['panierfer']['nb_pot'][$position] += $nb_pot;
			$_SESSION['panierfer']['mttc'][$position] += $prix_total;
		}
		else
		{
			array_push( $_SESSION['panierfer']['identifiant'], $identifiant);
		   	array_push( $_SESSION['panierfer']['id_support'], $id_support);
			array_push( $_SESSION['panierfer']['id_nuancier'], $id_nuancier);
			array_push( $_SESSION['panierfer']['id_couleur'], $id_couleur);
			array_push( $_SESSION['panierfer']['la_couleur'], $la_couleur);
			array_push( $_SESSION['panierfer']['rf_couleur'], $rf_couleur);
			array_push( $_SESSION['panierfer']['id_contenant'], $id_contenant);
			array_push( $_SESSION['panierfer']['brillance'], $brillance);
			array_push( $_SESSION['panierfer']['nomproduit'], "");
		  	array_push( $_SESSION['panierfer']['nb_pot'], $nb_pot);
		   	array_push( $_SESSION['panierfer']['prixunitaire'], $prixunitaire);
			array_push( $_SESSION['panierfer']['ports'], $ports);
		   	array_push( $_SESSION['panierfer']['mttc'], $prix_total);
			array_push( $_SESSION['panierfer']['typeprod'], "");
			array_push( $_SESSION['panierfer']['idproduit'], "");
		}
	}
	
	else
	  echo "Un probl&egrave;me est survenu veuillez contacter l'administrateur du site.";
}



function supprimerArticle($identifiant){
	if(creationPanier())
	{
		$tmp = array();
		$tmp['identifiant'] = array();
		$tmp['id_support'] = array();
		$tmp['id_nuancier'] = array();
		$tmp['id_couleur'] = array();
		$tmp['la_couleur'] = array();
		$tmp['rf_couleur'] = array();
		$tmp['id_contenant'] = array();
		$tmp['brillance'] = array();
		$tmp['nomproduit'] = array();
		$tmp['nb_pot'] = array();
		$tmp['prixunitaire'] = array();
		$tmp['ports'] = array();
		$tmp['mttc'] = array();
		$tmp['typeprod'] = array();
		$tmp['idproduit'] = array();
		// echo $identifiant;
		for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
		{
			if ($_SESSION['panierfer']['identifiant'][$i] != $identifiant)
			{
				array_push($tmp['identifiant'],$_SESSION['panierfer']['identifiant'][$i]);
				array_push($tmp['id_support'],$_SESSION['panierfer']['id_support'][$i]);
				array_push($tmp['id_nuancier'],$_SESSION['panierfer']['id_nuancier'][$i]);
				array_push($tmp['id_couleur'],$_SESSION['panierfer']['id_couleur'][$i]);
				array_push($tmp['la_couleur'],$_SESSION['panierfer']['la_couleur'][$i]);
				array_push($tmp['rf_couleur'],$_SESSION['panierfer']['rf_couleur'][$i]);
				array_push($tmp['id_contenant'],$_SESSION['panierfer']['id_contenant'][$i]);
				array_push($tmp['brillance'],$_SESSION['panierfer']['brillance'][$i]);
				array_push($tmp['nomproduit'],$_SESSION['panierfer']['nomproduit'][$i]); 
				array_push($tmp['nb_pot'],$_SESSION['panierfer']['nb_pot'][$i]); 
				array_push($tmp['prixunitaire'],$_SESSION['panierfer']['prixunitaire'][$i]);
				array_push($tmp['ports'],$_SESSION['panierfer']['ports'][$i]);
				array_push($tmp['mttc'],$_SESSION['panierfer']['mttc'][$i]);
				array_push($tmp['typeprod'],$_SESSION['panierfer']['typeprod'][$i]);
				array_push($tmp['idproduit'],$_SESSION['panierfer']['idproduit'][$i]);
			}
		}
		
		if(isset($_SESSION['panierfer']['code'])) 			{$tmp['code'] = $_SESSION['panierfer']['code'];}
		if(isset($_SESSION['panierfer']['codevalid'])) 	{$tmp['codevalid'] = $_SESSION['panierfer']['codevalid'];}
		if(isset($_SESSION['panierfer']['lapromo'])) 		{$tmp['lapromo'] = $_SESSION['panierfer']['lapromo'];}
		if(isset($_SESSION['panierfer']['lecadeau'])) 		{$tmp['lecadeau'] = $_SESSION['panierfer']['lecadeau'];}
		if(isset($_SESSION['panierfer']['c_reduc_ht']))	{$tmp['c_reduc_ht'] = $_SESSION['panierfer']['c_reduc_ht'];}
		if(isset($_SESSION['panierfer']['promottc']))		{$tmp['promottc'] = $_SESSION['panierfer']['promottc'];}
		
		$_SESSION['panierfer'] =  $tmp;
		unset($tmp);      
	}
	else
	  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function videArticle(){
	$_SESSION['panierfer'] = array();
	$_SESSION['panierfer']['identifiant'] = array();
	$_SESSION['panierfer']['id_support'] = array();
	$_SESSION['panierfer']['id_nuancier'] = array();
	$_SESSION['panierfer']['id_couleur'] = array();
	$_SESSION['panierfer']['la_couleur'] = array();
	$_SESSION['panierfer']['rf_couleur'] = array();
	$_SESSION['panierfer']['id_contenant'] = array();
	$_SESSION['panierfer']['brillance'] = array();
	$_SESSION['panierfer']['nomproduit'] = array();
	$_SESSION['panierfer']['nb_pot'] = array();
	$_SESSION['panierfer']['prixunitaire'] = array();
	$_SESSION['panierfer']['ports'] = array();
	$_SESSION['panierfer']['mttc'] = array();
	$_SESSION['panierfer']['typeprod'] = array();
	$_SESSION['panierfer']['idproduit'] = array();
}

function supprimerCode()
{
	unset($_SESSION['panierfer']['code']);
	unset($_SESSION['panierfer']['codevalid']);
	unset($_SESSION['panierfer']['lapromo']);
	unset($_SESSION['panierfer']['lecadeau']);
	unset($_SESSION['panierfer']['c_reduc_ht']);
	unset($_SESSION['panierfer']['promottc']);
}

function modifierQuantite($identifiant, $priun, $nb_pot, $mttc){
	if (creationPanier())
	{
		if ($nb_pot > 0)
  		{
			$position = array_search($identifiant,  $_SESSION['panierfer']['identifiant']);
            if ($position !== false)
   			{
				$_SESSION['panierfer']['nb_pot'][$position] = $nb_pot;
				$_SESSION['panierfer']['prixunitaire'][$position] = $priun;
				$_SESSION['panierfer']['mttc'][$position] = $mttc;
			}
  		}
  		else{
   			supprimerArticle($identifiant);     
		}
	}
	else
  		echo "Un probl&eacute;me est survenu veuillez contacter l'administrateur du site.";
}


function MontantGlobalht(){
	$total=0;
	for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
  	{            
   		$total += $_SESSION['panierfer']['nb_pot'][$i] * str_replace(",", ".", $_SESSION['panierfer']['prixunitaire'][$i]); 
  	}      
	
	
	return number_format($total, 2, '.', '');
}

function PortsGlobal(){
	$ports=0;
	for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
  	{            
   		if($_SESSION['panierfer']['ports'][$i] > $ports) { $ports = $_SESSION['panierfer']['ports'][$i]; }
  	}
	// echo $ports;
	return $ports;
}


function MontantGlobal(){
	$total=0;
	for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
  	{            
   		$total += $_SESSION['panierfer']['nb_pot'][$i] * str_replace(",", ".", $_SESSION['panierfer']['prixunitaire'][$i]); 
  	}      
	
	// Calcule les frais de port
	$port = FraisdePort();
	
	return number_format($total, 2, '.', '');
}

function MontantGlobalttc(){
	$total=0;
	for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
  	{            
   		$total += $_SESSION['panierfer']['nb_pot'][$i] * str_replace(",", ".", $_SESSION['panierfer']['prixunitaire'][$i]); 
  	}      
	
	// Calcule les frais de port
	
	return number_format($total, 2, '.', '');
}


function PoidsGlobal(){
	$poids=0;
	for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
  	{            
   		$poids += str_replace(",", ".", $_SESSION['panierfer']['poids'][$i]); 
  	}      
	return $poids;
}

function FraisdePort()
{
	$leports=0;
	$ttcmd = 0;
	
	$lien = connexionBDD();
	
	$requettefranco = "SELECT `tariffranco` FROM illi21_tarif_franco	 WHERE `idf` = '800' "; 
	$res_franco_ = mysqli_query($lien,$requettefranco);
	$lect_franco_ = mysqli_fetch_object($res_franco_);  
	$franco = $lect_franco_->tariffranco;
	
	// Montant total
	if(isset($_SESSION['panierfer']['montantTotal']))
	{
		$ttcmd = $_SESSION['panierfer']['montantTotal'];
	}else{
		$ttcmd = MontantGlobalttc();
	}
	
	// Reduction batifer
	if(isset($_SESSION['panierfer']['c_reduc_ht']))
	{
		$reducbtf = $_SESSION['panierfer']['c_reduc_ht'];
	
	}else{
		$reducbtf = '0';
	}
	
	// Code Reduction
	if(isset($_SESSION['panierfer']['promottc']))
	{
		$reducpromo = $_SESSION['panierfer']['promottc'];
	
	}else{
		$reducpromo = '0';
	}
	
	$leports =  PortsGlobal();
	
	
	
	
	// $fp = fopen("fichier.txt","w"); 
	// fputs($fp,$ttcmd . "\n"); 
	// fputs($fp,$reducpromo . "\n"); 
	// fputs($fp,$reducbtf . "\n"); 
	// fputs($fp,$franco . "\n"); 
	// fclose($fp);
	
	// echo "ttcmd : ".$ttcmd."<br>";
	// echo "reducbtf : ".$reducbtf."<br>";
	// echo "reducpromo : ".$reducpromo."<br>";
	// echo "franco : ".$franco."<br>";
	
	
	
	if( ($ttcmd - $reducbtf + $reducpromo) > $franco)
	{
		$leports = 0;
	}
	
	// $fp = fopen("fichier.txt","w"); 
	// fputs($fp,$leports . "\n"); 
	// fclose($fp);
	
	// echo $leports;
	$_SESSION['panierfer']['fraisdePort'] = $leports;
	return number_format($leports, 2, '.', '');
}

function FraisdePortMontant($totalht)
{
	$leports =  PortsGlobal();
	// echo "<br>leports : ".$leports;
	// echo "<br>Totalht : ".$totalht.'<br>';
	$lien = connexionBDD();
	
	$requettefranco = "SELECT `tariffranco` FROM illi21_tarif_franco	 WHERE `idf` = '800' "; 
	$res_franco_ = mysqli_query($lien,$requettefranco);
	$lect_franco_ = mysqli_fetch_object($res_franco_);  
	$franco = $lect_franco_->tariffranco;
	
	if( $totalht > $franco)
	{
		$leports = 0;
	}
	
	
	$_SESSION['panierfer']['fraisdePort'] = $leports;
	return number_format($leports, 2, '.', '');
}



function nbArticle(){
	$nbarticle = 0;
	if (creationPanier()){
		for($i = 0; $i < count($_SESSION['panierfer']['identifiant']); $i++) 
		{
			$nbarticle += $_SESSION['panierfer']['nb_pot'][$i];
		}
	}else{
		$nbarticle = 0;
	}
	return $nbarticle;
}

?>