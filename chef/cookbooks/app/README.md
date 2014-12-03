app - Application Server Role cookbook
======================================

Contains:

* PHP       - application
* Nginx     - webserver
* Memcached - cache handler
* Solr      - optimised for reading slave server which replicates from master Solr Server

----------------------------------------------------
Environments:

* network

----------------------------------------------------
Server Role Cookbooks:

* default
* app

Description
------------
Application Server - is the PHP application server and receives requests from the load balancer server "balancer".

Can and should have multiple instances, especially when the load balancing needs to be tested.

Just define another machine with  "role[app]".

Used only in  "network" environment and is part of a small local network along with the other servers:
"balancer", "db", "media", "solrserver".

For bringing this server up:

    $ vagrant up app