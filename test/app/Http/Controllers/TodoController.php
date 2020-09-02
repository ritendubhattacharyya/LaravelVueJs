<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class TodoController extends Controller
{
    public function index() {
        $todos = App\Todo::orderBy('order')->get();
        return view('welcome', compact('todos'));
    }

    public function store() {
        $attributes = request()->validate([
           'name' => 'required'
        ]);
        $attributes['done'] = request('done');
        return App\Todo::create($attributes);
    }

    public function delete($id) {
        App\Todo::find($id)->delete();
    }

    public function update($id) {
        $todo = App\Todo::find($id);
        $attribute['name'] = request('name');
        $todo->update($attribute);
    }

    public function isDone($id) {
        $attribute['done'] = request('done');
        $todo = App\Todo::find($id);

        $todo->update($attribute);
    }

    public function updateAll() {
//        dd(request('todoUpdated'));
        App\Todo::truncate();
        foreach (request('todoUpdated') as $todo) {
            App\Todo::create([
               'id'=> $todo['id'],
                'name'=> $todo['name'],
                'done'=> $todo['done'],
                'order'=> $todo['order'],
                'created_at'=> $todo['created_at'],
                'updated_at'=> $todo['updated_at']
            ]);
        }
    }
}
