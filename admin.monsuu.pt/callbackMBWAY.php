<?php
include("ligacao.php");
/* 
 
 LINK: https://www.admin.monsuu.pt/callbackMBWAY.php?chave=s465ads4d6asd5sa4d96asfd6sa5f46d54f6ds54sa6546dsa5&referencia=MS2107&valor=20.99&datahorapag=25/02/2021 14:45&estado=PAGO
 */

//devem definir uma chave a vosso gosto e que devem comunicar � Ifthen bem como o url de invoca��o.
$chave_anti_phishing = "s465ads4d6asd5sa4d96asfd6sa5f46d54f6ds54sa6546dsa5";

/*
 * verifica se os parametros necess�rios v�m incluidos no url de callback
 * no exemplo s� assumimos os obrigat�rios, isto �, chave, entidade, referencia e valor. Podem tamb�m solicitar a data/hora de pagamento e o terminal bastando para isso acrescentar os campos.
 */
if(isset($_REQUEST['chave']) && isset($_REQUEST['referencia']) && isset($_REQUEST['valor']) && isset($_REQUEST['datahorapag']) && isset($_REQUEST['estado'])){
	 
	$chave = $_REQUEST['chave'];
	$orderNumber = $_REQUEST['referencia'];
	$valor = $_REQUEST['valor'];
	$dataHora = $_REQUEST['datahorapag'];
	$estado = $_REQUEST['estado'];
   
	
	//verifica se a chave anti-phishing devolvida pela ifthen corresponde � chave definida
	if($chave==$chave_anti_phishing){
		echo "CALLBACK OK<br>";
		echo "<br>Referencia " . $orderNumber;
		echo "<br>Valor " . $valor;
		echo "<br>Data Hora " . $dataHora;
		echo "<br>Estado " . $estado;
		//echo "<br>CHAVE " . $chave;

		$sqlPagamentos = "UPDATE pagamentosencomendas SET pago = 1 WHERE idEncomenda LIKE '$orderNumber'" ;
		$ligacao -> query ($sqlPagamentos);

		$sqlEncomenda = "UPDATE encomendas SET estadoencomenda = 'Pagamento Confirmado' WHERE idEncomenda LIKE '$orderNumber'";  
            
		if($ligacao -> query ($sqlEncomenda)) {
			echo("<br> Encomenda " . $orderNumber . "atualizada");
			$sqlDadosEncomenda = "SELECT * FROM encomendas WHERE idEncomenda LIKE '$orderNumber'";  
			$resultado_encomenda = mysqli_query($ligacao, $sqlDadosEncomenda);
			$row_encomenda = mysqli_fetch_assoc($resultado_encomenda);
			 	//include("smtp.php");
                //orderUpdate($row_encomenda['nome'], $orderNumber, "Pagamento Confirmado", $row_encomenda['email']);
                echo("<br> Encomenda ".$orderNumber. " E-mail enviado ao cliente ".$row_encomenda['nome']." <br><br><br>");
		}

	}	
}

?>