<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsitePost extends Model
{

    protected $fillable = ['website_id', 'post_text'];

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }
}
