<?php
	session_start();
	require_once 'includes/fonctionsqli.php';
	require_once 'includes/panier.php';
	$lien = connexionBDD();
    $lien -> set_charset("utf8");
	
	// Lecture des parametres adresse
	$lect_adr = "SELECT ids, noment, bpost, annee, siret, capital, adresse, cp, ville, tel, fax, emel, accroche FROM illi21_paramsite WHERE ids = '1'";
	$res_adr_ = mysqli_query($lien,$lect_adr);
	$lect_adr_ = mysqli_fetch_object($res_adr_); 
	
	$numtel = $lect_adr_->tel;
	$noment = $lect_adr_->noment;
	$annee = $lect_adr_->annee;
	$siret = $lect_adr_->siret;
	$capital = $lect_adr_->capital;
	$adresse = $lect_adr_->adresse;
	$cp = $lect_adr_->cp;
	$ville = $lect_adr_->ville;
	$accroche = ($lect_adr_->accroche);
	$emel = $lect_adr_->emel;
	
	
	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");
	while($tva =  mysqli_fetch_object($res_lect_tva))
	{
		$tauxtva["$tva->id_tva"] = $tva->taux_tva;	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr"><!-- InstanceBegin template="/Templates/modele-client.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html" />
<meta charset="utf-8" />
<meta name="robots" content="index, follow" />
<meta name="author" content="feraud-color.fr" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />



<!-- InstanceBeginEditable name="doctitle" -->
<title>Feraud Color- peinture qualit&eacute; professionnelle, lasure et vernis couleurs sur mesure livr&eacute; en France</title>
<meta name="Description" content="Peinture de qualit&eacute; professionnelle, teinte sur-mesure pour tous supports. Livr&eacute; en France en 48h" />
<!-- InstanceEndEditable -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css" />
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css" />
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css" />
<link rel="stylesheet" type="text/css" href="styles/main_styles.css" />
<link rel="stylesheet" type="text/css" href="styles/responsive.css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous" />
<!-- Style poudre -->
<link rel="stylesheet" href="css/stylepoudre.css" type="text/css" />
<link type="text/css" href="jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet" />

<script src="js/voir.js"></script>

<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="3beeb959-df32-49f7-a073-63a4d2619575" data-blockingmode="auto" type="text/javascript"></script>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<?php include_once("includes/analyticstracking.php"); ?>

<!-- InstanceBeginEditable name="head" -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- InstanceEndEditable -->


</head>

<body>


<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">

		<!-- Top Navigation -->

		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="top_nav_left" style="font-size:1.3em;">Besoin d'un conseil ? <i class="fa fa-phone" style="padding-top:8px;"></i> <?php echo $numtel;?></div>
					</div>
					<div class="col-md-6 text-right">
						<div class="top_nav_right">
							<ul class="top_nav_menu">
								<li class="account">
                                	<i class="fa fa-lock" style="font-size:1.6em; padding-top:8px;"></i>
                                    <i class="fa fa-cc-visa" style="font-size:1.6em"></i>
                                    <i class="fa fa-cc-mastercard" style="font-size:1.6em"></i>
                                    <i class="fa fa-credit-card" style="font-size:1.6em"></i>

								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee"><img src="images/logo-feraud-color.png" /></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">ACCUEIL</a></li>
                                <li><a href="feraud-configurateur-peinture#leconfigurateur">CONFIGURATEUR</a></li>
                                <li><a href="feraud-boutique-consommable-outillage">BOUTIQUE</a></li>
                                <li><a href="feraud-actualites">ACTUALIT&Eacute;S</a></li>
								<li><a href="feraud-telechargement-documents-pdf-video-peinture">TUTOS</a></li>
                                <li><a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver" class="dernier">CONTACT</a></li>
							</ul>
							<ul class="navbar_user">

								<li class="user">
                                	<center><a href="feraud-mon-compte-mes-commandes"><i class="fa fa-user" aria-hidden="true"></i></a></center>
                                    <span class="menu_btn" onclick="window.location.href='feraud-mon-compte-mes-commandes'"><?php if(isset($_SESSION['c_feraud']['auth']) and ($_SESSION['c_feraud']['auth'] == '1')) { echo "Connect&eacute;";}else{ ?>Mon compte&nbsp;<?php }?></span>
                                </li>
				  				<li class="checkout">
									<a href="feraud-mon-panier-liste-produits-boutique-peinture">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items"><?php creationPanier(); $nb_article = count($_SESSION['panierfer']['identifiant']); echo $nb_article; ?></span>
									</a>
                                    <span class="menu_btn" onclick="window.location.href='feraud-mon-panier-liste-produits-boutique-peinture'">Panier</span>
								</li>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li><a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">ACCUEIL</a></li>
                <li><a href="feraud-configurateur-peinture#leconfigurateur">CONFIGURATEUR</a></li>
                <li><a href="feraud-boutique-consommable-outillage">BOUTIQUE</a></li>
                <li><a href="feraud-actualites">ACTUALIT&Eacute;S</a></li>
				<li class="menu_item"><a href="feraud-telechargement-documents-pdf-video-peinture">TUTOS</a></li>
                <li class="menu_item"><a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver">CONTACT</a></li>
			</ul>
		</div>
	</div>

	
	
    <!-- PAGE -->
    
   
    
	<div class="pages_internes">
		<div class="container">
			<div class="row">
            	<?php 
				if(isset($_POST['co-admin'])){
					$erreur = verifieAuthentificationClient(securiseFormulaire($_POST['identifiantc']), securiseFormulaire($_POST['motdepassec']));
				}else{
					$erreur = "";
				}
				if(estAuthentifieClient())
				{
					$id_client	= $_SESSION['c_feraud']['id_client'];
					$lecture = "SELECT * FROM illi21_clients_cpt WHERE id_client = '$id_client' AND c_valide = '1';";
					$resultat_lecture = mysqli_query($lien,$lecture);
					$trouve = mysqli_num_rows($resultat_lecture);
				   
					if ($trouve == 0){
						$_SESSION['c_feraud']['auth'] = FALSE;
						$erreur = "Mauvais identifiant / mot de passe !";
					}else{
						
						$ligne = mysqli_fetch_object($resultat_lecture);
					 	// Met les infos en session
						$_SESSION['livraison']['nom'] 		= securiseFormulaire($ligne->l_nom);
						$_SESSION['livraison']['prenom']	= securiseFormulaire($ligne->l_prenom);
						$_SESSION['livraison']['adr1']		= securiseFormulaire($ligne->l_adr1);
						$_SESSION['livraison']['cp']		= securiseFormulaire($ligne->l_cp);
						$_SESSION['livraison']['ville'] 	= securiseFormulaire($ligne->l_ville);
						$_SESSION['livraison']['portable']	= securiseFormulaire($ligne->l_tel);
						$_SESSION['livraison']['societe']	= securiseFormulaire($ligne->l_soc);
						$_SESSION['livraison']['emel']		= securiseFormulaire($ligne->l_mail);
						$_SESSION['livraison']['valide']	= securiseFormulaire($ligne->c_valide);
					}
				?>
                    
		    	<!-- InstanceBeginEditable name="EditRegion3" -->
                <div class="col-md-12">
                        <p>Bonjour <strong><?php if(estAuthentifieClient()) {echo $_SESSION['c_feraud']['prenom']." ".$_SESSION['c_feraud']['nom']; }else{ echo "&nbsp;";} ?></strong>, vous &ecirc;tes bien connect&eacute; &agrave; votre compte.</p>
                    </div>
                    <center>
                    <div class="col-md-12 mb-3">
                        <div class=" btn btn-feraud mr-2" onclick="window.location.href='feraud-mon-compte-liste-de-mes-commandes'">Vos commandes</div>
                        <div class=" btn btn-feraud mr-2" onclick="window.location.href='feraud-mon-panier-liste-produits-boutique-peinture'">Votre panier</div>
                        <div class=" btn btn-feraud mr-2" onclick="window.location.href='feraud-mon-compte-modifier-compte-client'">Mes coordonn&eacute;es</div>
                        <div class=" btn btn-feraud mr-2" onclick="window.location.href='feraud-mon-compte-deconnexion'">Se d&eacute;connecter</div>            
                    </div>
                    </center>
                
            	<div class="col-md-12">
                    <h1>Modifier mes coordonn&eacute;es</h1>
                </div>
                
				<div class="container">
                	<?php 
					$id_user	= $_SESSION['c_feraud']['id_client'];
					$lectureclient = "SELECT * FROM illi21_clients_cpt WHERE id_client = '$id_user' limit 1";
					$resultat_lectureclient = mysqli_query($lien,$lectureclient) or die ("Erreur : authentification");
					$trouveclient = mysqli_num_rows($resultat_lectureclient);
						
						if ($trouveclient > 0)
						{
						
							if(!isset($_POST['valider']))
							{
								$resultat_lectureclient = mysqli_query($lien,$lectureclient) or die ("Erreur : authentification");
								$lect_cpt_ = mysqli_fetch_object($resultat_lectureclient);  
								$nom 		= $lect_cpt_->l_nom;
								$prenom		= $lect_cpt_->l_prenom;
								$lsoc 		= $lect_cpt_->l_soc;
								$lsoc_siren = $lect_cpt_->l_soc_siren;
								$clientcde 	= $lect_cpt_->clientcode;
								$ladr1	 	= $lect_cpt_->l_adr1;
								$lcp 		= $lect_cpt_->l_cp;
								$laville 	= $lect_cpt_->l_ville;
								$lepays 	= $lect_cpt_->l_pays;
								$letel 		= $lect_cpt_->l_tel;
								$lemel	 	= $lect_cpt_->l_mail;
								
							  ?>
							  <form role="form" class="needs-validation" novalidate method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  autocomplete="off" >
								<div class="row">
									<div class="form-group col-md-6">
										<label for="InputName">Nom *</label>
										<input type="text" class="form-control creationcompte" id="InputName" placeholder="Votre nom" required name="_lenom" value="<?php echo $nom; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="InputLastName">Pr&eacute;nom *</label>
										<input type="text" class="form-control creationcompte" id="InputLastName" placeholder="Votre pr&eacute;nom" required name="_leprenom" value="<?php echo $prenom; ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="form-group col-md-6">
										<label for="InputSociete">Soci&eacute;t&eacute;</label>
										<input type="text" class="form-control creationcompte" id="InputSociete" placeholder="Nom de votre Soci&eacute;t&eacute;" name="_societe" value="<?php echo $lsoc; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="InputCodeCli">Code client Feraud</label>
										<input type="text" class="form-control creationcompte" id="InputCodeCli" placeholder="Code client" name="_clientcode" value="<?php echo $clientcde; ?>" disabled="disabled">
										
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="form-group col-md-12">
										<label for="InputSiren">Siren</label>
										<input type="text" class="form-control creationcompte" id="InputSiren" placeholder="Num&eacute;ro Siren de votre soci&eacute;t&eacute;" name="_siren" value="<?php echo $lsoc_siren; ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="form-group col-md-12">
										<label for="InputAdress">Adresse *</label>
										<input type="text" class="form-control creationcompte" id="InputAdress" placeholder="Votre Adresse" required name="_ladresse" value="<?php echo $ladr1; ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								 
								<div class="row">
									<div class="form-group col-md-6">
										<label for="InputCpe">Code Postal *</label>
										<input type="text" class="form-control creationcompte" id="InputCpe" placeholder="Votre code postal" required name="_lecp" value="<?php echo $lcp; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="InputVille">Ville *</label>
										<input type="text" class="form-control creationcompte" id="InputVille" placeholder="Votre ville" required name="_laville" value="<?php echo $laville; ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="form-group col-md-6">
										<label for="InputPays">Pays</label>
										<input type="text" class="form-control creationcompte" id="InputPays" placeholder="Votre pays" name="_lepays" value="<?php echo $lepays; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="InputTele">T&eacute;l&eacute;phone portable *</label>
										<input type="text" class="form-control creationcompte" id="InputTele" placeholder="Votre num&eacute;ro de t&eacute;l&eacute;phone portable" required name="_letel" value="<?php echo $letel; ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="form-group col-md-6">
										<label for="exampleInputEmail1">Email </label>
										<input type="email" class="form-control creationcompte" id="exampleInputEmail1" placeholder="Votre email" required name="mel1" onchange="form.mel2.pattern = RegExp.escape(this.value);" value="<?php echo $lemel; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="exampleInputEmail1">Email confirmation</label>
										<input type="email" class="form-control creationcompte" id="exampleInputEmail1" placeholder="Confirmez votre adresse Mail" required name="mel2"  value="<?php echo $lemel; ?>">
									</div>
								</div>
								<div class="clearfix"></div>
								
								<div class="row">
									<div class="form-group col-md-6">
										<label for="exampleInputPassword1">Mot de passe (En cas de modification)</label>
										<input type="password" class="form-control creationcompte" id="exampleInputPassword1" placeholder="Mot de passe (Min. 8 caract&egrave;res et au moins 1 majuscule et 1 chiffre)"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1" onchange="form.pwd2.pattern = RegExp.escape(this.value);"  autocomplete="new-password">
									</div>
									<div class="form-group col-md-6">
										<label for="exampleInputPassword1">Confirmez le mot de passe (En cas de modification)</label>
										<input type="password" class="form-control creationcompte" id="exampleInputPassword1" placeholder="Confirmation du mot de passe"  minlength="8" maxlength="12" name="pwd2" >
									</div>
								</div>
								<div class="clearfix"></div>
								
							   
								
								<div class="row">
									<div class="form-group col-md-6">
										<div class="g-recaptcha" data-sitekey="6Le4E7kfAAAAAPiIzvUarY9NxIENXPKq2_UF0NTQ"></div>
									</div>
									<div class="form-group col-md-6">
										<input type="submit" class="btn btn-default fondrouge" value="Modifier vos coordonn&eacute;es" name="valider">
									</div>
								</div>
							</form>
							<?php 
							
								}else{
									
									$privatekey = "6Le4E7kfAAAAAJj3Q6QC3nQGwLtU0lRmCm-EYShr";
									$captcha=$_POST['g-recaptcha-response'];
									$ip = $_SERVER['REMOTE_ADDR'];
												
									$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$ip);
									$responseKeys = json_decode($response,true); 
										
									if(intval($responseKeys["success"]) !== 1) {
										// What happens when the CAPTCHA was entered incorrectly
										echo ("<p class=\"rouge\">Le code entr&eacute; est incorrect. Merci de r&eacute;essayer.</p><p><a class=\"erreur\" href=\"feraud-mon-compte-modifier-compte-client\">Cliquez ici</a><br><br><br><br><br><br><br><br><br><br><br><br></p>");
									}else{
										
									
											// Your code here to handle a successful verification
										
											$date1 = date('Y-m-d');
											$heure = date('H:i:s');
											$civiliv	= "";
											
											$adresse2	= "";
											$lenom		= securiseFormulaire($_POST['_lenom']);
											$leprenom	= securiseFormulaire($_POST['_leprenom']);
											$societe	= securiseFormulaire($_POST['_societe']);
											// $clientcode	= securiseFormulaire($_POST['_clientcode']);
											$siren		= securiseFormulaire($_POST['_siren']);
											$ladresse	= securiseFormulaire($_POST['_ladresse']);
											$lecp		= securiseFormulaire($_POST['_lecp']);
											$laville	= securiseFormulaire($_POST['_laville']);
											$lemel1		= securiseFormulaire($_POST['mel1']);
											$lemel2		= securiseFormulaire($_POST['mel2']);
											$lepwd1		= securiseFormulaire($_POST['pwd1']);
											$lepwd2		= securiseFormulaire($_POST['pwd2']);
											$lepays		= securiseFormulaire($_POST['_lepays']);
											$letel		= securiseFormulaire($_POST['_letel']);
											
											$civil		= "";
											$lenom2		= $lenom;
											$leprenom2	= $leprenom;
											$societe2	= $societe;
											$siren2		= $siren;
											$ladresse2	= $ladresse;
											$ladresse3	= "";
											$lecp2		= $lecp;
											$laville2	= $laville;
											$pays2		= "";
											
											if($lepwd1 <> ""){
												// On chiffre le message
												$options = [
													'cost' => 12,
												];
												$motdepassechiffre =  password_hash($lepwd1, PASSWORD_BCRYPT, $options);
												// enregistrer le compte en base de donnees
												$querymajcpt  = "update `illi21_clients_cpt` set ";
												$querymajcpt .= "`l_civilite` = '$civiliv',  `l_nom` = '$lenom', `l_prenom` = '$leprenom', `l_adr1` = '$ladresse', `l_adr2` = '$adresse2', `l_cp` = '$lecp', `l_ville` = '$laville', `l_pays` = '$lepays', ";
												$querymajcpt .= "`l_tel` = '$letel', `l_soc` = '$societe', `l_soc_siren` = '$siren', `l_mail` = '$lemel1', `c_civilite` = '$civil', `c_nom` = '$lenom2', `c_prenom` = '$leprenom2', ";
												$querymajcpt .= "`c_adr1` = '$ladresse2',`c_adr2` = '$ladresse3',`c_cp` = '$lecp2', `c_ville` = '$laville2', `c_pays` = '$pays2', `c_tel` = '$letel', `c_soc` = '$societe2',`c_soc_siren` = '$siren2',";
												$querymajcpt .= "`c_mail` = '$lemel1', `c_mdp` = '$motdepassechiffre' WHERE id_client = '$id_user' limit 1";
											}else{
												// enregistrer le compte en base de donnees
												$querymajcpt  = "update `illi21_clients_cpt` set ";
												$querymajcpt .= "`l_civilite` = '$civiliv',  `l_nom` = '$lenom', `l_prenom` = '$leprenom', `l_adr1` = '$ladresse', `l_adr2` = '$adresse2', `l_cp` = '$lecp', `l_ville` = '$laville', `l_pays` = '$lepays', ";
												$querymajcpt .= "`l_tel` = '$letel', `l_soc` = '$societe', `l_soc_siren` = '$siren', `l_mail` = '$lemel1', `c_civilite` = '$civil', `c_nom` = '$lenom2', `c_prenom` = '$leprenom2', ";
												$querymajcpt .= "`c_adr1` = '$ladresse2',`c_adr2` = '$ladresse3',`c_cp` = '$lecp2', `c_ville` = '$laville2', `c_pays` = '$pays2', `c_tel` = '$letel', `c_soc` = '$societe2',`c_soc_siren` = '$siren2',";
												$querymajcpt .= "`c_mail` = '$lemel1' WHERE id_client = '$id_user' limit 1";
											}
								
											// echo $querymajcpt;
											$res_mod_client = mysqli_query($lien,$querymajcpt) or die ("Erreur modification client".$querymajcpt);
										
											?>
											<p >Votre compte a bien &eacute;t&eacute; modifi&eacute;.<br /></strong><br /><br /> <a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">Cliquez ici</a> pour vous retourner &agrave; l'accueil<br /><br /><br /><br /><br /><br /><br /><br /></p>
											<?php
									}
							}
						}
					?>
                    </div>
					<div class="clearfix"></div>        
                    <br /><br />
                </div>
			
			
			
			
            
			
				<!-- InstanceEndEditable -->			
                <?php 
				}else{
					// formulaire de connection
					?>
					
                            <div class="col-sm-6 col-md-4" style="float:none;margin:auto;" >
                                <h1 class="text-center login-title">Connectez-vous pour continuer sur Feraud-color.fr</h1>
                                <div class="account-wall">
                                    <img class="profile-img" src="images/login-feraud.png" alt="">
                                  <form class="form-signin" name="seconnecter" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    <input type="text" class="form-control" placeholder="Email"  name="identifiantc" required autofocus>
                                    <input type="password" class="form-control" placeholder="Mot de passe" name="motdepassec" id="iDmdp">
                                    <div class="col-12 mb-1"><input type="checkbox" onclick="monPass()">&nbsp;<i>Afficher le mot de passe</i></div>
                                    <button class="btn btn-lg btn-feraud btn-block" type="submit" name="co-admin">Se connecter</button>
                                    
                                    <span class="clearfix"></span>
                                  </form>
                                </div>
                                <?php if ($erreur <> "ok" and $erreur <> "") echo "<center><p class='rouge'>".$erreur."</p></center>"; ?>
                                <a href="feraud-mon-compte-creer-un-nouveau-compte" class="text-center new-account">Cr&eacute;er un compte</a>
                                <a href="feraud-mon-compte-modifier-mdp-compte" class="text-center new-account">Mot de passe oubli&eacute;</a>
                            </div>
                    
					<?php
				}
				?>
            </div>
	  </div>
	</div>
    
    
    
    
	
    
    
    
   
    
    

