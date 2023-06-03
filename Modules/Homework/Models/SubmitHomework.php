<?php

namespace Modules\Homework\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitHomework extends Model
{
    protected $fillable = ['user_id','instructor_id','homework_id','course_id','detail','homework','remark','marks'];
}