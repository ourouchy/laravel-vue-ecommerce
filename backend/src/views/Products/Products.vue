<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-3xl font-semibold">Products</h1>
        <button type="submit"
                @click="showProductModel"
                class="flex w-40 h-9 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Add new Product
        </button>

    </div>
    <ProductModel v-model="showModel" :product="productModel" @close="onModelClose"/>
    <ProductsTable @clickEdit="editProduct"/>
</template>

<script setup>


import {ref} from "vue";
import ProductsTable from "./ProductsTable.vue";
import ProductModel from "./ProductModel.vue";
import store from "../../store/index.js";

const DEFAULT_EMPTY_OBJET = {
    id: '',
    title:'',
    image:'',
    description: '',
    price: '',
}
const showModel = ref(false);
const productModel = ref({...DEFAULT_EMPTY_OBJET})

function showProductModel(){
    showModel.value = true
}

function editProduct(product) {
    store.dispatch('getProduct', product.id)
        .then(({data}) => {
          productModel.value = data
            showProductModel()
    })
}


function onModelClose(){
    productModel.value = {...DEFAULT_EMPTY_OBJET}
}
</script>

