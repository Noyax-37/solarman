<br><br><br>

Presentación
===
El plugin Solarman permite recuperar la información de tu inversor supervisado por el sitio web https://home.solarmanpv.com/, como por ejemplo los modelos Sofar Solar HYD de 3 a 6 kW de potencia nominal.

Archivos de configuración automática para: Afore_BNTxxxKTL-2mppt, deye_2mppt, deye_4mppt, deye_hybrid, deye_sg04lp3, deye_string, hyd-zss-hp-3k-6k, kstar_hybrid, sofar_g3hyd, sofar_hyd3k-6k-es, sofar_lsw3, sofar_wifikit, sofar_XXTL-G3.yaml, solis_1p8k-5g, solis_3p-4g, solis_hybrid, solis_s6-gr1p, zcs_azzurro-ktl-v3.
<br>

Lista (no exhaustiva) de los inversores compatibles actualmente y el archivo de configuración correspondiente:
<br>
La documentación de los inversores se encuentra en [este directorio](docs_onduleurs/ )
<br>

| Archivo de configuración   | Inversores compatibles | Observaciones |
|----------------------------|------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| Afore_BNTxxxKTL-2mppt.yaml | ? | |
| deye_2mppt.yaml | Microinversor DEYE con 2 seguidores MPPT  | p. ej., SUN600G3-EU-230 / SUN800G3-EU-230 / SUN1000G3-EU-230 |
| deye_4mppt.yaml | Microinversor DEYE con 4 seguidores MPPT  | p. ej. SUN1300G3-EU-230 / SUN1600G3-EU-230 / SUN2000G3-EU-230 |
| deye_hybrid.yaml | Inversores híbridos DEYE/Sunsynk/SolArk     | se utiliza cuando no se especifica ninguna búsqueda |
| deye_sg04lp3.yaml | DEYE/Sunsynk/SolArk Hybrid 8/12K-SG04LP3 | p. ej., 12K-SG04LP3-EU |
| deye_string.yaml | Inversores de cadena DEYE/Sunsynk/SolArk     | p. ej., SUN-4/5/6/7/8/10/12K-G03 Plus |
| hyd-zss-hp-3k-6k.yaml | ? | |
| kstar_hybrid.yaml | ? | |
| sofar_g3hyd.yaml | Inversor híbrido trifásico SOFAR | HYD 6000 o versión renombrada (trifásico), p. ej., ZCS Azzurro 3PH HYD-ZSS |
| sofar_hyd3k-6k-es.yaml     | Inversor híbrido monofásico SOFAR | Monofásico, compatible con Sofar Solar HYD xxxx ES (probado con el modelo 6000) o productos de otras marcas, p. ej., ZCS Azzurro HYD-ZSS |
| sofar_hyd-xxktl-3ph.yaml   | Inversor híbrido trifásico SOFAR | Probado en un Sofar Hyd 15KTL trifásico |
| sofar_lsw3.yaml | Inversores SOFAR | |
| sofar_TL_G2.yaml | Inversores SOFAR X Gen 2 | |
| sofar_wifikit.yaml | ? | |
| sofar_XXTL-G3.yaml | SOFAR xxxx TL G3 | Probado en Sofar Solar 3000 TL G3 |
| solid_1p8k-5g.yaml | SOLIS 1P8K-5G | |
| solid_3p-4g.yaml | SOLIS 3P-4G | |
| solis_hybrid.yaml | Inversor SOLIS Hybrid | |
| solid_s6-grip.yaml | SOLIS S6-GRIP | |
| zcs_azzurro-ktl-v3.yaml    | Inversores ZCS Azzurro KTL-V3 | ZCS Azzurro 3.3/4.4/5.5/6.6 KTL-V3 (versión renombrada del Sofar KTLX-G3) |

<br><br><br><br><br>


Requisitos previos:
===
Para poder recuperar la información de tu inversor, necesitas un inversor compatible (lista no exhaustiva más arriba) equipado con un adaptador wifi. Tiene este aspecto:

* llave LSW3 (la más habitual):

![Clave de wifi](cle_wifi.png)

<br>
<br>

* clave S2-WL-ST (en algunos inversores SOLIS y quizá en otras marcas)

![Clave 2](clé_S2-WL-ST.jpg)

<br>
<br>

Instalación del complemento
===
¿Necesitas alguna explicación? Vale, pues una vez instalado el plugin, actualiza las dependencias

<br>
<br>

Configuración general del complemento
===
![Configuración general](recherche.png)

<br>
<br>
Hay un botón que permite buscar en la red los inversores que hay en ella; por el momento, solo funciona con las llaves LSW3:
<br>

Para buscar, el nivel de registro debe estar, como mínimo, en «info»: haz clic en el 1; si no aparece el botón de registro 3, haz clic en el 2 y, por último, haz clic en el botón 3.

Este es el tipo de registro que verás aparecer:

![Registro de búsqueda de red](log_recherche.png)

Solo tendrá que copiar la dirección IP y el número de serie en la configuración de su inversor.

Nada más que destacar. Un campo al que no se puede acceder para una posible ampliación, aunque no es seguro que esta llegue a materializarse.

<br>
<br>
<br>
<br>
<br>

Creación de un nuevo equipo
===
![Nuevo equipamiento](ajout_ondul.png)

Haz clic en el signo «+» de «Añadir»

## Elección
<br>

![Elección del equipamiento](ajout_ondul1.png)

Ponle un nombre a tu nuevo equipo y, a continuación, elige el archivo de plantilla que se utilizará para configurarlo

<br>

## Configuración del equipo:
<br>

![configuración del equipo](param_equipmnt.png)
<br>
Los primeros campos son los habituales.

A partir de ese momento, el archivo de configuración que haya seleccionado ya no se podrá modificar. Si se ha equivocado, elimine ese equipo y vuelva a crear otro.

Debe seleccionar el modelo de llave wifi que está instalado en su inversor (véase más arriba)

Debe introducir la dirección IP de su adaptador wifi, el puerto que utiliza para comunicarse y su número de serie. El puerto suele ser el 8899 o el 502, dependiendo del modelo de adaptador instalado, pero tendrá que buscar el número de serie en la configuración del adaptador.

La página de configuración se puede ver en tu navegador de Internet introduciendo la dirección de tu dispositivo: http://adresse_ip_de_votre_clé_wifi. El nombre de usuario y la contraseña predeterminados, si no los has cambiado, son «admin» y «admin».

![configuración de la clave wifi](param_cle.png)

A continuación, elija la frecuencia de consulta que desee; solo son válidas las opciones de 1, 5, 10, 15 y 30 minutos.

El botón verde situado en la parte inferior de la pantalla sirve para forzar la actualización de los valores de tu inversor

El botón naranja restablece los registros utilizados para que coincidan con los del archivo de configuración empleado. Esto es necesario si modificas el archivo YAML de configuración. Sin embargo, ten en cuenta que, si aparecen errores, la única solución es volver a empezar desde el principio creando un nuevo equipo.


Plantilla de widget
===

Se ha añadido una plantilla (gracias a @Phpvarious) que permite mostrar los datos principales del inversor de una forma más visual. De momento solo lo he completado para mi inversor (Sofar Solar HYD xxx ES), pero puedes adaptarlo tú mismo (consulta el archivo de configuración más abajo).

Desde la versión 1.0.8, la información que alimenta la plantilla se puede asignar directamente desde los controles del equipo => ya no es necesario modificar el archivo YAML

![widgetgif](widget.gif)

Si ha instalado una versión anterior a la integración de este widget o si modifica el archivo de configuración, es necesario que haga clic en el botón de restablecimiento de datos que se encuentra en los ajustes del dispositivo.

Verás que aparece en los controles de tu equipo un comando llamado «template». Puedes elegir si quieres que se muestren los controles o no.

![Plantilla 1](template1.jpg)

Si vas a la sección de configuración / visualización, verás el widget que se utiliza.

![Plantilla 2](template2.jpg)

Al deslizar hacia abajo, aparecerán los ajustes opcionales del widget

![plantilla3](template3.jpg)


Si su inversor no aparece en la lista o si necesita adaptar el archivo existente
===

Si cree que su inversor puede ser uno de los que Solarman puede monitorizar y conoce los registros Modbus que hay que consultar, puede utilizar el [archivo de plantilla](modele_onduleur.yaml) para crear uno nuevo, respetando siempre los siguientes principios:

## para la sección «solicitudes»:

ejemplo:

solicitudes:
  - inicio: 0x0200
fin:  0x0255
mb_functioncode: 0x03
  - inicio: 0x10B0
fin: 0x10BC
mb_functioncode: 0x04

Por lo tanto, debe conocer los códigos de función Modbus que se utilizan para consultar los registros de su inversor. Para cada «mb_functioncode», debe indicar el intervalo entre el primer registro que se va a consultar, «start», y el último, «end».

## para la sección «parameters»:

ejemplo:

parámetros:
 - grupo: blablabla
Artículos: bla, bla, bla
    - name: «El nombre del registro»
widget: «El nombre de la parte del widget (consulta la ayuda más abajo)»  => ya no es necesario a partir de la versión 1.0.8
Hombre: «¿Qué?»
escala: 0,01
regla: 1
registros: [0x0200]
  
    - nombre: «Producción total»
widget: «El nombre de la parte del widget (consulta la ayuda más abajo)»  => ya no es necesario a partir de la versión 1.0.8
uom: «kWh»
escala: 1
regla: 3
registros: [0x0255, 0x0254]
  
    - nombre: «Corriente de red»
