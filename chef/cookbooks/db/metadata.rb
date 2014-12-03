name              'db'
maintainer        "Cosmin Voicu"
maintainer_email  "cosmin.voicu@gmail.com"
license           "Apache 2.0"
description       "Installs & configures RDBMS."
long_description  IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version           "1.0.0"

recipe            "default", "Default installation & configuration"

%w{ ubuntu debian }.each do |os|
  supports os
end

depends "default"

depends "mysql"
depends "database"
