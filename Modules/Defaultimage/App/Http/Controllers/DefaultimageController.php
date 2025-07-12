<?php

namespace Modules\Defaultimage\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Defaultimage\App\Models\DefaultImage;

class DefaultimageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataList'] = DefaultImage::orderBy('id', 'desc')->get();
        return view('defaultimage::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('defaultimage::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp,svg,gif|max:1024',
        ]);

        $image = $request->file('image');
        $customName = 'image_' . date('ymdhis') . '.' . $image->getClientOriginalExtension();
        // Define path
        $destinationPath = public_path('uploads/defaultImage');
        // Move the image to the destination
        $image->move($destinationPath, $customName);

        $input = $request->all();
        $input['file']=$customName;
        $result = DefaultImage::create($input);
        if ($result) {
            return redirect()->route('defaultimage.index')->with('success', 'Image added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('defaultimage::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('defaultimage::edit');
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
        $data = DefaultImage::find($id);
        $path = public_path('uploads/defaultImage/' . $data->file);
        if (file_exists($path)) {
            unlink($path);
        }
        $result = $data->delete();

        if ($result) {
            return redirect()->back()->with('success', 'Image deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
