<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{
	/* filters of thread */

	protected $filter = ['by']; 
	
    // filter query by given username
	protected function by($username)
	{
		$user = User::where('name',$username)->firstOrFail();

        return $this->builder->where('user_id',$user->id);
	}
}