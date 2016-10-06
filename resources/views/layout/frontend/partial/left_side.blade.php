<ul>
    <li class="sidebar-head">
        <h4>{{ trans('frontend/general.support') }}</h4>
    </li>
    <li class="sidebar-menu-top active">
        <a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('frontend/general.ways_to_buy_tickets') }}</a>
    </li>
    <li class="sidebar-menu">
        <a href="{{URL::route('support-faq')}}">{{ trans('frontend/general.frequently_asked_questions') }}</a>
    </li>
    <li class="sidebar-menu">
        <a href="{{URL::route('support-contact-us')}}">{{ trans('frontend/general.contact_us') }}</a>
    </li>
    <li class="sidebar-menu">
        <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('frontend/general.terms_and_conditions') }}</a>
    </li>
    <li class="sidebar-menu">
        <a href="{{URL::route('support-privacy-policy')}}">{{ trans('frontend/general.privacy_policy') }}</a>
    </li>
</ul>