<!-- MAIN -->
<main x-data="{ right: false, left: false, cartItemsCount: {{\App\Http\Helpers\Cart::getCartItemsCount()}} }"
      @cart-change.window="cartItemsCount = $event.detail.count"
      @body:right.window="right = !right" @body:left.window="left = !left" @body:reset.window="left = false; right = false" :class="{ '-translate-x-full md:-translate-x-120' : left, 'translate-x-full md:translate-x-120' : right }" class="fixed bg-white w-full transform translate-x-0 transition-transform duration-500 ease z-30">
    <!-- OVERLAY -->
    <div x-data="{ isActive: false }" @overlay:open.window="isActive = true" @overlay:close.window="isActive = false" :class="{ 'opacity-75 visible' : isActive, 'opacity-0 invisible' : !isActive }" class="absolute inset-0 w-full h-full opacity-0 invisible z-20 transition-all duration-500 ease"></div>

    <!-- SIDEBARS -->

    <!-- mobile menu -->
    <nav x-data="sidebar" x-bind="setup" @mobile-sidebar:open.window="open()" @mobile-sidebar:close.window="close()" x-cloak data-position="left"
         class="fixed top-0 flex flex-col pb-72 w-full md:w-120 h-[calc(100vh)] text-gray-900 bg-white shadow transform z-50
                                                                        ">

        <header class="relative p-6 pt-6 pb-0 text-center">
            <div class="flex justify-between">
            <button x-data @click="$dispatch('mobile-sidebar:close')" class="bottom-0 left-6 transform animate-boing hover:text-indigo-500 transition-transform,transition-colors ease">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
            </button>
            <a class="mr-14">
                <img class="max-h-14 pr-1" src="{{ asset('images/logo.png') }}" alt="friandos">
            </a>
            </div>
        </header>



        <ul class="flex flex-col p-6 pb-0">

            <li x-data="{ active: false, height: 0 }" x-init="height = $refs.menu.offsetHeight; $refs.menu.style = 'height: 0'" @mouseenter="active = true; $refs.menu.style = 'height: ${height}px';console.log($refs.menu)" @mouseleave="active = false; $refs.menu.style = 'height: 0'" class="group transform scale-100 hover:scale-105 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">
                <a href="#" class="block p-3 text-xl hover:text-indigo-500 transition-colors duration-300 ease">Shop</a>

                <ul x-ref="menu" x-init="$refs.menu" x-show="active" class="transition-height duration-300 ease">

                    <li class="block ml-3">
                        <a href="#" class="block p-3 text-lg text-gray-500 hover:text-indigo-500 transition-colors ease">Clothes</a>
                    </li>

                    <li class="block ml-3">
                        <a href="#" class="block p-3 text-lg text-gray-500 hover:text-indigo-500 transition-colors ease">Electronics</a>
                    </li>

                    <li class="block ml-3">
                        <a href="#" class="block p-3 text-lg text-gray-500 hover:text-indigo-500 transition-colors ease">Furniture</a>
                    </li>

                    <li class="block ml-3">
                        <a href="#" class="block p-3 text-lg text-gray-500 hover:text-indigo-500 transition-colors ease">Insurance</a>
                    </li>

                </ul>
            </li>

            <li class="">
                <a href="#" class="block p-3 text-xl transform scale-100 hover:scale-105 hover:text-indigo-500 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">About</a>
            </li>

            <li class="">
                <a href="#" class="block p-3 text-xl transform scale-100 hover:scale-105 hover:text-indigo-500 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">Blog</a>
            </li>

            <li class="">
                <a href="#" class="block p-3 text-xl transform scale-100 hover:scale-105 hover:text-indigo-500 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">FAQ</a>
            </li>

            <li class="">
                <a href="#" class="block p-3 text-xl transform scale-100 hover:scale-105 hover:text-indigo-500 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">Support</a>
            </li>

            <li class="">
                <a href="#" class="block p-3 text-xl transform scale-100 hover:scale-105 hover:text-indigo-500 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">Reviews</a>
            </li>

            <li class="">
                <a href="#" class="block p-3 text-xl transform scale-100 hover:scale-105 hover:text-indigo-500 hover:bg-gray-100 hover:shadow transition-transform,transition-colors duration-300 ease rounded">Contact</a>
            </li>
        </ul>

        <div class="px-6 py-3">
            <hr />
        </div>

    </nav>

    <!-- cart menu -->
    <nav x-data="sidebar" x-bind="setup" @cart-sidebar:open.window="open()" @cart-sidebar:close.window="close()" x-cloak data-position="right"
         class="fixed top-0 flex flex-col pb-72 w-full md:w-120 h-[calc(100vh)] text-gray-900 bg-white shadow transform z-50"
    >
        @include('layouts.navigation_cart')
    </nav>

    <!-- HEADER -->
    <header class="p-5 flex items-center justify-between text-gray-900 shadow z-30">
        <div class="md:hidden">

            <!-- toggle mobile menu -->
            <button x-data @click="$dispatch('mobile-sidebar:open'); console.log('button clicked')" class="inline-block hover:text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>


        <!-- Logo -->
        <div class="pt-3 pl-3 pb-3 ml-0">
            <a href="{{route('home')}}" class="py-navbar-item w-56 h-12">
                <img class="max-h-14 pr-1" src="{{ asset('images/logo.png') }}" alt="friandos">
            </a>
        </div>
        <div>
            <div class="flex items-center gap-4">

                <!--  toggle cart menu -->
                <div class="">

                    <button x-data @click="$dispatch('cart-sidebar:open')" class="relative inline-block hover:text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <small
                            x-show="cartItemsCount"
                            x-transition
                            x-text="cartItemsCount"
                            x-cloak
                            class="py-[2px] px-[8px] rounded-full bg-red-500"
                        ></small>
                    </button>
                </div>
                @if (!Auth::guest())
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                    <div>
                        <button @click="open = !open" type="button" class="relative inline-flex items-center justify-center text-gray-900 hover:text-indigo-500 mt-1">
                            <!-- SVG Icon with hover effect on the icon only -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 hover:text-indigo-500">
                                <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>


                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none;">
                        <div class="py-1" role="none">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">License</a>

                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                    <a href="{{route('register')}}" class="py-3 px-5 w-max bg-indigo-500 text-white text-sm font-semibold rounded-md shadow-lg shadow-indigo-500/50 focus:outline-none">
                        Se connecter
                    </a>
                @endif


            </div>
        </div>

    </header>



</main>
