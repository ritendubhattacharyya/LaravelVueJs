<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Spatie\Menu\Laravel\Menu;

class AdminController extends Controller
{

    public function index() {
        $this->authorize('can-open', auth()->user());
        $products = App\product::where('manager_id', auth()->user()->id)->get();
        if(auth()->user()->roles === 'admin') {
            $products = App\Product::all();
        }

        // menu building
        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>')
            ->setActive('admin');

        $categories = App\Category::all();
        return view('admin-home', [
            'menu' => $menu,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function destroy($id) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $product = App\Product::find($id);

        $detailIds = [];
        $details = $product->details;
        foreach($details as $detail) {
            if($detail->product->count() === 1) {
                array_push($detailIds, $detail->id);
            }
        }

        $product->details()->detach();
        $product->delete();
        App\Detail::destroy($detailIds);
        return redirect('/admin')->with('success', 'Delete Successful');
    }

    public function edit($id) {
        $this->authorize('can-open', auth()->user());
        $product = App\Product::find($id);
        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>')
            ->setActive('Add Product');
        return view('admin-edit', [
            'product' => $product,
            'menu' => $menu
        ]);
    }

    public function editNext($id) {
        $this->authorize('can-open', auth()->user());
        $product = App\Product::find($id);

        $attribute = request()->validate([
            'sku' => 'required|max:255',
            'price' => 'required|numeric',
            'offer' => 'required|numeric',
            'description' => 'required|min:8|max:255',
            'qty' => 'required|numeric'
        ]);

        if(request('avatar')) {
            $attribute['avatar'] = request('avatar')->store('avatars');
        }

        $product->update($attribute);

        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>')
            ->setActive('/admin');

        return view('admin-edit-2', [
            'product' => $product,
            'menu' => $menu
        ]);
    }

    public function update($id) {
        $this->authorize('can-open', auth()->user());
        $product = App\Product::find($id);
        foreach($product->details as $detail) {
            $attribute = [
                'attribute_name' => $detail->attribute_name,
                'attribute_value' => request($detail->attribute_name)
            ];
            $detailTemp = App\Detail::find($detail->id);
            $detailTemp->update($attribute);
        }
        return redirect('/admin')->with('success', 'Edit successful');
    }

    public function create() {
        $this->authorize('can-open', auth()->user());

        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        return view('create-admin', compact('menu'));
    }

    public function next(App\Http\Requests\ProductValidation $request) {
        $this->authorize('can-open', auth()->user());
//        $attribute = request()->validate([
//           'sku' => 'required|max:255|unique:products',
//           'price' => 'required|numeric',
//           'offer' => 'required|numeric',
//           'description' => 'required|min:8|max:255',
//           'qty' => 'required|numeric'
//        ]);

        $attribute = $request->validated();

        if(request('avatar')) {
            $attribute['avatar'] = request('avatar')->store('avatars');
        }

        $attribute['category_id'] = request('category_id');
        $attribute['variants'] = request('variants');
        $attribute['manager_id'] = auth()->user()->id;


        App\Product::create($attribute);
        $product = App\Product::latest()->first();
        $this->store($product->id);

//        $category = App\Category::find(request('category_id'));

//        return view('create-admin-2', [
//            'category' => $category,
//            'product' => $product
//        ]);
        return redirect('/admin')->with('success', 'Data added successfully');
    }

    public function store($product_id) {
        $this->authorize('can-open', auth()->user());
        $product = App\Product::find($product_id);
        $category = App\Category::find($product->category_id);
        $ids = [];
        foreach($category->attributes as $attribute) {
            if($row = App\Detail::where('attribute_name', $attribute->name)->where('attribute_value', request($attribute->name))->first()) {
                array_push($ids, $row->id);
            } else {
                $input = [
                    'attribute_name' => $attribute->name,
                    'attribute_value' => request($attribute->name)
                ];
                App\Detail::create($input);
                $detail = App\Detail::where('attribute_name', $attribute->name)->where('attribute_value', request($attribute->name))->first();
                array_push($ids, $detail->id);
            }
        }

        $product->details()->attach($ids);
    }

    public function viewUser() {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $users = App\User::latest()->get();

        $menu = Menu::new()
            ->addClass('nav')
            ->link('/', 'Welcome')
            ->link('/admin', 'Home')
            ->link('/admin/create', 'Add Product')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/category/create">Add Category</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/attribute">Attributes</a>')
            ->htmlIf(auth()->user()->roles === 'admin', '<a href="/admin/userDetails">User details</a>');

        return view('admin-userDetails', [
            'users' => $users,
            'menu' => $menu
        ]);
    }

    public function changeRole($userId) {
        $this->authorize('can-open', auth()->user());
        $this->authorize('access', auth()->user());
        $user = App\User::find($userId);
        if(request('action') === 'makeAdmin') {
            $user->roles = 'admin';
        } else if(request('action') === 'makeManager') {
            $user->roles = 'manager';
        } else if(request('action') === 'removeAdmin') {
            $user->roles = 'user';
        }
        $user->save();
        return back();
    }

    public function getCategory($id) {
        $this->authorize('can-open', auth()->user());
        return json_encode(App\Category::find($id)->attributes);
    }
}
