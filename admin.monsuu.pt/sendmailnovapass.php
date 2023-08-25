<?php
$to_email = $email;
$subject = "Pedido de Recuperação de Password";
$body = "Olá, recebemos um pedido de restabelecimento de password neste endereço de email. Por favor aceda a http://127.0.0.1/DWDM/Projeto/recuperarpassword.php?hash=$hashSafe&email=$email este link." ;
$headers = "From: VIRPREV, SA";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}