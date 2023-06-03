<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;


class Acedemic extends Model
{
    protected $fillable = ['user_id','course','school','marks','yearofpassing'];
}
