<!doctype html>
<html lang="en">

<head>
    <?php
   include_once("admin/ligacao.php");
    session_start();    
    ?>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsuu | Fashion Store</title>

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

    <?php include('header.php'); 
  
        $hash = (isset($_GET['hash'])) ? $_GET['hash'] : null;
        $email = (isset($_GET['email'])) ? $_GET['email'] : null;

        if(!isset($hash)) {

        
  ?>

    <div class="jumbotron jumbotron-fluid text-center mt-5 mb-0">
        <div class="container ">
            <h1 class="display-4 lead">RECUPERAÇÃO DE PASSWORD</h1>
            <p class="lead">Por favor introduza o endereço de email associado à sua conta.</p>
            <p class="lead">Caso ainda não disponha de uma conta, poderá criar uma <a href="registo.php">aqui.</a></p>
        </div>
    

    <div class="container ">
        <div class="row text-center">
            <div class="col-12"><?php
                if (isset($_SESSION['resultadoPedido'])){
                    echo $_SESSION['resultadoPedido'];
                    unset($_SESSION['resultadoPedido']);
                             }
                             ?>
            </div>
        </div>
        <div class="row">

            <div class="col-3">
            </div>
            <div class="col-6">
                <form class="" action="admin/validarRecuperarPassword.php" method="POST">
                    <div class="form-group">
                        <h2><label>Email</label></h2>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>

                    </div>

                    <button type="submit" class="btn btn-primary col-12">Confirmar</button>



                </form>
            </div>

            <div class="col-3">
            </div>

        </div>
    </div>

    <?php 
    }
    else {
        $sqlHash = "SELECT * FROM recuperarpassword WHERE email LIKE '$email' and valido = 1" ;
    $resultado_hash = mysqli_query($ligacao, $sqlHash);
    $resultado = mysqli_fetch_assoc($resultado_hash);
    if($resultado['hashsafe'] ==$hash && $resultado['email'] == $email) {

    
    ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <h1 class="display-4 lead">RECUPERAÇÃO DE PASSWORD</h1>
        <p class="lead">Por favor introduza a sua nova Password</p>
    </div>
    <div class="container">

        <div class="row text-center">
            <div class="col-12"><?php
                if (isset($_SESSION['resultadoPedido'])){
                    echo $_SESSION['resultadoPedido'];
                    unset($_SESSION['resultadoPedido']);
                             }
                             ?>
            </div>
        </div>
        <form class="needs-validation"
            action="atualizarConta.php?edit=3&email=<?php echo $email?>&hash=<?php echo $hash?>" method="POST">
            <div class="form-row">

                <div class="col-3"></div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Nova Password</label>
                    <input type="password" class="form-control" id="inputZip" name="passwordNova" required>
                </div>
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="form-group col-md-6 ">
                    <label for="inputCity">Confirmação Password Nova</label>
                    <input type="password" class="form-control" id="inputZip" name="passwordConf" required>
                </div>
                <div class="col-3 "></div>
                <div class="col-md-12 mt-3 text-center"> <a
                        href="atualizarconta.php?hash=<?php$hash?>&email=<?php$email?>"><button type="submit"
                            class="btn btn-secondary btn-lg">Editar Password<i
                                class="fas fa-user-lock fa-lg ml-2"></i></button></a></div>
            </div>
    </div>
    </form>
    </div>
    </div>
    <?php }
    else{?>
    <div class="jumbotron jumbotron-fluid text-center mb-2">
        <div class="container ">
            <h1 class="display-4 lead">RECUPERAÇÃO DE PASSWORD</h1>
            <p class="lead">Link Inválido</p>

        </div>
    </div>
    <div class="col-12"><?php
              echo("<div class='alert alert-warning text-center' role='alert'>Este link não é valido. Por favor solicite um <a href='recuperarpassword.php'>novo pedido de password</a></div>");
              unset($_SESSION['resultadoPedido']);
                             ?>
    </div>
    <?php
        }

}?>
</div>
    <?php include'footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="scripts/jsCustomHeader.js"></script>

  <script src="scripts/pageTriggerLoad.js"></script>
</body>

</html>