<?php
if(isset($_GET['id_nuancier'])) {
 
    $json = array();
     
    if(isset($_GET['id_nuancier'])) {
        $id = htmlentities(intval($_GET['id_nuancier']));
        // requête qui récupère les couleurs selon la nuancier
        $requete = "SELECT id_cl as id, coul_com as nom, coul_rvb as lacoul FROM `illi21_couleur` WHERE `id_nuancier` = ". $id ." order by nom asc ";
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

		$json[$donnees['id']][] = ($donnees['nom']).";".($donnees['lacoul']);
    }
     
    // envoi du résultat au success
    echo json_encode($json);
}
?>