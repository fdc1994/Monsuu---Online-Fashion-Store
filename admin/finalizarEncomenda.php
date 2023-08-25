<?php
session_start();
include("verificaStockFinalizar.php");


    include_once("ligacao.php");
    

    date_default_timezone_set('Europe/Lisbon');
    $metodopagamento = $_SESSION['metodoPagamento'];
    echo($metodopagamento);
    $comentarios = $_POST['comentarios'];
    $_SESSION['comentarios'] = $comentarios;
    $nome = $_SESSION["dadosEncomenda"][0] . " " . $_SESSION["dadosEncomenda"][1];
    $telefone = $_SESSION["dadosEncomenda"][2];
    $morada = $_SESSION["dadosEncomenda"][3];
    $distrito = $_SESSION["dadosEncomenda"][4];
    $concelho = $_SESSION["dadosEncomenda"][5];
    $codigopostal = $_SESSION["dadosEncomenda"][6];
    $email = $_SESSION['userEmail'];
    if(isset($_SESSION['nif'])) {
        $nif = $_SESSION["dadosEncomenda"][7];
    }
    else{
        $nif ="999999999";
    }
    if(isset($_POST['telefoneMBWAY'])) {
        $_SESSION['telefoneMBWAY'] = $_POST['telefoneMBWAY'];
        }
           
        include("encontraprodutoscarrinho.php");
        $precototal =0;
        $totalprodutos=0;
        $novoStock = 0;
        $precoID= array();
      
        for ($i = 0; $i < count($idsEncontrados); $i++) {
            
            $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." AND listado = 1 LIMIT 1";
            
            $resultado_final = mysqli_query($ligacao, $sql);
            $count=0;
            $row = $resultado_final->fetch_assoc();
            $tamanho= $tamanhoID[$i];
            $idproduto = $idsEncontrados[$i];
            $stock = json_decode($row['stock'], TRUE);
           
            $totalprodutos+= $quantidadeID[$i];
            include("encontradesconto.php");
            $precoID[$idsEncontrados[$i]] = strval($precofinal);
            $precototal+= $precofinal * $quantidadeID[$i];
            $novoStock = $stock[$tamanho] - $quantidadeID[$i] ;
            
            //echo (" o Novo stock vai ser ".$row['stock'.$tamanho] ." -".  $quantidadeID[$i]);
            
            $jsonStock = json_encode($stock);
            
            $sqlAtualizaStock= "UPDATE produtos SET stock = '$jsonStock' WHERE id = $idproduto";
            echo"<br><br><br><br>".$sqlAtualizaStock . "<br><br>";
            //echo$sqlAtualizaStock;
            $encomendaDetalhes = $encomendaDetalhes . " | Nome Produto: " .$row['nome'] . " | Quantidade: " . $quantidadeID[$i] . " | Tamanho: " . $tamanhoID[$i] . "|" ." Preço Final: " . $precofinal . "------------\n"; 
           
            if($ligacao -> query($sqlAtualizaStock) === TRUE) {
                //echo("Modificação do Stock Com Sucesso <br>");
                $sqlapagacarrinho = "DELETE FROM carrinhocompras WHERE idProduto = $idproduto and idUtilizador = $idutilizador and tamanho LIKE '$tamanho'";
                echo $sqlapagacarrinho;
                if ($ligacao -> query ($sqlapagacarrinho) === TRUE){
                    //echo("Apagado do Carrinho <br>");
                    //echo $sqlapagacarrinho;
                    }
                    else {
                        echo "Erro: " . $sqlapagacarrinho . "<br>" . $ligacao -> error;
                    }
            }
            else {
                echo "Erro: " . $sql . "<br>" . $ligacao -> error;
            }
        }
        if($precototal >= 50) {
            $encomendaDetalhes = $encomendaDetalhes . "------------\n" . "Portes: GRÁTIS";
            $encomendaDetalhes = $encomendaDetalhes . "------------\n" . "Total: ".$precototal."€";
            //echo $encomendaDetalhes;
        }
        else {
            $encomendaDetalhes = $encomendaDetalhes . "------------\n" . "Portes: 3,99€";
            $encomendaDetalhes = $encomendaDetalhes . "------------\n" . "Total: ".($precototal+3.99)."€";
            //echo $encomendaDetalhes;
        }
        $encomendaDetalhes = $encomendaDetalhes . "------------\n" . "Total: $precototal"."€";
        
        //echo $encomendaDetalhes;
        if($i== count($idsEncontrados)-1) {
            //echo"tratamento dos produtos com sucesso <br>";
        }
        $jsonId = json_encode($idsEncontrados);
        $jsonTamanho = json_encode($tamanhoID);
        $jsonQuantidade = json_encode($quantidadeID);
        $jsonPreco = json_encode($precoID);

        $sqlCount = "SELECT COUNT(*) FROM encomendas";
         
        $resultado_count = mysqli_query($ligacao, $sqlCount);
        $rowCount = $resultado_count->fetch_assoc();
        
        
        $orderNumber = "MS" . substr(date("Y"), -2) . sprintf('%02d', ($rowCount['COUNT(*)'] + 1));
        
       
        if($precototal < 50) {
            $precototal+= 3.99;
            $portes = "3.99";
         }
         else {
             $portes = "GRATIS";
         }
        if($_SESSION['metodoPagamento'] == "Multibanco") {
            
            include("multibanco.php");
            GenerateMbRef(12374, 809, $orderNumber, $precototal);
            $detalhesPagamento= array();
            array_push($detalhesPagamento, $_SESSION['refMB']['entidade']);
            array_push($detalhesPagamento, $_SESSION['refMB']['referencia']);
            $referencia = $_SESSION['refMB']['referencia'];
            array_push($detalhesPagamento, $_SESSION['refMB']['valor']);
            $currentDate = date('d/m/Y H:i:s', time());
            $dateLimit = date('d/m/Y H:i:s', time() + (86400*2));
            $valorLiquido = $precototal - ($precototal*0.017+0.22)*1.23;
            $valorLiquido= number_format($valorLiquido,2);
        }
        else if($_SESSION['metodoPagamento'] == "Payshop") {
            include("requestPayshop.php");
            $currentDate = date('d/m/Y H:i:s', time());
            $dateLimit = date('d/m/Y', time() + (86400*2));
            
            generatePayshop($precototal,str_replace("/", "",date('Y/m/d', time() + (86400*2))),$orderNumber);
            echo("<br><br>Inicio imprimir referencia sessão refPayshop:" . $_SESSION['refPayshop']['Reference'] ."<br>");
            $detalhesPagamento= array();
            array_push($detalhesPagamento, $_SESSION['refPayshop']['Reference']);
            $referencia = $_SESSION['refPayshop']['Reference'];
            array_push($detalhesPagamento, number_format($precototal,2));
            array_push($detalhesPagamento, $dateLimit);
            $_SESSION['refPayshop']['preco'] = number_format($precototal,2);
            $_SESSION['refPayshop']['limite'] = $dateLimit;

            $valorLiquido = (($precototal -0.57)*1.23);
            $valorLiquido= number_format($valorLiquido,2);
        }
        else if($_SESSION['metodoPagamento'] == "MBWAY") {
            $detalhesPagamento= array();
            include("requestMBWAY.php");
            requestMbWay($precototal, $_SESSION['telefoneMBWAY'],$email,$orderNumber);
            $currentDate = date('d/m/Y H:i:s', time());
            $dateLimit = date('d/m/Y H:i:s', time() + 300);
            $valorLiquido = $precototal - ($precototal*0.007+0.07)*1.23;
            $valorLiquido= number_format($valorLiquido,2);
            include("verificacaoEncomendaMBWAY.php");
            verificaEncomendaMBWAY($orderNumber);
            array_push($detalhesPagamento, $_SESSION['telefoneMBWAY']);
            array_push($detalhesPagamento, number_format($precototal,2));
            array_push($detalhesPagamento, $dateLimit);
            
        }
        
        $dia = date("d/m/Y");
        $hora= date("H:i:s");
        $detalhesPagamento= json_encode($detalhesPagamento);
        echo $detalhesPagamento;

        $diaHora= $dia. " " .  $hora;
        
        $sqlEncomenda = "INSERT INTO encomendas (idEncomenda, idUtilizador, nome, morada, distrito, cidade, cpostal, telefone, email ,nif, detalhe,comentariosCliente, jsonId, jsonTamanho, jsonQuantidade, jsonPreco, dataEncomenda, horaEncomenda,limitePagamento, metodoPagamento, detalhesPagamento, portes, totalencomenda, estadoencomenda) 
        VALUES ('$orderNumber', $userId, '$nome', '$morada', '$distrito', '$concelho', '$codigopostal', $telefone, '$email', $nif, '$encomendaDetalhes', '$comentarios', '$jsonId', '$jsonTamanho','$jsonQuantidade','$jsonPreco','$dia','$hora','$dateLimit','$metodopagamento','$detalhesPagamento','$portes', $precototal,'Aguarda Pagamento')";
        
        
        if ($ligacao -> query ($sqlEncomenda) === TRUE){
           $_SESSION['limitePagamento'] = $dateLimit;
           if($_SESSION['metodoPagamento'] == "Multibanco" || $_SESSION['metodoPagamento'] == "Payshop") {
            $referenciaConcatenate =str_replace(' ', '', $referencia);
            $sqlPagamentos = "INSERT INTO pagamentosencomendas (idEncomenda, referencia, dataEncomenda, limitePagamento, valorLiquido, valorBruto, metodoPagamento, pago) 
            VALUES ('$orderNumber', '$referenciaConcatenate', '$currentDate','$dateLimit',$valorLiquido,$precototal, '$metodopagamento',0)";
           }
           else if($_SESSION['metodoPagamento'] == "MBWAY") {
            $sqlPagamentos = "INSERT INTO pagamentosencomendas (idEncomenda, dataEncomenda, limitePagamento, valorLiquido, valorBruto, metodoPagamento, pago) 
            VALUES ('$orderNumber', '$currentDate','$dateLimit',$valorLiquido,$precototal, '$metodopagamento',0)";
           }
            
            
             if ($ligacao -> query ($sqlPagamentos) === TRUE){
                header("Location: ../carrinho.php?buy=orderComplete&orderNumber=$orderNumber");
                
                if($metodopagamento== "MBWAY") {
                     include("smtp.php");
                    newOrderMBWay($nome, $orderNumber, $_SESSION['telefoneMBWAY'], $precototal,$dateLimit, $email);
                    newOrderAdmin("Fábio", $orderNumber, "MBWay", $precototal,$dateLimit, "fabiocarvalho@monsuu.pt");
                }
                else if($metodopagamento== "Payshop") {
                     include("smtp.php");
                    newOrderPayshop($nome, $orderNumber, $_SESSION['refPayshop']['Reference'], $precototal,$_SESSION['refPayshop']['limite'], $email);
                    newOrderAdmin("Fábio", $orderNumber, "Payshop", $precototal,$dateLimit, "fabiocarvalho@monsuu.pt");
                }
                else if($metodopagamento== "Multibanco") {
                     include("smtp.php");
                    newOrderMb($nome, $orderNumber, $_SESSION['refMB']['entidade'], $_SESSION['refMB']['referencia'], $precototal,$dateLimit, $email);
                    newOrderAdmin("Fábio", $orderNumber, "Multibanco", $precototal,$dateLimit, "fabiocarvalho@monsuu.pt");
                }

                }   
                else {
                    $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-warning' role='alert'>Ocorreu um erro a processar a sua encomenda, por favor entre em contacto connosco.</div>";
                    header("Location: ../carrinho.php");
                    echo "Erro: " . $sqlPagamentos . "<br>" . $ligacao -> error;
                }
            }

            else {
                $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-warning' role='alert'>Ocorreu um erro ao processar a sua encomenda, por favor entre em contacto connosco.</div>";
               header("Location: ../carrinho.php");
                echo "Erro: " . $sqlEncomenda . "<br>" . $ligacao -> error;
            }
        
        
               
           
    
 
 ?>
 
