<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobsetting extends Model
{
    use HasFactory;

    protected $fillable = ['job_enable'];
    
    protected static function newFactory()
    {
        return \Modules\Resume\Database\factories\JobsettingFactory::new();
    }
}
