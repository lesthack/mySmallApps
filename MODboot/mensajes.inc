saludo 	db 13,10,'Bienvenido a MOD Boot Disquete'
	db 13,10,'Simulacion del LOAD de un Sistema Operativo'
	db 13,10,'Escaneando:                   OK'
	db 13,10,'Buscando archivos necesarios: OK'
	db 13,10,'Escriba ayuda para ver comandos.',13,10,0

;######################## cadenas de SHELL.ASM ##############################

prompt	db 13,10,'Shell MOD# ',0
cmd1	db 'ayuda',0
mCmd1	db 13,10,'Comandos disponibles:'
	db 13,10,' ayuda:   muestra esta ayuda'
	db 13,10,' halt:    apaga el sistema'
	db 13,10,' reboot:  reinicia el sistema'
	db 13,10,' exit:    cierra el prompt'
	db 13,10,0

cmd2	db 'halt',0
mCmd2	db 'Apagando el sistema garacias por creer en DiOS',0

cmd3	db 'reboot',0
mCmd3	db 'reiniciando el sistema garacias por creer en DiOS',0

cmd4	db 'exit',0
mCmd4	db 'cerrando linea de comando',0

cmd5	db 'ayuda',0
mCmd5	db 'Ayuda de MOD Boot Disquete',0

mUnkCmd	db 'Comando desconocido, contacte a lesthack@gmail.com',0

;####################### fin cadenas de SHELL.ASM ##########################