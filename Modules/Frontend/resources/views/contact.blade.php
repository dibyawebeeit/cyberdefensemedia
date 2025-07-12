@extends('frontend::layouts.master')
@section('title','Contact')
@section('content')

<div class="inner-template contact-template">
    <section class="inner-bannr contact-bannr">
        <div class="container">
           <div class="row">
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
                    <h1 class="innr-bnt-title">Contact Us</h1>
                </div>                
           </div>
        </div>
    </section>
    <section class="contact-row-two p-t-60 p-b-60">
        <div class="container">
            <div class="row row-contact row-col-center">
                <div class="col-cmn col-lg-10 col-md-12 col-sm-12 one">  
                        <div class="section-content">
                        <h2 class="wp-block-heading has-text-align-center">Contact Us</h2>
                        <div class="wp-block-contact-form-7-contact-form-selector">
                        <div class="wpcf7 js" id="wpcf7-f45-o1" lang="en-US" dir="ltr" data-wpcf7-id="45">
                        <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
                        <form method="post" action="{{route('submit_contact')}}" class="wpcf7-form init" aria-label="Contact form">
                            @csrf
                            

                        <div class="frm-row">
                            <div class="frm-col2">
                                <p>
                                    <span class="wpcf7-form-control-wrap" data-name="your-name">
                                        <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Your Name*" value="{{ old('name') }}" type="text" name="name" required>
                                    </span>
                                </p>
                                @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="frm-col2">
                                <p><span class="wpcf7-form-control-wrap" data-name="email-123"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Your Email*" value="{{ old('email') }}" type="email" name="email" required></span>
                                </p>
                                @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="frm-col2">
                                <p><span class="wpcf7-form-control-wrap" data-name="tel-493"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Your Phone*" value="{{ old('phone') }}" type="tel" name="phone" required></span>
                                </p>
                                @error('phone')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="frm-col2">
                                <p><span class="wpcf7-form-control-wrap" data-name="subject"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Subject" value="{{ old('subject') }}" type="text" name="subject" required></span>
                                </p>
                                @error('subject')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="frm-row">
                            <div class="frm-colfull">
                                <p><span class="wpcf7-form-control-wrap" data-name="your-message"><textarea cols="40" rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Your Message.." name="message" required>{{ old('message') }}</textarea></span>
                                </p>
                                @error('message')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="frm-row frm-row-btn text-center">
                            <div class="frm-colfull">
                                <p><input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Submit Now"><span class="wpcf7-spinner"></span>
                                </p>
                            </div>
                        </div><div class="wpcf7-response-output" aria-hidden="true"></div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>





@endsection