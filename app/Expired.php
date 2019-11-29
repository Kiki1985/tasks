<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expired extends Model
{
    public function task()
    {
        return $this->hasOne('App\Task');
    }
}
