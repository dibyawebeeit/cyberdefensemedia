<?php

namespace App\Http\Controllers;

use App\Models\Newsfeed;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Modules\Feedvalues\App\Models\Feedvalues;
use Modules\Feed\App\Models\Feed;

class TestController extends Controller
{
    public function index()
    {
        // Newsfeed::truncate();
        try 
        {
               $id = 11;
               $feed = Feed::where('id',$id)->first();

                $response = Http::get('https://api.rss2json.com/v1/api.json', [
                    'rss_url' => $feed->url
                ]);

                if ($response->ok()) {

                    $feedData = $response->json();

                    $count = 0;
                    foreach ($feedData['items'] as $item) {
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
