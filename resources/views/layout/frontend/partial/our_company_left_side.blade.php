<ul>
    <li class="sidebar-head">
        <h4>{{ trans('frontend/general.our_company') }}</h4>
    </li>
    <li class="sidebar-menu-top {{ (Request::url() == URL::route('our-company-about-us')) ? 'active' : '' }}">
        <a href="{{URL::route('our-company-about-us')}}">{{ trans('frontend/general.about_asiaboxoffice') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('our-company-careers')) ? 'active' : '' }}">
        <a href="{{URL::route('our-company-careers')}}">{{ trans('frontend/general.careers') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('our-company-contact-us')) ? 'active' : '' }}">
        <a href="{{URL::route('our-company-contact-us')}}">{{ trans('frontend/general.contact_us') }}</a>
    </li>
</ul>