<?php

namespace Modules\Ebook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ebook extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function newFactory()
    {
        return \Modules\Ebook\Database\factories\EbookFactory::new();
    }

    public function category()   
    {
        return $this->hasOne('Modules\Ebook\Models\EbookCategory','id','category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id')->withDefault();
    }
}
