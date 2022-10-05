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
	$accroche =($lect_adr_->accroche);
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
            	<div class="titreh1 text-center">
	            	<h1>Demande de r&eacute;initialisation de mon mot de passe</h1>
                </div>
                <div class="container" align="center">
                	<div class="col-lg-12">Veuillez saisir votre adresse mail.<br />Une fois le formulaire valid&eacute;, vous recevrez un courriel sur votre adresse vous permettant de r&eacute;initaliser votre mot de passe.<br /><br /></div>
                </div>
                <div class="container">
                	<?php 
                	if(!isset($_POST['valider'])){
                	?>
                      <form role="form" id="reinitpass" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  >
                        <div class="row">
	                        <div class="form-group col-md-12">
    	                        
        	                    <input type="email" class="form-control creationcompte" id="exampleInputEmail1" placeholder="Votre email" required name="mel1" onchange="form.mel2.pattern = RegExp.escape(this.value);">
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
                       <i> Les informations recueillies par <?php echo $lect_adr_->noment; ?> via ce formulaire sont utilis&eacute;es uniquement pour traiter votre demande de r&eacute;initialisation de votre mot de passe.</i>
</div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="row">
                        	<div class="form-group col-md-6">
	                            <div class="g-recaptcha" data-sitekey="6Le4E7kfAAAAAPiIzvUarY9NxIENXPKq2_UF0NTQ"></div>
                            </div>
                            <div class="form-group col-md-6">
	                        	<input type="submit" class="btn btn-default fondrouge" value="Envoyez votre demande" name="valider">
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
								echo ("<p class=\"rouge\">Le code entr&eacute; est incorrect. Merci de r&eacute;essayer.</p><p><a class=\"erreur\" href=\"feraud-mon-compte-modifier-mdp-compte\">Cliquez ici</a><br><br><br><br><br><br><br><br><br><br><br><br></p>");
							}else{
								
									$date1 = date('Y-m-d');
									$heure = date('H:i:s');
									
									
									
									
									$lecp		= securiseFormulaire($_POST['_lecp']);
									
									$lemel1		= securiseFormulaire($_POST['mel1']);
									
									
									$lecture = "SELECT * FROM illi21_clients_cpt WHERE c_mail = '$lemel1' limit 1;";
									$resultat_lecture = mysqli_query($lien,$lecture) or die ("Erreur : authentification");
									$trouve = mysqli_num_rows($resultat_lecture);
								   
									if ($trouve == 0){
										$_SESSION['c_feraud']['auth'] = FALSE;
										?>
                                        <p >D&eacute;sol&eacute;, aucune correspondance "Adresse mail" n'a &eacute;t&eacute; trouv&eacute;e.<br /><br /> <a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">Cliquez ici</a> pour retourner &agrave; l'accueil du site<br /><br /><br /><br /><br /><br /><br /><br /></p>
                                        
                                        <?php
									}else{
	
										function base64url_encode( $data ){
										  return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
										}
										
										$url1 = "https://feraud-color.fr/_ps8i-";
										$url2 = "_idcp=|".$lecp;
										$url3 = "|&idco=|".$lemel1;
										$url4 = "|".time();
										
										$urlencodee = base64url_encode($url2.$url3.$url4);
									
										//ON ENVOI UN MAIL DE CONFIRMATION A LA PERSONNE CONCERNEE
										$sujet = "feraud-color.fr - Demande de réinitialisation du mot de passe";
										$mailheaders = "From: feraud-color.fr<contact@feraud-color.fr> \r\n";
										$mailheaders .='Content-Type: text/html; charset="utf-8"'." \r\n";
										// $mailheaders .= "Bcc: automate@declic-communication.com\r\n";
										// $mailheaders .= "Bcc: contact@feraud-color.fr\r\n";
										$destinataire = $lemel1; 
												
										$corps =  "Bonjour,<br><br>";
										$corps .= "Cliquez ou recopiez le lien ci-dessous dans un navigateur pour r&eacute;initialiser le mot de passe de votre compte feraud-color.fr<br><br>Ce lien est valable 15 minutes.<br><br>";
											
										$corps .= "<a href=\"".$url1.$urlencodee."\">".$url1.$urlencodee."</a><br><br><br>";
								
										$corps .= "Cordialement, <br>L'&eacute;quipe feraud-color.fr<br><br>";
										
										
										// Si tout est Ok on envoi le mail au client
										
										$subject = utf8_decode($sujet);
										$subject = mb_encode_mimeheader($sujet,"UTF-8");
										
										
										mail($destinataire,  $subject, $corps, $mailheaders);
									
										?>
										<p ><br />Un courriel vous a &eacute;t&eacute; envoy&eacute;. Il vous permettra de r&eacute;initialiser votre mot de passe.<br />Veuillez v&eacute;rifier &eacute;ventuellement dans vos courriers ind&eacute;sirables / spam<br /><br /><br /> <a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">Cliquez ici</a> pour retourner &agrave; l'accueil du site<br /><br /><br /><br /><br /><br /><br /><br /></p>
										
										<?php
									}
								
							}
					
					
					
					
						}
					?>
                    </div>
                    <br /><br />
                    <div class="clearfix"></div>
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

<!-- InstanceBeginEditable name="footer" --><!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
