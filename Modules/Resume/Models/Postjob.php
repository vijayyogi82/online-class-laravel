<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Postjob extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','companyname','title','description','message','min_experience','max_experience','experience','location','requirement','role','industry_type','employment_type','image','min_salary','max_salary','salary','skills','years','status','varified','approved'];
    
    protected static function newFactory()
    {
        return \Modules\Resume\Database\factories\PostjobFactory::new();
    }

    public function postjob()
    {
        return $this->hasMany('Modules\Resume\Models\Applyjob','job_id','id');
    }
}
