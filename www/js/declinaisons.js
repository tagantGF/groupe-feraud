// JavaScript Document

function parseDecimalRoundAndFixed(num,dec){
  var d =  Math.pow(10,dec);
  return (Math.round(num * d) / d).toFixed(dec);
}

$(document).ready(function() 
	{
		var $declinaisons = $('#prod_declinaison');
		var $prixttc = $('#prixttcdecli');
		var $prixht = $('#prixhtcdecli');
		
		
		
		
		$declinaisons.on('change', function() 
		{
			var val = $(this).val(); // on récupère la valeur du support
	 		// console.log("Valeur : "+val);
			if(val != '') 
			{	
				var clientbatifer = $("#clientbatifer").val();
				$("#iddeclinaison").val(val);
				$("#en-stock"). addClass('d-flex');
				$("#lignepanier"). addClass('d-flex');
				
				// console.log(clientbatifer);
				// Recherche le prix du produit
				// Affiche le prix
				// Ajoute la classe d-flex aud div ID lignepanier
				// Ajoute l'id au input hidden idproduit
				
				$.ajax({
					url: 'prixdeclinaison.php',
					data: 'id_declit='+ val,
					dataType: 'json',
					success: function(json) 
					{
						$.each(json, function(index, value) 
						{
							
							if(clientbatifer > 0)
							{
								var $prixbarre 		= $('#prixbarre');
								var leprix_barre	= parseDecimalRoundAndFixed(value,2);
								$("#prixbarre").css("display", "table");
								
								
								var leprix_ht 		= parseDecimalRoundAndFixed(value,2);
								var leprix_ttc		= parseDecimalRoundAndFixed(value * 1.20,2);
								// Calcul prix moins la reduction : prix = prix - (prix * reduc / 100)
								var prixttcnew = leprix_ttc - (leprix_ttc * clientbatifer / 100)
								prixttcnew = parseDecimalRoundAndFixed(prixttcnew,2);
								
								var prixhtcnew = leprix_ht - (leprix_ht * clientbatifer / 100)
								prixhtcnew = parseDecimalRoundAndFixed(prixhtcnew,2);
								
								$prixbarre.empty().append('Prix public : '+ leprix_ttc +' &euro; TTC');
								$prixht.empty().append(''+ prixhtcnew +' &euro; HT');
								$prixttc.empty().append('Votre prix : '+ prixttcnew +' &euro; TTC');
							
							}else{
								var leprix_ht  = parseDecimalRoundAndFixed(value,2);
								var leprix_ttc = parseDecimalRoundAndFixed(value * 1.20,2);
								
								$prixht.empty().append(''+ leprix_ht +' &euro; HT');
								$prixttc.empty().append(''+ leprix_ttc +' &euro; TTC');
							
							}
							
							
						});
					}
				});
		
			}
		});
		// FIN JQUERY
	});	