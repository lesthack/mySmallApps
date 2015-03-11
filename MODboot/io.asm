;controlada Ok (ver si el getstring deja borrar mas atras de donde empezo)

;# Funcion PutChar #########################################################
;# Descripcion:
;#	Pone un caracter en la posicion del cursor
;# Parametros:
;# 	AL -> Caracter a mostrar
;# Retorno:
;#	Ninguno
;# Nota:
;#	Hacerlo sin la Bios
;###########################################################################

putChar:
	push ax		; guardamos...
		
	mov ah,0eh	; funcion putChar de la Bios
	int 10h		; interrupcion de video

	pop ax		; recuperamos
	ret		; return

;# Funcion putString #######################################################
;# Descripcion:
;#	Pone la cadena en la posicion del cursor
;# Parametros:
;# 	SI -> cadena a mostrar terminada en 0
;# Retorno:
;#	Ninguno
;# Nota:
;#	-
;###########################################################################

putString:
	push ax		; ponemos en la pila los valores que modificamos
	push si

.l1:
	mov al,[si]	; cargamos el caracter
	cmp al,0	; nos fijamos si es el terminador
	jz .fin		; si es el terminador terminamos
	call putChar	; ponemos el caracter
	inc si		; SI++
	jmp .l1		; de nuevo...

.fin:
	pop si		; recuperamos los valores
	pop ax
	ret		; return
	
;# Funcion getChar #########################################################
;# Descripcion:
;#	obtiene un caracter y lo retira del buffer
;# Parametros:
;# 	-
;# Retorno:
;#	AH -> scancode
;#	AL -> ASCII
;# Nota:
;#	Hacerlo sin la BIOS
;###########################################################################

getChar:
	mov ah,0	; getkey de la bios
	int 16h		; int de teclado
	call putChar	; lo mostramos
	ret

;# Funcion GetString #######################################################
;# Descripcion:
;#	obtiene una cadena hasta que se presiona enter
;# Parametros:
;#	CX -> cantidad de caracteres maxima a leer
;# 	ES:DI -> donde poner la cadena
;# Retorno:
;#	DI -> la cadena
;# Nota:
;#	-
;###########################################################################

getString:
	push cx
	push ax		; guardamos...
	push di
	push si

	mov si,di
.l1:
	cmp cx,0
	jz .fin
	mov ah,0	; getkey de la bios
	int 16h		; int de teclado
	dec cx
	cmp al,0xd	; es enter?
	jz .fin		; si es terminamos
	cmp al,0x8	; es backSpace?
	jz .bs		; lo tratamos
	call putChar
	mov [di],al	; si no, ponemos el carater
	inc di		; DI++
	jmp .l1		; de nuevo
.bs:
	cmp si,di	; si llego al primer caracter
	je .l1		; pide el que sigue
	call putChar
	dec di		; si no, DI--
	jmp .l1		; pide el que sigue
.fin:
        mov byte [di],0	; ponemos el terminador de cadena
	mov al,13	; bajamos a la linea siguiente
	call putChar
	mov al,10
	call putChar

	pop si	
	pop di
	pop ax		; restauramos...
	pop cx
	ret