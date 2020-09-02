<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App;

class ProfileController extends Controller
{
    public function show($id) {
        $user = App\User::find($id);
        $tweeks = $user->tweeks->pluck('id')->map(function($tweekId) {
            return App\Tweek::withLikes()->find($tweekId);
        });
        return view('show_profile', [
            'user' => $user,
            'tweeks' => $tweeks
        ]);
    }

    public function follow($id) {
        $user = App\User::find($id);
        auth()->user()->follow($user);
        return back();
    }

    public function unfollow($id) {
        $user = App\User::find($id);
        auth()->user()->unfollow($user);
        return back();
    }

    public function edit($id) {
        $user = App\User::find($id);
        $this->authorize('edit', $user);
        return view('edit_profile', compact('user'));
    }

    public function update($id) {
        $user = App\User::find($id);
        $this->authorize('edit', $user);
        $attribute = request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user)],
            'bio' => 'max:255',
            'avatar' => 'file'
        ]);

        if(request('avatar')) {
            $attribute['avatar'] = request('avatar')->store('avatars');
        }

        $user->update($attribute);

        return redirect("/profile/$id");
    }
}
