<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWebsiteSubscription extends Model
{

    protected $fillable = ['user_id', 'website_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
