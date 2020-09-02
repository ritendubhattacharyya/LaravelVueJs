<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Validation\Rule;
use Spatie\Menu\Laravel\Menu;

class CategoryController extends Controller
{
    public function create() {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');
        return view('admin-create-category', compact('menu'));
    }

    public function store() {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $attribute = request()->validate([
            'name' => 'required|max:20|unique:categories'
        ]);
        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        App\Category::create($attribute);
        return view('admin-create-attribute', [
            'category' => App\Category::where('name', request('name'))->first(),
            'menu' => $menu
        ]);
    }

    public function edit($category_id) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $category = App\Category::find($category_id);

        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        return view('admin-category-edit', [
            'category' => $category,
            'menu' => $menu
        ]);
    }

    public function next($category_id) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $category = App\Category::find($category_id);
        $attribute = request()->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category)],
        ]);

        $category->update($attribute);

        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        return view('admin-attribute-edit-2', [
            'attributes' => $category->attributes,
            'category' => $category,
            'menu' => $menu
        ]);
    }

    public function destroy($category_id) {
        $category = App\Category::find($category_id);
        $this->authorize('access', auth()->user());
        if($category->products->count() > 0) {
            return back()->with('error', 'please delete the products first!!!');
        } else {
            $category->attributes()->detach();
            $category->delete();
            return back()->with('success', 'delete successful');
        }
    }
}
