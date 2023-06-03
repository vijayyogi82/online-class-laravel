<?php
namespace Modules\Forum\Models;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $fillable = ['topic_title', 'description', 'photo','category_id','status','created_by_user_id','display_order','display_in_listing','slug'];
    /** This funciton is use to create relation users and topics */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'created_by_user_id', 'id')->withDefault();
    }

    /** This funciton is use to create relation category */
    public function forumcategory()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id', 'id')->withDefault();
    }

    /** This funciton is use to create relation between comment and topic */
    public function comment()
    {
        return $this->hasMany(ForumComment::class, 'topic_id')->with('user');
    }
    public function category_detail()  {
        return $this->hasOne(ForumCategory::class, 'id', 'category_id');
    }
}