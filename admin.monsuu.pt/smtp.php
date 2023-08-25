<?php

function newOrderAdmin($nome, $orderNumber, $metodoPagamento, $valor, $validade, $email) {
  

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
  $message = Swift_Message::newInstance('Monsuu Store Administração - '. $orderNumber .' - Nova Encomenda')
  ->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
  ->setTo(array($email))
  ->addPart('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
  
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
            <style type="text/css">
            .ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}body,td,input,textarea,select{margin:unset;font-family:unset}input,textarea,select{font-size:unset}@media screen and (max-width: 600px){table.row th.col-lg-1,table.row th.col-lg-2,table.row th.col-lg-3,table.row th.col-lg-4,table.row th.col-lg-5,table.row th.col-lg-6,table.row th.col-lg-7,table.row th.col-lg-8,table.row th.col-lg-9,table.row th.col-lg-10,table.row th.col-lg-11,table.row th.col-lg-12{display:block;width:100% !important}.d-mobile{display:block !important}.d-desktop{display:none !important}.w-lg-25{width:auto !important}.w-lg-25>tbody>tr>td{width:auto !important}.w-lg-50{width:auto !important}.w-lg-50>tbody>tr>td{width:auto !important}.w-lg-75{width:auto !important}.w-lg-75>tbody>tr>td{width:auto !important}.w-lg-100{width:auto !important}.w-lg-100>tbody>tr>td{width:auto !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.w-25{width:25% !important}.w-25>tbody>tr>td{width:25% !important}.w-50{width:50% !important}.w-50>tbody>tr>td{width:50% !important}.w-75{width:75% !important}.w-75>tbody>tr>td{width:75% !important}.w-100{width:100% !important}.w-100>tbody>tr>td{width:100% !important}.w-auto{width:auto !important}.w-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:0 !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:0 !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:0 !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:0 !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:0 !important}.p-lg-2>tbody>tr>td{padding:0 !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:0 !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:0 !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:0 !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:0 !important}.p-lg-3>tbody>tr>td{padding:0 !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:0 !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:0 !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:0 !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:0 !important}.p-lg-4>tbody>tr>td{padding:0 !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:0 !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:0 !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:0 !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:0 !important}.p-lg-5>tbody>tr>td{padding:0 !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:0 !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:0 !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:0 !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:0 !important}.p-0>tbody>tr>td{padding:0 !important}.pt-0>tbody>tr>td,.py-0>tbody>tr>td{padding-top:0 !important}.pr-0>tbody>tr>td,.px-0>tbody>tr>td{padding-right:0 !important}.pb-0>tbody>tr>td,.py-0>tbody>tr>td{padding-bottom:0 !important}.pl-0>tbody>tr>td,.px-0>tbody>tr>td{padding-left:0 !important}.p-1>tbody>tr>td{padding:4px !important}.pt-1>tbody>tr>td,.py-1>tbody>tr>td{padding-top:4px !important}.pr-1>tbody>tr>td,.px-1>tbody>tr>td{padding-right:4px !important}.pb-1>tbody>tr>td,.py-1>tbody>tr>td{padding-bottom:4px !important}.pl-1>tbody>tr>td,.px-1>tbody>tr>td{padding-left:4px !important}.p-2>tbody>tr>td{padding:8px !important}.pt-2>tbody>tr>td,.py-2>tbody>tr>td{padding-top:8px !important}.pr-2>tbody>tr>td,.px-2>tbody>tr>td{padding-right:8px !important}.pb-2>tbody>tr>td,.py-2>tbody>tr>td{padding-bottom:8px !important}.pl-2>tbody>tr>td,.px-2>tbody>tr>td{padding-left:8px !important}.p-3>tbody>tr>td{padding:16px !important}.pt-3>tbody>tr>td,.py-3>tbody>tr>td{padding-top:16px !important}.pr-3>tbody>tr>td,.px-3>tbody>tr>td{padding-right:16px !important}.pb-3>tbody>tr>td,.py-3>tbody>tr>td{padding-bottom:16px !important}.pl-3>tbody>tr>td,.px-3>tbody>tr>td{padding-left:16px !important}.p-4>tbody>tr>td{padding:24px !important}.pt-4>tbody>tr>td,.py-4>tbody>tr>td{padding-top:24px !important}.pr-4>tbody>tr>td,.px-4>tbody>tr>td{padding-right:24px !important}.pb-4>tbody>tr>td,.py-4>tbody>tr>td{padding-bottom:24px !important}.pl-4>tbody>tr>td,.px-4>tbody>tr>td{padding-left:24px !important}.p-5>tbody>tr>td{padding:48px !important}.pt-5>tbody>tr>td,.py-5>tbody>tr>td{padding-top:48px !important}.pr-5>tbody>tr>td,.px-5>tbody>tr>td{padding-right:48px !important}.pb-5>tbody>tr>td,.py-5>tbody>tr>td{padding-bottom:48px !important}.pl-5>tbody>tr>td,.px-5>tbody>tr>td{padding-left:48px !important}.s-lg-1>tbody>tr>td,.s-lg-2>tbody>tr>td,.s-lg-3>tbody>tr>td,.s-lg-4>tbody>tr>td,.s-lg-5>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}@media yahoo{.d-mobile{display:none !important}.d-desktop{display:block !important}.w-lg-25{width:25% !important}.w-lg-25>tbody>tr>td{width:25% !important}.w-lg-50{width:50% !important}.w-lg-50>tbody>tr>td{width:50% !important}.w-lg-75{width:75% !important}.w-lg-75>tbody>tr>td{width:75% !important}.w-lg-100{width:100% !important}.w-lg-100>tbody>tr>td{width:100% !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:4px !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:4px !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:4px !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:4px !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:4px !important}.p-lg-2>tbody>tr>td{padding:8px !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:8px !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:8px !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:8px !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:8px !important}.p-lg-3>tbody>tr>td{padding:16px !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:16px !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:16px !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:16px !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:16px !important}.p-lg-4>tbody>tr>td{padding:24px !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:24px !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:24px !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:24px !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:24px !important}.p-lg-5>tbody>tr>td{padding:48px !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:48px !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:48px !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:48px !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:48px !important}.s-lg-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-lg-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-lg-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-lg-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-lg-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-lg-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}
  
          </style>
  </head><body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
            <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'!
            </h3>
  <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
           
        </td>
      </tr>
    </tbody>
  </table>
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Recebeste uma nova encomenda!</h5>
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
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">O método de pagamento escolhido é : '.$metodoPagamento.'<br><br>O pagamento é válido até: '.$validade.'.</h5>
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
  
<table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
<tbody>
  <tr>
    <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
       
    </td>
  </tr>
</tbody>
</table>
  
  <table class="btn btn-info mx-auto " align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-radius: 4px; margin: 0;" align="center" bgcolor="#17a2b8">
          <a href="http://www.admin.monsuu.pt/encomendas.php?orderNumber='.$orderNumber.'" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Ver Encomenda</a>
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
    
           <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.facebook.com/Monsuustore/"><img class="img " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
    
         <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
  <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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
  
  </body>','text/html')
  ;
  
  
  // Efectuar o envio
  if($mailer->send($message)) {
      echo("sucesso");
  }
  else {
      echo("erro");
  };
}

