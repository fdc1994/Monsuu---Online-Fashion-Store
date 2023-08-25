<?php

if(!isset($_SESSION['userId'])) {
    header("Location: login.php");
  }
  $encomendaDetalhes ="";
    include("ligacao.php");
    $idutilizador = $_SESSION['userId'];

    $sqlCarrinho = "SELECT * FROM carrinhocompras WHERE idUtilizador = $idutilizador";
    $resultadoCarrinho = mysqli_query($ligacao, $sqlCarrinho);

    

    if($resultadoCarrinho -> num_rows >0) {
        $existiuMudanca = false;
        
        while ($row = mysqli_fetch_assoc($resultadoCarrinho)) {
            $idproduto =$row['idProduto'];
            $tamanho = $row['tamanho'];
            
            $sqlProduto= "SELECT * FROM produtos WHERE id =$idproduto";
            $resultProduto = mysqli_query($ligacao, $sqlProduto);
            $rowProduto = $resultProduto->fetch_assoc();
            $stock = json_decode($rowProduto['stock'], TRUE);
            $quantidadeCarrinho = $row['quantidade'];

            $stock = $stock[$tamanho];
            echo "Stock do Produto: " . $stock . "<br>";
            if($stock==0) {
                $existiuMudanca = true;
                $sql = "DELETE FROM carrinhocompras WHERE idProduto = $idproduto and idUtilizador = $idutilizador AND tamanho like '$tamanho'";
                $_SESSION['resultadoAddCarrinho'] = "<h3 class='text-success mb-3'>Devido a uma mudança de Stock tivemos de alterar algumas quantidades dos produtos no seu Carrinho. Por favor verifique o mesmo antes de continuar.</h3>";
                mysqli_query($ligacao, $sql);
            }
            
            else if($quantidadeCarrinho>$stock) {
                    $existiuMudanca = true;
                    $_SESSION['resultadoAddCarrinho'] = "<h3 class='text-success mb-3'>Devido a uma mudança de Stock tivemos de alterar algumas quantidades no seu Carrinho. Por favor verifique o mesmo antes de continuar.</h3>";
                    $sql = "UPDATE carrinhocompras SET quantidade = $stock WHERE idProduto = $idproduto and idUtilizador = $idutilizador AND tamanho like '$tamanho'";
                    mysqli_query($ligacao, $sql);
           }
           
        }
        
    }
    if($existiuMudanca) {
        header("Location:../carrinho.php");
        die();
    }
    else{
        echo("produtos disponiveis");
    }
    
 ?>
 
