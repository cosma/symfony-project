name "costore"
description "Role for installing and configuring everything on one server."

default_attributes({})

override_attributes({})
override_attributes({})

run_list(
    "role[default]",
    "role[app]",
    "role[db]",
    "recipe[symfony]"
)