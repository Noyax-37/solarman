# Registro de cambios del plugin Solarman


>**IMPORTANTE**
>
>Si no hay información sobre la actualización, es porque esta se refiere únicamente a cambios en la documentación, la traducción o el texto.

Si quieres invitarme a un café por PayPal: [Invitar a un café](https://www.paypal.com/donate/?hosted_button_id=JD64LAEUMUWMU)


# 1.2.6

   - La reutilización de algunas partes de la plantilla no debería tener ningún impacto
   - posibilidad de introducir los parámetros de la plantilla en la configuración del equipo, además del método actual
   
# 1.2.4

   - posibilidad de escanear un rango de registros para comprobar si son accesibles y la conformidad de los datos recopilados
   - Incorporación de archivos Modbus para algunos inversores

# 1.2.3

   - Se ha añadido el número de versión, además de la fecha, en el campo «Estado» de la configuración del plugin (gracias a @Bad por su ayuda)
   - Mejora del proceso de consulta del inversor. Ahora el complemento se conecta y no se desconecta hasta que se han consultado todos los registros (antes se desconectaba y volvía a conectarse con cada rango de registros, qué vergüenza).
   - corrección de algunos errores tipográficos

# 1.2.2

   - Toma en cuenta las llaves S2-WL-ST instaladas en algunos inversores SOLIS (¿quizás en otros también?)

# 1.2.1 (12/09/2024) => beta

   - uso de las bibliotecas de @nebz y @Mips + @TiTidom-RC (dependance.lib y pyenv.lib)

# 1.1.1b (05/09/2024) => beta + estable

   - una corrección un poco más «limpia» que la que se introdujo rápidamente en la versión 1.1.1

# 1.1.1 (02/09/2024) => beta + estable

   - corrección de un error que provocaba un agotamiento de la memoria

# 1.1.0 (28/08/2024) => beta + estable

   - Creación de un entorno virtual para Python
   - adición y/o modificación de los archivos de configuración YAML de los inversores

# 1.0.9 (13/07/2024) => beta + estable

   - corrección de un error que se producía al crear determinados equipos
   - creación de un botón para publicar directamente en la comunidad

# 1.0.8 (30/03/2024) => beta + estable

   - Incorporación de reglas de decodificación específicas de Sofar Solar (hora y fecha); véanse las reglas 10 y 11 en la documentación
   - Añadir regla de decodificación con restitución en binario
   - adición o modificación de archivos de configuración
   - posibilidad de asignar comandos al widget desde el equipo
   - He cambiado el nombre del widget a solarman_distri_onduleur. Lo siento, @phpvarious, por no haberlo pensado antes.

# 1.0.7 (08/12/2023) => beta + estable

   - Añadir archivo del inversor Sofar Solar xxx TL Generación 2
   - Incorporación del comando «refresh»
   - corrección de errores en la plantilla
   - Añadiré los archivos DOC de los inversores cuando los tenga

# 1.0.6 (25/11/2023) => beta

   - Mejora de la gestión del proceso en Python
   - corrección de algunos errores
   - Se ha añadido compatibilidad con widgets para el archivo sofar_XXTL-G3.yaml
   - Añadir un archivo para poder enviar comandos al inversor

# 1.0.5 (11/11/2023) => beta

   - Se ha añadido una plantilla para que la visualización de ciertos datos resulte más atractiva
   - Plantilla válida para SOFAR SOLAR HYD x000 EP
   - corrección de algunos errores

# 1.0.4 (29/10/2023) => beta + estable
   
   - corrección de errores

# 1.0.3 (29/10/2023) => beta + estable
   
   - Se han añadido dependencias para incluir Yampl para PHP en determinadas configuraciones (gracias, @Loïc)
   - corrección de un error de introducción de datos en las tareas programadas + incorporación de la posibilidad de introducir directamente la duración (1, 5, etc.)
   - Es posible incluir espacios en los nombres de los equipos; sin embargo, los archivos de registro contendrán «_» en lugar de espacios
   - Se ha añadido un nuevo archivo para el inversor Sofar Solar XX TL G3, probado en el Sofar Solar 3000 TL G3 (gracias a @Morzini y @Bernard26300)
   - Modificación de la visualización de los comandos de un equipo con la incorporación de los registros en formato decimal y hexadecimal
   - Mejoras y corrección de errores en la consulta del inversor
   
# 1.0.2 (19/10/2023) => beta
   
   - corrección de un error
   - corrección de archivos de configuración YAML
   - Incorporación de una actualización de los controles en el equipo
   - se ha añadido una función para escanear la red en busca de inversores compatibles
   
# 1.0.1 (16/10/2023) => beta
   
   - documentación
  
  
# 1.0.0 (15/10/2023) => beta

- Primera versión beta funcional
