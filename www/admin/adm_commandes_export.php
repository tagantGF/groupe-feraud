<?php
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    ini_set('default_charset', 'UTF-8');
	session_start();
	require_once 'includes/fonctionsqli.php';
	$lien = connexionBDD();
    $lien -> set_charset("utf8");
	if(isset($_POST['identifiantc'])){
		$erreur = verifieAuthentificationClient(securiseFormulaire($_POST['identifiantc']), securiseFormulaire($_POST['motdepassec']));
		// echo "Erreur : ".$erreur; 
	}else{
		$erreur = "";
	}
	
	// ***********************************  excel ********************************//
	
	require_once 'includes/PHPExcel/PHPExcel.php';
	require_once 'includes/PHPExcel/PHPExcel/IOFactory.php';
	require_once 'includes/PHPExcel/PHPExcel/Writer/Excel2007.php';
	
	$workbook = new PHPExcel;
		
	$sheet = $workbook->getActiveSheet();
		
	$styleA1 = $sheet->getStyle("A1:T2");
		
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$styleFont->setSize(8);
	$styleFont->setName('Arial');
	$styleFont->getColor()->setRGB('ffffff');
		
	$styleAlign = $styleA1->getAlignment();
	$styleAlign->setHorizontal('center');
	$styleAlign->setVertical('center');
	$styleAlign->setWrapText(true);
		
	$styleFill = $styleA1->getFill();
	$styleFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$styleFill->getStartColor()->setRGB('0000d4');
		
	$styleBorder = $styleA1->getBorders();
	$styleBorder->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		
	$sheet->mergeCells('A1:A2');
	$sheet->mergeCells('B1:B2');
	$sheet->mergeCells('C1:C2');
	$sheet->mergeCells('D1:D2');
	$sheet->mergeCells('E1:E2');
	$sheet->mergeCells('F1:F2');
	$sheet->mergeCells('G1:G2');
	$sheet->mergeCells('H1:H2');
	$sheet->mergeCells('I1:I2');
	$sheet->mergeCells('J1:J2');
	$sheet->mergeCells('K1:K2');
	$sheet->mergeCells('L1:L2');
	$sheet->mergeCells('M1:M2');
	$sheet->mergeCells('N1:N2');
	$sheet->mergeCells('O1:O2');
	$sheet->mergeCells('P1:P2');
	$sheet->mergeCells('Q1:Q2');
	$sheet->mergeCells('R1:R2');
	$sheet->mergeCells('S1:S2');
	$sheet->mergeCells('T1:T2');
	
		
	$sheet->getColumnDimension('A')->setWidth(10);
	$sheet->getColumnDimension('B')->setWidth(15);
	$sheet->getColumnDimension('C')->setWidth(10);
	$sheet->getColumnDimension('D')->setWidth(15);
	$sheet->getColumnDimension('E')->setWidth(10);
	$sheet->getColumnDimension('F')->setWidth(10);
	$sheet->getColumnDimension('G')->setWidth(10);
	$sheet->getColumnDimension('H')->setWidth(70);
	$sheet->getColumnDimension('I')->setWidth(40);
	$sheet->getColumnDimension('J')->setWidth(20);
	$sheet->getColumnDimension('K')->setWidth(20);
	$sheet->getColumnDimension('L')->setWidth(20);
	$sheet->getColumnDimension('M')->setWidth(20);
	$sheet->getColumnDimension('N')->setWidth(20);
	$sheet->getColumnDimension('O')->setWidth(20);
	$sheet->getColumnDimension('P')->setWidth(10);
	$sheet->getColumnDimension('Q')->setWidth(20);
	$sheet->getColumnDimension('R')->setWidth(25);
	$sheet->getColumnDimension('S')->setWidth(55);
	$sheet->getColumnDimension('T')->setWidth(55);
	
		
	$sheet->setCellValue('A1','N Commande');
	$sheet->setCellValue('B1','Date');
	$sheet->setCellValue('C1','Heure');
	$sheet->setCellValue('D1','Montant total');
	$sheet->setCellValue('E1','Frais de port ');
	$sheet->setCellValue('F1','Réduction');
	$sheet->setCellValue('G1','Type de paiement');
	$sheet->setCellValue('H1','Client');
	$sheet->setCellValue('I1','Mail');
	$sheet->setCellValue('J1','Detail commande : ');
	$sheet->setCellValue('K1','- Ref');
	$sheet->setCellValue('L1','- Support');
	$sheet->setCellValue('M1','- Nuancier');
	$sheet->setCellValue('N1','- Aspect');
	$sheet->setCellValue('O1','- Contenant');
	$sheet->setCellValue('P1','- Qte');
	$sheet->setCellValue('Q1','- Prix unitaire');
	$sheet->setCellValue('R1','- Prix total');
	$sheet->setCellValue('S1','- Commentaire');
	// $sheet->setCellValue('S1','- Code Promo');
	
	$compteur_ligne = 3;
	
	// ********************* fin excel *******************************************//
