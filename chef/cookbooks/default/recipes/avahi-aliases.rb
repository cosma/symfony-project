#
# Cookbook Name:: default
# Recipe:: avahi-aliases
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

# install avahi aliasses for multiple domains and subdomains a python workaround

include_recipe "git"

# install some packages for development scope
%w{python-pip python-avahi}.each do |pkg|
    package pkg do
        action :install
    end
end

execute "install avahi-aliases" do
  command "pip install  git+git://github.com/airtonix/avahi-aliases.git"
end

execute "avahi-aliases" do
  command "avahi-alias start"
  action :nothing
end

template "/etc/avahi/aliases.d/default" do
    source "etc/avahi/aliases.d/default.erb"
    mode   "0644"
    owner  "root"
    group  "root"
    variables(
        :domain_aliases => node[:domain_aliases]
    )
    notifies :run, "execute[avahi-aliases]"
end