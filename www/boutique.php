<?php
	ini_set('default_charset', 'UTF-8');
	$charset = "UTF-8";
	session_start();
	require_once 'includes/fonctionsqli.php';
	require_once 'includes/panier.php';
	$lien = connexionBDD();
    $lien -> set_charset("utf8");
	// Verifie si client Feraud
	if(isset($_SESSION['c_feraud']['typecpt']) and isset($_SESSION['c_feraud']['clireduc']))
	{
		if($_SESSION['c_feraud']['typecpt'] == '1' and $_SESSION['c_feraud']['clireduc'] > 0)
			{
				$clibat = $_SESSION['c_feraud']['typecpt'];
				$redubat = $_SESSION['c_feraud']['clireduc'];
			}else{
				$clibat = '0';
				$redubat = 0;
			}
	
	}else{
		$clibat = '0';
		$redubat = 0;
	}
																	
	
	
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
	
	// Lecture des categories
	$lect_famille = "SELECT * FROM illi21_familles WHERE f_enligne = '1' order by f_ordre ASC;";
	$res_lect_famille = mysqli_query($lien,$lect_famille) or die ("Erreur lecture famille");
	$nbre_famille = mysqli_num_rows($res_lect_famille);
	
	$orderby = " order by p_ordre ASC";
	
	// Requete produits par defaut
	
	// Verifie si c'est une recherche
	
	if(isset($_POST["rechercher"]) and ($_POST["rechercheprod"] <> "") )
	{
		$lesmots = securiseFormulaire($_POST["rechercheprod"]);
		$l_produits = "select * from illi21_produits where p_enligne = '1' and p_nom like '%".$lesmots."%' ".$orderby."";
		$_SESSION['lesmots'] = $lesmots;
		$urltrinom = "feraud-boutique-recherche-nm";
		$urltriprx = "feraud-boutique-recherche-px";
	}else{
		$l_produits = "select * from illi21_produits where p_enligne = '1' ".$orderby."";
		$urltrinom = "feraud-boutique-consommable-outillage-nom";
		$urltriprx = "feraud-boutique-consommable-outillage-prix";
	}
	
	
	if(isset($_GET["_tr"])) 
	{
		if(isset($_SESSION['lesmots']))
		{
			$lesmots = $_SESSION['lesmots'];
		}else{
			$lesmots = '';
		}
		
		if($_GET["_tr"] == "nm") $orderby = " order by p_nom ASC";
		if($_GET["_tr"] == "px") $orderby = " order by p_prix_ht ASC";
		$l_produits = "select * from illi21_produits where p_enligne = '1' and p_nom like '%".$lesmots."%' ".$orderby."";
		$urltrinom = "feraud-boutique-recherche-nm";
		$urltriprx = "feraud-boutique-recherche-px";
	}
	// Verifie s'il y a des parametres dans l'url
	if(isset($_GET["_idf"])) 
		{
			$idfamille = securiseFormulaire($_GET["_idf"]);
			
			// Recherche le nom de la famille
			$l_famille = "SELECT * FROM illi21_familles WHERE id_famille = '$idfamille' limit 1;";
			$res_l_famille = mysqli_query($lien,$l_famille) or die ("Erreur lecture famille v1");
			$s_fmlle = mysqli_fetch_object($res_l_famille);
			
			$urltrinom = "feraud-boutique-famille-nm-".$idfamille."-".$s_fmlle->nomlien."";
			$urltriprx = "feraud-boutique-famille-px-".$idfamille."-".$s_fmlle->nomlien."";
			
			// Requete produits de la famille
			$l_produits = "select * from illi21_produits where p_famille = $idfamille and p_enligne = '1'  ".$orderby."";
			
		}
		else{
			$idfamille = "";
		}
	if(isset($_GET["_idsf"])) 
		{ 
			$idsfamille = securiseFormulaire($_GET["_idsf"]);
			
			// Recherche le nom de la famille
			$l_sfamille = "SELECT * FROM illi21_familles_sous WHERE id_sous_famille = '$idsfamille' limit 1;";
			$res_l_sfamille = mysqli_query($lien,$l_sfamille) or die ("Erreur lecture sous famille v1");
			$s_sfmlle = mysqli_fetch_object($res_l_sfamille);
			
			$urltrinom = "feraud-boutique-sous-famille-nm-".$idsfamille."-".$s_sfmlle->nomlien."";
			$urltriprx = "feraud-boutique-sous-famille-px-".$idsfamille."-".$s_sfmlle->nomlien."";
			
			// Requete produits de la sous famille
			$l_produits = "select * from illi21_produits where p_sfamille = $idsfamille and p_enligne = '1'  ".$orderby."";
			
		}else{
			$idsfamille = "";
		}
	if(isset($_GET["_pas"])) 
		{ 
			$_pas = securiseFormulaire($_GET["_pas"]);
			$urltrinom = "feraud-boutique-consommable-outillage-nom";
			$urltriprx = "feraud-boutique-consommable-outillage-prix";
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
<title>Feraud Color- Commandez vos accessoires de peinture en ligne</title>
<meta name="description" content="Feraud Color vous propose tous les accessoires nécessaires à la peinture, nuancier, brosse, pinceau, becher, adhésif, bâche, éponge abrasive, etc." />
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
<link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="styles/categories_styles.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
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
    
	<div class="container product_section_container">
		<div class="row">
			<div class="col product_section clearfix">

				

				<!-- Sidebar -->

				<div class="sidebar">
					<div class="sidebar_section">
						<div class="sidebar_title" id="deroule">
							<h5>Cat&eacute;gorie produits</h5>
						</div>
						<ul class="sidebar_categories">
                        	<li><a href="feraud-boutique-consommable-outillage">Toutes</a></li>
                        	<?php if ($nbre_famille > 0 )
								{ 
									while($famille = mysqli_fetch_object($res_lect_famille))
									{
								?>
                                	<!-- <li class="active"><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>Women</a></li> -->
									<li <?php if($famille->id_famille == $idfamille) echo "class='active'"; ?>><a href="feraud-boutique-famille-<?php echo $famille->id_famille."-".$famille->nomlien; ?>"><?php echo ($famille->f_libelle) ; ?></a></li>
                                    <?php 
										// Vérifie s'il y a une sous famille
										$lect_s_famille = "SELECT * FROM illi21_familles_sous WHERE sf_enligne = '1' and sf_famille = '$famille->id_famille' order by sf_ordre ASC;";
										$res_lect_s_famille = mysqli_query($lien,$lect_s_famille) or die ("Erreur lecture sous famille");
										$nbre_s_famille = mysqli_num_rows($res_lect_s_famille);
										if ($nbre_s_famille > 0 )
										{
											while($s_famille = mysqli_fetch_object($res_lect_s_famille))
											{
											?>
                                    			<li class="souscat <?php if($s_famille->id_sous_famille == $idsfamille) echo "active"; ?>"><a href="feraud-boutique-sous-famille-<?php echo $s_famille->id_sous_famille."-".$s_famille->nomlien; ?>"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><?php echo ($s_famille->sf_libelle) ; ?></a></li>
		                                    <?php 
											}
										}
									}
								}
							?>
						</ul>
					</div>
                    <div class="sidebar_section letri">
                    	<div class="sidebar_title">
                        	<h5>Tri</h5>
                        </div>

                        <ul class="sorting_type">
                            <li class="type_sorting_btn" ><a href="<?php echo $urltrinom; ?>">Nom du produit</a></li>
                            <li class="type_sorting_btn" ><a href="<?php echo $urltriprx; ?>">Prix</a></li>
                        </ul>

                    </div>




					
					

				</div>

				<!-- Main Content -->

				<div class="main_content">

					<!-- Products -->

					<div class="products_iso">
						<div class="row">
							<div class="col">

								<!-- Product Sorting -->

								<div class="product_sorting_container product_sorting_container_top">
									
                                    <div class="product_search">
                                        <form name="larecherche" method="post" class="example" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <input type="text" value"" placeholder="Rechercher un produit"  name="rechercheprod" id="rechercheprod" class="form-control" />
                                            <button type="submit" class="form-control" name="rechercher"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
									

								</div>

								<!-- Product Grid -->
								<?php  // echo $l_produits; echo $l_produits;  ?>
								<div class="product-grid">

									<?php 
									
									
									$res_lect_produits = mysqli_query($lien, $l_produits) or die ("Erreur lecture produits");
									$nbre_produits = mysqli_num_rows($res_lect_produits);
									
									if ($nbre_produits > 0)
									{
										while($leprod =  mysqli_fetch_object($res_lect_produits))
										{
											$id_produit		= $leprod->id_p;
											$lblproduit		= $leprod->p_nom;
											$prxproduit		= $leprod->p_prix_ht;
											$tauxtvaprod	= $leprod->p_taux_tva;
											$ptype			= $leprod->p_type;
											
											$str = htmlentities(($lblproduit), ENT_NOQUOTES, $charset);
											$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
											$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
											$titre = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caract?res
											$libel_prod = strtolower(preg_replace("/[^\w]/", '-', $titre ));
											
											?>
											<!-- Product 1 -->
		
                                            <div class="product-item">
                                            	<a href="feraud-produit-detail-fiche-<?php echo $id_produit; ?>-<?php echo $libel_prod; ?>">
                                                <div class="product">
                                                    <div class="product_image">
                                                    <?php if (is_file("images/produits/".$leprod->p_photo)) {?>
                                                                <img src="images/produits/<?php echo $leprod->p_photo; ?>" alt="<?php echo $lblproduit; ?>">
                                                    <?php }else{?>
                                                    
                                                    <?php }?>
                                                    </div>
                                                
                                                    
                                                    <div class="product_info">
                                                      <h6 class="product_name"><a href="feraud-produit-detail-fiche-<?php echo $id_produit; ?>-<?php echo $libel_prod; ?>"><?php echo $lblproduit; ?></a></h6>
                                                        <div class="product_price">
                                                        <?php 
														if($ptype == 'm')
														{
															$pretxt = "<span class='apartirde'>A partir de </span>";
															// Calcul du prix le plus bas
															$rechercheprix = "SELECT MIN(p_prix_ht) as prixleplusbas from illi21_produits_var where id_prod = '$id_produit';";
															$res_prix_decli = mysqli_query($lien,$rechercheprix);
															$leprix = mysqli_fetch_object($res_prix_decli); 
															$prxproduit = $leprix->prixleplusbas;
														}else{
															$pretxt = "";
														}
														if ($prxproduit > 0) { 
														
															if($clibat == '1' and $redubat > 0)
															{
																// Prix client Feraud
																// echo "PRIX Feraud";
																// echo "<span class='strikethrough'>".$pretxt.prixttc($prxproduit, $tauxtva[$tauxtvaprod])." &euro; TTC</span><br>" ;
																$prxproduit = prixclient($prxproduit,$redubat);
																echo $pretxt.number_format(prixttc($prxproduit, $tauxtva[$tauxtvaprod]), 2, '.', ' ' )." &euro; TTC" ;
																
															}else{
																echo $pretxt.number_format(prixttc($prxproduit, $tauxtva[$tauxtvaprod]), 2, '.', ' ' )." &euro; TTC" ;
															}
														}
														?>
														</div>
														<div class="product_ht">
														<?php 
															if ($prxproduit > 0) { echo  number_format($prxproduit, 2, ',', ' ')." &euro; HT" ; }
														?>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                </a>
                                                <div class="red_button add_to_cart_button"><a href="feraud-produit-detail-fiche-<?php echo $id_produit; ?>-<?php echo $libel_prod; ?>">Voir le d&eacute;tail</a></div>
                                            </div>
									<?php 
										}
									}else{
									?>
									
									<div class="product-item">Aucun produit trouv&eacute; ...</div>
									<?php
									}
									?>
									

								<!-- Product Sorting -->

								

							</div>
						</div>
					</div>
				</div>
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
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="js/categories_custom.js"></script>

<!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
