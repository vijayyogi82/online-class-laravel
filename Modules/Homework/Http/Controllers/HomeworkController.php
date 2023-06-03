<?php

namespace Modules\Homework\Http\Controllers;

use App\Course;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Homework\Models\Homework;
use Modules\Homework\Models\SubmitHomework;
use Session;

class HomeworkController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HomeworkController
    |--------------------------------------------------------------------------
    |
    | All homework functionality related logics are placed in this controller.
    |
     */

   /**
     *  This function hold the functionality for homework list view.
     *  @param $course_id
     *  @return view homework index
     */

    public function index($course_id)
    {
        $course = Course::where('id', $course_id)->first();
        $homework = Homework::where('course_id', $course_id)->get();

        return view('homework::admin.homework.index', compact('course'))
            ->with('homework', $homework);

    }

    /**
     *  This function hold the functionality for homework create page.
     *  @param $request
     *  @return view homework create
     */

    public function create(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();
        return view('homework::admin.homework.create', compact('course'));
    }

    /**
     *  This function holds the functionality to store homework.
     *  @return store homework
     *  @param $request
     */

    public function store(Request $request)
    {

        $request->validate([
            "title" => "required",
            "marks" => "required",
            "endtime" => "required",
            "description" => "required"
        ]);

        if ($file = $request->file('homework')) {

            $validator = Validator::make(
                [
                    'file' => $request->homework,
                    'extension' => strtolower($request->homework->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:zip,pdf,jpg,png,jpeg',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors('Invalid file !');
            }

            if ($file = $request->file('homework')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/homework', $name);
                $input['pdf'] = $name;
            }
        }

        $input['title'] = strip_tags($request->title);
        $input['description'] = strip_tags($request->description);
        $input['user_id'] = Auth::User()->id;
        $input['course_id'] = strip_tags($request->course_id);

        $input['status'] = (isset($request->status) ? '1' : '0');
        $input['marks'] = strip_tags($request->marks);
        $input['compulsory'] = (isset($request->compulsory) ? '1' : '0');
        $input['endtime'] = date('Y-m-d H:i:s', strtotime($request->endtime));

        Homework::create($input);

        Session::flash('success', __('flash.AddedSuccessfully'));
        return redirect()->route('homework.index', $request->course_id);
    }

    /**
     *  This function holds the functionality to edit homework.
     *  @return edit homework view
     */

    public function edit(Request $request, $id, $cat)
    {
        $course = Course::where('id', $cat)->first();
        $homework = Homework::where('id', $id)->first();
        return view('homework::admin.homework.edit', compact('homework', 'course'));
    }

   /**
     *  This function holds the functionality to update homework.
     *  @return update homework 
     *  @param $id
     *  @param $course_id
     *  @param $request
     */

    public function update(Request $request, $id, $course_id)
    {
        $request->validate([
            "title" => "required",
            "marks" => "required",
            "endtime" => "required",
            "description" => "required"
        ]);

        $homework = Homework::where('id', $id)->first();
        $input = $request->all();
        $input['title'] = strip_tags($request->title);
        $input['description'] = strip_tags($request->description);
        $input['marks'] = strip_tags($request->marks);

        $input['status'] = (isset($request->status) ? '1' : '0');
        $input['compulsory'] = (isset($request->compulsory) ? '1' : '0');
        $input['endtime'] = date('Y-m-d H:i:s', strtotime($request->endtime));
        $homework->update($input);

        Session::flash('success', __('Update Successfully'));

        return redirect()->route('homework.index', $course_id);
    }

    /**
     *  This function holds the functionality to delete homework.
     *  @return delete homework 
     *  @param $id
     */

    public function delete($id)
    {
        $homeworkdelete = Homework::findOrFail($id);
        $homeworkdelete->submithomework()->delete();

        $homeworkdelete->delete();
        Session::flash('delete', trans('flash.DeletedSuccessfully'));
        return redirect()->back();

    }

    /**
     *  This function holds the functionality to view homework.
     *  @return homework view
     *  @param $id
     *  @param $course_id
     *  @param $request
     */

    public function view(Request $request, $id, $course_id)
    {
        $course = Course::where('id', $course_id)->first();

        $subhomework = Homework::findOrFail($id)->submithomework;

        return view('homework::admin.homework.view', compact('course'))
            ->with('subhomework', $subhomework);

    }

    /**
     *  This function holds the functionality to submit homework via student.
     *  @return store homework
     *  @param $id
     *  @param $request
     */

    public function submit(Request $request, $id)
    {
        $input = $request->all();

        if ($file = $request->file('homework')) {

            $validator = Validator::make(
                [
                    'file' => $request->homework,
                    'extension' => strtolower($request->homework->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:zip,pdf,jpg,png,jpeg',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors('Invalid file !');
            }

            if ($file = $request->file('homework')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/SubmitHomework', $name);
                $input['homework'] = $name;
            }
        }

        $input['user_id'] = auth()->id();
        $input['instructor_id'] = strip_tags($request->instructor_id);
        $input['course_id'] = $id;
        $input['homework_id'] = strip_tags($request->homework_id);

        SubmitHomework::create($input);

        return back()->with('success', __('flash.SubmittedSuccessfully'));

    }

    /**
     *  This function holds the functionality to update student marks.
     *  @return update marks
     *  @param $id
     *  @param $request
     */

    public function marksupdate(Request $request, $id)
    {

        $subhomework = SubmitHomework::where('id', $id)->first();
        $input = $request->all();
        $subhomework->update($input);
        return back()->with('success', trans('Update Successfully'));

    }

    /**
     *  This function holds the functionality to download homework that given by admin.
     *  @return download homework
     *  @param $id
     */

    public function download($id)
    {
        $homework = Homework::where('id', $id)->value('pdf');
        $file = $homework;

        $path = public_path() . "/files/Homework/" . $homework;
        ob_end_clean();

        $headers = array(
            'Content-Type : application/pdf',
        );
        return response()->download($path, $file, $headers);
    }

    /**
     *  This function holds the functionality to download student submitted homework.
     *  @return download SubmitHomework
     *  @param $id
     */

    public function submithomeworkdownload($id)
    {
        $homework = SubmitHomework::where('id', $id)->value('homework');
        $file = $homework;

        $path = public_path() . "/files/SubmitHomework/" . $homework;
        ob_end_clean();

        $headers = array(
            'Content-Type : application/pdf',
        
        );
        return response()->download($path, $file, $headers);
    }

    /**
     *  This function holds the functionality to change homework status.
     *  @return response true
     *  @param $request
     */

    public function status(Request $request)
    {
        $homework = Homework::find(strip_tags($request->id));

        $homework->status = strip_tags($request->status);

        $homework->save();

        return response()->json($request->all());
    }

    /**
     *  This function holds the functionality to mark homework as compulsory.
     *  @return response true
     *  @param $request
     */

    public function compulsory(Request $request)
    {
        $homework = Homework::find(strip_tags($request->id));

        $homework->compulsory = strip_tags($request->compulsory);

        $homework->save();
        return response()->json($request->all());
    }

}