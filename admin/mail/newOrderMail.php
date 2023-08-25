<?php

function sendMailNewOrder($to_email,$orderNumber) {

$subject = "Monsuu Store - Nova Encomenda ";
$body = "Hi,nn This is test email send by PHP Script";
$headers = "From: no-reply@monsuu.pt";
 

    $subject = "Monsuu Store - Confirmação de Encomenda";
    $body = 'tetse';

     
    if (mail($to_email, $subject, $body, $headers)) {
        echo(mail($to_email, $subject, $body, $headers));
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
}

sendMailNewOrder("fdc1994@hotmail.com", "MS25");