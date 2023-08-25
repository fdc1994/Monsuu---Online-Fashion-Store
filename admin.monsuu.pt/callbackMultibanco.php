<?php
include("ligacao.php");
/* 
 
 LINK: https://www.admin.monsuu.pt/callbackMultibanco.php?chave=[CHAVE_ANTI_PHISHING]&entidade=[ENTIDADE]&referencia=[REFERENCIA]&valor=[VALOR] 
 */

//devem definir uma chave a vosso gosto e que devem comunicar � Ifthen bem como o url de invoca��o.
$chave_anti_phishing = "s465ads4d6asd5sa4d96asfd6sa5f46d54f6ds54sa6546dsa5";

/*
 * verifica se os parametros necess�rios v�m incluidos no url de callback
 * no exemplo s� assumimos os obrigat�rios, isto �, chave, entidade, referencia e valor. Podem tamb�m solicitar a data/hora de pagamento e o terminal bastando para isso acrescentar os campos.
 */
if(isset($_REQUEST['chave']) && isset($_REQUEST['entidade']) && isset($_REQUEST['referencia']) && isset($_REQUEST['valor'])){
	 
	$chave = $_REQUEST['chave'];
	$entidade = $_REQUEST['entidade'];
	$referencia = $_REQUEST['referencia'];
	$valor = $_REQUEST['valor'];
	
	//verifica se a chave anti-phishing devolvida pela ifthen corresponde � chave definida
	if($chave==$chave_anti_phishing){
		echo "CALLBACK OK<br>";
		echo "<br>Entidade " . $entidade;
		echo "<br>Referencia " . $referencia;
		echo "<br>Valor " . $valor;
		//echo "<br>CHAVE " . $chave;
		$sqlDadosEncomenda = "SELECT * FROM pagamentosencomendas WHERE referencia LIKE '$referencia'";  
		$resultado_encomenda = mysqli_query($ligacao, $sqlDadosEncomenda);
		$row_encomenda = mysqli_fetch_assoc($resultado_encomenda);
		$orderNumber = $row_encomenda['idEncomenda'];
		$sqlEncomenda = "UPDATE pagamentosencomendas SET pago = 1 WHERE referencia LIKE '$referencia'";  
		$ligacao -> query ($sqlEncomenda);
		$sqlEncomenda = "UPDATE encomendas SET estadoencomenda = 'Pagamento Confirmado' WHERE idEncomenda LIKE '$orderNumber'";  
            
		if($ligacao -> query ($sqlEncomenda)) {
			echo("<br> Encomenda " . $orderNumber . "atualizada");
			$sqlDadosEncomenda = "SELECT * FROM encomendas WHERE idEncomenda LIKE '$orderNumber'";  
			$resultado_encomenda = mysqli_query($ligacao, $sqlDadosEncomenda);
			$row_encomenda = mysqli_fetch_assoc($resultado_encomenda);
			 	//include("smtp.php");
                //orderUpdate($row_encomenda['nome'], $orderNumber, "Pagamento Confirmado", $row_encomenda['email']);
                echo("<br>Encomenda ".$orderNumber. " E-mail enviado ao cliente ".$row_encomenda['nome']." <br><br><br>");
		}
	}	
}

?>