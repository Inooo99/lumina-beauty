<div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow h-full flex flex-col">
    <div class="aspect-square mb-4 rounded-lg overflow-hidden bg-gray-100 relative group">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-white text-gray-800 px-4 py-2 rounded-full text-sm font-bold shadow-lg hover:bg-primary transition-colors cursor-pointer">
            <i class="ri-shopping-cart-2-line mr-1"></i> Add
            </button>
        </form>
        </div>
    </div>
    
    <div class="flex-1">
        <h4 class="font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h4>
        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $product->description }}</p>
    </div>
    
    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        <a href="{{ route('product.detail', $product->id) }}" class="text-sm text-gray-500 hover:text-primary transition-colors">
            Detail
        </a> 
    </div>
</div>