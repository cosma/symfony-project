name "db"
description "Role for installing and configuring a Database server."

default_attributes({})

override_attributes({})

run_list(
    "role[default]",
    "recipe[db]"
)