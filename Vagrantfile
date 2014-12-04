# -*- mode: ruby -*-
# vi: set ft=ruby :

##
# Vagrantfile
#
# All default Vagrant configuration is done here. For a complete reference,
# please see the online documentation at http://docs.vagrantup.com/.
##


##
# Vagrant plugins
##
required_plugins = %w( vagrant-berkshelf vagrant-cachier vagrant-omnibus vagrant-vbguest vagrant-triggers)
required_plugins.each do |plugin|
  system "vagrant plugin install #{plugin}" unless Vagrant.has_plugin? plugin
end

###
#   Add the box from vagrant cloud
#       vagrant box add chef/ubuntu-14.04"
##


# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    ##
    # Every Vagrant virtual environment requires a box to build off of.
    ##
    config.vm.box = "chef/ubuntu-14.04"

    ##
    # The url from where the 'config.vm.box' box will be fetched if it doesn't
    # already exist on the user's system.
    ##
    config.vm.box_url = "https://vagrantcloud.com/ubuntu/boxes/trusty64/versions/14.04/providers/virtualbox.box"

    ##
    #   The time in seconds that Vagrant will wait for the machine to boot and be accessible
    ##
    config.vm.boot_timeout = 900

    ##
    # Vagrant plugin 'vagrant-cachier' for caching downloaded data.
    ##
    config.cache.auto_detect = false

    ##
    # Vagrant plugin 'vagrant-berkshelf' for cookbook dependency management.
    ##
    config.berkshelf.enabled = true
    config.berkshelf.berksfile_path = "./chef/Berksfile"

    ##
    # Vagrant plugin 'vagrant-omnibus' to update chef-solo to the latest version.
    ##
    config.omnibus.chef_version = :latest

    config.vm.define 'symfony'

    ##
    # set update Guest Adition true/false
    ##
    config.vbguest.auto_update = true

    # uncomment line below if you wanna enable cache per machine
    config.cache.scope = :machine

    # Set the hostname
    config.vm.host_name = 'symfony'

    ##
    # Create a private network, which allows host-only access to the machine
    # using a specific IP.
    ##
    config.vm.network :private_network, ip: '192.168.10.10'


    # set node specific Virtual Box settings
    config.vm.provider :virtualbox do |vb|
        vb.name = "symfony"
        vb.customize [
                  "modifyvm", :id,
                  "--description", "Symfony Standard Project",
                  "--memory", 2048
        ]
    end

    ##
    # mount project folder  only for application nodes: app & media folder  only for media server node: media
    # NFS shared folders required nfs to be installed on host machine:
    #  $apt-get install nfs-kernel-server
    ##
    #nodeConfig.vm.synced_folder ".", "/vagrant", :id => "vagrant-root" , nfs: true
    ##, :group => "www-data", :mount_options => ["dmode=775", "fmode=764"] #

    config.vm.synced_folder ".", "/vagrant", type: "rsync",
        rsync__exclude: [
        ".git",
        ".idea",
        ".sass-cache",
        "app/cache",
        "app/config/parameters.yml",
        "app/logs",
        "node_modules",
        "vendor",
        "web/assets",
        "web/bundles"
        ],
        rsync__auto: true

    config.vm.synced_folder "./vendor", "/vagrant/vendor"

    ##
    # Enable provisioning with chef solo, specifying a cookbooks path, roles
    # path, and data_bags path (all relative to this Vagrantfile), and adding
    # some recipes and/or roles.
    ##
     config.vm.provision :chef_solo do |chef|
         chef.cookbooks_path = ["./chef/cookbooks"]
         chef.roles_path = "./chef/roles"
         chef.data_bags_path = "./chef/data_bags/development"
         chef.add_role 'symfony'
         chef.log_level = :debug # uncomment this for more debug info
     end



end

# Load Vagrantfile.local to overwrite or extend default Vagrant configuration
load "Vagrantfile.local" if File.exists?("Vagrantfile.local")