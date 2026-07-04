# Solarman Plugin Changelog

>**IMPORTANT**
>
>If there is no information about the update, it means that the update only involves documentation, translations, or text.

If you'd like to buy me a coffee via PayPal: [Buy Me a Coffee](https://www.paypal.com/donate/?hosted_button_id=JD64LAEUMUWMU)


# 1.2.7

   - Modification of the load animation to allow for a negative load
   - Modification of Modbus registers related to loads for inverters configured with the deye_sg04lp3.yaml file
   - Based on an idea from @Bison, an "info" command has been added to check the status of the inverter query:
      - 0: Query completed successfully
      - 1: Query partially completed successfully
      - 2: Query completely out of service
   - In connection with the order above, add an indicator on the widget's inverter to show the status of the inverter query
      - green: query completed successfully
      - orange: query partially completed successfully
      - red: question completely off-topic
   - Added a configuration file for the Solis Single Phase Hybrid EH1P6K inverters (thanks to @Bison for the file)
   
# 1.2.6

   - Reuse of certain parts of the template should normally have no impact
   - the option to enter template parameters in the equipment configuration in addition to the current method
   
# 1.2.4

   - the ability to scan a range of registers to verify whether they are accessible and to check the validity of the collected data
   - Adding Modbus files for some inverters

# 1.2.3

   - Added the version number in addition to the date in the "Status" field of the plugin's configuration (thanks to @Bad for the help)
   - Improvements to the inverter query process. Now the plugin connects and doesn't disconnect until all registers have been queried (previously, it would disconnect and reconnect for each register range—shame on me).
   - correction of a few typos

# 1.2.2

   - Support for S2-WL-ST keys installed on certain SOLIS inverters (and possibly others?)

# 1.2.1 (12/09/2024) => beta

   - Using the libraries from @nebz and @Mips + @TiTidom-RC (dependance.lib and pyenv.lib)

# 1.1.1b (September 5, 2024) => beta + stable

   - a fix that's a little "neater" than the one quickly added to version 1.1.1

# 1.1.1 (September 2, 2024) => beta + stable

   - Fixed a bug that caused memory to run out

# 1.1.0 (August 28, 2024) => beta + stable

   - Creating a virtual environment for Python
   - Adding and/or modifying YAML configuration files for inverters

# 1.0.9 (July 13, 2024) => beta + stable

   - Fixed a bug that occurred when creating certain pieces of equipment
   - Create a button to post directly in the community

# 1.0.8 (March 30, 2024) => beta + stable

   - Add decoding rules specific to Sofar Solar (time and date); see rules 10 and 11 in the documentation
   - Add a decoding rule with binary output
   - Adding and/or modifying configuration files
   - ability to assign commands to the widget from the device
   - Changed the widget name to solarman_distri_onduleur. Sorry, @phpvarious, for not thinking of that.

# 1.0.7 (December 8, 2023) => beta + stable

   - Add Sofar Solar xxx TL Generation 2 Inverter File
   - Addition of the "refresh" command
   - Bug fixes in the template
   - Add the inverter documentation files when I have them

# 1.0.6 (11/25/2023) => beta

   - Improving Python Process Management
   - Fixed a few bugs
   - Added widget compatibility for the sofar_XXTL-G3.yaml file
   - Add a file to enable sending commands to the inverter

# 1.0.5 (11/11/2023) => beta

   - Added a template to make the display of certain data look nicer
   - template OK pour SOFAR SOLAR HYD x000 EP
   - Fixed a few bugs

# 1.0.4 (10/29/2023) => beta + stable
   
   - bug fixes

# 1.0.3 (10/29/2023) => beta + stable
   
   - Added dependencies to support Yampl for PHP on certain configurations (thanks @Loïc)
   - Fixed an input error in the cron jobs + added the option to enter the time directly (1, 5, etc.)
   - You can include spaces in equipment names; however, the log files will contain "_" instead of spaces.
   - Added a new file for the SOFAR SOLAR XX TL G3 inverter, tested on the SOFAR SOLAR 3000 TL G3 (thanks to @Morzini and @Bernard26300)
   - Modification of the display of equipment commands to include decimal and hexadecimal registers
   - Improvements and bug fixes related to inverter querying
   
# 1.0.2 (10/19/2023) => beta
   
   - bug fix
   - Correcting YAML configuration files
   - Added an update to the equipment orders
   - Added a feature to scan the network for compatible inverters
   
# 1.0.1 (10/16/2023) => beta
   
   - documentation
  
  
# 1.0.0 (10/15/2023) => beta

- First functional beta version
