<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class StudentController extends Controller
{
    public function index() {
        $students = App\Student::all();
        return view('home', compact('students'));
    }

    public function create() {
        return view('addStudent');
    }

    public function store() {
        $attributes = request()->validate([
           'name' => 'required',
           'address' => 'required',
           'section' => 'required'
        ]);

        App\Student::create($attributes);
    }

    public function update($id) {
        $student = App\Student::find($id);
        $attribute = request()->validate([
            'name' => 'required',
            'address' => 'required',
            'section' => 'required'
        ]);

        $student->update($attribute);
    }

    public function destroy($id) {
        $student = App\Student::find($id);
        $student->delete();
    }
}
