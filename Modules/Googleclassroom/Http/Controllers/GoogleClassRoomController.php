<?php
namespace Modules\Googleclassroom\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Googleclassroom\Http\Controllers\GoogleClassRoomController;
use \Modules\Googleclassroom\Models\Googleclassroom;
use Illuminate\Support\Facades\Auth;
use File;
use Google_Client;
use Google_Service_Classroom;
use App\Course;
use App\User;
use Google_Service_Classroom_Course;
use getClient;
use DB;
use Session;
use Image;
use validator;
class GoogleClassRoomController extends Controller
{

    protected $client;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
        $auth_email = Auth::user()->email;
        $path = 'files/googleclassroom'.'/'.$auth_email;
       
        $tokenPath = public_path().'/'.$path.'/'.'client_secret.json';
        
        if(file_exists(public_path().'/'.$path.'/'.'client_secret.json')) {

            $client = new Google_Client();
            $client->setAuthConfig($tokenPath);
            $client->setScopes([
                Google_Service_Classroom::CLASSROOM_COURSES,
                Google_Service_Classroom::CLASSROOM_COURSES_READONLY,
                Google_Service_Classroom::CLASSROOM_COURSEWORK_ME,
                Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS,
                Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS_READONLY,
                Google_Service_Classroom::CLASSROOM_ROSTERS,
                Google_Service_Classroom::CLASSROOM_STUDENT_SUBMISSIONS_ME_READONLY,
                Google_Service_Classroom::CLASSROOM_ANNOUNCEMENTS_READONLY,
                Google_Service_Classroom::CLASSROOM_COURSEWORKMATERIALS_READONLY,
                "https://www.googleapis.com/auth/drive",
                "https://www.googleapis.com/auth/drive.file",
                "https://www.googleapis.com/auth/classroom.coursework.me"                             
              ]);
            $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
            $client->setHttpClient($guzzleClient);
            $this->client = $client;
            
        }