function newOrderPayshop($nome, $orderNumber, $ref, $valor, $validade, $email) {
  

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
  $message = Swift_Message::newInstance('Monsuu Store - '. $orderNumber .' - Nova Encomenda - Referência de pagamento Payshop')
  ->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
  ->setTo(array($email))
  ->addPart('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
  
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
            <style type="text/css">
            .ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}body,td,input,textarea,select{margin:unset;font-family:unset}input,textarea,select{font-size:unset}@media screen and (max-width: 600px){table.row th.col-lg-1,table.row th.col-lg-2,table.row th.col-lg-3,table.row th.col-lg-4,table.row th.col-lg-5,table.row th.col-lg-6,table.row th.col-lg-7,table.row th.col-lg-8,table.row th.col-lg-9,table.row th.col-lg-10,table.row th.col-lg-11,table.row th.col-lg-12{display:block;width:100% !important}.d-mobile{display:block !important}.d-desktop{display:none !important}.w-lg-25{width:auto !important}.w-lg-25>tbody>tr>td{width:auto !important}.w-lg-50{width:auto !important}.w-lg-50>tbody>tr>td{width:auto !important}.w-lg-75{width:auto !important}.w-lg-75>tbody>tr>td{width:auto !important}.w-lg-100{width:auto !important}.w-lg-100>tbody>tr>td{width:auto !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.w-25{width:25% !important}.w-25>tbody>tr>td{width:25% !important}.w-50{width:50% !important}.w-50>tbody>tr>td{width:50% !important}.w-75{width:75% !important}.w-75>tbody>tr>td{width:75% !important}.w-100{width:100% !important}.w-100>tbody>tr>td{width:100% !important}.w-auto{width:auto !important}.w-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:0 !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:0 !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:0 !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:0 !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:0 !important}.p-lg-2>tbody>tr>td{padding:0 !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:0 !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:0 !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:0 !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:0 !important}.p-lg-3>tbody>tr>td{padding:0 !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:0 !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:0 !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:0 !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:0 !important}.p-lg-4>tbody>tr>td{padding:0 !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:0 !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:0 !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:0 !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:0 !important}.p-lg-5>tbody>tr>td{padding:0 !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:0 !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:0 !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:0 !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:0 !important}.p-0>tbody>tr>td{padding:0 !important}.pt-0>tbody>tr>td,.py-0>tbody>tr>td{padding-top:0 !important}.pr-0>tbody>tr>td,.px-0>tbody>tr>td{padding-right:0 !important}.pb-0>tbody>tr>td,.py-0>tbody>tr>td{padding-bottom:0 !important}.pl-0>tbody>tr>td,.px-0>tbody>tr>td{padding-left:0 !important}.p-1>tbody>tr>td{padding:4px !important}.pt-1>tbody>tr>td,.py-1>tbody>tr>td{padding-top:4px !important}.pr-1>tbody>tr>td,.px-1>tbody>tr>td{padding-right:4px !important}.pb-1>tbody>tr>td,.py-1>tbody>tr>td{padding-bottom:4px !important}.pl-1>tbody>tr>td,.px-1>tbody>tr>td{padding-left:4px !important}.p-2>tbody>tr>td{padding:8px !important}.pt-2>tbody>tr>td,.py-2>tbody>tr>td{padding-top:8px !important}.pr-2>tbody>tr>td,.px-2>tbody>tr>td{padding-right:8px !important}.pb-2>tbody>tr>td,.py-2>tbody>tr>td{padding-bottom:8px !important}.pl-2>tbody>tr>td,.px-2>tbody>tr>td{padding-left:8px !important}.p-3>tbody>tr>td{padding:16px !important}.pt-3>tbody>tr>td,.py-3>tbody>tr>td{padding-top:16px !important}.pr-3>tbody>tr>td,.px-3>tbody>tr>td{padding-right:16px !important}.pb-3>tbody>tr>td,.py-3>tbody>tr>td{padding-bottom:16px !important}.pl-3>tbody>tr>td,.px-3>tbody>tr>td{padding-left:16px !important}.p-4>tbody>tr>td{padding:24px !important}.pt-4>tbody>tr>td,.py-4>tbody>tr>td{padding-top:24px !important}.pr-4>tbody>tr>td,.px-4>tbody>tr>td{padding-right:24px !important}.pb-4>tbody>tr>td,.py-4>tbody>tr>td{padding-bottom:24px !important}.pl-4>tbody>tr>td,.px-4>tbody>tr>td{padding-left:24px !important}.p-5>tbody>tr>td{padding:48px !important}.pt-5>tbody>tr>td,.py-5>tbody>tr>td{padding-top:48px !important}.pr-5>tbody>tr>td,.px-5>tbody>tr>td{padding-right:48px !important}.pb-5>tbody>tr>td,.py-5>tbody>tr>td{padding-bottom:48px !important}.pl-5>tbody>tr>td,.px-5>tbody>tr>td{padding-left:48px !important}.s-lg-1>tbody>tr>td,.s-lg-2>tbody>tr>td,.s-lg-3>tbody>tr>td,.s-lg-4>tbody>tr>td,.s-lg-5>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}@media yahoo{.d-mobile{display:none !important}.d-desktop{display:block !important}.w-lg-25{width:25% !important}.w-lg-25>tbody>tr>td{width:25% !important}.w-lg-50{width:50% !important}.w-lg-50>tbody>tr>td{width:50% !important}.w-lg-75{width:75% !important}.w-lg-75>tbody>tr>td{width:75% !important}.w-lg-100{width:100% !important}.w-lg-100>tbody>tr>td{width:100% !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:4px !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:4px !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:4px !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:4px !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:4px !important}.p-lg-2>tbody>tr>td{padding:8px !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:8px !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:8px !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:8px !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:8px !important}.p-lg-3>tbody>tr>td{padding:16px !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:16px !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:16px !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:16px !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:16px !important}.p-lg-4>tbody>tr>td{padding:24px !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:24px !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:24px !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:24px !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:24px !important}.p-lg-5>tbody>tr>td{padding:48px !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:48px !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:48px !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:48px !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:48px !important}.s-lg-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-lg-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-lg-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-lg-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-lg-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-lg-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}
  
          </style>
  </head><body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
            <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'
            </h3>
  <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
           
        </td>
      </tr>
    </tbody>
  </table>
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Obrigado pela tua nova encomenda!</h5>
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
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Aqui tens a tua referência Payshop! Ficamos a aguardar o teu pagamento. <br><br>A tua referência é valida durante 48 horas até '.$validade.'.</h5>
  <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
           
        </td>
      </tr>
    </tbody>
  </table>
  
  
            
  <table valign="top" class="bg-light body" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0; padding: 0; border: 0;" bgcolor="#f8f9fa">
  <tbody>
    <tr>
      <td valign="top" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f8f9fa">
        
    <table class="container" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
  <tbody>
    <tr>
      <td align="center" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
        <!--[if (gte mso 9)|(IE)]>
          <table align="center">
            <tbody>
              <tr>
                <td width="600">
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 600px; margin: 0 auto;">
          <tbody>
            <tr>
              <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
                
      <table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
      <th class="col-lg-3 col-sm-0" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
      
</th>

      
      <th class="col-lg-6 col-sm-12" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 50%; margin: 0;">
  
     	<table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 100%; border: 1px solid #dee2e6;">
  <thead class="thead-light">
    <tr>
      <th colspan="2" class="text-center" style="line-height: 24px; font-size: 16px; color: #495057; margin: 0; padding: 12px; border-color: #dee2e6; border-style: solid; border-width: 1px 1px 2px;" align="center" bgcolor="#e9ecef" valign="top">
<img class="w-25" width="160" height="50" src="http://images.monsuu.pt/payshop.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; width: 25%; border: 0 none;">
</th>
      
    </tr>
  </thead>
  <tbody>
    <tr style="" bgcolor="#f2f2f2">
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Referência</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$ref.'</td>
      
    </tr>
    <tr>
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Valor</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$valor.'</td>
    </tr>
     <tr style="" bgcolor="#f2f2f2">
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Validade</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$validade.'</td>
    </tr>
  </tbody>
</table>
      
</th>

      <th class="col-lg-3 col-sm-0" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
      
</th>

    
    </tr>
  </thead>
</table>

    
              </td>
            </tr>
          </tbody>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
            </tbody>
          </table>
        <![endif]-->
      </td>
    </tr>
  </tbody>
</table>


  
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
  
  <table class="btn btn-info mx-auto " align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-radius: 4px; margin: 0;" align="center" bgcolor="#17a2b8">
          <a href="http://www.monsuu.pt/encomendas.php?orderNumber='.$orderNumber.'" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Ver Encomenda</a>
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
    
           <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.facebook.com/Monsuustore/"><img class="img " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
    
         <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
  <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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
  
  </body>','text/html')
  ;
  
  
  // Efectuar o envio
  if($mailer->send($message)) {
      echo("sucesso");
  }
  else {
      echo("erro");
  };
}

