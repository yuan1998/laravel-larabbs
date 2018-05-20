<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'category_id', 'reply_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'
    ];



    public function category ()
    {
        return $this->belongsto(Category::class);
    }



    public function user ()
    {
        return $this->belongsto(User::class);
    }



}
