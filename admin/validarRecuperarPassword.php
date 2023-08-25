<?php

include_once("ligacao.php");

session_start();

if((isset($_POST['email']))) {
    date_default_timezone_set('Europe/Lisbon');
    
    $email= mysqli_real_escape_string($ligacao, $_POST['email']);

    $result_user = "SELECT * FROM utilizador WHERE email = '$email' LIMIT 1" ;
    $resultado_user = mysqli_query($ligacao, $result_user);
    $resultado = mysqli_fetch_assoc($resultado_user);
    $date = date('d/m/Y H:i:s', time());
    echo$date;

    if(isset($resultado)) {
        $hashSafe = md5($email . $date);
        $SQlinvalidalinksanteriores = "UPDATE recuperarpassword SET valido = 0 WHERE email like '$email'" ;
        $ligacao -> query ($SQlinvalidalinksanteriores);
        $SQLpedidoPassword = "INSERT INTO recuperarpassword (date,hashsafe,email,valido) VALUES ('$date','$hashSafe','$email', 1)" ;
        if ($ligacao -> query ($SQLpedidoPassword) === TRUE){ 
            //include("smtp.php");
            $_SESSION['resultadoPedido'] = "<div class='alert alert-success' role='alert'>Caso o Email introduzido corresponda a algum registo iremos enviar um email de restabelecimento de password.<br> Por favor verifique a sua caixa de correio.</div>";
            header("Location: ../recuperarPassword.php");
        }
        
    }
    else {
        $_SESSION['resultadoPedido'] = "<div class='alert alert-warning' role='alert'>Por favor insira um email de utilizador válido</div>";
        header("Location: ../recuperarpassword.php");
    }
}

else {
    $_SESSION['resultadoPedido'] = "<div class='alert alert-warning' role='alert'>Por favor insira um email de utilizador válido</div>";
    header("Location: ../recuperarpassword.php");
   
}