function newOrderMBWay($nome, $orderNumber, $telefone, $valor, $validade, $email) {
  

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
  $message = Swift_Message::newInstance('Monsuu Store - '. $orderNumber .' - Nova Encomenda - Pagamento MBWay')
  ->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
  ->setTo(array($email))
  ->addPart('<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
          <style type="text/css">
          .ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}body,td,input,textarea,select{margin:unset;font-family:unset}input,textarea,select{font-size:unset}@media screen and (max-width: 600px){table.row th.col-lg-1,table.row th.col-lg-2,table.row th.col-lg-3,table.row th.col-lg-4,table.row th.col-lg-5,table.row th.col-lg-6,table.row th.col-lg-7,table.row th.col-lg-8,table.row th.col-lg-9,table.row th.col-lg-10,table.row th.col-lg-11,table.row th.col-lg-12{display:block;width:100% !important}.d-mobile{display:block !important}.d-desktop{display:none !important}.w-lg-25{width:auto !important}.w-lg-25>tbody>tr>td{width:auto !important}.w-lg-50{width:auto !important}.w-lg-50>tbody>tr>td{width:auto !important}.w-lg-75{width:auto !important}.w-lg-75>tbody>tr>td{width:auto !important}.w-lg-100{width:auto !important}.w-lg-100>tbody>tr>td{width:auto !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.w-25{width:25% !important}.w-25>tbody>tr>td{width:25% !important}.w-50{width:50% !important}.w-50>tbody>tr>td{width:50% !important}.w-75{width:75% !important}.w-75>tbody>tr>td{width:75% !important}.w-100{width:100% !important}.w-100>tbody>tr>td{width:100% !important}.w-auto{width:auto !important}.w-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:0 !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:0 !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:0 !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:0 !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:0 !important}.p-lg-2>tbody>tr>td{padding:0 !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:0 !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:0 !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:0 !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:0 !important}.p-lg-3>tbody>tr>td{padding:0 !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:0 !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:0 !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:0 !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:0 !important}.p-lg-4>tbody>tr>td{padding:0 !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:0 !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:0 !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:0 !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:0 !important}.p-lg-5>tbody>tr>td{padding:0 !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:0 !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:0 !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:0 !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:0 !important}.p-0>tbody>tr>td{padding:0 !important}.pt-0>tbody>tr>td,.py-0>tbody>tr>td{padding-top:0 !important}.pr-0>tbody>tr>td,.px-0>tbody>tr>td{padding-right:0 !important}.pb-0>tbody>tr>td,.py-0>tbody>tr>td{padding-bottom:0 !important}.pl-0>tbody>tr>td,.px-0>tbody>tr>td{padding-left:0 !important}.p-1>tbody>tr>td{padding:4px !important}.pt-1>tbody>tr>td,.py-1>tbody>tr>td{padding-top:4px !important}.pr-1>tbody>tr>td,.px-1>tbody>tr>td{padding-right:4px !important}.pb-1>tbody>tr>td,.py-1>tbody>tr>td{padding-bottom:4px !important}.pl-1>tbody>tr>td,.px-1>tbody>tr>td{padding-left:4px !important}.p-2>tbody>tr>td{padding:8px !important}.pt-2>tbody>tr>td,.py-2>tbody>tr>td{padding-top:8px !important}.pr-2>tbody>tr>td,.px-2>tbody>tr>td{padding-right:8px !important}.pb-2>tbody>tr>td,.py-2>tbody>tr>td{padding-bottom:8px !important}.pl-2>tbody>tr>td,.px-2>tbody>tr>td{padding-left:8px !important}.p-3>tbody>tr>td{padding:16px !important}.pt-3>tbody>tr>td,.py-3>tbody>tr>td{padding-top:16px !important}.pr-3>tbody>tr>td,.px-3>tbody>tr>td{padding-right:16px !important}.pb-3>tbody>tr>td,.py-3>tbody>tr>td{padding-bottom:16px !important}.pl-3>tbody>tr>td,.px-3>tbody>tr>td{padding-left:16px !important}.p-4>tbody>tr>td{padding:24px !important}.pt-4>tbody>tr>td,.py-4>tbody>tr>td{padding-top:24px !important}.pr-4>tbody>tr>td,.px-4>tbody>tr>td{padding-right:24px !important}.pb-4>tbody>tr>td,.py-4>tbody>tr>td{padding-bottom:24px !important}.pl-4>tbody>tr>td,.px-4>tbody>tr>td{padding-left:24px !important}.p-5>tbody>tr>td{padding:48px !important}.pt-5>tbody>tr>td,.py-5>tbody>tr>td{padding-top:48px !important}.pr-5>tbody>tr>td,.px-5>tbody>tr>td{padding-right:48px !important}.pb-5>tbody>tr>td,.py-5>tbody>tr>td{padding-bottom:48px !important}.pl-5>tbody>tr>td,.px-5>tbody>tr>td{padding-left:48px !important}.s-lg-1>tbody>tr>td,.s-lg-2>tbody>tr>td,.s-lg-3>tbody>tr>td,.s-lg-4>tbody>tr>td,.s-lg-5>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}@media yahoo{.d-mobile{display:none !important}.d-desktop{display:block !important}.w-lg-25{width:25% !important}.w-lg-25>tbody>tr>td{width:25% !important}.w-lg-50{width:50% !important}.w-lg-50>tbody>tr>td{width:50% !important}.w-lg-75{width:75% !important}.w-lg-75>tbody>tr>td{width:75% !important}.w-lg-100{width:100% !important}.w-lg-100>tbody>tr>td{width:100% !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:4px !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:4px !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:4px !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:4px !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:4px !important}.p-lg-2>tbody>tr>td{padding:8px !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:8px !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:8px !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:8px !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:8px !important}.p-lg-3>tbody>tr>td{padding:16px !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:16px !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:16px !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:16px !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:16px !important}.p-lg-4>tbody>tr>td{padding:24px !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:24px !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:24px !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:24px !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:24px !important}.p-lg-5>tbody>tr>td{padding:48px !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:48px !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:48px !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:48px !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:48px !important}.s-lg-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-lg-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-lg-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-lg-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-lg-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-lg-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}

        </style>
</head><body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
            <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'
            </h3>
  <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
           
        </td>
      </tr>
    </tbody>
  </table>
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Obrigado pela tua nova encomenda!</h5>
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
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Já enviamos o pedido de pagamento MBWay para o número: '.$telefone.'! <br>Ficamos a aguardar o teu pagamento.</h5>
  <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
           
        </td>
      </tr>
    </tbody>
  </table>
  
  
            
  <table valign="top" class="bg-light body" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0; padding: 0; border: 0;" bgcolor="#f8f9fa">
  <tbody>
    <tr>
      <td valign="top" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f8f9fa">
        
    <table class="container" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
  <tbody>
    <tr>
      <td align="center" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
        <!--[if (gte mso 9)|(IE)]>
          <table align="center">
            <tbody>
              <tr>
                <td width="600">
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 600px; margin: 0 auto;">
          <tbody>
            <tr>
              <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
                
      <table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
      <th class="col-lg-3 col-sm-0" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
      
</th>

      
      <th class="col-lg-6 col-sm-12" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 50%; margin: 0;">
  
     	<table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 100%; border: 1px solid #dee2e6;">
  <thead class="thead-light">
    <tr>
      <th colspan="2" class="text-center" style="line-height: 24px; font-size: 16px; color: #495057; margin: 0; padding: 12px; border-color: #dee2e6; border-style: solid; border-width: 1px 1px 2px;" align="center" bgcolor="#e9ecef" valign="top">
<img class="w-25" width="160" height="50" src="http://images.monsuu.pt/mbway.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; width: 25%; border: 0 none;">
</th>
      
    </tr>
  </thead>
  <tbody>
    <tr style="" bgcolor="#f2f2f2">
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Nº Telemóvel</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$telefone.'</td>
      
    </tr>
    <tr>
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Valor</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$valor.'</td>
    </tr>
     <tr style="" bgcolor="#f2f2f2">
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Validade</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$validade.'</td>
    </tr>
  </tbody>
</table>
      
</th>

      <th class="col-lg-3 col-sm-0" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
      
</th>

    
    </tr>
  </thead>
</table>

    
              </td>
            </tr>
          </tbody>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
            </tbody>
          </table>
        <![endif]-->
      </td>
    </tr>
  </tbody>
</table>


  
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
  
  <table class="btn btn-info mx-auto " align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-radius: 4px; margin: 0;" align="center" bgcolor="#17a2b8">
          <a href="http://www.monsuu.pt/encomendas.php?orderNumber='.$orderNumber.'" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Ver Encomenda</a>
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
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Por motivos de segurança apenas poderemos aceitar o teu pagamento nos próximos 5 minutos. Caso não consigas fazer o pagamento, <a href="mailto:geral@monsuu.pt">entra em contacto connosco</a> ou se preferires <a href="www.monsuu.pt">faz uma nova encomenda.</a></h5>
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
    
           <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.facebook.com/Monsuustore/"><img class="img " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
    
         <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
  <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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
  
  </body>','text/html')
  ;
  
  
  // Efectuar o envio
  if($mailer->send($message)) {
      echo("sucesso");
  }
  else {
      echo("erro");
  };
}


