<a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.our_company') }}</a>
<div class="collapse" id="mobile-sidebar-collapse">
    <ul>
        <li><a href="{{URL::route('our-company-about-us')}}">{{ trans('frontend/general.about_asiaboxoffice') }}</a></li>
        <li><a href="{{URL::route('our-company-careers')}}">{{ trans('frontend/general.careers') }}</a></li>
        <li><a href="{{URL::route('our-company-contact-us')}}">{{ trans('frontend/general.contact_us') }}</a></li>
    </ul>
</div>