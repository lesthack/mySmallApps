# MODBoot

> Nota: ModBoot es un proyecto universitario que desarrollé en el 2006. Recupere los ficheros y decidí subirlo a un repo. Si ha alguien le sirve, mejor. Si encuentras errores en el, por favor, crea un issue.

El proyecto MOD Boot Disquete consiste en un disquete con la estructura necesaria (archivos programados en ensamblador) para arrancar a una maquina con un procesador de la familia 80x86.

Es decir, se pretende crear una estructura de archivos que en conjunto actúen a similitud de un sistema operativo.

¿Qué es un sistema operativo? Un sistema operativo es un conjunto de programas destinados a permitir la comunicación del usuario con un ordenador y gestionar sus recursos de una manera eficiente.

MOD Boot Disquete es un sistema de archivos que en conjunto están destinados solo al arranque de un ordenador.

La diferencia entre MOD Boot Disquete es simple, MOD no es un sistema operativo, sin embargo, se han investigado aspectos que un sistema operativo comparte.

## Introducción

Cuando una computadora inicia su proceso de encendido, busca en un dispositivo algún software que le indique que hacer. Todo sistema operativo esta cimentado con una base de código ensamblado compilado el cual le dará ordenes para cargar los suficientes recursos para operar.

Quien se encarga de buscar en un sector 0 o mejor conocido como sector Boot es el Bios.

El sector de Boot es el primer sector absoluto (Track 0, head 0, sector 1) de una unidad de disco, ya sea diskette o disco duro en una PC, y está compuesto por los primeros 512 bytes. En ellos se almacenan los archivos "ocultos" (hidden files) del sistema de Inicio del Sistema Operativo, tanto en el MS-DOS como en Windows 95/98, Millenium, NT, 2000  XP.

Según Wikipédoa el BIOS (Basic Input-Output System) es un código de interfaz que localiza y carga el sistema operativo en la RAM; es un software muy básico instalado en la placa base que permite que ésta cumpla su cometido. Proporciona la comunicación de bajo nivel, y el funcionamiento y configuración del hardware del sistema que, como mínimo, maneja el teclado y proporciona salida básica (emitiendo pitidos normalizados por el altavoz del ordenador si se producen fallos) durante el arranque. El BIOS usualmente está escrito en lenguaje ensamblador. El primer término BIOS apareció en el sistema operativo CP/M, y describe la parte de CP/M que se ejecutaba durante el arranque y que iba unida directamente al hardware (las máquinas de CP/M usualmente tenían un simple cargador arrancable en la ROM, y nada más). La mayoría de las versiones de MS-DOS tienen un archivo llamado "IBMBIO.COM" o "IO.SYS" que es análogo al CP/M BIOS.

Así pues, con operaciones básicas de ensamblador y con los conocimientos suficientes del BIOS podremos simular el inicio de un sistema operativo.

## Investigación

### Estructura de un Disquete.

El proyecto MOD se montara sobre un disquete para realizar pruebas antes de montarlo en un dispositivo como un disco duro. El motivo esta en que un disquete (Floppy 3 1/2)  actúa de la misma manera en como un disco duro almacena su información para el arranque de un sistema operativo.

Un Disquete es un dispositivo de almacenamiento externo que en la época actual su uso ya no es común. En tiempos pasados, un sistema operativo residía en un disquete, entonces, al momento de encender el ordenador este buscaba en el sector de inicio del disquete alguno, con la finalidad de procesarlo y darle la oportunidad de ser el intercesor entre usuario-ordenador.

En la época actual, los disquete’s son solo de uso secundario, pero, aun son usados para arrancar un ordenador y decirle a este que se va a ejecutar alguna acción como la instalación de un nuevo sistema operativo, o la reparación de algún daño o alguna otra acción.

Sin embargo, el sector de inicio aun sigue tan presente en todos los medios de almacenamiento, como los Discos Duros, los CD’s, o lo muy actual, las memorias USB.

