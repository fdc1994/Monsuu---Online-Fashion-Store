<?php
include_once("ligacao.php");

session_start();
if(isset($_SESSION['userId'])){
  header("Location: index.php");
}
?>

  <?php 
  
        $hash = (isset($_GET['hash'])) ? $_GET['hash'] : null;
        $email = (isset($_GET['id'])) ? $_GET['id'] : null;
        echo("entrou no ficheiro");
        if(!isset($hash)) {
          header("Location: index.php");

        
    }
      else {
        
        $sqlHash = "SELECT * FROM verutilizador WHERE emailUtilizador LIKE '$email'" ;
      $resultado_hash = mysqli_query($ligacao, $sqlHash);
      $resultado = mysqli_fetch_assoc($resultado_hash);
       if($resultado['hashPedido'] ==$hash && $resultado['verificado'] ==0) {
        
        $sqlVerificaConta = "UPDATE utilizador SET verificado = 1 WHERE email LIKE '$email'";
        $sqlVerificaConta2 = "UPDATE verutilizador SET verificado = 1 WHERE emailUtilizador LIKE '$email'";
        if ($ligacao -> query ($sqlVerificaConta) === TRUE && $ligacao -> query ($sqlVerificaConta2) === TRUE) {
            header("Location: ../login.php");
            $_SESSION['Registo'] = "<div class='alert alert-success mb-3'>Conta verificada com sucesso!</div>";
            die();
        } else {
            echo "Erro: " . $sqlVerificaConta . "<br>" . $ligacao -> error;
        }
       
      
        }
      }
                             ?>
        