?>
<!doctype html>
<html lang="fr"><!-- InstanceBegin template="/Templates/modele_admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Backoffice de gestion du site Feraud Color</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="css/back.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-3 text-center mb-5"><a href="index-admin.php"><img src="../images/logo-feraud-color.png" width="50%"></a></div>
        <div class="col-md-9 text-center mb-5"><h2 class="heading-section">GESTION DU SITE FERAUD COLOR</h2></div>
    </div>
    <?php 
            if(isset($_POST['identifiantc'])){
                $erreur = verifieAuthentificationClient(securiseFormulaire($_POST['identifiantc']), securiseFormulaire($_POST['motdepassec']));
                // echo "Erreur : ".$erreur; 
            }else{
                $erreur = "";
            }
            if(estAuthentifieClient())
            {
				$bienvenue	= "Bonjour ".$_SESSION['c_tec_ra']['tonprenom']." ".$_SESSION['c_tec_ra']['tonnom'];
				?>
                <div class="content_container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                        	<div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-list">
                                            </span>Peintures</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_peintures.php">Liste</a>
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-tree-conifer text-primary"></span><a href="adm_supports.php">Supports</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-lock text-primary"></span><a href="adm_contenant.php">Contenants</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-th text-primary"></span><a href="adm_nuanciers.php">Nuanciers</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-euro text-primary"></span><a href="adm_tarifs.php">Tarifs peintures</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-star-empty text-primary"></span><a href="adm_tarifs_pdr.php">Tarifs poudres</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                               
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsproduits"><span class="glyphicon glyphicon-star">
                                            </span>Produits</a>
                                        </h4>
                                    </div>
                                    <div id="collapsproduits" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_produits.php">Liste</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-plus text-primary"></span><a href="adm_produits_ajout.php">Ajout</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-folder-open text-primary"></span><a href="adm_familles.php">Familles</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-inbox text-primary"></span><a href="adm_sous_familles.php">Sous-familles</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapscinq"><span class="glyphicon glyphicon-cloud-download">
                                            </span>Téléchargements</a>
                                        </h4>
                                    </div>
                                    <div id="collapscinq" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_telechargement.php">Liste</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-plus text-primary"></span><a href="adm_telechargement_ajout.php">Ajout</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapssix"><span class="glyphicon glyphicon-sound-stereo">
                                            </span>Slider</a>
                                        </h4>
                                    </div>
                                    <div id="collapssix" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_slider.php">Liste</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-plus text-primary"></span><a href="adm_slider_ajout.php">Ajout</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapssept"><span class="glyphicon glyphicon-plane">
                                            </span>Frais de port</a>
                                        </h4>
                                    </div>
                                    <div id="collapssept" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_ports.php">Modifier</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-euro text-primary"></span><a href="adm_ports_franco.php">Franco</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsneufplus"><span class="glyphicon glyphicon-user">
                                            </span>Client Feraud</a>
                                        </h4>
                                    </div>
                                    <div id="collapsneufplus" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_clients.php">Recherche</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-plus text-primary"></span><a href="adm_clients_ajout.php">Ajout</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-file text-primary"></span><a href="adm_clients_maj.php">Mise à jour fichier</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsneuf"><span class="glyphicon glyphicon-certificate">
                                            </span>Codes Promo</a>
                                        </h4>
                                    </div>
                                    <div id="collapsneuf" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_promos.php">Recherche</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-plus text-primary"></span><a href="adm_promos_ajout.php">Ajout</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsdix"><span class="glyphicon glyphicon-shopping-cart">
                                            </span>Commandes</a>
                                        </h4>
                                    </div>
                                    <div id="collapsdix" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_commandes.php">Liste</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-export text-primary"></span><a href="adm_commandes_export.php">Export</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapstreize"><span class="glyphicon glyphicon-comment">
                                            </span>Blog</a>
                                        </h4>
                                    </div>
                                    <div id="collapstreize" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-search text-primary"></span><a href="adm_blog.php">Liste</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-plus text-primary"></span><a href="adm_blog_ajout.php">Ajout</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsonze"><span class="glyphicon glyphicon-list-alt">
                                            </span>Pages statiques</a>
                                        </h4>
                                    </div>
                                    <div id="collapsonze" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-align-left text-primary"></span><a href="adm-pages.php?page=mentions">Mentions Légales</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-align-left text-primary"></span><a href="adm-pages.php?page=cgv">CGV</a>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsdouze"><span class="glyphicon glyphicon-pencil">
                                            </span>Admin</a>
                                        </h4>
                                    </div>
                                    <div id="collapsdouze" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                
                                                <tr>
                                                    <td>
                                                        <span class="glyphicon glyphicon-off text-danger"></span><a href="adm_deconnexion.php" class="text-danger">Se déconnecter</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 col-md-9">
                          <!-- InstanceBeginEditable name="EditRegion3" -->
						  <?php 
					$rqadd = "";
					$titre = "toutes";
					$toutes = true;
				
				?>


                <h1>Télécharger le fichier des commandes</h1>
    
                            
                            <?php
                                $compteur = 0;
								$lect_cmd = "SELECT * FROM illi21_commandes where c_paiement = '1' ORDER BY c_date DESC, c_heure DESC ".$rqadd." ;";
	
	
								
								
								// echo $lect_cmd;
                                $res_lect_cmd = mysqli_query($lien,$lect_cmd) or die ("Erreur");
                                while($cmd = mysqli_fetch_object($res_lect_cmd)){
                                    
                                    
                                    $datecmd = explode("-", $cmd->c_date);
                                    $total = $cmd->c_total;
                                    $mttotal = str_replace(".", ",", number_format($total, 2, '.', ''));
                                    if($compteur%2)
                                        $bg = '#d1d1d1';
                                    else
                                        $bg = '#e3e3e3';
                                        
                                    
                                        
                                    if($cmd->c_paiement == '1')
                                        $bgvalide = '#1b9200';
                                    else
                                        $bgvalide = '#e10000';
									
                            	?>
                               
                                <?php
								// Export Excel
								$sheet->setCellValue('A'.$compteur_ligne, ($cmd->numcom));
								$sheet->getStyle('A'.$compteur_ligne.':S'.$compteur_ligne)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFdddddd');
								
								
								$sheet->setCellValue('B'.$compteur_ligne, ($datecmd[2]."/".$datecmd[1]."/".$datecmd[0]));
								$sheet->setCellValue('C'.$compteur_ligne, ($cmd->c_heure));
								$sheet->setCellValue('D'.$compteur_ligne, ($mttotal));
								$sheet->setCellValue('E'.$compteur_ligne, ($cmd->c_fdp));
								$sheet->setCellValue('F'.$compteur_ligne, (number_format($cmd->c_reduc * 1.20, 2, '.', '')));
								$sheet->setCellValue('G'.$compteur_ligne, ($cmd->c_type_paiement));
								$sheet->setCellValue('H'.$compteur_ligne, (stripslashes($cmd->l_soc)." ".$cmd->f_civilite." ".stripslashes($cmd->f_nom)." ".stripslashes($cmd->f_prenom)." ".stripslashes($cmd->l_adr1)." ".stripslashes($cmd->l_cp)." ".stripslashes($cmd->l_ville)." ".stripslashes($cmd->l_telephone)));
								$sheet->setCellValue('I'.$compteur_ligne, ($cmd->l_mel));
								$sheet->setCellValue('J'.$compteur_ligne, "");
								$sheet->setCellValue('K'.$compteur_ligne, "");
								$sheet->setCellValue('L'.$compteur_ligne, "");
								$sheet->setCellValue('M'.$compteur_ligne, "");
								$sheet->setCellValue('N'.$compteur_ligne, "");
								$sheet->setCellValue('O'.$compteur_ligne, "");
								$sheet->setCellValue('P'.$compteur_ligne, "");
								$sheet->setCellValue('Q'.$compteur_ligne, "");
								$sheet->setCellValue('R'.$compteur_ligne, "");
								$sheet->setCellValue('S'.$compteur_ligne, ($cmd->c_comtr));
								// $sheet->setCellValue('S'.$compteur_ligne, ($cmd->c_codpro));
	
								$sheet->getRowDimension("$compteur_ligne")->setRowHeight(30);
	
								$compteur_ligne++;
								// FIN Excel Commande globale
								
								// Détail de la commande
								$id_cmd = $cmd->id_commande;
								$lect_det_cmd 		= "SELECT * FROM illi21_commandes_detail where d_commande = '$id_cmd' ;";
								$res_lect_det_cmd	= mysqli_query($lien,$lect_det_cmd) or die ("Erreur lecture detail commande");
								$nb_article 		= mysqli_num_rows($res_lect_det_cmd);
								
								$res_lect_det_cmd	= mysqli_query($lien,$lect_det_cmd) or die ("Erreur lecture detail commande");
								while($ligne_cmd = mysqli_fetch_object($res_lect_det_cmd))
								{
									$produit = "";
									$support = "";
									$contenant= "";
									$nuancier = "";
									$couleur = "";
									$quantite = "";
									$prix_unit = "";
									$prix_total = "";
									
									if($ligne_cmd->d_produit <> "")
									{
										// Produit
										$quantite = $ligne_cmd->d_quantite ;
										$prix_unit = $ligne_cmd->d_prix_unit ;
										$prix_total = $ligne_cmd->d_prix_total ;
										
										// Export Excel
										$sheet->setCellValue('A'.$compteur_ligne, "     .");
										$sheet->setCellValue('B'.$compteur_ligne, "     .");
										$sheet->setCellValue('C'.$compteur_ligne, "     .");
										$sheet->setCellValue('D'.$compteur_ligne, "     .");
										$sheet->setCellValue('E'.$compteur_ligne, "     .");
										$sheet->setCellValue('F'.$compteur_ligne, "     .");
										$sheet->setCellValue('G'.$compteur_ligne, "     .");
										$sheet->setCellValue('H'.$compteur_ligne, "     .");
										$sheet->setCellValue('I'.$compteur_ligne, "     .");
										$sheet->setCellValue('J'.$compteur_ligne, "");
										$sheet->setCellValue('K'.$compteur_ligne,($ligne_cmd->d_produit));
										
										$sheet->MergeCells('K'.$compteur_ligne.':O'.$compteur_ligne.'');

										$sheet->setCellValue('P'.$compteur_ligne, ($quantite));
										$sheet->setCellValue('Q'.$compteur_ligne, ($prix_unit));
										$sheet->setCellValue('R'.$compteur_ligne, ($prix_total));
										$sheet->setCellValue('S'.$compteur_ligne, "");
										$sheet->setCellValue('T'.$compteur_ligne, "");
			
										$sheet->getRowDimension("$compteur_ligne")->setRowHeight(30);
			
										$compteur_ligne++;
										// FIN Excel Commande globale
										
									}else{
										// Peinture
										// Le support
										$support = $ligne_cmd->d_support ;
										$requet_ = "SELECT id_s as id, sup_nom as nom FROM support where id_s = '".$support."'";
										$resultat_    = mysqli_query($lien, $requet_);
										$lect_res_    = mysqli_fetch_object($resultat_); 
										$lesupport    = "".$lect_res_->nom;
										
										
										// Le contenant
										$contenant= $ligne_cmd->d_contenant ;
										$requet_ = "SELECT id_c as id, cont_nom as nom FROM contenant where id_c = '".$contenant."'";
										$resultat_    = mysqli_query($lien, $requet_);
										$lect_res_    = mysqli_fetch_object($resultat_); 
										$lecontenant   = "".$lect_res_->nom;
										
										// Le nuancier
										$nuancier = $ligne_cmd->d_nuancier ;
										$requet_ = "SELECT id_n as id, nunom as nom FROM nuancier where id_n = '".$nuancier."'";
										$resultat_    = mysqli_query($lien, $requet_);
										$lect_res_    = mysqli_fetch_object($resultat_); 
										$lenuancier   = "".$lect_res_->nom;
										
										
										$couleur = $ligne_cmd->d_rf_couleur ;
										$lacouleur = $ligne_cmd->d_nom_couleur ;
										$brillance = $ligne_cmd->d_brillance;
										$quantite = $ligne_cmd->d_quantite ;
										$prix_unit = $ligne_cmd->d_prix_unit ;
										$prix_total = $ligne_cmd->d_prix_total ;
										
										
										// Export Excel
										$sheet->setCellValue('A'.$compteur_ligne, "     .");
										$sheet->setCellValue('B'.$compteur_ligne, "     .");
										$sheet->setCellValue('C'.$compteur_ligne, "     .");
										$sheet->setCellValue('D'.$compteur_ligne, "     .");
										$sheet->setCellValue('E'.$compteur_ligne, "     .");
										$sheet->setCellValue('F'.$compteur_ligne, "     .");
										$sheet->setCellValue('G'.$compteur_ligne, "     .");
										$sheet->setCellValue('H'.$compteur_ligne, "     .");
										$sheet->setCellValue('I'.$compteur_ligne, "     .");
										$sheet->setCellValue('J'.$compteur_ligne, "");
										$sheet->setCellValue('K'.$compteur_ligne, ($couleur));
										$sheet->setCellValue('L'.$compteur_ligne, ($lesupport));
										$sheet->setCellValue('M'.$compteur_ligne, ($lenuancier));
										$sheet->setCellValue('N'.$compteur_ligne, ($brillance));
										$sheet->setCellValue('O'.$compteur_ligne, ($lecontenant));
										$sheet->setCellValue('P'.$compteur_ligne, ($quantite));
										$sheet->setCellValue('Q'.$compteur_ligne, ($prix_unit));
										$sheet->setCellValue('R'.$compteur_ligne, ($prix_total));
										$sheet->setCellValue('S'.$compteur_ligne, "");
										// $sheet->setCellValue('S'.$compteur_ligne, "");
			
										$sheet->getRowDimension("$compteur_ligne")->setRowHeight(30);
			
										$compteur_ligne++;
										// FIN Excel Commande globale
									}
									
									
								}
								echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
								?>
                            <?php
                                    $compteur++;
                                }
								$nb_ligne = $compteur_ligne-1;
                
								$styleContenu = $sheet->getStyle("A3:T$nb_ligne");
								
								$styleAlignC = $styleContenu->getAlignment();
								$styleAlignC->setVertical('center');
								$styleAlignC->setWrapText(true);
										
								$styleBorderC = $styleContenu->getBorders();
								$styleBorderC->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
										
								$writer = new PHPExcel_Writer_Excel2007($workbook);
								$writer->setOffice2003Compatibility(false);
									
								
								$writer->save('excelcmd/export_commandes.xlsx');    
                            ?>     
                            
							
					<p class="clear"></p>
                        <div class="suite"><div class="excel" align="right"><a href="excelcmd/export_commandes.xlsx"><img src="excelcmd/ico_excel.gif" alt="Export ficher Excel" border="0" /></a></div></div>
                
						  
						  
						  <!-- InstanceEndEditable -->                        
                       </div>
                  </div>
                </div>
    			
    <?php
			}else{
			?>
    <!-- LOGIN -->
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-5">
        <div class="login-wrap p-4 p-md-5">
          <div class="icon d-flex align-items-center justify-content-center"> <span class="fa fa-user-o"></span> </div>
          <h3 class="text-center mb-4">S'identifier</h3>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login-form" method="post">
            <div class="form-group">
              <input name="identifiantc" type="text" class="form-control rounded-left" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="form-group d-flex">
              <input name="motdepassec" type="password" class="form-control rounded-left" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
              <button type="submit" class="form-control btn btn-primary rounded submit px-3">Connexion</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin LOGIN -->
    <?php 
			
			}
			
			?>
  </div>
</section>
  
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
<!-- InstanceEnd --></html>