La estructura de un medio de almacenamiento Magnético como un disquete o un disco duro (aun desconozco como actúa una memoria flash) se divide en caras, pistas y sectores.
Las caras son las superficies del disco que almacenan datos. Los disquetes actuales poseen dos caras: la superior y la inferior. Para acceder a cada cara del disco, las unidades poseen una cabeza de lectura/escritura por cada una. 
Las pistas son anillos concéntricos en cada una de las caras. En los discos duros se denominan cilindros. 
A su vez, las pistas se subdividen en sectores. En la mayoría de los discos un sector almacena 512 bytes de información. 

Las cabezas y cilindros comienzan a numerarse desde el cero y los sectores desde el uno. En consecuencia, el primer sector de un disco duro será el correspondiente a la cabeza 0, cilindro 0 y sector 1. 

La estructura lógica de un disco duro está formada por: 

- El sector de arranque (Master Boot Record) 
- Espacio particionado
- Espacio sin particionar

El sector de arranque es el primer sector de todo disco duro (cabeza 0, cilindro 0, sector 1). En él se almacena la tabla de particiones y un pequeño programa master de inicialización, llamado también Master Boot. Este programa es el encargado de leer la tabla de particiones y ceder el control al sector de arranque de la partición activa. Si no existiese partición activa, mostraría un mensaje de error. 

El espacio particionado es el espacio del disco que ha sido asignado a alguna partición. El espacio no particionado, es espacio no accesible del disco ya que todavía no ha sido asignado a ninguna partición. A continuación se muestra un ejemplo de un disco duro con espacio particionado (2 particiones primarias y 2 lógicas) y espacio todavía sin particionar. 

El caso más sencillo consiste en un sector de arranque que contenga una tabla de particiones con una sola partición, y que esta partición ocupe la totalidad del espacio restante del disco. En este caso, no existiría espacio sin particionar. 

### Organización de la información.

La información se organiza en sectores dentro del disco duro como ya lo hemos visto, cada uno caracterizado por una dirección diferente. Cuando se lee o escribe un sector del disco, debe especificarse dicha dirección. 

Los discos duros para PC son formateados a bajo nivel  por su fabricante con un tamaño de sector de 512  bytes. Esto significa que cada dirección hace referencia a un bloque de 512 datos consecutivos. Asimismo, se puede emplear la dirección de un sector como dirección inicial de un conjunto de sectores consecutivos. 

Durante el arranque del sistema, la escritura y lectura de sectores en los discos duros se lleva a cabo empleando los servicios BIOS INT 13h para discos duros. Una vez el sistema operativo  ha  sido  cargado,  lo  normal  es  que  no  se  empleen  estos  servicios,  sino  los proporcionados por el driver del sistema operativo para dicho disco. 

Actualmente hay dos tipos de servicios BIOS INT 13h para discos duros, de los cuales se hablará  en  el  siguiente  apartado:  los  servicios  estándar  con  traducción  y  los  servicios extendidos. 

Los servicios BIOS INT 13h estándar especifican la dirección de un sector mediante tres números: Cylinder, Head, Sector (cilindro, cabeza y sector). Para especificar el cilindro se emplean 10 bits, del 0 a 1023, para la cabeza 8 bits, del 0 al 255, y para el sector 6 bits, del 1 al 63 (el cero no se usa). A este esquema de direccionamiento se le denomina CHS. Sin embargo, los discos duros a través de su interfaz ATA y SATA direccionan sus sectores empleando un mecanismo de direccionamiento diferente: LBA, o CHS con diferente número 2 de cilindros, cabezas, o sectores por pista . Por el contrario, la  interfaz  SCSI emplea exclusivamente  direccionamiento  LBA.  En  cualquier  caso,  la  BIOS  lleva  a  cabo  la traducción de sus parámetros CHS a los parámetros CHS o LBA del disco duro . 

Con el esquema de direccionamiento CHS (con traducción), los servicios BIOS pueden direccionar cualquier sector de un disco duro con un tamaño menor de 1024 cilindros/disco x 256 cabezas/cilindro x 63 sectores/cabeza x 512 bytes/sector = 8,4  GBytes/disco 20

> Nota. Se ha empleado 1 GByte = 10  bytes. 

