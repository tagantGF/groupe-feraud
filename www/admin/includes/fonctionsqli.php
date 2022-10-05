<?php
function connexionBDD() {
	
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

function securiseFormulaire($variable){
	$donnee = $variable;
	$lien = connexionBDD();
		
	if(get_magic_quotes_gpc())
		$resultat = $donnee;
	else
		$resultat = mysqli_real_escape_string($lien, $donnee);	
	
	return $resultat;
}

/***************** CLIENT ****************/

function verifieAuthentificationClient($identifiant, $mdp){
	$lien = connexionBDD();
	if(isset($_SESSION['c_tec_ra']['auth'])) 
		unset($_SESSION['c_tec_ra']);
 	
 	if($identifiant != "" && $mdp != ""){
		$lecture = "SELECT iduser, nomuser, prenomuser, passuser  FROM illi21_accesreg WHERE loginuser = '$identifiant';";
		$resultat_lecture = mysqli_query($lien,$lecture) or die ("Erreur : authentification");
		$trouve = mysqli_num_rows($resultat_lecture);
	   
		if ($trouve == 0){
			$_SESSION['c_tec_ra']['auth'] = FALSE;
			$erreur = "Mauvais identifiant / mot de passe ! (Errno 1)";
			$erreur = $lecture;
		}else{
			$pass = securiseFormulaire($mdp);	
			
			
			$ligne = mysqli_fetch_object($resultat_lecture) or die ("Erreur : authentification");
			$passuser = $ligne->passuser;
		 
			if (($pass == $passuser)) 
			{
				$res_info_session = mysqli_query($lien,$lecture);
				$infos = mysqli_fetch_object($res_info_session) or die ("Erreur : authentification");
				$infoAdmin = array('id_client' => $infos->iduser, 'tonnom' => $infos->nomuser, 'tonprenom' => $infos->prenomuser, 'auth' => TRUE);
				$_SESSION['c_tec_ra'] = $infoAdmin;
				$erreur = "ok";
			}else{
				$_SESSION['c_tec_ra']['auth'] = FALSE;
				$erreur = "Mauvais identifiant / mot de passe ! (Errno 2)";
			}
		}
	}else{
		$erreur = "L'identifiant et le mot de passe sont obligatoires!";
	}
	return $erreur;	
}

function estAuthentifieClient(){
	if(isset($_SESSION['c_tec_ra']['auth'])){
		if($_SESSION['c_tec_ra']['auth'])
			return TRUE;
		else
			return FALSE;
	}else{
		return FALSE;
	}
}

function detruireSessionClient(){
	unset($_SESSION['c_tec_ra']);
}

/***************** FIN CLIENT *****************/

/***************** CERTIFICAT *****************/
function renommeNom($nom){
	$nom = strtolower(str_replace(" ", "_", $nom));
	$nom = strtr($nom, 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËéèêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ','AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn'); 
	$nom = preg_replace('/([^.a-z0-9]+)/i', '_', $nom);
	return $nom;
}
function envoi_document($fichier, $temp, $repertoire) {
    global $error;
	move_uploaded_file($temp, $repertoire.'/'.$fichier);
	
	return $fichier;
}

/***************** FIN CERTIFICAT *************/

function genChAle($longueur, $listeCar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
 $chaine = '';
 $max = mb_strlen($listeCar, '8bit') - 1;
 for ($i = 0; $i < $longueur; ++$i) {
 $chaine .= $listeCar[random_int(0, $max)];
 }
 return $chaine;
}

function dateEN2FR($jour)

{
	return substr($jour,8,2) . substr($jour,4,4) . substr($jour,0,4); 
} 


/***************** PHOTO ****************/



function envoyerImage($image, $temp, $repertoire){
	$image = renommeNom($image);

	move_uploaded_file($temp, $repertoire.'/'.$image);
	
	return $image;
}

/*-------- nettoyage texte --------------- */
function clean_text($str,$options = array()){

	if(in_array('TOUT',$options)):
		$options = array('HTML','TRIM','MAJUSCULE','MINUSCULE','ACCENT','PONCTUATION','TABULATION','ENTER','DOUBLE');
	endif;

	foreach($options as $option):
		switch($option){

			// Suppression des espaces vides en debut et fin de chaque ligne
			case 'TRIM':
				$str = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$str);
			break;

			// Remplacement des caractères accentués par leurs équivalents non accentués
			case 'ACCENT':
				$str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
				$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
				$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. 'œ'
				$str = html_entity_decode($str); 
			break;

			// Transforme tout le texte en minuscule
			case 'MINUSCULE':
				$str = mb_strtolower($str, 'UTF-8');
			break;

			// Transforme tout le texte en majuscule
			case 'MAJUSCULE':
				$str = mb_strtoupper($str, 'UTF-8');
			break;

			// Remplace toute la ponctuation par des tirets
			case 'PONCTUATION':
				$str = preg_replace('#([[:punct:]])#','-',$str);
				$exceptions = array("’");
				$str = str_replace($exceptions,'-',$str);
			break;

			// Remplace les tabulations par des espaces
			case 'TABULATION':
				$str = preg_replace("#\h#u", "-", $str);
			break;

			// Remplace les espaces multiples par des espaces simples
			case 'DOUBLE':
				$str = preg_replace('#[" "]{2,}#','-',$str);
			break;

			// Remplace 1 entrée (\r\n) par 1 espace
			case 'ENTER':
				$str = str_replace(array("\r","\n"),'-',$str);
			break;

			// Supprime toutes les balises html
			case 'HTML':
				$str = strip_tags($str);
			break;
		}
	endforeach;
	
	return $str;
}

?>