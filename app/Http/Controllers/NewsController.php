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

        $data =  $request->validate([
            'title'=>'required|string|min:3|max:20',
            'author'=>'required|string|min:3|max:20',
            'content'=>'required|string|min:3|max:20',
            'published'=>'required|bool',
            'image'=>'required|file|mimes:png,jpg,jpeg,svg|max:2048',// 1024 * X = X MB
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = time() .'.'. $image->getClientOriginalExtension();
            $data['image'] = 'uploads/'.$file_name;
            $image->move(public_path('uploads'),$file_name);
        }
        News::create($data);    

        return back()->with('success','news create successfully');
    }
    
    function index() {
        $news = News::get();
        return view('news_index' , compact('news'));
    }
    
    function update(Request $request,string $id) {
        $news  = News::findOrFail($id);

        $data =  $request->validate([
            'title'=>'required|string|min:3|max:20',
            'author'=>'required|string|min:3|max:20',
            'content'=>'required|string|min:3|max:20',
            'published'=>'required|bool',
            'image'=>'sometimes|nullable|file|mimes:png,jpg,jpeg,svg|max:2048',// 1024 * X = X MB

        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = time() .'.'. $image->getClientOriginalExtension();
            $data['image'] = 'uploads/'.$file_name;
            $image->move(public_path('uploads'),$file_name);
            @unlink(public_path($news->image));
        }

        $news->update($data);
        
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
        $news->delete() ;
        return back()->with('success','news deleted successfully');
    }
    
    function delete(string $id) {
        $news  = News::onlyTrashed()->findOrFail($id);
        @unlink(public_path($news->image));
        $news->forceDelete() ;
        return back()->with('success','news deleted successfully');
    }
    
    function restore(string $id) {
        $news  = News::onlyTrashed()->findOrFail($id);
        $news->restore() ;
        return back()->with('success','news restored successfully');
    }

    public function trashed(){
        $news = News::onlyTrashed()->get();
        return view('trashedNews' , compact('news'));
    }
}