<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $colums = ['title', 'author', 'content', 'published'];

    function store(Request $request)
    {

        $data = $this->validated($request);
        News::create($data);

        return back()->with('success', 'news create successfully');
    }

    function create()
    {
        return view('news_create');
    }

    function index()
    {
        $news = News::get();
        return view('news_index', compact('news'));
    }

    function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $data = $this->validated($request, $news->image);

        $news->update($data);

        return back()->with('success', 'news updated successfully');

    }

    function edit(string $id)
    {
        $news = News::findOrFail($id);
        return view('news_edit', compact('news'));

        // return view('news_edit',[
        //     'news'=>$news,
        // ]);

        // return 'car id is' . $id ;
    }


    function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('newsDetail', compact('news'));
    }

    function destory(string $id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return back()->with('success', 'news deleted successfully');
    }

    function delete(string $id)
    {
        $news = News::onlyTrashed()->findOrFail($id);
        @unlink(public_path($news->image));
        $news->forceDelete();
        return back()->with('success', 'news deleted successfully');
    }

    function restore(string $id)
    {
        $news = News::onlyTrashed()->findOrFail($id);
        $news->restore();
        return back()->with('success', 'news restored successfully');
    }

    public function trashed()
    {
        $news = News::onlyTrashed()->get();
        return view('trashedNews', compact('news'));
    }


    public function validated(Request $request, $old_image = null)
    {
        $messages = [
            'title.required' => 'title is required',
            'title.string' => 'title must be string',
            'title.min' => 'title must be at least 3 characters',
            'title.max' => 'title must be at most 20 characters',
            'author.required' => 'author is required',
            'author.string' => 'author must be string',
            'author.min' => 'author must be at least 3 characters',
            'author.max' => 'author must be at most 20 characters',
            'content.required' => 'content is required',
            'content.string' => 'content must be string',
            'content.min' => 'content must be at least 3 characters',
            'content.max' => 'content must be at most 20 characters',
            'published.required' => 'published is required',
            'published.bool' => 'published must be boolean',
            'image.required' => 'image is required',
            'image.file' => 'image must be file',
            'image.mimes' => 'image must be png,jpg,jpeg,svg',
            'image.max' => 'image must be at most 2048',
        ];

        $data = $request->validate([
            'title' => 'required|string|min:3|max:20',
            'author' => 'required|string|min:3|max:20',
            'content' => 'required|string|min:3|max:20',
            'published' => 'required|bool',
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
