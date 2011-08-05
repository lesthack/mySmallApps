# -*- coding: utf-8 -*-
import time
import operator

class impresora:
    def __init__(self, parent):
        self.parent = parent
        self.estado = True
        self.cola = []
        self.tarea_actual = None
        self.recurso = None
        self.tiempo_ini = None
        
    def Reset(self):
        self.estado = True
        self.cola = []
        self.tarea_actual = None
        self.recurso = None
        self.tiempo_ini = None
        self.parent.ent_sal.DeleteAllItems()
            
    def agregarRecurso(self, tarea):
        self.parent.ent_sal.Append([
                             tarea.id, 
                             tarea.recursos,
                             0,
                             0
                             ])
        if self.estado == False:
            self.cola.append(tarea)
        else:
            self.tarea_actual = tarea
            self.recurso = self.tarea_actual.recursos
            self.entrar_impresora()
            self.estado = False
            
    def review(self):
        if self.tarea_actual == None: 
            print "Impresora Vacia"
            return
        
        self.recurso-=1
        print "Impresora >> Tarea:",self.tarea_actual.id,"Recurso:",self.recurso
        self.agregarHistorial()
        
        if self.recurso == 0:
            self.update_gui()
            if self.cola.__len__() > 0:
                self.politica()
                self.entrar_impresora()
            else:
                self.tarea_actual = None
                self.recurso = None
                self.estado = True
                
    def politica(self):
        """
            0: FIFO
            2: Tiempo
        """
        
        if self.parent.politica_impresion == 0:
            self.tarea_actual = self.cola[0]            
        elif self.parent.politica_impresion == 1:
            self.tarea_actual = self.cola[0]
            for tarea in self.cola:
                if tarea.recursos < self.tarea_actual.recursos:
                    self.tarea_actual = tarea
        
        self.cola.remove(self.tarea_actual)
        self.recurso = self.tarea_actual.recursos
    
    def entrar_impresora(self):
        self.tiempo_ini = self.parent.monitor.mytime
        #act tiempo ini
        id_temp = self.parent.ent_sal.FindItem(0,str=str(self.tarea_actual.id))
        self.parent.ent_sal.SetStringItem(id_temp,2,str(self.tiempo_ini))
        
    def update_gui(self):
        #Actualizamo la lista de Impresora [E/S]
        try:
            id_temp = self.parent.ent_sal.FindItem(0,str=str(self.tarea_actual.id))
            if id_temp > -1:
                self.parent.ent_sal.SetStringItem(id_temp,3,str(self.parent.monitor.mytime))
        except:
            pass

        
    def agregarHistorial(self):
        #agregamos al historial
        self.parent.historial_impresora[self.parent.historial_impresora.__len__()-1].append([
                                                                                             self.tarea_actual.id,
                                                                                             self.tiempo_ini, 
                                                                                             self.parent.monitor.mytime
                                                                                             ])