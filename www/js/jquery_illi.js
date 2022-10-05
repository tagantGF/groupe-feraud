// JavaScript Document

function parseDecimalRoundAndFixed(num,dec){
  var d =  Math.pow(10,dec);
  return (Math.round(num * d) / d).toFixed(dec);
}

$(document).ready(function() 
	{
		var dynamic = $('#commande');
		var static = $('#static');
		
		static.height(dynamic.height() + 20);
		
		//console.log(dynamic.height());
		// console.log(static.height());
		
		dynamic.on('change', function() 
		{
			static.height(dynamic.height() + 20);
		});
		
		var $supports = $('#supports');
		
		var $nuanciers = $('#nuanciers');
		var $couleurs = $('#couleurs');
		var $poudres = $('#poudre');
		var $contenant = $('#contenant');
		var $brillance = $('#brillance');
		var $macouleur = $('#macouleur');
		var $mapoudre = $('#mapoudre');
		var $prixbarre = $('#prixbarre');
		var $prixttc = $('#prixttc');
		var $prixht = $('#prixht');
		var $mttc = $('#mttc');
		var $nbpot = $('#nbpot');
		var $recpoudre = $('#searchpost');
		
		// chargement des supports
		$.ajax({
			url: 'support.php',
			data: 'go', // on envoie $_GET['go']
			dataType: 'json', // on veut un retour JSON
			success: function(json) 
			{
                // console.log("Chaque ligne");
				$.each(json, function(index, value) 
				{ // pour chaque noeud JSON
					// on ajoute l option dans la liste
					$supports.append('<option value="'+ index +'">'+ value +'</option>');
					
				});
			},
		 			  error: function (xhr, ajaxOptions, thrownError) {
		 				alert(xhr.status);
		 				alert(thrownError);
		 			  }
		});
		
		
		document.getElementById("ajoutpanier").disabled=true;
		
		$('#my_radio_box').change(function(){
            alert('Radio Box has been changed!');
        });
		
		
		// *****************************************
		// **** masque le layer poudre *************
		// *****************************************
		$("#fermer").click(function(){

		 document.getElementById('layer_poudre').style.display='none';
		});
		
		// *****************************************
		// à la sélection d un support dans la liste
		// *****************************************
		// ******** SUPPORT ************************
		// *****************************************
		
		$supports.on('change', function() 
		{
			var val = $(this).val(); // on récupère la valeur du support
	 		// console.log("Valeur : "+val);
			if(val != '') 
			{
				$prixbarre.empty();
				
				
				
				$nuanciers.empty(); // on vide la liste des nuanciers
				$brillance.empty(); // on vide la liste des brillances
				$couleurs.empty(); // on vide la liste des couleurs
				$contenant.empty(); // on vide la liste des contenants
				$prixttc.empty(); // on vide le prix
				$prixht.empty(); // on vide le prix
				$nbpot.empty(); // on vide le nb de pot
				$recpoudre.empty(); // on vide la recherche poudre
				
				document.commande.prixttc.value=''; // Vide le prix en cas de changement de support
				document.commande.prixht.value=''; // Vide le prix en cas de changement de support
				
				
				$brillance.append('<option value="" disabled selected value>Choisir la brillance</option>');
				$couleurs.append('<option value="" disabled selected value>Choisir le nuancier</option>');
				$contenant.append('<option value="" disabled selected value>Choisir le conditionnement</option>');
				$prixttc.append('0'); // on vide le prix
				$prixht.append('0'); // on vide le prix
				$nbpot.append('<option value="" disabled selected value>Quantit&eacute;</option>');
				document.getElementById('macouleur').style.display='none';
				document.getElementById('mapoudre').style.display='none';
				document.commande.larefpoudre.value='';
				document.getElementById('refpoudre').style.display='none';
				
				
				document.getElementById("ajoutpanier").disabled=true;
				$satin = "Satin\u00e9";
				// On met à jour la brillance
				switch(val) 
				{
					case '10':
						// Bois interieur
						$brillance.append('<option value="Mat">Mat (10% de brillance)</option>');
						$brillance.append('<option value="'+ $satin +'">'+ $satin +' (30% de brillance)</option>');
						$brillance.append('<option value="Brillant">Brillant (70% de brillance)</option>');
						break;
						
					case '20':
						// Bois exterieur
						$brillance.append('<option value="'+ $satin +'">'+ $satin +' (30% de brillance)</option>');
						break;
					
					case '30':
						// Métal
						$brillance.append('<option value="Mat">Mat (10% de brillance)</option>');
						$brillance.append('<option value="'+ $satin +'">'+ $satin +' (30% de brillance)</option>');
						$brillance.append('<option value="Brillant">Brillant (70% de brillance)</option>');
						break;
						
					case '40':
						// Alu
						$brillance.append('<option value="Mat">Mat (10% de brillance)</option>');
						$brillance.append('<option value="'+ $satin +'">'+ $satin +' (30% de brillance)</option>');
						$brillance.append('<option value="Brillant">Brillant (70% de brillance)</option>');
						break;
						
					case '50':
						// PVC
						$brillance.append('<option value="Mat">Mat (10% de brillance)</option>');
						$brillance.append('<option value="'+ $satin +'">'+ $satin +' (30% de brillance)</option>');
						$brillance.append('<option value="Brillant">Brillant (70% de brillance)</option>');
						break;
						
					default:
						alert('0');
				} 

				$('#supports').val(val);
				 
				$.ajax({
					url: 'supports.php',
					data: 'id_support='+ val, // on envoie $_GET['id_support']
					dataType: 'json',
					success: function(json) 
					{
						$nuanciers.append('<option value="" disabled selected value>Choisir le nuancier</option>');
						$.each(json, function(index, value) 
						{
							$nuanciers.append('<option value="'+ index +'" onClick="document.getElementById(\'layer_nuancier\').style.display=\'block\';">'+ value +'</option>');
							
						});
						$nuanciers.append('<option value="99" onClick="document.getElementById(\'layer_poudre\').style.display=\'block\'; document.getElementById(\'searchpost\').value=\'\';">POUDRE</option>');
						
						
					
					}
				});
			}else{
				// Pas de valeur donc on met tout à zero
				$nuanciers.empty(); // on vide la liste des nuanciers
				$brillance.empty(); // on vide la liste des brillances
				$couleurs.empty(); // on vide la liste des couleurs
				$contenant.empty(); // on vide la liste des contenants
				$prixttc.empty(); // on vide le prix
				$prixht.empty(); // on vide le prix
				
				$prixbarre.empty();
				
				
				$nbpot.empty(); // on vide le nb de pot
				$recpoudre.empty(); // on vide la recherche poudre
				document.getElementById('lenomdelacouleur').innerHTML = "";
				document.getElementById('lenomdelapoudre').innerHTML = "";
				document.getElementById('lenomdelaref').innerHTML = "";
				document.getElementById('mapoudre').style.display='none';
				document.getElementById('refpoudre').style.display='none';
				document.getElementById('pastillecouleur').style.backgroundColor="";
				$mttc.empty();
				document.commande.prixttc.value='';
				document.commande.prixht.value='';
			}
		});
	
		
		// *****************************************
		// à la sélection d un nuancier dans la liste on genere les couleurs du nuancier
		// *****************************************
		// ******** NUANCIER ************************
		// *****************************************
		
		$nuanciers.on('change', function() 
		{
				
			$couleurs.empty(); // on vide la liste des couleurs
			$contenant.empty(); // on vide la liste des contenants
			$prixttc.empty(); // on vide le prix
			$prixht.empty(); // on vide le prix
			
			$prixbarre.empty();
			
			
			document.commande.prixttc.value=''; // Vide le prix en cas de changement de support
			document.commande.prixht.value=''; // Vide le prix en cas de changement de support
			
			$nbpot.empty(); // on vide le nb de pot
			$recpoudre.empty(); // on vide la recherche poudre
			document.getElementById("ajoutpanier").disabled=true;
			var $resultligne = $('#resultligne');
			var val = $(this).val(); // on récupère la valeur du nuancier
			// console.log(val);
	 
			if(val != '') 
			{
				if(val != '99') 
				{
					$couleurs.empty(); // on vide la liste des couleurs
					$( "#layer_nuancier" ).show( "slow" );
					document.commande.idapoudre.value='';
					document.commande.larefpoudre.value='';
					document.getElementById('refpoudre').style.display='none';
					document.getElementById('layer_nuancier').style.display='block';
					document.getElementById('mabrillance').style.display='block';
					document.getElementById('mapoudre').style.display='none';
					
					$.ajax({
						url: 'couleur.php',
						data: 'id_nuancier='+ val, // on envoie $_GET['id_nuancier']
						dataType: 'json',
						success: function(json) 
						{
							$.each(json, function(index, value) 
							{
								var idpeinture = String(index);
								var lavaleur = String(value);
								var start_pos = lavaleur.split(/[;]/);;
								// alert(start_pos[0]);
								// console.log(start_pos[0]);
								if(start_pos[1] != ''){
								$couleurs.append('<div id= \"'+ idpeinture + '\" class=\"unenuance\" style=\"cursor:pointer;background:' + start_pos[1] + ';\" onclick=\"document.commande.lacouleur.value=\''+ start_pos[1] + '\';document.commande.idacouleur.value=\''+ idpeinture + '\';document.commande.larefcoul.value=\''+ start_pos[0] + '\';document.getElementById(\'layer_nuancier\').style.display=\'none\';document.getElementById(\'macouleur\').style.display=\'block\';document.getElementById(\'pastillecouleur\').style.backgroundColor=\'' + start_pos[1] + '\'; document.getElementById(\'lenomdelacouleur\').innerHTML = \'' + start_pos[0] +'\'\"><div class=\"refcoul\">' + start_pos[0] + '</div></div>');
								}
							});
						}
					});
				}else{
					
					document.getElementById('layer_nuancier').style.display='none';
					document.getElementById('layer_poudre').style.display='block';
					document.getElementById('mabrillance').style.display='none';
					document.commande.lacouleur.value='';
					document.commande.idacouleur.value='';
					document.commande.larefcoul.value='';
					document.commande.searchpost.value='';
					// document.commande.resultligne.value='';
					document.getElementById('searchpost').value='';
					document.getElementById('resultligne').value='';
					$resultligne.empty();
					$recpoudre.empty();
					
					$('#brillance').prop('required',false);
				}
			}
		});
	
		
	
		// *****************************************************************************
		// à la sélection d une couleur on affiche les contenants possibles
		// *****************************************************************************
		// ******** CONTENANTS *********************************************************
		// *****************************************************************************
			

		$("#couleurs").click(function(){
			static.height(dynamic.height() + 30);
			
			
			
			var valradio = $(supports).val();
			
	 		
	 		// console.log("Valeur : "+valradio);
			if(valradio != '') 
			{
				$contenant.empty(); // on vide la liste des contenants
				 
				$.ajax({
					url: 'contenant.php',
					// data: 'id_couleur='+ val, // on envoie $_GET['id_couleur']
					data: 'id_support='+ valradio, // on envoie $_GET['id_support']
					dataType: 'json',
					success: function(json) 
					{
						$contenant.append('<option value="" disabled selected value>Choisir le conditionnement</option>');
						$.each(json, function(index, value) 
						{
							$contenant.append('<option value="'+ index +'" ">'+ value +'</option>');
						});
					}
				});
			}
		});
		
		
		// *****************************************************************************
		//au click sur la couleur on reaffiche le nuancier
		// *****************************************************************************
		// ******** PRIX ***************************************************************
		// *****************************************************************************
			$("#blocoul").click(function(){
				var val = $(nuanciers).val(); // on récupère la valeur de la couleur
				document.getElementById("ajoutpanier").disabled=true;
		 
				if(val != '') 
				{
					$couleurs.empty(); // on vide la liste des couleurs
					$contenant.empty(); // on vide la liste des contenants
					$prixttc.empty(); // on vide le prix
					$prixht.empty(); // on vide le prix
					
					$prixbarre.empty();
					
					
					$mttc.empty();
					document.commande.prixttc.value='';
					document.commande.prixht.value='';
					document.commande.mttc.value='';
					$nbpot.empty(); 
					$( "#layer_nuancier" ).show( "slow" );
					$.ajax({
						url: 'couleur.php',
						data: 'id_nuancier='+ val, // on envoie $_GET['id_nuancier']
						dataType: 'json',
						success: function(json) 
						{
							$.each(json, function(index, value) 
							{
								var idpeinture = String(index);
								var lavaleur = String(value);
								var start_pos = lavaleur.split(/[;]/);;
								// alert(start_pos[0]);
								if(start_pos[1] != ''){
								$couleurs.append('<div id= \"'+ idpeinture + '\" class=\"unenuance\" style=\"cursor:pointer;background:' + start_pos[1] + ';\" onclick=\"document.commande.lacouleur.value=\''+ start_pos[1] + '\';document.commande.idacouleur.value=\''+ idpeinture + '\';document.commande.larefcoul.value=\''+ start_pos[0] + '\';document.getElementById(\'layer_nuancier\').style.display=\'none\';document.getElementById(\'macouleur\').style.display=\'block\';document.getElementById(\'pastillecouleur\').style.backgroundColor=\'' + start_pos[1] + '\'; document.getElementById(\'lenomdelacouleur\').innerHTML = \'' + start_pos[0] +'\'\"><div class=\"refcoul\">' + start_pos[0] + '</div></div>');
								}
							});
						}
					});
				}
			});
		
		
		// *****************************************************************************
		// ********* à la sélection d un contenant dans la liste on genere le prix *****
		// *****************************************************************************
		// ******** PRIX ***************************************************************
		// *****************************************************************************
		$contenant.on('change', function() 
		{
			var val = $(this).val(); // on récupère la valeur du contenant
			var valc = $(idacouleur).val(); // on récupère la valeur de la couleur
			
			var clientbatifer = $("#clientbatifer").val();
			// console.log(clientbatifer);
			
			
			if(val != '' && valc != '') 
			{
				// Version RAL et SIKKENS
				// console.log(val);
				// console.log(valc);
				
				$prixttc.empty(); // on vide le champ prix et on calcule le prix unitaire
				$prixht.empty();
				
				$prixbarre.empty();
				
				
				document.commande.prixttc.value=''; // Vide le prix en cas de changement de support
				document.commande.prixht.value=''; // Vide le prix en cas de changement de support
				
				$mttc.empty();
				$nbpot.empty(); // on vide le champ prix et on calcule le prix unitaire
				
				$.ajax({
					url: 'prix.php',
					data: 'id_contenant='+ val + '&id_couleur='+ valc, // on envoie $_GET['id_contenant'] et $_GET['id_couleur']
					dataType: 'json',
					success: function(json) 
					{
						$.each(json, function(index, value) 
						{
							if(clientbatifer > 0)
							{
								// var leprix_barre	= parseDecimalRoundAndFixed(value * 1.2,2);
								// $("#prixbarre").css("display", "inline");
								// $prixbarre.empty().append(''+ leprix_barre);
								// $("#prixbarre"). addClass('prix_barre');
								
								// Calcule le prix avec reduction client batifer
								var prixttcnew = (value * 1.2) - ((value * 1.2) * clientbatifer / 100)
								prixttcnew = parseDecimalRoundAndFixed(prixttcnew,2);
								
								var prixhtcnew = value - (value * clientbatifer / 100)
								prixhtcnew = parseDecimalRoundAndFixed(prixhtcnew,2);
								
								
								
								

								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
								$mttc.append(''+ value +'');
								// alert(value);
								document.commande.prixttc.value = prixttcnew;
								document.commande.prixht.value = prixhtcnew;
								document.commande.mttc.value = prixttcnew;
							}else{
								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
								$mttc.append(''+ value +'');
								// alert(value);
								document.commande.prixttc.value = parseDecimalRoundAndFixed(value * 1.20,2);
								document.commande.prixht.value = parseDecimalRoundAndFixed(value,2);
								document.commande.mttc.value = value;
							}
							document.getElementById("ajoutpanier").disabled=false;
							// genere la liste des valeurs du nombre de pot
							$nbpot.append('<option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>');
							
						});
					}
				});
			}else{
				// VERSION POUDRE
				var valp = $(idapoudre).val(); // on récupère la valeur de la poudre
				var refp = $(larefpoudre).val(); // on récupère la valeur de la ref poudre
				// console.log(valp);
				// console.log(refp);
				
				
				$prixttc.empty(); // on vide le champ prix et on calcule le prix unitaire
				$prixht.empty(); // on vide le champ prix et on calcule le prix unitaire
				
				$prixbarre.empty();
				
				
				$mttc.empty();
				$nbpot.empty(); // on vide le champ prix et on calcule le prix unitaire
				 
				$.ajax({
					url: 'prixpdr.php',
					data: 'id_contenant='+ val + '&id_poudre='+ valp, // on envoie $_GET['id_contenant'] et $_GET['id_poudre']
					dataType: 'json',
					success: function(json) 
					{
						$.each(json, function(index, value) 
						{
							if(clientbatifer > 0)
							{
								// var leprix_barre	= parseDecimalRoundAndFixed(value * 1.2,2);
								// $("#prixbarre").css("display", "inline");
								// $prixbarre.empty().append(''+ leprix_barre);
								// $("#prixbarre"). addClass('prix_barre');
								
								// Calcule le prix avec reduction client batifer
								var prixttcnew = (value * 1.2) - ((value * 1.2) * clientbatifer / 100)
								prixttcnew = parseDecimalRoundAndFixed(prixttcnew,2);
								
								var prixhtcnew = value - (value * clientbatifer / 100)
								prixhtcnew = parseDecimalRoundAndFixed(prixhtcnew,2);
								
								
								
								

								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
								$mttc.append(''+ value +'');
								// alert(value);
								document.commande.prixttc.value = prixttcnew;
								document.commande.prixht.value = prixhtcnew;
								document.commande.mttc.value = prixttcnew;
							}else{
								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
							
								$mttc.append(''+ value +'');
								// alert(value);
								document.commande.prixttc.value =  parseDecimalRoundAndFixed(value * 1.20,2);
								document.commande.prixht.value = parseDecimalRoundAndFixed(value,2);
							
								document.commande.mttc.value = value;
							
							}
							document.getElementById("ajoutpanier").disabled=false;
							// genere la liste des valeurs du nombre de pot
							$nbpot.append('<option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>');
							// console.log(value);
						});
					}
				});
				
			}
		});
		
		
		
		
		// à la sélection d un nb de pot dans la liste on recalcule le prix
		$nbpot.on('change', function() 
		{
			var val = $(this).val(); // on récupère la valeur du nombre de pots
			var valcl = $(contenant).val(); // on récupère la valeur du contenant
			var valct = $(idacouleur).val(); // on récupère la valeur de la couleur
			var valcp = $(idapoudre).val(); // on récupère la valeur de la poudre
			
			var clientbatifer = $("#clientbatifer").val();
			
			// alert(valct);
	 
			if(val != '' && valcl != '' && valct != '') 
			{
				// Version RAL et SIKKENS
				$prixttc.empty(); // on vide le champ prix et on calcule le prix unitaire
				$prixht.empty(); // on vide le champ prix et on calcule le prix unitaire
				
				$prixbarre.empty();
				
				
				$mttc.empty();
				$.ajax({
					url: 'prix.php',
					data: 'id_contenant='+ valcl + '&id_couleur='+ valct + '&nbpot='+ val, // on envoie $_GET['id_contenant'] et $_GET['id_couleur']
					dataType: 'json',
					success: function(json) 
					{
						$.each(json, function(index, value) 
						{
							if(clientbatifer > 0)
							{
								// var leprix_barre	= parseDecimalRoundAndFixed(value * 1.2,2);
								// $("#prixbarre").css("display", "inline");
								// $prixbarre.empty().append(''+ leprix_barre);
								// $("#prixbarre"). addClass('prix_barre');
								
								// Calcule le prix avec reduction client batifer
								var prixttcnew = (value * 1.2) - ((value * 1.2) * clientbatifer / 100)
								prixttcnew = parseDecimalRoundAndFixed(prixttcnew,2);
								
								var prixhtcnew = value - (value * clientbatifer / 100)
								prixhtcnew = parseDecimalRoundAndFixed(prixhtcnew,2);
								
								
								
								

								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
								$mttc.append(''+ value +'');
								// alert(value);
								document.commande.prixttc.value = prixttcnew;
								document.commande.prixht.value = prixhtcnew;
								document.commande.mttc.value = prixttcnew;
							}else{
								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
							
								document.commande.prixttc.value = parseDecimalRoundAndFixed(value * 1.20,2);
								document.commande.prixht.value = parseDecimalRoundAndFixed(value,2);
							
								$mttc.append(''+ mttc +'');
								document.commande.mttc.value = value;
							}
						});
					}
				});
			}else{
				// Version poudre
				$prixttc.empty(); // on vide le champ prix et on calcule le prix unitaire
				$prixht.empty(); // on vide le champ prix et on calcule le prix unitaire
				
				$prixbarre.empty();
				
				
				$mttc.empty();
				$.ajax({
					url: 'prixpdr.php',
					data: 'id_contenant='+ valcl + '&id_poudre='+ valcp + '&nbpot='+ val, // on envoie $_GET['id_contenant'] et $_GET['id_couleur']
					dataType: 'json',
					success: function(json) 
					{
						$.each(json, function(index, value) 
						{
							if(clientbatifer > 0)
							{
								// var leprix_barre	= parseDecimalRoundAndFixed(value * 1.2,2);
								// $("#prixbarre").css("display", "inline");
								// $prixbarre.empty().append(''+ leprix_barre);
								// $("#prixbarre"). addClass('prix_barre');
								
								// Calcule le prix avec reduction client batifer
								var prixttcnew = (value * 1.2) - ((value * 1.2) * clientbatifer / 100)
								prixttcnew = parseDecimalRoundAndFixed(prixttcnew,2);
								
								var prixhtcnew = value - (value * clientbatifer / 100)
								prixhtcnew = parseDecimalRoundAndFixed(prixhtcnew,2);
								
								
								
								

								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
								$mttc.append(''+ value +'');
								// alert(value);
								document.commande.prixttc.value = prixttcnew;
								document.commande.prixht.value = prixhtcnew;
								document.commande.mttc.value = prixttcnew;
							}else{
								$prixttc.append(''+ value +'');
								$prixht.append(''+ value +'');
								
								document.commande.prixttc.value = parseDecimalRoundAndFixed(value * 1.20,2);
								document.commande.prixht.value = parseDecimalRoundAndFixed(value,2);
								$mttc.append(''+ mttc +'');
								document.commande.mttc.value = value;
							}
						});
					}
				});
			
			}
		});
		
		
		
		
		// POUDRE
			
			// Reaffiche le choix poudre
			$("#lenomdelapoudre").click(function() { 
		    
				document.commande.lacouleur.value='';
				document.commande.idacouleur.value='';
				document.commande.larefcoul.value='';
				document.commande.searchpost.value='';
				document.getElementById('layer_nuancier').style.display='none';
				document.getElementById('layer_poudre').style.display='block';
                $contenant.empty(); // on vide la liste des contenants
				$prixttc.empty(); // on vide le prix
				$prixht.empty(); // on vide le prix
				
				$prixbarre.empty();
				
				
				$nbpot.empty(); // on vide le nb de pot
				document.commande.mttc.value = '';
				
				document.getElementById("ajoutpanier").disabled=true;
			
			});
			
			
 			// Autocompletion liste des ref poudre
			$( "#searchpost" ).autocomplete({
			source: function( request, response ) {
			
			  $.ajax({
				url: "autoref.php",
				type: 'post',
				dataType: "json",
				data: {
				  search: request.term
				},
				success: function( data ) {
				  response( data );
				}
			  });
			},
			minLength : 5,
			select: function (event, ui) {
			  $('#searchpost').val(ui.item.pnom); // display the selected text
			  $('#selectedpost_id').val(ui.item.value); // save selected id to input
			  return false;
			}
			});  
			
			
			
			// Lance la recherche d'une poudre
			$("#envoirec").click(function() { 
				var $resultligne = $('#resultligne');
				var valrecherche = $("#searchpost").val();
				$resultligne.empty(); // on vide la liste des references
				
				var names = $('.form-check input:checked').map(function () 
				{
					return this.value;
				}).get();
				
				var dataString = 'refcherche='+ valrecherche + '&marques=' + names;
				// console.clear();
				$.ajax({
					url: 'rechercheref.php',
					data: dataString,
					dataType: 'json',
					success: function(json) 
					{
						if ( json.length == 0 ) {
							// console.log("NO DATA!");
							$resultligne.append('<p><i>Aucun r\u00e9sultat ...</i></p>');
						}else{
							$.each(json, function(index, value) 
							{
								// console.log(value);
								
								ref_poudre = json[index].value;
								nom_poudre = json[index].label;
		
								// alert(start_pos[0]);
								ligne = "<div id= \""+ ref_poudre + "\" class='lignepoudre' onClick=\"document.getElementById('layer_poudre').style.display='none';document.getElementById('lenomdelapoudre').innerHTML = '" + nom_poudre + "'; document.commande.idapoudre.value='" + ref_poudre + "';document.getElementById('lenomdelaref').innerHTML = '" + ref_poudre + "';document.commande.larefpoudre.value='" + nom_poudre + "'; document.getElementById('macouleur').style.display='none';document.getElementById('mapoudre').style.display='block';document.getElementById('refpoudre').style.display='none';\"><div class='nompoudre'>" + nom_poudre + " <div class='choix'>Choisir</div></div></div>";
								$resultligne.append(ligne);
							});
						}
						
					},
					  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status);
						alert(thrownError);
					  }
				});
				
				// console.log(names);
			});
			
			$("#recfiltre").click(function() 
			{
				 
				var $resultligne = $('#resultligne');
				var valrecherche = $("#searchpost").val();
				$resultligne.empty(); // on vide la liste des references
				
				var names = $('.form-check input:checked').map(function () 
				{
					return this.value;
				}).get();
				
				var dataString = 'refcherche='+ valrecherche + '&marques=' + names;
				// console.clear();
				$.ajax({
					url: 'rechercheref.php',
					data: dataString,
					dataType: 'json',
					success: function(json) 
					{
						if ( json.length == 0 ) {
							// console.log("NO DATA!");
							$resultligne.append('<p><i>Aucun r\u00e9sultat ...</i></p>');
						}else{
							$.each(json, function(index, value) 
							{
								// console.log(value);
								
								ref_poudre = json[index].value;
								nom_poudre = json[index].label;
		
								// alert(start_pos[0]);
								ligne = "<div id= \""+ ref_poudre + "\" class='lignepoudre' onClick=\"document.getElementById('layer_poudre').style.display='none';document.getElementById('lenomdelapoudre').innerHTML = '" + nom_poudre + "'; document.commande.idapoudre.value='" + ref_poudre + "';document.getElementById('lenomdelaref').innerHTML = '" + ref_poudre + "';document.commande.larefpoudre.value='" + nom_poudre + "'; document.getElementById('macouleur').style.display='none';document.getElementById('mapoudre').style.display='block';document.getElementById('refpoudre').style.display='none';\"><div class='nompoudre'>" + nom_poudre + " </div></div>";
								$resultligne.append(ligne);
							});
						}
						
					},
					  error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status);
						alert(thrownError);
					  }
				});
				
				// console.log(names);
			
			});
			
			// A la selection d'une poudre on masque la brillance et on affiche le contenant
			$("#resultligne").click(function(){

				// console.log("Ok poudre");
				document.getElementById('mabrillance').style.display='none';
				$('#brillance').prop('required',false);
				// Récupère l'identifiant de la poudre choisie
				var idpdr = $(idapoudre).val(); // on récupère la valeur de la poudre
				// console.log(idpdr);
				static.height(dynamic.height() + 30);
				if(idpdr != '') 
				{
					$contenant.empty(); // on vide la liste des contenants
					 
					$.ajax({
						url: 'contenantpoudre.php',
						data: 'id_poudre='+ idpdr, // on envoie $_GET['id_couleur']
						dataType: 'json',
						success: function(json) 
						{
							$contenant.append('<option value="" selected="selected">-- Conditionnement --</option>');
							$.each(json, function(index, value) 
							{
								$contenant.append('<option value="'+ index +'" ">'+ value +'</option>');
							});
						}
					});
				}
			});
			
			
			
			// Coche toutes les cases checkbox
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
		
	
	
	// FIN JQUERY
	});	