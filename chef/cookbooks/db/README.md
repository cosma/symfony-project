db - MySQL Server Role cookbook
======================================

Contains:

* MySQL     - database

----------------------------------------------------
Environments:

* network

----------------------------------------------------
Server Role Cookbooks:

* default
* db

Description
------------
MySQL Server - database server.

Can and should have multiple instances, especially for a replication purpose.

Just define another machine with  "role[db]"

Used only in  "network" environment and is part of a small local network along with the other servers:
"app", "balancer", "media", "solrserver".

For bringing this server up:

    $ vagrant up db