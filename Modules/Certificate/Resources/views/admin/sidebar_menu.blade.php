<!-- This will append in sidebar menu -->
<!-- li start-->
<li class="{{ Nav::isRoute('create.certificate') }}">
    <a href="{{route('create.certificate')}}" class="menu">
        <span>{{ __('Manage Certificate') }}</span>
    </a>
</li>
<li class="{{ Nav::isRoute('certificate.setting') }}">
    <a href="{{route('certificate.setting')}}" class="menu">
        <span>{{ __('Certificate Setting') }}</span>
    </a>
</li>
<!-- li end -->