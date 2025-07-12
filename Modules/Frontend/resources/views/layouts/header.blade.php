<header class="header"> 
  <div class="topbar-menu">
    <div class="container">
      <div class="row middle-content-row">
        <div class="col-cmn col-lg-4 col-md-4 col-sm-4 one">
        <div class="sitelogo"><a href="{{ url('/') }}" class="custom-logo-link" rel="home" aria-current="page">
            <img width="188" height="53" src="{{ asset('frontendassets/logo.jpg') }}" class="custom-logo" alt="Cyber Defense" decoding="async" sizes="100vw"></a> 
          </div>   
		</div>
        
        <div class="col-cmn col-lg-8 col-md-8 col-sm-8 two text-right">                    
			<div class="mainmenu-div">        	
                    <nav class="navbar navbar-expand-lg">                        
                        <div id="navbarSupportedContent" class="collapse navbar-collapse">
                           <ul id="menu-main-menu" class="navbar-nav ml-auto">
                            <li id="menu-item-33" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-25 current_page_item menu-item-33"><a href="{{ url('/') }}" aria-current="page">Home</a></li>
                            <li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-34"><a href="{{ route('about') }}">About Us</a></li>
                            <li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-35"><a href="{{ route('news') }}">News</a></li>
                            <li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>         
                        </div>
                      
                  
				        <span class="social-link"><ul>
                            <li><a href="{{sitesetting()->facebook}}" target="_blank"><i class="fa-brands  fa-facebook-f"></i></a></li>
                            <li><a href="{{sitesetting()->twitter}}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="{{sitesetting()->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="{{sitesetting()->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </span>        
                    </nav>
            </div>	  
        </div>  
      </div>
    </div>
  </div>
</header>