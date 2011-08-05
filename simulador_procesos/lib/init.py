import wx
import gui
import random
import monitor



class App(wx.App):
    def OnInit(self):
        self.my_app = gui.MyFrame(None, -1, "")
        self.my_app.Show()
        return True

        
def main():
    """
        main Angel
    """
    app = App()
    app.MainLoop()
    
    
    