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
<script language='javascript'>
	function calculadr()
	{
		if (document.getElementById('factidem').checked == true)
		{
			
			document.getElementById('facturation').style.display = 'block';
		
			document.getElementById('prenom_f').required = true;
			document.getElementById('nom_f').required = true;
			document.getElementById('adresse_f').required = true;
			document.getElementById('cp_f').required = true;
			document.getElementById('ville_f').required = true;
			document.getElementById('telephone_f').required = true;
			document.getElementById('societe_f').required = false;
		
			document.getElementById('prenom_f').disabled = false;
			document.getElementById('nom_f').disabled = false;
			document.getElementById('adresse_f').disabled = false;
			document.getElementById('cp_f').disabled = false;
			document.getElementById('ville_f').disabled = false;
			document.getElementById('telephone_f').disabled = false;
			document.getElementById('societe_f').disabled = false;
		}else{
		
			document.getElementById('facturation').style.display = 'none';
		
			document.getElementById('prenom_f').required = false;
			document.getElementById('nom_f').required = false;
			document.getElementById('adresse_f').required = false;
			document.getElementById('cp_f').required = false;
			document.getElementById('ville_f').required = false;
			document.getElementById('telephone_f').required = false;
			document.getElementById('societe_f').required = false;
		
			document.getElementById('prenom_f').disabled = true;
			document.getElementById('nom_f').disabled = true;
			document.getElementById('adresse_f').disabled = true;
			document.getElementById('cp_f').disabled = true;
			document.getElementById('ville_f').disabled = true;
			document.getElementById('telephone_f').disabled = true;
			document.getElementById('societe_f').disabled = true;
		}
	}
	
	
	function verifadresse() {
		var x = document.forms["livraison"]["prenom_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre prénom");
			document.forms["livraison"]["prenom_l"].focus();
			return false;
		}
		
		var x = document.forms["livraison"]["nom_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre nom");
			document.forms["livraison"]["nom_l"].focus();
			return false;
		}
		
		var x = document.forms["livraison"]["adresse_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre adresse");
			document.forms["livraison"]["adresse_l"].focus();
			return false;
		}
		var x = document.forms["livraison"]["cp_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre code postal");
			document.forms["livraison"]["cp_l"].focus();
			return false;
		}
		var x = document.forms["livraison"]["ville_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre ville");
			document.forms["livraison"]["ville_l"].focus();
			return false;
		}
		var x = document.forms["livraison"]["telephone_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre telephone");
			document.forms["livraison"]["telephone_l"].focus();
			return false;
		}
		
		var x = document.forms["livraison"]["emel_l"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre mail");
			document.forms["livraison"]["emel_l"].focus();
			return false;
		}
		
		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		var x = document.forms["livraison"]["emel_l"].value;
		if(!regex.test(x))
		{
		   alert("Merci de renseigner une adresse mail valide");
		   return false;
		}
		
	}
	
	function verifform() {
		var x = document.forms["contact"]["nom"].value;
		if (x == null || x == "") {
			alert("Merci de saisir votre nom");
			document.forms["livraison"]["nom"].focus();
			return false;
		}
		
		var x = document.forms["livraison"]["acceptcgv"].value;
		if (x == null || x == "") {
			alert("Merci d'(accepter les Conditions Générales d'Utilisation");
			return false;
		}
		
	}
	</script>

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
            
            	<?php
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
						$_SESSION['panierfer']['typepai'] = "";
					
						if (isset($_GET['_cb']) and $_GET['_cb'] == '1')
							{
							$l1 = $l2 = $l3 = $l4 = $l5 = $l6 = $l7 = $l8 = $l9 = $f1 = $f2 = $f3 = $f4 = $f5 = $f6 = $f7 = $f8 = "";
							$_SESSION['panierfer']['typepai'] = "cb";
							// Paiement CB
							if(isset($_SESSION['livraison']['civilite']))					$l1 = stripslashes($_SESSION['livraison']['civilite']);
							if(isset($_SESSION['livraison']['prenom']))						$l2 = stripslashes($_SESSION['livraison']['prenom']);
							if(isset($_SESSION['livraison']['nom']))						$l3 = stripslashes($_SESSION['livraison']['nom']);
							if(isset($_SESSION['livraison']['adr1']))						$l4 = stripslashes($_SESSION['livraison']['adr1']);
							if(isset($_SESSION['livraison']['cp']))							$l5 = stripslashes($_SESSION['livraison']['cp']);
							if(isset($_SESSION['livraison']['ville']))						$l6 = stripslashes($_SESSION['livraison']['ville']);
							if(isset($_SESSION['livraison']['portable']))					$l7 = stripslashes($_SESSION['livraison']['portable']);
							if(isset($_SESSION['livraison']['societe']))					$l8 = stripslashes($_SESSION['livraison']['societe']);
							if(isset($_SESSION['livraison']['emel']))						$l9 = stripslashes($_SESSION['livraison']['emel']);
						
							
							if(isset($_SESSION['facturation']['civilite']))					$f1 = stripslashes($_SESSION['facturation']['civilite']);
							if(isset($_SESSION['facturation']['prenom']))					$f2 = stripslashes($_SESSION['facturation']['prenom']);
							if(isset($_SESSION['facturation']['nom']))						$f3 = stripslashes($_SESSION['facturation']['nom']);
							if(isset($_SESSION['facturation']['adr1']))						$f4 = stripslashes($_SESSION['facturation']['adr1']);
							if(isset($_SESSION['facturation']['cp']))						$f5 = stripslashes($_SESSION['facturation']['cp']);
							if(isset($_SESSION['facturation']['ville']))					$f6 = stripslashes($_SESSION['facturation']['ville']);
							if(isset($_SESSION['facturation']['portable']))					$f7 = stripslashes($_SESSION['facturation']['portable']);
							if(isset($_SESSION['facturation']['societe']))					$f8 = stripslashes($_SESSION['facturation']['societe']);
								
							?>
                            <div class="col-lg-12">
							<form method="post" action="feraud-mon-panier-valider-avant-paiement" name="livraison" id="livraison" onsubmit="return verifadresse();">
								<div class="row">
									<p style="margin-top:10px;"><b>Adresse de livraison</b> <i>uniquement en France Métropolitaine</i></p>
								</div>
                                
								<div class="row">
                                	<div class="col-sm-6">

                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label">Civilité<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
                                            	<label><input type="radio" name="civilite_l" id="Madame" value="Mme" class="validate[required] form-control-sm" <?php if($l1 == "Mme") echo 'checked="checked"'; ?>/> Mme</label>
	                                            <label><input type="radio" name="civilite_l" id="Monsieur" value="Mr" class="validate[required] form-control-sm" <?php if($l1 == "Mr") echo 'checked="checked"'; ?>/> Mr</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="prenom_l">Prénom<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="prenom_l" id="prenom_l" class="validate[required] form-control" value="<?php echo $l2; ?>"  required aria-required="true"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="nom_l">Nom<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="nom_l" id="nom_l" class="validate[required] form-control" value="<?php echo $l3; ?>"  required aria-required="true"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="ville_l">Société : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="societe_l" id="societe_l" value="<?php echo $l8; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="adresse_l">Adresse<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="adresse_l" id="adresse_l" class="validate[required] form-control" value="<?php echo $l4; ?>"  required aria-required="true"/>
                                            </div>
                                        </div>
                                    </div>
							
								
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="cp_l" class="col-sm-4 col-form-label">Code postal<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="cp_l" id="cp_l" class="validate[required] form-control" value="<?php echo $l5; ?>"  required aria-required="true"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ville_l" class="col-sm-4 col-form-label">Ville<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="ville_l" id="ville_l" class="form-control" required aria-required="true" value="<?php echo $l6; ?>" maxlength="48" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="telephone_l" class="col-sm-4 col-form-label">Téléphone<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="text" name="telephone_l" id="telephone_l" class="validate[required] form-control" value="<?php echo $l7; ?>"  required aria-required="true"  onBlur="validertel(this)"/> (au format 0303030303 sans . ni espace)								
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="emel_l" class="col-sm-4 col-form-label">Mail<span class="rouge">*</span> : </label>
                                            <div class="col-sm-8">
	                                            <input type="email" name="emel_l" id="emel_l" class="validate[required] form-control" value="<?php echo $l9; ?>"  required aria-required="true"/>
                                            </div>
                                        </div>
									</div>
                                </div>

								<p class="flotteg clear">&nbsp;<input type="checkbox" name="factidem" id="factidem" onclick="calculadr()" />&nbsp;&nbsp;<i>Adresse de facturation différente de l'adresse de livraison</i>	</p>
								<p class="filetform"></p>
                                <div id="facturation" style="display:none">
                                    <div class="row">
                                		<div class="col-sm-6">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Civilité<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
	                                                <label class="none"><input type="radio" name="civilite_f" id="Madame" value="Mme" class="validate[required] form-control-sm" <?php if($f1 == "Mme") echo 'checked="checked"'; ?> /> Mme</label>
                                                    <label class="none"><input type="radio" name="civilite_f" id="Monsieur" value="Mr" class="validate[required] form-control-sm" <?php if($f1 == "Mr") echo 'checked="checked"'; ?> /> Mr</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="prenom_f" class="col-sm-4 col-form-label">Prénom<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
	                                                <input type="text" name="prenom_f" id="prenom_f" class="validate[required] form-control" value="<?php echo $f2; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nom_f" class="col-sm-4 col-form-label">Nom<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
	                                                <input type="text" name="nom_f" id="nom_f" class="validate[required] form-control" value="<?php echo $f3; ?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="code_et_f" class="col-sm-4 col-form-label">Société : </label>
                                                <div class="col-sm-8">
	                                                <input type="text" name="societe_f" id="societe_f" class="form-control" value="<?php echo $f8; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="adresse_f" class="col-sm-4 col-form-label">Adresse<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
	                                                <input type="text" name="adresse_f" id="adresse_f" class="validate[required] form-control" value="<?php echo $f4; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cp_f" class="col-sm-4 col-form-label">Code postal<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
	                                                <input type="text" name="cp_f" id="cp_f" class="validate[required] form-control" value="<?php echo $f5; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ville_f" class="col-sm-4 col-form-label">Ville<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
	                                                <input type="text" name="ville_f" id="ville_f" class="validate[required] form-control" value="<?php echo $f6; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="telephone_f" class="col-sm-4 col-form-label">Téléphone<span class="rouge">*</span> : </label>
                                                <div class="col-sm-8">
      	                                          <input type="text" name="telephone_f" id="telephone_f" class="validate[required] form-control" value="<?php echo $f7; ?>"  onBlur="validertel(this)"/> (au format 0606060606 sans . ni espace)										
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
								<div class="code-promo" style="display:none">
                                	<div class="votre-code"><span class="titrelivgnoir">Code promo</span></div>
                                    <div class="votre-code-saisie"><input type="text" name="code_p" id="code_p" value="" /></div>
                                    <p class="filetform"></p>
                                </div>
                                <div class="row">
                                	<div class="col-sm-6">
										<a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">
											<div id="continuer-achat" class="clear btn">CONTINUER MES ACHATS</div>
										</a>
                                    </div>
                                	<div class="col-sm-6">
										<input type="submit" name="livr" id="livr" class="btn" value="VALIDER" />
                                    </div>
                                </div>
							</form>
                            </div>
							<?php
						}
						
						if (isset($_GET['_cpt']) and $_GET['_cpt'] == '1')
							{
							$_SESSION['panierfer']['typepai'] = "cpt";
							// Paiement COMPTE
							?>
                            <div class="col-lg-12">
                                <form method="post" action="feraud-mon-panier-valider-avant-paiement" name="contact" id="contact" onsubmit="return verifform();">
                                <div class="row">
									<div class="titreform col-sm-12">Paiement compte client</div>
								</div>
                                
								
                                
                                <div class="row">
                                	<div class="col-sm-8">
                                    	<div class="row mb-1">
                                        	<label class="col-sm-4 form-black">Numéro de compte* : </label>
                                            <div class="col-sm-8">
                                            	
                                                <input type="text" name="compte" id="compte" class="validate[required] form-control" tabindex="1" value=""  required aria-required="true"/>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                        	<label class="col-sm-4 form-black">E-mail* : </label>
                                            <div class="col-sm-8">
                                            	<input type="email"  name="lemail" id="lemail" maxlength="128" tabindex="7"  required aria-required="true" value=""  class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                        	<label class="col-sm-4 form-black">Mot de passe : </label>
                                            <div class="col-sm-8">
                                            	<input type="password"  name="motdepas" id="motdepas" maxlength="12" minlength="6" tabindex="9" aria-required="true" value=""  class="form-control"/>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1">
                                        	<label class="col-sm-4 form-black">Commentaire : </label>
                                            <div class="col-sm-8">
                                            	<textarea name="commentaire" id="commentaire" tabindex="10" value=""  class="form-control-area" rows="3" /></textarea>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-sm-4 bg-light border border-secondary">
                                    	<p><strong>Pas de mot de passe ?</strong></p>
                                        <p class="txt-form">Saisissez en plus de votre numéro de compte et de votre adresse mail, votre code postal : </p>
                                        
                                        <input type="text"  name="codp" id="codp" maxlength="10" tabindex="8"  class="form-control"  value=""/>
                                    </div>
                               </div>
                               <!--
                               <div class="row">
	                               	<div class="code-promo">
                                        <div class="votre-code"><span class="titrelivgnoir">Code promo</span></div>
                                        <div class="votre-code-saisie"><input type="text" name="code_p" id="code_p" value="" maxlength="20" /></div>
                                        <p class="filetform"></p>
                                    </div>
                               </div>
                                -->
                                 <div class="row mt-3">
                                 	<div class="col-sm-6">
                                    	<a href="feraud-peinture-qualite-professionnelle-sur-mesure-couleur-lasure-vernis-bois-metal-personnalisee">
                                            <div id="continuer-achat" class="clear btn">CONTINUER MES ACHATS</div>
                                            </a>
                                    </div>
                                    <div class="col-sm-6">
                                            <input type="submit" name="livr" id="livr" class="btn" value="VALIDER" />
                                    </div>
                                 </div>
                                
                                 </form>
  
                            </div>            
							
							
							
							
							
							
							<?php
						
							}
						
						
						
						
					}
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
