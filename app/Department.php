<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
