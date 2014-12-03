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

include_recipe "mysql::server"
include_recipe "database::mysql"

# create connection info as an external ruby hash
mysql_connection_info = {
    :host => "127.0.0.1",
    :username => "root",
    :password => node[:mysql][:server_root_password]
}

#user_shop = Chef::DataBagItem.load("mysql_users", "costore")

# create mysql databases
node[:db][:mysql][:databases].each do |database|
  mysql_database "#{database}" do
    connection mysql_connection_info
    action :create
  end
end

# create mysql users and grant privileges
node[:db][:mysql][:users].each do |user_name, user|
  user_item = Chef::DataBagItem.load("mysql_users", "#{user_name}")

  mysql_database_user "#{user_name}" do
    connection mysql_connection_info
    password user_item["password"]
    host "%"
    action :create
  end

  user[:databases].each do |database_name|
    mysql_database_user "#{user_name}" do
      connection mysql_connection_info
      privileges user[:privileges]
      database_name "#{database_name}"
      host "%"
      action :grant
    end
  end
end

service "mysql" do
    action :restart
end