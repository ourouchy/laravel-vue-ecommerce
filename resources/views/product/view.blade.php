 <x-app-layout>
     <div class="container mx-auto px-4 py-8">
         <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <!-- Product Image Gallery -->
             <div x-data="{
            images: ['{{ $product->image }}'],
            activeImage: null,
            prev() {
                let index = this.images.indexOf(this.activeImage);
                if (index === 0)
                    index = this.images.length;
                this.activeImage = this.images[index - 1];
            },
            next() {
                let index = this.images.indexOf(this.activeImage);
                if (index === this.images.length - 1)
                    index = -1;
                this.activeImage = this.images[index + 1];
            },
            init() {
                this.activeImage = this.images.length > 0 ? this.images[0] : null
            }
        }">
                 <div class="relative">
                     <template x-for="image in images">
                         <div x-show="activeImage === image" class="aspect-w-3 aspect-h-2">
                             <img :src="image" alt="{{ $product->title }}" class="object-cover rounded-xl" />
                         </div>
                     </template>
                     <!-- Navigation arrows -->
                     <a @click.prevent="prev" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/30 text-white p-2 rounded-l-lg">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                         </svg>
                     </a>
                     <a @click.prevent="next" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/30 text-white p-2 rounded-r-lg">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                         </svg>
                     </a>
                 </div>
                 <!-- Thumbnail navigation -->
                 <div class="flex mt-4 space-x-4">
                     <template x-for="image in images">
                         <a @click.prevent="activeImage = image" class="cursor-pointer">
                             <img :src="image" alt="" class="w-20 h-20 object-cover rounded-lg" :class="{'ring-2 ring-slate-900': activeImage === image}" />
                         </a>
                     </template>
                 </div>
             </div>

             <!-- Product Details -->
             <div>
                 <h1 class="text-3xl font-bold text-slate-900 mb-4">{{ $product->title }}</h1>
                 <div class="flex items-center mb-4">
                     <div class="flex items-center">
                         <!-- Add your rating component here if you have product ratings -->
                         <span class="ml-2 text-sm font-semibold text-slate-900">5.0</span>
                     </div>
                 </div>
                 <div class="mb-4">
                     <span class="text-3xl font-bold text-slate-900">${{ $product->price }}</span>
                     @if($product->original_price && $product->original_price > $product->price)
                         <span class="text-sm text-slate-900 line-through ml-2">${{ $product->original_price }}</span>
                         @php
                             $discount = round((($product->original_price - $product->price) / $product->original_price) * 100);
                         @endphp
                         <span class="ml-2 rounded-full bg-black px-2 py-1 text-xs font-semibold text-white">{{ $discount }}% OFF</span>
                     @endif
                 </div>
                 <div class="mb-6">
                     <label for="quantity" class="block text-sm font-medium text-slate-700 mb-2">Quantity</label>
                     <input type="number" name="quantity" x-ref="quantityEl" value="1" min="1"
                            class="w-20 rounded-md border-gray-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                 </div>
                 <button @click="addToCart({{ $product->id }}, $refs.quantityEl.value)"
                         class="w-full bg-slate-900 text-white py-3 px-6 rounded-md text-sm font-medium hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300 flex items-center justify-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                     </svg>
                     Add to Cart
                 </button>
                 <div class="mt-8" x-data="{expanded: false}">
                     <h3 class="text-lg font-semibold mb-2">Product Description</h3>
                     <div x-show="expanded" x-collapse.min.120px class="text-sm text-gray-700 mb-2">
                         {{ $product->description }}
                     </div>
                     <button @click="addToCart()" class="text-sm text-slate-900 font-medium hover:text-gray-700">
                         <span x-text="expanded ? 'Read Less' : 'Read More'"></span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
</x-app-layout>
