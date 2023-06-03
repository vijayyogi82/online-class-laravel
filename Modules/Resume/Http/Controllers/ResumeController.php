<?php

namespace Modules\Resume\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Resume\Models\Acedemic;
use Modules\Resume\Models\Personalinfo;
use Modules\Resume\Models\Project;
use Modules\Resume\Models\Workexp;
use Session;

class ResumeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | ResumeController
    |--------------------------------------------------------------------------
    |
    | All resume  functionality related logics are placed in this controller.
    |
     */

    /**
     *  This function hold the functionality for resume index page.
     *  @return view resume index
     */
    public function index()
    {
        $persoanl = Personalinfo::where('user_id', Auth::user()->id)->first();
        $persoanlview = Personalinfo::where('user_id', Auth::user()->id)->first();
        $works = Workexp::where('user_id', Auth::user()->id)->get();
        $worksview = Workexp::where('user_id', Auth::user()->id)->get();
        $education = Acedemic::where('user_id', Auth::user()->id)->get();
        $educationview = Acedemic::where('user_id', Auth::user()->id)->get();
        $project = Project::where('user_id', Auth::user()->id)->get();
        $projectview = Project::where('user_id', Auth::user()->id)->get();
        return view('resume::front.index', compact('projectview', 'worksview', 'educationview', 'persoanlview', 'persoanl', 'works', 'education', 'project'));
    }

    /**
     *  This function holds the functionality to store resume.
     *  @return response true
     *  @param $request
     */

    public function store(Request $request)
    {

        $persoanl['fname']      = strip_tags($request->fname);
        $persoanl['lname']      = strip_tags($request->lname);
        $persoanl['profession'] = strip_tags($request->profession);
        $persoanl['country']    = strip_tags($request->country);
        $persoanl['state']      = strip_tags($request->country_state);
        $persoanl['city']       = strip_tags($request->country_city);
        $persoanl['address']    = strip_tags($request->address);
        $persoanl['phone']      = strip_tags($request->phone);
        $persoanl['email']      = strip_tags($request->email);
        $persoanl['skill']      = strip_tags($request->skill);
        $persoanl['strength']   = strip_tags($request->strength);
        $persoanl['interest']   = strip_tags($request->interest);
        $persoanl['objective']  = strip_tags($request->objective);
        $persoanl['language']   = strip_tags($request->language);

        if ($file = $request->file('photo')) {

            $validator = Validator::make(
                [
                    'file' => strip_tags($request->photo),
                    'extension' => strtolower($request->photo->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:jpg,png',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors(__('Invalid file !'));
            }

            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/resume', $name);
                $persoanl['image'] = $name;
            }
        }

        $persoanl['user_id'] = Auth::user()->id;

        /** foreach for acedemic **/
        foreach ($request->course as $key => $course) {

            Acedemic::create([
                'user_id'       => Auth::user()->id,
                'course'        => strip_tags($request->course[$key]),
                'school'        => strip_tags($request->school[$key]),
                'marks'         => strip_tags($request->marks[$key]),
                'yearofpassing' => strip_tags($request->yearofpassing[$key]),
            ]);

        }

        /** foreach for  workexp **/
        foreach ($request->startdate as $key => $course) {
            Workexp::create([
                'user_id'       => Auth::user()->id,
                'startdate'     => strip_tags($request->startdate[$key]),
                'enddate'       => strip_tags($request->enddate[$key]),
                'city'          => strip_tags($request->city[$key]),
                'state'         => strip_tags($request->state[$key]),
                'jobtitle'      => strip_tags($request->jobtitle[$key]),
                'employer'      => strip_tags($request->employer[$key]),
            ]);

        }

        /** foreach for  project **/
        foreach ($request->projecttitle as $key => $course) {

            Project::create([

                'user_id'       => Auth::user()->id,
                'projecttitle'  => strip_tags($request->projecttitle[$key]),
                'role'          => strip_tags($request->role[$key]),
                'description'   => strip_tags($request->description[$key]),

            ]);

        }

        Personalinfo::create($persoanl);
        Session::flash('success', __('Successfully submitted'));
        return back();
    }

    /**
     *  This function hold the functionality for resume list view.
     *  @return view resume admin index
     */

    public function adminindex()
    {
        $personals = Personalinfo::all();
        return view('resume::admin.index', compact('personals'));
    }

    /**
     *  This function holds the functionality to edit resume.
     *  @return edit resume view
     *  @param $id
     *  @param $request
     */

    public function myresumeview(Request $request, $id)
    {
        $personal = Personalinfo::where('user_id', Auth::user()->id)->first();

        $works = Workexp::where('user_id', Auth::user()->id)->get();

        $educations = Acedemic::where('user_id', Auth::user()->id)->get();

        $projects = Project::where('user_id', Auth::user()->id)->get();

        return view('resume::front.resume.view', compact('personal', 'works', 'educations', 'projects'));

    }
    public function resumeedit(Request $request, $id)
    {
        $personal = Personalinfo::where('user_id', Auth::user()->id)->first();

        $works = Workexp::where('user_id', Auth::user()->id)->get();

        $educations = Acedemic::where('user_id', Auth::user()->id)->get();

        $projects = Project::where('user_id', Auth::user()->id)->get();

        return view('resume::front.resume.edit', compact('personal', 'works', 'educations', 'projects'));

    }
    public function resume_update(Request $request, $id)
    {

        $data = Personalinfo::where('user_id', $id)->first();
        $persoanl['fname']      = strip_tags($request->fname);
        $persoanl['lname']      = strip_tags($request->lname);
        $persoanl['profession'] = strip_tags($request->profession);
        $persoanl['country']    = strip_tags($request->country);
        $persoanl['address']    = strip_tags($request->address);
        $persoanl['phone']      = strip_tags($request->phone);
        $persoanl['email']      = strip_tags($request->email);
        $persoanl['skill']      = strip_tags($request->skill);
        $persoanl['strength']   = strip_tags($request->strength);
        $persoanl['interest']   = strip_tags($request->interest);
        $persoanl['objective']  = strip_tags($request->objective);
        $persoanl['language']   = strip_tags($request->language);
        if ($file = $request->file('photo')) {

            $validator = Validator::make(
                [
                    'file' => strip_tags($request->photo),
                    'extension' => strtolower($request->photo->getClientOriginalExtension()),
                ],
                [
                    'file' => 'required',
                    'extension' => 'required|in:jpg,png',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors(__('Invalid file !'));
            }

            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $file->move('files/resume', $name);
                $persoanl['image'] = $name;
            }
        }

        Acedemic::where('user_id', Auth::user()->id)->delete();

        /** foreach for acedmic **/
        foreach ($request->course as $key => $course) {
            Acedemic::create([
                'user_id'       => Auth::user()->id,
                'course'        => strip_tags($request->course[$key]),
                'school'        => strip_tags($request->school[$key]),
                'marks'         => strip_tags($request->marks[$key]),
                'yearofpassing' => strip_tags($request->yearofpassing[$key]),
            ]);

        }
        Workexp::where('user_id', Auth::user()->id)->delete();

        /** foreach for workexp **/
        foreach ($request->startdate as $key => $course) {
            Workexp::create([
                'user_id'       => Auth::user()->id,
                'startdate'     => strip_tags($request->startdate[$key]),
                'enddate'       => strip_tags($request->enddate[$key]),
                'city'          => strip_tags($request->city[$key]),
                'state'         => strip_tags($request->state[$key]),
                'jobtitle'      => strip_tags($request->jobtitle[$key]),
                'employer'      => strip_tags($request->employer[$key]),
            ]);

        }
        Project::where('user_id', Auth::user()->id)->delete();

        /** foreach for project **/
        foreach ($request->projecttitle as $key => $course) {
            Project::create([
                'user_id' => Auth::user()->id,
                'projecttitle' => strip_tags($request->projecttitle[$key]),
                'role' => strip_tags($request->role[$key]),
                'description' => strip_tags($request->description[$key]),

            ]);

        }

        $data->update($persoanl);
        Session::flash('success', __('Resume edit successfully'));
        return redirect()->back();

    }

    /**
     *  This function holds the functionality to view resume.
     *  @return resume view
     *  @param $id
     *  @param $request
     */
    public function view(Request $request, $id)
    {
        $persoanl = Personalinfo::where('user_id', $id)->firstorfail();
        $works = Workexp::where('user_id', $id)->get();
        $education = Acedemic::where('user_id', $id)->get();
        $project = Project::where('user_id', $id)->get();

        return view('resume::admin.view')
            ->with('persoanl', $persoanl)
            ->with('works', $works)
            ->with('education', $education)
            ->with('project', $project);
    }

    /**
     *  This function holds the functionality to delete resume.
     *  @return delete resume
     *  @param $id
     */

    public function destroy($id)
    {

        $persoanl = Personalinfo::where('user_id', $id)->delete();
        $works = Workexp::where('user_id', $id)->delete();
        $education = Acedemic::where('user_id', $id)->delete();
        $project = Project::where('user_id', $id)->delete();
        Session::flash('success', __('Delete Successfully'));
        return redirect()->back();

    }

    /**
     *  This function holds the functionality to change resume status.
     *  @return response true
     *  @param $request
     */

    public function resumestatus(Request $request)
    {

        $resume = Personalinfo::find(strip_tags($request->id));
        $resume->status = $request->status;
        $resume->save();
        return response()->json(true);
    }
    /**
     *  This function holds the functionality to change resume status.
     *  @return response true
     *  @param $request
     */

    public function resumeverified(Request $request)
    {

        $resume = Personalinfo::find(strip_tags($request->id));
        $resume->verified = $request->verified;
        $resume->save();
        return response()->json(true);
    }
    /**
     *  This function holds the functionality to change resume status.
     *  @return response true
     *  @param $request
     * @param $id
     */

    public function approved(Request $request, $id)
    {

        Personalinfo::where('id', '=', $id)->update(['status' => 1]);
        Session::flash('success', __('Resume Status Change Successfully'));
        return back();

    }

    /**
     *  This function holds the functionality to change resume status.
     *  @return response true
     *  @param $request
     * @param $id
    */

    public function notapproved(Request $request, $id)
    {
        Personalinfo::where('id', '=', $id)->update(['message' => strip_tags($request->message)]);
        Personalinfo::where('id', '=', $id)->update(['status' => 0]);
        Session::flash('success', __('Resume Status Change Successfully'));
        return back();

    }

    /**
     * This function holds the functionality to download resume in pdf.
     * @return response true
     * @param $request
     * @param $id
    */

    public function pdfdownload(Request $request, $id)
    {

        $personal = Personalinfo::where('user_id', $id)->first();
        $projects = Project::where('user_id', $id)->get();
        $works = Workexp::where('user_id', $id)->get();
        $educations = Acedemic::where('user_id', $id)->get();
        return view('resume::front.download', compact('personal', 'works', 'educations', 'projects'));

    }

}
