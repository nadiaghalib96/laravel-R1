<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function test1(){
        return view('login');
    }
    public function login(){
        return view('login');
    }
    public function showUpload(){
        return view('upload');
    }

    public function place(){
        return view('place');
    }

    public function blog(){
        return view('blog');
    }

    public function upload(Request $request){
        // $file_extension = $request->image->getClientOriginalExtension();
        // $file_name = time() . '.' . $file_extension;
        $h = $this->uploadFile($request->image, 'assets/images');
        return $h;
    }
    public function received(Request $request){
        $msg = "Your email is: " . $request->email . "<br> and Password is: " . $request->pwd;
        return $msg;
    }

    function home(){
        $news = News::get();
        return view('home',compact('news'));
    }

    public function mySession(){
       session()->put('test','first session');
      session()->forget('test');
     $data = session('test');
    return view('session',compact('data'));
    }
}
