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

    <?php include 'header.php'; ?>

    <div class="jumbotron text-center mb-0 mt-5">
        <div class="row text-center">
            <div class="col-12">
                <?php  if (isset($_SESSION['resultadoInserir'])){
                    echo $_SESSION['resultadoInserir'];
                    unset($_SESSION['resultadoInserir']);
                             }?>
            </div>
        </div>
        <h1 class="display-3">Inserir Novo Produto</h1>


        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12 text-right mr-0">
                    <a class="btn btn-info mt-5" onclick="history.go(-1)">Voltar Atrás</a>
                </div>
            </div>




            <div class="container">
                <div class="row mb-1">
                    <form class="" action="inserirDados.php" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-12 col-md-12">
                            <div class="row mt-3">
                                <div class="col ">
                                    <label for="exampleInputEmail1">Nome</label>
                                    <input type="text" class="form-control" name="nome" required>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Referência</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="ref" required>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Categoria</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="categoria"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Coleção</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="colecao"
                                        required>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col">
                                    <label for="exampleInputEmail1">Preço
                                    </label>
                                    <input type="number" class="form-control" id="exampleInputEmail1" name="preco"
                                        min="0" step="0.01" value="0.00" required>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Desconto</label>
                                    <input type="number" min="0" max="99" step="1" value="0" class="form-control"
                                        id="exampleInputEmail1" name="desconto" required>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlSelect1">Novidade</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="novidade"
                                        required>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>

                                    </select>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlSelect1">Listado</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="listado" required>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5">
                                <div class="col-md-12 text-center">
                              
                                    <h1>Está a inserir Roupa ou Calçado?</h1>
                                    <br>Roupa <input type="checkbox" id="checkRoupa" name="checkRoupa" value="1" onclick="openClothes()" checked> 
                                    Calçado <input
                                        type="checkbox" id="checkCalcado" name="checkCalcado"  value="1" onclick="openShoes()" >
                                </div>
                            </div>


                            <div class="row mb-1" id="roupa">
                                <div class="col">
                                    <label for="exampleInputEmail1">Stock
                                        Único</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stockUnico">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Stock
                                        Small</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stockS">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Stock
                                        Medium</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stockM">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Stock
                                        Large</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stockL">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Stock XL</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stockXL">
                                </div>


                            </div>

                            <div class="row mb-1 disabled" id="calcado">
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">36</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock36">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">37</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock37">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">38</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock38">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">39</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock39">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">40</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock40">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">41</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock41">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">42</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock42">
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <label for="exampleInputEmail1">43</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock43">
                                </div>


                            </div>
                            <div class="row mb-1">
                                <div class="col-md-12 col-lg-6">
                                    <label for="exampleInputEmail1">Descrição</label>
                                    <textarea class="form-control" name="descricao" type="textarea" rows="5"
                                        name="descricao" required></textarea>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <label for="exampleInputEmail1">Ficha
                                        Técnica</label>
                                    <textarea class="form-control" type="textarea" rows="5" name="fichaTecnica"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3 ">

                            <div class="col-lg-1 col-md-0"></div>
                            <div class="col-lg-10 col-md-12 mb-3">
                                <small class="form-text text-muted">
                                    As novas fotografias devem respeitar o formato pré-definido e ser carregadas pela
                                    ordem em que se apresentam. <br>
                                    Exemplo: Caso existam apenas duas fotografias devem ser submetidas no campo
                                    Fotografia 1 e Fotografia 2.
                                </small>

                            </div>
                            <div class="col-lg-1 col-md-0"></div>


                            <div class="col-md-12 col-lg-3 mb-2">
                                <label for="exampleInputEmail1">Fotografia 1</label>
                                <input type="file" name="foto1" id="foto" class="form-control-file">
                            </div>
                            <div class="col-md-12 col-lg-3 mb-2">
                                <label for="exampleInputEmail1">Fotografia 2</label>
                                <input type="file" name="foto2" id="foto" class="form-control-file">
                            </div>
                            <div class="col-md-12 col-lg-3 mb-2">
                                <label for="exampleInputEmail1">Fotografia 3</label>
                                <input type="file" name="foto3" id="foto" class="form-control-file">
                            </div>
                            <div class="col-md-12 col-lg-3 mb-2">
                                <label for="exampleInputEmail1">Fotografia 4</label>
                                <input type="file" name="foto4" id="foto" class="form-control-file">
                            </div>

                        </div>
                </div>
            </div>
        </div>


        <button type="reset" class="btn btn-secondary">Apagar Informação</button>
        <button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-toggle="modal"
            data-target="#modalConfirm">Submeter Nova Informação</button>




        <div class="row ">
            <div class="col-md-12 text-right mr-0">
                <a class="btn btn-info mt-5 mb-5" onclick="history.go(-1)">Voltar Atrás</a>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pretende Confirmar a Inserção de
                            dados?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-dark">
                        Caso encontre alguma incoerência na informação do produto poderá alterar a mesma
                        posteriormente através do menu editar.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar
                            Atrás</button>
                        <button type="submit" class="btn btn-primary">Gravar Alterações</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
    


    </div>





    </div>
    </div>
    <?php 
        
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
    <script src="scripts/stockCheckBox.js"></script>
</body>