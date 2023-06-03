<?php

namespace Modules\Chatboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function conversation(){
        return $this->belongsTo(Conversations::class,'conv_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Chatboard\Database\factories\ChatFactory::new();
    }
}
