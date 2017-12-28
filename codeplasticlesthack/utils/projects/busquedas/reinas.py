#! /usr/bin/env python
# -*- coding: UTF-8 -*-
import sys
sys.setrecursionlimit(100000)
c = 0
reinas = []

def nextElement(pos=[]):
    if pos[1]+1 < 8: return [pos[0], pos[1]+1]
    elif pos[0]+1 < 8: return [pos[0]+1, 0]
    else: return [0, 0]

def eNReinas(pos):
    for reina in reinas:
        if pos[0] == reina[0] or pos[1] == reina[1] \
            or abs(pos[0] - reina[0]) == abs(pos[1] - reina[1]):
            return True
    else:
        return False
    
def freinas(act):
    
    if reinas.__len__() == 8:
        return True
    
    if not eNReinas(act):
    	print "%c<position><in>%d%d</in></position>" % (chr(9),act[0],act[1])
        reinas.append(act)
    else:
        if act in reinas:
            act = reinas.pop()
            print "%c<position><out>%d%d</out></position>" % (chr(9),act[0],act[1])
    return freinas(nextElement(act))

def generateXML(pos):
	print "<item>"
	freinas(pos)
	print "</item>"

if __name__ == "__main__":
    if sys.argv.__len__() == 3:
    	generateXML([int(x) for x in sys.argv[1:3]])
        
        #print reinas
    else:
        print "Eject: python reinas.py x y"
    
