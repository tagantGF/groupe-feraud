<?php
/*************** CONNEXION BDD *****************/
function connexionBDD() {
	/*
	$hote = "localhost";
	$ident = "root";
	$mdp = "root";
	$bdd = "illicoloat349856";
    */
	
	$hote = "bqsyhdddeclic.mysql.db";
	$ident = "bqsyhdddeclic";
	$mdp = "Declic4Feraud";
	$bdd = "bqsyhdddeclic";

	$lien = mysqli_connect($hote, $ident, $mdp, $bdd);
	
	if (mysqli_connect_errno()) {
    	printf("Échec de la connexion : %s\n", mysqli_connect_error());
    	exit();
	}
	
	return $lien;
}

function deconnexionBDD($lien){
	mysqli_close($lien);
}
/************** FIN CONNEXION BDD ****************/

/***************** AUTHENTICATION ****************/

//ADMIN
function verifieAuthentificationAdmin($identifiant, $mdp){
	$lien = connexionBDD();
	if(isset($_SESSION['adm_illi']['auth'])) 
		unset($_SESSION['adm_illi']);
 	
 	if($identifiant != "" && $mdp != ""){
		$lecture = "SELECT * FROM illi_admin WHERE adm_identifiant = '$identifiant' AND adm_mdp = '$mdp'";
		$resultat_lecture = mysqli_query($lien,$lecture) or die ("Erreur : authentification");
		$trouve = mysqli_num_rows($resultat_lecture);
	   
		if ($trouve == 0){
			$_SESSION['adm_illi']['auth'] = FALSE;
			$erreur = "Mauvais identifiant ou mot de passe!";
		}else{
			$ligne = mysqli_fetch_object($resultat_lecture) or die ("Erreur : authentification");
			$info_sess = "SELECT * FROM illi_admin WHERE adm_identifiant = '$identifiant' AND adm_mdp = '$mdp'";
			$res_info_session = mysqli_query($lien,$info_sess);
			$infos = mysqli_fetch_object($res_info_session) or die ("Erreur : authentification");
			$infoAdmin = array('id_admin' => $infos->id_admin, 'nom' => $infos->adm_nom, 'prenom' => $infos->adm_prenom, 'auth' => TRUE);
			$_SESSION['adm_illi'] = $infoAdmin;
			$erreur = "ok";
		}
	}else{
		$erreur = "L'identifiant et le mot de passe sont obligatoires!";
	}
	return $erreur;	
}

function estAuthentifieAdmin(){
	if(isset($_SESSION['adm_illi']['auth'])){
		if($_SESSION['adm_illi']['auth'])
			return TRUE;
		else
			return FALSE;
	}else{
		return FALSE;
	}
}
 	
function detruireSessionAdmin(){
	unset($_SESSION['adm_illi']);
}

/***************** FIN AUTHENTIFICATION *****************/
/***************** FORMULAIRES ****************/
function securiseFormulaire($variable){
	$donnee = $variable;
		
	if(get_magic_quotes_gpc())
		$resultat = $donnee;
	else
		$resultat = addslashes($donnee);	
	
	return $resultat;
}

function renommeNom($nom){
	$nom = strtolower(str_replace(" ", "_", $nom));
	$nom = strtr($nom, 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËéèêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ','AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn'); 
	$nom = preg_replace('/([^.a-z0-9]+)/i', '_', $nom);
	return $nom;
}

function renommeNomPhoto($nom){
	$nom = date('dmyhis')."_".renommeNom($nom);
	return $nom;
}

/***************** FIN FORMULAIRE *****************/
/***************** CLIENT ****************/

function verifieAuthentificationClient($identifiant, $mdp){
	$lien = connexionBDD();
	if(isset($_SESSION['c_feraud']['auth'])) 
		unset($_SESSION['c_feraud']);
 	
 	if($identifiant != "" && $mdp != ""){
		$lecture = "SELECT * FROM illi21_clients_cpt WHERE c_mail = '$identifiant' AND c_valide = '1';";
		$resultat_lecture = mysqli_query($lien,$lecture) or die ("Erreur : authentification");
		$trouve = mysqli_num_rows($resultat_lecture);
	   
		if ($trouve == 0){
			$_SESSION['c_feraud']['auth'] = FALSE;
			$erreur = "Mauvais identifiant / mot de passe !";
		}else{
			$pass = securiseFormulaire($mdp);	
			// On chiffre le message
			$options = [
				'cost' => 12,
			];
			$ligne = mysqli_fetch_object($resultat_lecture) or die ("Erreur : authentification");
			$hash = $ligne->c_mdp;
		 
			if (password_verify($pass, $hash)) 
			{
				$res_info_session = mysqli_query($lien,$lecture);
				$infos = mysqli_fetch_object($res_info_session) or die ("Erreur : authentification");
				$infoAdmin = array('id_client' => $infos->id_client, 'civilite' => $infos->c_civilite, 'nom' => $infos->c_nom, 'prenom' => $infos->c_prenom, 'typecpt' => $infos->type_cpt, 'compte' => $infos->clientcode, 'email' => $infos->c_mail, 'clireduc' => $infos->cli_reduc, 'auth' => TRUE);
				$_SESSION['c_feraud'] = $infoAdmin;
				$erreur = "ok";
			}else{
				$_SESSION['c_feraud']['auth'] = FALSE;
				$erreur = "Mauvais identifiant / mot de passe !";
			}
		}
	}else{
		$erreur = "L'identifiant et le mot de passe sont obligatoires!";
	}
	return $erreur;	
}

function estAuthentifieClient(){
	if(isset($_SESSION['c_feraud']['auth'])){
		if($_SESSION['c_feraud']['auth'])
			return TRUE;
		else
			return FALSE;
	}else{
		return FALSE;
	}
}

function detruireSessionClient(){
	unset($_SESSION['c_feraud']);
}

/***************** FIN CLIENT *****************/

/***************** PRIX TTC  **********************/
function prixttc($prixht, $taux){
	return number_format($prixht + (($prixht / 100) * $taux), 3, '.', ' ');
}

function prixht($prixht){
	return number_format($prixht, 3, '.', ' ');
}

function prixclient($prixht, $taux)
{
	return number_format($prixht - (($prixht * $taux) / 100), 3, '.', '');
}

function prixclientpoudre($prixht, $tauxb, $tauxp)
{
	$prixbatifer = $prixht - (($prixht * $tauxb) / 100);
	
	return number_format($prixbatifer - (($prixbatifer * $tauxp) / 100), 3, '.', '');
}


/**************************************************/

/***************** PHOTO ****************/

function envoi_document($fichier, $temp, $repertoire) {
    global $error;
	move_uploaded_file($temp, $repertoire.'/'.$fichier);
	
	return $fichier;
}

function envoyerImage($image, $temp, $repertoire){
	$image = renommeNom($image);

	move_uploaded_file($temp, $repertoire.'/'.$image);
	
	return $image;
}
