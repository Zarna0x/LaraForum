<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;



abstract class Filters 
{
	protected $request;
    protected $builder;
    protected $filters;

	public function __construct (Request $request)
	{
		$this->request = $request;

	}

	// returns builder object
	public function apply($builder)
	{
		$this->builder = $builder;

// get all filters. check if method exists for given filter. if so execute given method for filter...
 collect($this->getFilters())->filter(function ($value,$filter) {
  return method_exists($this, $filter);
})->each(function ($value,$filter) {
	
	$this->$filter($value);
});


        // foreach ($this->getFilters() as $filter => $val) {
        	
        //    if ($this->hasFilter($filter)) {
        //       return $this->$filter($this->request->$filter);
        //    }
        // }

		return $this->builder;
                  
 	}
    
    protected function getFilters ()
    {
    	return $this->request->intersect($this->filters);
    }

    // check if filter method exists on given filter and is request asks for given filter
 	protected function hasFilter ($filter): bool
 	{
      return method_exists($this,$filter) && $this->request->has($filter);
 	}

}