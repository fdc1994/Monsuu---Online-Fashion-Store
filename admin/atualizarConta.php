<?php
session_start();

if(!isset($_SESSION['userId'])) {
 
    header("Location: ../login.php");
  }
  $userId = (isset($_GET['userId'])) ? $_GET['userId'] : null;
  $edit = (isset($_GET['edit'])) ? $_GET['edit'] : null;

    include_once("ligacao.php");
if($edit=="1") {
   
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $tel = $_POST['telefone'];
    $morada = $_POST['morada'];
    $distrito = $_POST['distrito'];
    $cidade = $_POST['cidade'];
    $codigopostal = $_POST['codigopostal'];

    
        $sql = "UPDATE utilizador SET nome = '$nome', apelido = '$apelido' ,telefone = '$tel',morada = '$morada',distrito = '$distrito',cidade ='$cidade',cpostal = '$codigopostal' WHERE id = ".$_SESSION['userId'];
    
    
        if ($ligacao -> query ($sql) === TRUE) {
            echo($sql);
            $_SESSION['userNome'] = $nome;
            $_SESSION['userApelido'] = $apelido;
            $_SESSION['userTelefone'] = $tel;
            $_SESSION['userMorada'] = $morada;
            $_SESSION['userDistrito'] = $distrito;
            $_SESSION['userCidade'] = $cidade;
            $_SESSION['userCpostal'] = $codigopostal;
            header("Location: ../minhaconta.php");
            $_SESSION['MinhaConta'] = "<div class='alert alert-success text-center' role='alert'>Dados atualizados com Sucesso!</div>";
            die();
        } else {
            header("Location: ../minhaconta.php?id=1");
            $_SESSION['MinhaConta'] = "<div class='alert alert-warning text-center' role='alert'>Ocorreu um erro durante a sua atulização de dados. Por favor contacte a administração.</div>";
        }
}
else if($edit=="2"){
    $result_user = "SELECT * FROM utilizador WHERE email LIKE '" . $_SESSION['userEmail'] . "'" ;
    $resultado_user = mysqli_query($ligacao, $result_user);
    $resultado = mysqli_fetch_assoc($resultado_user);
    
    $passatual = mysqli_real_escape_string($ligacao, $_POST['passwordAtual']);
    $passnova = mysqli_real_escape_string($ligacao, $_POST['passwordNova']);
    $passconf = mysqli_real_escape_string($ligacao, $_POST['passwordConf']);
    
    if(md5($passatual) != $resultado['passwd']) {
        echo("Password atual não coincide");
        $_SESSION['MinhaConta'] = "<div class='alert alert-warning text-center' role='alert'>A Password atual que inseriu não corresponde à sua.</div>";
        header("Location: ../minhaconta.php?edit=2");
    }
    else if($passnova != $passconf) {
        echo("Password nova não coincide");
        $_SESSION['MinhaConta'] = "<div class='alert alert-warning text-center' role='alert'>A Nova Password que inseriu não corresponde à sua confirmação.</div>";
        header("Location: ../minhaconta.php?edit=2");
    }
    else{
        $passnova = md5($passnova);
        $sql = "UPDATE utilizador SET passwd = '$passnova'WHERE id = ".$_SESSION['userId'];
    
    
        if ($ligacao -> query ($sql) === TRUE) {
            header("Location: ../minhaconta.php");
            $_SESSION['MinhaConta'] = "<div class='alert alert-success text-center' role='alert'>Password atualizada com Sucesso!</div>";
            die();
        } else {
            echo "Erro: " . $sql . "<br>" . $ligacao -> error;
        }
    }
        
}
//Mudança Password via Email
else if ($edit=="3") {
    $email = $_GET['email'];
    $hash = $_GET['hash'];
    $result_user = "SELECT * FROM utilizador WHERE email LIKE '" . $email . "'" ;
    $resultado_user = mysqli_query($ligacao, $result_user);
    $resultado = mysqli_fetch_assoc($resultado_user);
    
    
    $passnova = mysqli_real_escape_string($ligacao, $_POST['passwordNova']);
    $passconf = mysqli_real_escape_string($ligacao, $_POST['passwordConf']);
    
    
    if($passnova != $passconf) {
        echo("Password nova não coincide");
        $_SESSION['resultadoPedido'] = "<div class='alert alert-warning text-center' role='alert'>A Nova Password que inseriu não corresponde à sua confirmação.</div>";
        header("Location: ../recuperarpassword.php?hash=$hash&email=$email");
    }
    else{
        $passnova = md5($passnova);
        $sql = "UPDATE utilizador SET passwd = '$passnova' WHERE email like '$email'";
    
    
        if ($ligacao -> query ($sql) === TRUE) {
            
            $sqlFechaPedido = "UPDATE recuperarPassword SET valido = 0 WHERE email like '$email'";
            $ligacao -> query ($sqlFechaPedido);
            header("Location: ../login.php");
            $_SESSION['resultadoPedido'] = "<div class='alert alert-success text-center' role='alert'>Password atualizada com Sucesso!</div>";
            die();
        } else {
            echo "Erro: " . $sql . "<br>" . $ligacao -> error;
        }
    }
}
    
    
 
 ?>
 
