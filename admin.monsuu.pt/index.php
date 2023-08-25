<!DOCTYPE html>

<html lang="en">
<?php
   include_once("ligacao.php");
    session_start();
    if($_SESSION['admin'] != 1){
        header("Location: login.php");
      }
    ?>

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsuu | Administração</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/styleReg.css">
    <link rel="stylesheet" href="css/styleResponsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<div class="disabled" id="loader">
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
</div>

<body>

    <?php include 'header.php'; 
    
        
    $sqlVisitors = "SELECT * FROM visitors";
    $resultadoVisitors = $ligacao->query($sqlVisitors);
    $rowVisitors = mysqli_fetch_assoc($resultadoVisitors);

    $sqlUsers = "SELECT COUNT(id) FROM utilizador";
    $resultadoUsers = $ligacao->query($sqlUsers);
    $rowUsers = mysqli_fetch_assoc($resultadoUsers);
    

    $sqlCart = "SELECT SUM(quantidade) FROM carrinhocompras";
    $resultadoCart = $ligacao->query($sqlCart);
    $rowCart = mysqli_fetch_assoc($resultadoCart);
    
    
    ?>
    <div class="jumbotron text-center mb-0 mt-5 main">
        <div class="row text-center">
            <div class="col-12">
                <?php  if (isset($_SESSION['resultadoEditar'])){
                    echo $_SESSION['resultadoEditar'];
                    unset($_SESSION['resultadoEditar']);
                             }?>
            </div>
        </div>
        <div class="container mt-5 mb-5">

            <div class="row mb-5">
                <div class="col-xl-3 col-sm-6 col-md-4 mx-auto p-1">

                    <!-- Card Visitantes -->
                    <div class="card bg-gradient-directional-primary text-white">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fas fa-eye fa-3x ml-2"></i>
                                    </div>
                                    <div class="media-body  text-right">
                                        <h5 class="lead"><?php echo $rowVisitors['visitors']?> </h5>
                                        <span>Visitantes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="col-xl-3 col-sm-6 col-md-4 mx-auto p-1">

                    <!-- Card Visitantes -->
                    <div class="card bg-gradient-directional-success text-white">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fas fa-user fa-3x ml-2"></i>
                                    </div>
                                    <div class="media-body  text-right">
                                        <h5 class="lead"><?php echo $rowUsers['COUNT(id)'] ?> </h5>
                                        <span>Utilizadores</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="col-xl-3 col-sm-6 col-md-4 mx-auto p-1">

                    <!-- Card Visitantes -->
                    <div class="card bg-gradient-directional-warning text-white">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fas fa-shopping-cart fa-3x ml-2"></i>
                                    </div>
                                    <div class="media-body  text-right">
                                        <h5 class="lead"><?php echo $rowCart['SUM(quantidade)']; if($rowCart['SUM(quantidade)'] <= 0) {echo "0";}?> </h5>
                                        <span>Produtos Em Carrinho</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>


            <?php 

