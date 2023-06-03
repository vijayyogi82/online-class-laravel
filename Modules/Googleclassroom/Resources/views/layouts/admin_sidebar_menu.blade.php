<!-- Google classroom start  -->
<li class="{{ Nav::isRoute('googleclassroom.setting') }}">
    <a href="javaScript:void();">
        <span>{{ __('Google Class Room') }}</span><i class="feather icon-chevron-right"></i>
    </a>
    <ul class="vertical-submenu">
        <li class="{{ Nav::isRoute('googleclassroom.setting') }}"><a href="{{route('googleclassroom.setting')}}">{{ __('Setting') }}</a></li>
        <li class="{{ Nav::isRoute('googleclassroom.index') }}"><a href="{{route('googleclassroom.index')}}">{{ __('Dashboard') }}</a></li>
        <li class="{{ Nav::isRoute('googleclassroom.allclass') }}"><a href="{{route('googleclassroom.allclass')}}">{{ __('All Class') }}</a></li>
    </ul>
</li>
<!-- Google classroom end  -->