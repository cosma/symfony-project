name              'default'
maintainer        "Cosmin Voicu"
maintainer_email  "cosmin.voicu@gmail.com"
license           "Apache 2.0"
description       "Installs & configures specific stuff for all type of servers."
long_description  IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version           "1.0.0"

recipe            "default",                "Default installation and configuration"
recipe            "default::auto-updates",  "Install autoupdates"
recipe            "default::timezone",      "Set timezone"
recipe            "default::avahi-alias",  "Install domain aliases"

%w{ ubuntu debian }.each do |os|
  supports os
end

depends "apt"
depends "apt-periodic"
depends "ntp"
depends "git"
depends "avahi"