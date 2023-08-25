
<?php

if($_SESSION['admin'] != 1){
    header("Location: login.php");
  }
include_once("ligacao.php");
session_start();


$nome=$_POST['nome'];
$ref=$_POST['ref'];
$categoria=$_POST['categoria'];
$colecao=$_POST['colecao'];
$preco=$_POST['preco'];
$desconto=$_POST['desconto'];
$novidade=$_POST['novidade'];
$listado=$_POST['listado'];

$checkRoupa = (isset($_POST['checkRoupa'])) ? $_POST['checkRoupa'] : 0;
$checkCalcado = (isset($_POST['checkCalcado'])) ? $_POST['checkCalcado'] : 0;

$descricao=$_POST['descricao'];
$fichatecnica=$_POST['fichaTecnica'];

if($checkCalcado ==1) {
    $stock36=$_POST['stock36'];
    $stock37=$_POST['stock37'];
    $stock38=$_POST['stock38'];
    $stock39=$_POST['stock39'];
    $stock40=$_POST['stock40'];
    $stock41=$_POST['stock41'];
    $stock42=$_POST['stock42'];
    $stock43=$_POST['stock43'];
    //echo "Calçado" . $stock36,$stock37;
    $stock = array("36"=>$stock36,"37"=>$stock37,"38"=>$stock38, "39"=>$stock39, "40"=>$stock40, "41"=>$stock41, "42"=>$stock42, "43"=>$stock43);

 
    print_r($stock);
    
}
else if($checkRoupa ==1) {
    $stockUnico=$_POST['stockUnico'];
    $stockS=$_POST['stockS'];
    $stockM=$_POST['stockM'];
$stockL=$_POST['stockL'];
$stockXL=$_POST['stockXL'];
$stock = array("Unico" =>$stockUnico, "S" =>$stockS,"M" =>$stockM,"L" =>$stockL,"XL" =>$stockXL );
print_r($stock);
}

$jsonStock= json_encode($stock);
echo($jsonStock);

if(is_uploaded_file($_FILES['foto1']['tmp_name'])){
   
    $fileName= $ref . "-1.jpg";
    $targetFile = "../public_html/images/produtos/" . $fileName;
    $targetFile2 = "images/produtos/" . $fileName;
    echo $targetFile;
    if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $targetFile) && copy($targetFile, $targetFile2)) {
        $foto1 = "'".$fileName."'";
    }
    
}
else {
    $foto1 = "null";
}
if(is_uploaded_file($_FILES['foto2']['tmp_name'])){
    
    $fileName= $ref . "-2.jpg";
    $targetFile = "../public_html/images/produtos/" . $fileName;
    $targetFile2 = "images/produtos/" . $fileName;
    echo $targetFile;
    if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $targetFile) && copy($targetFile, $targetFile2)) {
        $foto2 = "'".$fileName."'";
    }
    
}
else {
    $foto2 = "null";
}
if(is_uploaded_file($_FILES['foto3']['tmp_name'])){
    
    $fileName= $ref . "-3.jpg";
    $targetFile = "../public_html/images/produtos/" . $fileName;
    $targetFile2 = "images/produtos/" . $fileName;
    echo $targetFile;
    
    if (move_uploaded_file($_FILES["foto3"]["tmp_name"], $targetFile) && copy($targetFile, $targetFile2)) {
        $foto3 = "'".$fileName."'";
    }
    
}
else {
    $foto3 = "null";
}
if(is_uploaded_file($_FILES['foto4']['tmp_name'])){
   
    $fileName= $ref . "-4.jpg";
    $targetFile = "../public_html/images/produtos/" . $fileName;
    $targetFile2 = "images/produtos/" . $fileName;
    echo $targetFile;
    
    if (move_uploaded_file($_FILES["foto4"]["tmp_name"], $targetFile) && copy($targetFile, $targetFile2)) {
        $foto4 = "'".$fileName."'";
    }
    
    
}
else {
    $foto4 = "null";
}

$sql = "INSERT INTO produtos 
        (nome,ref,categoria,colecao,descricao,fichaTecnica,
        stock, novidade,
        listado,preco,foto1,foto2,foto3,foto4) VALUES('$nome','$ref','$categoria','$colecao',
        '$descricao','$fichatecnica','$jsonStock', $novidade,$listado,$preco,$foto1,$foto2,$foto3,$foto4)";  
echo $sql;

if ($ligacao -> query ($sql) === TRUE){
    $sqlGetLastId= "SELECT MAX(id) FROM produtos";
    $resultID = mysqli_query($ligacao, $sqlGetLastId);
    $rowID = $resultID->fetch_assoc();
    $id = $rowID['MAX(id)'] +1;
    if($desconto !="0") {
        $sqlDesconto = "INSERT INTO promocoes VALUES ($id,$desconto);" ;
        $insertDesconto = mysqli_query($ligacao, $sqlDesconto);
    }
    
    $_SESSION['resultadoInserir'] = "<div class='alert alert-success' role='alert'>Produto inserido com sucesso.</div>";
    header("location:inserir.php");
    
}


       

?>

