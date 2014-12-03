name "balancer"
description "Role for installing and configuring a balancer server."

default_attributes({})

override_attributes({})

run_list(
    "role[default]",
    "recipe[balancer]"
)