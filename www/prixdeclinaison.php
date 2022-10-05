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
		
		
if(isset($_GET['id_declit'])) 
{
 
    $json = array();
     
    if(isset($_GET['id_declit'])) 
	{
        $id = htmlentities(intval($_GET['id_declit']));

       //  errlogtxt($id);
		// errlogtxt($idc);
		
		
		 // requête qui récupère le prix de la declinaison
        $requeteprix = "SELECT p_prix_ht FROM `illi21_produits_var` WHERE `id_decli` = ".$id." ";
		$res_prix = mysqli_query($lien,$requeteprix);
		$leprix = mysqli_fetch_object($res_prix); 
		$prixdebase = $leprix->p_prix_ht;
		// errlogtxt($prixdebase);
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
   
	$prixht = ($prixdebase);
	$json[$id][] = ($prixht);
    // errlogtxt($prixht);
     
    // envoi du résultat au success
    echo json_encode($json);
}
?>
