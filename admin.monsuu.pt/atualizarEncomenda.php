
<?php


include_once("ligacao.php");
session_start();


$id = $_GET['id'];
$pagina = $_GET['pagina'];
$string = "estado" . $id ;


$estado = $_POST[$string] ;

$sql = "UPDATE encomendas SET estadoencomenda= '$estado'WHERE id = $id;";  
    echo $estado;

if ($ligacao -> query ($sql) === TRUE){
    echo $sql;
        
        $sqlDadosEncomenda = "SELECT * FROM encomendas WHERE id = $id";  
    $resultado_encomenda = mysqli_query($ligacao, $sqlDadosEncomenda);
    $row_encomenda = mysqli_fetch_assoc($resultado_encomenda);
        
        if($estado != "Cancelada") {
            echo("A enviar email atualização ");
            include("smtp.php");
            orderUpdate($row_encomenda['nome'],$row_encomenda['idEncomenda'] , $estado, $row_encomenda['email']);
        }
        else{
            echo("A enviar email atualização Cancelada ");
            include("smtp.php");
            orderCancelled($row_encomenda['nome'], $row_encomenda['idEncomenda'], $estado, $row_encomenda['email']);
        }
        header("Location: encomendas.php?pagina=$pagina");
        //die();
}
else{
    echo "Erro: " . $sql . "<br>" . $ligacao -> error;
}
?>