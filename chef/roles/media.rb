name "media"
description "Role for installing and configuring a Media server."

default_attributes({})

override_attributes({})

run_list(
    "role[default]",
    "recipe[media]"
)