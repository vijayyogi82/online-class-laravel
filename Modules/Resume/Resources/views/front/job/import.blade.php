@extends('theme.master')
@section('title','Import User')
<!--section start--> 
@section('content')
<!-- css section start--> 
@section('custom-head')
<link rel="stylesheet" href="{{ url('/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/resume.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/style.css') }}">
<link rel="stylesheet" href="{{ Module::asset('resume:css/index.css') }}">
@endsection
@php
$gets = App\Breadcum::first();
@endphp
@if(isset($gets)) 
<section id="business-home" class="business-home-main-block" >
    <div class="business-img">
        @if($gets['img'] !== NULL && $gets['img'] !== '')
        <img src="{{ url('/images/breadcum/'.$gets->img) }}" class="img-fluid" alt="" />
        @else
        <img src="{{ Avatar::create($gets->text)->toBase64() }}" alt="course"
            class="img-fluid">
        @endif
    </div>
    <div class="overlay-bg"></div>
    <div class="container-fluid">
        <div class="business-dtl">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="bredcrumb-dtl">
                        <h1 class="">Import Job</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
@endif
<section id="import" class="import-main-block">
	<div class="container">
		<div class="import-block">
			<div class="row mb-4">
				<div class="col-lg-6">
					<h4 class="box-title">Job</h4>
				</div>
				<div class="col-lg-6">
					<div class="widgetbar">
						<a href="{{ url('files/job.csv') }}" class="float-right btn btn-primary mr-2">
							<i data-feather="download"></i>Download Example csv File
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<form action="{{ route('job.csvfileupload') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
					  	<div class="form-group">
					   		<label for="file">Select csv File :</label>
					   		<div class="row no-gutters">
				  				<div class="col-lg-8">
									<input required="" type="file" name="file" class="form-control">
									@if ($errors->has('file'))
								  	<span class="invalid-feedback text-danger" role="alert">
									  <strong>{{ $errors->first('file') }}</strong>
								  	</span>
						   			@endif
				   				</div>
				   				<div class="col-lg-4">
				   					<button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Submit</button>
					  			</div>
					   		</div>
					  	</div>
					</form>
				</div>
			</div>
		</div>
		<div class="import-job-block">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-30">
						<div class="card-header mb-4">
							<h4 class="box-title">{{ __('Import Job') }}</h4>
						</div>
						<div class="card-body">
						
							<div class="table-responsive">
								<table id="datatable-buttons" class="table table-striped table-bordered">
									<thead>
										<tr>
					                        <th>Column No</th>
					                        <th>Column Name</th>
					                        <th>Description</th>
					            		</tr>
									</thead>
									<tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><b>Company Name</b> (Required)</td>
                                            <td>Company Name</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><b>Job Title</b> (Required)</td>
                                            <td>Job Title</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><b>Job Description</b> (Required)</td>
                                            <td>Job Description</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><b>Requirement</b> (Required)</td>
                                            <td>Requirement</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><b>Location</b> (Required)</td>
                                            <td>Location</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td><b>Minimum Experience</b> (Required)</td>
                                            <td>Minimum Experience</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td><b>Maximum Experience</b> (Required)</td>
                                            <td>Maximum Experience</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td><b>Month Experience</b> (Required)</td>
                                            <td>Month Experience</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td><b>Role</b> (Required)</td>
                                            <td>Role</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td><b>Industry Type</b> (Required)</td>
                                            <td>Industry Type</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td><b>Employment Type</b> (Required)</td>
                                            <td>Employment Type</td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td><b>Image</b> (Required)</td>
                                            <td>Image</td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td><b>Minimum Salary</b> (Required)</td>
                                            <td>Minimum Salary</td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td><b>Maximum Salary</b> (Required)</td>
                                            <td>Maximum Salary</td>
                                        </tr>
                                        <tr>
                                            <td>15</td>
                                            <td><b>Salary</b> (Required)</td>
                                            <td>Salary</td>
                                        </tr>
                                        <tr>
                                            <td>16</td>
                                            <td><b>Key Skills</b> (Required)</td>
                                            <td>Key Skills</td>
                                        </tr>
										<tr>
                                            <td>17</td>
                                            <td><b>User Id</b> (Required)</td>
                                            <td>User Id</td>
                                        </tr>
                                    </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection
<!-- This section will contain javacsript start -->
@section('custom-script')

<script src="{{ url('admin_assets/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="https://emart.castleindia.in/front/vendor/js/additional-methods.min.js"></script>
<script src="https://emart.castleindia.in/front/vendor/js/jquery.validate.min.js"></script>
 <!-- Datatable js -->
 
<script>var url = @json(url('/'));</script>
<script src="{{ Module::asset('resume:js/job.js') }}"></script>
<script>var user = @json(Auth::user()->id);</script>

<script src="{{ Module::asset('resume:js/resume.js') }}"></script>
<script src="{{ Module::asset('resume:js/append.js') }}"></script>
@endsection
<!-- This section will contain javacsript end -->