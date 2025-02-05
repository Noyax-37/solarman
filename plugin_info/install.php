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

function solarman_install() {
    $core_version = '1.1.1';
    $packagesjson = dirname(__FILE__) . '/packages.json';
    if (file_exists($packagesjson)){
        unlink($packagesjson);
    }
    $postinstall = dirname(__FILE__) . '../resources/post-install.sh';
    if (file_exists($postinstall)){
        unlink($postinstall);
    }
    if (!file_exists(dirname(__FILE__) . '/info.json')) {
        log::add('solarman','warning','Pas de fichier info.json');
        goto step2;
    }
    $data = json_decode(file_get_contents(dirname(__FILE__) . '/info.json'), true);
    if (!is_array($data)) {
        log::add('solarman','warning',__('Impossible de décoder le fichier info.json', __FILE__));
        goto step2;
    }
    try {
        $core_version = $data['pluginVersion'];
        config::save('version', $core_version, 'solarman');
    } catch (\Exception $e) {

    }

    step2:
/*
    $crontoday = cron::byClassAndFunction('solarman', 'interroOnduleurs');
    if (!is_object($crontoday)) {
        $crontoday = new cron();
        $crontoday->setClass('solarman');
        $crontoday->setFunction('interroOnduleurs');
        $crontoday->setEnable(1);
        $crontoday->setDeamon(0);
        $crontoday->setSchedule('* * * * *');
        $crontoday->save();
    }
*/
    message::removeAll('solarman');
    message::add('solarman', sprintf(__("Installation du plugin Solarman terminée, vous êtes en version %s. Il est impératif de relancer l'installation des dépendances.", __FILE__), $core_version);
}

function solarman_update() {
    log::add('solarman','debug',__('solarman_update'));
    $core_version = '1.1.1';
    $packagesjson = dirname(__FILE__) . '/packages.json';
    if (file_exists($packagesjson)){
        unlink($packagesjson);
    }
    $postinstall = dirname(__FILE__) . '../resources/post-install.sh';
    if (file_exists($postinstall)){
        unlink($postinstall);
    }
    if (!file_exists(dirname(__FILE__) . '/info.json')) {
        log::add('solarman','warning',__('Pas de fichier info.json', __FILE__));
        goto step2;
    }
    $data = json_decode(file_get_contents(dirname(__FILE__) . '/info.json'), true);
    if (!is_array($data)) {
        log::add('solarman','warning', __('Impossible de décoder le fichier info.json (non bloquant ici)', __FILE__));
        goto step2;
    }
    try {
        $core_version = $data['pluginVersion'];
        config::save('version', $core_version, 'solarman');
    } catch (\Exception $e) {
        log::add('solarman','warning', __('Pas de version de plugin (non bloquant ici)', __FILE__));
        goto step2;
    }

    step2:
    //affectation du level "info" au fichier de log solarman_recherche_reseau
    config::save('log::level::solarman_recherche_reseau', '{"200":"1"}');

    message::add('solarman', __('Mise à jour du plugin Solarman en cours...', __FILE__));
    log::add('solarman','info','*****************************************************');
    log::add('solarman','info',__('*********** Mise à jour du plugin solarman **********', __FILE__));
    log::add('solarman','info','*****************************************************');
    log::add('solarman','info',__('**        Core version    :', __FILE__) . ' '. $core_version. '                **');
    log::add('solarman','info','*****************************************************');

/*
    $crontoday = cron::byClassAndFunction('solarman', 'interroOnduleurs');
    if (is_object($crontoday)) {
        $crontoday->remove();
    }

    $crontoday = cron::byClassAndFunction('solarman', 'interroOnduleurs');
    if (!is_object($crontoday)) {
        $crontoday = new cron();
        $crontoday->setClass('solarman');
        $crontoday->setFunction('interroOnduleurs');
        $crontoday->setEnable(1);
        $crontoday->setDeamon(0);
        $crontoday->setSchedule('* * * * *');
        $crontoday->save();
    }
    $crontoday->stop();
*/

    message::removeAll('solarman');
    message::add('solarman', sprintf(__("Mise à jour du plugin Solarman terminée, vous êtes en version %s. Il est impératif de relancer l'installation des dépendances.", __FILE__), $core_version));
//    solarman::cron();
}

function solarman_remove() {
    $crontoday = cron::byClassAndFunction('solarman', 'interroOnduleurs');
    if (is_object($crontoday)) {
        $crontoday->remove();
    }
    message::removeAll('solarman');
    message::add('solarman', __('Désinstallation du plugin Solarman terminée', __FILE__));
}

