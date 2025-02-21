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


# """ Scan Modbus registers to find valid registers"""
import sys
import os
import logging
import argparse
import globals
try:
    from jeedom.jeedom import *
except ImportError as ex:
    print("Error: importing module from jeedom folder")
    print(ex)
    sys.exit(1)
from pySolarman import PySolarmanV5, V5FrameError
import umodbus.exceptions
from umodbus import conf
from umodbus.client import tcp


def main(register_start, register_end, register_type):
    try:
        if globals.typecle == 'LSW3':
            modbus = PySolarmanV5(globals.inverter_host, globals.inverter_sn, port=globals.inverter_port, mb_slave_id=globals.inverter_mb_slaveid, logger=logging, auto_reconnect=True, socket_timeout=15)
        else:
            conf.SIGNED_VALUES = True
            sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            sock.connect((globals.inverter_host, globals.inverter_port))
        logging.info(f"Début interrogation de l'onduleur {globals.inverter_name} associé au data logger {globals.inverter_host}:{globals.inverter_port}")
        if register_type == 'read_input' or register_type == 'all':
            logging.info("Scan des input registers (code 0x04)")
            for x in range(register_start, register_end + 1):
                try:
                    if globals.typecle == 'LSW3':
                        val = modbus.read_input_registers(register_addr=x, quantity=1)[0]
                    else:
                        message = tcp.read_input_registers(slave_id=globals.inverter_mb_slaveid, register_addr=x, quantity=1)
                        val = tcp.send_message(message, sock)
                    logging.info(f"Registre: {x:#06x} (en décimal: {x:05}) \tValue en decimal: {val:05} (en hexa: {val:#06x})")
                except (V5FrameError, umodbus.exceptions.IllegalDataAddressError):
                    logging.info(f"Registre: {x:05}\t\tValue: inaccessible")
                    continue
            logging.info("Fin scan input registers")
        if register_type == 'read_holding' or register_type == 'all':
            logging.info("Scan des holding registers (code 0x03)")
            for x in range(register_start, register_end + 1):
                try:
                    if globals.typecle == 'LSW3':
                        val = modbus.read_holding_registers(register_addr=x, quantity=1)[0]
                    else:
                        message = tcp.read_holding_registers(slave_id=globals.inverter_mb_slaveid, register_addr=x, quantity=1)
                        val = tcp.send_message(message, sock)
                    logging.info(f"Registre: {x:#06x} (en décimal: {x:05}) \tValue en decimal: {val:05} (en hexa: {val:#06x})")
                except (V5FrameError, umodbus.exceptions.IllegalDataAddressError):
                    logging.info(f"Registre: {x:#06x}\t\tValue: inaccessible")
                    continue
            logging.info("Fin scan holding registers")
    except:
        logging.error("Erreur scan registers")
        raise


# ------------------------------------------------------------------------------
# MAIN
# ------------------------------------------------------------------------------

parser = argparse.ArgumentParser(description='Solarman python for Jeedom plugin')
parser.add_argument("--loglevel", help="Log Level for the daemon", type=str)

parser.add_argument("--ipclewifi", help="Adresse IP de la cle wifi", type=str)
parser.add_argument("--portclewifi", help="Port de la cle wifi", type=str)
parser.add_argument("--serialclewifi", help="Numero de serie de la cle wifi", type=str)
parser.add_argument("--mbslaveid", help="Id modbus de l onduleur", type=str)
parser.add_argument("--typeclewifi", help="Type de cle raccordee sur l'onduleur", type=str)

parser.add_argument("--register_start", help="premier registre a interroger", type=str)
parser.add_argument("--register_end", help="dernier registre a interroger", type=str)
parser.add_argument("--register_type", help="type de registre a interroger (read_input ou read_holding)", type=str)


args = parser.parse_args()

globals.log_level = args.loglevel
globals.typecle = args.typeclewifi
globals.inverter_host = args.ipclewifi
globals.inverter_port = int(args.portclewifi)
globals.inverter_mb_slaveid = int(args.mbslaveid)
if globals.typecle == "LSW3":
	globals.inverter_sn = int(args.serialclewifi)
else:
	globals.inverter_sn = 0
registerstart = int(args.register_start, 16)
registerend = int(args.register_end, 16)
jeedom_utils.set_log_level(globals.log_level)

logging.info('Solarman ------ debut recup donnees de l onduleur en IP: ' + str(globals.inverter_host))

logging.info('SOLARMAN------ Log level : ' + str(globals.log_level))

logging.info('SOLARMAN------ type de la cle wifi : ' + str(globals.typecle))
logging.info('SOLARMAN------ Adresse IP de la cle wifi : ' + str(globals.inverter_host))
logging.info('SOLARMAN------ Port de la cle wifi : ' + str(globals.inverter_port))
logging.info('SOLARMAN------ Numero de serie de la cle wifi File : ' + str(globals.inverter_sn))
logging.info('SOLARMAN------ Id modbus de l onduleur : ' + str(globals.inverter_mb_slaveid))
logging.info('SOLARMAN------ Type de Registres a scanner : ' + str(args.register_type))
logging.info('SOLARMAN------ Registres a scanner : de ' + str(args.register_start) + ' a ' + str(args.register_end))

main(registerstart, registerend, args.register_type)

try:
    sys.exit() # this always raises SystemExit
except SystemExit:
    logging.info("SOLARMAN------ sys.exit() sortie normale")
except:
    logging.error("SOLARMAN------ probleme lors de la sortie") # some other exception got raised