# -*- coding: utf-8 -*-
import wx
import data
import monitor
import proceso
import impresora

class MyFrame(wx.Frame):
    def __init__(self, *args, **kwds):
        # begin wxGlade: MyFrame.__init__
        kwds["style"] = wx.DEFAULT_FRAME_STYLE
        wx.Frame.__init__(self, *args, **kwds)
        self.panels = wx.Notebook(self, -1, style=0)
        self.politica_llegada = 0
        self.politica_ejecucion = 0
        self.politica_impresion = 0
        self.politica_ejecution_alterada = False
        
        #globales
        self.RAM = 512
        self.numero_procesos = 5
        self.tareas = []
        self.memoria = []
        self.historial = [] #realmente es bidimensional
        self.historial_impresora = [] #realmente es bidimensional
        self.temp_tareas = [] 
        
        # Menu Bar
        self.menu_principal = wx.MenuBar()
        self.archivo = wx.Menu()
        self.salir = wx.MenuItem(self.archivo, wx.NewId(), "&Salir de la Aplicacion", "", wx.ITEM_NORMAL)
        self.archivo.AppendItem(self.salir)
        self.menu_principal.Append(self.archivo, "&Archivo")
        
        self.menu_procesos = wx.Menu()
        self.correr = wx.MenuItem(self.menu_procesos, wx.NewId(), "&Correr procesos actuales", "", wx.ITEM_NORMAL)
        self.detener = wx.MenuItem(self.menu_procesos, wx.NewId(), "&Detener procesos actuales", "", wx.ITEM_NORMAL)
        self.menu_procesos.AppendItem(self.correr)
        self.menu_procesos.AppendItem(self.detener)
        self.menu_principal.Append(self.menu_procesos, "&Procesos")
                
        self.opciones = wx.Menu()
        self.prioridad_ini = wx.Menu()
        self.prioridad_ini_fifo = wx.MenuItem(self.prioridad_ini, wx.NewId(), "FIFO", "", wx.ITEM_RADIO)
        self.prioridad_ini_RAM = wx.MenuItem(self.prioridad_ini, wx.NewId(), "RAM", "", wx.ITEM_RADIO)
        self.prioridad_ini_tiempo = wx.MenuItem(self.prioridad_ini, wx.NewId(), "Tiempo", "", wx.ITEM_RADIO)
        self.prioridad_ini.AppendItem(self.prioridad_ini_fifo)
        self.prioridad_ini.AppendItem(self.prioridad_ini_RAM)
        self.prioridad_ini.AppendItem(self.prioridad_ini_tiempo)
        self.prioridad_eje = wx.Menu()
        self.prioridad_eje_RAM = wx.MenuItem(self.prioridad_eje, wx.NewId(), "RAM", "", wx.ITEM_RADIO)
        self.prioridad_eje_fifo = wx.MenuItem(self.prioridad_eje, wx.NewId(), "FIFO", "", wx.ITEM_RADIO)
        self.prioridad_eje_tiempo = wx.MenuItem(self.prioridad_eje, wx.NewId(), "Tiempo", "", wx.ITEM_RADIO)
        self.prioridad_eje.AppendItem(self.prioridad_eje_RAM)
        self.prioridad_eje.AppendItem(self.prioridad_eje_fifo)
        self.prioridad_eje.AppendItem(self.prioridad_eje_tiempo)
        self.prioridad_imp = wx.Menu()
        self.prioridad_imp_fifo = wx.MenuItem(self.prioridad_imp, wx.NewId(), "FIFO", "", wx.ITEM_RADIO)
        self.prioridad_imp_tiempo = wx.MenuItem(self.prioridad_imp, wx.NewId(), "Tiempo", "", wx.ITEM_RADIO)
        self.prioridad_imp.AppendItem(self.prioridad_imp_fifo)
        self.prioridad_imp.AppendItem(self.prioridad_imp_tiempo)
        self.opciones.AppendMenu(wx.NewId(),"Prioridad de e&ntrada",self.prioridad_ini,"")
        self.opciones.AppendMenu(wx.NewId(),"Prioridad por e&jecución",self.prioridad_eje,"")
        self.opciones.AppendMenu(wx.NewId(),"Prioridad de &impresion",self.prioridad_imp,"")
        self.menu_principal.Append(self.opciones, "&Opciones")
        
        self.ayuda = wx.Menu()
        self.acercade = wx.MenuItem(self.ayuda, wx.NewId(), "Acerca de", "", wx.ITEM_NORMAL)
        self.ayuda.AppendItem(self.acercade)
        self.menu_principal.Append(self.ayuda, "A&yuda")
        self.SetMenuBar(self.menu_principal)
        
        # Menu Bar end
        self.procesos = wx.ListCtrl(self.panels, -1, style=wx.LC_REPORT|wx.SUNKEN_BORDER)
        self.memoria = wx.ListCtrl(self.panels, -1, style=wx.LC_REPORT|wx.SUNKEN_BORDER)
        #self.grafica = wx.ScrolledWindow(self.panels, -1)
        self.concurrencia = wx.ListCtrl(self.panels, -1, style=wx.LC_REPORT|wx.SUNKEN_BORDER)
        self.ent_sal = wx.ListCtrl(self.panels, -1, style=wx.LC_REPORT|wx.SUNKEN_BORDER)
        self.status_bar = wx.StatusBar(self, -1)
        
        #graficas
        self.graficas = []
        self.graficas_impresora = []
        
        #creamos el monitor
        self.monitor = monitor.monitor(self)
        #la impresora
        self.impresora = impresora.impresora(self)
        
        self.__set_properties()
        self.__do_layout()
        
        self.Bind(wx.EVT_MENU, self.handler_menu_salir, self.salir)
        self.Bind(wx.EVT_MENU, self.handler_menu_acercade, self.acercade)
        #self.Bind(wx.EVT_MENU, self.handler_iniciar, self.iniciar)
        self.Bind(wx.EVT_MENU, self.handler_correr, self.correr)
        self.Bind(wx.EVT_MENU, self.handler_detener, self.detener)
        self.Bind(wx.EVT_PAINT, self.OnPaint_Graphic)
        
        
        #asignamos eventos a las politicas
        self.Bind(wx.EVT_MENU, self.handler_prioridad_ini_fifo, self.prioridad_ini_fifo)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_ini_tiempo, self.prioridad_ini_tiempo)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_ini_recursos, self.prioridad_ini_RAM)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_eje_fifo, self.prioridad_eje_fifo)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_eje_tiempo, self.prioridad_eje_tiempo)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_eje_recursos, self.prioridad_eje_RAM)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_imp_fifo, self.prioridad_imp_fifo)
        self.Bind(wx.EVT_MENU, self.handler_prioridad_imp_tiempo, self.prioridad_imp_tiempo)

        
    def __set_properties(self):
        # begin wxGlade: MyFrame.__set_properties
        self.SetTitle("Sistema")
        self.SetSize((390, 468))
        
        self.status_bar.SetFieldsCount(3)
        
        self.procesos.SetMinSize((380, 468))
        self.procesos.InsertColumn(0, "ID", wx.LIST_FORMAT_CENTER, 50)
        self.procesos.InsertColumn(1, "Tamaño", wx.LIST_FORMAT_CENTER, 80)
        self.procesos.InsertColumn(2, "Tiempo", wx.LIST_FORMAT_CENTER, 80)
        self.procesos.InsertColumn(3, "Recursos", wx.LIST_FORMAT_CENTER, 80)
        self.procesos.InsertColumn(4, "H.D.", wx.LIST_FORMAT_CENTER, 80)
        
        self.memoria.SetMinSize((380, 468))
        self.memoria.InsertColumn(0, "", wx.LIST_FORMAT_LEFT, 80)
        self.memoria.InsertColumn(1, "Memoria", wx.LIST_FORMAT_CENTER, 300)
        
        self.concurrencia.SetMinSize((380, 468))
        self.concurrencia.InsertColumn(0, " ", wx.LIST_FORMAT_CENTER, 50)
        self.concurrencia.InsertColumn(1, "Tiempo Inicial", wx.LIST_FORMAT_CENTER, 165)
        self.concurrencia.InsertColumn(2, "Tiempo Final", wx.LIST_FORMAT_CENTER, 165)
        
        self.ent_sal.SetMinSize((380, 468))
        self.ent_sal.InsertColumn(0, " ", wx.LIST_FORMAT_CENTER, 50)
        self.ent_sal.InsertColumn(1, "Tiempo Recurso", wx.LIST_FORMAT_CENTER, 105)
        self.ent_sal.InsertColumn(2, "Tiempo Ini", wx.LIST_FORMAT_CENTER, 105)
        self.ent_sal.InsertColumn(3, "Tiempo Fin", wx.LIST_FORMAT_CENTER, 105)
        
        #llenando la tabla de procesos
        for i in range(self.numero_procesos):
            self.tareas.append(proceso.proceso(self, i, self.monitor))
            #self.tareas[self.tareas.__len__()-1].Start()
        
        #copiamos
        self.temp_tareas = self.tareas[:]
            
        self.status_bar.SetStatusText("Tiempo: 1s",0)    
        self.status_bar.SetStatusText("Memoria: %d MB" % self.RAM,1)
        self.status_bar.SetStatusText("Procesos: %d" % self.tareas.__len__(),2)
        

    def __do_layout(self):
        # begin wxGlade: MyFrame.__do_layout
        sizer_1 = wx.BoxSizer(wx.VERTICAL)
        self.panels.AddPage(self.procesos, "Procesos")
        self.panels.AddPage(self.memoria, "Memoria")
        self.panels.AddPage(self.concurrencia, "Concurrencia")
        self.panels.AddPage(self.ent_sal, "Impresora [E/S]")
        #self.panels.AddPage(self.grafica, "Recursos")
        #self.panels.AddPage(self.graficas[0],"Grafica 1")
        sizer_1.Add(self.panels, 1, wx.EXPAND, 0)
        sizer_1.Add(self.status_bar, 0, wx.EXPAND, 0)
        self.SetSizer(sizer_1)
        self.Layout()
        # end wxGlade

    def handler_menu_salir(self, event): # wxGlade: MyFrame.<event_handler>
        exit(0)

    def handler_menu_acercade(self, event): # wxGlade: MyFrame.<event_handler>
        print ""
        event.Skip()

    def handler_prioridad_eje_fifo(self, event): 
        self.politica_ejecucion = 0
        event.Skip()
    
    def handler_prioridad_eje_tiempo(self, event): 
        self.politica_ejecucion = 1
        event.Skip()
        
    def handler_prioridad_eje_recursos(self, event): 
        self.politica_ejecucion = 2
        event.Skip()
    
    def handler_prioridad_ini_fifo(self, event): 
        self.politica_llegada = 0
        event.Skip()
    
    def handler_prioridad_ini_tiempo(self, event): 
        self.politica_llegada = 1
        event.Skip()
        
    def handler_prioridad_ini_recursos(self, event): 
        self.politica_llegada = 2
        event.Skip()
    
    def handler_prioridad_imp_fifo(self, event): 
        self.politica_impresion = 0
        event.Skip()
    
    def handler_prioridad_imp_tiempo(self, event): 
        self.politica_impresion = 1
        event.Skip()
        
    def handler_iniciar(self, event): 
        #iniciamos todo
        self.tareas = []
        self.memoria = []
        self.historial = []
        
        #limpiamos la lista
        self.procesos.DeleteAllItems()
        
        #cargamos nuevas tareas
        for i in range(self.numero_procesos):
            self.tareas.append(proceso.proceso(self, i, self.monitor))
        
        #respaldo
        self.temp_tareas = self.tareas
        
        dlg = wx.MessageDialog(self, 'Se han creado nuevos procesos!',
                               'Process',
                               wx.OK | wx.ICON_INFORMATION
                               #wx.YES_NO | wx.NO_DEFAULT | wx.CANCEL | wx.ICON_INFORMATION
                               )
        dlg.ShowModal()
        dlg.Destroy()
        event.Skip()
    
    def handler_correr(self, event): 
        dlg = wx.MessageDialog(self, 'Desea resetear los valores?',
                               'Process',
                               wx.YES_NO | wx.ICON_INFORMATION
                               )
        
        if dlg.ShowModal()==5103: #si contesta que si
            self.tareas = self.temp_tareas[:]
            self.monitor.Reset()
            self.impresora.Reset()
            for tarea in self.tareas: tarea.Reset()
            
        
        dlg.Destroy()
        
        self.monitor.Start() #corremos
        self.createGraph()
        event.Skip()
    
    def handler_detener(self, event):
        self.monitor.Stop()
        dlg = wx.MessageDialog(self, 'Los eventos se han detenido',
                               'Process',
                               wx.OK | wx.ICON_INFORMATION
                               )
        dlg.ShowModal()
        dlg.Destroy()
        event.Skip()
    
    def OnPaint_Graphic(self, event):
        if(self.graficas.__len__()==0): return
        #pintamos procesos
        nh=0
        for grafica in self.graficas:
            dc = wx.PaintDC(grafica)
            grafica.SetBackgroundColour((0,0,0))
            
            pen_red = wx.Pen(wx.RED)
            pen_green = wx.Pen(wx.GREEN)
            pen_blue = wx.Pen(wx.BLUE)
            #dc.Clear()
            
            dc.SetPen(pen_red)
            dc.DrawLine(20,20,20,380)
            dc.DrawLine(10,370,400 + self.monitor.mytime*30,370)
            
            h = 350/self.numero_procesos
            
            dc.SetTextForeground((255,0,0))
            
            for i in range(10):
                dc.DrawLabel("T%d" % i, (5,350-h*i,100,50))
            
            t = 15
            for i in range(self.monitor.mytime+1):
                dc.DrawLabel("%d" % i, (t,370,100,50))
                t+=30
            
            #pinta procesos
            dc.SetPen(pen_green)
            for i in self.historial[nh]:
                dc.DrawLine(50 + 25*(i[1]-1),350-h*i[0],50 + 25*(i[2]-1),350-h*i[0])
            nh+=1
        
        #pintamos impresora
        nh = 0
        for grafica in self.graficas_impresora:
            dc = wx.PaintDC(grafica)
            grafica.SetBackgroundColour((0,0,0))
            
            pen_red = wx.Pen(wx.RED)
            pen_green = wx.Pen(wx.GREEN)
            pen_blue = wx.Pen(wx.BLUE)
            #dc.Clear()
            
            dc.SetPen(pen_red)
            dc.DrawLine(20,20,20,380)
            dc.DrawLine(10,370,400 + self.monitor.mytime*30,370)
            
            h = 350/self.numero_procesos
            
            dc.SetTextForeground((255,0,0))
            
            for i in range(10):
                dc.DrawLabel("T%d" % i, (5,350-h*i,100,50))
            
            t = 15
            for i in range(self.monitor.mytime+1):
                dc.DrawLabel("%d" % i, (t,370,100,50))
                t+=30
            
            #pinta impresora
            dc.SetPen(pen_blue)
            for i in self.historial_impresora[nh]:
                dc.DrawLine(50 + 25*(i[1]-1),350-h*i[0],50 + 25*(i[2]-1),350-h*i[0])
            nh+=1    
        
                
    def __del__(self):
        #self.f.close()
        pass
    
    def createGraph(self):
        #creamos
        self.graficas.append(wx.ScrolledWindow(self.panels, -1))
        self.graficas_impresora.append(wx.ScrolledWindow(self.panels, -1))
        #agregamos
        self.panels.AddPage(self.graficas[self.graficas.__len__()-1],"Graph #%d Procesador" % self.graficas.__len__())
        self.panels.AddPage(self.graficas_impresora[self.graficas_impresora.__len__()-1],"Graph #%d Impresora" % self.graficas_impresora.__len__())
