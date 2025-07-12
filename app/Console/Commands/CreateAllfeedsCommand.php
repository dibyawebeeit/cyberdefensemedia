<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Modules\Feedvalues\App\Models\Feedvalues;
use Modules\Feed\App\Models\Feed;

class CreateAllfeedsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-allfeeds-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create All Feeds';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Clear the table first
        Feedvalues::truncate();
        

        //First Feed Start [The Hacker News] ##################################
        
        try 
        {
            $id =1;
            $feed = Feed::where('id',$id)->first();
                $response = Http::get($feed->url);

                if ($response->ok()) {
                    $xml = simplexml_load_string($response->body(), null, LIBXML_NOCDATA);
                    $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

                    $itemsRaw = iterator_to_array($xml->channel->item, false);
                    $limitedItems = array_slice($itemsRaw, 0, 20);

                    foreach ($limitedItems as $item) {
                        $mediaUrl = null;

                        if (isset($item->enclosure)) {
                            $attributes = $item->enclosure->attributes();
                            $mediaUrl = (string) $attributes['url'];
                        }

                        $title       = (string) $item->title;
                        $link        = (string) $item->link;
                        $description =(string) $item->description;
                        try {
                            $pubDate     = Carbon::parse((string) $item->pubDate)->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }
                        $creator    = (string) $item->author ?? '';
                        $media       = $mediaUrl;

                        try {
                            $data =array(
                                'feed_id' => $id,
                                'title' =>$title,
                                'link' =>$link,
                                'description' =>$description,
                                'pubDate' =>$pubDate,
                                'creator' => $creator,
                                'media' => $media
                            );
                            Feedvalues::create($data);
                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("HackNews RSS Fetch Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
            // Optionally log the error
            Log::error("First Feed Error: " . $e->getMessage());
        }

        //First Feed End [The Hacker News] ####################################

        //Second Feed Start [Dark Reading] ##################################

        try {
            $id =2;
            $feed = Feed::where('id',$id)->first();

            $response = Http::get($feed->url);

            if ($response->ok()) {
                $xmlString = $response->body();
                $xml = simplexml_load_string($xmlString, null, LIBXML_NOCDATA);
                $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

                $count = 0;
                foreach ($xml->channel->item as $item) {
                    if ($count >= 20) break; // Stop after 20 items
                    $count++;

                    $mediaContent = $item->xpath('media:content');
                    $mediaThumbnail = $item->xpath('media:thumbnail');

                    $title = (string) $item->title;
                    $link  = (string) $item->link;
                    $description = (string) $item->description;
                    try {
                        $pubDate = Carbon::parse((string) $item->pubDate)->format('d M Y');
                    } catch (\Exception $e) {
                        $pubDate = null;
                    }
                    $creator = (string) $item->children('dc', true)->creator ?? '';                        $media   = isset($mediaContent[0]['url']) ? (string) $mediaContent[0]['url'] :
                                        (isset($mediaThumbnail[0]['url']) ? (string) $mediaThumbnail[0]['url'] : null);

                    try {
                        $data =array(
                            'feed_id' => $id,
                            'title' =>$title,
                            'link' =>$link,
                            'description' =>$description,
                            'pubDate' =>$pubDate,
                            'creator' => $creator,
                            'media' => $media
                        );
                        Feedvalues::create($data);

                        
                    } catch (\Throwable $th) {
                        //throw $th;
                        Log::error("Second Feed Error: " . $th->getMessage());
                    }

                }
            }
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error("Second Feed Error: " . $e->getMessage());
        }

        //Second Feed End [Dark Reading] ####################################

        //Third Feed Start [Bleeping Computer] ##################################
        try 
        {
            $id =3;
            $feed = Feed::where('id',$id)->first();
       
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                    'Accept' => 'application/rss+xml, application/xml;q=0.9, */*;q=0.8'
                ])->get($feed->url);

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    $count = 0;
                    foreach ($feedData['channel']['item'] as $item) {
                        if ($count >= 20) break; // Stop after 20 items
                        $count++;

                        $title       = $item['title'];
                        $link        = $item['link'];
                        $description = $item['description'] ?? null;
                        try {
                            $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }
                        $category = $item['category'];
                        $categories = is_array($category) ? implode(', ', $category) : (string) $category;

                        // $category    = $item['category'] ?? null;
                        $media       = $item['media'] ?? null;

                        try {

                            $data =array(
                                'feed_id' => $id,
                                'title' =>$title,
                                'link' =>$link,
                                'description' =>$description,
                                'pubDate' =>$pubDate,
                                'creator' => $categories,
                                'media' => $media
                            );
                            Feedvalues::create($data);

                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("Third Feed Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
                // Optionally log the error
                Log::error("Third Feed Failed: " . $e->getMessage());
        }
        //Third Feed End [Bleeping Computer] ####################################


        //Forth Feed Start [Cyber Scoop] ##################################

        try 
        {
            $id =4;
            $feed = Feed::where('id',$id)->first();
       
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                    'Accept' => 'application/rss+xml, application/xml;q=0.9, */*;q=0.8'
                ])->get($feed->url);

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    $count = 0;
                    foreach ($feedData['channel']['item'] as $item) {
                        if ($count >= 20) break; // Stop after 20 items
                        $count++;

                        $title       = $item['title'];
                        $link        = $item['link'];

                        preg_match('/<p>(.*?)<\/p>/', (string) $item['description'], $matches);
                        $firstParagraph = $matches[1] ?? '';

                        $description = $firstParagraph ?? null;
                        try {
                            $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }

                        $category = $item['category'];
                        if (is_array($category)) {
                            $limitedCategories = array_slice($category, 0, 2); // take only 2
                            $categories = implode(', ', $limitedCategories);
                        } else {
                            $categories = (string) $category;
                        }

                        // $category    = $item['category'] ?? null;
                        $media       = $item['media'] ?? null;

                        try {

                            $data =array(
                                'feed_id' => $id,
                                'title' =>$title,
                                'link' =>$link,
                                'description' =>$description,
                                'pubDate' =>$pubDate,
                                'creator' => $categories,
                                'media' => $media
                            );

                            Feedvalues::create($data);

                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("Forth Feed Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
                // Optionally log the error
                Log::error("Forth Feed Failed: " . $e->getMessage());
        }

        //Forth Feed End [Cyber Scoop] ##################################


        //Fifit Feed Start [Krebs on Security] ##################################
        try 
        {
            $id =5;
            $feed = Feed::where('id',$id)->first();
       
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                    'Accept' => 'application/rss+xml, application/xml;q=0.9, */*;q=0.8'
                ])->get($feed->url);

            
                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);
                    
                    $count = 0;
                    foreach ($feedData['channel']['item'] as $item) {
                        if ($count >= 20) break; // Stop after 20 items
                        $count++;

                        $title       = $item['title'];
                        $link        = $item['link'];

                        // preg_match('/<p>(.*?)<\/p>/', (string) $item['description'], $matches);
                        // $firstParagraph = $matches[1] ?? '';

                        $description = $item['description'] ?? null;

                        try {
                            $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }

                        $category = $item['category'];
                        if (is_array($category)) {
                            $limitedCategories = array_slice($category, 0, 2); // take only 2
                            $categories = implode(', ', $limitedCategories);
                        } else {
                            $categories = (string) $category;
                        }

                        // $category    = $item['category'] ?? null;
                        $media       = $item['media'] ?? null;

                        try {

                            $data =array(
                                'feed_id' => $id,
                                'title' =>$title,
                                'link' =>$link,
                                'description' =>$description,
                                'pubDate' =>$pubDate,
                                'creator' => $categories,
                                'media' => $media
                            );

                            Feedvalues::create($data);

                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("Fifth Feed Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
                // Optionally log the error
                Log::error("Fifth Feed Failed: " . $e->getMessage());
        }
        //Fifit Feed End [Krebs on Security] ##################################


        //6th Feed Start [Threatpost] ##################################
        try 
        {
            $id =6;
            $feed = Feed::where('id',$id)->first();
       
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                    'Accept' => 'application/rss+xml, application/xml;q=0.9, */*;q=0.8'
                ])->get($feed->url);
            
                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    // dd($feedData['channel']['item']);

                    $count = 0;
                    foreach ($feedData['channel']['item'] as $item) {
                        if ($count >= 20) break; // Stop after 20 items
                        $count++;

                        $title       = $item['title'];
                        $link        = $item['link'];

                        // preg_match('/<p>(.*?)<\/p>/', (string) $item['description'], $matches);
                        // $firstParagraph = $matches[1] ?? '';

                        $description = $item['description'] ?? null;

                        try {
                            $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }

                        $category = $item['category'];
                        if (is_array($category)) {
                            $limitedCategories = array_slice($category, 0, 2); // take only 2
                            $categories = implode(', ', $limitedCategories);
                        } else {
                            $categories = (string) $category;
                        }

                        // $category    = $item['category'] ?? null;
                        $media       = $item['media'] ?? null;

                        try {

                            $data =array(
                                'feed_id' => $id,
                                'title' =>$title,
                                'link' =>$link,
                                'description' =>$description,
                                'pubDate' =>$pubDate,
                                'creator' => $categories,
                                'media' => $media
                            );

                            Feedvalues::create($data);

                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("6th Feed Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
                // Optionally log the error
                Log::error("6th Feed Failed: " . $e->getMessage());
        }
        //6th Feed End [Threatpost] ##################################


        //7th Feed Start [SC Magazine] ##################################
                //no data found
        //7th Feed Start [SC Magazine] ##################################

        //8th Feed Start [Reuters Cybersecurity] ##################################
                //no data found
        //8th Feed Start [Reuters Cybersecurity] ##################################


        //9th Feed Start [ZDNet Security] ##################################
            try {
                $id =9;
                $feed = Feed::where('id',$id)->first();
                $response = Http::get($feed->url);

                if ($response->ok()) {
                    $xml = simplexml_load_string($response->body(), null, LIBXML_NOCDATA);
                    $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

                    $itemsRaw = iterator_to_array($xml->channel->item, false);
                    $limitedItems = array_slice($itemsRaw, 0, 20);

                    foreach ($limitedItems as $item) {
                        
                        $title       = (string) $item->title;
                        $link        = (string) $item->link;
                        $description = (string) $item->description;
                        try {
                            $pubDate     = Carbon::parse((string) $item->pubDate)->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }
                        $creator     = null;

                        $mediaCredits = $item->xpath('media:credit');
                        if (!empty($mediaCredits)) {
                            $creator = (string) $mediaCredits[0];
                        }
                        
                        $media       = null;

                        try {

                            $data =array(
                                'feed_id' => $id,
                                'title' =>$title,
                                'link' =>$link,
                                'description' =>$description,
                                'pubDate' =>$pubDate,
                                'creator' => $creator,
                                'media' => $media
                            );

                            Feedvalues::create($data);

                           
                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("9th Feed Failed: " . $th->getMessage());
                        }

                    }
                }
            } catch (\Exception $e) {
                // Optionally log the error
                Log::error("9th Feed Failed: " . $e->getMessage());
            }
        //9th Feed End [ZDNet Security] ##################################


        //10th Feed Start [CSO Online] ##################################
        try 
        {
            $id = 10;
            $feed = Feed::where('id',$id)->first();

                $response = Http::get($feed->url);

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    // dd($feedData['channel']['item']);

                    if (!empty($feedData['channel']['item'])) {
                        $limitedItems = array_slice($feedData['channel']['item'], 0, 20);

                        foreach ($limitedItems as $item) {
                            $mediaUrl = null;

                            if (isset($item['enclosure'])) {
                                $attributes = $item['enclosure']['@attributes'];
                                $mediaUrl = $attributes['url'];
                            }

                            $title       = $item['title'];
                            $link        = $item['link'];
                            $description = $this->extractSummaryFromDescription($item['description'] ?? null);
                            try {
                                $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                            } catch (\Throwable $th) {
                                //throw $th;
                                $pubDate = null;
                            }
                            
                            $category    = $item['category'] ?? 'NA';
                            $media       = $mediaUrl;

                            try {

                                $data =array(
                                    'feed_id' => $id,
                                    'title' =>$title,
                                    'link' =>$link,
                                    'description' =>$description,
                                    'pubDate' =>$pubDate,
                                    'creator' => $category,
                                    'media' => $media
                                );

                            Feedvalues::create($data);

                            } catch (\Throwable $th) {
                                //throw $th;
                                Log::error("10th Feed Failed: " . $th->getMessage());
                            }


                        }
                    }
                }
        } catch (\Exception $e) {
                // Optional: log error
                Log::error("10th Feed Failed: " . $e->getMessage());
        }
        //10th Feed End [CSO Online] ##################################


        //11th Feed Start [Cyber Defense Magazine] ##################################
        try 
        {
               $id = 11;
               $feed = Feed::where('id',$id)->first();

                $response = Http::get('https://api.rss2json.com/v1/api.json', [
                    'rss_url' => $feed->url
                ]);

                if ($response->ok()) {

                    $feedData = $response->json();

                    foreach ($feedData['items'] as $item) {

                        $title       = $item['title'];
                        $link        = $item['link'];
                        $description = $this->extractSummaryFromDescription($item['description'] ?? null);
                        try {
                            $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }

                        $creator =$item['author'] ?? null;
                        $media       = $this->extractImageFromDescription($item['description'] ?? null);

                        try {

                            $data =array(
                                    'feed_id' => $id,
                                    'title' =>$title,
                                    'link' =>$link,
                                    'description' =>$description,
                                    'pubDate' =>$pubDate,
                                    'creator' => $creator,
                                    'media' => $media
                                );

                            Feedvalues::create($data);
                            
                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("11th Feed Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
                // Optionally log the error
                Log::error("11th Feed Failed: " . $e->getMessage());
        }
        //11th Feed End [Cyber Defense Magazine] ##################################


        //12th Feed Start [Cyber Defense Wire] ##################################
        try 
        {
               $id = 12;
               $feed = Feed::where('id',$id)->first();

                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                    'Accept' => 'application/rss+xml, application/xml;q=0.9, */*;q=0.8'
                ])->get($feed->url);

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    $count = 0;
                    foreach ($feedData['channel']['item'] as $item) {
                        if ($count >= 20) break; // Stop after 20 items
                        $count++;

                        $title       = $item['title'];
                        $link        = $item['link'];
                        $description = $this->extractSummaryFromDescription($item['description'] ?? null);
                        try {
                            $pubDate     = Carbon::parse($item['pubDate'])->format('d M Y');
                        } catch (\Throwable $th) {
                            //throw $th;
                            $pubDate = null;
                        }
                        $category    = $item['category'] ?? null;
                        $media       = $this->extractImageFromDescription($item['description'] ?? null);

                        try {

                            $data =array(
                                    'feed_id' => $id,
                                    'title' =>$title,
                                    'link' =>$link,
                                    'description' =>$description,
                                    'pubDate' =>$pubDate,
                                    'creator' => $category,
                                    'media' => $media
                                );

                            Feedvalues::create($data);
                            
                        } catch (\Throwable $th) {
                            //throw $th;
                            Log::error("12th Feed Failed: " . $th->getMessage());
                        }
                    }
                }
        } catch (\Exception $e) {
                // Optionally log the error
                Log::error("12th Feed Failed: " . $e->getMessage());
        }
        //12th Feed End [Cyber Defense Wire] ##################################

         //static content replace
       Feedvalues::where('creator', 'Stevin')
            ->update(['creator' => 'Cyber Defense Magazine']);



    }


    private function extractImageFromDescription($description)
    {
        libxml_use_internal_errors(true); // Suppress HTML parsing warnings
        $doc = new \DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $description);

        $imgTags = $doc->getElementsByTagName('img');
        if ($imgTags->length > 0) {
            return $imgTags->item(0)->getAttribute('src');
        }

        return null;
    }

    private function extractSummaryFromDescription($description)
    {
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $description);

        $paragraphs = $doc->getElementsByTagName('p');

        foreach ($paragraphs as $p) {
            $text = trim($p->textContent);

            // Skip "The post ..." footer paragraph
            if (str_starts_with($text, 'The post')) {
                continue;
            }

            // Return first valid paragraph (excluding image-only ones)
            if (!empty($text)) {
                return $text;
            }
        }

        return null;
    }

}
