<?php
/*
  $Id: account_history_info.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  if (!isset($HTTP_GET_VARS['order_id']) || (isset($HTTP_GET_VARS['order_id']) && !is_numeric($HTTP_GET_VARS['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $customer_info_query = tep_db_query("select o.customers_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " s where o.orders_id = '". (int)$HTTP_GET_VARS['order_id'] . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1'");
  $customer_info = tep_db_fetch_array($customer_info_query);
  if ($customer_info['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY_INFO);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  $breadcrumb->add(sprintf(NAVBAR_TITLE_3, $HTTP_GET_VARS['order_id']), tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $HTTP_GET_VARS['order_id'], 'SSL'));

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order($HTTP_GET_VARS['order_id']);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script type="text/javascript" src="iepngfix_tilebg.js"></script>
<style type="text/css">
.ie6_png 			{behavior: url("iepngfix.htc") }
.ie6_png img		{behavior: url("iepngfix.htc") }
.ie6_png input		{behavior: url("iepngfix.htc") }
</style>
<!--[if IE]>
   <script type="text/javascript" src="ie_png.js"></script>
   <script type="text/javascript">
       ie_png.fix('.png');
   </script>
<![endif]-->
</head>

<body>
<!-- header //-->
<?php $tab_sel = 5; ?>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" class="<?php echo MAIN_TABLE; ?>" cellspacing="0" cellpadding="0">
<tr>
    <td class="<?php echo BOX_WIDTH_TD_LEFT; ?>"><table border="0" class="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="0">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td class="<?php echo CONTENT_WIDTH_TD; ?>"><?php //echo panel_top(); ?>
	
<?php //echo tep_draw_top();?>

<?php //echo tep_draw_title_top();?>

				<?php echo HEADING_TITLE; ?>
			
<?php //echo tep_draw_title_bottom();?>
								
<?php //echo tep_draw1_top();?>	
			
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main indent_2" colspan="2"><b><?php echo sprintf(HEADING_ORDER_NUMBER, $HTTP_GET_VARS['order_id']) . ' <small>(' . $order->info['orders_status'] . ')</small>'; ?></b></td>
          </tr>
          <tr>
            <td class="smallText indent_2"><?php echo HEADING_ORDER_DATE . ' ' . tep_date_long($order->info['date_purchased']); ?></td>
            <td class="smallText" align="right"><?php echo HEADING_ORDER_TOTAL . ' ' . $order->info['total']; ?></td>
          </tr>
        </table>
		
<?php //echo tep_draw_infoBox_top();?>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php
  if ($order->delivery != false) {
?>
            <td width="30%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main indent_2"><b><?php echo HEADING_DELIVERY_ADDRESS; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></td>
              </tr>
<?php
    if (tep_not_null($order->info['shipping_method'])) {
?>
              <tr>
                <td class="main indent_2"><b><?php echo HEADING_SHIPPING_METHOD; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo $order->info['shipping_method']; ?></td>
              </tr>
<?php
    }
?>
            </table></td>
<?php
  }
?>
            <td width="<?php echo (($order->delivery != false) ? '70%' : '100%'); ?>"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
                  <tr>
                    <td class="main" colspan="2"><b><?php echo HEADING_PRODUCTS; ?></b></td>
                    <td class="smallText" align="right"><b><?php echo HEADING_TAX; ?></b></td>
                    <td class="smallText" align="right"><b><?php echo HEADING_TOTAL; ?></b></td>
                  </tr>
<?php
  } else {
?>
                  <tr>
                    <td class="main" colspan="3"><b><?php echo HEADING_PRODUCTS; ?></b></td>
                  </tr>
<?php
  }

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td class="main" align="right" width="30">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
         '            <td class="main">' . $order->products[$i]['name'];

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
      }
    }

    echo '</td>' . "\n";

    if (sizeof($order->info['tax_groups']) > 1) {
      echo '            <td class="main" align="right">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n";
    }

    echo '            <td class="main" align="right">' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
		
<?php //echo tep_draw_infoBox_bottom();?>

	<table cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td class="main indent_2"><b><?php echo HEADING_BILLING_INFORMATION; ?></b></td>
      </tr>
	</table>

<?php //echo tep_draw_infoBox_top();?>
		
		<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo HEADING_BILLING_ADDRESS; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo HEADING_PAYMENT_METHOD; ?></b></td>
              </tr>
              <tr>
                <td class="main"><?php echo $order->info['payment_method']; ?></td>
              </tr>
            </table></td>
            <td width="70%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
    echo '              <tr>' . "\n" .
         '                <td class="main" align="right" width="100%">' . $order->totals[$i]['title'] . '</td>' . "\n" .
         '                <td class="main" align="right">' . $order->totals[$i]['text'] . '</td>' . "\n" .
         '              </tr>' . "\n";
  }
?>
            </table></td>
          </tr>
        </table>

<?php //echo tep_draw_infoBox_bottom();?>		
		
<?php //echo tep_pixel_trans();?>

	<table cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td class="main indent_2"><b><?php echo HEADING_ORDER_HISTORY; ?></b></td>
      </tr>
	 </table>

<?php //echo tep_pixel_trans();?>

		
<?php //echo tep_draw_infoBox_top();?>

		<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $statuses_query = tep_db_query("select os.orders_status_name, osh.date_added, osh.comments from " . TABLE_ORDERS_STATUS . " os, " . TABLE_ORDERS_STATUS_HISTORY . " osh where osh.orders_id = '" . (int)$HTTP_GET_VARS['order_id'] . "' and osh.orders_status_id = os.orders_status_id and os.language_id = '" . (int)$languages_id . "' and os.public_flag = '1' order by osh.date_added");
  while ($statuses = tep_db_fetch_array($statuses_query)) {
    echo '              <tr>' . "\n" .
         '                <td class="main" width="70">' . tep_date_short($statuses['date_added']) . '</td>' . "\n" .
         '                <td class="main" width="70">' . $statuses['orders_status_name'] . '</td>' . "\n" .
         '                <td class="main">' . (empty($statuses['comments']) ? '&nbsp;' : nl2br(tep_output_string_protected($statuses['comments']))) . '</td>' . "\n" .
         '              </tr>' . "\n";
  }
?>
            </table>
			
<?php //echo tep_draw_infoBox_bottom();?>	


<?php 
$pmt = $order->info['payment_method'];

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
           $ref1= $subent_id." ".substr($chk_str, 8, 3)." ".substr($chk_str, 11, 1).$chk_digits;
	return $ref1;
    }    
	
if( $pmt=="Multibanco")
{


//echo tep_pixel_trans();?>

	<table cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td class="main indent_2"><b><?php echo "Dados Multibanco"; ?></b></td>
      </tr>
	 </table>

<?php //echo tep_pixel_trans();?>

		
<?php //echo tep_draw_infoBox_top();?>

		<table cellpadding="3" width="300px" cellspacing="0" style="margin-top: 10px;border: 1px solid #45829F; background-color: #FFFFFF;">
    <tr>
        <td style="font-size: x-small; border-bottom: 1px solid #45829F; background-color: #45829F; color: White" colspan="3">Pagamento por Multibanco ou Homebanking</td>
    </tr>
    <tr>
        <td rowspan="3"><center><img src="http://img412.imageshack.us/img412/9672/30239592.jpg" alt="" width="52" height="60"/></center></td>
        <td style="font-size: x-small; font-weight:bold; text-align:left">Entidade:</td>
        <td style="font-size: x-small; text-align:left"><?php echo MODULE_PAYMENT_TRANSFERENCIA_ENTIDADE; ?></td>
    </tr>
    <tr>
        <td style="font-size: x-small; font-weight:bold; text-align:left">Referência:</td>
        <td style="font-size: x-small; text-align:left"><?php echo GenerateMbRef($HTTP_GET_VARS['order_id'], $order->totals[sizeof($order->totals)-1]['value'])?></td>
    </tr>
    <tr>
        <td style="font-size: x-small; font-weight:bold; text-align:left">Valor:</td>
        <td style="font-size: x-small; text-align:left"><?php echo $order->totals[sizeof($order->totals)-1]['text']; ?></td>
    </tr>
    <tr>
        <td style="font-size: xx-small;border-top: 1px solid #45829F; background-color: #45829F; color: White" colspan="3">O talão emitido pela caixa automática faz prova de pagamento. Conserve-o.</td>
    </tr>
</table>

			
<?php //echo tep_draw_infoBox_bottom();

}?>	






		
<?php
  if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php');
?>

<?php //echo tep_pixel_trans();?>
				
<?php //echo tep_draw_infoBox2_top();?>	
 
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr><td><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, tep_get_all_get_params(array('order_id')), 'SSL') . '">' . tep_image_button('button_back1.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td></tr>
            </table>
				
<?php //echo tep_draw_infoBox2_bottom();?>	
				
<?php //echo tep_draw1_bottom();?>
      		
<?php //echo tep_draw_bottom();?>
	
	</td>
<!-- body_text_eof //-->
	<td class="<?php echo BOX_WIDTH_TD_RIGHT; ?>"><table border="0" class="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="0">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>