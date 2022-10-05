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
						  <h1>Supprimer une déclinaison</h1>
                           <?php
						   if(isset($_GET['_id_prd']) && is_numeric($_GET['_id_prd']))
							{
								$id_decli = $_GET['_id_prd'];
								
								$lect_decli = "SELECT * FROM illi21_produits_var WHERE id_decli = '$id_decli ' limit 1;";
								$res_lect_decli = mysqli_query($lien,$lect_decli) or die ("Erreur lecture declinaison");
								$ladecli = mysqli_fetch_object($res_lect_decli);
								$id_prod = $ladecli->id_prod;
								if(isset($_POST['ajouter'])){
									
									$query_sup_declic  = "DELETE FROM `illi21_produits_var`  WHERE id_decli = '$id_decli ' limit 1;";
									// echo $query_sup_declic;
									$res_mod_declic	= mysqli_query($lien,$query_sup_declic) or die ("Erreur suppression declinaison");
									
									// Mets a jout le prix le plus bas du produit
									$rechercheprix = "SELECT MIN(p_prix_ht) as prixleplusbas from illi21_produits_var where id_prod = '$id_prod';";
									$res_prix_decli = mysqli_query($lien,$rechercheprix);
									$leprix = mysqli_fetch_object($res_prix_decli); 
									$prxproduit = $leprix->prixleplusbas;
									
									$query_modif_prod  = "UPDATE `illi21_produits` set  `p_prix_ht` = '$prxproduit' WHERE id_p = '$id_prod ' limit 1;";

									$res_modif_prod	= mysqli_query($lien,$query_modif_prod) or die ("Erreur modification produit");
									
									?>		
									<p>La déclinaison a bien été supprimée.</p>
									
									<p><a href="adm_produits_decli.php?id_prd=<?php echo $id_prod;?>" class="btn btn-info">Retour au produit</a></p>
									<?php 
								}else{
								?>
								<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="aj_prod" id="aj_prod" enctype="multipart/form-data">
									
									
	
									<div class="mb-3 mt-4 row">
										<label for="libelle" class="col-sm-2 col-form-label">Nom* : </label>
										<div class="col-sm-10">
											<input type="text" class="form-control" value="<?php echo $ladecli->p_nom; ?>" disabled  />
										</div>
									 </div>
									<div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-2 col-form-label">Référence* : </label>
                                        <div class="col-sm-4">
                                            <input type="text"  class="form-control"  value="<?php echo $ladecli->p_ref; ?>"disabled />
                                        </div>
                                        <label for="libelle" class="col-sm-2 col-form-label">Poids* : </label>
                                        <div class="col-md-4">
                                            <input type="number"class="form-control"   value="<?php echo $ladecli->p_poids; ?>"disabled/>
                                        </div>
                                    </div>
									<div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-2 col-form-label">Prix H.T.* : </label>
                                        <div class="col-sm-4">
                                            <input type="number"   class="form-control"  value="<?php echo $ladecli->p_prix_ht; ?>" disabled/>
                                        </div>
                                        <label for="enligne" class="col-sm-2 col-form-label">En ligne : </label>
                                        <div class="col-sm-4">
                                            <select name="enligne" id="enligne" class="form-control" disabled>
                                                <option value="1" <?php if($ladecli->p_enligne == '1') echo "selected='selected'"; ?>>Oui</option>
                                                <option value="0" <?php if($ladecli->p_enligne == '0') echo "selected='selected'"; ?>>Non</option>
                                            </select>
                                        </div>
            
                                     </div>
								   
									<div class="mb-3 mt-4 row">
											<input type="submit" name="ajouter" id="ajouter" value="Supprimer la déclinaison" class="btn btn-success col-sm-3 mr-1" />
											<a href="adm_produits_decli.php?id_prd=<?php echo $id_prod;?>" class="btn btn-danger col-sm-3">Annuler</a>
                                            
										</div>
								</form>
								<?php 
								}
							}else{
								echo "Déclinaison inexistant";
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
