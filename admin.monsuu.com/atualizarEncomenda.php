
<?php


include_once("ligacao.php");
session_start();


$id = $_GET['id'];
$pagina = $_GET['pagina'];
$string = "estado" . $id ;


$estado = $_POST[$string] ;

$sql = "UPDATE encomendas SET estadoencomenda= '$estado'WHERE id = $id;";  
    

if ($ligacao -> query ($sql) === TRUE){
    echo $sql;
        header("Location: encomendas.php?pagina=$pagina");
        //die();
}
else{
    echo "Erro: " . $sql . "<br>" . $ligacao -> error;
}
?>