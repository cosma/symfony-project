#
# Cookbook Name:: db
# Recipe:: mariadb
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


if node[:platform_family] == "debian"
    case node[:lsb][:codename]
        when "trusty", "precise", "quantal", "raring"
            apt_repository "ondrej-mariadb" do
                uri "http://ppa.launchpad.net/ondrej/mariadb-10.0/ubuntu"
                distribution distribution node[:lsb][:codename]
                components ["main"]
                deb_src true
                keyserver "keyserver.ubuntu.com"
                key "E5267A6C"
            end
    end
end

include_recipe "mariadb"

mysql2_chef_gem 'default' do
  provider Chef::Provider::Mysql2ChefGem::Mariadb
  action :install
end