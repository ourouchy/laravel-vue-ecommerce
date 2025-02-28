<template>
    <div class="flex justify-center items-center min-h-full w-full min-w-full">
        <div class="flex">
            <div class="text-indigo-600 self-start text-5xl px-8 font-bold border-r pb-8 leading-10">404</div>
            <div class="px-8">
                <h1 class="text-5xl font-bold mb-2">Page not found</h1>
                <p class="text-gray-500 mb-9">Please check the url in address bar and try again !</p>
                <div>
                    <router-link :to="{name: 'app.dashboard'}" type="submit" class="rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back home</router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>


</script>

