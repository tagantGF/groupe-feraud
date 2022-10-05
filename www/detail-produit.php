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
	
	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");
	while($tva =  mysqli_fetch_object($res_lect_tva))
	{
		$tauxtva["$tva->id_tva"] = $tva->taux_tva;	
	}
	
	// Recherche le produit
	if(isset($_GET['_idp']) && is_numeric($_GET['_idp']))
	{
		$id_prod = $_GET['_idp'];
		$prodok  = "1";
		$lect_produit = "SELECT * FROM illi21_produits WHERE id_p = '$id_prod' and p_enligne = '1' limit 1;";
		$res_lect_produit = mysqli_query($lien,$lect_produit) or die ("Erreur lecture produit NumProd1");
		$leprod = mysqli_fetch_object($res_lect_produit);
		$prod_nom	= $leprod->p_nom;
		$prod_ref	= $leprod->p_ref;
		$prod_type	= $leprod->p_type;
		$prod_famil	= $leprod->p_famille;
		$prod_sfami	= $leprod->p_sfamille;
		$prod_desc	= $leprod->p_des_com;
		$prod_dest	= "";
		$prod_prix	= $leprod->p_prix_ht;
		$prod_tva	= $leprod->p_taux_tva;
		$prod_pho1	= $leprod->p_photo;
		$prod_pho2	= $leprod->p_photo_2;
		$prod_pho3	= $leprod->p_photo_3;
		$prod_pdf	= $leprod->p_pdf;
		$prod_decli	= $leprod->p_declinaison;
		
		// Recherche familles et sous famille eventuelle
		
		if ($prod_famil > 0 ) 
		{
			$lect_famille = "SELECT * FROM illi21_familles WHERE f_enligne = '1' and id_famille = '$prod_famil' limit 1;";
			$res_lect_famille = mysqli_query($lien,$lect_famille) or die ("Erreur lecture famille");
			$nbre_famille = mysqli_num_rows($res_lect_famille);
			if ($nbre_famille > 0 )
			{
				$lafamille = mysqli_fetch_object($res_lect_famille);
				$familnomlien 	= $lafamille->nomlien;
				$nomfamille 	= ($lafamille->f_libelle);
			}else{
				$familnomlien = '';
				$nomfamille = '';
			}
		}
		if ($prod_sfami > 0 ) 
		{
			$lect_s_famille = "SELECT * FROM illi21_familles_sous WHERE sf_enligne = '1' and id_sous_famille = '$prod_sfami' limit 1;";
			$res_lect_s_famille = mysqli_query($lien,$lect_s_famille) or die ("Erreur lecture sous famille");
			$nbre_s_famille = mysqli_num_rows($res_lect_s_famille);
			if ($nbre_s_famille > 0 )
			{
				$lasfamille = mysqli_fetch_object($res_lect_s_famille);
				$sfamilnomlien 	= $lasfamille->nomlien;
				$snomfamille 	= ($lasfamille->sf_libelle);
			}else{
				$sfamilnomlien = '';
				$snomfamille = '';
			}
		}
		
	}else{
		// produit introuvable
		$prodok  = "0";
		$id_prod = "0";
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
<title>Feraud Color- <?php echo $prod_nom; ?></title>
<meta name="Description" content="<?php echo strip_tags($prod_desc); ?>" />
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
<link rel="stylesheet" type="text/css" href="styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="styles/single_responsive.css">

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
        <div class="container single_product_container">
            <div class="row">
                <div class="col">
                	<!-- Breadcrumbs -->

                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">Accueil</a></li>
                            <li><a href="feraud-boutique-consommable-outillage"><i class="fa fa-angle-right" aria-hidden="true"></i>Boutique</a></li>
                            <li><a href="feraud-boutique-famille-<?php echo $prod_famil."-".$familnomlien; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $nomfamille; ?></a></li>
                            <?php if ($prod_sfami > '0' ) {?>
                            <li><a href="feraud-boutique-sous-famille-<?php echo $prod_sfami."-".$sfamilnomlien; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $snomfamille; ?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
			<?php if ($prodok == '1')
            {
            ?>
            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <li class="active">
                                        <?php if ($prod_pho1 <> "" and is_file("images/produits/".$prod_pho1)) 
										{ 
										?>
                                        	<img src="images/produits/<?php echo $prod_pho1; ?>" alt="<?php echo $prod_nom; ?>" data-image="images/produits/<?php echo $prod_pho1; ?>"></li>
                                        <?php 
										}
										?>
                                        <?php if ($prod_pho2 <> "" and is_file("images/produits/".$prod_pho2)) 
										{ 
										?>
	                                        <li><img src="images/produits/<?php echo $prod_pho2; ?>" alt="<?php echo $prod_nom; ?>" data-image="images/produits/<?php echo $prod_pho2; ?>"></li>
                                        <?php 
										}
										?>
                                        <?php if ($prod_pho3 <> "" and is_file("images/produits/".$prod_pho3)) 
										{ 
										?>
	                                        <li><img src="images/produits/<?php echo $prod_pho3; ?>" alt="<?php echo $prod_nom; ?>" data-image="images/produits/<?php echo $prod_pho3; ?>"></li>
                                        <?php 
										}
										?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                	<?php if ($prod_pho1 <> "" and is_file("images/produits/".$prod_pho1)) 
									{ 
									?>
										<div class="single_product_image_background" style="background-image:url(images/produits/<?php echo $prod_pho1; ?>)"></div>
									<?php 
									}
									?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">
                            <h2><?php echo $prod_nom; ?></h2>
                            <?php 
							if($prod_type == 's')
							{
								echo "<p>Réf. : ".$prod_ref."</p>";
							}
							?>
                            <p><?php echo $prod_desc; ?></p>
                            <?php 
							if ($prod_pdf <> "" and is_file("documents/".$prod_pdf)) 
							{?>
								<a href="documents/<?php echo $prod_pdf;?>" class="lepdf btn btn-pdf" target="_blank">Télécharger la fiche produit <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            <?php
							}
							?>
                        </div>
                        
                        <?php 
						if($prod_type == 's')
						{
						// Produit simple
							?>
							<div class="enstock col-3 mb-2">En stock</div>
                            
                            <div class="product_price">
							
							<?php 
							if($clibat == '1' and $redubat > 0)
							{
								echo "<span class='product_price_strike'>Prix public : ".number_format(prixttc($prod_prix, $tauxtva[$prod_tva]), 2, '.', ' ' )." &euro; TTC</span><br>" ;
								$prod_prix = prixclient($prod_prix,$redubat);
								echo "Votre prix : ".number_format(prixttc($prod_prix, $tauxtva[$prod_tva]), 2, '.', ' ' )." &euro; TTC" ;
							}else{
								echo number_format(prixttc($prod_prix, $tauxtva[$prod_tva]), 2, '.', ' ' )." &euro; TTC" ; 
							}
							?>
                            </div>
                            
                            
							<div class="product_price_ht"><?php echo number_format($prod_prix, 2, ',', ' ')." &euro; HT" ; ?></div>
							
							<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
								<span>Quantit&eacute; :</span>
								<div class="quantity_selector">
									<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
									<span id="quantity_value">1</span>
									<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
								</div>
								<form method="post" action="feraud-panier-ajouter-article" name="panier" id="panier"><input type="hidden" id="quantiteprod" name="quantite" value="1" />
                                	<input type="hidden" id="idproduit" name="idproduit" value="<?php echo $id_prod;?>" />
								<div class="red_button add_to_cart_button"><a href="#" onclick="document.getElementById('panier').submit();">ajouter au panier</a></div>
								</form>
							</div>
                        <?php 
						}else{
							// Produit multiple
							// recherche toutes les déclinaisons
							$recherche_declinaisons = "SELECT * from illi21_produits_var where id_prod = '$id_prod';";
							$res_declinaisons = mysqli_query($lien, $recherche_declinaisons);
							
							$nbre_lignes = mysqli_num_rows($res_declinaisons);
							if ($nbre_lignes > 0 )
							{
								?>
								<p><strong>Choisir un modèle ci-dessous : </strong></p>
                                <select name="prod_declinaison" id="prod_declinaison" class="form-control mb-2">
                                	<option value="" selected="selected" disabled="disabled"><?php echo $prod_decli; ?></option>
                                <?php
								while($ladeclinaison =  mysqli_fetch_object($res_declinaisons))
								{
									?>
									<option value="<?php echo $ladeclinaison->id_decli; ?>"><?php echo $ladeclinaison->p_nom; ?></option>
									<?php 
								}
								?>
                                </select>
                                <div class="enstock col-3 mb-2" style="display:none" id="en-stock">En stock</div>
                                <div class="product_price_strike" id="prixbarre" style="display:none"></div>
                                <div class="product_price" id="prixttcdecli"></div>
                                <div class="product_price_ht" id="prixhtcdecli"></div>

                                <div class="quantity flex-column flex-sm-row align-items-sm-center" id="lignepanier" style="display:none">
                                    <span>Quantit&eacute; :</span>
                                    <div class="quantity_selector">
                                        <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <span id="quantity_value">1</span>
                                        <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <form method="post" action="feraud-panier-ajouter-article" name="panierdecli" id="panierdecli">
                                    	<input type="hidden" id="quantiteprod" name="quantite" value="1" />
                                        <input type="hidden" id="iddeclinaison" name="iddeclinaison" value="" />
                                        <input type="hidden" id="clientbatifer" name="clientbatifer" value="<?php if($clibat == '1' and $redubat > 0) {echo $redubat;}else{ echo '0';}?>" />
                                    	<div class="red_button add_to_cart_button"><a href="#" onclick="document.getElementById('panierdecli').submit();">ajouter au panier</a></div>
                                    </form>
                                </div>
                                <?php
							}
						?>
						
						<?php 
						}
						?>
                    </div>
                </div>
            </div>
            
            <!-- Tabs -->
			<?php if($prod_dest <> "") 
			{
				?>
				<div class="tabs_section_container mt-5">
			
					<div class="container">
						
						<div class="row">
							<div class="col">
			
								<!-- Tab Description -->
			
								<div id="tab_1" class="tab_container active">
									<div class="row">
										<div class="col-lg-12 desc_col">
											<div class="tab_title">
												<h4></h4>
											</div>
											<div class="tab_text_block">
												
												
											</div>
											
										</div>
										
									</div>
								</div>
			
							   
			
							   
			
								
			
							</div>
						</div>
					</div>
			
				</div>
				
				
				<?php 
			}
			
			}else{
				?>
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="product_details">Produit introuvable ...</div>
                    </div>
                </div>
				<?php
			}?>
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

<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="js/single_custom.js"></script>
<script src="js/declinaisons.js"></script>
<!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
