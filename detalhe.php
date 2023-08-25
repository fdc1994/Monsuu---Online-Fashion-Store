<!doctype html>
<html lang="en">

<head>
    <?php
if(!isset($_GET['id'])){
  header("Location: index.php");
}
   include_once("admin/ligacao.php");
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
    <meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>Monsuu | Fashion Store</title>

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

    <?php
        include('header.php');

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
        else if($colecao=="Verão") {
            $jumbotron = "jumbotronSummer";
          }
        $precofinal;

        $desconto=0;
        include("admin/encontradesconto.php");
        ?>
    </div>
    </div>
    </div>

    <div class="jumbotron col-12 mt-5 mb-0 lead" id="<?php echo($jumbotron);?>">
        <h1 class="display-3 text-center text-white">Coleção <?php echo($row['colecao']);?></h1>
        <h3 class="lead text-center text-white"><?php echo($row['categoria']);?></h3>
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
        <form class="form needs-validation" method="POST" action="adicionarcarrinho.php?id=<?php echo ($row['id'])?>">
            <div class="col-md-12  text-right mr-0 mt-2 mb-3 text-white">
                <a class="btn btn-primary" onclick="history.go(-1)">Voltar Atrás</a>
            </div>
            <div class="row mx-auto">
                <div class="col-md-12 col-lg-6 col-xl-6 mb-3 mt-2">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">




                            <?php if(isset($row['foto1'])) {echo ('<div class="carousel-item active">
                 <button type="button" class="btn" data-toggle="modal" data-target="#foto1"><img class="d-block img-fluid teste w-75 h-75" src="images/produtos/'.$row['foto1'].'" alt="First slide"></button>
                </div>
                ') ;}?>
                            <?php if(isset($row['foto2'])) {echo ('<div class="carousel-item">
                 <button type="button" class="btn" data-toggle="modal" data-target="#foto2"><img class="d-block img-fluid  teste w-75 h-75" src="images/produtos/'.$row['foto2'].'" alt="First slide"></button>
                </div>') ;}?>
                            <?php if(isset($row['foto3'])) {echo ('<div class="carousel-item">
                 <button type="button" class="btn" data-toggle="modal" data-target="#foto3"><img class="d-block img-fluid teste  w-75 h-75" src="images/produtos/'.$row['foto3'].'" alt="First slide"></button>
                </div>') ;}?>
                            <?php if(isset($row['foto4'])) {echo ('<div class="carousel-item">
                 <button type="button" class="btn" data-toggle="modal" data-target="#foto4"><img class="d-block img-fluid  teste w-75 h-75" src="images/produtos/'.$row['foto4'].'" alt="First slide"></button>
                </div>') ;}?>
                        </div>


                        <a class="carousel-control-prev text-dark" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>

                <div class="col-md-12 col-lg-6 col-xl-6 ">

                    <h1 class="mb-2 lead display-4 "><?php echo$row['nome']?> </h1>
                    <?php if($row['novidade'] == 1)  {?>
                    <span class="new text-center lead">Novo</span><?php }?>
                    <?php if($desconto >0) {
                                    ?>
                    <div class="discount text-center lead">-<?php echo($desconto)?>%</div>
                    <div>
                        <del class="text-danger lead"><?php echo ("Antes: " . $row['preco'])?>€</del>
                        <span class="hoverslow"> &nbsp;
                            <span class="text-success h3"><?php echo(" Agora: " . number_format($precofinal,2));?>€
                            </span>
                        </span>

                    </div>



                    <?php
                    
                    
                }
                
                
                
                else{?>

                    <h1 class="text-success "><?php echo ($row['preco'])?>&nbsp;EUR</h1>

                    <?php
                }
                $stock = json_decode($row['stock'], TRUE);
                unset($precofinal);
              

                if($row['categoria']!= "Calçado") {
                
                     if($stock['Unico'] >0 || $stock['S'] >0 || $stock['M'] >0 || $stock['L'] >0 || $stock['XL'] >0) {?>
                    <h5 class="text-muted mb-2 mt-2"> Referência: <?php echo$row['ref']?> </h5>
                    <h4 class="mb-3 mt-2">Tamanho </h4>
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="btn-group radio-group" required>
                                        <?php if($stock['Unico'] >0) {echo ('<label class="btn btn-info not-active">Tamanho Único<input type="radio" value="Unico" name="tamanho" required></label>') ;}?>
                                        <?php if($stock['S'] >0) {echo ('<label class="btn btn-info not-active">S<input type="radio" value="S" name="tamanho" required></label>') ;}?>
                                        <?php if($stock['M'] >0) {echo ('<label class="btn btn-info not-active">M<input type="radio" value="M" name="tamanho" ></label>') ;}?>
                                        <?php if($stock['L'] >0) {echo ('<label class="btn btn-info not-active">L<input type="radio" value="L" name="tamanho" ></label>') ;}?>
                                        <?php if($stock['XL'] >0) {echo ('<label class="btn btn-info not-active">XL<input type="radio" value="XL" name="tamanho"></label>') ;}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>





                    <h4 class="mb-3 mt-0">Quantidade a Adicionar ao Carrinho </h4>
                    <input type="number" class="form-control ml-3" style="width:50%!important;" name="quantidade"
                        value="1" min="1" max="5" required>
                    <?php }
                    ?>
                    <div class="text-center mt-5 mb-5">
                        <div class="col-md-10 col-lg-6 col-xl-6 mb-3">
                            <?php if($stock['Unico'] >0 || $stock['S'] >0 || $stock['M'] >0 || $stock['L'] >0 || $stock['XL'] >0) {?>
                            <button type="submit" class="btn btn-success">Adicionar ao Carrinho<i
                                    class="fas fa-cart-plus fa-lg"></i></button>
                            <?php }else{?>

                            <button type="submit" class="btn btn-secondary" disabled>Produto Indisponível<i
                                    class="fas fa-cart-plus fa-lg"></i></button>
                            <?php
                        }


                    }

                    else if ($row['categoria'] =="Calçado"){

                        if($stock['36'] >0 || $stock['37'] >0 || $stock['38'] >0 || $stock['39'] >0 || $stock['40'] >0|| $stock['41'] >0|| $stock['42'] >0|| $stock['43'] >0) {?>
                            <h5 class="text-muted mb-2 mt-2"> Referência: <?php echo$row['ref']?> </h5>
                            <h4 class="mb-3 mt-2">Tamanho </h4>
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <div class="btn-group radio-group" required>
                                                <?php if($stock['36'] >0) {echo ('<label class="btn btn-info not-active">36<input type="radio" value="36" name="tamanho" required></label>') ;}?>
                                                <?php if($stock['37'] >0) {echo ('<label class="btn btn-info not-active">37<input type="radio" value="37" name="tamanho" required></label>') ;}?>
                                                <?php if($stock['38'] >0) {echo ('<label class="btn btn-info not-active">38<input type="radio" value="38" name="tamanho" ></label>') ;}?>
                                                <?php if($stock['39'] >0) {echo ('<label class="btn btn-info not-active">39<input type="radio" value="39" name="tamanho" ></label>') ;}?>
                                                <?php if($stock['40'] >0) {echo ('<label class="btn btn-info not-active">40<input type="radio" value="40" name="tamanho"></label>') ;}?>
                                                <?php if($stock['41'] >0) {echo ('<label class="btn btn-info not-active">41<input type="radio" value="41" name="tamanho"></label>') ;}?>
                                                <?php if($stock['42'] >0) {echo ('<label class="btn btn-info not-active">42<input type="radio" value="42" name="tamanho"></label>') ;}?>
                                                <?php if($stock['43'] >0) {echo ('<label class="btn btn-info not-active">43<input type="radio" value="43" name="tamanho"></label>') ;}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
        
        
        
        
        
                            <h4 class="mb-3 mt-0">Quantidade a Adicionar ao Carrinho </h4>
                            <input type="number" class="form-control ml-3" style="width:50%!important;" name="quantidade"
                                value="1" min="1" max="5" required>
                            <?php }
                            ?>
                            <div class="text-center mt-5 mb-5">
                                <div class="col-md-10 col-lg-6 col-xl-6 mb-3">
                                    <?php if($stock['36'] >0 || $stock['37'] >0 || $stock['38'] >0 || $stock['39'] >0 || $stock['40'] >0|| $stock['41'] >0|| $stock['42'] >0|| $stock['43'] >0) {?>
                                    <button type="submit" class="btn btn-success">Adicionar ao Carrinho<i
                                            class="fas fa-cart-plus fa-lg"></i></button>
                                    <?php }else{?>
        
                                    <button type="submit" class="btn btn-secondary" disabled>Produto Indisponível<i
                                            class="fas fa-cart-plus fa-lg"></i></button>
                                    <?php
                                }
                    }
                       

             ?>
                        </div>
                    </div>
        </form>


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
           $sql = "SELECT * FROM produtos WHERE id NOT LIKE $id AND colecao LIKE '$colecao' OR categoria LIKE 'categoria' AND id NOT LIKE $id ORDER BY RAND() LIMIT 4";
           $result = $ligacao->query($sql);
           $promocao;
           if(isset($result)){
            echo(' 
            <h3 class="display-4 text-center mt-5 mb-5">Relacionados</h3>
        ');
           
           ?>
    <hr>

    <!-- Relacionados !-->

    <div class="container ">
        <div class="row ">
            <?php 
                
                
                    
                }
                while ($row = $result -> fetch_assoc()) {
                  
                    include("admin/encontradesconto.php");
                    if(!isset($desconto))
                    {$desconto=0;}
                    
                    $stock = json_decode($row['stock'], TRUE);
                    //print_r($stock) ;
                    $totalStock = array_sum($stock);
                    //echo " Total Stock : " . $totalStock;
                    ?>
            <div class="col-md-6 col-lg-3 mb-3 p-1 text-center">
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
        <?php } ?>






    </div>
    <?php 
    }
?>
    </div>

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
                <img class="w-100 mt-5" src="images/produtos/<?php echo $row['foto1']?>" alt="">
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
                <img class="w-100 mt-5" src="images/produtos/<?php echo $row['foto2']?>" alt="">
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
                <img class="w-100 mt-5" src="images/produtos/<?php echo $row['foto3']?>" alt="">
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
                <img class="w-100 mt-5" src="images/produtos/<?php echo $row['foto4']?>" alt="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>

                </div>
            </div>
        </div>

        <?php
    } 
    
}

?>





        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
        </script>
        <script src="scripts/jsCustomHeader.js"></script>
        <script src="scripts/styleSelectListDetalhe.js"></script>
        <script src="scripts/pageTriggerLoad.js"></script>





</body>

</html>