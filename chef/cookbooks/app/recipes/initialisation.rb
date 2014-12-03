#
# Cookbook Name:: app
# Recipe:: initialisation
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

include_recipe "composer"
include_recipe "composer::self_update"

bash "install composer Symfony" do
    user "vagrant"
    group "vagrant"
    cwd "/vagrant"
    code <<-EOH
        COMPOSER_PROCESS_TIMEOUT=3000 composer install --prefer-source --no-interaction
        EOH
    environment ({'HOME' => '/home/vagrant'})
end