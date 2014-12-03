#
# Cookbook Name:: balancer
# Attributes:: default
#
# Author::  Cosmin Voicu(<cosmin.voicu@gmail.com>)
# Copyright::  2013, Cosmin Voicu
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
# http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
#

# balancer attributes
default[:balancer][:port] = 80;
default[:balancer][:application_servers] = {
    "app.local" => 4
    #"app2.local" => 1
}

# memcached attributes
default[:memcached][:memory] = 128
default[:memcached][:port] = 11211
default[:memcached][:listen] = '0.0.0.0'
default[:memcached][:maxconn] = 1024
default[:memcached][:max_object_size] = '1m'
default[:memcached][:logfilename] = 'memcached.log'
default[:memcached][:user] = 'nobody'
default[:memcached][:group] = 'nogroup'

# nginx attributes
default[:nginx][:repo_source] = "nginx"
default[:nginx][:version] = "1.4.4"

