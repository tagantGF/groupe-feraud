<?php
	//------------------------------------------------------------
	// PAGE DE RETOUR "TRAITEMENT" PAIEMENT CB
	//------------------------------------------------------------
	// ini_set('display_errors',1);
	ini_set('default_charset', 'UTF-8');
	// $charset = "ISO-8859-15";

	require_once '../includes/fonctionsqli.php';
	require_once '../includes/panier.php';
	require_once '../banque/function.php';
	require("../includes/phpmailer/class.phpmailer.php");
	define("EURO",chr(128));

	

	$lien = connexionBDD();
	$lien -> set_charset("utf8");
	// mysqli_set_charset($lien, "latin1");

	// Lecture des paramètres adresse
	$lect_adr = "SELECT noment, ids, adresse, cp, ville, tel, fax, emel FROM illi21_paramsite WHERE ids = '1'";
	$res_adr_ = mysqli_query($lien,$lect_adr);
	$lect_adr_ = mysqli_fetch_object($res_adr_);  

	// lecture des taux de tva
	$lect_tva = "SELECT * FROM illi21_tva;";
	$res_lect_tva = mysqli_query($lien,$lect_tva) or die ("Erreur lecture tva");

	while($latva =  mysqli_fetch_object($res_lect_tva))
	{
		$tauxtva["$latva->id_tva"] = $latva->taux_tva;	
	}

	if (empty ($_POST))
	{
		echo 'POST is empty';
	}else{
		echo 'Data Received ';
		if (isset($_POST['vads_hash']))
		{
			echo 'Form API notification detected';
			
			// boucle pour récupérer la totalité des champs en retour
			$params			= array();
			foreach ($_POST as $cle=>$valeur) 
			{
				$params[$cle] = $valeur;
			}
			//Signature computation		
			$TEST_key 		= utf8_encode("Pav6Je8V1ImpSaqN");
			$PROD_key 		= utf8_encode("dhv9CSZegwOSXT6N");
			
			$sign 		= get_Signature($params, $PROD_key);
			
			if ($_POST['signature'] == $sign){
						
				// Clé exacte, on récupère le numéro de commande 
				// et l'état du paiement
				
				$vads_trans_status = $params['vads_trans_status']; // Etat du paiement
				$id_cmd = $params['vads_order_id']; // Id de commande
				
				switch ($_REQUEST['vads_trans_status']) 
				{
					
					case "AUTHORISED":
						// Met à jour le mode de paiement
						// Met à jour le mode de paiement
						$upd_cmd 		= "update illi21_commandes set c_type_paiement = 'CB', c_paiement = '1' where id_commande = '$id_cmd' limit 1 ;";
						$res_upd_cmd 	= mysqli_query($lien, $upd_cmd) or die ("Erreur maj commande");

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



						// La commande
						$lect_cmd 		= "SELECT * FROM illi21_commandes where id_commande = '$id_cmd' limit 1 ;";
						$res_lect_cmd 	= mysqli_query($lien,$lect_cmd) or die ("Erreur lecture commande");
						$lacommande 	= mysqli_fetch_object($res_lect_cmd);

						$dt 			= date('Y-m-d');
						$dtcmd			= substr($dt,8,2)."/".substr($dt,5,2)."/".substr($dt,0,4);
						$hr 			= $lacommande->c_heure;
						$total          = $lacommande->c_total;
						$port			= $lacommande->c_fdp;
						$code_promo		= $lacommande->c_code;
						$cpromo			= $lacommande->c_codpro;

						$reduc			= $lacommande->c_reduc;
						// $reducht 		= number_format($reduc * ((100 + $tauxtva[1] ) /100), 2, '.', '');
						$reducht 		= $reduc;

						$promoreduc		= $lacommande->c_promo;
						$c_pourc		= $lacommande->c_pourc;
						$commentaire	= $lacommande->c_comtr;


						$nouvtotalht = number_format($total / ( (100 + $tauxtva[1]) / 100 ), 2, '.', '');
						$nouvtotal2 = $nouvtotalht-$port;

						if ($code_promo <> "") 
						{
							$codepromo = "CODE PROMO : ".$code_promo;
						}

						$ipclient 		= $lacommande->c_ip;

						$l_civi			= $lacommande->l_civilite;
						$l_nom			= utf8_decode($lacommande->l_nom);
						$l_prenom		= utf8_decode($lacommande->l_prenom);
						$l_adresse		= utf8_decode($lacommande->l_adr1);
						$l_cp			= $lacommande->l_cp;
						$l_ville		= utf8_decode($lacommande->l_ville);
						$l_societe		= utf8_decode($lacommande->l_soc);
						$l_tel			= $lacommande->l_telephone;
						$emeil 			= $lacommande->l_mel;

						$f_civi			= $lacommande->f_civilite;
						$f_nom			= utf8_decode($lacommande->f_nom);
						$f_prenom		= utf8_decode($lacommande->f_prenom);
						$f_adresse		= utf8_decode($lacommande->f_adr1);
						$f_cp			= $lacommande->f_cp;
						$f_ville		= utf8_decode($lacommande->f_ville);
						$f_societe		= utf8_decode($lacommande->f_soc);
						$f_tel			= $lacommande->f_tel;

						$compte = $l_civi." ".$l_prenom." ".$l_nom;

						// l'adresse mail de receptionnaire de la commande
						// $mail  = 'b.bour@declic-communication.fr';
						$mail  = $emeil;

						$entete  = "MIME-Version: 1.0\r\n";
						$entete .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$entete .= "From: ".$lect_adr_->noment."<".$lect_adr_->emel.">\r\n";
						$entete .= "Reply-To: $mail\r\n";
						$entete .= "Bcc: automate@declic-communication.com\r\n";
						$entete .= "Bcc: feraud.color@groupe-feraud.com\r\n";

						$sujet = "Site internet Feraud Color - Votre commande";

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
						$message1 .= "Merci pour votre commande r&eacute;gl&eacute;e par CB.<br><br><br><br><br>";
						$message1 .= "----------------------<br>";
						$message1 .= "Votre adresse mail : ".stripslashes($emeil)."<br><br>";
						$message1 .= "----------------------<br>";
						$message1 .= "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
						$message1 .= "<tr><td><table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
						$message1 .= "<tr><td width=\"200px\"><img src=\"https://feraud-color.fr/images/logo-feraud-color.png\" width=\"140\" height=\"50\" /></td>\r\n";
						$message1 .= "<td align=\"center\" ><table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">\r\n";
						$message1 .= "<tr><td width=\"300px\">&nbsp;</td><td width=\"300px\">".$f_societe."<br>".$f_civi." ".$f_prenom." ".$f_nom."<br>".$f_adresse."<br>".$f_cp." ".$f_ville."</td></tr>\r\n";
						$message1 .= "<tr><td align=\"center\" colspan=\"2\">&nbsp;</td></tr><tr>\r\n";
						$message1 .= "<td align=\"center\" colspan=\"2\" style=\"font-size:18px; font-weight:bold\">Commande n&deg; ".$newcmdaff."-".$anneecmd." du ".$dtcmd.".</td></tr></table></td></tr></table></td></tr>\r\n";
						$message1 .= "<tr><td>\r\n";
						$message1 .= "<table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:left; border:1px grey solid;\">\r\n";

						$message1 .= "<tr style=\"background-color:#b32c88; color:#FFFFFF; font-size:12px; font-weight:bold\">\r\n";
						$message1 .= "<td width=\"20px\" height=\"24px\">&nbsp;</td>\r\n";
						$message1 .= "<td width=\"130px\">Couleur</td>\r\n";
						$message1 .= "<td width=\"100px\">Support</td>\r\n";
						$message1 .= "<td width=\"100px\">Nuancier</td>\r\n";
						$message1 .= "<td width=\"80px\">Brillance</td>\r\n";
						$message1 .= "<td width=\"150px\">Contenant</td>\r\n";
						$message1 .= "<td width=\"100px\" align=\"center\">Quantit&eacute;</td>\r\n";
						$message1 .= "<td width=\"100px\" align=\"center\">Prix Unitaire</td>\r\n";
						$message1 .= "<td width=\"120px\" align=\"center\">Total</td>\r\n";
						$message1 .= "<td width=\"10px\">&nbsp;</td></tr>\r\n";

						// Sous Total HT
						$message4 .= "<tr style=\"background-color:#cccccc; color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Sous-Total HT de la commande</strong></td><td></td><td align=\"center\">".number_format($nouvtotal2 + $reducht , 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";

						// Suite REDUC code promo
						if($promoreduc < 0)
						{

							 $message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Montant HT de votre r&eacute;duction \"Code Promo\"</strong></td><td></td><td align=\"center\">".number_format($promoreduc, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";

						}

						if($reducht > 0 and ($reducht <> ($promoreduc * -1)))
						{

							 $message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Montant HT de votre r&eacute;duction \"Client Feraud\"</strong></td><td></td><td align=\"center\">-".number_format($reducht+$promoreduc, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";

						}

						// Suite port pour mail
						$message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Participation aux frais de port de matières dangereuses et d'emballage</strong></td><td></td><td align=\"center\">".number_format($port, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";

						// Total HT
						$message4 .= "<tr style=\"background-color:#cccccc; color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>Total HT de la commande</strong></td><td></td><td align=\"center\">".number_format($nouvtotal2 + $port, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";

						// TVA
						$message4 .= "<tr style=\"color:#000\"><td height=\"24px\" >&nbsp;</td><td colspan=\"6\"><strong>T.V.A. 20%</strong></td><td></td><td align=\"center\">".number_format(($total - $nouvtotal2 - $port), 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";


						// Suite prix pour mail
						$message4 .= "<tr style=\"background-color:#cccccc; color:#000\"><td height=\"24px\" >&nbsp;</td><td><strong>Total TTC</strong></td><td></td><td></td><td></td><td></td><td></td><td></td><td align=\"center\">".number_format($total, 2, '.', '')." &euro;</td><td width=\"10px\">&nbsp;</td></tr>\r\n";




						// recap adresse livraison
						$txtfacturation = "";
						if($f_societe <> "") $txtfacturation .= $f_societe."<br>";
						$txtfacturation .= $f_civi." ".$f_prenom." ".$f_nom."<br>";
						if($f_adresse <> "") $txtfacturation .=  $f_adresse."<br>";
						$txtfacturation .= $f_cp." ".$f_ville."<br>";
						$txtfacturation .= $f_tel;

						$txtlivraison = "";
						if($l_societe <> "") $txtlivraison .= $l_societe."<br>";
						$txtlivraison .= $l_civi." ".$l_prenom." ".$l_nom."<br>";
						if($l_adresse <> "") $txtlivraison .=  $l_adresse."<br>";
						$txtlivraison .=  $l_cp." ".$l_ville."<br>";
						$txtlivraison .=  $l_tel;


						$message5 .= "<tr><td colspan=\"10\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;border:1px grey solid;\">\r\n";
						$message5 .= "<tr style=\"background-color:#b32c88; color:#FFFFFF; font-size:12px; font-weight:bold\"><td width=\"10px\">&nbsp;</td>\r\n";
						$message5 .= "<td width=\"260px\" align=\"center\" height=\"24px\">Adresse de livraison</td>\r\n";
						$message5 .= "<td width=\"260px\" align=\"center\" >Commentaire</td>\r\n";
						$message5 .= "<td width=\"10px\">&nbsp;</td></tr><tr style=\"background-color:#fff; color:#000; font-size:12px; font-weight:normal\">\r\n";
						$message5 .= "<td width=\"10px\">&nbsp;</td><td width=\"260px\" align=\"left\">".$txtlivraison."<br><b>".$codepromo."</b></td><td width=\"260px\" align=\"left\">".utf8_decode(stripslashes($commentaire))."</td><td width=\"10px\">&nbsp;</td>\r\n";
						$message5 .= "</tr></table></td></tr>\r\n";



						// Bas de page et fin de fichier
						$message6 .= "<tr><td colspan=\"10\"><table width=\"900\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal;\">\r\n";
						$message6 .= "<tr align=\"center\"><td>".$lect_adr_->noment." | ".$lect_adr_->adresse." | ".$lect_adr_->cp." ".$lect_adr_->ville." | T&eacute;l. : ".$lect_adr_->tel." | Email : <U><a href=\"mailto:".$lect_adr_->emel."\">".$lect_adr_->emel."</a></U>&nbsp;| <a href=\"https://feraud-color.fr\">feraud-color.fr</a></td></tr><tr align=\"center\"><td>SAS au capital de 39 255,62 Euros | SIRET 558 502 829 00036| APE 4673A| N&deg; intracommunautaire FR48 558 502 829</td></tr></table>\r\n";
						$message6 .= "</td></tr></table></td></tr></table></body></html>\r\n";



						// ENREGISTRE LE DETAIL DE LA COMMANDE dans le mail
						// Le detail commande

						$lect_det_cmd 		= "SELECT * FROM illi21_commandes_detail where d_commande = '$id_cmd' ;";
						$res_lect_det_cmd	= mysqli_query($lien,$lect_det_cmd) or die ("Erreur lecture detail commande");
						$nb_article 		= mysqli_num_rows($res_lect_det_cmd);
						$res_lect_det_cmd	= mysqli_query($lien,$lect_det_cmd) or die ("Erreur lecture detail commande");


						if($nb_article > 0)
						{

							$compteur=1;
							$i=0;
							$message3 = "";

							$centrer = "text-align:center";

							while($ligne_cmd = mysqli_fetch_object($res_lect_det_cmd))
							{	 
								if($compteur%2)
										$class = 'height:34px;	background:#f7f7f6;';
									else
										$class = 'height:34px;	background:#ebebec;';

								if($ligne_cmd->d_produit <> "")
								{
									// boutique produit
									$message3 .="<tr style=\"".$class."\">\r\n";
										$message3 .="<td >&nbsp;</td>\r\n";
										$message3 .="<td colspan=\"5\">".utf8_decode($ligne_cmd->d_produit)."</td>\r\n";
										$message3 .="<td style=".$centrer.">".$ligne_cmd->d_quantite."</td>\r\n";
										$message3 .="<td style=".$centrer.">".$ligne_cmd->d_prix_unit." &euro;  </td>\r\n";
										$message3 .="<td style=".$centrer.">".$ligne_cmd->d_prix_total." &euro;"."</td>\r\n";
										$message3 .="<td width=\"10px\">&nbsp;</td>\r\n";
									$message3 .="</tr>\r\n";
								}else{	

									// Le support
									$requet_ = "SELECT id_s as id, sup_nom as nom FROM illi21_support where id_s = '".$ligne_cmd->d_support."'";
									// echo $requet_;
									$resultat_		= mysqli_query($lien, $requet_);
									$row_cnt_s		= mysqli_num_rows($resultat_);
									if($row_cnt_s > 0)
									{
										$lect_res_    = mysqli_fetch_object($resultat_); 
										$lesupport    = "&nbsp;".utf8_decode($lect_res_->nom);
									}else{
										$lesupport    = "";
									}


									// Le nuancier
									$requet_ = "SELECT id_n as id, nunom as nom FROM illi21_nuancier where id_n = '".$ligne_cmd->d_nuancier."'";
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
									$requet_ = "SELECT id_c as id, cont_nom as nom FROM illi21_contenant where id_c = '".$ligne_cmd->d_contenant."'";
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



									$message3 .="<tr style=\"".$class."\">\r\n";
									if($ligne_cmd->d_nuancier == '99')
									{
										$message3 .="<td style=\"border-bottom:1px #FFFFFF solid;\">".$ligne_cmd->d_nom_couleur."</td>\r\n";
									}else{
										$message3 .="<td style=\"background:".$ligne_cmd->d_nom_couleur."; border-bottom:1px #FFFFFF solid;\">&nbsp;</td>\r\n";
									}

									$message3 .="<td>".$ligne_cmd->d_rf_couleur."</td>\r\n";
									$message3 .="<td>".$lesupport."</td>\r\n";
									$message3 .="<td>".$lenuancier."</span></td>\r\n";
									$message3 .="<td>".utf8_decode($ligne_cmd->d_brillance)."</span></td>\r\n";
									$message3 .="<td>".$lecontenant."</span></td>\r\n";
									$message3 .="<td style=".$centrer.">".$ligne_cmd->d_quantite."</td>\r\n";
									$message3 .="<td style=".$centrer.">".$ligne_cmd->d_prix_unit." &euro;  </td>\r\n";
									$message3 .="<td style=".$centrer.">".$ligne_cmd->d_prix_total." &euro;"."</td>\r\n";
									$message3 .="<td width=\"10px\">&nbsp;</td>\r\n";
									$message3 .="</tr>\r\n";
								}
								$compteur++;
							}


							$message = $message0." ".$message1." ".$message3." ".$message4." ".$message5." ".$message6;
							
							mail($mail, $sujet, $message, $entete);
							unset($_SESSION['panierfer']);
							unset($_SESSION['facturation']);
							unset($_SESSION['livraison']);
						}

						break;
						
					case "ABANDONED":
						unset($_SESSION['panierfer']);
						break;
						
					case "CAPTURED":
						unset($_SESSION['panierfer']);
						break;
					
					case "ACCEPTED":
						unset($_SESSION['panierfer']);
						break;
						
					case "AUTHORISED_TO_VALIDATE":
						unset($_SESSION['panierfer']);
						break;
						
					case "CANCELLED":
						unset($_SESSION['panierfer']);
						break;
						
					case "CAPTURE_FAILED":
						unset($_SESSION['panierfer']);
						break;
						
					case "EXPIRED":
						unset($_SESSION['panierfer']);
						break;
						
					case "REFUSED":
						unset($_SESSION['panierfer']);
						break;
						
					case "SUSPENDED":
						unset($_SESSION['panierfer']);
						break;
						
					case "UNDER_VERIFICATION":
						unset($_SESSION['panierfer']);
						break;
						
					case "WAITING_AUTHORISATION":
						unset($_SESSION['panierfer']);
						break;
						
					case "WAITING_AUTHORISATION_TO_VALIDATE":
						unset($_SESSION['panierfer']);
						break;
				}
				
				// errlogtxt("OK");
				

			}else{
				// errlogtxt("PAS OK");
				// errlogtxt("Recue :");
				// errlogtxt($_POST['signature']);
				// errlogtxt("Calculee :");
				// errlogtxt($sign);
			}
			//Signature verification		
			//Order Update
		} 
	}

	//echo $tauxtva[1];


	deconnexionBDD($lien);

?>
