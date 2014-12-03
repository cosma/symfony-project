balancer - Load Balancer Role cookbook
======================================

Contains:

* Nginx     - software load balancer and reverse proxy
* Memcached - sessions handler

----------------------------------------------------
Environments:

* network

----------------------------------------------------
Server Role Cookbooks:

* default
* balancer

Description
------------
Load Balancer Server - Load balancing the "app" type nodes .

Should run only on one node.

Used only in  "network" environment and is part of a small local network along with the other servers:
"app", "db", "media", "solrserver".

For bringing this server up:

    $ vagrant up balancer