# -*- coding: utf-8 -*-
import thread
import random
from time import sleep
from data import NEW_LINE

class proceso:
    def __init__(self, parent, id, monitor):
        self.parent = parent
        self.monitor = monitor
        
        self.id = id
        self.tiempo = random.randrange(3,10)
        self.RAM = random.randrange(1,self.parent.RAM)
        self.recursos = random.randrange(3,15)
        self.hd = 0
        
        self.tiempo_ini = 0
        self.tiempo_fin = 0
        self.tiempo_activo = self.tiempo
        self.tiempo_dormido = 1
        
        self.sleep = True
        self.running = False
        self.death = False

        print "Ha nacido el proceso %d" % self.id
        
        self.parent.procesos.Append([
                                     self.id, 
                                     self.RAM,
                                     self.tiempo,
                                     self.recursos,
                                     self.hd
                                     ])
        self.parent.concurrencia.Append([
                                     self.id, 
                                     0,
                                     0
                                     ])
    def Reset(self):
        self.tiempo_ini = 0
        self.tiempo_fin = 0
        self.tiempo_activo = self.tiempo
        self.tiempo_dormido = 1
        
        self.sleep = True
        self.running = False
        self.death = False
        
        print "Ha nacido de nuevo el proceso %d" % self.id
        
        self.parent.concurrencia.Append([
                                     self.id, 
                                     0,
                                     0
                                     ])
        
    def Start(self):
        self.parent.concurrencia.SetStringItem(self.id,1,str(self.monitor.mytime))
        print "Yo %d[%d][%d] me he activado" % (self.id, self.RAM, self.tiempo)
        self.keep = self.running = True
        thread.start_new_thread(self.Run, ())
        
            
    def Stop(self):
        self.keep = False
        
    def Run(self):
        while self.keep:
            self.tiempo_activo-=1
            print "Soy el proceso %d y estoy vivo: %d" % (self.id, self.tiempo_activo)
            #self.parent.historial.append([self.id, self.monitor.mytime, self.monitor.mytime + self.tiempo_dormido])
            self.parent.historial[self.parent.historial.__len__()-1].append([self.id, 
                                          len(self.parent.historial[self.parent.historial.__len__()-1]), 
                                          len(self.parent.historial[self.parent.historial.__len__()-1]) + 1]
            )
            if self.tiempo_activo <= 0:
                try:
                    self.parent.concurrencia.SetStringItem(self.id,2,str(self.monitor.mytime))
                except: pass
                print "Yo %d he muerto" % self.id
                self.keep = False
                self.death = True
                #lo metemos a la impresora
                self.parent.impresora.agregarRecurso(self)
                break
            sleep(self.tiempo_dormido)
        self.running = False
    
    def Destroy(self):
        thread.exit_thread()