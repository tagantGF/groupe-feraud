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
                                            </span>T??l??chargements</a>
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
                                                        <span class="glyphicon glyphicon-file text-primary"></span><a href="adm_clients_maj.php">Mise ?? jour fichier</a>
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
                                                        <span class="glyphicon glyphicon-align-left text-primary"></span><a href="adm-pages.php?page=mentions">Mentions L??gales</a>
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
                                                        <span class="glyphicon glyphicon-off text-danger"></span><a href="adm_deconnexion.php" class="text-danger">Se d??connecter</a>
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
						  <h1>Supprimer un article</h1>
                          <?php
						  if(isset($_GET['_ida']) && is_numeric($_GET['_ida']))
							{
								$id_actu = $_GET['_ida']; 
								
								$lect_actu = "SELECT * FROM illi21_actualites WHERE id_actu = '$id_actu' limit 1;";
								$res_lect_actu = mysqli_query($lien,$lect_actu) or die ("Erreur lecture actu");
								$lactu = mysqli_fetch_object($res_lect_actu);
								
								if(isset($_POST['supprimer'])){
									// enregistrement de la fiche produit
									// $date = date('Y-m-d');
									
									
									if(is_file("../images/actualites/alaune/".$lactu->photo_alaune)) unlink("../images/actualites/alaune/".$lactu->photo_alaune);
									
									
									$query_modif_actu = "delete from `illi21_actualites` WHERE id_actu = '$id_actu' limit 1;";
									$res_mod_actu		= mysqli_query($lien,$query_modif_actu) or die ("Erreur modification actu");
									
									// Supprime les photos de la gallerie
									$lect_photo = "SELECT * FROM illi21_actualites_photos WHERE id_actu = '$id_actu' ;";
									$res_lect_photo = mysqli_query($lien,$lect_photo) or die ("Erreur lecture photos");
									$row_cnt = mysqli_num_rows($res_lect_photo);
									if($row_cnt > 0)
									{
									
										while($photo = mysqli_fetch_object($res_lect_photo))
										{
											if(is_file("../images/actualites/".$photo->nm_photo)) unlink("../images/actualites/".$photo->nm_photo);
										}
									}
									?>	
									<p>L'actualit?? a bien ??t?? supprim??e.</p>
											
									<p><a href="adm_blog.php" class="btn btn-info">Retour ?? la gestion du blog</a></p>
									<?php 
								}else{
								?>
								<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="aj_prod" id="aj_prod" enctype="multipart/form-data">
									
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Titre* : </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="titre_actu" id="titre_actu" maxlength="128" required value="<?php echo $lactu->titre; ?>" />
										</div>
									</div>
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Sous-Titre* : </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="soustitre_actu" id="soustitre_actu" maxlength="128" required value="<?php echo $lactu->sous_titre; ?>" />
										</div>
									</div>
	
								    <?php if (is_file("../images/actualites/alaune/".$lactu->photo_alaune)) {?>
                                    <div class="mb-3 mt-4 row">
                                        <label for="photo2"  class="col-sm-3 col-form-label">Image actuelle</label>
                                        <div class="col-sm-9">
	                                        <i><strong><img src="../images/actualites/alaune/<?php echo $lactu->photo_alaune; ?>" width="300px" /></strong></i>
                                        </div>
                                    </div> 
                                    <?php } ?>
									
									
									<div class="mb-3 mt-4 row">
										<div class="col-sm-9">
										<input type="submit" name="supprimer" id="supprimer" value="Supprimer l'article" class="btn btn-success" />
										</div>
									</div>
								</form>
								<?php 
								}
							}else{
								echo "Article inexistant";
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
