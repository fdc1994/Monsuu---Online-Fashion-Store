<?php

    $buy = (isset($_GET['buy'])) ? $_GET['buy'] : null;
    
    if($buy == "1") {?>
<div class="container mb-5 mt-2 text-center lead align-text-top col-lg-12 col-md-12 mx-auto cart-header">
    <strong>Carrinho </strong> <span class="align-bottom"><i class="fas fa-chevron-right fa-sm"></i></span> <span
        class=""><strong> Envio</strong> </span> <span class="align-bottom"><i
            class="fas fa-chevron-right fa-sm text-warning"></i></span>
    <span class="text-muted">Pagamento</span> <span class="align-bottom"><i
            class="fas fa-chevron-right fa-sm"></i></span> <span class="text-muted">Confirmação</span>
</div>


<div class="col-lg-12 col-md-12 mt-3 lead text-center">
    <h3>Informações de Envio</h3>
</div>
<hr class="hr mb-5">


<div class="row mt-2">
    <div class="col-md-1 col-lg-3"></div>
    <div class="col-md-10 col-lg-6 lead text-center">
        <form class="needs-validation" action="carrinho.php?buy=2" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName">Nome</label>
                    <input type="text" value="<?php echo $_SESSION['userNome']?>" class="form-control"
                        id="validationCustom01" placeholder="Nome" value="" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputSurname">Apelido</label>
                    <input type="text" value="<?php echo $_SESSION['userApelido']?>" class="form-control"
                        id="validationCustom01" placeholder="Apelido" value="" name="apelido" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputSurname">Telefone</label>
                    <input type="tel" value="<?php echo $_SESSION['userTelefone']?>" class="form-control"
                        id="validationCustom01" placeholder="" name="telefone" pattern="[1-9]{2}[0-9]{7}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputState">Distrito</label>
                    <select id="inputState" class="form-control" name="distrito"
                        value="<?php echo $_SESSION['userDistrito']?>" required>
                        <option value="Aveiro" <?php if($_SESSION['userDistrito'] == "Aveiro") {echo("selected");}?>>
                            Aveiro</option>
                        <option value="Beja" <?php if($_SESSION['userDistrito'] == "Beja") {echo("selected");}?>>Beja
                        </option>
                        <option value="Braga" <?php if($_SESSION['userDistrito'] == "Braga") {echo("selected");}?>>Braga
                        </option>
                        <option value="Braganca"
                            <?php if($_SESSION['userDistrito'] == "Bragança") {echo("selected");}?>>Bragança</option>
                        <option value="Castelo_branco"
                            <?php if($_SESSION['userDistrito'] == "Castelo Branco") {echo("selected");}?>>Castelo Branco
                        </option>
                        <option value="Coimbra" <?php if($_SESSION['userDistrito'] == "Coimba") {echo("selected");}?>>
                            Coimbra</option>
                        <option value="Evora" <?php if($_SESSION['userDistrito'] == "Évora") {echo("selected");}?>>Évora
                        </option>
                        <option value="Faro" <?php if($_SESSION['userDistrito'] == "Faro") {echo("selected");}?>>Faro
                        </option>
                        <option value="Guarda" <?php if($_SESSION['userDistrito'] == "Guarda") {echo("selected");}?>>
                            Guarda</option>
                        <option value="Leiria" <?php if($_SESSION['userDistrito'] == "Leiria") {echo("selected");}?>>
                            Leiria</option>
                        <option value="Lisboa" <?php if($_SESSION['userDistrito'] == "Lisboa") {echo("selected");}?>>
                            Lisboa</option>
                        <option value="Portalegre"
                            <?php if($_SESSION['userDistrito'] == "Portalegre") {echo("selected");}?>>Portalegre
                        </option>
                        <option value="Porto" <?php if($_SESSION['userDistrito'] == "Porto") {echo("selected");}?>>Porto
                        </option>
                        <option value="Santarem"
                            <?php if($_SESSION['userDistrito'] == "Santarem") {echo("selected");}?>>Santarém</option>
                        <option value="Setubal" <?php if($_SESSION['userDistrito'] == "Setubal") {echo("selected");}?>>
                            Setúbal</option>
                        <option value="Viana Do Castelo"
                            <?php if($_SESSION['userDistrito'] == "Viana Do Castelo") {echo("selected");}?>>Viana do
                            Castelo</option>
                        <option value="Vila Real"
                            <?php if($_SESSION['userDistrito'] == "Vila Real") {echo("selected");}?>>Vila Real</option>
                        <option value="Viseu" <?php if($_SESSION['userDistrito'] == "Viseu") {echo("selected");}?>>Viseu
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Cidade</label>
                    <input type="text" value="<?php echo $_SESSION['userCidade']?>" class="form-control" id="inputCity"
                        name="cidade" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Código Postal</label>
                    <input type="text" value="<?php echo $_SESSION['userCpostal']?>" class="form-control" id="inputZip"
                        name="codigopostal" pattern="\d{4}-\d{3}" required>
                </div>
                <div class="col-3"></div>
                <div class="form-group col-md-12">
                    <label for="inputAddress">Morada</label>
                    <textarea type="text" class="form-control" id="inputAddress" name="morada"
                        placeholder="Avenida da Liberdade 427 1º Direito..."
                        required><?php echo($_SESSION['userMorada']);?></textarea>
                </div>

                <div class="col-md-12 text-center"><label for="myCheck">Pretende fatura com contribuinte?</label>
                    <br>Sim <input type="checkbox" id="checkS" onclick="openNif()"> Não <input type="checkbox"
                        id="checkN" onclick="closeNif()" checked></div>
                <div class="col-lg-3"></div>
                <div class="form-group col-md-12 disabled mt-2" id="nif">
                    <label for="inputAddress">Número de Contribuinte</label>
                    <input type="text" class="form-control" id="inputAddress" pattern="[1-9]{1}[0-9]{8}" name="nif"
                        placeholder="Por favor indique o seu número de contribuinte">
                    <small class="small text-muted mb-5 mt-5">Se pretender que os seus dados sejam faturados com
                        detalhes diferentes, por favor indique-o na fase final na secção de observações e entraremos em
                        contacto consigo.</small>
                </div>
                <div class="col-12 text-center">
                    <hr>
                    <a href="carrinho.php?buy=2"> <button type="submit"
                            class="btn btn-warning lead mt-2 mb-3">CONTINUAR</button> </a><br>
                </div>

        </form>




    </div>
</div>

<?php
    }
    if($buy == "2") {
        $numerodedados = 7;
        $dadosEncomenda = array();
        array_push($dadosEncomenda, $_POST['nome'], $_POST['apelido'], $_POST['telefone'], $_POST['morada'], $_POST['distrito'], $_POST['cidade'], $_POST['codigopostal']);
        
        $dadosEncomenda = array_filter($dadosEncomenda);
       
        if($_POST['nif'] != null) {
            $numerodedados++;
            array_push($dadosEncomenda, $_POST['nif']);
            $_SESSION['nif'] = true;
           
        }
        else {
            unset($_SESSION['nif']);
        }
        if(count($dadosEncomenda) != $numerodedados) {
           
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-warning' role='alert'>Não foi possível finalizar o seu processo de compra. Por favor siga todos os passos pela ordem correta.</div>";
            echo '<script>window.location.href = "carrinho.php";</script>';
            die();
        }
        else {
            $_SESSION['dadosEncomenda'] = $dadosEncomenda;
           // echo "Dados Ok <br>";
            
            //print_r($dadosEncomenda);
        ?>
<div class="container input-payment">
    <div class="container mb-5 mt-2 text-center lead align-text-top col-lg-12 col-md-12 mx-auto cart-header">
        <strong>Carrinho </strong> <span class="align-bottom"><i
                class="fas fa-chevron-right fa-sm text-warning"></i></span> <span class=""><strong> Envio</strong>
        </span> <span class="align-bottom"><i class="fas fa-chevron-right fa-sm text-warning"></i></span>
        <span class=""> <strong>Pagamento</strong> </span> <span class="align-bottom"><i
                class="fas fa-chevron-right fa-sm"></i></span> <span class="text-muted">Confirmação</span>
    </div>


    <div class="col-lg-12 col-md-12 mt-3 lead text-center">
        <h3>Método de Pagamento</h3>
    </div>
    <hr class="hr mb-5">
    <div class="row">

        <div class="col-md-0 col-lg-3"></div>
        <div class="col-lg-6 col-md-10 text-center">

            <div class="">
                <form action="carrinho.php?buy=3" method="POST">



                    <input class="form-check-input" type="radio" name="pagamento" id="MBWAY" value="MBWAY">
                    <label class="form-check-label" for="MBWAY">
                        <img src="images/mbway.png" style="max-height:80px!important" alt="">

                    </label>


                    <input class="form-check-input" type="radio" name="pagamento" id="MB" value="Multibanco">
                    <label class="form-check-label" for="MB">
                        <img src="images/multibanco.png" style="max-height:80px!important" alt="">
                    </label>


                    <input class="form-check-input" type="radio" name="pagamento" id="Payshop" value="Payshop">
                    <label class="form-check-label" for="Payshop">
                        <img src="images/payshop.png" style="max-height:80px!important" alt="">
                    </label>



            </div>
            <button type="submit" class="btn btn-warning lead mt-2 mb-3">CONTINUAR</button>
            </form>

        </div>

    </div>


    <br>

    <?php }
    }
    if($buy == "3") {
        if(isset($_POST['pagamento'])) {
            $_SESSION['metodoPagamento'] = $_POST['pagamento'];
        }
        else{
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-warning' role='alert'>Não foi possível finalizar o seu processo de compra. Por favor siga todos os passos pela ordem correta.</div>";
            echo '<script>window.location.href = "carrinho.php";</script>';
            die();
        }
        
        ?>
    <div class="row text-center">
        <div class="col-12">
            <?php  if (isset($_SESSION['resultadoAddCarrinho'])){
                        echo $_SESSION['resultadoAddCarrinho'];
                        unset($_SESSION['resultadoAddCarrinho']);
                                 }?>
        </div>
    </div>
    <div class="container mb-5 mt-2 text-center lead align-text-top col-lg-12 col-md-12 mx-auto cart-header">
        <strong>Carrinho</strong> <span class="align-bottom"><i
                class="fas fa-chevron-right fa-sm text-warning"></i></span> <strong> Envio</strong> </span> <span
            class="align-bottom"><i class="fas fa-chevron-right fa-sm text-warning"></i></span>
        <strong>Pagamento</strong> <span class="align-bottom"><i
                class="fas fa-chevron-right fa-sm text-warning"></i></span> <span class="text-muted">Confirmação</span>
    </div>


    <div class="col-lg-12 col-md-12 mt-3 lead text-center">
        <h1 class="display-4">Confirmação de Encomenda</h1>
    </div>
    <hr class="hr mb-5">


    <div class="row mt-2">
        <div class="d-none d-lg-block d-xl-block col-lg-2"></div>
        <div class="text-center col-md-12 col-lg-4 mt-0">
            <h1>Produtos</h1>
            <hr>
        </div>
        <div class="text-center d-none d-lg-block d-xl-block col-lg-4">
            <h1>Resumo</h1>
            <hr>
        </div>
        <div class="col-md-0 col-lg-2"></div>
        <div class="col-md-0 col-lg-2"></div>

        <div class="cart final col-md-12 col-lg-4 lead p-3">


            <?php 
                                $precototal =0;
                                $totalprodutos=0;
                                for ($i = 0; $i < count($idsEncontrados); $i++) {
                                    
                                    $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." LIMIT 1";
                                 
                                    $resultado_final = mysqli_query($ligacao, $sql);
                                    $count=0;
                                   
                                    $row = $resultado_final->fetch_assoc();
                                    $totalprodutos+= $quantidadeID[$i];
                                    include("admin/encontradesconto.php");
                                   
                                    $precototal+= $precofinal * $quantidadeID[$i];
                                   
                                    ?>
            <div class="row">
                <form
                    action="atualizarCarrinho.php?edit=1&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>"
                    method="POST">
                    <div class="col-4 pr-0"><a class="align-middle" href="detalhe.php?id=<?php echo ($row['id'])?>"><img
                                src="images/produtos/<?php echo ($row['foto1'])?>" alt=""></a></div>
                    <div class="col-8 float-right">


                        <div>
                            <h5 class="mb-1 text-right mr-1"><?php echo ($row['nome'])?></h5>
                        </div>
                        <div class="text-muted small text-right"><?php echo ($row['ref'])?></div>
                        
                        <div class="text-muted text-right ">Tamanho <?php if ($tamanhoID[$i]== "Unico") {echo "Único";} else {echo $tamanhoID[$i];}?></div>
                        <div class="text-right text-muted ">Qtd: <?php echo($quantidadeID[$i])?></div>
                        <div class="text-right text-muted "> Preço Uni: <?php echo(number_format($precofinal,2));?>€
                        </div>
                        <div class="text-right text-muted "> Preço Total:
                            <?php echo(number_format($precofinal * $quantidadeID[$i],2));?>€ </div>
                    </div>
                </form>
            </div>

            <hr>

            <?php
                                           
                                }
                        
                            
                            ?>

        </div>
        <div class="col-lg-4">

            <div class="mb-2 col-md-12 col-lg-12 mr-0 text-left bg-white p-3">
                <div class="text-center d-lg-none d-xl-none col-md-12 col-lg-4 mt-1">
                    <h1>Resumo</h1>
                    <hr>
                </div>
                <h4><i class="fas fa-shipping-fast text-warning text-warning"></i>&nbsp;Dados Entrega e Faturação</h4>

                <strong>Nome:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][0] . " " . $_SESSION["dadosEncomenda"][1]);?>
                <br>
                <strong>Telefone:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][2]);?> <br>
                <strong>Email:&nbsp;</strong><?php echo($_SESSION["userEmail"]);?> <br>
                <strong>Morada:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][3]);?> <br>
                <strong>Distrito:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][4]);?> <br>
                <strong>Concelho:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][5]);?> <br>
                <strong>Código Postal:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][6]);?> <br>
                <?php if(isset($_SESSION['nif'])) {?>
                <strong>NIF: &nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][7]);?> <br>

                <?php }?>

                <strong>Comentários/Observações:&nbsp;</strong>
                <form action="admin/finalizarEncomenda.php" method="POST" class="needs-validation">
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="comentarios"></textarea>
                    </div>
                    <hr>
                    <h4> <i class="far fa-money-bill-alt text-warning"></i>&nbsp;Pagamento</h4>
                    <strong>Método de Pagamento:&nbsp;</strong><?php echo($_SESSION['metodoPagamento']);?><br>
                    <?php if($_POST['pagamento'] == "MBWAY") {?>

                    <i class="fas fa-mobile-alt fa-sm"></i>&nbsp;<strong>Nº Telemóvel MBWAY: </strong><input
                        class="form-control-sm" name="telefoneMBWAY" type="tel" pattern="[1-9]{2}[0-9]{7}"
                        style="border: 1px solid black!important;" required>

                    <small class="text-small text-muted w-25">Deve introduzir um número português válido sem indicativos
                        de país. ex:"9xxxxxxxx"</small><br>
                    <small class="text-small text-muted w-25">Após finalizar a encomenda será enviado um pedido ao
                        número indicado para finalizar a operação na aplicação MBWAY.</small><br>
                    <?php }
                   else if ($_POST['pagamento'] == "Multibanco") {?>


                    <small class="text-small text-muted w-25">Após finalizar a encomenda será gerada uma referência
                        multibanco que será enviada para o seu email e poderá também consultá-la na sua área de
                        cliente.</small><br>

                    <?php 
                   }
                   else {?>
                    <small class="text-small text-muted w-25">Após finalizar a encomenda será gerada uma referência
                        Payshop que será enviada para o seu email e poderá também consultá-la na sua área de
                        cliente.</small>
                   
                    <?php    }
                   
                   ?>
                    <strong>Produtos: &nbsp;</strong><?php echo $totalprodutos?></i> <br>
                    <strong>Valor Carrinho: &nbsp;</strong><?php echo number_format($precototal,2)?>€</i> <br>
                    <?php if($precototal >=50) {?>
                    <strong>Valor Portes:&nbsp;</strong> <span class="text-success">GRÁTIS </span> <br>
                    <?php  }
                    else{ ?>

                    <strong>Valor Portes:&nbsp;</strong> <span class="">3.99 €</span> <br>
                    <small class="text-small text-muted w-25">Portes gratuitos para encomendas a partir de
                        50€</small><br>
                    <?php $precototal+= 3.99;}?>
                    <strong>Valor Total:&nbsp;</strong><?php echo(number_format($precototal,2));?> €<br>
                    <small class="text-small text-muted w-25">IVA de 23% incluído</small><br>

                    <hr>
                    <div class="col-12 text-center">

                        <button type="submit" class="btn btn-warning lead mt-2 mb-3">FINALIZAR ENCOMENDA</button><br>

                    </div>
                </form>
                <hr class="mt-2 mb-1">
            </div>

        </div>

        <?php 
    }
    else if($buy == "orderComplete") {
        $orderNumber = (isset($_GET['orderNumber'])) ? $_GET['orderNumber'] : null;
        if(isset($orderNumber)) {?>

        <div class="container mb-5 mt-2 text-center lead align-text-top col-lg-12 col-md-12 mx-auto cart-header">
            <strong class="text-success">Carrinho</strong> <span class="align-bottom"><i
                    class="fas fa-chevron-right fa-sm text-warning"></i></span> <strong class="text-success">
                Envio</strong> </span> <span class="align-bottom"><i
                    class="fas fa-chevron-right fa-sm text-warning"></i></span>
            <strong class="text-success">Pagamento</strong> <span class="align-bottom"><i
                    class="fas fa-chevron-right fa-sm text-warning"></i></span> <strong class="text-success"><span
                    class="text">Confirmação</strong></span>
        </div>


        <div class="col-lg-12 col-md-12 mt-3 lead text-center mr-0">
            <h1 class="display-4">Encomenda Finalizada com Sucesso <i class="far fa-check-circle  text-success"></i>
            </h1>
        </div>

        <hr>
        <div class="row">

            <div class="col-md-0 col-lg-1"></div>
            <div class="col-md-0 col-lg-10 mt-2 text-center">
                <h3>Agradecemos a sua preferência, <?php echo $_SESSION['userNome']?>! </h3>
            </div>
            <div class="col-md-0 col-lg-1"></div>
            <div class="col-md-0 col-lg-1"></div>
            <div class="col-md-0 col-lg-10 text-center mt-5">
                <h5>Dentro de instantes irá receber um e-mail no endereço indicado com todas as informações da sua
                    encomenda. <br> <br> Após a receção do pagamento iremos processar o envio da sua encomenda. Poderá
                    acompanhar o estado da mesma através da sua <a href="encomendas.php">área de cliente</a>.</h5>
            </div>
            <div class="col-md-0 col-lg-1"></div>
            <hr>
        </div>


        <div class="row mt-2">
        <div class="col-md-12  text-center pr-3 mt-3">
           <h1 class="lead display-4 mb-5">Encomenda <?php echo $orderNumber?><?php
           
           
           ?> </h1>
            </div>
            <div class="d-none d-lg-block d-xl-block col-lg-2"></div>
            <div class="text-center col-md-12 col-lg-4 mt-0">
                <h1>Produtos</h1>
                <hr>
            </div>
            <div class="text-center d-none d-lg-block d-xl-block col-lg-4">
                <h1>Resumo</h1>
                <hr>
            </div>
            <div class="col-md-0 col-lg-2"></div>
            <div class="col-md-0 col-lg-2"></div>

            <div class="cart final col-md-12 col-lg-4 lead p-3">
                <?php include "admin/encontraEncomendasJson.php"?>


            </div>
            <div class="col-lg-4">

                <div class="mb-2 col-md-12 col-lg-12 mr-0 text-left bg-white p-3">
                    <div class="text-center d-lg-none d-xl-none col-md-12 col-lg-4 mt-1">
                        <h1>Resumo</h1>
                        <hr>
                    </div>
                    <h4><i class="fas fa-shipping-fast text-warning text-warning"></i>&nbsp;Dados Entrega e Faturação
                    </h4>

                    <strong>Nome:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][0] . " " . $_SESSION["dadosEncomenda"][1]);?>
                    <br>
                    <strong>Telefone:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][2]);?> <br>
                    <strong>Morada:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][3]);?> <br>
                    <strong>Distrito:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][4]);?> <br>
                    <strong>Concelho:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][5]);?> <br>
                    <strong>Código Postal:&nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][6]);?> <br>
                    <?php if(isset($_SESSION['nif'])) {?>
                    <strong>NIF: &nbsp;</strong><?php echo($_SESSION["dadosEncomenda"][7]);?> <br>

                    <?php }
                else {
                    ?>
                    <strong>NIF: &nbsp;</strong><?php echo("999999999 CONSUMIDOR FINAL");?> <br>
                    <?php
                }
                ?>
                <strong>Comentários/Observações:&nbsp;</strong>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="comentarios" readonly><?php
                        echo $_SESSION['comentarios'];
                        ?></textarea>
                    </div>


                    <form action="admin/finalizarEncomenda.php" method="POST" class="needs-validation">
                        <hr>
                        <h4> <i class="far fa-money-bill-alt text-warning"></i>&nbsp;Pagamento</h4>

                        <strong>Produtos: &nbsp;</strong><?php echo $totalprodutos?></i> <br>
                        <strong>Valor Carrinho: &nbsp;</strong><?php echo number_format($precototal,2)?>€</i> <br>
                        <?php if($precototal >=50) {?>
                        <strong>Valor Portes:&nbsp;</strong> <span class="text-success">GRÁTIS </span> <br>
                        <?php  }
                    else{ ?>

                        <strong>Valor Portes:&nbsp;</strong> <span class="">3.99 €</span> <br>
                        <small class="text-small text-muted w-25">Portes gratuitos para encomendas a partir de
                            50€</small><br>
                        <?php $precototal+= 3.99;}?>
                        <strong>Valor Total:&nbsp;</strong><?php echo(number_format($precototal,2));?> €<br>
                        <small class="text-small text-muted w-25">IVA de 23% incluído</small><br>
                        <hr>


                        <strong>Método de Pagamento:&nbsp;</strong><?php echo($_SESSION['metodoPagamento']);?> <br>
                        <div class="row">
                        </div>
                        <?php if($_SESSION['metodoPagamento'] == "MBWAY") {?>

                        <i class="fas fa-mobile-alt fa-sm"></i>&nbsp;<strong>Nº Telemóvel MBWAY: </strong>
                        <?php echo $_SESSION['telefoneMBWAY']?>

                        <small class="text-small text-muted w-25">Foi enviado um pedido de pagamento para o número indicado. Por favor termine o pagamento no seu dispositivo nos próximos 5 minutos.</small><br>
                        <strong>Data Limite Pagamento:&nbsp;</strong><?php echo($_SESSION['limitePagamento']);?> <br>
                        <?php }
                   else if ($_SESSION['metodoPagamento'] == "Multibanco") {?>
                        <br>
                        <div class="refMb p-2 mx-auto mb-4">
                            <div class="row">
                                <img src="images/multibanco.png" class="w-25 mx-auto mt-0" alt="">
                            </div>
                            <div class="row mt-2 ">
                                <div class="col-6">
                                    <pre><strong>Entidade:</strong></pre>
                                    <pre><strong>Referência:</strong></pre>
                                    <pre><strong>Valor:</strong> </pre>
                                    <pre><strong>Validade:</strong> </pre>
                                </div>
                                <div class="col-6 float-right">
                                    <pre>|&nbsp;<?php echo $_SESSION['refMB']['entidade']?></pre>
                                    <pre>|&nbsp;<?php echo $_SESSION['refMB']['referencia']?></pre>
                                    <pre>|&nbsp;<?php echo $_SESSION['refMB']['valor']?>€</pre>
                                    <pre>|&nbsp;<?php echo $_SESSION['limitePagamento']?></pre>
                                </div>

                            </div>


                        </div>
                        <small class="text-small text-muted w-25 mt-5">A seguinte referência terá uma validade de 48
                            horas. Se a mesma caducar, terá de voltar a fazer uma nova encomenda e os seus produtos
                            voltarão a estar em stock.</small>
                        <?php  }
                   else if ($_SESSION['metodoPagamento'] == "Payshop"){?>
                       <br>
                        <div class="refMb p-2 mx-auto mb-4">
                            <div class="row">
                                <img src="images/payshop.png" class="w-25 mx-auto mt-0" alt="">
                            </div>
                            <div class="row mt-2 ">
                                <div class="col-6">
                                    <pre><strong>Referência:</strong></pre>
                                    <pre><strong>Valor:</strong></pre>
                                    <pre><strong>Validade:</strong> </pre>
                                </div>
                                <div class="col-6 float-right">
                                    <pre>|&nbsp;<?php echo $_SESSION['refPayshop']['Reference']?></pre>
                                    <pre>|&nbsp;<?php echo $_SESSION['refPayshop']['preco']?>€</pre>
                                    <pre>|&nbsp;<?php echo $_SESSION['refPayshop']['limite']?></pre>
                                   
                                </div>

                            </div>


                        </div>
                        <small class="text-small text-muted w-25 mt-5">A seguinte referência terá uma validade de 48
                            horas. Se a mesma caducar, terá de voltar a fazer uma nova encomenda e os seus produtos
                            voltarão a estar em stock.</small>
                        
                        <?php    }
                   
                   ?>


                    </form>
                    <hr class="mt-2 mb-1">
                </div>

            </div>
        </div>
    </div>







    <?php
        }
        else{
            $_SESSION['resultadoAddCarrinho'] = "<div class='alert alert-warning' role='alert'>Não foi possível apresentar os detalhes da sua encomenda. Por favor verifique a sua área de cliente e caso necessite de assistência entre em contacto com o nosso serviço ao cliente através da página de contactos.</div>";
            echo '<script>window.location.href = "carrinho.php";</script>';
            die();
        }
        
        ?>

    <?php
    }
    if(!isset($buy)) {

        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
           
        include("admin/encontraprodutoscarrinho.php");

        

        if ($totalprodutos>0) {
        

            
        ?>
    <div class="row text-center">
        <div class="col-12">
            <?php  if (isset($_SESSION['resultadoAddCarrinho'])){
                        echo $_SESSION['resultadoAddCarrinho'];
                        unset($_SESSION['resultadoAddCarrinho']);
                                 }?>
        </div>
    </div>
    <div class="container mb-5 mt-2 text-center lead align-text-top col-lg-12 col-md-12 mx-auto cart-header">
        <strong> Carrinho</strong> <span class="align-bottom"><i
                class="fas fa-chevron-right fa-sm text-warning"></i></span> <span class="text-muted">Envio</span> <span
            class="align-bottom"><i class="fas fa-chevron-right fa-sm"></i></span>
        <span class="text-muted">Pagamento</span> <span class="align-bottom"><i
                class="fas fa-chevron-right fa-sm"></i></span> <span class="text-muted">Confirmação</span>
    </div>
    <div class="col-lg-2">
    </div>
    <div class="col-lg-12 col-md-12 mt-3 lead text-center">
        <h5 class="display-4">Os meus Produtos</h3>
    </div>
    <hr class="hr mb-5">
    <div class="row mt-2">
        <div class="col-2"></div>
        <div class="col-lg-4 col-md-6 text-center">
            <h3>Produtos</h3>
            <hr>
        </div>
        <div class="col-4 text-center">
            <h3 class="d-none d-md-block">Resumo da Compra</h3>
            <hr class="d-none d-md-block">
        </div>
        <div class="col-2"></div>
        <div class="col-2"></div>

        <div class="cart col-md-6 col-lg-4 lead">

            <?php 
                                $precototal =0;
                                $totalprodutos=0;
                                for ($i = 0; $i < count($idsEncontrados); $i++) {
                                    
                                    $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." LIMIT 1";
                                 
                                    $resultado_final = mysqli_query($ligacao, $sql);
                                    $count=0;
                                   
                                    $row = $resultado_final->fetch_assoc();
                                    $totalprodutos+= $quantidadeID[$i];
                                    include("admin/encontradesconto.php");
                                   
                                    $precototal+= $precofinal * $quantidadeID[$i];
                                   
                                    ?>
            <div class="row">
                <form
                    action="atualizarCarrinho.php?edit=1&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>"
                    method="POST">
                    <div class="col-4 pr-0"><a class="align-middle" href="detalhe.php?id=<?php echo ($row['id'])?>"><img
                                src="images/produtos/<?php echo ($row['foto1'])?>" alt=""></a></div>
                    <div class="col-8 float-right">

                        <div>
                            <h5 class="mb-1 text-right mr-1"><?php echo ($row['nome'])?></h5>
                        </div>
                        <div class="text-muted small text-right"><?php echo ($row['ref'])?></div>
                        <div class="text-muted text-right ">Tamanho <?php if ($tamanhoID[$i]== "Unico") {echo "Único";} else {echo $tamanhoID[$i];}?></div>
                        <div class="text-right text-muted ">Qtd: <input style="max-width:50px;" class="form-control-sm"
                                type="number" min="0" name="quantidade"
                                value="<?php echo($quantidadeID[$i])?>"><button><i
                                    class="fas fa-sync-alt mr-1"></i></button></div>
                        <div class="text-right text-muted "> Preço Uni: <?php echo(number_format($precofinal,2));?>€
                            <button type="button" data-toggle="modal" data-toggle="modal"
                                data-target="#modalConfirm<?php echo($i)?>"><i
                                    class="fas fa-trash-alt mr-1"></i></button></div>
                        <div class="text-right text-muted "> Preço Total:
                            <?php echo(number_format($precofinal * $quantidadeID[$i],2));?>€ </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="modalConfirm<?php echo($i)?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Pretende apagar este produto do seu
                                carrinho?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row mb-1 text-center">
                                    <div class="col">
                                        <h3 class="h3"><?php echo($row['nome'])?></h3>
                                    </div>
                                </div>
                                <div class="row mb-2 d-flex flex-wrap align-items-center flex">
                                    <div class="col text-center align-middle">
                                        <img src="images/produtos/<?php echo $row['foto1'] ?>">
                                    </div>
                                    <div class="col" style="height: 100%;">
                                        <label for="exampleInputEmail1">Descrição</label>
                                        <textarea class="form-control-md" rows="6" name="descricao" type="textarea"
                                            readonly><?php echo($row['descricao'])?> "</textarea>
                                    </div>
                                </div>

                                <div class="row mb-1 mt-2">
                                    <div class="col">

                                        <label for="exampleInputEmail1">Tamanho</label>
                                        <input type="text" class="form-control-sm" id="exampleInputEmail1"
                                            value="<?php echo($tamanhoID[$i])?>" min='0' readonly>
                                    </div>
                                    <div class="col">

                                        <label for="exampleInputEmail1">Quantidade</label>
                                        <input type="text" class="form-control-sm" id="exampleInputEmail1"
                                            value="<?php echo($idsEncontrados[$i])?>" min='0' readonly>
                                    </div>

                                </div>
                                <div class="row mb-0">
                                    <div class="col">
                                        <label for="exampleInputEmail1">Preço</label>
                                        <input type="text" class="form-control-sm" id="exampleInputEmail1"
                                            value="<?php echo($precofinal)?>" readonly>
                                    </div>
                                    <div class="col">

                                        <label for="exampleInputEmail1">Total</label>
                                        <input type="text" class="form-control-sm" id="exampleInputEmail1"
                                            value="<?php echo(number_format($idsEncontrados[$i] * $precofinal,2 ))?>€"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="lead mt-2">
                                Não é possível reverter esta ação. Terá de adicionar um novo produto ao seu carrinho se
                                desejar que esteja novamente disponível no seu carrinho.
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar Atrás</button>
                            <?php ?>
                            <a
                                href="atualizarCarrinho.php?edit=2&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>"><button
                                    class="btn btn-warning">Apagar Produto</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <?php          
                                }
                                
                            ?>

        </div>




        <div class="text-center col-md-6 col-lg-4 mt-0">
            <h3 class="d-xs-block d-sm-block d-md-block d-lg-none d-xl-none">Resumo da Compra</h3>
            <hr class="d-xs-block d-sm-block d-md-block d-lg-none d-xl-none">
            <div class="mb-2 col-md-12 col-lg-12 mr-0 text-left">

                <i class="fas fa-check text-success"></i>&nbsp;Envios Grátis para Portugal Continental a partir de 50€
                <br>

                <i class="fas fa-sync text-success"></i>&nbsp;Trocas e Devoluções em Caso de Defeitos<br>
                <i class="fas fa-lock text-success"></i>&nbsp;Métodos de Pagamentos Seguros<br>

            </div>

            <div class="mb-2 mt-2 col-md-12 col-lg-12 mr-0 text-right">
                <strong>Produtos: &nbsp;</strong><?php echo $totalprodutos?></i> <br>
                <strong>Valor Carrinho: &nbsp;</strong><?php echo number_format($precototal,2)?>€</i> <br>
                <?php if($precototal >=50) {?>
                <strong>Valor Portes:&nbsp;</strong> <span class="text-success">GRÁTIS </span>
                <?php  }
                    else{ ?>

                <strong>Valor Portes:&nbsp;</strong> <span class="">3.99 €</span>

                <?php $precototal+= 3.99;}?>
                <br>
                <strong>Valor Total:&nbsp;</strong><?php echo(number_format($precototal,2));?> €<br>
                <small class="text-small text-muted w-25">IVA de 23% incluído</small>
            </div>


            <div class="col-12 text-center">
                <hr>
                <a href="carrinho.php?buy=1"> <button type="button" class="btn btn-warning lead mt-2 mb-3">PROCESSAR
                        ENCOMENDA</button> </a><br>
                <img src="images/multibanco.png" class="small-icons mr-2" alt="">
                <img src="images/mbway.png" class="small-icons" alt="">

                <img src="images/payshop.png" class=" ml-0 small-icons" alt="">
            </div>


        </div>












        <?php }

                
                    
    else{?>

        <div class='container mt-5 col-12'>
            <div class="row text-center">
                <div class="col-12">
                    <?php  if (isset($_SESSION['resultadoAddCarrinho'])){
                        echo $_SESSION['resultadoAddCarrinho'];
                        unset($_SESSION['resultadoAddCarrinho']);
                                 }?>
                </div>
            </div>
            <div class='row text-center text-dark container-main'>
                <div class="col-12">
                    <h5 class="">Ainda não adicionou produtos ao seu carrinho.</h5>
                </div>
                <hr>
                </hr>
                <div class="col-12 lead">
                    <h5>Mas ainda vai a tempo de escolher o seu novo Look!</h5>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4 mt-5 mb-5">
                    <button type="button" class="btn btn-info" onclick="openNav()">Ver Produtos</button>
                </div>
                <div class="col-4">

                </div>
            </div>

        </div>

        <?php
    }
    }
    
   

   
    
        $ligacao->close();
    ?>
    </div>
</div>