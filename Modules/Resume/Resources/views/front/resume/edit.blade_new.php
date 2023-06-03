@extends('theme.master')
@section('title', 'Edit Resume')
@section('content')
<!-- css section start--> 
@section('custom-head')
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/style.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume/edit.css') }}">
@endsection
<!-- css section end--> 
@include('admin.message')
<!--section start-->
<section  class="blog-home-main-block">
    <p class="ml-md-5">{{ __('Edit Resume') }} <span  class="name">({{ filter_var($personal->fname)}} {{ filter_var($personal->lname)}})</span></p>
</section> 
<!--section end -->

<!-- section start --> 
<section id="blog" class="back">
    <!-- container start--> 
    <div class="container">
         <!-- row start--> 
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5  mb-5 ">
                <!-- <form method="post" id="msform" enctype="multipart/form-data"  action="{{ route('resume.update',["id" => Auth::user()->id])}}" >
                    @csrf -->
                    <!--row start-->
                    <div class="resume-edit-page">
                        <div class="row">
                            <div class="col-md-4 user-img">
                                @if(filter_var($personal->image))
                                <img src="{{ Module::asset('resume:image/1642075249happy-young-female-student-holding-notebooks-from-courses-smiling-camera-standing-spring-clothes-against-blue-background.jpg') }}" class="img-fluid resume-image d-block mb-4 " alt="image">
                                @else
                                <img src="{{ Module::asset('resume:image/1642075249happy-young-female-student-holding-notebooks-from-courses-smiling-camera-standing-spring-clothes-against-blue-background.jpg') }}" class="img-fluid resume-image1 d-block mb-4 " alt="image">
                                @endif
                                <form method="POST"  id="upload_form" accept-charset="UTF-8" enctype="multipart/form-data">
                                  @csrf
                                    <div class="user-edit-icon">
                                        <label for="file-input">
                                          <i data-feather="edit-2"></i>
                                        </label>
                                        <input id="file-input" type="file" name="image" accept=".png, .jpg, .jpeg, .webp, .gif"/>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Full Name :</label>
                                        <input type="name" class="form-control" id="exampleInputfname1" aria-describedby="fnameHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Job Title :</label>
                                        <input type="jtitle" class="form-control" id="exampleInputjob1" aria-describedby="jobHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Your Address :</label>
                                        <input type="address" class="form-control" id="exampleInputaddress1" aria-describedby="addressHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Your Email :</label>
                                        <input type="email" class="form-control" id="exampleInputemail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Website Link :</label>
                                        <input type="wlink" class="form-control" id="exampleInputlink1" aria-describedby="linkHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone No :</label>
                                        <input type="phoneno" class="form-control" id="exampleInputphoneno1" aria-describedby="phonenoHelp">
                                    </div>
                                </form>
                                <hr>
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Skill's :</label>
                                        <input type="skills" class="form-control" id="exampleInputskills1" aria-describedby="skillsHelp">
                                    </div>
                                </form>
                                <hr>
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Strength :</label>
                                        <input type="strength" class="form-control" id="exampleInputstrength1" aria-describedby="strengthHelp">
                                    </div>
                                </form>
                                <hr>
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Interest :</label>
                                        <input type="interest" class="form-control" id="exampleInputinterest1" aria-describedby="interestHelp">
                                    </div>
                                </form>
                                <hr>
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Language :</label>
                                        <input type="language" class="form-control" id="exampleInputlanguaget1" aria-describedby="languageHelp">
                                    </div>
                                </form>
                                <!-- <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="customFile" name="photo">
                                    <label class="custom-file-label" for="customFile">{{ __("Choose file") }}</label>
                                </div> -->
                               <!--  <p><i class="fa fa-map-marker mr-2"></i><textarea  name="address" class="w-100" cols="30">{{ filter_var($personal->address)}}</textarea></p>
                                <p><i class="fa fa-phone mr-2"></i><textarea   name="phone" class="w-100"  cols="30">{{ filter_var($personal->phone)}}</textarea></p>
                                <p><i class="fa fa-envelope mr-2"></i><textarea  name="email" class="w-100" cols="30">{{ filter_var($personal->email)}}</textarea></p>
                                <p><b>{{ __("Profession :") }}</b><br><textarea  class="w-100" name="profession" cols="30">{{ filter_var($personal->profession)}}</textarea></p>
                                <p><b>{{ __("Skills :") }}</b><br><textarea  class="w-100" name="skill" cols="30">{{ filter_var($personal->skill)}}</textarea></p>
                                <p><b>{{ __("Strength :") }}</b><br><textarea  class="w-100" name="strength" cols="30">{{ filter_var($personal->strength)}}</textarea></p>
                                <p><b>{{ __("Interest :") }}</b><br><textarea  class="w-100" name="interest" cols="30">{{ filter_var($personal->interest)}}</textarea></p>
                                <p><b>{{ __("Language :") }}</b><br><textarea class="w-100"  name="language" cols="30">{{ filter_var($personal->language)}}</textarea></p> -->
                            </div>
                            <div class="col-md-8 bg-white resume-block">
                                <div class="mb-4">
                                    <h3 class="resume-block-heading">About Us</h3>
                                    <form>
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="mb-4">
                                    <h3 class="resume-block-heading">Work Experience</h3>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Position</label>
                                                    <input type="position" class="form-control" id="exampleInputposition1" aria-describedby="positionHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start Date</label>
                                                    <input type="date" class="form-control" id="exampleInputdate1" aria-describedby="dateHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End Date</label>
                                                    <input type="date" class="form-control" id="exampleInputedate1" aria-describedby="edateHelp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        </div>
                                    </form>
                                    <div class="add-exp-btn text-right">
                                        <button type="button" name="add" id="add" class="add btn btn-outline-primary btn-rounded btn-sm">Add New Experience</button>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h3 class="resume-block-heading">Education</h3>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Institution</label>
                                                    <input type="institution" class="form-control" id="exampleInputinstitution1" aria-describedby="institutionHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Degree</label>
                                                    <input type="degree" class="form-control" id="exampleInputdegree1" aria-describedby="degreeHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Area Of Study</label>
                                                    <input type="study" class="form-control" id="exampleInputstudy1" aria-describedby="studyHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Grade</label>
                                                    <input type="grade" class="form-control" id="exampleInputgrade1" aria-describedby="gradeHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start Date</label>
                                                    <input type="date" class="form-control" id="exampleInputdate1" aria-describedby="dateHelp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End Date</label>
                                                    <input type="date" class="form-control" id="exampleInputedate1" aria-describedby="edateHelp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        </div>
                                    </form>
                                    <div class="add-exp-btn text-right">
                                        <button type="button" name="add" id="add" class="add btn btn-outline-primary btn-rounded btn-sm">Add New Education</button>
                                    </div>
                                </div>
                                <!-- <h3 class="text-danger  mt-3">
                                    <input type="text" class="w-100" name="fname" value="{{ filter_var($personal->fname)}}"><input type="text" class="w-100 mt-2" name="lname" value="{{ filter_var($personal->lname)}}">
                                </h3>
                                <h5 class="mt-3 text-danger">{{ __("OBJECTIVE :") }}</h5>
                                <p><textarea  rows="4" class="w-100" name="objective">{{ filter_var($personal->objective) }}</textarea></p>
                                <h5 class="mt-3 text-danger">{{ __("EDUCATION :") }}</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                    <table  id="dynamic_field" class="w-100 table-responsive">
                                        <thead>
                                        <th>{{ __("Degree") }}</th>
                                        <th>{{ __("School/College") }}</th>
                                        <th>{{ __("Marks") }}</th>
                                        <th>{{ __("Passing Year") }}</th>
                                        <thead>
                                        <tbody>
                                            @foreach($educations as $education)
                                            <tr>
                                                <td><input type="text" name="course[]" class="" value="{{ filter_var($education->course)}}"></td>
                                                <td><input type="text" class="" name="school[]" value="{{ filter_var($education->school)}}"></td>
                                                <td ><input type="text"  name="marks[]" value="{{ filter_var($education->marks)}}"></td>
                                                <td><input type="text" class="w-50" name="yearofpassing[]" value="{{ filter_var($education->yearofpassing)}}">
                                                    <button type="button" name="add" id="add" class="add btn btn-outline-primary btn-rounded btn-sm">{{ __("+") }}</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5 class="mt-3 text-danger">{{ __("EXPERIENCE :") }}</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <table  id="dynamic_field1" class="w-100 table-responsive">
                                        <thead>
                                        <th>{{ __("StartDate") }}</th>
                                        <th>{{ __("EndDate") }}</th>
                                        <th>{{ __("City") }}</th>
                                        <th>{{ __("State") }}</th>
                                        <th>{{ __("Job Title") }}</th>
                                        <th>{{ __("Employer") }}</th>
                                        <thead>
                                        <tbody>
                                            @foreach($works as $work)
                                            <tr>
                                            <td ><input type="text" class="w-100" name="startdate[]"  value="{{ filter_var($work->startdate)}}"></td>
                                            <td><input type="text" class="w-100" name="enddate[]" value="{{ filter_var($work->enddate)}}"></td>
                                        
                                            <td ><input type="text"  class="w-100" name="city[]"  value="{{ filter_var($work->city)}}"></td>
                                            <td ><input type="text"  class="w-100"  name="state[]"  value="{{ filter_var($work->state)}}"></td>
                                            <td ><input type="text"  name="jobtitle[]"  value="{{ filter_var($work->jobtitle)}}"></td>
                                            
                                            <td><input type="text" class="w-50" name="employer[]" value="{{ filter_var($work->employer)}}">
                                                <button type="button" name="add" id="add1" class="add1 btn btn-outline-primary btn-rounded btn-sm">{{ __("+") }}</button>
                                            </td>
                                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <h5 class="mt-3 text-danger">{{ __("PROJECT :") }}</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <table  id="dynamic_field2" class="w-100 table-responsive">
                                        <thead>
                                        <th>{{ __("Project Title") }}</th>
                                        <th>{{ __("Role") }}</th>
                                        <th>{{ __("Description") }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach($projects as $project)
                                            <tr>
                                            <td><input type="text" class="w-100" name="projecttitle[]" value="{{ filter_var($project->projecttitle)}}"></td>
                                            <td><input type="text"  class="w-100 "  name="role[]" value="{{ filter_var($project->role)}}"></td>
                                            <td><textarea class="w-100 form-con mt-1" name="description[]">{{ filter_var($project->description)}}</textarea></td>
                                            <td><button type="button" name="add" id="add2" class="add2 btn btn-outline-primary btn-rounded btn-sm">{{ __("+") }}</button></td>
                                        </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                                
                            <div class="submit-btn">
                               
                                <input type="submit"  class="btn btn-info mb-2 float-right" />
                            </div> -->
                        </div>
                    </div>
                    <!--row end-->
                   
                <!-- </form> -->
            </div>
        </div>
         <!-- row end--> 
    </div>
    <!-- container end--> 
</section>
<!-- section end--> 
@endsection

<!-- This section will contain javacsript start-->
@section('custom-script')
<script src="{{ Module::asset('resume:js/resume.js') }}"></script>
<script src="{{ Module::asset('resume:js/job.js') }}"></script>
<script src="{{ Module::asset('resume:js/append.js') }}"></script>
@endsection
<!-- This section will contain javacsript end-->             