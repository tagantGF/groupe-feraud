<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../includes/fonctionsqli.php';
$lien = connexionBDD();

if(isset($_GET['famille']) && is_numeric($_GET['famille'])){
	$id_famille = $_GET['famille'];

    $lect_sous_familles = "SELECT * FROM illi21_familles_sous WHERE sf_famille = '$id_famille' ORDER BY sf_ordre ASC;";
    $res_lect_sous_familles = mysqli_query($lien,$lect_sous_familles) or die ("Erreur");
	$row_cnt = mysqli_num_rows($res_lect_sous_familles);
	if($row_cnt > 0)
	{
		
		?>
        
        <select name="sfamille" id="aff_sous_famille"  class="form-control">
			<option value="%">Toutes</option>
			<?php 
		    while($sous_familles = mysqli_fetch_object($res_lect_sous_familles))
			{
			?>
				<option value="<?php echo $sous_familles->id_sous_famille; ?>"><?php echo utf8_encode($sous_familles->sf_libelle); ?></option>
			<?php	
			}
		?>
        </select>
        <?php
	}else{
		?><i>Aucune sous famille disponible.</i><?php
	}
}else{
	echo "<p>Aucune sous famille disponible.</p>";
}
?>