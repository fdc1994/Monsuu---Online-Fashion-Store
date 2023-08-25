
<!doctype html>
<html lang="en">
<head>
<?php
   include_once("admin/ligacao.php");
    session_start();
    if(isset($_SESSION['userId'])){
      header("Location: index.php");
    }?>
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
  
  <?php include 'header.php'; ?>
  
<div class="jumbotron jumbotron-fluid text-center mt-5 mb-0" id="jumbotronMarble">
  <div class="container">
    <h1 class="display-3 lead">Registo de Utilizador</h1>
    <p class="lead">Para usufruir de imediato de todas as funcionalidades do nosso site, crie um registo rápido.</p>
  </div>


    <div class="container container-main mb-5">
    <div class="row">
    <div class="col-12">
    <?php if (isset($_SESSION['ErroRegistar'])){
                    echo $_SESSION['ErroRegistar'];
                    unset($_SESSION['ErroRegistar']);
                             }?></div>
    </div>
        <div class="row">
            <div class="col-1">
            </div>
             <div class="col-10">
             <form class="needs-validation" action="admin/registoGravar.php" method="POST">
             <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="inputEmail4">Nome</label>
                  <input type="text" class="form-control text-center" id="validationCustom01" placeholder="Nome" value="" name="nome" required>
                  </div>
                  <div class="form-group col-md-6">
                  <label for="inputEmail4">Apelido</label>
                  <input type="text" class="form-control text-center" id="validationCustom01" placeholder="Apelido" value="" name="apelido" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control text-center" id="inputEmail4" placeholder="Email" name="email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPhone">Telefone</label>
                    <input type="tel" class="form-control text-center" id="inputEmail4" placeholder="9xxxxxxxx" name="telefone" pattern="[1-9]{2}[0-9]{7}" required>
                  </div>
                  
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control text-center" id="inputPassword4" placeholder="Password" name="passwd" minlength="6" required >
                    <small class="form-text text-muted">A sua password deve conter pelo menos 6 caracteres</small>
                    <small class="form-text text-muted">Nunca partilhe a sua password e atualize-a sempre que possível.</small>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Confirmação de Password</label>
                    <input type="password" class="form-control text-center" id="inputPassword4" placeholder="Password" name="confirm_passwd" minlength="6" required>
                    <small class="form-text text-muted">Deve confirmar a sua Password.</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Morada</label>
                  <textarea type="text" class="form-control text-center" id="inputAddress" name="morada" placeholder="Exemplo: Avenida da Liberdade 427 1º Direito..." required></textarea>
                </div>
                <div class="form-row">
                  
                  <div class="form-group col-md-4">
                    <label for="inputState">Distrito</label>
                      <select id="inputState" class="form-control text-center" name="distrito" required>
                        <option value="Aveiro">Aveiro</option>
                        <option value="Beja">Beja</option>
                        <option value="Braga">Braga</option>
                        <option value="Braganca">Bragança</option>
                        <option value="Castelo_branco">Castelo Branco</option>
                        <option value="Coimbra">Coimbra</option>
                        <option value="Evora">Évora</option>
                        <option value="Faro">Faro</option>
                        <option value="Guarda">Guarda</option>
                        <option value="Leiria">Leiria</option>
                        <option value="Lisboa">Lisboa</option>
                        <option value="Portalegre">Portalegre</option>
                        <option value="Porto">Porto</option>
                        <option value="Santarem">Santarém</option>
                        <option value="Setubal">Setúbal</option>
                        <option value="Viana Do Castelo">Viana do Castelo</option>
                        <option value="Vila Real">Vila Real</option>
                        <option value="Viseu">Viseu</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputCity">Cidade</label>
                    <input type="text" class="form-control text-center" id="inputCity" name="cidade" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputCity">Código Postal</label>
                    <input type="text" class="form-control text-center" id="inputZip" pattern="\d{4}-\d{3}" placeholder="0000-000" name="codigopostal" required>
                  </div>
                </div>
                <div class="form-group text-left mt-2 mb-2">
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="1" required>
                    <label class="form-check-label" for="1">
                      Concordo com os termos e condições
                    </label>
                  </div>
               
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="2" required>
                    <label class="form-check-label" for="2">
                      Aceito o tratamento dos meus dados de acordo com a política GDPR
                    </label>
                  </div>
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="3" name="pub" value="1" >
                    <label class="form-check-label" for="3" >
                      Autorizo ser contactado para receber informações de Marketing e personalização de experiência
                    </label>
                  </div>
                </div>
              </div>
                
                </div>
                <div class="form-row mt-2">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 text-center"> <button class="btn btn-info btn-lg" type="submit" style="padding-bottom:10px;">Registar<i class="fas fa-user-plus fa-lg ml-2"></i></button></div>
                  <div class="col-md-2"></div>
                </div>
                
              </form>
           
            </div>

        </div>
    </div>                        
    </div>
    <?php
    include ("footer.php");
    ?>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="scripts/jsCustomHeader.js"></script>

  <script src="scripts/pageTriggerLoad.js"></script>
  </body>
  </html>