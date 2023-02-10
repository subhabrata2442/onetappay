@extends('layouts.front.frontLayout')
@section('frontContent')
    @include('front.templates.header')

    @php
        $auth = Auth::user();
        $authUserId = $auth->id ?? '';
        $user_type = $auth->user_type ?? '';
        $userName = Session::get('userName') ?? '';
        $total_cart_item = isset($total_cart_item) ? $total_cart_item : 0;
        $total_cart_amount = isset($total_cart_amount) ? $total_cart_amount : 0;
        
        $p = $_GET['p'] ?? '';
        
        $is_booked_table = '';
        if (count($merchant_item_list) > 0) {
            if ($p == 'book_table') {
            } else {
                $is_booked_table = 'style=display:none';
            }
        }
        
    @endphp

    <input type="hidden" value="cart" id="page_id" />
    <section class="sec-gap-top sec-gap-btm">
        <div class="container-fluid left-right-gap">
            <div class="row g-3">
                <div class="col-lg-7 col-md-4 col-sm-4 col-4">
                    <div class="hotels-img hotels-img1"> <img class="img-block"
                            src="{{ asset('public/front/images/hotels/img7.jpg') }}" alt=""> </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="hotels-img hotels-img2"> <img class="img-block"
                                    src="{{ asset('public/front/images/first-order/first-order1.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="hotels-img hotels-img2"> <img class="img-block"
                                    src="{{ asset('public/front/images/first-order/first-order2.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                    <div class="hotels-img hotels-img1"> <img class="img-block"
                            src="{{ asset('public/front/images/collection/colection1.jpg') }}" alt=""> </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hotel-info-sec">
        <div class="container-fluid left-right-gap" id="order_container">
            <div class="row g-3 justify-content-between">
                <div class="col-lg-auto col-md-6 col-sm-12">
                    <div class="hotel-name-ifo">
                        <!--<a class="cmn-abtn2" href="{{ url('searcharea?location=' . $city) }}"><i class="fa-solid fa-reply"></i>back</a>-->
                        <h4> {{ $store_info->restaurant_name }}</h4>
                        <p>{{ $store_info->delivery_estimation }} min • ${{ $store_info->free_delivery }} Delivery Fee</p>
                        <p>{{ $store_info->address }} |
                            <button type="button" class="get-direc"><i class="fa-solid fa-route"></i>Get Direction</button>
                        </p>
                        <div><span class="open-time-text">Time: 11:00 AM to 11:00 PM</span> <span class="hotel-open position-relative"> <span
                                    class="open-time">(Open Now)<i class="fa-solid fa-angle-down"></i></span>
                                <div class="hotel-open-list">
                                    <ul>
                                        <li>Sunday 12:00 PM to 11:00 PM</li>
                                        <li>Monday 12:00 PM to 11:00 PM</li>
                                        <li>Tuesday 12:00 PM to 11:00 PM</li>
                                        <li>Wednesday 12:00 PM to 11:00 PM</li>
                                        <li>Thursday 12:00 PM to 11:00 PM</li>
                                        <li>Friday 12:00 PM to 11:00 PM</li>
                                        <li>Saturday 12:00 PM to 11:00 PM</li>
                                    </ul>
                                </div>
                            </span> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-auto col-md-6 col-sm-12">
                    <div class="hotel-total-review">
                        <ul class="d-flex flex-wrap">
                            <li class="d-flex">
                                <div class="star-total">
                                    <p><strong>4.4<i class="fa-solid fa-star"></i></strong></p>
                                </div>
                                <div class="star-total-text">
                                    <p><strong>3,580</strong></p>
                                    <p>Dinning Reviews</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="star-total">
                                    <p><strong>4.4<i class="fa-solid fa-star"></i></strong></p>
                                </div>
                                <div class="star-total-text">
                                    <p><strong>3,580</strong></p>
                                    <p>Dinning Reviews</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="hotel-bookmark-list">
                        <ul class="d-flex flex-wrap">
                            @if (Auth::user() && $user_type == 3)
                                @if (count($merchant_item_list) > 0)
                                    <li><a class="hotel-bookmark-list-btn @if ($p != 'book_table') active @endif"
                                            href="{{ url($store_url . '#order_container') }}"><i
                                                class="fa-solid fa-utensils"></i>Order Food</a></li>

                                    @if (count($store_table) > 0)
                                        <li><a class="hotel-bookmark-list-btn @if ($p == 'book_table') active @endif"
                                                href="{{ url($store_url . '/?p=book_table#order_container') }}"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @else
                                     <li><a class="hotel-bookmark-list-btn no_table_booking_avaible"
                                                href="javascript:;"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @endif
                                @else
                                <li><a class="hotel-bookmark-list-btn no_food_order_avaible"
                                             href="javascript:;"><i
                                                class="fa-solid fa-utensils"></i>Order Food</a></li>
                                                
                                    @if (count($store_table) > 0)
                                        <li><a class="hotel-bookmark-list-btn active"
                                                href="{{ url($store_url . '/?p=book_table#order_container') }}"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @else
                                     <li><a class="hotel-bookmark-list-btn no_table_booking_avaible"
                                                href="javascript:;"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @endif
                                @endif
                            @else
                                @if (count($merchant_item_list) > 0)
                                    <li><a class="hotel-bookmark-list-btn @if ($p != 'book_table') active @endif"
                                            href="{{ url($store_url . '#order_container') }}"><i
                                                class="fa-solid fa-utensils"></i>Order Food</a></li>
                                    @if (count($store_table) > 0)
                                        <li><a class="hotel-bookmark-list-btn"
                                                href="{{ url('/signup/?redirect_to=' . $store_url . '/?p=book_table') }}"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @else
                                     <li><a class="hotel-bookmark-list-btn no_table_booking_avaible"
                                                href="javascript:;"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @endif
                                @else
                                <li><a class="hotel-bookmark-list-btn no_food_order_avaible"
                                             href="javascript:;"><i
                                                class="fa-solid fa-utensils"></i>Order Food</a></li>
                                    @if (count($store_table) > 0)
                                        <li><a class="hotel-bookmark-list-btn"
                                                href="{{ url('/signup/?redirect_to=' . $store_url . '/?p=book_table') }}"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                     @else
                                     <li><a class="hotel-bookmark-list-btn no_table_booking_avaible"
                                                href="javascript:;"><i
                                                    class="fa-solid fa-utensils"></i>Book Table</a></li>
                                    @endif
                                @endif

                            @endif

                            <li><a class="hotel-bookmark-list-btn" href="javascript:;"><i
                                        class="fa-solid fa-bookmark"></i>Bookmark</a></li>
                            <li><a class="hotel-bookmark-list-btn" href="javascript:;"><i
                                        class="fa-solid fa-share"></i>Share</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="hotel-info-sec2">
        <div class="container-fluid left-right-gap">
            @if (count($store_table) > 0)
                <div class="booked_table" {{ $is_booked_table }}>
                    @if (Auth::user() && $user_type == 3)
                        <form class="forms has-validation-callback" action="{{ route('store.booking_table.save') }}"
                            method="POST" id="table_booking-form" onsubmit="return false;">
                            @csrf
                            <div class="row table-book-new">
                                <div class="table-book-wrap-lft">
                                    <div class="booked-step-process-head">
                                        <ul class="d-flex step-process-head-list">
                                            <li class="col step_bar active done" id="step1_progress_bar">
                                                <div class="process-head-text">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center h-100">
                                                        <i class="fa-solid fa-user"></i> <strong>head</strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col step_bar" id="step2_progress_bar">
                                                <div class="process-head-text">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center h-100">
                                                        <i class="fa-solid fa-calendar-days"></i> <strong>date</strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col step_bar" id="step3_progress_bar">
                                                <div class="process-head-text">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center h-100">
                                                        <i class="fa-solid fa-clock"></i> <strong>time</strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col step_bar" id="step4_progress_bar">
                                                <div class="process-head-text">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center h-100">
                                                        <i class="fa-solid fa-table"></i> <strong>Table</strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col step_bar" id="step5_progress_bar">
                                                <div class="process-head-text">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center h-100">
                                                        <i class="fa-solid fa-user"></i> <strong>User</strong>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="booked-step-process-box tab-pane" id="step1">
                                            <div class="step-box-person">
                                                <div class="head-booked-wrap">
                                                    <p>I want to book for <span class="person-book-select">
                                                            <select class="form-control selectOption_1 person-select"
                                                                id="total_person" name="total_person">
                                                                <option value="">Select</option>



                                                                @for ($i = 2; 10 > $i; $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}</option>
                                                                @endfor



                                                            </select>
                                                        </span> person </p>
                                                </div>
                                                <div class="nxt-prv-btn-wrap">
                                                    <ul class="d-flex justify-content-end">
                                                        <!-- <li><a href="#" class="nxt-prv-btn">previous</a></li> -->
                                                        <li><a href="javascript:;" class="nxt-prv-btn next-step"
                                                                data-step="1" data-nextstep="2">next</a></li>
                                                        <!-- <li><button type="button" class="nxt-prv-btn">book</button></li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="booked-step-process-box tab-pane" id="step2"
                                            style="display:none">
                                            <div class="step-box-date">
                                                <div class="d-flex flex-wrap date-pick-caln"> {!! $calendar !!}
                                                    {!! $next_calendar !!}
                                                    <input type="hidden" name="booking_date" id="booking_date">
                                                </div>
                                                <div class="nxt-prv-btn-wrap">
                                                    <ul class="d-flex justify-content-between">
                                                        <li><a href="javascript:;" class="nxt-prv-btn prev-step"
                                                                data-step="2" data-prevstep="1">Previous</a></li>
                                                        <li><a href="javascript:;" class="nxt-prv-btn next-step"
                                                                data-step="2" data-nextstep="3">next</a></li>
                                                        <!-- <li><button type="button" class="nxt-prv-btn">book</button></li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="booked-step-process-box tab-pane" id="step3"
                                            style="display:none">
                                            <div class="step-box-date">
                                                <div class="date-pick-caln time-pick-wrap">
                                                    <div class="time-pick-head">choose your time</div>
                                                    <input type="hidden" name="booking_time_id" id="booking_time_id">
                                                    <input type="hidden" name="booking_time_slot"
                                                        id="booking_time_slot">
                                                    <ul class="d-flex flex-wrap" id="timeslot_section">
                                                    </ul>
                                                </div>
                                                <div class="nxt-prv-btn-wrap">
                                                    <ul class="d-flex justify-content-between">
                                                        <li><a href="javascript:;" class="nxt-prv-btn prev-step"
                                                                data-step="3" data-prevstep="2">Previous</a></li>
                                                        <li><a href="javascript:;" class="nxt-prv-btn next-step"
                                                                data-step="3" data-nextstep="4">next</a></li>
                                                        <!-- <li><button type="button" class="nxt-prv-btn">book</button></li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="booked-step-process-box tab-pane" id="step4"
                                            style="display:none">
                                            <div class="step-box-person">
                                                <div class="date-pick-caln time-pick-wrap">
                                                    <div class="time-pick-head">choose your Table</div>
                                                    <input type="hidden" name="booking_table_id" id="booking_table_id">
                                                    <input type="hidden" name="booking_table_name"
                                                        id="booking_table_name">
                                                    <div id="book_table_section"> </div>
                                                </div>
                                                <div class="nxt-prv-btn-wrap">
                                                    <ul class="d-flex justify-content-between">
                                                        <li><a href="javascript:;" class="nxt-prv-btn prev-step"
                                                                data-step="4" data-prevstep="3">Previous</a></li>
                                                        <li><a href="javascript:;" class="nxt-prv-btn next-step"
                                                                data-step="4" data-nextstep="5">next</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="booked-step-process-box tab-pane" id="step5"
                                            style="display:none">
                                            <div class="step-box-person">
                                                <div class="date-pick-caln time-pick-wrap">
                                                    <div class="time-pick-head">Customer Details</div>
                                                    <div class="process-details-gaust">
                                                        <div class="row g-3">
                                                            <div class="gaust-input-wrap">
                                                                <input type="text" name="customer_name"
                                                                    id="customer_name"
                                                                    class="form-control gaust-input-style"
                                                                    placeholder="Customer Name">
                                                            </div>
                                                            <div class="gaust-input-wrap">
                                                                <input name="customer_phone" id="customer_phone"
                                                                    type="tel" class="form-control gaust-input-style"
                                                                    placeholder="Enter Phone">
                                                            </div>
                                                            <div class="gaust-input-wrap">
                                                                <input type="E-Mail" name="customer_email"
                                                                    id="customer_email"
                                                                    class="form-control gaust-input-style"
                                                                    placeholder="E-mail">
                                                            </div>
                                                            <div class="gaust-txtare-wrap">
                                                                <textarea rows="4" name="customer_special_request" id="customer_special_request"
                                                                    class="form-control gaust-txtare-style" placeholder="Special Request (Optional)"></textarea>
                                                            </div>
                                                            <div class="capchaArea">
                                                                <div class="help-captcha w-100">
                                                                    <div class="g-recaptcha"
                                                                        data-sitekey="6LfgCMkjAAAAADdDPhZ5iH196OjreIraMlGtlCX4"
                                                                        data-callback="recaptchaCallback"
                                                                        data-expired-callback="recaptchaExpired"></div>
                                                                    <input id="hidden-grecaptcha" name="hidden-grecaptcha"
                                                                        type="text"
                                                                        style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;" />
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- For Mobile Details --}}
                                                <div class="mobile-only-details d-block d-lg-none">
                                                    <h4>booking details</h4>
                                                    <div class="booked-detls">
                                                        <div class="booked-detls-lft">
                                                            <div class="booked-detls-head">total person</div>
                                                        </div>
                                                        <div class="booked-detls-rgt">
                                                            <div class="booked-detls-dtls">: <span
                                                                    class="total-booked-person" id=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="booked-detls">
                                                        <div class="booked-detls-lft">
                                                            <div class="booked-detls-head">date</div>
                                                        </div>
                                                        <div class="booked-detls-rgt">
                                                            <div class="booked-detls-dtls">: <span
                                                                    class="total-booked-person" id=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="booked-detls">
                                                        <div class="booked-detls-lft">
                                                            <div class="booked-detls-head">time</div>
                                                        </div>
                                                        <div class="booked-detls-rgt">
                                                            <div class="booked-detls-dtls">: <span
                                                                    class="total-booked-person" id=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="booked-detls">
                                                        <div class="booked-detls-lft">
                                                            <div class="booked-detls-head">Table</div>
                                                        </div>
                                                        <div class="booked-detls-rgt">
                                                            <div class="booked-detls-dtls">: <span
                                                                    class="total-booked-person" id=""></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="booked-text">
                                                        <h5>User Details</h5>
                                                        <div class="user-details-wrap" id=""></div>
                                                        <div class="user-details-wrap" id=""></div>
                                                        <div class="user-details-wrap" id=""></div>
                                                    </div>
                                                    <div class="booked-text" id="" style="display:none;">
                                                        <h5>Special Request</h5>
                                                        <p id=""></p>
                                                    </div>
                                                </div>
                                                <div class="nxt-prv-btn-wrap">
                                                    <ul class="d-flex justify-content-between">
                                                        <li><a href="javascript:;" class="nxt-prv-btn prev-step"
                                                                data-step="5" data-prevstep="4">Previous</a></li>
                                                        <li><a href="javascript:;" class="nxt-prv-btn next-step"
                                                                data-step="5">Submit</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-book-wrap-rgt d-none d-lg-block">
                                    <div class="table-book-dtls-wrap">
                                        <h4>booking details</h4>
                                        <div class="booked-detls">
                                            <div class="booked-detls-lft">
                                                <div class="booked-detls-head">total person</div>
                                            </div>
                                            <div class="booked-detls-rgt">
                                                <div class="booked-detls-dtls">: <span class="total-booked-person"
                                                        id="total-booked-person-view"></span></div>
                                            </div>
                                        </div>
                                        <div class="booked-detls">
                                            <div class="booked-detls-lft">
                                                <div class="booked-detls-head">date</div>
                                            </div>
                                            <div class="booked-detls-rgt">
                                                <div class="booked-detls-dtls">: <span class="total-booked-person"
                                                        id="booked-date-view"></span></div>
                                            </div>
                                        </div>
                                        <div class="booked-detls">
                                            <div class="booked-detls-lft">
                                                <div class="booked-detls-head">time</div>
                                            </div>
                                            <div class="booked-detls-rgt">
                                                <div class="booked-detls-dtls">: <span class="total-booked-person"
                                                        id="booked-time-view"></span></div>
                                            </div>
                                        </div>
                                        <div class="booked-detls">
                                            <div class="booked-detls-lft">
                                                <div class="booked-detls-head">Table</div>
                                            </div>
                                            <div class="booked-detls-rgt">
                                                <div class="booked-detls-dtls">: <span class="total-booked-person"
                                                        id="booked-table-view"></span></div>
                                            </div>
                                        </div>
                                        {{--
                                          <div class="booked-detls">
                                                <div class="booked-detls-lft">
                                              <div class="booked-detls-head">Customer Name</div>
                                            </div>
                                                <div class="booked-detls-rgt">
                                              <div class="booked-detls-dtls">: <span class="total-booked-person" id="booked-customer_name-view"></span></div>
                                            </div>
                                              </div>
                                          <div class="booked-detls">
                                                <div class="booked-detls-lft">
                                              <div class="booked-detls-head">Customer Phone</div>
                                            </div>
                                                <div class="booked-detls-rgt">
                                              <div class="booked-detls-dtls">: <span class="total-booked-person" id="booked-customer_phone-view"></span></div>
                                            </div>
                                              </div>
                                          <div class="booked-detls">
                                                <div class="booked-detls-lft">
                                              <div class="booked-detls-head">Customer E-mail</div>
                                            </div>
                                                <div class="booked-detls-rgt">
                                              <div class="booked-detls-dtls">: <span class="total-booked-person" id="booked-customer_email-view"></span></div>
                                            </div>
                                              </div>
                                          --}}
                                        <div class="booked-text">
                                            <h5>User Details</h5>
                                            <div class="user-details-wrap" id="booked-customer_name-view"></div>
                                            <div class="user-details-wrap" id="booked-customer_phone-view"></div>
                                            <div class="user-details-wrap" id="booked-customer_email-view"></div>
                                        </div>
                                        <div class="booked-text" id="customer_special_request_view_sec"
                                            style="display:none;">
                                            <h5>Special Request</h5>
                                            <p id="booked-customer_special_request-view"></p>
                                        </div>
                                        <!--<div class="booked-text">
                                                                              <h5>Important Note</h5>
                                                                              <ul class="note-list">
                                                                                <li>Lorem ipsum dolor sit amet</li>
                                                                                <li>Lorem ipsum dolor sit amet</li>
                                                                                <li>Lorem ipsum dolor sit amet</li>
                                                                              </ul>
                                                                            </div>-->
                                        <!--<div class="crt-book-btn-wrap" id="booking_details_submit_sec">
                                                                                <button type="button" class="crt-book-btn">submit</button>
                                                                              </div>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <a class="hotel-bookmark-list-btn without-login-tablebook"
                            href="{{ url('/signup/?redirect_to=' . $store_url . '/?p=book_table') }}">For Table Booking
                            Click
                            here to login</a>
                    @endif
                </div>
            @endif
            @if (count($merchant_item_list) > 0)
                <div class="booked_food"
                    @if (count($store_table) > 0) @if ($p == 'book_table')style="display:none; @endif
                    @endif">
                    <div class="row g-2 g-lg-3">
                        <button type="button" class="mobile-cata-filter mobile_cata_btn" style=""><i
                                class="fa-solid fa-utensils"></i> catagory</button>
                        <div class="hotel-menu-lft cata_lft">
                            <button type="button" class="mobile-cata-filter-close cata_btn_close"><i
                                    class="fa-solid fa-xmark"></i></button>
                            <div class="hotel-menu-lft-wrap sticky-bar">
                                <div class="hotel-menu-lft-head">
                                    <h4>Menu</h4>
                                </div>
                                <ul class="src-time-rslt">
                                    <li>11:00 AM to 11:00 PM</li>
                                </ul>
                                <div class="hotel-menu-catagory">
                                    <div class="hotel-menu-lft-head">
                                        <h4>Picked For You</h4>
                                    </div>
                                    <ul class="menu-catagory-list">
                                        @if (count($category_list) > 0)
                                            @php($count = 0)
                                            @foreach ($category_list as $c_row)
                                                <li class="@if ($count == 0) active @endif cat_btn"
                                                    data-id="{{ $c_row->cat_id }}"><a
                                                        href="javascript:;">{{ $c_row->category_name }}</a></li>
                                                @php($count++)
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="menu-booking-list-wrap">
                            @if (count($item_list) > 0)
                                @php($count = 0)
                                @foreach ($item_list as $c_row)
                                    <div class="item_cat_sec" id="item_cat-{{ $c_row['cat_id'] }}"
                                        @if ($count != 0) style="display:none" @endif>
                                        <div class="hotel-menu-lft-head mb-3">
                                            <h4>{{ $c_row['category_name'] }}</h4>
                                        </div>
                                        <div class="hotel-pick-liswrap">
                                            @if (count($c_row['items']) > 0)
                                                @foreach ($c_row['items'] as $row)
                                                    <div class="hotel-pick-list flex-wrap">
                                                        <div class="hotel-pick-list-lft">
                                                            <div class="pick-hotel-desc">
                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div class="pick-hotel-title">
                                                                        <h4>{{ $row['item_name'] }}</h4>
                                                                    </div>
                                                                    <div class="pick-hotel-price">
                                                                        <h5>$ {{ $row['price'] }}</h5>
                                                                    </div>
                                                                </div>
                                                                <p>{{ $row['item_description'] }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="hotel-pick-list-rgt position-relative"> <img
                                                                class="img-block" src="{{ $row['photo'] }}"
                                                                alt=""> <span class="pick-add-wrap"> <a
                                                                    class="pick-add-btn" href="javascript:;"
                                                                    onclick="addtocart('{{ $row['item_id'] }}','{{ $store_id }}','{{ $c_row['cat_id'] }}')">add<i
                                                                        class="fa-solid fa-plus"></i></a> </span> </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @php($count++)
                                @endforeach
                            @endif
                        </div>
                        <div class="cart-wrap-details">
                            <div class="cart-wrap-box sticky-bar">
                                <div class="cart-wrap-head">
                                    <h4>Cart<span class="sm-text total_cart_item_count">{{ $total_cart_item }}
                                            Items</span></h4>
                                </div>
                                <div class="cart-wrap-body cart_items_section">
                                    @if (count($cartinfo) > 0)
                                        @foreach ($cartinfo as $cart)
                                            <div class="crt-product-list d-flex justify-content-between align-items-center"
                                                id="cart-item-{{ $cart['cart_id'] }}">
                                                <div class="crt-product-name">
                                                    <div class="prod-name-dtls item-veg">
                                                        <h3><a href="javascript:;">{{ $cart['name'] }}</a></h3>
                                                        <!--<p>[serves 1-2]</p>-->
                                                    </div>
                                                </div>
                                                <div class="crt-product-qty">
                                                    <div class="d-flex qty-item-add align-items-center priceControl">
                                                        <button type="button" class="qty-add sub controls2"
                                                            value="-" data-id="{{ $cart['cart_id'] }}"><i
                                                                class="fa-solid fa-minus"></i></button>
                                                        <input type="number"
                                                            class="form-control qty-show count qty qtyInput2"
                                                            value="{{ $cart['quantity'] }}" min="1"
                                                            max="20" data-max-lim="20">
                                                        <button type="button" class="qty-add add controls2"
                                                            value="+" data-id="{{ $cart['cart_id'] }}"><i
                                                                class="fa-solid fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="crt-product-price">
                                                    <h3 id="grand_total-{{ $cart['cart_id'] }}">
                                                        ${{ $cart['grand_total'] }}</h3>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <!--<div class="crt-product-list d-flex justify-content-between align-items-center">
                                                                <div class="crt-product-name">
                                                                  <div class="prod-name-dtls item-veg">
                                                                    <h3><a href="#">Mutton Biriyani</a></h3>
                                                                    <p>[serves 1-2]</p>
                                                                  </div>
                                                                </div>
                                                                <div class="crt-product-qty">
                                                                  <div class="d-flex qty-item-add align-items-center">
                                                                    <button type="button" class="qty-add"><i class="fa-solid fa-minus"></i></button>
                                                                    <input type="number" class="form-control qty-show" value="1">
                                                                    <button type="button" class="qty-add"><i class="fa-solid fa-plus"></i></button>
                                                                  </div>
                                                                </div>
                                                                <div class="crt-product-price">
                                                                  <h3><i class="fa-solid fa-indian-rupee-sign"></i> 5689.00</h3>
                                                                </div>
                                                              </div>-->
                                </div>
                                <div class="cart-wrap-ftr" id="cart_checkout_section"
                                    @if ($total_cart_item == 0) style="display:none;" @endif>
                                    <ul class="d-flex justify-content-between">
                                        <li>
                                            <h4>Sub Total</h4>
                                            <!--<p>Extra Chrges May Apply</p>-->
                                        </li>
                                        <li>
                                            <h4 class="cart_subtotal"> ${{ $total_cart_amount }}</h4>
                                        </li>
                                    </ul>
                                    <div class="crt-book-btn-wrap cart_checkout_btn_section">
                                        @if (Auth::user() && $user_type == 3)
                                            <a href="{{ $checkout_url }}" class="crt-book-btn checkout_btn">checkout</a>
                                        @else
                                            <a href="{{ url('/signup/?redirect_to=' . $checkout_url) }}"
                                                class="crt-book-btn checkout_btn">checkout</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-booking-wrap" style="display: none;">
                            <div class="table-booking-box sticky-bar">
                                <h3>Book Table</h3>
                                <ul class="table-book-step d-flex">
                                    <li class="active">
                                        <button type="button" class="table-process"><i
                                                class="fa-regular fa-calendar-days"></i></button>
                                    </li>
                                    <li>
                                        <button type="button" class="table-process"><i
                                                class="fa-regular fa-clock"></i></button>
                                    </li>
                                    <li>
                                        <button type="button" class="table-process"><i
                                                class="fa-regular fa-user"></i></button>
                                    </li>
                                    <li>
                                        <button type="button" class="table-process"><i
                                                class="fa-solid fa-info"></i></button>
                                    </li>
                                </ul>
                                <div class="step3" style="display: none;">
                                    <div class="process-details">
                                        <div class="process-details-head">
                                            <h4>How many people</h4>
                                        </div>
                                        <div class="process-details-people">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">1</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">2</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box active">3</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">4</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">5</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">6</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">7</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">8</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">9</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">10</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">11</div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                                                    <div class="details-people-box">12</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="process-more-opt">
                                            <button type="button" class="process-more-opt-btn">More Option<i
                                                    class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="step4" style="display: block;">
                                    <div class="process-details">
                                        <div class="process-details-head">
                                            <h4>Guest Details</h4>
                                        </div>
                                        <div class="process-details-gaust">
                                            <div class="row g-3">
                                                <div class="gaust-input-wrap">
                                                    <input type="text" class="form-control gaust-input-style"
                                                        placeholder="Customer Name">
                                                </div>
                                                <div class="gaust-input-wrap">
                                                    <input name="phone" type="tel" id="phone_prifix"
                                                        class="form-control gaust-input-style">
                                                    <!-- <input type="number" class="form-control gaust-input-style" placeholder="Phone No."> -->
                                                </div>
                                                <div class="gaust-input-wrap">
                                                    <input type="E-Mail" class="form-control gaust-input-style"
                                                        placeholder="E-mail">
                                                </div>
                                                <div class="gaust-txtare-wrap">
                                                    <textarea rows="4" class="form-control gaust-txtare-style" placeholder="Special Request (Optional)"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-book-btn-wrap">
                                            <button type="button" class="table-book-btn">book now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <div class="pick-table-cart-wrap" style="display: none;">
        <div class="pick-table-cart">
            <div class="small-sec-heading2">
                <h4>Cart<span class="sm-text">(8 Items)</span></h4>
            </div>
            <div class="pick-table-cart-list">
                <div class="accordion">
                    <div class="accordion-item">
                        <div class="accordion-header" id="foodList">
                            <div class="accordion-button">
                                <div class="cart-list-wrap">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex">
                                                <div class="food-type food-veg"> <i class="fa-regular fa-circle-dot"></i>
                                                </div>
                                                <div class="food-name">
                                                    <h4>Lorem Ipsum</h4>
                                                    <p>Lorem Ipsum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex qty-add-wrap">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="qty-show" value="1">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="food-price">
                                                <p class="discount-price">$ 152</p>
                                                <p class="total-price">$ 99</p>
                                            </div>
                                        </div>
                                        <div class="pick-arrow">
                                            <button data-bs-toggle="collapse" data-bs-target="#cartFood"><i
                                                    class="fa-solid fa-angle-up"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cartFood" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="cart-list-wrap">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex">
                                                <div class="food-type food-nonveg"> <i
                                                        class="fa-regular fa-circle-dot"></i> </div>
                                                <div class="food-name">
                                                    <h4>Lorem Ipsum</h4>
                                                    <p>Lorem Ipsum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex qty-add-wrap">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="qty-show" value="1">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="food-price">
                                                <p class="discount-price">$ 152</p>
                                                <p class="total-price">$ 99</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-list-wrap">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex">
                                                <div class="food-type food-nonveg"> <i
                                                        class="fa-regular fa-circle-dot"></i> </div>
                                                <div class="food-name">
                                                    <h4>Lorem Ipsum</h4>
                                                    <p>Lorem Ipsum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex qty-add-wrap">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="qty-show" value="1">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="food-price">
                                                <p class="discount-price">$ 152</p>
                                                <p class="total-price">$ 99</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-list-wrap">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex">
                                                <div class="food-type food-veg"> <i class="fa-regular fa-circle-dot"></i>
                                                </div>
                                                <div class="food-name">
                                                    <h4>Lorem Ipsum</h4>
                                                    <p>Lorem Ipsum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex qty-add-wrap">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="qty-show" value="1">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="food-price">
                                                <p class="discount-price">$ 152</p>
                                                <p class="total-price">$ 99</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-list-wrap">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex">
                                                <div class="food-type food-nonveg"> <i
                                                        class="fa-regular fa-circle-dot"></i> </div>
                                                <div class="food-name">
                                                    <h4>Lorem Ipsum</h4>
                                                    <p>Lorem Ipsum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex qty-add-wrap">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="qty-show" value="1">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="food-price">
                                                <p class="discount-price">$ 152</p>
                                                <p class="total-price">$ 99</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-list-wrap">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <div class="d-flex">
                                                <div class="food-type food-veg"> <i class="fa-regular fa-circle-dot"></i>
                                                </div>
                                                <div class="food-name">
                                                    <h4>Lorem Ipsum</h4>
                                                    <p>Lorem Ipsum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="d-flex qty-add-wrap">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-minus"></i></button>
                                                <input type="number" class="qty-show" value="1">
                                                <button type="button" class="qty-add"><i
                                                        class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="food-price">
                                                <p class="discount-price">$ 152</p>
                                                <p class="total-price">$ 99</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="total-order-food">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="subtotal-name">
                                <h4>Lorem Ipsum</h4>
                                <p>Lorem Ipsum</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="subtotal-amount">
                                <ul class="d-flex align-items-center">
                                    <li><span class="discount-price">$ 400</span> <strong>$ 200</strong></li>
                                    <li>
                                        <button type="button" class="total-chkout">Check Out</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var merchant_id = '{{ $store_id }}';
        </script>
        <script src="{{ asset('public/front/js/search.js/?t=' . time()) }}"></script>
        <script src="{{ asset('public/front/js/user.js/?t=' . time()) }}"></script>
        <script src="{{ asset('public/front/js/table_booking.js/?t=' . time()) }}"></script>
        <script src="{{ asset('public/front/js/cart.js/?t=' . time()) }}"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        
        <script>
		$(document).on('click', '.no_table_booking_avaible', function(){
			swal("Sorry", "Table booking not available at this moment!", "error");
		});
		$(document).on('click', '.no_food_order_avaible', function(){
			swal("Sorry", "Food order currently not available at this moment!", "error");
		});
		
		
		</script>
        
        
        
        <script>
            $(document).on('click', '.cat_btn', function() {
                $('.cat_btn').removeClass('active');
                $(this).addClass('active');
                var id = $(this).data('id');
                $('.item_cat_sec').hide();
                $('#item_cat-' + id).show();
            });
        </script>
        <script>
            $(document).on('click', '.mobile_cata_btn', function() {
                $(this).hide();
                $('.cata_lft').addClass('cata_open');
                $('body').append(`<div class="modal-backdrop fade show"></div>`).addClass("sort-popup");
            });
            $(document).on('click', '.cata_btn_close', function() {
                $('.mobile_cata_btn').show();
                $('.cata_lft').removeClass('cata_open');
                $('body').removeClass("sort-popup");
                $('body').find('.modal-backdrop').remove();
            });
        </script>
    @endpush
@endsection
