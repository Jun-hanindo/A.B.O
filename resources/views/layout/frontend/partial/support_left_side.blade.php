<ul>
    <li class="sidebar-head">
        <h4 class="font-light">{{ trans('frontend/general.support') }}</h4>
    </li>
    <li class="sidebar-menu-top  {{ (Request::url() == URL::route('support-way-to-buy-tickets')) ? 'active' : '' }}">
        <a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('frontend/general.ways_to_buy_tickets') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('support-faq')) ? 'active' : '' }}">
        <a href="{{URL::route('support-faq')}}">{{ trans('frontend/general.frequently_asked_questions') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('support-contact-us')) ? 'active' : '' }}">
        <a href="{{URL::route('support-contact-us')}}">{{ trans('frontend/general.contact_us') }}</a>
    </li>
    {{-- <li class="sidebar-menu {{ (Request::url() == URL::route('support-terms-and-conditions')) ? 'active' : '' }}">
        <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('frontend/general.terms_and_conditions') }}</a>
    </li> --}}
    <li class="sidebar-menu {{ (Request::url() == URL::route('support-terms-ticket-sales')) ? 'active' : '' }}">
        <a href="{{URL::route('support-terms-ticket-sales')}}">{{ trans('frontend/general.terms_of_ticket_sales') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('support-terms-website-use')) ? 'active' : '' }}">
        <a href="{{URL::route('support-terms-website-use')}}">{{ trans('frontend/general.terms_of_website_use') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('support-privacy-policy')) ? 'active' : '' }}">
        <a href="{{URL::route('support-privacy-policy')}}">{{ trans('frontend/general.privacy_policy') }}</a>
    </li>
</ul>