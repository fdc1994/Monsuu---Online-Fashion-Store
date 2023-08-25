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
    <a class="navbar-brand " href="index.php" style="left:1900px;">M O N S U U</a>
    <a class="navbar-admin mr-2" href="index.php" >Admin</a>
    

    <div class="col-12 text-center">
        <form action="resultadopesquisa.php" method="POST" class="search">
            <input type="text" name="pesquisa" type="search" class="form-control-sm mx-auto no-border mb-1"
                placeholder="Procurar Produtos" id="mainSearchBar" value="<?php echo $valueSearchbar?>">
            <button type="submit" class="search"><i class="fas fa-search"></i></button>
        </form>
    </div>



</nav>










<div id="mySidebar" class="sidebar lead">


    <a href="javascript:void(0)" class="closebtn mb-5" onclick="closeNav()"
        style="border-bottom:none!important; margin-right:0;!important;">&times;</a>
        
    <a class="main" data-toggle="collapse" href="#collapseProdutos" aria-expanded="false" aria-controls="collapseProdutos">Produtos</a>
    <div class="collapse" id="collapseProdutos">
        <a class="" href="index.php">
            Ver Produtos
        </a>
        <a class="" href="inserir.php">
            Inserir Produtos
        </a>
    </div>
    <a class="main" href="encomendas.php">Encomendas</a>
    <a class="main" href="encomendas.php">Pedidos De Contacto</a>
    
    
    
    
    

    


</div>