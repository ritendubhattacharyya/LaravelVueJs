<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index() {
        return Blog::latest()->get();
    }

    public function store() {
        $category = implode(request('categories'));
        Blog::create([
            'title' => request('title'),
            'body' => request('body'),
            'category' => $category,
            'author' => request('author')
        ]);
        return response('success');
    }

    public function show($id) {
        return Blog::find($id);
    }
}
