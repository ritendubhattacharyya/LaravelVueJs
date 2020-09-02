<div class="flex mb-4 border border-gray-400 items-center bg-white" style="width:100%">
    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" title="Woman holding a mug">
        <img src="{{ $product->getAvatarPath() }}" alt="" style="width:100%; height:100%;">
    </div>
    <div class="flex-1 bg-white p-6">
        <div class="mb-8">
            <div class="text-gray-900 font-bold text-xl mb-2">{{ $product->name }}</div>
            <p class="text-gray-700 text-base">Price: {{ ($product->offer) ? $product->offer : $product->mrp }}</p>
            <div class="flex py-4">
                <form action="/cart/{{ App\Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->firstorfail()->id }}/decrement" method="POST">
                    @csrf
                    <button type="submit" class="bg-transparent border border-gray-400 px-2">-</button>
                </form>
                <p class="px-2 border border-gray-400">Qty: {{ $product->cartQty }}</p>
                <form action="/cart/{{ App\Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->firstorfail()->id }}/increment" method="POST">
                    @csrf
                    <button type="submit" class="bg-transparent border border-gray-400 px-2">+</button>
                </form>
            </div>
        </div>
    </div>
    <form action="/cart/{{ App\Cart::where('user_id', auth()->user()->id)->where('product_id', $product->id)->firstorfail()->id }}" method="POST" class="px-4">
        @csrf
        @method('DELETE')
        <button type="submit" >
            <img src="/img/remove.png" alt="remove" width="20" height="20">
        </button>
    </form>

</div>


