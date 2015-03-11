;# Funcion shell ###########################################################
;# Descripcion:
;#	el interprete de comandos
;# Parametros:
;# 	-
;# Retorno:
;#	-
;# Nota:
;#	no sea interpretado como s Hell
;###########################################################################
shell:
	push si
	push di
	push ax

.comienzo:
	mov si,prompt
	call putString
	mov di,cmd
	mov cx,79
	call getString

	mov di,cmd
	mov si,cmd1
	call strCmp
	cmp ax,1
	jz .ejCmd1		; ejecutar comando1

	mov di,cmd
	mov si,cmd2
	call strCmp
	cmp ax,1
	jz .ejCmd2		; ejecutar comando2

	mov di,cmd
	mov si,cmd3
	call strCmp
	cmp ax,1
	jz .ejCmd3		; ejecutar comando3

	mov di,cmd
	mov si,cmd4
	call strCmp
	cmp ax,1
	jz .fin			; terminamos el shell

	mov di,cmd
	mov si,cmd5
	call strCmp
	cmp ax,1
	jz .ejCmd5		; ejecutar comando5

	; los otros

.unkCmd:
	mov si,mUnkCmd
	call putString
	jmp .comienzo

.ejCmd1:
	mov si,mCmd1
	call putString
	jmp .comienzo

.ejCmd2:
	mov si,mCmd2
	call putString
	call halt
	pop ax
	pop di
	pop si
	ret			; nunca vuelve pero...

.ejCmd3:
	mov si,mCmd3
	call putString
	call reboot
	pop ax
	pop di
	pop si
	ret			; nunca vuelve pero...

.ejCmd5:
	mov si,mCmd5
	call putString
	jmp .comienzo

.fin:
	mov si,mCmd4
	call putString
	pop ax
	pop di
	pop si
	ret

cmd 	times 80 db 0

