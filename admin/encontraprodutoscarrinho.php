<?php 

include("ligacao.php");

$userId = $_SESSION['userId'];


$idsEncontrados = array();
$tamanho = null;
$tamanhoID = array();
$quantidadeID = array();
$sqlEncontra = "SELECT * FROM carrinhocompras WHERE idUtilizador =$userId";
$resultadoCarrinho = $ligacao->query($sqlEncontra);
$precototal=0;
$totalprodutos =0;

if ($resultadoCarrinho->num_rows > 0) {
 
    $i = 0;
    while ($rowCarrinho = $resultadoCarrinho->fetch_assoc()) {
       
        $tamanho = $rowCarrinho['tamanho'];
        
        $idsEncontrados[$i] = $rowCarrinho['idProduto'];
        $tamanhoID[$i] = $tamanho;
        $quantidadeID[$i] = $rowCarrinho['quantidade'];
        $totalprodutos += $quantidadeID[$i];
        $i++;
    }
}


if($totalprodutos>0) {
    if($totalprodutos == 1){
        $idAProcurar = implode("", array_values($idsEncontrados));
    }
    else{
        $idAProcurar = implode(",", array_values($idsEncontrados));
    }
}



?>