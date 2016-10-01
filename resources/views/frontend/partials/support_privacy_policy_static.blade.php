@extends('layout.frontend.master.master')
@section('title', 'Event Asia Box Office')
@section('content')
          <section class="about-content ways-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="sidebar">
                          <ul>
                              <li class="sidebar-head">
                                  <h4>{{ trans('general.support') }}</h4>
                              </li>
                              {{-- <li class="sidebar-menu-top">
                                  <a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a>
                              </li> --}}
                              <li class="sidebar-menu-top">
                                  <a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a>
                              </li>
                              <li class="sidebar-menu active">
                                  <a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content main-terms">
                          <div class="support-desc">
                              <div class="row">
                                  <h3 class="head-about font-light">{{ trans('general.privacy_policy') }}</h3>
                                    <div class="col-md-12">
                                        <div class="privacy-content">
                                            <p>Asia Box Office respects the privacy of all our customers and business contacts, and is committed to safeguarding the personal data you provide to us. Please read this Privacy Policy to learn more about the ways in which we collect, use and protect your personal data. We want you to fully understand our privacy practices. If you have any questions, please send an email to our data protection team at dataprotection@sistic.com.sg.</p>
                                            <h5>Overview</h5>
                                            <p>This Privacy Policy applies to the services available on or through SISTIC's website at www.sistic.com.sg and all related domains and sub-domains ("Site").</p>
                                            <p>This Privacy Policy describes the data that we collect from you and how we may deal with that data, in the course of our normal business operations.</p>
                                            <p>Access to and use of the services available on or through the Site is conditional upon acceptance of SISTIC's Conditions of Access, into which this Privacy Policy is incorporated by reference and which this Privacy Policy is an integral part of. By accessing and/or using the services available on or through the Site, you hereby acknowledge you have read SISTIC's Conditions of Access and this Privacy Policy, and that you are expressly agreeing to the Conditions of Access and expressly consenting to our collection, use and disclosure of your personal data in accordance with this Privacy Policy. If you do not agree to the Conditions of Access and/or do not consent to such collection, use and disclosure of your personal data, please do not access or use the services available on or through the Site.</p>
                                            <h5>Privacy Policy</h5>
                                            <ol>
                                              <li>Data Collection and Use
                                                <ol>
                                                  <li>We collect your personal data:
                                                    <ol>
                                                      <li>For SISTIC’s use:We collect your personal data in our own capacity and for our own use, and such use of your personal data by SISTIC shall be governed by the terms of this Privacy Policy.</li>
                                                      <li>For the promoter’s use:In relation to your booking for a specific show, event or attraction (each an "Event"), we collect your personal data as ticketing agent and data intermediary on behalf of the promoter and venue operator of the Event (each a "Transacting Party"), for the Transacting Party’s use for the purposes of ticket sales, Event administration, providing Event-related services, processing bookings or tickets for admission to the Event, or other related activities (collectively “Event Administration”), and providing you with their marketing materials where you have consented to receiving them. The Transacting Party will have to contact you for additional consents if it wishes to use your personal data for any other purpose.</li>
                                                    </ol>
                                                  </li>
                                                  <li>We collect and use your personal data to allow us to provide services and features to meet your needs, and to customize and improve our services to make your experience more secure and convenient. We only collect personal data about you that we consider reasonably necessary for achieving these purposes</li>
                                                  <li>If you choose to use our services, we may require you to provide contact and identity information and other personal data as indicated on the forms throughout the Site. Where possible, we will indicate which fields are mandatory and which fields are optional.</li>
                                                  <li>In general, we collect and use your personal data to facilitate our provision of the services requested by you. We will maintain a file about you and your use of our services. We will collect, use and retain the data in your file, and such other data that we may obtain from time to time in connection with your current and past activities on the Site, for as long as the purpose for which the data is collected continues or where otherwise necessary for legal purposes or the purposes of our normal business operations. Thereafter, we will destroy or delete the data, or remove the means by which the data can be associated with you. The abovementioned purposes may include but are not limited to: resolving disputes; troubleshooting problems; helping promote secure trading; collecting fees owed to us; conducting surveys, obtaining customer feedback and measuring consumer interest in our products and services; communicating with you (including on behalf of promoters or venue operators from whom you have purchased a ticket); customising and optimising your experience on the Site; detecting and protecting us against error, fraud and other criminal activity; and such other purposes as may be notified to you before or at the time of collection or use of the data.</li>
                                                  <li>We may also look across multiple users to identify problems or resolve disputes, and in particular, we may examine your personal data to identify users using multiple user-IDs or aliases. We may also compare and review your personal data for errors, omissions and/or accuracy.</li>
                                                  <li>Under some circumstances, we may require certain financial information from you. We use your financial information (including credit card information) only to verify the accuracy of your name, address, and other information, to detect any fraud or other criminal activity, and to bill you for your use of our services.</li>
                                                  <li>We automatically track certain information based upon your behaviour on the Site. We use this information to do internal research on our users' demographics, interests, and behaviour to better understand, protect and serve our users in general and you in particular. This information may include the URL that you just came from (whether this URL is on the Site or not), which URL you next access (whether this URL is on the Site or not), your computer browser information, and your IP address.</li>
                                                  <li>We use data collection devices such as "cookies" on certain pages of the Site to promote trust and security, help analyse our web page flow and measure promotional effectiveness. "Cookies" are small files placed on your hard drive that assist us in providing our services. We may offer features that are only available through the use of a "cookie". We also use cookies to reduce the number of times you need to enter your password. Cookies can also help us provide to you information that is targeted to your interests. Most cookies are "session cookies", meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline our cookies (if your browser permits you to do so), although in that case you may not be able to use certain features on the Site and you may be required to enter your password more frequently during a session on the Site.</li>
                                                </ol>
                                              </li>
                                              <li>Marketing opt-in and opt-out provision
                                                <ol>
                                                  <li>When you register for a SISTIC account, you may opt-in to receive marketing information via email from: SISTIC, promoters and/or venue operators. This information will include the latest news on shows, events, promotions, contests and/or lucky draws.</li>
                                                  <li>If you opt to receive marketing information from SISTIC:
                                                    <ol>
                                                      <li>We will use your email address to inform you about online and offline offers, products, services, and updates and send you our e-newsletters and/or electronic direct marketing materials such as the SISTIC Buzz and SISTIC Buzz Special, which provide information on events that are jointly promoted by SISTIC. The SISTIC Buzz features multiple events organised by various promoters, while the SISTIC Buzz Special features one or more events organised by a single promoter.</li>
                                                      <li>If you change your mind at any time and wish to un-subscribe from SISTIC’s marketing material, you may easily do so via the unsubscription link found on each email, or through our hotline at +65 6348 5555. Alternatively, you may also log into "My Account" at www.sistic.com.sg and opt out directly by editing your email preferences.</li>
                                                    </ol>
                                                  </li>
                                                  <li>If you opt to receive marketing information from a promoter or venue operator (each a “Marketing Party”):
                                                    <ol>
                                                      <li>SISTIC will, as ticketing agent and data intermediary of such Marketing Party, disclose to such Marketing Party, your email address and other personal data relevant to such marketing purpose, and such Marketing Party will be contractually bound to SISTIC to use such personal data within the scope of your consents, and to comply with the provisions of the Personal Data Protection Act (No. 26 of 2012) (“PDPA”). The Marketing Party will have to contact you for additional consents if it wishes to use your personal data for any other purpose.</li>
                                                      <li>If you change your mind at any time and wish to un-subscribe from any Marketing Party’s marketing material, please contact the Marketing Party to do so. If you wish to obtain the contact particulars of the Marketing Party, you may call our hotline at +65 6348 5555.</li>
                                                    </ol>
                                                  </li>
                                                </ol>
                                              </li>
                                              <li>Sharing with and Disclosure to Third Parties
                                                <ol>
                                                  <li>As a matter of policy, your personal data will not be shared or disclosed to third parties (whether for their marketing purposes or otherwise) without your consent. However, we reserve the right to disclose your personal data to our third party service providers (including any third party service provider which hosts or manages data from this Site; credit, debit and charge card companies, banks and other entities processing payment instructions given by you through this Site; lawyers; auditors; our ticketing outlets and agents and any other agents or subcontractors acting on our behalf), government or regulatory authorities, and/or promoters or venue operators for the purpose of Event Administration, to the extent required in the normal course and scope of our business in the provision of our services, and where required or permitted by applicable law, statute, stock exchange regulation or by-law, regulatory or governmental order or court order. Our promoters and venue operators may in turn disclose your personal data to their third party service providers to the extent required for Event Administration.</li>
                                                </ol>
                                              </li>
                                              <li>Security
                                                <ol>
                                                  <li>Your privacy is important to us. We put in place reasonable security arrangements (which shall at least be equivalent to industry standard practices) to protect your privacy and personal data, in such manner and to such extent as we deem reasonably appropriate to prevent unauthorised access, collection, use, disclosure, copying, modification, disposal or similar risks. However, there is no such thing as "perfect security" and we do not guarantee in any way, and you should not expect, that your personal data or private communications will always remain private and/or safe from any abuse or misuse by third parties.</li>
                                                  <li>Your personal data to be used by SISTIC is stored on SISTIC's servers located in Singapore. We use such procedural and technical safeguards as we deem reasonably necessary to protect your privacy and to protect your personal data against loss, theft and unauthorised access, collection, use, disclosure, copying, modification or disposal. Such safeguards include but are not limited to the use of encryption, firewalls and Secure Socket Layer technology. We will also employ the appropriate security techniques to reasonably protect data against loss, theft, and unauthorized access, collection, use, disclosure, copying, modification or disposal by users inside and outside SISTIC</li>
                                                  <li>SISTIC protects the personal data it collects in a secure database with important data being encrypted, and the database servers are hosted in a protected data centre. SISTIC employees are required, as a condition of their employment, to treat personal data held by SISTIC as confidential, and to maintain the confidentiality of that personal data.</li>
                                                  <li>  As "perfect security" does not exist, SISTIC does not represent or warrant that there will not be, and hereby disclaims any responsibility or liability directly or indirectly arising out of or in connection with, any loss, theft, or unauthorised access, collection, use, disclosure, copying, modification, disposal or similar actions with regard to any data held or maintained by us.</li>
                                                  <li>You are advised to contact the relevant Transacting Party or Marketing Party if you wish to find out how it stores your personal data. If you wish to obtain the contact particulars of the Transacting Party or Marketing Party, you may call our hotline at +65 6348 5555.</li>
                                                </ol>
                                              </li>
                                              <li>Accessing and Updating your Data
                                                <ol>
                                                  <li>If you wish to access, update or otherwise change or remove any personal data that you provide for SISTIC’s use, please contact us at: our hotline +65 6348 5555 for assistance. You will also be able to change it directly after logging in under "My Account" at www.sistic.com.sg.</li>
                                                </ol>
                                              </li>
                                              <li>Changes to the Privacy Policy
                                                <ol>
                                                  <li>SISTIC reserves the right to amend its prevailing Privacy Policy at any time and will place any such amendments on this Site.</li>
                                                </ol>
                                              </li>
                                              <li>Governing Law
                                                <ol>
                                                  <li>This Privacy Policy is governed by and shall be construed in accordance with Singapore law, without giving effect to any principles of conflicts of law. By accessing this Site and providing personal data or information requested, you agree to submit to the non-exclusive jurisdiction of the Singapore courts.</li>
                                                </ol>
                                              </li>
                                              <li>Contact SISTIC
                                                <ol>
                                                  <li>If you have further questions about this Privacy Policy or wish to contact us regarding our privacy practices and policies, please do not hesitate to contact us at: dataprotection@sistic.com.sg. You can also write to us at 10 Eunos Road 8, #03-04, Singapore Post Centre, Singapore 408600.</li>
                                                </ol>
                                              </li>
                                            </ol>
                                            <br>
                                            <label class="update-terms">Updated by Asia Box Office Legal Team on May 15, 2016</label>
                                            {{-- {!! $content !!} --}}
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
                    <a class="menu" role="button" data-toggle="collapse" href="#mobile-sidebar-collapse" aria-expanded="false" aria-controls="collapseExample">Support</a>
                    <div class="collapse" id="mobile-sidebar-collapse">
                      <ul>
                        {{-- <li><a href="{{URL::route('support-way-to-buy-tickets')}}">{{ trans('general.ways_to_buy_tickets') }}</a></li> --}}
                        <li><a href="{{URL::route('support-faq')}}">{{ trans('general.frequently_asked_questions') }}</a></li>
                        <li><a href="{{URL::route('contact-us')}}">{{ trans('general.contact_us') }}</a></li>
                        <li><a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a></li>
                        <li><a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a></li>
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
                    <h3 class="font-light">{{ trans('general.privacy_policy') }}</h3>
                  </div>
                    <div class="col-md-12">
                        <div class="privacy-content">
                            <p>Asia Box Office respects the privacy of all our customers and business contacts, and is committed to safeguarding the personal data you provide to us. Please read this Privacy Policy to learn more about the ways in which we collect, use and protect your personal data. We want you to fully understand our privacy practices. If you have any questions, please send an email to our data protection team at dataprotection@sistic.com.sg.</p>
                            <h5>Overview</h5>
                            <p>This Privacy Policy applies to the services available on or through SISTIC's website at www.sistic.com.sg and all related domains and sub-domains ("Site").</p>
                            <p>This Privacy Policy describes the data that we collect from you and how we may deal with that data, in the course of our normal business operations.</p>
                            <p>Access to and use of the services available on or through the Site is conditional upon acceptance of SISTIC's Conditions of Access, into which this Privacy Policy is incorporated by reference and which this Privacy Policy is an integral part of. By accessing and/or using the services available on or through the Site, you hereby acknowledge you have read SISTIC's Conditions of Access and this Privacy Policy, and that you are expressly agreeing to the Conditions of Access and expressly consenting to our collection, use and disclosure of your personal data in accordance with this Privacy Policy. If you do not agree to the Conditions of Access and/or do not consent to such collection, use and disclosure of your personal data, please do not access or use the services available on or through the Site.</p>
                            <h5>Privacy Policy</h5>
                            <ol>
                              <li>Data Collection and Use
                                <ol>
                                  <li>We collect your personal data:
                                    <ol>
                                      <li>For SISTIC’s use:We collect your personal data in our own capacity and for our own use, and such use of your personal data by SISTIC shall be governed by the terms of this Privacy Policy.</li>
                                      <li>For the promoter’s use:In relation to your booking for a specific show, event or attraction (each an "Event"), we collect your personal data as ticketing agent and data intermediary on behalf of the promoter and venue operator of the Event (each a "Transacting Party"), for the Transacting Party’s use for the purposes of ticket sales, Event administration, providing Event-related services, processing bookings or tickets for admission to the Event, or other related activities (collectively “Event Administration”), and providing you with their marketing materials where you have consented to receiving them. The Transacting Party will have to contact you for additional consents if it wishes to use your personal data for any other purpose.</li>
                                    </ol>
                                  </li>
                                  <li>We collect and use your personal data to allow us to provide services and features to meet your needs, and to customize and improve our services to make your experience more secure and convenient. We only collect personal data about you that we consider reasonably necessary for achieving these purposes</li>
                                  <li>If you choose to use our services, we may require you to provide contact and identity information and other personal data as indicated on the forms throughout the Site. Where possible, we will indicate which fields are mandatory and which fields are optional.</li>
                                  <li>In general, we collect and use your personal data to facilitate our provision of the services requested by you. We will maintain a file about you and your use of our services. We will collect, use and retain the data in your file, and such other data that we may obtain from time to time in connection with your current and past activities on the Site, for as long as the purpose for which the data is collected continues or where otherwise necessary for legal purposes or the purposes of our normal business operations. Thereafter, we will destroy or delete the data, or remove the means by which the data can be associated with you. The abovementioned purposes may include but are not limited to: resolving disputes; troubleshooting problems; helping promote secure trading; collecting fees owed to us; conducting surveys, obtaining customer feedback and measuring consumer interest in our products and services; communicating with you (including on behalf of promoters or venue operators from whom you have purchased a ticket); customising and optimising your experience on the Site; detecting and protecting us against error, fraud and other criminal activity; and such other purposes as may be notified to you before or at the time of collection or use of the data.</li>
                                  <li>We may also look across multiple users to identify problems or resolve disputes, and in particular, we may examine your personal data to identify users using multiple user-IDs or aliases. We may also compare and review your personal data for errors, omissions and/or accuracy.</li>
                                  <li>Under some circumstances, we may require certain financial information from you. We use your financial information (including credit card information) only to verify the accuracy of your name, address, and other information, to detect any fraud or other criminal activity, and to bill you for your use of our services.</li>
                                  <li>We automatically track certain information based upon your behaviour on the Site. We use this information to do internal research on our users' demographics, interests, and behaviour to better understand, protect and serve our users in general and you in particular. This information may include the URL that you just came from (whether this URL is on the Site or not), which URL you next access (whether this URL is on the Site or not), your computer browser information, and your IP address.</li>
                                  <li>We use data collection devices such as "cookies" on certain pages of the Site to promote trust and security, help analyse our web page flow and measure promotional effectiveness. "Cookies" are small files placed on your hard drive that assist us in providing our services. We may offer features that are only available through the use of a "cookie". We also use cookies to reduce the number of times you need to enter your password. Cookies can also help us provide to you information that is targeted to your interests. Most cookies are "session cookies", meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline our cookies (if your browser permits you to do so), although in that case you may not be able to use certain features on the Site and you may be required to enter your password more frequently during a session on the Site.</li>
                                </ol>
                              </li>
                              <li>Marketing opt-in and opt-out provision
                                <ol>
                                  <li>When you register for a SISTIC account, you may opt-in to receive marketing information via email from: SISTIC, promoters and/or venue operators. This information will include the latest news on shows, events, promotions, contests and/or lucky draws.</li>
                                  <li>If you opt to receive marketing information from SISTIC:
                                    <ol>
                                      <li>We will use your email address to inform you about online and offline offers, products, services, and updates and send you our e-newsletters and/or electronic direct marketing materials such as the SISTIC Buzz and SISTIC Buzz Special, which provide information on events that are jointly promoted by SISTIC. The SISTIC Buzz features multiple events organised by various promoters, while the SISTIC Buzz Special features one or more events organised by a single promoter.</li>
                                      <li>If you change your mind at any time and wish to un-subscribe from SISTIC’s marketing material, you may easily do so via the unsubscription link found on each email, or through our hotline at +65 6348 5555. Alternatively, you may also log into "My Account" at www.sistic.com.sg and opt out directly by editing your email preferences.</li>
                                    </ol>
                                  </li>
                                  <li>If you opt to receive marketing information from a promoter or venue operator (each a “Marketing Party”):
                                    <ol>
                                      <li>SISTIC will, as ticketing agent and data intermediary of such Marketing Party, disclose to such Marketing Party, your email address and other personal data relevant to such marketing purpose, and such Marketing Party will be contractually bound to SISTIC to use such personal data within the scope of your consents, and to comply with the provisions of the Personal Data Protection Act (No. 26 of 2012) (“PDPA”). The Marketing Party will have to contact you for additional consents if it wishes to use your personal data for any other purpose.</li>
                                      <li>If you change your mind at any time and wish to un-subscribe from any Marketing Party’s marketing material, please contact the Marketing Party to do so. If you wish to obtain the contact particulars of the Marketing Party, you may call our hotline at +65 6348 5555.</li>
                                    </ol>
                                  </li>
                                </ol>
                              </li>
                              <li>Sharing with and Disclosure to Third Parties
                                <ol>
                                  <li>As a matter of policy, your personal data will not be shared or disclosed to third parties (whether for their marketing purposes or otherwise) without your consent. However, we reserve the right to disclose your personal data to our third party service providers (including any third party service provider which hosts or manages data from this Site; credit, debit and charge card companies, banks and other entities processing payment instructions given by you through this Site; lawyers; auditors; our ticketing outlets and agents and any other agents or subcontractors acting on our behalf), government or regulatory authorities, and/or promoters or venue operators for the purpose of Event Administration, to the extent required in the normal course and scope of our business in the provision of our services, and where required or permitted by applicable law, statute, stock exchange regulation or by-law, regulatory or governmental order or court order. Our promoters and venue operators may in turn disclose your personal data to their third party service providers to the extent required for Event Administration.</li>
                                </ol>
                              </li>
                              <li>Security
                                <ol>
                                  <li>Your privacy is important to us. We put in place reasonable security arrangements (which shall at least be equivalent to industry standard practices) to protect your privacy and personal data, in such manner and to such extent as we deem reasonably appropriate to prevent unauthorised access, collection, use, disclosure, copying, modification, disposal or similar risks. However, there is no such thing as "perfect security" and we do not guarantee in any way, and you should not expect, that your personal data or private communications will always remain private and/or safe from any abuse or misuse by third parties.</li>
                                  <li>Your personal data to be used by SISTIC is stored on SISTIC's servers located in Singapore. We use such procedural and technical safeguards as we deem reasonably necessary to protect your privacy and to protect your personal data against loss, theft and unauthorised access, collection, use, disclosure, copying, modification or disposal. Such safeguards include but are not limited to the use of encryption, firewalls and Secure Socket Layer technology. We will also employ the appropriate security techniques to reasonably protect data against loss, theft, and unauthorized access, collection, use, disclosure, copying, modification or disposal by users inside and outside SISTIC</li>
                                  <li>SISTIC protects the personal data it collects in a secure database with important data being encrypted, and the database servers are hosted in a protected data centre. SISTIC employees are required, as a condition of their employment, to treat personal data held by SISTIC as confidential, and to maintain the confidentiality of that personal data.</li>
                                  <li>  As "perfect security" does not exist, SISTIC does not represent or warrant that there will not be, and hereby disclaims any responsibility or liability directly or indirectly arising out of or in connection with, any loss, theft, or unauthorised access, collection, use, disclosure, copying, modification, disposal or similar actions with regard to any data held or maintained by us.</li>
                                  <li>You are advised to contact the relevant Transacting Party or Marketing Party if you wish to find out how it stores your personal data. If you wish to obtain the contact particulars of the Transacting Party or Marketing Party, you may call our hotline at +65 6348 5555.</li>
                                </ol>
                              </li>
                              <li>Accessing and Updating your Data
                                <ol>
                                  <li>If you wish to access, update or otherwise change or remove any personal data that you provide for SISTIC’s use, please contact us at: our hotline +65 6348 5555 for assistance. You will also be able to change it directly after logging in under "My Account" at www.sistic.com.sg.</li>
                                </ol>
                              </li>
                              <li>Changes to the Privacy Policy
                                <ol>
                                  <li>SISTIC reserves the right to amend its prevailing Privacy Policy at any time and will place any such amendments on this Site.</li>
                                </ol>
                              </li>
                              <li>Governing Law
                                <ol>
                                  <li>This Privacy Policy is governed by and shall be construed in accordance with Singapore law, without giving effect to any principles of conflicts of law. By accessing this Site and providing personal data or information requested, you agree to submit to the non-exclusive jurisdiction of the Singapore courts.</li>
                                </ol>
                              </li>
                              <li>Contact SISTIC
                                <ol>
                                  <li>If you have further questions about this Privacy Policy or wish to contact us regarding our privacy practices and policies, please do not hesitate to contact us at: dataprotection@sistic.com.sg. You can also write to us at 10 Eunos Road 8, #03-04, Singapore Post Centre, Singapore 408600.</li>
                                </ol>
                              </li>
                            </ol>
                            <br>
                            <label class="update-terms">Updated by Asia Box Office Legal Team on May 15, 2016</label>
                            {{-- {!! $content !!} --}}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </section>
@stop