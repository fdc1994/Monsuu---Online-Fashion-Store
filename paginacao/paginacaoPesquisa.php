<?php
    
    $pesquisa = (isset($_POST['pesquisa'])) ? $_POST['pesquisa'] : $_GET['pesquisa'];
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
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
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$pesquisa%' AND listado = 1";
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            array_push($idsEncontrados, $row['id']);
        }
    }
    $sql = "SELECT * FROM produtos WHERE categoria LIKE '%$pesquisa%' AND listado = 1";
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            if(!in_array($row['id'], $idsEncontrados)) {
                array_push($idsEncontrados, $row['id']);
            }
        }
    }

    $sql = "SELECT * FROM produtos WHERE colecao LIKE '%$pesquisa%' AND listado = 1";
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            if(!in_array($row['id'], $idsEncontrados)) {
                array_push($idsEncontrados, $row['id']);
            }
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
        <form action="?pagina=<?php echo $pagina?>&pesquisa=<?php echo $pesquisa?>" method="POST">
            <div class="form-group">
                <span style="white-space: nowrap">
                    <label for="size">Ordenar Por:</label>
                    <select class="form-control-sm" id="orderBy" name="orderBy" onchange="this.form.submit()">
                        <option <?php if ($orderBy == "precAsc") {echo "selected";}?> value="precAsc">Preço Ascendente
                        </option>
                        <option <?php if ($orderBy == "precDesc") {echo "selected";}?> value="precDesc">Preço
                            Descendente</option>
                        <option <?php if ($orderBy == "col") {echo "selected";}?> value="col">Coleção</option>
                        <option <?php if ($orderBy == "name") {echo "selected";}?> value="name">Nome</option>

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
                <a href="detalhe.php?id=<?php echo ($row['id'])?>"><img class="card-img-top mt-0 w-100"
                        style="max-height:85%!important" src="images/produtos/<?php echo $row['foto1']?>"
                        alt="Card image cap"></img></a>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nome']?> <br><?php if($desconto >0) {?> <div
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
            echo("
            <li class='page-item'><a class='page-link' href='resultadopesquisa.php?pagina=$pagina_anterior&pesquisa=$pesquisa&orderBy=$orderBy'>Anterior</a></li>");
            ?>
        <?php } else {
            echo("
            <li class='page-item disabled' style='display: block!important;'><a class='page-link' >Anterior</a></li>"); 
        }  
    
        //Apresentar o número de paginacão
        for ($i = 1; $i <= $num_pagina; $i++) 
        { 
            if($i != $pagina) {
                echo("<li class='page-item'><a class='page-link' href='resultadopesquisa.php?pagina=$i&pesquisa=$pesquisa&orderBy=$orderBy'>$i</a></li>");
            }  
            else {
                echo("<li class='page-item active'><a class='page-link' href='resultadopesquisa.php?pagina=$i&pesquisa=$pesquisa&orderBy=$orderBy'>$i</a></li>");
            }
           
        }
    
        if ($pagina_posterior <= $num_pagina) {  echo("
            <li class='page-item'><a class='page-link' href='resultadopesquisa.php?pagina=$pagina_posterior&pesquisa=$pesquisa&orderBy=$orderBy'>Próxima</a></li></nav></div>");} 
            else { 
           echo("
            <li class='page-item disabled'  style='display: block!important;'><a class='page-link' >Próxima</a></li></nav></div>"); 
            }
        
        }
    
    
        $ligacao->close();
    ?>
    </div>