#!/usr/bin/python3
# -*- coding: utf-8 -*-
# vim: tabstop=8 expandtab shiftwidth=4 softtabstop=4

# This file is part of Jeedom.
#
# Jeedom is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# Jeedom is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Jeedom. If not, see <http://www.gnu.org/licenses/>.

import logging
import sys
import os
from optparse import OptionParser
from os.path import join
import argparse
import globals
import yaml
import socket
from umodbus import conf
from umodbus.client import tcp
try:
    from jeedom.jeedom import *
except ImportError as ex:
    print("Error: importing module from jeedom folder")
    print(ex)
    sys.exit(1)

#from pysolarmanv5 import PySolarmanV5
from pySolarman import PySolarmanV5
from parser import ParameterParser

QUERY_RETRY_ATTEMPTS = 4

def lire():
	pid = str(os.getpid())
	with open('/var/www/html/plugins/solarman/data/inverters/' + globals.lookup_file) as f:
		parameter_definition = yaml.full_load(f)
	
	result = 0
	erreur = 0
	noLogger = 0
	params = ParameterParser(parameter_definition)
	requests = parameter_definition['requests']
	nbrequests = len(requests)
	logging.debug(f"Interrogation pour [{nbrequests}] intervalles...")
	intervalles = len(requests)

	try:
		if globals.typecle == 'LSW3':
			modbus = PySolarmanV5(globals.inverter_host, globals.inverter_sn, port=globals.inverter_port, mb_slave_id=globals.inverter_mb_slaveid, logger=logging, auto_reconnect=True, socket_timeout=15)
		else:
			conf.SIGNED_VALUES = True
			sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
			sock.connect((globals.inverter_host, globals.inverter_port))
		logging.info(f"Début interrogation de l'onduleur {globals.inverter_name} associé au data logger {globals.inverter_host}:{globals.inverter_port}")
		for request in requests:
			start = request['start']
			end = request['end']
			mb_fc = request['mb_functioncode']
			logging.info(f"Interrogation de [{hex(start)} - {hex(end)}]...")
			_SendData = {}
			attempts_left = QUERY_RETRY_ATTEMPTS
			while attempts_left > 0:
				attempts_left -= 1
				try:
					length = end - start + 1
					if mb_fc==3:
						response=''
						if globals.typecle == 'LSW3':
							response  = modbus.read_holding_registers(register_addr=start, quantity=length)
						else:
							message = tcp.read_holding_registers(slave_id=globals.inverter_mb_slaveid, starting_address=start, quantity=length)
							response = tcp.send_message(message, sock)
					if mb_fc==4:
						if globals.typecle == 'LSW3':
							response  = modbus.read_input_registers(register_addr=start, quantity=length)
						else:
							message = tcp.read_input_registers(slave_id=globals.inverter_mb_slaveid, starting_address=start, quantity=length)
							response = tcp.send_message(message, sock)
					params.parse(response, start, length)        
					result += 1
					erreur = 1
				except Exception as e:
					erreur = 0
					logging.warning(f"Interrogation des registres [{hex(start)} - {hex(end)}] NOK avec l'exception [{type(e).__name__}: {e}]")

				if erreur == 0:
					logging.warning(f"Interrogation des registres [{hex(start)} - {hex(end)}] NOK, il reste [{attempts_left} essai]")
				else:
					logging.debug(f"Interrogation des registres [{hex(start)} - {hex(end)}] succes")
					break
			if result == 0:
				logging.warning(f"Interrogation des registres [{hex(start)} - {hex(end)}] NOK, abandon.")
		if globals.typecle == 'LSW3':
			if 'modbus' in locals():
				try:
					logging.info(f"Deconnexion du logger 'LSW3' {globals.inverter_host}:{globals.inverter_port}")
					modbus.disconnect()
				finally:
					modbus = None
			else:
				noLogger += 1
		else:
			logging.info(f"Deconnexion du logger 'sock' {globals.inverter_host}:{globals.inverter_port}")
			sock.close()
		logging.info(f"Fin interrogation de l'onduleur {globals.inverter_name}...")
		if result >= 1:
			logging.info(f"Interrogations OK pour {result} / {nbrequests} intervalles, mise a jour des donnees.")
			current_val = params.get_result()
			logging.debug('Resultat : ')
			# logging.debug(current_val)
			try:
				_SendData = current_val
				_SendData['PID'] = str(pid)
				logging.debug(_SendData)
				globals.JEEDOM_COM.add_changes('device::' + globals.ideqpmnt, _SendData)
			except Exception:
				error_com = "Connexion error"
				logging.error(error_com)
		else:
			current_val = {}
			if noLogger == intervalles * QUERY_RETRY_ATTEMPTS:
				try:
					_SendData = current_val
					_SendData['PID'] = str(pid)
					logging.debug(_SendData)
					globals.JEEDOM_COM.add_changes('device::' + globals.ideqpmnt, _SendData)
				except Exception:
					error_com = "Connexion error"
					logging.error(error_com)
				logging.error("Attention le plugin ne trouve pas votre logger, il est peut etre eteint sinon verifiez que son adresse IP n'a pas change")
	except Exception as e:
		logging.warning(f"Interrogation de l'onduleur {globals.inverter_sn} a {globals.inverter_host}:{globals.inverter_port} non aboutie avec l'exception [{type(e).__name__}: {e}]")
		current_val = {}
		try:
			_SendData = current_val
			_SendData['PID'] = str(pid)
			logging.debug(_SendData)
			globals.JEEDOM_COM.add_changes('device::' + globals.ideqpmnt, _SendData)
		except Exception:
			error_com = "Connexion error"
			logging.error(error_com)

    

