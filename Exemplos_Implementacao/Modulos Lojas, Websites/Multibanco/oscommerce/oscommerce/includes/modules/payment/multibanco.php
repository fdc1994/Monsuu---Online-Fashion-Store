<?php


 class multibanco {
    var $code, $title, $description, $enabled, $pag;

// class constructor
    function multibanco() {

      global $order, $customer_id;
      $this->code = 'multibanco';
      $this->title = Multibanco;
      $this->description = "Modulo para pagamento Multibanco.";
	  $this->entidade=MODULE_PAYMENT_TRANSFERENCIA_ENTIDADE;
	  $this->sub_entidade=MODULE_PAYMENT_TRANSFERENCIA_SUB_ENTIDADE;
      $this->email_footer =
		MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION."\n\n".MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION;
		
      $this->sort_order = MODULE_PAYMENT_TRANSFERENCIA_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_TRANSFERENCIA_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_TRANSFERENCIA_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_TRANSFERENCIA_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_TRANSFERENCIA_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_TRANSFERENCIA_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
     }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }
    
    

function GenerateMbRef($order_id, $order_value)
{
//     IMPORTANTE: Coloque aqui o seu codigo de entidade e sub-entidade correctamente
       $ent_id = MODULE_PAYMENT_TRANSFERENCIA_ENTIDADE;
       $subent_id = MODULE_PAYMENT_TRANSFERENCIA_SUB_ENTIDADE;
	   $order_id ="0000".$order_id;
	   
	   //     Apenas são considerados os 4 caracteres mais à direita do order_id
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
		   
           $chk_str = sprintf('%05u%03u%04u%08u',$ent_id, $subent_id, $order_id, round($order_value*100));
		   
           $chk_array = array(3, 30, 9, 90, 27, 76, 81, 34, 49, 5, 50, 15, 53, 45, 62,38, 89, 17, 73, 51);
           
           for ($i = 0; $i < 20; $i++)
           {
                 $chk_int = substr($chk_str, 19-$i, 1);
                 $chk_val += ($chk_int%10)*$chk_array[$i];
           }
           
           $chk_val %= 97;
           
           $chk_digits = sprintf('%02u', 98-$chk_val);
           
           $teste .= "<pre>";
           $teste .= "\n<b>Dados para pagamento por Multibanco:</b><p>";
		   $teste .= "</p><img src='http://img412.imageshack.us/img412/9672/30239592.jpg' align='left' width='45'";
           $teste .= "\n<b> Entidade:    </b>".$ent_id;
           $teste .= "\n<b> Referência:  </b>".$subent_id." ".substr($chk_str, 8, 3)." ".substr($chk_str, 11, 1).$chk_digits;
           $teste .= "\n<b> Valor:       </b>".round($order_value,2)." €";
		   $teste .= "\n\n<span style=\"font-size: 9px\">O talão emitido pela caixa automática faz prova de pagamento. Conserve-o.</span>";
           $teste .= "</pre>";
		   
		   
		   
		   
		   return $teste;
    }    
    
	
   function confirmation() { 

   $pag='Seleccionou a forma de pagamento por multibanco. Assim que confirmar a encomenda terá acesso imediato às referências de pagamento na próxima página e por e-mail.';
    return array('title' => $pag);
    }
   
   




    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_TRANSFERENCIA_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de exibição.', 'MODULE_PAYMENT_TRANSFERENCIA_SORT_ORDER', '0', 'Ordem de exibição', '6', '0', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('País Permitido', 'MODULE_PAYMENT_TRANSFERENCIA_ZONE', '0', 'Se uma zona é seleccionada, o pagamento apenas é permitido para esse mesmo País.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Activar o módulo Transferência', 'MODULE_PAYMENT_TRANSFERENCIA_STATUS', 'True', '', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem (Opções de Pagamento)', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION', 'Dados para pagamento por Multibanco', 'Texto a ser exibido para o cliente nas opções de pagamento:', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Numero da Entidade', 'MODULE_PAYMENT_TRANSFERENCIA_ENTIDADE', '', 'Numero da Entidade', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Numero da SubEntidade', 'MODULE_PAYMENT_TRANSFERENCIA_SUB_ENTIDADE', '', 'Numero da SubEntidade', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Texto a Enviar no Email', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION', 'Seu pedido será enviado quando confirmado o pagamento. Para agilizar o processo, envie o comprovante por fax: (xx)xxxx-xxxx ou email: a@a.com.', 'Texto a Enviar no Email', '6', '5', now())");



   }


    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_TRANSFERENCIA_SORT_ORDER','MODULE_PAYMENT_TRANSFERENCIA_STATUS', 'MODULE_PAYMENT_TRANSFERENCIA_TEXT_SELECTION', 'MODULE_PAYMENT_TRANSFERENCIA_ENTIDADE','MODULE_PAYMENT_TRANSFERENCIA_SUB_ENTIDADE','MODULE_PAYMENT_TRANSFERENCIA_TEXT_CONFIRMATION', 'MODULE_PAYMENT_TRANSFERENCIA_ZONE');

    }
  }
   
?>