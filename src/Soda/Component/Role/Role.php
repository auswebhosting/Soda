<?php

namespace Soda\Component\Role;

class Role {

	private $roles;

    public function __construct($roles)
    {
    	$this->roles = $roles;

        foreach($this->roles as $key => $value)
        {
            $name = $value['name'];

            if($this->getDefaults())
            {
            	$capabilities = wp_parse_args($value['capabilities'], $this->getDefaults());
            }
            else
            {
            	$capabilities = $value['capabilities'];
            }

            var_dump($capabilities);

            add_role($key, $name, $capabilities);
        }
    }

    private function getDefaults()
    {
        foreach($this->roles as $key => $value)
        {
        	if($key == 'default')
        	{
        		return $value['capabilities'];
        	}
        }

        return false;
    }

}