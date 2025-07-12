@extends('frontend::layouts.master')
@section('title','Home')

@section('content')

<section class="home-row-bnrslider p-b-98">
    <div class="containerFull">
        <div class="col-one">
            <div class="section-content homeBnrSlider">
                {{-- @if (!empty($section1) && !empty($section1->feedList))
                    @foreach ($section1->feedList as $itemvalue) --}}
                    @if (!empty($section1))
                    @foreach ($section1 as $itemvalue)
                    <div>
                        <div class="csn-shortcode-news-item itemCol1">
                            <div class="csn-news-img">
                                <a href="{{ $itemvalue['link'] }}" target="_blank" tabindex="-1">
                                    <img class="lazy-load" src="{{ $itemvalue['media'] }}" data-src="{{ $itemvalue['media'] }}">
                                </a>
                            </div>
                            <div class="csn-news-content">
                                <h3>
                                    <a href="{{ $itemvalue['link'] }}" target="_blank" tabindex="-1">{{ substr($itemvalue['title'],0,50) }}</a>
                                </h3>
                                <div class="csn-news-author">{{ $itemvalue['pubDate'] }} | {{ $itemvalue['creator'] }}</div>
                                {{-- <p>{{ $itemvalue['description'] }}</p> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                @endif
            </div>
        </div>
    </div>    
</section>





<section class="home-row-latestArticle p-b-60">
    <div class="container">
    
       <div class="row col-middle-gap">
           <div class="col-cmn col-lg-8 col-md-12 col-sm-12 one">
           		<div class="section-content">
                	<div class="latestArticleLft">
                        <div class="section-heading">
                            <h2>{{ $section2->sectionDetails->section_title ?? '' }}</h2>
                        </div>
                       <div class="latestArticleLftMain">
                            @if (!empty($section2->feedList))
                                @foreach ($section2->feedList as $item)
                                    <div class="latestArticleLftOne">
                                    <div class="cybernews-shortcode-container">
                                        <div class="csn-shortcode-news-container">
                                            <div class="csn-shortcode-news-item itemCol1">
                                                <div class="csn-news-img"><a href="{{ $item['link'] }}" target="_blank">
                                                    <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                                </a>
                                                </div>
                                                <div class="csn-news-content">
                                                    <h3><a href="{{ $item['link'] }}" target="_blank">
                                                        {{ substr($item['title'],0,$section2->item_length) }}</a></h3>
                                                    <div class="csn-news-author">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                                    <p>{{ substr($item['description'],0,$section2->desc_length) }}...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p></p>
                                </div>
                                @endforeach
                                
                            @endif
                            
                            <div class="latestArticleLftTwo">
                                <div class="cybernews-shortcode-container">
                                    <div class="csn-shortcode-news-container">
                                        @if (!empty($section_two->feedList))
                                            @foreach ($section_two->feedList as $item)
                                                <div class="csn-shortcode-news-item itemCol1">
                                                    <div class="csn-news-img">
                                                        <a href="{{ $item['link'] }}" target="_blank">
                                                            <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                                        </a>
                                                    </div>
                                                    <div class="csn-news-content">
                                                        <h3><a href="{{ $item['link'] }}" target="_blank">
                                                            {{ substr($item['title'],0,$section_two->title_length) }}...</a></h3>
                                                        <div class="csn-news-author ">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                                        <p>{{ substr($item['description'],0,$section_two->desc_length) }}..</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        
                                    </div>
                                </div>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-cmn col-lg-4 col-md-12 col-sm-12 two">
           		<div class="section-content">
					<h2>{{ $section3->sectionDetails->section_title ?? '' }}</h2>
					
                    <div class="cybernews-shortcode-container">
                        <div class="csn-shortcode-news-container">
                            @if (!empty($section3->feedList))
                                @foreach ($section3->feedList as $item)
                                    <div class="csn-shortcode-news-item itemCol1">
                                        <div class="csn-news-img">
                                            <a href="{{ $item['link'] }}" target="_blank">
                                                <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                            </a>
                                        </div>
                                        <div class="csn-news-content">
                                            <h3><a href="{{ $item['link'] }}" target="_blank">
                                                {{ substr($item['title'],0,$section3->title_length) }}</a></h3>
                                            <div class="csn-news-author hackitemauthor">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                            <p>{{ substr($item['description'],0,$section3->desc_length) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            

                            </div>
                        </div>
                        <p></p>
                </div>
           </div>
       </div>
       
    </div>    
</section>



<section class="home-row-aiNews p-t-98 p-b-60 offWhiteGb">
    <div class="container">
    
       <div class="row col-middle-gap">
           <div class="col-cmn col-lg-6 col-md-12 col-sm-12 one">
           		<div class="section-content">
                    <div class="section-heading">
                        <h2>{{ $section4->sectionDetails->section_title ?? '' }}</h2>
                    </div>   

                    @if (!empty($section4->feedList))
                        @foreach ($section4->feedList as $item)
                            <div class="cybernews-shortcode-container">
                                <div class="csn-shortcode-news-container">
                                    <div class="csn-shortcode-news-item itemCol1">
                                        <div class="csn-news-img">
                                            <a href="{{ $item['link'] }}" target="_blank">
                                                <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                            </a>
                                        </div>
                                        <div class="csn-news-content">
                                            <h3><a href="{{ $item['link'] }}" target="_blank">
                                                {{ substr($item['title'],0,$section4->title_length) }}</a></h3>
                                            <div class="csn-news-author">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                            <p>{{ substr($item['description'],0,$section4->desc_length) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    
             	
                </div>
           </div>
           <div class="col-cmn col-lg-6 col-md-12 col-sm-12 two">
           		<div class="section-content">
                    <div class="section-heading"><h2>{{ $section5->sectionDetails->section_title ?? '' }}</h2>
                    </div>   
                    <div class="cybernews-shortcode-container">
                        <div class="csn-shortcode-news-container">

                            @if (!empty($section5->feedList))
                                @foreach ($section5->feedList as $item)
                                    <div class="csn-shortcode-news-item itemCol2">
                                        <div class="csn-news-img">
                                            <a href="{{ $item['link'] }}" target="_blank">
                                                <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                            </a>
                                        </div>
                                        <div class="csn-news-content">
                                            <h3><a href="{{ $item['link'] }}" target="_blank">
                                                {{ substr($item['title'],0,$section5->title_length) }}</a></h3>
                                            <div class="csn-news-author">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                            <p>{{ substr($item['description'],0,$section5->desc_length) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            


                            </div>
                        </div>
                        <p></p>
        
                </div>
           </div>
       </div>
       
    </div>    
</section>



<section class="home-row-newsletters p-t-98 p-b-98">
    <div class="container">
    
       <div class="row">
           <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
           		<div class="section-content">
				    <span class="newsletter-heading">
                        <h2 class="wp-block-heading has-text-align-center">{{sitesetting()->newsletter_title}}</h2>
                    </span>
                    <span class="newsletter-heading">
                    <p class="has-text-align-center">{{sitesetting()->newsletter_desc}} </p>
                    </span>
                    <span class="newsletter-heading">
                        <form method="post" action="{{ route('submit_newsletter') }}" class="tnp-subscription">
                            @csrf
                            <div class="tnp-field tnp-field-email">
                                <input class="tnp-email" type="email" name="email" placeholder="Enter Your Email Address" required="">
                            </div>
                            <div class="tnp-field tnp-field-button" style="text-align: left">
                                <input class="tnp-submit" type="submit" value="Subscribe" style="">
                            </div>
                        </form>
                    </span>                                 
                </div>
           </div>
       </div>
       
    </div>    
</section>




<section class="home-row-trendingNews p-b-60">
    <div class="container">
    
       <div class="row col-middle-gap">
           <div class="col-cmn col-lg-12 col-md-12 col-sm-12 headingcol">
           		<div class="section-content">
                    <div class="section-heading"><h2>{{ $section6->sectionDetails->section_title ?? '' }}</h2></div>
                </div>
           </div>
           <div class="col-cmn col-lg-7 col-md-7 col-sm-12 one">
           		<div class="section-content">
                    <div class="cybernews-shortcode-container">
                        <div class="csn-shortcode-news-container">

                            @if (!empty($section6->feedList))
                                @foreach ($section6->feedList as $item)
                                    <div class="csn-shortcode-news-item itemCol1">
                                        <div class="csn-news-img">
                                            <a href="{{ $item['link'] }}" target="_blank">
                                                <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                            </a>
                                        </div>
                                        <div class="csn-news-content">
                                            <h3><a href="{{ $item['link'] }}" target="_blank">
                                                {{ substr($item['title'],0,$section6->title_length) }}</a></h3>
                                            <div class="csn-news-author">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                            <p>{{ substr($item['description'],0,$section6->desc_length) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            


                        </div>
                    </div>             	
                </div>
           </div>
           <div class="col-cmn col-lg-5 col-md-5 col-sm-12 two">
           		<div class="section-content">
                    <div class="cybernews-shortcode-container">
                        <div class="csn-shortcode-news-container">
                        <div class="section-content">
                            <div class="section-heading"><h2>{{ $section7->sectionDetails->section_title ?? '' }}</h2></div>
                        </div>
                            @if (!empty($section7->feedList))
                                @foreach ($section7->feedList as $item)
                                   
                                    <div class="csn-shortcode-news-item itemCol1">
                                        <div class="csn-news-img">
                                            <a href="{{ $item['link'] }}" target="_blank">
                                                <img class="lazy-load" src="{{ $item['media']  }}" data-src="{{ $item['media']  }}">
                                            </a>
                                            </div>
                                            <div class="csn-news-content">
                                                <h3><a href="{{ $item['link'] }}" target="_blank">
                                                    {{ substr($item['title'],0,$section7->title_length) }}</a></h3>
                                                <div class="csn-news-author">{{ $item['pubDate'] }} | {{ $item['creator'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                        </div>        
                </div>
           </div>
       </div>
       
    </div>    
</section>



@endsection

