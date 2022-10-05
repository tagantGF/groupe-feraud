<?php
	session_start();
	require_once 'admin/includes/fonctionsqli.php';
	$lien = connexionBDD();
    $lien -> set_charset("utf8");
?>
<!doctype html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
// Si le formulaire de creation a bien ete poste
$date 		= date('Y-m-d');
$heure 		= date('H:i:s');
$lienfic = "https://temoignages-viessmann.fr/cible/cible1206408827.csv";

$fichier = @fopen($lienfic, 'r');
$linesCount = 0;
if ($fichier) 
	{
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
    ?>
    <p style="font-size:14px">Votre fichier comporte <strong class="rouge"><?php echo $linesCount; ?></strong> &eacute;l&eacute;ments.<br />
    
    <?php
	// Import REEL
    // Efface la base actuelle
    
     $suppression  = "delete from `illi21_clientsilli`;";
     $res_suppression = mysqli_query($lien,$suppression) or die ("Erreur suppression clients");
    
    
     $suppression  = "ALTER TABLE `illi21_clientsilli` auto_increment = 100;";
     $res_suppression = mysqli_query($lien,$suppression) or die ("Erreur suppression clients");
    
    

     $fichier = @fopen($lienfic, 'r');
     if ($fichier) 
    {
         unlink("cible/rapport.txt");
         $fp1 = fopen('cible/rapport.txt', 'w');
         $i=0;
         while(!feof($fichier))
         {
             $i++;
             $ligne		= fgets($fichier,1024);
           
             $element	= explode(";", $ligne);
            
             $_clicode	= mysqli_real_escape_string($lien,$element[0]);
             $_clinom	= mysqli_real_escape_string($lien,$element[1]);
             $_clicp  	= mysqli_real_escape_string($lien,$element[2]);
            
          
            
             if($_clicode <> '')
             {
                 $res_enr_contact = mysqli_query($lien,"INSERT INTO `illi21_clientsilli` (`clicode`, `clinom`, `clicp`, `dt`, `hr`, `cli_reduc`) VALUES ('$_clicode','$_clinom','$_clicp','$date','$heure', '20');") or die ("Erreur enregistrement client");
             }
            
            
         }
         fclose($fichier);
        fclose($fp1);
        ?>
        <p style="font-size:14px">Fichier Client importé<br />
        <?php
    }
?>
</body>
</html>
