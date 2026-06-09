<br><br><br>

Overview
===
The Solarman plugin allows you to retrieve data from your inverter monitored by the website https://home.solarmanpv.com/, such as the Sofar Solar HYD models ranging from 3 to 6 kW.

Auto-configuration files for: Afore_BNTxxxKTL-2mppt, deye_2mppt, deye_4mppt, deye_hybrid, deye_sg04lp3, deye_string, hyd-zss-hp-3k-6k, kstar_hybrid, sofar_g3hyd, sofar_hyd3k-6k-es, sofar_lsw3, sofar_wifikit, sofar_XXTL-G3.yaml, solis_1p8k-5g, solis_3p-4g, solis_hybrid, solis_s6-gr1p, zcs_azzurro-ktl-v3.
<br>

List (not exhaustive) of inverters currently supported and their associated configuration files:
<br>
The inverter documentation can be found in [this directory](docs_inverters/)
<br>

| Configuration file   | Supported inverters | Notes |
|----------------------------|------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
Afore_BNTxxxKTL-2mppt.yaml | ? | |
| deye_2mppt.yaml | DEYE Microinverter with 2 MPPT Trackers  | e.g. SUN600G3-EU-230 / SUN800G3-EU-230 / SUN1000G3-EU-230 |
| deye_4mppt.yaml | DEYE Microinverter with 4 MPPT Trackers  | e.g. SUN1300G3-EU-230 / SUN1600G3-EU-230 / SUN2000G3-EU-230 |
| deye_hybrid.yaml | DEYE/Sunsynk/SolArk Hybrid inverters     | used when no lookup specified |
| deye_sg04lp3.yaml | DEYE/Sunsynk/SolArk Hybrid 8/12K-SG04LP3 | e.g., 12K-SG04LP3-EU |
| deye_string.yaml | DEYE/Sunsynk/SolArk String inverters     | e.g. SUN-4/5/6/7/8/10/12K-G03 Plus |
| hyd-zss-hp-3k-6k.yaml | ? | |
| kstar_hybrid.yaml | ? | |
| sofar_g3hyd.yaml | SOFAR Hybrid Three-Phase inverter | HYD 6000 or rebranded (three-phase), ex. ZCS Azzurro 3PH HYD-ZSS |
| sofar_hyd3k-6k-es.yaml     | SOFAR Hybrid Single-Phase Inverter | Single-phase, compatible with Sofar Solar HYD xxxx ES (tested on the 6000) or rebranded models, e.g., ZCS Azzurro HYD-ZSS |
| sofar_hyd-xxktl-3ph.yaml   | SOFAR Hybrid Three-Phase inverter | Testé sur un Sofar Hyd 15KTL 3 phases |
| sofar_lsw3.yaml | SOFAR Inverters | |
| sofar_TL_G2.yaml | SOFAR Inverters X Gen 2 | |
| sofar_wifikit.yaml | ? | |
| sofar_XXTL-G3.yaml | SOFAR xxxx TL G3 | Tested on Sofar Solar 3000 TL G3 |
| solid_1p8k-5g.yaml | SOLIS 1P8K-5G | |
| solid_3p-4g.yaml | SOLIS 3P-4G | |
| solis_hybrid.yaml | SOLIS Hybrid inverter | |
| solid_s6-grip.yaml | SOLIS S6-GRIP | |
| zcs_azzurro-ktl-v3.yaml    | ZCS Azzurro KTL-V3 inverters | ZCS Azzurro 3.3/4.4/5.5/6.6 KTL-V3 (rebranded Sofar KTLX-G3) |

<br><br><br><br><br>


Prerequisites:
===
To retrieve data from your inverter, you need a compatible inverter (see the non-exhaustive list above) equipped with a Wi-Fi dongle. It looks like this:

* LSW3 key (the most common):

![Wi-Fi Key](cle_wifi.png)

<br>
<br>

* S2-WL-ST key (on certain SOLIS inverters and possibly other brands)

![Key 2](clé_S2-WL-ST.jpg)

