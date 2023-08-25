<?php

function verificaEncomendas() {
    include("ligacao.php");
date_default_timezone_set('Europe/Lisbon');

$sql = "SELECT * FROM pagamentosencomendas" ;
$resultado_pedido = mysqli_query($ligacao, $sql);


while ($row = mysqli_fetch_assoc($resultado_pedido)) {
   
    if($row['metodoPagamento'] == "Payshop") {
        $currentDate = date('d/m/Y', time());
    }
    else {
        $currentDate = date('d/m/Y H:i:s', time());
    }

    
    $limiteDate = $row['limitePagamento'];
    $orderNumber = $row['idEncomenda'];
    echo "Current Date " . $currentDate . " Limite Date " . $limiteDate . "<br>";
   if($currentDate > $limiteDate && $row['pago'] ==0) {
    echo 'A Encomenda '.$orderNumber.' expirou e não foi paga';
    $sqlDadosEncomenda = "SELECT * FROM encomendas WHERE idEncomenda LIKE '$orderNumber'";  
    $resultado_encomenda = mysqli_query($ligacao, $sqlDadosEncomenda);
    $row_encomenda = mysqli_fetch_assoc($resultado_encomenda);
    echo "<br> Estado atual na tabela encomendas: " . $row_encomenda['estadoencomenda'] ." <br>";
        if ($row_encomenda['estadoencomenda'] != "Cancelada") {
            $sqlEncomenda = "UPDATE encomendas SET estadoencomenda = 'Cancelada' WHERE idEncomenda LIKE '$orderNumber'";  
            
            if($ligacao -> query ($sqlEncomenda)) {
                
                echo("Encomenda ".$orderNumber. "atualizada para CANCELADA<br> ");
                
                //include("smtp.php");
                //orderCancelled($row_encomenda['nome'], $orderNumber, "Cancelada", $row_encomenda['email']);
                echo("Encomenda ".$orderNumber. " E-mail enviado ao cliente ".$row_encomenda['nome']." <br><br><br>");
            }
        }
        else {
            echo("Encomenda ".$orderNumber. " já se encontra CANCELADA<br> <br>");
        }
    } 
     else if ($row['pago'] ==1){
         echo("A Encomenda ".$orderNumber." foi paga <br><br><br>");
     }
     else if ($currentDate < $limiteDate && $row['pago'] ==0){
        echo("A Encomenda ".$orderNumber." não foi paga  mas ainda não expirou<br><br><br>");
    }
    
}
}
verificaEncomendas();
?>

