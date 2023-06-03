<!-- This will append MPesa payment admin payment settings page. -->
<!-- MPesa payment settings start -->
@extends('admin.layouts.master')
@section('title','All Mpesa')
@section('maincontent')
<?php
$data['heading'] = 'Mpesa Setting';
$data['title'] = 'Setting';
$data['title1'] = 'Mpesa Setting';
?>
@include('admin.layouts.topbar',$data)
<div class="contentbar">
    <div class="row">
        <div class="col-lg-12">
            <div class="card dashboard-card m-b-30">
                <div class="card-header">
                    <h5 class="box-tittle">{{ __('Mpesa') }} {{ __('Setting') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('mpesa.payment.settings') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MPESA_CONSUMER_SECRET"> {{ __("MPESA COSUMER SECRET:") }}</label>

                                    <div class="input-group mb-3">

                                        <input id="password" type="password"
                                            value="{{ env('MPESA_CONSUMER_SECRET') }}" name="MPESA_CONSUMER_SECRET"
                                            class="form-control" placeholder="enter your MPESA COSUMER SECRET KEY">
                                        <div class="input-group-prepend text-center">
                                            <span toggle="#password"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __("MPESA COSUMER KEY:") }}</label>
                                    <input required name="MPESA_COSUMER_KEY" value="{{ env('MPESA_COSUMER_KEY') }}" type="text"
                                        class="form-control" placeholder="{{ __("Enter SERVICE TYPE") }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __("Status:") }}</label>
                                    <label class="switch">
                                        <input class="user" type="checkbox"  name="MPESA_ENABLE" id="MPESA_ENABLE" {{ config('mpesa.ENABLE') == 1 ? "checked"  :"" }}>
                                        <span class="knob"></span>
                                      </label>
                                    
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                                        Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                                        Update</button>
                                </div>
                    
                                <div class="clear-both"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MPESA_PASSKEY">{{ __("MPESA PASS KEY:") }}</label>

                                    <div class="input-group mb-3">

                                        <input id="password-field" type="password"
                                        value="{{ env('MPESA_PASSKEY') }}" name="MPESA_PASSKEY"
                                            class="form-control"  placeholder="{{ __("enter your MPESA PASSKEY.") }}">
                                        <div class="input-group-prepend text-center">
                                            <span toggle="#password-field"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __("MPESA SHORTCODE:") }}</label>
                                    <input required name="MPESA_SHORTCODE" value="{{ env('MPESA_SHORTCODE') }}" type="text"
                                        class="form-control" placeholder="{{ __("Enter MPESA SHORTCODE") }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ __("Sandbox (TEST MODE):") }}</label>
                                    <label class="switch">
                                        <input class="user" type="checkbox"  name="MPESA_SANDBOX" id="MPESA_SANDBOX" {{ config('mpesa.MPESA_SANDBOX') == 1 ? "checked"  :"" }}>
                                        <span class="knob"></span>
                                      </label>
                                    
                                </div>
                              
                            </div>
                        </div>
                     
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
<!-- MPesa payment settings end -->
