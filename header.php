<?php
if(isset($_GET['pesquisa'])) {
    $valueSearchbar = $_GET['pesquisa'];
}
else if(isset($_POST['pesquisa'])) {
    $valueSearchbar = $_POST['pesquisa'];
}
else {
    $valueSearchbar = "";
}
?>

<nav class="navbar navbar-light fixed-top shadow-lg" id="navbar">

    <button class="navbar-toggler" type="button" onclick="openNav()">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mx-auto" href="index.php" style="left:2000px;">M O N S U U</a>

    <div class="nav-item dropdown mr-0 ml-0" style="" id="navbarIcons">
        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <span class="fas fa-user fa-lg"></span>

        </a>
        <?php if(!isset($_SESSION['userId']))
         {
        ?>
        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="registo.php"><i class="fas fa-user-plus fa-lg"></i> REGISTO</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt fa-lg"></i> LOG IN</a>
        </div>
        <?php }
        else{?>
        <div class="dropdown-menu dropdown-menu-right dropdown-user " aria-labelledby="navbarDropdown">
            <div class="container-">
                <strong class="text-center ml-4" style="font-size:large;">
                    <i class="fas fa-store mr-1"></i> Bem-vindo/a <span style="font-size:x-large;"
                        class="text-aqua"><?php echo($_SESSION['userNome']);?></span>
                </strong>

                <div class="dropdown-divider">

                </div>

                <a class="dropdown-item" href="minhaconta.php"><i class="fas fa-user fa-lg mr-2"></i>A MINHA CONTA</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="encomendas.php"><i class="fas fa-shipping-fast fa-md mr-2"></i>AS MINHAS
                    ENCOMENDAS</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="admin/logout.php"><i
                        class="fas fa-sign-out-alt fa-lg mr-2"></i>LOGOUT</a>
            </div>

        </div>

        <?php   }
        ?>

        
    </div>

    <div class="nav-item dropdown mr-0" style="top:12px; " id="navbarIcons">
        <a class="nav-link " href="#" id="navbardrop" data-toggle="dropdown" style="padding-right:0px!important;"><span
                class="fa fa-shopping-cart fa-lg"></span>
            <br><?php if(!isset($_SESSION['userId'])) {echo "0.00";} else {include "admin/encontraprecototal.php";} ?> €
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-cart align-middle" role="menu">

            <div class="container ">

                <div class="col text-center">
                    <hr>
                    <span class="h4 mt-3 mb-3 lead">Carrinho de Compras</span>
                    <hr>


                    <?php if(!isset($_SESSION['userId']))
         {?>


                    <strong class="mt-3">Inicie Sessão para adicionar produtos ao seu carrinho.</strong>
                    <hr>
                    <a href="login.php"><button type="button" class="btn btn-info btn-lg mt-2 mb-4 ">Iniciar Sessão<i
                                class="fas fa-sign-in-alt fa-lg ml-2"></i> </button></a>


                </div>
                <?php }
          else{
                
            include("admin/encontraprodutoscarrinho.php");
        
            if (isset($idAProcurar)) {
              
              ?>

                <div class="inner-cart" >
                    <?php
                         for ($i = 0; $i < count($idsEncontrados); $i++) {
                                    
                          $sql = "SELECT * FROM produtos WHERE id =".$idsEncontrados[$i]." AND listado = 1 LIMIT 1";
                       
                          $resultado_final = mysqli_query($ligacao, $sql);
                          $count=0;
                          
                         
                          $row = $resultado_final->fetch_assoc();
                        
                          include("admin/encontradesconto.php");
                         
                          $precototal+= $precofinal * $quantidadeID[$i];
                          ?>
                    <div class="row">
                        <div class="col-4 pr-0 "><a class="align-middle mr-3 ml-0"
                                href="detalhe.php?id=<?php echo ($row['id'])?>"><img
                                    src="images/produtos/<?php echo ($row['foto1'])?>" alt=""></a></div>
                        <div class="col-8">
                            <form
                                action="atualizarCarrinho.php?edit=1&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>"
                                method="POST">
                                <a href="detalhe.php?id=<?php echo ($row['id'])?>">
                                    <div>
                                        <h5 class="mb-1 text-left mr-1"><?php echo ($row['nome'])?></h5>
                                    </div>
                                </a>
                                <div class="text-muted small text-left"><?php echo ($row['ref'])?></div>
                                <div class="text-muted text-left ">Tamanho
                                    <?php if ($tamanhoID[$i]== "Unico") {echo "Único";} else {echo $tamanhoID[$i];}?>
                                </div>
                                <div class="text-left text-muted "> <?php echo(number_format($precofinal,2));?>€ <span
                                        style="float:right;"> <a
                                            href="atualizarCarrinho.php?edit=2&id=<?php echo $row['id'] ?>&tamanho=<?php echo $tamanhoID[$i]?>"><i
                                                class="fas fa-trash-alt  mr-2"></i></a> </span></div>
                                <div class="text-left text-muted ">Qtd: <input style="max-width:50px;"
                                        class="form-control-sm" type="number" min="0" name="quantidade"
                                        value="<?php echo($quantidadeID[$i])?>"><button><i
                                            class="fas fa-sync-alt  mr-1"></i></button></div>
                                <div class="text-left text-muted "> Preço Uni: <span
                                        class="float-right"><?php echo(number_format($precofinal,2));?>€ </span> </div>

                                <div class="text-left text-muted "> Preço Total: <span
                                        class="float-right"><?php echo(number_format($precofinal * $quantidadeID[$i],2));?>€
                                    </span> </div>


                        </div>
                        </form>
                    </div>
                    <hr>





                    <?php
                      
                      
                  }
                  
                  
                  ?>
                </div>
                <div class="row text-right mb-2">
                    <div class="col-12 text-right">

                        <strong>Valor Produtos:&nbsp;</strong><?php echo(number_format($precototal,2));?> €
                        <br>
                        <?php if($precototal >=50) {?>
                        <strong>Valor Portes:&nbsp;</strong> <span class="text-success">GRÁTIS</span>
                        <?php  }
                        else{
                        ?>


                        <strong>Valor Portes:&nbsp;</strong> <span class="text-sucess">3.99 €</span>
                        <br>
                        <small class="text-muted small">Portes gratuitos em compras superiores ou iguais a 50€</small>

                        <?php $precototal+= 3.99;  }?>
                    </div>

                    <div class="col-12 text-right">

                        <strong>Valor Total:&nbsp;</strong><?php echo(number_format($precototal,2));?> €
                    </div>

                </div>

                <div class="row text-center mt-2">
                    <div class="col text-center">
                        <a href="carrinho.php"><button type="button" class="btn btn-info mt-2 mb-5 ">Ver Carrinho <i
                                    class="fas fa-search fa-lg"></i> </button></a>
                    </div>

                </div>
            </div>
            <?php }?>




            <?php 
          
            
              if($totalprodutos>0) {
            ?>


            <?php  }
              
              else{?>

            <b class="mt-3 mb-3">Ainda não existem artigos no seu carrinho.</b>
            <hr>
            <a href="carrinho.php"><button type="button" class="btn btn-info btn-lg mt-1 mb-3 "><span
                        class="text-dark">Ver Carrinho </span><i class="fas fa-search fa-lg"></i> </button></a>
            <?php }}?>

        </div>

    </div>

    </div>
    </div>



    </div>

    <div class="col-12 text-center">
        <form action="resultadopesquisa.php" method="POST" class="search">
            <input type="text" name="pesquisa" type="search" class="form-control-sm mx-auto no-border mb-1"
                placeholder="O que procuras hoje?" id="mainSearchBar" value="<?php echo $valueSearchbar?>">
            <button type="submit" class="search"><i class="fas fa-search"></i></button>
        </form>
    </div>



