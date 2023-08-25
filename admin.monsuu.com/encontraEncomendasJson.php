<?php 
    $numeroEncomenda =(isset($_GET['orderNumber'])) ? $_GET['orderNumber'] : null;
    $null =(isset($_GET['null'])) ? $_GET['null'] : null;
    $populatedLeft= false;
    if(isset($numeroEncomenda)) {
        $sql = "SELECT * FROM encomendas WHERE idEncomenda LIKE '$numeroEncomenda' LIMIT 1";
        //echo $sql;
        $resultado = mysqli_query($ligacao, $sql);
        $count=0;
        $row = $resultado->fetch_assoc();
        $jsonId = $row['jsonId'];
        $jsonTamanho = $row['jsonTamanho'];
        $jsonQuantidade = $row['jsonQuantidade'];
        $jsonPreco = $row['jsonPreco'];
        $jsonDetalhesPagamento = $row['detalhesPagamento'];
        //echo $jsonDetalhesPagamento;
        $idsEncontrados = json_decode($jsonId, TRUE);
        $tamanhoID = json_decode($jsonTamanho, TRUE);
        $quantidadeID = json_decode($jsonQuantidade, TRUE);
        $precoID = json_decode($jsonPreco, TRUE);
        $detalhesPagamento = json_decode($jsonDetalhesPagamento, TRUE);

        //print_r($idsEncontrados);
        //print_r($tamanhoID);
        //print_r($quantidadeID);
        //print_r($precoID);
        //print($jsonDetalhesPagamento);
        //print_r($detalhesPagamento);
    }
    

                                $precototal =0;
                                $totalprodutos=0;
                                for ($i = 0; $i < count($idsEncontrados); $i++) {
                                    
                                    $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." LIMIT 1";
                                 
                                    $resultado_final = mysqli_query($ligacao, $sql);
                                    $count=0;
                                   
                                    $row = $resultado_final->fetch_assoc();
                                    $totalprodutos+= $quantidadeID[$i];
                                    include("encontradesconto.php");
                                   
                                    $precototal+= $precoID[$idsEncontrados[$i]] * $quantidadeID[$i];
                                  
                                   
                                    ?>
                                <div class="row" >
                                <form action="atualizarCarrinho.php?edit=1&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>" method="POST">
                                    <div class="col-4 pr-0" ><a class="align-middle" href="detalhe.php?id=<?php echo ($row['id'])?>" ><img src="images/produtos/<?php echo ($row['foto1'])?>" alt=""></a></div>
                                    <div class="col-8 float-right">
                                    
                                        <div><h5 class="mb-1 text-right mr-1"><?php echo ($row['nome'])?></h5></div>
                                        <div class="text-muted small text-right"><?php echo ($row['ref'])?></div>
                                        <div class="text-muted text-right ">Tamanho <?php echo($tamanhoID[$i])?></div>
                                        <div class="text-right text-muted ">Qtd: <?php echo($quantidadeID[$i])?></div>
                                        <div class="text-right text-muted "> Preço Uni: <?php echo $precoID[$idsEncontrados[$i]];?>€ </div>
                                        <div class="text-right text-muted "> Preço Total: <?php echo(number_format($precoID[$idsEncontrados[$i]] * $quantidadeID[$i],2));?>€ </div>
                                    </div>
                                </form>
                                </div>

                                <hr>
                                
                <?php
                
                                           
                                }
                        
                            
                            ?>      