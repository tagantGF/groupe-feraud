<?php
if(isset($_GET['go']) || isset($_GET['id_support'])) {
 
    $json = array();
     
    if(isset($_GET['id_support'])) 
    {
        $id = htmlentities(intval($_GET['id_support']));
        // requête qui récupère les nuanciers selon le support
        $requete = "SELECT id_n as id, nunom as nom FROM illi21_nuancier where id_n <> '99';";
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