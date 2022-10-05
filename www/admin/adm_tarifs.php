<?php
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
	
	// Recherche les 9 tarifs
	
	// 1 Litre
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25000' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs 1 Litre");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25000 = $tarifcla->tar_class;
		$mesur25000 = $tarifcla->tar_mesu;
	}else{
		$class25000 = "1000";
		$mesur25000 = "1000";
	}
	
	// 2,5 Litres
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25050' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs 2,5 Litres");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25050 = $tarifcla->tar_class;
		$mesur25050 = $tarifcla->tar_mesu;
	}else{
		$class25050 = "1000";
		$mesur25050 = "1000";
	}
	
	// 3 Litres
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25100' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs 3 Litres");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25100 = $tarifcla->tar_class;
		$mesur25100 = $tarifcla->tar_mesu;
	}else{
		$class25100 = "1000";
		$mesur25100 = "1000";
	}
	
	// 5 Litres
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25200' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs 5 Litres");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25200 = $tarifcla->tar_class;
		$mesur25200 = $tarifcla->tar_mesu;
	}else{
		$class25200 = "1000";
		$mesur25200 = "1000";
	}
	
	// 10 Litres
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25300' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs 10 Litres");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25300 = $tarifcla->tar_class;
		$mesur25300 = $tarifcla->tar_mesu;
	}else{
		$class25300 = "1000";
		$mesur25300 = "1000";
	}
	
	// 25 Litres
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25400' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs 25 Litres");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25400 = $tarifcla->tar_class;
		$mesur25400 = $tarifcla->tar_mesu;
	}else{
		$class25400 = "1000";
		$mesur25400 = "1000";
	}
	
	// Spray 400ml
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25500' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs spray 400ml");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25500 = $tarifcla->tar_class;
		$mesur25500 = $tarifcla->tar_mesu;
	}else{
		$class25500 = "1000";
		$mesur25500 = "1000";
	}
	
	// Flacon retouche 9ml
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25650' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs flacon 9ml");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25650 = $tarifcla->tar_class;
		$mesur25650 = $tarifcla->tar_mesu;
	}else{
		$class25650 = "1000";
		$mesur25650 = "1000";
	}
	
	// Feutre retouche 8ml
	$lect_tarifs = "SELECT tar_class, tar_mesu FROM illi21_contenant where id_c = '25700' limit 1";
	$res_lect_tarifs = mysqli_query($lien, $lect_tarifs) or die ("Erreur lecture tarifs flacon 8ml");
	$row_cnt = mysqli_num_rows($res_lect_tarifs);
	if($row_cnt > 0)
	{
		$tarifcla = mysqli_fetch_object($res_lect_tarifs);
		$class25700 = $tarifcla->tar_class;
		$mesur25700 = $tarifcla->tar_mesu;
	}else{
		$class25700 = "1000";
		$mesur25700 = "1000";
	}
	
	
	
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
						  <h1>Tarif de base des nuanciers RAL et SIKKENS</h1>
                          <?php
                          if(isset($_POST['modifier']))
						  {
						  	$class25000 = securiseFormulaire($_POST['class25000']);
							$mesur25000 = securiseFormulaire($_POST['mesur25000']);
							
							$class25050 = securiseFormulaire($_POST['class25050']);
							$mesur25050 = securiseFormulaire($_POST['mesur25050']);
							
							$class25100 = securiseFormulaire($_POST['class25100']);
							$mesur25100 = securiseFormulaire($_POST['mesur25100']);
							
							$class25200 = securiseFormulaire($_POST['class25200']);
							$mesur25200 = securiseFormulaire($_POST['mesur25200']);
							
							$class25300 = securiseFormulaire($_POST['class25300']);
							$mesur25300 = securiseFormulaire($_POST['mesur25300']);
							
							$class25400 = securiseFormulaire($_POST['class25400']);
							$mesur25400 = securiseFormulaire($_POST['mesur25400']);
							
							$class25500 = securiseFormulaire($_POST['class25500']);
							$mesur25500 = securiseFormulaire($_POST['mesur25500']);
							
							$class25650 = securiseFormulaire($_POST['class25650']);
							$mesur25650 = securiseFormulaire($_POST['mesur25650']);
							
							$class25700 = securiseFormulaire($_POST['class25700']);
							$mesur25700 = securiseFormulaire($_POST['mesur25700']);
							
							
							  
							  if ($class25000 > 0 and $mesur25000 > 0 and $class25050 > 0 and $mesur25050 > 0 and $class25100 > 0 and $mesur25100 > 0 and $class25200 > 0 and $mesur25200 > 0 and $class25300 > 0 and $mesur25300 > 0 and $class25400 > 0 and $mesur25400 > 0 and $class25500 > 0 and $mesur25500 > 0 and $class25650 > 0 and $mesur25650 > 0 and $class25700 > 0 and $mesur25700 > 0)
							  {
							  	$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25000', tar_mesu  = '$mesur25000' WHERE id_c = '25000' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant 1 Litre");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25050', tar_mesu  = '$mesur25050' WHERE id_c = '25050' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant 2,5 Litres");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25100', tar_mesu  = '$mesur25100' WHERE id_c = '25100' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant 3 Litres");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25200', tar_mesu  = '$mesur25200' WHERE id_c = '25200' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant 5 Litres");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25300', tar_mesu  = '$mesur25300' WHERE id_c = '25300' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant 10 Litres");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25400', tar_mesu  = '$mesur25400' WHERE id_c = '25400' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant 25 Litres");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25500', tar_mesu  = '$mesur25500' WHERE id_c = '25500' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant Spray 400ml");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25650', tar_mesu  = '$mesur25650' WHERE id_c = '25650' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant Flacon retouche 9ml");
								
								$maj_tarif  = "UPDATE illi21_contenant SET tar_class = '$class25700', tar_mesu  = '$mesur25700' WHERE id_c = '25700' limit 1;"; // 
								$res_maj_tarif = mysqli_query($lien, $maj_tarif) or die ("Erreur modification tarifs contenant Flacon retouche 8ml");	
							  
							  	echo "<br>Les tarifs des nuanciers RAL et SIKKENS ont bien été modifiés ...<br>";
							  }else{
							  	echo "<br>Les tarifs des nuanciers RAL et SIKKENS n'ont pas été modifiés car l'une des valeurs était à 0 ...<br>";
							  }
                          }else{
						  ?>
						  	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="recgesprod" id="recgesprod">
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">&nbsp;</label>
                                	<div class="col-sm-2 gras"><center>En stock HT</center></div>
                                    <div class="col-sm-2 gras"><center>Sur mesure HT</center></div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">1 Litre</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25000" id="inputclassique" value="<?php echo $class25000; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25000" id="inputclassique" value="<?php echo $mesur25000; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">2,5 Litres</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25050" id="inputclassique" value="<?php echo $class25050; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25050" id="inputclassique" value="<?php echo $mesur25050; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">3 Litres</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25100" id="inputclassique" value="<?php echo $class25100; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25100" id="inputclassique" value="<?php echo $mesur25100; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">5 Litres</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25200" id="inputclassique" value="<?php echo $class25200; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25200" id="inputclassique" value="<?php echo $mesur25200; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">10 Litres</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25300" id="inputclassique" value="<?php echo $class25300; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25300" id="inputclassique" value="<?php echo $mesur25300; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">25 Litres</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25400" id="inputclassique" value="<?php echo $class25400; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25400" id="inputclassique" value="<?php echo $mesur25400; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">Spray 400ml</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25500" id="inputclassique" value="<?php echo $class25500; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25500" id="inputclassique" value="<?php echo $mesur25500; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">Flacon retouche 9 ml</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25650" id="inputclassique" value="<?php echo $class25650; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25650" id="inputclassique" value="<?php echo $mesur25650; ?>"  >
        	                        </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                               		<label for="staticEmail" class="col-sm-4 col-form-label">Feutre retouche 8 ml</label>
                                	<div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="class25700" id="inputclassique" value="<?php echo $class25700; ?>"  >
        	                        </div>
                                    <div class="col-sm-2">
		                                <input type="text" class="form-control text-right" name="mesur25700" id="inputclassique" value="<?php echo $mesur25700; ?>"  >
        	                        </div>
                                </div>
            
                                
                                
                                
                                
                                <div class="mb-3 row">
                                	<div class="col-sm-4 text-right">
								  		<button type="cancel" onClick="window.location='index-admin.php';return false;" class="btn btn-warning">Annuler</button>
                                    </div>
                                    <div class="col-sm-3">
	    	                            <input type="submit" name="modifier" id="modifier" value="Modifier" class="btn btn-success" />
                                    </div>
                                </div>
                                
						  	</form>
                          <?php 
						  }
						  ?>
						  
						  
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
