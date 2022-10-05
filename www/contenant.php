<?php

function errlogtxt($errtxt)
		{
			$fp = fopen('errlog.txt','a+');
			fseek($fp,SEEK_END);
			$nouverr=$errtxt."\r\n";
			fputs($fp,$nouverr);
			fclose($fp); //basta
		}

if(isset($_GET['id_support'])) {
 
    $json = array();
     
    if(isset($_GET['id_support'])) {
        $id = htmlentities(intval($_GET['id_support']));
        // requête qui récupère les contenants selon le support
        $requete = "SELECT id_c as id, cont_nom as nom, cont_ol FROM illi21_contenant CONTEN inner join illi21_rel_sup_conten LIEN on CONTEN.id_c = LIEN.id_co WHERE LIEN.id_su = ". $id ." AND CONTEN.cont_ol = '1' ";
		// errlogtxt($requete);
    }
     
    // connexion à la base de données
    try {
        // $bdd = new PDO('mysql:host=localhost;dbname=illicoloat349856', 'root', 'root');
		$bdd = new PDO('mysql:host=bqsyhdddeclic.mysql.db;dbname=bqsyhdddeclic;charset=utf8', 'bqsyhdddeclic', 'Declic4Feraud');
    } catch(Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }
    // exécution de la requête
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
     
    // résultats
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        // je remplis un tableau et mettant l'id en index 

		$json[$donnees['id']][] = ($donnees['nom']);
    }
     
    // envoi du résultat au success
    echo json_encode($json);
}
?>