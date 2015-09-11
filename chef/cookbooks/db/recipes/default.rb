#
# Cookbook Name:: db
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


mysql_service 'default' do
    bind_address node[:mysql][:bind_address]
    port node[:mysql][:port]
    version node[:mysql][:version]
    initial_root_password node[:mysql][:server_root_password]
    action [:create, :start]
end

mysql2_chef_gem 'default' do
    gem_version '0.3.17'
    provider Chef::Provider::Mysql2ChefGem::Mysql
    action :install
end

# create connection info as an external ruby hash
db_connection_credentials = {
    :host => "127.0.0.1",
    :username => "root",
    :password => node[:mysql][:server_root_password]
}

# create mysql databases
node[:db][:databases].each do |database|
  mysql_database "#{database}" do
    connection db_connection_credentials
    encoding node[:db][:encoding]
    collation node[:db][:collation]
    action :create
  end
end

# create mysql users and grant privileges
node[:db][:users].each do |user_name, user|
  user_item = Chef::DataBagItem.load("db_users", "#{user_name}")

  mysql_database_user "#{user_name}" do
    connection db_connection_credentials
    password user_item["password"]
    host "%"
    action :create
  end

  user[:databases].each do |database_name|
    mysql_database_user "#{user_name}" do
      connection db_connection_credentials
      privileges user[:privileges]
      database_name "#{database_name}"
      host "%"
      action :grant
    end
  end
end

service "mysql-default" do
    action :restart
end