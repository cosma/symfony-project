#
# Cookbook Name:: default
# Recipe:: timezone
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

# set timezone to Europe/Berlin
bash "Set timezone to Europe/Berlin" do
    code <<-EOH
        echo "Europe/Berlin" > /etc/timezone
        dpkg-reconfigure --frontend noninteractive tzdata
    EOH
end

# set default locale to en_US.UTF-8
bash "Set default locale to en_US.UTF-8" do
    code <<-EOH
        update-locale LANG=en_US.UTF-8 LC_ALL=en_US.UTF-8
    EOH
end