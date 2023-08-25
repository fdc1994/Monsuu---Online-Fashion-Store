{* $Id: 2checkout.tpl 10055 2010-07-14 10:15:19Z klerik $ *}

{assign var="r_url" value="payment_notification.notify?payment=multibanco"|fn_url:'C':'http'}
<p>{$lang.multibanco|replace:"[return_url]":$r_url}</p>
<hr />

<div class="form-field">
	<label for="entidade">Entidade:</label>
	<input type="text" name="payment_data[processor_params][entidade]" id="entidade" value="{$processor_params.entidade}" class="input-text" size="5" />
</div>

<div class="form-field">
	<label for="subentidade">Sub-entidade:</label>
	<input type="text" name="payment_data[processor_params][subentidade]" id="subentidade" value="{$processor_params.subentidade}" class="input-text" size="3" />
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" {if $processor_params.mode == "test"}selected="selected"{/if}>{$lang.test}</option>
		<option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>