<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    ini_set('default_charset', 'UTF-8');
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>

<meta http-equiv="Content-Type" content="text/html" />
<meta charset="utf-8">
<meta name="robots" content="index, follow" />
<meta name="author" content="feraud-color.fr" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">



<title>Feraud Color - Peinture qualité professionnelle, lasure et vernis</title>
<meta name="description" content="Feraud Color spécialiste de la peinture de qualité professionnelle avec coloration sur-mesure. Peinture, lasure, vernis livrés partout en France en 48h." />

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--
<meta name="viewport" content="width=device-width, initial-scale=1">
-->
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/formulaire.css">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

<!-- Style poudre -->
    <link rel="stylesheet" href="css/stylepoudre.css" type="text/css" />
    <link type="text/css" href="jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 

<!-- RESPONSIVE -->
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

<!-- Slider -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="3beeb959-df32-49f7-a073-63a4d2619575" data-blockingmode="auto" type="text/javascript"></script>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<?php include_once("includes/analyticstracking.php"); ?>

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
                                <li><a href="feraud-actualites">ACTUALITÉS</a></li>
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
                <li><a href="feraud-actualites">ACTUALITÉS</a></li>
				<li class="menu_item"><a href="feraud-telechargement-documents-pdf-video-peinture">TUTOS</a></li>
                <li class="menu_item"><a href="feraud-peinture-adresse-coordonnees-contact-carte-nous-trouver">CONTACT</a></li>
			</ul>
		</div>
	</div>

	<!-- Slider -->
	<div class="slider_bg">
        <div class="main_slider">
    
            <div class="flexslider">
                <ul class="slides">
                	<?php 
						$reqslider = "SELECT id_sf, ord, nomslider, slideimg, lienslide, enligne  FROM illi21_slider where enligne = '1' order by `ord` ASC";
						$res_reqslider = mysqli_query($lien, $reqslider);
						$row_slide = mysqli_num_rows($res_reqslider);
						if($row_slide > 0)
						{
							while($leslide = mysqli_fetch_object($res_reqslider))
							{
								if($leslide->lienslide <> "")
								{
									?>
            		        		<li><a href="<?php echo $leslide->lienslide; ?>" target="_blank"><img src="images/slide/<?php echo $leslide->slideimg; ?>" alt=""></a></li>
                    				<?php 
								}else{
									?>
            		        		<li><img src="images/slide/<?php echo $leslide->slideimg; ?>" alt=""></li>
                    				<?php 
								}
							}
						}
					?>
                </ul>
            </div>
        </div>
	</div>
	
    <!-- configurateur Titre -->
	<div class="peinture_perso">
        <div class="container">
        	
            
        </div>
	</div>
    
    <!-- configurateur -->
	<div class="leconfigurateur" id="conteneur-central">
        <div class="container" >
            <div class="row" >
            	<div id="leconfigurateur" style="position:absolute; top:-50px; "></div>
                <div class="col-lg-8" id="dynamic">
	            	<form action="feraud-panier-ajouter-peinture" method="post" id="commande" name="commande" class="degradeilli" >
                        <div id="layer_nuancier" style="display:none;">
                        	<!-- AFFICHAGE DES COULEURS-->
	                        <h2>Cliquez sur la nuance de votre choix</h2>
                        	<i>Les couleurs sont à titre indicatif seulement, mieux vaut se munir d'un nuancier.</i>
                        	<div id="couleurs">
                        
	                        </div>
                        
    	                    <div class="clear"></div>
                        </div>
                        
                        <div id="layer_poudre" style="display:none;"><div id="fermer">x</div>
        	                <h2>Rechercher une poudre <i>(Exemple : ae00 grey)</i></h2>
	                        <div id="poudre">
                            
    	                    <!-- FORMULAIRE POUDRE-->
        		                <div class="container">
                			        <div class="row">
                        				<div class="col-4 border-right">
					                        <p><strong>MARQUES</strong></p>
                    				    </div>
				                        <div class="col-8" id="recherche"><input type="text" class="form-control" id="searchpost" aria-describedby="Saisissez la référence" placeholder="Rechercher une poudre" >
                					        <div id="envoirec">
						                        <span>Rechercher</span>
                        					</div>
				                        </div>
                			        </div>
                        			<div class="row">
				                        <div class="col-4 border-right">
                				        <?php 
				                        $recmarques 	= "Select nomarque from illi21_marque order by nomarque asc";
				                        $res_marques    = mysqli_query($lien, $recmarques);
				                        $row_cnt 		= mysqli_num_rows($res_marques);
				                        if($row_cnt > 0)
					                        {
					                        ?>
					                        <div class="form-check">
					                        <?php
                    						    while ($lect_marques_ = mysqli_fetch_object($res_marques))
						                        {
						                        ?>
                                                <div class="form-check">
	                                                <input class="form-check-input" type="checkbox" value="<?php echo $lect_marques_->nomarque; ?>" id="marque_n" name="marque_n">
    	                                            <label class="form-check-label" for="defaultCheck1"><?php echo $lect_marques_->nomarque; ?></label>
                                                </div>
						                        <?php
                        						}
						                        ?>
                                                <div class="form-check">
                    	                            <input class="form-check-input" type="checkbox" value="*" id="checkAll" >
                        	                        <label class="form-check-label" for="defaultCheck1">TOUTES</label>
                                                </div>
					                        <?php
					                        ?>
                    				    	</div>
			                	        	<?php
            				            	}
				                        	?>
	                                        <div id="filtrer"><span class="btn btn-light" id="recfiltre">Filtrer</span></div>
				                        </div>
                 						<div class="col-8" id="resultligne"></div>
		                        	</div>
                       			</div>
                        	<!-- FIN FORMULAIRE POUDRE-->
                       	 </div>
                       	 <div class="clear" ></div>
                        </div>
                        
                        <div class="form-group">
	                        <div class="centre"><h2 class="blanc config" ><strong>Configurez votre peinture sur mesure</strong></h2></div>
                        </div>

                         <div class="form-group">
                         	<h5 class="blanc gauche">Je souhaite peindre : </h5>
    	                	<?php 
								$reqsupport = "SELECT id_s, sup_nom, sup_lib_form, sup_class, sup_ol, sup_ordre FROM illi21_support where sup_ol = '1' order by `sup_ordre` ASC";
                                // echo $reqsupport;
								$res_reqsupport = mysqli_query($lien, $reqsupport);
							?>
                            <select id="supports" name="supports" required class="form-control custom-select">>
                                <option value="" disabled selected value>Choisir le support</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                        	<h5 class="blanc gauche">Je sélectionne une couleur : </h5>
	                        <select id="nuanciers" name="nuanciers" class="form-control custom-select">
                                <option value="" disabled selected value>Choisir le nuancier</option >
                            </select>
                            
                            <input type="hidden" name="lacouleur"	id="lacouleur" value="" />
                            <input type="hidden" name="idacouleur"	id="idacouleur" value="" />
                            <input type="hidden" name="larefcoul"	id="larefcoul" value="" />
                            <input type="hidden" name="idapoudre"	id="idapoudre" value="" />
                            <input type="hidden" name="larefpoudre"	id="larefpoudre" value="" />
                        </div>
                        <div class="form-group form-control" id="macouleur" style="display:none">
                            
                            <div class="blocoul" id="blocoul"><div id="lenomdelacouleur" ></div><div id="pastillecouleur" ></div></div>
                        </div>
                            
                        <div class="form-group form-control" id="mapoudre" style="display:none">
                            <div class="blopoudre" id="blopoudre"><div id="lenomdelapoudre" ></div></div>
                        </div>
                            
                        <div class="form-group form-control" id="refpoudre" style="display:none">
                            <div class="blopoudre" id="blocref"><div id="lenomdelaref" ></div></div>
                        </div>
                        
                     
                        <div class="form-group" id="mabrillance">
                        	<h5 class="blanc gauche">Brillance : </h5>
	                        <select id="brillance" name="brillance" required class="form-control custom-select">>
    	                        <option value="" disabled selected value>Choisir la brillance</option>
        	                </select>
                        </div>
                        
                        <div class="form-group">
                        	<h5 class="blanc gauche">Conditionnement : </h5>
	                        <select name="contenant" id="contenant" class="form-control custom-select">>
    	                    	<option value="" disabled selected value>Choisir le conditionnement</option>
        	                </select>
                        </div>
                        
                        <div class="form-group">
                        	<h5 class="blanc gauche">Quantité : </h5>
	                        <select name="nbpot" id="nbpot" dir="" class="form-control custom-select">>
    	                    	<option value="" disabled selected value>Quantité</option>
        	                </select>
                        </div>
                        
                        <div class="form-group leprix">
                        	<label class="prix">Prix de ma peinture :</label>
                            <input type="hidden" value="" name="mttc" id="mttc" />
                            <input type="text" value="" name="prixht" id="prixht" disabled="disabled" />&euro; HT / 
                            <input type="text" value="" name="prixttc" id="prixttc" disabled="disabled" />
                            <span id="prixbarre" style="display:none;" /></span>&nbsp;&euro; TTC
                            <input type="hidden" id="clientbatifer" name="clientbatifer" value="<?php if($clibat == '1' and $redubat > 0) {echo $redubat;}else{ echo '0';}?>" />
                        </div>
                        
                        <div class="form-group centre">
                        	<input type="submit" id="ajoutpanier" name="ajoutpanier" value="Ajouter au panier" > 
                        </div>
                
    	            </form>
                </div>
                <div class="col-lg-4">
                	<!--
                	<div class="voir_la_boutique_item d-flex flex-row align-items-center">
						<div class="deal_icon"><img src="images/picto-pinceau.png" /></div>
						<div class="deal_content">
							<h2>boutique</h2>
							<h3>accessoires</h3>
                            <a href="feraud-boutique-consommable-outillage" class="laboutique">Voir la boutique</a>
						</div>
					</div>
                    -->
                    <div class="la_boutique_outillage"  id="static" >
                    	<div class="outillage_content">
                        	
							<h2>boutique</h2>
							<h3>accessoires</h3>
                            <a href="feraud-boutique-consommable-outillage" class="laboutique">Voir la boutique</a>
                            
						</div>
                    </div>
                    
                    
                </div>
            </div>
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
    
    

	
	

	

	<!-- Accroche -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h1><?php echo $accroche; ?></h1>
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
                            <li>Tél. : <?php echo $numtel; ?></li>
                            <li>Mail : <?php echo $emel; ?></li>
                        </ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="footer_nav_container d-flex flex-sm-row flex-column  justify-content-lg-start  text-center">
						<ul class="footer_nav">
                        	<li><h4>à propos de Feraud Color</h4></li>
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
							<li><a href="feraud-peinture-mentions-legales-et-credits">Mentions légales</a></li>
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
						<div align="center">© Feraud Color - <?php echo $annee; ?>, tous droits réservés - <a href="https://www.declic-communication.com" target="_blank">Création et programmation de sites internet : Déclic Communication</a></div>
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


<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

  <!-- FlexSlider -->
  <script defer src="js/jquery.flexslider.js"></script>

  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        controlsContainer: $(".custom-controls-container"),
        customDirectionNav: $(".custom-navigation a"),
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  
  <!-- Syntax Highlighter -->
  <script type="text/javascript" src="js/shCore.js"></script>
  <script type="text/javascript" src="js/shBrushXml.js"></script>
  <script type="text/javascript" src="js/shBrushJScript.js"></script>
  <script type="application/javascript" src="jquery-ui/js/jquery-ui-1.10.3.custom.js"></script> 
  <script type="application/javascript" src="js/jquery_illi.js" ></script>
  
 
</body>

</html>
