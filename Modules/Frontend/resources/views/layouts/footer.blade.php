<footer>
    <div class="footer-top text-center">
        <div class="container">
            <div class="row rowtwo">
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
                    <div class="cipi">
				        <span class="footer-logo">
                        <figure class="wp-block-image size-full"><img loading="lazy" decoding="async" width="188" height="53" src="{{ asset('frontendassets/logo.jpg') }}" data-src="{{ asset('frontendassets/logo.jpg') }}" alt="" class="wp-image-146"></figure>
                        </span>     
                    </div>
                </div>
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 two">
                    <div class="cipi">
                        <span class="social-link">
                            <ul>
                                <li><a href="{{sitesetting()->facebook}}" target="_blank"><i class="fa-brands  fa-facebook-f"></i></a></li>
                                <li><a href="{{sitesetting()->twitter}}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="{{sitesetting()->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="{{sitesetting()->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </span>                                
                    </div>
                </div>
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 three">
                    <div class="cipi">
                        <ul id="menu-footer-menu" class="listo">
                            <li id="menu-item-37" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-25 current_page_item menu-item-37"><a href="{{ url('/') }}" aria-current="page">Home</a></li>
                            <li id="menu-item-38" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-38"><a href="{{ route('about') }}">About Us</a></li>
                            <li id="menu-item-39" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39"><a href="{{ route('news') }}">News</a></li>
                            <li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40"><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>              
                        <span class="footer-copyright">
                            <p>© 2025 Cyber Defense Media Group. All rights reserved. </p>
                        </span>                                
                    </div>
                </div>
            </div> 
	    </div>
    </div>
</footer>

@if (session()->has('success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 10000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: "success",
    text: "{{ session('success') }}"
    });
</script>
@endif
@if (session()->has('error'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 10000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: "error",
    text: "{{ session('error') }}"
    });
</script>
@endif