name "app"
description "Role for installing and configuring an Application server."

default_attributes({})

override_attributes({})

run_list(
    "role[default]",
    "recipe[app]"
)