include("ligacao.php");
    
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
    if(!isset($_POST['orderBy']) && !isset($_GET['orderBy'])) {
        $orderBy = "refDesc";
    }
    else if(isset($_POST['orderBy'])) {
        $orderBy = $_POST['orderBy'];
    }
    else if (isset($_GET['orderBy'])) {
        $orderBy = $_GET['orderBy'];
    }
    
    
    $sql = "SELECT * FROM produtos ";
    $resultado = $ligacao->query($sql);

  

    

    //total de produtos encontrados;
    $total_produtos = mysqli_num_rows($resultado);

    //Quantidade de produtos por pagina
    $quantidade_pg = 9;

    //calcular o número de pagina necessárias para apresentar os livros
    $num_pagina = ceil($total_produtos / $quantidade_pg);

    if($total_produtos !=0) {?>

            <div class="row mb-5">
                <div class='lead col-lg-8 col-md-6   text-left'>A Visualizar Página <?php echo$pagina ?> de
                    <?php echo$num_pagina ?></div>

                <div class="lead col-lg-3 col-md-6 ">
                    <form action="?pagina=<?php echo $pagina?>" method="POST">
                        <div class="form-group">
                            <span style="white-space: nowrap">
                                <label for="size">Ordenar Por:</label>
                                <select class="form-control-sm sorter" id="orderBy" name="orderBy"
                                    onchange="this.form.submit()">
                                    <option <?php if ($orderBy == "refAsc") {echo "selected";}?> value="refAsc">
                                        Referência Ascendente</option>
                                    <option <?php if ($orderBy == "refDesc") {echo "selected";}?> value="refDesc">
                                        Referência Descendente</option>
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
    </div>



    <?php
    }
    
    //Inicio da visualização
    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    //Selecionar os produtos a serem apresentado na página


  if ($total_produtos > 0) {
    if($orderBy =="col") {
        $sql = "SELECT * FROM produtos ORDER BY colecao limit $inicio, $quantidade_pg";
      }
      else if($orderBy =="name") {
        $sql = "SELECT * FROM produtos ORDER BY nome limit $inicio, $quantidade_pg";
      }
      else if($orderBy =="refAsc") {
        $sql = "SELECT * FROM produtos ORDER BY ref ASC limit $inicio, $quantidade_pg";
      }
      else if($orderBy =="refDesc") {
        $sql = "SELECT * FROM produtos ORDER BY ref DESC limit $inicio, $quantidade_pg";
      }
      
   
        $resultado_final = mysqli_query($ligacao, $sql);
        if ($resultado_final->num_rows > 0) {
  ?>

    <table class="table table-responsive table-bordered table-hover table-fit p-0">
        <thead class="thead-dark">
            <tr>
                <th scope='col-1'>Foto</th>
                <th scope='col-1'>REF</th>
                <th scope='col-1'>Categ</th>
                <th scope='col-1'>Cole</th>
                <th scope='col-1'>Nome</th>
                <th scope='col-1'>Desc</th>
                <th scope='col-1'>Preço Final</th>
                <th scope='col-1'>Stock</th>

                <th scope='col-1'>Novi</th>
                <th scope='col-1'>List</th>
                <th scope='col-1'>Edit</th>
            </tr>
        </thead>

        <?php

      while ($row = mysqli_fetch_assoc($resultado_final)) {
          unset($desconto);
        include("encontradesconto.php")
        
      ?>

        <tbody>

            <tr>
                <?php 
                        if(!isset($desconto))
                        {$desconto=0;}
                        

                        if ($row['novidade'] == 1) {
                          $novidade = "Sim";
                        }
                        else if($row['novidade'] == 0) {
                          $novidade = "Não";
                        }
                        if ($row['listado'] == 1) {
                            $listado = "Sim";
                          }
                          else if($row['novidade']== 0) {
                            $listado = "Não";
                          }

                          $stock = json_decode($row['stock'], TRUE);
                        $textStock ="";
                        foreach ($stock as $key => $value) {
                            $textStock.= $key . ": " . $value . "<br>";
                        }
                          
                        ?>

                <td scope="row align-middle"><img src="/images/produtos/<?php echo $row['foto1'] ?>" alt "..."
                        class="img-fluid">
                <td scope="row" class="align-middle"><?php echo $row['ref'] ?></td>
                <td scope="row" class="align-middle"><?php echo $row['categoria'] ?></td>
                <td scope="row" class="align-middle"><?php echo $row['colecao'] ?></td>
                <td scope="row" class="align-middle"><?php echo $row['nome'] ?></td>
                <td scope="row" class="align-middle"><?php echo $desconto?>%</td>
                <td scope="row" class="align-middle"><?php echo $precofinal?>€</td>
                <td scope="row" class="align-middle"><?php echo $textStock ?></td>

                <td scope="row" class="align-middle"><?php echo $novidade ?></td>
                <td scope="row" class="align-middle"><?php echo $listado ?></td>

                <td scope="row" class="align-middle">
                    <button type="button" class="btn btn-outline-success p-2 mb-1 btn-lg" data-toggle="modal"
                        data-target="#modalEdit<?php echo($row['id'])?>">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </button>


                    <button type="button" class="btn btn-outline-danger p-2 mb-1 btn-lg" data-toggle="modal" data-toggle="modal"
                        data-target="#modalConfirm<?php echo($row['id'])?>">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>







                    </th>
            </tr>
        </tbody>
        <div class="modal fade" id="modalEdit<?php echo($row['id'])?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <form class=""
                                        action="editarDados.php?pagina=<?php echo($pagina)?>&id=<?php echo($row['id'])?>&orderBy=<?php echo($orderBy)?>"
                                        method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Editar Produto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="container">
                                                <div class="row mb-1">
                                                    <div class="col-lg-7 col-md-12 w-100 h-100">
                                                        <label for="exampleInputEmail1">Fotografias
                                                            Atuais</label>
                                                        <div id="carouselEdit<?php echo($row['id'])?>"
                                                            class="carousel slide" data-ride="carousel">
                                                            <div class="carousel-inner">
                                                                <?php if(isset($row['foto1'])) {echo ('<div class="carousel-item active">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto1"><img class="d-block w-75" src="images/produtos/'.$row['foto1'].'" alt="First slide"></button>
                                                                        </div>
                                                                        ') ;}?>
                                                                <?php if(isset($row['foto2'])) {echo ('<div class="carousel-item">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto2"><img class="d-block w-75" src="images/produtos/'.$row['foto2'].'" alt="First slide"></button>
                                                                        </div>') ;}?>
                                                                <?php if(isset($row['foto3'])) {echo ('<div class="carousel-item">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto3"><img class="d-block w-75" src="images/produtos/'.$row['foto3'].'" alt="First slide"></button>
                                                                        </div>') ;}?>
                                                                <?php if(isset($row['foto4'])) {echo ('<div class="carousel-item">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto4"><img class="d-block w-75" src="images/produtos/'.$row['foto4'].'" alt="First slide"></button>
                                                                        </div>') ;}?>
                                                            </div>
                                                            <a class="carousel-control-prev text-dark"
                                                                href="#carouselEdit<?php echo($row['id'])?>"
                                                                role="button" data-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next"
                                                                href="#carouselEdit<?php echo($row['id'])?>"
                                                                role="button" data-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-12">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Nome</label>
                                                                <input type="text" class="form-control" name="nome"
                                                                    value="<?php echo($row['nome'])?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Referência</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['ref'])?>" name="ref">
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Categoria</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['categoria'])?>"
                                                                    name="categoria">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Coleção</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['colecao'])?>"
                                                                    name="colecao">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Preço sem
                                                                    Desconto
                                                                </label>
                                                                <input type="number" class="form-control"
                                                                    id="exampleInputEmail1" name="preco" min="0"
                                                                    step="0.01" value="<?php echo($row['preco'])?>">
                                                            </div>
                                                            <div class="col">

                                                                <label for="exampleInputEmail1">Preço com
                                                                    Desconto
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($precofinal)?>€" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Desconto</label>
                                                                <input type="number" min="0" max="99" step="1"
                                                                    value="<?php echo($desconto)?>" class="form-control"
                                                                    id="exampleInputEmail1" name="desconto">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleFormControlSelect1">Novidade</label>
                                                                <select class="form-control"
                                                                    id="exampleFormControlSelect1" name="novidade">
                                                                    <option value="1"
                                                                        <?php if($novidade == "Sim") {echo "selected";}?>>
                                                                        Sim</option>
                                                                    <option value="0"
                                                                        <?php if($novidade == "Não") {echo "selected";}?>>
                                                                        Não</option>

                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleFormControlSelect1">Listado</label>
                                                                <select class="form-control"
                                                                    id="exampleFormControlSelect1" name="listado">
                                                                    <option value="1"
                                                                        <?php if($listado == "Sim") {echo "selected";}?>>
                                                                        Sim
                                                                    </option>
                                                                    <option value="0"
                                                                        <?php if($listado == "Não") {echo "selected";}?>>
                                                                        Não
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <h1 class="mt-1">Stock</h1>
                                                        </div>
                                                    </div>
                                                        <?php
                                                                    if($row['categoria'] != "Calçado") {

                                                                   
                                                                    ?>
                                                        <div class="row mb-1">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Único</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['Unico'])?>"
                                                                    name="stockUnico"required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Small</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['S'])?>" name="stockS"required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Medium</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['M'])?>" name="stockM"required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Large</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['L'])?>" name="stockL"required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock XL</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['XL'])?>" name="stockXL"required>
                                                            </div>


                                                        </div>
                                                        <?php
                                                         }
                                                         else {
                                                            
                                                         
                                                        ?>

                                                        <div class="row mb-1">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">
                                                                    36</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['36'])?>" name="stock36"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">
                                                                    37</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['37'])?>" name="stock37"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">38</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['38'])?>" name="stock38"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">39</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['39'])?>" name="stock39"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">40</label>
                                                                <input type="number" min="0" max="99" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['40'])?>" name="stock40"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">41</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['41'])?>" name="stock41"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">42</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['42'])?>" name="stock42"required>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">43</label>
                                                                <input type="number" min="0" max="99" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($stock['43'])?>" name="stock43" required>
                                                            </div>


                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="row mb-1">
                                                            <div class="col-md-12 col-lg-6">
                                                                <label for="exampleInputEmail1">Descrição</label>
                                                                <textarea class="form-control" name="descricao"
                                                                    type="textarea" rows="5"
                                                                    name="descricao"><?php echo($row['descricao'])?></textarea>
                                                            </div>
                                                            <div class="col-md-12 col-lg-6">
                                                                <label for="exampleInputEmail1">Ficha
                                                                    Técnica</label>
                                                                <textarea class="form-control" type="textarea" rows="5"
                                                                    name="fichaTecnica"><?php echo($row['fichaTecnica'])?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 mt-3">

                                                        <div class="col-12 p-2"><strong class="form-text text-muted">
                                                                Utilizar apenas se pretender substituir as
                                                                fotos!
                                                            </strong></div>


                                                        <div class="col-md-12 col-lg-3 mb-2">
                                                            <label for="exampleInputEmail1">Fotografia 1</label>
                                                            <input type="file" name="foto1" id="foto"
                                                                class="form-control-file">
                                                        </div>
                                                        <div class="col-md-12 col-lg-3 mb-2">
                                                            <label for="exampleInputEmail1">Fotografia 2</label>
                                                            <input type="file" name="foto2" id="foto"
                                                                class="form-control-file">
                                                        </div>
                                                        <div class="col-md-12 col-lg-3 mb-2">
                                                            <label for="exampleInputEmail1">Fotografia 3</label>
                                                            <input type="file" name="foto3" id="foto"
                                                                class="form-control-file">
                                                        </div>
                                                        <div class="col-md-12 col-lg-3 mb-2">
                                                            <label for="exampleInputEmail1">Fotografia 4</label>
                                                            <input type="file" name="foto4" id="foto"
                                                                class="form-control-file">
                                                        </div>
                                                        <div class="col-lg-3 col-md-0"></div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <small class="form-text text-muted">
                                                                Se Desejar, poderá carregar uma nova foto.
                                                                As fotos dos produtos devem respeitar o formato
                                                                pré-definido.
                                                            </small>

                                                        </div>
                                                        <div class="col-lg-3 col-md-0"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <button type="reset" class="btn btn-primary">Repôr Info</button>
                                            <button type="submit" class="btn btn-success">Confirmar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="modalConfirm<?php echo($row['id'])?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered  modal-xl " role="document">
                                <div class="modal-content container-custom">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Pretende apagar este produto?
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row mb-1">
                                                <div class="col-lg-7 col-md-12">
                                                    <label for="exampleInputEmail1">Foto</label>
                                                    <div id="carouselDelete<?php echo($row['id'])?>"
                                                        class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <?php if(isset($row['foto1'])) {echo ('<div class="carousel-item active">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto1"><img class="d-block w-75" src="/images/produtos/'.$row['foto1'].'" alt="First slide"></button>
                                            </div>
                                            ') ;}?>
                                                            <?php if(isset($row['foto2'])) {echo ('<div class="carousel-item">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto2"><img class="d-block w-75" src="/images/produtos/'.$row['foto2'].'" alt="First slide"></button>
                                            </div>') ;}?>
                                                            <?php if(isset($row['foto3'])) {echo ('<div class="carousel-item">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto3"><img class="d-block w-75" src="/images/produtos/'.$row['foto3'].'" alt="First slide"></button>
                                            </div>') ;}?>
                                                            <?php if(isset($row['foto4'])) {echo ('<div class="carousel-item">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto4"><img class="d-block w-75" src="/images/produtos/'.$row['foto4'].'" alt="First slide"></button>
                                            </div>') ;}?>
                                                        </div>
                                                        <a class="carousel-control-prev text-dark"
                                                            href="#carouselDelete<?php echo($row['id'])?>" role="button"
                                                            data-slide="prev">
                                                            <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next"
                                                            href="#carouselDelete<?php echo($row['id'])?>" role="button"
                                                            data-slide="next">
                                                            <span class="carousel-control-next-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-12">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Nome</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['nome'])?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Referência</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['ref'])?>" readonly>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Categoria</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['categoria'])?>" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Coleção</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['colecao'])?>" readonly>
                                                        </div>
                                                    </div>



                                                    <div class="row mt-2">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Preço sem Desconto </label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['preco'])?>" readonly>
                                                        </div>
                                                        <div class="col">

                                                            <label for="exampleInputEmail1">Preço com Desconto </label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($precofinal)?>€" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Desconto</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo $desconto; ?>%" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Novidade</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1" value="<?php echo $novidade; ?>"
                                                                readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Listado</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1" value="<?php echo $listado; ?>"
                                                                readonly>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h1 class="mt-1">Stock</h1>
                                                        </div>
                                                    </div>
                                                    <?php
                                                                    if($row['categoria'] != "Calçado") {

                                                                   
                                                                    ?>
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock
                                                                Único</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['Unico'])?>" name="stockUnico"
                                                                readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock
                                                                Small</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['S'])?>" name="stockS"
                                                                readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock
                                                                Medium</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['M'])?>" name="stockM"
                                                                readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock
                                                                Large</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['L'])?>" name="stockL"
                                                                readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock XL</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['XL'])?>" name="stockXL"
                                                                readonly>
                                                        </div>


                                                    </div>
                                                    <?php
                                                         }
                                                         else {
                                                            
                                                         
                                                        ?>

                                                    <div class="row mb-1">
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">
                                                                36</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['36'])?> " name="stock36"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">
                                                                37</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['37'])?>" name="stock37"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">38</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['38'])?>" name="stock38"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">39</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['39'])?>" name="stock39"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">40</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['40'])?>" name="stock39"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">41</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['41'])?>" name="stock41"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">42</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['42'])?>" name="stock42"
                                                                readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="exampleInputEmail1">43</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($stock['43'])?>" name="stock43"
                                                                readonly>
                                                        </div>


                                                    </div>
                                                    <?php
                                                        }
                                                        ?>

                                                    <div class="row mb-1">
                                                        <div class="col-md-12 col-lg-6">
                                                            <label for="exampleInputEmail1">Descrição</label>
                                                            <textarea class="form-control" type="textarea" rows="5"
                                                                readonly><?php echo($row['descricao'])?> "</textarea>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <label for="exampleInputEmail1">Ficha Técnica</label>
                                                            <textarea class="form-control" type="textarea" rows="5"
                                                                readonly><?php echo($row['fichaTecnica'])?> "</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        Não é possível reverter esta ação. Terá de adicionar um novo produto se desejar
                                        que
                                        este produto
                                        esteja novamente disponível.
                                    </div>
                                    <div class="modal-footer mt-2">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar
                                            Atrás</button>
                                        <a
                                            href="apagar.php?pagina=<?php echo($pagina)?>&id=<?php echo $row['id'] ?>&orderBy=<?php echo($orderBy)?>"><button
                                                class="btn btn-primary">Apagar
                                                Produto</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>




        <?php
        }
      }
      else {
        echo "0 results";
        }
    }
      ?>

    </table>
    <?php
      
      ?>


    <?php
