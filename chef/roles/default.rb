name "default"
description "Role for installing and configuring a Default Server."

default_attributes({})

override_attributes({})

run_list(
    "recipe[default]"
)