<?php
session_start();


    include_once("ligacao.php");

    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $email = $_POST['email'];
    $tel = $_POST['telefone'];
    $passwd = md5($_POST['passwd']);
    $passconf = md5($_POST['confirm_passwd']);
    $morada = $_POST['morada'];
    $distrito = $_POST['distrito'];
    $cidade = $_POST['cidade'];
    $codigopostal = $_POST['codigopostal'];
    $pub = $pesquisa = (isset($_POST['pub'])) ? $_POST['pub'] :0;
 
    $result_user = "SELECT * FROM utilizador WHERE email LIKE '$email'" ;
    $resultado_user = mysqli_query($ligacao, $result_user);
    $resultado = mysqli_fetch_assoc($resultado_user);
   
    
    if($passwd != $passconf) {
        echo("Password não coincide");
        $_SESSION['ErroRegistar'] = "<div class='alert alert-warning text-center' role='alert'>As suas passwords não coincidem. <br><br>Por favor tente de novo.</div>";
        header("Location: ../registo.php");
    }
    else{

        
    if(isset($resultado)) {
        $_SESSION['ErroRegistar'] = "<div class='alert alert-danger text-center' role='alert'>Já existe um registo com os dados que indicou. <br><br>Poderá iniciar sessão através da página de <a href='login.php'>login</a></div>";
        echo("Erro password");
        header("Location: ../registo.php");
    }
    else{
        $sql = "INSERT INTO utilizador (nome,apelido,email,telefone,passwd,morada,distrito,cidade,cpostal,autPub,admin,verificado) VALUES ('$nome', '$apelido', '$email', '$tel', '$passwd', '$morada', '$distrito','$cidade', '$codigopostal', $pub, 0, 0)";
        if ($ligacao -> query ($sql) === TRUE) {
            include("validarNovaConta.php");
            header("Location: ../login.php");
            $_SESSION['Registo'] = "<div class='alert alert-success mb-3'>Registo Criado com Sucesso! Foi enviado um e-mail para o seu correio eletrónico. <br><br>Deverá aceder ao mesmo de forma a verificar a sua conta antes de poder iniciar sessão.</div>";
            die();
        } else {
            echo "Erro: " . $sql . "<br>" . $ligacao -> error;
        }
        
        
    }
    }

    
 
 ?>
 
