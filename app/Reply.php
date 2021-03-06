<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	
    protected $guarded = [];
    protected $fillable = [];
    public function owner ()
    {
       return $this->belongsTo(User::class,'user_id');
    }
}
