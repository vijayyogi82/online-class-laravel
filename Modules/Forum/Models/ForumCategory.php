<?php

namespace Modules\Forum\Models;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    protected $table = 'forums_categories';
    protected $fillable = ['category_name', 'status','slug'];
}