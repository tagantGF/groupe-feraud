<?php

include "includes/config.php";

if(isset($_POST['search'])){

  // Search value
  $search = $_POST['search'];

  // Explode by " " to get an Array
  $search_explode = explode(" ",$search);

  // Create condition
  $condition_arr = array();
  $ref_arr = array();
  foreach($search_explode as $value){
    $condition_arr[] = " p_nom like '%".$value."%'";
	$ref_arr[] = " p_ref like '%".$value."%'";
  }

  $condition = " ";
  if(count($condition_arr) > 0){
    $condition = "WHERE".implode(" and ",$condition_arr);
	$recref = "".implode(" and ",$ref_arr);
  }
 
  // Select Query
  $query = "SELECT * FROM illi21_poudre ".$condition." or ".$recref;

  $result = mysqli_query($con,$query); 
  while($row = mysqli_fetch_assoc($result) ){
    $response[] = array("value"=>$row['idp'],"label"=>$row['p_nom'];
  }
 
  echo json_encode($response);
}

exit;