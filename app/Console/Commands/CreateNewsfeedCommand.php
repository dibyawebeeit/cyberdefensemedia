<?php

namespace App\Console\Commands;

use App\Models\Newsfeed;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Feedvalues\App\Models\Feedvalues;
use Illuminate\Support\Arr;

class CreateNewsfeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-newsfeed-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Newsfeed Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Newsfeed::truncate();
        try {
            $response = Http::get(env('NEWS_API_URL'));
            $result =  $response->json()['articles'] ?? [];
            
            // Sort by publishedAt descending
           $sorted = collect($result)
            ->filter(function ($item) {
                // Remove items with missing or invalid dates
                try {
                    return !empty($item['publishedAt']) && Carbon::parse($item['publishedAt']);
                } catch (\Throwable $e) {
                    return false;
                }
            })
            ->sortByDesc(function ($item) {
                return Carbon::parse($item['publishedAt']);
            })
            ->values(); // optional: reindex the collection
            
            foreach ($sorted as $item) {

            $title       = $item['title'];
            $link        = $item['url'];
            $description = $item['description'];
            try {
                $pubDate     = Carbon::parse($item['publishedAt'])->format('d M Y');
            } catch (\Throwable $th) {
                //throw $th;
                $pubDate = null;
            }
            $creator    = $item['author'] ?? null;
            $media       = $item['urlToImage'] ?? null;

            try {
                $data =array(
                    'title' =>$title,
                    'link' =>$link,
                    'description' =>$description,
                    'pubDate' =>$pubDate,
                    'creator' => $creator,
                    'media' => $media
                );
                Newsfeed::create($data);
            } catch (\Throwable $th) {
                //throw $th;
                Log::error("News Feed Failed: " . $th->getMessage());
            }
        }
        } catch (\Throwable $e) {
            //throw $th;
            Log::error("News Feed Error: " . $e->getMessage());
        }
    }
}
