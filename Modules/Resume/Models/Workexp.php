<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;


class Workexp extends Model
{
    
    protected $fillable = ['user_id','jobtitle','employer','city','state','startdate','enddate'];

}
