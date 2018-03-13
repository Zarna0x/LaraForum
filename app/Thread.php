<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    protected $fillable = [];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCounty',function ($builder) {
          $builder->withCount('replies');

        });
    }

    public function path ()
    {
    	return '/threads/'.$this->channel->slug.'/'.$this->id;
    }

    public function replies ()
    {
       return $this->hasMany(Reply::class);
    }

    public function owner () 
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply ($params)
    {
        $this->replies()->create($params);
    }

    public function scopeFilter($query,$filters)
    {
       return $filters->apply($query);
    }

    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }
}
