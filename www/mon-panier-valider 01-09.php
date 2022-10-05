<?php
	session_start();
	$passwd = 'illico48';
	require_once 'includes/fonctionsqli.php';
	require_once 'includes/panier.php';
	$lien = connexionBDD();
	
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
	$_SESSION['panierfer']['acceptcgv'] = '0';
	$_SESSION['livraison']['code_p'] = '';
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
            	<div class="col-lg-12">
		                <h1>Confirmation de commande</h1>
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
						// Lecture compte client
						$lect_cptr = "SELECT * FROM illi21_clients_cpt WHERE id_client = '".$id_client."' limit 1 ";
						// echo $lect_cptr;
						$res_lect_cptr_ = mysqli_query($lien, $lect_cptr);
						$row_cnt = mysqli_num_rows($res_lect_cptr_);
						if($row_cnt > 0)
						{
							$depas = 1;
							$lemessage = 1;
							$lect_compte_ = mysqli_fetch_object($res_lect_cptr_);  
							
							$typedecompte = $lect_compte_->type_cpt;
							
							if($typedecompte == '1')
							{
								// Client compte Batifer
								$reduc = $lect_compte_->cli_reduc;
								$_SESSION['panierfer']['c_pourc'] = $reduc;
								$_SESSION['panierfer']['c_reduc'] = '0';
								
								$_SESSION['livraison']['civilite'] 	 	= "";						
								$_SESSION['livraison']['adr1'] 		 	= "";
								$_SESSION['livraison']['cp'] 		 	= "";
								$_SESSION['livraison']['ville'] 	 	= "";
								$_SESSION['livraison']['societe'] 	 	= $lect_compte_->clientcode;
								$_SESSION['livraison']['portable'] 	 	= "";
								$_SESSION['livraison']['emel'] 		 	= $lect_compte_->c_mail;
								$_SESSION['livraison']['commentaire'] 	= "";
								
								$_SESSION['facturation']['civilite']	= "";
								$_SESSION['facturation']['prenom']		= "";
								$_SESSION['facturation']['nom'] 		= "";
								$_SESSION['facturation']['adr1'] 		= "";
								$_SESSION['facturation']['cp'] 			= "";
								$_SESSION['facturation']['ville']		= "";
								$_SESSION['facturation']['societe'] 	= $lect_compte_->clientcode;
								$_SESSION['facturation']['compte'] 		= $lect_compte_->clientcode;
								$_SESSION['facturation']['portable'] 	= "";
							
							}else{
								// Client normal
								$reduc = 0;
								$_SESSION['panierfer']['c_reduc'] = '0';
								$_SESSION['panierfer']['c_pourc'] = '0';
								
								$_SESSION['livraison']['civilite'] 	 = $lect_compte_->l_civilite;
								$_SESSION['livraison']['prenom'] 	 = $lect_compte_->l_prenom;
								$_SESSION['livraison']['nom'] 		 = $lect_compte_->l_nom;
								$_SESSION['livraison']['adr1'] 		 = $lect_compte_->l_adr1;
								$_SESSION['livraison']['cp'] 		 = $lect_compte_->l_cp;
								$_SESSION['livraison']['ville'] 	 = $lect_compte_->l_ville;
								$_SESSION['livraison']['societe'] 	 = $lect_compte_->l_soc;
								$_SESSION['livraison']['portable'] 	 = $lect_compte_->l_tel;
								$_SESSION['livraison']['emel'] 		 = $lect_compte_->l_mail;
								$_SESSION['livraison']['commentaire'] = "";
								
								
								$_SESSION['facturation']['civilite']	= $lect_compte_->c_civilite;
								$_SESSION['facturation']['prenom']		= $lect_compte_->c_prenom;
								$_SESSION['facturation']['nom'] 		= $lect_compte_->c_nom;
								$_SESSION['facturation']['adr1'] 		= $lect_compte_->c_adr1;
								$_SESSION['facturation']['cp'] 			= $lect_compte_->c_cp;
								$_SESSION['facturation']['ville']		= $lect_compte_->c_ville;
								$_SESSION['facturation']['societe'] 	= $lect_compte_->c_soc;
								$_SESSION['facturation']['portable'] 	= $lect_compte_->c_tel;
							
							}
						}else{
							$depas = 0;
							$lemessage = 0;
						}
					}
					if($depas == 1)
					{
					/* Le contenu du Panier*/
						?>
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
												// Produit simple ou d�clinaison
												if($_SESSION['panierfer']['typeprod'][$i] == "s")
												{
													// Produit simple
													
													// La photo
													$requet_ = "SELECT id_p , p_photo FROM illi21_produits where id_p = '".$_SESSION['panierfer']['idproduit'][$i]."'";
													// echo $requet_;
													$resultat_    = mysqli_query($lien, $requet_);
													$lect_res_    = mysqli_fetch_object($resultat_); 
													$limage    = $lect_res_->p_photo;
													if (is_file("images/produits/".$limage)) 
													{
													?><img src="images/produits/<?php echo $limage; ?>"  height="28px" style="margin-right:5px;" /><?php
													}
												
													echo $_SESSION['panierfer']['nomproduit'][$i]; 
												}
												if($_SESSION['panierfer']['typeprod'][$i] == "m")
												{
													// Produit multiple
													
													// La declinaison
													$requetdec_ = "SELECT id_prod , p_nom FROM illi21_produits_var where id_decli = '".$_SESSION['panierfer']['idproduit'][$i]."'";
													// echo $requet_;
													$resultatdec_    = mysqli_query($lien, $requetdec_);
													$lect_resdec_    = mysqli_fetch_object($resultatdec_); 
													
													// La photo
													$requet_ = "SELECT id_p , p_photo FROM illi21_produits where id_p = '$lect_resdec_->id_prod'";
													// echo $requet_;
													$resultat_    = mysqli_query($lien, $requet_);
													$lect_res_    = mysqli_fetch_object($resultat_); 
	
													
													$limage    = $lect_res_->p_photo;
													if (is_file("images/produits/".$limage)) 
													{
													?><img src="images/produits/<?php echo $limage; ?>"  height="28px" style="margin-right:5px;" /><?php
													}
												
													echo $_SESSION['panierfer']['nomproduit'][$i]; 
												}
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
							$_SESSION['panierfer']['montantTotal'] = MontantGlobal();
							$_SESSION['panierfer']['montantTotalHt'] = MontantGlobalht();
							$_SESSION['panierfer']['fraisdePort'] = FraisdePort();
							$_SESSION['panierfer']['poidstotal'] = PoidsGlobal();
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
                                                $nouvtotalht = number_format($nouvtotal2 / ( (100 + $tauxtva[1]) / 100 ), 2, '.', '');
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
									<div class="col-7">&nbsp;Montant HT de votre r&eacute;duction "Client Batifer"</div>
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
                                
                                <div class="row lepanier mb-4">
                                    <div class="col-7">&nbsp;TOTAL TTC de la commande</div>
                                    <div class="col-5 droit">
                                    <?php 
                                        
                                            $nouvtotal = $_SESSION['panierfer']['montantTotal'] + $_SESSION['panierfer']['fraisdePort'];
                                            $_SESSION['panierfer']['mttccmd'] = $nouvtotal;
                                            echo number_format($nouvtotal, 2, '.', ' ')." &euro;"; 
                                            
                                        
                                            
                                    ?>
                                    </div>
                            	</div>
                                
                             	<?php 
								if($totalttc > 0) 
								{
									if($typedecompte == '1')						
									{
									// COMPTE
									$_SESSION['panierfer']['typepai'] = "cpt";
									?>
									<div class="row">
                                    
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
                                        <div class="col-sm-8">
                                            <?php if($poidstotal <= $poidsmaxi) 
                                                
                                            {
                                            ?>
                                                <form method="post" action="feraud-mon-panier-methode-paiement-cb-ou-compte-pro" name="cgv" id="cgv">
                                                    <p>
                                                       <textarea name="commentaire" class="form-control creationcompte textea" id="commentaire" tabindex="10" value="<?php if($_SESSION['panierfer']['commentaire'] <> "") echo $_SESSION['panierfer']['commentaire'];?>" placeholder="Commentaires"/></textarea>
                                                       <input type="checkbox" name="acceptcgv" id="acceptcgv" value="1"  required aria-required="true" />
                                                       <label for="cgvok">J'ai lu les <a href="feraud-peinture-laques-conditions-generale-de-vente" class="souligne noir" target="_blank">conditions g&eacute;n&eacute;rales de vente</a> et j'y adh&egrave;re sans r&eacute;serve.</label>
                                                       <br />
                                                       <input type="submit" name="confirmer-panier" id="confirmer-panier" value="Payer avec mon compte Batifer" class="btn btn-danger"/>
                                                    </p>
                                                </form>
                                            <?php 
                                            }else{
                                            ?>
                                                <p class="rouge">Attention, votre commande d&eacute;passe <?php echo $poidsmaxi; ?> kilos. Merci de nous contacter pour les conditions de livraison au <?php echo $lect_adr_->tel; ?>.<br /><br /><br /></p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
									
									<?php
									}
									if($typedecompte == '0')						
									{
									// CB
									$_SESSION['panierfer']['typepai'] = "cb";
									?>
                                    <div class="row">
                                        <div id="rappeladresse-fac" class="col-sm-4">
                                            <p><span class="titrelivgbordeau">Coordonn&eacute;es</span></p>
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
                                        <div class="col-sm-8">
                                        <?php if($poidstotal <= $poidsmaxi) 
											
										{
										?>
                                            <form method="post" action="feraud-mon-panier-methode-paiement-cb-ou-compte-pro" name="cgv" id="cgv">
                                                <p>
                                                   <textarea name="commentaire" class="form-control creationcompte textea" id="commentaire" tabindex="10" value="<?php if($_SESSION['panierfer']['commentaire'] <> "") echo $_SESSION['panierfer']['commentaire'];?>" placeholder="Commentaires"/></textarea>
                                                   <input type="checkbox" name="acceptcgv" id="acceptcgv" value="1"  required aria-required="true" />
                                                   <label for="cgvok">J'ai lu les <a href="feraud-peinture-laques-conditions-generale-de-vente" class="souligne noir" target="_blank">conditions g&eacute;n&eacute;rales de vente</a> et j'y adh&egrave;re sans r&eacute;serve.</label>
                                                   <br />
                                                   <input type="submit" name="confirmer-panier" id="confirmer-panier" value="Payer par CB" class="btn btn-danger"/>
                                                </p>
                                            </form>
                                        <?php 
										}else{
										?>
											<p class="rouge">Attention, votre commande d&eacute;passe <?php echo $poidsmaxi; ?> kilos. Merci de nous contacter pour les conditions de livraison au <?php echo $lect_adr_->tel; ?>.<br /><br /><br /></p>
										<?php
										}
										
										?>
                                        </div>
                                    </div>
									<?php
									}
								}
                   
							
					
					/* Fin le contenu du Panier*/
					}
				}
            	?>
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
