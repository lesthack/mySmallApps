from mod_python import apache
from puzzle import *

def index(req):
	req.content_type = "text/html"
	req.write("<h1>Hola mundo</h1>")
	req.write("")


	
