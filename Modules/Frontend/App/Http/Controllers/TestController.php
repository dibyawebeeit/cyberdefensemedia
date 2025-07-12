<?php

namespace Modules\Frontend\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Bannerfeed;
use App\Models\Cyberattackfeed;
use App\Models\Cyberdefensefeeds;
use App\Models\Hacknewsfeed;
use App\Models\Securityfeed;
use Modules\Cms\App\Models\Aboutus;
use Modules\Contact\App\Models\Contact;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('frontend::index');
        $data=array();

        //Direct API Call
        // $data['bannerFeedList']=$this->bannerFeed();
        // $data['cyberdefenseFeedList']=$this->cyberdefenseFeed();
        // $data['hacknewsFeedList']=$this->hacknewsFeed();
        // $data['securityFeedList']=$this->securityFeed();
        // $data['cyberattackFeedList']=$this->cyberattackFeed();
        // dd($this->cyberdefenseFeed());
    }

    public function bannerFeed()
    {
        return Cache::remember('banner_feed_data', now()->addHours(12), function () {
            $items = [];

            try {
                $response = Http::get(env('BANNER_FEED_URL'));

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, null, LIBXML_NOCDATA);
                    $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

                    foreach ($xml->channel->item as $item) {
                        $mediaContent = $item->xpath('media:content');
                        $mediaThumbnail = $item->xpath('media:thumbnail');

                        $items[] = [
                            'title'       => (string) $item->title,
                            'link'        => (string) $item->link,
                            'description' => (string) $item->description,
                            'pubDate'     => Carbon::parse((string) $item->pubDate)->format('d M Y'),
                            'creator'     => (string) $item->children('dc', true)->creator ?? '',
                            'media'       => isset($mediaContent[0]['url']) ? (string) $mediaContent[0]['url'] :
                                            (isset($mediaThumbnail[0]['url']) ? (string) $mediaThumbnail[0]['url'] : null),
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Log the error if needed
                // Log::error("Banner Feed Error: " . $e->getMessage());
            }

            return $items; // Only array of strings and scalar values — safe for caching
        });
    }

    public function cyberdefenseFeed()
    {
        return Cache::remember('cyberdefense_feed_data', now()->addHours(12), function () {
            $items = [];

            try {
                $response = Http::get(env('CYBER_DEFENSE_URL'));

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    foreach ($feedData['channel']['item'] as $key => $item) {
                        if ($key == 4) {
                            break;
                        }

                        $items[] = [
                            'title'       => substr($item['title'],0,40),
                            'link'        => $item['link'],
                            'description' => $this->extractSummaryFromDescription($item['description'] ?? ''),
                            'pubDate'     => Carbon::parse($item['pubDate'])->format('d M Y'),
                            'category'    => $item['category'] ?? 'NA',
                            'media'       => $this->extractImageFromDescription($item['description'] ?? ''),
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Optionally log the error
                // Log::error("CyberDefense RSS Fetch Failed: " . $e->getMessage());
            }

            return $items;
        });
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

    public function hacknewsFeed()
    {
        return Cache::remember('hacknews_feed_data', now()->addHours(12), function () {
            $items = [];

            try {
                $response = Http::get(env('HACK_NEWS_FEED_URL'));

                if ($response->ok()) {
                    $xml = simplexml_load_string($response->body(), null, LIBXML_NOCDATA);
                    $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

                    $itemsRaw = iterator_to_array($xml->channel->item, false);
                    $limitedItems = array_slice($itemsRaw, 0, 4);

                    foreach ($limitedItems as $item) {
                        $mediaUrl = asset('frontendassets/noimage.jpg');

                        if (isset($item->enclosure)) {
                            $attributes = $item->enclosure->attributes();
                            $mediaUrl = (string) $attributes['url'];
                        }

                        $items[] = [
                            'title'       => (string) $item->title,
                            'link'        => (string) $item->link,
                            'description' => substr((string) $item->description, 0, 100),
                            'pubDate'     => Carbon::parse((string) $item->pubDate)->format('d M Y'),
                            'creator'     => (string) $item->author ?? '',
                            'media'       => $mediaUrl,
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Optionally log the error
                // Log::error("HackNews RSS Fetch Failed: " . $e->getMessage());
            }

            return $items;
        });
    }

    public function securityFeed()
    {
        return Cache::remember('security_feed_data', now()->addHours(12), function () {
            $items = [];

            try {
                $response = Http::get(env('SECURITY_FEED_URL'));

                if ($response->ok()) {
                    $xml = simplexml_load_string($response->body(), null, LIBXML_NOCDATA);
                    $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

                    $itemsRaw = iterator_to_array($xml->channel->item, false);
                    $limitedItems = array_slice($itemsRaw, 0, 2);

                    foreach ($limitedItems as $item) {
                        $items[] = [
                            'title'       => (string) $item->title,
                            'link'        => (string) $item->link,
                            'description' => substr((string) $item->description, 0, 100),
                            'pubDate'     => Carbon::parse((string) $item->pubDate)->format('d M Y'),
                            'creator'     => null,
                            'media'       => asset('frontendassets/noimage.jpg'),
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Optionally log the error
                // Log::error("Security RSS Fetch Failed: " . $e->getMessage());
            }

            return $items;
        });
    }

    public function cyberattackFeed()
    {
        return Cache::remember('cyberattack_feed_data', now()->addHours(12), function () {
            $items = [];

            try {
                $response = Http::get(env('CYBER_ATTACK_FEED_URL'));

                if ($response->ok()) {
                    $xmlString = $response->body();
                    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $feedData = json_decode($json, true);

                    if (!empty($feedData['channel']['item'])) {
                        $limitedItems = array_slice($feedData['channel']['item'], 0, 4);

                        foreach ($limitedItems as $item) {
                            $mediaUrl = asset('frontendassets/noimage.jpg');

                            if (isset($item['enclosure'])) {
                                $attributes = $item['enclosure']['@attributes'];
                                $mediaUrl = $attributes['url'];
                            }

                            $items[] = [
                                'title'       => $item['title'],
                                'link'        => $item['link'],
                                'description' => $this->extractSummaryFromDescription($item['description'] ?? ''),
                                'pubDate'     => Carbon::parse($item['pubDate'])->format('d M Y'),
                                'category'    => $item['category'] ?? 'NA',
                                'media'       => $mediaUrl,
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                // Optional: log error
                // Log::error("CyberAttack RSS Fetch Failed: " . $e->getMessage());
            }

            return $items;
        });
    }
    
}
