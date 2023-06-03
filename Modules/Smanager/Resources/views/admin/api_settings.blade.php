<div class="tab-pane fade" id="v-pills-Smanager" role="tabpanel" aria-labelledby="v-pills-Smanager-tab">
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="pay_enable">{{ __('Smanager Payment') }}</label>
        </div>

        <div class="col-md-12 form-group">
            <input type="checkbox" id="smanager_sec1" class="custom_toggle" name="smanager_check" {{ $gsetting->smanager_enable==1 ? 'checked' : '' }} />
        </div>
        
        <div class="col-md-6 form-group">
            <label for="pay_cid">{{ __('SMANAGER CLIENT ID') }}<sup class="redstar">*</sup></label>
            <input value="{{ $env_files['SMANAGER_CLIENT_ID'] }}" autofocus name="SMANAGER_CLIENT_ID" type="text" class="form-control" placeholder="Enter CLIENT ID"/>
        </div>
        
        
        <div class="col-md-6 form-group">
            <label for="pay_cid">{{ __('SMANAGER CLIENT SECRET') }}<sup class="redstar">*</sup></label>
            <input value="{{ $env_files['SMANAGER_CLIENT_SECRET'] }}" autofocus name="SMANAGER_CLIENT_SECRET" type="text" class="form-control" placeholder="Enter CLIENT SECRET"/>
            
        </div>

        <div class="col-md-12 form-group">
            <label for="pay_mode">{{ __('SMANAGER Mode') }}<sup class="redstar">*</sup></label>
            <input value="{{ $env_files['SMANAGER_URL'] }}" autofocus name="SMANAGER_URL" type="text" class="form-control" placeholder="Enter SMANAGER URL"/>
            <small class="text-info"><i class="fa fa-question-circle"></i> {{ __('For Test use') }} <b>{{ __('"https://api.dev-sheba.xyz"') }}</b> {{ __('and for Live use') }} <b>{{ __('"https://api.sheba.xyz"') }}</b></small>
        </div>
        <div class="form-group col-md-12">
            <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
        </div>
    </div>
</div>
