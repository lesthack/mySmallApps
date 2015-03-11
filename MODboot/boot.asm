[ORG 0x7C00]		; en 0x7C00 se carga el contenido del primer sector
[BITS 16]		; 16 bits

push cs			; ds = cs
pop ds 
mov si,loading		; cargamos el mensaje
call print		; llamamos a la funcion
			; desde aca cargamos el programa
mov ah,02h		; ah=02, int13 lee un sector del disco
mov al,4		; al = 4, lee cuatro sectores 
mov ch,0		; la pista
mov cl,2		; Sector Id
mov dh,0	 	; cabeza
mov dl,0	 	; Drive (0 es floppy)
mov bx,0x1000		; Es:Bx es donde poner el programa
mov es,bx
mov bx,0x00
int 13h			; llamamos a la interrupcion

jmp 0x1000:0x00         ; saltamos a donde cargamos el programa

print:			; funcion print
	mov ah,0Eh	; funcion 0E de la BIOS que pone un caracter (int 10)
start:
	lodsb		; carga en al lo que hay en ds:si e incrementa si
	cmp al,0	; compara al con 0 ( fin de cadena )
	jz end		; si es cero termina
	int 10h		; llama a la funcion que pone el caracter
	jmp start	; vuelve a start
end:
	ret		; vuelve al que lo llamo

loading 	db 13,10,'Loading MOD Boot Disquete...',0
times 438 db 0 		;llenamos 425 bytes en cero para que el programa sea de 512 bytes
db 0x55 , 0xAA 		; la firma que tiene que ir al final para que sea un disco de arranque 

