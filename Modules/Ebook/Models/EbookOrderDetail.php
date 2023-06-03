<?php

namespace Modules\Ebook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EbookOrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function newFactory()
    {
        return \Modules\Ebook\Database\factories\EbookOrderDetailFactory::new();
    }
}
