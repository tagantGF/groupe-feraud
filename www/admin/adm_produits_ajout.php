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
<script type="text/javascript">
  $(document).ready(function(){
	$("input[name='type_prod']").click(function(){
	  var val = $(this).attr("value");
	  var target = $("." + val);
	  $(".msg").not(target).hide();
	  $(target).show();
	});
  });
</script>
<script language="JavaScript" type="text/javascript">
        var nombreChamp = 0;
    function test(what)
		{
		if(what == 'plus')
			{
			 // Ajout du champ Libelle de la variation
			 var lib_prod = document.createElement("input" );
			 lib_prod.setAttribute("type", "text" );
			 lib_prod.setAttribute("name", "lib_prod" + nombreChamp);
			 lib_prod.setAttribute("id", "lib_prod" + nombreChamp);
			 lib_prod.setAttribute("class", "multinput");
			 lib_prod.setAttribute("required", "");
			 lib_prod.setAttribute("placeholder", "Libellé");
			 
			 // Ajout du champ reference de la variation
			 var ref_prod = document.createElement("input" );
			 ref_prod.setAttribute("type", "text" );
			 ref_prod.setAttribute("name", "ref_prod" + nombreChamp);
			 ref_prod.setAttribute("id", "ref_prod" + nombreChamp);
			 ref_prod.setAttribute("class", "multinput");
			 ref_prod.setAttribute("required", "");
			 ref_prod.setAttribute("placeholder", "Ref unique");
			 
			 
			 // Ajout du champ prix de la variation
			 var prix_prod = document.createElement("input" );
			 prix_prod.setAttribute("type", "number" );
			 prix_prod.setAttribute("name", "prix_prod" + nombreChamp);
			 prix_prod.setAttribute("id", "prix_prod" + nombreChamp);
			 prix_prod.setAttribute("pattern", "[0-9]+([\.,][0-9]+)?");
			 prix_prod.setAttribute("inputmode", "numeric");
			 prix_prod.setAttribute("step", "0.01");
			 prix_prod.setAttribute("required", "");   
			 prix_prod.setAttribute("class", "multinput");
			 prix_prod.setAttribute("placeholder", "0.00");
			 
			 var labelElem = document.createElement("label" );
			 labelElem.setAttribute("for", "champ" + nombreChamp);
			 var labelText = document.createTextNode("Choix " + nombreChamp);
			 labelElem.appendChild(labelText);
			
			 // Exemple avec un label ajouté devant le champ
			 // document.getElementById("myform" ).appendChild(labelElem);
			 document.getElementById("myform" ).appendChild(lib_prod);
			 document.getElementById("myform" ).appendChild(ref_prod);
			 document.getElementById("myform" ).appendChild(prix_prod);
			  document.getElementById("myform" ).appendChild(document.createElement("BR" ));
			 
			 nombreChamp++;
			}
		
		document.getElementById("nbmligne").value = nombreChamp;
		}
    </script>
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
						   <h1>Ajouter un produit</h1>
                           <?php
							if(isset($_POST['ajouter'])){
								// enregistrement de la fiche produit
								$date = date('Y-m-d');
								$heure = date('H:i:s');
								
								$typeprod 	= securiseFormulaire($_POST['type_prod']);
								
								if($typeprod == 's')
								{
									$nbligne	= "";
									$ref_prod	= securiseFormulaire($_POST['ref_prod']);
									$pds_prod	= "0";
									$prix_prod	= number_format(securiseFormulaire($_POST['prix_prod']), 3, '.', '');
									$nom_var	= "";
								}
								
								if($typeprod == 'm')
								{
									$nbligne	= securiseFormulaire($_POST['nbmligne']);
									$ref_prod	= "";
									$pds_prod	= "0";
									$prix_prod	= "";
									$nom_var	= securiseFormulaire($_POST['nom_var']); 
									
								}
								
								$nom_prod	= securiseFormulaire($_POST['nom_prod']);
								
								$frais_port	= securiseFormulaire($_POST['frais_port']);
								
								
								$famille	= securiseFormulaire($_POST['famille']);
								$sfamille	= securiseFormulaire($_POST['sfamille']);
								
								$enligne	= securiseFormulaire($_POST['enligne']);
								$desc_comm	= securiseFormulaire($_POST['desc_comm']);
								$desc_tech	= "";
								
								$p_ordre	= securiseFormulaire($_POST['p_ordre']);
								
								
								
								if($_FILES['photo1']['name'] != ''){
                                    $photo1 = envoyerImage(($_FILES['photo1']['name']), $_FILES['photo1']['tmp_name'], "../images/produits");	
                                }else{
                                    $photo1 = "";
                                }
								
								if($_FILES['photo2']['name'] != ''){
                                    $photo2 = envoyerImage(($_FILES['photo2']['name']), $_FILES['photo2']['tmp_name'], "../images/produits");	
                                }else{
                                    $photo2 = "";
                                }
								
								if($_FILES['photo3']['name'] != ''){
                                    $photo3 = envoyerImage(($_FILES['photo3']['name']), $_FILES['photo3']['tmp_name'], "../images/produits");	
                                }else{
                                    $photo3 = "";
                                }
								
								
								if($_FILES['lepdf']['name'] != ''){
                                    $lepdf = envoyerImage(($_FILES['lepdf']['name']), $_FILES['lepdf']['tmp_name'], "../documents");	
                                }else{
                                    $lepdf = "";
                                }
								
								$query_ajout_prod  = "INSERT INTO `illi21_produits` (`dt`, `hr`, `p_type`, `p_declinaison`, `p_nom`, `p_ref`, `p_famille`, `p_sfamille`, `p_des_com`, `p_des_tec`, `p_prix_ht`, `p_prix_ht_promo`,";
								$query_ajout_prod .= " `p_poids`, `p_taux_tva`, `p_prod_lie_1`, `p_prod_lie_2`, `p_prod_lie_3`, `p_photo`, `p_photo_2`, `p_photo_3`, `p_ordre`, `p_pdf`, `p_port`, `p_enligne`) VALUES (";
								$query_ajout_prod .= "'$date', '$heure', '$typeprod','$nom_var', '$nom_prod', '$ref_prod', '$famille', '$sfamille', '$desc_comm', '$desc_tech', '$prix_prod', '0',";
								$query_ajout_prod .= " '$pds_prod', '1', '0', '0', '0', '$photo1', '$photo2', '$photo3', '$p_ordre', '$lepdf' , '$frais_port', '$enligne');";
								$res_enr_prod	= mysqli_query($lien,$query_ajout_prod) or die ("Erreur enregistrement produit");
								$idprod = mysqli_insert_id($lien);
								if($typeprod == 'm' and $nbligne>0)
								{
									// Enregistre les déclinaisons
									for ($i = 0; $i < $nbligne; $i++) {
										$nomprod = 'lib_prod'.$i;
										$refprod = 'ref_prod'.$i;
										$pdsprod = '0';
										$priprod = 'prix_prod'.$i;
										$nom_decli	= securiseFormulaire($_POST[$nomprod]);
										$ref_decli	= securiseFormulaire($_POST[$refprod]);
										$pds_decli	= number_format(securiseFormulaire($_POST[$pdsprod]), 3, '.', '');
										$prix_decli	= number_format(securiseFormulaire($_POST[$priprod]), 3, '.', '');
										$query_ajout_decli   = "INSERT INTO `illi21_produits_var` (`id_prod`, `p_nom`, `p_ref`, `p_prix_ht`, `p_poids`, `p_enligne`)";
										$query_ajout_decli  .= " VALUES ";
										$query_ajout_decli  .= "( '$idprod','$nom_decli','$ref_decli','$prix_decli','$pds_decli', '1')";
										$res_enr__decli	= mysqli_query($lien,$query_ajout_decli) or die ("Erreur enregistrement déclinaison produit");
									}
									// Mets a jout le prix le plus bas du produit
									$rechercheprix = "SELECT MIN(p_prix_ht) as prixleplusbas from illi21_produits_var where id_prod = '$idprod';";
									// echo $rechercheprix;
									$res_prix_decli = mysqli_query($lien,$rechercheprix);
									$leprix = mysqli_fetch_object($res_prix_decli); 
									$prxproduit = $leprix->prixleplusbas;
									
									$query_modif_prod  = "UPDATE `illi21_produits` set  `p_prix_ht` = '$prxproduit' WHERE id_p = '$idprod ' limit 1;";

									$res_modif_prod	= mysqli_query($lien,$query_modif_prod) or die ("Erreur modification produit");
								
								}
								
								
                                ?>		
                                <p>Le produit a bien été ajouté.</p>
                                <p><a href="adm_produits_ajout.php" class="btn btn-info">En ajouter un autre</a></p>		
                                <p><a href="adm_produits.php" class="btn btn-info">Retour à la gestion des produits</a></p>
								<?php 
							}else{
							?>
                            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="aj_prod" id="aj_prod" enctype="multipart/form-data">
                            	<div class="mb-3 mt-4 row">
                                    <label for="famille" class="col-sm-2 col-form-label">Famille* : </label>
                                    <div class="col-sm-4">
                                    <select name="famille" id="famille" onChange="afficher_select_sf();" class="form-control">
                                        <option value="%">Toutes</option>
                                            <?php
                                            $lect_famille = "SELECT * FROM illi21_familles;";
                                            $res_lect_famille = mysqli_query($lien,$lect_famille) or die ("Erreur");
                                            while($famille = mysqli_fetch_object($res_lect_famille)){
                                                if(isset($_POST['valider']))
												{
                                                    if($_POST['famille'] == $famille->id_famille)
                                                        $sel = ' selected="selected"';
                                                    else
                                                        $sel = '';
                                                }else{
													$sel = '';
												}
                                            ?>
                                                        <option value="<?php echo $famille->id_famille; ?>"<?php echo $sel; ?>><?php echo ($famille->f_libelle); ?></option>
                                            <?php
                                            }
                                            ?>             
                                    </select>
                                    </div>
                                    <label for="sfamille"  class="col-sm-2 col-form-label">Sous famille : </label>
                                    <div class="col-sm-3">
                                    <span id="aff_sous_famille">
                                    <select name="sfamille" id="sfamille"  class="form-control">
                                        <option value="%">Toutes</option>
                                            <?php
                                            if(isset($_POST['valider'])){
                                                $lect_sfamille = "SELECT * FROM illi21_familles_sous WHERE sf_famille = '".$_POST['famille']."';";
                                                $res_lect_sfamille = mysqli_query($lien,$lect_sfamille) or die ("Erreur");
                                                while($sfamille = mysqli_fetch_object($res_lect_sfamille)){
                                                    if($_POST['sfamille'] == $sfamille->id_sous_famille)
                                                        $selsf = ' selected="selected"';
                                                    else
                                                        $selsf = '';
                                            ?>
                                                        <option value="<?php echo $sfamille->id_sous_famille; ?>"<?php echo $selsf; ?>><?php echo $sfamille->sf_libelle; ?></option>
                                            <?php	
                                                }
                                            }
                                            ?>
                                    </select>
                                    </span>
                                    </div>
                                </div>
                                
                                <div class="mb-3 mt-4 row">
                                    <label for="libelle" class="col-sm-2 col-form-label">Type* : </label>
                                    <div class="col-sm-4">
                                    	<div class="form-check form-check-inline"><input type="radio" name="type_prod" id="type_prod_s" value="s" class="form-check-input" required>Simple</div>
                                        <div class="form-check form-check-inline"><input type="radio" name="type_prod" id="type_prod_m" value="m" class="form-check-input">Multiple</div>
                                    </div>
                                    
                                    <label for="enligne" class="col-sm-2 col-form-label">En ligne : </label>
                                    <div class="col-sm-4">
                                        <select name="enligne" id="enligne" class="form-control">
                                            <option value="1" >Oui</option>
                                            <option value="0" selected="selected">Non</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 mt-4 row">
                                    <label for="libelle" class="col-sm-2 col-form-label">Nom* : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nom_prod" id="nom_prod" maxlength="128" required placeholder="128 caractères maxi" />
                                    </div>
                                 </div>
								
                                
                                
                                
                                <div class="mb-3 mt-4 row">
                                	<label for="libelle" class="col-sm-2 col-form-label">Descriptif commercial* : </label>
                                    <div class="col-sm-4"><textarea name="desc_comm" id="desc_comm"></textarea><script>CKEDITOR.replace( 'desc_comm', {height: 200, width:680});</script></div>
                                </div>
                                

                            	
                                
                                <div id="simple"  style="display:none;" class="s msg">
                                    <div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-2 col-form-label">Référence* : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="ref_prod" id="ref_prod" maxlength="30" required class="form-control" placeholder="Unique" />
                                        </div>
                                        <label for="libelle" class="col-sm-2 col-form-label">Prix H.T.* : </label>
                                        <div class="col-sm-4">
                                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" inputmode="numeric" step="0.01" name="prix_prod" id="prix_prod" maxlength="30" required class="form-control" placeholder="0.00" />
                                        </div>
                                    </div>
                                 </div>
                                <div id="multiple" style="display:none;" class="m msg">
                                	<div class="mb-3 mt-4 row">
                                        <label for="libelle" class="col-sm-4 col-form-label">Nom de la déclinaison * : </label>
                                        <div class="col-sm-8"><input type="text" class="form-control" name="nom_var" id="nom_var" maxlength="128" required placeholder="Contenance, Taille, ..." /></div>
                                    </div>
                                	<div class="mb-3 mt-4 row">
                                    	<label for="libelle" class="col-sm-2 col-form-label">Libellé : </label>
                                        <label for="libelle" class="col-sm-3 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Référence : </label>

                                        <label for="libelle" class="col-sm-3 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;Prix H.T. : </label>
                                        <div class="col-sm-4 col-form-label text-right">
                                        <input type="button" onClick="test('plus');" value="ajouter une ligne" class="alert-info">
                                        </div>
                                    </div>
                                 	<div class=" row">
                                    	

                                        <input type="hidden" name="nbmligne" id="nbmligne" value="0" />
                                    	<div name="myform" id="myform">
                                        
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="mb-3 mt-4 row">
                                	<label for="libelle" class="col-sm-2 col-form-label">Fichier PDF : </label>
                                    <div class="col-sm-6">
                                    	<input type="file" class="form-control" name="lepdf" id="lepdf" size="60" />
                                    </div>
                                    <span class="col-sm-4"><i>Format conseillé : PDF maxi 2Mo </i></span>
                                </div>
                                <div class="mb-3 mt-4 row">
                                	<label for="libelle" class="col-sm-2 col-form-label">Photo 1* : </label>
                                    <div class="col-sm-6">
                                    	<input type="file" class="form-control" name="photo1" id="photo1" size="60" required />
                                    </div>
                                    <span class="col-sm-4"><i>Format conseillé "Carré" 600px x 600px </i></span>
                                </div>
                                <div class="mb-3 mt-4 row">
                                	<label for="libelle" class="col-sm-2 col-form-label">Photo 2 : </label>
                                    <div class="col-sm-6">
                                    	<input type="file" class="form-control" name="photo2" id="photo2" size="60"  />
                                    </div>
                                    
                                </div>
                                <div class="mb-3 mt-4 row">
                                	<label for="libelle" class="col-sm-2 col-form-label">Photo 3 : </label>
                                    <div class="col-sm-6">
                                    	<input type="file" class="form-control" name="photo3" id="photo3" size="60" />
                                    </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                                	<label for="libelle" class="col-sm-2 col-form-label">Frais de port* : </label>
                                    <div class="col-sm-6">
                                    	<input type="radio" name="frais_port" id="frais_port_s" value="exp" required> Express<br>
                                        <input type="radio" name="frais_port" id="frais_port_x" value="exphg"> Express hors gabarit<br>
                                        <input type="radio" name="frais_port" id="frais_port_m" value="msg"> Messagerie<br>
                                    </div>
                                </div>
                                <div class="mb-3 mt-4 row">
                                    <label for="libelle" class="col-sm-4 col-form-label">Ordre d'affichage par defaut : </label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="p_ordre" id="p_ordre" maxlength="10" value="1" />
                                    </div>
                                 </div>
                                <div class="mb-3 mt-4 row">
                                        <div class="col-sm-9">
                                        <input type="submit" name="ajouter" id="ajouter" value="Ajouter le produit" class="btn btn-success" />
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
