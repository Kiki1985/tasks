<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];

	public function expired()
    {
        return $this->hasOne('App\Expired');
    }
}
