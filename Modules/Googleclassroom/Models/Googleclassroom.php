<?php

namespace Modules\Googleclassroom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Googleclassroom extends Model
{
    // use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Googleclassroom\Database\factories\GoogleclassroomFactory::new();
    // }

    protected $table = 'googleclassrooms';

    protected $fillable = ['user_id', 'owner_id', 'course_id', 'classroom_cource_id', 'cource_title', 'cource_description', 'cource_url', 'drive_url', 'link_by', 'classroom_cource_enrollment_code', 'cource_state','status', 'join_url', 'start_time','end_time','duration','timezone','image'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id')->withDefault();
    }

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id')->withDefault();
    }
}
