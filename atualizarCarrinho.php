<?php
session_start();
if(!isset($_SESSION['userId'])) {
    header("Location: login.php");
  }
include("admin/ligacao.php");
    $edit = $_GET['edit'];
    $idproduto = $_GET['id'];

    $idutilizador = $_SESSION['userId'];
    $quantidade = $_POST['quantidade'];
    $tamanho = $_GET['tamanho'];
    
   
    
    $precofinal;
    $sqlProduto= "SELECT * FROM produtos WHERE id =$idproduto";
    $resultProduto = mysqli_query($ligacao, $sqlProduto);
    $rowProduto = $resultProduto->fetch_assoc();
    $stock = json_decode($rowProduto['stock'], TRUE);
   
    
    
  if(isset($edit)) {
      if($edit=="2" || $quantidade==0) {
 
        $sql = "DELETE FROM carrinhocompras WHERE idProduto = $idproduto and idUtilizador = $idutilizador and tamanho LIKE ". "'" . $tamanho."'";
        echo $sql; 
    if ($ligacao -> query ($sql) === TRUE) {
        $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Produto eliminado do seu carrinho com Sucesso!</div>";
        header("Location: carrinho.php");
        die();
    } 
    else {
        echo "Erro: " . $sql . "<br>" . $ligacao -> error;
        }  
      }
      else if($edit=="1") {
        if($quantidade <= $stock[$tamanho]) {
            
        
            $sql = "UPDATE carrinhocompras SET quantidade = $quantidade WHERE idProduto = $idproduto and idUtilizador = $idutilizador AND tamanho LIKE '$tamanho'";
            
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Carrinho Atualizado com Sucesso</div>";
            if ($ligacao -> query ($sql) === TRUE) {
                
                header("Location: carrinho.php");
                die();
            } 
            else {
                echo "Erro: " . $sql . "<br>" . $ligacao -> error;
                }      
            }
        else if($quantidade> $stock[$tamanho]) {
          $sql = "UPDATE carrinhocompras SET quantidade =" .  $stock[$tamanho]." WHERE idProduto = $idproduto and idUtilizador = $idutilizador AND tamanho LIKE '$tamanho'";
          
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Apenas existem ". $stock[$tamanho] . " unidade/s do tamanho " . $tamanho ." do artigo " . $rowProduto['nome'] . " em stock. Foram adicionadas ao seu carrinho.</div>";
            
            
            
            if ($ligacao -> query ($sql) === TRUE) {
                header("Location: carrinho.php");
                die();
            } 
            else {
                echo "Erro: " . $sql . "<br>" . $ligacao -> error;
                }  
        }
      }
        
    
  }
  else if(!isset($edit)){   
    header("Location: carrinho.php");
  }
        
        
    
 ?>
 
