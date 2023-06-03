<?php

namespace Modules\Resume\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Resume\Models\Applyjob;
use Modules\Resume\Models\Postjob;
use Modules\Resume\Models\Jobsetting;
use Session;

class JobController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | JobController
    |--------------------------------------------------------------------------
    |
    | All job functionality related logics are placed in this controller.
    |
     */

    /**
     *  This function hold the functionality for job index page.
     *  @return view job index
     */
    public function index()
    {
        $jobs = Postjob::where('user_id', Auth::user()->id)->get();
        $applyjobs = Applyjob::where('user_id', Auth::user()->id)->paginate(10);
        return view('resume::front.job.index', compact('jobs', 'applyjobs'));

    }

    /**
     *  This function hold the functionality for admin job index page.
     *  @return view job /
     */
    public function adminindex()
    {
        $jobs = Postjob::all();
        return view('resume::front.job.admin.index', compact('jobs'));
    }

    /**
     *  This function hold the functionality for store job.
     *  @return response true
     *  @param $request
     *  @param $id
     */

    public function store(Request $request, $id)
    {
        $request->validate([
            'companyname' => 'required',
            'title' => 'required',
            'description' => 'required',
            'experience' => 'required',
            'minexp' => 'required',
            'maxexp' => 'required',
            'location' => 'required',
            'requirement' => 'required',
            'role' => 'required',
            'industry_type' => 'required',
            'employment_type' => 'required',
            'skills' => 'required',
        ]);

        $job['user_id'] = Auth::user()->id;
        $job['companyname'] = strip_tags($request->companyname);
        $job['title'] = strip_tags($request->title);
        $job['description'] = clean($request->description);
        $job['experience'] = strip_tags($request->experience);
        $job['min_experience'] = strip_tags($request->minexp);
        $job['max_experience'] = strip_tags($request->maxexp);
        $job['location'] = strip_tags($request->location);
        $job['requirement'] = strip_tags($request->requirement);
        $job['role'] = strip_tags($request->role);
        $job['industry_type'] = strip_tags($request->industry_type);
        $job['employment_type'] = strip_tags($request->employment_type);
        $job['salary'] = strip_tags($request->salary);
        $job['min_salary'] = strip_tags($request->minsalary);
        $job['max_salary'] = strip_tags($request->maxsalary);
        $job['skills'] = strip_tags($request->skills);

        if ($file = $request->file('image')) {

            $validator = Validator::make(
                [
                    'file' => strip_tags($request->image),
                    'extension' => strtolower($request->image->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:jpg,png',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors(__('Invalid file !'));
            }

            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/job', $name);
                $job['image'] = $name;
            }
        }

        Postjob::create($job);
        Session::flash('success', __('Job Create Successfully'));
        return back();
    }

    /**
     *  This function holds the functionality to search job.
     *  @return view find
     *  @param $request
     */
    public function find(Request $request)
    {
        /* Intitialize Query Builder */
        $postjob = Postjob::query();

        if ($request->search) {

            $result = $postjob->where("skills", "LIKE", '%' . strip_tags($request->search) . '%')
                ->orWhere("companyname", "LIKE", '%' . strip_tags($request->search) . '%')
                ->orWhere("title", "LIKE", '%' . strip_tags($request->search) . '%');

        } else {
            $result = $postjob->where('status', '1')
                ->where('approved', '1')
                ->orderBy('id', 'DESC');
        }

        $result = $postjob->paginate(10);

        return view('resume::front.job.find', compact('result'));

    }

    /**
     *  This function holds the functionality to admin job view.
     *  @return view view
     *  @param $request
     *  @param $id
     */

    public function adminjobview(Request $request, $id)
    {
        $job = Postjob::where('id', strip_tags($request->id))->first();
        return view('resume::front.job.admin.view', compact('job'));
    }

    /**
     *  This function holds the functionality to admin change job status.
     *  @return response true
     *  @param $request
     */

    public function adminstatus(Request $request)
    {
        $job = Postjob::find(strip_tags($request->id));
        $job->status = strip_tags($request->status);
        $job->save();
        return response()->json(true);
    }

    /**
     *  This function holds the functionality to user change job status.
     *  @return response true
     *  @param $request
     */

    public function userstatus(Request $request)
    {

        $job = Postjob::find(strip_tags($request->id));
        $job->status = strip_tags($request->status);
        $job->save();
        return response()->json(true);
    }

    /**
     *  This function holds the functionality to admin change approved status.
     *  @return response true
     *  @param $request
     */

    public function adminapproved(Request $request)
    {
        $job = Postjob::find(strip_tags($request->id));
        $job->approved = strip_tags($request->approved);
        $job->save();
        return response()->json(true);
    }

    /**
     *  This function holds the functionality to admin change verified status.
     *  @return response true
     *  @param $request
     */

    public function adminverified(Request $request)
    {
        $job = Postjob::find(strip_tags($request->id));
        $job->varified = strip_tags($request->verified);
        $job->save();

        return response()->json(true);
    }

    /**
     *  This function holds the functionality to admin delete job status.
     *  @return response true
     *  @param $request
     *  @param $id
     */

    public function adminjobdestroy($id)
    {
        $job = Postjob::findOrFail($id);
        $job->postjob()->delete();
        $job->delete();
        Session::flash('success', __('Delete Successfully'));
        return redirect()->back();
    }

    /**
     *  This function holds the functionality to display particular job view.
     *  @return view view
     *  @param $request
     *  @param $id
     */

    public function jobview(Request $request,$id)
    {
        $job = Postjob::findorfail($id);
        return view('resume::front.job.view', compact('job'));
    }

    /**
     *  This function holds the functionality to  apply for job.
     *  @return response true
     *  @param $request
     *  @param $id
     */

    public function applyjob(Request $request, $id)
    {
        $request->validate([
            'skills' => 'required',
        ]);

        $applyjob['skills'] = strip_tags($request->skills);
        $applyjob['experiense'] = strip_tags($request->experience);
        $applyjob['years'] = strip_tags($request->years);
        $applyjob['job_id'] = $id;
        $applyjob['user_id'] = Auth::user()->id;

        if ($file = $request->file('pdf')) {

            $validator = Validator::make(
                [
                    'file' => strip_tags($request->pdf),
                    'extension' => strtolower($request->pdf->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:pdf',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors(__('Invalid file !'));
            }

            if ($file = $request->file('pdf')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/applyjob', $name);
                $applyjob['pdf'] = $name;
            }
        }
        Applyjob::create($applyjob);
        Session::flash('success', __('Apply Successfully'));
        return back();
    }

    /**
     *  This function holds the functionality to  apply for job delete.
     *  @return response true
     *  @param $id
     */
    public function applyjobdestroy($id)
    {
        Applyjob::where('id', $id)->delete();
        Session::flash('success', __('Delete Successfully'));
        return back();
    }

    /**
     *  This function holds the functionality to job delete.
     *  @return response true
     *  @param $id
     */
    public function jobdestroy($id)
    {
        $job = Postjob::findOrFail($id);
        $job->postjob()->delete();
        $job->delete();
        Session::flash('success', __('Delete Successfully'));
        return back();
    }

    /**
     *  This function holds the functionality to filter the job.
     *  @return response true
     */

    public function filter(Request $request)
    {

        if ($request->location) {

            $result = Postjob::whereIN('location', $request->location)
                ->where('status', '1')
                ->where('approved', '1')
                ->paginate(10);

        } else {
            $result = Postjob::where('status', '1')
                ->where('approved', '1')
                ->paginate(10);

        }
        return view('resume::front.job.find', compact('result'));
    }

    /**
     *  This function holds the functionality to job edit.
     *  @return view edit
     * @param $request
     * @param $id
     */

    public function jobedit(Request $request, $id)
    {

        $job = Postjob::findOrFail($id);
        Session::flash('success', __('Job edit successfully'));
        return view('resume::front.job.edit', compact('job'));

    }

    /**
     *  This function holds the functionality to job show.
     *  @return view show
     *  @param $request
     *  @param $id
     */

    public function jobshow(Request $request, $id)
    {

        $job = Postjob::findorfail($id);
        $applyjobs = Applyjob::where('job_id', $id)->paginate(10);
        return view('resume::front.job.show', compact('job', 'applyjobs'));

    }

    /**
     * This function holds the functionality to job update.
     * @return response true
     * @param $request
     * @param $id
     */

    public function jobupdate(Request $request, $id)
    {

        $request->validate([
            'companyname' => 'required',
            'title' => 'required',
            'description' => 'required',
            'experience' => 'required',
            'minexp' => 'required',
            'maxexp' => 'required',
            'location' => 'required',
            'requirement' => 'required',
            'role' => 'required',
            'industry_type' => 'required',
            'employment_type' => 'required',
            'skills' => 'required',
        ]);

        $data = Postjob::where('id', $id)->first();
        $job['user_id'] = Auth::user()->id;
        $job['companyname'] = strip_tags($request->companyname);
        $job['title'] = strip_tags($request->title);
        $job['description'] = clean($request->description);
        $job['experience'] = strip_tags($request->experience);
        $job['min_experience'] = strip_tags($request->minexp);
        $job['max_experience'] = strip_tags($request->maxexp);
        $job['years'] = strip_tags($request->years);
        $job['location'] = strip_tags($request->location);
        $job['requirement'] = strip_tags($request->requirement);
        $job['role'] = strip_tags($request->role);
        $job['industry_type'] = strip_tags($request->industry_type);
        $job['employment_type'] = strip_tags($request->employment_type);
        $job['salary'] = strip_tags($request->salary);
        $job['min_salary'] = strip_tags($request->minsalary);
        $job['max_salary'] = strip_tags($request->maxsalary);
        $job['skills'] = strip_tags($request->skills);

        if ($file = $request->file('image')) {

            $validator = Validator::make(
                [
                    'file' => strip_tags($request->image),
                    'extension' => strtolower($request->image->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:jpg,png',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors(__('Invalid file !'));
            }

            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/job', $name);
                $job['image'] = $name;
            }
        }

        $data->update($job);
        Session::flash('success', __('Job update successfully'));
        return back();

    }

    /**
     * This function holds the functionality to resume download.
     * @return response true
     * @param $id
     */

    public function resume_download($id)
    {
        $job = Applyjob::where('id', $id)->value('pdf');
        $file = $job;

        $path = public_path() . "/files/applyjob/" . $job;
        $headers = array(
            'Content-Type : application/pdf',
        );
        return response()->download($path, $file, $headers);
    }

    /**
     * This function holds the functionality to admin job approved.
     * @return response true
     * @param $id
     * @param $request
    */

    public function jobapproved(Request $request, $id)
    {
        Postjob::where('id', '=', $id)->update(['approved' => 1]);
        Session::flash('success', __('Job status change successfully'));
        return back();
    }

    /**
     * This function holds the functionality to change job status.
     * @return response true
     * @param $request
     * @param $id
    */

    public function jobnotapproved(Request $request, $id)
    {
        Postjob::where('id', '=', $id)->update(['message' => strip_tags($request->message)]);
        Postjob::where('id', '=', $id)->update(['approved' => 0]);
        Session::flash('success', __('Job status change successfully'));
        return back();
    }
    public function import()
    {
        return view('resume::front.job.import');
    }

    public function csvfileupload(Request $req){

    $postjob = Postjob::all();
    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
    fgetcsv($csvFile); 
         $file_data= array();
        $data = array();
            while(($line = fgetcsv($csvFile)) !== FALSE){
            $data= array(
           'companyname' => $line[0],
            'title' => $line[1],
            'description' => $line[2],
            'requirement' => $line[3],
            'location' => $line[4],
            'min_experience' => $line[5],
            'max_experience' => $line[6],
            'experience' => $line[7],
            'role' => $line[8],
            'industry_type' => $line[9],
            'employment_type' => $line[10],
            'image' => $line[11],
            'min_salary' => $line[12],
            'max_salary' => $line[13],
            'salary' => $line[14],
            'skills' => $line[15],
            'user_id'=> $line[16]

           );
           Postjob::create($data);
           }
            fclose($csvFile);
            Session::flash('success', trans('Import Successfully'));
            return redirect('job');
        }
         public function search(Request $request)
    {
        /* Intitialize Query Builder */
        $postjob = Postjob::query();

        if ($request->search) {

            $result = $postjob->where("skills", "LIKE", '%' . strip_tags($request->search) . '%')
                ->orWhere("companyname", "LIKE", '%' . strip_tags($request->search) . '%')
                ->orWhere("title", "LIKE", '%' . strip_tags($request->search) . '%');

        } else {
            $result = $postjob->where('status', '1')
                ->where('approved', '1')
                ->orderBy('id', 'DESC');
        }

        $result = $postjob->paginate(10);

        return view('resume::front.job.search', compact('result'));

    }
    public function setting(){
        $jsetting = Jobsetting::first();
        return view('resume::front.job.admin.setting',compact('jsetting'));
    }
    public function update(Request $request)
    {
        try {

            $jsetting = Jobsetting::first();
            // $input = array_filter($request->all());
            if ($jsetting) {
                $jsetting->job_enable = isset($request->job_enable) ? 1 : 0;
                $jsetting->save();

            } else {

                $jsetting = new Jobsetting;
                $jsetting->job_enable = isset($request->job_enable) ? 1 : 0;
                $jsetting->save();
            }
            return redirect()->route('job.setting')->with('success', trans('flash.UpdatedSuccessfully'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
