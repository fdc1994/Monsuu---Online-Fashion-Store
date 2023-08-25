        <?php

    $buy = (isset($_GET['buy'])) ? $_GET['buy'] : null;
    if (isset($buy)){
        include("verificaStockFinalizar.php");
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    //Selecionar todos os campos da tabela isla
    if(isset($idAProcurar)) {

    
    $sqlProdutos = "SELECT * FROM produtos WHERE id IN ($idAProcurar)";
    $resultadoProdutos = mysqli_query($ligacao, $sqlProdutos);
    //mysqli_query --> Realiza uma consulta na base de dados

    //Total de livros 
    $total_titulos = mysqli_num_rows($resultadoProdutos);
    //mysqli_num_rows --> Obtenha o número de linhas no resultado

    //Quantidade de livros por pagina
    $quantidade_pg = 3;

    //calcular o número de pagina necessárias para apresentar os livros
    $num_pagina = ceil($total_titulos / $quantidade_pg);
    if($total_titulos !=0) {
        echo("<div class='lead ml-5 mb-5'>A Visualizar Página $pagina de $num_pagina</div>");
    }
    //ceil --> Frações arredondadas para cima

    //Inicio da visualização
    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    //Selecionar os livros a serem apresentado na página
    $sql = "SELECT * FROM produtos WHERE id IN ($idAProcurar) limit $inicio, $quantidade_pg";
    $resultadoProdutos = mysqli_query($ligacao, $sql);
    if($resultadoProdutos -> num_rows >0) {
        
        ?>
        <div class='container container-custom mt-5'>
            <div class="row text-center">
                <div class="col-6">
                    <h1 class="title">Resumo Da Encomenda</h1>
                </div>
                <div class="col-6">
                    <h1 class="title">Dados De Entrega</h1>
                </div>
            </div>
            <div class='row'>
                <div class="col-6">
                <div class="row">
                <table class='table table-striped table-responsive table-bordered bg-white' >
                    <thead class='thead-light'>
                        <tr>
                            <th scope='col'><b>Foto</th>
                            <th scope='col'><b>Nome</th>
                            <th scope='col'><b>Quantidade Produto</b></th>
                            <th scope='col'><b>Fabricante</th>
                            <th scope='col'><b>Referência</th>
                            <th scope='col'><b>Preço Unidade</th>
                            <th scope='col'><b>Quantidade</th>
                            <th scope='col'><b>Preço Total</th>
                        </tr>
                        </thead>
                        <tbody> <?php 
                      
                        while ($row = mysqli_fetch_assoc($resultadoProdutos)) {
                        include("encontradesconto.php");
                        
                        ?>
                            <tr>
                            <form action="finalizarcarrinho.php>" method="POST">
                            <th><img class="img-fluid w-50" src="images/<?php echo ($row['foto'])?>" ></img></th>
                            <td><?php echo ($row['nome'])?></td>
                            <td><?php echo($row['quantidade'] . " " . $row['medida']);?></td>
                            <td><?php echo ($row['fabricante'])?></td>
                            <td><input type="text" class="form-control"value="<?php echo ($row['ref'])?>" name="ref" readonly></td>
                            <td><?php echo(round($precofinal,2));?><b>€</td>
                            <td >
                                <?php echo("<input type='text' class='form-control' name='quantidade' value='".$idsEncontrados[$row['id']]."' readonly></input>")?>
                                </td>
                            <td><?php echo(round($idsEncontrados[$row['id']] * $precofinal,2))?><b>€</td>
                            </form>
                            </tr>
                        <?php
                        }?>
                            <tr>
                            <th colspan="6"><b>Total: </b></th>
                            <td></td>
                            <td colspan="1"><b><?php echo(round($precototal,2));?>€</td>
                            </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col"><?php
                    if($total_produtos >0){
           
           //Verificar a pagina anterior e seguinte
           $pagina_anterior = $pagina - 1;
           $pagina_posterior = $pagina + 1;
          ?>
  
           <nav aria-label='...' class="justify-content-center">
             <ul class='pagination justify-content-center'>
          <?php
             
           if ($pagina_anterior != 0) { 
               ?>
               <li class='page-item'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_anterior?>&buy=1'>Anterior</a></li>
           <?php } else {
               ?>
               <li class='page-item disabled'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_anterior?>&buy=1'>Anterior</a></li>
           <?php
           }  
       
           //Apresentar o número de paginacão
           for ($i = 1; $i <= $num_pagina; $i++) 
           { ?>
            <li class='page-item'><a class='page-link' href='carrinho.php?pagina=<?php echo $i ?>&buy=1'><?php echo $i ?></a></li>
            <?php
           }
       
           if ($pagina_posterior <= $num_pagina) {  ?>
               <li class='page-item'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_posterior?>&buy=1'>Posterior</a></li></nav>
           <?php }else { ?>
   
               <li class='page-item disabled'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_posterior?>&buy=1'>Posterior</a></li></nav>
               <?php
   
           
           }
       }?>
                    </div>
                </div>
                </div>
                    
             </div>
             
            <div class="col-6">
                <form action="finalizarEncomenda.php" method="POST">
                    <div class="row mb-1">
                        <div class="col">
                            <label>Nome</label>
                        <input type="text" class="form-control" value="<?php echo$_SESSION['userNome'] . " " . $_SESSION['userApelido'] ?>">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6">
                            <label for="exampleFormControlTextarea1">Morada</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo$_SESSION['userMorada'] ?></textarea>
                        </div>
                        <div class="col-6">
                            <div class="row mb-1">
                                <div class="col"><label for="exampleFormControlTextarea1">Distrito</label> <input type="text" class="form-control" value="<?php echo$_SESSION['userDistrito'] ?>"readonly></div>
                                <div class="col"> <label for="exampleFormControlTextarea1">Cidade</label> <input type="text" class="form-control" value="<?php echo$_SESSION['userCidade'] ?>"readonly></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col"><label for="exampleFormControlTextarea1">Código Postal</label> <input type="text" class="form-control" value="<?php echo$_SESSION['userCpostal'] ?>"readonly></div>
                        <div class="col"><label for="exampleFormControlTextarea1">Telefone</label> <input type="text" class="form-control" value="<?php echo$_SESSION['userTelefone'] ?>"readonly></div>
                    </div>
            </div>  
                <div class="row mb-1 ml-2">
                        <div class="col">
                            <h1 class="title">Método De Pagamento</h1>
                        </div>
                </div>
                <div class="row ml-2"> 
                    <div class="col">
                        <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="metodopagamento" id="exampleRadios1" value="MBWAY" checked>
                        <label class="form-check-label align-middle" for="exampleRadios1">
                            <img src="images/mbway.png" class="w-50" alt="">
                        </label>
                        </div>

                        <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="metodopagamento" id="exampleRadios2" value="Referência Multibanco">
                        <label class="form-check-label" for="exampleRadios2">
                            <img src="images/multibanco.png" class="img-fluid" style="width:7.5%;"alt=""> Referência
                        
                        </label>
                        </div>

                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodopagamento" id="exampleRadios3" value="Transferência Bancária">
                        <label class="form-check-label" for="exampleRadios3">
                        <i class="fas fa-receipt fa-2x ml-1 shadow "></i>     Transferência Bancária
                        </label>
                        </div>
                    </div>
                </div>


    </div>
    <div class="row mt-2">
        <div class="col-md-2"></div>
        <div class="col-md-6 text-center"> <a href="finalizarEncomenda.php"><button type="submit" class="btn btn-success btn-lg" >Terminar Compra<i class="fas fa-box fa-lg ml-2"></i></button></a></div>
        <div class="col-md-2"></div>
    </div>
    </div>
    </form>
</div> 
                
</div></div>

    
    
    <?php
    
    
}

   
    }
    }

    
    else if(!isset($buy)) {
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    //Selecionar todos os campos da tabela isla
    if(isset($idAProcurar)) {

    
    $sqlProdutos = "SELECT * FROM produtos WHERE id IN ($idAProcurar)";
    $resultadoProdutos = mysqli_query($ligacao, $sqlProdutos);
    //mysqli_query --> Realiza uma consulta na base de dados

    //Total de livros 
    $total_produtos = mysqli_num_rows($resultadoProdutos);
    //mysqli_num_rows --> Obtenha o número de linhas no resultado

    //Quantidade de produtos por pagina
    $quantidade_pg = 3;

    //calcular o número de pagina necessárias para apresentar os livros
    $num_pagina = ceil($total_produtos / $quantidade_pg);
    if($total_produtos !=0) {
        echo("<div class='lead ml-5 mb-5'>A Visualizar Página $pagina de $num_pagina</div>");
    }
    //ceil --> Frações arredondadas para cima

    //Inicio da visualização
    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    //Selecionar os livros a serem apresentado na página
    $sql = "SELECT * FROM produtos WHERE id IN ($idAProcurar) limit $inicio, $quantidade_pg";
    $resultadoProdutos = mysqli_query($ligacao, $sql);
    if($resultadoProdutos -> num_rows >0) {
        
        ?>
        <div class='container mt-5'>
        <div class="row text-center">
            <div class="col-12">
            <?php  if (isset($_SESSION['resultadoAddCarrinho'])){
                    echo $_SESSION['resultadoAddCarrinho'];
                    unset($_SESSION['resultadoAddCarrinho']);
                             }?>
                </div>
            </div>
            <div class='row'>
            
            <table width="100%" class='table table-striped table-bordered table-responsive bg-white'>

            <thead class='thead-light'>
            <tr>
                <th scope='col'><b>Foto</th>
                <th scope='col'><b>Nome</th>
                <th scope='col'><b>Quantidade</th>
                <th scope='col'><b>Fabricante</th>
                <th scope='col'><b>Referência</th>
                <th scope='col'><b>Preço Unidade</th>
                <th scope='col'><b>Quantidade</th>
                <th scope='col'><b>Preço Total</th>

            </tr>
            </thead>
<tbody> <?php 
    
    while ($row = mysqli_fetch_assoc($resultadoProdutos)) {
        include("encontradesconto.php");
       
        ?>
        <tr>
            <form action="atualizarCarrinho.php?edit=1&id=<?php echo $row['id'] ?>" method="POST">
            <th class="text-center"><img class="img-fluid w-50" src="images/<?php echo ($row['foto'])?>" ></img></th>
            <td><?php echo ($row['nome'])?></td>
            <td><?php echo($row['quantidade'] . " " . $row['medida']);?></td>
            <td><?php echo ($row['fabricante'])?></td>
            <td><input type="text" class="form-control"value="<?php echo ($row['ref'])?>" name="ref" readonly></td>
            <td><?php echo(round($precototal,2));?><b>€</td>
            <td >
                <?php echo("<input type='number' class='form-control' name='quantidade' value='".$idsEncontrados[$row['id']]."' min='1' ></input>")?>
                <div class="col-12 text-center mt-4">
                 
                    <button type="submit" class="btn-xs btn-outline-primary">Atualizar
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    </button>
                    <button type="button" class="btn-xs btn-outline-danger mt-2" data-toggle="modal" data-toggle="modal" data-target="#modalConfirm<?php echo($row['id'])?>">Apagar
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
            </button>
                </div>
                
            
                </td>
            <td><?php echo(round($idsEncontrados[$row['id']] * $precofinal,2))?><b>€</td>
            </form>
            <div class="modal fade" id="modalConfirm<?php echo($row['id'])?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pretende apagar este produto do seu carrinho?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">
                      <div class="row mb-1 d-flex flex-wrap align-items-center flex">
                            <div class="col">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo($row['nome'])?>" readonly>
                            </div>
                            <div class="col">
                            <label for="exampleInputEmail1">Quantidade</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo($row['quantidade'] . " " . $row['medida']);?>" readonly>
                            </div>
                            <div class="col">
                            <label for="exampleInputEmail1">Fabricante</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo($row['fabricante'])?>" readonly>
                            </div>

                        </div>
                      <div class="row mb-1 d-flex flex-wrap align-items-center flex">
                            <div class="col text-center align-middle">
                            <label for="exampleInputEmail1">Foto</label>
                            <img src="images/<?php echo $row['foto'] ?>"  class="img-fluid img-thumbnail">
                            </div>
                            <div class="col" style="height: 100%;">
                            <label for="exampleInputEmail1">Descrição</label>
                            <textarea class="form-control" rows="7" name="descricao" type="textarea" readonly ><?php echo($row['descricao'])?> "</textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                            <label for="exampleInputEmail1">Preço</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo($row['preco'])?>" readonly>
                            </div>
                            <div class="col">
                            
                            <label for="exampleInputEmail1">Quantidade</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" value="<?php echo($idsEncontrados[$row['id']])?>" min='0' max="<?php echo $row['stock']?>" readonly>
                            </div>
                            <div class="col">
                            
                            <label for="exampleInputEmail1">Total</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo(round($idsEncontrados[$row['id']] * $precofinal,2 ))?>€" readonly>
                            </div>
                        </div>
                        
                      
                      </div>
                      <div class="lead mt-2">
                      Não é possível reverter esta ação. Terá de adicionar um novo produto ao seu carrinho se desejar que esteja novamente disponível no seu carrinho.
                      </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar Atrás</button>
                      <a href="atualizarcarrinho.php?edit=2&id=<?php echo $row['id'] ?>"><button class="btn btn-primary" >Apagar Produto</button></a>
                    </div>
                    </div>
                </div>
      </tr>
      <?php
        }?>
        <tr >
          <th colspan="6"><b>Total: </b></th>
          <td></td>
          <td colspan="1"><b><?php echo(round($precototal,2));?>€</td>
        </tr>
        </tbody>
    </table>
    
    </div>
    </div>
    <div class="row text-center">
        <div class="col-12 text-center">
        <?php
                    if($total_produtos >0){
           
           //Verificar a pagina anterior e seguinte
           $pagina_anterior = $pagina - 1;
           $pagina_posterior = $pagina + 1;
          ?>
  
           <nav aria-label='...'>
             <ul class='pagination justify-content-center'>
          <?php
             
           if ($pagina_anterior != 0) { 
               ?>
               <li class='page-item'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_anterior?>'>Anterior</a></li>
           <?php } else {
               ?>
               <li class='page-item disabled'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_anterior?>'>Anterior</a></li>
           <?php
           }  
       
           //Apresentar o número de paginacão
           for ($i = 1; $i <= $num_pagina; $i++) 
           { ?>
            <li class='page-item'><a class='page-link' href='carrinho.php?pagina=<?php echo $i ?>'><?php echo $i ?></a></li>
            <?php
           }
       
           if ($pagina_posterior <= $num_pagina) {  ?>
               <li class='page-item'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_posterior?>'>Posterior</a></li></nav>
           <?php }else { ?>
   
               <li class='page-item disabled'><a class='page-link' href='carrinho.php?pagina=<?php echo $pagina_posterior?>'>Posterior</a></li></nav>
               <?php
   
           
           }
       }?>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center"> <a href="carrinho.php?buy=1"><button class="btn btn-success btn-lg" >Terminar Compra<i class="fas fa-box fa-lg ml-2"></i></button></a></div>
        <div class="col-md-4"></div>
    </div>
    </div>
    </div>
    

    
    
    <?php
    
}

   
    }
    else{?>

        <div class='container mt-5'>
            <div class="row text-center">
                <div class="col-12">
                <?php  if (isset($_SESSION['resultadoAddCarrinho'])){
                        echo $_SESSION['resultadoAddCarrinho'];
                        unset($_SESSION['resultadoAddCarrinho']);
                                 }?>
                    </div>
                </div>
                <div class='row text-center'>
                    <div class="col-12">
                    <h1 class="title">Ainda não adicionou produtos ao seu carrinho.</h1>
                    </div>
                </div>
                
                    </div>
    
                <?php
    }
    }
    
   

   
    
        $ligacao->close();
    ?>
