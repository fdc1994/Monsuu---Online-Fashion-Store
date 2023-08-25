<?php

include_once("ligacao.php");

session_start();

if((isset($_POST['email'])) && (isset($_POST['passwd']))) {
    $redirect = (isset($_GET['redirect'])) ? $_GET['redirect'] : 0;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $email= mysqli_real_escape_string($ligacao, $_POST['email']);
    $passwd = md5($_POST['passwd']);

    $result_user = "SELECT * FROM utilizador WHERE email = '$email' and passwd = '$passwd' LIMIT 1" ;
    $resultado_user = mysqli_query($ligacao, $result_user);
    $resultado = mysqli_fetch_assoc($resultado_user);
    echo($result_user);
    if(isset($resultado)) {
        if($resultado['verificado'] == 1) {
            $_SESSION['userId'] = $resultado['id'];
            $_SESSION['userNome'] = $resultado['nome'];
            $_SESSION['userApelido'] = $resultado['apelido'];
            $_SESSION['userEmail'] = $resultado['email'];
            $_SESSION['userTelefone'] = $resultado['telefone'];
            $_SESSION['userMorada'] = $resultado['morada'];
            $_SESSION['userDistrito'] = $resultado['distrito'];
            $_SESSION['userCidade'] = $resultado['cidade'];
            $_SESSION['userCpostal'] = $resultado['cpostal'];
            $_SESSION['admin'] = $resultado['admin'];
            if($redirect==1) {
                
                header("Location: ../detalhe.php?id=$id");
            }
            else{
                header("Location: ../index.php");
            }
        }
        else{
            $_SESSION['Erro'] = "<div class='alert alert-warning' role='alert'> A sua conta ainda não se encontra verificada. \nPor favor consulte o seu correio eletrónico para a verificar. Caso encontre algum problema por favor contacte a administração do Site.</div>";
           
            if($redirect==1) {
                
                header("Location: ../login.php?id=$id&redirect=1");
            }
            else{
                header("Location: ../login.php");
            }
        }
        
    }
    else {
        $_SESSION['Erro'] = "<div class='alert alert-warning' role='alert'> Utilizador ou Password Inválidas</div>";
        echo("<span class='text-danger'> Utilizador ou Password Inválidas</span>");
        if($redirect==1) {
                
            header("Location: ../login.php?id=$id&redirect=1");
        }
        else{
            header("Location: ../login.php");
        }
    }
}

else {
    $_SESSION['Erro'] = "<div class='alert alert-warning' role='alert'> Utilizador ou Password Inválidas</div>";
    if($redirect==1) {
                
        header("Location: ../login.php?id=$id&redirect=1");
    }
    else{
        header("Location: ../login.php");
    }
}