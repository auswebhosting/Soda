<?php

namespace Soda\Entity;

class BaseEntity
{
    protected $app;

    public function __construct()
    {
        global $app;
        $this->app = $app;
    }

    public function createProperties($object)
    {
        foreach($object as $key => $value)
        {
            $property = strtolower($key);
            $this->$property = $value;
        }
    }
}