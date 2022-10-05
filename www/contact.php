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
<title>Contactez Feraud Color, pour la peinture de qualit&eacute; professionnelle</title>
<meta name="Description" content="Feraud Color, la peinture, lasure et vernis de qualit&eacute; professionnelle sur-mesure � personnaliser et configurer suivant votre support � peindre." />
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
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css" />
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
    <?php 
		if(isset($_POST['nom']))		{ $nom = securiseFormulaire($_POST['nom']);}else{$nom = '';}
		if(isset($_POST['prenom']))		{ $prenom = securiseFormulaire($_POST['prenom']);}else{$prenom = '';}
		if(isset($_POST['adresse']))	{ $adresse = securiseFormulaire($_POST['adresse']);}else{$adresse = '';}
		if(isset($_POST['cp'])) 		{ $cp = securiseFormulaire($_POST['cp']);}else{$cp = '';}
		if(isset($_POST['ville']))		{ $ville = securiseFormulaire($_POST['ville']);}else{$ville = '';}
		if(isset($_POST['tel']))		{ $tel = securiseFormulaire($_POST['tel']);}else{$tel = '';}
		if(isset($_POST['mail']))		{ $mail = securiseFormulaire($_POST['mail']);}else{$mail = '';}
		if(isset($_POST['msg']))		{ $msg = securiseFormulaire($_POST['msg']);}else{$msg = '';}
		if(isset($_POST['clientbat']))	{ $clientbat = securiseFormulaire($_POST['clientbat']);}else{$clientbat = '';}
		if(isset($_POST['societe']))	{ $societe = securiseFormulaire($_POST['societe']);}else{$societe = '';}
	?>
<div class="pages_internes">
        <div class="container">
			<div class="row">
	            <div class="col-12">
                	<h1>Nous contacter !</h1>
                </div>
            </div>
            <div class="row">
            	<div class="col-12">
                	<p>Pour tous vos renseignements compl&eacute;mentaires, remplissez le formulaire ci-dessous avec vos coordonn&eacute;es.
