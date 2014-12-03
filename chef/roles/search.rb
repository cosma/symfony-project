name "search"
description "Role for installing and configuring a search server."

default_attributes({})

override_attributes({})

run_list(
    "role[default]",
    "recipe[search]"
)