<br>
<br>

Installing the plugin
===
Need some clarification? Okay, so once the plugin is installed, update the dependencies

<br>
<br>

General plugin settings
===
![General Settings](recherche.png)

<br>
<br>
A button allows you to search the network for the inverters connected to it; this feature is currently available only with LSW3 keys:
<br>

To check the log level, make sure it is set to at least "info": click 1; if the log 3 button does not appear, click 2; and finally, click the 3 button.

Here is the type of log you will see:

![Network search log](log_recherche.png)

All you have to do is copy the IP address and serial number into your UPS settings.

Nothing else in particular. A field that isn't open to future changes, though it's not certain those changes will ever happen.

<br>
<br>
<br>
<br>
<br>

Creating a new piece of equipment
===
![New equipment](ajout_ondul.png)

Click the "Add" button

## Choice
<br>

![Equipment Selection](ajout_ondul1.png)

Give your new equipment a name, then select the template file you want to use to configure it

<br>

## Equipment setup:
<br>

![equipment configuration](param_equipmnt.png)
<br>
The first fields are standard.

After that, the configuration file you selected will no longer be editable. If you made a mistake, delete this device and create a new one.

Select the Wi-Fi key model installed on your UPS (see above)

You will need to enter the IP address of your Wi-Fi adapter, the port it uses for communication, and its serial number. The port is usually 8899 or 502, depending on the model of adapter installed, but you will need to find the serial number in the adapter's settings.

You can access the configuration page in your web browser by entering your dongle's address: http://adresse_ip_de_votre_clé_wifi. The default username and password, if you haven't changed them, are admin and admin.

![Wi-Fi key settings](param_cle.png)

Next, select the polling interval you want; only 1, 5, 10, 15, and 30 minutes are valid.

The green button at the bottom of the screen is used to force an update of your inverter's values

The orange button resets the active registries to match those in the configuration file. This is necessary if you modify the YAML configuration file. However, be careful: if errors are displayed, the only option is to start over by recreating a new device.


Widget template
===

Added a template (thanks to @Phpvarious) that displays the inverter's key data in a more visual way. For now, I’ve only set it up for my inverter (Sofar Solar HYD xxx ES), but you can customize it yourself (see the configuration file below).

Starting with version 1.0.8, the data used to populate the template can be set directly via the device controls => no need to edit the YAML file anymore

![widgetgif](widget.gif)

If you installed a version that predates the integration of this widget, or if you modify the configuration file, you must click the "Reset Data" button in the device settings.

You will see a command called "template" appear in your device's controls. You can choose whether or not to display these commands.

![Template 1](template1.jpg)

If you go to the Settings / Display section, you'll see the widget being used.

![Template 2](template2.jpg)

As you scroll down, you'll see the widget's optional settings appear

![template3](template3.jpg)


If your inverter isn't on the list or if you need to modify the existing file
===

If you think your inverter is one of those that can be monitored by Solarman and you know which Modbus registers to query, then you can use the [template file](modele_onduleur.yaml) to create one, making sure to follow these guidelines:

## For the "requests" section:

example:

requests:
  - start: 0x0200
end:  0x0255
mb_functioncode: 0x03
  - start: 0x10B0
end: 0x10BC
mb_functioncode: 0x04

You must therefore know the Modbus function codes used to query your inverter's registers. For each "mb_functioncode," you must specify the range between the first register to be queried, "start," and the last, "end."

## For the "parameters" section:

example:

parameters:
 - group: blah blah blah
Items: blah blah blah
    - name: "The name of the registry"
widget: "The name of the widget section (see the help below)"  => is no longer required as of version 1.0.8
man: "What"
scale: 0.01
rule: 1
registers: [0x0200]
  
    - name: "Total Production"
widget: "The name of the widget section (see the help below)"  => is no longer required as of version 1.0.8
unit: "kWh"
scale: 1
rule: 3
registers: [0x0255, 0x0254]
  
    - name: "Grid Current"
