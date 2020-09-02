<?php

namespace App\Http\Controllers;

use App\Tweek;
use Illuminate\Http\Request;

class TweekController extends Controller
{
    public function index()
    {
        $ids = auth()->user()->follows()->pluck('id');
        return view('home', [
            'tweeks' => Tweek::whereIn('user_id', $ids)->withLikes()->orWhere('user_id', auth()->user()->id)->latest()->get()
        ]);
    }

    public function store() {
        $attribute = request()->validate(['body' => 'required|max:255']);
        Tweek::create([
            'user_id' => auth()->user()->id,
            'body' => $attribute['body']
        ]);

        return redirect('/tweeks');
    }
}
