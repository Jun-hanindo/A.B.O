<a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">{{ trans('frontend/general.support') }}</a>
<div class="collapse" id="mobile-sidebar-collapse">
    <ul>
        <li><a href="{{URL::route('static-ways-to-buy-tickets')}}">How to Buy Tickets</a></li>
        <li><a href="{{URL::route('static-faq')}}">{{ trans('frontend/general.frequently_asked_questions') }}</a></li>
        <li><a href="{{URL::route('static-contact-us')}}">{{ trans('frontend/general.contact_us') }}</a></li>
        <li><a href="{{URL::route('static-terms-ticket-sales')}}">{{ trans('frontend/general.terms_of_ticket_sales') }}</a></li>
        <li><a href="{{URL::route('static-terms-website-use')}}">{{ trans('frontend/general.terms_of_website_use') }}</a></li>
        <li><a href="{{URL::route('static-privacy-policy')}}">{{ trans('frontend/general.privacy_policy') }}</a></li>
    </ul>
</div>