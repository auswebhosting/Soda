<?php

namespace Soda\Component\Role;

class Role {

    public function __construct($roles)
    {
        foreach($roles as $key => $value)
        {
            $name = $value['name'];
            $capabilities = $value['capabilities'];

            add_role($key, $name, $capabilities);
        }
    }

}