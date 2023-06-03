<?php

namespace Modules\Certificate\Http\Controllers;

use App\Course;
use App\CourseProgress;
use App\Order;
use Auth;
use Crypt;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Image;
use Modules\Certificate\Models\CertificateDesign;
use PDF;
use Session;

class CertificateDesignController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CertificateDesignController
    |--------------------------------------------------------------------------
    |
    | This controllers hold the functionality of certicficate view, print, download
    |
     */

    /* This functions holds the functionality of return certificate view*/

    public function studcertificate()
    {
        return view('certificate::admin.certificate.certificate');
    }

    /* This functions holds the functionality of create certificate view*/

    public function createcertificate()
    {

        $certificate = CertificateDesign::first();
        return view('certificate::admin.certificate.create', compact('certificate'));

    }

    /* This functions holds the functionality of insert logo in certificate*/

    public function insertlogo(Request $request)
    {

      /** Getting first from table CertificateDesigns */

        $certificate = CertificateDesign::first();

        $input = $request->all();

        if (isset($certificate)) {

            if ($file = $request->file('logo_image')) {

                $path = 'images/certificate/logo/';

                if (!file_exists(public_path() . '/' . $path)) {

                    /** Create directory if not exist in public/images/certificate folder  */

                    $path = 'images/certificate/logo/';
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                if ($certificate->image != "") {

                    if (file_exists(public_path() . '/images/certificate/logo/' . $getstarted->logo_image)) {
                        unlink('images/certificate/logo/' . $certificate->logo_image);
                    }

                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/certificate/logo/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);

                $input['logo_image'] = $image;

            }

            $input['logo_enable'] = isset($request->logo_enable) ? 1 : 0;

            $certificate->update($input);

        } else {

            /** Create row if not exist */

            if ($file = $request->file('logo_image')) {

                $path = 'images/certificate/logo/';

                if (!file_exists(public_path() . '/' . $path)) {

                    /** Create directory if not exist in public/images/certificate folder  */

                    $path = 'images/certificate/logo/';
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/certificate/logo/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);

                $input['logo_image'] = $image;

            }

            $input['logo_enable'] = isset($request->logo_enable) ? 1 : 0;

            $data = CertificateDesign::create($input);

            $data->save();

        }

        return back()->with('message', __('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to create content in certificate */

    public function insertcontent(Request $request)
    {

      /** Getting first from table CertificateDesigns */

        $data = CertificateDesign::first();
        $input = $request->all();

        if (isset($data)) {
            $data->update($input);
        } else {
            $data = CertificateDesign::create($input);
            $data->save();
        }

        return back()->with('success', __('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to insert background in certificte */

    public function insertcertificatebackground(Request $request)
    {
        /** Getting first from table CertificateDesigns */

        $certificate = CertificateDesign::first();

        $input = $request->all();

        if (isset($certificate)) {

            if ($file = $request->file('background_image')) {

                $path = 'images/certificate/background/';

                if (!file_exists(public_path() . '/' . $path)) {

                    $path = 'images/certificate/background/';
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                /** Unlink old background if any */

                if ($certificate->image != "" && file_exists(public_path() . '/images/certificate/background/' . $certificate->background_image)) {
                   
                      unlink('images/certificate/background/' . $certificate->background_image);
                    
                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/certificate/background/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);

                $input['background_image'] = $image;

            }

            $input['background_image_enable'] = isset($request->background_image_enable) ? 1 : 0;

            $certificate->update($input);

        } else {

          /** Create row if not exist */

            if ($file = $request->file('background_image')) {

                $path = 'images/certificate/background/';

                if (!file_exists(public_path() . '/' . $path)) {

                    $path = 'images/certificate/background/';
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/certificate/background/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);

                $input['background_image'] = $image;

            }

            $input['background_image_enable'] = isset($request->background_image_enable) ? 1 : 0;

            $data = CertificateDesign::create($input);

            $data->save();

        }

        return back()->with('message', trans('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to cretae outer border in certificate */

    public function insertouterborder(Request $request)
    {

       /** Getting first from table CertificateDesigns */

        $data = CertificateDesign::first();
        $input = $request->all();

        if (isset($data)) {
            $input['border_one_enable'] = isset($request->border_one_enable) ? 1 : 0;
            $data->update($input);
        } else {

            $input['border_one_enable'] = isset($request->border_one_enable) ? 1 : 0;

            $data = CertificateDesign::create($input);
            $data->save();
        }

        return back()->with('success', trans('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to inner outer border in certificate */

    public function insertinnerborder(Request $request)
    {
        /** Getting first from table CertificateDesigns */

        $data = CertificateDesign::first();
        $input = $request->all();

        if (isset($data)) {
            $input['border_two_enable'] = isset($request->border_two_enable) ? 1 : 0;
            $data->update($input);
        } else {

            $input['border_two_enable'] = isset($request->border_two_enable) ? 1 : 0;

            $data = CertificateDesign::create($input);
            $data->save();
        }

        return back()->with('success', __('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to inner signature in certificate */

    public function insertsignature(Request $request)
    {
        /** Getting first from table CertificateDesigns */

        $certificate = CertificateDesign::first();

        $input = $request->all();

        if (isset($certificate)) {

            if ($file = $request->file('signature_image')) {

                $path = 'images/certificate/signature/';

                if (!file_exists(public_path() . '/' . $path)) {

                    $path = 'images/certificate/signature/';
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                if ($certificate->image != "" && file_exists(public_path() . '/images/certificate/signature/' . $certificate->signature_image)) {
                    
                    unlink('images/certificate/signature/' . $certificate->signature_image);
                    
                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/certificate/signature/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);

                $input['signature_image'] = $image;

            }

            $certificate->update($input);

        } else {

          /** Create row if not exist */

            if ($file = $request->file('signature_image')) {

                $path = 'images/certificate/logo/';

                if (!file_exists(public_path() . '/' . $path)) {

                  /** Create directory if not exist */

                    $path = 'images/certificate/logo/';
                    File::makeDirectory(public_path() . '/' . $path, 0777, true);
                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/certificate/logo/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);

                $input['signature_image'] = $image;

            }

            $data = CertificateDesign::create($input);

            $data->save();

        }

        return back()->with('message', __('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to inner date in certificate */

    public function insertdate(Request $request)
    {
        /** Getting first from table CertificateDesigns */

        $data = CertificateDesign::first();
        $input = $request->all();

        if (isset($data)) {
            // return $data;
            $input['date_enable'] = isset($request->date_enable) ? 1 : 0;
            $data->update($input);
        } else {

            $input['date_enable'] = isset($request->date_enable) ? 1 : 0;

            $data = CertificateDesign::create($input);
            $data->save();
        }

        return back()->with('success', __('flash.UpdatedSuccessfully'));

    }

    /** This function holds the functionality to download certificate in pdf format */

    public function pdfdownload($slug)
    {

        $serial_no = $slug;

        $whatIWant = strtok($slug, 'CR-');

        $progress = CourseProgress::where('id', $whatIWant)->first();

        $course = Course::where('id', $progress->course_id)->first();
        

        /** Create pdf from view */

        $pdf = PDF::loadView('certificate::front.download', compact('course', 'progress', 'serial_no'), [],
        [
            'title' => 'Certificate',
            'orientation' => 'L',
        ]);

        return $pdf->stream('certificate.pdf');
    }
    public function setting()
    {
        $certificate = CertificateDesign::first();
        return view('certificate::admin.certificate.certificate_seeting', compact('certificate'));
    }
    public function updatesetting(Request $request)
    {
        $certificate = CertificateDesign::first();
        $data['percentage'] = $request->percentage;
        $certificate->update($data);
        Session::flash('success', trans('flash.UpdateSuccessfully'));
        return back();
    }
    public function widget(Request $request){

        $data = CertificateDesign::first();
        $input = $request->all();

        if (isset($data)) {
            $data['widget1_enable'] = $request->widget1_enable;
            $data['widget2_enable'] = $request->widget2_enable;
            $data['widget3_enable'] = $request->widget3_enable;

            // return $data;
            $data->update($input);
        } else {


            $data = CertificateDesign::create($input);
            $data->save();
        }

        return back()->with('success', __('flash.UpdatedSuccessfully'));
    }
}
