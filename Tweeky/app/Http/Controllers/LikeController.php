<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;

class LikeController extends Controller
{
    public function like($id) {
        $tweek = App\Tweek::find($id);
        $tweek->like(auth()->user());
        return back();
    }

    public function dislike($id) {
        $tweek = App\Tweek::find($id);
        $tweek->dislike(auth()->user());
        return back();
    }
}
