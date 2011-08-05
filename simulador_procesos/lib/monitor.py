# -*- coding: utf-8 -*-
import thread
from time import sleep
import operator
import data

class monitor:
    def __init__(self, parent):
        self.parent = parent
        self.mytime = 0
        self.tareas_en_ram = []
        self.prioridades = []
        self.temp = []
        self.parent.historial.append([])
        self.parent.historial_impresora.append([])
        
    def Reset(self):
        self.mytime = 0
        self.tareas_en_ram = []
        self.prioridades = []
        self.temp = []
        self.parent.historial.append([])
        self.parent.historial_impresora.append([])
        self.parent.concurrencia.DeleteAllItems()
        
    def Start(self):
        for i in self.parent.tareas:
            print i.id, i.RAM, i.tiempo
            
        self.keep = self.running = True
        thread.start_new_thread(self.Run, ())
        
    def Stop(self):
        self.stop_process()
        self.keep = False
        
    def Run(self):
        while self.keep:
            sleep(1)
            self.mytime += 1
            print ""
            print "Tiempo: %d RAM: %d" % (self.mytime, self.getRAM())
            self.check_death()
            self.check_memory()
            self.check_priority()
            self.paint_memmory()
            self.parent.impresora.review()
            
        self.running = False
    
    def check_priority(self):
        #print "check priority", len(self.prioridades)
        if self.prioridades.__len__() > 0:
            tarea = self.prioridades.pop()
            #print "Sacando de la cola", tarea.id
            if tarea.running == False:
                tarea.Start()

        
    def check_death(self):
        for tarea in self.parent.tareas:
            if tarea.death == True:
                print "Encontre un muerto: %d" % tarea.id
                self.temp.remove((tarea, tarea.tiempo))
                self.parent.tareas.remove(tarea)
                self.delete_memorylist(tarea.id)
                for i in self.temp:
                    i[0].tiempo_dormido = len(self.temp)
        
    
    def check_memory(self):
        entro_alguien = False
        if self.getRAM() <= self.parent.RAM:
            
            temp = []
            lista_tareas = []
            #prioridad de entrada
            if(self.parent.politica_llegada==0):#prioridad por RAM
                for k in self.parent.tareas:
                    temp.append(k.RAM)
                
                temp = sorted(temp)
                
                for k in temp:
                    for tarea in self.parent.tareas:
                        if(tarea.RAM==k):
                            lista_tareas.append(tarea)
                
            elif(self.parent.politica_llegada==2): #prioridad por Tiempo
                for k in self.parent.tareas:
                    temp.append(k.tiempo)
                
                temp = sorted(temp)
                
                for k in temp:
                    for tarea in self.parent.tareas:
                        if(tarea.tiempo==k):
                            lista_tareas.append(tarea)
            else: #prioridad FIFO
                for tarea in self.parent.tareas:
                    lista_tareas.append(tarea)
                    
            for tarea in lista_tareas:
                    if not tarea.running and tarea.tiempo_activo > 0:
                        if self.getRAM() + tarea.RAM <= self.parent.RAM:
                            if tarea not in [k[0] for k in self.temp]:
                                entro_alguien = True
                                print "entro", tarea.id, tarea.RAM, tarea.tiempo
                                self.temp.append((tarea, tarea.tiempo))
                                
            if entro_alguien == True or self.parent.politica_ejecution_alterada==True:
                #print "entro alguien"
                self.parent.politica_ejecution_alterada=False
                self.order_priority()
                
    def order_priority(self):
        #prioridades para ejecución
        if(self.parent.politica_ejecucion==0):#prioridad por RAM
            self.temp = sorted(self.temp, key=operator.itemgetter(1))
        elif(self.parent.politica_ejecucion==1):#prioridad por FIFO
            self.temp = sorted(self.temp, key=operator.itemgetter(0))
        else: #prioridad por tiempo
            self.temp = sorted(self.temp, key=operator.itemgetter(2))
            
        self.prioridades = []
        for i in self.temp[::-1]:
            i[0].keep = False
            i[0].tiempo_dormido = len(i)
            self.prioridades.append(i[0])

                
    def getRAM(self):
        ram = 0
        for i in self.temp:
            ram += i[0].RAM
        return ram
    
    def paint_memmory(self):
        for i in self.temp:
            p = self.parent.memoria.FindItem(0,str=str(i[0].id))
            if p == -1:
                self.parent.memoria.Append([i[0].id, i[0].RAM])
                n = self.parent.memoria.GetItemCount()
                self.parent.memoria.SetItemBackgroundColour(n-1, data.colors[i[0].id])
            
    def delete_memorylist(self, id):
        p = self.parent.memoria.FindItem(0,str=str(id))
        if p > -1:
            self.parent.memoria.DeleteItem(p)
            
    def stop_process(self):
        for tarea in self.parent.tareas:
            tarea.Stop() #lo detenemos
            tarea.Destroy() #destruimos el hilo