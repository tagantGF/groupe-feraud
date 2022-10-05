<?php
 
    ini_set( 'display_errors', 1 );
 
    error_reporting( E_ALL );
 
    $from = "feraud.color@groupe-feraud.com";
 
    $to = "b.bour@declic-communication.fr";
 
    $subject = "Verification PHP mail";
 
    $message = "PHP mail marche";
 
    $headers = "From:" . $from;
 
    if(mail($to,$subject,$message, $headers))
    {
        echo "Message envoye";
    }else{
        echo "Message non envoye";
    } 
    
?>