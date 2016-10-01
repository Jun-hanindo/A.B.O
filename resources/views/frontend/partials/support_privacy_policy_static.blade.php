@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
<section class="about-content ways-content">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <li class="sidebar-head">
                        <h4 class="font-light">Support</h4>
                    </li>
                    <li class="sidebar-menu-top">
                        <a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('contact-us')}}">Contact Us</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a>
                    </li>
                    <li class="sidebar-menu active">
                        <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-content main-terms">
                <div class="support-desc">
                    <div class="row">
                        <h3 class="head-support font-light">Privacy Policy</h3>
                        <div class="col-md-12">
                            <div class="privacy-content">
                                <h5>Overview</h5>
                                <p>We, Asia Box Office Pte Ltd, are committed to protecting and respecting your privacy.</p>
                                <p>This policy (together with our <a href="{{URL::route('support-terms-website-use')}}">terms of use</a> and any other documents referred to on it) sets out the basis on which any personal data we collect from you, or that you provide to us, will be processed by us.  Please read the following carefully to understand our practices regarding your personal data and how we will treat it. By visiting www.asiaboxoffice.com (“our site”), you are accepting and consenting to the practices described in this policy. </p>
                                <h5>Privacy Policy</h5>
                                <ol>
                                    <li>Information we may collect from you<br>
                                        We may collect and process the following data about you:
                                        <ol>
                                            <li>Information you give us. You may give us information about you by filling in forms on our site by corresponding with us by phone, e-mail or otherwise. This includes information you provide when you register to use our site, subscribe to our service, search for a ticket, place an order on our site, enter a competition, promotion or survey or when you report a problem with our site. The information you give us may include your name, address, e-mail address and phone number, financial and credit card information, image, photograph and personal description.</li>
                                            <li>Information we collect about you. With regard to each of your visits to our site we may automatically collect the following information:
                                                <ul>
                                                    <li>technical information, including the Internet protocol (IP) address used to connect your computer to the Internet, your login information, browser type and version, time zone setting, browser plug-in types and versions, operating system and platform.</li>
                                                    <li>information about your visit, including the full Uniform Resource Locators (URL) clickstream to, through and from our site (including date and time); products you viewed or searched for; page response times, download errors, length of visits to certain pages, page interaction information (such as scrolling, clicks, and mouse-overs), and methods used to browse away from the page and any phone number used to call our customer service number.</li>
                                                </ul>
                                            </li>
                                            <li>Information we receive from other sources. We may receive information about you if you use any of the other websites we operate or the other services we provide.  We are also working closely with third parties (including, for example, business partners, sub-contractors in technical, payment and delivery services, advertising networks, analytics providers, search information providers, credit reference agencies) and may receive information about you from them.</li>
                                        </ol>
                                        <li>Uses made of the information<br>
                                            We use information held about you in the following ways:
                                            <ol>
                                                <li>Information you give to us. We will use this information:
                                                    <ul>
                                                        <li>To carry out our obligations arising from any contracts entered into between you and us and to provide you with the information, products and services that you request from us</li>
                                                        <li>To provide you with information about other goods and services we offer that are similar to those that you have already purchased or enquired about</li>
                                                        <li>To notify you about changes to our service</li>
                                                        <li>To ensure that content from our site is presented in the most effective manner for you and for your computer</li>
                                                    </ul>
                                                </li>
                                                <li>Information we collect about you. We will use this information:
                                                    <ul>
                                                        <li>To administer our site and for internal operations, including troubleshooting, data analysis, testing, research, statistical and survey purposes</li>
                                                        <li>to improve our site to ensure that content is presented in the most effective manner for you and for your computer</li>
                                                        <li>To allow you to participate in interactive features of our service, when you choose to do so</li>
                                                        <li>As part of our efforts to keep our site safe and secure</li>
                                                        <li>To measure or understand the effectiveness of advertising we serve to you and others, and to deliver relevant advertising to you</li>
                                                        <li>To make suggestions and recommendations to you and other users of our site about goods or services that may interest you or them.</li>
                                                    </ul>
                                                </li>
                                                <li>Information we receive from other sources. We may combine this information with information you give to us and information we collect about you. We may us this information and the combined information for the purposes set out above (depending on the types of information we receive).</li>
                                            </ol>
                                        </li>
                                        <li>Disclosure of your information
                                            <ol>
                                                <li>In connection with the above, we may share your personal information with any venue owner or promoter and/or any member of our group, which means our subsidiaries, our holding companies and its subsidiaries, and our affiliates.</li>
                                                <li>We may also share your information with selected third parties including our business partners, suppliers and sub-contractors for the performance of any contract we enter into with you.</li>
                                                <li>We may disclose your personal information to third parties:
                                                    <ul>
                                                        <li>In the event that we sell any business or assets, in which case we may disclose your personal data to the prospective buyer of such business or assets.</li>
                                                        <li>If Asia Box Office Pte Ltd or substantially all of its assets are acquired by a third party, in which case personal data held by it about its customers will be one of the transferred assets.</li>
                                                        <li>If we are under a duty to disclose or share your personal data in order to comply with any legal obligation, or in order to enforce or apply our <a href="{{URL::route('support-terms-website-use')}}">terms of use</a> or Terms and Conditions of <a href="{{URL::route('support-terms-ticket-sales')}}">Ticket Sales</a> and other agreements; or to protect the rights, property, or safety of Asia Box Office Pte Ltd, our customers, or others. This includes exchanging information with other companies and organisations for the purposes of fraud protection.</li>
                                                    </ul>
                                                </li>
                                            </ol>
                                        </li>
                                        <li>Where we store your personal data
                                            <ol>
                                                <li>The data that we collect from you may be transferred to, and stored at, a destination outside Singapore. It may also be processed by staff operating outside Singapore who work for us or for one of our suppliers. Such staff maybe engaged in, among other things, the fulfilment of your order, the processing of your payment details and the provision of support services.</li>
                                                <li>By submitting your personal data, you agree to this transfer, storing or processing. We will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this privacy policy.</li>
                                                <li>Where we have given you (or where you have chosen) a password which enables you to access certain parts of our site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.</li>
                                                <li>Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data transmitted to our site; any transmission is at your own risk. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorised access.</li>
                                            </ol>
                                        </li>
                                        <li>Your rights
                                            <ol>
                                                <li>You have the right to ask us not to process your personal data for marketing purposes. We will usually inform you (before collecting your data) if we intend to use your data for such purposes or if we intend to disclose your information to any third party for such purposes. You can exercise your right to prevent such processing by checking certain boxes on the forms we use to collect your data.  You can also exercise the right at any time by contacting us at connect@asiaboxoffice.com.</li>
                                                <li>Our site may, from time to time, contain links to and from the websites of our partners, advertisers and affiliates.  If you follow a link to any of these websites, please note that these websites have their own privacy policies and that we do not accept any responsibility or liability for these policies.  Please check these policies before you submit any personal data to these websites.</li>
                                            </ol>
                                        </li>
                                        <li>Access to information
                                            <ol>
                                                <li>The Personal Data Protection Act 2012 of Singapore (the “Act”) gives you the right to access information held about you.</li>
                                                <li>Your right of access can be exercised in accordance with the Act.</li>
                                                <li>Any access request may be subject to an administrative fee to meet our costs in providing you with details of the information we hold about you.</li>
                                            </ol>
                                        </li>
                                        <li>Changes to our privacy policy
                                            <ol>
                                                <li>Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail. Please check back frequently to see any updates or changes to our privacy policy.</li>
                                            </ol>
                                        </li>
                                        <li>Contact
                                            <ol>
                                                <li>Questions, comments and requests regarding this privacy policy should be addressed to connect@asiaboxoffice.com.</li>
                                            </ol>
                                        </li>
                                    </li>
                                </ol>
                                <br>
                                <label class="update-terms">Updated by Asia Box Office Legal Team on May 15, 2016</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ways-mobile mobile-content">
    <div class="row">
        <div class="col-md-12 mobile-sidebar">
            <div class="container">
                <div class="mobile-sidebar-menu">
                    <a class="menu collapsed" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                        <ul>
                            <li><a href="{{URL::route('support-faq')}}">Frequently Asked Questions</a></li>
                            <li><a href="{{URL::route('contact-us')}}">Contact Us</a></li>
                            <li><a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a></li>
                            <li><a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a></li>
                            <li><a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="mobile-page-title">
                    <h3 class="font-light">Privacy Policy</h3>
                </div>
                <div class="privacy-content">
                    <h5>Overview</h5>
                    <p>We, Asia Box Office Pte Ltd, are committed to protecting and respecting your privacy.</p>
                    <p>This policy (together with our <a href="{{URL::route('support-terms-website-use')}}">terms of use</a> and any other documents referred to on it) sets out the basis on which any personal data we collect from you, or that you provide to us, will be processed by us.  Please read the following carefully to understand our practices regarding your personal data and how we will treat it. By visiting www.asiaboxoffice.com (“our site”), you are accepting and consenting to the practices described in this policy. </p>
                    <h5>Privacy Policy</h5>
                    <ol>
                        <li>Information we may collect from you<br>
                            We may collect and process the following data about you:
                            <ol>
                                <li>Information you give us. You may give us information about you by filling in forms on our site by corresponding with us by phone, e-mail or otherwise. This includes information you provide when you register to use our site, subscribe to our service, search for a ticket, place an order on our site, enter a competition, promotion or survey or when you report a problem with our site. The information you give us may include your name, address, e-mail address and phone number, financial and credit card information, image, photograph and personal description.</li>
                                <li>Information we collect about you. With regard to each of your visits to our site we may automatically collect the following information:
                                    <ul>
                                        <li>technical information, including the Internet protocol (IP) address used to connect your computer to the Internet, your login information, browser type and version, time zone setting, browser plug-in types and versions, operating system and platform.</li>
                                        <li>information about your visit, including the full Uniform Resource Locators (URL) clickstream to, through and from our site (including date and time); products you viewed or searched for; page response times, download errors, length of visits to certain pages, page interaction information (such as scrolling, clicks, and mouse-overs), and methods used to browse away from the page and any phone number used to call our customer service number.</li>
                                    </ul>
                                </li>
                                <li>Information we receive from other sources. We may receive information about you if you use any of the other websites we operate or the other services we provide.  We are also working closely with third parties (including, for example, business partners, sub-contractors in technical, payment and delivery services, advertising networks, analytics providers, search information providers, credit reference agencies) and may receive information about you from them.</li>
                            </ol>
                            <li>Uses made of the information<br>
                                We use information held about you in the following ways:
                                <ol>
                                    <li>Information you give to us. We will use this information:
                                        <ul>
                                            <li>To carry out our obligations arising from any contracts entered into between you and us and to provide you with the information, products and services that you request from us</li>
                                            <li>To provide you with information about other goods and services we offer that are similar to those that you have already purchased or enquired about</li>
                                            <li>To notify you about changes to our service</li>
                                            <li>To ensure that content from our site is presented in the most effective manner for you and for your computer</li>
                                        </ul>
                                    </li>
                                    <li>Information we collect about you. We will use this information:
                                        <ul>
                                            <li>To administer our site and for internal operations, including troubleshooting, data analysis, testing, research, statistical and survey purposes</li>
                                            <li>to improve our site to ensure that content is presented in the most effective manner for you and for your computer</li>
                                            <li>To allow you to participate in interactive features of our service, when you choose to do so</li>
                                            <li>As part of our efforts to keep our site safe and secure</li>
                                            <li>To measure or understand the effectiveness of advertising we serve to you and others, and to deliver relevant advertising to you</li>
                                            <li>To make suggestions and recommendations to you and other users of our site about goods or services that may interest you or them.</li>
                                        </ul>
                                    </li>
                                    <li>Information we receive from other sources. We may combine this information with information you give to us and information we collect about you. We may us this information and the combined information for the purposes set out above (depending on the types of information we receive).</li>
                                </ol>
                            </li>
                            <li>Disclosure of your information
                                <ol>
                                    <li>In connection with the above, we may share your personal information with any venue owner or promoter and/or any member of our group, which means our subsidiaries, our holding companies and its subsidiaries, and our affiliates.</li>
                                    <li>We may also share your information with selected third parties including our business partners, suppliers and sub-contractors for the performance of any contract we enter into with you.</li>
                                    <li>We may disclose your personal information to third parties:
                                        <ul>
                                            <li>In the event that we sell any business or assets, in which case we may disclose your personal data to the prospective buyer of such business or assets.</li>
                                            <li>If Asia Box Office Pte Ltd or substantially all of its assets are acquired by a third party, in which case personal data held by it about its customers will be one of the transferred assets.</li>
                                            <li>If we are under a duty to disclose or share your personal data in order to comply with any legal obligation, or in order to enforce or apply our <a href="{{URL::route('support-terms-website-use')}}">terms of use</a> or Terms and Conditions of <a href="{{URL::route('support-terms-ticket-sales')}}">Ticket Sales</a> and other agreements; or to protect the rights, property, or safety of Asia Box Office Pte Ltd, our customers, or others. This includes exchanging information with other companies and organisations for the purposes of fraud protection.</li>
                                        </ul>
                                    </li>
                                </ol>
                            </li>
                            <li>Where we store your personal data
                                <ol>
                                    <li>The data that we collect from you may be transferred to, and stored at, a destination outside Singapore. It may also be processed by staff operating outside Singapore who work for us or for one of our suppliers. Such staff maybe engaged in, among other things, the fulfilment of your order, the processing of your payment details and the provision of support services.</li>
                                    <li>By submitting your personal data, you agree to this transfer, storing or processing. We will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this privacy policy.</li>
                                    <li>Where we have given you (or where you have chosen) a password which enables you to access certain parts of our site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.</li>
                                    <li>Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data transmitted to our site; any transmission is at your own risk. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorised access.</li>
                                </ol>
                            </li>
                            <li>Your rights
                                <ol>
                                    <li>You have the right to ask us not to process your personal data for marketing purposes. We will usually inform you (before collecting your data) if we intend to use your data for such purposes or if we intend to disclose your information to any third party for such purposes. You can exercise your right to prevent such processing by checking certain boxes on the forms we use to collect your data.  You can also exercise the right at any time by contacting us at connect@asiaboxoffice.com.</li>
                                    <li>Our site may, from time to time, contain links to and from the websites of our partners, advertisers and affiliates.  If you follow a link to any of these websites, please note that these websites have their own privacy policies and that we do not accept any responsibility or liability for these policies.  Please check these policies before you submit any personal data to these websites.</li>
                                </ol>
                            </li>
                            <li>Access to information
                                <ol>
                                    <li>The Personal Data Protection Act 2012 of Singapore (the “Act”) gives you the right to access information held about you.</li>
                                    <li>Your right of access can be exercised in accordance with the Act.</li>
                                    <li>Any access request may be subject to an administrative fee to meet our costs in providing you with details of the information we hold about you.</li>
                                </ol>
                            </li>
                            <li>Changes to our privacy policy
                                <ol>
                                    <li>Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail. Please check back frequently to see any updates or changes to our privacy policy.</li>
                                </ol>
                            </li>
                            <li>Contact
                                <ol>
                                    <li>Questions, comments and requests regarding this privacy policy should be addressed to connect@asiaboxoffice.com.</li>
                                </ol>
                            </li>
                        </li>
                    </ol>
                    <br>
                    <label class="update-terms">Updated by Asia Box Office Legal Team on May 15, 2016</label>
                </div>
            </div>
        </div>
    </div>
</section>
@stop