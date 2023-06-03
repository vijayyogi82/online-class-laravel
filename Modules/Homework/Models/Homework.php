<?php

namespace Modules\Homework\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    
    protected $table = 'homework';

    protected $fillable = ['description','pdf','user_id','course_id','compulsory','status','endtime','title','marks'];
    
    public function submithomework()
    {
        return $this->hasMany('Modules\Homework\Models\SubmitHomework','homework_id','id');
    }
}