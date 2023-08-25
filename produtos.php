<!DOCTYPE html>
<html lang="en">

<head>
<?php 
   include_once("admin/ligacao.php");
    session_start();
     
    $produto = (isset($_GET['produto'])) ? $_GET['produto'] : null;
    $colecao = (isset($_GET['colecao'])) ? $_GET['colecao'] : null;
    $novidades = (isset($_GET['novidades'])) ? $_GET['novidades'] : null;
    $saldos = (isset($_GET['saldos'])) ? $_GET['saldos'] : null;
    if($produto == "") {
      unset($produto);
    }
    if($colecao == "") {
      unset($colecao);
    }
    if($novidades == "") {
      unset($novidades);
    }
    if($saldos == "") {
      unset($saldos);
    }
    
   if(!isset($produto) && !isset($colecao) && !isset($novidades) && !isset($saldos)) {
    header("Location:index.php");
   }
    
  
    ?>
    
    
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsuu | Fashion Store</title>
        <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <link rel="stylesheet" href="css/styleReg.css">
    <link rel="stylesheet" href="css/styleResponsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<div class="disabled" id="loader">
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
</div>

<body >
  
<?php include "header.php";?>
  

  <div class="jumbotron text-center mb-0 mt-5 main" >
  
  <p class="lead display-3 mb-5">
    <?php
  
    
    if(isset($produto)) {
      $titulo = $produto;
  }
  else if(isset($colecao)) {
    $titulo = $colecao;
  }
  else if(isset($novidades)) {
    $titulo = "Novidades";
  }
  else if(isset($saldos)) {
    $titulo = "Saldos";
  }
    ?>
    
    
    <?php
   echo($titulo)
   ?>
 
   
  </p>

  
  <hr class="">
  
  <?php 
include "paginacao/paginacaoProdutos.php";?>
 
 

</div>
</div>


<?php 


include "footer.php";?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="scripts/jsCustomHeader.js"></script>

  <script src="scripts/pageTriggerLoad.js"></script>


</body>

</html>