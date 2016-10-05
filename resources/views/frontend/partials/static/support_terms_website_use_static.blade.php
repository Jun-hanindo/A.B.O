@extends('layout.frontend.master.master_static')
@section('title', 'Terms of Website Use - ')
@section('og_image', asset('assets/frontend/images/logo-share.jpg'))
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
                    <li class="sidebar-menu active">
                        <a href="{{URL::route('support-terms-website-use')}}">Terms of Website Use</a>
                    </li>
                    <li class="sidebar-menu">
                        <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
                      <div class="main-content main-terms">
                          <div class="support-desc">
                              <div class="row">
                                <h3 class="head-support font-light">Terms of Website Use</h3>
                                <div class="col-md-12">
                                  <div class="terms-content">
                                    <h5>PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY BEFORE USING THIS SITE</h5>
                                    <ol>
                                      <li><label class="font-bold">Terms of website use</label>
                                        <ol>
                                          <li>This website www.asiaboxoffice.com (<span class="font-bold">“our site”</span>) is owned by Asia Box Office Pte Ltd.</li>
                                          <li>These terms and conditions (together with the documents referred to herein) (<span class="font-bold">“terms of use”</span>) govern your use of our site, whether as a guest or a registered user. Use of our site includes accessing, browsing, or registering to use our site.</li>
                                          <li>Please read these terms of use carefully before you start to use our site, as these will apply to your use of our site.</li>
                                          <li>By using our site, you confirm that you accept these terms of use and that you agree to comply with them.</li>
                                          <li>If you do not agree to these terms of use, you must not use our site.</li>
                                          <li>You represent that you are of legal age to use our site in accordance with these terms of use and to create binding legal obligations for any liability you may incur as a result of the use of our site.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Other applicable terms</label>
                                        <ol>
                                          <li>These terms of use include the following additional terms, which also apply to your use of our site:
                                            <ul class="a">
                                              <li>Our <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>, which sets out the terms on which we process any personal data we collect from you, or that you provide to us. By using our site, you consent to such processing and you warrant that all data provided by you is accurate.</li>
                                            </ul>
                                          </li>
                                          <li>If you purchase tickets from our site, our Terms and Conditions of <a href="{{URL::route('support-terms-ticket-sales')}}">Ticket Sales</a> will apply to the sale and purchase. </li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Changes to these terms</label>
                                        <ol>
                                          <li>We may revise these terms of use at any time by amending this page.</li>
                                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Changes to our site</label>
                                        <ol>
                                          <li>We may update our site from time to time, and may change the content at any time. However, please note that any of the content on our site may be out of date at any given time, and we are under no obligation to update it.</li>
                                          <li>We do not guarantee that our site, or any content on it, will be free from errors or omissions.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Accessing our site</label>
                                        <ol>
                                          <li>Our site is made available free of charge.</li>
                                          <li>We do not guarantee that our site, or any content on it, will always be available or be uninterrupted. Access to our site is permitted on a temporary basis. We may suspend, withdraw, discontinue or change all or any part of our site without notice. We will not be liable to you if for any reason our site is unavailable at any time or for any period.</li>
                                          <li>You are responsible for making all arrangements necessary for you to have access to our site.</li>
                                          <li>You are also responsible for ensuring that all persons who access our site through your internet connection are aware of these terms of use and other applicable terms and conditions, and that they comply with them.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Your account and password</label>
                                        <ol>
                                          <li>If you choose, or you are provided with, a user identification code, password or any other piece of information as part of our security procedures, you must treat such information as confidential. You must not disclose it to any third party.</li>
                                          <li>We have the right to disable any user identification code or password, whether chosen by you or allocated by us, at any time, if in our reasonable opinion you have failed to comply with any of the provisions of these terms of use.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Intellectual property rights</label>
                                        <ol>
                                          <li>We are the owner or the licensee of all intellectual property rights in our site, and in the material published on it.  Those works are protected by copyright and other intellectual property laws. All such rights are reserved.</li>
                                          <li>You may print one copy, and may download extracts, of any page(s) from our site for your personal use.</li>
                                          <li>You must not modify the paper or digital copies of any materials you have printed off or downloaded in any way, and you must not use any illustrations, photographs, video or audio sequences or any graphics separately from any accompanying text.</li>
                                          <li>Our status (and that of any identified contributors) as the authors of content on our site must always be acknowledged.</li>
                                          <li>You must not use any part of the content on our site for commercial purposes without obtaining a licence to do so from us or our licensors.</li>
                                          <li>If you print, copy or download any part of our site in breach of these terms of use, your right to use our site will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">No reliance on information</label>
                                        <ol>
                                          <li>The content on our site is provided “as is”.</li>
                                          <li>Although we make reasonable efforts to update the information on our site, we make no representations, warranties or guarantees, whether express or implied, that the content on our site is accurate, complete or up-to-date.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Limitation of our liability</label>
                                        <ol>
                                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our site or any content on it, whether express or implied.</li>
                                          <li>We will not be liable to any user for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                                            <ul class="a">
                                              <li>use of, or inability to use, our site; or</li>
                                              <li>use of or reliance on any content displayed on our site.</li>
                                            </ul>
                                          </li>
                                          <li>Without limiting the above, we will not be liable to anyone for:
                                            <ul class="a">
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
                                      <li><label class="font-bold">Viruses</label>
                                        <ol>
                                          <li>We do not guarantee that our site will be secure or free from bugs or viruses.</li>
                                          <li>You are responsible for configuring your information technology, computer programmes and platform in order to access our site. You should use your own virus protection software.</li>
                                          <li>You must not misuse our site by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful. You must not attempt to gain unauthorised access to our site, the server on which our site is stored or any server, computer or database connected to our site. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our site will cease immediately.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Linking to our site</label>
                                        <ol>
                                          <li>You may link to our home page, provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it.</li>
                                          <li>You must not establish a link in such a way as to suggest any form of association, approval or endorsement on our part where none exists.</li>
                                          <li>You must not establish a link to our site in any website that is not owned by you.</li>
                                          <li>Our site must not be framed on any other site, nor may you create a link to any part of our site other than the home page.</li>
                                          <li>We reserve the right to withdraw linking permission without notice.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Third party links and resources in our site</label>
                                        <ol>
                                          <li>Where our site contains links to other sites and resources provided by third parties, these links are provided for your information only.</li>
                                          <li>We have no control over the contents of those sites or resources.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Applicable law</label>
                                        <ol>
                                          <li>These terms of use are governed by Singapore law.</li>
                                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                                        </ol>
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
                    <h3 class="font-light">Terms of Website Use</h3>
                  </div>
                  <div class="terms-content">
                    <h5>PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY BEFORE USING THIS SITE</h5>
                    <ol>
                      <li><label class="font-bold">Terms of website use</label>
                        <ol class="sub-ol">
                          <li>This website www.asiaboxoffice.com (<span class="font-bold">“our site”</span>) is owned by Asia Box Office Pte Ltd.</li>
                          <li>These terms and conditions (together with the documents referred to herein) (<span class="font-bold">“terms of use”</span>) govern your use of our site, whether as a guest or a registered user. Use of our site includes accessing, browsing, or registering to use our site.</li>
                          <li>Please read these terms of use carefully before you start to use our site, as these will apply to your use of our site.</li>
                          <li>By using our site, you confirm that you accept these terms of use and that you agree to comply with them.</li>
                          <li>If you do not agree to these terms of use, you must not use our site.</li>
                          <li>You represent that you are of legal age to use our site in accordance with these terms of use and to create binding legal obligations for any liability you may incur as a result of the use of our site.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Other applicable terms</label>
                        <ol>
                          <li>These terms of use include the following additional terms, which also apply to your use of our site:
                            <ul class="a">
                              <li>Our <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a>, which sets out the terms on which we process any personal data we collect from you, or that you provide to us. By using our site, you consent to such processing and you warrant that all data provided by you is accurate.</li>
                            </ul>
                          </li>
                          <li>If you purchase tickets from our site, our Terms and Conditions of <a href="{{URL::route('support-terms-ticket-sales')}}">Ticket Sales</a> will apply to the sale and purchase. </li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Changes to these terms</label>
                        <ol>
                          <li>We may revise these terms of use at any time by amending this page.</li>
                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Changes to our site</label>
                        <ol>
                          <li>We may update our site from time to time, and may change the content at any time. However, please note that any of the content on our site may be out of date at any given time, and we are under no obligation to update it.</li>
                          <li>We do not guarantee that our site, or any content on it, will be free from errors or omissions.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Accessing our site</label>
                        <ol>
                          <li>Our site is made available free of charge.</li>
                          <li>We do not guarantee that our site, or any content on it, will always be available or be uninterrupted. Access to our site is permitted on a temporary basis. We may suspend, withdraw, discontinue or change all or any part of our site without notice. We will not be liable to you if for any reason our site is unavailable at any time or for any period.</li>
                          <li>You are responsible for making all arrangements necessary for you to have access to our site.</li>
                          <li>You are also responsible for ensuring that all persons who access our site through your internet connection are aware of these terms of use and other applicable terms and conditions, and that they comply with them.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Your account and password</label>
                        <ol>
                          <li>If you choose, or you are provided with, a user identification code, password or any other piece of information as part of our security procedures, you must treat such information as confidential. You must not disclose it to any third party.</li>
                          <li>We have the right to disable any user identification code or password, whether chosen by you or allocated by us, at any time, if in our reasonable opinion you have failed to comply with any of the provisions of these terms of use.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Intellectual property rights</label>
                        <ol>
                          <li>We are the owner or the licensee of all intellectual property rights in our site, and in the material published on it.  Those works are protected by copyright and other intellectual property laws. All such rights are reserved.</li>
                          <li>You may print one copy, and may download extracts, of any page(s) from our site for your personal use.</li>
                          <li>You must not modify the paper or digital copies of any materials you have printed off or downloaded in any way, and you must not use any illustrations, photographs, video or audio sequences or any graphics separately from any accompanying text.</li>
                          <li>Our status (and that of any identified contributors) as the authors of content on our site must always be acknowledged.</li>
                          <li>You must not use any part of the content on our site for commercial purposes without obtaining a licence to do so from us or our licensors.</li>
                          <li>If you print, copy or download any part of our site in breach of these terms of use, your right to use our site will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">No reliance on information</label>
                        <ol>
                          <li>The content on our site is provided “as is”.</li>
                          <li>Although we make reasonable efforts to update the information on our site, we make no representations, warranties or guarantees, whether express or implied, that the content on our site is accurate, complete or up-to-date.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Limitation of our liability</label>
                        <ol>
                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our site or any content on it, whether express or implied.</li>
                          <li>We will not be liable to any user for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                            <ul class="a">
                              <li>use of, or inability to use, our site; or</li>
                              <li>use of or reliance on any content displayed on our site.</li>
                            </ul>
                          </li>
                          <li>Without limiting the above, we will not be liable to anyone for:
                            <ul class="a">
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
                      <li><label class="font-bold">Viruses</label>
                        <ol>
                          <li>We do not guarantee that our site will be secure or free from bugs or viruses.</li>
                          <li>You are responsible for configuring your information technology, computer programmes and platform in order to access our site. You should use your own virus protection software.</li>
                          <li>You must not misuse our site by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful. You must not attempt to gain unauthorised access to our site, the server on which our site is stored or any server, computer or database connected to our site. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our site will cease immediately.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Linking to our site</label>
                        <ol>
                          <li>You may link to our home page, provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it.</li>
                          <li>You must not establish a link in such a way as to suggest any form of association, approval or endorsement on our part where none exists.</li>
                          <li>You must not establish a link to our site in any website that is not owned by you.</li>
                          <li>Our site must not be framed on any other site, nor may you create a link to any part of our site other than the home page.</li>
                          <li>We reserve the right to withdraw linking permission without notice.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Third party links and resources in our site</label>
                        <ol>
                          <li>Where our site contains links to other sites and resources provided by third parties, these links are provided for your information only.</li>
                          <li>We have no control over the contents of those sites or resources.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Applicable law</label>
                        <ol>
                          <li>These terms of use are governed by Singapore law.</li>
                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                        </ol>
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