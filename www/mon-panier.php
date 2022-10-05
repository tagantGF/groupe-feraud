<?php
	ini_set('default_charset', 'UTF-8');
	$charset = "UTF-8";
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
	
	$_SESSION['panierfer']['lecadeau'] = '';
	$_SESSION['panierfer']['cadeauvalid'] = '0';
	$lareduht		= 0 ;
	$reduction		= 0;
	$reductionht	= 0;
	$clientbatifer	= '0';
	$totalhtavreduc	= 0;
	$lepourcentagesup = '0';
	$codevalide 	= '';
	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$_SESSION['panierfer']['fraisdePort'] = FraisdePort();
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");
	while($tva =  mysqli_fetch_object($res_lect_tva))
	{
		$tauxtva["$tva->id_tva"] = $tva->taux_tva;	
	}
	// Verifie si connecte 
	if(estAuthentifieClient())
	{
		
		$id_client	= $_SESSION['c_feraud']['id_client'];
		$lecture = "SELECT * FROM illi21_clients_cpt WHERE id_client = '$id_client' AND c_valide = '1';";
		$resultat_lecture = mysqli_query($lien,$lecture);
		$trouve = mysqli_num_rows($resultat_lecture);
	   
		if ($trouve == 0){
			
			$_SESSION['c_feraud']['auth'] = FALSE;
			$erreur = "Mauvais identifiant / mot de passe !";
			$reduc = 0;
			$clientbatifer = '0';
			$nbcol = 8;
			$redubat = 0;
		}else{
			
			$ligne = mysqli_fetch_object($resultat_lecture);
			$reduc = $ligne->cli_reduc;
			$clientcode = $ligne->clientcode;
			if($reduc > 0)
			{
				$nbcol = 6;
				$clientbatifer = '1';
				$redubat = $ligne->cli_reduc;
				
				// Verifie si un des produits est de la poudre et si le clien a une reduction sur cette marque
				$reducpoudre = '0';
				$reduc_pdr_pourcent = '0';
				$nb_article = count($_SESSION['panierfer']['identifiant']);
                if ($nb_article > 0)
				{
					for ($i=0; $i<$nb_article; $i++)
                    { 
						if($_SESSION['panierfer']['nomproduit'][$i] == "")
						{
							// C'est une poudre ou une peinture
							if($_SESSION['panierfer']['id_nuancier'][$i] == '99')
							{
								// Recherche la marque
								$recpoud = "SELECT * FROM `illi21_poudre` WHERE `idp` = '".$_SESSION['panierfer']['la_couleur'][$i]."' limit 1";
								$res_recpoud = mysqli_query($lien,$recpoud) or die ("Erreur lecture poudre");
								if(mysqli_num_rows($res_recpoud))
								{
									$lapoudre = mysqli_fetch_object($res_recpoud);
									$lamarque = $lapoudre->p_nuancier;
									if($clientcode <> "")
									{
										// vérifie si ce client a une reduc pour cette marque
										
										$rec_red_marque = "SELECT * FROM `illi21_marques_reduc` WHERE `code_client` = '$clientcode' AND `nom_marque` = '$lamarque'";
										$res_rec_red_marque	= mysqli_query($lien, $rec_red_marque);
										$row_cnt_reduc	= mysqli_num_rows($res_rec_red_marque);
										if($row_cnt_reduc == 1) 
										{
											$reducpoudre = '1';
											$nbcol = 5;
										}
									}
								}
							
							}
						}
					}
					
				}
			}else{
				$nbcol = 8;
				$clientbatifer = '0';
				$redubat = 0;
			}
			

		}
	}else{
		$clientbatifer = '0';
		$reduc = 0;
		$nbcol = 8;
		$redubat = 0;
	}
	
	// Recherche montant Franco
	$requettefranco = "SELECT `tariffranco` FROM illi21_tarif_franco	 WHERE `idf` = '800' "; 
	$res_franco_ = mysqli_query($lien,$requettefranco);
	$lect_franco_ = mysqli_fetch_object($res_franco_);  
	$franco = $lect_franco_->tariffranco;
	$_SESSION['panierfer']['franco'] = $franco;
	
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
    
	<div class="container pages_internes">
		<div class="row">
			<div class="col-lg-12">
		    	<h1>R&eacute;capitulatif de votre panier</h1>
            </div>
            <div class="col-lg-12 bordure">
            
            	<?php 
				
				// print_r($_SESSION);
				
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
                	?>
                	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="panier" id="panier">
                
                
                	<div class="row lepanier titrepanier">
                            <div class="col-lg-<?php echo $nbcol; ?> lepanier_item">Produit</div>
                            <div class="col-lg-1 lepanier_item droit">Qt&eacute;</div>
                            
                            <?php if($clientbatifer == '0') { ?>

                            <div class="col-lg-1 lepanier_item droit">P.U. HT</div>

                            <?php }else{?>
							<div class="col-lg-1 lepanier_item centre">P.U. HT<br />Public</div>
                            <div class="col-lg-1 lepanier_item centre">Remise<br />(en %)</div>
                            <?php 
							if($reducpoudre == '1')
							{
							?>
                             <div class="col-lg-1 lepanier_item centre">Remise<br />additionnelle</div>
                            <?php
							}
							?>
                            <div class="col-lg-1 lepanier_item centre">P.U. HT<br />Remis&eacute;</div>

                            <?php }?>
                            <div class="col-lg-1 lepanier_item droit">Total HT</div>
                            <div class="col-lg-1 lepanier_item droit">Supprimer</div>
                    </div>
                    <?php
                        $compteur=1;
                        $i=0;
                        for ($i=0; $i<$nb_article; $i++)
                        { 
							
                            ?>
                            <div class="row lesligne">
                            	<div class="col-lg-<?php echo $nbcol; ?>">
									<?php 
										if($_SESSION['panierfer']['nomproduit'][$i] <> "")
										{
											// Produit simple ou declinaison
											if($_SESSION['panierfer']['typeprod'][$i] == "s")
											{
												// Produit simple
												
												// La photo
												$requet_ = "SELECT id_p , p_photo, p_ref, p_nom FROM illi21_produits where id_p = '".$_SESSION['panierfer']['idproduit'][$i]."'";
												// echo $requet_;
												$resultat_    = mysqli_query($lien, $requet_);
												$lect_res_    = mysqli_fetch_object($resultat_); 
												$limage    = $lect_res_->p_photo;
												$id_produit		= $lect_res_->id_p;
												$lblproduit		= $lect_res_->p_nom;
												$str = htmlentities(($lblproduit), ENT_NOQUOTES, $charset);
												$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
												$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
												$titre = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caract?res
												$libel_prod = strtolower(preg_replace("/[^\w]/", '-', $titre ));
												if (is_file("images/produits/".$limage)) 
												{
												?><img src="images/produits/<?php echo $limage; ?>"  height="28px" style="margin-right:5px;" />
												<a href="feraud-produit-detail-fiche-<?php echo $id_produit; ?>-<?php echo $libel_prod; ?>">
                                                <?php
												}
												
												echo $_SESSION['panierfer']['nomproduit'][$i]." (".$lect_res_->p_ref.")";
												?>
                                                </a>
                                                <?php
											}
											if($_SESSION['panierfer']['typeprod'][$i] == "m")
											{
												// Produit multiple
												
												// La declinaison
												$requetdec_ = "SELECT id_prod , p_nom, p_ref FROM illi21_produits_var where id_decli = '".$_SESSION['panierfer']['idproduit'][$i]."'";
												// echo $requet_;
												$resultatdec_    = mysqli_query($lien, $requetdec_);
												$lect_resdec_    = mysqli_fetch_object($resultatdec_); 
												
												// La photo
												$requet_ = "SELECT id_p , p_photo, p_nom FROM illi21_produits where id_p = '$lect_resdec_->id_prod'";
												// echo $requet_;
												$resultat_    = mysqli_query($lien, $requet_);
												$lect_res_    = mysqli_fetch_object($resultat_); 
												$id_produit		= $lect_resdec_->id_prod;
												$lblproduit		= $lect_res_->p_nom;
												$str = htmlentities(($lblproduit), ENT_NOQUOTES, $charset);
												$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
												$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
												$titre = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caract?res
												$libel_prod = strtolower(preg_replace("/[^\w]/", '-', $titre ));

												
												$limage    = $lect_res_->p_photo;
												if (is_file("images/produits/".$limage)) 
												{
												?><img src="images/produits/<?php echo $limage; ?>"  height="28px" style="margin-right:5px;" />
												<a href="feraud-produit-detail-fiche-<?php echo $id_produit; ?>-<?php echo $libel_prod; ?>">
												<?php
												}
											
												echo $_SESSION['panierfer']['nomproduit'][$i]." (".$lect_resdec_->p_ref.")";  
												?>
                                                </a>
                                                <?php
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
												<span class='pan_couleur' style="border-bottom:1px #FFFFFF solid;"><?php echo $_SESSION['panierfer']['la_couleur'][$i]; ?></span>
											<?php 
											}else{
											?>
												<span class='pan_couleur' style="background:<?php echo $_SESSION['panierfer']['la_couleur'][$i]; ?>; border-bottom:1px #FFFFFF solid;"></span>
											<?php 
											
											}
											
											
											echo "<span class='pan_support'>".($lesupport)."</span><span class='pan_sepa'>&nbsp;|&nbsp;</span><span class='pan_nuancier'>".$_SESSION['panierfer']['rf_couleur'][$i]."</span>&nbsp;<span class='pan_brillance'>".$_SESSION['panierfer']['brillance'][$i]."</span><span class='pan_sepa'>&nbsp;|&nbsp;</span><span class='pan_contenant'>".$lecontenant."</span>";
										}
										
									?>
                                </div>
                                <?php 
								if(isset($_POST['actualiser']))
								{
									if($_SESSION['panierfer']['nb_pot'][$i] != $_POST["quantite_$i"])
									{	
									// Si nouvelle quantité on recalcule
										$total = $_SESSION['panierfer']['prixunitaire'][$i] * $_POST["quantite_$i"];
										$total = number_format($total, 2, '.', '');
									
										modifierQuantite($_SESSION['panierfer']['identifiant'][$i], $_SESSION['panierfer']['prixunitaire'][$i], $_POST["quantite_$i"],  $total);
										
										$_SESSION['panierfer']['montantTotal'] = MontantGlobal();
										$_SESSION['panierfer']['montantTotalHt'] = MontantGlobalht();
										
										$_SESSION['panierfer']['fraisdePort'] = FraisdePort();
									}
								
								}
                                
                                ?>
                            	<div class="col-lg-1 droit"><div class="mobile">Quantit&eacute; : </div>
								
	
									<select name="quantite_<?php echo $i;?>" id="quantite_<?php echo $i;?>">
										<?php 
                                        $qtmin = 99;
                                        
                                        for ($cpt = 1; $cpt <= $qtmin; $cpt++) 
                                        {
                                        ?>
                                        <option value="<?php echo $cpt;?>" <?php if($_SESSION['panierfer']['nb_pot'][$i] == $cpt) echo "selected=\"selected\""; ?>  ><?php echo $cpt;?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>

									
									
	
                                
                                </div>
                                <?php if($clientbatifer == '0') { ?>
                                
                                <div class="col-lg-1 droit"><div class="mobile">P.U. H.T. : </div><?php echo $_SESSION['panierfer']['prixunitaire'][$i]." &euro;";	 ?></div>
                                <div class="col-lg-1 droit"><div class="mobile">Total HT : </div><?php echo $_SESSION['panierfer']['mttc'][$i]." &euro;"; ?></div>
                                
                                <?php }else{?>
                                <div class="col-lg-1 droit"><div class="mobile">P.U. H.T. Public : </div><?php echo $_SESSION['panierfer']['prixunitaire'][$i]." &euro;";	 ?></div>
                                <div class="col-lg-1 droit"><div class="mobile">Remise (en %) : </div><?php echo $reduc; ?>%</div>
                                <?php
								$reduc_pdr_pourcent = 0;
								$lepourcentagesup = 0;
                                if($reducpoudre == '1')
                                {
									// Vérifie si c'est cette ligne qui a une réduction poudre
									// C'est une poudre ou une peinture
									if($_SESSION['panierfer']['id_nuancier'][$i] == '99')
									{
										// Recherche la marque
										$recpoud = "SELECT * FROM `illi21_poudre` WHERE `idp` = '".$_SESSION['panierfer']['la_couleur'][$i]."' limit 1";
										$res_recpoud = mysqli_query($lien,$recpoud) or die ("Erreur lecture poudre");
										if(mysqli_num_rows($res_recpoud))
										{
											$lapoudre = mysqli_fetch_object($res_recpoud);
											$lamarque = $lapoudre->p_nuancier;
											if($clientcode <> "")
											{
												// vérifie si ce client a une reduc pour cette marque
												
												$rec_red_marque = "SELECT * FROM `illi21_marques_reduc` WHERE `code_client` = '$clientcode' AND `nom_marque` = '$lamarque'";
												// echo $rec_red_marque;
												$res_rec_red_marque	= mysqli_query($lien, $rec_red_marque);
												$row_cnt_reduc	= mysqli_num_rows($res_rec_red_marque);
												if($row_cnt_reduc == 1) 
												{
													$lareducsup = mysqli_fetch_object($res_rec_red_marque);
													$lepourcentagesup = $lareducsup->reduc;
													$reduc_pdr_pourcent = $lepourcentagesup."%";
													?>
                                                    <div class="col-lg-1 droit"><div class="mobile">Remise additionnelle : </div><?php echo $reduc_pdr_pourcent; ?></div>
                                                    <?php
												}else{
													echo "<div class=\"col-lg-1 droit\"></div>";
													$reduc_pdr_pourcent = 0;
													$lepourcentagesup = 0;
												}
											}else{
												$reduc_pdr_pourcent = 0;
												$lepourcentagesup = 0;
												echo "<div class=\"col-lg-1 droit\"></div>";
											}
										}else{
											$reduc_pdr_pourcent = 0;
											$lepourcentagesup = 0;
											echo "<div class=\"col-lg-1 droit\"></div>";
										}
									
									}else{
										$reduc_pdr_pourcent = 0;
										$lepourcentagesup = 0;
										echo "<div class=\"col-lg-1 droit\"></div>";
									}
									
                                ?>
                                 
                                <?php
                                }
								
                                ?>
                                <div class="col-lg-1 droit"><div class="mobile">P.U. H.T. Remis&eacute; : </div><?php echo number_format(prixclientpoudre($_SESSION['panierfer']['prixunitaire'][$i],$redubat,$lepourcentagesup), 2, '.', ' ' )." &euro;";	 ?></div>
                                <div class="col-lg-1 droit"><div class="mobile">Total HT : </div><?php echo number_format(prixclientpoudre($_SESSION['panierfer']['mttc'][$i],$redubat,$lepourcentagesup), 2, '.', ' ' )." &euro;"; $totalhtavreduc = $totalhtavreduc + prixclientpoudre($_SESSION['panierfer']['mttc'][$i],$redubat,$lepourcentagesup); ?></div>
                                
                                <?php }?>
                                
                                
                                <div class="col-lg-1  poubelle centre"><a href="feraud-panier-supprimer-article-<?php echo $_SESSION['panierfer']['identifiant'][$i]; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                            </div>
                            
                    		<?php 
							 $compteur++;
						}
				 	}
					$_SESSION['panierfer']['montantTotal'] = MontantGlobal();
					$_SESSION['panierfer']['montantTotalHt'] = MontantGlobalht();
					

					
					
					?>
					
                    <?php if($_SESSION['panierfer']['montantTotal'] > 0) 
					{
					?>
                    <div class="row lepanier">
                            <div class="col-7">&nbsp;Sous-Total HT de la commande</div>
                            <div class="col-5 droit">
                            <?php 
							$nouvtotal2 = $_SESSION['panierfer']['montantTotal'];
							if($clientbatifer == '0') 
							{
								$nouvtotalht = number_format($nouvtotal2, 2, '.', '');
							}else{
								// $nouvtotalht = number_format(prixclient($nouvtotal2,$redubat), 2, '.', '');
								$nouvtotalht = number_format($totalhtavreduc, 2, '.', '');
							} 
								$nouvtotalhtfdp = $nouvtotalht;
								echo $nouvtotalht." &euro;"; 
                            ?>
                            </div>
                    </div>
                    <?php 
					
					
					// Calcul
					$nouvtotal2 = $nouvtotalhtfdp;
					// $nouvtotal2 = $_SESSION['panierfer']['montantTotal'];
					$nouvtotalht = number_format($nouvtotal2, 2, '.', '');
					
					// SI PROMO
					
					//************************** CODE PROMO *****************************************/
					if(isset($_POST['cpromo']) or isset($_SESSION['panierfer']['code']))
						{
							if(!isset($_SESSION['panierfer']['code']))
							{
								// Code n'est pas encore verifie
								$code = securiseFormulaire($_POST['cpromo']);
								$lect_code = "SELECT * FROM illi21_promo WHERE code_promo = '".$code."' AND actif = '1'  ;";
								// echo $lect_code; 
								$res_lect_code = mysqli_query($lien,$lect_code) or die ("Erreur lecture codes promo");
								if(mysqli_num_rows($res_lect_code))
								{
									// Le code est bon, on le garde
									$_SESSION['panierfer']['code'] 		= $code;
									$_SESSION['panierfer']['codevalid'] 	= 1;
									$codevalide = '1';
									$codelu = mysqli_fetch_object($res_lect_code);
									
									if($codelu->promo_pourc > 0)
									{
										// Pourcentage
										/*
										if($clientbatifer == '0') 
										{*/
											$_SESSION['panierfer']['lapromo']		= $codelu->promo_pourc."%";
											$nouvtotal = $nouvtotalhtfdp * ($codelu->promo_pourc / 100);
											$nouvtotal = number_format($nouvtotalhtfdp, 2, '.', '') - number_format($nouvtotal, 2, '.', '');
											
											$reduction = -(number_format($nouvtotalhtfdp * ($codelu->promo_pourc / 100), 2, '.', ''));
											$reductionht = number_format($reduction, 2, '.', '');
										/*
										}else{
											
											$nouvtotalhtprov = number_format(prixclient($nouvtotalhtfdp,$redubat), 2, '.', '');
											$_SESSION['panierfer']['lapromo']		= $codelu->promo_pourc."%";
											$nouvtotal = $nouvtotalhtprov * ($codelu->promo_pourc / 100);
											$nouvtotal = number_format($nouvtotalhtprov, 2, '.', '') - number_format($nouvtotal, 2, '.', '');
											
											$reduction = -(number_format($nouvtotalhtprov* ($codelu->promo_pourc / 100), 2, '.', ''));
											$reductionht = number_format($reduction, 2, '.', '');
										 	
										}*/
										
										
									}
									if($codelu->promo_mttc > 0)
									{	// Valeur
										$_SESSION['panierfer']['lapromo']		= $codelu->promo_mttc."&euro;";
										$nouvtotal = number_format($nouvtotalhtfdp, 2, '.', '') - number_format($codelu->promo_mttc, 2, '.', '');
										$reduction = -(number_format($codelu->promo_mttc, 2, '.', ''));
										$reductionht = number_format($reduction, 2, '.', '');
									}
									if($codelu->cadeau == '1')
										{
											$_SESSION['panierfer']['lecadeau'] = $_SESSION['panierfer']['code'];
											$_SESSION['panierfer']['cadeauvalid'] = '1';
										}
								}else{
									$codevalide = '0';
									$_SESSION['panierfer']['codevalid'] = 0;
									$_SESSION['panierfer']['cadeauvalid'] = '0';
								}
							}else{
								// Le code valide est peut-etre deje en memoire
								if($_SESSION['panierfer']['codevalid'] == 1)
								{
									$code = $_SESSION['panierfer']['code'];
									
									
									$lect_code = "SELECT * FROM illi21_promo WHERE code_promo = '".$code."' AND actif = '1'    ;";
									// echo "CODE ".$lect_code;
									$res_lect_code = mysqli_query($lien,$lect_code) or die ("Erreur lecture codes promo");
									if(mysqli_num_rows($res_lect_code))
									{
										
										$codelu = mysqli_fetch_object($res_lect_code);
										
										if($codelu->promo_pourc > 0)
										{
											/*
											if($clientbatifer == '0') 
											{*/
												// Pourcentage
												$_SESSION['panierfer']['lapromo']		= $codelu->promo_pourc."%";
												$nouvtotal = $nouvtotalhtfdp * ($codelu->promo_pourc / 100);
												$nouvtotal = number_format($nouvtotalhtfdp, 2, '.', '') - number_format($nouvtotal, 2, '.', '');
												
												
												
												$reduction = -(number_format($nouvtotalhtfdp * ($codelu->promo_pourc / 100), 2, '.', ''));
												$reductionht = number_format($reduction , 2, '.', '');
											/*
											}else{
												$nouvtotalhtprov = number_format(prixclient($nouvtotalhtfdp,$redubat), 2, '.', '');
												
												// Pourcentage
												$_SESSION['panierfer']['lapromo']		= $codelu->promo_pourc."%";
												$nouvtotal = $nouvtotalhtprov * ($codelu->promo_pourc / 100);
												$nouvtotal = number_format($nouvtotalhtprov, 2, '.', '') - number_format($nouvtotal, 2, '.', '');
												
												
												
												$reduction = -(number_format($nouvtotalhtprov * ($codelu->promo_pourc / 100), 2, '.', ''));
												$reductionht = number_format($reduction , 2, '.', '');
												
											} */
										
											
											// echo "montantTotal : ".$nouvtotalhtfdp."<br>";
											// echo "reduction : ".$reduction."<br>";
											// echo "nouvtotal : ".$nouvtotal."<br>";
										}
										if($codelu->promo_mttc > 0)
										{
											// Valeur
											$_SESSION['panierfer']['lapromo']		= $codelu->promo_mttc."&euro;";
											$nouvtotal = number_format($nouvtotalhtfdp, 2, '.', '') - number_format($codelu->promo_mttc, 2, '.', '');
											$reduction = -(number_format($codelu->promo_mttc, 2, '.', ''));
											$reductionht = number_format($reduction, 2, '.', '');
										}
										if($codelu->cadeau == '1')
										{
											$_SESSION['panierfer']['lecadeau'] = $_SESSION['panierfer']['code'];
											$_SESSION['panierfer']['cadeauvalid'] = '1';
										}
										
									
									}
								}
							
							}
							if($_SESSION['panierfer']['codevalid'] == 1)
							{
								if($_SESSION['panierfer']['cadeauvalid'] == '1')
								{
									?>
                                    <div class="row mt-2 lepanierclair">
                                        <div class="col-7"> Code cadeau : <?php echo $_SESSION['panierfer']['lecadeau']; ?>  (<a href="feraud-panier-supprimer-code">Retirer le code</a>)</div>

                                    </div>    
                                    <?php
								}else{
									$_SESSION['panierfer']['promottc'] = $reduction;
									?>
                                    <div class="row mt-2 lepanierclair">
                                        <div class="col-7">&nbsp;Code promo : <?php echo $_SESSION['panierfer']['code']." : ".$_SESSION['panierfer']['lapromo']." "; ?> (<a href="feraud-panier-supprimer-code">Retirer le code</a>)</div>
                                        <div class="col-5 droit"><?php  echo '- '.$reduction*(-1)." &euro;"; ?></div>
                                    </div>    
                                    <?php
								}
							}

						}
					
					
					// Si remise
					/*
					if($reduc > 0 or $reduction < 0)
					{
						// echo $nouvtotalht;
						//calcul du montant de la reduction HT
						$lareduc =  number_format(($nouvtotalht * $reduc / 100), 3, '.', ' ');
						$lareduht =  number_format(($nouvtotalht * $reduc / 100), 2, '.', ' ');
						$_SESSION['panierfer']['c_reduc_ht'] = $lareduht;
					}
					*/
					
					?>
                    <div class="row lepanierclair">
                        <div class="col-7">&nbsp;Participation aux frais de port de matières dangereuses et d'emballage</div>
                        <div class="col-5 droit">
						<?php
							$fraisdeport = FraisdePortMontant($nouvtotalhtfdp+$reduction) ;
							if($_SESSION['panierfer']['fraisdePort'] > 0)
							{
								echo number_format($_SESSION['panierfer']['fraisdePort'], 2, '.', '')." &euro;"; 
							}else{
								echo " OFFERT";
							}
						?></div>
                    </div>
                    <div class="row lepanier">
                            <div class="col-7">&nbsp;TOTAL HT de la commande</div>
                            <div class="col-5 droit">
                            <?php 
								
									$nouvtotal = ($nouvtotalht - $lareduht + $reduction) + $_SESSION['panierfer']['fraisdePort'] ;
									$_SESSION['panierfer']['mttccmd'] = $nouvtotal;
										
								
                                    $totalht 	= number_format($nouvtotal , 2, '.', '');
									$montantva	= $totalht * (($tauxtva[1]) / 100 );
									$totalttc	= number_format(($totalht + $montantva) , 2, '.', '');
									echo $totalht." &euro;"; 
									$montantva = number_format($montantva, 2, '.', '');
                            ?>
                            </div>
                    </div>
                    
                    <div class="row lepanierclair">
                        <div class="col-7">&nbsp;T.V.A. <?php echo $tauxtva[1]; ?>%</div>
                        <div class="col-5 droit"><?php echo $montantva." &euro;"; ?></div>
                    </div>

                    
                    
                    <div class="row lepanier">
                            <div class="col-7">&nbsp;TOTAL TTC de la commande</div>
                            <div class="col-5 droit">
                            <?php 
							if ($totalttc < 0) $totalttc = 0;
                             echo number_format($totalttc, 2, '.', ' ')." &euro;"; 
                            $_SESSION['panierfer']['montantTTC']  =   $totalttc;     
							
							
							// Calcule de la reduction totale : 
							$mttotreduc = 0;
							$mtglobalht = MontantGlobal();
							$mtreduit	= number_format($nouvtotal-$_SESSION['panierfer']['fraisdePort'] , 2, '.', '');
							$mttotreduc	= number_format(($mtglobalht - $mtreduit) , 2, '.', '');
							// echo "<br>HT Prix normal : ".$mtglobalht;
							// echo "<br>HT Prix reduit - port : ".$mtreduit;
							// echo "<br>".$mttotreduc;
							$_SESSION['panierfer']['c_reduc_ht'] = $mttotreduc;
							
                            ?>
                            </div>
                    </div>
                    <?php }?>
                    
                    <?php 
					if ($nb_article > 0)
					{
						if(!isset($_SESSION['panierfer']['code']))
						{
						?>
						
						<div class="row codepromo mt-2">
							<div class="col-lg-6 droit">Votre code promo <input name="cpromo" type="text" id="codpro" maxlength="12" <?php if($codevalide == '0' and ($_POST['cpromo'] <> '')) {echo "placeholder='CODE INCORRECT'"; }?> value=""  /></div><div class="col-lg-6"><a href="#" OnClick="panier.submit()"><i>Envoyer</i></a></div>
						</div>
						
						<?php 
						}
					}?>
                    
                    <div class="clear">&nbsp;</div>
                    
                    
                    <?php if($nouvtotalhtfdp > 0) 
                    {
                    ?>
                    <div class="row">
                    		 <div class="col-md-4 text-center">
	            	            
    	            	          
                                <button type="submit" class="btn btn-default viderpanier" name="actualiser" id="actualiser" >ACTUALISER<br />LE PANIER</button>
	        	                
    	                    </div>
                            
    	                	<div class="col-md-4 text-center">
                            	<a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">
    	    	                <div id="valider-panier" class="btn btn-default continuepanier">CONTINUER<br />MES ACHATS</div>
        	    	            </a>
                    	    </div>
            	           
                            <div class="col-md-4 text-center">
                            	<?php if ($nouvtotal > 0) { ?>
	                        	<a href="feraud-mon-panier-valider-avant-paiement">
	    	                    <div id="valider-panier" class="btn btn-default validpanier">VALIDER<br />et PAYER</div>
    	    	                </a>
                                <?php  } ?>
        	                </div>
                    </div>
                    <?php 
                    }
                    
                    ?>
                    
                    </form>
					<?php
				}
				?>
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
