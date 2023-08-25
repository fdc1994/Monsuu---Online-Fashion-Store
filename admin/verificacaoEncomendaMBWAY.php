<?php

function verificaEncomendaMBWAY($orderNumber) {
    include("ligacao.php");
date_default_timezone_set('Europe/Lisbon');

$sql = "SELECT * FROM pagamentosencomendas WHERE idEncomenda LIKE '$orderNumber'" ;
$resultado_pedido = mysqli_query($ligacao, $sql);
$row = mysqli_fetch_assoc($resultado_pedido);


if(isset($row)) {
    
    $currentDate = date('d/m/Y H:i:s', time());
    $limiteDate = $row['limitePagamento'];
    
   if($currentDate > $limiteDate && $row['pago'] ==0) {
    $sqlEncomenda = "UPDATE encomendas SET estadoencomenda = 'Cancelada' WHERE idEncomenda LIKE '$orderNumber'";  
    echo 'A Encomenda expirou e não foi paga';
    if($ligacao -> query ($sqlEncomenda)) {
        
        echo("Encomenda atualizada para CANCELADA");
        $sqlEncomenda = "SELECT * FROM encomendas WHERE idEncomenda LIKE '$orderNumber'";  
        $resultado_pedido = mysqli_query($ligacao, $sqlDadosUser);
        $row = mysqli_fetch_assoc($resultado_pedido);
        //include("smtp.php");
        //orderCancelled($row['nome'], $orderNumber, "Cancelada", $row['email']);
    }
    
     } 
     else if ($currentDate > $limiteDate && $row['pago'] ==1){
         echo("A Encomenda foi paga");
     }
    
}



}
verificaEncomendaMBWAY("MS2102");
?>