<!-- Trois boutons -->

	<div class="benefit">
		<div class="container">
			<div class="row">
            	<div class="col-lg-4 accueil">
            		<div class="row centre">
                        <div class="col-12 icon_couleurs"><img src="images/picto-couleurs-dispo.png" /></div>
                        <div class="col-12">
                            <h6>16000 couleurs disponibles</h6>
                            
                        </div>
                    </div>
                </div>
	            <div class="col-lg-4 accueil">                
                    <div class="row centre">
                        <div class="col-12 icon_nuancier"><img src="images/picto-nuancier.png" /></div>
                        <div class="col-12">
                            <h6>3 nuanciers</h6>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 accueil">                
                    <div class="row centre">
                        <div class="col-12 icon_livraison"><img src="images/picto-chrono.png" /></div>
                        <div class="col-12">
                            <h6>Livraison en 48h</h6>
                            
                        </div>
                    </div>
        		</div>
            </div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="footer_nav_container d-flex flex-sm-row flex-column  justify-content-lg-start  text-center">
                    	<ul class="footer_nav">
                        	<li><h4><?php echo $noment; ?></h4></li>
							<li><?php echo $adresse; ?></li>
							<li><?php echo $cp; ?> <?php echo $ville; ?> </li>
                            <li>T&eacute;l. : <?php echo $numtel; ?></li>
                            <li>Mail : <?php echo $emel; ?></li>
                        </ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="footer_nav_container d-flex flex-sm-row flex-column  justify-content-lg-start  text-center">
						<ul class="footer_nav">
                        	<li><h4>&agrave; propos de Feraud Color</h4></li>
                        	<li><a href="feraud-qui-sommes-nous-peinture-laque-lasure-vernis-couleurs">Qui sommes-nous ?</a></li>
							<li><a href="feraud-quoi-peindre-explications-support-bois-pvc-metal">Notre offre</a></li>
							<li><a href="feraud-comment-peindre-explications-peinture">Comment commander ?</a></li>
                        </ul>
					</div>
				</div>
                <div class="col-lg-4">
					<div class="footer_nav_container d-flex flex-sm-row flex-column  justify-content-lg-start  text-center">
						<ul class="footer_nav">
                        	<li><h4>Infos utiles</h4></li>
                        	<li><a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver">Contact</a></li>
							<li><a href="feraud-peinture-mentions-legales-et-credits">Mentions l&eacute;gales</a></li>
							<li><a href="feraud-peinture-laques-conditions-generale-de-vente">CGV</a></li>
                        </ul>
					</div>
				</div>
                
			</div>
			
		</div>
	</footer>
    <div class="footer-bas">
    	<div class="container">
			<div class="row">
            	<div class="col-lg-12">
					<div class="footer_nav_container">
						<div align="center">&copy;Feraud Color - <?php echo $annee; ?>, tous droits r&eacute;serv&eacute;s - <a href="https://www.declic-communication.com" target="_blank">Cr&eacute;ation et programmation de sites internet : D&eacute;clic Communication</a></div>
					</div>
				</div>
            </div>
    	</div>
    </div>

</div>






<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>

<!-- InstanceBeginEditable name="footer" --><!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
