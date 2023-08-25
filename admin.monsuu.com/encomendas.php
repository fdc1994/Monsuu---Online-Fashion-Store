
<!DOCTYPE html>
<html lang="en">
<?php
   include_once("ligacao.php");
    session_start();?>

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsuu | Administração</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/styleReg.css">
    <link rel="stylesheet" href="css/styleResponsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<div class="disabled" id="loader">
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
    <div class="sk-chase-dot"></div>
</div>
<body>
<?php
include 'header.php';

?>


<div class="jumbotron col-12 mt-5 mb-0">
<h1 class="display-4 lead text-center">Encomendas <i class="fas fa-dolly"></i></h1>
           <p class="lead text-center">Aqui poderá verificar o estado e detalhes das suas encomendas</p>   




<?php
include 'paginacao/paginacaoEncomendas.php';
include 'footer.php';
?>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="scripts/jsCustomHeader.js"></script>
    <script src="scripts/pageTriggerLoad.js"></script>
    <script src="scripts/searchOrder.js"></script>
    <script src="scripts/pageTriggerLoad.js"></script>
</body>

</html>