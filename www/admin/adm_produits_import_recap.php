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
						  <h1>Import de fichier CSV dans la base produits</h1>
						  <?php 
						  	// Si le formulaire de creation a bien ete poste
							if(isset($_POST['btnsuite']) and ($_FILES['lecsv']['name'] != ''))
							{
								$nomfic = "cible".rand().".csv";
								// charge le fichier cible en base
								$lecsv = envoi_document($nomfic, $_FILES['lecsv']['tmp_name'], "cible");
								$fichier = @fopen('cible/'.$nomfic.'', 'r');
								$linesCount = 0;
								if ($fichier) {
								   while (!feof($fichier)) 
								   {
										if(fgetc($fichier) == "\n")	
										{
											$linesCount++;
										}
								   }
									$linesCount++; // pour le EOF
									fclose($fichier);
								}
								
								$fichier = @fopen('cible/'.$nomfic.'', 'r');
								if ($fichier) 
								{
									unlink("cible/rapport.txt");
									$fp1 = fopen('cible/rapport.txt', 'w');
									$i=0;
									$y = -1;
									while(!feof($fichier))
									{
										$i++;
										$y++;
										$ligne		= fgets($fichier,4096);
										$ligne = mb_convert_encoding(($ligne), "UTF-8");
										if($i == '1')
										{
											// Passe la première ligne
											echo $i;
										}else{
											
											$element	= explode(";", strip_tags($ligne));
											// print_r($element);
											$_p_type		= mysqli_real_escape_string($lien,$element[0]);
											$_p_decli_nom	= mysqli_real_escape_string($lien,$element[1]);
											$_p_nom			= mysqli_real_escape_string($lien,$element[2]);
											$_p_ref			= mysqli_real_escape_string($lien,$element[3]);
											$_p_famille		= mysqli_real_escape_string($lien,$element[4]);
											$_p_sfamille	= mysqli_real_escape_string($lien,$element[5]);
											$_p_des_com		= mysqli_real_escape_string($lien,$element[6]);
											$_p_prix_ht		= mysqli_real_escape_string($lien,$element[7]);
											$_p_poids		= mysqli_real_escape_string($lien,$element[8]);
											$_p_photo		= mysqli_real_escape_string($lien,$element[9]);
											$_p_photo_2		= mysqli_real_escape_string($lien,$element[10]);
											$_p_photo_3		= mysqli_real_escape_string($lien,$element[11]);
											$_p_pdf			= mysqli_real_escape_string($lien,$element[12]);
											$_p_enligne		= mysqli_real_escape_string($lien,$element[13]);
											$_p_ordre		= mysqli_real_escape_string($lien,$element[14]);
											

											if($_p_type == 's')
											{
												if($_p_famille <> "")
												{
												
													// La famille
													$_lafamille = rtrim($_p_famille);
													$lareqrec = "SELECT id_famille, f_libelle FROM illi21_familles where f_libelle like '$_p_famille'";
													// echo $lareqrec."<br>";
													$res_recherche = mysqli_query($lien, $lareqrec);
													$nbre_res = mysqli_num_rows($res_recherche);
													if($nbre_res == 0 ) 
														{
															if ($_lafamille <> '')
															{
																$l1 = "\n. La famille n'existe pas (la fiche sera importée sans être attachée à une famille) : ".$_lafamille." : \n";
																fputs($fp1, $l1);
															}
															$_lafamille = "";
														}
												
												
												}else{
													$l1 = "\n. La famille est vide (la fiche sera importée sans être attachée à une famille) : ".$_lafamille." : \n";
													fputs($fp1, $l1);
												}
												
												if($_p_sfamille <> "")
												{
												
													// La sousfamille
													$_lasousfamille = rtrim($_p_sfamille);
													$lareqrec = "SELECT id_sous_famille, sf_libelle FROM illi21_familles_sous where sf_libelle like '$_lasousfamille'";
													// echo $lareqrec;
													$res_recherche = mysqli_query($lien, $lareqrec);
													$nbre_res = mysqli_num_rows($res_recherche);
													if($nbre_res == 0 ) 
														{
															if ($_lasousfamille <> '')
															{
																$l1 = "\n. La sous famille n'existe pas (la fiche sera importée sans être attachée à une sous famille) : ".$_lasousfamille." : \n";
																fputs($fp1, $l1);
															}
															$_lasousfamille = "";
														}
													
												
												
												}else{
													$l1 = "\n. La sous famille est vide (la fiche sera importée sans être attachée à une sous famille) : ".$_p_sfamille." : \n";
													fputs($fp1, $l1);
												}
												
											}
											$mm = 0;
											if($_p_type == 'm')
											{
												$mm++;
												// Le premier est le produit
												if ($mm == 1)
												{
													if($_p_famille <> "")
													{
													
														// La famille
														$_lafamille = rtrim($_p_famille);
														$lareqrec = "SELECT id_famille, f_libelle FROM illi21_familles where f_libelle like '$_p_famille'";
														// echo $lareqrec."<br>";
														$res_recherche = mysqli_query($lien, $lareqrec);
														$nbre_res = mysqli_num_rows($res_recherche);
														if($nbre_res == 0 ) 
															{
																if ($_lafamille <> '')
																{
																	$l1 = "\n. La famille n'existe pas (la fiche sera importée sans être attachée à une famille) : ".$_lafamille." : \n";
																	fputs($fp1, $l1);
																}
																$_lafamille = "";
															}
													
													
													}else{
														$l1 = "\n. La famille est vide (la fiche sera importée sans être attachée à une famille) : ".$_lafamille." : \n";
														fputs($fp1, $l1);
													}
													
													if($_p_sfamille <> "")
													{
													
														// La sousfamille
														$_lasousfamille = rtrim($_p_sfamille);
														$lareqrec = "SELECT id_sous_famille, sf_libelle FROM illi21_familles_sous where sf_libelle like '$_lasousfamille'";
														// echo $lareqrec;
														$res_recherche = mysqli_query($lien, $lareqrec);
														$nbre_res = mysqli_num_rows($res_recherche);
														if($nbre_res == 0 ) 
															{
																if ($_lasousfamille <> '')
																{
																	$l1 = "\n. La sous famille n'existe pas (la fiche sera importée sans être attachée à une sous famille) : ".$_lasousfamille." : \n";
																	fputs($fp1, $l1);
																}
																$_lasousfamille = "";
															}
														
													
													
													}else{
														$l1 = "\n. La sous famille est vide (la fiche sera importée sans être attachée à une sous famille) : ".$_p_sfamille." : \n";
														fputs($fp1, $l1);
													}
													
													
												
												}
												
												
												// Les suivants sont les déclinaisons
											
											}
											
											// print_r($element);
											
											// Les vérifications
											
											
											

											
											
											
											
											
										}
										
										
									}
									fclose($fichier);
									fclose($fp1);
								}
								$linesCount = $linesCount-1;
								?>
								<p style="font-size:14px">Votre fichier comporte <strong class="rouge"><?php echo $linesCount; ?></strong> &eacute;l&eacute;ments.<br />
								<br /><a href="cible/rapport.txt" target="_blank"><strong>Voir le rapport d'analyse avant import</a><br />
								<br />
								<form method="post" action="adm_produits_import_recap.php?_fic=<?php echo $nomfic; ?>" name="aj_doc" id="aj_doc">

								
									<input type="submit" id="btnimport" name="btnimport" value="Lancer l'import" />
									
								</form>
								</p>
								<?php
							}else{
							
								// IMPORT REEL 
								$nomfic = $_GET['_fic'];
								$fichier = @fopen('cible/'.$nomfic.'', 'r');
								$i = 0;
								if ($fichier) 
								{
									while(!feof($fichier))
									{
										$i++;
										if($i > 200){
											break;
										}
										$ligne		= fgets($fichier,4096);
										$ligne = mb_convert_encoding(($ligne), "UTF-8");
										if (1 == 1)
										{
											
										
											
											
											$element	= explode(";", strip_tags($ligne));
											// print_r($element);
											$_p_type		= mysqli_real_escape_string($lien,$element[0]);
											$_p_decli_nom	= (mysqli_real_escape_string($lien,$element[1]));
											$_p_nom			= (mysqli_real_escape_string($lien,$element[2]));
											$_p_ref			= mysqli_real_escape_string($lien,$element[3]);
											$_p_famille		= (mysqli_real_escape_string($lien,$element[4]));
											$_p_sfamille	= (mysqli_real_escape_string($lien,$element[5]));
											$_p_des_com		= (mysqli_real_escape_string($lien,$element[6]));
											$_p_prix_ht		= mysqli_real_escape_string($lien,$element[7]);
											$_p_poids		= mysqli_real_escape_string($lien,$element[8]);
											$_p_photo		= mysqli_real_escape_string($lien,$element[9]);
											$_p_photo_2		= mysqli_real_escape_string($lien,$element[10]);
											$_p_photo_3		= mysqli_real_escape_string($lien,$element[11]);
											$_p_pdf			= mysqli_real_escape_string($lien,$element[12]);
											$_p_enligne		= mysqli_real_escape_string($lien,$element[13]);
											$_p_ordre		= mysqli_real_escape_string($lien,$element[14]);
											

											if($_p_type == 's')
											{
												if($_p_famille <> "")
												{
												
													// La famille
													$_lafamille = rtrim($_p_famille);
													$lareqrec = "SELECT id_famille, f_libelle FROM illi21_familles where f_libelle like '$_p_famille'";
													// echo $lareqrec."<br>";
													$res_recherche = mysqli_query($lien, $lareqrec);
													$nbre_res = mysqli_num_rows($res_recherche);
													if($nbre_res == 0 ) 
														{
															$_lafamille = "";
														}else{
															$unefamille = mysqli_fetch_object($res_recherche);
															$_lafamille = $unefamille->id_famille;
														}
												
												
												}else{
													$l1 = "\n. La famille est vide (la fiche sera importée sans être attachée à une famille) : ".$_lafamille." : \n";
													fputs($fp1, $l1);
												}
												
												if($_p_sfamille <> "")
												{
												
													// La sousfamille
													$_lasousfamille = rtrim($_p_sfamille);
													$lareqrec = "SELECT id_sous_famille, sf_libelle FROM illi21_familles_sous where sf_libelle like '$_lasousfamille'";
													// echo $lareqrec;
													$res_recherche = mysqli_query($lien, $lareqrec);
													$nbre_res = mysqli_num_rows($res_recherche);
													if($nbre_res == 0 ) 
														{
															$_lasousfamille = "";
														}else{
															$unesoufam = mysqli_fetch_object($res_recherche);
															$_lasousfamille = $unesoufam->id_sous_famille;
														}
													
												
												
												}else{
													$l1 = "\n. La sous famille est vide (la fiche sera importée sans être attachée à une sous famille) : ".$_p_sfamille." : \n";
													fputs($fp1, $l1);
												}
												
											}
											$mm = 0;
											if($_p_type == 'm')
											{
												
												if($_p_famille <> "")
												{
												
													// La famille
													$_lafamille = rtrim($_p_famille);
													$lareqrec = "SELECT id_famille, f_libelle FROM illi21_familles where f_libelle like '$_p_famille'";
													// echo $lareqrec."<br>";
													$res_recherche = mysqli_query($lien, $lareqrec);
													$nbre_res = mysqli_num_rows($res_recherche);
													if($nbre_res == 0 ) 
														{
															$_lafamille = "";
														}else{
															$unefamille = mysqli_fetch_object($res_recherche);
															$_lafamille = $unefamille->id_famille;
														}
												
												
												}else{
													$l1 = "\n. La famille est vide (la fiche sera importée sans être attachée à une famille) : ".$_lafamille." : \n";
													fputs($fp1, $l1);
												}
												
												if($_p_sfamille <> "")
												{
												
													// La sousfamille
													$_lasousfamille = rtrim($_p_sfamille);
													$lareqrec = "SELECT id_sous_famille, sf_libelle FROM illi21_familles_sous where sf_libelle like '$_lasousfamille'";
													// echo $lareqrec;
													$res_recherche = mysqli_query($lien, $lareqrec);
													$nbre_res = mysqli_num_rows($res_recherche);
													if($nbre_res == 0 ) 
														{
															$_lasousfamille = "";
														}else{
															$unesoufam = mysqli_fetch_object($res_recherche);
															$_lasousfamille = $unesoufam->id_sous_famille;
														}
													
												
												
												}else{
													$l1 = "\n. La sous famille est vide (la fiche sera importée sans être attachée à une sous famille) : ".$_p_sfamille." : \n";
													fputs($fp1, $l1);
												}
											
											}
											
											// print_r($element);
											
											// Les vérifications
											
											
											$date 				= date('Y-m-d');
							                $heure 			= date('H:i:s');				
											
											
										
											
											
											$insertion  = "INSERT INTO `illi21_produits` (`dt`,`hr`, `p_type`,`p_declinaison`,`p_nom`, `p_ref`, `p_famille`, `p_sfamille`, `p_des_com`, `p_prix_ht`, ";
											$insertion .= "`p_poids`, `p_taux_tva`, `p_photo`, `p_photo_2`, `p_photo_3`, `p_pdf`, `p_enligne`, `p_ordre`) VALUES (";
											
											$insertion .= "'$date','$heure','$_p_type','$_p_decli_nom', '$_p_nom','$_p_ref','$_lafamille','$_lasousfamille','$_p_des_com','$_p_prix_ht', ";
											$insertion .= "'$_p_poids','1','$_p_photo','$_p_photo_2','$_p_photo_3','$_p_pdf	','$_p_enligne','$_p_ordre');";
											// echo $insertion."<br>";
											$res_enr_produit = mysqli_query($lien,$insertion) or die ("Erreur enregistrement produit");
										}
										
										
										
									}
									fclose($fichier);
									echo "<p>".$i."Le fichier de produits a bien été importé. Merci de déposer les images et les documents dans les dossiers respectifs.</p>";
								}
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
