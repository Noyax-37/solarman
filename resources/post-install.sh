# post-install script for Jeedom plugin teleinfo
#!/bin/bash
PROGRESS_FILE=/tmp/jeedom_install_in_progress_teleinfo
if [ ! -z $1 ]; then
    PROGRESS_FILE=$1
fi
date
touch ${PROGRESS_FILE}
echo 0 > ${PROGRESS_FILE}
echo "********************************************************************"
echo "*  Installation des dépendances depuis le fichier post-install.sh  *"
echo "********************************************************************"
BASEDIR=$(dirname $(readlink -f $0))

pyv="$(python3 -V 2>&1)"
echo "Version de python installée : $pyv"
echo "Repertoire de base pour installation VENV : $BASEDIR"

echo 1 > ${PROGRESS_FILE}
if [ -d "$BASEDIR/../ressources" ];then
echo "Le dossier ressources existe, il sera supprimé !";
sudo -u www-data rm -r -f $BASEDIR/../ressources
fi

echo 5 > ${PROGRESS_FILE}
sudo apt-get update
date
#echo 10 > ${PROGRESS_FILE}
#sudo apt remove -y python3-serial

echo 10 > ${PROGRESS_FILE}
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y php-yaml

echo 15 > ${PROGRESS_FILE}
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y python3
date

echo 20 > ${PROGRESS_FILE}
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y python3-venv python3-pip python3-dev
date

echo 25 > ${PROGRESS_FILE}
sudo -u www-data python3 -m venv $BASEDIR/venv --without-pip --system-site-packages
date

pyv="$($BASEDIR/venv/bin/python3 -V 2>&1)"
echo "Version de python installée en environnement virtuel : $pyv"

sudo -u www-data $BASEDIR/venv/bin/python3 $BASEDIR/get-pip.py --no-cache-dir

sudo -u www-data $BASEDIR/venv/bin/python3 -m pip install --no-cache-dir --upgrade pip wheel

echo 30 > ${PROGRESS_FILE}
sudo -u www-data $BASEDIR/venv/bin/pip3 install --upgrade --no-cache-dir pyyaml
echo 35 > ${PROGRESS_FILE}
sudo -u www-data $BASEDIR/venv/bin/pip3 install --upgrade --no-cache-dir pyudev
echo 40 > ${PROGRESS_FILE}
sudo -u www-data $BASEDIR/venv/bin/pip3 install --upgrade --no-cache-dir serial
echo 45 > ${PROGRESS_FILE}
sudo -u www-data $BASEDIR/venv/bin/pip3 install --upgrade --no-cache-dir requests
echo 50 > ${PROGRESS_FILE}
sudo -u www-data $BASEDIR/venv/bin/pip3 install --upgrade --no-cache-dir umodbus
echo 55 > ${PROGRESS_FILE}

date
rm ${PROGRESS_FILE}
echo "*******************************************"
echo "*  Installation des dépendances terminée  *"
echo "*******************************************"