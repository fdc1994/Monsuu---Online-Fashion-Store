<!doctype html>
<html lang="en">
<head>
<?php 
   include_once("admin/ligacao.php");
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
  
  <?php 
  if(!isset($_SESSION['userId'])) {
 
    header("Location: login.php");
  }
  include 'header.php';

  $userId = $_SESSION['userId'];
  $edit = (isset($_GET['edit'])) ? $_GET['edit'] : null;
 
  ?>

<div class="jumbotron jumbotron-fluid text-center mt-5 mb-0" >
    <h1 class="display-3 lead">Área de Cliente</h1>
    <p class="lead">Aqui poderá verificar os seus dados e gerir as informações da sua conta.</p>
  </div>
 
</div>
    <div class="container container-main mb-0 mt-0">
    <div class="col-12"><?php
                if (isset($_SESSION['MinhaConta'])){
                echo $_SESSION['MinhaConta'];
                unset($_SESSION['MinhaConta']);
                          }
                             ?>
                             </div>
  
            <div class="col-md-12 text-right mr-0 mt-0 text-white">
            <a class="btn btn-primary" onclick="history.go(-1)">Voltar Atrás</a>
            </div>
     
        <div class="row mt-0">
            <div class="col-1">
            </div>
             <div class="col-10">
             <?php 
             if(isset($edit)){
               if($edit=="1") {
               ?>
             <form class="needs-validation" action="admin/atualizarConta.php?edit=1" method="POST">
             <div class="form-row">
                  <div class="form-group col-md-4">
                  <label for="inputName">Nome</label>
                  <input type="text" value="<?php echo $_SESSION['userNome']?>" class="form-control" id="validationCustom01" placeholder="Nome" value="" name="nome" required>
                  </div>
                  <div class="form-group col-md-4">
                  <label for="inputSurname">Apelido</label>
                  <input type="text" value="<?php echo $_SESSION['userApelido']?>" class="form-control" id="validationCustom01" placeholder="Apelido" value="" name="apelido" required>
                  </div>
                  <div class="form-group col-md-4">
                  <label for="inputSurname">Telefone</label>
                  <input type="tel" value="<?php echo $_SESSION['userTelefone']?>" class="form-control" id="validationCustom01" placeholder="" name="telefone" pattern="[1-9]{2}[0-9]{7}" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Distrito</label>
                      <select id="inputState" class="form-control" name="distrito" value="<?php echo $_SESSION['userDistrito']?>" required>
                        <option value="Aveiro" <?php if($_SESSION['userDistrito'] == "Aveiro") {echo("selected");}?>>Aveiro</option>
                        <option value="Beja" <?php if($_SESSION['userDistrito'] == "Beja") {echo("selected");}?>>Beja</option>
                        <option value="Braga" <?php if($_SESSION['userDistrito'] == "Braga") {echo("selected");}?>>Braga</option>
                        <option value="Braganca" <?php if($_SESSION['userDistrito'] == "Bragança") {echo("selected");}?>>Bragança</option>
                        <option value="Castelo_branco" <?php if($_SESSION['userDistrito'] == "Castelo Branco") {echo("selected");}?>>Castelo Branco</option>
                        <option value="Coimbra" <?php if($_SESSION['userDistrito'] == "Coimba") {echo("selected");}?>>Coimbra</option>
                        <option value="Evora" <?php if($_SESSION['userDistrito'] == "Évora") {echo("selected");}?>>Évora</option>
                        <option value="Faro"<?php if($_SESSION['userDistrito'] == "Faro") {echo("selected");}?>>Faro</option>
                        <option value="Guarda"<?php if($_SESSION['userDistrito'] == "Guarda") {echo("selected");}?>>Guarda</option>
                        <option value="Leiria"<?php if($_SESSION['userDistrito'] == "Leiria") {echo("selected");}?>>Leiria</option>
                        <option value="Lisboa"<?php if($_SESSION['userDistrito'] == "Lisboa") {echo("selected");}?>>Lisboa</option>
                        <option value="Portalegre"<?php if($_SESSION['userDistrito'] == "Portalegre") {echo("selected");}?>>Portalegre</option>
                        <option value="Porto" <?php if($_SESSION['userDistrito'] == "Porto") {echo("selected");}?>>Porto</option>
                        <option value="Santarem"<?php if($_SESSION['userDistrito'] == "Santarem") {echo("selected");}?>>Santarém</option>
                        <option value="Setubal"<?php if($_SESSION['userDistrito'] == "Setubal") {echo("selected");}?>>Setúbal</option>
                        <option value="Viana Do Castelo"<?php if($_SESSION['userDistrito'] == "Viana Do Castelo") {echo("selected");}?>>Viana do Castelo</option>
                        <option value="Vila Real"<?php if($_SESSION['userDistrito'] == "Vila Real") {echo("selected");}?>>Vila Real</option>
                        <option value="Viseu"<?php if($_SESSION['userDistrito'] == "Viseu") {echo("selected");}?>>Viseu</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputCity">Cidade</label>
                    <input type="text"  value="<?php echo $_SESSION['userCidade']?>" class="form-control" id="inputCity" name="cidade" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputCity">Código Postal</label>
                    <input type="text" value="<?php echo $_SESSION['userCpostal']?>" class="form-control" id="inputZip" name="codigopostal" required>
                  </div>
                  <div class="col-3"></div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Morada</label>
                  <textarea type="text" class="form-control" id="inputAddress" name="morada" placeholder="Avenida da Liberdade 427 1º Direito..." required><?php echo($_SESSION['userMorada']);?></textarea>
                </div>
                
                </div>
                    <div class="col-md-12 text-center"> <a href=""><button type="submit" class="btn btn-primary btn-lg" >Editar Informação<i class="fas fa-user-edit fa-lg ml-2"></i></button></a></div>
                
                </div>
              </form>
<?php
              }
              else{?>
                  <form class="needs-validation mt-0" action="admin/atualizarConta.php?edit=2" method="POST">
             <div class="form-row">
              <div class="col-4"></div>
             <div class="form-group col-md-4">
                    <label for="inputCity">Password Atual</label>
                    <input type="password" class="form-control" id="inputZip" name="passwordAtual" required>
                </div>
                <div class="col-4"></div>
                <div class="col-4"></div>
              <div class="form-group col-md-4">
                <label for="inputCity">Nova Password</label>
                <input type="password" class="form-control" id="inputZip" name="passwordNova" required>
              </div>
              <div class="col-4"></div>
              <div class="col-4"></div>
              <div class="form-group col-md-4 ">
                    <label for="inputCity">Confirmação Password Nova</label>
                    <input type="password" class="form-control" id="inputZip" name="passwordConf" required>
                  </div>
                  <div class="col-4 "></div>
              <div class="col-md-12 mt-3 text-center"> <a href="minhaconta.php"><button type="submit" class="btn btn-secondary btn-lg" >Editar Password<i class="fas fa-user-lock fa-lg ml-2"></i></button></a></div>
                </div>
                </div>
                
              </form>
              </div>
                
<?php
              }
             }
             else{?>
              <form class="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Nome</label>
                    <input type="text" value=" <?php echo $_SESSION['userNome']?>" class="form-control" id="validationCustom01" placeholder="Nome" value="" name="nome" readonly>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Apelido</label>
                    <input type="text" value="<?php echo $_SESSION['userApelido']?>" class="form-control" id="validationCustom01" placeholder="Apelido" value="" name="apelido" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputEmail4">Email</label>
                      <input type="email" value="<?php echo $_SESSION['userEmail']?>" class="form-control" id="inputEmail4" placeholder="Email" name="email" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">Telefone</label>
                      <input type="tel" value="<?php echo $_SESSION['userTelefone']?>" class="form-control" id="inputPassword4" placeholder="" name="telefone"  readonly>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputAddress">Morada</label>
                    <textarea type="text" class="form-control" id="inputAddress" name="morada" placeholder="Avenida da Liberdade 427 1º Direito..." readonly><?php echo $_SESSION['userMorada']?></textarea>
                  </div>
                  <div class="form-row">
                    
                    <div class="form-group col-md-4">
                      <label for="inputState">Distrito</label>
                        <select id="inputState" class="form-control" name="distrito" readonly>
                          <option value="Aveiro"><?php echo $_SESSION['userDistrito']?></option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputCity">Cidade</label>
                      <input type="text" value="<?php echo $_SESSION['userCidade']?>" class="form-control" id="inputCity" name="cidade" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputCity">Código Postal</label>
                      <input type="text" value="<?php echo $_SESSION['userCpostal']?>" class="form-control" id="inputZip" name="codigopostal" readonly>
                    </div>
                    
                  </div>
                
                </div>
                  
                  </div>
                  
              </form>
           <?php  }
             if(!isset($edit)) {?>
              <div class="row mt-4">
                    <div class="col-md-2"></div>
                    <div class="col-md-4 mt-4 text-center"> <a href="minhaconta.php?edit=2"><button class="btn btn-secondary btn-lg" >Editar Password<i class="fas fa-user-lock fa-lg ml-2"></i></button></a></div>
                    <div class="col-md-4 mt-4 text-center"> <a href="minhaconta.php?edit=1"><button class="btn btn-primary btn-lg" >Editar Informação<i class="fas fa-user-edit fa-lg ml-2"></i></button></a></div>
                    <div class="col-md-2"></div>
                    
                  </div>
                  <div class="row mb-4 mt-5">
            <div class="col-md-12 text-right mr-0 text-white">
            <a class="btn btn-primary" onclick="history.go(-1)">Voltar Atrás</a>
            </div>
        
        </div>
                  <?php
             }
              if (isset($_SESSION['ErroRegistar'])){
                  ?> <p class="text-center mt-2"> <?php
                    echo $_SESSION['ErroRegistar'];
                    unset($_SESSION['ErroRegistar']);
                             }?>
            </div>

        </div>
    </div>                        

  <?php include'footer.php'; ?>

 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="scripts/jsCustomHeader.js"></script>
  <script src="scripts/pageTriggerLoad.js"></script>
  </body>
  </html>