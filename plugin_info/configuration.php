<?php
/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
  include_file('desktop', '404', 'php');
  die();
}


sendVarToJS('version', config::byKey('version', 'solarman', 'unknown', true));
include_file('desktop', 'solarman.config', 'js', 'solarman');


$port = config::byKey('port', 'solarman');
$core_version = '1.1.1';

if (!file_exists(dirname(__FILE__) . '/info.json')) {
  log::add('solarman','warning',__('Pas de fichier info.json', __FILE__));
}
$data = json_decode(file_get_contents(dirname(__FILE__) . '/info.json'), true);
if (!is_array($data)) {
  log::add('solarman','warning',__('Impossible de décoder le fichier info.json', __FILE__));
}
try {
  $core_version = $data['pluginVersion'];
} catch (\Exception $e) {
  log::add('solarman','warning',__('Impossible de récupérer la version.', __FILE__));
}

?>
<form class="form-horizontal">
  <fieldset>
    <div class="configGenerale">
      <legend><i class="icon fas fa-warning"></i> {{Options du Plugin}}</legend>
      <div class="form-group">
        <label class="col-sm-4 control-label">{{Recherche d'onduleurs}}</label>
        <div class="col-sm-8">
          <a class="btn btn-warning recherche_ondul" data-choix="recherche_ondul"><i class="fas fa-cogs"></i> {{Scanner le réseau pour trouver les onduleurs qui y sont présents (résultats dans le log "Solarman_recherche_reseau")}}</a>
        </div>
      </div>
      <div class="form-group">
          <label class="col-lg-4 control-label">{{Cycle d'interrogation des onduleurs (en minute)}}</label>
          <div class="col-lg-2">
              <input class="configKey form-control" data-l1key="cron" placeholder="{{non utilisé, saisir en cron de l'équipement}}" disabled="disabled"/>
          </div>
      </div>
      <div class="form-group">
          <label class="col-sm-4 control-label">{{Cycle (s)}}</label>
          <div class="col-sm-2">
              <input class="configKey form-control" data-l1key="cycle" placeholder="{{0.3}}"/>
          </div>
      </div>
    </div>
  </fieldset>
  <br /><br /><br /><br />
  <fieldset>
    <legend><i class="icon fas fa-warning"></i> {{Test scan plage de registres}}</legend>
    <div class="form-group">
      <label class="col-sm-2 control-label">{{Adresse Ip De Votre clé}}
      </label>
      <div class="col-sm-2">
        <input class="scan_reg form-control" data-l1key="ip_cle"/>
      </div>
      <label class="col-sm-2 control-label">{{Port de votre clé}}
      </label>
      <div class="col-sm-2">
        <input class="scan_reg form-control" data-l1key="port_cle"/>
      </div>
      <label class="col-sm-2 control-label">{{Modbus Slave ID}}
      </label>
      <div class="col-sm-2">
        <input class="scan_reg form-control" data-l1key="slave_id"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">{{Type de clé}}
      </label>
      <div class="col-sm-2">
        <select class="scan_reg form-control" data-l1key="type_cle">
          <option value=""></option>
          <option value="LSW3">{{LSW3 (la plus commune, connexion en WIFI)}}</option>
          <option value="ethernet">{{LSE3 (clé identique à la LSW3 mais en connection ethernet) ou S2-WL-ST (utilisée sur quelques onduleurs comme certains SOLIS par exemple)}}</option>
        </select>
      </div>
      <label class="col-sm-2 control-label">{{Numéro de série de votre clé wifi}}
      </label>
      <div class="col-sm-2">
        <input class="scan_reg form-control" data-l1key="serie_cle"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">{{Type de registre à interroger}}
      </label>
      <div class="col-sm-2">
        <select class="scan_reg form-control" data-l1key="type_registre">
          <option value=""></option>
          <option value="read_holding">{{Read holding registeur => modbus code 0x03}}</option>
          <option value="read_input">{{Read input registeur => modbus code 0x04}}</option>
        </select>
      </div>
      <label class="col-sm-2 control-label">{{Premier registre (en hexa = 0x0000)}}
      </label>
      <div class="col-sm-2">
        <input class="scan_reg form-control" data-l1key="register_start"/>
      </div>
      <label class="col-sm-2 control-label">{{Dernier registre (en hexa = 0x0000)}}
      </label>
      <div class="col-sm-2">
        <input class="scan_reg form-control" data-l1key="register_end"/>
      </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">{{Scan des registres (faire "rafraichir" si le log "solarman_scan_reg" n'apparait pas)}}</label>
        <div class="col-sm-8">
          <a class="btn btn-warning scan_register" data-choix="scan_register"><i class="fas fa-cogs"></i> {{Scanner les registres configurés ci-dessus}}</a>
        </div>
      </div>
   </fieldset>
  <br /><br /><br /><br />
  <fieldset>
    <legend><i class="icon loisir-pacman1"></i> {{Version}}</legend>
    <div class="form-group">
        <label class="col-lg-4 control-label">Core Solarman <sup><i class="fas fa-question-circle tooltips" title="{{C'est la version du plugin}}" style="font-size : 1em;color:grey;"></i></sup></label>
        <span style="top:6px;" class="col-lg-4"><?php echo $core_version; ?></span>
    </div>
  </fieldset>

</form>


<script>
      $('.recherche_ondul').on('click', function () {
				$.ajax({// fonction permettant de faire de l'ajax
                type: "POST", // methode de transmission des données au fichier php
                url: "plugins/solarman/core/ajax/solarman.ajax.php", // url du fichier php
                data: {
                    action: "rechercheOndul",
          					id: $('.eqLogicAttr[data-l1key=id]').value()
                },
                dataType: 'json',
                error: function (request, status, error) {
                    handleAjaxError(request, status, error);
                },
                success: function (data) { // si l'appel a bien fonctionné
                    $.fn.showAlert({message: "{{Recherches terminées, aller voir le résultat dans les log 'Solarman_recherche_reseau' }}", level: 'success'});
                }
            	});
	    });

      $('.scan_register').on('click', function () {
        if ($('.scan_reg[data-l1key=type_cle]').value() == 'LSW3'){
          serie_cle = $('.scan_reg[data-l1key=serie_cle]').value();
        } else {
          serie_cle = '123456';
        }
				$.ajax({// fonction permettant de faire de l'ajax
                type: "POST", // methode de transmission des données au fichier php
                url: "plugins/solarman/core/ajax/solarman.ajax.php", // url du fichier php
                data: {
                    action: "scanregister",
          					ipcle: $('.scan_reg[data-l1key=ip_cle]').value(),
                    portcle: $('.scan_reg[data-l1key=port_cle]').value(),
                    mbslaveid: $('.scan_reg[data-l1key=slave_id]').value(),
                    typecle: $('.scan_reg[data-l1key=type_cle]').value(),
                    seriecle: serie_cle,
                    typeregistre: $('.scan_reg[data-l1key=type_registre]').value(),
                    registerstart: $('.scan_reg[data-l1key=register_start]').value(),
                    registerend: $('.scan_reg[data-l1key=register_end]').value()
                },
                dataType: 'json',
                error: function (request, status, error) {
                    handleAjaxError(request, status, error);
                },
                success: function (data) { // si l'appel a bien fonctionné
                    $.fn.showAlert({message: "{{Scan non terminé, aller voir le résultat dans les log 'Solarman_scan_reg' et attendre la fin}}", level: 'success'});
                }
            	});
	    });


</script>

<!-- Inclusion du fichier javascript du plugin (dossier, nom_du_fichier, extension_du_fichier, id_du_plugin) -->
<?php include_file('desktop', 'solarman', 'js', 'solarman'); ?>

