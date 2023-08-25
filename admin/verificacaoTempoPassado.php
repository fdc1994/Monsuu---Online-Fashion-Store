<?php
date_default_timezone_set('Europe/Lisbon');
$email= mysqli_real_escape_string($ligacao, $email);
$sql = "SELECT * FROM recuperarpassword WHERE email LIKE '$email' AND hashsafe LIKE '$hash'" ;
$resultado_pedido = mysqli_query($ligacao, $sql);
$row = mysqli_fetch_assoc($resultado_pedido);


if(isset($row)) {
    $currentDate = date('d/m/Y H:i:s', time());
    $datePedido = strtotime($row['date']);
    echo $datePedido;
    
   if($datePedido >  time() + 86400) {
      //echo 'maior que 24 horas';
        $SQlinvalidalinksanteriores = "UPDATE recuperarpassword SET valido = 0 WHERE email like '$email'" ;
    $ligacao -> query ($SQlinvalidalinksanteriores);
     } 
    
}
$currentDate = date('d/m/Y H:i:s', time());
$dateLimit = date('d/m/Y H:i:s', time() + 300);

echo("Data atual: " . $currentDate);
echo("<br>Data Limite + 24h: " . $dateLimit);
echo("<br>");

?>

