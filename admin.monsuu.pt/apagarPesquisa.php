<?php

include("stylesheets.php");
   include_once("ligacao.php");

   $id=$_GET['id'];
$pagina=$_GET['pagina'];
$orderBy=$_GET['orderBy'];
$id = $_GET['id'];

if(!isset($id)) {
    header("Location: Index.php");
}

$sql = "DELETE FROM produtos 
    WHERE id = $id;";   

    $sqlPromocoes ="DELETE FROM promocoes WHERE id = $id;";

if ($ligacao -> query ($sql) === TRUE && $ligacao -> query ($sqlPromocoes) === TRUE) {
    $_SESSION['resultadoEditar'] = "<div class='alert alert-success' role='alert'>Produto apagado com sucesso.<br>Encomendas que contenham este produto poderão aparecer desformatadas.</div>";
    header("location:resultadopesquisa.php?pagina=$pagina&orderBy=$orderBy&pesquisa=$pesquisa");
    die();
} 
else {
    echo "Erro: " . $sql . "<br>" . $ligacao -> error;
}


?>