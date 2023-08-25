<?php
class Gateway {
	private $_config;
	private $_callback_table_w_prefix;
	private $_callback_table;
	private $_module;
	private $_basket;

	
	public function __construct($module = false, $basket = false) {
		$this->_config	= $GLOBALS['config']->get('config');

		$this->_module	= $module;
		$this->_basket	= $GLOBALS['cart']->basket;
	}
	
	

	##################################################

	public function transfer() {
		$transfer	= array(
			'action'	=> 'index.php?_g=rm&amp;type=gateway&amp;cmd=call&amp;module=multibanco&amp;cart_order_id='.$this->_basket['cart_order_id'],
			'method'	=> 'post',
			'target'	=> '_self',
			'submit'	=> 'auto',
		);
		return $transfer;
	}


	public function repeatVariables() {
		return (isset($hidden)) ? $hidden : false;
	}

	public function fixedVariables() {
		$hidden['gateway']	= basename(dirname(__FILE__));
		return (isset($hidden)) ? $hidden : false;
	}

	public function call() {
		//@todo everything
		$form_file	= dirname(__FILE__).CC_DS.'skin';

		$GLOBALS['gui']->changeTemplateDir(dirname(__FILE__).CC_DS.'skin'.CC_DS);

		$GLOBALS['smarty']->assign('MODULE', $this->_module);
		
		$order				= Order::getInstance();
		$cart_order_id		= sanitizeVar($_GET['cart_order_id']);
		$order_summary		= $order->getSummary($cart_order_id);
		
		
		//GERAR REFERENCIA MULTIBANCO
		$entidade = $this->_module["entidade"];
		$subentidade = $this->_module["subentidade"];
		$orderid = substr($order_summary['cart_order_id'],-4);
		$ordertotal = $order_summary['total'];
		
		$ifmb_referencia = $this->GenerateMbRef($entidade,$subentidade,$orderid,$ordertotal);
		
		$GLOBALS['smarty']->assign('REFERENCIA', $ifmb_referencia);
		//FIM GERAR REFERENCIA MULTIBANCO

		$transData['trans_id'] 		= null;
		$transData['notes']			= 'A refer&ecirc;ncia multibanco foi enviada para o cliente.<br /><br />Entidade: ' . $entidade . "<br />Refer&ecirc;ncia: " . $ifmb_referencia . "<br />Valor: " . $ordertotal;
		$transData['gateway']		= 'Pagamento por Multibanco';
		$transData['order_id']		= $order_summary['cart_order_id'];
		$transData['amount']		= $order_summary['total'];
		$transData['status']		= 'Aguardar pagamento por multibanco';
		$transData['customer_id']	= $order_summary['customer_id'];
		$order->logTransaction($transData);

		if ($order_summary) {
			$GLOBALS['smarty']->assign('VAL_ORDER_DATE',formatTime($order_summary['order_date']));
			if (($inventory = $GLOBALS['db']->select('CubeCart_order_inventory', false, array('cart_order_id' => $order_summary['cart_order_id']))) !== false) {
				foreach ($inventory as $item) {
					if (!empty($item['product_options'])) {
						if (($list = unserialize($item['product_options'])) !== false) {
							foreach ($list as $value) {
								$item['options'][] = $value;
							}
						} else {
							$options = explode("\n", $item['product_options']);
							foreach ($options as $option) {
								$value	= trim($option);
								if (empty($value)) continue;
								$item['options'][] = $value;
							}
						}
					}
					$item['price_total'] = $GLOBALS['tax']->priceFormat(($item['price'] * $item['quantity']), true);
					$item['price'] = $GLOBALS['tax']->priceFormat($item['price']);
					$smarty_data['items'][] = $item;
				}
				$GLOBALS['smarty']->assign('ITEMS', $smarty_data['items']);
			}

			// Taxes
			$taxes	= $GLOBALS['db']->select('CubeCart_order_tax', false, array('cart_order_id' => $order_summary['cart_order_id']));
			if ($taxes) {
				Tax::getInstance()->loadTaxes($order_summary['country']);
				foreach ($taxes as $vat) {
					$detail	= Tax::getInstance()->fetchTaxDetails($vat['tax_id']);
					$smarty_data['taxes'][] = array('value' => $GLOBALS['tax']->priceFormat($vat['amount']), 'name' => $detail['name']);
				}
				$GLOBALS['smarty']->assign('TAXES', $smarty_data['taxes']);
			}
			
			$order_summary['percent'] = '';
			if ($order_summary['discount_type'] == 'p') {
				$order_summary['percent'] = number_format(($order_summary['discount']/$order_summary['subtotal'])*100) . '%';
			}
			
			// Price Formatting
			$format	= array('discount','shipping','subtotal','total_tax','total');
			foreach ($format as $field) {
				if (isset($order_summary[$field])) $order_summary[$field] = $GLOBALS['tax']->priceFormat($order_summary[$field]);
			}
			// Delivery Address
			$elements	= array('title_d', 'first_name_d', 'last_name_d', 'company_name_d', 'line1_d', 'line2_d', 'town_d', 'state_d', 'postcode_d', 'country_d');
			foreach ($elements as $key) {
				if (isset($order_summary[$key]) && !empty($order_summary[$key])) {
					if ($key == 'country_d') $order_summary[$key] = getCountryFormat($order_summary[$key]);
					if ($key == 'state_d') $order_summary[$key] = getStateFormat($order_summary[$key]);
					$address[str_replace('_d','',$key)] = strip_tags($order_summary[$key]);
				}
			}

			$GLOBALS['smarty']->assign('ADDRESS_DELIVERY', $address);
			// Invoice Address
			unset($address);
			$elements	= array('title', 'first_name', 'last_name', 'company_name', 'line1', 'line2', 'town', 'state', 'postcode', 'country');
			foreach ($elements as $key) {
				if (isset($order_summary[$key]) && !empty($order_summary[$key])) {
					if ($key == 'country') $order_summary[$key] = getCountryFormat($order_summary[$key]);
					if ($key == 'state') $order_summary[$key] = getStateFormat($order_summary[$key]);
					$address[$key] = strip_tags($order_summary[$key]);
				}
			}
			$GLOBALS['smarty']->assign('ADDRESS_INVOICE', $address);
			$GLOBALS['smarty']->assign('ORDER_DATE', formatTime($order_summary['order_date'],false,true));
			// Store logo
			if (isset($this->_config['skin_style']) && !empty($this->_config['skin_style'])) {
				$skin_logo	= $this->_config['skin_folder'].'-'.$this->_config['skin_style'];
			} else {
				$skin_logo	= $this->_config['skin_folder'];
			}
			$store_logo = $GLOBALS['gui']->getLogo(true, 'invoices');
			$GLOBALS['smarty']->assign('STORE_LOGO', $store_logo);
			// Store Address
			$GLOBALS['smarty']->assign('STORE', array(
				'address' => $GLOBALS['config']->get('config', 'store_address'),
				'county' => getStateFormat($this->_config['store_zone']),
				'country' => getCountryFormat($this->_config['store_country']),
				'postcode' => $GLOBALS['config']->get('config', 'store_postcode'),
				'url' => CC_STORE_URL,
				'name' => $GLOBALS['config']->get('config', 'store_name'))
			);
			$GLOBALS['smarty']->assign('SUM', $order_summary);

			
			$GLOBALS['smarty']->display('print.tpl');
			
	
				
				// Compose the Order Confirmation email to the customer
				if ($content = Mailer::getInstance()->loadContent('cart.order_confirmation', $order_summary['lang'])) {
	
						// Put in items
						foreach ($inventory as $item) {
							if($item['product_id']>0){
								$product			= array_merge($GLOBALS['catalogue']->getProductData($item['product_id']),$item);
								$product['item_price']	= Tax::getInstance()->priceFormat($product['price']);
								$product['price'] 	= Tax::getInstance()->priceFormat($product['price']*$product['quantity']);
								if (!empty($item['product_options'])) $product['product_options'] = implode(' ',unserialize($item['product_options']));
								$vars['products'][]	= $product;
							} else {
								$item['price']	= Tax::getInstance()->priceFormat($item['price']);
								$vars['products'][]	= $item;
							}
						}
						
						if (isset($vars['products']) && !empty($vars['products'])) {
							$GLOBALS['smarty']->assign('PRODUCTS', $vars['products']);
						}
	
						// Put tax in
						if ($taxes) {
							foreach($taxes as $order_tax) {
								$tax_data = Tax::getInstance()->fetchTaxDetails($order_tax['tax_id']);
								$tax['tax_name'] 	= $tax_data['name'];
								$tax['tax_percent'] = sprintf('%.3f',$tax_data['tax_percent']);
								$tax['tax_amount'] 	= Tax::getInstance()->priceFormat($order_tax['amount']);
								$vars['taxes'][]	= $tax;
							}
							if (isset($vars['taxes']) && !empty($vars['taxes'])) {
								$GLOBALS['smarty']->assign('TAXES', $vars['taxes']);
							}
						}
						
						$billing = array (
							'first_name' 	=> $order_summary['first_name'],
							'last_name' 	=> $order_summary['last_name'],
							'company_name' 	=> $order_summary['company_name'],
							'line1' 		=> $order_summary['line1'],
							'line2' 		=> $order_summary['line2'],
							'town' 			=> $order_summary['town'],
							'state' 		=> getStateFormat($order_summary['state']),
							'postcode' 		=> $order_summary['postcode'],
							'country' 		=> getCountryFormat($order_summary['country']),
							'phone' 		=> $order_summary['phone'],
							'email' 		=> $order_summary['email']
						);
						$shipping = array (
							'first_name' 	=> $order_summary['first_name_d'],
							'last_name' 	=> $order_summary['last_name_d'],
							'company_name' 	=> $order_summary['company_name_d'],
							'line1' 		=> $order_summary['line1_d'],
							'line2' 		=> $order_summary['line2_d'],
							'town' 			=> $order_summary['town_d'],
							'state' 		=> getStateFormat($order_summary['state_d']),
							'postcode' 		=> $order_summary['postcode_d'],
							'country' 		=> getCountryFormat($order_summary['country_d'])
						);	

						// Format data
						$order_summary['order_date'] = formatTime($order_summary['order_date'],false,true);
						
						$order_summary['link'] 		= $GLOBALS['storeURL'].'/index.php?_a=vieworder&cart_order_id='.$order_summary['cart_order_id'];
						$GLOBALS['smarty']->assign('DATA', $order_summary);
						$GLOBALS['smarty']->assign('BILLING', $billing);
						$GLOBALS['smarty']->assign('SHIPPING', $shipping);
						$GLOBALS['smarty']->assign('TAXES', $vars['taxes']);
						$GLOBALS['smarty']->assign('PRODUCTS', $vars['products']);
						Mailer::getInstance()->sendEmail($order_summary['email'], $content);
				}
				
	

			$GLOBALS['cart']->clear();
		}
	}

	public function process() {
		return false;
	}

	##################################################

	public function form() {
		return false;
	}
	
	//INICIO TRATAMENTO DEFINIÇÕES REGIONAIS
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
		   
       return $subent_id." ".substr($chk_str, 8, 3)." ".substr($chk_str, 11, 1).$chk_digits;

    }
}