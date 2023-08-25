<?php
session_start();
$idproduto = $_GET['id'];
if(!isset($_SESSION['userId'])) {
    header("Location: login.php?redirect=1&id=$idproduto");
  }

    include("admin/ligacao.php");
    
    $idutilizador = $_SESSION['userId'];
    $quantidade = $_POST['quantidade'];
    $tamanho = $_POST['tamanho'];
    if($tamanho == "Unico") {
        $tamanhoReadable = "Único";
    }
    else {
        $tamanhoReadable = $tamanho;
    }

    $sqlProduto= "SELECT * FROM produtos WHERE id =$idproduto";
    $resultProduto = mysqli_query($ligacao, $sqlProduto);
    $rowProduto = $resultProduto->fetch_assoc();
    $stock = json_decode($rowProduto['stock'], TRUE);
   
    if($stock[$tamanho] == null) {
        $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-warning' role='alert'>Existiu um erro ao adicionar o seu produto. <br>Por favor tente de novo e caso o problema persista, por favor contacte a administração.</div>";
            header("Location: detalhe.php?id=$idproduto");
            die();
    }


    //obter preço do produto com desconto

    $precofinal;
    $sqlpreco= "SELECT preco FROM produtos WHERE id =$idproduto AND listado = 1";
    $resultpreco = mysqli_query($ligacao, $sqlpreco);
    $rowpreco = $resultpreco->fetch_assoc();
    $preco = $rowpreco['preco'];
    $sqldescontos = "SELECT desconto FROM promocoes WHERE id = $idproduto";
    $resultdescontos = mysqli_query($ligacao, $sqldescontos);
    $rowdescontos = $resultdescontos->fetch_assoc();
    if(isset($rowdescontos)) {
        $desconto = $rowdescontos['desconto'];
        
        $precofinal = $preco - ($preco *("0.".$desconto));
    }
    else{
        $precofinal = $preco;
    }

    //verificar se o produto já existe no carrinho do cliente para comparar a quantidade total
    
    $sqlExiste = "SELECT * FROM carrinhocompras WHERE idUtilizador = $idutilizador AND idProduto = $idproduto AND tamanho LIKE '$tamanho'";
echo $sqlExiste;
    $resultexiste = mysqli_query($ligacao, $sqlExiste);
    $rowexiste = $resultexiste->fetch_assoc();
    print_r($rowexiste);
    if (isset($rowexiste)) {
        $quantidadetotal = $quantidade + $rowexiste['quantidade'];
        if($quantidadetotal <= $stock[$tamanho]) {
            
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Foram adicionadas " . $quantidade ." unidade/s " . $rowpreco['nome'] ." ao seu carrinho.</div>";
            $sql = "UPDATE carrinhocompras SET quantidade = $quantidadetotal WHERE idProduto = $idproduto and idUtilizador = $idutilizador AND tamanho like '$tamanho'";
            echo $sql;
            if ($ligacao -> query ($sql) === TRUE) {
                header("Location: detalhe.php?id=$idproduto");
                die();
            } 
            else {
                echo "Erro: " . $sql . "<br>" . $ligacao -> error;
                }      
           }
        else if($quantidadetotal> $stock[$tamanho]) {
            $quantidade = $stock[$tamanho]; 
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Apenas existem ". $stock[$tamanho] . " unidade/s de tamanho " . $tamanhoReadable . " em stock. <br>O seu carrinho já contêm ". $quantidade . " unidade/s.</div>";
            
            $sql = "UPDATE carrinhocompras SET quantidade =" .  $stock[$tamanho]." WHERE idProduto = $idproduto and idUtilizador = $idutilizador AND tamanho like '$tamanho'" ;
            echo $sql;
            if ($ligacao -> query ($sql) === TRUE) {
                header("Location: detalhe.php?id=$idproduto");
                die();
            } 
            else {
                echo "Erro: " . $sql . "<br>" . $ligacao -> error;
                }  
        }
        
    }
    else {
        if($quantidade <= $stock[$tamanho]) {
        $totalpreco = $precofinal*$quantidade;
        $sql = "INSERT INTO carrinhocompras VALUES ('$idutilizador', '$idproduto', '$quantidade','$tamanho')";
        $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Foram Adicionadas " . $quantidade ." unidades " . $rowStock['nome'] ." ao seu carrinho.</div>";
        echo $sql;
        if ($ligacao -> query ($sql) === TRUE) {
            header("Location: detalhe.php?id=$idproduto");
            die();
        } 
        else {
            echo "Erro: " . $sql . "<br>" . $ligacao -> error;
            }      
       }

       else if($quantidade> $stock[$tamanho]) {
        $quantidade = $stock[$tamanho];
        $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-success' role='alert'>Apenas existem ". $stock[$tamanho] . " unidades " . $tamanhoReadable ." do artigo " . $rowstock['nome'] . " em stock. <br>Foram adicionadas ao seu carrinho.</div>";
     
        $sql = "INSERT INTO carrinhocompras VALUES ('$idutilizador', '$idproduto', '$quantidade','$tamanho')";
        if ($ligacao -> query ($sql) === TRUE) {
            header("Location: detalhe.php?id=$idproduto");
            die();
        } 
        else {
            echo "Erro: " . $sql . "<br>" . $ligacao -> error;
            }      
        }
    }
    
 ?>