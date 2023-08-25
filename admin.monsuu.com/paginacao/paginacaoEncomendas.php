    <?php

    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
 

    $orderNumber=(isset($_GET['orderNumber'])) ? $_GET['orderNumber'] : null;
    //Selecionar todos os campos da tabela encomendas
    $sqlEncomendas = "SELECT * FROM encomendas ORDER BY id DESC";
    $resultadoEncomendas = mysqli_query($ligacao, $sqlEncomendas);
    //mysqli_query --> Realiza uma consulta na base de dados

    //Total de livros 
    $total_encomendas = mysqli_num_rows($resultadoEncomendas);
    //mysqli_num_rows --> Obtenha o número de linhas no resultado

    //Quantidade de livros por pagina
    $quantidade_pg = 9;

    //calcular o número de pagina necessárias para apresentar os livros
    $num_pagina = ceil($total_encomendas / $quantidade_pg);
    if($total_encomendas !=0) {
        echo("<div class='lead ml-5 mb-5'>A Visualizar Página $pagina de $num_pagina</div>");
    }
    //ceil --> Frações arredondadas para cima

    //Inicio da visualização
    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    //Selecionar os livros a serem apresentado na página
    $sqlEncomendasFinal = "SELECT * FROM encomendas ORDER BY id DESC limit $inicio, $quantidade_pg" ;
    //echo($sqlEncomendasFinal);
    $resultadoEncomendasFinal = mysqli_query($ligacao, $sqlEncomendasFinal);
    if($resultadoEncomendasFinal -> num_rows >0 && !isset($orderNumber)) {
        ?>


    <table class='table table-striped table-responsive table-bordered col-12 mx-auto mb-5'>

        <thead class='thead-light'>
            <tr>
                <th scope='col'>ID</th>
                <th scope='col'>Data</th>
                <th scope='col'>Nome</th>
                <th scope='col'>Morada</th>
                <th scope='col'>Telefone</th>
                <th scope='col'>Detalhes</th>
                <th scope='col'>Comentários Cliente</th>
                <th scope='col'>Método de Pagamento</th>
                <th scope='col'>Estado Encomenda</th>
                <th scope='col'>Portes</th>
                <th scope='col'>Valor Total</th>
                <th scope='col'>Estado</th>

            </tr>
        </thead>
        <tbody> <?php 
    while ($row = mysqli_fetch_assoc($resultadoEncomendasFinal)) {
        ?>
            <tr>
                <td align=left><a
                        href="encomendas.php?orderNumber=<?php echo $row['idEncomenda'];?>&pagina=<?php echo $pagina;?>">
                        <?php echo $row['idEncomenda']?></a></td>
                <td align=left> <?php echo $row['dataEncomenda'] . " " .$row['horaEncomenda']?></td>
                <td align=left> <?php echo $row['nome']?></td>
                <td align=left> <textarea cols="8" rows="4" readonly><?php echo $row['morada']." - ".$row['distrito']." - ".$row['cidade']." - ".$row['cpostal']?></textarea></td>
               
                <td align=left> <?php echo $row['telefone']?></td>
                <td align=left> <textarea cols="8" rows="4" readonly><?php echo $row['detalhe']?></textarea></td>
                <td align=left> <textarea cols="8" rows="4" readonly><?php echo $row['comentariosCliente']?></textarea>
                </td>
                <td align=left> <?php echo $row['metodopagamento']?></td>
                <td align=left> <?php echo $row['estadoencomenda']?></td>
                <td align=left> <?php echo $row['portes']?></td>
                <td align=left> <?php echo $row['totalencomenda']?>€</td>
                <td width="100%" class="text-center">

                    <button type="button" data-toggle="modal" data-target="#modalConfirm<?php echo($row['id'])?>"
                        class="btn btn-success btn mx-auto ">Atualizar Estado</button>


                </td>
            </tr>
            <div class="modal fade" id="modalConfirm<?php echo($row['id'])?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Atualizar Encomenda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="container">
                                <div class="row mb-1">
                                    <div class="col-8 mx-auto text-center">
                                        <h1 class="lead display-4">Aviso</h1>
                                        <br>
                                        <p class="lead">Após atualizar o estado da encomenda o cliente irá receber um
                                            email automaticamente a informar do estado da mesma. </p>
                                    </div>

                                </div>
                                <div class="row mb-1">
                                    <div class="col-8 mx-auto text-center">
                                        <h1 class="lead text-left">Encomenda <?php echo($row['idEncomenda'])?></h1>


                                    </div>

                                </div>
                                <div class="row mb-1">
                                <form action="atualizarEncomenda.php?id=<?php echo $row['id'];?>&pagina=<?php echo $pagina;?>" method="POST">
                                    <div class="col-6 mx-auto"><select class="form-control"
                                            id="exampleFormControlSelect1" name="estado<?php echo $row['id']?>">
                                            <option value="Aguarda Pagamento"
                                                <?php if($row['estadoencomenda'] == "Aguarda Pagamento") {echo "selected";}?>>
                                                Aguarda
                                                Pagamento</option>
                                            <option value="Pagamento Confirmado"
                                                <?php if($row['estadoencomenda'] == "Pagamento Confirmado") {echo "selected";}?>>
                                                Pagamento Confirmado</option>
                                            <option value="Em Tratamento"
                                                <?php if($row['estadoencomenda'] == "Em Tratamento") {echo "selected";}?>>
                                                Em Tratamento
                                            </option>
                                            <option value="Em Trânsito"
                                                <?php if($row['estadoencomenda'] == "Em Trânsito") {echo "selected";}?>>
                                                Em Trânsito
                                            </option>
                                            <option value="Terminada com Sucesso"
                                                <?php if($row['estadoencomenda'] == "Terminada com Sucesso") {echo "selected";}?>>
                                                Terminada com Sucesso</option>
                                            <option value="Cancelada"
                                                <?php if($row['estadoencomenda'] == "Cancelada") {echo "selected";}?>>
                                                Cancelada</option>
                                        </select></div>
                                </div>
                                <div class="row mb-1">
                                <div class="col-lg-6 col-md-12 mx-auto">
                                    <small class="form-text text-muted">
                                        O estado atual é o que aparece quando a janela abre.
                                        <br>
                                        Se desejar, pode fechar a janela e voltar a abrir para confirmar o estado da mesma.
                                    </small>
                                

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="reset" class="btn btn-primary">Repôr Info</button>
                            <button type="submit" class="btn btn-success">Confirmar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>
            <?php
        }?>
        </tbody>
    </table>



    <?php
    
}
else if(isset($orderNumber)){?>
    <hr class="mt-3 mb-0">
    
        <div class="row mt-5">
            
        <div class="col-md-12  text-right pr-3 mb-3 mt-1">
                <a class="btn btn-warning" onclick="history.go(-1)">Voltar Atrás</a>
                </div>
    
                <div class="col-md-12  text-center pr-3 mt-3">
               <h1 class="lead display-4 mb-5">Encomenda <?php echo $orderNumber?><?php
               
               
               ?> </h1>
                </div>
                
                
                
        <div class="d-none d-lg-block d-xl-block col-lg-2"></div>
        <div class="text-center col-md-12 col-lg-4 mt-0"><h1>Produtos</h1>
            <hr>
        </div>
        <div class="text-center d-none d-lg-block d-xl-block col-lg-4"><h1>Resumo</h1>
            <hr>
        </div>
        <div class="col-md-0 col-lg-2"></div>
        <div class="col-md-0 col-lg-2"></div>
            
             <div class="cart final col-md-12 col-lg-4 lead p-3" >
             <?php include "encontraEncomendasJson.php";
             $sql = "SELECT * FROM encomendas WHERE idEncomenda LIKE '$numeroEncomenda' LIMIT 1";
             $resultado = mysqli_query($ligacao, $sql);
                    $row = mysqli_fetch_assoc($resultado);
                    $total_produtos = array_values(json_decode($row['jsonQuantidade']));
                    foreach($total_produtos as $key => $value)
                        {
                        $total_produtos = $value;
                        }
                        
             ?>
    
                 
            
            </div>  
        <div class="col-lg-4">
            
            <div class="mb-2 col-md-12 col-lg-12 mr-0 text-left bg-white p-3">
            <div class="text-center d-lg-none d-xl-none col-md-12 col-lg-4 mt-1"><h1>Resumo</h1>
            <hr>
        </div>
            <h4><i class="fas fa-shipping-fast text-warning text-warning"></i>&nbsp;Dados Entrega e Faturação</h4>
        
            <strong>Nome:&nbsp;</strong><?php echo($row["nome"])?> <br>
            <strong>Telefone:&nbsp;</strong><?php echo($row["telefone"]);?> <br>
            <strong>Morada:&nbsp;</strong><?php echo($row["morada"]);?> <br>
            <strong>Distrito:&nbsp;</strong><?php echo $row["distrito"]?> <br>
            <strong>Concelho:&nbsp;</strong><?php echo($row["cidade"]);?> <br>
            <strong>Código Postal:&nbsp;</strong><?php echo($row["cpostal"]);?> <br>
            <strong>NIF: &nbsp;</strong><?php echo($row["nif"]);?> <br>
            <strong>Comentários/Observações:&nbsp;</strong>
                        <div class="form-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="comentarios" readonly><?php
                            echo $row['comentariosCliente'];
                            ?></textarea>
                        </div>
            <hr>
            <h4> <i class="far fa-money-bill-alt text-warning"></i>&nbsp;Pagamento</h4>
            
            <strong>Produtos: &nbsp;</strong><?php echo $totalprodutos?></i> <br>
            <strong>Valor Carrinho: &nbsp;</strong><?php echo number_format($precototal,2)?>€</i> <br>
            <?php if($precototal >=50) {?>
                    <strong>Valor Portes:&nbsp;</strong> <span class="text-success">GRÁTIS </span> <br>
                <?php  }
                else{ ?>
                 
                     <strong>Valor Portes:&nbsp;</strong> <span class="">3.99 €</span> <br>
                     <small class="text-small text-muted w-25">Portes gratuitos para encomendas a partir de 50€</small><br> 
                    <?php $precototal+= 3.99;}?>
            <strong>Valor Total:&nbsp;</strong><?php echo(number_format($precototal,2));?> €<br>
               <small class="text-small text-muted w-25">IVA de 23% incluído</small><br>
               
                
              
               <strong>Método de Pagamento:&nbsp;</strong><?php echo($row["metodopagamento"]);?> <br>
               <strong>Estado Atual: &nbsp;</strong><?php echo($row["estadoencomenda"]);?> <br>
               <div class="row">
               </div>
               <?php if($row['metodopagamento'] == "MBWAY") {?>
                
                <i class="fas fa-mobile-alt fa-sm"></i>&nbsp;<strong>Nº Telemóvel MBWAY: </strong> <?php echo $detalhesPagamento[0]?>
                <br>
                <strong>Data Limite Pagamento </strong> <?php echo $detalhesPagamento[2]?>
                
               
               <?php }
               else if ($row['metodopagamento'] == "Multibanco") {?>
               
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
                </div>
                <div class="col-6 float-right">
                <pre>|&nbsp;<?php echo $detalhesPagamento[0]?></pre>
                <pre>|&nbsp;<?php echo $detalhesPagamento[1]?></pre>
                <pre>|&nbsp;<?php echo $detalhesPagamento[2]?>€</pre>  
                </div>
               
                </div>
                
              
                </div>
                <small class="text-small text-muted w-25 mt-5">A seguinte referência terá uma validade de X horas. Se a mesma caducar, terá de voltar a fazer uma nova encomenda e os seus produtos voltarão a estar em stock.</small>
             <?php  }
               else if($row['metodopagamento'] == "Payshop"){?>
               
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
                <pre>|&nbsp;<?php echo $detalhesPagamento[0]?></pre>
                <pre>|&nbsp;<?php echo $detalhesPagamento[1]?></pre>
                <pre>|&nbsp;<?php echo $detalhesPagamento[2]?></pre>  
                </div>
               
                </div>
                
              
                </div>
                <small class="text-small text-muted w-25 mt-5">A seguinte referência terá uma validade de X horas. Se a mesma caducar, terá de voltar a fazer uma nova encomenda e os seus produtos voltarão a estar em stock.</small>
            <?php $precototal+=1;   }
             
               ?>
         
               
               </form>
               
               <hr class="mt-2 mb-1">   
        </div>
        
        </div>
        <div class="col-md-12  text-right pr-3 mt-3">
                <a class="btn btn-warning" onclick="history.go(-1)">Voltar Atrás</a>
                </div>
    
               
        </div>
        </div>
        
    
    <?php }
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
                <div class="lead">
                    <h1 class="title">Ainda não tem encomendas.</h1>
                </div>
            </div>
        </div>
    </div>

    <?php
}

if($total_encomendas >1 && !isset($orderNumber)){
           
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
                        href='encomendas.php?pagina=<?php echo $pagina_anterior?>'>Anterior</a></li>
                <?php } else {
        ?>
                <li class='page-item disabled' style='display: block!important;'><a class='page-link'
                        href='encomendas.php?pagina=<?php echo $pagina_anterior?>'>Anterior</a></li>
                <?php
    }  

    //Apresentar o número de paginacão
    for ($i = 1; $i <= $num_pagina; $i++) 
    { ?>
                <li class='page-item'><a class='page-link'
                        href='encomendas.php?pagina=<?php echo $i ?>'><?php echo $i ?></a></li>
                <?php
    }

    if ($pagina_posterior <= $num_pagina) {  ?>
                <li class='page-item'><a class='page-link'
                        href='encomendas.php?pagina=<?php echo $pagina_posterior?>'>Posterior</a></li>
        </nav>
    </div>
    </div>
    <?php }else { ?>

    <li class='page-item disabled' style='display: block!important;'><a class='page-link'
            href='encomendas.php?pagina=<?php echo $pagina_posterior?>'>Posterior</a></li>
    </nav>
    </div>
    </div>
    <?php

    
    }
}
    
    
        $ligacao->close();
    ?>