<!-- admin job tab start -->
<li>
    <a href="javaScript:void();">
        <i class="feather icon-briefcase text-secondary"></i><span>{{ __('Job') }}</span><i class="feather icon-chevron-right"></i>
    </a>
    <ul class="vertical-submenu">
        <li>
            <a href="{{route('adminjob.index')}}">{{ __('Job') }}</a>
        </li>
        <li>
            <a href="{{url('resume')}}">{{ __('Resume') }}</a>
        </li>
        <li>
            <a href="{{url('job/setting')}}">{{ __('Setting') }}</a>
        </li>
    </ul>
</li>
<!-- admin job tab end -->