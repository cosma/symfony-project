#
# Cookbook Name:: app
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


# app attributes
default[:app][:port] = 80;
default[:app][:root_directory] = "/vagrant/web"

# php attributes
default[:php][:url]            = 'http://php.net/distributions'
default[:php][:version]        = "5.5.6"
default[:php][:conf_dir]       = "/etc/php5"
default[:php][:install_method] = "package"
default[:php][:packages]       = [
                                    "php5-fpm",
                                    "php5-cgi",
                                    "php5-dev",
                                    "php5-cli",
                                    "php-pear",
                                    "php5-mysql",
                                    "php5-xdebug",
                                    "php5-gd",
                                    "php5-memcache",
                                    "php5-mysqlnd",
                                    "php5-intl",
                                    "php5-curl"
                                    ]

default[:php][:directives]      = {
                                    "display_errors" => "On",
                                    "date.timezone" => "Europe/Berlin",
                                    "xdebug.remote_enable" => "1",
                                    "xdebug.remote_host" => "#{node[:default_server][:host_ip]}",
                                    "xdebug.remote_port" => "9000",
                                    "xdebug.remote_handler" => "dbgp",
                                    "xdebug.remote_mode" => "req",
                                    "xdebug.remote_log" => "/vagrant/tmp/xdebug/xdebug.log",
                                    "xdebug.auto_trace" => "0",
                                    "xdebug.collect_includes" => "1",
                                    "xdebug.collect_params" => "3",
                                    "xdebug.collect_return" => "1",
                                    "xdebug.default_enable" => "1",
                                    "xdebug.extended_info" => "1",
                                    "xdebug.show_local_vars" => "0",
                                    "xdebug.show_mem_delta" => "1",
                                    "xdebug.max_nesting_level" => "150",
                                    "xdebug.trace_enable_trigger" => "1",
                                    "xdebug.trace_format" => "0",
                                    "xdebug.trace_options" => "0",
                                    "xdebug.trace_output_dir" => "/vagrant/tmp/xdebug/trace",
                                    "xdebug.trace_output_name" => "%c",
                                    "xdebug.profiler_enable" => "0",
                                    "xdebug.profiler_enable_trigger" => "1",
                                    "xdebug.profiler_output_dir" => "/vagrant/tmp/xdebug/profiler",
                                    "xdebug.cli_color" => "1"
                                    }



# nginx attributes
default[:nginx][:repo_source]  = "nginx"
default[:nginx][:version]      = "1.4.4"





