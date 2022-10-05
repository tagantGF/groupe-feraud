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
						  <?php 
							if (@$_GET['t'])
							{
								$rqadd = "";
								$titre = "toutes";
								$toutes = true;			
							}else{
								$rqadd = "limit 0,20";
								$titre = "20 dernières";
								$toutes = false;
							}
						?>
		                <h1>Commandes (<?php echo $titre; ?>)</h1>

                        <table border="0" cellpadding="5" cellspacing="0" width="100%" id="commandes" class="ligne_cmd">
                            <tr>
                                <td width="6%" class="gras">Date</td>
                                <td width="15%" class="centre gras">Heure</td>
                                <td width="40%" class="centre gras">Client</td>
                                <td width="15%" class="centre gras">Montant total TTC</td>
                                <td width="5%" class="centre gras">Paiement</td>
                            </tr>
                            <?php
                                $compteur = 0;
								$lect_cmd = "SELECT * FROM illi21_commandes where c_paiement = '1' ORDER BY c_date DESC, c_heure DESC ".$rqadd." ;";
	
	
								
								
								// echo $lect_cmd;
                                $res_lect_cmd = mysqli_query($lien,$lect_cmd) or die ("Erreur");
                                while($cmd = mysqli_fetch_object($res_lect_cmd)){
                                    
                                    
                                    $datecmd = explode("-", $cmd->c_date);
                                    $total = $cmd->c_total;
                                    
                                    if($compteur%2)
                                        $bg = '#d1d1d1';
                                    else
                                        $bg = '#e3e3e3';
                                        
                                    
                                        
                                    if($cmd->c_paiement == '1')
                                        $bgvalide = '#1b9200';
                                    else
                                        $bgvalide = '#e10000';
                            	?>
                                <tr bgcolor="<?php echo $bg; ?>" height="10" style="border-bottom:1px white solid;">
                                    <td width="6%"><?php echo $datecmd[2]."/".$datecmd[1]."/".$datecmd[0]; ?></td>
                                    <td width="15%" class="centre"><?php echo $cmd->c_heure; ?></td>
                                    <td width="40%" class="centre"><?php echo $cmd->f_civilite; ?> <?php echo "<strong>".stripslashes($cmd->f_nom); ?> <?php echo stripslashes($cmd->f_prenom); ?><?php echo "</strong> ".($cmd->l_mel); ?></td>
                                    <td width="15%" class="centre"><?php echo str_replace(".", ",", number_format($total, 2, '.', '')); ?> €</td>
                                    <td width="5%" class="centre blanc" bgcolor="<?php echo $bgvalide; ?>"><?php echo $cmd->c_type_paiement; ?></td>
                                </tr>
                                <?php
								// affichage du détail
								// Adresse de livraison
								
								
								
								
								// Détail de la commande
								
								// Le detail commande
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
											$produit = $ligne_cmd->d_produit;
											$quantite = $ligne_cmd->d_quantite ;
											$prix_unit = $ligne_cmd->d_prix_unit ;
											$prix_total = $ligne_cmd->d_prix_total ;
											?>
                                            <tr class="lignecmd">
                                                <td colspan="5">
                                                    <table border="0" cellpadding="1" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="76%" colspan="6"><?php echo $produit; ?></td>
                                                            <td width="6%"><?php echo $quantite; ?></td>
                                                            <td width="8%" align="right"><?php echo $prix_unit; ?>€</td>
                                                            <td width="10%" align="right"><?php echo $prix_total; ?>€</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php
										}else{
											// PEINTURE
											// Le support
											$support = $ligne_cmd->d_support ;
											$requet_ = "SELECT id_s as id, sup_nom as nom FROM illi21_support where id_s = '".$support."'";
											$resultat_    = mysqli_query($lien, $requet_);
											$lect_res_    = mysqli_fetch_object($resultat_); 
											$lesupport    = "&nbsp;".($lect_res_->nom);
											
											
											// Le contenant
											$contenant= $ligne_cmd->d_contenant ;
											$requet_ = "SELECT id_c as id, cont_nom as nom FROM illi21_contenant where id_c = '".$contenant."'";
											$resultat_    = mysqli_query($lien, $requet_);
											$lect_res_    = mysqli_fetch_object($resultat_); 
											$lecontenant   = "&nbsp;".$lect_res_->nom;
											
											// Le nuancier
											$nuancier = $ligne_cmd->d_nuancier ;
											$requet_ = "SELECT id_n as id, nunom as nom FROM illi21_nuancier where id_n = '".$nuancier."'";
											$resultat_    = mysqli_query($lien, $requet_);
											$lect_res_    = mysqli_fetch_object($resultat_); 
											$lenuancier   = "&nbsp;".$lect_res_->nom;
											
											
											$couleur = $ligne_cmd->d_rf_couleur ;
											$lacouleur = $ligne_cmd->d_nom_couleur ;
											$brillance = $ligne_cmd->d_brillance;
											$quantite = $ligne_cmd->d_quantite ;
											$prix_unit = $ligne_cmd->d_prix_unit ;
											$prix_total = $ligne_cmd->d_prix_total ;
											?>
                                            <tr class="lignecmd">
                                                <td colspan="5">
                                                    <table border="0" cellpadding="1" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="6%" style="background:<?php echo $lacouleur; ?>">&nbsp; </td>
                                                            <td width="20%"><?php echo $couleur ;?></td>
                                                            <td width="10%"><?php echo $lesupport; ?></td>
                                                            <td width="15%"><?php echo $lenuancier; ?></td>
                                                            <td width="8%"><?php echo $brillance; ?></td>
                                                            <td width="17%"><?php echo $lecontenant; ?></td>
                                                            <td width="6%"><?php echo $quantite; ?></td>
                                                            <td width="8%" align="right"><?php echo $prix_unit; ?>€</td>
                                                            <td width="10%" align="right"><?php echo $prix_total; ?>€</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php
										}
								}
								
								if(($cmd->c_code <> ""))
									{
									// Ligne code promo
									?>
                                            <tr class="lignecmd">
                                                <td colspan="5">
                                                    <table border="0" cellpadding="1" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="100%" colspan="6"><i>Code promo : <?php echo $cmd->c_code; ?></i></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php
									}
								if(($cmd->c_pourc > 0) and ($cmd->c_reduc > 0))
									{
									// Ligne montant de la réduction 
									?>
                                            <tr class="lignecmd">
                                                <td colspan="5">
                                                    <table border="0" cellpadding="1" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="76%" colspan="6"><i>Réduction Pro en compte <?php echo $cmd->c_pourc ;?> % H.T.</i></td>
                                                            <td width="6%"></td>
                                                            <td width="8%" align="right"></td>
                                                            <td width="10%" align="right"><i>-<?php echo $cmd->c_reduc; ?>€</i></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php
									}
								if(($cmd->c_fdp > 0))
									{
									// Ligne montant des frais de port
									?>
                                            <tr class="lignecmd">
                                                <td colspan="5">
                                                    <table border="0" cellpadding="1" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td width="76%" colspan="6"><i>Frais de port H.T.</i></td>
                                                            <td width="6%"></td>
                                                            <td width="8%" align="right"></td>
                                                            <td width="10%" align="right"><i><?php echo $cmd->c_fdp; ?>€</i></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php
									}
								echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
								?>
                            <?php
                                    $compteur++;
                                }
                            ?>     
                            </table>
							<?php 
							if(!$toutes)
							{
							?>
								<a href="adm_commandes.php?t=s" class="voir">Voir toutes les commandes</a>
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
