<?php

namespace Modules\Faq\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Faq\App\Models\Faq;

class FaqController extends Controller
{

    public function index()
    {
        $data['dataList'] = Faq::orderBy('id', 'desc')->get();
        return view('faq::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faq::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $result = Faq::create($input);
        if ($result) {
            return redirect()->route('faq.index')->with('success', 'Faq added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('faq::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Faq::findOrFail($id);
        return view('faq::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        $data = Faq::find($id);
        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('faq.index')->with('success', 'Faq updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Faq::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Faq deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