        return $next($request);
    });
       
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        
        $auth_email = Auth::user()->email;

        $path = 'files/googleclassroom'.'/'.$auth_email;

        if(file_exists(public_path().'/'.$path.'/'.'client_secret.json')) {
            
            try {
                session_start();
               
                if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
                    $this->client->setAccessToken($_SESSION['access_token']);
                    // ---------------------------
                    $courses = Googleclassroom::where('user_id', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();
                    return view('googleclassroom::admin.googleclassroom.index',compact('courses'));
                    // ---------------------

                } else {
                    return redirect()->route('oauthCallback');
                }
            }catch(\Exception $ex){
                \Session::flash('delete', $ex->getMessage());
                return redirect()->route('googleclassroom.setting');

            }
            }
            else{

            return redirect()->route('googleclassroom.setting')->with('delete','Please update settings !');

            }  
                    
    }

     /**
     * Show the form for google class room setting.
     * @return Renderable
     */
    public function classroomsetting()
    {
        return view('googleclassroom::admin.googleclassroom.setting');
    }

    /**
     * Store a google class room json file for authentication.
     * @param Request $request
     * @return Renderable
     */
    public function classroomupdatefile(Request $request)
    {
        $request->validate([
            'file' => ['required'],
          ],[
            'file.required' => 'Please Choose File',
          ]);

        $file = $request->file;
        $filext = $file->clientExtension();

        if($request->file != '' && 'json' == $filext){   
        // $file = $request->file;
        $extension =  $file->clientExtension();
        $renamefile = 'client_secret.'.$extension;
        
        }
        // ===
        if($renamefile != ''){

            $auth_email = Auth::user()->email;

            $path = 'files/googleclassroom'.'/'.$auth_email;

            if(!file_exists(public_path().'/'.$path)) {

                $path = 'files/googleclassroom'.'/'.$auth_email;
            
                // $path = 'images/category/';
                File::makeDirectory(public_path().'/'.$path,0777,true);
            }  

            //code for remove old file
                $file_old = $path.$renamefile; 
                if(file_exists($file_old)){
                    unlink($file_old);    
                }
                $query = $file->move($path, $renamefile); 
            if($query){
                return redirect()->route('googleclassroom.setting')->with('success','Token details updated successfully !');
            }else{
                return back()->with('delete','Error updating details !');
            }
       }
    }

    public function oauths()
    {
        $auth_email = Auth::user()->email;
        $path = 'files/googleclassroom'.'/'.$auth_email;
        $credentialsFile = public_path().'/'.$path.'/'.'client_secret.json';

        if(file_exists(public_path().'/'.$path.'/'.'client_secret.json')) {

            session_start();
            $rurl = action([GoogleclassroomController::class, 'oauths']);
            // $rurl = action('GoogleclassroomController@oauths');
            $client = new Google_Client();
            $client->setAuthConfig($credentialsFile);
            $client->setRedirectUri($rurl);
            $client->setScopes([
                Google_Service_Classroom::CLASSROOM_COURSES,
                Google_Service_Classroom::CLASSROOM_COURSES_READONLY,
                Google_Service_Classroom::CLASSROOM_COURSEWORK_ME,
                Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS,
                Google_Service_Classroom::CLASSROOM_COURSEWORK_STUDENTS_READONLY,
                Google_Service_Classroom::CLASSROOM_ROSTERS,
                Google_Service_Classroom::CLASSROOM_STUDENT_SUBMISSIONS_ME_READONLY,
                Google_Service_Classroom::CLASSROOM_ANNOUNCEMENTS_READONLY,
                Google_Service_Classroom::CLASSROOM_COURSEWORKMATERIALS_READONLY,
                "https://www.googleapis.com/auth/drive",
                "https://www.googleapis.com/auth/drive.file",
                "https://www.googleapis.com/auth/classroom.coursework.me"                             
              ]);
            $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
            $client->setHttpClient($guzzleClient);
           
            if (!isset($_GET['code'])) {
                $auth_url = $client->createAuthUrl();
                $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
                return redirect($filtered_url);
            } else {
                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
                return redirect()->route('googleclassroom.index');
            }

        } 
        else{

            return redirect()->route('googleclassroom.setting')->with('delete','Please update settings !');

        }  
    }
   

    public function allclass(){
        $courses = Googleclassroom::where('user_id', '=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('googleclassroom::admin.googleclassroom.allclass',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if(Auth::User()->role == "admin"){
            $course = Course::where('status', '1')->get();
          }
          else{
            $course = Course::where('status', '1')->where('user_id', Auth::User()->id)->get();
          }
        return view('googleclassroom::admin.googleclassroom.create', compact('course'));
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
          ],[
            'title.required' => 'Please enter title',
          ]);

        session_start();
        $userid = Auth::user()->id;
        $title = $request->title;
        $description = $request->cource_description;
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
        $service = new Google_Service_Classroom($this->client);
        $course = new Google_Service_Classroom_Course(array(
            'name' => $title,
            'description' => $description,
            'ownerId' => 'me',
            'courseState' => 'PROVISIONED'
          ));
          $course = $service->courses->create($course);
            // --- add in database start
            if(isset($request->link_by))
            {
                $link_by = 'course';
                $course_id = $request['course_id'];
            }
            else
            {
                $link_by = NULL;
                $course_id = NULL;
            }
            $googleclassroom = new Googleclassroom();
            $googleclassroom->user_id = $userid;
            $googleclassroom->owner_id = $course->ownerId;
            $googleclassroom->course_id = $request->course_id;
            $googleclassroom->classroom_cource_id = $course->id;
            $googleclassroom->cource_title = $course->name;
            $googleclassroom->cource_description = $course->description;
            $googleclassroom->cource_url = $course->alternateLink;
            $googleclassroom->link_by = $link_by;
            $googleclassroom->classroom_cource_enrollment_code = $course->enrollmentCode;
            $googleclassroom->cource_state = $course->courseState;
            $googleclassroom->start_time = $request->start_time;
            $googleclassroom->end_time = $request->end_time;
            $googleclassroom->duration = $request->duration;
            $googleclassroom->timezone = $request->timezone;
            $googleclassroom->join_url = 'https://classroom.google.com/u/0/h';
            if(isset($request->status))
            {
                $googleclassroom->status = '1';
            }
            else
            {
                $googleclassroom->status = '0';
            }

            if ($request->hasFile('image'))
            {
                $path = 'images/googleclassroom/profile_image/';

                if(!file_exists(public_path().'/'.$path)) {
                    
                    $path = 'images/googleclassroom/profile_image/';
                    File::makeDirectory(public_path().'/'.$path,0777,true);
                }

                $image = $request->file('image');
                $name = $image->getClientOriginalName();
                $destinationPath = public_path('images/googleclassroom/profile_image');
                $image->move($destinationPath, $name);
                $googleclassroom->image = $name;    
            }
            // --- add in database end
            if ($googleclassroom->save()) {
                return redirect()->route('googleclassroom.index')->with('success','Cource add successfully !');
            }
            return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('googleclassroom::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($courseId)
    {
        session_start();
        $userid = Auth::user()->id;

        if(Auth::User()->role == "admin"){
            $course = Course::where('status', '1')->get();
          }
          else{
            $course = Course::where('status', '1')->where('user_id', Auth::User()->id)->get();
          }

        //   ==============
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            // $service = new Google_Service_Classroom($this->client);
            // $classroomcourses = $service->courses->get($courseId);
            $classroomcourses = Googleclassroom::where('classroom_cource_id', $courseId)->first();
        }

        return view('googleclassroom::admin.googleclassroom.edit',compact('course','classroomcourses'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $courseId)
    {
        session_start();
        $googleclassroom = Googleclassroom::where('classroom_cource_id', $courseId)->first();
        $input = $request->all();
        $userid = Auth::user()->id;
        $title = $request['title'];
        $description = $request['cource_description'];
        //   ==============
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            // -----update in google class room start ----------------
            $service = new Google_Service_Classroom($this->client);
            $course = new Google_Service_Classroom_Course(array(
                'name' => $title,
                'description' => $description
              ));
              $params = array(
                'updateMask' => 'name,description'
              );

              $courseupdate = $service->courses->patch($courseId, $course, $params);
           
            // -----update in google class room end ----------------
              if (!$courseupdate) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']); 
              }

            // === update data into database start
            if ($file = $request->file('image')) 
            { 
            if($googleclassroom->image != "")
            {
                $image_file = @file_get_contents(public_path().'/images/googleclassroom/profile_image/'.$googleclassroom->image);
                if($image_file)
                {
                    unlink(public_path().'/images/googleclassroom/profile_image/'.$googleclassroom->image);
                }
            }       
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/googleclassroom/profile_image/';
            $image = time().$file->getClientOriginalName();
            $optimizeImage->save($optimizePath.$image, 72);
            $input['image'] = $image;
                        
            }

            if(isset($request->link_by))
            {
                $input['link_by'] = 'course';
                $input['course_id'] = $request['course_id'];
            }
            else
            {
                $input['link_by'] = NULL;
                $input['course_id'] = NULL;
            }

            if(isset($request->status))
            {
                $input['status'] = '1';
            }
            else
            {
                $input['status'] = '0';
            }
            $input['cource_title'] =  $title;
            $input['cource_description'] = $description;
            $googleclassroom->update($input);
            // === update data into database end
            return redirect()->route('googleclassroom.index')->with('success','Cource updated successfully !');
               
          } else {
            return redirect()->route('oauthCallback');
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($courseId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            // ==================
            Googleclassroom::where('classroom_cource_id',$courseId)->delete();
            // $service = new Google_Service_Classroom($this->client);
            // $course = $service->courses->delete($courseId);
            return back()->with('success','Cource Deleted successfully !');
            // ==================

        } else {
            return redirect()->route('oauthCallback');
        } 
    }

    // This function performs bulk delete action
    public function bulk_delete(Request $request)
    {
        $request->validate([
            'checked' => ['required'],
          ],[
            'checked.required' => 'Atleast one item is required to be checked',
          ]);

        Googleclassroom::whereIn('id',$request->checked)->delete();
        Session::flash('success',trans('Deleted Successfully'));
        return redirect()->back();
          
    }

    // This function performs status change action
    public function status(Request $request)
    {
        $googleclassroom = Googleclassroom::find($request->id);
        $googleclassroom->status = $request->status;
        $googleclassroom->save();
        return redirect()->route('googleclassroom.index')->with('success','Cource Status has been changed successfully ! !'); 
    }

    // detail page
    public function detail(Request $request, $id)
    {
        $googleclassroomdetail = Googleclassroom::where('id', $id)->where('user_id', Auth::User()->id)->first();
        return view('googleclassroom::frontend.googleclassroom.detail', compact('googleclassroomdetail'));
    }
}
