<a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.support') }}</a>
<div class="collapse" id="mobile-sidebar-collapse">
    <ul>
        <li><a href="{{URL::route('ways-to-buy-tickets')}}">How to Buy Tickets</a></li>
        <li><a href="{{URL::route('faq')}}">{{ trans('frontend/general.frequently_asked_questions') }}</a></li>
        <li><a href="{{URL::route('contact-us')}}">{{ trans('frontend/general.contact_us') }}</a></li>
        {{-- <li><a href="{{URL::route('terms-and-conditions')}}">{{ trans('frontend/general.terms_and_conditions') }}</a></li> --}}
        <li><a href="{{URL::route('terms-ticket-sales')}}">{{ trans('frontend/general.terms_of_ticket_sales') }}</a></li>
        <li><a href="{{URL::route('terms-website-use')}}">{{ trans('frontend/general.terms_of_website_use') }}</a></li>
        <li><a href="{{URL::route('privacy-policy')}}">{{ trans('frontend/general.privacy_policy') }}</a></li>
    </ul>
</div>