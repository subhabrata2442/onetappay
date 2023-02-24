@extends('layouts.front.frontLayout')
@section('frontContent')
@include('front.templates.login_regis_header')
<!-- <section class="home-banner position-relative"> <span class="plate-img"> <img class="img-block" src="{{ asset('public/front/images/plate.png') }}" alt=""> </span> </section> -->
<section class="regBanner" style="background: url(./public/front/images/logBanner.jpg) center center no-repeat"></section>
<section>
  <div class="sections section-grey2">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ">
          <div class="search-wraps">
            <h1>Restaurant Signup</h1>
            <span class="login_link">Already have an account <a href="{{url('/merchant_admin')}}">login</a> here</span>
          </div>
          <div class="box-grey round top-line-green">
            <form class="forms has-validation-callback" action="{{route('merchant.signup.save')}}" method="POST" id="merchant_form" onsubmit="return false;">
              @csrf
              <div class="row top10">
                <div class="col-md-3 ">Restaurant name</div>
                <div class="col-md-9 has-error">
                  <input class="grey-fields full-width error" type="text" value="" name="restaurant_name" id="restaurant_name">
                  <!--<span class="help-block form-error">You have not answered all required fields</span>--></div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Restaurant phone</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" type="text" value="" name="restaurant_phone" id="restaurant_phone">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Contact name</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="required" type="text" value="" name="contact_name" id="contact_name">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Contact phone</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="required" type="text" value="" name="contact_phone" id="contact_phone">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Contact email</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="email" type="text" value="" name="contact_email" id="contact_email">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                  <p class="text-muted text-small">Important: Please enter your correct email. we will sent an activation code to your email</p>
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Street address</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="required" type="text" value="" name="street" id="street">
                  <input type="hidden" name="lat" id="lat">
                  <input type="hidden" name="lng" id="lng">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">City</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="required" type="text" value="" name="city" id="locality">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Post code/Zip code</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="required" type="text" value="" name="post_code" id="post_code">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Country</div>
                <div class="col-md-9">
                  <select class="grey-fields full-width" data-validation="required" name="country_code" id="country_code">
                    <option value="AF">Afghanistan</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="BQ">British Antarctic Territory</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="VG">British Virgin Islands</option>
                    <option value="BN">Brunei</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CT">Canton and Enderbury Islands</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos [Keeling] Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo - Brazzaville</option>
                    <option value="CD">Congo - Kinshasa</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="CI">Côte d’Ivoire</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="NQ">Dronning Maud Land</option>
                    <option value="DD">East Germany</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="FQ">French Southern and Antarctic Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong SAR China</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JT">Johnston Island</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Laos</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macau SAR China</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="FX">Metropolitan France</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MI">Midway Islands</option>
                    <option value="MD">Moldova</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar [Burma]</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="AN">Netherlands Antilles</option>
                    <option value="NT">Neutral Zone</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="KP">North Korea</option>
                    <option value="VD">North Vietnam</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PC">Pacific Islands Trust Territory</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territories</option>
                    <option value="PA">Panama</option>
                    <option value="PZ">Panama Canal Zone</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="YD">People's Democratic Republic of Yemen</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn Islands</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russia</option>
                    <option value="RW">Rwanda</option>
                    <option value="RE">Réunion</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="CS">Serbia and Montenegro</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="KR">South Korea</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syria</option>
                    <option value="ST">São Tomé and Príncipe</option>
                    <option value="TW">Taiwan</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UM">U.S. Minor Outlying Islands</option>
                    <option value="PU">U.S. Miscellaneous Pacific Islands</option>
                    <option value="VI">U.S. Virgin Islands</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="SU">Union of Soviet Socialist Republics</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US" selected="selected">United States</option>
                    <option value="ZZ">Unknown or Invalid Region</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VA">Vatican City</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Vietnam</option>
                    <option value="WK">Wake Island</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                    <option value="AX">Åland Islands</option>
                  </select>
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">State/Region</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" data-validation="required" type="text" value="" name="state" id="state">
                </div>
              </div>
              <!--<div class="row top10">
                <div class="col-md-3">Cuisine</div>
                <div class="col-md-8">
                  <select class="full-width chosen" multiple="multiple" data-validation="required" name="cuisine[]" id="cuisine" style="display: none;">
                    <option value="1">American</option>
                    <option value="2">Deli</option>
                    <option value="3">Indian</option>
                    <option value="4">Mediterranean</option>
                    <option value="14">Middle Eastern</option>
                    <option value="6">Barbeque</option>
                    <option value="5">Sandwiches</option>
                    <option value="13">Japanese</option>
                    <option value="7">Diner</option>
                    <option value="8">Italian</option>
                    <option value="9">Mexican</option>
                    <option value="10">Sushi</option>
                    <option value="11">Burgers</option>
                    <option value="12">Greek</option>
                    <option value="20">Vegetarian</option>
                    <option value="15">Thai</option>
                    <option value="21">cscs</option>
                    <option value="16">Chinese</option>
                    <option value="17">Healthy</option>
                    <option value="18">Korean</option>
                    <option value="19">Pizza</option>
                  </select>
                  <div class="chosen-container chosen-container-multi" style="width: 462px;" title="" id="cuisine_chosen">
                    <ul class="chosen-choices">
                      <li class="search-field">
                        <input type="text" value="Select Some Options" class="default" autocomplete="off" style="width: 147px;">
                      </li>
                    </ul>
                    <div class="chosen-drop">
                      <ul class="chosen-results">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>-->
              <div class="row top10">
                <div class="col-md-3">Services Pick Up or Delivery?</div>
                <div class="col-md-9">
                  <select class="grey-fields full-width" data-validation="required" name="service" id="service">
                    <option value="1">Delivery &amp; Pickup</option>
                    <option value="2">Delivery Only</option>
                    <option value="3">Pickup Only</option>
                    <option value="4">Delivery / Pickup / Dinein</option>
                    <option value="5">Delivery &amp; Dinein</option>
                    <option value="6">Pickup &amp; Dinein</option>
                    <option value="7">Dinein Only</option>
                  </select>
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Delivery Distance Covered</div>
                <div class="col-md-3">
                  <input placeholder="" class="numeric_only form-control" data-validation="required" type="text" value="" name="delivery_distance_covered" id="delivery_distance_covered" required="required">
                </div>
                <div class="col-md-3">
                  <select class="form-control" name="distance_unit" id="distance_unit">
                    <option value="mi" selected="selected">Miles</option>
                    <option value="km">Kilometers</option>
                  </select>
                </div>
              </div>
              <!--<div class="top15">
                <div class="section-label"> <a class="section-label-a"> <span class="bold"> Commission Type</span> <b></b> </a> </div>
              </div>-->
              <!--<div class="row top10">
                <div class="col-md-3">Type</div>
                <div class="col-md-8">
                  <select class="grey-fields full-width merchant_type_selection" data-validation="required" name="merchant_type" id="merchant_type">
                    <option value="2">Commission</option>
                    <option value="3">Commission+Invoice</option>
                  </select>
                </div>
              </div>-->
              <!--<div class="row top10 invoice_terms_wrap">
                <div class="col-md-3">Invoice Terms</div>
                <div class="col-md-8">
                  <select class="grey-fields full-width" data-validation="required" name="invoice_terms" id="invoice_terms">
                    <option value="1">Daily</option>
                    <option value="7">Weekly</option>
                    <option value="15">Every 15 Days</option>
                    <option value="30">Every 30 Days</option>
                  </select>
                </div>
              </div>-->
              <div class="top15">
                <div class="section-label"> <a class="section-label-a"> <span class="bold"> Login Information</span> <b></b> </a> </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Email</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" type="email" value="" name="email" id="email">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Password</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" type="password" value="" name="password" id="password">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3">Confirm Password</div>
                <div class="col-md-9">
                  <input class="grey-fields full-width" type="password" value="" name="password_confirmation" id="password_confirmation">
                </div>
              </div>
              <div class="row top10">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                  <input type="submit" value="Next" class="orange-button inline medium">
                </div>
              </div>
            </form>
          </div>
          <!--box-grey-->

        </div>
        <!--col-->

      </div>
      <!--row-->
    </div>
    <div class="regModel"><img class="img-block" src="{{ asset('public/front/images/logModel.jpg') }}" alt=""></div>
    <!--container-->
  </div>
</section>
@push('scripts')
<script src="{{ asset('public/front/js/store.js/?t='.time()) }}"></script>
@endpush
@endsection