# Registro de cambios del complemento Solarman

>**IMPORTANTE**
>
>Si no hay información sobre la actualización, es porque esta se refiere únicamente a la actualización de la documentación, la traducción o el texto.

Si quieres invitarme a un café a través de PayPal: [Invitar a un café](https://www.paypal.com/donate/?hosted_button_id=JD64LAEUMUWMU)


# 1.2.7

   - modificación de la animación de las cargas para permitir una carga negativa
   - Modificación de los registros Modbus relativos a las cargas de los inversores configurados con el archivo deye_sg04lp3.yaml
   - A partir de una idea de @Bison, se ha añadido un comando «info» para consultar el estado de la consulta del inversor:
      - 0: consulta completada con éxito
      - 1: consulta parcialmente completada con éxito
      - 2: pregunta totalmente fuera de lugar
   - En relación con el pedido anterior, se ha añadido un indicador en el inversor del widget para mostrar el estado de la consulta del inversor.
      - verde: consulta completada con éxito
      - naranja: consulta parcialmente completada con éxito
      - rojo: pregunta totalmente fuera de tema
   - Se ha añadido un archivo de configuración para los inversores Solis Single Phase Hybrid EH1P6K (gracias a @Bison por el archivo)
   
# 1.2.6

   - La reincorporación de algunas partes de la plantilla no debería tener ningún impacto, en principio.
   - posibilidad de introducir los parámetros de la plantilla en la configuración del equipo, además del método actual
   
# 1.2.4

   - posibilidad de escanear un rango de registros para comprobar si son accesibles y si los datos recopilados son correctos
   - Incorporación de archivos Modbus para algunos inversores

# 1.2.3

   - Se ha añadido el número de versión, además de la fecha, en el campo «Estado» de la configuración del plugin (gracias a @Bad por su ayuda)
   - Mejora del proceso de consulta del inversor. Ahora el complemento se conecta y no se desconecta hasta que se han consultado todos los registros (antes se producía una desconexión y reconexión con cada rango de registros, qué vergüenza).
   - corrección de algunos errores tipográficos

# 1.2.2

   - Toma en cuenta las claves S2-WL-ST instaladas en algunos inversores SOLIS (¿quizás también en otros?)

# 1.2.1 (12/09/2024) => beta

   - Uso de las bibliotecas de @nebz y @Mips + @TiTidom-RC (dependance.lib y pyenv.lib)

# 1.1.1b (05/09/2024) => beta + estable

   - una corrección un poco más «limpia» que la que se introdujo rápidamente en la versión 1.1.1

# 1.1.1 (02/09/2024) => beta + estable

   - corrección de un error que provocaba la saturación de la memoria

# 1.1.0 (28/08/2024) => beta + estable

   - Creación de un entorno virtual para Python
   - adición y/o modificación de los archivos de configuración YAML de los inversores

# 1.0.9 (13/07/2024) => beta + estable

   - corrección de un error que se producía al crear determinados equipos
   - Creación de un botón para publicar directamente en la comunidad

# 1.0.8 (30/03/2024) => beta + estable

   - Incorporación de reglas de decodificación específicas de Sofar Solar (hora y fecha); véanse las reglas 10 y 11 en la documentación.
   - Añadir regla de decodificación con restitución en binario
   - Añadir o modificar archivos de configuración
   - posibilidad de asignar comandos al widget desde el equipo
   - He cambiado el nombre del widget a «solarman_distri_onduleur». Lo siento, @phpvarious, por no haberlo pensado antes.

# 1.0.7 (08/12/2023) => beta + estable

   - Añadir archivo del inversor Sofar Solar xxx TL Generación 2
   - Incorporación del comando «refresh»
   - corrección de errores en la plantilla
   - Añadir los archivos DOC de los inversores cuando los tenga

# 1.0.6 (25/11/2023) => beta

   - Mejora de la gestión del proceso en Python
   - corrección de algunos errores
   - Se ha añadido compatibilidad con el widget para el archivo sofar_XXTL-G3.yaml
   - Añadir un archivo para poder enviar órdenes al inversor

# 1.0.5 (11/11/2023) => beta

   - Se ha añadido una plantilla para que la visualización de ciertos datos resulte más atractiva
   - Plantilla válida para SOFAR SOLAR HYD x000 EP
   - corrección de algunos errores

# 1.0.4 (29/10/2023) => beta + estable
   
   - corrección de errores

# 1.0.3 (29/10/2023) => beta + estable
   
   - Se han añadido dependencias para que Yampl para PHP funcione en determinadas configuraciones (gracias, @Loïc)
   - corrección de un error de introducción de datos en los crons + incorporación de la posibilidad de introducir directamente el tiempo (1, 5, etc.)
   - Es posible incluir espacios en los nombres de los equipos; sin embargo, los archivos de registro contendrán «_» en lugar de espacios.
   - Se ha añadido un nuevo archivo para el inversor Sofar Solar XX TL G3, probado en el SOFAR SOLAR 3000 TL G3 (gracias a @Morzini y @Bernard26300)
   - Modificación de la visualización de los comandos de un equipo con la incorporación de los registros en formato decimal y hexadecimal
   - Mejoras y corrección de errores en la consulta del inversor
   
# 1.0.2 (19/10/2023) => beta
   
   - corrección de un error
   - corrección de archivos de configuración YAML
   - Incorporación y actualización de los controles en el equipo
   - Se ha añadido una función para escanear la red en busca de inversores compatibles
   
# 1.0.1 (16/10/2023) => beta
   
   - documentación
  
  
# 1.0.0 (15/10/2023) => beta

- Primera versión beta funcional
