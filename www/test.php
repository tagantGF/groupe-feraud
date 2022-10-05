    <html>
    <head>
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
			 lib_prod.setAttribute("class", "form-control");
			 lib_prod.setAttribute("required", "");
			 lib_prod.setAttribute("placeholder", "Libellé");
			 
			 // Ajout du champ reference de la variation
			 var ref_prod = document.createElement("input" );
			 ref_prod.setAttribute("type", "text" );
			 ref_prod.setAttribute("name", "ref_prod" + nombreChamp);
			 ref_prod.setAttribute("id", "ref_prod" + nombreChamp);
			 ref_prod.setAttribute("class", "form-control");
			 ref_prod.setAttribute("required", "");
			 ref_prod.setAttribute("placeholder", "Ref unique");
			 
			 // Ajout du champ poids de la variation
			 var pds_prod = document.createElement("input" );
			 pds_prod.setAttribute("type", "number" );
			 pds_prod.setAttribute("name", "pds_prod" + nombreChamp);
			 pds_prod.setAttribute("id", "pds_prod" + nombreChamp);
			 pds_prod.setAttribute("class", "form-control");
			 pds_prod.setAttribute("required", "");
			 pds_prod.setAttribute("placeholder", "0.00");
			 
			 // Ajout du champ prix de la variation
			 var prix_prod = document.createElement("input" );
			 prix_prod.setAttribute("type", "number" );
			 prix_prod.setAttribute("name", "prix_prod" + nombreChamp);
			 prix_prod.setAttribute("id", "prix_prod" + nombreChamp);
			 prix_prod.setAttribute("pattern", "[0-9]+([\.,][0-9]+)?");
			 prix_prod.setAttribute("inputmode", "numeric");
			 prix_prod.setAttribute("step", "0.01");
			 prix_prod.setAttribute("required", "");   
			 prix_prod.setAttribute("class", "form-control");
			 prix_prod.setAttribute("placeholder", "0.00");
			 
			 var labelElem = document.createElement("label" );
			 labelElem.setAttribute("for", "champ" + nombreChamp);
			 var labelText = document.createTextNode("Choix " + nombreChamp);
			 labelElem.appendChild(labelText);
			 document.getElementById("myform" ).appendChild(document.createElement("BR" ));
			 // Exemple avec un label ajouté devant le champ
			 // document.getElementById("myform" ).appendChild(labelElem);
			 document.getElementById("myform" ).appendChild(lib_prod);
			 document.getElementById("myform" ).appendChild(ref_prod);
			 document.getElementById("myform" ).appendChild(pds_prod);
			 document.getElementById("myform" ).appendChild(prix_prod);
			 
			 nombreChamp++;
			}
		
		document.getElementById("nbmligne").value = nombreChamp;
		}
    </script>
    </head>
    <body>
    <?php 
	if(!isset($_POST['valider']))
	{
	?>

    <form name="myform" id="myform" method="post">
	    <input type="button" onClick="test('plus');" value="+">
    	<input type="submit" name="valider" value="Valider" />
        <input type="hidden" name="nbmligne" id="nbmligne" value="0" />
    </form>
    
    <?php 
	}else{
	    echo "<pre>";
    	print_r($_POST);
	    echo "</pre>";
	
	}

	?>
    </body>
    </html>