function newOrderMb($nome, $orderNumber, $entidade, $ref, $valor, $validade, $email) {
  

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
  $message = Swift_Message::newInstance('Monsuu Store - '. $orderNumber .' - Nova Encomenda - Referência de pagamento Multibanco')
  ->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
  ->setTo(array($email))
  ->addPart('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
  
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
            <style type="text/css">
            .ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}body,td,input,textarea,select{margin:unset;font-family:unset}input,textarea,select{font-size:unset}@media screen and (max-width: 600px){table.row th.col-lg-1,table.row th.col-lg-2,table.row th.col-lg-3,table.row th.col-lg-4,table.row th.col-lg-5,table.row th.col-lg-6,table.row th.col-lg-7,table.row th.col-lg-8,table.row th.col-lg-9,table.row th.col-lg-10,table.row th.col-lg-11,table.row th.col-lg-12{display:block;width:100% !important}.d-mobile{display:block !important}.d-desktop{display:none !important}.w-lg-25{width:auto !important}.w-lg-25>tbody>tr>td{width:auto !important}.w-lg-50{width:auto !important}.w-lg-50>tbody>tr>td{width:auto !important}.w-lg-75{width:auto !important}.w-lg-75>tbody>tr>td{width:auto !important}.w-lg-100{width:auto !important}.w-lg-100>tbody>tr>td{width:auto !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.w-25{width:25% !important}.w-25>tbody>tr>td{width:25% !important}.w-50{width:50% !important}.w-50>tbody>tr>td{width:50% !important}.w-75{width:75% !important}.w-75>tbody>tr>td{width:75% !important}.w-100{width:100% !important}.w-100>tbody>tr>td{width:100% !important}.w-auto{width:auto !important}.w-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:0 !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:0 !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:0 !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:0 !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:0 !important}.p-lg-2>tbody>tr>td{padding:0 !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:0 !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:0 !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:0 !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:0 !important}.p-lg-3>tbody>tr>td{padding:0 !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:0 !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:0 !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:0 !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:0 !important}.p-lg-4>tbody>tr>td{padding:0 !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:0 !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:0 !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:0 !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:0 !important}.p-lg-5>tbody>tr>td{padding:0 !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:0 !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:0 !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:0 !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:0 !important}.p-0>tbody>tr>td{padding:0 !important}.pt-0>tbody>tr>td,.py-0>tbody>tr>td{padding-top:0 !important}.pr-0>tbody>tr>td,.px-0>tbody>tr>td{padding-right:0 !important}.pb-0>tbody>tr>td,.py-0>tbody>tr>td{padding-bottom:0 !important}.pl-0>tbody>tr>td,.px-0>tbody>tr>td{padding-left:0 !important}.p-1>tbody>tr>td{padding:4px !important}.pt-1>tbody>tr>td,.py-1>tbody>tr>td{padding-top:4px !important}.pr-1>tbody>tr>td,.px-1>tbody>tr>td{padding-right:4px !important}.pb-1>tbody>tr>td,.py-1>tbody>tr>td{padding-bottom:4px !important}.pl-1>tbody>tr>td,.px-1>tbody>tr>td{padding-left:4px !important}.p-2>tbody>tr>td{padding:8px !important}.pt-2>tbody>tr>td,.py-2>tbody>tr>td{padding-top:8px !important}.pr-2>tbody>tr>td,.px-2>tbody>tr>td{padding-right:8px !important}.pb-2>tbody>tr>td,.py-2>tbody>tr>td{padding-bottom:8px !important}.pl-2>tbody>tr>td,.px-2>tbody>tr>td{padding-left:8px !important}.p-3>tbody>tr>td{padding:16px !important}.pt-3>tbody>tr>td,.py-3>tbody>tr>td{padding-top:16px !important}.pr-3>tbody>tr>td,.px-3>tbody>tr>td{padding-right:16px !important}.pb-3>tbody>tr>td,.py-3>tbody>tr>td{padding-bottom:16px !important}.pl-3>tbody>tr>td,.px-3>tbody>tr>td{padding-left:16px !important}.p-4>tbody>tr>td{padding:24px !important}.pt-4>tbody>tr>td,.py-4>tbody>tr>td{padding-top:24px !important}.pr-4>tbody>tr>td,.px-4>tbody>tr>td{padding-right:24px !important}.pb-4>tbody>tr>td,.py-4>tbody>tr>td{padding-bottom:24px !important}.pl-4>tbody>tr>td,.px-4>tbody>tr>td{padding-left:24px !important}.p-5>tbody>tr>td{padding:48px !important}.pt-5>tbody>tr>td,.py-5>tbody>tr>td{padding-top:48px !important}.pr-5>tbody>tr>td,.px-5>tbody>tr>td{padding-right:48px !important}.pb-5>tbody>tr>td,.py-5>tbody>tr>td{padding-bottom:48px !important}.pl-5>tbody>tr>td,.px-5>tbody>tr>td{padding-left:48px !important}.s-lg-1>tbody>tr>td,.s-lg-2>tbody>tr>td,.s-lg-3>tbody>tr>td,.s-lg-4>tbody>tr>td,.s-lg-5>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}@media yahoo{.d-mobile{display:none !important}.d-desktop{display:block !important}.w-lg-25{width:25% !important}.w-lg-25>tbody>tr>td{width:25% !important}.w-lg-50{width:50% !important}.w-lg-50>tbody>tr>td{width:50% !important}.w-lg-75{width:75% !important}.w-lg-75>tbody>tr>td{width:75% !important}.w-lg-100{width:100% !important}.w-lg-100>tbody>tr>td{width:100% !important}.w-lg-auto{width:auto !important}.w-lg-auto>tbody>tr>td{width:auto !important}.p-lg-0>tbody>tr>td{padding:0 !important}.pt-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-top:0 !important}.pr-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-right:0 !important}.pb-lg-0>tbody>tr>td,.py-lg-0>tbody>tr>td{padding-bottom:0 !important}.pl-lg-0>tbody>tr>td,.px-lg-0>tbody>tr>td{padding-left:0 !important}.p-lg-1>tbody>tr>td{padding:4px !important}.pt-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-top:4px !important}.pr-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-right:4px !important}.pb-lg-1>tbody>tr>td,.py-lg-1>tbody>tr>td{padding-bottom:4px !important}.pl-lg-1>tbody>tr>td,.px-lg-1>tbody>tr>td{padding-left:4px !important}.p-lg-2>tbody>tr>td{padding:8px !important}.pt-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-top:8px !important}.pr-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-right:8px !important}.pb-lg-2>tbody>tr>td,.py-lg-2>tbody>tr>td{padding-bottom:8px !important}.pl-lg-2>tbody>tr>td,.px-lg-2>tbody>tr>td{padding-left:8px !important}.p-lg-3>tbody>tr>td{padding:16px !important}.pt-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-top:16px !important}.pr-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-right:16px !important}.pb-lg-3>tbody>tr>td,.py-lg-3>tbody>tr>td{padding-bottom:16px !important}.pl-lg-3>tbody>tr>td,.px-lg-3>tbody>tr>td{padding-left:16px !important}.p-lg-4>tbody>tr>td{padding:24px !important}.pt-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-top:24px !important}.pr-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-right:24px !important}.pb-lg-4>tbody>tr>td,.py-lg-4>tbody>tr>td{padding-bottom:24px !important}.pl-lg-4>tbody>tr>td,.px-lg-4>tbody>tr>td{padding-left:24px !important}.p-lg-5>tbody>tr>td{padding:48px !important}.pt-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-top:48px !important}.pr-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-right:48px !important}.pb-lg-5>tbody>tr>td,.py-lg-5>tbody>tr>td{padding-bottom:48px !important}.pl-lg-5>tbody>tr>td,.px-lg-5>tbody>tr>td{padding-left:48px !important}.s-lg-0>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-lg-1>tbody>tr>td{font-size:4px !important;line-height:4px !important;height:4px !important}.s-lg-2>tbody>tr>td{font-size:8px !important;line-height:8px !important;height:8px !important}.s-lg-3>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-lg-4>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-lg-5>tbody>tr>td{font-size:48px !important;line-height:48px !important;height:48px !important}}
  
          </style>
  </head><body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
            <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'!
            </h3>
  <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
           
        </td>
      </tr>
    </tbody>
  </table>
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Obrigado pela tua nova encomenda!</h5>
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
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Aqui tens a tua referência Multibanco. Ficamos a aguardar o teu pagamento. <br><br>A tua referência é valida durante 48 horas até '.$validade.'.</h5>
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
  <table valign="top" class="bg-light body" style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0; padding: 0; border: 0;" bgcolor="#f8f9fa">
  <tbody>
    <tr>
      <td valign="top" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left" bgcolor="#f8f9fa">
        
    <table class="container" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
  <tbody>
    <tr>
      <td align="center" style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 0 16px;">
        <!--[if (gte mso 9)|(IE)]>
          <table align="center">
            <tbody>
              <tr>
                <td width="600">
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 600px; margin: 0 auto;">
          <tbody>
            <tr>
              <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
                
      <table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
      <th class="col-lg-3 col-sm-0" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
      
