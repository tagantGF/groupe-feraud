<?php
	session_start();
	$passwd = 'illico48';
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
	$accroche = utf8_encode($lect_adr_->accroche);
	
	
	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");
	while($tva =  mysqli_fetch_object($res_lect_tva))
	{
		$tauxtva["$tva->id_tva"] = $tva->taux_tva;	
	}
	
	$poidsmaxi = 210;
	
	$_SESSION['facturation']['pays'] 	= "FR";
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


<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->


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
            
            	<div class="col-lg-12">
                  	<div class="row">
		            	<div class="titrebgrouge">Confirmation de commande</div>
                    </div>
                </div>
                <div class="col-lg-12 bordure">
                <?php
	            // print_r($_SESSION['panierfer']);
    	        if(creationPanier())
				{
            	    $nb_article = count($_SESSION['panierfer']['identifiant']);
                	if ($nb_article <= 0)
					{
	                    ?>
	                    <div class="col-lg-12">
                        	<div class="row">
		                        <p style="font-style:italic; font-size:12px;">Votre panier est vide</p>
    		                    <p><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></p>
                            </div>
                        </div>
	                    <?php	
	                }else{
						$lemessage = 0;
						if($_SESSION['panierfer']['typepai'] == "cb")
						{
							$depas = 1;
							$lecompte = "";
							
							$_SESSION['panierfer']['c_reduc'] = '0';
							$_SESSION['panierfer']['c_pourc'] = '0';
							
							$_SESSION['livraison']['civilite'] 	 = securiseFormulaire($_POST['civilite_l']);
							$_SESSION['livraison']['prenom'] 	 = securiseFormulaire(stripslashes($_POST['prenom_l']));
							$_SESSION['livraison']['nom'] 		 = securiseFormulaire(stripslashes($_POST['nom_l']));
							$_SESSION['livraison']['adr1'] 		 = securiseFormulaire(stripslashes($_POST['adresse_l']));
							$_SESSION['livraison']['cp'] 		 = securiseFormulaire($_POST['cp_l']);
							$_SESSION['livraison']['ville'] 	 = securiseFormulaire(stripslashes($_POST['ville_l']));
							$_SESSION['livraison']['societe'] 	 = securiseFormulaire(stripslashes($_POST['societe_l']));
							$_SESSION['livraison']['portable'] 	 = securiseFormulaire($_POST['telephone_l']);
							$_SESSION['livraison']['emel'] 		 = securiseFormulaire($_POST['emel_l']);
							
							$_SESSION['livraison']['commentaire'] = "";
							
							if(isset($_POST['factidem']))
							{
								$_SESSION['facturation']['civilite'] 	= securiseFormulaire($_POST['civilite_f']);
								$_SESSION['facturation']['prenom'] 		= securiseFormulaire(stripslashes($_POST['prenom_f']));
								$_SESSION['facturation']['nom'] 		= securiseFormulaire(stripslashes($_POST['nom_f']));
								$_SESSION['facturation']['adr1'] 		= securiseFormulaire(stripslashes($_POST['adresse_f']));
								$_SESSION['facturation']['cp'] 			= securiseFormulaire($_POST['cp_f']);
								$_SESSION['facturation']['ville'] 		= securiseFormulaire(stripslashes($_POST['ville_f']));
								$_SESSION['facturation']['societe'] 	= securiseFormulaire(stripslashes($_POST['societe_f']));
								$_SESSION['facturation']['portable'] 	= securiseFormulaire($_POST['telephone_f']);
							
							}else{
								$_SESSION['facturation']['civilite']	= securiseFormulaire($_POST['civilite_l']);
								$_SESSION['facturation']['prenom']		= securiseFormulaire(stripslashes($_POST['prenom_l']));
								$_SESSION['facturation']['nom'] 		= securiseFormulaire(stripslashes($_POST['nom_l']));
								$_SESSION['facturation']['adr1'] 		= securiseFormulaire(stripslashes($_POST['adresse_l']));
								$_SESSION['facturation']['cp'] 			= securiseFormulaire($_POST['cp_l']);
								$_SESSION['facturation']['ville']		= securiseFormulaire(stripslashes($_POST['ville_l']));
								$_SESSION['facturation']['societe'] 	= securiseFormulaire(stripslashes($_POST['societe_l']));
								$_SESSION['facturation']['portable'] 	= securiseFormulaire($_POST['telephone_l']);
							}
						}	
						if($_SESSION['panierfer']['typepai'] == "cpt")
						{
							$lecompte  = securiseFormulaire($_POST['compte']);
						
							$lemessage = 0;
							$_SESSION['livraison']['civilite'] 	 = "";
							$_SESSION['livraison']['prenom'] 	 = "";
							$_SESSION['livraison']['nom'] 		 = "";
							$_SESSION['livraison']['adr1'] 		 = "";
							$_SESSION['livraison']['cp'] 		 = "";
							$_SESSION['livraison']['ville'] 	 = "";
							$_SESSION['livraison']['societe'] 	 = securiseFormulaire($_POST['compte']);
							$_SESSION['livraison']['portable'] 	 = "";
							$_SESSION['livraison']['emel'] 		 = securiseFormulaire($_POST['lemail']);
							$_SESSION['livraison']['commentaire'] = securiseFormulaire($_POST['commentaire']);
							
							
							$_SESSION['facturation']['civilite']	= "";
							$_SESSION['facturation']['prenom']		= "";
							$_SESSION['facturation']['nom'] 		= "";
							$_SESSION['facturation']['adr1'] 		= "";
							$_SESSION['facturation']['cp'] 			= "";
							$_SESSION['facturation']['ville']		= "";
							$_SESSION['facturation']['societe'] 	= "";
							$_SESSION['facturation']['portable'] 	= "";
							$lepass = securiseFormulaire($_POST['motdepas']);
							
							
							
							// echo $lepass;
							if ( $lepass <> $passwd) 
								{
									$codpostal = securiseFormulaire($_POST['codp']);
									$lecompte  = securiseFormulaire($_POST['compte']);
									$lemail  = securiseFormulaire($_POST['lemail']);
									// Pas de mot de passe donc on vérifie si le compte et cp existe en base
									
									// Lecture des paramètres adresse
									$lect_cptr = "SELECT clicode, clinom, clicp, cli_reduc FROM illi21_clientsilli WHERE clicode = '".$lecompte."' and clicp = '".$codpostal."' ";
									// echo $lect_cptr;
									$res_lect_cptr_ = mysqli_query($lien, $lect_cptr);
									$row_cnt = mysqli_num_rows($res_lect_cptr_);
									if($row_cnt > 0)
									{
										$lect_res_lect_cptr_    = mysqli_fetch_object($res_lect_cptr_); 
										$depas = 1;
										$lemessage = 1;
										$reduc = $lect_res_lect_cptr_->cli_reduc;
										$_SESSION['panierfer']['c_pourc'] = $reduc;
										// Ok en compte on affiche le mot de passe
										
									}else{
										$depas = 0;
										$_SESSION['panierfer']['c_pourc'] = '0';
										$lemessage = 0;
										// Pas en compte on envoi un mail à c.gomes@batifer.fr
										// $lemel  = "c.gomes@batifer.fr";
										$lemel  = "b.bour@declic-communication.fr";
										$entete  = "MIME-Version: 1.0\r\n";
										$entete .= "Content-type: text/html; charset=iso-8859-1\r\n";
										$entete .= "From: ".$lect_adr_->noment."<".$lect_adr_->emel.">\r\n";
										$entete .= "Reply-To: ".$lect_adr_->emel."\r\n";
										$entete .= "Bcc: automate@declic-communication.com\r\n";
										$message = "Bonjour.<br>Un client a essayé de passer commande sans mot de passe et sans être dans le fichier de vos clients :<br><br>\r\n\r\n";
										
										$message .= "Compte : ".$lecompte."<br>\r\n";
										$message .= "Mail : ".$lemail."<br>\r\n";
										$message .= "Code postal : ".$codpostal."<br>\r\n";
										
										$sujet = "Site internet Feraud Color - Client inexistant en base";
										// mail($lemel, $sujet, $message, $entete);
										
									}
										
									
								}else{
									$depas = 1;
								}
						}
						if(isset($_POST['code_p']))
						{
							$_SESSION['livraison']['code_p'] = securiseFormulaire($_POST['code_p']);
						}else{
							$_SESSION['livraison']['code_p'] = "";
						}
						
						
						// Vérifie si le compte existe
						$lecture_compte = "SELECT clicode, clinom, clicp, cli_reduc FROM illi21_clientsilli WHERE clicode = '".$lecompte."' limit 1 ";
						$res_lecture_compte = mysqli_query($lien, $lecture_compte);
						$nb_row_cnt = mysqli_num_rows($res_lecture_compte);
						if($nb_row_cnt > 0 or $depas == 1)
						{
							if($nb_row_cnt > 0)
							{
								$lect_res_lecture_compte    = mysqli_fetch_object($res_lecture_compte); 
								$reduc = $lect_res_lecture_compte->cli_reduc;
								$_SESSION['panierfer']['c_pourc'] = $reduc;
								$comptexist = '1';
							}else{
								$_SESSION['panierfer']['c_pourc'] = "";
								$comptexist = '0';
								$reduc = '0';
							}
							if($depas == 1)
							{
								if ($lemessage == 1)
								{
								?>
								
								<p><strong>Attention</strong> Merci de noter le mot de passe pour vos prochaines commandes : <span class="coulpass"><?php echo $passwd; ?></span></p>
								<?php
								
								}
							?>
								<div id="panier">
									<div class="row lepanier">
											<div class="col-lg-9 lepanier_item">Produit</div>
											<div class="col-lg-1 lepanier_item droit">Nb</div>
											<div class="col-lg-1 lepanier_item droit">Prix unitaire</div>
											<div class="col-lg-1 lepanier_item droit">Total TTC</div>
											
									</div>
								<?php
								$compteur=1;
							$i=0;
							for ($i=0; $i<$nb_article; $i++)
							{ 
								
								?>
								<div class="row lesligne">
									<div class="col-lg-9">
										<?php 
											if($_SESSION['panierfer']['nomproduit'][$i] <> "")
											{
												echo $_SESSION['panierfer']['nomproduit'][$i]; 
											}else{
												// Le support
												$requet_ = "SELECT id_s as id, sup_nom as nom FROM illi21_support where id_s = '".$_SESSION['panierfer']['id_support'][$i]."'";
												// echo $requet_;
												$resultat_    = mysqli_query($lien, $requet_);
												$lect_res_    = mysqli_fetch_object($resultat_); 
												$lesupport    = "&nbsp;".$lect_res_->nom;
												
												// Le nuancier
												$requet_ = "SELECT id_n as id, nunom as nom FROM illi21_nuancier where id_n = '".$_SESSION['panierfer']['id_nuancier'][$i]."'";
												// echo $requet_;
												$resultat_    = mysqli_query($lien, $requet_);
												$lect_res_    = mysqli_fetch_object($resultat_); 
												$lenuancier   = "&nbsp;".$lect_res_->nom;
												
												// Le contenant
												$requet_ = "SELECT id_c as id, cont_nom as nom FROM illi21_contenant where id_c = '".$_SESSION['panierfer']['id_contenant'][$i]."'";
												// echo $requet_;
												$resultat_    = mysqli_query($lien, $requet_);
												$lect_res_    = mysqli_fetch_object($resultat_); 
												$lecontenant   = "&nbsp;".$lect_res_->nom;
												
												
												
												if($_SESSION['panierfer']['id_nuancier'][$i] == '99')
												{									
												?>
													<span class='pan_couleur' style="border-bottom:1px #FFFFFF solid;"><?php echo $_SESSION['panierfer']['la_couleur'][$i]?></span>
												<?php 
												}else{
												?>
													<span class='pan_couleur' style="background:<?php echo $_SESSION['panierfer']['la_couleur'][$i]; ?>; border-bottom:1px #FFFFFF solid;"></span>
												<?php 
												
												}
												
												
												echo "<span class='pan_support'>".utf8_encode($lesupport)."</span><span class='pan_sepa'>&nbsp;|&nbsp;</span><span class='pan_nuancier'>".$_SESSION['panierfer']['rf_couleur'][$i]."</span>&nbsp;<span class='pan_brillance'>".$_SESSION['panierfer']['brillance'][$i]."</span><span class='pan_sepa'>&nbsp;|&nbsp;</span><span class='pan_contenant'>".$lecontenant."</span>";
											}
											
										?>
									</div>
									<div class="col-lg-1 droit"><div class="mobile"></div><?php echo $_SESSION['panierfer']['nb_pot'][$i];	 ?></div>
									<div class="col-lg-1 droit"><div class="mobile"></div><?php echo $_SESSION['panierfer']['prixunitaire'][$i]." &euro;";	 ?></div>
									<div class="col-lg-1 droit"><div class="mobile"></div><?php echo $_SESSION['panierfer']['mttc'][$i]." &euro;"; ?></div>
									
								</div>
								<?php 
								 $compteur++;
										}
										
										$totalttc = $_SESSION['panierfer']['montantTotal'];
										$_SESSION['panierfer']['poids_colis'] = PoidsGlobal();
										$poidstotal = $_SESSION['panierfer']['poids_colis'];
										$_SESSION['panierfer']['fraisdePort'] = FraisdePort();
										
										?>
                                                                               
                                        
                                        <div class="row lepanier">
                                                <div class="col-7">&nbsp;TOTAL HT de la commande</div>
                                                <div class="col-5 droit">
                                                <?php 
                                                        $nouvtotal2 = ($_SESSION['panierfer']['montantTotal']);
                                                        $nouvtotalht = number_format($nouvtotal2 / ( (100 + $tauxtva[1]) / 100 ), 2, '.', ' ');
                                                        echo $nouvtotalht." &euro;"; 
                                                ?>
                                                </div>
                                        </div>
                                        <?php 
										// Si remise
										if($reduc > 0)
										{
											//calcul du montant de la reduction HT
											$lareduc =  number_format(($nouvtotalht * $reduc / 100), 2, '.', ' ');
											$_SESSION['panierfer']['c_reduc'] = $lareduc;
											$_SESSION['panierfer']['montantTotal'] = ($nouvtotalht - $lareduc) * ((100 + $tauxtva[1]) / 100 );
											?>
											<div class="row lepanierclair">
                                                <div class="col-7">&nbsp;Montant HT de votre réduction "Client Batifer"</div>
                                                <div class="col-5 droit">
                                                <?php 
                                                        echo $lareduc." &euro;"; 
                                                ?>
                                                </div>
	                                        </div>
											<?php
										}else{
											$_SESSION['panierfer']['c_reduc'] = '0';
										}
										
										?>
										
                                        <div class="row lepanierclair">
											<div class="col-7">&nbsp;Frais de port TTC</div>
											<div class="col-5 droit"><?php echo $_SESSION['panierfer']['fraisdePort']." &euro;"; ?></div>
										</div>
										
										<div class="row lepanier">
												<div class="col-7">&nbsp;TOTAL TTC de la commande</div>
												<div class="col-5 droit">
												<?php 
													
														$nouvtotal = $_SESSION['panierfer']['montantTotal'] + $_SESSION['panierfer']['fraisdePort'];
														$_SESSION['panierfer']['mttccmd'] = $nouvtotal;
														echo number_format($nouvtotal, 2, '.', ' ')." &euro;"; 
														
													
														
												?>
												</div>
										</div>
					
									   
									
									
									<?php if($totalttc > 0) 
									{
										if($_SESSION['panierfer']['typepai'] == "cb")
										{
									
										?>
										<div class="row">
											<div id="rappeladresse-fac" class="col-sm-4">
												<p><span class="titrelivgbordeau">Adresse de facturation</span></p>
												<p>
												<?php 
													if($_SESSION['facturation']['societe'] <> "") echo $_SESSION['facturation']['societe']."<br>";
													echo $_SESSION['facturation']['civilite']." ".$_SESSION['facturation']['prenom']." ".$_SESSION['facturation']['nom']."<br>";
													if($_SESSION['facturation']['adr1'] <> "") echo $_SESSION['facturation']['adr1']."<br>";
													echo $_SESSION['facturation']['cp']." ".$_SESSION['facturation']['ville']."<br>";
													echo $_SESSION['facturation']['portable'];
												?>
												</p>
											</div>
											<div id="rappeladresse-liv" class="col-sm-4">
												<p><span class="titrelivgbordeau">Adresse de livraison</span></p>
												<p>
												<?php 
													if($_SESSION['livraison']['societe'] <> "") echo $_SESSION['livraison']['societe']."<br>";
													echo $_SESSION['livraison']['civilite']." ".$_SESSION['livraison']['prenom']." ".$_SESSION['livraison']['nom']."<br>";
													if($_SESSION['livraison']['adr1'] <> "") echo $_SESSION['livraison']['adr1']."<br>";
													echo $_SESSION['livraison']['cp']." ".$_SESSION['livraison']['ville']."<br>";
													echo $_SESSION['livraison']['portable'];
												?>
												</p>
											</div>
											
										</div>
										
										<?php 
										}else{
											if($_SESSION['panierfer']['typepai'] == "cpt")
											{
											?>
											<div id="rappeladresse" class="clear col-sm-4">
												<div id="rappeladresse-fac">
													<p><span class="titrelivgbordeau">Compte de facturation</span></p>
													<p>
													<?php 
														if($_SESSION['livraison']['societe'] <> "") echo "<div class='row'><span class='col-sm-4' style='font-weight:700'>Compte :</span> ".$_SESSION['livraison']['societe']."</div>";
														if($_SESSION['livraison']['emel'] <> "") echo "<div class='row'><span class='col-sm-4' style='font-weight:700'>Mail :</span> ".$_SESSION['livraison']['emel']."</div>";
													?>
													</p>
													<?php 
													if($_SESSION['livraison']['code_p'] <> ''){
													echo "<span class=\"titrelivgbordeau\">Code Promo : </span>".$_SESSION['livraison']['code_p'];
													}
													
													?>
												</div>
											</div>
											
											<?php
											}
										
										}
										
									
									?>
									
									
									<div class="row" id="cgvpaiement">
										<div class="col-sm-12">
											<?php 
											if($poidstotal <= $poidsmaxi) 
											{
											?>
											<form method="post" action="feraud-mon-panier-methode-paiement-cb-ou-compte-pro" name="cgv" id="cgv">
												<p>
												   <input type="checkbox" name="acceptcgv" id="acceptcgv" value="1"  required aria-required="true" />
												   <label for="cgvok">J'ai lu les <a href="feraud-peinture-laques-conditions-generale-de-vente" class="souligne noir" target="_blank">conditions générales de vente</a> et j'y adhère sans réserve.</label>
												   <input class="btn" type="submit" name="confirmer-panier" id="confirmer-panier" value="VALIDER" />
												</p>
											</form>
											<?php 
											}else{
											?>
												<p class="rougemini">Attention, votre commande dépasse <?php echo $poidsmaxi; ?> kilos. Merci de nous contacter pour les conditions de livraison au <?php echo $lect_adr_->tel; ?>.<br /><br /><br /></p>
											<?php
											}
											?>
										</div>
									</div>
									<?php
									} 
									?>
									<div class="clear">&nbsp;</div>
							   </div>
						<?php
							}else{
							// mot de passe incorrect
							?>
								<p class="rougemini">Attention, votre mot de passe est incorrect, vous ne pouvez passer commande avec votre compte pro. Merci de nous contacter au <?php echo $lect_adr_->tel; ?>.<br /><br /><br /></p>
							<?php
							
							}
						}else{
							// Compte inexistant
								$reduc = 0;
								$comptexist = '0';
							?>
								<p class="rougemini">Attention, ce compte est incorrect, vous ne pouvez passer commande avec votre compte pro. Merci de nous contacter au <?php echo $lect_adr_->tel; ?>.<br /><br /><br /></p>
							<?php	
						
						}
					}
				}
				?>
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

<!-- InstanceBeginEditable name="footer" --><!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
