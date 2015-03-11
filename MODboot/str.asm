;Controlada OK

strCmp:
	push si
	push di
	
.cmp:
	mov ah,[si]
	mov al,[di]
	inc si
	inc di
	cmp al,ah
	jnz .false
	cmp al,0
	jz .true	
	jmp .cmp

.true
	mov ax,1
	jmp .volver
	
.false:
	mov ax,0

.volver:
	pop di
	pop si
	ret