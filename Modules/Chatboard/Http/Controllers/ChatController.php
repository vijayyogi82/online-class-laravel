<?php

namespace Modules\Chatboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use Modules\Chatboard\Models\Chat;
use Modules\Chatboard\Models\Conversations;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function chatlist()
    {
        $conversations = Conversations::where('receiver_id','=',auth()->id())
                         ->orWhere('sender_id','=',auth()->id())
                         ->whereHas('chat')
                         ->orderBy('id','DESC')
                         ->get();

        if(request()->user){
            $users = User::where('fname','LIKE','%'.request()->user.'%')
                     ->orWhere('lname','LIKE','%'.request()->user.'%')
                     ->where('id','!=',auth()->id())
                     ->paginate(10,['id','fname','lname','user_img','role']);
        }else{
            $users = User::where('id','!=',auth()->id())
                     ->paginate(10,['id','fname','lname','user_img','role']);
        }

        return view('chatboard::chat.chat_list',compact('conversations','users'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createchat($userid){

        $conversation = Conversations::where('receiver_id',$userid)
                        ->where('sender_id',auth()->id())
                        ->with('chat')
                        ->first();

        /** Search vise versa */

        if(!isset($conversation)){

            $conversation = Conversations::where('sender_id',$userid)
                        ->where('receiver_id',auth()->id())
                        ->with('chat')
                        ->first();

        }

        if(!$conversation){

            $conversation                = new Conversations;
            $conversation->conv_id       = Str::uuid();
            $conversation->receiver_id   = $userid;
            $conversation->sender_id     = auth()->id();
            $conversation->save();

        }

        return redirect(route('chat.screen',$conversation->conv_id));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function chatscreen($id){

        $conversation = Conversations::where('conv_id','=',$id)
                        ->with('chat')
                        ->firstOrfail();

        $reciever = $conversation->sender_id == auth()->id() ? $conversation->reciever : $conversation->sender;
        $chats = Chat::where('conv_id',$conversation->id)->where('user_id','!=', Auth::user()->id)->where('status','Not Seen')->get();
        foreach ($chats as $key => $chat) {
            $params['status'] = 'Seen';
            $chat->update($params);
        }
        return view('chatboard::chat.chat_screen',compact('conversation','reciever'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function sendmessage(Request $request,$conv_id){

        if($request->file('media')){
 
             $path = public_path() . '/images/conversations/';
             File::makeDirectory($path, $mode = 0777, true, true);
 
             $file = $request->media;
             $type = __('media');
 
             $name = 'chat_media_' . time() . str_random(10) . '.' . $file->getClientOriginalExtension();
             $img = Image::make($file);
 
             $img->resize(600, 600, function ($constraint) {
                 $constraint->aspectRatio();
             });
 
             $img->save($path . '/' . $name, 95);
             //file upload code and pass image url in pusher and response
        }else{
         
             $type = __('text');
 
        }
 
         try{
            date_default_timezone_set('Asia/Kolkata');
             $chat = Chat::create([
                 'message' => $request->message,
                 'type'    => $type,
                 'media'   => isset($name) ? $name : NULL,
                 'conv_id' => $conv_id,
                 'user_id' => auth()->id(),
             ]);
     
             return response()->json([
                 'status'  => 'success',
                 'message' => __('sent'),
                 'data' => $chat
             ]);
 
         }catch(\Exception $e){
 
             return response()->json([
                 'status' => 'fail',
                 'message' => $e->getMessage()
             ]);
 
         }
 
     }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function get_chat(Request $request,$id)
    {
        $conversation = Conversations::where('conv_id','=',$id)
                        ->with('chat')
                        ->firstOrfail();

        $reciever = $conversation->sender_id == auth()->id() ? $conversation->reciever : $conversation->sender;
        $chats = Chat::where('conv_id',$conversation->id)->where('user_id','!=', Auth::user()->id)->where('status','Not Seen')->get();
        foreach ($chats as $key => $chat) {
            $params['status'] = 'Seen';
            $chat->update($params);
        }
        return array(

            'chat_model' => view('chatboard::chat.live_chat', [ 'conversation' => $conversation ])->render(),

        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
