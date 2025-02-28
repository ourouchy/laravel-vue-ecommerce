<script setup>
  import Sidebar from "./Sidebar.vue";
  import Navbar from "./Navbar.vue";
  import {ref, onMounted, onUnmounted, computed} from 'vue'
  import store from "../store/index.js";
  import Spinner from "./core/spinner.vue";


  const currentUser = computed(() => store.state.user.data);






const {title} = defineProps({
      title: String
  })

  const sidebarOpened = ref(true)

  function toggleSidebar(){
        sidebarOpened.value = !sidebarOpened.value
  }
onMounted(()=>{
    store.dispatch('getUser')
    handleSidebarOpened()
    window.addEventListener('resize', handleSidebarOpened)
})

  onUnmounted(()=>{
      window.removeEventListener('resize', handleSidebarOpened)
  })
function handleSidebarOpened(){

        sidebarOpened.value = window.outerWidth > 768;

}
</script>

<template>

    <div
        v-if="currentUser.id"
        class="min-h-full bg-gray-200 flex">
        <!----    Sidebar ---->
        <Sidebar :class="{'-ml-[200px]': !sidebarOpened }"></Sidebar>
        <!----    Sidebar ----->

        <div class="flex-1">
            <Navbar @toggle-sidebar="toggleSidebar"></Navbar>

            <!--- Content ---->

            <main class="p-6">
                    <router-view></router-view>

            </main>

            <!--- Content ---->

        </div>
    </div>
    <div v-else class=" min-h-full bg-gray-200 flex items-center justify-center">
        <spinner />
        </div>

</template>





<style scoped>

</style>
