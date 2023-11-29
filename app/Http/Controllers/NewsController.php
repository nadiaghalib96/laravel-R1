<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    
    private $colums =['title','author','content','published'];

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
    








    function update(Request $request,string $id) {
     News::where('id',$id)->update($request->only($this->colums));
        
        
        $news  = News::findOrFail($id);

        return back()->with('success','news updated successfully');

    }






    
    function edit(string $id) {
        $news  = News::findOrFail($id);
        return view('news_edit',compact('news'));
        
        // return view('news_edit',[
        //     'news'=>$news,
        // ]);

        // return 'car id is' . $id ;
    }


    function show(string $id) {

        $news  = News::findOrFail($id);
        return view('newsDetail',compact('news'));
    }

    function destory(string $id) {

        $news  = News::findOrFail($id);
        News::where ('id' , $id)->delete() ;
        return back()->with('success','news deleted successfully');
    }
}
