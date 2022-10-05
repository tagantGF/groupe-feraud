<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Classe de traitement des exceptions et des erreurs */
require 'PHPMailer/src/Exception.php';

/* Classe-PHPMailer */
require 'PHPMailer/src/PHPMailer.php';
/* Classe SMTP nécessaire pour établir la connexion avec un serveur SMTP */
require 'PHPMailer/src/SMTP.php';

try {
    // Tentative de création d’une nouvelle instance de la classe PHPMailer
    $mail = new PHPMailer (true);
	// $mail->isSMTP();
	$mail->SMTPAuth = false;
	// Informations personnelles
	// $mail->Host = "smtp.office365.com";
	// $mail->Port = "587";
	// $mail->Username = "support@groupe-feraud.com";
	// $mail->Password = "SAgg0Rt@13";
	// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	
	
	// Expéditeur
	$mail->setFrom('feraud.color@groupe-feraud.com', 'Feraud Color');
	// Destinataire dont le nom peut également être indiqué en option
	$mail->addAddress('b.bour@declic-communication.fr', 'Bour Ben');
	// Copie
	$mail->addCC('b.bour@declic2.net');
	// Copie cachée
	$mail->addBCC('b.bour@declic-communication.com', 'Ben');
	
	
	$mail->isHTML(true);
	// Betreff
	$mail->Subject = 'Objet de votre email';
	// HTML-Inhalt
	$mail->Body = 'Le texte de votre email en HTML. Il est également possible des mettre des éléments en <b>gras</b>, par exemple.';
	$mail->AltBody = 'Le texte comme simple élément textuel';
	// Ajouter une pièce jointe
	$mail->addAttachment("PHPMailer/examples/images/phpmailer.png", "phpmailer.png");
	
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64';
	
	$mail->send();
	
	echo "Ok";
} catch (Exception $e) {
        echo "Mailer Error: ".$mail->ErrorInfo;
}

?>