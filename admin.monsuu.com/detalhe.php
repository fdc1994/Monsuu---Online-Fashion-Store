<!doctype html>
<html lang="en">
<head>
<?php
if(!isset($_GET['id'])){
  header("Location: index.php");
}
   include_once("ligacao.php");
    session_start();
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id=$id AND listado = 1 LIMIT 1";
    $result = $ligacao->query($sql);
    $promocao;
    $row = $result -> fetch_assoc();
    if(!isset($row)) {
      header("location:javascript://history.go(-1)");
    }
    
    
    ?>
    
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />
    <title>Monsuu | Fashion Store</title>

        <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <link rel="stylesheet" href="css/styleReg.css">
    <link rel="stylesheet" href="css/styleResponsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
        
    <?php
        include('header.php');
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
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id=$id AND listado = 1 LIMIT 1";
    $result = $ligacao->query($sql);
    $promocao;
   
 
    while ($row = $result -> fetch_assoc()) {
    
        $categoria = $row['categoria'];
        $colecao = $row['colecao'];
        if($colecao=="Comfy") {
          $jumbotron = "jumbotronCozy";
        }
        else if($colecao=="Inverno") {
          $jumbotron = "jumbotronWinter";
        }
        $precofinal;
        include("encontradesconto.php");
        ?>
        </div>
        </div>
        </div>
        
        <div class="jumbotron col-12 mt-5 mb-0 lead" id="<?php echo($jumbotron);?>">
                <h1 class="display-3 text-center text-white">Coleção <?php echo($row['colecao']);?></h1>
                <h3 class="lead text-center"><?php echo($row['categoria']);?></h3>
        </div>
        
        <div class="container mb-0 container-main lead">
            <div class="row text-center">
            <div class="col-12">
            <?php  if (isset($_SESSION['resultadoAddCarrinho'])){
                    echo $_SESSION['resultadoAddCarrinho'];
                    unset($_SESSION['resultadoAddCarrinho']);
                             }?>
                </div>
            </div>
            <form class="form needs-validation" method="POST" action="adicionarcarrinho.php?id=<?php echo ($row['id'])?>" >
            <div class="col-md-12  text-right mr-0 mt-2 mb-3 text-white">
            <a class="btn btn-primary" onclick="history.go(-1)">Voltar Atrás</a>
            </div>
        <div class="row mx-auto">
          <div class="col-md-12 col-lg-6 col-xl-6 mb-3 mt-2">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
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

           
            <a class="carousel-control-prev text-dark" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
           
            </div>
       
          <div class="col-md-12 col-lg-6 col-xl-6 "> 
              
              <h1 class="mb-2 lead display-4 "><?php echo$row['nome']?> </h1>
              <?php if(isset($rowdescontos)) {
                                    ?>           
                                    <div class="discount text-center lead">-<?php echo($desconto)?>%</div> 
                    <div> 
                    <del class="text-danger lead"><?php echo ("Antes: " . $row['preco'])?>€</del>
                    <span class="hoverslow"> &nbsp;
                    <span class="text-success h3"><?php echo(" Agora: " . number_format($precofinal,2));?>€ </span>
                    </span>
                    
                    </div>
                    
                    
                    
                    <?php
                    
                    
                }
                else{?>
                
                    <h1 class="text-success "><?php echo ($row['preco'])?>&nbsp;EUR</h1>
                    
                    <?php
                }unset($precofinal);
                ?>
              <h1 class="mb-2 lead display-4">Editar Produto </h1>
              
                    <button type="button" class="btn btn-outline-success mb-4 btn-sm" data-toggle="modal"
                        data-target="#modalEdit<?php echo($row['id'])?>">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pencil-square"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </button>


                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-toggle="modal"
                        data-target="#modalConfirm<?php echo($row['id'])?>">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>


                    <!-- Modal Edit-->
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
                                                            href="#carouselEdit<?php echo($row['id'])?>" role="button"
                                                            data-slide="prev">
                                                            <span class="carousel-control-prev-icon"
                                                                aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next"
                                                            href="#carouselEdit<?php echo($row['id'])?>" role="button"
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
                                                                value="<?php echo($row['colecao'])?>" name="colecao">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Preço sem
                                                                Desconto
                                                            </label>
                                                            <input type="number" class="form-control"
                                                                id="exampleInputEmail1" name="preco" min="0" step="0.01"
                                                                value="<?php echo($row['preco'])?>">
                                                        </div>
                                                        <div class="col">

                                                            <label for="exampleInputEmail1">Preço com
                                                                Desconto
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputEmail1" value="<?php echo($precofinal)?>€" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="exampleInputEmail1">Desconto</label>
                                                            <input type="number" min="0" max="99" step="1" value="<?php echo($desconto)?>" class="form-control" id="exampleInputEmail1" name="desconto" >
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleFormControlSelect1">Novidade</label>
                                                            <select class="form-control" id="exampleFormControlSelect1"
                                                                name="novidade">
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
                                                            <select class="form-control" id="exampleFormControlSelect1"
                                                                name="listado">
                                                                <option value="1"
                                                                    <?php if($listado == "Sim") {echo "selected";}?>>Sim
                                                                </option>
                                                                <option value="0"
                                                                    <?php if($listado == "Não") {echo "selected";}?>>Não
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
                                                                value="<?php echo($row['stockXL'])?>" name="stockXL">
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

                    </div>
                    <!-- Modal DELETE-->
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
                                                <div id="carouselDelete<?php echo($row['id'])?>" class="carousel slide"
                                                    data-ride="carousel">
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
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['nome'])?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Referência</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['ref'])?>" readonly>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Categoria</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['categoria'])?>" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Coleção</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['colecao'])?>" readonly>
                                                    </div>
                                                </div>



                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Preço sem Desconto </label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['preco'])?>" readonly>
                                                    </div>
                                                    <div class="col">

                                                        <label for="exampleInputEmail1">Preço com Desconto </label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($precofinal)?>€" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Desconto</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo $desconto; ?>%" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Novidade</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo $novidade; ?>" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Listado</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo $listado; ?>" readonly>
                                                    </div>

                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Stock Único</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['stockUnico'])?>" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Stock Small</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['stockS'])?>" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Stock Medium</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['stockM'])?>" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Stock Large</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            value="<?php echo($row['stockL'])?>" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="exampleInputEmail1">Stock XL</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
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
                                    Não é possível reverter esta ação. Terá de adicionar um novo produto se desejar que
                                    este produto
                                    esteja novamente disponível.
                                </div>
                                <div class="modal-footer mt-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar
                                        Atrás</button>
                                    <a href="apagar.php?pagina=<?php echo($pagina)?>&id=<?php echo $row['id'] ?>"><button
                                            class="btn btn-primary">Apagar
                                            Produto</button></a>
                                </div>







                                
                
            </div>
            
            <div class="col-12 mb-1">
                <h1 class="lead display-4">Sobre o Produto</h1>
            </div>
           
            <div class="col-10 mb-2 ml-2 mt-2">
            <i class="fas fa-bars fa-lg text-aqua mr-3"></i><?php echo $row['descricao'] ?>
            </div>

            <div class="col-10 mb-2 ml-2 mt-2">
            <i class="fas fa-cut fa-lg text-aqua mr-3"></i><?php echo $row['fichaTecnica'] ?>
            </div>
          </div>
            <hr>
           <?php 
           $sql = "SELECT * FROM produtos WHERE id NOT LIKE $id AND colecao LIKE '$colecao' OR categoria LIKE '$categoria' AND id NOT LIKE $id LIMIT 3";
           $result = $ligacao->query($sql);
           $promocao;
           if(isset($result)){
            echo(' 
            <h3 class="display-4 text-center mt-5 mb-5">Relacionados</h3>
        ');
           
           ?>
<hr>
           
            <!-- Relacionados !-->

            <div class="card-group mx-auto">
            <?php 
                
                
                    
                }
                while ($row = $result -> fetch_assoc()) {
                  
                  $precofinal;
                  $sqldescontos = "SELECT desconto FROM promocoes WHERE id = ".$row['id'];
                  $resultdescontos = mysqli_query($ligacao, $sqldescontos);
                  $rowdescontos = $resultdescontos->fetch_assoc();
                  if(isset($rowdescontos)) {
                      $desconto = $rowdescontos['desconto'];
                      $preco = $row['preco'];
                      $precofinal = $preco - ($preco *("0.".$desconto));
                  }
                    ?>

                   <a href="detalhe.php?id=<?php echo $row['id']?>"> <div class="card mr-2 col-md-6 col-lg-4 col-xl-3 text-center border-aqua">  
                   
                        <img class="card-img-top text-center w-100"  src="../images/produtos/<?php echo $row['foto1']?>" alt="Card image cap">
                        <div class="card-body">
                        <div class="card-title mt-2 text-center h4"><?php echo $row['nome']?><?php if(isset($precofinal)) {?> <span class="discount text-center lead">-<?php echo($desconto)?>%</span><?php }?></div>
     
                        <?php if(isset($precofinal)) {
                                    ?>
                                    
                                    <p class="card-text text-center">
                                        
                                    <del class="text-danger"><?php echo ("Antes: " . $row['preco'])?>€</del>&nbsp;
                                    <br>  
                                    <span class="text-success h3"><?php echo("Agora: " . number_format($precofinal,2));?>€</span>
                                    <br>
                                    
                                    </p>
                                    <?php
                                    
                                }
                                else{?>
                                    <p class="card-text">
                                    <div class="text-success"><?php echo ($row['preco'])?>€</div>&nbsp;<?php
                                }unset($precofinal);
                                ?>
                    </div></a>
                    </div>
                
                <?php } ?>
               

            
            

              
                </div>
            <?php 
    }
?>


    </div>
    <?php
    include 'footer.php';
    ?>
<?php 
$sql = "SELECT * FROM produtos WHERE id=$id LIMIT 1";
$result = $ligacao->query($sql);
while ($row = $result -> fetch_assoc()) {
     {
     ?>

   <!-- Modal -->
   <div class="modal fade text-center" id="foto1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content text-center">
        <img class="w-100 mt-5"src="images/produtos/<?php echo $row['foto1']?>" alt="">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="foto2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content ">
        <img src="images/produtos/<?php echo $row['foto2']?>" alt="">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="foto3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content ">
        <img src="images/produtos/<?php echo $row['foto3']?>" alt="">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="foto4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content ">
        <img src="images/produtos/<?php echo $row['foto4']?>" alt="">
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>

<?php
    } 
    
}

?>
  

  


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
 <script src="scripts/jsCustomHeader.js"></script>
 <script src="scripts/styleSelectListDetalhe.js"></script>
 <script src="scripts/pageTriggerLoad.js"></script>



 
   
</body>

</html>

