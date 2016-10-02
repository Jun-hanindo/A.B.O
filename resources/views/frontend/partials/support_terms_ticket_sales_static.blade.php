@extends('layout.frontend.master.master')
@section('title', 'Terms of Ticket Sales - ')
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
                    <li class="sidebar-menu active">
                        <a href="{{URL::route('support-terms-ticket-sales')}}">Terms of Ticket Sales</a>
                    </li>
                    <li class="sidebar-menu">
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
                                <h3 class="head-support font-light">Terms of Ticket Sales</h3>
                                <div class="col-md-12">
                                  <div class="terms-content">
                                    <ol>
                                      <li><label class="font-bold">General</label>
                                        <ol>
                                          <li>This website www.AsiaBoxOffice.com (“our site”) and the ticket booking facility on our site is owned by Asia Box Office Pte Ltd.</li>
                                          <li>These terms and conditions (together with the documents referred to herein) govern the sale and purchase of tickets from our site.</li>
                                          <li>You represent that you are of legal age to use our site and booking facility in accordance with these terms and conditions, and to create binding legal obligations for any liability you may incur as a result thereof.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Changes to these terms</label>
                                        <ol>
                                          <li>We may revise these terms and conditions at any time by amending this page.
                                          </li>
                                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Purchasing tickets</label>
                                        <ol>
                                          <li>All tickets to events are sold by us as agent for the respective event’s venue management or owner (collectively, “Venue Owner”) and/or promoter (“Promoter”).</li>
                                          <li>Tickets for any event may be subject to additional terms and conditions as the Venue Owner or Promoter may impose, provided that in the event of any inconsistency with these terms and conditions and those of the Venue Owner or Promoter, these terms and conditions shall prevail.</li>
                                          <li>Please refer to our <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a> for more details on how we use and protect your personal information.</li>
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
                                      <li><label class="font-bold">Collection of tickets</label>
                                        <ol>
                                          <li>Unless you have chosen to have your tickets delivered to you, you are required to collect your tickets within such time periods stipulated under the chosen collection method.</li>
                                          <li>In the event that you fail to collect any of your ticket(s) within the prescribed time frame, you will not be entitled to receive such ticket(s) or receive any refund for any such uncollected ticket(s).</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Changes/cancellation of events</label>
                                        <ol>
                                          <li>Events are sometimes re-scheduled, postponed or cancelled completely.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Entry to events</label>
                                        <ol>
                                          <li>Entry to any event may be subject to, and regulated by such terms and conditions as may be specified by the event’s Venue Owner and/or the Promoter.  A ticket holder may be denied entry to an event if the ticket holder does not comply with any such terms and conditions.</li>
                                          <li>Without limiting the above:
                                            <ul class="a">
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
                                      <li><label class="font-bold">Other rights</label>
                                        <ol>
                                          <li>The Promoter for an event may add, withdraw or substitute artistes and/or vary advertised programmes, event timing, event duration, seating arrangements and audience capacity without prior notice.</li>
                                          <li>The Venue Owner and/or the Promoter for an event may postpone, cancel, interrupt or stop the event due to adverse weather, security reasons or any other causes beyond their control.</li>
                                          <li>We shall be entitled to collect, use and disclose, and we shall be entitled to disclose to an event’s Promoter and/or Venue Owner for their use, any of your or a ticket holder’s personal data for the purpose of:
                                            <ul class="a">
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
                                      <li><label class="font-bold">Liability of liability</label>
                                        <ol>
                                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our booking facility or any content on it, whether express or implied.</li>
                                          <li>We will not be liable to anyone for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                                            <ul class="a">
                                              <li>use of, or inability to use, our booking facility; or</li>
                                              <li>use of or reliance on any content displayed on our booking facility.</li>
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
                                          <li>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of our booking facility or to your downloading of any content on it, or on any website linked to it.</li>
                                          <li>We assume no responsibility for the content of websites linked on our booking facility. Such links should not be interpreted as endorsement by us of those linked websites. We will not be liable for any loss or damage that may arise from your use of them.</li>
                                          <li>We will take all reasonable measures to ensure that information you transmit to us using our booking facility will remain confidential and protected from unauthorised access but we do not warrant against unauthorised access and will not be liable for any unauthorised access by any means to that information.</li>
                                        </ol>
                                      </li>
                                      <li><label class="font-bold">Applicable law</label>
                                        <ol>
                                          <li>These terms and conditions are governed by Singapore law.</li>
                                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                                        </ol>
                                      </li>
                                    </ol>
                                    <br>
                                    <label class="update-terms">Updated by Asia Box Office Legal Team on May 15, 2016.</label>
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
                    <h3 class="font-light">Terms of Ticket Sales</h3>
                  </div>
                  <div class="terms-content">
                    <ol>
                      <li><label class="font-bold">General</label>
                        <ol>
                          <li>This website www.AsiaBoxOffice.com (“our site”) and the ticket booking facility on our site is owned by Asia Box Office Pte Ltd.</li>
                          <li>These terms and conditions (together with the documents referred to herein) govern the sale and purchase of tickets from our site.</li>
                          <li>You represent that you are of legal age to use our site and booking facility in accordance with these terms and conditions, and to create binding legal obligations for any liability you may incur as a result thereof.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Changes to these terms</label>
                        <ol>
                          <li>We may revise these terms and conditions at any time by amending this page.
                          </li>
                          <li>Please check this page from time to time to take notice of any changes made, as they are binding on you.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Purchasing tickets</label>
                        <ol>
                          <li>All tickets to events are sold by us as agent for the respective event’s venue management or owner (collectively, “Venue Owner”) and/or promoter (“Promoter”).</li>
                          <li>Tickets for any event may be subject to additional terms and conditions as the Venue Owner or Promoter may impose, provided that in the event of any inconsistency with these terms and conditions and those of the Venue Owner or Promoter, these terms and conditions shall prevail.</li>
                          <li>Please refer to our <a href="{{URL::route('support-privacy-policy')}}">Privacy Policy</a> for more details on how we use and protect your personal information.</li>
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
                      <li><label class="font-bold">Collection of tickets</label>
                        <ol>
                          <li>Unless you have chosen to have your tickets delivered to you, you are required to collect your tickets within such time periods stipulated under the chosen collection method.</li>
                          <li>In the event that you fail to collect any of your ticket(s) within the prescribed time frame, you will not be entitled to receive such ticket(s) or receive any refund for any such uncollected ticket(s).</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Changes/cancellation of events</label>
                        <ol>
                          <li>Events are sometimes re-scheduled, postponed or cancelled completely.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Entry to events</label>
                        <ol>
                          <li>Entry to any event may be subject to, and regulated by such terms and conditions as may be specified by the event’s Venue Owner and/or the Promoter.  A ticket holder may be denied entry to an event if the ticket holder does not comply with any such terms and conditions.</li>
                          <li>Without limiting the above:
                            <ul class="a">
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
                      <li><label class="font-bold">Other rights</label>
                        <ol>
                          <li>The Promoter for an event may add, withdraw or substitute artistes and/or vary advertised programmes, event timing, event duration, seating arrangements and audience capacity without prior notice.</li>
                          <li>The Venue Owner and/or the Promoter for an event may postpone, cancel, interrupt or stop the event due to adverse weather, security reasons or any other causes beyond their control.</li>
                          <li>We shall be entitled to collect, use and disclose, and we shall be entitled to disclose to an event’s Promoter and/or Venue Owner for their use, any of your or a ticket holder’s personal data for the purpose of:
                            <ul class="a">
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
                      <li><label class="font-bold">Liability of liability</label>
                        <ol>
                          <li>Nothing in these terms of use excludes or limits our liability for death or personal injury arising from our negligence, or our fraud or fraudulent misrepresentation, or any other liability that cannot be excluded or limited by Singapore law.</li>
                          <li>To the extent permitted by law, we exclude all conditions, warranties, representations or other terms which may apply to our booking facility or any content on it, whether express or implied.</li>
                          <li>We will not be liable to anyone for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:
                            <ul class="a">
                              <li>use of, or inability to use, our booking facility; or</li>
                              <li>use of or reliance on any content displayed on our booking facility.</li>
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
                          <li>We will not be liable for any loss or damage caused by a virus, distributed denial-of-service attack, or other technologically harmful material that may infect your computer equipment, computer programs, data or other proprietary material due to your use of our booking facility or to your downloading of any content on it, or on any website linked to it.</li>
                          <li>We assume no responsibility for the content of websites linked on our booking facility. Such links should not be interpreted as endorsement by us of those linked websites. We will not be liable for any loss or damage that may arise from your use of them.</li>
                          <li>We will take all reasonable measures to ensure that information you transmit to us using our booking facility will remain confidential and protected from unauthorised access but we do not warrant against unauthorised access and will not be liable for any unauthorised access by any means to that information.</li>
                        </ol>
                      </li>
                      <li><label class="font-bold">Applicable law</label>
                        <ol>
                          <li>These terms and conditions are governed by Singapore law.</li>
                          <li>You agree that the courts of Singapore will have non-exclusive jurisdiction in the case of any dispute.</li>
                        </ol>
                      </li>
                    </ol>
                    <br>
                    <label class="update-terms">Updated by Asia Box Office Legal Team on May 15, 2016.</label>
                  </div>
                </div>
              </div>
            </div>
</section>
@stop