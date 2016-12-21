<?php

use Illuminate\Database\Seeder;
use App\Models\ManagePage;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->truncate();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'Contact Us Page';
        $tixtrack->slug = 'contact-us';
        $tixtrack->content = '<div class="col-md-4">
                                <div class="hotline">
                                    <div class="iconWays">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <h4 class="headWays font-light">Talk to Us</h4>
                                    <h5>Reach out to our customer service team.</h5>
                                    <br>
                                    <a href="mailto:connect@asiaboxoffice.com">
                                        <button class="btn btnBlackDefault font-bold button-email"><i class="fa fa-envelope"></i>connect@asiaboxoffice.com</button>
                                    </a>
                                    <button class="btn btnBlackDefault font-bold"><i class="fa fa-phone"></i>Call +65 6733 0360</button>
                                    
                                    <br>
                                    <div class="operating">
                                        <label class="font-bold">Hotline Operating Hours</label>
                                        <br>
                                        <label>Mon to Fri: 10am - 6pm</label>
                                    </div>
                                </div>
                            </div>';
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = '<div class="mobileTab">
                                            <ul class="nav nav-tabs tab-mobile tab-mobile-contact" role="tablist">
                                                <!-- <li role="presentation" class="active"><a href="#boxoffice" aria-controls="home" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-ticket"></i></div><br>Box Office</a></li> -->
                                                <li role="presentation"><a href="#hotline" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-envelope"></i></div><br>Talk to Us</a></li>
                                                <!-- <li role="presentation"><a href="#website" aria-controls="profile" role="tab" data-toggle="tab"><div class="iconWays"><i class="fa fa-laptop"></i></div><br>Website</a></li> -->
                                            </ul>
                                        </div>
                                        <div class="contentTab">
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="hotline">
                                                    <h4 class="head-mobile-ways">Reach out to our customer service team.</h4>
                                                    <div class="office-button-mobile">
                                                        <a href="mailto:connect@asiaboxoffice.com">
                                                            <button class="btn btnBlackDefault font-bold button-email"><i class="fa fa-envelope"></i>connect@asiaboxoffice.com</button>
                                                        </a>
                                                        <a href="tel:+6567330360">
                                                            <button class="btn btnSeeContact btnBlackDefault font-bold"><i class="fa fa-phone" style="margin-right: 10px;"></i>Call +65 6733 0360</button>
                                                        </a>
                                                    </div>
                                                    <div class="hotline-operating-mobile">
                                                        <label class="label-head font-bold">Hotline Operating Hours</label><br>
                                                        <label>Mon to Fri: 10am - 6pm</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'About Us Page';
        $tixtrack->slug = 'about-us';
        $tixtrack->content = '<div class="col-md-9">
                                <div class="main-content">
                                    <div class="about-desc">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat laoreet eros, eget aliquet mi maximus eu. Donec nec blandit nisi. Aliquam volutpat eros id nibh congue elementum. Nam lectus quam, feugiat in faucibus orci luctus commodo ut.</p>
                             

                                                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus sollicitudin condimentum ante, nec volutpat velit vehicula sit amet. Praesent at posuere ipsum. Etiam rutrum consequat risus sit amet dignissim. Nam lectus quam, feugiat in commodo ut, sollicitudin quis odio. Fusce vel tincidunt nisi, pharetra semper sem.</p>
                                                <a class="client-btn" href="#client">Our Clients</a> 
                                                <a class="partner-btn" href="#partner">Our Partners</a>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="logo-about">
                                                    <img src="http://asiabox.stagingapps.net/assets/frontend/images/about-logo.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="client-desc" id="client">
                                        <h3>Our Clients</h3>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="client-logo">
                                                    <img class="img-center" src="http://asiabox.stagingapps.net/assets/frontend/images/client-logo-1.png" style="width: 123px; height: 40px;" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="client-logo">
                                                    <img src="http://asiabox.stagingapps.net/assets/frontend/images/client-logo-2.png" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="client-logo">
                                                    <img src="http://asiabox.stagingapps.net/assets/frontend/images/client-logo-3.png" />
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btnAbout" data-target="#modalContact" data-toggle="modal" id="ticket">Sell Events Through Us</button>
                                    </div>

                                    <div class="partner-desc" id="partner">
                                        <h3>Our Partners</h3>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="client-logo">
                                                    <img src="http://asiabox.stagingapps.net/assets/frontend/images/partner-logo-1.png" style="width: 108px; height: 108px;" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="client-logo">
                                                    <img class="img-center" src="http://asiabox.stagingapps.net/assets/frontend/images/partner-logo-2.png" style="width: 135px; height: 34px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btnAbout" data-target="#modalContact" data-toggle="modal" id="partner">Work With Us</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Send a Message</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="error-modal"></div>
                                            <form id="message-form">
                                                <select name="subject" id="subject" class="form-control subject">
                                                    <option id="ticket" value="Ticketing Solution for Your Event">Ticketing Solution for Your Event</option>
                                                    <option id="partner" value="Partnerships">Partnerships</option>
                                                </select>
                                                <input type="text" name="name" id="name" placeholder="Name" class="form-control name">
                                                <input type="text" name="email" id="email" placeholder="Email" class="form-control email">
                                                <div class="row">
                                                    <div class="col-md-3 col-1">
                                                        <input type="text" name="country_code" placeholder="+65" id="country_code" class="form-control country_code">
                                                    </div>
                                                    <div class="col-md-9 col-2">
                                                        <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number" class="form-control contact_number">
                                                    </div>
                                                </div>
                                                <textarea type="text" name="message" id="message" placeholder="Write your message" class="form-control message"></textarea>
                                                <p>[captcha]</p>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btnFeedback">Send Message</button>
                                        </div>
                                  </div>
                              </div>
                            </div>
                            <div class="modal fade" id="modalYes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Thanks for Your Submission</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>We will get back to you within 24 Hours.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btnDismiss" data-dismiss="modal">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = 'mobile';
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'Privacy Policy Page';
        $tixtrack->slug = 'privacy-policy';
        $tixtrack->content = "<h5>Overview</h5>
                            <p>We, Asia Box Office Pte Ltd, are committed to protecting and respecting your privacy.</p>
                            <p>This policy (together with our <a href='/terms-of-website-use'>terms of use</a> and any other documents referred to on it) sets out the basis on which any personal data we collect from you, or that you provide to us, will be processed by us.  Please read the following carefully to understand our practices regarding your personal data and how we will treat it. By visiting www.asiaboxoffice.com (“our site”), you are accepting and consenting to the practices described in this policy. </p>
                            <h5>Privacy Policy</h5>
                            <ol>
                              <li><label class='font-bold'>Information we may collect from you</label><br>
                                  We may collect and process the following data about you:
                                <ol class='a'>
                                  <li><span class='font-bold'>Information you give us.</span> You may give us information about you by filling in forms on our site by corresponding with us by phone, e-mail or otherwise. This includes information you provide when you register to use our site, subscribe to our service, search for a ticket, place an order on our site, enter a competition, promotion or survey or when you report a problem with our site. The information you give us may include your name, address, e-mail address and phone number, financial and credit card information, image, photograph and personal description.</li>
                                  <li><span class='font-bold'>Information we collect about you.</span> With regard to each of your visits to our site we may automatically collect the following information:
                                    <ul>
                                      <li>technical information, including the Internet protocol (IP) address used to connect your computer to the Internet, your login information, browser type and version, time zone setting, browser plug-in types and versions, operating system and platform; and</li>
                                      <li>information about your visit, including the full Uniform Resource Locators (URL) clickstream to, through and from our site (including date and time); products you viewed or searched for; page response times, download errors, length of visits to certain pages, page interaction information (such as scrolling, clicks, and mouse-overs), and methods used to browse away from the page and any phone number used to call our customer service number.</li>
                                    </ul>
                                  </li>
                                  <li><span class='font-bold'>Information we receive from other sources.</span> We may receive information about you if you use any of the other websites we operate or the other services we provide.  We are also working closely with third parties (including, for example, business partners, sub-contractors in technical, payment and delivery services, advertising networks, analytics providers, search information providers, credit reference agencies) and may receive information about you from them.</li>
                                </ol>
                                  <li><label class='font-bold'>Uses made of the information</label><br>
                                      We use information held about you in the following ways:
                                      <ol class='a'>
                                        <li><span class='font-bold'>Information you give to us.</span> We will use this information:
                                          <ul>
                                            <li>To carry out our obligations arising from any contracts entered into between you and us and to provide you with the information, products and services that you request from us</li>
                                            <li>To provide you with information about other goods and services we offer that are similar to those that you have already purchased or enquired about</li>
                                            <li>To notify you about changes to our service</li>
                                            <li>To ensure that content from our site is presented in the most effective manner for you and for your computer</li>
                                          </ul>
                                        </li>
                                        <li><span class='font-bold'>Information we collect about you.</span> We will use this information:
                                          <ul>
                                            <li>To administer our site and for internal operations, including troubleshooting, data analysis, testing, research, statistical and survey purposes</li>
                                            <li>to improve our site to ensure that content is presented in the most effective manner for you and for your computer</li>
                                            <li>To allow you to participate in interactive features of our service, when you choose to do so</li>
                                            <li>As part of our efforts to keep our site safe and secure</li>
                                            <li>To measure or understand the effectiveness of advertising we serve to you and others, and to deliver relevant advertising to you</li>
                                            <li>To make suggestions and recommendations to you and other users of our site about goods or services that may interest you or them.</li>
                                          </ul>
                                        </li>
                                        <li><span class='font-bold'>Information we receive from other sources.</span> We may combine this information with information you give to us and information we collect about you. We may us this information and the combined information for the purposes set out above (depending on the types of information we receive).</li>
                                      </ol>
                                  </li>
                                  <li><label class='font-bold'>Disclosure of your information</label>
                                    <ol>
                                      <li>In connection with the above, we may share your personal information with any venue owner or promoter and/or any member of our group, which means our subsidiaries, our holding companies and its subsidiaries, and our affiliates.</li>
                                      <li>We may also share your information with selected third parties including our business partners, suppliers and sub-contractors for the performance of any contract we enter into with you.</li>
                                      <li>We may disclose your personal information to third parties:
                                        <ul class='a'>
                                          <li>In the event that we sell any business or assets, in which case we may disclose your personal data to the prospective buyer of such business or assets.</li>
                                          <li>If Asia Box Office Pte Ltd or substantially all of its assets are acquired by a third party, in which case personal data held by it about its customers will be one of the transferred assets.</li>
                                          <li>If we are under a duty to disclose or share your personal data in order to comply with any legal obligation, or in order to enforce or apply our <a href='/terms-of-website-use'>terms of use</a> or Terms and Conditions of <a href='/terms-of-ticket-sales'>Ticket Sales</a> and other agreements; or to protect the rights, property, or safety of Asia Box Office Pte Ltd, our customers, or others. This includes exchanging information with other companies and organisations for the purposes of fraud protection.</li>
                                        </ul>
                                      </li>
                                    </ol>
                                  </li>
                                  <li><label class='font-bold'>Where we store your personal data</label>
                                    <ol>
                                      <li>The data that we collect from you may be transferred to, and stored at, a destination outside Singapore. It may also be processed by staff operating outside Singapore who work for us or for one of our suppliers. Such staff maybe engaged in, among other things, the fulfilment of your order, the processing of your payment details and the provision of support services.</li>
                                      <li>By submitting your personal data, you agree to this transfer, storing or processing. We will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this privacy policy.</li>
                                      <li>Where we have given you (or where you have chosen) a password which enables you to access certain parts of our site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.</li>
                                      <li>Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data transmitted to our site; any transmission is at your own risk. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorised access.</li>
                                    </ol>
                                  </li>
                                  <li><label class='font-bold'>Your rights</label>
                                    <ol>
                                      <li>You have the right to ask us not to process your personal data for marketing purposes. We will usually inform you (before collecting your data) if we intend to use your data for such purposes or if we intend to disclose your information to any third party for such purposes. You can exercise your right to prevent such processing by checking certain boxes on the forms we use to collect your data.  You can also exercise the right at any time by contacting us at connect@asiaboxoffice.com.</li>
                                      <li>Our site may, from time to time, contain links to and from the websites of our partners, advertisers and affiliates.  If you follow a link to any of these websites, please note that these websites have their own privacy policies and that we do not accept any responsibility or liability for these policies.  Please check these policies before you submit any personal data to these websites.</li>
                                    </ol>
                                  </li>
                                  <li><label class='font-bold'>Access to information</label>
                                    <ol>
                                      <li>The Personal Data Protection Act 2012 of Singapore (the “Act”) gives you the right to access information held about you.</li>
                                      <li>Your right of access can be exercised in accordance with the Act.</li>
                                      <li>Any access request may be subject to an administrative fee to meet our costs in providing you with details of the information we hold about you.</li>
                                    </ol>
                                  </li>
                                  <li><label class='font-bold'>Changes to our privacy policy</label>
                                    <ol>
                                      <li>Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail. Please check back frequently to see any updates or changes to our privacy policy.</li>
                                    </ol>
                                  </li>
                                  <li><label class='font-bold'>Contact</label>
                                    <ol>
                                      <li>Questions, comments and requests regarding this privacy policy should be addressed to connect@asiaboxoffice.com.</li>
                                    </ol>
                                  </li>
                                </ol>
                              </li>
                            </ol>
                            <br>
                            <label class='update-terms'>Updated by Asia Box Office Legal Team on May 15, 2016</label>";
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = "<h5>Overview</h5>
                    <p>We, Asia Box Office Pte Ltd, are committed to protecting and respecting your privacy.</p>
                    <p>This policy (together with our <a href='/terms-of-website-use'>terms of use</a> and any other documents referred to on it) sets out the basis on which any personal data we collect from you, or that you provide to us, will be processed by us.  Please read the following carefully to understand our practices regarding your personal data and how we will treat it. By visiting www.asiaboxoffice.com (“our site”), you are accepting and consenting to the practices described in this policy. </p>
                    <h5>Privacy Policy</h5>
                    <ol>
                      <li><label class='font-bold'>Information we may collect from you</label><br>
                          We may collect and process the following data about you:
                        <ol class='a'>
                          <li><span class='font-bold'>Information you give us.</span> You may give us information about you by filling in forms on our site by corresponding with us by phone, e-mail or otherwise. This includes information you provide when you register to use our site, subscribe to our service, search for a ticket, place an order on our site, enter a competition, promotion or survey or when you report a problem with our site. The information you give us may include your name, address, e-mail address and phone number, financial and credit card information, image, photograph and personal description.</li>
                          <li><span class='font-bold'>Information we collect about you.</span> With regard to each of your visits to our site we may automatically collect the following information:
                            <ul>
                              <li>technical information, including the Internet protocol (IP) address used to connect your computer to the Internet, your login information, browser type and version, time zone setting, browser plug-in types and versions, operating system and platform; and</li>
                              <li>information about your visit, including the full Uniform Resource Locators (URL) clickstream to, through and from our site (including date and time); products you viewed or searched for; page response times, download errors, length of visits to certain pages, page interaction information (such as scrolling, clicks, and mouse-overs), and methods used to browse away from the page and any phone number used to call our customer service number.</li>
                            </ul>
                          </li>
                          <li><span class='font-bold'>Information we receive from other sources.</span> We may receive information about you if you use any of the other websites we operate or the other services we provide.  We are also working closely with third parties (including, for example, business partners, sub-contractors in technical, payment and delivery services, advertising networks, analytics providers, search information providers, credit reference agencies) and may receive information about you from them.</li>
                        </ol>
                          <li><label class='font-bold'>Uses made of the information</label><br>
                              We use information held about you in the following ways:
                              <ol class='a'>
                                <li><span class='font-bold'>Information you give to us.</span> We will use this information:
                                  <ul>
                                    <li>To carry out our obligations arising from any contracts entered into between you and us and to provide you with the information, products and services that you request from us</li>
                                    <li>To provide you with information about other goods and services we offer that are similar to those that you have already purchased or enquired about</li>
                                    <li>To notify you about changes to our service</li>
                                    <li>To ensure that content from our site is presented in the most effective manner for you and for your computer</li>
                                  </ul>
                                </li>
                                <li><span class='font-bold'>Information we collect about you.</span> We will use this information:
                                  <ul>
                                    <li>To administer our site and for internal operations, including troubleshooting, data analysis, testing, research, statistical and survey purposes</li>
                                    <li>to improve our site to ensure that content is presented in the most effective manner for you and for your computer</li>
                                    <li>To allow you to participate in interactive features of our service, when you choose to do so</li>
                                    <li>As part of our efforts to keep our site safe and secure</li>
                                    <li>To measure or understand the effectiveness of advertising we serve to you and others, and to deliver relevant advertising to you</li>
                                    <li>To make suggestions and recommendations to you and other users of our site about goods or services that may interest you or them.</li>
                                  </ul>
                                </li>
                                <li><span class='font-bold'>Information we receive from other sources.</span> We may combine this information with information you give to us and information we collect about you. We may us this information and the combined information for the purposes set out above (depending on the types of information we receive).</li>
                              </ol>
                          </li>
                          <li><label class='font-bold'>Disclosure of your information</label>
                            <ol>
                              <li>In connection with the above, we may share your personal information with any venue owner or promoter and/or any member of our group, which means our subsidiaries, our holding companies and its subsidiaries, and our affiliates.</li>
                              <li>We may also share your information with selected third parties including our business partners, suppliers and sub-contractors for the performance of any contract we enter into with you.</li>
                              <li>We may disclose your personal information to third parties:
                                <ul class='a'>
                                  <li>In the event that we sell any business or assets, in which case we may disclose your personal data to the prospective buyer of such business or assets.</li>
                                  <li>If Asia Box Office Pte Ltd or substantially all of its assets are acquired by a third party, in which case personal data held by it about its customers will be one of the transferred assets.</li>
                                  <li>If we are under a duty to disclose or share your personal data in order to comply with any legal obligation, or in order to enforce or apply our <a href='/terms-of-website-use'>terms of use</a> or Terms and Conditions of <a href='/terms-of-ticket-sales'>Ticket Sales</a> and other agreements; or to protect the rights, property, or safety of Asia Box Office Pte Ltd, our customers, or others. This includes exchanging information with other companies and organisations for the purposes of fraud protection.</li>
                                </ul>
                              </li>
                            </ol>
                          </li>
                          <li><label class='font-bold'>Where we store your personal data</label>
                            <ol>
                              <li>The data that we collect from you may be transferred to, and stored at, a destination outside Singapore. It may also be processed by staff operating outside Singapore who work for us or for one of our suppliers. Such staff maybe engaged in, among other things, the fulfilment of your order, the processing of your payment details and the provision of support services.</li>
                              <li>By submitting your personal data, you agree to this transfer, storing or processing. We will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this privacy policy.</li>
                              <li>Where we have given you (or where you have chosen) a password which enables you to access certain parts of our site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.</li>
                              <li>Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data transmitted to our site; any transmission is at your own risk. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorised access.</li>
                            </ol>
                          </li>
                          <li><label class='font-bold'>Your rights</label>
                            <ol>
                              <li>You have the right to ask us not to process your personal data for marketing purposes. We will usually inform you (before collecting your data) if we intend to use your data for such purposes or if we intend to disclose your information to any third party for such purposes. You can exercise your right to prevent such processing by checking certain boxes on the forms we use to collect your data.  You can also exercise the right at any time by contacting us at connect@asiaboxoffice.com.</li>
                              <li>Our site may, from time to time, contain links to and from the websites of our partners, advertisers and affiliates.  If you follow a link to any of these websites, please note that these websites have their own privacy policies and that we do not accept any responsibility or liability for these policies.  Please check these policies before you submit any personal data to these websites.</li>
                            </ol>
                          </li>
                          <li><label class='font-bold'>Access to information</label>
                            <ol>
                              <li>The Personal Data Protection Act 2012 of Singapore (the “Act”) gives you the right to access information held about you.</li>
                              <li>Your right of access can be exercised in accordance with the Act.</li>
                              <li>Any access request may be subject to an administrative fee to meet our costs in providing you with details of the information we hold about you.</li>
                            </ol>
                          </li>
                          <li><label class='font-bold'>Changes to our privacy policy</label>
                            <ol>
                              <li>Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail. Please check back frequently to see any updates or changes to our privacy policy.</li>
                            </ol>
                          </li>
                          <li><label class='font-bold'>Contact</label>
                            <ol>
                              <li>Questions, comments and requests regarding this privacy policy should be addressed to connect@asiaboxoffice.com.</li>
                            </ol>
                          </li>
                        </ol>
                      </li>
                    </ol>
                    <br>
                    <label class='update-terms'>Updated by Asia Box Office Legal Team on May 15, 2016</label>";
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'Career Page';
        $tixtrack->slug = 'careers';
        $tixtrack->content = 'desktop
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat laoreet eros, eget aliquet mi maximus eu. Donec nec blandit nisi. Aliquam volutpat eros id nibh congue elementum. Nam lectus quam, feugiat in faucibus orci luctus commodo ut, sollicitudin.</p>';
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = 'mobile';
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'Terms of Ticket Sales Page';
        $tixtrack->slug = 'terms-of-ticket-sales';
        $tixtrack->content = "<ol>
                              <li><label class='font-bold'>General</label>
                                <ol>
                                  <li>This website www.AsiaBoxOffice.com (“our site”) and the ticket booking facility on our site is owned by Asia Box Office Pte Ltd.</li>
                                  <li>These terms and conditions (together with the documents referred to herein) govern the sale and purchase of tickets from our site.</li>
                                  <li>You represent that you are of legal age to use our site and booking facility in accordance with these terms and conditions, and to create binding legal obligations for any liability you may incur as a result thereof.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Changes to these terms</label>
                                <ol>
                                  <li>We may revise these terms and conditions at any time by amending this page.
                                  </li>
                                  <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Purchasing tickets</label>
                                <ol>
                                  <li>All tickets to events are sold by us as agent for the respective event’s venue management or owner (collectively, “Venue Owner”) and/or promoter (“Promoter”).</li>
                                  <li>Tickets for any event may be subject to additional terms and conditions as the Venue Owner or Promoter may impose, provided that in the event of any inconsistency with these terms and conditions and those of the Venue Owner or Promoter, these terms and conditions shall prevail.</li>
                                  <li>Please refer to our <a href='/privacy-policy'>Privacy Policy</a> for more details on how we use and protect your personal information.</li>
                                  <li>You may need a username and password to access certain areas of our site, including the booking facility on our site. You are responsible for maintaining the security of your username and password and you are responsible for any action taken under your username or password.</li>
                                  <li>All ticket bookings are subject to availability and our acceptance.  We reserve the right to accept or reject any booking in whole or in part and we shall not be required to provide any reason for doing so.</li>
                                  <li>Ticket prices listed on our site are may be subject to good and services tax (“GST”).  You may be charged processing and other fees which will be displayed on screen, together with applicable GST, prior to your binding commitment to purchase being made.</li>
                                  <li>Full payment must be received and verified by us in order to guarantee that a ticket purchase transaction has occurred.</li>
                                  <li>A confirmation email receipt will be issued upon our acceptance of your order. If you do not receive a confirmation email, do not assume your order has not gone through; instead please contact us at tickets@asiaboxoffice.com to request another confirmation email. We are not responsible for any internet connection errors experienced while making an online booking. If you have not received an order confirmation email, it is your responsibility to contact our offices to verify your online booking before making another booking.</li>
                                  <li>Your confirmation email will include details of the tickets you have purchased, together with your name, address and delivery details. You must check these details carefully and let us know of any errors within [48 hours] of the date of the confirmation email. We are unable to deal with mistakes or errors that are notified to us after [48 hours] of the date of the confirmation email. Please note that failure to provide correct name, address and delivery details could lead to failed or refused delivery or your ability to collect tickets or ticket packages. If you fail to provide correct name, address and delivery details this is at your own risk and we take no responsibility and are not liable for your failure to gain access to events arising therefrom.</li>
                                  <li>Upon acceptance of your order, no exchange or refund of any ticket will be made under any circumstances, save as expressly permitted under these terms and conditions.</li>
                                  <li>While we try and ensure that all listings on our site are accurate, technical errors may occur. If we discover that an error has occurred which has resulted in an erroneous order confirmation, we will inform you as soon as possible.  Further, we reserve the right to cancel your order under such circumstances. Where it is possible we will give you the option of reconfirming your order with the correct details or cancelling your order for a full refund. If we are unable to contact you, you agree that we may treat the order as cancelled without any liability to us.</li>
                                  <li>Anyone seeking to obtain a student or senior citizen discount (or such other discount as may be applicable) on the purchase price of his ticket must provide us with such supporting identification or other documents as we may deem necessary, including any student and/or senior citizen passes.  Such documents must be produced at the time of booking the ticket and/or prior to event entry.</li>
                                  <li>The resale of tickets purchased from our site is strictly prohibited.  We reserve the right to cancel any ticket that has been so resold and to deny any such ticket holder entry to the event.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Collection of tickets</label>
                                <ol>
                                  <li>Unless you have chosen to have your tickets delivered to you, you are required to collect your tickets within such time periods stipulated under the chosen collection method.</li>
                                  <li>In the event that you fail to collect any of your ticket(s) within the prescribed time frame, you will not be entitled to receive such ticket(s) or receive any refund for any such uncollected ticket(s).</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Changes/cancellation of events</label>
                                <ol>
                                  <li>Events are sometimes re-scheduled, postponed or cancelled completely.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Entry to events</label>
                                <ol>
                                  <li>Entry to any event may be subject to, and regulated by such terms and conditions as may be specified by the event’s Venue Owner and/or the Promoter.  A ticket holder may be denied entry to an event if the ticket holder does not comply with any such terms and conditions.</li>
                                  <li>Without limiting the above:
                                    <ul class='a'>
                                      <li>entry to an event may be denied if a ticket has not been purchased from us or other authorised points of sale;</li>
                                      <li>infants in arms or children below the admission age stated in publicity materials who hold valid tickets to an event will be denied entry;</li>
                                      <li>latecomers may be denied entry until a break or intermission during the event as we may deem appropriate;</li>
                                      <li>entry to an event may be subject to venue’s prevailing terms and conditions of entry; and</li>
                                      <li>entry to an event may be subject to age restrictions as may be prescribed by the Venue Owner, the Promoter or by law.</li>
                                    </ul>
                                  </li>
                                  <li>No photography, audio or video recording is allowed during any event unless otherwise stated by the Venue Owner or the Promoter.</li>
                                  <li>Each ticket holder agrees to submit to any search, whether prior to entry to, or during, an event, for any prohibited items including but not limited to weapons, controlled, dangerous and illegal substances and recording devices. The Venue Owner and the Promoter reserve the right to refuse admission to or evict any person from an event if any prohibited items is found.</li>
                                  <li>The Venue Owner and the Promoter reserve the right to refuse entry to and/or evict any person from an event if there is any breach by that person of these terms and conditions or if in the Venue Owner or Promoter’s opinion, that person’s conduct is disorderly or inappropriate, or poses a threat to security or to others’ enjoyment of the event.</li>
                                  <li>Where any person has been refused entry to, or has been evicted from, an event under these terms and conditions, such person shall not be entitled to any refund for his or her ticket or any compensation whatsoever.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Other rights</label>
                                <ol>
                                  <li>The Promoter for an event may add, withdraw or substitute artistes and/or vary advertised programmes, event timing, event duration, seating arrangements and audience capacity without prior notice.</li>
                                  <li>The Venue Owner and/or the Promoter for an event may postpone, cancel, interrupt or stop the event due to adverse weather, security reasons or any other causes beyond their control.</li>
                                  <li>We shall be entitled to collect, use and disclose, and we shall be entitled to disclose to an event’s Promoter and/or Venue Owner for their use, any of your or a ticket holder’s personal data for the purpose of:
                                    <ul class='a'>
                                      <li>ticket processing;</li>
                                      <li>event organisation;</li>
                                      <li>event promotion and marketing;</li>
                                      <li>carrying out any billing, cancellation, postponement and/or refund; and</li>
                                      <li>other purposes that may be relevant, or incidental to the foregoing, including contacting you to provide updates about the event.</li>
                                    </ul>
                                  </li>
                                  <li>Together with the Venue Owner and the Promoter, we or any of us may use a ticket holder's image or likeness in any live or recorded video display, photograph, picture or publicity material or website.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Liability of liability</label>
                                <ol>
                                  <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                                  <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our booking facility or any content on it, whether express or implied.</li>
                                  <li>We will not be liable to anyone for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                                    <ul class='a'>
                                      <li>use of, or inability to use, our booking facility; or</li>
                                      <li>use of or reliance on any content displayed on our booking facility.</li>
                                    </ul>
                                  </li>
                                  <li>Without limiting the above, we will not be liable to anyone for:
                                    <ul class='a'>
                                      <li>loss of profits, sales, business, or revenue;</li>
                                      <li>business interruption;</li>
                                      <li>loss of anticipated savings;</li>
                                      <li>loss of business opportunity, goodwill or reputation; or</li>
                                      <li>any indirect or consequential loss or damage.</li>
                                    </ul>
                                  </li>
                                  <li>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of our booking facility or to your downloading of any content on it, or on any website linked to it.</li>
                                  <li>We assume no responsibility for the content of websites linked on our booking facility. Such links should not be interpreted as endorsement by us of those linked websites. We will not be liable for any loss or damage that may arise from your use of them.</li>
                                  <li>We will take all reasonable measures to ensure that information you transmit to us using our booking facility will remain confidential and protected from unauthorised access but we do not warrant against unauthorised access and will not be liable for any unauthorised access by any means to that information.</li>
                                </ol>
                              </li>
                              <li><label class='font-bold'>Applicable law</label>
                                <ol>
                                  <li>These terms and conditions are governed by Singapore law.</li>
                                  <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                                </ol>
                              </li>
                            </ol>
                            <br>
                            <label class='update-terms'>Updated by Asia Box Office Legal Team on May 15, 2016.</label>";
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = "<ol>
                      <li><label class='font-bold'>General</label>
                        <ol>
                          <li>This website www.AsiaBoxOffice.com (“our site”) and the ticket booking facility on our site is owned by Asia Box Office Pte Ltd.</li>
                          <li>These terms and conditions (together with the documents referred to herein) govern the sale and purchase of tickets from our site.</li>
                          <li>You represent that you are of legal age to use our site and booking facility in accordance with these terms and conditions, and to create binding legal obligations for any liability you may incur as a result thereof.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Changes to these terms</label>
                        <ol>
                          <li>We may revise these terms and conditions at any time by amending this page.
                          </li>
                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Purchasing tickets</label>
                        <ol>
                          <li>All tickets to events are sold by us as agent for the respective event’s venue management or owner (collectively, “Venue Owner”) and/or promoter (“Promoter”).</li>
                          <li>Tickets for any event may be subject to additional terms and conditions as the Venue Owner or Promoter may impose, provided that in the event of any inconsistency with these terms and conditions and those of the Venue Owner or Promoter, these terms and conditions shall prevail.</li>
                          <li>Please refer to our <a href='/privacy-policy'>Privacy Policy</a> for more details on how we use and protect your personal information.</li>
                          <li>You may need a username and password to access certain areas of our site, including the booking facility on our site. You are responsible for maintaining the security of your username and password and you are responsible for any action taken under your username or password.</li>
                          <li>All ticket bookings are subject to availability and our acceptance.  We reserve the right to accept or reject any booking in whole or in part and we shall not be required to provide any reason for doing so.</li>
                          <li>Ticket prices listed on our site are may be subject to good and services tax (“GST”).  You may be charged processing and other fees which will be displayed on screen, together with applicable GST, prior to your binding commitment to purchase being made.</li>
                          <li>Full payment must be received and verified by us in order to guarantee that a ticket purchase transaction has occurred.</li>
                          <li>A confirmation email receipt will be issued upon our acceptance of your order. If you do not receive a confirmation email, do not assume your order has not gone through; instead please contact us at tickets@asiaboxoffice.com to request another confirmation email. We are not responsible for any internet connection errors experienced while making an online booking. If you have not received an order confirmation email, it is your responsibility to contact our offices to verify your online booking before making another booking.</li>
                          <li>Your confirmation email will include details of the tickets you have purchased, together with your name, address and delivery details. You must check these details carefully and let us know of any errors within [48 hours] of the date of the confirmation email. We are unable to deal with mistakes or errors that are notified to us after [48 hours] of the date of the confirmation email. Please note that failure to provide correct name, address and delivery details could lead to failed or refused delivery or your ability to collect tickets or ticket packages. If you fail to provide correct name, address and delivery details this is at your own risk and we take no responsibility and are not liable for your failure to gain access to events arising therefrom.</li>
                          <li>Upon acceptance of your order, no exchange or refund of any ticket will be made under any circumstances, save as expressly permitted under these terms and conditions.</li>
                          <li>While we try and ensure that all listings on our site are accurate, technical errors may occur. If we discover that an error has occurred which has resulted in an erroneous order confirmation, we will inform you as soon as possible.  Further, we reserve the right to cancel your order under such circumstances. Where it is possible we will give you the option of reconfirming your order with the correct details or cancelling your order for a full refund. If we are unable to contact you, you agree that we may treat the order as cancelled without any liability to us.</li>
                          <li>Anyone seeking to obtain a student or senior citizen discount (or such other discount as may be applicable) on the purchase price of his ticket must provide us with such supporting identification or other documents as we may deem necessary, including any student and/or senior citizen passes.  Such documents must be produced at the time of booking the ticket and/or prior to event entry.</li>
                          <li>The resale of tickets purchased from our site is strictly prohibited.  We reserve the right to cancel any ticket that has been so resold and to deny any such ticket holder entry to the event.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Collection of tickets</label>
                        <ol>
                          <li>Unless you have chosen to have your tickets delivered to you, you are required to collect your tickets within such time periods stipulated under the chosen collection method.</li>
                          <li>In the event that you fail to collect any of your ticket(s) within the prescribed time frame, you will not be entitled to receive such ticket(s) or receive any refund for any such uncollected ticket(s).</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Changes/cancellation of events</label>
                        <ol>
                          <li>Events are sometimes re-scheduled, postponed or cancelled completely.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Entry to events</label>
                        <ol>
                          <li>Entry to any event may be subject to, and regulated by such terms and conditions as may be specified by the event’s Venue Owner and/or the Promoter.  A ticket holder may be denied entry to an event if the ticket holder does not comply with any such terms and conditions.</li>
                          <li>Without limiting the above:
                            <ul class='a'>
                              <li>entry to an event may be denied if a ticket has not been purchased from us or other authorised points of sale;</li>
                              <li>infants in arms or children below the admission age stated in publicity materials who hold valid tickets to an event will be denied entry;</li>
                              <li>latecomers may be denied entry until a break or intermission during the event as we may deem appropriate;</li>
                              <li>entry to an event may be subject to venue’s prevailing terms and conditions of entry; and</li>
                              <li>entry to an event may be subject to age restrictions as may be prescribed by the Venue Owner, the Promoter or by law.</li>
                            </ul>
                          </li>
                          <li>No photography, audio or video recording is allowed during any event unless otherwise stated by the Venue Owner or the Promoter.</li>
                          <li>Each ticket holder agrees to submit to any search, whether prior to entry to, or during, an event, for any prohibited items including but not limited to weapons, controlled, dangerous and illegal substances and recording devices. The Venue Owner and the Promoter reserve the right to refuse admission to or evict any person from an event if any prohibited items is found.</li>
                          <li>The Venue Owner and the Promoter reserve the right to refuse entry to and/or evict any person from an event if there is any breach by that person of these terms and conditions or if in the Venue Owner or Promoter’s opinion, that person’s conduct is disorderly or inappropriate, or poses a threat to security or to others’ enjoyment of the event.</li>
                          <li>Where any person has been refused entry to, or has been evicted from, an event under these terms and conditions, such person shall not be entitled to any refund for his or her ticket or any compensation whatsoever.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Other rights</label>
                        <ol>
                          <li>The Promoter for an event may add, withdraw or substitute artistes and/or vary advertised programmes, event timing, event duration, seating arrangements and audience capacity without prior notice.</li>
                          <li>The Venue Owner and/or the Promoter for an event may postpone, cancel, interrupt or stop the event due to adverse weather, security reasons or any other causes beyond their control.</li>
                          <li>We shall be entitled to collect, use and disclose, and we shall be entitled to disclose to an event’s Promoter and/or Venue Owner for their use, any of your or a ticket holder’s personal data for the purpose of:
                            <ul class='a'>
                              <li>ticket processing;</li>
                              <li>event organisation;</li>
                              <li>event promotion and marketing;</li>
                              <li>carrying out any billing, cancellation, postponement and/or refund; and</li>
                              <li>other purposes that may be relevant, or incidental to the foregoing, including contacting you to provide updates about the event.</li>
                            </ul>
                          </li>
                          <li>Together with the Venue Owner and the Promoter, we or any of us may use a ticket holder's image or likeness in any live or recorded video display, photograph, picture or publicity material or website.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Liability of liability</label>
                        <ol>
                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our booking facility or any content on it, whether express or implied.</li>
                          <li>We will not be liable to anyone for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                            <ul class='a'>
                              <li>use of, or inability to use, our booking facility; or</li>
                              <li>use of or reliance on any content displayed on our booking facility.</li>
                            </ul>
                          </li>
                          <li>Without limiting the above, we will not be liable to anyone for:
                            <ul class='a'>
                              <li>loss of profits, sales, business, or revenue;</li>
                              <li>business interruption;</li>
                              <li>loss of anticipated savings;</li>
                              <li>loss of business opportunity, goodwill or reputation; or</li>
                              <li>any indirect or consequential loss or damage.</li>
                            </ul>
                          </li>
                          <li>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of our booking facility or to your downloading of any content on it, or on any website linked to it.</li>
                          <li>We assume no responsibility for the content of websites linked on our booking facility. Such links should not be interpreted as endorsement by us of those linked websites. We will not be liable for any loss or damage that may arise from your use of them.</li>
                          <li>We will take all reasonable measures to ensure that information you transmit to us using our booking facility will remain confidential and protected from unauthorised access but we do not warrant against unauthorised access and will not be liable for any unauthorised access by any means to that information.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Applicable law</label>
                        <ol>
                          <li>These terms and conditions are governed by Singapore law.</li>
                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                        </ol>
                      </li>
                    </ol>
                    <br>
                    <label class='update-terms'>Updated by Asia Box Office Legal Team on May 15, 2016.</label>";
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'Terms of Website Use Page';
        $tixtrack->slug = 'terms-of-website-use';
        $tixtrack->content = "<h5>PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY BEFORE USING THIS SITE</h5>
                                    <ol>
                                      <li><label class='font-bold'>Terms of website use</label>
                                        <ol>
                                          <li>This website www.asiaboxoffice.com (<span class='font-bold'>“our site”</span>) is owned by Asia Box Office Pte Ltd.</li>
                                          <li>These terms and conditions (together with the documents referred to herein) (<span class='font-bold'>“terms of use”</span>) govern your use of our site, whether as a guest or a registered user. Use of our site includes accessing, browsing, or registering to use our site.</li>
                                          <li>Please read these terms of use carefully before you start to use our site, as these will apply to your use of our site.</li>
                                          <li>By using our site, you confirm that you accept these terms of use and that you agree to comply with them.</li>
                                          <li>If you do not agree to these terms of use, you must not use our site.</li>
                                          <li>You represent that you are of legal age to use our site in accordance with these terms of use and to create binding legal obligations for any liability you may incur as a result of the use of our site.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Other applicable terms</label>
                                        <ol>
                                          <li>These terms of use include the following additional terms, which also apply to your use of our site:
                                            <ul class='a'>
                                              <li>Our <a href='/privacy-policy'>Privacy Policy</a>, which sets out the terms on which we process any personal data we collect from you, or that you provide to us. By using our site, you consent to such processing and you warrant that all data provided by you is accurate.</li>
                                            </ul>
                                          </li>
                                          <li>If you purchase tickets from our site, our Terms and Conditions of <a href='/terms-of-ticket-sales'>Ticket Sales</a> will apply to the sale and purchase. </li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Changes to these terms</label>
                                        <ol>
                                          <li>We may revise these terms of use at any time by amending this page.</li>
                                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Changes to our site</label>
                                        <ol>
                                          <li>We may update our site from time to time, and may change the content at any time. However, please note that any of the content on our site may be out of date at any given time, and we are under no obligation to update it.</li>
                                          <li>We do not guarantee that our site, or any content on it, will be free from errors or omissions.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Accessing our site</label>
                                        <ol>
                                          <li>Our site is made available free of charge.</li>
                                          <li>We do not guarantee that our site, or any content on it, will always be available or be uninterrupted. Access to our site is permitted on a temporary basis. We may suspend, withdraw, discontinue or change all or any part of our site without notice. We will not be liable to you if for any reason our site is unavailable at any time or for any period.</li>
                                          <li>You are responsible for making all arrangements necessary for you to have access to our site.</li>
                                          <li>You are also responsible for ensuring that all persons who access our site through your internet connection are aware of these terms of use and other applicable terms and conditions, and that they comply with them.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Your account and password</label>
                                        <ol>
                                          <li>If you choose, or you are provided with, a user identification code, password or any other piece of information as part of our security procedures, you must treat such information as confidential. You must not disclose it to any third party.</li>
                                          <li>We have the right to disable any user identification code or password, whether chosen by you or allocated by us, at any time, if in our reasonable opinion you have failed to comply with any of the provisions of these terms of use.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Intellectual property rights</label>
                                        <ol>
                                          <li>We are the owner or the licensee of all intellectual property rights in our site, and in the material published on it.  Those works are protected by copyright and other intellectual property laws. All such rights are reserved.</li>
                                          <li>You may print one copy, and may download extracts, of any page(s) from our site for your personal use.</li>
                                          <li>You must not modify the paper or digital copies of any materials you have printed off or downloaded in any way, and you must not use any illustrations, photographs, video or audio sequences or any graphics separately from any accompanying text.</li>
                                          <li>Our status (and that of any identified contributors) as the authors of content on our site must always be acknowledged.</li>
                                          <li>You must not use any part of the content on our site for commercial purposes without obtaining a licence to do so from us or our licensors.</li>
                                          <li>If you print, copy or download any part of our site in breach of these terms of use, your right to use our site will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>No reliance on information</label>
                                        <ol>
                                          <li>The content on our site is provided “as is”.</li>
                                          <li>Although we make reasonable efforts to update the information on our site, we make no representations, warranties or guarantees, whether express or implied, that the content on our site is accurate, complete or up-to-date.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Limitation of our liability</label>
                                        <ol>
                                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our site or any content on it, whether express or implied.</li>
                                          <li>We will not be liable to any user for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                                            <ul class='a'>
                                              <li>use of, or inability to use, our site; or</li>
                                              <li>use of or reliance on any content displayed on our site.</li>
                                            </ul>
                                          </li>
                                          <li>Without limiting the above, we will not be liable to anyone for:
                                            <ul class='a'>
                                              <li>loss of profits, sales, business, or revenue;</li>
                                              <li>business interruption;</li>
                                              <li>loss of anticipated savings;</li>
                                              <li>loss of business opportunity, goodwill or reputation; or</li>
                                              <li>any indirect or consequential loss or damage.</li>
                                            </ul>
                                          </li>
                                          <li>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of our site or to your downloading of any content on it, or on any website linked to it.</li>
                                          <li>We assume no responsibility for the content of websites linked on our site. Such links should not be interpreted as endorsement by us of those linked websites. We will not be liable for any loss or damage that may arise from your use of them.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Viruses</label>
                                        <ol>
                                          <li>We do not guarantee that our site will be secure or free from bugs or viruses.</li>
                                          <li>You are responsible for configuring your information technology, computer programmes and platform in order to access our site. You should use your own virus protection software.</li>
                                          <li>You must not misuse our site by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful. You must not attempt to gain unauthorised access to our site, the server on which our site is stored or any server, computer or database connected to our site. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our site will cease immediately.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Linking to our site</label>
                                        <ol>
                                          <li>You may link to our home page, provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it.</li>
                                          <li>You must not establish a link in such a way as to suggest any form of association, approval or endorsement on our part where none exists.</li>
                                          <li>You must not establish a link to our site in any website that is not owned by you.</li>
                                          <li>Our site must not be framed on any other site, nor may you create a link to any part of our site other than the home page.</li>
                                          <li>We reserve the right to withdraw linking permission without notice.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Third party links and resources in our site</label>
                                        <ol>
                                          <li>Where our site contains links to other sites and resources provided by third parties, these links are provided for your information only.</li>
                                          <li>We have no control over the contents of those sites or resources.</li>
                                        </ol>
                                      </li>
                                      <li><label class='font-bold'>Applicable law</label>
                                        <ol>
                                          <li>These terms of use are governed by Singapore law.</li>
                                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                                        </ol>
                                      </li>
                                    </ol>
                                    <br>
                                    <label class='update-terms'>Updated by Asia Box Office Legal Team on May 15, 2016</label>";
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = "<h5>PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY BEFORE USING THIS SITE</h5>
                    <ol>
                      <li><label class='font-bold'>Terms of website use</label>
                        <ol class='sub-ol'>
                          <li>This website www.asiaboxoffice.com (<span class='font-bold'>“our site”</span>) is owned by Asia Box Office Pte Ltd.</li>
                          <li>These terms and conditions (together with the documents referred to herein) (<span class='font-bold'>“terms of use”</span>) govern your use of our site, whether as a guest or a registered user. Use of our site includes accessing, browsing, or registering to use our site.</li>
                          <li>Please read these terms of use carefully before you start to use our site, as these will apply to your use of our site.</li>
                          <li>By using our site, you confirm that you accept these terms of use and that you agree to comply with them.</li>
                          <li>If you do not agree to these terms of use, you must not use our site.</li>
                          <li>You represent that you are of legal age to use our site in accordance with these terms of use and to create binding legal obligations for any liability you may incur as a result of the use of our site.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Other applicable terms</label>
                        <ol>
                          <li>These terms of use include the following additional terms, which also apply to your use of our site:
                            <ul class='a'>
                              <li>Our <a href='/privacy-policy'>Privacy Policy</a>, which sets out the terms on which we process any personal data we collect from you, or that you provide to us. By using our site, you consent to such processing and you warrant that all data provided by you is accurate.</li>
                            </ul>
                          </li>
                          <li>If you purchase tickets from our site, our Terms and Conditions of <a href='/terms-of-ticket-sales'>Ticket Sales</a> will apply to the sale and purchase. </li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Changes to these terms</label>
                        <ol>
                          <li>We may revise these terms of use at any time by amending this page.</li>
                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Changes to our site</label>
                        <ol>
                          <li>We may update our site from time to time, and may change the content at any time. However, please note that any of the content on our site may be out of date at any given time, and we are under no obligation to update it.</li>
                          <li>We do not guarantee that our site, or any content on it, will be free from errors or omissions.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Accessing our site</label>
                        <ol>
                          <li>Our site is made available free of charge.</li>
                          <li>We do not guarantee that our site, or any content on it, will always be available or be uninterrupted. Access to our site is permitted on a temporary basis. We may suspend, withdraw, discontinue or change all or any part of our site without notice. We will not be liable to you if for any reason our site is unavailable at any time or for any period.</li>
                          <li>You are responsible for making all arrangements necessary for you to have access to our site.</li>
                          <li>You are also responsible for ensuring that all persons who access our site through your internet connection are aware of these terms of use and other applicable terms and conditions, and that they comply with them.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Your account and password</label>
                        <ol>
                          <li>If you choose, or you are provided with, a user identification code, password or any other piece of information as part of our security procedures, you must treat such information as confidential. You must not disclose it to any third party.</li>
                          <li>We have the right to disable any user identification code or password, whether chosen by you or allocated by us, at any time, if in our reasonable opinion you have failed to comply with any of the provisions of these terms of use.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Intellectual property rights</label>
                        <ol>
                          <li>We are the owner or the licensee of all intellectual property rights in our site, and in the material published on it.  Those works are protected by copyright and other intellectual property laws. All such rights are reserved.</li>
                          <li>You may print one copy, and may download extracts, of any page(s) from our site for your personal use.</li>
                          <li>You must not modify the paper or digital copies of any materials you have printed off or downloaded in any way, and you must not use any illustrations, photographs, video or audio sequences or any graphics separately from any accompanying text.</li>
                          <li>Our status (and that of any identified contributors) as the authors of content on our site must always be acknowledged.</li>
                          <li>You must not use any part of the content on our site for commercial purposes without obtaining a licence to do so from us or our licensors.</li>
                          <li>If you print, copy or download any part of our site in breach of these terms of use, your right to use our site will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>No reliance on information</label>
                        <ol>
                          <li>The content on our site is provided “as is”.</li>
                          <li>Although we make reasonable efforts to update the information on our site, we make no representations, warranties or guarantees, whether express or implied, that the content on our site is accurate, complete or up-to-date.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Limitation of our liability</label>
                        <ol>
                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our site or any content on it, whether express or implied.</li>
                          <li>We will not be liable to any user for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                            <ul class='a'>
                              <li>use of, or inability to use, our site; or</li>
                              <li>use of or reliance on any content displayed on our site.</li>
                            </ul>
                          </li>
                          <li>Without limiting the above, we will not be liable to anyone for:
                            <ul class='a'>
                              <li>loss of profits, sales, business, or revenue;</li>
                              <li>business interruption;</li>
                              <li>loss of anticipated savings;</li>
                              <li>loss of business opportunity, goodwill or reputation; or</li>
                              <li>any indirect or consequential loss or damage.</li>
                            </ul>
                          </li>
                          <li>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of our site or to your downloading of any content on it, or on any website linked to it.</li>
                          <li>We assume no responsibility for the content of websites linked on our site. Such links should not be interpreted as endorsement by us of those linked websites. We will not be liable for any loss or damage that may arise from your use of them.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Viruses</label>
                        <ol>
                          <li>We do not guarantee that our site will be secure or free from bugs or viruses.</li>
                          <li>You are responsible for configuring your information technology, computer programmes and platform in order to access our site. You should use your own virus protection software.</li>
                          <li>You must not misuse our site by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful. You must not attempt to gain unauthorised access to our site, the server on which our site is stored or any server, computer or database connected to our site. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our site will cease immediately.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Linking to our site</label>
                        <ol>
                          <li>You may link to our home page, provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it.</li>
                          <li>You must not establish a link in such a way as to suggest any form of association, approval or endorsement on our part where none exists.</li>
                          <li>You must not establish a link to our site in any website that is not owned by you.</li>
                          <li>Our site must not be framed on any other site, nor may you create a link to any part of our site other than the home page.</li>
                          <li>We reserve the right to withdraw linking permission without notice.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Third party links and resources in our site</label>
                        <ol>
                          <li>Where our site contains links to other sites and resources provided by third parties, these links are provided for your information only.</li>
                          <li>We have no control over the contents of those sites or resources.</li>
                        </ol>
                      </li>
                      <li><label class='font-bold'>Applicable law</label>
                        <ol>
                          <li>These terms of use are governed by Singapore law.</li>
                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                        </ol>
                      </li>
                    </ol>
                    <br>
                    <label class='update-terms'>Updated by Asia Box Office Legal Team on May 15, 2016</label>";
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'How to Buy Tickets Page';
        $tixtrack->slug = 'how-to-buy-tickets';
        $tixtrack->content = '<div class="tabbable tabs-left list-faq">
                                    <div class="tab-content tab-ticket col-md-8">
                                        <div class="tab-pane active" id="topquestion">
                                       
                                            <ul class="ul-faq-content ul-ticket-content">
                                                <li>
                                                    <div class="circle-ticket step1-ticket">
                                                        <label>1</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapseone" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Select Event & Tickets</a>
                                                    <div class="collapse" id="collapseone">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Select the date of event you would like to attend.</li>
                                                            <li>Enter your promo code to unlock the discounted ticket price (hint: check on the event webpage for details of any current promotions).</li>
                                                            <li>Indicate the quantity of ticket or if this is a reserved seating event, choose your preferred seat .</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="circle-ticket step2-ticket">
                                                        <label>2</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapsetwo" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Make Payment</a>
                                                    <div class="collapse" id="collapsetwo">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Review your ticket selection and subtotal amount on the order summary page before proceeding to checkout.</li>
                                                            <li>The standard ticket delivery method is E-Ticket (Print at Home) and is free of charge. If there is physical ticket for this event, you can request for this by selecting Mail on the dropdown option with an additional $3 delivery fee (for Singapore addresses only).</li>
                                                            <li>Ensure that you have your details entered correctly as we will be sending you an Order Confirmation and/or E-Ticket to your email.</li>
                                                            <li>Complete your payment details by entering your credit card information or via Visa Checkout (https://secure.checkout.visa.com/customer_support/faq?locale=en).</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="circle-ticket step3-ticket">
                                                        <label>3</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapsethree" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Receive Your Tickets</a>
                                                    <div class="collapse" id="collapsethree">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Upon a successful purchase, you will receive an order confirmation number for your reference.</li>
                                                            <li>Your Order Confirmation and/or E-Ticket will be sent to you on email.</li>
                                                            <li>If you have selected for physical ticket, we will be in contact to update on the mailing status.</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="circle-ticket step4-ticket">
                                                        <label>4</label>
                                                    </div>
                                                    <a data-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Attend and Enjoy Your Event</a>
                                                    <div class="collapse" id="collapsefour">
                                                        <ol class="ul-inside ol-ticket">
                                                            <li>Go green and go light on the event day by saving your E-Ticket on your mobile for us to scan you in. Alternatively, you can also bring along your E-Ticket printout.</li>
                                                            <li>If you have selected for physical ticket, please remember to have it with you when you come for the event.</li>
                                                        </ol>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = '<div class="tabbable tabs-left list-faq">
                    <div class="tab-content tab-ticket col-md-8">
                        <div class="tab-pane active" id="topquestion">
                       
                            <ul class="ul-faq-content ul-ticket-content">
                                <li>
                                    <div class="circle-ticket step1-ticket">
                                        <label>1</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapseone-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Select Event & Tickets</a>
                                    <div class="collapse" id="collapseone-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Select the date of event you would like to attend.</li>
                                            <li>Enter your promo code to unlock the discounted ticket price (hint: check on the event webpage for details of any current promotions).</li>
                                            <li>Indicate the quantity of ticket or if this is a reserved seating event, choose your preferred seat .</li>
                                        </ol>
                                    </div>
                                </li>
                                <li>
                                    <div class="circle-ticket step2-ticket">
                                        <label>2</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapsetwo-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Make Payment</a>
                                    <div class="collapse" id="collapsetwo-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Review your ticket selection and subtotal amount on the order summary page before proceeding to checkout.</li>
                                            <li>The standard ticket delivery method is E-Ticket (Print at Home) and is free of charge. If there is physical ticket for this event, you can request for this by selecting Mail on the dropdown option with an additional $3 delivery fee (for Singapore addresses only).</li>
                                            <li>Ensure that you have your details entered correctly as we will be sending you an Order Confirmation and/or E-Ticket to your email.</li>
                                            <li>Complete your payment details by entering your credit card information or via Visa Checkout (https://secure.checkout.visa.com/customer_support/faq?locale=en).</li>
                                        </ol>
                                    </div>
                                </li>
                                <li>
                                    <div class="circle-ticket step3-ticket">
                                        <label>3</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapsethree-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Receive Your Tickets</a>
                                    <div class="collapse" id="collapsethree-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Upon a successful purchase, you will receive an order confirmation number for your reference.</li>
                                            <li>Your Order Confirmation and/or E-Ticket will be sent to you on email.</li>
                                            <li>If you have selected for physical ticket, we will be in contact to update on the mailing status.</li>
                                        </ol>
                                    </div>
                                </li>
                                <li>
                                    <div class="circle-ticket step4-ticket">
                                        <label>4</label>
                                    </div>
                                    <a data-toggle="collapse" href="#collapsefour-mobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed font-light">Attend and Enjoy Your Event</a>
                                    <div class="collapse" id="collapsefour-mobile">
                                        <ol class="ul-inside ol-ticket">
                                            <li>Go green and go light on the event day by saving your E-Ticket on your mobile for us to scan you in. Alternatively, you can also bring along your E-Ticket printout.</li>
                                            <li>If you have selected for physical ticket, please remember to have it with you when you come for the event.</li>
                                        </ol>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>';
        $tixtrack->save();

        $tixtrack = new ManagePage();
        $tixtrack->user_id = 1;
        $tixtrack->title = 'FAQ Page';
        $tixtrack->slug = 'faq';
        $tixtrack->content = '<div class="tabbable tabs-left list-faq">
                                    <ul class="nav nav-tabs col-md-4">
                                        <li class="top-faq active"><a href="#topquestion" data-toggle="tab">Top Questions</a></li>
                                        <li class="general-faq"><a href="#general" data-toggle="tab">General</a></li>
                                        <!-- <li class="account-faq"><a href="#account" data-toggle="tab">My Account</a></li> -->
                                        <li class="seat-faq"><a href="#seatallocation" data-toggle="tab">Seat Allocation</a></li>
                                        <li class="payment-faq"><a href="#payment" data-toggle="tab">Payment</a></li>
                                        <!-- <li class="collection-faq"><a href="#collection" data-toggle="tab">Collection</a></li> -->
                                    </ul>
                                    <div class="tab-content col-md-8">
                                        <div class="tab-pane active" id="topquestion">
                                            <h3 class="font-light">Top Questions</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseone" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What should I do if my tickets are lost?</a>
                                                    <div class="collapse" id="collapseone">
                                                        <p>Please contact us at +65 6733 0360 and have ready the following to get a replacement ticket issued with a new barcode:</p>
                                                        <ul class="ul-inside">
                                                            <li>Order Confirmation Number</li>
                                                            <li>Name</li>
                                                            <li>Contact Number</li>
                                                        </ul>
                                                        <p>A service fee of $5 per ticket reprint, in addition to the standard ticket delivery costs (if applicable), will be applicable for this change.</p>
                                                        <p>General Admission tickets cannot be replaced.
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwo" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What happens if an event is cancelled?</a>
                                                    <div class="collapse" id="collapsetwo">
                                                        <p>Cancellation policies are event specific and will be communicated by the show organiser. Given that refunds are offered, procedures will be provided on the event page and major media channels.</p>

                                                        <p>Given that refunds are offered, funds will be automatically returned into the same credit card you used to make the purchase.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsethree" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How long does it take for my tickets to be delivered?</a>
                                                    <div class="collapse" id="collapsethree">
                                                        <p>Tickets will be dispatched 1 month before the date of event. If you did not receive your tickets, please contact us at +65 6733 0360.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefour" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Does my child require a ticket?</a>
                                                    <div class="collapse" id="collapsefour">
                                                        <p>Admission rules vary between events. Please refer to the specific event page for information.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefive" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is a Booking Fee?</a>
                                                    <div class="collapse" id="collapsefive">
                                                        <p>It is a worldwide standard practice by ticketing services company to support investment in systems technology and to improve the online purchase experience.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="general">
                                            <h3 class="font-light">General</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseoneGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I reserve my tickets online?</a>
                                                    <div class="collapse" id="collapseoneGeneral">
                                                        <p>All transactions must be completed along with full payment at the time of booking.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwoGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I bring cameras and/or video cameras into the venue?</a>
                                                    <div class="collapse" id="collapsetwoGeneral">
                                                        <p>There are restrictions/limitations on items you can bring into each venue. Please refer to the event page for admission rules and regulations to the specific venue.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsethreeGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I buy tickets from unauthorised ticket vendors?</a>
                                                    <div class="collapse" id="collapsethreeGeneral">
                                                        <p>Tickets purchased from unauthorised ticket vendors come with high uncertainty of the sources. As such, they could lost/stolen tickets or duplicated tickets, which will be identified on site once scanned and denied entry.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefourGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What if I do not live in Singapore and/or do not have a local address, can I still buy tickets to Singapore events?</a>
                                                    <div class="collapse" id="collapsefourGeneral">
                                                        <p>You can make your purchase online or via our ticketing hotline at +65 6733 0360. We accept major credit cards for payment. For collection of tickets, you either select e-ticket for the tickets to be emailed to you or choose to pick up from the event venue which will be available 1 hour before event commence.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsefiveGeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How do I make corporate and group purchases? </a>
                                                    <div class="collapse" id="collapsefiveGeneral">
                                                        <p>Corporate and group purchases may be available from time to time, on an event to event basis. Please refer to the specific event page for information. Alternatively, you can also call us on the corporate hotline at +65 6733 0360.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="seatallocation">
                                            <h3 class="font-light">Seat Allocation</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseoneSeat" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Why can’t I choose my own seat online?</a>
                                                    <div class="collapse" id="collapseoneSeat">
                                                        <p>You may choose your preferred seat category and section. However, exact seat selection will only be available to events as granted by promoters.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwoSeat" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is an obstructed or restricted view?</a>
                                                    <div class="collapse" id="collapsetwoSeat">
                                                        <p>Due to the different event configuration, stage setup and props arrangement for each event, some seats may not have a full view of the stage. These seats, with obstructed or restricted view, will be identified on the seat map diagram of the event webpage.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="payment">
                                            <h3 class="font-light">Payment</h3>
                                            <ul class="ul-faq-content">
                                                <li>
                                                    <a data-toggle="collapse" href="#collapseonePayment" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What are the modes of payment?</a>
                                                    <div class="collapse" id="collapseonePayment">
                                                        <p>Visa, MasterCard, Amex are accepted via all booking channels.</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a data-toggle="collapse" href="#collapsetwoPayment" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is the CVV code?</a>
                                                    <div class="collapse" id="collapsetwoPayment">
                                                        <p>It is a 3-digit number embossed or imprinted on the reverse side of your credit card. For Amex card, it is a 4-digit number on the front side of your card.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
        $tixtrack->status = 'publish';
        $tixtrack->responsive_content = '<div class="row menu-faq-mobile">
                    <div class="box-mobile-faq col-xs-12">
                        <div class="col-xs-6">
                            <div class="top-faq-mobile faq-menu-mobile">
                                <a href="#" id="top-anchor">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Top Questions</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="general-faq-mobile faq-menu-mobile">
                                <a href="#" id="general-anchor">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i class="fa fa-question-circle"></i>
                                        </div>
                                        <div class="col-md-12">
                                            <p>General</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row menu-faq-mobile">
                    <div class="box-mobile-faq col-xs-12">
                        <div class="col-xs-6">
                            <div class="seat-faq-mobile faq-menu-mobile">
                                <a href="#" id="seat-anchor">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Seat Allocation</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="payment-faq-mobile faq-menu-mobile">
                                <a href="#" id="payment-anchor">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Payment</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 faq-top-show mobile-content-show body-question" id="faq-top-show">
                    <div class="container">
                        <div class="mobile-page-title mobile-title-faq">
                            <a href="#" class="back-faq">FAQ</a>
                            <h3 class="font-light">Top Questions</h3>
                        </div>
                        <div class="list-ask-mobile top-ask">
                            <ul class="ul-faq-content">
                                <li>
                                    <a data-toggle="collapse" href="#collapseonemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What should I do if my tickets are lost?</a>
                                    <div class="collapse" id="collapseonemobile">
                                        <p>Please contact us at +65 6733 0360 and have ready the following to get a replacement ticket issued with a new barcode:</p>
                                        <ul class="ul-inside">
                                            <li>Order Confirmation Number</li>
                                            <li>Name</li>
                                            <li>Contact Number</li>
                                        </ul>
                                        <p>A service fee of $5 per ticket reprint, in addition to the standard ticket delivery costs (if applicable), will be applicable for this change.</p>
                                        <p>General Admission tickets cannot be replaced.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsetwomobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What happens if an event is cancelled?</a>
                                    <div class="collapse" id="collapsetwomobile">
                                        <p>Cancellation policies are event specific and will be communicated by the show organiser. Given that refunds are offered, procedures will be provided on the event page and major media channels.</p>

                                        <p>Given that refunds are offered, funds will be automatically returned into the same credit card you used to make the purchase.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsethreemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How long does it take for my tickets to be delivered?</a>
                                    <div class="collapse" id="collapsethreemobile">
                                        <p>Tickets will be dispatched 1 month before the date of event. If you did not receive your tickets, please contact us at +65 6733 0360.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsefourmobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Does my child require a ticket?</a>
                                    <div class="collapse" id="collapsefourmobile">
                                        <p>Admission rules vary between events. Please refer to the specific event page for information.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsefivemobile" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is a Booking Fee?</a>
                                    <div class="collapse" id="collapsefivemobile">
                                        <p>It is a worldwide standard practice by ticketing services company to support investment in systems technology and to improve the online purchase experience.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 faq-general-show mobile-content-show body-question" id="faq-general-show">
                    <div class="container">
                        <div class="mobile-page-title mobile-title-faq">
                            <a href="#" class="back-faq">FAQ</a>
                            <h3 class="font-light">General</h3>
                        </div>
                        <div class="list-ask-mobile top-ask">
                            <ul class="ul-faq-content">
                                <li>
                                    <a data-toggle="collapse" href="#collapseonemobilegeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I reserve my tickets online?</a>
                                    <div class="collapse" id="collapseonemobilegeneral">
                                        <p>All transactions must be completed along with full payment at the time of booking.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsetwomobilegeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I bring cameras and/or video cameras into the venue?</a>
                                    <div class="collapse" id="collapsetwomobilegeneral">
                                        <p>There are restrictions/limitations on items you can bring into each venue. Please refer to the event page for admission rules and regulations to the specific venue.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsethreemobilegeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Can I buy tickets from unauthorised ticket vendors?</a>
                                    <div class="collapse" id="collapsethreemobilegeneral">
                                        <p>Tickets purchased from unauthorised ticket vendors come with high uncertainty of the sources. As such, they could lost/stolen tickets or duplicated tickets, which will be identified on site once scanned and denied entry.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsefourmobilegeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What if I do not live in Singapore and/or do not have a local address, can I still buy tickets to Singapore events?</a>
                                    <div class="collapse" id="collapsefourmobilegeneral">
                                        <p>You can make your purchase online or via our ticketing hotline at +65 6733 0360. We accept major credit cards for payment. For collection of tickets, you either select e-ticket for the tickets to be emailed to you or choose to pick up from the event venue which will be available 1 hour before event commence.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsefivemobilegeneral" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">How do I make corporate and group purchases?</a>
                                    <div class="collapse" id="collapsefivemobilegeneral">
                                        <p>Corporate and group purchases may be available from time to time, on an event to event basis. Please refer to the specific event page for information. Alternatively, you can also call us on the corporate hotline at +65 6733 0360.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 faq-seat-show mobile-content-show">
                    <div class="container">
                        <div class="mobile-page-title mobile-title-faq">
                            <a href="#" class="back-faq">FAQ</a>
                            <h3 class="font-light">Seat Allocation</h3>
                        </div>
                        <div class="list-ask-mobile top-ask">
                            <ul class="ul-faq-content">
                                <li>
                                    <a data-toggle="collapse" href="#collapseonemobileseat" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">Why can’t I choose my own seat online?</a>
                                    <div class="collapse" id="collapseonemobileseat">
                                        <p>You may choose your preferred seat category and section. However, exact seat selection will only be available to events as granted by promoters.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsetwomobileseat" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is an obstructed or restricted view?</a>
                                    <div class="collapse" id="collapsetwomobileseat">
                                        <p>Due to the different event configuration, stage setup and props arrangement for each event, some seats may not have a full view of the stage. These seats, with obstructed or restricted view, will be identified on the seat map diagram of the event webpage.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 faq-payment-show mobile-content-show">
                    <div class="container">
                        <div class="mobile-page-title mobile-title-faq">
                            <a href="#" class="back-faq">FAQ</a>
                            <h3 class="font-light">Payment</h3>
                        </div>
                        <div class="list-ask-mobile top-ask">
                            <ul class="ul-faq-content">
                                <li>
                                    <a data-toggle="collapse" href="#collapseonemobilepayment" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What are the modes of payment?</a>
                                    <div class="collapse" id="collapseonemobilepayment">
                                        <p>Visa, MasterCard, Amex are accepted via all booking channels.</p>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#collapsetwomobilepayment" aria-expanded="false" aria-controls="collapseExample" class="collapse-filter collapsed">What is the CVV code?</a>
                                    <div class="collapse" id="collapsetwomobilepayment">
                                        <p>It is a 3-digit number embossed or imprinted on the reverse side of your credit card. For Amex card, it is a 4-digit number on the front side of your card.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>';
        $tixtrack->save();
    }
}
