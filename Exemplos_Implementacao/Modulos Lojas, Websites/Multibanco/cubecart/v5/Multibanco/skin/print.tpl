<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$LANG.common.order_id} {$SUM.cart_order_id}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="modules/gateway/Multibanco/skin/style/print.css" media="screen,print" />
<style type="text/css" media="print">
form, input.button {
	display: none;
	visibility: hidden;
}
</style>
</head>

<body>
<form action="index.php" method="get">
  <input type="submit" value="{$LANG.common.close}" class="button" />
  <input type="button" value="{$LANG.common.print}" class="button" onclick="window.print();" />
  </form>

<div id="wrapper">
  <div id="header">
	 <img src="{$STORE_LOGO}" alt="" />
  </div>

  <div id="address">
	<div id="deliver-to">
	  <strong>{$LANG.address.delivery_address}</strong><br />
	  {$ADDRESS_DELIVERY.title} {$ADDRESS_DELIVERY.first_name} {$ADDRESS_DELIVERY.last_name}<br />
	  {if !empty($ADDRESS_DELIVERY.company_name)}{$ADDRESS_DELIVERY.company_name}<br />{/if}
	  {$ADDRESS_DELIVERY.line1} <br />
	  {if !empty($ADDRESS_DELIVERY.line2)}{$ADDRESS_DELIVERY.line2}<br />{/if}
	  {$ADDRESS_DELIVERY.town}<br />
	  {$ADDRESS_DELIVERY.state}, {$ADDRESS_DELIVERY.postcode}<br />
	  {$ADDRESS_DELIVERY.country}
	</div>
	<div id="invoice-to">
	<strong>{$LANG.address.billing_address}</strong><br />
	  {$ADDRESS_INVOICE.title} {$ADDRESS_INVOICE.first_name} {$ADDRESS_INVOICE.last_name}<br />
	  {if !empty($ADDRESS_INVOICE.company_name)}{$ADDRESS_INVOICE.company_name}<br />{/if}
	  {$ADDRESS_INVOICE.line1}<br />
	  {if !empty($ADDRESS_INVOICE.line2_d)}{$ADDRESS_INVOICE.line2}<br />{/if}
	  {$ADDRESS_INVOICE.town}<br />
	  {$ADDRESS_INVOICE.state}, {$ADDRESS_INVOICE.postcode}<br />
	  {$ADDRESS_INVOICE.country}
	</div>
  </div>

  <div id="info">
    <span style="float: right;"><strong>{$LANG.common.order_id}:</strong> {$SUM.cart_order_id}</span>
	<strong>{$LANG.common.date}:</strong> {$ORDER_DATE}
  </div>

  <div class="product">
    <span class="price"><strong>{$LANG.common.price}</strong></span>
	<strong>{$LANG.common.product}</strong>
  </div>

  {foreach from=$ITEMS item=item}
  <div class="product">
    <span class="price">{$item.price_total}</span>
	{$item.quantity} x {$item.name} {if !empty({$item.product_code})}- {$item.product_code}{/if} ({$item.price})<br />
	{if $item.options} 
	  {foreach from=$item.options item=option}
	    {$option} <br />
	  {/foreach}
	{/if}
  </div>
  {/foreach}

  <div id="totals">
	<div class="total">{$LANG.basket.total_sub}: {$SUM.subtotal}</div>
	<div class="total">{$LANG.basket.total_discount} {if $SUM.percent}({$SUM.percent}){/if}: {$SUM.discount}</div>
	<div class="total">{$LANG.basket.shipping}: {$SUM.shipping}</div>
	{if $TAX}
		<div class="total">{$LANG.basket.total_tax}: {$TAX}</div>
  	{elseif $TAXES}
  		{foreach from=$TAXES item=tax}
  		<div class="total">{$tax.name}: {$tax.value}</div>
  		{/foreach}
  	{/if}
	<div class="total"><strong>{$LANG.basket.total_grand}: {$SUM.total}</strong></div>
  </div>
  {if !empty($SUM.customer_comments)}
  <div>{$LANG.basket.your_comments}:<br /><em>&quot;{$SUM.customer_comments}&quot;</em></div>
  {/if}
  
  <div class="payment_method">
	<!--<strong>{$LANG.module.multibanco.module_description}</strong><br />
	<br />
	<div><strong>{$LANG.gateway.module_entidade}:</strong> {$MODULE.entidade}</div>
	<div><strong>{$LANG.gateway.referencia}:</strong> {$MODULE.accName}</div>
	<div><strong>{$LANG.gateway.valor}:</strong> {$SUM.total}</div>-->
	<br />
	<table cellpadding="0" cellspacing="0" style="margin:auto;border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black; width: 211px;" >
			<tbody>
				<tr>
					<td valign="top" style="border-bottom: solid 1px #222; padding-top: 5px; padding-bottom: 5px;">
						<img src="http://dl.dropbox.com/u/14494130/ifmb/imagensmodulos/mb.gif" border="0">
					</td>
					<td valign="middle" width="100%" style="padding-left: 10px; border-bottom: solid 1px #222; padding-top: 5px; padding-bottom: 5px; ">
						Pagamento por Multibanco&nbsp;&nbsp;
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" style="border-bottom: solid 1px #222; padding-top: 2px; padding-bottom: 2px;">

						<strong>&nbsp;Entidade:</strong>
					</td>
					<td valign="top" align="right" style="border-bottom: solid 1px #222; padding-top: 2px; padding-bottom: 2px; padding-right: 2px;">
						{$MODULE.entidade}
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" style="border-bottom: solid 1px #222; padding-top: 2px; padding-bottom: 2px;">
						<strong>&nbsp;Refer&ecirc;ncia:</strong>
					</td>
					<td valign="top" align="right" style="border-bottom: solid 1px #222; padding-top: 2px; padding-bottom: 2px; padding-right: 2px;">
						{$REFERENCIA}
					</td>
				</tr>
				<tr>
					<td valign="top" align="left" style="border-bottom: solid 1px #222; padding-top: 2px; padding-bottom: 2px; ">
						<strong>&nbsp;Valor:</strong>
					</td>
					<td valign="top" align="right" style="border-bottom: solid 1px #222; padding-top: 2px; padding-bottom: 2px;  padding-right: 2px;">
						{$SUM.total}
					</td>
				</tr>
			</tbody>
		</table>
  </div>

  {if !empty($MODULE.notes)}
  <div id="notes">{$MODULE.notes}</div>
  {/if}

  <div id="thanks">{$LANG.common.thanks}</div>
  <div id="footer">
	{$LANG.gateway.postal_address}: {$STORE.address}, {$STORE.county}, {$STORE.postcode} {$STORE.country}<br />
	{$STORE.name}, {$STORE.url}
  </div>
</div>
</body>
</html>