Una vez los discos superaron la barrera de 8,4 Gbytes, se añadieron extensiones para los servicios BIOS INT 13h que empleaban un direccionamiento diferente de  los sectores, denominado Logical Block Addressing (LBA). Con este nuevo esquema, los sectores se pueden  direccionar  de  forma  mucho  más  simple  con  un  solo  número  en  el  rango  0  á (máximo nº de sectores -1). Las extensiones BIOS actuales emplean direccionamiento LBA de 48 bits , lo que plantea un límite de capacidad de:

- 2<sup>48</sup> sectores/disco x 512 bytes/sector = 144 PBytes = 144000000 GBytes.

Las BIOS actuales de las placas base permiten emplear tanto direccionamiento CHS como LBA, en este último caso a través de las extensiones del servicio INT 13h.  

La conversión de una dirección CHS a LBA puede hacerse con la siguiente expresión: 

- LBA = (C x Nº de cabezas + H ) x Nº de sectores por pista + S - 1 

Y la conversión de una dirección LBA a CHS con la expresión: 

- C=LBA / (Nº de cabezas x Nº de sectores por pista) 
- TEMP = LBA % (Nº de cabezas x Nº de sectores por pista) 
- H = TEMP / Nº de sectores por pista 
- S = TEMP % Nº de sectores por pista + 1 

Debe notarse que los operadores “/” y “%” son los operadores de división entera y resto, respectivamente. 

A día de hoy, el direccionamiento CHS de discos duros sigue manteniéndose por cuestiones  de compatibilidad. El acceso al disco duros durante las primeras fases del arranque del sistema sigue haciéndose empleando direccionamiento CHS. Más tarde, si se comprueba que pueden usarse las extensiones del servicio INT 13h, se accede al disco duro empleando direccionamiento LBA. 

### Servicios BIOS de acceso al disco.

Estos servicios son los usados por todo el software de bajo nivel para acceder al disco. No obstante, una vez se ha cargado el sistema operativo, lo habitual es que se empleen los servicios proporcionados por un driver del disco.  

Durante el arranque del sistema, la CPU trabaja en el modo real de la arquitectura IA-32, es decir, trabajando con 16 bits y segmentos de tamaño 64 Kbytes definidos directamente por los registro segmento . La conmutación al modo protegido se produce al poco de comenzar la ejecución de un sistema operativo multitarea. 

Los servicios BIOS actuales de acceso al disco pueden dividirse en dos:

- Servicios estándar con traducción.
- Servicios extendidos. 

Los servicios estándar con traducción realizan el acceso al disco utilizando direccionamiento CHS y traducción de direcciones lógicas CHS a direcciones físicas CHS, por lo que pueden acceder a los sumo a los 8,4 Gbytes primeros del disco. El resto del disco resulta inaccesible a través de estos servicios.  

A continuación como referencia se proporcionan los servicios estándar con traducción más comunes, a los cuales se accede a través de la instrucción INT 13h. 

### INT 13h, AH = 02h: Lectura de sectores del disco 

Parámetros:

- AL = Número de sectores a leer en el rango 01h-80h (para caber en un segmento).
- CX contiene en los 10 bits más altos el cilindro lógico (C) de la dirección CHS del primer  sector  a  leer.  Los  6  bits  más  bajos  contienen  el  sector  lógico  (S)  de  la dirección CHS en el rango 01h-3Fh.
- DH = Cabeza (H) de la dirección CHS del primer sector lógico a leer.
- DL =  Disco duro a leer. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.
- ES:BX = Dirección segmentada de  memoria a partir de  la  cual se escriben  los sectores leídos.

Resultados:

- Bit de carry (CF): igual a 1 en caso de error, 0 en caso contrario.
- AH = Código de error cuando el servicio falla, 00h en caso contrario.
- AL = Número de sectores realmente leídos.

### INT 13h, AH = 03h: Escritura de sectores en el disco: 

Parámetros. 

