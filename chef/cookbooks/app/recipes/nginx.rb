#
# Cookbook Name:: app
# Recipe:: nginx
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

include_recipe "nginx"

template "#{node[:nginx][:dir]}/conf.d/params.conf" do
    source "/etc/nginx/conf.d/params.conf.erb"
    owner "root"
    group "root"
    mode 0644
    if File.exists?("#{node[:nginx][:dir]}/conf.d/params.conf")
        notifies :reload, "service[nginx]"
    end
end

template "#{node[:nginx][:dir]}/sites-available/app" do
    source "/etc/nginx/sites-available/app.erb"
    owner "root"
    group "root"
    mode 0644
    variables(
        :port =>            node[:app][:port],
        :root_directory =>  node[:app][:root_directory],
        :log_dir =>         node[:nginx][:log_dir]
    )
    if File.exists?("#{node[:nginx][:dir]}/sites-available/app")
        notifies :reload, "service[nginx]"
    end
end

nginx_site "default" do
    enable false
end

nginx_site "app" do
    enable true
end

service "nginx" do
    action :reload
end