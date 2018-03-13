<?php


// Some helper functions to write tests more easy (wrapper likestuff)

function create ($class,$attributes = [])
{
   return factory($class)->create($attributes);  
}

function make($class, $attributes = [])
{
  return factory($class)->make($attributes);
}
