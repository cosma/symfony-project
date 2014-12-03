name              'balancer'
maintainer        "Cosmin Voicu"
maintainer_email  "cosmin.voicu@gmail.com"
license           "Apache 2.0"
description       "Installs & configures Load balancer server."
long_description  IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version           "1.0.0"

recipe            "default",        "Default installation & configuration of balancer server"
recipe            "default::nginx", "Set Nginx as Software load balancer"

%w{ ubuntu debian }.each do |os|
  supports os
end

depends "apt"
depends "memcached"
depends "nginx"