if($total_produtos >1){
           
  //Verificar a pagina anterior e seguinte
  $pagina_anterior = $pagina - 1;
  $pagina_posterior = $pagina + 1;
 ?>
    <div class='row justify-content-center mt-5 mb-5'>
        <nav aria-label='...'>
            <ul class='pagination'>
                <?php
    
  if ($pagina_anterior != 0) { 
      ?>
                <li class='page-item'><a class='page-link'
                        href='index.php?pagina=<?php echo $pagina_anterior?>&orderBy=<?php echo $orderBy ?>'>Anterior</a>
                </li>
                <?php } else {
      ?>
                <li class='page-item disabled' style='display: block!important;'><a class='page-link'
                        href='index.php?pagina=<?php echo $pagina_anterior?>&orderBy=<?php echo $orderBy ?>'>Anterior</a>
                </li>
                <?php
  }  

  //Apresentar o número de paginacão
  for ($i = 1; $i <= $num_pagina; $i++) 
  { ?>
                <li class='page-item'><a class='page-link'
                        href='index.php?pagina=<?php echo $i ?>&orderBy=<?php echo $orderBy ?>'><?php echo $i ?></a>
                </li>
                <?php
  }

  if ($pagina_posterior <= $num_pagina) {  ?>
                <li class='page-item'><a class='page-link'
                        href='index.php?pagina=<?php echo $pagina_posterior?>&orderBy=<?php echo $orderBy ?>'>Posterior</a>
                </li>
        </nav>
    </div>
    </div>
    <?php }else { ?>

    <li class='page-item disabled' style='display: block!important;'><a class='page-link'
            href='index.php?pagina=<?php echo $pagina_posterior?>&orderBy=<?php echo $orderBy ?>'>Posterior</a></li>
    </nav>
    </div>
    </div>
    <?php

  
  }
}


  $ligacao->close();



include 'footer.php';
?>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="scripts/jsCustomHeader.js"></script>
    <script src="scripts/pageTriggerLoad.js"></script>
    <script src="scripts/searchOrder.js"></script>
    <script src="scripts/pageTriggerLoad.js"></script>

</body>

</html>