<?php
	ini_set('display_errors',1);
	ini_set('default_charset', 'UTF-8');
	require("includes/PHPMailer-master/src/PHPMailer.php");
	require("includes/PHPMailer-master/src/SMTP.php");
	require("includes/PHPMailer-master/src/POP3.php");
	require("includes/PHPMailer-master/src/Exception.php");
	require("includes/PHPMailer-master/src/OAuth.php");
	
	// Preparation du mail 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	$mail = new PHPMailer();
	$recipiant = "b.bour@declic-communication.fr";
	
	$mail->SMTPAuth   = true; //SMTP authentication
	$mail->Host       = "smtp.office365.com";
	$mail->Port       = 587; //SMTP Port
	$mail->Username   = "support@groupe-feraud.com"; //SMTP account username
	$mail->Password   = "SAgg0Rt@13";        //SMTP account password

	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->isHTML(true); // Set email format to HTML
	$mail->From = 'feraud.color@groupe-feraud.com';
	$mail->FromName = 'Feraud Color';
	$mail->AddReplyTo('feraud.color@groupe-feraud.com', 'Feraud Color'); //Reply TO
	$mail->AddAddress($recipiant, 'Benoit BOUR'); //recipient email
	// $mail->addBCC('automate@declic-communication.com','Declic automate');
	$mail->Subject    = "Votre commande Feraud Color"; //email subject
	$message = "Voici un exemple de mail au format Texte";
	$mail->Body       = $message;

	

	if(!$mail->Send()) {
	  echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
	}else{     
	  echo 'Mail envoyé avec succès';
	}
?>