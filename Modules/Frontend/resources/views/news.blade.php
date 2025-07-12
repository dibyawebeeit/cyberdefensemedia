@extends('frontend::layouts.master')
@section('title','News')
@section('content')

<div class="wrap default-page-template">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <section class="inner-bannr default-bannr">
                <div class="container">
                    <div class="row">
                        <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
                            <h1 class="innr-bnt-title">News</h1>
                        </div>                
                    </div>
                </div>
            </section>


            <section class="default-row-content">
                <div class="container">
                    <div class="row">
                        <div class="col-cmn col-lg-12 col-md-12 col-sm-12 defaultPageContent">  
                                <div class="section-content">                        
                                    <article id="post-29" class="post-29 page type-page status-publish hentry">
                                        <div class="entry-content">
                                            <div class="newsPageList">
                                                <div class="cybernews-shortcode-container">
                                                    <div class="csn-shortcode-news-container" id="articles">

                                                        {{-- <div class="csn-shortcode-news-item itemCol3">
                                                            <div class="csn-news-img">
                                                                <a href="https://www.darkreading.com/cyber-risk/infosec-layoffs-arent-bargain-boards-may-think" target="_blank">
                                                                    <img decoding="async" src="https://eu-images.contentstack.com/v3/assets/blt6d90778a997de1cd/blt096728049dbeb9b0/682500e64bf58dffc8c7e4a3/layoffs_Andriy_Popov_Alamy.jpg?width=1280&amp;auto=webp&amp;quality=80&amp;disable=upscale">
                                                                </a>
                                                            </div>
                                                            <div class="csn-news-content">
                                                                <h3><a href="https://www.darkreading.com/cyber-risk/infosec-layoffs-arent-bargain-boards-may-think" target="_blank">Infosec Layoffs Aren't the Bargain That Boards May Think</a></h3>
                                                                <div class="csn-news-author">14 May 2025 | Becky Bracken</div>
                                                                <p>Salary savings come with hidden costs, including insider threats and depleted cybersecurity defenses, conveying advantages to skilled adversaries, experts argue....</p>
                                                            </div>
                                                        </div>
                                                        <div class="csn-shortcode-news-item itemCol3">
                                                            <div class="csn-news-img">
                                                                <a href="https://www.darkreading.com/cyber-risk/infosec-layoffs-arent-bargain-boards-may-think" target="_blank">
                                                                    <img decoding="async" src="https://eu-images.contentstack.com/v3/assets/blt6d90778a997de1cd/blt096728049dbeb9b0/682500e64bf58dffc8c7e4a3/layoffs_Andriy_Popov_Alamy.jpg?width=1280&amp;auto=webp&amp;quality=80&amp;disable=upscale">
                                                                </a>
                                                            </div>
                                                            <div class="csn-news-content">
                                                                <h3><a href="https://www.darkreading.com/cyber-risk/infosec-layoffs-arent-bargain-boards-may-think" target="_blank">Infosec Layoffs Aren't the Bargain That Boards May Think</a></h3>
                                                                <div class="csn-news-author">14 May 2025 | Becky Bracken</div>
                                                                <p>Salary savings come with hidden costs, including insider threats and depleted cybersecurity defenses, conveying advantages to skilled adversaries, experts argue....</p>
                                                            </div>
                                                        </div> --}}

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="loadmoreCol text-center">
                                            {{-- <button id="toggleOurNews" class="btn">Show More</button> --}}
                                            <button id="loadMoreBtn" class="btn">Show More</button>
                                            </div>
                                        </div><!-- .entry-content -->
                                    </article><!-- #post-29 -->
                                </div>
                            </div>                       
                        </div>     
                    </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->
</div>
@endsection


@section('script')
    <script>
        const articlesContainer = document.getElementById('articles');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const fallbackImages = @json(array_map(fn($img) => asset('uploads/defaultImage/' . $img), $randomImages));
        

        let allArticles = [];
        let currentIndex = 0;
        const batchSize = 9;

        // Simulated fetch from API
        async function fetchArticles() {
            try {
                // Replace this URL with your actual API endpoint
                const apiUrl = "{{ url('newsFeedApi') }}";
                
                const response = await fetch(apiUrl);
                const data = await response.json(); // assuming it returns an array of articles
                allArticles = data;
                // console.log(data);
                
                displayNextArticles();
            } catch (error) {
                articlesContainer.innerHTML='<p>No Data Found!</p>';
                loadMoreBtn.style.display="none";
            }
            
        }

        async function displayNextArticles() {
            if (Array.isArray(allArticles) && allArticles.length > 0) {
                const nextArticles = allArticles.slice(currentIndex, currentIndex + batchSize);

                const elementsToInsert = [];

        for (const article of nextArticles) {
            const fallbackImage = fallbackImages[Math.floor(Math.random() * fallbackImages.length)];
            const hasValidImage = article.media && await isValidImage(article.media);
            const imageSrc = hasValidImage ? article.media : fallbackImage;
            const creator = article.creator ?? 'NA';

            const articleEl = `
                <div class="csn-shortcode-news-item itemCol3">
                    <div class="csn-news-img">
                        <a href="${article.link}" target="_blank">
                            <img decoding="async" class="lazy-load" src="${imageSrc}" data-src="${imageSrc}">
                        </a>
                    </div>
                    <div class="csn-news-content">
                        <h3><a href="${article.link}" target="_blank">
                            ${String(article.title).length > 45 
                            ? String(article.title).slice(0, 45) + '...' 
                            : article.title}
                        </a></h3>
                        <div class="csn-news-author">${article.pubDate} | ${creator}</div>
                        <p>
                        ${String(article.description).length > 180 
                            ? String(article.description).slice(0, 160) + '...' 
                            : article.description}
                        </p>

                    </div>
                </div>
            `;

            elementsToInsert.push(articleEl); // store, but don't insert yet
        }

        // Insert after all rendering is ready
        articlesContainer.insertAdjacentHTML('beforeend', elementsToInsert.join(''));

                currentIndex += batchSize;

                if (currentIndex >= allArticles.length) {
                    loadMoreBtn.style.display = 'none'; // hide button if all articles are loaded
                }
            } else {
                articlesContainer.innerHTML='<p>No Data Found!</p>';
                loadMoreBtn.style.display="none";
            }
        }

        // Load more on button click
        loadMoreBtn.addEventListener('click', displayNextArticles);

        // Initial fetch and display
        fetchArticles();

        function isValidImage(url) {
            return new Promise((resolve) => {
                const img = new Image();
                img.src = url;
                img.onload = () => resolve(true);
                img.onerror = () => resolve(false);
            });
        }
    </script>
@endsection