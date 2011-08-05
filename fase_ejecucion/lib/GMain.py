# -*- coding: utf-8 -*-
import pygame
import sys
from pygame.locals import *

xy = (800, 600)
Surface = pygame.display.set_mode(xy)
pygame.display.set_caption("Simulación Fase de Ejeción CPU :: Arquitectura de Computadoras")
background = (50,50,50)

myfont = None
texto = []

#vars
i=[0 for i in range(15)]
step = 1
inc = 1
add = 1

def main():
    global myfont
    pygame.init()
    myfont = pygame.font.SysFont("FreeSans", 11)
    while(True):
        Draw()
        getInput()
        

    
def getInput():
    key = pygame.key.get_pressed()
    for event in pygame.event.get():
        #worldgame.KeyEvent(key, event)
        if event.type == QUIT:
            pygame.quit(); sys.exit()

            
def Draw():
    Surface.fill(background)
    paintBackground()
    pygame.display.flip()

def paintBackground():
    paintBackgrounds()
    Animate()
    paintUnidadControl()
    paintUAL()
    paintMemorialCentral()
    paintXterm()
    paintText()
    
def paintBackgrounds():
    pygame.draw.rect(Surface, (255,140,0), (20, 20, 390, 150)) #backgroud
    pygame.draw.rect(Surface, (255,140,0), (490, 20, 300, 150)) #backgroud
    pygame.draw.rect(Surface, (255,140,0), (350, 190, 360, 370)) #backgroud
    
def paintXterm(): 
    pygame.draw.rect(Surface, (0,0,0), (10, 300, 300, 200)) #xterm
    
def paintText():
    global texto
    for item in texto: 
        Surface.blit(item[0], item[1])
    texto=[]

