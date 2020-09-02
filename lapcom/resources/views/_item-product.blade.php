<a href="product/{{ $product->id }}">
    <div>
        <div class="max-w-sm rounded overflow-hidden shadow-lg hover:shadow-xl">
            <img class="w-full" src="{{ $product->getAvatarPath() }}" alt="Product" style="height:150px">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">
                    {{ $product->details->filter(function($detail){return $detail->attribute_name === 'name';})->first()->attribute_value}}
                </div>
                <p class="text-gray-700 text-base">
                    {{ $product->offer }}
                </p>
            </div>
        </div>
    </div>
</a>
