<?php
require("../bootstrap-admin.php");
defined('SYSPATH_ADMIN') or die('No direct script access.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>...</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
    
    <script type="text/javascript" src="jquery-1.5.2.min.js"></script>

    <script>
    function formatar_mascara(src, mascara) {
	    var campo = src.value.length;
	    var saida = mascara.substring(0,1);
	    var texto = mascara.substring(campo);
	    if(texto.substring(0,1) != saida) {
		    src.value += texto.substring(0,1);
	    }
    }
    </script>
    <script type="text/javascript">
    function AddHiddenValue(oForm) {
	var strValue = document.getElementById("cidade").value;
	//alert("value: " + strValue);
	var oHidden = document.createElement("input");
	oHidden.name = "atualiza";
	oHidden.value = strValue;
	oForm.appendChild(oHidden);
    }
    </script>
    
<!--    <script type="text/javascript" src="../js/combo.js"></script>   -->

    <script type="text/javascript" src="../../scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
    // Creates a new plugin class and a custom listbox
    tinymce.create('tinymce.plugins.ExamplePlugin', {
            createControl: function(n, cm) {
                    return null;
            }
    });

    // Register plugin with a short name
    tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

    // Initialize TinyMCE with the new plugin and menu button
    tinyMCE.init({
            //plugins : '-example', // - tells TinyMCE to skip the loading of the plugin
            theme : "advanced",
            mode : "exact",  //textareas
            elements : "editor1",
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom"
    });
    </script>


<!-- dropdown -->
<script type="text/javascript">
$(document).ready(function(){
	load_options('','country');
});

function load_options(id,index){
	$("#loading").show();
	if(index=="state"){
		$("#city").html('<option value="">Select city</option>');
	}
	$.ajax({
		url: "ajax-dropdown.php?index="+index+"&id="+id,
		complete: function(){$("#loading").hide();},
		success: function(data) {
			$("#"+index).html(data);
		}
	})
}
</script>
<!-- dropdown -->


  </head>

  <body>
    <?php include( SYSPATH_ADMIN . "menu.php"); ?>
      <div class="content">
		<div class="hero-unit">
          <h1>Cadastro de Fornecedor</h1>
          <p>Cadastre aqui todas as informa&ccedil;&otilde;es legais do fornecedor.</p>
        </div>	  
		
		<div class="row">
		<div class="span15">
		<table class="zebra-striped">
			<form method="post" action="../model/supplier-insert.php" onsubmit="AddHiddenValue(this);">

				<?php require('../../includes/config/config.php'); ?>
				<?php require('../../includes/Sql/sql.class.php'); ?>
				<?php session_start(); ?>
				
				<input type='hidden' value='1' name='submitted' />
				<!-- DADOS DO ENDERECO DA EMPRESA -->
				<!-- START COMBO estado / endereco -  IMPORTANTE: isso vai para tabela endereco   -->		
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es do Endere&ccedil;o </b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				
				<tr>
					<td align="right">Localiza&ccedil;&atilde;o</td><td>
				
					    <select name="pais" id="country" onchange="load_options(this.value,'state');">
						    <option value="">Select country</option>
					    </select>
					    &nbsp;&nbsp;&nbsp;
					    <select name="estado" id="state" onchange="load_options(this.value,'city');">
						    <option value="">Select state</option>
					    </select>
					    &nbsp;&nbsp;&nbsp;
					    <select name="cidade" id="city">
						    <option value="">Select City</option>
					    </select>
					    <img src="loader.gif" id="loading" align="absmiddle" style="display:none;"/>
					</td>
				</tr>				
				<!-- END COMBO -->
				<tr><td align="right">Logradouro</td><td><input type="text" maxlength="155" name="endereco" size="20" /></td></tr>
				<tr><td align="right">Numero</td><td><input type="text" maxlength="14" name="numero" size="20" /></td></tr>
				<tr><td align="right">Complemento</td><td><input type="text" maxlength="32" name="complemento" size="20" /></td></tr>
				<tr><td align="right">Bairro</td><td><input type="text" maxlength="32" name="bairro" size="20" /></td></tr>
				<tr><td align="right">CEP</td><td><input type="text" maxlength="9" name="cep" size="20" onkeypress="formatar_mascara(this, '#####-###')" /></td></tr>
				<!-- FIM DADOS DO ENDERECO DA EMPRESA -->
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es da Empresa</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<!-- DADOS DA EMPRESA -->
				<tr><td align="right">Raz&atilde;o Social</td><td><input type="text" maxlength="53" name="razao_social" size="20"  /></td></tr>
				<tr><td align="right">Nome Fantasia</td><td><input type="text" maxlength="60" name="nome_fantasia" size="20"  /></td></tr>
				<tr><td align="right">DOC.VALIDO (CNPJ)</td><td><input type="text" maxlength="19" name="cnpj" size="20"  onkeypress="formatar_mascara(this, '###.###.###/####-##')" /></td></tr>
				<tr><td align="right">DOC.VALIDO (IE)</td><td><input type="text" maxlength="15" name="ie" size="20"  onkeypress="formatar_mascara(this, '###.###.###.###')" />  </td></tr>
				<tr><td align="right">DOC.VALIDO (IM)</td><td><input type="text" maxlength="15" name="im" value="" size="20"  />  </td></tr>
				<tr><td align="right">CNAE</td><td><input type="text" maxlength="15" name="cnae" value="" size="20"  title="CNAE Fiscal" alt="CNAE Fiscal" />  </td></tr>
				<tr><td align="right">CRT</td><td><input type="text" maxlength="15" name="crt" value="" size="20"  title="Co de regime tributação" alt="Co de regime tributção" />  </td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Informa&ccedil;&otilde;es de Contato da Empresa</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>		
				<tr><td align="right">Telefone 1</td><td><input type="text" maxlength="12" name="tel1" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /> Resp. <input type="text" maxlength="100" name="resp1" size="20"  /> </td></tr>
				<tr><td align="right">Telefone 2</td><td><input type="text" maxlength="12" name="tel2" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /> Resp. <input type="text" maxlength="100" name="resp2" size="20"  /> </td></tr>
				<tr><td align="right">FAX</td><td><input type="text" maxlength="12" name="fax" size="20"  onkeypress="formatar_mascara(this, '##-####-####')" /></td></tr>
				<tr><td align="right">E-Mail</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">@</span>
                            <input id="prependedInput" class="large" type="text" size="20" name="email">
                        </div>
                    </td>
                </tr>
				<tr><td align="right">Website</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">www</span>
                            <input id="prependedInput" class="large" type="text" maxlength="255" size="50" name="website">
                        </div>
                    </td>
                </tr>
				<tr><td align="right">Facebook Page</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">page</span>
                            <input id="prependedInput" class="large" type="text" maxlength="255" size="50" name="website_fb">
                            <small><i>* Apenas o nome do profile. Ex.: </i> https://www.facebook.com/<b>SUA_PAGINA</b> </small>
                        </div>
                    </td>
                </tr>
				<tr><td align="right">GMAP</td>
                    <td>
                        <div class="input-prepend">
                            <span class="add-on">url</span>
                            <input id="prependedInput" class="span12" type="text" maxlength="255" size="200" name="gmap"><br />
                            <small><i>* O URL da localiza&ccedil;&atilde;o (mapa) do cliente.</i> <br /><br />
                            	Ex.: <span class="label"> https://maps.google.com/maps/ms?msa=0...&amp;ll=-00.010101,-00.010101&amp;spn=0.061188,0.164623&amp;z=13&amp;output=embed </span> 
                            </small>
                        </div>
                    </td>
                </tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right"></td><td><b>Outras Informa&ccedil;&otilde;es da Empresa</b></td></tr>
				<tr><td align="right">&nbsp;</td><td></td></tr>
				<tr><td align="right">Horario Abertura</td>
                    <td><input type="text" maxlength="8" name="abre" size="20"  onkeypress="formatar_mascara(this, '##:##:##')" /> hh:mm:ss </td></tr>
				<tr><td align="right">Horario Fechamento</td>
                    <td><input type="text" maxlength="8" name="fecha" size="20"  onkeypress="formatar_mascara(this, '##:##:##')" /> hh:mm:ss </td></tr>
				<tr><td align="right">Observa&ccedil;&atilde;o</td>
					<td><textarea name="obs" class="span8"></textarea></td>
				</tr>
				<tr><td colspan="2">&nbsp; </td></tr>
				<tr><td colspan="2" align="center"><input type='submit' value="Cadastrar Fornecedor" class="btn success" /></td></tr>
				<!-- FIM DADOS DA EMPRESA -->
			</form>
		</table>
		</div>
		</div>
            <?php include("../footer.php"); ?>
      </div>
    </div>

  </body>
</html>