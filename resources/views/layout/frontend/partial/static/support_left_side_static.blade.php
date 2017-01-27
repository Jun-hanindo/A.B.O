<ul>
    <li class="sidebar-head">
        <h4 class="font-light">{{ trans('frontend/general.support') }}</h4>
    </li>
    <li class="sidebar-menu-top  {{ (Request::url() == URL::route('static-ways-to-buy-tickets')) ? 'active' : '' }}">
        <a href="{{URL::route('static-ways-to-buy-tickets')}}">How to Buy Tickets</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('static-faq')) ? 'active' : '' }}">
        <a href="{{URL::route('static-faq')}}">{{ trans('frontend/general.frequently_asked_questions') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('static-contact-us')) ? 'active' : '' }}">
        <a href="{{URL::route('static-contact-us')}}">{{ trans('frontend/general.contact_us') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('static-terms-ticket-sales')) ? 'active' : '' }}">
        <a href="{{URL::route('static-terms-ticket-sales')}}">{{ trans('frontend/general.terms_of_ticket_sales') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('static-terms-website-use')) ? 'active' : '' }}">
        <a href="{{URL::route('static-terms-website-use')}}">{{ trans('frontend/general.terms_of_website_use') }}</a>
    </li>
    <li class="sidebar-menu {{ (Request::url() == URL::route('static-privacy-policy')) ? 'active' : '' }}">
        <a href="{{URL::route('static-privacy-policy')}}">{{ trans('frontend/general.privacy_policy') }}</a>
    </li>
</ul>