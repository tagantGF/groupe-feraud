<?php
	session_start();
	require_once 'includes/fonctionsqli.php';
	require_once 'includes/panier.php';
	include ("banque/function.php");
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
	
	// Selection de la langue // Language selection
	if (isset($_REQUEST['lang'])) $lang = $_REQUEST['lang'];
	if (isset($_REQUEST['en_x'])) $lang = "en";
	if (isset($_REQUEST['fr_x'])) $lang = "fr";
	if (!isset($lang)) $lang = "fr";
	
	
	// Lorsque l'on arrive sur le choix de paiement on enregistre la commande.
	// Cette commande sera validée après le paiement CB ou après la saisie du compte client
	
	
	// ENREGISTRE LA COMMANDE
	$dt 			= date('Y-m-d');
	$hr 			= date('H:i:s');
	
	$mt_reduc		= $_SESSION['panierfer']['mttcreduc'];
	$mel_client 	= $_SESSION['livraison']['emel'];
	$total          = $_SESSION['panierfer']['montantTTC'];
	$lemttc 		= number_format($total, 2, '.', '');
	$c_reduc		= $_SESSION['panierfer']['c_reduc_ht'];
	$c_pourc		= $_SESSION['panierfer']['c_pourc'];
	$nb_article 	= count($_SESSION['panierfer']['identifiant']);
	$port			= $_SESSION['panierfer']['fraisdePort'];
	$ipclient 		= $_SERVER['REMOTE_ADDR'];
	
	$_SESSION['livraison']['commentaire'] = securiseFormulaire($_POST['commentaire']);
	$_SESSION['panierfer']['modedepaiement'] = securiseFormulaire($_POST['confirmer-panier']);
	
	$l_civi		=	$_SESSION['livraison']['civilite'];
	$l_nom		=	mysqli_real_escape_string($lien,$_SESSION['livraison']['nom']);
	$l_prenom	=	mysqli_real_escape_string($lien,$_SESSION['livraison']['prenom']);
	$l_adresse	=	mysqli_real_escape_string($lien,$_SESSION['livraison']['adr1']);
	$l_cp		=	mysqli_real_escape_string($lien,$_SESSION['livraison']['cp']);
	$l_ville	=	mysqli_real_escape_string($lien,$_SESSION['livraison']['ville']);
	$l_societe	=	mysqli_real_escape_string($lien,$_SESSION['livraison']['societe']);
	$l_tel		=	mysqli_real_escape_string($lien,$_SESSION['livraison']['portable']);
	$mel_client =   mysqli_real_escape_string($lien,$_SESSION['livraison']['emel']);
	
	$f_civi		=	$_SESSION['facturation']['civilite'];
	$f_nom		=	mysqli_real_escape_string($lien,$_SESSION['facturation']['nom']);
	$f_prenom	=	mysqli_real_escape_string($lien,$_SESSION['facturation']['prenom']);
	$f_asresse	=	mysqli_real_escape_string($lien,$_SESSION['facturation']['adr1']);
	$f_cp		=	mysqli_real_escape_string($lien,$_SESSION['facturation']['cp']);
	$f_ville	=	mysqli_real_escape_string($lien,$_SESSION['facturation']['ville']);
	$f_societe	=	mysqli_real_escape_string($lien,$_SESSION['facturation']['societe']);
	$f_tel		=	mysqli_real_escape_string($lien,$_SESSION['facturation']['portable']);
	
	$c_comtr	=	mysqli_real_escape_string($lien,$_SESSION['livraison']['commentaire']);
	
	$c_codpro	=	mysqli_real_escape_string($lien,$_SESSION['livraison']['code_p']);
	
	if(isset($_SESSION['panierfer']['code']))
	{
		$c_codep	=	mysqli_real_escape_string($lien,$_SESSION['panierfer']['code']);
	}else{
		$c_codep	=	"";
	}
	
	
	
	$idclient	= $_SESSION['c_feraud']['id_client'];
	
	$enr_commande  = "INSERT INTO  illi21_commandes (";
	$enr_commande .= "id_client, c_date, c_heure, c_total, c_reduc, c_pourc, c_code, c_promo, c_fdp, c_paiement, c_transactionid, c_type_paiement, c_ip, c_valide,";
	$enr_commande .= "l_civilite, l_nom, l_prenom, l_soc, l_adr1, l_cp, l_ville, l_telephone, l_mel, ";
	$enr_commande .= "f_civilite, f_nom, f_prenom, f_soc, f_adr1, f_cp, f_ville, f_tel, c_comtr, c_codpro";
	
	$enr_commande .= ") VALUES (";
	
	$enr_commande .= "'$idclient', '$dt', '$hr', '$total','$c_reduc','$c_pourc', '$c_codep' , '$mt_reduc' , '$port', '0', '', '', '$ipclient','0', ";
	$enr_commande .= " '$l_civi', '$l_nom', '$l_prenom', '$l_societe', '$l_adresse', '$l_cp', '$l_ville', '$l_tel', '$mel_client', ";
	$enr_commande .= " '$f_civi', '$f_nom', '$f_prenom', '$f_societe', '$f_asresse', '$f_cp', '$f_ville', '$f_tel', '$c_comtr', '$c_codpro'";
	$enr_commande .= ");";
	
	// echo $enr_commande;
	$res_enr_commande = mysqli_query($lien,$enr_commande) or die ("Erreur ajout commande");
	$id_cmd = mysqli_insert_id($lien); 
	// $id_cmd = "";
	$_SESSION['panierfer']['numcom'] = $id_cmd;
	
	
	
	
	// On enregistre la commande avant le paiement et on passe en paramètre le numéro de commande
	// Le champ c_valide et c_paymut restent à 0 tant que le paiement n'est pas valide
	// Le numero de commande sera egalement généré après le paiement
	
	$cust_name 		= $l_prenom." ".$l_nom;
	$cust_address 	= $l_adresse;
	$cust_zip 		= $l_cp;
	$cust_city 		= $l_ville;
	$cust_country 	= "";
	$cust_phone 	= $l_tel;
	$cust_email 	= $mel_client;
	
	$mttc_total		= $total;
	
	
	$newcmd			= "0";
	
	
	// ENREGISTRE LE DETAIL DE LA COMMANDE
	for ($i=0; $i<$nb_article; $i++)
	{		
		
		$nom_couleur = mysqli_real_escape_string($lien,$_SESSION['panierfer']['la_couleur'][$i]);
		$rf_couleur = mysqli_real_escape_string($lien,$_SESSION['panierfer']['rf_couleur'][$i]);
		
		if($_SESSION['panierfer']['nomproduit'][$i] <> "")
		{
			$d_produit = addslashes($_SESSION['panierfer']['nomproduit'][$i]);
		}else{
			$d_produit = "";
		}
		
		$identifiant 	= $_SESSION['panierfer']['identifiant'][$i];
		$support 		= $_SESSION['panierfer']['id_support'][$i];
		$contenant		= $_SESSION['panierfer']['id_contenant'][$i];
		$nuancier 		= $_SESSION['panierfer']['id_nuancier'][$i];
		$couleur		= $_SESSION['panierfer']['id_couleur'][$i];
		$brillance		= $_SESSION['panierfer']['brillance'][$i];
		$typeprod		= $_SESSION['panierfer']['typeprod'][$i];
		
		$quantite 	 	= $_SESSION['panierfer']['nb_pot'][$i];
		// $poidtotprod	= number_format($_SESSION['panierfer']['poids'][$i], 2, '.', '');
		$poidtotprod	= "";
		$prix        	= number_format($_SESSION['panierfer']['prixunitaire'][$i], 2, '.', '');
		$prixtotal   	= $_SESSION['panierfer']['mttc'][$i];
		
		$prixreduit		= number_format($_SESSION['panierfer']['prixunitaire_rm'][$i], 2, '.', '');
		$prixtotalredt 	= $_SESSION['panierfer']['prixtotal_rm'][$i];

		$enr_detail  = "INSERT INTO illi21_commandes_detail (d_commande, d_identifiant, d_produit, d_typ_produit ,d_support, d_contenant, d_nuancier, d_brillance, d_couleur, d_nom_couleur, d_rf_couleur, d_quantite, d_poid_totl, ";
		$enr_detail .= "d_prix_unit, d_prix_total, d_prix_unit_rm, d_prix_total_rm) ";
		
		$enr_detail .= "VALUES ('$id_cmd', '$identifiant', '$d_produit', '$typeprod','$support', '$contenant','$nuancier','$brillance','$couleur','$nom_couleur','$rf_couleur','$quantite', '$poidtotprod',";
		$enr_detail .= " '$prix', '$prixtotal', '$prixreduit', '$prixtotalredt')";
		// echo $enr_detail;
		$res_enr_detail = mysqli_query($lien,$enr_detail) or die ("Erreur ajout detail article");
	}
	
	// Banque
	$site_id 		= utf8_encode("12741012");
	$TEST_key 		= utf8_encode("Pav6Je8V1ImpSaqN");
	$PROD_key 		= utf8_encode("dhv9CSZegwOSXT6N");
	$currency		= utf8_encode("978");
	$payment_cards	= utf8_encode("CB;MAESTRO;VISA_ELECTRON;VISA;MASTERCARD");
	$vads_version	= utf8_encode("V2");
	$theme_config	= utf8_encode("RESPONSIVE_MODEL=Model_1");
	$dthr 			= utf8_encode(date('YmdHis'));
	$trans_id 		= utf8_encode(get_Trans_id());
	$payment_config	= utf8_encode("SINGLE");
	$page_action	= utf8_encode("PAYMENT");
	$ctx_mode		= utf8_encode("PRODUCTION"); // TEST
	$action_mode	= utf8_encode("INTERACTIVE");
	
	
	
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
                
                    <div class="titrebgrouge">Paiement de votre commande</div>
                    
                    <?php
					// print_r($_SESSION['panierfer']);
					
                    $montant 		= $_SESSION['panierfer']['montantTotal'] + $mt_reduc;
                    $totalttc 		= number_format(($total), 2, '.', '');
                    $mttc 			= number_format($totalttc, 2, '.', '');
                    
                    if(creationPanier())
                    {
                        $nb_article = count($_SESSION['panierfer']['identifiant']);
                        if ($nb_article <= 0)
                        {		
                            ?>
                            <p>Votre panier est vide</p>
                        <?php	
                        }else{	
                            if($totalttc > 0)
                            {            	
                                // PAIEMENT CB
                                
                                if($_SESSION['panierfer']['typepai'] == "cb"){
                                    $cust_name 		= ($_SESSION['facturation']['civilite']." ".$_SESSION['facturation']['prenom']." ".$_SESSION['facturation']['nom']);
                                    $cust_address 	= ($_SESSION['facturation']['adr1']);
                                    $cust_zip 		= ($_SESSION['facturation']['cp']);
                                    $cust_city 		= ($_SESSION['facturation']['ville']);
                                    $cust_country 	= ($_SESSION['facturation']['pays']);
                                    $cust_phone 	= ($_SESSION['facturation']['portable']);
                                    $cust_email 	= ($_SESSION['livraison']['emel']);
                                    $cust_ses_id	= session_id();
                                    $cust_ip_adr	= $_SERVER['REMOTE_ADDR'];
                                    $id_client		= $id_cmd;
                                    
                                    $mttc 			= str_replace(".", "", $mttc);// le montant transmis à la banque doit être en centime
									
									// Generation de la signature
									$params			= array();
									$params['vads_site_id'] 		= $site_id;
									$params['vads_currency'] 		= $currency;
									$params['vads_amount'] 			= $mttc;
									$params['vads_cust_email'] 		= utf8_encode($cust_email);
									$params['vads_payment_cards'] 	= $payment_cards;
									$params['vads_order_id'] 		= $id_cmd;
									$params['vads_version'] 		= $vads_version;
									$params['vads_theme_config']	= $theme_config;
									$params['vads_trans_date'] 		= $dthr;
									$params['vads_trans_id'] 		= $trans_id;
									$params['vads_payment_config'] 	= $payment_config;
									$params['vads_page_action'] 	= $page_action;
									$params['vads_ctx_mode'] 		= $ctx_mode;
									$params['vads_action_mode'] 	= $action_mode;


									$signature 		= get_Signature($params, $PROD_key);
                                    ?>
                                    
                                    <p class="corps12px">Merci de choisir votre moyen de paiement afin de régler la somme de <span class="bordeau gras"><?php echo $totalttc; ?> € TTC</span></p>
                                    
                                    <div id="form33"></div>
                                    
                                    <div id="fond-paiement">
                                        
                                        <div class="colonne">
                                            <form method="POST" action="https://clicandpay.groupecdn.fr/vads-payment/">
												<input type="hidden" name="vads_site_id"		value="<?php echo $site_id;?>" />
												<input type="hidden" name="vads_currency"		value="<?php echo $currency; ?>" />
												<input type="hidden" name="vads_amount"			value="<?php echo $mttc; ?>" >
												<input type="hidden" name="vads_cust_email"		value="<?php echo utf8_encode($cust_email); ?>" />
												<input type="hidden" name="vads_payment_cards"	value="<?php echo $payment_cards; ?>" />
												<input type="hidden" name="vads_order_id"		value="<?php echo $id_cmd; ?>">
												<input type="hidden" name="vads_version" 		value="<?php echo $vads_version; ?>" />
												<input type="hidden" name="vads_theme_config"	value="<?php echo $theme_config; ?>" />
												<input type="hidden" name="vads_trans_date" 	value="<?php echo $dthr; ?>" />
												<input type="hidden" name="vads_trans_id" 		value="<?php echo $trans_id; ?>" />
												<input type="hidden" name="vads_payment_config" value="<?php echo $payment_config; ?>" />
												<input type="hidden" name="vads_page_action" 	value="<?php echo $page_action; ?>" />
												<input type="hidden" name="vads_ctx_mode" 		value="<?php echo $ctx_mode; ?>" />
												<input type="hidden" name="vads_action_mode" 	value="<?php echo $action_mode; ?>" />
												<input type="hidden" name="signature" 			value="<?php echo utf8_encode($signature); ?>"/>
												<input type="submit" name="payer" value="Payer" class="btn btn-success"/>
											</form>
                                            <br />En ligne par carte bancaire - Visa, Mastercard, etc...                                
                                        </div>
                                    </div>
                                    <div id="partenaire-paiement">
                                        <p><img src="images/cadenas.png" alt="Avec notre partenaire CIC paiement en ligne sécurisé" title="Avec notre partenaire CIC paiement en ligne sécurisé" /> Avec notre partenaire CIC paiement en ligne sécurisé</p>
                                    </div>
                                    
                                    <?php
                                
                                
                                }
                                
                                // PAIEMENT COMPTE
                                
                                if($_SESSION['panierfer']['typepai'] == "cpt")
								{
								
									
									if($_SESSION['panierfer']['modedepaiement'] == "Payer par CB")
									{
										// Soit CB
										$cust_name 		= ($_SESSION['facturation']['civilite']." ".$_SESSION['facturation']['prenom']." ".$_SESSION['facturation']['nom']);
										$cust_address 	= ($_SESSION['facturation']['adr1']);
										$cust_zip 		= ($_SESSION['facturation']['cp']);
										$cust_city 		= ($_SESSION['facturation']['ville']);
										$cust_country 	= ($_SESSION['facturation']['pays']);
										$cust_phone 	= ($_SESSION['facturation']['portable']);
										$cust_email 	= ($_SESSION['livraison']['emel']);
										$cust_ses_id	= session_id();
										$cust_ip_adr	= $_SERVER['REMOTE_ADDR'];
										$id_client		= $id_cmd;
										
										$mttc 			= str_replace(".", "", $mttc);// le montant transmis à la banque doit être en centime
										
										// Generation de la signature
										$params			= array();
										$params['vads_site_id'] 		= $site_id;
										$params['vads_currency'] 		= $currency;
										$params['vads_amount'] 			= $mttc;
										$params['vads_cust_email'] 		= utf8_encode($cust_email);
										$params['vads_payment_cards'] 	= $payment_cards;
										$params['vads_order_id'] 		= $id_cmd;
										$params['vads_version'] 		= $vads_version;
										$params['vads_theme_config']	= $theme_config;
										$params['vads_trans_date'] 		= $dthr;
										$params['vads_trans_id'] 		= $trans_id;
										$params['vads_payment_config'] 	= $payment_config;
										$params['vads_page_action'] 	= $page_action;
										$params['vads_ctx_mode'] 		= $ctx_mode;
										$params['vads_action_mode'] 	= $action_mode;


										$signature 		= get_Signature($params, $PROD_key);
										?>
                                        
                                        <p class="corps12px">Merci de choisir votre moyen de paiement afin de régler la somme de <span class="bordeau gras"><?php echo $totalttc; ?> € TTC</span></p>
                                        
                                        <div id="form33"></div>
                                        
                                        <div id="fond-paiement">
                                            
                                            <div class="colonne">
                                                <form method="POST" action="https://clicandpay.groupecdn.fr/vads-payment/">
													<input type="hidden" name="vads_site_id"		value="<?php echo $site_id;?>" />
													<input type="hidden" name="vads_currency"		value="<?php echo $currency; ?>" />
													<input type="hidden" name="vads_amount"			value="<?php echo $mttc; ?>" >
													<input type="hidden" name="vads_cust_email"		value="<?php echo utf8_encode($cust_email); ?>" />
													<input type="hidden" name="vads_payment_cards"	value="<?php echo $payment_cards; ?>" />
													<input type="hidden" name="vads_order_id"		value="<?php echo $id_cmd; ?>">
													<input type="hidden" name="vads_version" 		value="<?php echo $vads_version; ?>" />
													<input type="hidden" name="vads_theme_config"	value="<?php echo $theme_config; ?>" />
													<input type="hidden" name="vads_trans_date" 	value="<?php echo $dthr; ?>" />
													<input type="hidden" name="vads_trans_id" 		value="<?php echo $trans_id; ?>" />
													<input type="hidden" name="vads_payment_config" value="<?php echo $payment_config; ?>" />
													<input type="hidden" name="vads_page_action" 	value="<?php echo $page_action; ?>" />
													<input type="hidden" name="vads_ctx_mode" 		value="<?php echo $ctx_mode; ?>" />
													<input type="hidden" name="vads_action_mode" 	value="<?php echo $action_mode; ?>" />
													<input type="hidden" name="signature" 			value="<?php echo $signature; ?>"/>
													<input type="submit" name="payer" value="Payer" class="btn btn-success"/>
												</form>
                                                <br />En ligne par carte bancaire - Visa, Mastercard, etc...                                
                                            </div>
                                        </div>
                                        <div id="partenaire-paiement">
                                            <p><img src="images/cadenas.png" alt="Avec notre partenaire CIC paiement en ligne sécurisé" title="Avec notre partenaire CIC paiement en ligne sécurisé" /> Avec notre partenaire CIC paiement en ligne sécurisé</p>
                                        </div>
                                        
                                        <?php
										
									}else{
										// Soit Compte
								
										$cust_name 		= ($_SESSION['facturation']['civilite']." ".$_SESSION['facturation']['prenom']." ".$_SESSION['facturation']['nom']);
										$cust_address 	= ($_SESSION['facturation']['adr1']);
										$cust_zip 		= ($_SESSION['facturation']['cp']);
										$cust_city 		= ($_SESSION['facturation']['ville']);
										$cust_country 	= ($_SESSION['facturation']['pays']);
										$cust_phone 	= ($_SESSION['facturation']['portable']);
										$cust_email 	= ($_SESSION['livraison']['emel']);
										$cust_ses_id	= session_id();
										$cust_ip_adr	= $_SERVER['REMOTE_ADDR'];
										$id_client		= $id_cmd;
										
										$mttc 			= str_replace(".", "", $mttc);// le montant transmis à la banque doit être en centime
										?>
										
										<p class="corps12px">Montant de votre commande en compte :  <span class="bordeau gras"><?php echo $totalttc; ?> € TTC</span></p>
										
										
										
										<div id="fond-paiement">
											<div class="colonne">
												<a href="feraud-commande-peinture-paiement-compte-pro-client" class="noir" ><img src="images/en-compte.jpg" alt="A la livraison" title="Paiement à la livraison" /><br />Cliquez ici pour valider votre commande "Professionnel" en compte chez nous</a>
											</div>
										</div>
		
										<div id="form33"></div>
										<?php
									
									
									
									}
									
									
									
                                
                                
                                
                                
                                
                                
                                }
                                
                            }else{
                                echo "<p class=\"rouge\">Le montant de la commande doit être supérieur à 0, paiement impossible !</p>";
                            } // Fin totalttc
                            
                        } // Fin nb_article
                        
                    } // Fin creation panier
                    
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
