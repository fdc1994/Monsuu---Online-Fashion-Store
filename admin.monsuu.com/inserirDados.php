
<?php


include_once("ligacao.php");
session_start();

$id=$_GET['id'];
$pagina=$_GET['pagina'];
$nome=$_POST['nome'];
$ref=$_POST['ref'];
$categoria=$_POST['categoria'];
$colecao=$_POST['colecao'];
$preco=$_POST['preco'];
$desconto=$_POST['desconto'];
$novidade=$_POST['novidade'];
$listado=$_POST['listado'];
$stockUnico=$_POST['stockUnico'];
$stockS=$_POST['stockS'];
$stockM=$_POST['stockM'];
$stockL=$_POST['stockL'];
$stockXL=$_POST['stockXL'];
$descricao=$_POST['descricao'];
$fichatecnica=$_POST['fichaTecnica'];

if($stockUnico == "") {
    $stockUnico = "null";
}
if($stockS == "") {
    $stockS = "null";
}
if($stockM == "") {
    $stockM = "null";
}
if($stockL == "") {
    $stockL = "null";
}
if($stockXL == "") {
    $stockXL = "null";
}
if(is_uploaded_file($_FILES['foto1']['tmp_name'])){
   
    $fileName= $ref . "-1.jpg";
    $targetFile = "../images/produtos/" . $fileName;
    echo $targetFile;
    if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $targetFile)) {
        $foto1 = "'".$fileName."'";
    }
    
}
else {
    $foto1 = "null";
}
if(is_uploaded_file($_FILES['foto2']['tmp_name'])){
    
    $fileName= $ref . "-2.jpg";
    $targetFile = "../images/produtos/" . $fileName;
    echo $targetFile;
    if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $targetFile)) {
        $foto2 = "'".$fileName."'";
    }
    
}
else {
    $foto2 = "null";
}
if(is_uploaded_file($_FILES['foto3']['tmp_name'])){
    
    $fileName= $ref . "-3.jpg";
    $targetFile = "../images/produtos/" . $fileName;
    echo $targetFile;
    
    if (move_uploaded_file($_FILES["foto3"]["tmp_name"], $targetFile)) {
        $foto3 = "'".$fileName."'";
    }
    
}
else {
    $foto3 = "null";
}
if(is_uploaded_file($_FILES['foto4']['tmp_name'])){
   
    $fileName= $ref . "-4.jpg";
    $targetFile = "../images/produtos/" . $fileName;
    echo $targetFile;
    
    if (move_uploaded_file($_FILES["foto4"]["tmp_name"], $targetFile)) {
        $foto4 = "'".$fileName."'";
    }
    
}
else {
    $foto4 = "null";
}

$sql = "INSERT INTO produtos 
        (nome,ref,categoria,colecao,descricao,fichaTecnica,
        stockUnico,stockS,stockM,stockL,stockXl,novidade,
        listado,preco,foto1,foto2,foto3,foto4) VALUES('$nome','$ref','$categoria','$colecao',
        '$descricao','$fichatecnica',$stockUnico,$stockS,
        $stockM,$stockL,$stockXL,$novidade,$listado,$preco,$foto1,$foto2,$foto3,$foto4)";  
echo $sql;

if ($ligacao -> query ($sql) === TRUE){
    $sqlGetLastId= "SELECT MAX(id) FROM produtos";
    $resultID = mysqli_query($ligacao, $sqlGetLastId);
    $rowID = $resultID->fetch_assoc();
    $id = $rowID['MAX(id)'] +1;
    if($desconto !="0" || $desconto != 0 || $desconto != "") {
        $sqlDesconto = "INSERT INTO promocoes VALUES ($id,$desconto);" ;
        $insertDesconto = mysqli_query($ligacao, $sqlDesconto);
    }
    
    $_SESSION['resultadoInserir'] = "<div class='alert alert-success' role='alert'>Produto inserido com sucesso.</div>";
    header("location:inserir.php");
    
}


       

?>