widget: "The name of the widget section (see the help below)"  => is no longer required as of version 1.0.8
man: "A"
scale: 0.01
rule: 2
registers: [0x10B0]
  
    - name: "Inverter status"
widget: "" (include this command if the widget does not use this information)  => no longer required as of version 1.0.8
man: ""
scale: 1
rule: 1
registers: [0x10BC]
isstr: true
lookup:
      -  key: 0
value: "Stand-by"
      -  key: 1
value: "Self-Checking"
      -  key: 2
value: "Normal"
      -  key: 3
value: "Discharging Check State"
      -  key: 4
value: "Discharging State"
      -  key: 5
value: "EPS State"
      -  key: 6
value: "Fault State"
      -  key: 7
value: "Permanent State"
  
### explanations

Key instructions:

group: Not used in the plugin, but must be kept; the text that follows is unnecessary. It must be kept regardless!
items: idem group. Under this directive, you will list the various registers that you want the plugin to query.
name: the name that will be displayed for your order in Jeedom
widget: name of the widget section to be populated by this command (see the help below)  => no longer required as of version 1.0.8
uom: Here, the unit of measurement for the value stored in the register is specified in quotation marks; it will be used in Jeedom.
scale: multiplier to use. For example, a scale of 0.1 converts the value 100 to 10
rule: the rule that the plugin must apply to interpret the values stored in the registry:
1: unsigned integer => value between 0 and 65,535 (FF FF in hexadecimal)
2: signed integer => value between -32,768 and +32,768
3: unsigned integer stored across multiple bytes (see the "Registers" section)
4: signed integer stored across multiple registers
5: ASCII value
6: Using Bits
7: version (?)
8: Date and time
9:00 a.m.
10: time in SOFAR format (the 8 most significant bits converted to decimal represent the hours, and the 8 least significant bits represent the minutes)
11: date in SOFAR format (the 8 most significant bits converted to decimal represent the month, and the 8 least significant bits represent the day)
12: binary representation of the days of the week in SOFOR format (using 7 bits, with Monday as the least significant bit)
13: Binary representation
registers: the register(s) storing the values. Always specify in hexadecimal and enclosed in square brackets (array). If there are multiple registers, separate them with a comma and list them in descending order from highest to lowest.
isstr: optional if false. If true, indicates that the value is a string and should be translated using the lookup key below
lookup: a list of registry key meanings based on their values.
key: registry value to be converted to text
value: text that will be displayed in place of the registry value
  
Be sure to follow the structure of this file exactly: hyphens on some lines but not others, indentation, quotation marks (or not), etc.

Here is the information you can enter for the widget:

![Widget aid](widget_help.png)

Caption:
Black: Fields to be filled in for the equipment.
Red: Optional settings.


For more details, you can visit @Phpvarious's page, which is entirely dedicated to his widget:

https://phpvarious.github.io/documentation/widget/fr_FR/widget_scenario/distribution_onduleur/


Acknowledgments
===

Thanks to @jmccrohan for developing the excellent pySolarmanV5 library [https://pysolarmanv5](https://pysolarmanv5.readthedocs.io/en/stable/#)

Thanks to [@StephaneJoubert](https://github.com/StephanJoubert/home_assistant_solarman), who developed a module for Home Assistant; I was able to gather some information and very well-written Python files from it.

Merci à [@Ppvarious](https://phpvarious.github.io/documentation/fr_FR/) pour son super widget.

Finally, thank you to [@Lydie13](https://community.jeedom.com/u/lydie13) for translating the configuration files into our language

Bug
===

If you encounter a bug with the plugin, you can ask for help:

[https://community.jeedom.com/tag/plugin-solarman](https://community.jeedom.com/tag/plugin-solarman)


If you get the error "Cannot uninstall 'PyYAML'. It is a distutils installed project..." when installing dependencies, go to "Settings/System/Configuration," then go to the ">_OS/DB" tab, and finally to ">_System Administration" and run the command "sudo -H pip3 install --ignore-installed PyYAML". Then restart the dependency installation and everything should work fine.

