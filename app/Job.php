<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $title;

    public function __construct($title)
    {
        $this->title = $title;
    }
}
