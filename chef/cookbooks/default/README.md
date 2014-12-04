default - Default Server cookbook
=================================

Contains:

* apt       - auto updates
* timezone  - default configuration
* locales   - default configuration
* dev tools - git, mc, htop, ncdu, mtr, grc, tmux, zsh

----------------------------------------------------
Environments:

* development
* network

----------------------------------------------------
Server Role Cookbooks:

* default

Description
------------
Default Server - installs and configures software specific for all servers types.

Will run on every server as the default generic role.

Doesn't exists as a standalone node can only run as part of others