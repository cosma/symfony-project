#
# Cookbook Name:: default
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

default[:default_server][:guest_ip] = node[:network][:interfaces][:eth1][:addresses].detect{|k,v| v[:family] == "inet" }.first
default[:default_server][:host_ip]  = default[:default_server][:guest_ip].gsub /\.\d+$/, ".1"

# avahi-daemon.conf values
#default[:avahi][:hostname] = "#{default[:hostname]}"
#default[:avahi][:domain]   = "local"

default[:apt_periodic][:unattended_upgrade_interval] = "7"
default[:apt_periodic][:unattended_upgrades][:mail] = ""
default[:apt_periodic][:unattended_upgrades][:allowed_origins] = ['${distro_id}:${distro_codename}-security']