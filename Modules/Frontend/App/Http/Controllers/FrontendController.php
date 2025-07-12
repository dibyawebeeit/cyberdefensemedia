<?php

namespace Modules\Frontend\App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Newsfeed;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Modules\Cms\App\Models\Aboutus;
use Modules\Cms\App\Models\Home;

use Modules\Contact\App\Models\Contact;
use Modules\Defaultimage\App\Models\DefaultImage;
use Modules\Feedvalues\App\Models\Feedvalues;
use Modules\Newsletter\App\Models\Newsletter;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public $randomImages;
    public function __construct()
    {
        // $this->randomImages = ['cdn-default1.png', 'cdn-default2.png', 'cdn-default3.png'];
        $this->randomImages = DefaultImage::pluck('file')->toArray();
    }
    public function index()
    {
        $data=array();

        // Section 1
        
        $section1 = Home::with('sectionDetails')->where('id', 1)->first();
        $section1->setRelation('feedList', 
            $section1->feedList()->limit($section1->items)->get()
        );
        foreach ($section1->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section1']=$section1;



        $today = Carbon::today()->format('d M Y');
        $section1 = Feedvalues::where('pubDate', $today)->get();

        // Optionally: group by feed_id
        // $groupedByFeed = $todayFeeds->groupBy('feed_id');

        // Output structure: Collection keyed by feed_id
        foreach ($section1 as $item) {
            if (empty($item->media) || !ImageHelper::isValidImageUrl($item->media)) {
                $item->media = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section1']=$section1;


        // Section 2: 
        $section2 = Home::with('sectionDetails')->where('id', 2)->first();
        $section2->setRelation('feedList', 
            $section2->feedList()->limit($section2->items)->get()
        );
        foreach ($section2->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section2']=$section2;

        $section_two = Home::with('sectionDetails')->where('id', 3)->first();
        $section_two->setRelation('feedList', 
            $section_two->feedList()->offset(1)->limit($section_two->items)->get()
        );
        foreach ($section_two->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section_two']=$section_two;

        // Section 3: 
        $section3 = Home::with('sectionDetails')->where('id', 4)->first();
        $section3->setRelation('feedList', 
            $section3->feedList()->limit($section3->items)->get()
        );
        foreach ($section3->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section3']=$section3;

        // Section 4: 
        $section4 = Home::with('sectionDetails')->where('id', 5)->first();
        $section4->setRelation('feedList', 
            $section4->feedList()->limit($section4->items)->get()
        );
        foreach ($section4->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section4']=$section4;

        // Section 5: 
        $section5 = Home::with('sectionDetails')->where('id', 6)->first();
        $section5->setRelation('feedList', 
            $section5->feedList()->limit($section5->items)->get()
        );
        foreach ($section5->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section5']=$section5;


        // Section 6: 
        $section6 = Home::with('sectionDetails')->where('id', 7)->first();
        $section6->setRelation('feedList', 
            $section6->feedList()->limit($section6->items)->get()
        );
        foreach ($section6->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section6']=$section6;

        // Section 7: 
        $section7 = Home::with('sectionDetails')->where('id', 8)->first();
        $section7->setRelation('feedList', 
            $section7->feedList()->limit($section7->items)->get()
        );
        foreach ($section7->feedList as &$item) {
            if (empty($item['media']) || !ImageHelper::isValidImageUrl($item['media'])) {
                $item['media'] = asset('uploads/defaultImage/' . $this->randomImages[array_rand($this->randomImages)]);
            }
        }
        $data['section7']=$section7;


        // dd($data['section2']);
        return view('frontend::index', $data);
    }
    public function about()
    {
        $data['about']=Aboutus::first();
        return view('frontend::about', $data);
    }
    public function news()
    {
        $data=array();

        //Random Images
        $data['randomImages']= $this->randomImages;
        return view('frontend::news', $data);
    }

    public function newsFeedApi() {
      
        // Separate feed_id == 11 first
        $priorityFeeds = Feedvalues::where('feed_id', 11)->get();

        // Then get all other Feedvalues
        $otherFeeds = Feedvalues::where('feed_id', '!=', 11)->get();

        // Merge feedvalues with priority items first
        $orderedFeeds = $priorityFeeds->concat($otherFeeds);

        // Get all newsfeeds
        $newsFeeds = Newsfeed::all();

        // Merge everything together
        $news = $orderedFeeds->merge($newsFeeds);

        // Sort the merged list by pubDate descending (if needed)
        $sortedNews = $news->sortByDesc(function ($item) {
            try {
                return Carbon::createFromFormat('d M Y', $item->pubDate);
            } catch (\Exception $e) {
                return now(); // Fallback to current date if parsing fails
            }
        })->values(); // Re-index

        return response()->json($sortedNews);
    }

    public function contact()
    {
        $data=array();
        return view('frontend::contact', $data);
    }
    public function submit_contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            "phone" => ['required', new PhoneNumber()],
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $input = $request->all();
        $result = Contact::create($input);
        if ($result) {
            $mailto = config('mail.to_address');
            Mail::to($mailto)->send(new ContactMail($validated));
            return redirect()->back()->with('success', 'Thank You. We will contact you soon.');
        } else {
            return redirect()->back()->withInput()->with('error', 'something went wrong!');
        }
    }

    public function submit_newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Something went wrong!');
        }

        $input = $request->all();
        $result = Newsletter::create($input);
        if ($result) {
            return redirect()->back()->with('success', 'Thank You. We will contact you soon.');
        } else {
            return redirect()->back()->withInput()->with('error', 'something went wrong!');
        }
    }

    

}
