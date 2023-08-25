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
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$pesquisa%' ";
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            array_push($idsEncontrados, $row['id']);
        }
    }
    $sql = "SELECT * FROM produtos WHERE categoria LIKE '%$pesquisa%' ";
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            if(!in_array($row['id'], $idsEncontrados)) {
                array_push($idsEncontrados, $row['id']);
            }
        }
    }

    $sql = "SELECT * FROM produtos WHERE colecao LIKE '%$pesquisa%'";
    $resultado = $ligacao->query($sql);

    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            if(!in_array($row['id'], $idsEncontrados)) {
                array_push($idsEncontrados, $row['id']);
            }
        }
    }

    $sql = "SELECT * FROM produtos WHERE ref LIKE '%$pesquisa%'";
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

            <div class="col-12">
                <?php  if (isset($_SESSION['resultadoEditar'])){
                    echo $_SESSION['resultadoEditar'];
                    unset($_SESSION['resultadoEditar']);
                             }?>
            </div>
        
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
                   
                        while ($row = $resultado_final->fetch_assoc()) {
                            unset($desconto);
                            unset($precofinal);
                           
                            include("encontradesconto.php");
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
                        ?>
                            
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card w-100 h-100 lead">
                <img class="card-img-top mt-0" style="max-width:100%"
                        src="../images/produtos/<?php echo $row['foto1']?>" alt="Card image cap"></img>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nome']?> <?php if($desconto >0) {?> <div
                            class="discount text-center lead">-<?php echo($desconto)?>%</div><?php }?></h5>
                    </hr>

                    <?php if($desconto >0) {
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
                                }
                                ?>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-success mb-4 btn-lg" data-toggle="modal"
                                data-target="#modalEdit<?php echo($row['id'])?>">
                                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-danger btn-lg" data-toggle="modal"
                                data-toggle="modal" data-target="#modalConfirm<?php echo($row['id'])?>">
                                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
                        </div>
                        <div class="modal fade" id="modalEdit<?php echo($row['id'])?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <form class=""
                                        action="editarDadosPesquisa.php?pagina=<?php echo($pagina)?>&id=<?php echo($row['id'])?>&pesquisa=<?php echo $pesquisa?>&orderBy=<?php echo($orderBy)?>"
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
                                                    <div class="col-lg-7 col-md-12">
                                                        <label for="exampleInputEmail1">Fotografias
                                                            Atuais</label>
                                                        <div id="carouselEdit<?php echo($row['id'])?>"
                                                            class="carousel slide" data-ride="carousel">
                                                            <div class="carousel-inner">
                                                                <?php if(isset($row['foto1'])) {echo ('<div class="carousel-item active">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto1"><img class="d-block w-75" src="../images/produtos/'.$row['foto1'].'" alt="First slide"></button>
                                                                        </div>
                                                                        ') ;}?>
                                                                <?php if(isset($row['foto2'])) {echo ('<div class="carousel-item">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto2"><img class="d-block w-75" src="../images/produtos/'.$row['foto2'].'" alt="First slide"></button>
                                                                        </div>') ;}?>
                                                                <?php if(isset($row['foto3'])) {echo ('<div class="carousel-item">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto3"><img class="d-block w-75" src="../images/produtos/'.$row['foto3'].'" alt="First slide"></button>
                                                                        </div>') ;}?>
                                                                <?php if(isset($row['foto4'])) {echo ('<div class="carousel-item">
                                                                        <button type="button" class="btn" data-toggle="modal" data-target="#foto4"><img class="d-block w-75" src="../images/produtos/'.$row['foto4'].'" alt="First slide"></button>
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


                                                        <div class="row mb-1">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Único</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['stockUnico'])?>"
                                                                    name="stockUnico">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Small</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['stockS'])?>" name="stockS">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Medium</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['stockM'])?>" name="stockM">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock
                                                                    Large</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['stockL'])?>" name="stockL">
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1">Stock XL</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputEmail1"
                                                                    value="<?php echo($row['stockXL'])?>"
                                                                    name="stockXL">
                                                            </div>


                                                        </div>
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
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto1"><img class="d-block w-75" src="../images/produtos/'.$row['foto1'].'" alt="First slide"></button>
                                            </div>
                                            ') ;}?>
                                                            <?php if(isset($row['foto2'])) {echo ('<div class="carousel-item">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto2"><img class="d-block w-75" src="../images/produtos/'.$row['foto2'].'" alt="First slide"></button>
                                            </div>') ;}?>
                                                            <?php if(isset($row['foto3'])) {echo ('<div class="carousel-item">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto3"><img class="d-block w-75" src="../images/produtos/'.$row['foto3'].'" alt="First slide"></button>
                                            </div>') ;}?>
                                                            <?php if(isset($row['foto4'])) {echo ('<div class="carousel-item">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#foto4"><img class="d-block w-75" src="../images/produtos/'.$row['foto4'].'" alt="First slide"></button>
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
                                                    <div class="row mb-1">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock Único</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['stockUnico'])?>" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock Small</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['stockS'])?>" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock Medium</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['stockM'])?>" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock Large</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['stockL'])?>" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Stock XL</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1"
                                                                value="<?php echo($row['stockXL'])?>" readonly>
                                                        </div>


                                                    </div>

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
                                        <a href="apagarPesquisa.php?pagina=<?php echo($pagina)?>&id=<?php echo $row['id'] ?>&pesquisa=<?php echo $pesquisa?>&orderBy=<?php echo($orderBy)?>"><button
                                                class="btn btn-primary">Apagar
                                                Produto</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>

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