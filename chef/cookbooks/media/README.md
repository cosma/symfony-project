media - Media Server Role cookbook
======================================

Contains:

* Nginx - webserver optimized for serving static files
* Media - static media files for the application

----------------------------------------------------
Environments:

* network

----------------------------------------------------
Server Role Cookbooks:

* default
* media

Description
------------
Media Server - serves the static files for teh application.

Can and should have multiple instances, especially when the load balancing needs to be tested.

Just define another machine with  "role[media]".

Used only in  "network" environment and is part of a small local network along with the other servers:
"balancer", "db", "app", "solrserver".

For bringing this server up:

    $ vagrant up media