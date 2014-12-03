solrserver - Solr Server Role cookbook
======================================

Contains:

* ElasticSearch  - master server optimized for writing.

----------------------------------------------------
Environments:

* network

----------------------------------------------------
Server Role Cookbooks:

* default
* search

Description
------------
ElasticSearch Server - is the ElasticSearch master server and should be in a unique node.

Used only in  "network" environment and is part of a small local network along with the other servers:
"app", "db", "media", "balancer".

For bringing this server up:

    $ vagrant up search