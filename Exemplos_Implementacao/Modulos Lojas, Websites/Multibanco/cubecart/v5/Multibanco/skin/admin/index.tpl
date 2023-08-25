<form action="{$VAL_SELF}" method="post" enctype="multipart/form-data">
	<div id="Multibanco" class="tab_content">
  		<h3>{$TITLE}</h3>
		<p class="copyText">{$LANG.multibanco.module_description}</p>
  		<fieldset><legend>{$LANG.module.cubecart_settings}</legend>
			<div><label for="status">{$LANG.common.status}</label><span><input type="hidden" name="module[status]" id="status" class="toggle" value="{$MODULE.status}" /></span></div>
			<div><label for="position">{$LANG.module.position}</label><span><input type="text" name="module[position]" id="position" class="textbox number" value="{$MODULE.position}" /></span></div>
			<div>
				<label for="scope">{$LANG.module.scope}</label>
				<span>
					<select name="module[scope]">
      						<option value="both" {$SELECT_scope_both}>{$LANG.module.both}</option>
      						<option value="main" {$SELECT_scope_main}>{$LANG.module.main}</option>
      						<option value="mobile" {$SELECT_scope_mobile}>{$LANG.module.mobile}</option>
    					</select>
				</span>
			</div>
			<div><label for="default">{$LANG.common.default}</label><span><input type="hidden" name="module[default]" id="default" class="toggle" value="{$MODULE.default}" /></span></div>
		</fieldset>
	

		<fieldset><legend>{$LANG.multibanco.module_dados_titulo}</legend>
			<div><label for="entidade">{$LANG.multibanco.module_entidade}</label><span><input type="text" name="module[entidade]" id="entidade" class="textbox" value="{$MODULE.entidade}" /></span></div>
			<div><label for="subentidade">{$LANG.multibanco.module_subentidade}</label><span><input type="text" name="module[subentidade]" id="subentidade" class="textbox" value="{$MODULE.subentidade}" /></span></div>
		</fieldset>

  		{$MODULE_ZONES}
  		<div class="form_control">
			<input type="submit" name="save" value="{$LANG.common.save}" />
  		</div>
		
		<input type="hidden" name="token" value="{$SESSION_TOKEN}" />
	</div>
</form>