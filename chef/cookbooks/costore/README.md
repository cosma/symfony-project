costore - All in one server cookbook
==================================

Contains:

* PHP           - application
* Nginx         - webserver
* Memcached     - cache handler
* Mysql         - database
* Elasticsearch -
* Media         - media files

----------------------------------------------------
Environments:

* development

----------------------------------------------------
Server Role Cookbooks:

* default
* app
* db
* costore

Description
------------
Allin Server - all software is installed on this server for faster development.

Some already defined server type roles are run against it.

In "development" environment you only need to use this server.

For bringing this server up:

    $ vagrant up costore



