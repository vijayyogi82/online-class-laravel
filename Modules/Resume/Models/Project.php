<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    protected $fillable = ['user_id','projecttitle','role','description'];
}
