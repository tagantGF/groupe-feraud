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
<!-- InstanceBeginEditable name="head" -->
<script src="js/adm.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<!-- InstanceEndEditable -->
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
						  <h1>Modifier un produit</h1>
                          <?php
							if(isset($_GET['id_prd']) && is_numeric($_GET['id_prd']))
							{
								$id_prod = $_GET['id_prd'];
								
								$lect_prod = "SELECT * FROM illi21_produits WHERE id_p = '$id_prod ' limit 1;";
								$res_lect_prod = mysqli_query($lien,$lect_prod) or die ("Erreur lecture produit");
								$leproduit = mysqli_fetch_object($res_lect_prod);
								if(isset($_POST['modifier'])){
									// modification de la fiche produit
									$date = date('Y-m-d');
									$heure = date('H:i:s');
									
									$nom_prod	= securiseFormulaire($_POST['nom_prod']);
									$nom_var	= securiseFormulaire($_POST['nom_var']);
									
									$frais_port	= securiseFormulaire($_POST['frais_port']);
									
									$ref_prod	= securiseFormulaire($_POST['ref_prod']);
									$famille	= securiseFormulaire($_POST['famille']);
									$sfamille	= securiseFormulaire($_POST['sfamille']);
									
									$enligne	= securiseFormulaire($_POST['enligne']);
									$desc_comm	= securiseFormulaire($_POST['desc_comm']);
									$desc_tech	= "";
									
									$p_ordre	= securiseFormulaire($_POST['p_ordre']);
									
									$pds_prod	= '0';
									$prix_prod	= number_format(securiseFormulaire($_POST['prix_prod']), 3, '.', '');
									
									if($_FILES['photo1']['name'] != ''){
										$photo1 = envoyerImage(($_FILES['photo1']['name']), $_FILES['photo1']['tmp_name'], "../images/produits");
										if(is_file("../images/produits/".$leproduit->p_photo)) unlink("../images/produits/".$leproduit->p_photo);
									}else{
										$photo1 = $leproduit->p_photo;
									}
									
									if($_FILES['photo2']['name'] != ''){
										$photo2 = envoyerImage(($_FILES['photo2']['name']), $_FILES['photo2']['tmp_name'], "../images/produits");
										if(is_file("../images/produits/".$leproduit->p_photo_2)) unlink("../images/produits/".$leproduit->p_photo_2);	
									}else{
										$photo2 = $leproduit->p_photo_2;
									}
									
									if($_FILES['photo3']['name'] != ''){
										$photo3 = envoyerImage(($_FILES['photo3']['name']), $_FILES['photo3']['tmp_name'], "../images/produits");
										if(is_file("../images/produits/".$leproduit->p_photo_3)) unlink("../images/produits/".$leproduit->p_photo_3);
									}else{
										$photo3 = $leproduit->p_photo_3;
									}
									
									if($_FILES['lepdf']['name'] != ''){
										$lepdf = envoyerImage(($_FILES['lepdf']['name']), $_FILES['lepdf']['tmp_name'], "../documents");	
										if(is_file("../documents/".$leproduit->p_pdf)) unlink("../documents/".$leproduit->p_pdf);
									}else{
										$lepdf = $leproduit->p_pdf;
									}
									
									$query_modif_prod  = "UPDATE `illi21_produits` set `p_nom` = '$nom_prod', `p_ref` = '$ref_prod', `p_famille` = '$famille', `p_sfamille` = '$sfamille', `p_declinaison` = '$nom_var',";
									$query_modif_prod .= "`p_des_com` = '$desc_comm', `p_des_tec` = '$desc_tech', `p_prix_ht` = '$prix_prod', `p_prix_ht_promo` = '0',";
									$query_modif_prod .= " `p_poids` = '$pds_prod', `p_taux_tva` = '1', `p_prod_lie_1` = '0', `p_prod_lie_2` = '0', `p_prod_lie_3` = '0', `p_port` = '$frais_port', ";
									$query_modif_prod .= "`p_photo` = '$photo1', `p_photo_2` = '$photo2', `p_photo_3` = '$photo3', `p_ordre` = '$p_ordre', `p_pdf` = '$lepdf', `p_enligne` = '$enligne' WHERE id_p = '$id_prod ' limit 1;";

									// echo $query_modif_prod;

									$res_modif_prod	= mysqli_query($lien,$query_modif_prod) or die ("Erreur modification produit");
									
									// Supprimer le PDF
									if(isset($_POST['suppdf']))
									{
										if(is_file("../documents/".$leproduit->p_pdf)) unlink("../documents/".$leproduit->p_pdf);
										$query_modif_prod  = "UPDATE `illi21_produits` set `p_pdf` = '' WHERE id_p = '$id_prod ' limit 1;";
										$res_modif_prod	= mysqli_query($lien,$query_modif_prod) or die ("Erreur modification produit");
									}
									
									// Supprimer l'image 2
									if(isset($_POST['supimg2']))
									{
										if(is_file("../images/produits/".$leproduit->p_photo_2)) unlink("../images/produits/".$leproduit->p_photo_2);
										$query_modif_prod  = "UPDATE `illi21_produits` set `p_photo_2` = '' WHERE id_p = '$id_prod ' limit 1;";
										$res_modif_prod	= mysqli_query($lien,$query_modif_prod) or die ("Erreur modification produit");
									}
									
									// Supprimer l'image 3
									if(isset($_POST['supimg3']))
									{
										if(is_file("../images/produits/".$leproduit->p_photo_3)) unlink("../images/produits/".$leproduit->p_photo_3);
										$query_modif_prod  = "UPDATE `illi21_produits` set `p_photo_3` = '' WHERE id_p = '$id_prod ' limit 1;";
										$res_modif_prod	= mysqli_query($lien,$query_modif_prod) or die ("Erreur modification produit");
									}
									
									?>		
									<p>Le produit a bien été modifié.</p>
									<p><a href="adm_produits.php" class="btn btn-info">Retour à la gestion des produits</a></p>
									<?php 
								}else{
								?>
								<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="aj_prod" id="aj_prod" enctype="multipart/form-data">
									<div class="mb-3 mt-4 row">
										<label for="famille" class="col-sm-2 col-form-label">Famille* : </label>
										<div class="col-sm-4">
										<select name="famille" id="famille" onChange="afficher_select_sf();" class="form-control">
												<?php
												$lect_famille = "SELECT * FROM illi21_familles;";
												$res_lect_famille = mysqli_query($lien,$lect_famille) or die ("Erreur");
												while($famille = mysqli_fetch_object($res_lect_famille))
												{
												?>
															<option value="<?php echo $famille->id_famille; ?>"<?php if($famille->id_famille == $leproduit->p_famille) echo ' selected="selected"'; ?>><?php echo ($famille->f_libelle); ?></option>
												<?php
												}
												?>             
										</select>
										</div>
										<label for="sfamille"  class="col-sm-2 col-form-label">Sous famille : </label>
										<div class="col-sm-3">
										<span id="aff_sous_famille">
										<select name="sfamille" id="sfamille"  class="form-control">
											
											<?php
                                            
                                                $lect_sfamille = "SELECT * FROM illi21_familles_sous WHERE sf_famille = '$leproduit->p_famille';";
                                                $res_lect_sfamille = mysqli_query($lien,$lect_sfamille) or die ("Erreur");
                                                while($sfamille = mysqli_fetch_object($res_lect_sfamille)){
                                                ?>
                                                        <option value="<?php echo $sfamille->id_sous_famille; ?>"<?php if($sfamille->id_sous_famille == $leproduit->p_sfamille) echo ' selected="selected"'; ?>><?php echo ($sfamille->sf_libelle); ?></option>
                                                <?php	
                                                }
                                            
                                            ?>
										</select>
										</span>
										</div>
									</div>
									
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Nom* : </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="nom_prod" id="nom_prod" maxlength="128" required value="<?php echo $leproduit->p_nom; ?>" />
										</div>
									 </div>
									
									
									
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Descriptif commercial* : </label>
										<div class="col-sm-4"><textarea name="desc_comm" id="desc_comm"><?php echo $leproduit->p_des_com; ?></textarea><script>CKEDITOR.replace( 'desc_comm', {height: 200, width:680});</script></div>
									</div>
									

                                    
                                    <?php if($leproduit->p_type == 's') 
									{ // Produit simple
									?>
                                    
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Référence* : </label>
										<div class="col-sm-4">
											<input type="text" name="ref_prod" id="ref_prod" maxlength="30" required class="form-control" value="<?php echo $leproduit->p_ref; ?>" /><input type="hidden" name="nom_var" value="">
										</div>
									</div>
                                    
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Prix H.T.* : </label>
										<div class="col-sm-4">
											<input type="number" pattern="[0-9]+([\.,][0-9]+)?" inputmode="numeric" step="0.01" name="prix_prod" id="prix_prod" maxlength="30" required class="form-control" value="<?php echo $leproduit->p_prix_ht; ?>" />
										</div>
	
                                        <label for="enligne" class="col-sm-2 col-form-label">En ligne : </label>
                                        <div class="col-sm-4">
                                            <select name="enligne" id="enligne" class="form-control">
                                                <option value="1" <?php if($leproduit->p_enligne == '1') echo 'selected="selected"'; ?>>Oui</option>
                                                <option value="0" <?php if($leproduit->p_enligne == '0') echo 'selected="selected"'; ?>>Non</option>
                                            </select>
                                        </div>
                                     </div>
                                     
                                     <?php }else{ // Produit multiple on ne propose que le champ En ligne et le nom de la declinaison
									 
									 	// Recherche l'ancien prix le plus bas
										$rechercheprix = "SELECT MIN(p_prix_ht) as prixleplusbas from illi21_produits_var where id_prod = '$id_prod';";
										$res_prix_decli = mysqli_query($lien,$rechercheprix);
										$leprix = mysqli_fetch_object($res_prix_decli); 
										$prxproduit = $leprix->prixleplusbas;
									 ?>
                                     <div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Nom de la déclinaison* : </label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="nom_var" id="nom_var" maxlength="128" required value="<?php echo $leproduit->p_declinaison; ?>" />
										</div>


										<input type="hidden" name="prix_prod" value="<?php echo $prxproduit; ?>">
                                        <input type="hidden" name="pds_prod" value="0" >
                                        <input type="hidden" name="ref_prod" value="">
	
                                        <label for="enligne" class="col-sm-2 col-form-label">En ligne : </label>
                                        <div class="col-sm-4">
                                            <select name="enligne" id="enligne" class="form-control">
                                                <option value="1" <?php if($leproduit->p_enligne == '1') echo 'selected="selected"'; ?>>Oui</option>
                                                <option value="0" <?php if($leproduit->p_enligne == '0') echo 'selected="selected"'; ?>>Non</option>
                                            </select>
                                        </div>
                                     </div>
									
                                     <?php
									 }
									 ?>
                                    
                                    <div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-2 col-form-label">Fichier PDF : </label>
                                        <div class="col-sm-6">
                                            <input type="file" class="form-control" name="lepdf" id="lepdf" size="60" />
                                        </div>
                                        <span class="col-sm-4"><i>Format conseillé : PDF maxi 2Mo </i></span>
                                    </div>
                                    <?php if (is_file("../documents/".$leproduit->p_pdf)) {?>
                                    <div class="mb-3 mt-4 row">
                                        <label for="photo2"  class="col-sm-3 col-form-label">PDF actuel : </label>
                                        <div class="col-sm-9">
	                                        <i><strong><a href="../documents/<?php echo $leproduit->p_pdf; ?>" target="_blank">Voir le fichier</a></strong></i>
                                        </div>
                                    </div> 
                                    <div class="mb-3 mt-4 row">
                                        <label for="photo2"  class="col-sm-3 col-form-label">Supprimer le PDF : </label>
                                        <div class="col-sm-9">
	                                        <input type="checkbox" name="suppdf" value="1">
                                        </div>
                                    </div> 
                                    <?php } ?>
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Nouv. Photo 1 : </label>
										<div class="col-sm-6">
											<input type="file" class="form-control" name="photo1" id="photo1" size="60"/>
										</div>
										<span class="col-sm-4"><i>Format conseillé "Carré" 600px x 600px </i></span>
									</div>
                                    <?php if (is_file("../images/produits/".$leproduit->p_photo)) {?>
                                    <div class="mb-3 mt-4 row">
                                        <label for="photo2"  class="col-sm-3 col-form-label">Image actuelle</label>
                                        <div class="col-sm-9">
	                                        <i><strong><img src="../images/produits/<?php echo $leproduit->p_photo; ?>" width="300px" /></strong></i>
                                        </div>
                                    </div>
                                    <?php } ?>
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Nouv. Photo 2 : </label>
										<div class="col-sm-6">
											<input type="file" class="form-control" name="photo2" id="photo2" size="60"  />
										</div>
										
									</div>
                                    
                                    <?php if (is_file("../images/produits/".$leproduit->p_photo_2)) {?>
                                    <div class="mb-3 mt-4 row">
                                        <label for="photo2"  class="col-sm-3 col-form-label">Image actuelle</label>
                                        <div class="col-sm-9">
	                                        <i><strong><img src="../images/produits/<?php echo $leproduit->p_photo_2; ?>" width="300px" /></strong></i>
                                        </div>
                                    </div> 
                                    <div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-3 col-form-label">Supprimer Photo 2 : </label>
										<div class="col-sm-6">
											<input type="checkbox" name="supimg2" value="1">
										</div>
										
									</div>
                                      <?php } ?>
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Nouv. Photo 3 : </label>
										<div class="col-sm-6">
											<input type="file" class="form-control" name="photo3" id="photo3" size="60" />
										</div>
										
									</div>
                                    <?php if (is_file("../images/produits/".$leproduit->p_photo_3)) {?>
                                    <div class="mb-3 mt-4 row">
                                        <label for="photo2"  class="col-sm-3 col-form-label">Image actuelle</label>
                                        <div class="col-sm-9">
	                                        <i><strong><img src="../images/produits/<?php echo $leproduit->p_photo_3; ?>" width="300px" /></strong></i>
                                        </div>
                                    </div> 
                                    <div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-3 col-form-label">Supprimer Photo 3 : </label>
										<div class="col-sm-6">
											<input type="checkbox" name="supimg3" value="1">
										</div>
										
									</div>
                                      <?php } ?>
                                    
                                    <div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-2 col-form-label">Frais de port* : </label>
                                        <div class="col-sm-6">
                                            <input type="radio" name="frais_port" value="exp" <?php if($leproduit->p_port == 'exp') echo "checked";?> required> Express<br>
                                            <input type="radio" name="frais_port" value="exphg" <?php if($leproduit->p_port == 'exphg') echo "checked";?>> Express hors gabarit<br>
                                            <input type="radio" name="frais_port" value="msg" <?php if($leproduit->p_port == 'msg') echo "checked";?>> Messagerie<br>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-4 col-form-label">Ordre d'affichage par defaut : </label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="p_ordre" id="p_ordre" maxlength="10" value="<?php echo $leproduit->p_ordre; ?>" />
                                        </div>
                                     </div>
									<div class="mb-3 mt-4 row">
											<div class="col-sm-9">
											<input type="submit" name="modifier" id="modifier" value="Modifier le produit" class="btn btn-success" />
											</div>
										</div>
								</form>
								<?php 
								}
							}else{
								echo "Produit inexistant";
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
