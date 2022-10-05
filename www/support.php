<?php
function errlogtxt($errtxt)
		{
			$fp = fopen('errlog.txt','a+');
			fseek($fp,SEEK_END);
			$nouverr=$errtxt."\r\n";
			fputs($fp,$nouverr);
			fclose($fp); //basta
		}
if(isset($_GET['go']) || isset($_GET['id_support'])) {
    errlogtxt("1");
    $json = array();
     
    if(isset($_GET['go'])) {
        // requête qui récupère les supports
		
        $requete = "SELECT id_s as id, sup_nom as nom, sup_lib_form, sup_class, sup_ol, sup_ordre FROM illi21_support where sup_ol = '1' order by `sup_ordre` ASC";
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
        // je remplis un tableau et mettant l'id en index (que ce soit pour les supports ou les nuanciers)
        $json[$donnees['id']][] = ($donnees['nom']);
    }
     
    // envoi du résultat au success
    echo json_encode($json);
}
?>