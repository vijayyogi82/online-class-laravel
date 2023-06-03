<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applyjob extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','job_id','experiense','years','skills','pdf'];
    
    protected static function newFactory()
    {
        return \Modules\Resume\Database\factories\ApplyjobFactory::new();
    }
    public function applyjob()   
    {
        return $this->hasMany('Modules\Resume\Models\Postjob','id','job_id');
    }

   public function company()   
    {
        return $this->hasOne('Modules\Resume\Models\Postjob','id','job_id');
    }
}