</th>

      
      <th class="col-lg-6 col-sm-12" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 50%; margin: 0;">
  
     	<table class="table table-striped table-bordered" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%; max-width: 100%; border: 1px solid #dee2e6;">
  <thead class="thead-light">
    <tr>
      <th colspan="2" class="text-center" style="line-height: 24px; font-size: 16px; color: #495057; margin: 0; padding: 12px; border-color: #dee2e6; border-style: solid; border-width: 1px 1px 2px;" align="center" bgcolor="#e9ecef" valign="top">
<img class="w-25" width="160" height="50" src="http://images.monsuu.pt/multibanco.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; width: 25%; border: 0 none;">
</th>
      
    </tr>
  </thead>
  <tbody>
    <tr style="" bgcolor="#f2f2f2">
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Entidade</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$entidade.'</td>
      
    </tr>
    <tr>
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Referência</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$ref.'</td>
    </tr>
     <tr style="" bgcolor="#f2f2f2">
      <th class="text-center" style="line-height: 24px; font-size: 16px; margin: 0;" align="center">Valor</th>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0; padding: 12px; border: 1px solid #dee2e6;" align="left" valign="top">'.$valor.'</td>
    </tr>
  </tbody>
</table>
      
</th>

      <th class="col-lg-3 col-sm-0" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 25%; margin: 0;">
  
      
