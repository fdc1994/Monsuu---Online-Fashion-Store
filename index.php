<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
    <?php 
    if(!isset($_COOKIE["visit"])) {
      //Firefox
      setcookie("visit", "visited", time() + 3600, "", "", 1); // 3600 = 1 hour
    }
    if(!isset($_COOKIE["visit"])) {
      //Chrome
      setcookie("visit", "visited", time() + 3600); // 3600 = 1 hour
    }
    if(!isset($_COOKIE["distinctVisitor"])) {
      //Firefox
        setcookie("distinctVisitor", "new", time() + 21600, "", "", 1); // 21600 = 6 hours
        include("admin/newVisitor.php");
    }
    if(!isset($_COOKIE["distinctVisitor"])) {
      //chrome
      setcookie("distinctVisitor", "new", time() + 21600, ); // 21600 = 6 hours
      include("admin/newVisitor.php");
  }
    
    include_once("admin/ligacao.php");
    session_start();?>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />
    <title>Monsuu | Fashion Store</title>
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    
    <?php 
      if(!isset($_COOKIE["visit"])) {
        ?>
    <link rel="stylesheet" href="css/styleIndex.css">
    <?php 
      }
      else{
        ?>
    <link rel="stylesheet" href="css/styleReg.css">
    <?php 
      }
  ?>
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

<body onload="init()">


    <?php include ("header.php");?>
    

<div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="notice d-flex justify-content-between align-items-center">
          <div class="cookie-text">Este site utiliza Cookies para monitorizar o tráfego e melhorar a sua experiência.</div>
          <div class="buttons d-flex flex-column flex-lg-row">
          <form action="index.php" method="post"></form>
            <a href="#a" class="btn btn-success mr-2" data-dismiss="modal" onclick="setCookie('acceptCookies','yes',1)">Eu aceito</a>
            <a href="rgpd.php" class="btn btn-secondary p-1" data-dismiss="modal">Saber Mais</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    <div class="container container-logo mb-0">
        M O N S U U

    </div>
 
    <div class="container-small mt-0">
        <hr class="main">Fashion Store
    </div>


    <div class="jumbotron text-center mb-0" id="container1">
    <strong>
            <h1 class="display-3 text-white text-stroke">Comfy Collection</h1>
        </strong>

        <p class="lead ">
        <h1>A coleção mais fofa e quente deste Inverno!</h1>
        </p>
        <hr class="">
       

        <p>
            <img src="images/cozycollection.png" class="w-25" alt="">
        </p>
        <p class="lead hoverslow display-3">
            <strong>É Como flutuar numa <span style="color:white;">nuvem!</span> </strong>
        </p>
        <hr class="">
        
        <a class="btn btn-info btn-lg mt-0" href="produtos.php?colecao=Comfy" role="button">Ver Produtos</a>




    </div>
    </div>


    <?php include "footer.php";?>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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

</body>

</html>