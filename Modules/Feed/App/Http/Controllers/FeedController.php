<?php

namespace Modules\Feed\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Feed\App\Models\Feed;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data['dataList'] = Feed::orderBy('id', 'desc')->get();
        return view('feed::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feed::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'url' => 'required|string|max:255',
        ]);

        $input = $request->all();
        $result = Feed::create($input);
        if ($result) {
            return redirect()->route('feed.index')->with('success', 'Feed added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('feed::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Feed::findOrFail($id);
        return view('feed::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'url' => 'required|string|max:255',
        ]);

        $data = Feed::find($id);
        $input = $request->all();
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('feed.index')->with('success', 'Feed updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Feed::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Feed deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
