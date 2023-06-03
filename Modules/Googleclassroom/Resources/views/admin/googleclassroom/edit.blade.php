@extends('admin.layouts.master')
@section('title', 'Edit Class - Admin')
@section('maincontent')
<?php
$data['heading'] = 'Edit Google Meeting';
$data['title'] = 'Class';
$data['title1'] = 'Edit Google Meeting';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
  @if ($errors->any())  
  <div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)     
  <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach  
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <div class="card dashboard-card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __('Edit Class') }}</h5>
          <div>
            <div class="widgetbar">
              <a href="{{ route('googleclassroom.index') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          
        <form autocomplete="off" action="{{ route('googleclassroom.update',$classroomcourses['classroom_cource_id']) }}" method="POST" enctype="multipart/form-data">
		      @csrf
          
          <div class="row">

              <div class="form-group col-md-6">
                <label for="exampleInputDetails">{{ __('Link By Course :') }}</label><br>
                <input type="checkbox" id="myCheck" name="link_by" class="custom_toggle" onclick="myFunction()">
              </div>

              <div class="form-group col-md-6">
                <div style="display: none" id="update-password">
				          <label>{{ __('Courses :') }}</label>
                  <select  name="course_id" id="course_id" class="select2-single form-control">
							      @foreach($course as $caat)
							      <option {{ $classroomcourses['course_id'] == $caat->id ? 'selected' : "" }} value="{{ $caat->id }}">{{ $caat->title }}</option>
						        @endforeach 
			            </select> 
			          </div>
              </div>

            <div class="form-group col-md-6"  id="sec3_three">
              <label>{{ __('Class Room :') }}<sup class="redstar">*</sup></label>
              <input type="text" name="title" placeholder="Cource title" value="{{ $classroomcourses->cource_title }}" class="form-control" required>
            </div>

            <div class="form-group col-md-6"  id="sec3_three">
              <label>{{ __('Class Room Agenda :') }}</label>
              <input type="text" name="description" value="{{ $classroomcourses->cource_description }}" placeholder="Class Room Description" class="form-control">
            </div>

            <div class="form-group col-md-6" id="sec4_four">
              <label>{{ __('Start Time :') }}<sup class="redstar">*</sup></label>
              <div class="input-group" id='datetimepicker1'>
                <input type="text" name="start_time" value="{{ $classroomcourses->start_time }}" id="time-format" class="form-control" placeholder="dd/mm/yyyy - hh:ii aa" aria-describedby="basic-addon5" required/>
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
                </div>
              </div>
            </div>
             
            <div class="form-group col-md-6"  id="sec5_four">
              <label>{{ __('End Time :') }}<sup class="redstar">*</sup></label>
              <div class="input-group" id='datetimepicker1'>
                <input type="text" name="end_time" value="{{ $classroomcourses->end_time }}" id="time-format1" class="form-control" placeholder="dd/mm/yyyy - hh:ii aa" aria-describedby="basic-addon5" required/>
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
                </div>
              </div>
            </div>
              
            <div class="form-group col-md-6"  id="sec3_three">
            	<label>{{ __('Duration :') }}<sup class="redstar">*</sup></label>
				      <input placeholder="Enter in mins eg 60" value="{{ $classroomcourses->duration }}" type="number" min="1" name="duration" class="form-control" required>
            </div>

            <div class="form-group col-md-6"  id="sec3_three">
				      <label>{{ __('Timezone :') }}</label>
              <select class="select2-single form-control" name="timezone">
                <option value="None">{{ __('Use Your Account Timezone') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Midway') selected @endif value="Pacific/Midway">{{ __('Midway Island, Samoa') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Pago_Pago') selected @endif value="Pacific/Pago_Pago">{{ __('Pago Pago') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Honolulu') selected @endif value="Pacific/Honolulu">{{ __('Hawaii') }}</option>
                <option @if($classroomcourses->timezone == 'America/Anchorage') selected @endif value="America/Anchorage">{{ __('Alaska') }}</option>
                <option @if($classroomcourses->timezone == 'America/Vancouver') selected @endif value="America/Vancouver">{{ __('Vancouver') }}</option>
                <option @if($classroomcourses->timezone == 'America/Los_Angeles') selected @endif value="America/Los_Angeles">{{ __('Pacific Time (US and Canada)') }}</option>
                <option @if($classroomcourses->timezone == 'America/Tijuana') selected @endif value="America/Tijuana">{{ __('Tijuana') }}</option>
                <option @if($classroomcourses->timezone == 'America/Edmonton') selected @endif value="America/Edmonton">{{ __('Edmonton') }}</option>
                <option @if($classroomcourses->timezone == 'America/Denver') selected @endif value="America/Denver">{{ __('Mountain Time (US and Canada)') }}</option>
                <option @if($classroomcourses->timezone == 'America/Phoenix') selected @endif value="America/Phoenix">{{ __('Arizona') }}</option>
                <option @if($classroomcourses->timezone == 'America/Mazatlan') selected @endif value="America/Mazatlan">{{ __('Mazatlan') }}</option>
                <option @if($classroomcourses->timezone == 'America/Winnipeg') selected @endif value="America/Winnipeg">{{ __('Winnipeg') }}</option>
                <option @if($classroomcourses->timezone == 'America/Regina') selected @endif value="America/Regina">{{ __('Saskatchewan') }}</option>
                <option @if($classroomcourses->timezone == 'America/Chicago') selected @endif value="America/Chicago">{{ __('Central Time (US and Canada)') }}</option>
                <option @if($classroomcourses->timezone == 'America/Mexico_City') selected @endif value="America/Mexico_City">{{ __('Mexico City') }}</option>
                <option @if($classroomcourses->timezone == 'America/Guatemala') selected @endif value="America/Guatemala">{{ __('Guatemala') }}</option>
                <option @if($classroomcourses->timezone == 'America/El_Salvador') selected @endif value="America/El_Salvador">{{ __('El Salvador') }}</option>
                <option @if($classroomcourses->timezone == 'America/Managua') selected @endif value="America/Managua">{{ __('Managua') }}</option>
                <option @if($classroomcourses->timezone == 'America/Costa_Rica') selected @endif value="America/Costa_Rica">{{ __('Costa Rica') }}</option>
                <option @if($classroomcourses->timezone == 'America/Montreal') selected @endif value="America/Montreal">{{ __('Montreal') }}</option>
                <option @if($classroomcourses->timezone == 'America/New_York') selected @endif value="America/New_York">{{ __('Eastern Time (US and Canada)') }}</option>
                <option @if($classroomcourses->timezone == 'America/Indianapolis') selected @endif value="America/Indianapolis">{{ __('Indiana (East)') }}</option>
                <option @if($classroomcourses->timezone == 'America/Panama') selected @endif value="America/Panama">{{ __('Panama') }}</option>
                <option @if($classroomcourses->timezone == 'America/Bogota') selected @endif value="America/Bogota">{{ __('Bogota') }}</option>
                <option @if($classroomcourses->timezone == 'America/Lima') selected @endif value="America/Lima">{{ __('Lima') }}</option>
                <option @if($classroomcourses->timezone == 'America/Halifax') selected @endif value="America/Halifax">{{ __('Halifax') }}</option>
                <option @if($classroomcourses->timezone == 'America/Puerto_Rico') selected @endif value="America/Puerto_Rico">{{ __('Puerto Rico') }}</option>
                <option @if($classroomcourses->timezone == 'America/Caracas') selected @endif value="America/Caracas">{{ __('Caracas') }}</option>
                <option @if($classroomcourses->timezone == 'America/Santiago') selected @endif value="America/Santiago">{{ __('Santiago') }}</option>
                <option @if($classroomcourses->timezone == 'America/St_Johns') selected @endif value="America/St_Johns">{{ __('Newfoundland and Labrador') }}</option>
                <option @if($classroomcourses->timezone == 'America/Montevideo') selected @endif value="America/Montevideo">{{ __('Montevideo') }}</option>
                <option @if($classroomcourses->timezone == 'America/Araguaina') selected @endif value="America/Araguaina">{{ __('Brasilia') }}</option>
                <option @if($classroomcourses->timezone == 'America/Argentina/Buenos_Aires') selected @endif value="America/Argentina/Buenos_Aires">{{ __('Buenos Aires, Georgetown') }}</option>
                <option @if($classroomcourses->timezone == 'America/Godthab') selected @endif value="America/Godthab">{{ __('Greenland') }}</option>
                <option @if($classroomcourses->timezone == 'America/Sao_Paulo') selected @endif value="America/Sao_Paulo">{{ __('Sao Paulo') }}</option>
                <option @if($classroomcourses->timezone == 'Atlantic/Azores') selected @endif value="Atlantic/Azores">{{ __('Azores') }}</option>
                <option @if($classroomcourses->timezone == 'Canada/Atlantic') selected @endif value="Canada/Atlantic">{{ __('Atlantic Time (Canada)') }}</option>
                <option @if($classroomcourses->timezone == 'Atlantic/Cape_Verde') selected @endif value="Atlantic/Cape_Verde">{{ __('Cape Verde Islands') }}</option>
                <option @if($classroomcourses->timezone == 'UTC') selected @endif value="UTC">{{ __('Universal Time UTC') }}</option>
                <option @if($classroomcourses->timezone == 'Etc/Greenwich') selected @endif value="Etc/Greenwich">{{ __('Greenwich Mean Time') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Belgrade') selected @endif value="Europe/Belgrade">{{ __('Belgrade, Bratislava, Ljubljana') }}</option>
                <option @if($classroomcourses->timezone == 'CET') selected @endif value="CET">{{ __('Sarajevo, Skopje, Zagreb') }}</option>
                <option @if($classroomcourses->timezone == 'Atlantic/Reykjavik') selected @endif value="Atlantic/Reykjavik">{{ __('Reykjavik') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Dublin') selected @endif value="Europe/Dublin">{{ __('Dublin') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/London') selected @endif value="Europe/London">{{ __('London') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Lisbon') selected @endif value="Europe/Lisbon">{{ __('Lisbon') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Casablanca') selected @endif value="Africa/Casablanca">{{ __('Casablanca') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Nouakchott') selected @endif value="Africa/Nouakchott">{{ __('Nouakchott') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Oslo') selected @endif value="Europe/Oslo">{{ __('Oslo') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Copenhagen') selected @endif value="Europe/Copenhagen">{{ __('Copenhagen') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Brussels') selected @endif value="Europe/Brussels">{{ __('Brussels') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Berlin') selected @endif value="Europe/Berlin">{{ __('Amsterdam, Berlin, Rome, Stockholm, Vienna') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Helsinki') selected @endif value="Europe/Helsinki">{{ __('Helsinki') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Amsterdam') selected @endif value="Europe/Amsterdam">{{ __('Amsterdam') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Rome') selected @endif value="Europe/Rome">{{ __('Rome') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Stockholm') selected @endif value="Europe/Stockholm">{{ __('Stockholm') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Vienna') selected @endif value="Europe/Vienna">{{ __('Vienna') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Luxembourg') selected @endif value="Europe/Luxembourg">{{ __('Luxembourg') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Paris') selected @endif value="Europe/Paris">{{ __('Paris') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Zurich') selected @endif value="Europe/Zurich">{{ __('Zurich') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Madrid') selected @endif value="Europe/Madrid">{{ __('Madrid') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Bangui') selected @endif value="Africa/Bangui">{{ __('West Central Africa') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Algiers') selected @endif value="Africa/Algiers">{{ __('Algiers') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Tunis') selected @endif value="Africa/Tunis">{{ __('Tunis') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Harare') selected @endif value="Africa/Harare">{{ __('Harare, Pretoria') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Nairobi') selected @endif value="Africa/Nairobi">{{ __('Nairobi') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Warsaw') selected @endif value="Europe/Warsaw">{{ __('Warsaw') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Prague') selected @endif value="Europe/Prague">{{ __('Prague Bratislava') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Budapest') selected @endif value="Europe/Budapest">{{ __('Budapest') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Sofia') selected @endif value="Europe/Sofia">{{ __('Sofia') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Istanbul') selected @endif value="Europe/Istanbul">{{ __('Istanbul') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Athens') selected @endif value="Europe/Athens">{{ __('Athens') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Bucharest') selected @endif value="Europe/Bucharest">{{ __('Bucharest') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Nicosia') selected @endif value="Asia/Nicosia">{{ __('Nicosia') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Beirut') selected @endif value="Asia/Beirut">{{ __('Beirut') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Damascus') selected @endif value="Asia/Damascus">{{ __('Damascus') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Jerusalem') selected @endif value="Asia/Jerusalem">{{ __('Jerusalem') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Amman') selected @endif value="Asia/Amman">{{ __('Amman') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Tripoli') selected @endif value="Africa/Tripoli">{{ __('Tripoli') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Cairo') selected @endif value="Africa/Cairo">{{ __('Cairo') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Johannesburg') selected @endif value="Africa/Johannesburg">{{ __('Johannesburg') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Moscow') selected @endif value="Europe/Moscow">{{ __('Moscow') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Baghdad') selected @endif value="Asia/Baghdad">{{ __('Baghdad') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Kuwait') selected @endif value="Asia/Kuwait">{{ __('Kuwait') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Riyadh') selected @endif value="Asia/Riyadh">{{ __('Riyadh') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Bahrain') selected @endif value="Asia/Bahrain">{{ __('Bahrain') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Qatar') selected @endif value="Asia/Qatar">{{ __('Qatar') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Aden') selected @endif value="Asia/Aden">{{ __('Aden') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Tehran') selected @endif value="Asia/Tehran">{{ __('Tehran') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Khartoum') selected @endif value="Africa/Khartoum">{{ __('Khartoum') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Djibouti') selected @endif value="Africa/Djibouti">{{ __('Djibouti') }}</option>
                <option @if($classroomcourses->timezone == 'Africa/Mogadishu') selected @endif value="Africa/Mogadishu">{{ __('Mogadishu') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Dubai') selected @endif value="Asia/Dubai">{{ __('Dubai') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Muscat') selected @endif value="Asia/Muscat">{{ __('Muscat') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Baku') selected @endif value="Asia/Baku">{{ __('Baku, Tbilisi, Yerevan') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Kabul') selected @endif value="Asia/Kabul">{{ __('Kabul') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Yekaterinburg') selected @endif value="Asia/Yekaterinburg">{{ __('Yekaterinburg') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Tashkent') selected @endif value="Asia/Tashkent">{{ __('Islamabad, Karachi, Tashkent') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Calcutta') selected @endif value="Asia/Calcutta">{{ __('India') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Kathmandu') selected @endif value="Asia/Kathmandu">{{ __('Kathmandu') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Novosibirsk') selected @endif value="Asia/Novosibirsk">{{ __('Novosibirsk') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Almaty') selected @endif value="Asia/Almaty">{{ __('Almaty') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Dacca') selected @endif value="Asia/Dacca">{{ __('Dacca') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Krasnoyarsk') selected @endif value="Asia/Krasnoyarsk">{{ __('Krasnoyarsk') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Dhaka') selected @endif value="Asia/Dhaka">{{ __('Astana, Dhaka') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Bangkok') selected @endif value="Asia/Bangkok">{{ __('Bangkok') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Saigon') selected @endif value="Asia/Saigon">{{ __('Vietnam') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Jakarta') selected @endif value="Asia/Jakarta">{{ __('Jakarta') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Irkutsk') selected @endif value="Asia/Irkutsk">{{ __('Irkutsk, Ulaanbaatar') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Shanghai') selected @endif value="Asia/Shanghai">{{ __('Beijing, Shanghai') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Hong_Kong') selected @endif value="Asia/Hong_Kong">{{ __('Hong Kong') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Taipei') selected @endif value="Asia/Taipei">{{ __('Taipei') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Kuala_Lumpur') selected @endif value="Asia/Kuala_Lumpur">{{ __('Kuala Lumpur') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Singapore') selected @endif value="Asia/Singapore">{{ __('Singapore') }}</option>
                <option @if($classroomcourses->timezone == 'Australia/Perth') selected @endif value="Australia/Perth">{{ __('Perth') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Yakutsk') selected @endif value="Asia/Yakutsk">{{ __('Yakutsk') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Seoul') selected @endif value="Asia/Seoul">{{ __('Seoul') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Tokyo') selected @endif value="Asia/Tokyo">{{ __('Osaka, Sapporo, Tokyo') }}</option>
                <option @if($classroomcourses->timezone == 'Australia/Darwin') selected @endif value="Australia/Darwin">{{ __('Darwin') }}</option>
                <option @if($classroomcourses->timezone == 'Australia/Adelaide') selected @endif value="Australia/Adelaide">{{ __('Adelaide') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Vladivostok') selected @endif value="Asia/Vladivostok">{{ __('Vladivostok') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Port_Moresby') selected @endif value="Pacific/Port_Moresby">{{ __('Guam, Port Moresby') }}</option>
                <option @if($classroomcourses->timezone == 'Australia/Brisbane') selected @endif value="Australia/Brisbane">{{ __('Brisbane') }}</option>
                <option @if($classroomcourses->timezone == 'Australia/Sydney') selected @endif value="Australia/Sydney">{{ __('Canberra, Melbourne, Sydney') }}</option>
                <option @if($classroomcourses->timezone == 'Australia/Hobart') selected @endif value="Australia/Hobart">{{ __('Hobart') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Magadan') selected @endif value="Asia/Magadan">{{ __('Magadan') }}</option>
                <option @if($classroomcourses->timezone == 'SST') selected @endif value="SST">{{ __('Solomon Islands') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Noumea') selected @endif value="Pacific/Noumea">{{ __('New Caledonia') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Kamchatka') selected @endif value="Asia/Kamchatka">{{ __('Kamchatka') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Fiji') selected @endif value="Pacific/Fiji">{{ __('Fiji Islands, Marshall Islands') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Auckland') selected @endif value="Pacific/Auckland">{{ __('Auckland, Wellington') }}</option>
                <option @if($classroomcourses->timezone == 'Asia/Kolkata') selected @endif value="Asia/Kolkata">{{ __('Mumbai, Kolkata, New Delhi') }}</option>
                <option @if($classroomcourses->timezone == 'Europe/Kiev') selected @endif value="Europe/Kiev">{{ __('Kiev') }}</option>
                <option @if($classroomcourses->timezone == 'America/Tegucigalpa') selected @endif value="America/Tegucigalpa">{{ __('Tegucigalpa') }}</option>
                <option @if($classroomcourses->timezone == 'Pacific/Apia') selected @endif value="Pacific/Apia">{{ __('Independent State of Samoa') }}</option>
              </select>
				      <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('Set to None if you want to use your account timezone.') }}</small>
            </div>
         
			
            <div class="form-group col-md-6">
			          <label for="image">{{ __('Image :') }}</label><br>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" type="file" name="image" id="image" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
                      </div>
                  </div>
                  @if($classroomcourses['image'] !== NULL && $classroomcourses['image'] !== '')
                    <img src="{{ url('/images/googleclassroom/profile_image/'.$classroomcourses->image) }}" height="70px;" width="70px;"/>
                  @else
                    <img src="{{ Avatar::create($cor->title)->toBase64() }}" alt="course" class="img-fluid">
                  @endif
		      	</div>

            <div class="form-group col-md-3">
              <label class="text-dark" for="exampleInputDetails">{{ __('adminstaticword.Status') }} :</label><br>
              <input type="checkbox" class="custom_toggle" name="status" {{ $classroomcourses->status == '1' ? 'checked' : '' }} />
              <input type="hidden"  name="free" value="0" for="status" id="status">
            </div>
            	
          </div>

          <div class="form-group">
            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>{{ __("Create")}}</button>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script>
  (function($) {
    "use strict";
    $(function(){
        $('#myCheck').change(function(){
          if($('#myCheck').is(':checked')){
            $('#update-password').show('fast');
          }else{
            $('#update-password').hide('fast');
          }
        });
        
    });
  })(jQuery);
  </script>
@endsection