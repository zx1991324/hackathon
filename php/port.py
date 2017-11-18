#!/usr/bin/env python
import os
import BaseHTTPServer
import CGIHTTPServer

# chdir(2) into the tutorial directory.
os.chdir(os.path.dirname(os.path.dirname(os.path.realpath(__file__))))
# 指定目录 ，如果目录错误 请求会失败
class Handler(CGIHTTPServer.CGIHTTPRequestHandler):
  cgi_directories  = ['/php']
BaseHTTPServer.HTTPServer(('0.0.0.0', 80), Handler).serve_forever()