</th>

    
    </tr>
  </thead>
</table>

    
              </td>
            </tr>
          </tbody>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
            </tbody>
          </table>
        <![endif]-->
      </td>
    </tr>
  </tbody>
</table>


  
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
  
  <table class="btn btn-info mx-auto " align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: separate !important; border-radius: 4px; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-radius: 4px; margin: 0;" align="center" bgcolor="#17a2b8">
          <a href="http://www.monsuu.pt/encomendas.php?orderNumber='.$orderNumber.'" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Ver Encomenda</a>
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
    
           <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.facebook.com/Monsuustore/"><img class="img " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
    
         <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
  <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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
  
  </body>','text/html')
  ;
  
  
  // Efectuar o envio
  if($mailer->send($message)) {
      echo("sucesso");
  }
  else {
      echo("erro");
  };
}



function orderCancelled($nome, $orderNumber, $orderStatus, $email) {
  

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
$message = Swift_Message::newInstance('Monsuu Store - '. $orderNumber .' - Encomenda Atualizada')
->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
->setTo(array($email))
->addPart('<body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
          <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'
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

<h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Estado Atual: '.$orderStatus.'</h5>
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

<table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
  <tbody>
    <tr>
      <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
         
      </td>
    </tr>
  </tbody>
</table>

<h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Lamentamos que não tenhas conseguido finalizar a tua encomenda. <br> <br>Contacta-nos para te podermos ajudar o mais rapidamente possível.</h5>
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
        <a href="mailto:geral@monsuu.pt" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Contactar</a>
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
  
         <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
      <a href="https://www.facebook.com/Monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
  
       <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
  <tbody>
    <tr>
      <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
      <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
<div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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

</body>','text/html')
;


// Efectuar o envio
if($mailer->send($message)) {
    echo("sucesso");
}
else {
    echo("erro");
};

}

function orderUpdate($nome, $orderNumber, $orderStatus, $email) {
  

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
  $message = Swift_Message::newInstance('Monsuu Store - '. $orderNumber .' - Encomenda Atualizada')
  ->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
  ->setTo(array($email))
  ->addPart('<body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
            <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'
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
  
  <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Estado Atual: '.$orderStatus.'</h5>
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
  
  <table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody>
      <tr>
        <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
           
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
    
           <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.facebook.com/Monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
    
         <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
        <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
  <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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
  
  </body>','text/html')
  ;
  
  
  // Efectuar o envio
  if($mailer->send($message)) {
      echo("sucesso");
  }
  else {
      echo("erro");
  };
  
  }

  function confirmEmail($nome,$hash ,$email ) {
  

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
    $message = Swift_Message::newInstance('Monsuu Store - Novo Registo/Confirmação de Conta')
    ->setFrom(array('noreply@monsuu.pt'=> 'Monsuu Store'))
    ->setTo(array($email))
    ->addPart('<body style="outline: 0; width: 600; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border: 0;" bgcolor="#ffffff">
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
              <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px;" align="center">Olá '.$nome.'
              </h3>
    <table class="s-2 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
      <tbody>
        <tr>
          <td height="8" style="border-spacing: 0px; border-collapse: collapse; line-height: 8px; font-size: 8px; width: 100%; height: 8px; margin: 0;" align="left">
             
          </td>
        </tr>
      </tbody>
    </table>
    
    <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Obrigado por te registares no nosso site!</h5>
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
    
    <h5 class="text-muted   text-center" style="margin-top: 0; margin-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 20px; line-height: 24px; color: #636c72;" align="center">Para terminares o teu registo carrega no botão.</h5>
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
            <a href="http://www.monsuu.pt/admin/verificarConta.php?hash='.$hash.'&id=$'.$email.'" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; border-radius: 4px; line-height: 20px; display: inline-block; font-weight: normal; white-space: nowrap; background-color: #17a2b8; color: #ffffff; padding: 8px 12px; border: 1px solid #17a2b8;">Confirmar Conta</a>
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
    
  
    
    <table class="s-3 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
      <tbody>
        <tr>
          <td height="16" style="border-spacing: 0px; border-collapse: collapse; line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left">
             
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
      
             <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
      <tbody>
        <tr>
          <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
          <a href="https://www.facebook.com/Monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/facebook.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
      
           <table class="mx-auto" align="center" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin: 0 auto;">
      <tbody>
        <tr>
          <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; margin: 0;" align="left">
          <a href="https://www.instagram.com/monsuustore/"><img class="img  " width="32px" height="32px" src="http://images.monsuu.pt/instagram.png" alt="Some Image" style="height: auto; line-height: 100%; outline: none; text-decoration: none; border: 0 none;"><table class="s-0 w-100" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"></a>
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
    <div class="hr " style="width: 100%; margin: 20px 0; border: 0;">
  <table border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; width: 100%;">
    <tbody>
      <tr>
        <td style="border-spacing: 0px; border-collapse: collapse; line-height: 24px; font-size: 16px; border-top-width: 1px; border-top-color: #dddddd; border-top-style: solid; height: 1px; width: 100%; margin: 0;" align="left"></td>
      </tr>
    </tbody>
  </table>
</div>

<table class="row" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center " align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  <div class="text-center" style="" align="center"><strong class="text-center" style="text-align: center !important;">Apoio Ao Cliente: <a href="mailto:geral@monsuu.pt">geral@monsuu.pt</a></strong></div>
</th>

 

    </tr>
  </thead>
</table>

  <table class="row " border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica, Arial, sans-serif; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-spacing: 0px; border-collapse: collapse; margin-right: -15px; margin-left: -15px; table-layout: fixed; width: 100%;">
  <thead>
    <tr>
      
  <th class="col-12 text-center" align="left" valign="top" style="line-height: 24px; font-size: 16px; min-height: 1px; padding-right: 15px; padding-left: 15px; font-weight: normal; width: 100%; margin: 0;">
  
<div class="text-center" style="" align="center">
<a href="www.monsuu.pt">WWW.MONSUU.PT </a><div class="text-muted" style="color: #636c72;">© Todos os Direitos Reservados.</div>
</div>
 

</th>

  
     
    </tr>
  </thead>
</table>

  
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
    
    </body>','text/html')
    ;
    
    
    // Efectuar o envio
    if($mailer->send($message)) {
        echo("sucesso");
    }
    else {
        echo("erro");
    };
    
  }

//orderCancelled("Fábio", "MS2122", "Cancelada", "fdc1994@hotmail.com");
//orderUpdate("Fábio", "MS2122", "Pagamento Confirmado", "fdc1994@hotmail.com");
//confirmEmail("Fábio", "sina229nwd2dni29", "fdc1994@hotmail.com");
//newOrderMb("Fábio", "MS2233", "23312", "340 934 120", "29.99€","26/02/2021 10:59", "fdc1994@hotmail.com");
//newOrderPayshop("Fábio", "MS2233", "340 934 120", "29.99€","26/02/2021", "fdc1994@hotmail.com");
//newOrderMBWay("Fábio", "MS2233", "912696272", "29.99€","26/02/2021 11:40", "fdc1994@hotmail.com");
//newOrderAdmin("Fábio", "MS2233", "Multibanco", "29.99€","26/02/2021 11:40", "fdc1994@hotmail.com");