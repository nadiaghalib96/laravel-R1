<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::query()->limit(6)->get();

        return view('home',compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addplace');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data =  $this->validated($request);
        Place::create($data);

        return back()->with('success','place create successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view('editplace',compact('place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $data = $this->validated($request,$place->image);

        $place->update($data);

        return back()->with('success','place updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return back()->with('success','place deleted successfully');
    }

    public function validated(Request $request, $old_image = null)
    {
        $messages = [
            'title.required' => 'title is required',
            'title.string' => 'title must be string',
            'title.min' => 'title must be at least 3 characters',
            'title.max' => 'title must be at most 20 characters',
            'description.required' => 'description is required',
            'description.string' => 'description must be string',
            'description.min' => 'description must be at least 3 characters',
            'description.max' => 'description must be at most 500 characters',
            'price_from.required' => 'price_from is required',
            'price_from.numeric' => 'price_from must be numeric',
            'price_from.min' => 'price_from must be at least 0',
            'price_to.required' => 'price_to is required',
            'price_to.numeric' => 'price_to must be numeric',
            'price_to.gt' => 'price_to must be greater than price_from',
            'image.required' => 'image is required',
            'image.file' => 'image must be file',
            'image.mimes' => 'image must be png,jpg,jpeg,svg',
            'image.max' => 'image must be at most 2048',
        ];

        $data = $request->validate([
            'title' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:3|max:500',
            'price_from' => 'required|numeric|min:0',
            'price_to' => 'required|numeric|gt:price_from',
            'image' => 'sometimes|nullable|file|mimes:png,jpg,jpeg,svg|max:2048',// 1024 * X = X MB

        ], $messages);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = time() . '.' . $image->getClientOriginalExtension();
            $data['image'] = 'uploads/' . $file_name;
            $image->move(public_path('uploads'), $file_name);
            if ($old_image) {
                @unlink(public_path($old_image));
            }
        }
        return $data;
    }
}
