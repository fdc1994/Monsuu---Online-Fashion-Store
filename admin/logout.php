<?php

session_start();

    unset(
        $_SESSION['userId'],
        $_SESSION['userNome'],
        $_SESSION['userApelido'],
        $_SESSION['userEmail'],
        $_SESSION['userMorada'],
        $_SESSION['userDistrito'],
        $_SESSION['userCidade'] ,
        $_SESSION['userCpostal'] ,
        $_SESSION['admin']
    );

$_SESSION['logout'] = "<div class='alert alert-success' role='alert'>Logout efetuado com sucesso</div>";
header("Location: ../login.php");
?>