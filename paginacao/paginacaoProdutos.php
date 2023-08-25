<?php


    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
    if(isset($produto)) {
        $sql = "SELECT * FROM produtos WHERE categoria LIKE '%$produto%' AND listado = 1";
    }
    else if(isset($colecao)) {
        $sql = "SELECT * FROM produtos WHERE colecao LIKE '%$colecao%' AND listado = 1";
    }
    else if(isset($novidades)) {
        $sql = "SELECT * FROM produtos WHERE novidade = 1 AND listado = 1";
    }
    else if(isset($saldos)) {
        $sql = "SELECT * FROM promocoes";
    }

    if(!isset($_POST['orderBy']) && !isset($_GET['orderBy'])) {
        $orderBy = "name";
    }
    else if(isset($_POST['orderBy'])) {
        $orderBy = $_POST['orderBy'];
    }
    else if (isset($_GET['orderBy'])) {
        $orderBy = $_GET['orderBy'];
    }
    $idsEncontrados = array();
    
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            array_push($idsEncontrados, $row['id']);
        }
    }

    

    //total de produtos encontrados;
    $total_produtos = count($idsEncontrados);

    //Quantidade de livros por pagina
    $quantidade_pg = 9;

    //calcular o número de pagina necessárias para apresentar os livros
    $num_pagina = ceil($total_produtos / $quantidade_pg);

    if($total_produtos !=0) {
        ?>
<div class="row">
    <div class='lead col-lg-8 col-md-12 ml-2 mt-5 text-left'>A Visualizar Página <?php echo$pagina ?> de
        <?php echo$num_pagina ?></div>

    <div class="lead col-lg-3 col-md-12 mr-2 mt-5">
        <?php
        if(isset($produto) ){
            ?>
        <form action="?produto=<?php echo $produto?>&pagina=<?php echo $pagina?>" method="POST">
            <?php
        }
        else if(isset($colecao)) {?>
            <form action="?colecao=<?php echo $colecao?>&pagina=<?php echo $pagina?>" method="POST">
                <?php
        }
        else if(isset($novidades)) {?>
                <form action="?novidades=<?php echo $novidades?>&pagina=<?php echo $pagina?>" method="POST">
                    <?php
                    }
                    else if(isset($saldos)) {?>
                    <form
                        action="?saldos=<?php echo $saldos?>&pagina=<?php echo $pagina?>&orderBy=<?php echo $orderBy?>"
                        method="POST">
                        <?php
                                }  
        ?>


                        <div class="form-group">
                            <span style="white-space: nowrap">
                                <label for="size">Ordenar Por:</label>
                                <select class="form-control-sm" id="orderBy" name="orderBy"
                                    onchange="this.form.submit()">
                                    <option <?php if ($orderBy == "precAsc") {echo "selected";}?> value="precAsc">Preço
                                        Ascendente
                                    </option>
                                    <option <?php if ($orderBy == "precDesc") {echo "selected";}?> value="precDesc">
                                        Preço
                                        Descendente</option>
                                    <option <?php if ($orderBy == "col") {echo "selected";}?> value="col">Coleção
                                    </option>
                                    <option <?php if ($orderBy == "name") {echo "selected";}?> value="name">Nome
                                    </option>

                                </select>
                    </form>
                    </span>
    </div>
</div>
</div>


<?php
    }
    if($total_produtos == 1){
        $idAProcurar = implode("", $idsEncontrados);
        
    }
    else{
        $idAProcurar = implode(",", $idsEncontrados);
    }
    //Inicio da visualização
    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    //Selecionar os livros a serem apresentado na página
    if($total_produtos >0) {
        if($orderBy =="col") {
            $sql = "SELECT * FROM produtos WHERE id IN ($idAProcurar) AND listado = 1 ORDER BY colecao limit $inicio, $quantidade_pg";
          }
          else if($orderBy =="name") {
            $sql = "SELECT * FROM produtos WHERE id IN ($idAProcurar) AND listado = 1 ORDER BY nome limit $inicio, $quantidade_pg";
          }
          else if($orderBy =="precAsc") {
            $sql = "SELECT * FROM produtos WHERE id IN ($idAProcurar) AND listado = 1 ORDER BY preco ASC limit $inicio, $quantidade_pg";
          }
          else if($orderBy =="precDesc") {
            $sql = "SELECT * FROM produtos WHERE id IN ($idAProcurar) AND listado = 1 ORDER BY preco DESC limit $inicio, $quantidade_pg";
          }
        
        $resultado_final = mysqli_query($ligacao, $sql);
        if ($resultado_final->num_rows > 0) { ?>
<div class="container mx-auto">
    <div class="row mx-auto">
        <?php
                    unset($desconto);
                        while ($row = $resultado_final->fetch_assoc()) {
                            include("encontradesconto.php");
                            if(!isset($desconto))
                            {$desconto=0;}
                            
                            $stock = json_decode($row['stock'], TRUE);
                            //print_r($stock) ;
                            $totalStock = array_sum($stock);
                            //echo " Total Stock : " . $totalStock;
                            ?>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card w-100 h-100 lead">
                <a href="detalhe.php?id=<?php echo ($row['id'])?>"><img class="card-img-top mt-0" style="max-width:100%"
                        src="images/produtos/<?php echo $row['foto1']?>" alt="Card image cap"></img></a>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nome']?> <br> <?php if($desconto>0) {?> <div
                            class="discount text-center lead mt-2">-<?php echo($desconto)?>%</div>
                        <?php }?><?php if($row['novidade'] == 1)  {?>
                        <span class="new text-center lead mt-2">Novo</span><?php }?>
                    </h5>
                    <hr>
                    <div class="col-12 mb-2">
                        <?php if($totalStock <=0)  {?>
                        <span class="soldOut text-center lead">Esgotado</span><?php }?>
                    </div>
                    <?php if($desconto>0) {
                                    ?>

                    <p class="card-text text-center">

                        <del class="text-danger h6"><?php echo ("Antes: " . $row['preco'])?>€</del>&nbsp; <br>
                        <span class="text-success h4"><?php echo("Agora: " . number_format($precofinal,2));?>€</span>
                        <br>

                    </p>
                    <?php
                                    
                                }
                                else{?>
                    <p class="card-text">
                    <div class="text-success h4"><?php echo ($row['preco'])?>€</div>&nbsp;<?php
                                }unset($precofinal, $desconto);
                                ?>


                </div>
            </div>


        </div>
        <?php        
                         }
                         
        }
        
    }



    else {
        echo "<p class='lead display-4 text-center mt-5'>Sem Resultados</p>";
    }
    
    if($total_produtos >0){
           
        //Verificar a pagina anterior e seguinte
        $pagina_anterior = $pagina - 1;
        $pagina_posterior = $pagina + 1;
        echo("
        </div>
        <div class='row justify-content-center mt-5 mb-5'>
        <nav aria-label='...'>
          <ul class='pagination'>");
    
          
          
        if ($pagina_anterior != 0) { 
            if(isset($produto)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_anterior&produto=$produto&orderBy=$orderBy'>Anterior</a></li>");
            }
            else if(isset($colecao)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_anterior&colecao=$colecao&orderBy=$orderBy'>Anterior</a></li>");
            }
            else if(isset($novidades)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_anterior&novidades=$novidades&orderBy=$orderBy'>Anterior</a></li>");
            }
            else if(isset($saldos)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_anterior&saldos=$saldos&orderBy=$orderBy'>Anterior</a></li>");
            }
         } else {
            echo("
            <li class='page-item disabled' style='display: block!important;'><a class='page-link' >Anterior</a></li>"); 
        }  
    
        //Apresentar o número de paginacão
        for ($i = 1; $i <= $num_pagina; $i++) 
        { 
            
            if($i != $pagina) {
                if(isset($produto)) {
                    echo("<li class='page-item'><a class='page-link' href='produtos.php?pagina=$i&produto=$produto&orderBy=$orderBy'>$i</a></li>");
                }
                else if(isset($colecao)) {
                    echo("<li class='page-item'><a class='page-link' href='produtos.php?pagina=$i&colecao=$colecao&orderBy=$orderBy'>$i</a></li>");
                }
                else if(isset($novidades)) {
                    echo("<li class='page-item'><a class='page-link' href='produtos.php?pagina=$i&novidades=$novidades&orderBy=$orderBy'>$i</a></li>");
                }
                else if(isset($saldos)) {
                    echo("<li class='page-item'><a class='page-link' href='produtos.php?pagina=$i&saldos=$saldos&orderBy=$orderBy'>$i</a></li>");
                }
                
            }  
            else {
                if(isset($produto)) {
                    echo("<li class='page-item active'><a class='page-link' href='produtos.php?pagina=$i&produto=$produto&orderBy=$orderBy'>$i</a></li>");
                }
                else if(isset($colecao)) {
                    echo("<li class='page-item active'><a class='page-link' href='produtos.php?pagina=$i&colecao=$colecao&orderBy=$orderBy'>$i</a></li>");
                }
                else if(isset($novidades)) {
                    echo("<li class='page-item active'><a class='page-link' href='produtos.php?pagina=$i&novidades=$novidades&orderBy=$orderBy'>$i</a></li>");
                }
                else if(isset($saldos)) {
                    echo("<li class='page-item active'><a class='page-link' href='produtos.php?pagina=$i&saldos=$saldos&orderBy=$orderBy'>$i</a></li>");
                }
                
            }
           
        }
    
        if ($pagina_posterior <= $num_pagina) {  
            if(isset($produto)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_posterior&produto=$produto&orderBy=$orderBy'>Próxima</a></li>");
            }
            else if(isset($colecao)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_posterior&colecao=$colecao&orderBy=$orderBy'>Próxima</a></li>");
            }
            else if(isset($novidades)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_posterior&novidades=$novidades&orderBy=$orderBy'>Próxima</a></li>");
            }
            else if(isset($saldos)) {
                echo("
                <li class='page-item'><a class='page-link' href='produtos.php?pagina=$pagina_posterior&saldos=$saldos&orderBy=$orderBy'>Próxima</a></li>");
            }} 
            else { 
           echo("
            <li class='page-item disabled'  style='display: block!important;'><a class='page-link' >Próxima</a></li></nav></div>"); 
            }
        
        }
    
    
        $ligacao->close();
    ?>
    </div>