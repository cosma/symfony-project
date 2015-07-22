#
# Cookbook Name:: default
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

# default receipes for executing on every node
include_recipe "apt"

# automatically updates   #include_recipe "default::auto-updates"
include_recipe "apt-periodic"

# set time zone
include_recipe "default::timezone"


include_recipe "ntp"

# install  domain
include_recipe "avahi"
# install domain aliases only if domain_aliases is set
unless node[:domain_aliases].nil?
    include_recipe "default::avahi-aliases" unless node[:domain_aliases].empty?
end

# install some packages for development scope
%w{vim nano curl build-essential python-software-properties acl mc htop ncdu mtr grc tmux zsh sysv-rc-conf git subversion lynx apt-show-versions}.each do |pkg|
    package pkg do
        action :install
    end
end
