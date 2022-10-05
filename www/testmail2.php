<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Document sans titre</title>
</head>
<body>
    <?php
    //envoie de mail avec entête
    $expediteur = "feraud.color@groupe-feraud.com";
    date("D, j M Y H:i:s"); //date
    $entete = "From: $expediteurn"; // expéditeur
    $entete .= "Reply-To: $expediteur n"; // Adresse de retour, retour à l'envoyeur en cas d'erreur
    $entete .= "X-Mailer: PHP/" . phpversion() . "n" ; //version
    $entete .= "Date: ". date("D, j M Y H:i:s"); //date;
    mail( "b.bour@declic-communication.fr", "Communication", "Nous vous communiquons que le département sera fermé tous les mardi après midi.", $entete);
    ?>
</body>
</html>