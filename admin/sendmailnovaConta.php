<?php
$to_email = $email;
$subject = "Monsuu Store - Confirmação de Conta";
$body = "Olá, \nMuito obrigada por teres criado uma conta no nosso site. Por favor acede a http://127.0.0.1/Monsuu/admin/verificarConta.php?hash=$hashSafe&id=$email este link para poderes confirmar a tua conta e começar já as tuas compras. \n Obrigada pela tua preferência e até já!" ;
$headers = "From: Monsuu Store";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}