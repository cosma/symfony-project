Dockerized Symfony Standard Project 
===================================

Welcome to the Dockerized Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

This document contains information on how to download, install, and start
using Symfony on Docker.

# Table of Contents
 - [Installing Symfony](#installing-symfony)
 - [Docker](#docker)

## Installing Symfony

When it comes to installing the Symfony Standard Edition, you have the
following options.

### Use Composer (*recommended*)

As Symfony uses [Composer][2] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new Symfony application:

    php composer.phar create-project cosma/symfony-project path/to/install

Composer will install Symfony and all its dependencies under the
`path/to/install` directory.

## Docker

1) Download and install latest version of [Virtual Box](https://www.virtualbox.org/wiki/Downloads)
 
2) Download and install latest version of [Docker](http://docs.docker.com/engine/installation). 
   For MacOS/ Windows user please install through [Docker Toolbox](https://www.docker.com/toolbox)

3) Run in console:
    `docker-compose up`
    
Docker containers expose Nginx on port 80, MySQL on port 3306 and  Kibana server on port 81.

crosslend requirements

sf2-test
========

Hello applicant! Have a look on this small application.
The code is not really nice, please refactor & improve!

- refactor the controller and the service
- Add a config entry "default_greeting_string" to the AppBundle configuration (not as a parameter).
- write a unit-test for HelloWorldService (should run without accessing DB)
- Feel free to comment your thoughts if you think the change is not self-explaining

