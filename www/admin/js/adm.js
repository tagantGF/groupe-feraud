// JavaScript Document
function afficher_select_sf() 
{
	$.ajax(
	{
		type: "GET",
		url: "ajax/select_sous_familles.php",
		data: "famille="+$("select[name='famille'] > option:selected").val(),
		success: function(msg)
		{
			$("#aff_sous_famille").html(msg); 	
		}
	});
}


$(document).ready(function() 
	{
	
		$("#type_prod_s").click(function()
		{
			// console.log("simple");
			$('#nom_var').prop('required',false);
		});
		
		$("#type_prod_m").click(function()
		{
			// console.log("multiple");
			$('#ref_prod').prop('required',false);
			$('#pds_prod').prop('required',false);
			$('#prix_prod').prop('required',false);
			
		});
	
		
	
	// FIN JQUERY
	});	