# -*- coding: utf-8 -*-
import random

NEW_LINE = '\n'

def processos(RAM):
    process = []
    for i in range(10):
        #id, ram, time, recursos, hd, flag, time-ini, time-end
        process.append([i,random.randrange(1,RAM),random.randrange(1,20),random.randrange(1,10),random.randrange(1,10), 0, 0, 0])
    return process

colors = []

for x in range(10):
    colors.append((random.randrange(1,255),random.randrange(1,255),random.randrange(1,255)))