Un conseiller Feraud Color vous contactera dans les plus brefs d&eacute;lais :</p>
                </div>
            </div>
            <div class="row">
                    <div class="col-8">

                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="contact" id="contact">
                          <div class="row mb-3">
                            <div class="col-6">
                              <input type="text" class="form-control" placeholder="Pr&eacute;nom*"  name="prenom" id="prenom" value="<?php echo $prenom; ?>" maxlength="50" tabindex="1" required aria-required="true" data-error="Pr&eacute;nom est obligatoire">
                            </div>
                            
                            <div class="col-6">
                              <input type="text" class="form-control" placeholder="Nom*"  name="nom" id="nom" value="<?php echo $nom; ?>"  maxlength="50" tabindex="2"  required aria-required="true" data-error="Nom est obligatoire">
                            </div>
                          </div>
                          
                          
                        <div class="row">
                            <div class="col-md-2"><label for="InputName">Je suis * </label></div>
                            <div class="col-md-2 specialsize"><input type="radio" name="clientbat" id="clientbat0" value="un particulier" tabindex="3" <?php if($clientbat == "un particulier") echo "checked=\"checked\""; ?> />&nbsp;un Particulier</div>
                            <div class="col-md-2 specialsize"><input type="radio" name="clientbat" id="clientbat1" value="une société" <?php if($clientbat == "une société") { echo "checked=\"checked\""; } ?> required/>&nbsp;une Société </div>
                            <div class="col-md-6"><input type="text" class="form-control creationcompte  <?php if($societe == '' and $clientbat <> "une société") echo "hiddenblc";?> mb-3" tabindex="5" id="InputCodeCli" placeholder="Nom de société *" name="societe" value="<?php echo $societe; ?>"></div>
                        </div>                        
            	          
                          
                          <div class="row mb-3">
                            <div class="col"><input type="text" class="form-control" placeholder="Adresse"  name="adresse" id="adresse" value="<?php echo $adresse; ?>" maxlength="100" tabindex="6" /></div>
                          </div>
                          
                          <div class="row mb-3">
                            <div class="col-4"><input type="text" class="form-control"  placeholder="Code Postal" name="cp" id="cp" value="<?php echo $cp; ?>" maxlength="8" tabindex="7" /></div>
                            <div class="col-8"><input type="text" class="form-control"  placeholder="Ville*" name="ville" id="ville" value="<?php echo $ville; ?>" maxlength="50" tabindex="8"  required aria-required="true"/></div>
                          </div>
                          
                          <div class="row mb-3">
                            <div class="col-6"><input type="text" class="form-control"  placeholder="T&eacute;l&eacute;phone*" name="tel" value="<?php echo $tel; ?>" id="tel" maxlength="15" tabindex="9"  required aria-required="true"/></div>
                            <div class="col-6"><input type="text" class="form-control"  placeholder="E-mail*"  name="mail" id="mail" value="<?php echo $mail; ?>" maxlength="255" tabindex="10"  required aria-required="true"/></div>
                          </div>
                          <div class="row mb-3">
                            <div class="col"><textarea name="msg" class="form-control"  placeholder="Votre message"  id="msg" cols="" rows="5" tabindex="11"><?php echo $msg; ?></textarea></div>
                          </div>
                          
                          <div class="row mb-3">
                            <div class="col-6"><div class="g-recaptcha" data-sitekey="6Le4E7kfAAAAAPiIzvUarY9NxIENXPKq2_UF0NTQ"></div></div>
                            <div class="col-6"><input type="submit" class="form-control red_button message_submit_btn trans_300" id="btn" name="btn" value="Envoyer" tabindex="12" /></div>
                          </div>
                        </form>
                    </div>
                    <div class="col-4">
                        <div id="conteneur-logo">
                            <h2><?php echo $lect_adr_->noment; ?></h2>
                            <p><?php echo $lect_adr_->adresse; ?></p>
                            <p><?php echo $lect_adr_->cp." ".$lect_adr_->ville; ?></p>
                            <p>T&eacute;l. : <?php echo $lect_adr_->tel; ?></p>
                            <p>Mail : <?php echo $lect_adr_->emel; ?></p>
                        </div>
                    </div>
                </div>
            
            
            <?php
             if(isset($_POST['btn']) && $_POST['btn'] == 'Envoyer')
			 {
				  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
				  {
						$secret = '6Le4E7kfAAAAAJj3Q6QC3nQGwLtU0lRmCm-EYShr';
						$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
						$responseData = json_decode($verifyResponse);
						if($responseData->success)
						{ 
							// Your code here to handle a successful verification
							$nom = securiseFormulaire($_POST['nom']);
							$prenom = securiseFormulaire($_POST['prenom']);
							
							$clientbat = securiseFormulaire($_POST['clientbat']);
							
							
							$adresse = securiseFormulaire($_POST['adresse']);
							$cp = securiseFormulaire($_POST['cp']);
							$ville = securiseFormulaire($_POST['ville']);
							$tel = securiseFormulaire($_POST['tel']);
							$mail = securiseFormulaire($_POST['mail']);

							$msg = securiseFormulaire($_POST['msg']);	
							
							$entete  = "MIME-Version: 1.0\r\n";
							$entete .= "Content-type: text/html; charset=iso-8859-1\r\n";
							$entete .= "From: ".$lect_adr_->noment."<".$lect_adr_->emel.">\r\n";
							$entete .= "Reply-To: $mail\r\n";
							$entete .= "Bcc: automate@declic-communication.com\r\n";
							$entete .= "Bcc: feraud.color@groupe-feraud.com\r\n";
							
							$sujet = "Demande de contact sur le site internet Feraud Color";
							
							$message = "Bonjour,<br /><br /> ";
							$message .= "Nous avons bien re&ccedil;u votre message et il sera trait&eacute; dans les plus brefs d&eacute;lais. <br><br>R&eacute;capitulatif de votre demande :<br>";
							$message .= "----------------------<br>";
							$message .= "Coordonn&eacute;es : <br>";
							$message .= "Nom : ".stripslashes(utf8_decode($nom))."<br>";
							$message .= "Pr&eacute;nom : ".stripslashes(utf8_decode($prenom))."<br>";
							$message .= "Je suis : ".stripslashes(utf8_decode($clientbat))."<br>";
							if(isset($_POST['societe']))	
							{ 
								$societe = securiseFormulaire($_POST['societe']); 
								if($societe <> '')
								{
									$message .= "Soci&eacute;t&eacute; : ".stripslashes(utf8_decode($societe))."<br>";
								}
							}
							if($adresse != "" && $cp != "" && $ville != "")
								$message .= "Adresse : ".stripslashes(utf8_decode($adresse))."<br>".stripslashes(utf8_decode($cp))." ".stripslashes(utf8_decode($ville))."<br>";
							if($tel != "")
								$message .= "T&eacute;l&eacute;phone : ".stripslashes(utf8_decode($tel))."<br>";
							$message .= "Adresse mail : ".stripslashes($mail)."<br>";
							
							$message .= "----------------------<br>";
							$message .= "Objet du contact : <br>";
							$message .= stripslashes(utf8_decode($msg));
							
							$message .= "----------------------<br>";
							$message .= "<br><br><b>Feraud Color</b><br>T&eacute;l. : ";
							
							mail($mail, $sujet, $message, $entete);
						
						
							?>
							<div style="color: limegreen;" align="center" class="mb-2"><br /><br /><b>Votre demande de contact a &eacute;t&eacute; soumise avec succ&egrave;s.</b><br /><br />
                            <script>
								$(document).ready(function () {
									
									$('#btn').prop('disabled', true);
									$('#contact').css({'display':'none'});									
								});
							</script>
                            </div>
                            <div align="center" class="mb-3"><a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee" name="retour" class="btn-info p-2 blancbouton">Retourner &agrave; la page d'accueil</a></div>
						<?php 
						}else{
						?>
							<div style="color: red;"><b>La v&eacute;rification du robot a &eacute;chou&eacute;, veuillez r&eacute;essayer.</b></div>
						<?php 
						}
				   }else{?>
					   <div style="color: red;"><b>Veuillez cocher la case de v&eacute;rification du robot.</b></div>
				   <?php 
				   }
             }
             ?>
                <div class="row">
                    <div class="col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d46463.195083320934!2d5.46773291190215!3d43.2943752!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x208e606fcf75544d!2sQuincaillerie%20FERAUD!5e0!3m2!1sfr!2sfr!4v1664436390237!5m2!1sfr!2sfr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
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
<script type="text/javascript">

$(function(){

$("#clientbat1").click(function(){$("#InputCodeCli").removeClass('hiddenblc');$('#InputCodeCli').attr('required', 'required');})
$("#clientbat0").click(function(){$("#InputCodeCli").addClass('hiddenblc');$('#InputCodeCli').removeAttr('required');})

})

</script>

<!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
