<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Spatie\Menu\Laravel\Menu;

class AttributeController extends Controller
{
    public function index() {

        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $attributes = App\Attribute::all();
        return view('admin-attribute', [
            'attributes' => $attributes,
            'menu' => $menu
        ]);
    }

    public function create() {
        $categories = App\Category::all();
        $this->authorize('access', auth()->user());
        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        return view('admin-attribute-create', [
            'categories' => $categories,
            'menu' => $menu
        ]);
    }

    public function store($category_id) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $category = App\Category::find($category_id);
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        $ids = [];
        $attributes['name'] = str_replace(' ', '', $attributes['name']);
        $attribute_array = explode(',', $attributes['name']);
        foreach($attribute_array as $attribute) {
            if($row = App\Attribute::where('name', $attribute)->first()) {
                array_push($ids, $row->id);
            } else {
                $attributeTemp['type'] = 'text';
                $attributeTemp['required'] = true;
                $attributeTemp['name'] = $attribute;
                App\Attribute::create($attributeTemp);
                $row = App\Attribute::where('name', $attribute)->first();
                array_push($ids, $row->id);
            }
        }

        $category->attributes()->attach($ids);
        return redirect('/admin')->with('success', 'category added successfully');
    }

    public function storeSeparate() {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $attribute = request()->validate([
           'name' => 'required|unique:attributes'
        ]);
        $attribute['type'] = 'text';
        $attribute['required'] = true;
        App\Attribute::create($attribute);
        $attribute = App\Attribute::where('name', request('name'))->first();
        $attribute->categories()->attach(request('category_id'));
        return redirect('/admin/attribute')->with('success', 'attribute added successfully');
    }

    public function update($category_id) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $category = App\Category::find($category_id);
        $attributes = $category->attributes;
        foreach($attributes as $attribute) {
            $attributeItem['name'] = request($attribute->id);
            $attributeItem['type'] = 'text';
            $attributeItem['required'] = true;
            $attribute->update($attributeItem);
        }

        return redirect('/admin')->with('success', 'Edit successful');
    }

    public function destroy($attribute_id) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $attribute = App\Attribute::find($attribute_id);
        $attribute->categories()->detach();

        $details = App\Detail::where('attribute_name', $attribute->name)->get();
        foreach($details as $detail) {
            $detail->product()->detach();
            $detail->delete();
        }
        $attribute->delete();

        return back()->with('success', 'Delete successful');
    }
}
