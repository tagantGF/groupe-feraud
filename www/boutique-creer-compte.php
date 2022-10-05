<?php
	session_start();
	require_once 'includes/fonctionsqli.php';
	require_once 'includes/panier.php';
	$lien = connexionBDD();
	$lien -> set_charset("utf8");
	
	// Lecture des paramètres adresse
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
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr"><!-- InstanceBegin template="/Templates/modele_pages.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html" />
<meta charset="utf-8" />
<meta name="robots" content="index, follow" />
<meta name="author" content="feraud-color.fr" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />



<!-- InstanceBeginEditable name="doctitle" -->
<title>Feraud Color- peinture qualité professionnelle, lasure et vernis couleurs sur mesure livré en France</title>
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
    
    <!-- InstanceBeginEditable name="EditRegion1" -->
    
	<div class="pages_internes">
        <div class="container">
        	<div class="row">
            	<div class="titreh1 col-6">
	            	<h1>Création compte client</h1>
                </div>
                <div class="col-6 droit"><i>* Champ obligatoire</i></div>
            </div>
            <div class="row">
                <div class="container">
                	<?php 
                	if(!isset($_POST['valider'])){
                	?>
                      <form role="form"  method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="creationcompte"  >
                      	<div class="row">
	                        <div class="form-group col-md-6">
    	                        
        	                    <input type="text" class="form-control creationcompte" id="InputName" placeholder="Votre nom *" required name="_lenom">
            	            </div>
                	        <div class="form-group col-md-6">
                    	        
                        	    <input type="text" class="form-control creationcompte" id="InputLastName" placeholder="Votre prénom *" required name="_leprenom">
	                        </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-6">
    	                       
        	                    <input type="text" class="form-control creationcompte" id="InputSociété" placeholder="Nom de votre société" name="_societe">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="col-md-4"><label for="InputName">Je suis client Feraud * </label></div>
                                    <div class="col-md-2"><input type="radio" name="clientbat" id="clientbat1" value="1" required/>&nbsp;Oui</div>
                                    <div class="col-md-2"><input type="radio" name="clientbat" id="clientbat0" value="0" checked="checked" />&nbsp;Non</div>
                                    <div class="col-md-4"><input type="text" class="form-control creationcompte hiddenblc" id="InputCodeCli" placeholder="Code client *" name="_clientcode"></div>
	                            </div>                        
            	            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-12">
    	                        
        	                    <input type="text" class="form-control creationcompte" id="InputSiren" placeholder="Numéro Siren de votre société" name="_siren">
            	            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-12">
    	                        
        	                    <input type="text" class="form-control creationcompte" id="InputAdress" placeholder="Votre Adresse *" required name="_ladresse">
            	            </div>
                        </div>
                        <div class="clearfix"></div>
                         
                        <div class="row">
	                        <div class="form-group col-md-6">
    	                        
        	                    <input type="text" class="form-control creationcompte" id="InputCpe" placeholder="Votre code postal *" required name="_lecp">
            	            </div>
                	        <div class="form-group col-md-6">
                    	        
                        	    <input type="text" class="form-control creationcompte" id="InputVille" placeholder="Votre ville *" required name="_laville">
	                        </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-6">
    	                        
        	                    <input type="text" class="form-control creationcompte" id="InputPays" placeholder="Votre pays" name="_lepays">
            	            </div>
                	        <div class="form-group col-md-6">
                    	       
                        	    <input type="text" class="form-control creationcompte" id="InputTele" placeholder="Votre numéro de téléphone portable *" required name="_letel">
	                        </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-6">
    	                        
        	                    <input type="email" class="form-control creationcompte" id="exampleInputEmail1" placeholder="Votre email *" required name="mel1" onchange="form.mel2.pattern = RegExp.escape(this.value);">
            	            </div>
                	        <div class="form-group col-md-6">
                    	        
                        	    <input type="email" class="form-control creationcompte" id="exampleInputEmail1" placeholder="Confirmez votre adresse Mail *" required name="mel2" >
	                        </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-6">
    	                        
        	                    <input type="password" class="form-control creationcompte" id="exampleInputPassword1" placeholder="Mot de passe (Min. 8 caractères et au moins 1 majuscule et 1 chiffre)" required minlength="8" maxlength="24" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1" onchange="form.pwd2.pattern = RegExp.escape(this.value);" title="Min. 8 caractères et au moins 1 majuscule et 1 chiffre" autocomplete="new-password" >
            	            </div>
                	        <div class="form-group col-md-6">
                    	        
                        	    <input type="password" class="form-control creationcompte" id="exampleInputPassword1" placeholder="Confirmation du mot de passe" required minlength="8" maxlength="24" name="pwd2" title="Min. 8 caractères et au moins 1 majuscule et 1 chiffre" >
	                        </div>
                        </div>

                        <div class="clearfix"></div>
                        
                        <div class="row">
                          <div class="form-group col-md-12">
                          	<label class="form-check-label">
                              <input class="form-check-input" type="checkbox" id="Inputaccept" name="_acceptrgpd" required> Je confirme avoir pris connaissance des informations relatives au recueil et &agrave; la gestion de mes donn&eacute;es via ce formulaire.
                            </label>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
	                        <div class="form-group col-md-12">
                       <i> Les informations recueillies par <?php echo $lect_adr_->noment; ?> via ce formulaire sont utilis&eacute;es pour traiter votre demande particuli&egrave;re et vous faire parvenir des informations commerciales li&eacute;es &agrave; notre soci&eacute;t&eacute;. Pour demander la modification ou la suppression de vos informations, <a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver">cliquez ici</a>.</i></div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                        	<div class="form-group col-md-6">
	                            <div class="g-recaptcha" data-sitekey="6Le4E7kfAAAAAPiIzvUarY9NxIENXPKq2_UF0NTQ"></div>
                            </div>
                            <div class="form-group col-md-6">
	                        	<input type="submit" class="btn btn-default fondrouge" value="Créer votre compte" name="valider">
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
								echo ("<p class=\"rouge\">Le code entré est incorrect. Merci de réessayer.</p><p><a class=\"erreur\" href=\"feraud-mon-compte-creer-un-nouveau-compte\">Cliquez ici</a><br><br><br><br><br><br><br><br><br><br><br><br></p>");
							}else{
							
								/*******************************************************************************/
								/*******************************************************************************/
								/*******************************************************************************/
								/*******************************************************************************/
								/*******************************************************************************/
								/*******************************************************************************/
								/*******************************************************************************/
								
								
								
								// Formulaire valide
								// Si le code Feraud est saisi je verifie si c'est Ok
								
								$type_de_compte		= '0'; // Client normal
								
								
								if(isset($_POST['_clientcode']) and ($_POST['_clientcode'] <> ""))
								{
									// Verification Client Feraud avant de creer le compte
									$clientcode	= securiseFormulaire($_POST['_clientcode']);
									$codpostal	= securiseFormulaire($_POST['_lecp']);
									$lect_cptr = "SELECT clicode, clinom, clicp, cli_reduc FROM illi21_clientsilli WHERE clicode = '".$clientcode."' and clicp = '".$codpostal."' ";
									// echo $lect_cptr;
									$res_lect_cptr_ = mysqli_query($lien, $lect_cptr);
									$row_cnt = mysqli_num_rows($res_lect_cptr_);
									if($row_cnt > 0)
									{
										// Ok compte Feraud valide
										$lect_bati = mysqli_fetch_object($res_lect_cptr_); 
										$type_de_compte		= '1';
										$mt_reduc = $lect_bati->cli_reduc; // On recupere le montant de la reduction
										$erreurcpt = '0';
									}else{
									
										$type_de_compte		= '0';
										$erreurcpt = '1';
										$mt_reduc = '0';
									}
								}else{
									$clientcode	= "";
									$erreurcpt = '0';
									$mt_reduc = '0';
								}
								
								// Si OK
								
								
								
								
								if($erreurcpt == '0')
								
								{					
								
									// Verifie si l'adresse mail a deja ete utilisee
									$lemel1		= securiseFormulaire($_POST['mel1']);
									
									$lectureclient = "SELECT * FROM illi21_clients_cpt WHERE c_mail = '$lemel1';";
									$resultat_lectureclient = mysqli_query($lien,$lectureclient) or die ("Erreur : authentification");
									$trouveclient = mysqli_num_rows($resultat_lectureclient);
									
									if ($trouveclient == 0)
									{
								
										// Your code here to handle a successful verification
									
										$date1 = date('Y-m-d');
										$heure = date('H:i:s');
										$civiliv	= "";
										
										$adresse2	= "";
										$lenom		= securiseFormulaire($_POST['_lenom']);
										$leprenom	= securiseFormulaire($_POST['_leprenom']);
										$societe	= securiseFormulaire($_POST['_societe']);
										
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
										$tel		= "";
										
										// On chiffre le message
										$options = [
											'cost' => 12,
										];
										$motdepassechiffre =  password_hash($lepwd1, PASSWORD_BCRYPT, $options);
										
										
										  //ON ENVOI UN MAIL DE CONFIRMATION A LA PERSONNE CONCERNEE
										
										$destinataire = $lemel1; 
										$mail  = $destinataire;
										
										$entete  = "MIME-Version: 1.0\r\n";
										
										$entete .='Content-Type: text/html; charset="utf-8"'." \r\n";
										$entete .= "From: ".$lect_adr_->noment."<".$lect_adr_->emel.">\r\n";
										$entete .= "Reply-To: $mail\r\n";
										$entete .= "Bcc: automate@declic-communication.com\r\n";
										$entete .= "Bcc: contact@feraud-color.fr\r\n";
										
										$sujet = "Feraud Color - Création de votre compte client";
										
										$message1 = "";
										$message1 .= "<html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n";
										$message1 .= "<title>Feraud Color</title></head>\r\n";
										$message1 .= "<body style=\"font-family:Arial, Helvetica, sans-serif;font-size:12px;\">\r\n";
										$message1 .= "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
										$message1 .= "<tr><td><table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
										$message1 .= "<tr><td width=\"200px\"><img src=\"https://feraud-color.fr/images/logo-feraud-color.png\" width=\"140\" height=\"50\" /></td></tr></table></td></tr></table>\r\n";
										
										$message1 .= "Bonjour, <br><br>";
										$message1 .= "Nous vous confirmons la cr&eacute;ation de votre compte client aupr&egrave;s de Feraud Color<br><br><br><br>";
										
										$message1 .= "Nom : ".stripslashes(($lenom))."<br>";
										$message1 .= "Pr&eacute;nom : ".stripslashes(($leprenom))."<br>";
										$message1 .= "Soci&eacute;t&eacute; : ".$societe."<br>";
										$message1 .= "Code client Feraud : ".$clientcode."<br>";
										$message1 .= "Siren : ".$siren."<br>";
										$message1 .= "Adresse : ".$ladresse."<br>";
										$message1 .= "Code Postal : ".$lecp."<br>";
										$message1 .= "Ville : ".$laville."<br>";
										$message1 .= "Pays : ".$lepays."<br>";
										$message1 .= "T&eacute;l&eacute;phone : ".$letel."<br>";
										$message1 .= "Courriel / identifiant de connexion : ".$lemel1."<br>";
										$message1 .= "Mot de passe : Vous seul le connaissez<br><br><br>";
												
										$message1 .= "Cordialement, <br>L'&eacute;quipe Feraud Color<br><br><br><br><br>";
										
										// Bas de page et fin de fichier
										$message1 .= "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
										$message1 .= "<tr><td colspan=\"7\"><table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal;\">\r\n";
										$message1 .= "<tr align=\"center\"><td>".$lect_adr_->noment." | ".$lect_adr_->adresse." | ".$lect_adr_->cp." ".$lect_adr_->ville." | T&eacute;l. : ".$lect_adr_->tel." | Email : <U><a href=\"mailto:".$lect_adr_->emel."\">".$lect_adr_->emel."</a></U>&nbsp;| <a href=\"http://feraud-color.fr\">feraud-color.fr</a></td></tr><tr align=\"center\"><td>SAS au capital de 39 255,62 Euros | SIRET 558 502 829 00036| APE 4673A| N&deg; intracommunautaire FR48 558 502 829</td></tr></table>\r\n";
										$message1 .= "</td></tr></table></body></html>\r\n";
										
										
										// enregistrer le compte en base de données
										$queryinsert  = "INSERT INTO `illi21_clients_cpt` (";
										$queryinsert .= "`clientcode`, `type_cpt`, `cl_dt_crea`, `cl_hr_crea`, `l_civilite`,  `l_nom`, `l_prenom`, `l_adr1`, `l_adr2`, `l_cp`, `l_ville`, `l_pays`, `l_tel`, `l_soc`, `l_soc_siren`, `l_mail`,";
										$queryinsert .= "`c_civilite`, `c_nom`, `c_prenom`, `c_adr1`,`c_adr2`,`c_cp`, `c_ville`, `c_pays`, `c_tel`, `c_soc`,`c_soc_siren`,`c_mail`, `c_mdp`, `cli_reduc`,`c_valide`";
										$queryinsert .= ") VALUES ";
										$queryinsert .= "( '$clientcode','$type_de_compte', '$date1', '$heure', '$civiliv', '$lenom', '$leprenom', '$ladresse', '$adresse2', '$lecp', '$laville', '$lepays', '$letel', '$societe','$siren','$lemel1',";
										$queryinsert .= "  '$civil', '$lenom2', '$leprenom2', '$ladresse2', '$ladresse3', '$lecp2', '$laville2', '$pays2', '$tel', '$societe2', '$siren2', '$lemel1', '$motdepassechiffre', '$mt_reduc' ,'1');";
							
										// echo $queryinsert;
										$res_enr_client = mysqli_query($lien,$queryinsert) or die ("Erreur enregistrement client".$queryinsert);
										
										
										// apres l'insertion on créé le numero de client avec l'id genere automatiquement
										
										
										$idclient = mysqli_insert_id($lien);
				
										
										// Si tout est Ok on envoi le mail au client
										
										mail($mail, utf8_decode($sujet), $message1, $entete);
									
										?>
										<p >Votre compte a bien été créé.<br />Un email vous a été envoyé sur l'adresse <strong><?php echo $destinataire; ?></strong>.<br /><br /> <a href="feraud-mon-compte-mes-commandes">cliquez ici</a> pour vous identifier<br /><br /><br /><br /><br /><br /><br /><br /></p>
										<?php
									}else{
										?>
										<p >Un compte exite déjà avec cette adresse mail.<br /><a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver">Cliquez ici</a> pour vous nous contacter<br /><br /><br /><br /><br /><br /><br /><br /></p>
										<?php
									// Fin vérif adresse mail si existante
									}
									
								
								}else{
									?>
                                    <p >Numéro de compte / Code postal incorrect.<br /><a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver">Cliquez ici</a> pour vous nous contacter<br /><br /><br /><br /><br /><br /><br /><br /></p>
                                    <?php
								
								
								//fin erreur compte Feraud
								}
								
							
							
							// Fin verif code captcha
							}
						}
					?>
                    </div>
                    <div class="clearfix"></div>
                
                    <br /><br />
                
                
            </div>
        </div>
	</div>
    
    <!-- InstanceEndEditable -->
    
    
	
    
    
    
    
        

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

<!-- InstanceBeginEditable name="footer" -->
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<script type="text/javascript">

$(function(){

$("#clientbat1").click(function(){$("#InputCodeCli").removeClass('hiddenblc');$('#InputCodeCli').attr('required', 'required');})


$("#clientbat0").click(function(){$("#InputCodeCli").addClass('hiddenblc');$('#InputCodeCli').removeAttr('required');})

})

</script>

<script type="text/javascript">

  // polyfill for RegExp.escape
  if(!RegExp.escape) {
    RegExp.escape = function(s) {
      return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
    };
  }

</script>
<!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
