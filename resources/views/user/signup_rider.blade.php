@extends('templatesign')

@section('main')

<style>
    #gender_options {
        color: gray !important;
    }
    #gender_options option{
        color: black;
    }
</style>


<div id="app-wrapper" class="signup-riders" ng-controller="facebook_account_kit">
   @include('user.otp_popup')
 <!--  <header class="funnel" style="background:url('images/blue-global.png') center center repeat;" >
    <div class="bit bit--logo text--center">
      <a href="{{ url('/') }}">
       <img class="white_logo" src="{{ $logo_url }}" style="width: 109px; height: 50px;background-size: contain;">
     </a> 
   </div>
 </header>  --> 
 <section class="content-signupdrive" margin-top:3em; style="background-color:#006161">

  <div class="signup-wrapper cls_signuprider">
    <div class="stage" style="margin-top: 10px;">
      <section class="signup-top">
        <div class="signup-top-text">
          <h2 class="text-center m-b-12">{{trans('messages.footer.siginup_ride')}}</h2>
          <p style="font-size: 150%; margin-bottom: 40px;" align="center">{{trans('messages.user.safe_reliable')}}</p>
        </div>
      </section>
      <div class="form-wrapper text_frm">
      <form action="{{ url('rider_register') }}" 
      method="POST" 
      id="form">
    <input type="hidden" name="fb_id" id="fb_id" value="{{ @$user['fb_id'] }}">
    @csrf
    <input type="hidden" name="request_type" id="request_type" value="">
    <input type="hidden" name="otp" id="otp" value="">


        <input type="hidden" name="user_type" value="Rider">
        <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
          <div class="filed-half res-full col-md-12 input-group">
            <div class="field">
              <label class="field__label" for="fname">{{trans('messages.user.firstname')}}</label>
             <input type="text" name="first_name" id="fname" class="form-control one-column-form__input--text" placeholder="{{ trans('messages.user.firstname') }}" value="{{ @$user['first_name'] }}">
            </div>
            <span class="text-danger first_name_error">{{ $errors->first('first_name') }}</span>
          </div>
        </div>
          <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
          <div class="filed-half  res-full col-md-12 clearfix">
            <div class="field">
              <label class="field__label" for="lname">{{trans('messages.user.lastname')}}</label>
              <input type="text" name="last_name" id="lname" class="form-control one-column-form__input--text" placeholder="{{ trans('messages.user.lastname') }}" value="{{ @$user['last_name'] }}">
            </div>
            <span class="text-danger last_name_error">{{ $errors->first('last_name') }}</span>
          </div>
        </div>
        <div class="layout col-md-12 layout--flush float mobile-container left two-char" ng-init="old_country_code={{old('country_code')!=null? old('country_code') : '1'}}">
          <div class="layout__item" id="country">
            <div id="select-title-stage">{{old('country_code')!=null? '+'.old('country_code') : '+1'}}</div>
            <div class="select select--xl">
              <label for="mobile-country"><div class="flag US"></div></label>
              <select name="country_code" tabindex="-1" id="mobile_country" class="square borderless--right">
                @foreach($country as $key => $value)
                <option value="{{$value->phone_code}}" {{ ($value->id == (old('country_id')!=null? old('country_id') : '1')) ? 'selected' : ''  }} data-value="+{{ $value->phone_code}}" data-id="{{ $value->id }}">{{ $value->long_name}}
                </option>
                @endforeach
                <input type="hidden" name="country_id" id="country_id" value="{{ old('country_id') }}">
              </select> 
              <span class="text-danger country_code_error">{{ $errors->first('country_code') }}</span>               
            </div>
          </div>
          <div class="layout__item number">
            <div class="input-group icon-input right ">
              <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
                <div class="field" ng-init="old_mobile_number='{{old('mobile_number')!=null?old('mobile_number'):''}}'">
                  <label class="field__label" for="mobile" style="padding-left:0px;font-weight:bold;margin-top: 0px !important;">{{trans('messages.profile.mobile')}}</label>
                  <input type="tel" name="mobile_number" id="mobile" class="form-control one-column-form__input--text" placeholder="{{ trans('messages.profile.mobile') }}" maxlength="15" style="margin:0px !important">
                  <i class="fa fa-mobile inside-ion" aria-hidden="true" style="font-size: 16px;"></i>
                </div>
                <span class="text-danger mobile_number_error">{{ $errors->first('mobile_number') }}</span>
                <span class="text-danger mobile-text-danger" style="display: none">Mobile Number is required</span>             
              </div>
            </div>
          </div>
        </div>

        <div class="input-group icon-input right cls_select">
          <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
            <div class="field ">
              <select name="gender" id="gender_options" class=" form-control">
                  <option value="" disabled selected hidden>{{ __('messages.driver_dashboard.select').' '.__('messages.profile.gender') }}</option>
                  <option value="1">{{ __('messages.profile.male') }}</option>
                  <option value="2">{{ __('messages.profile.female') }}</option>
              </select>
            </div>
            <span class="text-danger gender_error">{{ $errors->first('gender') }}</span>
          </div>
        </div>

        <div class="input-group icon-input right ">
          <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
            <div class="field">
              <label class="field__label" for="input-email">{{trans('messages.user.email')}}</label>
              
             <input type="text" name="email" id="input-email" class="form-control one-column-form__input--text" placeholder="{{ trans('messages.user.email') }}" style="margin:0px !important">
              <i class="fa fa-envelope inside-ion" aria-hidden="true" style="font-size: 11px;"></i>
            </div>
            <span class="text-danger email_error">{{ $errors->first('email') }}</span>
          </div>
        </div>

        <div class="input-group icon-input right ">
          <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
            <div class="field">
              <label class="field__label" for="password">{{trans('messages.user.paswrd')}}</label>            
              <input type="password" name="password" id="password" class="form-control one-column-form__input--text" placeholder="{{ trans('messages.user.paswrd') }}" style="margin:0px !important">
              <i class="fa fa-lock inside-ion" aria-hidden="true" style="font-size: 13px;"></i>
            </div>
            <span class="text-danger password_error">{{ $errors->first('password') }}</span>
          </div>
        </div>
        <div class="input-group icon-input right ">
          <div class="layout layout--flush col-md-12 container-field clearfix push-small--bottom">
            <div class="field">
              <label class="field__label" for="referral_code">
                {{trans('messages.referrals.referral_code')}}
              </label>
              <input type="text" name="referral_code" id="referral_code" class="_style_3vhmZK text-uppercase form-control" placeholder="{{ trans('messages.referrals.referral_code') }}">
              <i class="fa fa-user-plus inside-ion" aria-hidden="true" style="font-size: 13px;"></i>
            </div>
            <span class="text-danger referral_code_error">{{ $errors->first('referral_code') }}</span>
          </div>
        </div>
        <div class="text--center" id="captcha-form-container" style="display: none;">
          <div id="captcha" class="push--bottom display--inline-block text--center"></div>
        </div>

        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="code" id="code" />

        @php
        $submit_method = site_settings('otp_verification') ? 'send_otp':'check_otp';
        @endphp

        <button id="submit-btn" ng-click="showPopup('{{$submit_method}}');" type="button" class="btn btn--full btn--primary btn--large btn--arrow signup-btn">
          <span class="float--left push-small--right">{{trans('messages.home.siginup')}}</span>
          <i class="fa fa-long-arrow-right icon icon_right-arrow-thin"></i>
        </button>
        </form>
        <p class="push-tiny--top legal">{{trans('messages.user.clicking_terms')}}
          <a href="{{ url('terms_of_service')}}">{{$site_name}}{{trans('messages.user.terms')}} </a> {{trans('messages.user.and')}} 
          <a href="{{ url('privacy_policy')}}">{{trans('messages.user.privacy')}}</a>
          .</p>
          <div class="small push-small--bottom push-small--top" id="sign-up-link-only" data-reactid="26">
            <p class=" display--inline email_phone-sec" data-reactid="27"><a href="{{ url('signin_rider')}}">{{trans('messages.ride.already_have_account')}} </a></p>
            <p class="pull-right forgot password-sec hide">
             <a href="{{ url('forgot_password_rider')}}" class="forgot-password">{{trans('messages.user.forgot_paswrd')}}</a>
           </p>
         </div>

       </div>
     </div>
   </section>
 </div>

 
</main>
<style>

.funnel
{
  height: 0px !important;
}


</style>
@stop
