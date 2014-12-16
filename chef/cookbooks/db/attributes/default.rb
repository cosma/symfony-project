#
# Cookbook Name:: db
# Attributes:: default
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

# db attributes
default[:db][:mysql][:databases] = ["symfony", "symfony_dev", "symfony_test"]

# Define  mysql users and rights for application
default[:db][:mysql][:users] = {
    :costore => {
        :privileges => [:all],
        :databases => ["symfony", "symfony_dev", "symfony_test"]
    }
}

# mysql attributes
default[:mysql][:bind_address] = "0.0.0.0"
default[:mysql][:allow_remote_root] = true
default[:mysql][:remove_anonymous_users] = true
default[:mysql][:remove_test_database] = true

# Set passwords for default mysql users
mysql_user = Chef::DataBagItem.load("mysql_users", "debian")
default[:mysql][:server_debian_password] = mysql_user["password"]

mysql_user = Chef::DataBagItem.load("mysql_users", "root")
default[:mysql][:server_root_password] = mysql_user["password"]

mysql_user = Chef::DataBagItem.load("mysql_users", "repl")
default[:mysql][:server_repl_password] = mysql_user["password"]


