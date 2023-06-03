<?php
namespace Modules\Forum\Models;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{

    /** This funciton is use to create self relation in reply */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_comment_id')->with('user');
    }

    /** This funciton is use to create self relation in comment */
    public function childrenCat()
    {
        return $this->hasMany(self::class, 'parent_comment_id', 'id')->with('user', 'children');
    }

    /** This funciton is use to create relation between users and comment table (one to one relation) */
    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'posted_by_user_id');
    }
}