widget: «El nombre de la parte del widget (consulta la ayuda más abajo)»  => ya no es necesario a partir de la versión 1.0.8
hombre: «A»
escala: 0,01
regla: 2
registros: [0x10B0]
  
    - nombre: «Estado del inversor»
widget: "" (introduce este comando si el widget no utiliza esta información)  => ya no es necesario a partir de la versión 1.0.8
hombre: ""
escala: 1
regla: 1
registros: [0x10BC]
isstr: true
búsqueda:
      -  clave: 0
valor: «En espera»
      -  clave: 1
valor: «Autocomprobación»
      -  clave: 2
valor: «Normal»
      -  clave: 3
valor: «Comprobación del estado de descarga»
      -  clave: 4
valor: «Estado de descarga»
      -  clave: 5
valor: «Estado del EPS»
      -  clave: 6
valor: «Estado de fallo»
      -  clave: 7
valor: «Estado permanente»
  
### explicaciones

instrucciones clave:

grupo: no se utiliza en el complemento, pero hay que mantenerlo; el texto que viene a continuación no sirve para nada. ¡A pesar de todo, es necesario mantenerlo!
items: idem group. En esta instrucción agruparás los distintos registros que le pedirás al complemento que consulte.
nombre: nombre que aparecerá para tu pedido en Jeedom
widget: nombre de la parte del widget a la que se va a enviar este comando (véase la ayuda más abajo)  => ya no es necesario a partir de la versión 1.0.8
uom: aquí se indica entre comillas la unidad de medida de lo que se almacena en el registro; se utilizará en Jeedom
escala: factor multiplicador que se debe utilizar. Por ejemplo, una escala de 0,1 convierte el valor 100 en 10
regla: regla que el complemento deberá aplicar para interpretar los valores almacenados en el registro:
1: entero sin signo => valor entre 0 y 65 535 (FF FF en hexadecimal)
2: entero con signo => valor entre -32 768 y +32 768
3: entero sin signo almacenado en varios bytes (véase la sección «registros»)
4: entero con signo almacenado en varios registros
5: valor ASCII
6: uso de los bits
7: versión (?)
8: fecha y hora
9:00
10: hora al estilo Sofar (los 8 bits de orden alto convertidos a decimal indican las horas y los 8 bits de orden bajo indican los minutos)
11: fecha en formato SOFAR (los 8 bits de orden alto, convertidos a decimal, indican los meses, y los 8 bits de orden bajo, los días)
12: representación binaria de los días de la semana en formato SOFOR (en 7 bits, siendo el bit menos significativo el lunes)
13: representación en binario
registros: el registro o registros que almacenan los valores. Siempre deben indicarse en formato hexadecimal y entre corchetes (matriz). Si hay varios registros, deben separarse con una coma y ordenarse de mayor a menor.
isstr: opcional si es false. Si es true, indica que el valor es un carácter y que se traducirá utilizando la clave de búsqueda que se indica a continuación
lookup: lista de los significados del registro en función de su valor.
clave: valor del registro que se va a convertir en texto
valor: texto que se mostrará en lugar del valor del registro
  
Asegúrate de respetar la estructura de este archivo: los guiones en algunas líneas y no en otras, la sangría, el uso o no de comillas, etc.

En cuanto al widget, esta es la información que se puede introducir:

![Ayuda sobre widgets](widget_help.png)

Leyenda:
Negro: Datos que hay que introducir en el equipo.
Rojo: Parámetros opcionales.


Para más detalles, puedes consultar la página de @Phpvarious dedicada íntegramente a su widget:

https://phpvarious.github.io/documentation/widget/fr_FR/widget_scenario/distribution_onduleur/


Agradecimientos
===

Gracias a @jmccrohan por haber desarrollado la excelente biblioteca pySolarmanV5 [https://pysolarmanv5](https://pysolarmanv5.readthedocs.io/en/stable/#)

Gracias a [@StephaneJoubert](https://github.com/StephanJoubert/home_assistant_solarman), quien ha desarrollado un módulo para Home Assistant del que he extraído algunos datos y archivos Python muy bien escritos

Gracias a [@Ppvarious](https://phpvarious.github.io/documentation/fr_FR/) por su fantástico widget.

Por último, gracias a [@Lydie13](https://community.jeedom.com/u/lydie13) por haber traducido los archivos de configuración a nuestro idioma

Error
===

Si detectas algún error en el complemento, puedes solicitar ayuda:

[https://community.jeedom.com/tag/plugin-solarman](https://community.jeedom.com/tag/plugin-solarman)


Si aparece el error «Cannot uninstall 'PyYAML'. Es un proyecto instalado con distutils...» al instalar las dependencias, ve a «Configuración/Sistema/Configuración», luego a la pestaña «>_OS/DB» y, por último, a «>_Administración del sistema» y ejecuta el comando «sudo -H pip3 install --ignore-installed PyYAML». A continuación, reinicia la instalación de las dependencias y todo debería volver a funcionar correctamente.

