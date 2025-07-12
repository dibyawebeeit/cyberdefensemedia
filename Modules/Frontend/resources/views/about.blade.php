@extends('frontend::layouts.master')
@section('title','About Us')
@section('content')

<div class="inner-template about-template">
    <section class="inner-bannr about-bannr">
        <div class="container">
           <div class="row">
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
                    <h1 class="innr-bnt-title">About Us</h1>
                </div>                
           </div>
        </div>
    </section>

    <section class="home-row-one p-t-98 p-b-98 about-content-3">
        <div class="container">
            <div class="row middle-content-row col-middle-gap">
            {{-- <div class="col-cmn col-lg-6 col-md-6 col-sm-12 one">
                    <div class="section-img"><img src="{{ asset('uploads/cmsImage/'.$about->image1) }}" class="fullsize"></div>
            </div> --}}
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 two">
                        <div class="section-content">
                            <h2>{{ $about->title1 }}</h2>
                            <p>{!! $about->desc1 !!}</p>
                        </div>
                </div>
            </div>
        </div>    
    </section>
    
    {{-- <section class="about-row-three p-t-98 p-b-98" style="background-image:url({{ asset('uploads/cmsImage/'.$about->cta_bg_image) }});">

        <div class="container">
        <div class="row row-col-center">
            <div class="col-cmn col-lg-8 col-md-12 col-sm-12 one text-center">
                    <div class="section-content">
                        <h2>{{ $about->cta_title }}</h2>
                        <p><a href="{{ route($about->cta_button_url) }}" class="btn">{{ $about->cta_button_text }}</a></p>
                    </div>
            </div>
        </div>
        </div>    
    </section> --}}

    {{-- <section class="about-row-four mob-rightimg-row p-t-98 p-b-98">
        <div class="container">
        
        <div class="row middle-content-row col-middle-gap">
            <div class="col-cmn col-lg-6 col-md-6 col-sm-12 one">
                    <div class="section-content">
                        <h2>{{ $about->title2 }}</h2>
                        <p>{!! $about->desc2 !!}</p>
                    </div>
            </div>
            <div class="col-cmn col-lg-6 col-md-6 col-sm-12 two">
                    <div class="section-img"><img src="{{ asset('uploads/cmsImage/'.$about->image2) }}" class="fullsize"></div>
            </div>
        </div>
        </div>    
    </section> --}}
</div>
@endsection