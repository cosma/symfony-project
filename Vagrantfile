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



##
# Available nodes.
##
availableNodes = [

    #   All-Inn server
    {
        :name => "costore",
        :description => "Costore Server - all software installed: App, PHP, Nginx, Memcached, Mysql, ElasticSearch, Media - for faster development",
        :ip => '192.168.50.10',
        :memory => 2048
        },

#     #   Application server
#     {
#         :name => 'app',
#         :description => "Application server - App, PHP, Nginx, Memcached, Solr slave - for testing server infrastructure",
#         :ip => '192.168.50.20',
#         :memory => 1024
#         },
#
#     #   Db Server
#     {
#         :name => 'db',
#         :description => "Db Server - Mysql - for testing server infrastructure",
#         :ip => '192.168.50.30',
#         :memory => 512
#         },
#
#     #   Elastic Search
#     {
#         :name => 'elasticsearch',
#         :description => "Elastic Search",
#         :ip => '192.168.50.40',
#         :memory => 512
#         },
#
#     #   Media server
#     {
#         :name => 'media',
#         :description => "Media server - Nginx, Media - for testing server infrastructure",
#         :ip => '192.168.50.50',
#         :memory => 256
#         },
#
#     #   Load Balancer server
#     {
#         :name => 'balancer',
#         :description => "Load Balancer server - Nginx lb, Memcached sessions - for testing server infrastructure",
#         :ip => '192.168.50.60',
#         :memory => 256
#         },

]

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

    # iterates over available nodes and set specific node configuration
    availableNodes.each do |node|

        # define a node
        config.vm.define node[:name], primary: ( node[:name] == 'costore' ? true : false ) do |nodeConfig|

            ##
            # set update Guest Adition true/false
            ##
            nodeConfig.vbguest.auto_update = true

            # uncomment line below if you wanna enable cache per machine
            nodeConfig.cache.scope = :machine

            # Set the hostname
            nodeConfig.vm.host_name = node[:name]

            ##
            # Create a private network, which allows host-only access to the machine
            # using a specific IP.
            ##
            nodeConfig.vm.network :private_network, ip: node[:ip]


            # set node specific Virtual Box settings
            nodeConfig.vm.provider :virtualbox do |vb|
                vb.customize [
                          "modifyvm", :id,
                          "--description", "#{node[:description]}",
                          "--memory", node[:memory]
                ]
            end

            ##
            # mount project folder  only for application nodes: app & media folder  only for media server node: media
            # NFS shared folders required nfs to be installed on host machine:
            #  $apt-get install nfs-kernel-server
            ##
            case node[:name]
                when "costore", "app", "media"
                    #nodeConfig.vm.synced_folder ".", "/vagrant", :id => "vagrant-root" , nfs: true
                    ##, :group => "www-data", :mount_options => ["dmode=775", "fmode=764"] #

                    nodeConfig.vm.synced_folder ".", "/vagrant", type: "rsync",
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

                    nodeConfig.vm.synced_folder "./vendor", "/vagrant/vendor"

                else
                    nodeConfig.vm.synced_folder ".", "/vagrant", :disabled => true
            end

            ##
            # Enable provisioning with chef solo, specifying a cookbooks path, roles
            # path, and data_bags path (all relative to this Vagrantfile), and adding
            # some recipes and/or roles.
            ##
             nodeConfig.vm.provision :chef_solo do |chef|
                 chef.cookbooks_path = ["./chef/cookbooks"]
                 chef.roles_path = "./chef/roles"
                 chef.data_bags_path = "./chef/data_bags/development"
                 chef.add_role node[:name]
                 chef.log_level = :debug # uncomment this for more debug info
             end

        end
    end

end

# Load Vagrantfile.local to overwrite or extend default Vagrant configuration
load "Vagrantfile.local" if File.exists?("Vagrantfile.local")