<?php

namespace Modules\Resume\Models;

use Illuminate\Database\Eloquent\Model;


class Personalinfo extends Model
{
    protected $fillable = ['fname','lname','profession','country','state','city','address','phone','email','status','verified','message','skill','strength','interest','user_id','image','objective','language'];
   

    public function Acedemic()
    {
        return $this->hasMany('Modules\Resume\Models\Acedemic','user_id','user_id');
    }
    public function Works()
    {
        return $this->hasMany('Modules\Resume\Models\Workexp','user_id','user_id');
    }
    public function Project()
    {
        return $this->hasMany('Modules\Resume\Models\Project','user_id','user_id');
    }
    
    
}
