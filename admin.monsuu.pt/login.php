
<!doctype html>
<html lang="en">
<head>
<?php
if(isset($_SESSION['admin'])){
  header("Location: index.php");
}
$redirect = (isset($_GET['redirect'])) ? $_GET['redirect'] : 0;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
   include_once("ligacao.php");
    session_start();?>
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
  <body>
  
  <?php include('header.php'); ?>

<div class="jumbotron jumbotron-fluid text-center mt-5 mb-0" >

  <div class="container mt-0 mb-0">
    <h1 class="display-4 lead mb-5"> <strong>Administração</strong></h1>
  
  
      <div class="row text-center mt-0 mb-0">
        <div class="col-12"><?php
                if (isset($_SESSION['logout'])){
                    echo $_SESSION['logout'];
                    unset($_SESSION['logout']);
                             }
                if (isset($_SESSION['Erro'])){
                    echo $_SESSION['Erro'];
                    unset($_SESSION['Erro']);
                             }
                if (isset($_SESSION['Registo'])){
                echo $_SESSION['Registo'];
                unset($_SESSION['Registo']);
                          }
                          if (isset($_SESSION['resultadoPedido'])){
                            echo $_SESSION['resultadoPedido'];
                            unset($_SESSION['resultadoPedido']);
                                      }
                             ?>
        </div>
      </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
              <form class="" action="validarlogin.php?redirect=<?php echo $redirect?>&id=<?php echo $id?>" method="POST">
                <div class="form-group">
                  <h1 class=""><label>Email</label></h2>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>  
                </div>
                <div class="form-group">
                <h1 class=""><label>Password</label></h2>
                    <input type="password" name="passwd" class="form-control" id="exampleInputPassword1" required>
                    <small id="emailHelp" class="form-text ">Nunca partilhe a sua palavra-passe com ninguém.</small>
                    
                </div>
              
            </div>
            <div class="col-2"></div>
            <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-info text-center text-white col-6">Confirmar</button>
                    <p class="text-center mt-2 form-text text-info"> <a  href="recuperarpassword.php">Esqueceu-se da sua Password?</a> 
                    </p>
                    </form>
            </div>

           
        </div>
    </div>                        
    </div>
  <?php include'footer.php'; ?>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="scripts/jsCustomHeader.js"></script>
  <script src="scripts/pageTriggerLoad.js"></script>
  </body>
  </html>