def Animate():
    #pygame.draw.lines(Surface, (255,69,0), False,((90,50),(120,50)),10) #reloj-secuenciador
    #pygame.draw.lines(Surface, (255,69,0), False,((235,40),(255,40)),10) #sec-dec
    global i, step, texto, inc, add
    if(step==0):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        pygame.draw.lines(Surface, (255,69,0), False,((320,140),(320,140+i[0]),(320+i[1],140+i[0])),10) #cont-regdirmem
        if(i[0]+140<230): i[0]+=inc
        elif(i[1]+320<370): i[1]+=inc
        else: step=1;i[0]=0; i[1]=0
    elif(step==1):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        pygame.draw.lines(Surface, (255,69,0), False,((380,250),(380,250+i[0])),10) #regdirmem-selector
        if(i[0]+250<270): i[0]+=inc
        else: step=2; i[0]=0
    elif(step==2):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        pygame.draw.lines(Surface, (255,69,0), False,((380,295),(380,295+i[0]),(380+i[1],295+i[0])),10) #regdirmem-selector
        if(i[0]+295<300): i[0]+=inc
        elif(i[1]+380<480): i[1]+=inc
        else: step=3; i[0]=0; i[1]=0
    elif(step==3):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
        texto.append([myfont.render("# [step 3] enviando a RIM contenido", True, (255, 255, 255)),(25,349)])
        pygame.draw.lines(Surface, (255,69,0), False,((590,280),(590,280-i[0])),10) #celda-RIM
        if(280-i[0]>250): i[0]+=inc
        else: step=4; i[0]=0
    elif(step==4):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
        texto.append([myfont.render("# [step 3] enviando a RIM contenido", True, (255, 255, 255)),(25,349)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,349)])
        texto.append([myfont.render("# [step 4] enviando al Reg. Instruccion", True, (255, 255, 255)),(25,361)])
        texto.append([myfont.render("# [step 5] decodificando Instruccion", True, (255, 255, 255)),(25,373)])
        pygame.draw.lines(Surface, (255,69,0), False,((700,220),(700+i[0],220),
                                                      (700+i[0],220-i[1]),(700+i[0]-i[2],220-i[1]),
                                                      (700+i[0]-i[2],220-i[1]-i[3]),
                                                      (700+i[0]-i[2]-i[4],220-i[1]-i[3])),10) #RIM-RegInt
        
        if(220-i[1]-i[3]<90): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,361)])
        if(220-i[1]-i[3]<60): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,373)])
        
        if(i[0]+700<720): i[0]+=inc
        elif(220-i[1]>180): i[1]+=inc
        elif(720-i[2]>280): i[2]+=inc
        elif(220-i[1]-i[3]>50): i[3]+=inc
        elif(700+i[0]-i[2]-i[4]>240): i[4]+=inc
        else: step=5; i=[0 for i in range(10)]
        
    elif(step==5):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
        texto.append([myfont.render("# [step 3] enviando a RIM contenido", True, (255, 255, 255)),(25,349)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,349)])
        texto.append([myfont.render("# [step 4] enviando al Reg. Instruccion", True, (255, 255, 255)),(25,361)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,361)])
        texto.append([myfont.render("# [step 5] decodificando Instruccion", True, (255, 255, 255)),(25,373)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,373)])
        texto.append([myfont.render("                secuenciador activado", True, (255, 255, 255)),(25,385)])
        pygame.draw.lines(Surface, (255,69,0), False,((345,140),(345,140+i[0]),(345+i[1],140+i[0]),(345+i[1],140+i[0]-i[2])),10)
        pygame.draw.lines(Surface, (255,69,0), False,((345,140),(345,140+i[0]),(345+i[1]+i[3],140+i[0]),(345+i[1]+i[3],140+i[0]-i[2])),10)
        if(i[0]+140<180): i[0]+=inc
        elif(345+i[1]<640): i[1]+=inc
        elif(345+i[1]+i[3]<740): i[3]+=inc
        elif(140+i[0]-i[2]>110): i[2]+=inc
        else: step=6; i[0]=i[1]=i[2]=i[3]=0
    elif(step==6):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
        texto.append([myfont.render("# [step 3] enviando a RIM contenido", True, (255, 255, 255)),(25,349)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,349)])
        texto.append([myfont.render("# [step 4] enviando al Reg. Instruccion", True, (255, 255, 255)),(25,361)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,361)])
        texto.append([myfont.render("# [step 5] decodificando Instruccion", True, (255, 255, 255)),(25,373)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,373)])
        texto.append([myfont.render("                secuenciador activado", True, (255, 255, 255)),(25,385)])
        texto.append([myfont.render("# [step 6] incrementando contador add %d" % add, True, (255, 255, 255)),(25,397)])
        pygame.draw.lines(Surface, (255,69,0), False,((345,140),(345,180),(640,180),(640,110)),10)
        pygame.draw.lines(Surface, (255,69,0), False,((345,140),(345,180),(740,180),(740,110)),10)
        pygame.draw.lines(Surface, (255,69,0), False,((680,50),(680,50-i[0]),(680-i[1],50-i[0]),(680-i[1],50-i[0]+i[2])),10)
        if(50-i[0]>40): i[0]+=inc
        elif(680-i[1]>370): i[1]+=inc
        elif(50-i[0]+i[2]<110): i[2]+=inc
        else: step=7; i[0]=i[1]=i[2]=0
    elif(step==7):
        texto.append([myfont.render(":: Fase Busqueda", True, (255, 255, 255)),(25,313)])
        texto.append([myfont.render("# [step 1] enviando instruccion AND, &ah", True, (255, 255, 255)),(25,325)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        texto.append([myfont.render("# [step 2] activando celda ", True, (255, 255, 255)),(25,337)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
        texto.append([myfont.render("# [step 3] enviando a RIM contenido", True, (255, 255, 255)),(25,349)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,349)])
        texto.append([myfont.render("# [step 4] enviando al Reg. Instruccion", True, (255, 255, 255)),(25,361)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,361)])
        texto.append([myfont.render("# [step 5] decodificando Instruccion", True, (255, 255, 255)),(25,373)])
        texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,373)])
        texto.append([myfont.render("                secuenciador activado", True, (255, 255, 255)),(25,385)])
        texto.append([myfont.render("# [step 6] incrementando contador add %d" % add, True, (255, 255, 255)),(25,397)])
        pygame.draw.lines(Surface, (255,69,0), False,((345,140),(345,180),(640,180),(640,110)),10)
        pygame.draw.lines(Surface, (255,69,0), False,((345,140),(345,180),(740,180),(740,110)),10)
        pygame.draw.lines(Surface, (255,69,0), False,((680,50),(680,40),(370,40),(370,110)),10)
        pygame.draw.lines(Surface, (255,69,0), False,((680,90),(680-i[0],90)),10)
        if(680-i[0]>600): i[0]+=inc
        else: step=8; i[0]=0
        add+=1
    elif(step==8):
        texto.append([myfont.render(":: Fase Ejecucion", True, (255, 255, 255)),(25,313)])
        pygame.draw.lines(Surface, (255,69,0), False,((280,100),(280,100+i[0]),
                                                      (280+i[1],100+i[0]),(280+i[1],100+i[0]+i[2]),
                                                      (280+i[1]+i[3],100+i[0]+i[2]),(280+i[1]+i[3],100+i[0]+i[2]-i[4]),
                                                      (280+i[1]+i[3]-i[5],100+i[0]+i[2]-i[4])),10)    
        #pintanto
        if(i[0]>0): texto.append([myfont.render("# [step 1] transmitiendo al RDM", True, (255, 255, 255)),(25,325)])
        if(i[1]>=60): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        if(i[1]>0): texto.append([myfont.render("# [step 2] obteniendo operando", True, (255, 255, 255)),(25,337)])
        if(i[3]>100): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
        if(i[4]>0): texto.append([myfont.render("# [step 3] enviando a RIM", True, (255, 255, 255)),(25,349)])
        if(i[4]>100): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,349)])        
            
        if(100+i[0]<230): i[0]+=inc
        elif(280+i[1]<400): i[1]+=inc
        elif(100+i[0]+i[2]<340): i[2]+=inc
        elif(280+i[1]+i[3]<640): i[3]+=inc
        elif(100+i[0]+i[2]-i[4]>85): i[4]+=inc
        elif(280+i[1]+i[3]-i[5]>600): i[5]+=inc
        else: step=9; i=[0 for i in range(15)]
                
    elif(step==9):
        texto.append([myfont.render(":: Fase Ejecucion", True, (255, 255, 255)),(25,313)])
        pygame.draw.lines(Surface, (255,69,0), False,((280,100),(280,100+i[0]),
                                                      (280+i[1],100+i[0]),(280+i[1],100+i[0]+i[2]),
                                                      (280+i[1]+i[3],100+i[0]+i[2]),(280+i[1]+i[3],100+i[0]+i[2]-i[4]),
                                                      (280+i[1]+i[3]+i[5],100+i[0]+i[2]-i[4]),
                                                      (280+i[1]+i[3]+i[5],100+i[0]+i[2]-i[4]-i[6]),
                                                      (280+i[1]+i[3]+i[5]-i[7],100+i[0]+i[2]-i[4]-i[6]),
                                                      (280+i[1]+i[3]+i[5]-i[7],100+i[0]+i[2]-i[4]-i[6]+i[8]),
                                                      (280+i[1]+i[3]+i[5]-i[7]+i[9],100+i[0]+i[2]-i[4]-i[6]+i[8]),
                                                      (280+i[1]+i[3]+i[5]-i[7]+i[9],100+i[0]+i[2]-i[4]-i[6]+i[8]+i[10]),
                                                      (280+i[1]+i[3]+i[5]-i[7]+i[9]-i[11],100+i[0]+i[2]-i[4]-i[6]+i[8]+i[10]),
                                                      ),10)
        #pintando
        if(i[0]>0): texto.append([myfont.render("# [step 4] transmitiendo 2do operando", True, (255, 255, 255)),(25,325)])
        if(i[1]>=60): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,325)])
        if(i[2]>0): texto.append([myfont.render("# [step 5] obteniendo 3er operando", True, (255, 255, 255)),(25,337)])
        if(i[5]>0): 
            texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,337)])
            texto.append([myfont.render("# [step 6] 2do operando al reg2", True, (255, 255, 255)),(25,349)])
        if(i[6]>70): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,349)])
        if(i[7]>0): texto.append([myfont.render("# [step 7] ejecutando operacion", True, (255, 255, 255)),(25,361)])
        if(i[7]>120): texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,361)])
        if(i[7]>150): texto.append([myfont.render("# [step 8] enviando resultado", True, (255, 255, 255)),(25,373)])
        if(i[10]>20): 
            texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,373)])
            texto.append([myfont.render("# [step 9] get inst save to solved", True, (255, 255, 255)),(25,385)])
            texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,385)])
            texto.append([myfont.render("# [step 10] saved to solved", True, (255, 255, 255)),(25,397)])
        if(i[11]>80):
            texto.append([myfont.render("[Completo]", True, (0, 255, 0)),(230,397)])
            
        if(100+i[0]<230): i[0]+=inc
        elif(280+i[1]<400): i[1]+=inc
        elif(100+i[0]+i[2]<450): i[2]+=inc
        elif(280+i[1]+i[3]<640): i[3]+=inc
        elif(100+i[0]+i[2]-i[4]>240): i[4]+=inc
        elif(280+i[1]+i[3]+i[5]<720): i[5]+=inc
        elif(100+i[0]+i[2]-i[4]-i[6]>50): i[6]+=inc
        elif(280+i[1]+i[3]+i[5]-i[7]>435): i[7]+=inc
        elif(100+i[0]+i[2]-i[4]-i[6]+i[8]<180): i[8]+=inc
        elif(280+i[1]+i[3]+i[5]-i[7]+i[9]<660): i[9]+=inc
        elif(100+i[0]+i[2]-i[4]-i[6]+i[8]+i[10]<500): i[10]+=inc
        elif(280+i[1]+i[3]+i[5]-i[7]+i[9]-i[11]>550): i[11]+=inc
        else: step=1; i=[0 for i in range(15)]
                          