# ------------------------------------------------------------------------------
# MAIN
# ------------------------------------------------------------------------------

parser = argparse.ArgumentParser(description='Solarman python for Jeedom plugin')
parser.add_argument("--apikey", help="Value to write", type=str)
parser.add_argument("--loglevel", help="Log Level for the daemon", type=str)
parser.add_argument("--callback", help="Value to write", type=str)
parser.add_argument("--cyclesommeil", help="Wait time between 2 readline", type=str)
parser.add_argument("--cycle", help="Cycle to send event", type=str)
parser.add_argument("--nameonduleur", help="Nom de l onduleur", type=str)

parser.add_argument("--configonduleur", help="fichier de config onduleur", type=str)
parser.add_argument("--idonduleur", help="Id de l equipement", type=str)
parser.add_argument("--ipclewifi", help="Adresse IP de la cle wifi", type=str)
parser.add_argument("--portclewifi", help="Port de la cle wifi", type=str)
parser.add_argument("--serialclewifi", help="Numero de serie de la cle wifi", type=str)
parser.add_argument("--mbslaveid", help="Id modbus de l onduleur", type=str)
parser.add_argument("--typeclewifi", help="Type de cle raccordee sur l'onduleur", type=str)

args = parser.parse_args()

globals.apikey = args.apikey
globals.log_level = args.loglevel
globals.callback = args.callback
globals.cycle_sommeil = args.cyclesommeil
globals.cycle = args.cycle
globals.inverter_name = str(args.nameonduleur)
globals.lookup_file = args.configonduleur
globals.ideqpmnt = args.idonduleur
globals.typecle = args.typeclewifi
globals.inverter_host = args.ipclewifi
globals.inverter_port = int(args.portclewifi)
globals.inverter_mb_slaveid = int(args.mbslaveid)
globals.path = './html/plugins/solarman/data/inverters/'
if globals.typecle == "LSW3":
	globals.inverter_sn = int(args.serialclewifi)
else:
	globals.inverter_sn = 0

globals.cycle = float(globals.cycle)
globals.cycle = 0
globals.cycle_sommeil = float(globals.cycle_sommeil)


jeedom_utils.set_log_level(globals.log_level)

globals.JEEDOM_COM = jeedom_com(apikey=globals.apikey, url=globals.callback, cycle=globals.cycle)
logging.info('Solarman ------ debut recup donnees de l onduleur : ' + str(globals.ideqpmnt))

logging.info('SOLARMAN------ Apikey : ' + str(globals.apikey))
logging.info('SOLARMAN------ Log level : ' + str(globals.log_level))
logging.info('SOLARMAN------ Callback : ' + str(globals.callback))
logging.info('SOLARMAN------ Cycle Sommeil : ' + str(globals.cycle_sommeil))
logging.info('SOLARMAN------ Cycle : ' + str(globals.cycle))

logging.info('SOLARMAN------ Onduleur : ' + str(globals.inverter_name))
logging.info('SOLARMAN------ Fichier de config : ' + str(globals.lookup_file))
logging.info('SOLARMAN------ Id de l equipement : ' + str(globals.ideqpmnt))
logging.info('SOLARMAN------ type de la cle wifi : ' + str(globals.typecle))
logging.info('SOLARMAN------ Adresse IP de la cle wifi : ' + str(globals.inverter_host))
logging.info('SOLARMAN------ Port de la cle wifi : ' + str(globals.inverter_port))
logging.info('SOLARMAN------ Numero de serie de la cle wifi File : ' + str(globals.inverter_sn))
logging.info('SOLARMAN------ Id modbus de l onduleur : ' + str(globals.inverter_mb_slaveid))
pidd = str(os.getpid())
logging.info('SOLARMAN------ PID : ' + pidd)


if not globals.JEEDOM_COM.test():
    logging.error('MODEM------ Network communication issues. Please fix your Jeedom network configuration.')
    sys.exit()

lire()

try:
    sys.exit() # this always raises SystemExit
except SystemExit:
    logging.debug("SOLARMAN------ sys.exit() sortie normale")
except:
    logging.error("SOLARMAN------ probleme lors de la sortie") # some other exception got raised