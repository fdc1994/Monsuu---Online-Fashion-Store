<?php



// inclusão da framework no código
require_once '../lib/swift_required.php';

// definir a autenticação via SMTP
// mail.dominios.pt -> deverá trocar pelo endereço de e-mail do seu domínio
// webmaster@dominio.tld -> deverá trocar pelo seu endereço de e-mail
// password_caixa_email -> deverá preencher com a password da respectiva caixa

$transport = Swift_SmtpTransport::newInstance('mail.monsuu.pt', 587)
->setUsername('noreply@monsuu.pt')
->setPassword('Ben2010!,.')
;
$mailer = Swift_Mailer::newInstance($transport);
 
// Criar o cabeçalho, assim como a mensagem
$message = Swift_Message::newInstance('Monsuu Store - Encomenda')
->setFrom(array('noreply@monsuu.pt') => "Monsuu Store")
->setTo(array($email))
->addPart('<body style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
<table valign="top" class="bg-light body" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0; padding: 0; border: 0;" bgcolor="#f8f9fa">
  <tbody>
    <tr>
      <td valign="top" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f8f9fa">
        

    <table class="container-fluid" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 0 16px;" align="left">
        
      <img class="img-fluid " width="" height="" src="http://images.monsuu.pt/bannerNew.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; width: 100%; max-width: 100%; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="0" style="border-spacing: 0px; border-collapse: collapse; line-height: 0; font-size: 0; width: 100%; height: 0; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>


   <table class="card" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; width: 100%; overflow: hidden; border: 1px solid #dee2e6;" bgcolor="#ffffff">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left">
        <div>
  <table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>

<table class="card-body " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; width: 100%; margin: 0; padding: 20px;" align="left">
        <div>
          <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá ' . $nome . '
          </h3>
<table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>

<h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">O estado da tua encomenda foi atualizado.</h5>
<table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>


    <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>

<h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Estado Atual: ' . $orderStatus.'</h5>
<table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>


          
<table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>

<table class="btn btn-info mx-auto " align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; margin: 0 auto;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-radius: 4px; margin: 0;" align="center" bgcolor="#17a2b8">
        <a href="http://www.monsuu.pt/encomendas.php?orderNumber='.$orderNumber.'" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Ver Encomenda</a>
      </td>
    </tr>
  </tbody>
</table>

    <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

     <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Segue-nos nas redes sociais para novidades diárias!
    </h3>
<table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>


<table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
      <th class="col-3 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
         
</th>

       <th class="col-3 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
         <a href="https://www.facebook.com/Monsuustore/"></a><table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <img class="img  " width="64px" height="64px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="0" style="border-spacing: 0px; border-collapse: collapse; line-height: 0; font-size: 0; width: 100%; height: 0; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>


      </td>
    </tr>
  </tbody>
</table>

         
</th>

      <th class="col-3 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
       <a href="https://www.instagram.com/monsuustore/"> </a><table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <img class="img  " width="64px" height="64px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="0" style="border-spacing: 0px; border-collapse: collapse; line-height: 0; font-size: 0; width: 100%; height: 0; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>


      </td>
    </tr>
  </tbody>
</table>

         
</th>

      <th class="col-3 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
         
         
</th>

      
    
    </tr>
  </thead>
</table>

     

</div>
      </td>
    </tr>
  </tbody>
</table>
<table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>



    </div>
      </td>
    </tr>
  </tbody>
</table>

    
       
      </td>
    </tr>
  </tbody>
</table>

    
  
      </td>
    </tr>
  </tbody>
</table>

</body>','text/html')
;

// Efectuar o envio
if($mailer->send($message)) {
    echo("sucesso");
}
else {
    echo("erro");
};

echo

//newOrderStatus("Fábio", "fdc1994@hotmail.com","MS2101", "Pagamento Recebido");