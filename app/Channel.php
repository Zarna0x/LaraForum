<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	// override key for route model binding
	public function getRouteKeyName()
	{
	    return 'slug';
	}

	public function threads()
	{
		//channel has many threads
		return $this->hasMany(Thread::class);
	}


}
