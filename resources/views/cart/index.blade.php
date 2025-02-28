<x-app-layout>
    <div class="container lg:w-2/3 xl:w-2/3 mx-auto mt-28">
        <h1 class="text-3xl font-bold mb-6">Your Cart Items</h1>

        <div x-data="{
        cartItems: {{
            json_encode(
                $products->map(fn($product) => [
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image ?: '/img/noimage.png',
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $cartItems[$product->id]['quantity'],
                    'href' => route('product.view', $product->slug),
                    'removeUrl' => route('cart.remove', $product),
                    'updateQuantityUrl' => route('cart.update-quantity', $product)
                ])
            )
        }},
        get cartTotal() {
            return this.cartItems.reduce((accum, next) => accum + next.price * next.quantity, 0).toFixed(2)
        },
    }"
             @cart-change.window="cartItems = cartItems.filter(p => p.id !== $event.detail.product_id)"
             class="bg-white p-4 rounded-lg shadow">
            <!-- Product Items -->
            <template x-if="cartItems.length">
                <div>
                    <!-- Product Item -->
                    <template x-for="product in cartItems" :key="product.id">
                        <div x-data="productItem(product)">
                            <li class="relative flex items-center justify-between mb-3 p-3 h-20 bg-gray-100 transform scale-100 hover:scale-105 rounded-lg shadow group transition-transform duration-300 ease">
                                <a class="flex-shrink mr-3 h-full hover:opacity-75 transition-opacity duration-150 ease" :href="product.href">
                                    <img class="h-full object-cover rounded-lg shadow lazyload" :src="product.image" data-sizes="auto" :alt="product.title">
                                </a>
                                <div class="flex-grow flex flex-col items-start justify-center leading-6">
                                    <h3 x-text="product.title"></h3>
                                    <span class="inline-block text-xs">Size: M</span>
                                    <span class="inline-block text-lg font-bold leading-6">$<span x-text="product.price"></span></span>
                                </div>
                                <div class="flex-shrink flex flex-col items-center justify-between w-8">
                                    <button class="animate-boing hover:opacity-75 transition-opacity duration-150 ease"
                                            @click.prevent="product.quantity++; changeQuantity()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <input class="w-full text-center bg-transparent"
                                           type="number"
                                           x-model.number="product.quantity"
                                           @change="changeQuantity()">
                                    <button class="animate-boing hover:opacity-75 transition-opacity duration-150 ease"
                                            @click.prevent="if(product.quantity > 1) { product.quantity--; changeQuantity() }">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <button class="absolute -top-2 -right-2 text-red-500 hover:text-red-400 opacity-0 group-hover:opacity-100 animate-boing transition-colors duration-150 ease"
                                        @click.prevent="removeItemFromCart()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </li>
                        </div>
                    </template>
                    <!-- Product Item -->

                    <div class="border-t border-gray-300 pt-4">
                        <div class="flex justify-between">
                            <span class="font-semibold">Subtotal</span>
                            <span id="cartTotal" class="text-xl" x-text="`$${cartTotal}`"></span>
                        </div>
                        <p class="text-gray-500 mb-6">
                            Shipping and taxes calculated at checkout.
                        </p>

                        <form action="" method="post">
                            @csrf
                            <button type="submit" class="btn-primary w-full py-3 text-lg">
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                </div>
                <!--/ Product Items -->
            </template>
            <template x-if="!cartItems.length">
                <div class="text-center py-8 text-gray-500">
                    You don't have any items in cart
                </div>
            </template>
        </div>
    </div>
</x-app-layout>
