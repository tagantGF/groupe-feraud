<?php
	require_once 'includes/fonctionsqli.php';
	$lien = connexionBDD();
	
	function errlogtxt($errtxt)
		{
			$fp = fopen('errlog.txt','a+');
			fseek($fp,SEEK_END);
			$nouverr=$errtxt."\r\n";
			fputs($fp,$nouverr);
			fclose($fp); //basta
		}
		
		
if(isset($_GET['id_contenant']) and isset($_GET['id_couleur'])) {
 
    $json = array();
     
    if(isset($_GET['id_contenant']) and isset($_GET['id_couleur'])) 
	{
        $id = htmlentities(intval($_GET['id_contenant']));
		$idc = htmlentities(intval($_GET['id_couleur']));
       //  errlogtxt($id);
		// errlogtxt($idc);
		
		// requête qui récupère le taux du contenant 
		$requetecontenant = "SELECT id_c, tar_class, tar_mesu FROM `illi21_contenant` WHERE `id_c` = ". $id ." ";
		$res_contenant = mysqli_query($lien,$requetecontenant);
		$lecontenant = mysqli_fetch_object($res_contenant); 
		$cont_tar_class = $lecontenant->tar_class;
		$cont_tar_mesu = $lecontenant->tar_mesu;
		// errlogtxt($requetecontenant);
		
		
		// requête qui récupère le type de tarif couleur (sur mesure ou en stock) 
		$requetecoul = "SELECT id_cl, tartype FROM `illi21_couleur` WHERE `id_cl` = ". $idc ." ";
		$res_couleur = mysqli_query($lien,$requetecoul);
		$lacouleur = mysqli_fetch_object($res_couleur); 
		$letaux = $lacouleur->tartype;
		// errlogtxt($requetecoul);
		
		
		// CALCUL prix de base x letaux
		if($letaux == '100')
		{
			// en stock
			$prx = $cont_tar_class;
			
		}else{
			// Sur mesure
			$prx = $cont_tar_mesu;
		}
		
		// errlogtxt($prx);
		
		// illi21_tarifs_peintures  illi21_contenant  illi21_couleur
    }
     
    // connexion à la base de données
    try {
        // $bdd = new PDO('mysql:host=localhost;dbname=illicoloat349856', 'root', 'root');
		$bdd = new PDO('mysql:host=bqsyhdddeclic.mysql.db;dbname=bqsyhdddeclic;charset=utf8', 'bqsyhdddeclic', 'Declic4Feraud');
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
	
	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$resultva = $bdd->query($lect_tva) or die(print_r($bdd->errorInfo()));
	$datatva  = $resultva->fetch(PDO::FETCH_ASSOC);
	$tauxtva  = $datatva['taux_tva'];
	
	
	
	 
    // résultats
   
	if(isset($_GET['nbpot']) )
	{
		$nbp = ($_GET['nbpot']);
	}else{
		$nbp = 1;
	}
	$prix = ($prx);
	$montant = $prix * $nbp;
	$json[$id][] = ($montant);
    // errlogtxt($montant);
     
    // envoi du résultat au success
    echo json_encode($json);
}
?>
