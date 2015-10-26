Symfony Standard Project
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

This document contains information on how to download, install, and start
using Symfony. For a more detailed explanation, see the [Installation][1]
chapter of the Symfony Documentation.

1) Installing the Standard Edition
----------------------------------

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


2) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path-to-project/web/config.php

If you get any warnings or recommendations, fix them before moving on.



3) Docker
----------

1) Download and install latest version of [Docker Toolbox](https://www.docker.com/toolbox)

2) Download and install latest version of [Vagrant](https://www.vagrantup.com/downloads.html)
 
3) Download the vagrant box. Run in console:
    `docker-compose up`
    
4) Download and install latest version of [Chef DK](https://downloads.chef.io/chef-dk/)
    

5) Move to project folder ans start the vagrant machine
    `vagrant up`
    
7) For provisioning:
    `vagrant reload --provision`
    
    In case of error just run before
    `rm .vagrant/machines/symfony/virtualbox/synced_folders` 


access the application from host on `symfony.local`



