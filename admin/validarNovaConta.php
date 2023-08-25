<?php

include_once("ligacao.php");

session_start();

if((isset($_POST['email']))) {
    $email= mysqli_real_escape_string($ligacao, $_POST['email']);
    $date = date('m/d/Y h:i:s a', time());

        $hashSafe = md5($email . $date);
        $SQLpedidoverificarConta = "INSERT INTO verutilizador (emailUtilizador,hashPedido,verificado) VALUES ('$email','$hashSafe', 0)" ;
        if ($ligacao -> query ($SQLpedidoverificarConta) === TRUE){ 
            include("sendmailnovaConta.php");
        }
    else {   
        $_SESSION['resultadoPedido'] = "<div class='alert alert-warning' role='alert'>Ocorreu um Erro, Por favor contacte a administração do site.</div>";
        header("Location: ../login.php");
    }
}

else {
    $_SESSION['resultadoPedido'] = "<div class='alert alert-warning' role='alert'> Utilizador ou Password Inválidas</div>";
    header("Location: ../login.php");
   
}