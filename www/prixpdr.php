<?php
	require_once 'includes/fonctionsqli.php';
function errlogtxt($errtxt)
		{
			$fp = fopen('errlog.txt','a+');
			fseek($fp,SEEK_END);
			$nouverr=$errtxt."\r\n";
			fputs($fp,$nouverr);
			fclose($fp); //basta
		}


if(isset($_GET['id_contenant']) and isset($_GET['id_poudre'])) {
 
    $json = array();
     
    if(isset($_GET['id_contenant']) and isset($_GET['id_poudre'])) {
        $id = htmlentities(intval($_GET['id_contenant']));
		$idc = htmlentities(intval($_GET['id_poudre']));
        // requête qui récupère le prix suivant la couleur et le contenant
        $requete = "SELECT idp_contenant as id, prixttc as prx FROM `illi21_tarifspdr` WHERE `idp_contenant` = ". $id ." ";
    }
    // errlogtxt($requete);
    // connexion à la base de données
    try {
        // $bdd = new PDO('mysql:host=localhost;dbname=illicoloat349856', 'root', 'root');
		$bdd = new PDO('mysql:host=bqsyhdddeclic.mysql.db;dbname=bqsyhdddeclic;charset=utf8', 'bqsyhdddeclic', 'Declic4Feraud');
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
    // exécution de la requête
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
    
	
	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$resultva = $bdd->query($lect_tva) or die(print_r($bdd->errorInfo()));
	$datatva  = $resultva->fetch(PDO::FETCH_ASSOC);
	$tauxtva  = $datatva['taux_tva'];
	
	// errlogtxt($lect_tva);
	
	 
    // résultats
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // je remplis un tableau et mettant l'id en index 
		if(isset($_GET['nbpot']) )
		{
			$nbp = ($_GET['nbpot']);
		}else{
			$nbp = 1;
		}
		$prix = ($donnees['prx']);
		$montant = $prix * $nbp;
		$json[$donnees['id']][] = ($montant);
    }
     
    // envoi du résultat au success
    echo json_encode($json);
}
?>
