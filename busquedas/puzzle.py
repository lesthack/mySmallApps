#! /usr/bin/env python
# -*- coding: UTF-8 -*-
import sys, math, copy

class nodo:
    def __init__(self, puzzle = [[]], cost = 0):
        self.puzzle = puzzle
        self.cost = cost
        self.zero = self.getPos(self.puzzle, 0)
        self.childrens = []
        self.father = None
        
    def PrintPuzzle(self):
        for row in self.puzzle:
            print row
        print ""
        
    def getPos(self, puzzle, n):
        for x in range(puzzle.__len__()):
            for y in range(puzzle[x].__len__()):
                if puzzle[x][y] == n:
                    return [x,y]
    
    def MovUp(self):
        if self.zero[0]-1 >= 0:
            return self.__ChangePos(self.zero, [self.zero[0]-1, self.zero[1]])
        else:
            return None
        
    def MovDown(self):
        if self.zero[0]+1 < self.puzzle.__len__():
            return self.__ChangePos(self.zero, [self.zero[0]+1, self.zero[1]])
        else:
            return None
    
    def MovLeft(self):
        if self.zero[1]-1 >= 0:
            return self.__ChangePos(self.zero, [self.zero[0], self.zero[1]-1])
        else:
            return None
        
    def MovRight(self):
        if self.zero[1]+1 < self.puzzle[0].__len__():
            return self.__ChangePos(self.zero, [self.zero[0], self.zero[1]+1])
        else:
            return None
    
    def __ChangePos(self, A, B):
        #Cambia posiciones en el puzzle
        new_nodo = copy.deepcopy(self)
        
        T = new_nodo.puzzle[A[0]][A[1]]
        new_nodo.puzzle[A[0]][A[1]] = new_nodo.puzzle[B[0]][B[1]]
        new_nodo.puzzle[B[0]][B[1]] = T
        
        new_nodo.zero = new_nodo.getPos(new_nodo.puzzle, 0)
        new_nodo.father = self
        return new_nodo
        
    def CalcCost(self, end):
        pos_correct = 0
        movs = 0
        
        #Calculamos cuantos no estan en su posicion
        for x in range(end.puzzle.__len__()):
            for y in range(end.puzzle[x].__len__()):
                if self.puzzle[x][y] != end.puzzle[x][y]:
                    pos_correct+=1;
                    
        #calculamos los mov para llegar a su lugar
        for x in range(end.puzzle.__len__()):
            for y in range(end.puzzle[x].__len__()):
                T = self.getPos(end.puzzle, self.puzzle[x][y])
                movs += int(math.fabs(x-T[0]) + math.fabs(y-T[1]))
        
        self.cost = pos_correct + movs
        return self.cost
    
    def extendGraf(self):
        movup = self.MovUp()
        movdown = self.MovDown()
        movleft = self.MovLeft()
        movright = self.MovRight()
        
        if movup != None and not exist(ini, movup): 
        	self.childrens.append(movup)
        if movdown != None and not exist(ini, movdown): 
        	self.childrens.append(movdown)
        if movleft != None and not exist(ini, movleft): 
        	self.childrens.append(movleft)
        if movright != None and not exist(ini, movright): 
        	self.childrens.append(movright)

def nodoMin(act, end):
    
    if act.childrens.__len__() == 1:
        return act.childrens[0]
    elif act.childrens.__len__() > 1:
        temp = act.childrens[0]
        temp.CalcCost(end)
        for hoja in act.childrens:
            if hoja.CalcCost(end) < temp.cost:
                temp = hoja
        return temp

def getNodoMin(nodo, end):
    global nodo_min
    if nodo.childrens.__len__()>0:
        for minodo in nodo.childrens:
            getNodoMin(minodo, end)
    else:
        if nodo.CalcCost(end) < nodo_min.cost and nodo not in inexpandibles:
            nodo_min = nodo
    return None

def exist(nodo, hoja):
    if nodo.puzzle[:] == hoja.puzzle[:]:
        return True
    else:
        if nodo.childrens.__len__()>0:
            for minodo in nodo.childrens:
                if exist(minodo, hoja):
                    return True
            else:
                return False
    
#Variables globales
nodo_min = nodo(cost=36)        
#ini = nodo([[8,1,0],
#            [4,2,3],
#            [7,6,5]])

ini = nodo([[1,2,3],
            [4,5,6],
            [7,8,0]])

end = nodo([[0,8,7],
            [6,5,4],
            [3,2,1]])

inexpandibles = []

def puzzle():

    act = ini
    
    while act.puzzle[:] != end.puzzle[:]:
        #act.PrintPuzzle()
        act.extendGraf()
        
        if act.childrens.__len__() == 0:
            inexpandibles.append(act)
        nodo_min.cost = 36
        getNodoMin(ini, end)
        act = nodo_min
    
    #act.PrintPuzzle()
    return act

def generateXML(act):
	stack = []

	while act.puzzle[:] != ini.puzzle[:]:
		stack.append(act.puzzle)
		act = act.father
	stack.append(act.puzzle)
	
	#Empezamos a generar el documento XML
	print "<puzzles>"
	while len(stack) > 0:
		temp = stack.pop()
		print "%c<iter>" % chr(9)
		for i in range(len(temp)):
			for j in range(len(temp[i])):
				print "%c%c<p%d%d>%d</p%d%d>" % (chr(9),chr(9),i,j,temp[i][j],i,j)
		print "%c</iter>" % chr(9)
	print "</puzzles>"

def isSolved():
	min = 0
	for i in range(len(end.puzzle)):
		for j in range(len(end.puzzle)):
			if ini.puzzle[i][j] < end.puzzle[i][j]:
				min+=1
	zero = ini.getPos(ini.puzzle,0)
	if ini.puzzle[zero[0]][zero[1]] % 2 == 0:
		min+=1
	if min % 2 == 0: return False
	else: return True
	
if __name__ == "__main__":
	if len(sys.argv) >= 3:
		ini = nodo([[int(n) for n in sys.argv[1][:3]],[int(n) for n in sys.argv[1][3:6]],[int(n) for n in sys.argv[1][6:9]]])
		end = nodo([[int(n) for n in sys.argv[2][:3]],[int(n) for n in sys.argv[2][3:6]],[int(n) for n in sys.argv[2][6:9]]])
		
		#if isSolved():
		generateXML(puzzle())
		#else:
		#	print "<solved>false</solved>"
