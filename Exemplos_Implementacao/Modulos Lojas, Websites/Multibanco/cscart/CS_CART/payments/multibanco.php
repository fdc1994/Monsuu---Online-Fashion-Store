<?php

	if (defined('PAYMENT_NOTIFICATION')) {

		$pp_response = array();
	
		$pp_response['order_status'] = 'O';
		fn_finish_payment($_REQUEST['order_id'],$pp_response);
	
		fn_order_placement_routines($_REQUEST['order_id'],false);
		
		}else{
	
		$entidade=$processor_data['params']['entidade'];
		$subentidade=$processor_data['params']['subentidade'];
		$order_total=$order_info['total'];
		$current_location = Registry::get('config.current_location');
		$link_script = $current_location . "/payments/multibanco/ifmb.php";
		$url_return = $current_location . "/$index_script";
	
		echo <<<EOT
			<html>
				<body onload="document.process.submit();">
					<form method="POST" action="{$link_script}" name="process">
						<input type="hidden" name="ENTIDADE" value="{$entidade}" />
						<input type="hidden" name="SUBENTIDADE" value="{$subentidade}" />
						<input type="hidden" name="ID" value="{$order_id}" />
						<input type="hidden" name="VALOR" value="{$order_total}" />
						<input type="hidden" name="RETURN" value="{$url_return}" />
					</form>
				</body>
			</html>
EOT;
	}
?>