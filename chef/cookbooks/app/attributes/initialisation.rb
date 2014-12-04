#
# Cookbook Name:: app
# Attributes:: initialisation
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

default[:composer][:php_recipe] = 'php::default'
default[:composer][:url] = 'http://getcomposer.org/composer.phar'
default[:composer][:install_dir] = '/usr/local/bin'
default[:composer][:bin] = "#{node['composer']['install_dir']}/composer"
default[:composer][:install_globally] = true
default[:composer][:mask] = 0777
default[:composer][:link_type] = :hard
default[:composer][:global_configs] = { 'vagrant' => nil }
default[:composer][:home_dir] = '/home/vagrant'






