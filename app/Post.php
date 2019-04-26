<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     public function category()
    {
        return $this->belongsTo('App\Category');
    }

     public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

     public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    
}
