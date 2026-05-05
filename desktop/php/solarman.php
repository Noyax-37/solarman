<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}

sendVarToJS('eqType', 'solarman');
//include_file('desktop', 'solarman.functions', 'js', 'solarman');
// Déclaration des variables obligatoires
$plugin = plugin::byId('solarman');
sendVarToJS('eqType', $plugin->getId());
$eqLogics = eqLogic::byType($plugin->getId());
?>

<?php
/**
 *
 * @param Solaman $eqL
 */
function displayActionCard($action_name, $fa_icon, $action = '', $class = '') {
	echo '<div class="eqLogicAction cursor ' . $class . '" data-action="' . $action . '">';
	echo '<i class="fas ' . $fa_icon . '"></i><br/><span>' . $action_name . '</span>';
	echo '</div>'."\n";
}
?>

<div class="row row-overflow">
	<!-- Page d'accueil du plugin -->
	<div class="col-xs-12 eqLogicThumbnailDisplay">
		<div class="row">
			<div class="col-sm-10">
				<legend><i class="fas fa-cog"></i> {{Gestion}}</legend>
				<!-- Boutons de gestion du plugin -->
				<div class="eqLogicThumbnailContainer">
					<?php
						displayActionCard('{{Ajouter un onduleur}}', 'fa-plus-circle', 'addSolarmanEq', 'logoSecondary');
						displayActionCard('{{Configuration}}', 'fa-wrench', 'gotoPluginConf', 'logoSecondary');
					?>
					<?php
						// à conserver
						// sera afficher uniquement si l'utilisateur est en version 4.4 ou supérieur
						$jeedomVersion  = jeedom::version() ?? '0';
						$displayInfoValue = version_compare($jeedomVersion, '4.4.0', '>=');
						if ($displayInfoValue) {
					?>
						<div class="col-sm-2">
							<div class="eqLogicThumbnailContainer">
								<div class="cursor eqLogicAction logoSecondary warning" data-action="createCommunityPost">
									<i class="fas fa-ambulance"></i>
									<br>
									<span class="warning">{{Créer un post Community}}</span>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<legend><i class="fas fa-table"></i> {{Mes onduleurs}}</legend>
		<?php
		if (count($eqLogics) == 0) {
			echo '<br><div class="text-center" style="font-size:1.2em;font-weight:bold;">{{Aucun équipement trouvé, cliquer sur "Ajouter un onduleur" pour commencer}}</div>';
		} else {
			// Champ de recherche
			echo '<div class="input-group" style="margin:5px;">';
			echo '<input class="form-control roundedLeft" placeholder="{{Rechercher}}" id="in_searchEqlogic">';
			echo '<div class="input-group-btn">';
			echo '<a id="bt_resetSearch" class="btn" style="width:30px"><i class="fas fa-times"></i></a>';
			echo '<a class="btn roundedRight hidden" id="bt_pluginDisplayAsTable" data-coreSupport="1" data-state="0"><i class="fas fa-grip-lines"></i></a>';
			echo '</div>';
			echo '</div>';
			// Liste des équipements du plugin
			echo '<div class="eqLogicThumbnailContainer">';
			foreach ($eqLogics as $eqLogic) {
				$opacity = ($eqLogic->getIsEnable()) ? '' : 'disableCard';
				echo '<div class="eqLogicDisplayCard cursor ' . $opacity . '" data-eqLogic_id="' . $eqLogic->getId() . '">';
				echo '<img src="' . $eqLogic->getImage() . '"/>';
				echo '<br>';
				echo '<span class="name">' . $eqLogic->getHumanName(true, true) . '</span>';
				echo '<span class="hiddenAsCard displayTableRight hidden">';
				echo ($eqLogic->getIsVisible() == 1) ? '<i class="fas fa-eye" title="{{Equipement visible}}"></i>' : '<i class="fas fa-eye-slash" title="{{Equipement non visible}}"></i>';
				echo '</span>';
				echo '</div>';
			}
			echo '</div>';
		}
		?>
	</div> <!-- /.eqLogicThumbnailDisplay -->

	<!-- Page de présentation de l'équipement -->
	<div class="col-xs-12 eqLogic" style="display: none;">
		<!-- barre de gestion de l'équipement -->
		<div class="input-group pull-right" style="display:inline-flex;">
			<span class="input-group-btn">
				<!-- Les balises <a></a> sont volontairement fermées à la ligne suivante pour éviter les espaces entre les boutons. Ne pas modifier -->
				<a class="btn btn-sm btn-default eqLogicAction roundedLeft" data-action="configure"><i class="fas fa-cogs"></i><span class="hidden-xs"> {{Configuration avancée}}</span>
				</a><a class="btn btn-sm btn-default eqLogicAction" data-action="copy"><i class="fas fa-copy"></i><span class="hidden-xs"> {{Dupliquer}}</span>
				</a><a class="btn btn-sm btn-success eqLogicAction" data-action="save"><i class="fas fa-check-circle"></i> {{Sauvegarder}}
				</a><a class="btn btn-sm btn-danger eqLogicAction roundedRight" data-action="remove"><i class="fas fa-minus-circle"></i> {{Supprimer}}
				</a>
			</span>
		</div>
		<!-- Onglets -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation"><a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay"><i class="fas fa-arrow-circle-left"></i></a></li>
			<li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-tachometer-alt"></i> {{Equipement}}</a></li>
			<li role="presentation"><a href="#commandtab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-list"></i> {{Commandes}}</a></li>
		</ul>
		<div class="tab-content">
			<!-- Onglet de configuration de l'équipement -->
			<div role="tabpanel" class="tab-pane active" id="eqlogictab">
				<!-- Partie gauche de l'onglet "Equipements" -->
				<!-- Paramètres généraux et spécifiques de l'équipement -->
				<form class="form-horizontal">
					<fieldset>
						<div class="col-lg-6">
							<legend><i class="fas fa-wrench"></i> {{Paramètres généraux}}</legend>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Nom de l'équipement}}</label>
								<div class="col-sm-6">
									<input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display:none;">
									<input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Objet parent}}</label>
								<div class="col-sm-6">
									<select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
										<option value="">{{Aucun}}</option>
										<?php
										$options = '';
										foreach ((jeeObject::buildTree(null, false)) as $object) {
											$options .= '<option value="' . $object->getId() . '">' . str_repeat('&nbsp;&nbsp;', $object->getConfiguration('parentNumber')) . $object->getName() . '</option>';
										}
										echo $options;
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Catégorie}}</label>
								<div class="col-sm-6">
									<?php
									foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
										echo '<label class="checkbox-inline">';
										echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" >' . $value['name'];
										echo '</label>';
									}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Options}}</label>
								<div class="col-sm-6">
									<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked>{{Activer}}</label>
									<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked>{{Visible}}</label>
								</div>
							</div>

							<legend><i class="fas fa-cogs"></i> {{Paramètres spécifiques}}</legend>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Fichier de configuration utilisé}}
									<sup><i class="fas fa-question-circle tooltips" title="{{non modifiable}}"></i></sup>
								</label>
								<div class="col-sm-6">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="configInverter" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Modèle de clé utilisée}}
									<sup><i class="fas fa-question-circle tooltips" title="{{Voir la documentation pour trouver le modèle clé}}"></i></sup>
								</label>
								<div class="col-sm-6" height="11px">
									<select class="eqLogicAttr configKey" data-l1key="configuration" data-l2key="typeCleWifi">
										<valeur>"LSW3"</valeur>
										<option value="LSW3" selected="yes">{{LSW3 (la plus commune, connection en WIFI)}}</option>
										<option value="ethernet">{{LSE3 (clé identique à la LSW3 mais en connection ethernet) ou S2-WL-ST (utilisée sur quelques onduleurs comme certains SOLIS par exemple)}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Adresse IP de votre clé}}
									<sup><i class="fas fa-question-circle tooltips" title="{{Attention, pas l'adresse de l'onduleur mais de la clé}}"></i></sup>
								</label>
								<div class="col-sm-6">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="ipCleWifi">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Port utilisé par votre clé}}
									<sup><i class="fas fa-question-circle tooltips" title="{{A chercher dans les config de votre clé, en général 8899 pour LSW3 et 502 pour LSE3 ou S2-WL-ST}}"></i></sup>
								</label>
								<div class="col-sm-6">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="portCleWifi" placeholder="{{8899}}">
								</div>
								<label class="col-sm-10 control-label">{{Pour trouver le port, en général 8899, aller sur http://Adresse_Ip_De_Votre_clé_wifi/config_hide.html (utilisateur et mot de passe = "admin")}} </label>
							</div>
							<br><br>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Numéro de série de votre clé wifi}}
									<sup><i class="fas fa-question-circle tooltips" title="{{A chercher dans les config de votre clé}}"></i></sup>
								</label>
								<div class="col-sm-6">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="serialCleWifi">
								</div>
								<label class="col-sm-10 control-label">{{Pour trouver le numéro de série aller sur http://Adresse_Ip_De_Votre_clé/ (dans "STATUS" puis "Device Informations")}} </label>
							</div>
							<br><br>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Modbus Slave ID}}
									<sup><i class="fas fa-question-circle tooltips" title="{{A chercher dans les config de votre onduleur, en général 1}}"></i></sup>
								</label>
								<div class="col-sm-6">
									<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="mbSlaveId" placeholder="{{1}}">
								</div>
							</div>
							<!-- Exemple de champ de saisie du cron d'auto-actualisation avec assistant -->
							<!-- La fonction cron de la classe du plugin doit contenir le code prévu pour que ce champ soit fonctionnel -->
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Auto-actualisation}}
									<sup><i class="fas fa-question-circle tooltips" title="{{Fréquence de rafraîchissement des commandes infos de l'équipement}}"></i></sup>
								</label>
								<div class="col-sm-6">
									<div class="input-group">
										<input type="text" class="eqLogicAttr form-control roundedLeft" data-l1key="configuration" data-l2key="autorefresh" placeholder="{{Cliquer sur ? pour afficher l'assistant cron}}">
										<span class="input-group-btn">
											<a class="btn btn-default cursor jeeHelper roundedRight" data-helper="cron" title="Assistant cron">
												<i class="fas fa-question-circle"></i>
											</a>
										</span>
									</div>
									<label class="col-sm-12 control-label">{{Seuls les auto actualisation à 1, 5, 10, 15 et 30 minutes sont fonctionnelles}} </label>
								</div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-sm-2">
									<span> </span>
								</div>
								<div class="col-sm-8">
									<a class="btn btn-success maj_commandes" data-choix="maj_commandes"><i class="fas fa-cogs"></i> {{Mise à jour manuellement de la valeur des commandes de l'onduleur}}</a>
								</div>
							</div>
							<br><br>
							<div class="form-group">
								<div class="col-sm-2">
									<span> </span>
								</div>
								<div class="col-sm-8">
									<a class="btn btn-warning raz_configInverter" data-choix="raz_configInverter"><i class="fas fa-cogs"></i> {{Rechargement des paramètres de l'onduleur (modification config, suppression par erreur de commande, ...)}}</a>
								</div>
							</div>
                            
                            <!-- Début Configuration Widget -->
							<br><br>
                            <legend><i class="fas fa-palette"></i> {{Paramètres d'affichage du Widget (s'il est utilisé)}}
                                <sup><i class="fas fa-question-circle tooltips" title="Effacer la zone de texte correspondante pour retrouver la valeur par défaut d'un des paramètres"></i></sup>
                            </legend>

							<div class="col-sm-4"></div>
                            <a class="btn btn-info" id="bt_openTemplateHelp"><i class="fas fa-info-circle"></i> {{ À quoi correspondent ces paramètres ? }}</a>
							<br><br>
                            
                            <div class="col-sm-2">
                            </div>
                            <fieldset class="param-template">
                                <!-- Général -->
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{{Couleur arrière plan}}
                                        <sup><i class="fas fa-question-circle tooltips" title="transparent, #ffffff, linear-gradient..."></i></sup>
                                    </label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <!-- Color Picker intégré comme un addon -->
                                            <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;">
                                            </span>
                                            <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="Background" placeholder="transparent">
                                        </div>
                                    </div>
                                </div>

                                <!-- Réseau -->
                                <fieldset><legend>{{Réseau}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Texte Surplus Jour}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="dailyGridSellText"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Texte Conso Réseau}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="dailyGridBuyText"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Puissance Max Réseau}}
                                            <sup><i class="fas fa-question-circle tooltips" title="sert à la vitesse d'animation"></i></sup>
                                        </label>
                                        <div class="col-sm-6"><input type="number" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="gridMaxPower"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur Réseau}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#5490c2">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="gridColor" placeholder="#5490c2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur si réseau HS}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#db041c">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="noGridColor" placeholder="#db041c">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- Solaire -->
                                <fieldset><legend>{{Solaire}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Texte Prod. Jour}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="dailySolarText"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Puissance Max PV}}
                                            <sup><i class="fas fa-question-circle tooltips" title="sert à la vitesse d'animation"></i></sup>
                                        </label>
                                        <div class="col-sm-6"><input type="number" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="pvMaxPower"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur Solaire}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #ffa500;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#ffa500">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="solarColor" placeholder="orange">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom PV1}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="pv1Name" placeholder="PV1"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom PV2}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="pv2Name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom PV3}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="pv3Name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom PV4}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="pv4Name"></div>
                                    </div>
                                </fieldset>

                                <!-- Onduleur -->
                                <fieldset><legend>{{Onduleur}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur Onduleur}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#808080">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="inverterColor" placeholder="grey">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur texte onduleur}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="inverterTxt" placeholder="black">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- Batterie -->
                                <fieldset><legend>{{Batterie}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Texte Charge Jour}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="dailyBatteryChargeText"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Texte Décharge Jour}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="dailyBatteryDischargeText"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Puissance Max Batterie}}
                                            <sup><i class="fas fa-question-circle tooltips" title="sert à la vitesse d'animation"></i></sup>
                                        </label>
                                        <div class="col-sm-6"><input type="number" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="batteryMaxPower"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{SOC Mini}}</label>
                                        <div class="col-sm-6"><input type="number" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="batterySocShutdown"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom Chargeur PV}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="mpptName"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur Batterie}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#ff69b4">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="batteryColor" placeholder="pink">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <!-- Auxiliaire -->
                                <fieldset><legend>{{Auxiliaire}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Puissance Max Aux}}
                                            <sup><i class="fas fa-question-circle tooltips" title="sert à la vitesse d'animation"></i></sup>
                                        </label>
                                        <div class="col-sm-6"><input type="number" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="auxMaxPower"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur Auxiliaire}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#a43df5">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="auxColor" placeholder="#a43df5">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <!-- Charges -->
                                <fieldset><legend>{{Charges (Load)}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Texte Conso Jour}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="dailyLoadText"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Puissance Max Load}}
                                            <sup><i class="fas fa-question-circle tooltips" title="sert à la vitesse d'animation"></i></sup>
                                        </label>
                                        <div class="col-sm-6"><input type="number" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="loadMaxPower"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Couleur Load}}</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon cursor" style="padding: 2px; background-color: #eee;">
                                                    <input type="color" class="color-picker-helper" style="width: 30px; height: 30px; border: none; padding: 0; cursor: pointer;" value="#5fb6ad">
                                                </span>
                                                <input type="text" class="form-control cmdAttr template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="loadColor" placeholder="#5fb6ad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Animation Load}}</label>
                                        <div class="col-sm-6">
                                            <select class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="loadAnimate">
                                                <option value="1">{{Activée}}</option>
                                                <option value="0">{{Désactivée}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom Charge 1}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load1Name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Icone Charge 1}}
                                            <sup><i class="fas fa-question-circle tooltips" title="oven, pump, aircon, boiler, charging"></i></sup>
                                        </label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load1Icon"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom Charge 2}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load2Name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Icone Charge 2}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load2Icon"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom Charge 3}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load3Name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Icone Charge 3}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load3Icon"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Nom Charge 4}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load4Name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Icone Charge 4}}</label>
                                        <div class="col-sm-6"><input type="text" class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="load4Icon"></div>
                                    </div>
                                </fieldset>

                                <!-- Debug -->
                                <fieldset><legend>{{Debug (affiche des infos dans la console)}}</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">{{Mode Debug}}</label>
                                        <div class="col-sm-6">
                                            <select class="cmdAttr form-control template-widget-param" data-l1key="display" data-l2key="parameters" data-l3key="debug">
                                                <option value="0">{{Désactivé}}</option>
                                                <option value="1">{{Activé}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                            </fieldset>

						</div>

                        <!-- Partie droite de l'onglet "Équipement" -->
                        <div class="col-lg-6">
                            <legend><i class="fas fa-info"></i> {{Informations}}</legend>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">{{Description}}</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control eqLogicAttr autogrow" data-l1key="comment"></textarea>
                                </div>
                            </div>
                        </div>

					</fieldset>
				</form>
			</div><!-- /.tabpanel #eqlogictab-->

			<!-- Onglet des commandes de l'équipement -->
			<div role="tabpanel" class="tab-pane" id="commandtab">
				<a class="btn btn-default btn-sm pull-right cmdAction" data-action="add" style="margin-top:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une commande}}</a>
				<br><br>
				<div class="table-responsive">
					<table id="table_cmd" class="table table-bordered table-condensed">
						<thead>
							<tr>
								<th class="hidden-xs" style="min-width:50px;width:70px;">ID</th>
								<th style="min-width:200px;width:350px;">{{Nom}}</th>
								<th>{{Type}}</th>
								<th>{{Registre (en décimal)}}</th>
								<th>{{Registre (en héxadécimal)}}</th>
								<th>{{Utilisation dans widget}}</th>
								<th style="min-width:260px;">{{Options}}</th>
								<th>{{Etat}}</th>
								<th style="min-width:80px;width:200px;">{{Actions}}</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div><!-- /.tabpanel #commandtab-->

		</div><!-- /.tab-content -->
	</div><!-- /.eqLogic -->

	<!-- Modale d'aide pour les paramètres du template -->
	<div class="modal fade" id="md_templateHelp" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">
						<i class="fas fa-info-circle"></i> {{Infos succintes sur l'utilisation des paramètres du widget:}}
					</h4>
				</div>
                <div class="modal-body">
                    <p style="font-size:1.1em; margin-bottom:20px;">
                        {{Ces paramètres permettent de personnaliser l'apparence et le comportement du }}<strong>{{widget spécifique}}</strong> {{de votre onduleur Solarman.}}<br>
                        <small>{{Ils ne s'appliquent que si vous avez choisi d'utiliser le template du plugin (commande '01-Template' visible).}}</small>
                    </p>

                    <div style="display:flex; flex-wrap:wrap; gap:18px; justify-content:center;">

                        <!-- Carte Générale -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#f9f9f9;">
                            <h4 style="margin-top:0; color:#2c7be5;"><i class="fas fa-paint-brush"></i> {{Général}}</h4>
                            <ul style="padding-left:20px; margin:12px 0;">
                                <li><strong>{{Couleur arrière-plan}}</strong> : {{couleur de fond du widget entier}}<br>
                                    <code>transparent</code> | <code>#f0f4f8</code> | <code>linear-gradient(to right, #e0f7fa, #bbdefb)</code>
                                </li>
                            </ul>
                        </div>

                        <!-- Carte Réseau -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#f9f9f9;">
                            <h4 style="margin-top:0; color:#2c7be5;"><i class="fas fa-plug"></i> {{Réseau}}</h4>
                            <ul style="padding-left:20px; margin:12px 0;">
                                <li><strong>{{Texte Surplus / Conso Jour}}</strong> : {{libellé affiché (ex: "Injection réseau", "Achat réseau")}}</li>
                                <li><strong>{{Puissance Max Réseau}}</strong> : {{valeur en W pour calibrer l'animation (ex: 6000)}}</li>
                                <li><strong>{{Couleur Réseau}}</strong> : {{couleur du flux quand le réseau est présent}}</li>
                                <li><strong>{{Couleur si réseau HS}}</strong> : {{couleur quand plus de connexion réseau détectée}}</li>
                            </ul>
                        </div>

                        <!-- Carte Solaire -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#f9f9f9;">
                            <h4 style="margin-top:0; color:#2c7be5;"><i class="fas fa-sun"></i> {{Solaire}}</h4>
                            <ul style="padding-left:20px; margin:12px 0;">
                                <li><strong>{{Texte Prod. Jour}}</strong> : {{ex "Production photovoltaïque"}}</li>
                                <li><strong>{{Puissance Max PV}}</strong> : {{puissance crête installée (ex: 9000) → impacte l'animation}}</li>
                                <li><strong>{{Couleur Solaire}}</strong> : {{couleur du flux PV (souvent orange/jaune)}}</li>
                                <li><strong>{{Nom PV1 / PV2 / PV3 / PV4}}</strong> : {{renommez les entrées MPPT si besoin}}</li>
                            </ul>
                        </div>

                        <!-- Carte Onduleur -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#f9f9f9;">
                            <h4 style="margin-top:0; color:#2c7be5;"><i class="fas fa-microchip"></i> {{Onduleur}}</h4>
                            <ul style="padding-left:20px; margin:12px 0;">
                                <li><strong>{{Couleur Onduleur}}</strong> : {{couleur du corps / icône de l'onduleur}}</li>
                                <li><strong>{{Couleur texte onduleur}}</strong> : {{couleur des valeurs affichées sur l'onduleur}}</li>
                            </ul>
                        </div>

                        <!-- Carte Batterie -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#f9f9f9;">
                            <h4 style="margin-top:0; color:#2c7be5;"><i class="fas fa-battery-full"></i> {{Batterie}}</h4>
                            <ul style="padding-left:20px; margin:12px 0;">
                                <li><strong>{{Texte Charge / Décharge Jour}}</strong> : {{libellés personnalisés}}</li>
                                <li><strong>{{Puissance Max Batterie}}</strong> : {{pour l'animation (ex: 5000)}}</li>
                                <li><strong>{{SOC Mini}}</strong> : {{sert aux calculs de la capacités et du temps restant en décharge (ex: 10)}}</li>
                                <li><strong>{{Nom Chargeur PV}}</strong> : {{nom d'un chargeur éventuel ex "MPPT hybride"}}</li>
                            </ul>
                        </div>

                        <!-- Carte Auxiliaire & Charges -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#f9f9f9;">
                            <h4 style="margin-top:0; color:#2c7be5;"><i class="fas fa-bolt"></i> {{Auxiliaire & Charges}}</h4>
                            <ul style="padding-left:20px; margin:12px 0;">
                                <li><strong>{{Puissance Max Aux / Load}}</strong> : {{calibrage animation}}</li>
                                <li><strong>{{Animation Load}}</strong> : {{1 = activée (pulsation quand conso), 0 = statique}}</li>
                                <li><strong>{{Nom / Icône Charge 1 à 4}}</strong> : {{personnalisation (ex: "Climatisation", "four", "pompe")}}<br>
                                    Icônes possibles : {{oven, pump, aircon, boiler, charging, tv, lightbulb, etc.}}
                                </li>
                            </ul>
                        </div>

                        <!-- Debug -->
                        <div style="flex:1 1 320px; max-width:380px; border:1px solid #ddd; border-radius:8px; padding:16px; background:#fff3cd; border-color:#ffeeba;">
                            <h4 style="margin-top:0; color:#856404;"><i class="fas fa-bug"></i> Debug</h4>
                            <p style="margin:8px 0;">
                                {{Activez le mode Debug (1) pour voir dans la console du navigateur :}}<br>
                                • {{les valeurs reçues}}<br>
                                • {{les calculs d'animation}}<br>
                                • {{les erreurs potentielles}}
                            </p>
                            <small>{{Utile uniquement pour dépanner.}}</small>
                        </div>

                    </div>

                    <div style="margin-top:25px; text-align:center; font-style:italic; color:#666;">
                        {{Pour revenir à la valeur par défaut d'un paramètre → effacez complètement la case correspondante et sauvegardez.}}
                    </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">{{Fermer}}</button>
				</div>
			</div>
		</div>
	</div>

</div><!-- /.row row-overflow -->

<script>
	        $('.raz_configInverter').on('click', function () {
				$.ajax({// fonction permettant de faire de l'ajax
                type: "POST", // methode de transmission des données au fichier php
                url: "plugins/solarman/core/ajax/solarman.ajax.php", // url du fichier php
                data: {
                    action: "razConfigInverter",
    				configInverter: $('.eqLogicAttr[data-l1key=configuration][data-l2key=configInverter]').value(),
					id: $('.eqLogicAttr[data-l1key=id]').value()
                },
                dataType: 'json',
                error: function (request, status, error) {
                    handleAjaxError(request, status, error);
                },
                success: function (data) { // si l'appel a bien fonctionné
                    $.fn.showAlert({message: '{{Mise à jour réussie}}', level: 'success'});
                }
            	});
	        });


	        $('.maj_commandes').on('click', function () {
				$.ajax({// fonction permettant de faire de l'ajax
                type: "POST", // methode de transmission des données au fichier php
                url: "plugins/solarman/core/ajax/solarman.ajax.php", // url du fichier php
                data: {
                    action: "majCommandes",
					id: $('.eqLogicAttr[data-l1key=id]').value()
                },
                dataType: 'json',
                error: function (request, status, error) {
                    handleAjaxError(request, status, error);
                },
                success: function (data) { // si l'appel a bien fonctionné
                    $.fn.showAlert({message: '{{Actualisation des données réussie}}', level: 'success'});
                }
            	});
	        });


// --- Gestion des paramètres du template ---

var solarmanTemplateCmd = null;

function bindTemplateParams() {
    var eqId = $('.eqLogicAttr[data-l1key=id]').value();
    if (!eqId) return;

    $.ajax({
        type: "POST",
        url: "core/ajax/eqLogic.ajax.php",
        data: {
            action: "get",
            id: eqId,
            type: 'solarman'
        },
        dataType: 'json',
        success: function (data) {
            if (data.state == 'ok' && data.result && data.result.cmd) {
                var templateCmd = null;
                for (var i in data.result.cmd) {
                    if (data.result.cmd[i].logicalId == 'Template') {
                        templateCmd = data.result.cmd[i];
                        break;
                    }
                }

                if (templateCmd) {
                    solarmanTemplateCmd = templateCmd;
                    $('.template-widget-param').attr('data-cmd_id', templateCmd.id);

                    var params = {};
                    if (templateCmd.display && templateCmd.display.parameters) {
                        params = templateCmd.display.parameters;
                    }

                    $('.template-widget-param').each(function() {
                        var key = $(this).attr('data-l3key');
                        if (params[key] !== undefined) {
                            $(this).value(params[key]);
                            syncColorPickerFromText($(this));
                        }
                    });
                }
            }
        }
    });
}

function syncColorPickerFromText($textInput) {
    // On cherche le color picker DANS le groupe (il est maintenant dans un span addon)
    var $colorPicker = $textInput.closest('.input-group').find('.color-picker-helper');
    if ($colorPicker.length) {
        var val = $textInput.value();
        if (/^#[0-9A-F]{6}$/i.test(val)) {
            $colorPicker.value(val);
        }
    }
}

// Hook sur le bouton Sauvegarder
var solarmanIsSavingCmd = false;

 $('body').on('click', '.eqLogicAction[data-action=save]', function(e) {
    if (solarmanIsSavingCmd) return;
    if (!solarmanTemplateCmd) return;

    e.preventDefault();
    e.stopImmediatePropagation();

    var params = {};
    $('.template-widget-param').each(function() {
        var key = $(this).attr('data-l3key');
        var val = $(this).value();
        if (key) {
            if (!isNaN(val) && val !== '') {
                params[key] = parseFloat(val);
            } else {
                params[key] = val;
            }
        }
    });

    if (!solarmanTemplateCmd.display) solarmanTemplateCmd.display = {};
    solarmanTemplateCmd.display.parameters = params;

    solarmanIsSavingCmd = true;
    
    jeedom.cmd.save({
        cmd: solarmanTemplateCmd,
        error: function(error) {
            handleAjaxError(error);
            solarmanIsSavingCmd = false;
        },
        success: function() {
            $('.eqLogicAction[data-action=save]')[0].click();
            setTimeout(function() {
                solarmanIsSavingCmd = false;
            }, 1000);
        }
    });
});

// --- Interactions Color Pickers ---

// 1. Quand on change la couleur via le picker -> on met à jour le texte
 $('.eqLogic').on('input change', '.color-picker-helper', function() {
    var textInput = $(this).closest('.input-group').find('input[type="text"]');
    var newColor = $(this).value();
    textInput.value(newColor);
    textInput.change(); 
});

// 2. Quand on tape du texte -> on essaye de mettre à jour le picker
 $('.eqLogic').on('input', '.template-widget-param', function() {
    syncColorPickerFromText($(this));
});

// Hooks Jeedom standard
 $('body').off('jeedom_eqLogic_load').on('jeedom_eqLogic_load', function(event, eqLogic) {
    bindTemplateParams();
});

var templateObserver = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if ($('.eqLogic').is(':visible') && $('.template-widget-param:not([data-cmd_id])').length > 0) {
            bindTemplateParams();
        }
    });
});
templateObserver.observe(document.querySelector('.row.row-overflow'), { attributes: true, subtree: true, attributeFilter: ['style'] });

// affichage de la modale d'aide template
$(document).on('click', '#bt_openTemplateHelp', function() {
	console.log("Ouverture modale aide template");
    $('#md_templateHelp').modal('show');
});





</script>

<!-- Inclusion du fichier javascript du plugin (dossier, nom_du_fichier, extension_du_fichier, id_du_plugin) -->
<?php include_file('desktop', 'solarman', 'js', 'solarman'); ?>
<!-- Inclusion du fichier javascript du core - NE PAS MODIFIER NI SUPPRIMER -->
<?php include_file('core', 'plugin.template', 'js'); ?>