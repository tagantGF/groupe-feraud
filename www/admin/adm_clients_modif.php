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
						  <h1>Modifier un client</h1>
                    
							<?php
							 if(isset($_GET['id_cli']) && is_numeric($_GET['id_cli']))
                        	{
								$id_client = $_GET['id_cli'];
								$lect_client = "SELECT * FROM illi21_clientsilli WHERE cliid = '$id_client';";
								$res_lect_client = mysqli_query($lien,$lect_client) or die ("Erreur lecture client");
								$leclient = mysqli_fetch_object($res_lect_client);
								if(isset($_POST['modifier']))
								{
									$codcli 	= securiseFormulaire($_POST['cocli']);
									$nomscli 	= securiseFormulaire($_POST['nomcli']);
									$cpccli 	= securiseFormulaire($_POST['cpcli']);
									$redcli 	= number_format(securiseFormulaire($_POST['redcli']), 3, '.', '');
									$date 		= date('Y-m-d');
									$heure 		= date('H:i:s');
									
									$enr_clients  = "update illi21_clientsilli set clicode = '$codcli', clinom = '$nomscli', clicp = '$cpccli', cli_reduc = '$redcli' WHERE cliid = '$id_client' limit 1;";
									$res_enr_clients = mysqli_query($lien,$enr_clients) or die ("Erreur enregistrement clients");
									
									// Modifie le montant de la reduction sur le compte client boutique si nécessaire
									
									$lect_cliencpt = "SELECT * FROM illi21_clients_cpt WHERE clientcode = '$codcli';";
									$res_lect_clientcpt = mysqli_query($lien,$lect_cliencpt) or die ("Erreur lecture client compte");
									$row_cnt = mysqli_num_rows($res_lect_clientcpt);
									if($row_cnt > 0)
									{
										$modif_clients  = "update illi21_clients_cpt set cli_reduc = '$redcli'  WHERE clientcode = '$codcli';";
										$res_modif_clients = mysqli_query($lien,$modif_clients) or die ("Erreur modification clients");
									}
									
									// Modifie les reductions poudres
									$recmarques 	= "Select idm, nomarque from illi21_marque order by nomarque asc";
									$res_marques    = mysqli_query($lien, $recmarques);
									$row_cnt 		= mysqli_num_rows($res_marques);
									if($row_cnt > 0)
										{
										while ($lect_marques_ = mysqli_fetch_object($res_marques))
											{
												$montantreduc = number_format(securiseFormulaire($_POST[$lect_marques_->idm]), 3, '.', '');
												// Si montant de la reduc > 0
												if($montantreduc > 0)
												{
													// Cherche si enreg exite deja
													$rec_reduc = "select code_client, nom_marque, reduc from illi21_marques_reduc where code_client = '$leclient->clicode' and nom_marque = '$lect_marques_->nomarque' limit 1";
													$res_rec_reduc	= mysqli_query($lien, $rec_reduc);
													$row_cnt_reduc	= mysqli_num_rows($res_rec_reduc);
													if($row_cnt_reduc == 1) 
													{
														// Si existe met à jour
														$modif_reduc  = "update illi21_marques_reduc set reduc = '$montantreduc' where code_client = '$leclient->clicode' and nom_marque = '$lect_marques_->nomarque' limit 1";
														$res_modif_reduc = mysqli_query($lien,$modif_reduc) or die ("Erreur modification reduction");
													}else{
														// sinon créer
														$enr_reduc  = "INSERT INTO illi21_marques_reduc (code_client, nom_marque, reduc) ";
														$enr_reduc .= "VALUES ('$leclient->clicode','$lect_marques_->nomarque','$montantreduc');";
														$res_enr_reduc = mysqli_query($lien,$enr_reduc) or die ("Erreur enregistrement reduction");
													}
												}else{
													// Cherche si enreg exite deja alors on met à 0
													$rec_reduc = "select code_client, nom_marque, reduc from illi21_marques_reduc where code_client = '$leclient->clicode' and nom_marque = '$lect_marques_->nomarque' limit 1";
													$res_rec_reduc	= mysqli_query($lien, $rec_reduc);
													$row_cnt_reduc	= mysqli_num_rows($res_rec_reduc);
													if($row_cnt_reduc == 1) 
													{
														// Si existe met à jour
														$modif_reduc  = "delete from illi21_marques_reduc  where code_client = '$leclient->clicode' and nom_marque = '$lect_marques_->nomarque' limit 1";
														$res_modif_reduc = mysqli_query($lien,$modif_reduc) or die ("Erreur modification reduction");
													}
												}
											
											}
										}
									
									
									
									?>		
									<p>Le client a bien été modifié.</p>

									<p><a href="adm_clients.php" class="btn btn-info">Retour à la liste des clients</a></p>
									<?php	
								}else{
									?>
									<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="aj_sfam" id="aj_sfam">
										<div class="mb-3 mt-4 row">
											<label for="cocli" class="col-sm-3 col-form-label">Code client : </label>
											<div class="col-sm-9">
												<input type="text" name="cocli" id="cocli" maxlength="5" required class="form-control"  value="<?php echo $leclient->clicode; ?>"  /> 
											</div>
										</div>
										<div class="mb-3 mt-4 row">
											<label for="nomcli" class="col-sm-3 col-form-label">Nom : </label>
											<div class="col-sm-9">
												<input type="text" name="nomcli" id="nomcli" maxlength="48" class="form-control"  required  value="<?php echo $leclient->clinom; ?>"/> 
											</div>
										</div>
										<div class="mb-3 mt-4 row">
											<label for="cpcli" class="col-sm-3 col-form-label">Code postal : </label>
											<div class="col-sm-9">
												<input type="text" name="cpcli" id="cpcli" maxlength="5" required class="form-control" value="<?php echo $leclient->clicp; ?>" /> 
											</div>
										</div>
										<div class="mb-3 mt-4 row">
											<label for="redcli" class="col-sm-3 col-form-label">Remise g&eacute;n&eacute;rale (%) : </label>
											<div class="col-sm-2">
												<input type="number" name="redcli" id="redcli" maxlength="5" class="form-control" min="0" step='0.1' value="<?php echo $leclient->cli_reduc; ?>" />
											</div>
										</div>
                                        <div class="mb-3 mt-4 row">
											<label for="redcli" class="col-sm-10 col-form-label">Remise suppl&eacute;mentaire sur marques Poudres (%) : </label>
										</div>
                                        <?php 
											$recmarques 	= "Select idm, nomarque from illi21_marque order by nomarque asc";
											$res_marques    = mysqli_query($lien, $recmarques);
											$row_cnt 		= mysqli_num_rows($res_marques);
											if($row_cnt > 0)
												{
												while ($lect_marques_ = mysqli_fetch_object($res_marques))
													{
													// Cherche s'il existe deja une reduc
													$rec_reduc = "select code_client, nom_marque, reduc from  illi21_marques_reduc where code_client = '$leclient->clicode' and nom_marque = '$lect_marques_->nomarque' limit 1";
													$res_rec_reduc	= mysqli_query($lien, $rec_reduc);
													$row_cnt_reduc	= mysqli_num_rows($res_rec_reduc);
													if($row_cnt_reduc == 1) 
													{
														$lareduc = mysqli_fetch_object($res_rec_reduc);
														$lemtreduc = $lareduc->reduc;
													}else{
														$lemtreduc = 0;
													}
													?>
													<div class="mb-3 mt-4 row">
                                                    	<div class="col-sm-3"></div>
														<label for="redcli" class="col-sm-3 col-form-label"><?php echo $lect_marques_->nomarque; ?> : </label>
														<div class="col-sm-2">
															<input type="number" name="<?php echo $lect_marques_->idm; ?>" min="0" id="<?php echo $lect_marques_->idm; ?>" maxlength="5" class="form-control" step='0.1' value="<?php echo $lemtreduc;?>" />
														</div>
													</div>
													<?php
													}
												}
										?>
                                        
										<div class="mb-3 mt-4 row">
											<label>&nbsp;</label>
											<input type="submit" name="modifier" id="modifier" value="Modifier le client" class="btn btn-success" />
										</div>
									</form>  
									<?php
								}
							}else{
								echo "Client inexistant";
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