def paintUnidadControl():
    global myfont
    global texto
    
    pygame.draw.rect(Surface, (255,255,255), (30, 30, 70, 45)) #reloj
    pygame.draw.rect(Surface, (255,255,255), (110, 30, 130, 70)) #secuenciador
    pygame.draw.rect(Surface, (255,255,255), (250, 30, 100, 30)) #decodificador
    pygame.draw.rect(Surface, (255,255,255), (250, 70, 100, 30)) #reginstruccion
    pygame.draw.rect(Surface, (255,255,255), (300, 110, 100, 30)) #contadorprog
    
    texto.append([myfont.render("reloj", True, (0, 0, 0)),(40,35)])
    texto.append([myfont.render("del sistema", True, (0, 0, 0)),(40,47)])
    texto.append([myfont.render("secuenciador", True, (0, 0, 0)),(115,35)])
    texto.append([myfont.render("decodificador", True, (0, 0, 0)),(260,35)])
    texto.append([myfont.render("reg. instruccion", True, (0, 0, 0)),(260,75)])
    texto.append([myfont.render("contador.prog", True, (0, 0, 0)),(310,120)])

def paintUAL():
    global myfont
    global texto
    
    pygame.draw.rect(Surface, (255,255,255), (500, 30, 100, 30)) #Acumulador
    pygame.draw.rect(Surface, (255,255,255), (500, 70, 100, 30)) #regestado
    pygame.draw.polygon(Surface, (255,255,255), ((650,50),(730,50),(760,120),(710,120),(690,90),(670,120),(620,120))) #circuito operacional
    pygame.draw.rect(Surface, (255,255,255), (620, 130, 50, 30)) #reg2
    pygame.draw.rect(Surface, (255,255,255), (710, 130, 50, 30)) #reg1
    
    texto.append([myfont.render("acumuador", True, (0, 0, 0)),(510,35)])
    texto.append([myfont.render("reg.estado", True, (0, 0, 0)),(510,75)])
    texto.append([myfont.render("circuito operacional", True, (0, 0, 0)),(643,70)])
    texto.append([myfont.render("reg. 2", True, (0, 0, 0)),(625,135)])
    texto.append([myfont.render("reg. 1", True, (0, 0, 0)),(715,135)])
    
    
def paintMemorialCentral():
    global myfont
    global texto
    
    pygame.draw.rect(Surface, (255,255,255), (370, 200, 150, 50)) #RegDirMemoria
    pygame.draw.rect(Surface, (255,255,255), (550, 200, 150, 50)) #RegIntMemoria
    pygame.draw.rect(Surface, (255,255,255), (360, 270, 80, 25)) #selector

    texto.append([myfont.render("reg. de direccion", True, (0, 0, 0)),(375,205)])
    texto.append([myfont.render("de memoria", True, (0, 0, 0)),(375,217)])
    texto.append([myfont.render("reg. de intercamio", True, (0, 0, 0)),(555,205)])
    texto.append([myfont.render("de memoria", True, (0, 0, 0)),(555,217)])
    texto.append([myfont.render("selector", True, (0, 0, 0)),(365,275)])
    
    for i in range(7): #celdas
        pygame.draw.rect(Surface, (255,255,255), (480, 280 + i*40, 130, 30))
        texto.append([myfont.render("Celda %d" % i, True, (0, 0, 0)),(485,280+(i*40+5))])