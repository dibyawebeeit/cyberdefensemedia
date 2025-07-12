<?php

namespace Modules\Cms\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Cms\App\Models\Aboutus;
use Modules\Cms\App\Models\Home;
use Modules\Cms\App\Models\Section;
use Modules\Feed\App\Models\Feed;
use Modules\Setting\App\Models\Setting;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cms::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('cms::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function about_us(Request $request) {
        $data['dataList'] = Aboutus::first();

        return view('cms::about_us',$data);
    }

    public function submit_about_us(Request $request) {
        $validated = $request->validate([
            'title1' => 'required|string|max:255',
            'desc1' => 'required|string',
            // 'title2' => 'required|string|max:255',
            // 'desc2' => 'required|string',
            // 'cta_title' => 'required|string|max:255',
            // 'cta_button_text' => 'required|string|max:100',
            // 'cta_button_url' => 'required|string|max:100',
        ]);

        $data = Aboutus::first();
        $input = $request->all();

        if ($request->has('image1')) {
            $validated = $request->validate([
                'image1' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('image1');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->image1);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image1'] = $imageName;
        } 

        if ($request->has('image2')) {
            $validated = $request->validate([
                'image2' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('image2');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->image2);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image2'] = $imageName;
        }

        if ($request->has('cta_bg_image')) {
            $validated = $request->validate([
                'cta_bg_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('cta_bg_image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->cta_bg_image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['cta_bg_image'] = $imageName;
        }

        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'About Us updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    public function home(Request $request) {
        $data['dataList'] = Aboutus::first();

        $data['feedList'] = Feed::where('status',1)->get();
        $data['sectionList'] = Section::select('id','section_title')->get();

        $data['section1'] = Home::where('section_id',1)->first();
        $data['section2'] = Home::where('section_id',2)->get();
        $data['section3'] = Home::where('section_id',3)->first();
        $data['section4'] = Home::where('section_id',4)->first();
        $data['section5'] = Home::where('section_id',5)->first();
        $data['section6'] = Home::where('section_id',6)->first();
        $data['section7'] = Home::where('section_id',7)->first();

        // dd($data['sectionList']);

        return view('cms::home',$data);
    }

    public function submit_home(Request $request)
    {
        $section_ids = [
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
            5 => 6,
            6 => 7,
        ];
        foreach ($section_ids as $key => $id) {
            Section::where('id', $id)->update([
                'section_title' => $request->title[$key]
            ]);
        }


        $home_ids = [
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
            5 => 6,
            6 => 7,
            7 => 8,
        ];

        foreach ($home_ids as $key => $id) {
            Home::where('id', $id)->update([
                'feed_id' => $request->feed_id[$key],
                'items' => $request->items[$key],
                'title_length' => $request->title_length[$key],
                'desc_length' => $request->desc_length[$key],
            ]);
        }

        return redirect()->back()->with('success', 'Home updated successfully');

    }
}