</nav>










<div id="mySidebar" class="sidebar lead">


    <a href="javascript:void(0)" class="closebtn mb-5" onclick="closeNav()"
        style="border-bottom:none!important; margin-right:0;!important;">&times;</a>

    <a class="main hover text-white" href="produtos.php?novidades=1">
        NOVO
    </a>
    <a class="main" data-toggle="collapse" href="#collapseMulher" aria-expanded="false"
        aria-controls="collapseMulher">Mulher</a>
    <div class="collapse" id="collapseMulher">
        <a class="" href="produtos.php?produto=Casacos">
            Casacos
        </a>
        <a class="" href="produtos.php?produto=Fatos Treino">
            Fatos Treino
        </a>
        <a class="" href="produtos.php?produto=Camisas">
            Camisas
        </a>
        <a class="" href="produtos.php?produto=Malhas">
            Malhas
        </a>
        <a class="" href="produtos.php?produto=Calças">
            Calças/Jeans
        </a>
        <a class="" href="produtos.php?produto=Calções">
            Calções
        </a>
        <a class="" href="produtos.php?produto=Saias">
            Saias
        </a>
        <a class="" href="produtos.php?produto=Vestidos">
            Vestidos
        </a>
        <a class="" href="produtos.php?produto=Tops">
            Tops
        </a>
    </div>
    <a class="main" href="produtos.php?produto=Calçado">Calçado</a>
    <div class="collapse" id="collapseDummy">


    </div>
    <a class="main" data-toggle="collapse" href="#collapseAcessories" aria-expanded="false"
        aria-controls="collapseAcessories">Acessórios</a>

    <div class="collapse" id="collapseAcessories">
        <a class="" href="produtos.php?produto=Malas">
            Malas
        </a>
        <a class="" href="produtos.php?produto=Bijuteria">
            Bijuteria
        </a>

    </div>
    <a class="main" data-toggle="collapse" href="#collapseColecoes" aria-expanded="false"
        aria-controls="collapseColecoes">Coleções</a>
    <div class="collapse" id="collapseColecoes">
        <a class="" href="produtos.php?colecao=Comfy">
            Comfy Collection
        </a>

    </div>
    <a class="main" href="produtos.php?saldos=1">Saldos</a>
    <div class="collapse" id="collapseDummy">


    </div>








</div>