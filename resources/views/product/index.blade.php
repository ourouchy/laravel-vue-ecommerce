 <x-app-layout>
        <main class="main-content mt-28">




            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="flex flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md"
                             x-data="productItem({{ json_encode([
                'id' => $product->id,
                'image' => $product->image,
                'title' => $product->title,
                'price' => $product->price,
                'originalPrice' => $product->original_price ?? null,
                'addToCartUrl' => route('cart.add', $product)
            ]) }})">
                            <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="{{ route('product.view', $product->slug) }}">
                                <img class="object-cover w-full" src="{{ $product->image }}" alt="{{ $product->title }}" />
                                @if($product->original_price && $product->original_price > $product->price)
                                    @php
                                        $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                                    @endphp
                                    <span class="absolute top-0 left-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white">{{ $discount }}% OFF</span>
                                @endif
                            </a>
                            <div class="mt-4 px-5 pb-5 flex-grow">
                                <a href="{{ route('product.view', $product->slug) }}">
                                    <h5 class="text-xl tracking-tight text-slate-900">{{ $product->title }}</h5>
                                </a>
                                <div class="mt-2 mb-5 flex items-center justify-between">
                                    <p>
                                        <span class="text-3xl font-bold text-slate-900">${{ $product->price }}</span>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="text-sm text-slate-900 line-through">${{ $product->original_price }}</span>
                                        @endif
                                    </p>
                                    <!-- Add your rating component here if you have product ratings -->
                                </div>
                                <button @click="addToCart()"
                                        class="flex w-full items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
</x-app-layout>
