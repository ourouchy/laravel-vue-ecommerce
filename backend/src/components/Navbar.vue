<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import store from "../store/index.js";
import router from "../router/index.js";
import {computed} from "vue";


const emit = defineEmits(['toggle-sidebar'])

const currentUser = computed(() => store.state.user.data);
function logout(){
    store.dispatch('logout')
        .then(() => {
            router.push({name: 'login'})
        })
}

</script>

<template>
    <header class="flex justify-between items-center py-4 px-3 h-14 shadow bg-white">
        <button @click="emit('toggle-sidebar')" class="flex items-center justify-center rounded transition-colors w-8 h-8 text-gray-700 hover:bg-black/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

        </button>


            <Menu as="div" class="relative inline-block text-left">
                <div>
                    <MenuButton class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/79.jpg" class="rounded-full w-8 mr-2">
                        <small>{{currentUser.name}}</small>
                        <ChevronDownIcon
                            class="h-5 w-5 text-indigo-200 hover:text-indigo-100"
                            aria-hidden="true"
                        />
                    </MenuButton>
                </div>

                <transition
                    enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0"
                >
                    <MenuItems
                        class="absolute right-0 mt-2 w-36 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                    >
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                                <button
                                    :class="[
                                      active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                        ]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2 text-indigo-800">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>

                                    Profile
                                </button>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <button
                                    @click="logout"
                                    :class="[
                                      active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2 text-indigo-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>

                                    Logout
                                </button>
                            </MenuItem>
                        </div>

                    </MenuItems>
                </transition>
            </Menu>

    </header>
</template>





<style scoped>

</style>
