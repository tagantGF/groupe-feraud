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
	
	$message3 = "";
	
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
            	<div id="mon-panier">
                    <div class="titrebgrouge">Paiement compte client</div>
                    
                    <div id="compte-illi">
                    <?php
                    if(creationPanier())
                    {
                        $nb_article = count($_SESSION['panierfer']['identifiant']);
                        if ($nb_article <= 0)
                        {
                            ?>
                            <p>Votre panier est vide</p>
                            <?php	
                        }else{
                    
                    
                            $cust_name 		= ($_SESSION['facturation']['civilite']." ".$_SESSION['facturation']['prenom']." ".$_SESSION['facturation']['nom']);
                            $cust_address 	= ($_SESSION['facturation']['adr1']);
                            $cust_zip 		= ($_SESSION['facturation']['cp']);
                            $cust_city 		= ($_SESSION['facturation']['ville']);
                            $cust_country 	= ($_SESSION['facturation']['pays']);
                            $cust_phone 	= ($_SESSION['facturation']['portable']);
                            $cust_email 	= ($_SESSION['livraison']['emel']);
                            
							$mt_reduc		= $_SESSION['panierfer']['mttcreduc']; // Reduc avec code 							
							
                            
                            $port			= $_SESSION['panierfer']['fraisdePort'];
							
							$nouvtotal2 	= $_SESSION['panierfer']['montantTotal'];
                            $nouvtotalht	= number_format($nouvtotal2, 2, '.', '');
							
							
							
							$reduc			= $_SESSION['panierfer']['c_reduc_ht']; // Reduc totale (code + Feraud)
							$reducht 		= $reduc + $mt_reduc;
							
							
							
							$c_pourc		= $_SESSION['panierfer']['c_pourc'];
							
							$nouvtotal3		= number_format(($nouvtotalht), 2, '.', '');
							
							$c_codep		=	@mysqli_real_escape_string($lien,$_SESSION['panierfer']['code']);
                            
							$total          = ($nouvtotal3+$port+$mt_reduc-$reducht) * 1.20;
							
							
							$totalht		= $nouvtotal3+$port+$mt_reduc-$reducht;
							$totalttc		= $total;
							$mttva			= $totalttc - $totalht;
                
                            // Récupère la commande, on prépare le mail et on envoie le mail
                            $id_cmd = 	$_SESSION['panierfer']['numcom'];
                            $dt 			= date('Y-m-d');
                            $dtcmd			= substr($dt,8,2)."/".substr($dt,5,2)."/".substr($dt,0,4);
                            
                            // Met à jour le mode de paiement
                            $upd_cmd 		= "update illi21_commandes set c_type_paiement = 'Pro_en_cpt', c_paiement = '1' where id_commande = '$id_cmd' limit 1 ;";
                            $res_upd_cmd 	= mysqli_query($lien,$upd_cmd) or die ("Erreur maj commande");
                            
                            // recupère le numero de commande et l annee en cours
                            $requetecmd = "select numcmd from illi21_numcmd";
                            $res_requetecmd = @mysqli_query($lien,$requetecmd)  or die ("Erreur de lecture base de données");;
                            $oldcmd = @mysqli_fetch_object($res_requetecmd);
                            
                            $newcmd = $oldcmd->numcmd + 1;
                            $newcmdaff = str_pad($newcmd, 6, '0', STR_PAD_LEFT);
                            $anneecmd = date('Y');
                            
                            $upd_numcmd 		= "update illi21_numcmd set numcmd = '$newcmd' limit 1 ;";
                            $res_upd_numcmd 	= mysqli_query($lien,$upd_numcmd) or die ("Erreur maj num commande");
                            
                            // Met à jour la cmd avec le numero de cmde
                            $upd_cmd 		= "update illi21_commandes set numcom = $newcmd where id_commande = '$id_cmd' limit 1 ;";
                            $res_upd_cmd 	= mysqli_query($lien,$upd_cmd) or die ("Erreur maj commande");
        
        
                            // Your code here to handle a successful verification
                            $compte 		= securiseFormulaire($_SESSION['livraison']['societe']);
                            $emeil 			= securiseFormulaire($_SESSION['livraison']['emel']);
                            $commentaire	= securiseFormulaire($_SESSION['livraison']['commentaire']);
                            $c_codpro		= securiseFormulaire($_SESSION['livraison']['code_p']);
                            $codepromo		= "";
                            if ($c_codep <> "") 
                                {
                                    $codepromo = "CODE PROMO : ".$c_codep;
                                }
                            // $mail  = "b.bour@declic2.net";
                            $mail  = $cust_email;
        
                            $l_civi			= ($_SESSION['livraison']['prenom']);
                            $l_nom			= ($_SESSION['livraison']['nom']);
                            $l_prenom		= ($_SESSION['livraison']['prenom']);
                            $l_adresse		= ($_SESSION['livraison']['adr1']);
                            $l_cp			= ($_SESSION['livraison']['cp']);
                            $l_ville		= ($_SESSION['livraison']['ville']);
                            $l_societe		= ($_SESSION['livraison']['societe']);
                            $l_tel			= ($_SESSION['livraison']['portable']);
                            
                            $f_civi			= ($_SESSION['facturation']['civilite']);
                            $f_nom			= ($_SESSION['facturation']['nom']);
                            $f_prenom		= ($_SESSION['facturation']['prenom']);
                            $f_adresse		= $cust_address;
                            $f_cp			= $cust_zip;
                            $f_ville		= $cust_city;
                            $f_societe		= ($_SESSION['facturation']['societe']);
                            $f_tel			= $cust_phone;
                            
                            $entete  = "MIME-Version: 1.0\r\n";
                            $entete .= "Content-type: text/html; charset=iso-8859-1\r\n";
                            $entete .= "From: ".$lect_adr_->noment."<".$lect_adr_->emel.">\r\n";
                            $entete .= "Reply-To: $mail\r\n";
                            $entete .= "Bcc: automate@declic-communication.com\r\n";
                            // *********************************************** //
							$entete .= "Bcc: feraud.color@groupe-feraud.com\r\n"; 
							// *********************************************** //
                            
                            $sujet = "Site internet Feraud Color - Commande en compte";
                            
                            // PREPARE LE contenu du mail
                            // charge le message au format html
                            
                            // ENTETE + ligne logo
                            $txtfacturation = "";
                            if($f_societe <> "") $txtfacturation .= $f_societe."<br>";
                            $txtfacturation .= $f_civi." ".$f_prenom." ".$f_nom."<br>";
                            if($f_adresse <> "") $txtfacturation .=  $f_adresse."<br>";
                            $txtfacturation .= $f_cp." ".$f_ville;
                            $txtfacturation = stripslashes($txtfacturation);
                            
                            $message0  = $message1 = $message4 = $message5 = $message6 = "";
                            $message1 .= "<html xmlns=\"https://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\r\n";
                            $message1 .= "<title>Feraud Color</title></head>\r\n";
                            $message1 .= "<body style=\"font-family:Arial, Helvetica, sans-serif;font-size:12px;\">\r\n";
                            $message1 .= "Bonjour, <br><br>";
                            $message1 .= "Merci pour votre commande r&eacute;gl&eacute;e en compte.<br><br><br><br>";
                            $message1 .= "----------------------<br>";
                            $message1 .= "Adresse mail : ".stripslashes($emeil)."<br><br>";
                            $message1 .= "Compte client : ".stripslashes($compte)."<br>";
                            $message1 .= "----------------------<br>";
                            $message1 .= "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
                            $message1 .= "<tr><td><table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
                            $message1 .= "<tr><td width=\"200px\"><img src=\"https://feraud-color.fr/images/logo-feraud-color.png\" width=\"140\" height=\"50\" /></td>\r\n";
                            $message1 .= "<td align=\"center\" ><table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
                            $message1 .= "<tr><td width=\"300px\">&nbsp;</td><td width=\"300px\"><br>".$f_civi." ".$f_prenom." ".$f_nom."<br>".$f_adresse."<br>".$f_cp." ".$f_ville."</td></tr>\r\n";
                            $message1 .= "<tr><td align=\"center\" colspan=\"2\">&nbsp;</td></tr><tr>\r\n";
                            $message1 .= "<td align=\"center\" colspan=\"2\" style=\"font-size:18px; font-weight:bold\">Commande n&deg; ".$newcmdaff."-".$anneecmd." du ".$dtcmd.".</td></tr></table></td></tr></table></td></tr>\r\n";
                            $message1 .= "<tr><td>\r\n";
                            $message1 .= "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; border:1px grey solid;\">\r\n";
                            
                            $message1 .= "<tr style=\"background-color:#b32c88; color:#FFFFFF; font-size:12px; font-weight:bold\">\r\n";
                            $message1 .= "<td width=\"20px\" height=\"24px\">&nbsp;</td>\r\n";
                            $message1 .= "<td width=\"80px\">Couleur</td>\r\n";
                            $message1 .= "<td width=\"100px\">Support</td>\r\n";
                            $message1 .= "<td width=\"100px\">Nuancier</td>\r\n";
                            $message1 .= "<td width=\"80px\">Brillance</td>\r\n";
                            $message1 .= "<td width=\"200px\">Contenant</td>\r\n";
                            $message1 .= "<td width=\"100px\" align=\"center\">Quantit&eacute;</td>\r\n";
                            $message1 .= "<td width=\"100px\" align=\"center\">Prix Unitaire</td>\r\n";
                            $message1 .= "<td width=\"120px\" align=\"center\">Total</td>\r\n";
                            $message1 .= "<td width=\"10px\">&nbsp;</td></tr>\r\n";
                            
							// Sous-Total HT
							$message4 .= "<tr style=\"background-color:#cccccc; color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Sous-Total HT de la commande</strong></td><td></td><td align=\"center\">".number_format($nouvtotal3, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
							
							
							// CODE PROMO
                            if($mt_reduc < 0)
							{
								
                                 $message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Montant HT de votre r&eacute;duction \"Code Promo\"</strong></td><td></td><td align=\"center\">".number_format($mt_reduc, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
								
							}
							// REDUC Feraud
                            if($reducht > 0)
							{
								
                                 $message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Montant HT de votre r&eacute;duction \"Client Feraud\"</strong></td><td></td><td align=\"center\">-".number_format($reducht, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
								
							}
                            
                            // Suite port pour mail
                            $message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Participation aux frais de port de mati&egrave;res dangereuses et d'emballage</strong></td><td></td><td align=\"center\">".number_format($port, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
							
							
							// Sous total HT
							// Suite prix pour mail
                            $message4 .= "<tr style=\"background-color:#cccccc; color:#000\"><td height=\"24px\" >&nbsp;</td><td><strong>Total HT</strong></td><td></td><td></td><td></td><td></td><td></td><td></td><td align=\"center\">".number_format($totalht, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
							
							//TVA
							$message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>T.V.A. 20%</strong></td><td></td><td align=\"center\">".number_format($mttva , 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
                            
                            // Suite prix pour mail
                            $message4 .= "<tr style=\"background-color:#cccccc; color:#000\"><td height=\"24px\" >&nbsp;</td><td><strong>Total TTC</strong></td><td></td><td></td><td></td><td></td><td></td><td></td><td align=\"center\">".number_format($totalttc, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";
                            
                            
                            
                            
                            // recap adresse livraison
                            $txtfacturation = "";
                            if($l_societe <> "") $txtfacturation .= "Compte : ".$l_societe."<br>";
                            if($cust_email <> "") $txtfacturation .=  "Adresse mail : ".$cust_email."<br>";
                            
                            
                            
                            
                            
                            $message5 .= "<tr><td colspan=\"10\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;border:1px grey solid;\">\r\n";
                            $message5 .= "<tr style=\"background-color:#b32c88; color:#FFFFFF; font-size:12px; font-weight:bold\"><td width=\"10px\">&nbsp;</td>\r\n";
                            $message5 .= "<td width=\"260px\" align=\"center\" height=\"24px\">Compte</td>\r\n";
                            $message5 .= "<td width=\"260px\" align=\"center\" >Commentaire</td>\r\n";
                            $message5 .= "<td width=\"10px\">&nbsp;</td></tr><tr style=\"background-color:#fff; color:#000; font-size:12px; font-weight:normal\">\r\n";
                            $message5 .= "<td width=\"10px\">&nbsp;</td><td width=\"260px\" align=\"left\">".$txtfacturation."<br><b>".$codepromo."</b></td><td width=\"260px\" align=\"left\">".utf8_decode(stripslashes($commentaire))."</td><td width=\"10px\">&nbsp;</td>\r\n";
                            $message5 .= "</tr></table></td></tr>\r\n";
                            
                            
                            
                            // Bas de page et fin de fichier
                            $message6 .= "<tr><td colspan=\"10\"><table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal;\">\r\n";
                            $message6 .= "<tr align=\"center\"><td>".$lect_adr_->noment." | ".$lect_adr_->adresse." | ".$lect_adr_->cp." ".$lect_adr_->ville." | T&eacute;l. : ".$lect_adr_->tel." | Email : <U><a href=\"mailto:".$lect_adr_->emel."\">".$lect_adr_->emel."</a></U>&nbsp;| <a href=\"https://feraud-color.fr\">feraud-color.fr</a></td></tr><tr align=\"center\"><td>SAS au capital de 39 255,62 Euros | SIRET 558 502 829 00036| APE 4673A| N&deg; intracommunautaire FR48 558 502 829</td></tr></table>\r\n";
                            $message6 .= "</td></tr></table></td></tr></table></body></html>\r\n";
            
            
                            
                            // ENREGISTRE LE DETAIL DE LA COMMANDE dans le mail
                            $nb_article 	= count($_SESSION['panierfer']['identifiant']);
                            
                            $compteur=1;
                            $i=0;
                            $message3 = "";
                            for ($i=0; $i<$nb_article; $i++)
                            { 
                                // Le support
                                $requet_ = "SELECT id_s as id, sup_nom as nom FROM illi21_support where id_s = '".$_SESSION['panierfer']['id_support'][$i]."'";
                                // echo $requet_;
                                $resultat_		= mysqli_query($lien, $requet_);
								$row_cnt_s		= mysqli_num_rows($resultat_);
								if($row_cnt_s > 0)
								{
									$lect_res_    = mysqli_fetch_object($resultat_); 
	                                $lesupport    = "&nbsp;".$lect_res_->nom;
								}else{
									$lesupport    = "";
								}
                                
                                
                                // Le nuancier
                                $requet_ = "SELECT id_n as id, nunom as nom FROM illi21_nuancier where id_n = '".$_SESSION['panierfer']['id_nuancier'][$i]."'";
                                // echo $requet_;
                                $resultat_    = mysqli_query($lien, $requet_);
								$row_cnt_n		= mysqli_num_rows($resultat_);
								if($row_cnt_n > 0)
								{
									$lect_res_    = mysqli_fetch_object($resultat_); 
                                	$lenuancier   = "&nbsp;".$lect_res_->nom;
								}else{
									$lenuancier    = "";
								}
                                
                                
                                // Le contenant
                                $requet_ = "SELECT id_c as id, cont_nom as nom FROM illi21_contenant where id_c = '".$_SESSION['panierfer']['id_contenant'][$i]."'";
                                // echo $requet_;
                                $resultat_    = mysqli_query($lien, $requet_);
								$row_cnt_c		= mysqli_num_rows($resultat_);
								if($row_cnt_c > 0)
								{
									$lect_res_    = mysqli_fetch_object($resultat_); 
                                	$lecontenant   = "&nbsp;".$lect_res_->nom;
								}else{
									$lecontenant    = "";
								}
                                
								
								
								
                                
                                $leprixunit   = $_SESSION['panierfer']['prixunitaire'][$i];
                                $centrer = "text-align:center";
                                if($compteur%2)
                                    $class = 'height:34px;	background:#f7f7f6;';
                                else
                                    $class = 'height:34px;	background:#ebebec;';
                                    
                                
                                $message3 .="<tr style=\"".$class."\">\r\n";
								
								
								// *********** //
								// Si produits //
								// *********** //
								
								if($_SESSION['panierfer']['nomproduit'][$i] <> "")
									{
									// boutique produit
										$message3 .="<td>&nbsp;</td>\r\n";
										$message3 .="<td colspan=\"5\">".utf8_decode($_SESSION['panierfer']['nomproduit'][$i])."</td>\r\n";
										$message3 .="<td style=".$centrer.">".$_SESSION['panierfer']['nb_pot'][$i]."</td>\r\n";
										$message3 .="<td style=".$centrer.">".$leprixunit." &euro;  </td>\r\n";
										$message3 .="<td style=".$centrer.">".$_SESSION['panierfer']['mttc'][$i]." &euro;"."</td>\r\n";
										$message3 .="<td width=\"10px\">&nbsp;</td>\r\n";
									
									
									}else{
									// boutique peinture
									
		                                if($_SESSION['panierfer']['id_nuancier'][$i] == '99')
										{
											$message3 .="<td style=\"border-bottom:1px #FFFFFF solid;\">".$_SESSION['panierfer']['la_couleur'][$i]."</td>\r\n";
										}else{
											$message3 .="<td style=\"background:".$_SESSION['panierfer']['la_couleur'][$i]."; border-bottom:1px #FFFFFF solid;\">&nbsp;</td>\r\n";
										}
										$message3 .="<td>".$_SESSION['panierfer']['rf_couleur'][$i]."</td>\r\n";
										$message3 .="<td>".$lesupport."</td>\r\n";
										$message3 .="<td>".$lenuancier."</span></td>\r\n";
										$message3 .="<td>".utf8_decode($_SESSION['panierfer']['brillance'][$i])."</span></td>\r\n";
										$message3 .="<td>".$lecontenant."</span></td>\r\n";
										$message3 .="<td style=".$centrer.">".$_SESSION['panierfer']['nb_pot'][$i]."</td>\r\n";
										$message3 .="<td style=".$centrer.">".$leprixunit." &euro;  </td>\r\n";
										$message3 .="<td style=".$centrer.">".$_SESSION['panierfer']['mttc'][$i]." &euro;"."</td>\r\n";
										$message3 .="<td width=\"10px\">&nbsp;</td>\r\n";

									
									}
								                                
								
								
								
								$message3 .="</tr>\r\n";
        
                                $compteur++;
                            }
                            
        
        
                            
                    
                            
                            
        
                            $message = $message0." ".$message1." ".$message3." ".$message4." ".$message5." ".$message6;
                            // mail("b.bour@declic2.net", $sujet, $message, $entete);
							if($emeil <> "")
							{
	                            mail($emeil, $sujet, $message, $entete);
								unset($_SESSION['panierfer']);
								unset($_SESSION['facturation']);
								unset($_SESSION['livraison']);
								?>
                                <p class="txt9pt_1gras">Merci, votre commande nous a bien &eacute;t&eacute; transmise.</p>
                                <p>Un mail a &eacute;t&eacute; envoy&eacute; sur l'adresse <?php echo $emeil; ?></p>
                                
                                <p>&nbsp;<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />&nbsp;</p>                    
                                <?php
							}else{
								?>
                                <p class="txt9pt_1gras"></p>
                                
                                <p>&nbsp;<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />&nbsp;</p>                    
                                <?php
							}
                        }
                    }
                    
                    ?>
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

<!-- InstanceBeginEditable name="footer" --><!-- InstanceEndEditable -->

<!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>  


</body>

<!-- InstanceEnd --></html>
