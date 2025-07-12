<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        @if (View::hasSection('title'))
        @yield('title')
        @else
            Home
        @endif - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">
    <link rel="icon" href="{{ asset('frontendassets/favicon.jpg') }}" sizes="32x32">

    <link rel="stylesheet" href="{{ asset('frontendassets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontendassets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontendassets/css/style-main.css') }}">

    <link rel="stylesheet" href="{{ asset('frontendassets/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontendassets/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontendassets/css/slick-theme.css') }}" />

    <script src="{{ asset('frontendassets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

    
    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-frontend', 'resources/assets/sass/app.scss') }} --}}
</head>

<body>

    @include('frontend::layouts.header')
    @yield('content')
    @include('frontend::layouts.footer')
    {{-- Vite JS --}}
    {{-- {{ module_vite('build-frontend', 'resources/assets/js/app.js') }} --}}

    

    <script src="{{ asset('frontendassets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontendassets/js/slick.js') }}"></script>
    <script src="{{ asset('frontendassets/js/main-script.js') }}"></script>

    <script>
        jQuery(document).ready(function( $ ){	
            $(document).on('click', '.ufg-parent-filters .col-md-12 button', function (e){
                ufgparentfilter = document.getElementsByClassName("ufg-parent-filters");
                for (i = 0; i < ufgparentfilter.length; i++) {
                    ufgparentfilter[i].className = ufgparentfilter[i].className.replace(" filteractive", "");
                    ufgparentfilter[i].className += " filterinactive";
                }
                this.classList.toggle("filteractive");		
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
                let lazyImages = [].slice.call(document.querySelectorAll("img.lazy-load"));
                let active = false;
                        const lazyLoad = () => {
                    if (active === false) {
                        active = true;
                           setTimeout(() => {
                            lazyImages.forEach((img) => {
                                if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect().bottom >= 0 && getComputedStyle(img).display !== "none") {
                                    img.src = img.dataset.src;
                                    img.classList.remove("lazy-load");
                                    lazyImages = lazyImages.filter((image) => image !== img);
                                }
                            });
                            if (lazyImages.length === 0) {
                                document.removeEventListener("scroll", lazyLoad);
                                window.removeEventListener("resize", lazyLoad);
                            }
                            active = false;
                        }, 200);
                    }
                };
         
                document.addEventListener("scroll", lazyLoad);
                window.addEventListener("resize", lazyLoad);
                lazyLoad();
            });
    </script>

    <script>
        jQuery(document).ready(function () {
            const $slider = jQuery('.homeBnrSlider');
            const minSlides = 5;
            const $items = $slider.children();
            const total = $items.length;

            // Duplicate slides if total is less than required
            if (total > 0 && total < minSlides) {
                const repeatTimes = Math.ceil(minSlides / total);
                for (let i = 0; i < repeatTimes - 1; i++) {
                    $items.clone().appendTo($slider);
                }
            }

            // Initialize Slick
            $slider.slick({
                dots: false,
                infinite: true,
                speed: 500,
                slidesToShow: 5,
                slidesToScroll: 1,
                centerMode: true,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
        </script>

    @yield('script')

</body>
