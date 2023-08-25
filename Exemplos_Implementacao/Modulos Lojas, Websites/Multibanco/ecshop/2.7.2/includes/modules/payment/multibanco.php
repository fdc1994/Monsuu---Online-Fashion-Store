<?php

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/multibanco.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* ??????? */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* ?? */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* ???????? */
    $modules[$i]['desc']    = 'multibanco_desc';

    /* ???????? */
    $modules[$i]['is_cod']  = '0';

    /* ???????? */
    $modules[$i]['is_online']  = '0';

    /* ?? */
    $modules[$i]['author']  = 'Ifthen Software';

    /* ?? */
    $modules[$i]['website'] = 'http://www.ifthensoftware.com/ProdutoX.aspx?ProdID=5';

    /* ??? */
    $modules[$i]['version'] = '1.0.0';

    /* ???? */
    $modules[$i]['config']  =array(
        array('name' => 'multibanco_entidade', 'type' => 'text', 'value' => ''),
        array('name' => 'multibanco_sub_entidade', 'type' => 'text', 'value' => '')
    );

    return;
}

/**
 * ?
 */
class multibanco
{
    /**
     * ????
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function multibanco()
    {
    }

    function __construct()
    {
        $this->multibanco();
    }

    /**
     * ????
     */
    function get_code($order, $payment)
    {
	
		$refCode = $this->GenerateMbRef($payment['multibanco_entidade'], $payment['multibanco_sub_entidade'], $order['order_sn'], $order['order_amount']);
		
		$multi = '<div align="center">
<table cellpadding="3" width="300px" cellspacing="0" style="margin-top: 10px;border: 1px solid #45829F" align="center">
			<tr>
				<td style="font-size: x-small; border-top: 0px; border-left: 0px; border-right: 0px; border-bottom: 1px solid #45829F; background-color: #45829F; color: White" colspan="3"><div align="center">Pagamento por Multibanco ou Homebanking</div></td>
			</tr>
			<tr>
		        <td rowspan="3"><div align="center"><img src="http://img412.imageshack.us/img412/9672/30239592.jpg" alt="" width="52" height="60"/></div></td>
		        <td style="font-size: x-small; font-weight:bold; text-align:left">Entidade:</td>
		        <td style="font-size: x-small; text-align:left">'. $payment['multibanco_entidade'] .'</td>
			</tr>
			<tr>
				<td style="font-size: x-small; font-weight:bold; text-align:left">Refer&ecirc;ncia:</td>
				<td style="font-size: x-small; text-align:left">'. $refCode .'</td>
			</tr>
			<tr>
				<td style="font-size: x-small; font-weight:bold; text-align:left">Valor:</td>
				<td style="font-size: x-small; text-align:left">' . $order['order_amount'] . ' &euro;</td>
			</tr>
			<tr>
				<td style="font-size: xx-small;border-top: 1px solid #45829F; border-left: 0px; border-right: 0px; border-bottom: 0px; background-color: #45829F; color: White" colspan="3">O tal&atilde;o emitido pela caixa autom&aacute;tica faz prova de pagamento. Conserve-o.</td>
			</tr>
		</table>
</div>';
        return $multi;
    }

    /**
     * ????
     */
    function response()
    {
        return;
    }
	
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
		if(strlen($ent_id)<5){
			echo "Lamentamos mas tem de indicar uma entidade válida";
                 return;
		}else if(strlen($ent_id)>5){
			echo "Lamentamos mas tem de indicar uma entidade válida";
                 return;
		}if(strlen($subent_id)==0){
			echo "Lamentamos mas tem de indicar uma subentidade válida";
                 return;
		}else if(strlen($subent_id)==1){
			$subent_id='00'.$subent_id;
		}else if(strlen($subent_id)==2){
			$subent_id='0'.$subent_id;
		}else if(strlen($subent_id)>3){
			echo "Lamentamos mas tem de indicar uma entidade válida";
                 return;
		}

		$chk_val = 0;
		
		$order_id ="0000".$order_id;

		$order_value= sprintf("%01.2f", $order_value);

		$order_value =  $this->format_number($order_value);

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

		   $refCode =$subent_id." ".substr($chk_str, 8, 3)." ".substr($chk_str, 11, 1).$chk_digits;
       return $refCode;           

    }
}

?>