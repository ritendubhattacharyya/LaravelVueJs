@extends('layouts.admin')

@section('content')
 <div class="p-4 bg-white" border-gray-500>
     @if(session('success'))
         <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-3 rounded relative" role="alert">
             <strong class="font-bold">{{ session('success') }}</strong>
         </div>
     @elseif(session('error'))
         <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-3 rounded relative" role="alert">
             <strong class="font-bold">{{ session('error') }}</strong>
         </div>
     @endif
     <h1 class="font-bold text-2xl mb-4">Products</h1>
     <table class="table-auto bg-white w-full">
         <thead>
         <tr>
             <th class="px-4 py-2">id</th>
             <th class="px-4 py-2">Type</th>
             <th class="px-4 py-2">Name</th>
             <th class="px-4 py-2">Price</th>
             <th class="px-4 py-2">Offer</th>
             <th class="px-4 py-2">Qty</th>
             <th class="px-4 py-2">Action</th>
         </tr>
         </thead>
         <tbody>
         @forelse($products as $product)
             <tr>
                 <td class="border border-gray-500 px-4 py-2">{{ $product->id }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ App\Category::find($product->category_id)->name }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ $product->name }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ $product->price }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ $product->offer }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ $product->qty }}</td>
                 <td class="border border-gray-500 px-4 py-2 flex justify-center">
                     <form action="/admin/edit/{{ $product->id }}" method="get">
                         @csrf
                         <button type="submit" class="button bg-transparent text-blue-500 mr-3">Edit</button>
                     </form>
                     <form action="/admin/{{ $product->id }}" method="post">
                         @csrf
                         @method('delete')
                         <button type="submit" class="button bg-transparent text-blue-500">Delete</button>
                     </form>
                 </td>
             </tr>
         @empty
             <p class="text-xl text-gray-500">No product sorry!!</p>
         @endforelse

         </tbody>
     </table>

{{--     category view--}}
     <h1 class="font-bold text-2xl mb-4 mt-16">Categories</h1>
     <table class="table-auto bg-white w-full">
         <thead>
         <tr>
             <th class="px-4 py-2">id</th>
             <th class="px-4 py-2">Name</th>
             <th class="px-4 py-2">Created_at</th>
             <th class="px-4 py-2">Actions</th>
         </tr>
         </thead>
         <tbody>
         @foreach($categories as $category)
             <tr>
                 <td class="border border-gray-500 px-4 py-2">{{ $category->id }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ $category->name }}</td>
                 <td class="border border-gray-500 px-4 py-2">{{ $category->created_at }}</td>
                 <td class="border border-gray-500 px-4 py-2 flex justify-center">
                     <form action="/admin/category/edit/{{ $category->id }}" method="get">
                         @csrf
                         <button type="submit" class="button bg-transparent text-blue-500 mr-3">Edit</button>
                     </form>
                     <form action="/admin/category/{{ $category->id }}" method="post">
                         @csrf
                         @method('delete')
                         <button type="submit" class="button bg-transparent text-blue-500">Delete</button>
                     </form>
                 </td>
             </tr>
         @endforeach

         </tbody>
     </table>

 </div>
@endsection
