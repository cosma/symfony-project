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
#        $ vagrant box add ubuntu/trusty64
##


# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    ##
    # Every Vagrant virtual environment requires a box to build off of.
    ##
    config.vm.box = "ubuntu/trusty64"

    ##
    # The url from where the 'config.vm.box' box will be fetched if it doesn't
    # already exist on the user's system.
    ##
    config.vm.box_url = "https://vagrantcloud.com/ubuntu/boxes/trusty64/versions/14.04/providers/virtualbox.box"

    ##
    #   The time in seconds that Vagrant will wait for the machine to boot and be accessible
    ##
    config.vm.boot_timeout = 900


    # Disable automatic box update checking. If you disable this, then
    # boxes will only be checked for updates when the user runs
    # `vagrant box outdated`. This is not recommended.
    config.vm.box_check_update = true

    ##
    # Vagrant plugin 'vagrant-cachier' for caching downloaded data.
    ##
    if Vagrant.has_plugin?("vagrant-cachier")
        config.cache.scope = :machine
        config.cache.auto_detect = false
    end

    ##
    # Vagrant plugin 'vagrant-berkshelf' for cookbook dependency management.
    ##
    if Vagrant.has_plugin?("vagrant-berkshelf")
        config.berkshelf.enabled = true
        config.berkshelf.berksfile_path = "./chef/Berksfile"
    end

    ##
    # Vagrant plugin 'vagrant-omnibus' to update chef-solo to the latest version.
    ##
    if Vagrant.has_plugin?("vagrant-omnibus")
        config.omnibus.chef_version = :latest
    end

    ##
    # set update Guest Adition true/false
    ##
    if Vagrant.has_plugin?("vagrant-vbguest")
        config.vbguest.auto_update = true
    end

    config.vm.define 'symfony'

    # Set the hostname
    config.vm.host_name = 'symfony'

    ##
    # Create a private network, which allows host-only access to the machine
    # using a specific IP.
    ##
    config.vm.network :private_network, ip: '192.168.10.10'


    # set node specific Virtual Box settings
    config.vm.provider :virtualbox do |vb|
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
    config.vm.synced_folder ".", "/vagrant", :id => "vagrant-root" , nfs: true
    ##, :group => "www-data", :mount_options => ["dmode=775", "fmode=764"] #

#     config.vm.synced_folder ".", "/vagrant",
#         type: "rsync",
#         rsync__exclude: [
#         ".git",
#         ".idea",
#         ".sass-cache",
#         "app/cache",
#         "app/bootstrap.php.cache",
#         "app/config/parameters.yml",
#         "app/logs",
#         "node_modules",
#         "vendor",
#         "web/assets",
#         "web/bundles"
#         ]
#
#     config.vm.synced_folder "./vendor", "/vagrant/vendor"

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