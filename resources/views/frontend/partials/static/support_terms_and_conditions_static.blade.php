@extends('layout.frontend.master.master_static')
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
                              <li class="sidebar-menu active">
                                  <a href="{{URL::route('support-terms-and-conditions')}}">{{ trans('general.terms_and_conditions') }}</a>
                              </li>
                              <li class="sidebar-menu">
                                  <a href="{{URL::route('support-privacy-policy')}}">{{ trans('general.privacy_policy') }}</a>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-9">
                      <div class="main-content main-terms">
                          <div class="support-desc">
                              <div class="row">
                                  <h3 class="head-about font-light">{{ trans('general.terms_and_conditions') }}</h3>
                                  <h5>Sale of Asia Box Office (ABO) tickets are subject to the following Terms and Conditions</h5>
                                    <div class="col-md-12">
                                      <div class="terms-content">
                                            <ol>
                                                <li>All tickets are sold by SISTIC.com Pte Ltd ("SISTIC") as agent for and on behalf of the venue management or owner ("Venue Owner") responsible for the venue in which the event will be held ("Venue") and/or the promoter ("Promoter") responsible for the event for which they are sold ("Event"). All orders are subject to availability and acceptance by SISTIC. SISTIC reserves the right to accept or reject any order. By ordering tickets you agree, on your own behalf and as agent on behalf of all persons for whom you are purchasing tickets or who will be holding tickets purchased by you (you and each such person being a "Ticket Holder"), to be bound by these Terms and Conditions. SISTIC shall be entitled, but not obliged, to conduct verification checks on any order, and shall be entitled to rescind the order if such verification checks reveal any fraud or other irregularity in the order.</li>
                                                <li>SISTIC has no control over the maintenance or management of the Venue, or the organisation or management of the Event. SISTIC, its agents and employees shall not be liable for any death, personal injury (unless such death or personal injury was caused by the negligence of SISTIC), loss or damage however caused while in the venue nor are they liable for any complaints, claims, refunds, or exchange for any reason whatsoever, including without limitation, those relating to the Event, the Venue, or cancellation or postponement of the Event (collectively, "Claims"). Booking fees and all handling fees shall not be refundable. Any other refunds shall be made only at the Promoter's discretion and on the Promoter's account. SISTIC shall not be liable for any such Claims or refunds.</li>
                                                <li>Upon confirmation of your order for tickets, no exchange of tickets will be made under any circumstances and tickets are not transferable and may not be resold. SISTIC and the Provider each reserves the right to cancel any tickets that have been transferred or resold and to deny any such Ticket Holder entry.</li>
                                                <li>Upon confirmation of your order for tickets, no refund on tickets will be made under any circumstances except pursuant to Conditions 6 below.</li>
                                                <li>If an Event is postponed or cancelled, a Postponement Publicity Notice or a Cancellation Publicity Notice (collectively, the "Notices" or individually, a "Notice") respectively shall be placed in the media by the Promoter or SISTIC.</li>
                                                <li>All claims for refunds shall be directed to the Promoter. SISTIC may process refunds, but only as agent of the Promoter and as may be authorised by the Promoter out of sums held by SISTIC for the Promoter. The amount of such refund processed by SISTIC will be on a pro-rated basis ("Pro-rated Amount") in accordance with the amount of the said sums held by SISTIC after deduction of all sums due from Promoter to SISTIC ("Promoter's Proceeds") and the price paid by the Ticket Holder for the ticket. SISTIC shall not be liable to process any refund beyond the Pro-rated Amount under any circumstances. In any case, SISTIC shall not be liable and under no obligation to process any refund at all in the event that the Promoter did not authorise such refunds, the Promoter did not pay in advance the said sums to SISTIC or where SISTIC is not or is no longer holding any Promoters Proceeds. The following terms shall apply where refunds are processed by SISTIC:
                                                <ol>
                                                    <li>The Promoter or Venue Owner shall at its own discretion place notices advising procedures for requesting a refund and the period and time within which the Ticket Holder may request a refund.</li>
                                                    <li>If a request for a refund is made within one month after the date of a Notice, no administrative fee will be charged pursuant to such a request.</li>
                                                    <li>If a request for a refund is made between one month and six months (inclusive) after the date of a Notice, any refund made pursuant to such a request shall be charged a 20% administrative fee on the value of the ticket(s), subject to a maximum sum represented by the Pro-rated Amount.</li>
                                                    <li>No refund will be made if the request for the refund is made after six months from the date of a Notice. Such unrefunded sums shall be dealt with at SISTIC's or the Promoter’s sole discretion.</li>
                                                    <li>All tickets purchased using credit cards shall be refunded to the credit card accounts with which the tickets were purchased. If such credit card accounts are no longer valid, no credit card refunds will be made and Condition 6.6 below shall apply.</li>
                                                    <li>Tickets purchased using payments other than credit cards shall be refunded in cash and refunds will have to be made at the SISTIC Box Office located at 10 Eunos Road 8, #03-04 Singapore Post Centre Singapore 408600 during the normal operating hours of our Box Office. Ticket Holders will have to produce the full stub of the original tickets in good condition to claim refunds. The identity of the person receiving the refunds may be recorded by our Customer Service Officers.</li>
                                                </ol>
                                                </li>
                                                <li>Entry will be refused if tickets have not been purchased from SISTIC or other authorised points of sale.</li>
                                                <li>The resale of tickets at the same or any price in excess of the initial purchase price is prohibited. SISTIC reserves the right to cancel any tickets that have been resold and to deny any such Ticket Holder entry.</li>
                                                <li>Infants in arms or children without tickets will not be admitted unless otherwise stated in Event advertisements or announcement.</li>
                                                <li>Student and Senior Citizen passes (and others where applicable) must be shown to obtain discounts (where applicable) and upon admission.</li>
                                                <li>Latecomers cannot be admitted until a suitable break during the performances.</li>
                                                <li>Entry to the Venue will be subject to the Venue's prevailing terms and conditions of entry.</li>
                                                <li>Entry to the Event may be subject to age restrictions specified in the webpage or in publicity for the Event, and no refunds will be made on the grounds that the Ticket Holder was not aware of such age restrictions.</li>
                                                <li>The Promoter/Venue Owner reserves the right without refund or compensation to refuse admission/evict any person(s) whose conduct is disorderly or inappropriate or who poses a threat to security, or to the enjoyment of the Event by others.</li>
                                                <li>No photography, audio or video recording is allowed during the Event unless otherwise stated by the Promoter.</li>
                                                <li>The Promoter may add, withdraw or substitute artistes and/or vary advertised programmes, Event times, seating arrangements and audience capacity without prior notice.</li>
                                                <li>The Promoter/Venue Owner/SISTIC may use the Ticket Holder's image or likeness in any live or recorded video display, photograph, picture or publicity material or website.</li>
                                                <li>The Promoter/Venue Owner may postpone, cancel, interrupt or stop the Event due to adverse weather, dangerous situations, or any other causes beyond his reasonable control.</li>
                                                <li>The Ticket Holder agrees to submit to any search for any prohibited items including but not limited to weapons, controlled, dangerous and illegal substances and recording devices.</li>
                                                <li>The Ticket Holder voluntarily assumes all risk and danger incidental to the Event whether occurring prior to, during or subsequent to the actual Event, including any death, personal injury, loss, damage or liability.</li>
                                                <li>Purchasers of tickets who are under 18 years of age should seek parental consent before purchasing tickets/merchandises from our website. By transacting on our website, you certify that you are at least 18 years of age and you understand these Terms and Conditions.</li>
                                                <li>All tickets must be collected within the time periods stipulated for your chosen delivery method. No refunds will be made for uncollected tickets.</li>
                                                <li>Any complaints regarding the Event shall be directed solely to and dealt with by the Promoter. Any complaints regarding the Venue shall be directed solely to and dealt with by the Venue Owner.</li>
                                                <li>By providing any personal data to SISTIC, you agree that SISTIC shall be entitled to use and process such data in accordance with its Privacy Policy.</li>
                                                <li>Singapore law shall govern the sale of all tickets and you agree to submit to the exclusive jurisdiction of the Singapore courts.</li>
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
                    <h3 class="font-light">{{ trans('general.terms_and_conditions') }}</h3>
                  </div>
                  <div class="row">
                    <div class="terms-content">
                      <div class="container">
                            <h5>Sale of Asia Box Office (ABO) tickets are subject to the following Terms and Conditions</h5>
                            <ol>
                                <li>All tickets are sold by SISTIC.com Pte Ltd ("SISTIC") as agent for and on behalf of the venue management or owner ("Venue Owner") responsible for the venue in which the event will be held ("Venue") and/or the promoter ("Promoter") responsible for the event for which they are sold ("Event"). All orders are subject to availability and acceptance by SISTIC. SISTIC reserves the right to accept or reject any order. By ordering tickets you agree, on your own behalf and as agent on behalf of all persons for whom you are purchasing tickets or who will be holding tickets purchased by you (you and each such person being a "Ticket Holder"), to be bound by these Terms and Conditions. SISTIC shall be entitled, but not obliged, to conduct verification checks on any order, and shall be entitled to rescind the order if such verification checks reveal any fraud or other irregularity in the order.</li>
                                <li>SISTIC has no control over the maintenance or management of the Venue, or the organisation or management of the Event. SISTIC, its agents and employees shall not be liable for any death, personal injury (unless such death or personal injury was caused by the negligence of SISTIC), loss or damage however caused while in the venue nor are they liable for any complaints, claims, refunds, or exchange for any reason whatsoever, including without limitation, those relating to the Event, the Venue, or cancellation or postponement of the Event (collectively, "Claims"). Booking fees and all handling fees shall not be refundable. Any other refunds shall be made only at the Promoter's discretion and on the Promoter's account. SISTIC shall not be liable for any such Claims or refunds.</li>
                                <li>Upon confirmation of your order for tickets, no exchange of tickets will be made under any circumstances and tickets are not transferable and may not be resold. SISTIC and the Provider each reserves the right to cancel any tickets that have been transferred or resold and to deny any such Ticket Holder entry.</li>
                                <li>Upon confirmation of your order for tickets, no refund on tickets will be made under any circumstances except pursuant to Conditions 6 below.</li>
                                <li>If an Event is postponed or cancelled, a Postponement Publicity Notice or a Cancellation Publicity Notice (collectively, the "Notices" or individually, a "Notice") respectively shall be placed in the media by the Promoter or SISTIC.</li>
                                <li>All claims for refunds shall be directed to the Promoter. SISTIC may process refunds, but only as agent of the Promoter and as may be authorised by the Promoter out of sums held by SISTIC for the Promoter. The amount of such refund processed by SISTIC will be on a pro-rated basis ("Pro-rated Amount") in accordance with the amount of the said sums held by SISTIC after deduction of all sums due from Promoter to SISTIC ("Promoter's Proceeds") and the price paid by the Ticket Holder for the ticket. SISTIC shall not be liable to process any refund beyond the Pro-rated Amount under any circumstances. In any case, SISTIC shall not be liable and under no obligation to process any refund at all in the event that the Promoter did not authorise such refunds, the Promoter did not pay in advance the said sums to SISTIC or where SISTIC is not or is no longer holding any Promoters Proceeds. The following terms shall apply where refunds are processed by SISTIC:
                                <ol>
                                    <li>The Promoter or Venue Owner shall at its own discretion place notices advising procedures for requesting a refund and the period and time within which the Ticket Holder may request a refund.</li>
                                    <li>If a request for a refund is made within one month after the date of a Notice, no administrative fee will be charged pursuant to such a request.</li>
                                    <li>If a request for a refund is made between one month and six months (inclusive) after the date of a Notice, any refund made pursuant to such a request shall be charged a 20% administrative fee on the value of the ticket(s), subject to a maximum sum represented by the Pro-rated Amount.</li>
                                    <li>No refund will be made if the request for the refund is made after six months from the date of a Notice. Such unrefunded sums shall be dealt with at SISTIC's or the Promoter’s sole discretion.</li>
                                    <li>All tickets purchased using credit cards shall be refunded to the credit card accounts with which the tickets were purchased. If such credit card accounts are no longer valid, no credit card refunds will be made and Condition 6.6 below shall apply.</li>
                                    <li>Tickets purchased using payments other than credit cards shall be refunded in cash and refunds will have to be made at the SISTIC Box Office located at 10 Eunos Road 8, #03-04 Singapore Post Centre Singapore 408600 during the normal operating hours of our Box Office. Ticket Holders will have to produce the full stub of the original tickets in good condition to claim refunds. The identity of the person receiving the refunds may be recorded by our Customer Service Officers.</li>
                                </ol>
                                </li>
                                <li>Entry will be refused if tickets have not been purchased from SISTIC or other authorised points of sale.</li>
                                <li>The resale of tickets at the same or any price in excess of the initial purchase price is prohibited. SISTIC reserves the right to cancel any tickets that have been resold and to deny any such Ticket Holder entry.</li>
                                <li>Infants in arms or children without tickets will not be admitted unless otherwise stated in Event advertisements or announcement.</li>
                                <li>Student and Senior Citizen passes (and others where applicable) must be shown to obtain discounts (where applicable) and upon admission.</li>
                                <li>Latecomers cannot be admitted until a suitable break during the performances.</li>
                                <li>Entry to the Venue will be subject to the Venue's prevailing terms and conditions of entry.</li>
                                <li>Entry to the Event may be subject to age restrictions specified in the webpage or in publicity for the Event, and no refunds will be made on the grounds that the Ticket Holder was not aware of such age restrictions.</li>
                                <li>The Promoter/Venue Owner reserves the right without refund or compensation to refuse admission/evict any person(s) whose conduct is disorderly or inappropriate or who poses a threat to security, or to the enjoyment of the Event by others.</li>
                                <li>No photography, audio or video recording is allowed during the Event unless otherwise stated by the Promoter.</li>
                                <li>The Promoter may add, withdraw or substitute artistes and/or vary advertised programmes, Event times, seating arrangements and audience capacity without prior notice.</li>
                                <li>The Promoter/Venue Owner/SISTIC may use the Ticket Holder's image or likeness in any live or recorded video display, photograph, picture or publicity material or website.</li>
                                <li>The Promoter/Venue Owner may postpone, cancel, interrupt or stop the Event due to adverse weather, dangerous situations, or any other causes beyond his reasonable control.</li>
                                <li>The Ticket Holder agrees to submit to any search for any prohibited items including but not limited to weapons, controlled, dangerous and illegal substances and recording devices.</li>
                                <li>The Ticket Holder voluntarily assumes all risk and danger incidental to the Event whether occurring prior to, during or subsequent to the actual Event, including any death, personal injury, loss, damage or liability.</li>
                                <li>Purchasers of tickets who are under 18 years of age should seek parental consent before purchasing tickets/merchandises from our website. By transacting on our website, you certify that you are at least 18 years of age and you understand these Terms and Conditions.</li>
                                <li>All tickets must be collected within the time periods stipulated for your chosen delivery method. No refunds will be made for uncollected tickets.</li>
                                <li>Any complaints regarding the Event shall be directed solely to and dealt with by the Promoter. Any complaints regarding the Venue shall be directed solely to and dealt with by the Venue Owner.</li>
                                <li>By providing any personal data to SISTIC, you agree that SISTIC shall be entitled to use and process such data in accordance with its Privacy Policy.</li>
                                <li>Singapore law shall govern the sale of all tickets and you agree to submit to the exclusive jurisdiction of the Singapore courts.</li>
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
          </section>
@stop