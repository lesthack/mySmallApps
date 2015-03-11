[ORG 0x0000]		
[BITS 16]

;# KERNEL.ASM ##############################################################
;# el Sistema Operativo!

;# Funcion init ############################################################
;# Descripcion:
;#	Establece los valores iniciales para que el SO funcione
;# Parametros:
;# 	-
;# Retorno:
;#	-
;# Nota:
;#	-
;###########################################################################

init:
	cli			; desabilitamos las interrupciones
	mov ax,cs		; cargo en ax cs
	mov ds,ax		; ds = cs
	mov es,ax		; es = cs
	mov ax,0x9000		; ax = 0x9000
	mov ss,ax		; ss = ax
	mov sp,0xFFFF		; sp = 0xFFFF ( la pila crece hacia abajo )
	sti			; habilito las interrupciones

	jmp main

;# Funcion main ############################################################
;# Descripcion:
;#	el metodo principal del sistema operativo
;# Parametros:
;# 	-
;# Retorno:
;#	-
;# Nota:
;#	-
;###########################################################################

main:
	call setUp
	call shell		; llamamos al interprete de comandos
	call halt		; bloqueamos la maquina
	ret

;# Funcion reboot ##########################################################
;# Descripcion:
;#	reinicia la maquina
;# Parametros:
;# 	-
;# Retorno:
;#	No va a retornar nunca ( creo ) :)
;# Nota:
;#	-
;###########################################################################

reboot:
	jmp 0xFFFF:0x0000	; saltamos a FFFF:0000
	ret			; en realidad nunca va a volver pero...

;# Funcion halt ############################################################
;# Descripcion:
;#	bloquea el micro
;# Parametros:
;# 	-
;# Retorno:
;#	no retorna...
;# Nota:
;#	lo hago asi y no con un bucle infinito porque lei por ahi que
;#	de esa forma se calienta el micro...
;###########################################################################

halt:
	cli			; desabilito las interrupciones
	hlt			; bloqueo el micro
	ret			; en realidad nunca va a volver pero...

;# Funcion setUp ##########################################################
;# Descripcion:
;#	en teoria aca se hace el setUp pero por ahora no hace nada
;# Parametros:
;# 	ni uno
;# Retorno:
;#	ni uno
;# Nota:
;#	por ahora solo pone mensajes boludos
;###########################################################################

setUp:
	mov si,saludo
	call putString
	ret

%include "io.asm"
%include "str.asm"
%include "shell.asm"
%include "mensajes.inc"