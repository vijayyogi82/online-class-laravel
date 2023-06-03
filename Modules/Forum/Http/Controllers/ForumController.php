<?php
namespace Modules\Forum\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use App\Setting;

class ForumController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ForumController
    |--------------------------------------------------------------------------
    |
    | This controllers holds the functionality for forum settings.
    |
    */

    /** @return view forum index */

    public function index()
    {
        $forumstatus = DB::table('settings')->first();
        return view('forum::admin.forum.index', compact('forumstatus'));
    }

    /** This function holds the funtionality to chnage status of forum enable globally */
    /** @param $request */

    public function changeStatus(Request $request)
    {
        $forum = Setting::find($request->user_id);
        $forum->forum_enable = strip_tags($request->status);
        $forum->save();
    }

}