#
# Cookbook Name:: app
# Recipe:: default
#
# Author::  Cosmin Voicu(<cosmin.voicu@gmail.com>)
# Copyright::  2013, Cosmin Voicu
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
#

# set-up apt source for php package install
if node[:php][:install_method] == "package"
    if Gem::Version.new(node[:php][:version]) >= Gem::Version.new("5.5")
        puts "PHP 5.5"
        if node[:platform_family] == "debian"
            case node[:lsb][:codename]
                when "precise", "quantal", "raring"
                    apt_repository "ondrej-systemd" do
                        uri "http://ppa.launchpad.net/ondrej/systemd/ubuntu"
                        distribution node[:lsb][:codename]
                        components ["main"]
                        deb_src true
                        keyserver "keyserver.ubuntu.com"
                        key "E5267A6C"
                    end
                    apt_repository "ondrej-php55" do
                        uri "http://ppa.launchpad.net/ondrej/php5/ubuntu"
                        distribution node[:lsb][:codename]
                        components ["main"]
                        deb_src true
                        keyserver "keyserver.ubuntu.com"
                        key "E5267A6C"
                    end
                when "wheezy"
                    apt_repository "dotdeb-php55" do
                        uri "http://packages.dotdeb.org"
                        distribution node[:lsb][:codename]
                        components ["wheezy-php55"]
                        deb_src true
                        key "http://www.dotdeb.org/dotdeb.gpg"
                    end
            end
        end

    elsif Gem::Version.new(node[:php][:version]) >= Gem::Version.new("5.4")
        puts "PHP 5.4"
        if node[:platform_family] == "debian"
            case node[:lsb][:codename]
                when "precise", "quantal", "raring"
                    apt_repository "ondrej-php54" do
                        uri "http://ppa.launchpad.net/ondrej/php5-oldstable/ubuntu"
                        distribution node[:lsb][:codename]
                        components ["main"]
                        deb_src true
                        keyserver "keyserver.ubuntu.com"
                        key "E5267A6C"
                    end
                when "squeeze"
                    apt_repository "dotdeb-php54" do
                        uri "http://packages.dotdeb.org"
                        distribution node[:lsb][:codename]
                        components ["squeeze-php55"]
                        deb_src true
                        key "http://www.dotdeb.org/dotdeb.gpg"
                    end
            end
        end
    else
        puts "PHP 5.3"
    end

    execute "apt-get update" do
      command "apt-get update"
      ignore_failure true
      only_if { apt_installed? }
      action :run
    end
end

# run the php recipe
include_recipe "php"

service "php5-fpm" do
    action :restart
    start_command "sudo service php5-fpm start"
    stop_command "sudo service php5-fpm stop"
    status_command "sudo service php5-fpm status"
    restart_command "sudo service php5-fpm stop && sudo service php5-fpm start"
end

#configures php.ini files
if node[:platform_family] == "debian"
    %w{fpm cgi cli}.each do |pkg|
        template "#{node['php']['conf_dir']}/#{pkg}/php.ini" do
            cookbook "php"
            source "php.ini.erb"
            owner "root"
            group "root"
            mode "0644"
            variables(:directives => node[:php][:directives])
            notifies :restart, "service[php5-fpm]"
        end
    end
end

# create php aliases for cli debug
template "/etc/profile.d/php-aliases.sh" do
    source "/etc/profile.d/php-aliases.sh.erb"
    owner "root"
    group "root"
    mode "0644"
    :create_if_missing
    variables( :server_name_in_ide => "#{node[:hostname]}.local")
end
