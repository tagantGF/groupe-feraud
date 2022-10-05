<?php

include "includes/config.php";

if(isset($_GET['refcherche']) and isset($_GET['marques'])) {

	$json = array();
	$larec = securiseFormulaire($_GET['refcherche']); // Les mots recherchés
	
	
	
	
	$lesmarques = securiseFormulaire($_GET['marques']); // Les marques recherchées

	$condition = "1 = 1";
	
	$recref = "7 = 7";
	
	if ($larec <> "") 
	{
		// Explode by " " to get an Array
		$search_nom = explode(" ",$larec);
		
		// Create condition
		$condition_arr = array();
		$ref_arr = array();
		foreach($search_nom as $vlnom){
			$condition_arr[] = " p_nom like '%".$vlnom."%'";
			$ref_arr[] = " p_ref like '%".$vlnom."%'";
		}
		if(count($condition_arr) > 0){
			$condition = "".implode(" and ",$condition_arr);
			$recref = "".implode(" and ",$ref_arr);
		  }
	}else{
		$condition = "2 = 2";
	}
	
	if($lesmarques <> "") {
		$remarque = " and ( ";
		$search_explode = explode(",",$lesmarques);
		
		foreach($search_explode as $value){
			$remarque .= " p_nuancier like '".$value."' or " ;
		  }
		$remarque =  rtrim($remarque, 'or ');
		$remarque .= " )";
		$condition .= $remarque;
	}

	
	if ($larec <> "") 
	{
		// Recherche avec mots clé
		$query = "SELECT * FROM illi21_poudre where ".$condition." or ".$recref;
	}else{
		// Marque seule
		$query = "SELECT * FROM illi21_poudre where ".$condition;
	}
	$result = mysqli_query($con,$query); 
	$row_cnt = mysqli_num_rows($result);
	if ($row_cnt > 0)
	{
		while($row = mysqli_fetch_assoc($result) ){
			$response[] = array("value"=>$row['p_ref'],"label"=>($row['p_nom']),"marque"=>$row['p_nuancier']);
		}
	}else{
		$response = "";
	}
	

	// $json['1'][] = $query;
	
	


	// envoi du résultat au success
   echo json_encode($response);
}