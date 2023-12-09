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

        $data =  $request->validate([
            'title'=>'required|string|min:3|max:20',
            'description'=>'required|string|min:3|max:500',
            'price_from'=>'required|numeric|min:0',
            'price_to'=>'required|numeric|gt:price_from',
            'image'=>'required|file|mimes:png,jpg,jpeg,svg|max:2048',// 1024 * X = X MB
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = time() .'.'. $image->getClientOriginalExtension();
            $data['image'] = 'uploads/'.$file_name;
            $image->move(public_path('uploads'),$file_name);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
