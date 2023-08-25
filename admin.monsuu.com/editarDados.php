
<?php


include_once("ligacao.php");
session_start();

$id=$_GET['id'];
$pagina=$_GET['pagina'];
$orderBy=$_GET['orderBy'];
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

$sql = "UPDATE produtos 

        SET nome='$nome', 
        ref='$ref',
        categoria='$categoria',
        colecao='$colecao',
        descricao='$descricao',
        fichaTecnica='$fichatecnica',
        stockUnico=$stockUnico,
        stockS=$stockS,
        stockM=$stockM,
        stockL=$stockL,
        stockXL=$stockXL,
        novidade=$novidade,
        listado=$listado,
        preco=$preco
        WHERE id = $id;";  
//echo $sql;

if ($ligacao -> query ($sql) === TRUE){
    $sqlTemDesconto = "SELECT * FROM promocoes WHERE id = $id;";  

    $resultDesconto = $ligacao->query($sqlTemDesconto);
    if ($resultDesconto-> num_rows >0) {
        
        if($desconto !="0" || $desconto != 0) {
            $sqlDesconto = "UPDATE promocoes 

            SET desconto='$desconto'
            WHERE id = $id;"; 
            echo("desconto Atualizado com sucesso");
        }
        else if ($desconto == "0" && $desconto ==0){
            echo("o Desconto vai ser apagado da tabela");
            $sqlDesconto = "DELETE FROM promocoes 
            WHERE id = $id;"; 
        }  
    }
    else{
        $sqlDesconto = "INSERT INTO promocoes VALUES ($id,$desconto);" ;
        echo("desconto inserido com sucesso");
    }
    if ($ligacao -> query ($sqlDesconto) === TRUE){
        echo($sqlDesconto);
        

        
        if(is_uploaded_file($_FILES['foto1']['tmp_name'])){
            $foto=basename($_FILES["foto1"]["name"]);
            //echo$foto;
            $fileName= $ref . "-1.jpg";
            $targetFile = "../images/produtos/" . $fileName;
            //echo $targetFile;
            if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $targetFile)) {
                echo("foto inserida com sucesso");
                $sqlUpdatePhotoPath = "UPDATE produtos 
                SET foto1 = '$fileName'
                WHERE id = $id;";  
                if ($ligacao -> query ($sqlUpdatePhotoPath) === TRUE) {
                    echo("caminho da foto 1 atualizado com sucesso");
                }
            }
        }
        if(is_uploaded_file($_FILES['foto2']['tmp_name'])){
            $foto=basename($_FILES["foto2"]["name"]);
            //echo$foto;
            $fileName= $ref . "-2.jpg";
            $targetFile = "../images/produtos/" . $fileName;
            //echo $targetFile;
            if (move_uploaded_file($_FILES["foto2"]["tmp_name"], $targetFile)) {
                echo("foto inserida com sucesso");
                $sqlUpdatePhotoPath = "UPDATE produtos 
                SET foto2 = '$fileName'
                WHERE id = $id;";  
                if ($ligacao -> query ($sqlUpdatePhotoPath) === TRUE) {
                    echo("caminho da foto 2 atualizado com sucesso");
                }
            }
        }
        if(is_uploaded_file($_FILES['foto3']['tmp_name'])){
            $foto=basename($_FILES["foto3"]["name"]);
            //echo$foto;
            $fileName= $ref . "-3.jpg";
            $targetFile = "../images/produtos/" . $fileName;
            //echo $targetFile;
            if (move_uploaded_file($_FILES["foto3"]["tmp_name"], $targetFile)) {
                echo("foto inserida com sucesso");
                $sqlUpdatePhotoPath = "UPDATE produtos 
                SET foto3 = '$fileName'
                WHERE id = $id;";  
                if ($ligacao -> query ($sqlUpdatePhotoPath) === TRUE) {
                    echo("caminho da foto 3 atualizado com sucesso");
                }
            }
        }
        if(is_uploaded_file($_FILES['foto4']['tmp_name'])){
            $foto=basename($_FILES["foto4"]["name"]);
            //echo$foto;
            $fileName= $ref . "-4.jpg";
            $targetFile = "../images/produtos/" . $fileName;
            //echo $targetFile;
            if (move_uploaded_file($_FILES["foto4"]["tmp_name"], $targetFile)) {
                echo("foto inserida com sucesso");
                $sqlUpdatePhotoPath = "UPDATE produtos 
                SET foto4 = '$fileName'
                WHERE id = $id;";  
                if ($ligacao -> query ($sqlUpdatePhotoPath) === TRUE) {
                    echo("caminho da foto 4 atualizado com sucesso");
                }
            }
        }
        $_SESSION['resultadoEditar'] = "<div class='alert alert-success' role='alert'>Produto editado com sucesso.</div>";
        header("location:index.php?pagina=$pagina&orderBy=$orderBy");
    }
    else{
        echo"<br><br>". "Erro: " . $sql . "<br>" . $ligacao -> error;
    }
    
}
else{
    echo"<br><br>". "Erro: " . $sql . "<br>" . $ligacao -> error;
}

?>

