
<?php 
   include_once("ligacao.php");
    session_start();
    
    
    //encontrar os produtos 
    include("encontraprodutoscarrinho.php");

    $jsonId = json_encode($idsEncontrados);
    $jsonTamanho = json_encode($tamanhoID);
    $jsonQuantidade = json_encode($quantidadeID);
    echo($jsonId.$jsonTamanho.$jsonQuantidade);


    //como encontrar de novo

    $idsEncontrados = json_decode($jsonId);
    $tamanhosEncontrados = json_decode($jsonTamanho);
    $quantidadeEncontrada = json_decode($jsonQuantidade);
    print_r($idsEncontradosJson);
    print_r($tamanhosEncontradosJson);
    print_r($quantidadeEncontradaJson);
                                $precototal =0;
                                $totalprodutos=0;
                                for ($i = 0; $i < count($idsEncontrados); $i++) {
                                    
                                    $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." LIMIT 1";
                                 
                                    $resultado_final = mysqli_query($ligacao, $sql);
                                    $count=0;
                                   
                                    $row = $resultado_final->fetch_assoc();
                                    $totalprodutos+= $quantidadeID[$i];
                                    include("encontradesconto.php");
                                   
                                    $precototal+= $precofinal * $quantidadeID[$i];
                                   
                                    ?>
                                <div class="row" >
                                <form action="atualizarCarrinho.php?edit=1&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>" method="POST">
                                    <div class="col-4 pr-0" ><a class="align-middle" href="detalhe.php?id=<?php echo ($row['id'])?>" ><img src="images/produtos/<?php echo ($row['foto1'])?>" alt=""></a></div>
                                    <div class="col-8 float-right">
                                    
                                        <div><h5 class="mb-1 text-right mr-1"><?php echo ($row['nome'])?></h5></div>
                                        <div class="text-muted small text-right"><?php echo ($row['ref'])?></div>
                                        <div class="text-muted text-right ">Tamanho <?php echo($tamanhoID[$i])?></div>
                                        <div class="text-right text-muted ">Qtd: <?php echo($quantidadeID[$i])?></div>
                                        <div class="text-right text-muted "> Preço Uni: <?php echo(number_format($precofinal,2));?>€ </div>
                                        <div class="text-right text-muted "> Preço Total: <?php echo(number_format($precofinal * $quantidadeID[$i],2));?>€ </div>
                                    </div>
                                </form>
                                </div>

                                <hr>
                                
                <?php
                                           
                                }
                        
                            
                            ?>      
    
    
    ?>


</html>