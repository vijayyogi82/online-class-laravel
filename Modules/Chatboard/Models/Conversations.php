<?php

namespace Modules\Chatboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversations extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chat(){
        return $this->hasMany(Chat::class,'conv_id');
    }

    public function sender(){
        return $this->belongsTo('App\User','sender_id','id');
    }

    public function reciever(){
        return $this->belongsTo('App\User','receiver_id','id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Chatboard\Database\factories\ConversationsFactory::new();
    }
}
