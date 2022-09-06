<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailRequest extends Model
{

    protected $fillable = ['user_id', 'post_id'];
}
