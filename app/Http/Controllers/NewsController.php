<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    function create() {
        return view('news_create');
    }

    function store(Request $request) {

        $data =  $request->only([
            'title',
            'author',
            'content',
            'published'
        ]);

        News::create($data);    

        return back()->with('success','news create successfully');
    }
    
    function index() {
        return view('news_index');
    }
    
    // function edit($id) {
    //     $news  = News::findOrFail($id);
    //     dd($news);
    // }
}
