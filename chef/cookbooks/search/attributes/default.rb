#
# Cookbook Name:: search
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

# java attributes
default[:java][:install_flavor] = "oracle"
default[:java][:jdk_version] = "7"
default[:java][:accept_license_agreement] = "true"
default[:java][:oracle][:accept_oracle_download_terms] = "true"
default[:java][:java_home] = "/usr/lib/jvm/jdk1.7.0_25"
