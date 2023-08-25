<?php
	function format_number($number) 
	{ 
		$verifySepDecimal = number_format(99,2);
	
		$valorTmp = $number;
	
		$sepDecimal = substr($verifySepDecimal, 2, 1);
	
		$hasSepDecimal = True;
	
		$i=(strlen($valorTmp)-1);
	
		for($i;$i!=0;$i-=1)
		{
			if(substr($valorTmp,$i,1)=="." || substr($valorTmp,$i,1)==","){
				$hasSepDecimal = True;
				$valorTmp = trim(substr($valorTmp,0,$i))."@".trim(substr($valorTmp,1+$i));
				break;
			}
		}
	
		if($hasSepDecimal!=True){
			$valorTmp=number_format($valorTmp,2);
		
			$i=(strlen($valorTmp)-1);
		
			for($i;$i!=1;$i--)
			{
				if(substr($valorTmp,$i,1)=="." || substr($valorTmp,$i,1)==","){
					$hasSepDecimal = True;
					$valorTmp = trim(substr($valorTmp,0,$i))."@".trim(substr($valorTmp,1+$i));
					break;
				}
			}
		}
	
		for($i=1;$i!=(strlen($valorTmp)-1);$i++)
		{
			if(substr($valorTmp,$i,1)=="." || substr($valorTmp,$i,1)=="," || substr($valorTmp,$i,1)==" "){
				$valorTmp = trim(substr($valorTmp,0,$i)).trim(substr($valorTmp,1+$i));
				break;
			}
		}
	
		if (strlen(strstr($valorTmp,'@'))>0){
			$valorTmp = trim(substr($valorTmp,0,strpos($valorTmp,'@'))).trim($sepDecimal).trim(substr($valorTmp,strpos($valorTmp,'@')+1));
		}
		
		return $valorTmp; 
	} 
	//FIM TRATAMENTO DEFINIÇÕES REGIONAIS


	//INICIO REF MULTIBANCO

function GenerateMbRef($ent_id, $subent_id, $order_id, $order_value)
{


		$order_id ="0000".$order_id;

		$order_value =  format_number($order_value);

		//Apenas sao considerados os 4 caracteres mais a direita do order_id
		$order_id = substr($order_id, (strlen($order_id) - 4), strlen($order_id));


	if ($order_value < 1){
                 echo "Lamentamos mas é impossível gerar uma referência MB para valores inferiores a 1 Euro";
                 return;
           }
           if ($order_value >= 1000000){
                 echo "<b>AVISO:</b> Pagamento fraccionado por exceder o valor limite para pagamentos no sistema Multibanco<br>";
           }
           while ($order_value >= 1000000){
                 GenerateMbRef($order_id++, 999999.99);
                 $order_value -= 999999.99;
           }
                              
           
        //cálculo dos check digits
		
		   
           $chk_str = sprintf('%05u%03u%04u%08u', $ent_id, $subent_id, $order_id, round($order_value*100));
		   
           $chk_array = array(3, 30, 9, 90, 27, 76, 81, 34, 49, 5, 50, 15, 53, 45, 62, 38, 89, 17, 73, 51);
           
           for ($i = 0; $i < 20; $i++)
           {
                 $chk_int = substr($chk_str, 19-$i, 1);
                 $chk_val += ($chk_int%10)*$chk_array[$i];
           }
           
           $chk_val %= 97;
           
           $chk_digits = sprintf('%02u', 98-$chk_val);

       return $subent_id." ".substr($chk_str, 8, 3)." ".substr($chk_str, 11, 1).$chk_digits;

    }
	
	$ent= $_POST['ENTIDADE'];
	$subent = $_POST['SUBENTIDADE'];
	$order_id = $_POST['ID'];
	$order_total = $_POST['VALOR'];
	$url_return = $_POST['RETURN'];
	
	$ref = GenerateMbRef($ent, $subent, $order_id, $order_total);
 ?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Language" content="pt"> 
<meta name="GENERATOR" content="Microsoft FrontPage 6.0"> 
<meta name="ProgId" content="FrontPage.Editor.Document"> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
<title>IFMB - Sistema Pagamentos Por Multibanco</title> 
</head> 
 
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#D4F2F2"> 
 
<div align="center"> 
	<table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="100%"> 
		<tr>
			<td align="center">
				<table border="0" cellpadding="0">
				<tr>
				<td>
				<table cellpadding="3" width="300px" cellspacing="0" style="margin-top: 10px;border: 1px solid #45829F;background-color: #ffffff;">
					<tr>
						<td style="font-size: x-small; border-bottom: 1px solid #45829F; background-color: #45829F; color: White" colspan="3">Pagamento por Multibanco ou Homebanking</td>
					</tr>
					<tr>
						<td rowspan="3"><img src="Images/logoMB.jpg" alt="" /></td>
						<td style="font-size: x-small; font-weight:bold; text-align:left">Entidade:</td>
						<td style="font-size: x-small; text-align:left"><?php echo $ent; ?></td>
					</tr>
					<tr>
						<td style="font-size: x-small; font-weight:bold; text-align:left">Referência:</td>
						<td style="font-size: x-small; text-align:left"><?php echo $ref; ?></td>
					</tr>
					<tr>
						<td style="font-size: x-small; font-weight:bold; text-align:left">Valor:</td>
						<td style="font-size: x-small; text-align:left"><?php echo $order_total; ?></td>
					</tr>
					<tr>
						<td style="font-size: xx-small;border-top: 1px solid #45829F; background-color: #45829F; color: White" colspan="3">O talão emitido pela caixa automática faz prova de pagamento. Conserve-o.</td>
					</tr>
				</table>
				</td>
				</tr>
				<tr>
			<td align="center">
				<form method="GET" action=<?php echo $url_return; ?> >
					<input type="hidden" name="dispatch" value="payment_notification" />
					<!--<input type="hidden" name="dispatch" value="checkout.complete" />-->
					<input type="hidden" name="payment" value="Multibanco" />
					<input type="hidden" name="order_id" value=<?php echo $order_id; ?> />
					<input type="submit" value="Voltar &agrave; encomenda" />
				</form>
			</td>
		</tr>
				</table>
				
			</td>
		</tr>
		
	</table>
</div> 
 
</body> 
 
</html> 
