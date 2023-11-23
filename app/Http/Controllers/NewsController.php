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
        $news = News::get();
        return view('news_index' , compact('news'));
    }
    
    function update(string $id,Request $request) {


    }
    
    function edit(string $id) {
        $news  = News::findOrFail($id);
        return view('news_edit',compact('news'));
        
        // return view('news_edit',[
        //     'news'=>$news,
        // ]);

        // return 'car id is' . $id ;
    }
}
