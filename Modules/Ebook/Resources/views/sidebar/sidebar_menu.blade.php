<li class="{{ Nav::isRoute('ebook-categories') }} {{ Nav::isRoute('ebook') }} {{ Nav::isRoute('ebook-reviews') }} {{ Nav::isRoute('ebook-orders') }}">
    <a href="javaScript:void();" class="menu"><i class="feather icon-user text-secondary"></i>
        <span>{{ __('Ebooks') }}<div class="sub-menu truncate">{{__('Ebook, Category, Reviews, Orders')}}</div></span>
        <i class="feather icon-chevron-right"></i>
    </a>
    <ul class="vertical-submenu">
        <li class="{{ Nav::isRoute('ebook-categories') }}"><a href="{{route('ebook-category')}}">{{ __('Category') }}</a></li>
        <li class="{{ Nav::isRoute('ebook') }}"><a href="{{route('ebook')}}">{{ __('Ebooks') }}</a></li>
        <li class="{{ Nav::isRoute('ebook-reviews') }}"><a href="{{route('ebook-reviews')}}">{{ __('Reviews') }}</a></li>
        <li class="{{ Nav::isRoute('ebook-orders') }}"><a href="{{route('ebook-orders')}}">{{ __('Orders') }}</a></li>
    </ul>
</li>