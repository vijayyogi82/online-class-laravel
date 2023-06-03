<?php
namespace Modules\Forum\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Forum\Models\ForumTopic;
use \Modules\Forum\Models\ForumComment;
use \Modules\Forum\Models\ForumCategory;
use DB;
use Image;

class ForumTopicController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ForumTopicController
    |--------------------------------------------------------------------------
    |
    | This controller holds the funtionality of forum management.
    |
    */

    /** This funciton is use to add topics */
    /** @param $request */

    public function addforums(Request $request)
    {
        $request->validate([
            'topic_title' => 'required',
            'description' => 'required',
        ]);

        $forumTopic = new forumTopic;
        $forumTopic->topic_title = strip_tags($request->topic_title);
        $forumTopic->description = strip_tags($request->description);
        $forumTopic->category_id = strip_tags($request->category_id);
        $forumTopic->created_by_user_id = auth()->id();
        $forumTopic->display_order = __('1');
        $forumTopic->display_in_listing = __('1');
        $slug = str_slug(strip_tags($request->topic_title), '-');

        $forumTopic->slug = $slug;

        if(isset($request->status))
        {
            $forumTopic->status = __("1");
        }
        else
        {
            $forumTopic->status = __('2');
        }

        // -------------------------------------
        if (!is_dir(public_path() . '/admin_assets/forum')) {
            mkdir(public_path() . '/admin_assets/forum');
        }
      
        if($photo = $request->file('photo')){
            $imagename = time().'.'.$photo->getClientOriginalExtension(); 
            $destinationPath = public_path('/admin_assets/forum');
            $thumb_img = Image::make($photo->getRealPath())->resize(100, 100);
            $thumb_img->save($destinationPath.'/'.$imagename,80);
            $photo->move($destinationPath, $imagename);
            $forumTopic->photo = $imagename;
            
        }

        $forumTopic->save();
        return back()->with('success',__('Topic has been created successfully !'));
    }

    /** This funciton is use to display all topics */
    /** @return view  community-forum */ 

    public function forumsList()
    { 
        $formcategories = ForumCategory::where('status','1')->get();
        $forumLists = ForumTopic::with('user','comment','forumcategory')
                    ->where('status',1)->where('display_in_listing',1)
                    ->orderBy('display_order')
                    ->paginate(6);
        return view("forum::admin.forum.community-forum", compact('forumLists','formcategories'));
    }

    /** This funciton is use to display display topics on the basis of category */
    /** @param $id */
    /** @return view  community-forum-general */ 
    public function forumsdetailsfilter($id)
    { 
        $formcategories = ForumCategory::where('status','1')->get();
        $forumLists = ForumTopic::with('user','comment','forumcategory')->where('status',1)->where('display_in_listing',1)->where('category_id',$id)->orderBy('display_order')->paginate(6);
        return view("forum::admin.forum.community-forum-general", compact('forumLists','formcategories'));
    }

    /** This funciton is use to display display topics on the basis of category detail */
    /** @param $slug */
    /** @return view  community-forum-details */ 

    public function forumsDetails($slug)
    {
        $formcategories = ForumCategory::where('status','1')->get();
        $forumLists = ForumTopic::with('user','comment')
                      ->where('slug',$slug)
                      ->where('status',1)
                      ->where('display_in_listing',1)
                      ->orderBy('display_order')
                      ->first();
        $comments = ForumComment::where('topic_id',$forumLists->id)
                    ->with('childrenCat','user')
                    ->where('parent_comment_id', 0)
                    ->get();
        return view("forum::admin.forum.community-forum-details",compact('forumLists','comments','formcategories'));
    }

    /** This funciton is use to save comment */
    /** @param $request */
    /** @param $id */
    /** @return response true */ 

    public function commentSave(Request $request , $id)
    {
       
        $request->validate([
            'comment' => 'required',
        ]);

        $forumComment = new forumComment;
        $forumComment->topic_id = strip_tags($request->topic_id);
        $forumComment->parent_comment_id = $id;
        $forumComment->description = strip_tags($request->comment);
        $forumComment->posted_by_user_id = auth()->id();
        $forumComment->save();
        return back()->with('success',__("Comment has been saved successfully !"));

    }

    /** This funciton is use to save replay on a comment */
    /** @param $request */
    /** @return response true */ 

    public function reply(Request $request)
    {
       
        $validation = $request->validate([
            'comment' => 'required',
        ]);

        $forumComment = new forumComment;
        $forumComment->topic_id = strip_tags($request->topic_id);
        $forumComment->parent_comment_id = strip_tags($request->parent_comment_id);
        $forumComment->description = strip_tags($request->comment);
        $forumComment->posted_by_user_id = auth()->id();
        $forumComment->save();
        return back()->with('success',__('Replay on comment has been added !'));

    }

    /** This funciton is use to update a comment */
    /** @param $request */
    /** @param $id */
    /** @return response true */ 

    public function update(Request $request,$id)
    {
        $forumComment = ForumComment::findorfail($id);
        $forumComment->description = strip_tags($request->comment);
        $forumComment->save();
        return back()->with('success',__('Comment has been updated successfully !'));
    }

    /** This funciton is use to delete a comment */
    /** @param $id */
    /** @return response true */ 

    public function delete($id)
    {
        DB::table('forum_comments')
            ->where('id',$id)
            ->delete();
        return back()->with('deleted',__('Comment has been deleted successfully !'));
    }

    /** This funciton is use to add a category */
    /** @param $id */
    /** @return response true */ 


    public function addforumscategory(Request $request)
    {
        
        $request->validate([
            'category_name' => 'required',
        ]);
        $forumCategory = new ForumCategory;
        $forumCategory->category_name = strip_tags($request->category_name);
        $slug = str_slug(strip_tags($request->category_name), '-');
        $forumCategory->slug = $slug;
        if(isset($request->status))
        {
            $forumCategory->status = __('1');
        }
        else
        {
            $forumCategory->status = __('2');
        }

        $forumCategory->save();

        return back()->with('success',__("Forum category has been added successfully !"));
    }
}