- AL = Número de sectores a escribir.
- CX contiene en los 10 bits más altos el cilindro lógico (C) de la dirección CHS del primer sector a escribir. Los 6 bits más bajos contienen el sector lógico (S) de la dirección CHS en el rango 01h-3Fh.
- DH = Cabeza lógica (H) de la dirección CHS del primer sector a escribir.
- DL =  Disco duro a escribir. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.
- ES:BX = Dirección segmentada de memoria a partir de la cual se leen los sectores a escribir.

Resultados:   

- Bit de carry (CF): igual a 1 en caso de error, 0 en caso contrario.
- AH = Código de error cuando el servicio falla, 00h en caso contrario.
- AL = Número de sectores realmente escritos.

### INT 13h, AH = 08h: Lectura de los parámetros del disco 

Parámetros:   

- DL =  Disco duro a leer. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.

Resultados:

- Bit de carry (CF): igual a 1 en caso de error, 0 en caso contrario.
- AH = Código de error cuando el servicio falla, 00h en caso contrario.
- DL = Número de discos duros en el sistema.   DH = Número de cabezas lógicas - 1.   
- CX contiene en los 10 bits más altos el Nº de cilindros lógicos – 1.  Los 6 bits más bajos contienen el Nº de sectores lógicos del disco. 

Más adelante, los servicios INT 13h fueron extendidos para romper la barrera de los 8,4 Gbytes. Para ello se empleo direccionamiento LBA. Los servicios INT 13h extendidos de acceso al disco duro más empleados son los siguientes: 

### INT 13h, AH = 41h: Comprobación de presencia de extensiones: 

Parámetros  

- DL =  Disco duro a leer. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.   
- BX = 55AAh 

Resultados:

- Bit de carry (CF):  igual  a 1 cuando no se soportan  las extensiones, 0 en caso contrario.
- BX = AA55h si se soportan extensiones.
- AH = Versión de las extensiones Enhanced Disk Driver (EDD) soportadas, ó el código de error 01h cuando no se soportan las extensiones.
- CX = Bitmap que indica las extensiones soportadas. 

### INT 13h, AH = 42h: Lectura extendida de sectores del disco.

Parámetros: 

- DL =  Disco duro a leer. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.   
- DS:SI = Dirección del paquete a partir de la cual se escriben los sectores leídos. 

Resultados:   

- Cuando no hay error, CF = 0 y AH = 0.
- Cuando hay error, CF = 1 y AH = Código de error.  

El paquete que contiene los sectores a leer o escribir tiene el siguiente formato:  

### INT 13h, AH = 43h: Escritura extendida de sectores del disco 

Parámetros:   

- AL = specifica flags para la verificación de la escritura.
- DL =  Disco duro a leer. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.
- DS:SI = Dirección del paquete a partir de la cual se obtienen los sectores a escribir. 

Resultados:   

- Cuando no hay error, CF = 0 y AH = 0.
- Cuando hay error, CF = 1 y AH = Código de error. 
 
### INT 13h, AH = 48h: Lectura extendida de los parámetros del disco 

Parámetros:   

- DL =  Disco duro a leer. El primer disco duro es el 80h, el siguiente 81h y así sucesivamente.
- DS:SI = Dirección del paquete que contiene los parámetros. Este paquete tiene un tamaño de hasta 30 bytes. Los campos más relevantes son solos siguientes: 
	- Bytes 0 a 1: Tamaño máximo del paquete. Como regla práctica, debe llamarse con el valor 30. 
	- Bytes  4 a 7: Número de sectores físicos.  
	- Bytes  8 a 11: Número de cabezas físicas. 
	- Bytes  12 a 15: Número de sectores físicos  por pista. 
	- Bytes 16 a 23: Número de sectores físicos en el disco. 
	- Bytes 24 a 25: Número de bytes por sector. 

Resultados:   

- Cuando no hay error, CF = 0, AH = 0 y los Bytes 0 a 1 a partir de la dirtección DS:SI proporcionan el tamaño real del paquete generado.
- Cuando ocurre un error, CF = 1 y AH = código de error. 

MOD Boot Disquete esta dividido en dos archivos, Boot y Kernel, a su vez Kernel es un solo programa conformado por 4 archivos mas (Por mas comodidad).